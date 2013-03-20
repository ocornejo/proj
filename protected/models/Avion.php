<?php

/**
 * This is the model class for table "avion".
 *
 * The followings are the available columns in table 'avion':
 * @property string $MATRICULA
 * @property integer $FLOTA_ID_FLOTA
 * @property integer $OPERADOR_ID_OPERADOR
 *
 * The followings are the available model relations:
 * @property Operador $oPERADORIDOPERADOR
 * @property Flota $fLOTAIDFLOTA
 * @property Trabajo[] $trabajos
 */
class Avion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Avion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'avion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MATRICULA, FLOTA_ID_FLOTA, OPERADOR_ID_OPERADOR', 'required'),
			array('FLOTA_ID_FLOTA, OPERADOR_ID_OPERADOR', 'numerical', 'integerOnly'=>true),
			array('MATRICULA', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('MATRICULA, FLOTA_ID_FLOTA, OPERADOR_ID_OPERADOR', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'oPERADORIDOPERADOR' => array(self::BELONGS_TO, 'Operador', 'OPERADOR_ID_OPERADOR'),
			'fLOTAIDFLOTA' => array(self::BELONGS_TO, 'Flota', 'FLOTA_ID_FLOTA'),
			'tRABAJO' => array(self::HAS_MANY, 'Trabajo', 'AVION_MATRICULA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'MATRICULA' => 'Matricula',
			'FLOTA_ID_FLOTA' => 'ID Flota',
			'OPERADOR_ID_OPERADOR' => 'ID Operador',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('MATRICULA',$this->MATRICULA,true);
		$criteria->compare('FLOTA_ID_FLOTA',$this->FLOTA_ID_FLOTA);
		$criteria->compare('OPERADOR_ID_OPERADOR',$this->OPERADOR_ID_OPERADOR);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                    'pagination'=>array('pageSize'=>100),
		));
	}
        
        public function suggestMatricula($keyword, $limit=20)
	{
		$criteria=array(
			'select'=>'DISTINCT(MATRICULA) AS MATRICULA',
			'condition'=>'MATRICULA LIKE :keyword',
			'order'=>'MATRICULA',
			'limit'=>$limit,
			'params'=>array(
				':keyword'=>"$keyword%"
			)
		);
		$models=$this->findAll($criteria);
		$suggest=array();
		foreach($models as $model) {
				$suggest[] = array(
					'value'=>$model->MATRICULA,
					'label'=>$model->MATRICULA,
				);
		}
		return $suggest;
	}
        
        public function getOptions()
	{
		return CHtml::listData($this->findAll(),'MATRICULA','MATRICULA');
	}
        
}
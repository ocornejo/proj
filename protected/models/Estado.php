<?php

/**
 * This is the model class for table "estado".
 *
 * The followings are the available columns in table 'estado':
 * @property integer $ID_ESTADO
 * @property string $NOMBRE_ESTADO
 *
 * The followings are the available model relations:
 * @property Trabajo[] $trabajos
 */
class Estado extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Estado the static model class
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
		return 'estado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOMBRE_ESTADO', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_ESTADO, NOMBRE_ESTADO', 'safe', 'on'=>'search'),
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
			'trabajos' => array(self::HAS_MANY, 'Trabajo', 'ESTADO_ID_ESTADO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_ESTADO' => 'Id Estado',
			'NOMBRE_ESTADO' => 'Nombre Estado',
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

		$criteria->compare('ID_ESTADO',$this->ID_ESTADO);
		$criteria->compare('NOMBRE_ESTADO',$this->NOMBRE_ESTADO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
	 * @return array for dropdown (attr1 => attr2)
	 */
	public function getOptions()
	{
		return CHtml::listData($this->findAll(),'ID_ESTADO','NOMBRE_ESTADO');
	}
}
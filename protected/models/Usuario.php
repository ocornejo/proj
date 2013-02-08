<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property integer $BP
 * @property string $NOMBRE
 * @property integer $NIVEL_USUARIO
 * @property string $PASSWORD
 * @property integer $FILIAL_ID_FILIAL
 *
 * The followings are the available model relations:
 * @property Trabajo[] $trabajos
 * @property Filial $fILIALIDFILIAL
 */
class Usuario extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuario the static model class
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
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('BP, FILIAL_ID_FILIAL', 'required'),
			array('BP, NIVEL_USUARIO, FILIAL_ID_FILIAL', 'numerical', 'integerOnly'=>true),
			array('NOMBRE', 'length', 'max'=>25),
			array('PASSWORD', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('BP, NOMBRE, NIVEL_USUARIO, PASSWORD, FILIAL_ID_FILIAL', 'safe', 'on'=>'search'),
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
			'trabajos' => array(self::HAS_MANY, 'Trabajo', 'USUARIO_BP'),
			'fILIALIDFILIAL' => array(self::BELONGS_TO, 'Filial', 'FILIAL_ID_FILIAL'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'BP' => 'Bp',
			'NOMBRE' => 'Nombre',
			'NIVEL_USUARIO' => 'Nivel Usuario',
			'PASSWORD' => 'Password',
			'FILIAL_ID_FILIAL' => 'Filial Id Filial',
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

		$criteria->compare('BP',$this->BP);
		$criteria->compare('NOMBRE',$this->NOMBRE,true);
		$criteria->compare('NIVEL_USUARIO',$this->NIVEL_USUARIO);
		$criteria->compare('PASSWORD',$this->PASSWORD,true);
		$criteria->compare('FILIAL_ID_FILIAL',$this->FILIAL_ID_FILIAL);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
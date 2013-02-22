<?php

/**
 * This is the model class for table "trabajo".
 *
 * The followings are the available columns in table 'trabajo':
 * @property integer $ID_TRABAJO
 * @property integer $OT
 * @property string $AVION_MATRICULA
 * @property integer $USUARIO_BP
 * @property integer $PLANIFICADO
 * @property string $HORA_INICIO
 * @property string $HORA_TERMINO
 * @property string $COMENTARIO
 * @property string $FECHA
 * @property integer $CALIFICACION
 * @property integer $ESTADO_ID_ESTADO
 * @property integer $LUGAR_ID_LUGAR
 * @property integer $ASEO_ID_ASEO
 * @property integer $TURNO_ID_TURNO
 * @property string $ARCHIVO
 *
 * The followings are the available model relations:
 * @property Nota[] $notas
 * @property Aseo $aSEOIDASEO
 * @property Avion $aVIONMATRICULA
 * @property Estado $eSTADOIDESTADO
 * @property Lugar $lUGARIDLUGAR
 * @property Turno $tURNOIDTURNO
 * @property Usuario $uSUARIOBP
 */
class Trabajo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Trabajo the static model class
	 */
	public $imagen;
        
        public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'trabajo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('AVION_MATRICULA, USUARIO_BP, ESTADO_ID_ESTADO,FECHA, ASEO_ID_ASEO, TURNO_ID_TURNO,LUGAR_ID_LUGAR', 'required','on'=>'guardar'),
			//array('AVION_MATRICULA, USUARIO_BP, ESTADO_ID_ESTADO,FECHA, ASEO_ID_ASEO, TURNO_ID_TURNO,LUGAR_ID_LUGAR','allowEmpty'=>true, 'on'=>'formSubmit'),
                        array('OT, USUARIO_BP, PLANIFICADO, CALIFICACION, ESTADO_ID_ESTADO, LUGAR_ID_LUGAR, ASEO_ID_ASEO, TURNO_ID_TURNO', 'numerical', 'integerOnly'=>true),
			array('FECHA','date', 'format'=>'yyyy-MM-dd'),
                        array('HORA_INICIO', 'date', 'format'=>'HH:mm'),
                        array('HORA_TERMINO','date', 'format'=>'HH:mm'),
                        array('imagen', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true,'on'=>'update'),
                        array('AVION_MATRICULA', 'length', 'max'=>7),
			array('COMENTARIO', 'length', 'max'=>255),
                        
			array('HORA_INICIO, HORA_TERMINO, FECHA', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_TRABAJO, OT, AVION_MATRICULA, USUARIO_BP, PLANIFICADO, HORA_INICIO, HORA_TERMINO, COMENTARIO, FECHA, CALIFICACION, ESTADO_ID_ESTADO, LUGAR_ID_LUGAR, ASEO_ID_ASEO, TURNO_ID_TURNO,ARCHIVO', 'safe', 'on'=>'search'),
		);
	}
        
        function behaviors() {
            return array(
                'ensureNull' => array(
                    'class' => 'ext.ensureNullBehavior.EEnsureNullBehavior',
                    // Uncomment if you don't want to ensure nulls on update
                    // 'useOnUpdate' => false,
                )
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
			'notas' => array(self::HAS_MANY, 'Nota', 'TRABAJO_ID_TRABAJO'),
			'aSEOIDASEO' => array(self::BELONGS_TO, 'Aseo', 'ASEO_ID_ASEO'),
			'AVION' => array(self::BELONGS_TO, 'Avion', 'AVION_MATRICULA'),
                        'amat' => array(self::HAS_ONE,'Avion','MATRICULA'),
			'eSTADOIDESTADO' => array(self::BELONGS_TO, 'Estado', 'ESTADO_ID_ESTADO'),
			'lUGARIDLUGAR' => array(self::BELONGS_TO, 'Lugar', 'LUGAR_ID_LUGAR'),
			'tURNOIDTURNO' => array(self::BELONGS_TO, 'Turno', 'TURNO_ID_TURNO'),
			'uSUARIOBP' => array(self::BELONGS_TO, 'Usuario', 'USUARIO_BP'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_TRABAJO' => 'ID',
			'OT' => 'OT',
			'AVION_MATRICULA' => 'Matrícula',
			'USUARIO_BP' => 'BP',
			'PLANIFICADO' => 'Planificado',
			'HORA_INICIO' => 'Hora inicio',
			'HORA_TERMINO' => 'Hora término',
			'COMENTARIO' => 'Comentario',
			'FECHA' => 'Fecha',
			'CALIFICACION' => 'Calificación',
			'ESTADO_ID_ESTADO' => 'Estado',
			'LUGAR_ID_LUGAR' => 'Lugar',
			'ASEO_ID_ASEO' => 'Aseo',
			'TURNO_ID_TURNO' => 'Turno',
                        'ARCHIVO'=> 'Archivo',
                        'imagen'=>'Foto',
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

		$criteria->compare('ID_TRABAJO',$this->ID_TRABAJO);
		$criteria->compare('OT',$this->OT);
		$criteria->compare('AVION_MATRICULA',$this->AVION_MATRICULA,true);
		$criteria->compare('USUARIO_BP',$this->USUARIO_BP);
		$criteria->compare('PLANIFICADO',$this->PLANIFICADO);
		$criteria->compare('HORA_INICIO',$this->HORA_INICIO,true);
		$criteria->compare('HORA_TERMINO',$this->HORA_TERMINO,true);
		$criteria->compare('COMENTARIO',$this->COMENTARIO,true);
		$criteria->compare('FECHA',$this->FECHA,true);
		$criteria->compare('CALIFICACION',$this->CALIFICACION);
		$criteria->compare('ESTADO_ID_ESTADO',$this->ESTADO_ID_ESTADO);
		$criteria->compare('LUGAR_ID_LUGAR',$this->LUGAR_ID_LUGAR);
		$criteria->compare('ASEO_ID_ASEO',$this->ASEO_ID_ASEO);
		$criteria->compare('TURNO_ID_TURNO',$this->TURNO_ID_TURNO);
                $criteria->compare('ARCHIVO', $this->ARCHIVO);
                
                //$criteria->with = array('avion');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        


}
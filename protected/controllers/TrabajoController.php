<?php

class TrabajoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	
//        public function actionCreate(){
//            $model = new Trabajo('inicio');
//            $modelT = new Turno;           
//            $model->save(false);
//            $this->render('create',array(
//			'model'=>$model,'modelT'=>$modelT,
//            ));
// 
//            
//        }

        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model= new Trabajo('inicio');
                $modelT= new Turno;
                
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation(array($model,$modelT));
                
                if(isset($_POST['Trabajo'],$_POST['Turno']))
		{
                        
                        //$model=$this->loadModel(Yii::app()->getRequest()->getQuery('id')); 
                        $model->attributes=$_POST['Trabajo'];
                        $modelT->attributes=$_POST['Turno'];
                        
                      
                        if($model->ASEO_ID_ASEO===8)
                            $model->scenario='bano';
                        else{
                            switch ($model->ESTADO_ID_ESTADO) {
                                case 1:
                                    $model->scenario='ok';
                                    break;
                                case 2:
                                    $model->scenario='pendiente';
                                    break;
                                case 3:
                                case 4:
                                case 5:
                                    $model->scenario='laneco';
                                    break;
                                case 9:
                                    $model->scenario='nula';
                                    break;
                            }
                        }
                
                
                if($model->validate() && $modelT->validate()){
                    
                        $var=Turno::model()->findAll(array('order'=>'ID_TURNO DESC', 'limit'=>'1'));
                        if(count($var)>0)
                            $idTurno = (int) $var[0]['ID_TURNO']+1; 
                        else {
                            $idTurno=1;
                        }
                        
                        $modelT->ID_TURNO=$idTurno;
                        $model->TURNO_ID_TURNO=$idTurno;
                        
                    if(CUploadedFile::getInstance($model,'imagen')!=null){
                                    $images_path = realpath(Yii::app()->basePath . '/../images');
                                    $path=$images_path . '/' .$model->AVION_MATRICULA."-".$model->FECHA."-".$model->ASEO_ID_ASEO.".JPG";
                                    $model->imagen=CUploadedFile::getInstance($model,'imagen');
                                    $model->ARCHIVO=$path;
                                    $model->imagen->saveAs($path);
                                    
                                    $modelT->save(false);
                                    $model->save(false);
                                     
                     if($model->ASEO_ID_ASEO==5 || $model->ASEO_ID_ASEO==7){       
                        $nota = new Nota;
                        $id_flota = Flota::model()->findByAttributes(array('NOMBRE_FLOTA' => $_POST['flotaId']))->ID_FLOTA;
                        $id_aseo = $model->ASEO_ID_ASEO;

                        $sql = Yii::app()->db->createCommand('SELECT evaluacion.id_evaluacion, evaluacion.nombre, ponderacion.ponderacion
                                                                                FROM evaluacion
                                                                                INNER JOIN ponderacion ON (ponderacion.evaluacion_id_evaluacion = evaluacion.id_evaluacion
                                                                                AND ponderacion.aseo_id_aseo=:id_aseo
                                                                                AND ponderacion.flota_id_flota =:id_flota )')->bindValues(array(':id_aseo' => $id_aseo,
                                                                                ':id_flota' => $id_flota))->queryAll();


                        $sql2 = Yii::app()->db->createCommand('SELECT item_se_evalua.item_id_item,item.evaluacion_id_evaluacion, item.nombre
                                                                                FROM item_se_evalua
                                                                                INNER JOIN item ON ( item_se_evalua.item_id_item = item.id_item
                                                                                AND item_se_evalua.flota_id_flota =:id_flota
                                                                                AND item_se_evalua.aseo_id_aseo =:id_aseo )')->bindValues(array(':id_aseo' => $id_aseo,
                                                                                ':id_flota' => $id_flota))->queryAll();

                        $this->renderPartial('createDialog', array('model' => $nota,
                            'id_aseo' => $id_aseo,
                            'id_trabajo' => $model->ID_TRABAJO,
                            'id_flota' => $id_flota,
                            'sql' => $sql,
                     'sql2' => $sql2 ), false, true);
                        
                     }

                    }
                    else{
                                    
                          $modelT->save(false);
                          $model->save(false);
                                    
                            if($model->ASEO_ID_ASEO==5 || $model->ASEO_ID_ASEO==7){       
                                                   $nota = new Nota;
                                                   $id_flota = Flota::model()->findByAttributes(array('NOMBRE_FLOTA' => $_POST['flotaId']))->ID_FLOTA;
                                                   $id_aseo = $model->ASEO_ID_ASEO;

                                                   $sql = Yii::app()->db->createCommand('SELECT evaluacion.id_evaluacion, evaluacion.nombre, ponderacion.ponderacion
                                                                                                           FROM evaluacion
                                                                                                           INNER JOIN ponderacion ON (ponderacion.evaluacion_id_evaluacion = evaluacion.id_evaluacion
                                                                                                           AND ponderacion.aseo_id_aseo=:id_aseo
                                                                                                           AND ponderacion.flota_id_flota =:id_flota )')->bindValues(array(':id_aseo' => $id_aseo,
                                                                                                           ':id_flota' => $id_flota))->queryAll();


                                                   $sql2 = Yii::app()->db->createCommand('SELECT item_se_evalua.item_id_item,item.evaluacion_id_evaluacion, item.nombre
                                                                                                           FROM item_se_evalua
                                                                                                           INNER JOIN item ON ( item_se_evalua.item_id_item = item.id_item
                                                                                                           AND item_se_evalua.flota_id_flota =:id_flota
                                                                                                           AND item_se_evalua.aseo_id_aseo =:id_aseo )')->bindValues(array(':id_aseo' => $id_aseo,
                                                                                                           ':id_flota' => $id_flota))->queryAll();

                                                   $this->renderPartial('createDialog', array('model' => $nota,
                                                       'id_aseo' => $id_aseo,
                                                       'id_trabajo' => $model->ID_TRABAJO,
                                                       'id_flota' => $id_flota,
                                                       'sql' => $sql,
                                                'sql2' => $sql2 ), false, true);

                                                }
                    }
                                    
                            
                            }
                 else{
                                $error = CActiveForm::validate(array($model,$modelT));
                                if($error!='[]')
                                    echo $error;
                                Yii::app()->end();
                }
		}
                if(!Yii::app()->request->isAjaxRequest){
                    $this->render('create',array(
                            'model'=>$model,
                            'modelT'=>$modelT,
                    ));

                }
                   
    
	}
        
        
//        
//
//	/**
//	 * Updates a particular model.
//	 * If update is successful, the browser will be redirected to the 'view' page.
//	 * @param integer $id the ID of the model to be updated
//	 */
//	public function actionUpdate($id)
//	{
//		$model=new Trabajo;
//               
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//
//		if(isset($_POST['Trabajo']))
//		{
//			$model->attributes=$_POST['Trabajo'];
//          
//
//			if($model->save()){
//                            $this->redirect(array('view','id'=>$model->ID_TRABAJO));
//                        }
//		}
//
//		$this->render('update',array(
//			'model'=>$model,
//		));
//	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            
            $dataProvider=new CActiveDataProvider('Trabajo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        

        
        

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Trabajo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Trabajo']))
			$model->attributes=$_GET['Trabajo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Trabajo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Trabajo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Trabajo $model the model to be validated
	 */
	protected function performAjaxValidation($models)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='trabajo-form')
		{
			echo CActiveForm::validate($models);
			Yii::app()->end();
		}
	}

}

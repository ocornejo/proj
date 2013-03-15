<?php

class TrabajoController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionSave() {



        if (isset($_POST['Trabajo'], $_POST['Turno'])) {
            $model = new Trabajo('inicio');
            $modelT = new Turno;
            $this->performAjaxValidation(array($model, $modelT));
            //$model=$this->loadModel(Yii::app()->getRequest()->getQuery('id')); 
            $model->attributes = $_POST['Trabajo'];
            $modelT->attributes = $_POST['Turno'];


            if ($model->ASEO_ID_ASEO === 8)
                $model->scenario = 'bano';
            else {
                switch ($model->ESTADO_ID_ESTADO) {
                    case 1:
                        $model->scenario = 'ok';
                        break;
                    case 2:
                        $model->scenario = 'pendiente';
                        break;
                    case 3:
                    case 4:
                    case 5:
                    case 6:
                    case 7:
                    case 8:
                        $model->scenario = 'laneco';
                        break;
                    case 9:
                        $model->scenario = 'nula';
                        break;
                }
            }


            if ($model->validate() && $modelT->validate()) {

                $var = Turno::model()->findAll(array('order' => 'ID_TURNO DESC', 'limit' => '1'));
                if (count($var) > 0)
                    $idTurno = (int) $var[0]['ID_TURNO'] + 1;
                else {
                    $idTurno = 1;
                }
                $modelT->ID_TURNO = $idTurno;
                $model->TURNO_ID_TURNO = $idTurno;


                if ($model->ASEO_ID_ASEO == 5 || $model->ASEO_ID_ASEO == 7) {
                    $modelT->save(false);
                    $model->save(false);
                    
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
                        'sql2' => $sql2), false, true);
                   
                } else {
                    $modelT->save(false);
                    $model->save(false);
                    
                }
            } else {
                $error = CActiveForm::validate(array($model, $modelT));
                if ($error != '[]')
                    echo $error;
                Yii::app()->end();
            }
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        
        if(isset($_POST['update'],$_POST['Trabajo'], $_POST['Turno'])){

            if(Trabajo::model()->exists(array('condition'=>'AVION_MATRICULA=:amat AND ASEO_ID_ASEO=:aseoid','params'=>array(':amat'=>$_POST['Trabajo']['AVION_MATRICULA'],':aseoid'=>$_POST['Trabajo']['ASEO_ID_ASEO']))))
                 $returnId=Trabajo::model()->findAll(array('condition'=>'AVION_MATRICULA=:amat AND ASEO_ID_ASEO=:aseoid','order'=> 'ID_TRABAJO DESC','limit'=>1,'params'=>array(':amat'=>$_POST['Trabajo']['AVION_MATRICULA'],':aseoid'=>$_POST['Trabajo']['ASEO_ID_ASEO'])));
//            $returnId=Trabajo::model()->findAll(array('condition'=>'AVION_MATRICULA=:amat AND ASEO_ID_ASEO=:aseoid','order' => 'ID_TRABAJO DESC','limit'=>1,'params'=>array(':amat'=>$_POST['Trabajo']['AVION_MATRICULA'],':aseoid'=>$_POST['Trabajo']['ASEO_ID_ASEO'])));
//            var_dump($returnId[0]->ID_TRABAJO); 
            $model=$this->loadModel($returnId[0]->ID_TRABAJO);
            $modelT= new Turno;
            // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation(array($model, $modelT));

                //$model=$this->loadModel(Yii::app()->getRequest()->getQuery('id')); 
                $model->attributes = $_POST['Trabajo'];
                $modelT->attributes = $_POST['Turno'];


                if ($model->ASEO_ID_ASEO === 8)
                    $model->scenario = 'bano';
                else {
                    switch ($model->ESTADO_ID_ESTADO) {
                        case 1:
                            $model->scenario = 'ok';
                            break;
                        case 2:
                            $model->scenario = 'pendiente';
                            break;
                        case 3:
                        case 4:
                        case 5:
                        case 6:
                        case 7:
                        case 8:
                            $model->scenario = 'laneco';
                            break;
                        case 9:
                            $model->scenario = 'nula';
                            break;
                    }
                }

                if ($model->validate() && $modelT->validate()) {

                    if (!is_dir(Yii::getPathOfAlias('webroot') . '/images/')) {
                        mkdir(Yii::getPathOfAlias('webroot') . '/images/');
                        chmod(Yii::getPathOfAlias('webroot') . '/images/', 0755);
                        // the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
                    }

                    $var = Turno::model()->findAll(array('order' => 'ID_TURNO DESC', 'limit' => '1'));
                    if (count($var) > 0)
                        $idTurno = (int) $var[0]['ID_TURNO'] + 1;
                    else {
                        $idTurno = 1;
                    }
                    $modelT->ID_TURNO = $idTurno;
                    $model->TURNO_ID_TURNO = $idTurno;

                    $images = CUploadedFile::getInstancesByName('imagen');

                    if (isset($images) && count($images) > 0) {

                        $images_path = realpath(Yii::app()->basePath . '/../images');

                        $i = 1;
                        foreach ($images as $image => $pic) {
                            $path = $images_path . '/' . $model->AVION_MATRICULA . "-" . $model->FECHA . "-" . $model->ASEO_ID_ASEO . "-Foto" . $i . ".JPG";
                            if ($pic->saveAs($path)) {
                                switch ($i) {
                                    case 1:
                                        $model->ARCHIVO1 = $path;
                                        break;
                                    case 2:
                                        $model->ARCHIVO2 = $path;
                                        break;
                                    case 3:
                                        $model->ARCHIVO3 = $path;
                                        break;
                                }
                            } else {

                            }
                            // handle the errors here, if you want
                            $i++;
                        }

                        $modelT->save(false);
                        $model->save(false);
                        $this->render('view', array(
                         'model' => $this->loadModel($model->ID_TRABAJO),
                        ));
                        exit;

                    } else {

                        $modelT->save(false);
                        $model->save(false);
                        $this->render('view', array(
                         'model' => $this->loadModel($model->ID_TRABAJO),
                    ));
                        exit;
                    }
                }
            
        }
        
        $model = new Trabajo('inicio');
        $modelT = new Turno;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation(array($model, $modelT));
        

        if (isset($_POST['Trabajo'], $_POST['Turno'])) {
//            $returnId=Trabajo::model()->findAll(array('condition'=>'AVION_MATRICULA=:amat AND ASEO_ID_ASEO=:aseoid','order' => 'ID_TRABAJO DESC','limit'=>1,'params'=>array(':amat'=>$_POST['Trabajo']['AVION_MATRICULA'],':aseoid'=>$_POST['Trabajo']['ASEO_ID_ASEO'])));
//            var_dump($returnId[0]->ID_TRABAJO);                       
            //$model=$this->loadModel(Yii::app()->getRequest()->getQuery('id')); 
            $model->attributes = $_POST['Trabajo'];
            $modelT->attributes = $_POST['Turno'];


            if ($model->ASEO_ID_ASEO === 8)
                $model->scenario = 'bano';
            else {
                switch ($model->ESTADO_ID_ESTADO) {
                    case 1:
                        $model->scenario = 'ok';
                        break;
                    case 2:
                        $model->scenario = 'pendiente';
                        break;
                    case 3:
                    case 4:
                    case 5:
                    case 6:
                    case 7:
                    case 8:
                        $model->scenario = 'laneco';
                        break;
                    case 9:
                        $model->scenario = 'nula';
                        break;
                }
            }

            if ($model->validate() && $modelT->validate() && isset($_POST['buttonSubmit'])) {
                
                if($model->ESTADO_ID_ESTADO!=2 && $model->ESTADO_ID_ESTADO!=9 && Trabajo::model()->exists("ASEO_ID_ASEO=".$model->ASEO_ID_ASEO." AND AVION_MATRICULA='".$model->AVION_MATRICULA."'")){
                                           
                    $result=Trabajo::model()->findAllByAttributes(array("ASEO_ID_ASEO"=>$model->ASEO_ID_ASEO,"AVION_MATRICULA"=>$model->AVION_MATRICULA),array('order'=>'FECHA DESC','limit'=>1));
                    $date= new DateTime($result[0]['FECHA']);
                    $dateNow =new DateTime();
                    $interval= $date->diff($dateNow)->d;
                    $model->ULTIMO_ASEO=$interval;
                    var_dump($date->format('Y-m-d H:i:s').":".$dateNow->format('Y-m-d H:i:s').":".$interval);
                }
                else{
                     $model->ULTIMO_ASEO=0;
                }

                if (!is_dir(Yii::getPathOfAlias('webroot') . '/images/')) {
                    mkdir(Yii::getPathOfAlias('webroot') . '/images/');
                    chmod(Yii::getPathOfAlias('webroot') . '/images/', 0755);
                    // the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
                }
                

                $var = Turno::model()->findAll(array('order' => 'ID_TURNO DESC', 'limit' => '1'));
                if (count($var) > 0)
                    $idTurno = (int) $var[0]['ID_TURNO'] + 1;
                else {
                    $idTurno = 1;
                }
                $modelT->ID_TURNO = $idTurno;
                $model->TURNO_ID_TURNO = $idTurno;

                $images = CUploadedFile::getInstancesByName('imagen');
                
                if (isset($images) && count($images) > 0) {

                    $images_path = realpath(Yii::app()->basePath . '/../images');

                    $i = 1;
                    foreach ($images as $image => $pic) {
                        $path = $images_path . '/' . $model->AVION_MATRICULA . "-" . $model->FECHA . "-" . $model->ASEO_ID_ASEO . "-Foto" . $i . ".JPG";
                        if ($pic->saveAs($path)) {
                            switch ($i) {
                                case 1:
                                    $model->ARCHIVO1 = $path;
                                    break;
                                case 2:
                                    $model->ARCHIVO2 = $path;
                                    break;
                                case 3:
                                    $model->ARCHIVO3 = $path;
                                    break;
                            }
                        } else {
                            
                        }
                        // handle the errors here, if you want
                        $i++;
                    }

                    $modelT->save(false);
                    $model->save(false);
                     $this->render('view', array(
                         'model' => $this->loadModel($model->ID_TRABAJO),
                    ));
                        exit;
                    
                } else {

                    $modelT->save(false);
                    $model->save(false);
                     $this->render('view', array(
                         'model' => $this->loadModel($model->ID_TRABAJO),
                    ));
                        exit;
                }
            }
        }


        if (!Yii::app()->request->isAjaxRequest) {
            $this->render('create', array(
                'model' => $model,
                'modelT' => $modelT,
            ));
        }
    }

    public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Trabajo']))
		{
			$model->attributes=$_POST['Trabajo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_TRABAJO));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        $dataProvider = new CActiveDataProvider('Trabajo');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Trabajo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Trabajo']))
            $model->attributes = $_GET['Trabajo'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Trabajo the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Trabajo::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Trabajo $model the model to be validated
     */
    protected function performAjaxValidation($models) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'trabajo-form') {
            echo CActiveForm::validate($models);
            Yii::app()->end();
        }
    }
    public function actionSearchOT()
        {   
                $regForm = $_POST["Trabajo"];
                $ot = $regForm["OT"];
                //echo $ot;
                if($ot!='')
                    $dataTemp= Trabajo::model()->findAll('OT=:ot',array(':ot'=>$ot));
                else
                    $dataTemp=NULL;
                if(count($dataTemp)>0){
                    echo CJSON::encode('SI');
                }
                else
                    echo CJSON::encode('NO');
        }

}

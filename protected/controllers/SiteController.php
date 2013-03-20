<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
        
//        public function behaviors(){
//               return array(
//                   'toExcel'=>array(
//                       'class'=>'ext.eexcelview.EExcelBehavior',
//                   ),
//               );
//           }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
                            $this->redirect(array("site/index"));
                        }
				//$this->redirect(Yii::app()->user->returnUrl);
                }
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionBajar()
	{

                $model=new Trabajo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Trabajo']))
			$model->attributes=$_GET['Trabajo'];

		$this->render('bajardatos',array(
			'model'=>$model,
		));
	}
       
       
         
         public function actionDownloadExcelKi(){

           $model=new Trabajo('search');

            $this->toExcel('Trabajo',
            array(
                'OT','AVION_MATRICULA'               
            ),
            'Aseos', // file name
            array(
                'creator' => 'Gerencia Mejora Continua', // file info
                ),
            'Excel5' // file type
            );
         }
        
        public function actionDownloadExcel(){
            
                $d = $_SESSION['Lectivo-excel'];

//            $data = array();
//
//            $data[]=array_keys($d->data[0]->attributes);//headers: cols name
//
//            foreach ($d->data as $item) {
//                $data[] = $item->attributes;
//            }
             $i = 0;
        
        //fix column header. 
        //Could have used something like this - $data[]=array_keys($issueDataProvider->data[0]->attributes);. 
        //But that would return all attributes which i do not want
        $data[$i]['OT'] = 'OT';
        $data[$i]['AVION_MATRICULA'] = 'Matricula';
        $data[$i]['USUARIO_BP'] = 'BP';
        $data[$i]['ESTADO_ID_ESTADO'] = 'Estado';
        $data[$i]['LUGAR_ID_LUGAR'] = 'Lugar';
        $data[$i]['ASEO_ID_ASEO'] = 'Aseo';
        $data[$i]['PLANIFICADO'] = 'Planificado';
        $data[$i]['HORA_INICIO'] = 'Hora inicio';
        $data[$i]['HORA_TERMINO'] = 'Hora termino';
        $data[$i]['FECHA'] = 'Fecha';
        $data[$i]['CALIFICACION'] = 'Calificacion';
        
        $i++;
        
        //populate data array with the required data elements
        foreach($d->data as $issue)
        {
            $data[$i]['OT'] = $issue['OT'];
//            $data[$i]['MATRICULA'] = $issue['MATRICULA'];
//            $data[$i]['BP'] =$issue['BP'];
////            $data[$i]['status'] = $issue->getStatusText();
////            $data[$i]['priority'] = $issue['priority'];
////            $data[$i]['assigned_to'] = $issue->assigned_to->username;
//            $data[$i]['ESTADO_ID_ESTADO'] = $issue['BP'];
//            $data[$i]['LUGAR_ID_LUGAR'] = $issue['BP'];
//            $data[$i]['ASEO_ID_ASEO'] = $issue['BP'];
//            $data[$i]['PLANIFICADO'] = $issue['BP'];
//            $data[$i]['HORA_INICIO'] = $issue['BP'];
//            $data[$i]['HORA_TERMINO'] = $issue['BP'];
//            $data[$i]['FECHA'] =$issue['BP'];
//            $data[$i]['CALIFICACION'] = $issue['BP'];
            $i++;
        }

            Yii::import('application.extensions.phpexcel.JPhpExcel');
            $xls = new JPhpExcel('UTF-8', false, 'test');
            $xls->addArray($data);
            $xls->generateXML('exportedData'); //export into a .xls file
        }
            
        public function actionIndex(){
            
            $model=new Trabajo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Trabajo']))
			$model->attributes=$_GET['Trabajo'];

		$this->render('index',array(
			'model'=>$model,
            ));
        }
}
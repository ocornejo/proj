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
        
        public function actionCriticos(){
            
           
                $model=new Avion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Avion']))
			$model->attributes=$_GET['Avion'];

		$this->render('criticos',array(
			'model'=>$model,
            ));
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
                $this->layout=false;
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
                if(isset($_GET['avion']))
                    $model->AVION_MATRICULA=$_GET['avion'];
                if(isset($_GET['aseo']))
                    $model->ASEO_ID_ASEO=$_GET['aseo'];
		if(isset($_GET['Trabajo']))
                    $model->attributes=$_GET['Trabajo'];


		$this->render('bajardatos',array(
			'model'=>$model,
		));
	}
        
        public function actionReporte()
	{
                $files = glob(getcwd().'\\temp\\*'); // get all file names
                    foreach($files as $file){ // iterate files
                      if(is_file($file))
                        unlink($file); // delete file
                }

                $model=new Trabajo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Trabajo'])){
                    
			$model->attributes=$_GET['Trabajo'];
                        
                }

		$this->render('reporte',array(
			'model'=>$model,
		));
	}
       public function actionDownloadExcel(){
            
          $d = $_SESSION['Lectivo-excel'];
           $i = 0;
        
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
        $data[$i]['ULTIMO_ASEO'] = 'Días sin aseo';
        $data[$i]['CALIFICACION'] = 'Calificacion';
        
        $i++;
        
        //populate data array with the required data elements
        foreach($d->data as $issue)
        {
            $data[$i]['OT'] = $issue['OT'];
            $data[$i]['AVION_MATRICULA'] = $issue['AVION_MATRICULA'];
            $data[$i]['USUARIO_BP'] =$issue->uSUARIOBP->NOMBRE;
            $data[$i]['ESTADO_ID_ESTADO'] = $issue->eSTADOIDESTADO->NOMBRE_ESTADO;
            if($issue['LUGAR_ID_LUGAR']!=NULL) 
                $data[$i]['LUGAR_ID_LUGAR']=$issue->lUGARIDLUGAR->LUGAR; 
            else 
                $data[$i]['LUGAR_ID_LUGAR']="";
            if($issue['ASEO_ID_ASEO']!=NULL) 
                $data[$i]['ASEO_ID_ASEO']=$issue->aSEOIDASEO->TIPO_ASEO;
            else 
                $data[$i]['ASEO_ID_ASEO']="";
             if($issue['PLANIFICADO']!=NULL) 
                $data[$i]['PLANIFICADO']="Si";
            else 
                $data[$i]['PLANIFICADO']="No";
            $data[$i]['HORA_INICIO'] = $issue['HORA_INICIO'];
            $data[$i]['HORA_TERMINO'] = $issue['HORA_TERMINO'];
            $data[$i]['FECHA'] =$issue['FECHA'];
            $data[$i]['ULTIMO_ASEO']=$issue['ULTIMO_ASEO'];
            $data[$i]['CALIFICACION'] = $issue['CALIFICACION'];
            $i++;
        }

            Yii::import('application.extensions.phpexcel.JPhpExcel');
            $xls = new JPhpExcel('UTF-8', false, 'test');
            $xls->addArray($data);
            $fecha = new DateTime();
            $xls->generateXML('Resumen_Aseo-Cabina_'.$fecha->format('d-m-Y_H:i')); //export into a .xls file
        }
 
        public function actionSendExcel(){
            
          $d = $_SESSION['Lectivo-excel'];
           $i = 0;
        
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
        $data[$i]['ULTIMO_ASEO'] = 'Días sin aseo';
        $data[$i]['CALIFICACION'] = 'Calificacion';
        
        $i++;
        
        //populate data array with the required data elements
        foreach($d->data as $issue)
        {
            $data[$i]['OT'] = $issue['OT'];
            $data[$i]['AVION_MATRICULA'] = $issue['AVION_MATRICULA'];
            $data[$i]['USUARIO_BP'] =$issue->uSUARIOBP->NOMBRE;
            $data[$i]['ESTADO_ID_ESTADO'] = $issue->eSTADOIDESTADO->NOMBRE_ESTADO;
            if($issue['LUGAR_ID_LUGAR']!=NULL) 
                $data[$i]['LUGAR_ID_LUGAR']=$issue->lUGARIDLUGAR->LUGAR; 
            else 
                $data[$i]['LUGAR_ID_LUGAR']="";
            if($issue['ASEO_ID_ASEO']!=NULL) 
                $data[$i]['ASEO_ID_ASEO']=$issue->aSEOIDASEO->TIPO_ASEO;
            else 
                $data[$i]['ASEO_ID_ASEO']="";
             if($issue['PLANIFICADO']!=NULL) 
                $data[$i]['PLANIFICADO']="Si";
            else 
                $data[$i]['PLANIFICADO']="No";
            $data[$i]['HORA_INICIO'] = $issue['HORA_INICIO'];
            $data[$i]['HORA_TERMINO'] = $issue['HORA_TERMINO'];
            $data[$i]['FECHA'] =$issue['FECHA'];
            $data[$i]['ULTIMO_ASEO']=$issue['ULTIMO_ASEO'];
            $data[$i]['CALIFICACION'] = $issue['CALIFICACION'];
            $i++;
        }

            Yii::import('application.extensions.phpexcel.JPhpExcel');
            $xls = new JPhpExcel('UTF-8', false, 'test');
            $xls->addArray($data);
            $fecha = new DateTime();
           
            $out = '';
            ob_start();
            $xls->generateXML('Resumen_Aseo-Cabina_'.$fecha->format('d-m-Y')); //export into a .xls file
            $out .= ob_get_contents();
            ob_end_flush();

             Yii::import('ext.yii-mail.YiiMailMessage');
            $message = new YiiMailMessage;
            $message->setBody('Se adjunto informe de turno', 'text/html');
            $message->subject = 'Informe de Turno Aseos: '.$fecha->format('d-m-Y');
            $message->addTo('niccolo.paganini15@gmail.com');
            $message->from = Yii::app()->params['adminEmail'];
            $filename='Resumen_Aseo-Cabina_'.$fecha->format('d-m-Y');
                        // check that something was actually written to the buffer
            if (strlen($out) > 0) {
             $file = 'temp/Resumen_Aseo-Cabina_'.$fecha->format('d-m-Y'). '.xls';
             touch($file); 
             $fh = fopen($file, 'w');
             fwrite($fh, $out);
             fclose($fh);
            }
            $message->attach(Swift_Attachment::fromPath($file), $filename, "xls");
            Yii::app()->mail->send($message);           
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
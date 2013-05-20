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

/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
    
    	$isAdmin = "isset(Yii::app()->user->role) && (Yii::app()->user->role==='admin')";
		$isUser = "isset(Yii::app()->user->role) && ((Yii::app()->user->role==='user') ||
					 (Yii::app()->user->role==='admin'))";
		$isAnaliz = "isset(Yii::app()->user->role) && ((Yii::app()->user->role==='analiz') ||
														 (Yii::app()->user->role==='user') || 
														 (Yii::app()->user->role==='admin'))";
		 
		   
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'bajar','bajarevaluaciones',
                					'criticos','error','reporte','DownloadExcel',
                					'DownloadExcelEval','SendExcel','Logout','page','resumen'),
                'users' => array('@'),
                'expression'=>$isAnaliz
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('login'),
                'users' => array('*'),
            ),
/*
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('@'),
                'expression'=>$isAdmin,
            ),
*/
            array('deny', // deny all users
                'users' => array('@'),
            ),
        );
    }

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
	public function actionBajarEvaluaciones(){
		$model = new Trabajo('searchItem');
		$model->unsetAttributes();
		if(isset($_GET['Trabajo']))
			$model->attributes=$_GET['Trabajo'];
		$this->render('bajarevaluaciones',array(
			'model'=>$model
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
	
	public function actionResumen(){
		$model=new Avion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Avion'])){
        	$model->attributes=$_GET['Avion'];
        }

		$this->render('resumen',array(
			'model'=>$model,
		));
	}
	
	public function actionDownloadExcel(){
            
          $d = $_SESSION['Lectivo-excel'];
           $i = 0;
        
        $data[$i]['FECHA'] = 'Fecha';
        $data[$i]['TURNO_ID_TURNO']='Turno';
        $data[$i]['AVION_MATRICULA'] = 'Matricula';
        $data[$i]['flota_grilla'] = 'Flota';
        $data[$i]['LUGAR_ID_LUGAR'] = 'Lugar';
        $data[$i]['ASEO_ID_ASEO'] = 'Aseo';
        $data[$i]['PLANIFICADO'] = 'Planificado';
        $data[$i]['ESTADO_ID_ESTADO'] = 'Estado';
        $data[$i]['HORA_INICIO'] = 'Hora inicio';
        $data[$i]['HORA_TERMINO'] = 'Hora termino';
        $data[$i]['CALIFICACION'] = 'Calificacion';
        $data[$i]['OT'] = 'OT';
        $data[$i]['COMENTARIO'] = 'Comentario';
        $data[$i]['USUARIO_BP'] = 'Usuario';
        //$data[$i]['ARCHIVO1']='Foto';
        //$data[$i]['ULTIMO_ASEO'] = 'Días sin aseo';
        
        
        
        $i++;
        
        //populate data array with the required data elements
        foreach($d->data as $issue)
        {
            if($issue->FECHA!=NULL){
		        $temp_var= explode('-',$issue->FECHA);
	            $data[$i]['FECHA'] = $temp_var[2].'-'.$temp_var[1].'-'.$temp_var[0];    
            }
            else
            	$data[$i]['FECHA']="";
            $temp_var=null;
            $temp_var= explode('-',$issue->tURNOIDTURNO->FECHA);
            $data[$i]['TURNO_ID_TURNO']= $temp_var[2].'-'.$temp_var[1].'-'.$temp_var[0].' '.$issue->tURNOIDTURNO->tIPOTURNOIDTIPOTURNO->TIPO;
            
            $data[$i]['AVION_MATRICULA'] = $issue['AVION_MATRICULA'];
            $data[$i]['flota_grilla'] = $issue['flota_grilla'];
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
            
            $data[$i]['ESTADO_ID_ESTADO'] = $issue->eSTADOIDESTADO->NOMBRE_ESTADO;

            $data[$i]['HORA_INICIO'] = $issue['HORA_INICIO'];
            $data[$i]['HORA_TERMINO'] = $issue['HORA_TERMINO'];
            
            //$data[$i]['ULTIMO_ASEO']=$issue['ULTIMO_ASEO'];
            $data[$i]['CALIFICACION'] = $issue['CALIFICACION'];
            $data[$i]['OT'] = $issue['OT'];
            $data[$i]['COMENTARIO'] = $issue['COMENTARIO'];
            $data[$i]['USUARIO_BP'] =$issue->uSUARIOBP->NOMBRE;
/*
            if($issue['ARCHIVO1']!=null){
	            $data[$i]['ARCHIVO1']= 'http://localhost:8080/proj/index.php?r=trabajo/view&id='.$issue['ID_TRABAJO'];
            }
            else
            	$data[$i]['ARCHIVO1'] = "";
*/

            $i++;
        }

            Yii::import('application.extensions.phpexcel.JPhpExcel');
            $xls = new JPhpExcel('UTF-8', false, 'test');
            $xls->addArray($data);
            $fecha = new DateTime();
            $xls->generateXML('Resumen_Aseo-Cabina_'.$fecha->format('d-m-Y')); //export into a .xls file
        }
        
        
        
        
        public function actionDownloadExcelEval(){
            
         $d = $_SESSION['Lectivo-excel'];
         $i = 0;
         $dbCommand = Yii::app()->db->createCommand('select ID_ITEM,NOMBRE,EVALUACION_ID_EVALUACION from item');
         $items_sql = $dbCommand->queryAll();
         
        $data[$i]['FECHA'] = '';
        $data[$i]['flota'] = '';
        $data[$i]['AVION_MATRICULA'] = '';
        $data[$i]['aSEOIDASEO.TIPO_ASEO'] = '';
        $data[$i]['CALIFICACION'] = '';
        foreach($items_sql as $item){
	         $data[$i]['item_'.$item['ID_ITEM']] = Evaluacion::model()->findByPk($item['EVALUACION_ID_EVALUACION'])->NOMBRE;
        }        
        $i++;
          
        $data[$i]['FECHA'] = 'Fecha';
        $data[$i]['flota'] = 'Flota';
        $data[$i]['AVION_MATRICULA'] = 'Matrícula';
        $data[$i]['aSEOIDASEO.TIPO_ASEO'] = 'Aseo';
        $data[$i]['CALIFICACION'] = 'Calificación';
        foreach($items_sql as $item){
	         $data[$i]['item_'.$item['ID_ITEM']] = $item['NOMBRE'];
        }        
        $i++;
        
        //populate data array with the required data elements

        foreach($d->data as $issue)
        {   
            if($issue['FECHA']!=NULL){
                $temp_var= explode('-',$issue['FECHA']);
                $data[$i]['FECHA'] = $temp_var[2].'-'.$temp_var[1].'-'.$temp_var[0];
            }
            else
                $data[$i]['FECHA'] = "";
            
            $data[$i]['flota'] = $issue['flota'];
            $data[$i]['AVION_MATRICULA'] = $issue['AVION_MATRICULA'];
            $data[$i]['aSEOIDASEO.TIPO_ASEO'] = $issue->aSEOIDASEO->TIPO_ASEO;
            $data[$i]['CALIFICACION'] = $issue['CALIFICACION'];
            
            
            foreach($items_sql as $item){
	         $data[$i]['item_'.$item['ID_ITEM']] = $issue['item_'.$item['ID_ITEM']];
	         }
            $i++;
        }

            Yii::import('application.extensions.phpexcel.JPhpExcel');
            $xls = new JPhpExcel('UTF-8', false, 'test');
            $xls->addArray($data);
            $fecha = new DateTime();
            $xls->generateXML('Resumen_Evaluaciones_'.$fecha->format('d-m-Y')); //export into a .xls file
        }

        
             
 
        public function actionSendExcel(){
            
          $d = $_SESSION['Lectivo-excel'];
           $i = 0;
        
        $data[$i]['FECHA'] = 'Fecha';
        $data[$i]['TURNO_ID_TURNO']='Turno';
        $data[$i]['AVION_MATRICULA'] = 'Matricula';
        $data[$i]['flota_grilla'] = 'Flota';
        $data[$i]['LUGAR_ID_LUGAR'] = 'Lugar';
        $data[$i]['ASEO_ID_ASEO'] = 'Aseo';
        $data[$i]['PLANIFICADO'] = 'Planificado';
        $data[$i]['ESTADO_ID_ESTADO'] = 'Estado';
        $data[$i]['HORA_INICIO'] = 'Hora inicio';
        $data[$i]['HORA_TERMINO'] = 'Hora termino';
        $data[$i]['CALIFICACION'] = 'Calificacion';
        $data[$i]['OT'] = 'OT';
        $data[$i]['COMENTARIO'] = 'Comentario';
        $data[$i]['USUARIO_BP'] = 'Usuario';
        //$data[$i]['ARCHIVO1']='Foto';
        //$data[$i]['ULTIMO_ASEO'] = 'Días sin aseo';
        
        
        
        $i++;
        $planificados=0;
        $realizados=0;
        $realizadosNR=0;
        $desLan=0;
        $desLanNR=0;
        $desEco =0 ;
        $desEcoNR=0;
        //populate data array with the required data elements
        foreach($d->data as $issue)
        {
            if($issue->FECHA!=NULL){
		        $temp_var= explode('-',$issue->FECHA);
	            $data[$i]['FECHA'] = $temp_var[2].'-'.$temp_var[1].'-'.$temp_var[0];    
            }
            else
            	$data[$i]['FECHA']="";
            $temp_var=null;
            $temp_var= explode('-',$issue->tURNOIDTURNO->FECHA);
            $data[$i]['TURNO_ID_TURNO']= $temp_var[2].'-'.$temp_var[1].'-'.$temp_var[0].' '.$issue->tURNOIDTURNO->tIPOTURNOIDTIPOTURNO->TIPO;
            
            $data[$i]['AVION_MATRICULA'] = $issue['AVION_MATRICULA'];
            $data[$i]['flota_grilla'] = $issue['flota_grilla'];
                        if($issue['LUGAR_ID_LUGAR']!=NULL) 
                $data[$i]['LUGAR_ID_LUGAR']=$issue->lUGARIDLUGAR->LUGAR; 
            else 
                $data[$i]['LUGAR_ID_LUGAR']="";
            if($issue['ASEO_ID_ASEO']!=NULL) 
                $data[$i]['ASEO_ID_ASEO']=$issue->aSEOIDASEO->TIPO_ASEO;
            else 
                $data[$i]['ASEO_ID_ASEO']="";
            if($issue['PLANIFICADO']!=NULL){ 
                if($issue['PLANIFICADO'])
                	$data[$i]['PLANIFICADO']="Si";
                else
                	$data[$i]['PLANIFICADO']="No";
                $planificados = $planificados + (int) $issue['PLANIFICADO'];
            }
            else 
                $data[$i]['PLANIFICADO']="";
            
            if($issue['ESTADO_ID_ESTADO']!=NULL){
            	$data[$i]['ESTADO_ID_ESTADO'] = $issue->eSTADOIDESTADO->NOMBRE_ESTADO;
            	if(!strcmp($issue->eSTADOIDESTADO->NOMBRE_ESTADO,"Ok")){
            		$realizados=$realizados + 1;
            		if($issue['PLANIFICADO']==0)
            			$realizadosNR = $realizadosNR +1;
            	}
            	if(substr($issue->eSTADOIDESTADO->NOMBRE_ESTADO, 0, 3 ) === "LAN" && strcmp($issue->aSEOIDASEO->TIPO_ASEO,"Terminal")!=0){
            		$desLan=$desLan + 1;
            		if($issue['PLANIFICADO']==0)
            			$desLanNR = $desLanNR +1;
            	}
            	if(substr($issue->eSTADOIDESTADO->NOMBRE_ESTADO, 0, 8 ) === "Ecoblanc" && strcmp($issue->aSEOIDASEO->TIPO_ASEO,"Terminal")!=0){
            		$desEco=$desEco + 1;
            		if($issue['PLANIFICADO']==0)
            			$desEcoNR = $desEcoNR +1;
            	}
            }
            else
            	$data[$i]['ESTADO_ID_ESTADO'] = "";

            $data[$i]['HORA_INICIO'] = $issue['HORA_INICIO'];
            $data[$i]['HORA_TERMINO'] = $issue['HORA_TERMINO'];
            
            //$data[$i]['ULTIMO_ASEO']=$issue['ULTIMO_ASEO'];
            $data[$i]['CALIFICACION'] = $issue['CALIFICACION'];
            $data[$i]['OT'] = $issue['OT'];
            $data[$i]['COMENTARIO'] = $issue['COMENTARIO'];
            $data[$i]['USUARIO_BP'] =$issue->uSUARIOBP->NOMBRE;

/*
            if($issue['ARCHIVO1']!=null){
	            $data[$i]['ARCHIVO1']= 'http://localhost:8080/proj/index.php?r=trabajo/view&id='.$issue['ID_TRABAJO'];
            }
            else
            	$data[$i]['ARCHIVO1'] = "";
*/

            $i++;
        }

            Yii::import('application.extensions.phpexcel.JPhpExcel');
            $xls = new JPhpExcel('UTF-8', false, 'test');
            $xls->addArray($data);
            $fecha = new DateTime();
           
            $out = '';
            ob_start();
            $xls->generateXML('Resumen_Aseo-Cabina_'.
            			$fecha->format('d-m-Y')); 
            $out .= ob_get_contents();
            ob_end_flush();

           
            Yii::import('ext.yii-mail.YiiMailMessage');
            $message = new YiiMailMessage;

            $message->setBody('Resumen Informe de Turno: <br/><br/>
            				   Aseos Planificados: '.$planificados.'<br/>
            				   Aseos Realizados: '.$realizados.' (NR: '.$realizadosNR.') <br/>
            				   Desasignados LAN: '.$desLan.' (NR: '.$desLanNR.') <br/>
            				   Desasignados Ecoblanc: '.$desEco.' (NR: '.$desEcoNR.') <br/><br/>
            				   No se consideran aseos Terminales desasignados', 'text/html');

			//$message->setBody('Resumen Informe de Turno:', 'text/html');			
            $message->subject = 'Informe de Turno Aseos: '.$fecha->format('d-m-Y').': '.Usuario::model()->FindByPk(Yii::app()->user->getId())->NOMBRE;



            $addTo=array();
	        $mails = simplexml_load_file('mail_contacts.xml');
		    foreach($mails as $mail){
			        $addTo[] =(string)$mail->email;
		     }
		    $to=implode(", ",$addTo);


            $message->addTo('reportes.mejora.continua@gmail.com');
        
            foreach($addTo as $value){
            	$message->addCC(trim($value));  
            }

            
            $message->from = Yii::app()->params['adminEmail'];

            $filename='Resumen_Aseos_Cabina_'.$fecha->format('d-m-Y');
                        // check that something was actually written to the buffer
            if (strlen($out) > 0) {
             $file = 'temp/Resumen_Aseos_Cabina_'.$fecha->format('d-m-Y'). '.xls';
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
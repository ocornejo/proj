<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico" type="image/x-icon" />
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/buttons.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icons.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tables.css" />
    
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu_iestyles.css" />
	

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	 <?php if(Yii::app()->user->getId() ==NULL):?>
        <div id="topnav">
           
            <div class="topnav_text"><a href='<?php echo Yii::app()->controller->createUrl('site/index'); ?>'>Inicio</a> | <a href='<?php echo Yii::app()->controller->createUrl('site/logout'); ?>'>Cerrar sesión</a> </div>
	</div>
        <?php endif;?>
        <?php if(Yii::app()->user->getId() !=NULL):?>
        <div id="topnav">
           
            <div class="topnav_text"><a href='<?php echo Yii::app()->controller->createUrl('site/index'); ?>'>Inicio</a> | <a href="<?php echo Yii::app()->controller->createUrl('usuario/view',array('id'=>Yii::app()->user->getId()));?>">Mi cuenta: <?php echo Usuario::model()->FindByPk(Yii::app()->user->getId())->NOMBRE; ?></a> | <a href='<?php echo Yii::app()->controller->createUrl('site/logout'); ?>'>Cerrar sesión</a> </div>
	</div>
        <?php endif;?>
        
	<div id="header">
		<div id="logo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png"></img><?php //echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
    <!--
<?php /*$this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>array(
                array('label'=>'Dashboard', 'url'=>array('/site/index'),'itemOptions'=>array('class'=>'test')),
                array('label'=>'Theme Pages',
                  'items'=>array(
                    array('label'=>'Graphs & Charts', 'url'=>array('/site/page', 'view'=>'graphs'),'itemOptions'=>array('class'=>'icon_chart')),
					array('label'=>'Form Elements', 'url'=>array('/site/page', 'view'=>'forms')),
					array('label'=>'Interface Elements', 'url'=>array('/site/page', 'view'=>'interface')),
					array('label'=>'Error Pages', 'url'=>array('/site/page', 'view'=>'Demo 404 page')),
					array('label'=>'Calendar', 'url'=>array('/site/page', 'view'=>'calendar')),
					array('label'=>'Buttons & Icons', 'url'=>array('/site/page', 'view'=>'buttons_and_icons')),
                  ),
                ),
                array('label'=>'Gii Generated Module',
                  'items'=>array(
                    array('label'=>'Items', 'url'=>array('/theme/index')),
                    array('label'=>'Create Item', 'url'=>array('/theme/create')),   
					array('label'=>'Manage Items', 'url'=>array('/theme/admin')),
                  ),
                ),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
            ),
    )); */?> --->
	<div id="mainmenu">
    
		<?php  //CHtml::image(Yii::app()->theme->baseUrl."/images/big_icons/icon-house.png","","",array("width"=>10,"heigth"=>10)).
                    $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>CHtml::image(Yii::app()->theme->baseUrl."/images/big_icons/icon-house.png","",array("width"=>20,"heigth"=>20,'style' => 'vertical-align:10px;')). CHtml::label("  Inicio", "",array('style' => 'vertical-align:15px;')), 'url'=>array('/site/index')),
				array('label'=>CHtml::image(Yii::app()->theme->baseUrl."/images/big_icons/icon-write.png","",array("width"=>20,"heigth"=>20,'style' => 'vertical-align:10px;')). CHtml::label("  Ingreso datos", "",array('style' => 'vertical-align:15px;')), 'url'=>array('/trabajo/create')),
                                //array('label'=>'Ingreso datos', 'url'=>array('/site/page', 'view'=>'ingresodatos')),
                                array('label'=>CHtml::image(Yii::app()->theme->baseUrl."/images/big_icons/icon-down.png","",array("width"=>20,"heigth"=>20,'style' => 'vertical-align:10px;')). CHtml::label("  Aseos", "",array('style' => 'vertical-align:15px;')), 'url'=>array('/site/bajar')),
                                array('label'=>CHtml::image(Yii::app()->theme->baseUrl."/images/big_icons/icon-cabinet.png","",array("width"=>20,"heigth"=>20,'style' => 'vertical-align:10px;')). CHtml::label("  Evaluaciones", "",array('style' => 'vertical-align:15px;')), 'url'=>array('/site/bajarevaluaciones')),
                                
                                array('label'=>CHtml::image(Yii::app()->theme->baseUrl."/images/big_icons/icon-warning.png","",array("width"=>20,"heigth"=>20,'style' => 'vertical-align:10px;')). CHtml::label("  Críticos", "",array('style' => 'vertical-align:15px;')), 'url'=>array('/site/criticos')),
                                array('label'=>CHtml::image(Yii::app()->theme->baseUrl."/images/big_icons/icon-chart2.png","",array("width"=>20,"heigth"=>20,'style' => 'vertical-align:10px;')). CHtml::label("  Enviar reportes", "",array('style' => 'vertical-align:15px;')), 'url'=>array('/site/reporte'),'itemOptions'=>array('class'=>'icon_chart')),
				array('label'=>CHtml::image(Yii::app()->theme->baseUrl."/images/big_icons/icon-gears.png","",array("width"=>20,"heigth"=>20,'style' => 'vertical-align:10px;')). CHtml::label("  Opciones", "",array('style' => 'vertical-align:15px;')), 'url'=>array('/site/page', 'view'=>'opciones'))
				),
                    'encodeLabel'=>false,
		)); ?>
	</div> <!--mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'homeLink'=>CHtml::link('Inicio', array('/site/index')),
                'links'=>$this->breadcrumbs,
            )); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div id="footer">
		Sistema de Aseo-Cabina <?php echo date('Y'); ?><br/>
		<?php echo "Gerencia Mejora Continua, Ingeniería y Mantenimiento" ?><br/>
                <a href="mailto:correo.contacto@lan.com?Subject=Sistema%20Aseo-Cabina">correo.contacto@lan.com</a>
                
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
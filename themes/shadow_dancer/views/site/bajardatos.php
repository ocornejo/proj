<?php

$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/jquery.css');
$this->pageTitle=Yii::app()->name . ' - Bajar datos';
$this->breadcrumbs=array(
	'Bajar datos',
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#trabajo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");?>

<h1>Bajar datos</h1>


<?php echo CHtml::submitButton('Filtros', array('class'=>'search-button','style'=>'background: url(/proj/themes/shadow_dancer/images/small_icons/search-icon.png) no-repeat 6px 1px; padding-left: 24px; vertical-align: bottom;')); ?>

<div class="search-form" style="display: none;">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<style>
    .CGridViewContainer {overflow: auto;
overflow-y: hidden; }
</style>

<div class="CGridViewContainer">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trabajo-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'OT',
                array(
                    'name'=>'AVION_MATRICULA',
                     'value'=> '$data->AVION->MATRICULA',
                    
                    'filter'=> Avion::model()->options,
                ),
		'flota_grilla',
                array(
                        'name'=>'USUARIO_BP',
                        'value'=> '$data->uSUARIOBP->NOMBRE',
                        'filter'=>  Usuario::model()->options
                ),
                 array(
                        'name'=>'ESTADO_ID_ESTADO',
                        'value'=> '$data->eSTADOIDESTADO->NOMBRE_ESTADO',
                        'filter'=>  Estado::model()->options),
   
                array(
                    'name'=>'LUGAR_ID_LUGAR',
                    
                        'value'=> function($data){
                            if($data->LUGAR_ID_LUGAR==NULL)
                                return "";
                            else
                                return $data->lUGARIDLUGAR->LUGAR;
                         },
                   
                    'filter'=>  Lugar::model()->options,
                ),
                 array(
                    'name'=>'ASEO_ID_ASEO',
                     'value'=> function($data){
                            if($data->ASEO_ID_ASEO==NULL)
                                return "";
                            else
                                return $data->aSEOIDASEO->TIPO_ASEO;
                         },
                    
                    'filter'=> Aseo::model()->options,
                ),
                array(
                    'name'=>'PLANIFICADO',
                    'filter'=>array(1=>"Si",0=>"No"),
                    'value'=>function($data){
                             if($data->PLANIFICADO==NULL)
                                 return "";
                             else
                                 return @$data->PLANIFICADO ? "Si" : "No";
                    }),

                array(
                    'name'=>'HORA_INICIO',
                    
                    'value'=>function($data){
                             if($data->HORA_INICIO==NULL)
                                 return "";
                             else{

	                             $temp_var= explode(':',$data->HORA_INICIO);
	                             return $temp_var[0].':'.$temp_var[1];
                             }
                                 
                    }),
               array(
                    'name'=>'HORA_TERMINO',
                    
                    'value'=>function($data){
                             if($data->HORA_TERMINO==NULL)
                                 return "";
                             else{

	                             $temp_var= explode(':',$data->HORA_TERMINO);
	                             return $temp_var[0].':'.$temp_var[1];
                             }
                                 
                    }),    
            array(
                    'name'=>'FECHA',
                    
                    'value'=>function($data){
                             if($data->FECHA==NULL)
                                 return "";
                             else{

	                             $temp_var= explode('-',$data->FECHA);
	                             return $temp_var[2].'-'.$temp_var[1].'-'.$temp_var[0];
                             }
                                 
                    }),
                'ULTIMO_ASEO',
		'CALIFICACION',
                     array(
                    'name'=>'TURNO_ID_TURNO',
                    //'filter'=>  Turno::model()->options,
                    'value'=>function($data){
                             if($data->TURNO_ID_TURNO==NULL)
                                 return "";
                             else
                                 return @$data->tURNOIDTURNO->FECHA.' '.$data->tURNOIDTURNO->tIPOTURNOIDTIPOTURNO->TIPO;
                    },
                    ),
                    array(
                    'name'=>'ARCHIVO1',
                    //'filter'=>  Turno::model()->options,
                    'value'=>function($data){
                             if($data->ARCHIVO1==NULL)
                                 return "";
                             else
                                 return CHtml::link("Ver",array("trabajo/view",'id'=>$data->ID_TRABAJO),array("style"=>"font-weight:bold;"));
                    },
                    'type'=>'raw',
                    ),
		
	),
));
                    ?>
  </div>
    <?php
   
        $baseUrl = Yii::app()->theme->baseUrl; 
        $normalImageSrc = "{$baseUrl}/images/excel.png";
        $image = CHtml::image($normalImageSrc,"",array('style' => 'vertical-align:10px;')).'Descargar datos filtrados';
        //"",array("width"=>20,"heigth"=>20,'style' => 'vertical-align:10px;')

        echo CHtml::link($image, array('site/DownloadExcel'));            
        
                    
?>



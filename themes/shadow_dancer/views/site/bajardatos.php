<?php

$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/jquery.css');
$this->pageTitle=Yii::app()->name . ' - Bajar datos';
$this->breadcrumbs=array(
	'Bajar datos',
);
?>

<h1>Bajar datos</h1>

<div class="form">
    
<?php 


$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trabajo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'OT',
		'AVION_MATRICULA',
		'USUARIO_BP',
                 array(
                        'name'=>'ESTADO_ID_ESTADO',
                        'value'=> function($data){
                            if($data->ESTADO_ID_ESTADO==NULL)
                                return "";
                            else
                                return Estado::model()->findByPk($data->ESTADO_ID_ESTADO)->NOMBRE_ESTADO;
                         },
                 'filter'=>  Estado::model()->options),
   
                array(
                    'name'=>'LUGAR_ID_LUGAR',
                    
                        'value'=> function($data){
                            if($data->LUGAR_ID_LUGAR==NULL)
                                return "";
                            else
                                return Lugar::model()->findByPk($data->LUGAR_ID_LUGAR)->LUGAR;
                         },
                   
                    'filter'=>  Lugar::model()->options,
                ),
                 array(
                    'name'=>'ASEO_ID_ASEO',
                     'value'=> function($data){
                            if($data->ASEO_ID_ASEO==NULL)
                                return "";
                            else
                                return Aseo::model()->findByPk($data->ASEO_ID_ASEO)->TIPO_ASEO;
                         },
                    
                    'filter'=> Aseo::model()->options,
                ),
                array(
                    'name'=>'PLANIFICADO',
                    'value'=>function($data){
                             if($data->PLANIFICADO==1)
                                 return "Si";
                             else {
                                 return "No";
                             }
                    },
                ),
		'HORA_INICIO',
		'HORA_TERMINO',
		'FECHA',
		'CALIFICACION',
		'TURNO_ID_TURNO',
		
	),
));
        $baseUrl = Yii::app()->theme->baseUrl; 
        $normalImageSrc = "{$baseUrl}/images/excel.png";
        $image = CHtml::image($normalImageSrc,"",array('style' => 'vertical-align:10px;')).'Descargar';
        //"",array("width"=>20,"heigth"=>20,'style' => 'vertical-align:10px;')

        echo CHtml::link($image, array('site/DownloadExcel'));            
        
                    
?>
    
</div>

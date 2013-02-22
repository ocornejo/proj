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
echo Estado::model()->findByPk(2)->NOMBRE_ESTADO;

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trabajo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'OT',
		'AVION_MATRICULA',
		'USUARIO_BP',
                'ESTADO_ID_ESTADO',
                    array(
                        'name'=>'ESTADO_ID_ESTADO',
                        'value'=>function($data){
                            $value= Estado::model()->findByPk($data->ESTADO_ID_ESTADO)->NOMBRE_ESTADO;
                            return $data->ESTADO_ID_ESTADO;
                        },
                        'filter'=>  Estado::model()->options,
                    ),
//                array(
//                    'name'=>'LUGAR_ID_LUGAR',
//                    'value'=>'Lugar::model()->findByPk($data->LUGAR_ID_LUGAR)->LUGAR',
//                    'filter'=>  Lugar::model()->options,
//                ),
//                 array(
//                    'name'=>'ASEO_ID_ASEO',
//                    'value'=>'Aseo::model()->findByPk($data->ASEO_ID_ASEO)->TIPO_ASEO',
//                    'filter'=> Aseo::model()->options,
//                ),
		'PLANIFICADO',
		'HORA_INICIO',
		'HORA_TERMINO',
		'COMENTARIO',
		'FECHA',
		'CALIFICACION',
                
		'TURNO_ID_TURNO',
		
	),
)); ?>
    
</div>

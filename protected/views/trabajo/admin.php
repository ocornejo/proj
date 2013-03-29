<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */

$this->breadcrumbs=array(
	'Trabajos'=>array('index'),
	'Administrar',
);

//$this->menu=array(
//	array('label'=>'Listar aseos realizados', 'url'=>array('index')),
//	array('label'=>'Ingresar aseo', 'url'=>array('create')),
//);

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
");
?>
<div class="span-23">
<h1>Administrar aseos</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Búsqueda avanzada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trabajo-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'OT',
		'AVION_MATRICULA',
		'USUARIO_BP',
		 array(
                    'name'=>'PLANIFICADO',
                    'filter'=>array(1=>"Si",0=>"No"),
                    'value'=>function($data){
                             if($data->PLANIFICADO==NULL)
                                 return "";
                             else
                                 return @$data->PLANIFICADO ? "Si" : "No";
                    }),
		'HORA_INICIO',
		'HORA_TERMINO',
		'FECHA',
		'CALIFICACION',
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
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
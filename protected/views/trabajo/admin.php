<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */

$this->breadcrumbs=array(
	'Trabajos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Trabajo', 'url'=>array('index')),
	array('label'=>'Create Trabajo', 'url'=>array('create')),
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
");
?>

<h1>Manage Trabajos</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trabajo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID_TRABAJO',
		'OT',
		'AVION_MATRICULA',
		'USUARIO_BP',
		'PLANIFICADO',
		'HORA_INICIO',
		'HORA_TERMINO',
		'COMENTARIO',
		'FECHA',
		'CALIFICACION',
		'ESTADO_ID_ESTADO',
		'LUGAR_ID_LUGAR',
		'ASEO_ID_ASEO',
		'TURNO_ID_TURNO',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuario'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar usuarios', 'url'=>array('index')),
	array('label'=>'Crear usuarios', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#usuario-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar usuarios</h1>

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
	'id'=>'usuario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'BP',
		'NOMBRE',
		'NIVEL_USUARIO',
                array(
                            'name'=> 'FILIAL_ID_FILIAL',
                            'header'=>'Filial',
                            'value'=>'$data->fILIALIDFILIAL->NOMBRE_FILIAL', // this will access the current group's 1st member and give out the firstname of that member
                            'filter'=>Filial::model()->options,
                            'htmlOptions'=>array('style' => 'text-align: center;'),
                        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

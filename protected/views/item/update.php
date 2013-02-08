<?php
/* @var $this ItemController */
/* @var $model Item */

$this->breadcrumbs=array(
	'Items'=>array('index'),
	$model->ID_ITEM=>array('view','id'=>$model->ID_ITEM),
	'Update',
);

$this->menu=array(
	array('label'=>'List Item', 'url'=>array('index')),
	array('label'=>'Create Item', 'url'=>array('create')),
	array('label'=>'View Item', 'url'=>array('view', 'id'=>$model->ID_ITEM)),
	array('label'=>'Manage Item', 'url'=>array('admin')),
);
?>

<h1>Update Item <?php echo $model->ID_ITEM; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
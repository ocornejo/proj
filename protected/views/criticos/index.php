<?php
/* @var $this CRITICOSController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Criticoses',
);

$this->menu=array(
	array('label'=>'Create CRITICOS', 'url'=>array('create')),
	array('label'=>'Manage CRITICOS', 'url'=>array('admin')),
);
?>

<h1>Criticoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

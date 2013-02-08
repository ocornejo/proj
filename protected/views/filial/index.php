<?php
/* @var $this FilialController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Filials',
);

$this->menu=array(
	array('label'=>'Create Filial', 'url'=>array('create')),
	array('label'=>'Manage Filial', 'url'=>array('admin')),
);
?>

<h1>Filials</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

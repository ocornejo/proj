<?php
/* @var $this AseoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Aseos',
);

$this->menu=array(
	array('label'=>'Create Aseo', 'url'=>array('create')),
	array('label'=>'Manage Aseo', 'url'=>array('admin')),
);
?>

<h1>Aseos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php

$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/jquery.css');
$this->pageTitle=Yii::app()->name . ' - Bajar evaluaciones';
$this->breadcrumbs=array(
	'Bajar evaluaciones',
);
?>

<h1>Bajar evaluaciones</h1>

<div class="search-form" style="">
<?php $this->renderPartial('_searchEvaluaciones',array(
	'model'=>$model,
)); ?>

</div>

<div style="">
<?php 
	list($dataProvider,$columns) = $model->searchItem();
	


	$this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'item-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>$columns,
	
	));
?>
</div>
<?php
	$baseUrl = Yii::app()->theme->baseUrl; 
    $normalImageSrc = "{$baseUrl}/images/excel.png";
    $image = CHtml::image($normalImageSrc,"",array('style' => 'vertical-align:10px;')).'Descargar datos filtrados';
    echo CHtml::link($image, array('site/DownloadExcelEval'));            
       
?>


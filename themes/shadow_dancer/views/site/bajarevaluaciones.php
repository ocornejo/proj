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




<style>
    .CGridViewContainer {overflow: auto;
overflow-y: hidden; }
</style>


<div class="CGridViewContainer">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'item-grid',
	'dataProvider'=>$model->searchItem(),
	
	'columns'=>array(
		'NOMBRE',
                array(
                            'name'=> 'EVALUACION_ID_EVALUACION',
                            'header'=>'Evaluación',
                            'value'=>'$data->eVALUACIONIDEVALUACION->NOMBRE', // this will access the current group's 1st member and give out the firstname of that member
                            'filter'=>  Evaluacion::model()->options,
                            'htmlOptions'=>array('style' => 'text-align: left;'),
                             ),
                'notas'
		
	),
));
                    ?>
  </div>
    <?php
   
        $baseUrl = Yii::app()->theme->baseUrl; 
        $normalImageSrc = "{$baseUrl}/images/excel.png";
        $image = CHtml::image($normalImageSrc,"",array('style' => 'vertical-align:10px;')).'Descargar datos filtrados';
        //"",array("width"=>20,"heigth"=>20,'style' => 'vertical-align:10px;')

        echo CHtml::link($image, array('site/DownloadExcel'));            
        
                    
?>



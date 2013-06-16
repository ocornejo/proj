<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


        <fieldset>
        <legend>Información del avión</legend>
        
        
      
            <div class="span-9">
            <?php $this->widget('application.extensions.multiselects.XMultiSelects',array(
				    'leftTitle'=>'Flotas disponibles',
				    'leftName'=>'Flota[disponible][]',
				    'leftList'=>CHtml::listData(Flota::model()->findAll(),'ID_FLOTA','NOMBRE_FLOTA'),
				    'rightTitle'=>'Flotas seleccionadas',
				    'rightName'=>'Flota[selected][]',
				    'rightList'=>CHtml::listData(Flota::model()->findAll(array('limit'=>0)),'ID_FLOTA','NOMBRE_FLOTA'),
				    'size'=>9,
				    'width'=>'100px',
				));
			?>
            </div>

        </fieldset>
        
 
	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
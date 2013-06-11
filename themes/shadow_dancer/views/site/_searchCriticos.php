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
        
        
        <div class="raw">
            <?php echo $form->label($model,'FLOTA_ID_FLOTA'); ?>
            <?php //echo $form->dropDownList($model, 'flota', CHtml::listData(Flota::model()->findAll(), 'ID_FLOTA', 'NOMBRE_FLOTA'), array('empty' => 'Seleccione')); ?>
            <?php echo $form->ListBox($model,'FLOTA_ID_FLOTA', CHtml::listData(Flota::model()->findAll(), 'ID_FLOTA', 'NOMBRE_FLOTA'), array('empty' => null,'multiple'=>'multiple','style' => 'height: 100px; vertical-align: middle;',
            'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('Avion/GetMatByFlota'),
                    'dataType' => 'json',
                    'data' => array('datasds'=> 'js:this.value'),
                    'success' => 'function(data) { 
                                                    $("#flotaId").val(data.flota[0].NOMBRE_FLOTA);
                                                    idFlota = data.flota[0].ID_FLOTA;
                                                  }',

                    ))); ?>
        </div>
            <div class="raw">
		<?php echo $form->label($model,'MATRICULA'); ?>
		<?php $posts2=Avion::model()->findAll(); 
                      echo $form->dropDownList($model, 'MATRICULA', CHtml::listData($posts2, 'MATRICULA', 'MATRICULA',function($posts2) {
                                                return CHtml::encode($posts2->fLOTAIDFLOTA->NOMBRE_FLOTA);
                                        }), array('empty' => 'Seleccione'));?>
            </div>

        </fieldset>
        
 
	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
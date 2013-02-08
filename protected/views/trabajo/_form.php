<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'trabajo-form',
	'enableAjaxValidation'=>false,
        'stateful'=>true, 
        'htmlOptions'=>array(
            'enctype' => 'multipart/form-data'
        )
        
)); ?>

        <p class="note">Campos con<span class="required">*</span> son requeridos.</p>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'OT'); ?>
		<?php echo $form->textField($model,'OT',array('style' => 'width:50px','maxlength'=>6)); ?>
		<?php echo $form->error($model,'OT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AVION_MATRICULA'); ?>
                <?php echo $form->dropDownList($model,'AVION_MATRICULA',  CHtml::listData(Avion::model()->findAll(), 'MATRICULA', 'MATRICULA'),
                                    array('empty' => ' ',
                                        'ajax' => array(
                                            'type'=>'POST',
                                            'url'=>CController::createUrl('Flota/GetFlotaByMat'), 
                                            'dataType'=>'json',
                                            'data'=>array('matricula'=>'js:this.value'),  
                                            'success'=>'function(data) {
                                                $("#flotaId").val(data[0].NOMBRE_FLOTA);
                                            }',
                             ))); ?>
		<?php //echo $form->textField($model,'AVION_MATRICULA',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'AVION_MATRICULA'); ?>
	</div>
        <div class="row">
        <?php echo CHtml::label('Flota:', '');
              echo CHtml::textField('flotaId', '', array('style' => 'width:45px','readonly'=>'true'));?>
        </div>
	<div class="row">
		<?php echo $form->labelEx($model,'USUARIO_BP'); ?>
		<?php echo $form->textField($model,'USUARIO_BP'); ?>
		<?php echo $form->error($model,'USUARIO_BP'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PLANIFICADO'); ?>
		<?php echo $form->checkBox($model,'PLANIFICADO', false, array('value'=>1, 'uncheckValue'=>0))?>
		<?php echo $form->error($model,'PLANIFICADO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HORA_INICIO'); ?>
		<?php $this->widget('application.extensions.jui_timepicker.JTimePicker', array(
                    'model'=>$model,
                     'attribute'=>'HORA_INICIO',
                     // additional javascript options for the date picker plugin
                     'options'=>array(
                         'showPeriod'=>true,
                         'hours'=>array('starts'=>1, 'ends'=>23),
                         'minutes'=>array('interval'=>1),
                         'showPeriodLabels'=> false,
                         'showPeriod'=> false,
                         'hourText'=> 'Hora',
                         'minuteText'=> 'Minuto', 
                         'rows'=> 6,
                         'showCloseButton'=>true,
                         'closeButtonText'=> 'Listo',
                         ),
                     'htmlOptions'=>array('size'=>4,'maxlength'=>5),
                 ));
                ?>

		<?php echo $form->error($model,'HORA_INICIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HORA_TERMINO'); ?>
		<?php $this->widget('application.extensions.jui_timepicker.JTimePicker', array(
                    'model'=>$model,
                     'attribute'=>'HORA_TERMINO',
                     // additional javascript options for the date picker plugin
                     'options'=>array(
                         'showPeriod'=>true,
                         'hours'=>array('starts'=>1, 'ends'=>23),
                         'minutes'=>array('interval'=>1),
                         'showPeriodLabels'=> false,
                         'showPeriod'=> false,
                         'hourText'=> 'Hora',
                         'minuteText'=> 'Minuto', 
                         'rows'=> 6,
                         'showCloseButton'=>true,
                         'closeButtonText'=> 'Listo',
                         ),
                     'htmlOptions'=>array('size'=>4,'maxlength'=>5),
                 ));
                ?>
		<?php echo $form->error($model,'HORA_TERMINO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COMENTARIO'); ?>
		<?php echo $form->textArea($model, 'COMENTARIO', array('maxlength' => 255, 'rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($model,'COMENTARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHA'); ?>
		<?php //echo $form->textField($model,'FECHA'); ?>
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'FECHA',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'dateFormat'=>'yy-mm-dd',
                        'showAnim'=>'fold',
                    ),
                    'htmlOptions'=>array(
                                'class'=>'shadowdatepicker',
                                'style' => 'width:74px'
                    ),
                ));?>
		<?php echo $form->error($model,'FECHA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CALIFICACION'); ?>
		<?php echo $form->textField($model,'CALIFICACION',array('style' => 'width:30px','maxlength'=>3)); ?>
		<?php echo $form->error($model,'CALIFICACION'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ESTADO_ID_ESTADO'); ?>
		<?php echo $form->dropDownList($model, 'ESTADO_ID_ESTADO', CHtml::listData(Estado::model()->findAll(), 'ID_ESTADO', 'NOMBRE_ESTADO'), array('empty' => ' '));?>
		<?php echo $form->error($model,'ESTADO_ID_ESTADO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LUGAR_ID_LUGAR'); ?>
		<?php echo $form->dropDownList($model, 'LUGAR_ID_LUGAR', CHtml::listData(Lugar::model()->findAll(), 'ID_LUGAR', 'LUGAR'), array('empty' => ' '));?>
		<?php echo $form->error($model,'LUGAR_ID_LUGAR'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ASEO_ID_ASEO'); ?>
		<?php echo $form->dropDownList($model, 'ASEO_ID_ASEO', CHtml::listData(Aseo::model()->findAll(), 'ID_ASEO', 'TIPO_ASEO'), array('empty' => ' ',
                                        'ajax' => array(
                                            'type'=>'POST',
                                            'url'=>CController::createUrl('Flota/GetFlotaByMat'), 
                                            'dataType'=>'json',
                                            'data'=>array('matricula'=>'js:this.value'),  
                                            'success'=>'function(data) {
                                                $("#flotaId").val(data[0].NOMBRE_FLOTA);
                                            }',
                             )));?>
		<?php echo $form->error($model,'ASEO_ID_ASEO'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'TURNO_ID_TURNO'); ?>
		<?php echo $form->textField($model,'TURNO_ID_TURNO'); ?>
		<?php echo $form->error($model,'TURNO_ID_TURNO'); ?>
        </div>
	
        <div class="row">
        <?php 
	
            echo $form->labelEx($model, 'image');
            echo $form->fileField($model, 'image');
            echo $form->error($model, 'image');?>
        
        </div>
        
        
        <div class="row buttons">
              <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        </div>
	


<?php $this->endWidget();?>

</div><!-- form -->
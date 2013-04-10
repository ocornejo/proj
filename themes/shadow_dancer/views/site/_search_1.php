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
        <legend>Información personal</legend>
        <div class="raw">
		<?php echo $form->label($model,'USUARIO_BP'); ?>
		<?php echo $form->dropDownList($model, 'USUARIO_BP', CHtml::listData(Usuario::model()->findAll(), 'BP', 'NOMBRE'), array('empty' => 'Seleccione'));?>
	</div>
        <div class="raw">
		<?php echo $form->label($model,'Fecha turno: '); 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => Turno::model(),
                            'attribute' => 'FECHA',
                            'name' => 'FECHATE', // This is how it works for me.
                            'language' => 'es',
                            // additional javascript options for the date picker plugin
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'showAnim' => 'drop',
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:74px',
                                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('Turno/GetTurnoByTipoTurno'),
                    'dataType' => 'json',
                    'data' => array('fecha' => 'js:this.value','tipo_turno_id_tipo_turno'=>'js:$("#'.CHtml::activeId(Turno::model(), 'TIPO_TURNO_ID_TIPO_TURNO').'").val()'),
                    'success' => 'function(data) {
                                                    console.log(data);
                                                    $("#'.CHtml::activeId($model, 'TURNO_ID_TURNO').'").val(data);
                                                  }',
                    ),'onBlur'=>'if(this.value=="") $("#'.CHtml::activeId($model, 'TURNO_ID_TURNO').'").val("");',
                            ),
                        ));
                echo $form->textField($model,'TURNO_ID_TURNO',array('style'=>'display:none;'));
                ?>
	</div>
         


        <div class="raw">
            <?php echo $form->label($model,'Tipo turno: '); ?>
            <?php echo $form->dropDownList(Turno::model(), 'TIPO_TURNO_ID_TIPO_TURNO',CHtml::listData(TipoTurno::model()->findAll(),'ID_TIPO_TURNO','TIPO'),array('empty' => 'Seleccione',
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('Turno/GetTurnoByTipoTurno'),
                    'dataType' => 'json',
                    'data' => array('tipo_turno_id_tipo_turno' => 'js:this.value','fecha'=>'js:$("#FECHATE").val()'),
                    'success' => 'function(data) {
                                                    console.log(data);
                                                    $("#'.CHtml::activeId($model, 'TURNO_ID_TURNO').'").val(data);
                                                  }',
                    )));
               ?>

        </div>
        
        
        </fieldset>
	
        
	
	

	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
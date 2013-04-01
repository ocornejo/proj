<?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'trabajo-form2',
        'enableAjaxValidation' => false,
        'enableClientValidation'=>true,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        ),
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));    
?>
<hr>
    <div class="flash-success">El aseo ha sido guardado con éxito.</div>
    <p>ASEO #2</p>
  <fieldset>
      <legend>Información del Aseo</legend>
      <div class="raw">
          <?php echo $form->labelEx($model2, 'ASEO_ID_ASEO'); ?>
              
        <?php
        echo $form->dropDownList($model2, 'ASEO_ID_ASEO', CHtml::listData(Aseo::model()->findAll(), 'ID_ASEO', 'TIPO_ASEO'), array('empty' => 'Seleccione', //'disabled'=>'disabled',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('Aseo/GetTipoByPond'),
                'dataType' => 'json',
                'data' => array('id_aseo' => 'js:this.value'),
                'success' => 'function(data) {
                                                        if(data=="1"){
                                                            $("#showDialogEvaluacion2").show();
                                                            $("#' . CHtml::activeId($model2, 'CALIFICACION') . '").show();
                                                            $("#CALIFICACION_LABEL2").show();
                                                            
                                                        }
                                                        else{
                                                            $("#showDialogEvaluacion2").hide();
                                                            $("#' . CHtml::activeId($model2, 'CALIFICACION') . '").hide();
                                                            $("#CALIFICACION_LABEL2").hide();
                                                        }
                                                     }',
        )));
        ?>
                    <?php echo $form->error($model2, 'ASEO_ID_ASEO'); ?>
      </div>
      
      <div class="raw">
          <?php echo $form->labelEx($model2, 'LUGAR_ID_LUGAR'); ?>
          <?php echo $form->dropDownList($model2, 'LUGAR_ID_LUGAR', CHtml::listData(Lugar::model()->findAll('filial_id_filial=:filial', array(':filial' => Usuario::model()->findByPk(Yii::app()->user->getId())->FILIAL_ID_FILIAL)), 'ID_LUGAR', 'LUGAR'), array('empty' => 'Seleccione')); ?>
          <?php echo $form->error($model2, 'LUGAR_ID_LUGAR'); ?>
      </div>
      
      <div class="raw">
          <?php echo $form->labelEx($model2, 'PLANIFICADO'); ?>
          <?php echo $form->radioButtonList($model2, 'PLANIFICADO', array(1 => 'Si', 0 => 'No'), array('separator' => ' ')); ?>
          <?php echo $form->error($model2, 'PLANIFICADO'); ?>
      </div>
  </fieldset>
    
    <fieldset>
        <legend>Información cronológica</legend>
        <div class="raw">
            <?php echo $form->labelEx($model2, 'HORA_INICIO'); ?>
            <?php $this->widget('application.extensions.jui_timepicker.JTimePicker', array(
                           'model' => $model2,
                           'attribute' => 'HORA_INICIO',
                           // additional javascript options for the date picker plugin
                           'options' => array(
                               'showPeriod' => true,
                               'hours' => array('starts' => 0, 'ends' => 23),
                               'minutes' => array('interval' => 1),
                               'showPeriodLabels' => false,
                               'showPeriod' => false,
                               'hourText' => 'Hora',
                               'minuteText' => 'Minuto',
                               'rows' => 6,
                               'showCloseButton' => true,
                               'closeButtonText' => 'Listo',
                           ),
                           'htmlOptions' => array('size' => 5, 'maxlength' => 5, 'readonly' => 'readonly'),
                       )); ?>
            <?php echo $form->error($model2, 'HORA_INICIO'); ?>
        </div>
        <div class="raw">
            <?php echo $form->labelEx($model2, 'HORA_TERMINO'); ?>
            <?php $this->widget('application.extensions.jui_timepicker.JTimePicker', array(
                        'model' => $model2,
                        'attribute' => 'HORA_TERMINO',
                        // additional javascript options for the date picker plugin
                        'options' => array(
                            'showPeriod' => true,
                            'hours' => array('starts' => 0, 'ends' => 23),
                            'minutes' => array('interval' => 1),
                            'showPeriodLabels' => false,
                            'showPeriod' => false,
                            'hourText' => 'Hora',
                            'minuteText' => 'Minuto',
                            'rows' => 6,
                            'showCloseButton' => true,
                            'closeButtonText' => 'Listo',
                        ),
                        'htmlOptions' => array('size' => 5, 'maxlength' => 5, 'readonly' => 'readonly'),
                    )); ?>
           <?php echo $form->error($model2, 'HORA_TERMINO'); ?>
        </div>
        <div class="raw">
            <?php echo $form->labelEx($model2, 'FECHA'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model2,
                'attribute' => 'FECHA',
                'language' => 'es',
                // additional javascript options for the date picker plugin
                'options' => array(
                    'dateFormat' => 'yy-mm-dd',
                    'showAnim' => 'fold',
                ),
                'htmlOptions' => array(
                    'style' => 'width:74px',
                    'readonly' => 'readonly',
                ),
            )); ?>
            <?php echo $form->error($model2, 'FECHA'); ?>
        </div>
    </fieldset>
    
    <fieldset>
        <legend>Información de la evaluación</legend>
        <div class="raw">
            <?php echo $form->labelEx($model2, 'ESTADO_ID_ESTADO'); ?>
            <?php echo $form->dropDownList($model2, 'ESTADO_ID_ESTADO', CHtml::listData(Estado::model()->findAll(), 'ID_ESTADO', 'NOMBRE_ESTADO'), array('empty' => 'Seleccione')); ?>
            <?php echo $form->error($model2, 'ESTADO_ID_ESTADO'); ?>
        </div>
        
        <div class="raw">
            <?php echo $form->labelEx($model2, 'OT'); ?>
            <?php echo $form->textField($model2, 'OT', array('style' => 'width:50px', 'maxlength' => 6,'onBlur'=>CHtml::ajax(array(
                                                                                           'url'=>Yii::app()->createUrl('trabajo/SearchOT'),
                                                                                           'type'=>'post',                                                        
                                                                                           'dataType'=>'json',
                                                                                           //'data'=>array('title' => 'js:this.value'),       
                                                                                           'success'=>'function(data){ //alert(data[0]);
                                                                                                                                            if(data[0]=="N");
                                                                                                                                                //alert(data[1]);
                                                                                                                                            else{
                                                                                                                                                alert("OT ingresada ya existe");
                                                                                                                                                 $("#' . CHtml::activeId($model2, 'OT') . '").val("");}
                                                                                                                                        }',
                                                                                                                            'error' => "function(data, status){ alert(status); }",
                                                                                            )))); ?>
            <?php echo $form->error($model2, 'OT'); ?>
        </div>
        
        <div class="raw">
            <?php echo $form->labelEx($model2, 'CALIFICACION', array('id' => 'CALIFICACION_LABEL2')); ?>
            <?php echo $form->textField($model2, 'CALIFICACION', array('style' => 'width:30px', 'maxlength' => 3, 'readonly' => 'true')); ?>
            <?php $baseUrl = Yii::app()->theme->baseUrl;
            $imageId = "img";
            $normalImageSrc = "{$baseUrl}/images/write.png";

            $img = "<img style=\"vertical-align:-10px;\" id=\"{$imageId}\" class=\"showDialogEvaluacion2\" src=\"{$normalImageSrc}\"/ >";

            echo CHtml::ajaxLink($img, $this->createUrl('trabajo/save'), array(
                'type' => 'POST',
                'data' => 'js:$("#trabajo-form2").serialize()',
                'success' => "function(html,textStatus,jqXHR) {
                                     $('#AjaxLoader2').hide();  
                                    if (html.indexOf('{')==0) {
                                       jQuery('#trabajo-form2').ajaxvalidationmessages('show', html);            
                                    }
                                    else {
                                       $('#SubButton2').hide();
                                       $('#HideSubButton2').show(); 
                                       jQuery('#trabajo-form2').ajaxvalidationmessages('hide');
                                       $('#dialogEvaluacion2').html(html).dialog('open');

                                       return false;
                                     }
                                 }",
                'error' => "function(html) {

                                    jQuery('#trabajo-form2').ajaxvalidationmessages('hide');

                                 }",
                'update' => '#dialogEvaluacion2',
                'beforeSend' => 'function(){                        
                                       $("#AjaxLoader2").show();
                                  }'
                    ), array('id' => 'showDialogEvaluacion2', 'type' => 'hidden'));
            ?>
        </div>
        <div id="dialogEvaluacion2"></div>
        <div id="AjaxLoader2" style="display: none">Cargando evaluación<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/spinner.gif"></div>
    </fieldset>
    
    <fieldset class="coments">
        <legend>Comentarios y fotos</legend>
        <div class="raw">
            <?php echo $form->labelEx($model2, 'COMENTARIO',array('style'=>"vertical-align:26px;")); ?>
            <?php echo $form->textArea($model2, 'COMENTARIO', array('maxlength' => 255, 'rows' => 3, 'cols' => 70)); ?>
            <?php echo $form->error($model2, 'COMENTARIO'); ?>
        </div>
        
        <div class="raw">
           <?php echo $form->labelEx($model2, 'imagen',array('style'=>"vertical-align:top;")); ?>
           <?php $this->widget('CMultiFileUpload', array(
                                    'model'=>$model2,
                                    'name' => 'imagen',
                                    'accept' => 'jpeg|jpg|gif|png', // useful for verifying files
                                    //'duplicate' => 'Archivo ya existe', // useful, i think
                                    'denied' => 'Tipo de archivo inválido', // useful, i think
                                    'remove'=>Yii::t('ui','Remover'),
                                    'max'=>3,
                                )); ?>
           <?php echo $form->error($model2, 'imagen'); ?> 
        </div>
    </fieldset>
    

<!--  <div class="button-row">
    <a href="#">Cancel</a> or <input type="submit" value="Save Changes">
  </div>  -->
    

<?php $this->endWidget(); ?>
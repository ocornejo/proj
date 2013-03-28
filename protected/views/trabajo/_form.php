<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */
/* @var $form CActiveForm */
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl . '/css/jquery.css');
$cs->registerCSSFile($baseUrl . '/css/semantic.css');
?>

<script type="text/javascript">
    window.arreglo = new Array();
    window.global = 1;
    window.notasFinales = new Array();
    window.temp = new Object();
    window.tamano = 0;
    window.var2 = new Array();
    window.var3 = new Array();




    $(document).ready(function() {
        $("#showDialogEvaluacion").hide();
        var currentTime = new Date()
        var month = currentTime.getMonth() + 1;
        var day = currentTime.getDate();
        var year = currentTime.getFullYear();
        if (day < 10) {
            day = '0' + day
        }
        if (month < 10) {
            month = '0' + month
        }
        currentTime = month + '/' + day + '/' + year;
        <?php  print('$("#' . CHtml::activeId($modelT, 'FECHA') . '").val(year+ "-" + month+ "-" + day);'); ?>
        <?php  print('$("#' . CHtml::activeId($model, 'FECHA') . '").val(year+ "-" + month+ "-" + day);'); ?>
        //console.log($("#<?php echo CHtml::activeId($model, 'AVION_MATRICULA'); ?> option:selected").text());
        $.post(
                '<?php echo $this->createUrl("Flota/GetFlotaByMat"); ?>',
                {'matricula': $("#<?php echo CHtml::activeId($model, 'AVION_MATRICULA'); ?> option:selected").text()},
        function(data) {
            $("#flotaId").val(data[0].NOMBRE_FLOTA);
        }
        , "json");
    });



    Object.size = function(obj) {
        var size = 0, key;
        for (key in obj) {
            if (obj.hasOwnProperty(key))
                size++;
        }
        return size;
    };

    function inicia(variable2, variable3) {
        var i;
        window.var2 = variable3;
        window.var3 = variable2;
        for (i = 0; i < window.var3.length; i++) {
            window.temp[window.var3[i]['evaluacion_id_evaluacion']] = 0;
            window.arreglo[i] = 101;
        }
        for (var key in window.temp) {
            tamano = parseInt(key);
        }

    }
    function updateTag(var1) {
        final = 0;
        count = 0;
        total = 0;
        notaFinal = 0;
        var1 = var1 + 1;

        for (var j = 0; j < window.var3.length; j++) {
            if (window.var3[j]['evaluacion_id_evaluacion'] == var1) {
                count = count + 1;
                if (parseInt(window.arreglo[j]) == 101)
                    total = total + 0;
                else
                    total = total + parseInt(window.arreglo[j]);
                //console.log("total :"+total+" count: "+count+" parse: "+parseFloat(window.arreglo[j]));
            }

        }

        final = Number((total / count).toFixed(0));
        window.temp[var1] = (final * window.var2[var1 - 1]['ponderacion']) / 100;

        for (var i = 1; i <= window.tamano; i++) {
            if (window.temp[i] != null)
                notaFinal = Number((notaFinal + window.temp[i]).toFixed(0));
        }
        //console.log("temp: "+window.temp[var1]+" notaFinal: "+notaFinal);
        var1 = var1 - 1;
        variable1 = "notaPond[" + var1 + "]";

        document.getElementById(variable1).innerHTML = final + "%";
        $('#NotaFinal').val(notaFinal + "%");
<?php print('$("#' . CHtml::activeId($model, 'CALIFICACION') . '").val(notaFinal);'); ?>


    }
    function updateAll(var2, var3) {
        for (var i = 1; i <= window.tamano; i++) {
            if (window.temp[i] != null)
                updateTag(i - 1);
        }

    }
</script>

<div class="form semantic">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'trabajo-form',
        'enableAjaxValidation' => false,
        'enableClientValidation'=>true,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        ),
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    $this->widget('application.extensions.ajaxvalidationmessages.EAjaxValidationMessages', array(
        'errorCssClass' => 'clsError',
        'errorMessageCssClass' => 'clsErrorMessage',
        'errorSummaryCssClass' => 'clsErrorSummary'));
    ?>
    
    <?php //echo $form->errorSummary(array($model,$modelT));  ?>
  
    <p>INFORMACIÓN DE TURNO</p>
   
    <fieldset>
    
    <legend>Información personal</legend>
        <?php $model->USUARIO_BP = Yii::app()->user->getId(); ?>
        <?php echo $form->hiddenField($model, 'USUARIO_BP'); ?>
    <div class="raw">
        <?php Usuario::model()->NOMBRE = Usuario::model()->FindByPk(Yii::app()->user->getId())->NOMBRE; ?>
        <?php echo $form->labelEx(Usuario::model(), 'NOMBRE'); ?>
        <?php echo $form->textField(Usuario::model(), 'NOMBRE', array('style' => 'width:100px', 'maxlength' => 30, 'readonly' => true)); ?>
    </div>
    
    <div class="raw">
        <?php echo $form->labelEx($modelT, 'FECHA'); ?>
            <?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $modelT,
                            'attribute' => 'FECHA',
                            'name' => $modelT->FECHA, // This is how it works for me.
                            'value' => $modelT->FECHA,
                            'language' => 'es',
                            // additional javascript options for the date picker plugin
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'showAnim' => 'drop',
                            ),
                            'htmlOptions' => array(
                                'style' => 'width:74px',
                                'readonly' => 'readonly',
                            ),
                        )); ?>
<!--        <?php $posts2=$modelT->findAll(array('order'=>'FECHA ASC')); 
                      echo $form->dropDownList($modelT, 'FECHA', CHtml::listData($posts2, 'ID_TURNO', 'FECHA',function($posts2) {
                                                return CHtml::encode($posts2->tIPOTURNOIDTIPOTURNO->TIPO);
                                        }), array('empty' => 'Seleccione'));?> -->
            <?php  echo $form->error($modelT, 'FECHA'); ?>
    </div>
  
    <div class="raw">
      <?php echo $form->labelEx($modelT, 'TIPO_TURNO_ID_TIPO_TURNO'); ?>
      <?php echo $form->dropDownList($modelT, 'TIPO_TURNO_ID_TIPO_TURNO', CHtml::listData(TipoTurno::model()->findAll(), 'ID_TIPO_TURNO', 'TIPO'), array('empty' => 'Seleccione'));?>
      <?php echo $form->error($modelT, 'TIPO_TURNO_ID_TIPO_TURNO');?>
    </div>
  
  </fieldset>   
  
  
  <fieldset>    
    
    <legend>Información del avión</legend>          
    
    <div class="raw">
        <?php echo $form->labelEx($model, 'AVION_MATRICULA'); 
        $posts=Avion::model()->findAll(); 
        echo $form->dropDownList($model, 'AVION_MATRICULA', CHtml::listData($posts, 'MATRICULA', 'MATRICULA',function($posts) {
                                                return CHtml::encode($posts->fLOTAIDFLOTA->NOMBRE_FLOTA);
                                        }), array('empty' => 'Seleccione',
                    'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('Flota/GetFlotaByMat'),
                    'dataType' => 'json',
                    'data' => array('matricula' => 'js:this.value'),
                    'success' => 'function(data) {
                                                    $("#flotaId").val(data[0].NOMBRE_FLOTA);
                                                  }',
                    )));?>
        <?php echo $form->error($model, 'AVION_MATRICULA'); ?>
    </div>
    
    <div class="raw">
        <?php echo CHtml::label('Flota:', ''); ?>
        <?php echo CHtml::textField('flotaId', '', array('style' => 'width:43px', 'readonly' => 'readonly')); ?>
    </div>

  </fieldset>
    <hr>
    <div class="flash-success">El aseo ha sido guardado con éxito.</div>
    <p>ASEO #1</p>
  <fieldset>
      <legend>Información del Aseo</legend>
      <div class="raw">
          <?php echo $form->labelEx($model, 'ASEO_ID_ASEO'); ?>
              
        <?php
        echo $form->dropDownList($model, 'ASEO_ID_ASEO', CHtml::listData(Aseo::model()->findAll(), 'ID_ASEO', 'TIPO_ASEO'), array('empty' => 'Seleccione', //'disabled'=>'disabled',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('Aseo/GetTipoByPond'),
                'dataType' => 'json',
                'data' => array('id_aseo' => 'js:this.value'),
                'success' => 'function(data) {
                                                        if(data=="1"){
                                                            $("#showDialogEvaluacion").show();
                                                            $("#' . CHtml::activeId($model, 'CALIFICACION') . '").show();
                                                            $("#CALIFICACION_LABEL").show();
                                                            
                                                        }
                                                        else{
                                                            $("#showDialogEvaluacion").hide();
                                                            $("#' . CHtml::activeId($model, 'CALIFICACION') . '").hide();
                                                            $("#CALIFICACION_LABEL").hide();
                                                        }
                                                     }',
        )));
        ?>
                    <?php echo $form->error($model, 'ASEO_ID_ASEO'); ?>
      </div>
      
      <div class="raw">
          <?php echo $form->labelEx($model, 'LUGAR_ID_LUGAR'); ?>
          <?php echo $form->dropDownList($model, 'LUGAR_ID_LUGAR', CHtml::listData(Lugar::model()->findAll('filial_id_filial=:filial', array(':filial' => Usuario::model()->findByPk(Yii::app()->user->getId())->FILIAL_ID_FILIAL)), 'ID_LUGAR', 'LUGAR'), array('empty' => 'Seleccione')); ?>
          <?php echo $form->error($model, 'LUGAR_ID_LUGAR'); ?>
      </div>
      
      <div class="raw">
          <?php echo $form->labelEx($model, 'PLANIFICADO'); ?>
          <?php echo $form->radioButtonList($model, 'PLANIFICADO', array(1 => 'Si', 0 => 'No'), array('separator' => ' ')); ?>
          <?php echo $form->error($model, 'PLANIFICADO'); ?>
      </div>
  </fieldset>
    
    <fieldset>
        <legend>Información cronológica</legend>
        <div class="raw">
            <?php echo $form->labelEx($model, 'HORA_INICIO'); ?>
            <?php $this->widget('application.extensions.jui_timepicker.JTimePicker', array(
                           'model' => $model,
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
            <?php echo $form->error($model, 'HORA_INICIO'); ?>
        </div>
        <div class="raw">
            <?php echo $form->labelEx($model, 'HORA_TERMINO'); ?>
            <?php $this->widget('application.extensions.jui_timepicker.JTimePicker', array(
                        'model' => $model,
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
           <?php echo $form->error($model, 'HORA_TERMINO'); ?>
        </div>
        <div class="raw">
            <?php echo $form->labelEx($model, 'FECHA'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
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
            <?php echo $form->error($model, 'FECHA'); ?>
        </div>
    </fieldset>
    
    <fieldset>
        <legend>Información de la evaluación</legend>
        <div class="raw">
            <?php echo $form->labelEx($model, 'ESTADO_ID_ESTADO'); ?>
            <?php echo $form->dropDownList($model, 'ESTADO_ID_ESTADO', CHtml::listData(Estado::model()->findAll(), 'ID_ESTADO', 'NOMBRE_ESTADO'), array('empty' => 'Seleccione')); ?>
            <?php echo $form->error($model, 'ESTADO_ID_ESTADO'); ?>
        </div>
        
        <div class="raw">
            <?php echo $form->labelEx($model, 'OT'); ?>
            <?php echo $form->textField($model, 'OT', array('style' => 'width:50px', 'maxlength' => 6,'onBlur'=>CHtml::ajax(array(
                                                                                           'url'=>Yii::app()->createUrl('trabajo/SearchOT'),
                                                                                           'type'=>'post',                                                        
                                                                                           'dataType'=>'json',
                                                                                           //'data'=>array('title' => 'js:this.value'),       
                                                                                           'success'=>'function(data){ //alert(data[0]);
                                                                                                                                            if(data[0]=="N");
                                                                                                                                                //alert(data[1]);
                                                                                                                                            else{
                                                                                                                                                alert("OT ingresada ya existe");
                                                                                                                                                 $("#' . CHtml::activeId($model, 'OT') . '").val("");}
                                                                                                                                        }',
                                                                                                                            'error' => "function(data, status){ alert(status); }",
                                                                                            )))); ?>
            <?php echo $form->error($model, 'OT'); ?>
        </div>
        
        <div class="raw">
            <?php echo $form->labelEx($model, 'CALIFICACION', array('id' => 'CALIFICACION_LABEL')); ?>
            <?php echo $form->textField($model, 'CALIFICACION', array('style' => 'width:30px', 'maxlength' => 3, 'readonly' => 'true')); ?>
            <?php $baseUrl = Yii::app()->theme->baseUrl;
            $imageId = "img";
            $normalImageSrc = "{$baseUrl}/images/write.png";

            $img = "<img style=\"vertical-align:-10px;\" id=\"{$imageId}\" class=\"showDialogEvaluacion\" src=\"{$normalImageSrc}\"/ >";

            echo CHtml::ajaxLink($img, $this->createUrl('trabajo/save'), array(
                'type' => 'POST',
                'data' => 'js:$("#trabajo-form").serialize()',
                'success' => "function(html,textStatus,jqXHR) {
                                     $('#AjaxLoader').hide();  
                                    if (html.indexOf('{')==0) {
                                       jQuery('#trabajo-form').ajaxvalidationmessages('show', html);            
                                    }
                                    else {
                                       $('#SubButton').hide();
                                       $('#HideSubButton').show(); 
                                       jQuery('#trabajo-form').ajaxvalidationmessages('hide');
                                       $('#dialogEvaluacion').html(html).dialog('open');

                                       return false;
                                     }
                                 }",
                'error' => "function(html) {

                                    jQuery('#trabajo-form').ajaxvalidationmessages('hide');

                                 }",
                'update' => '#dialogEvaluacion',
                'beforeSend' => 'function(){                        
                                       $("#AjaxLoader").show();
                                  }'
                    ), array('id' => 'showDialogEvaluacion', 'type' => 'hidden'));
            ?>
        </div>
        <div id="dialogEvaluacion"></div>
        <div id="AjaxLoader" style="display: none">Cargando evaluación<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/spinner.gif"></div>
    </fieldset>
    
    <fieldset class="coments">
        <legend>Comentarios y fotos</legend>
        <div class="raw">
            <?php echo $form->labelEx($model, 'COMENTARIO',array('style'=>"vertical-align:26px;")); ?>
            <?php echo $form->textArea($model, 'COMENTARIO', array('maxlength' => 255, 'rows' => 3, 'cols' => 70)); ?>
            <?php echo $form->error($model, 'COMENTARIO'); ?>
        </div>
        
        <div class="raw">
           <?php echo $form->labelEx($model, 'imagen',array('style'=>"vertical-align:top;")); ?>
           <?php $this->widget('CMultiFileUpload', array(
                                    'name' => 'imagen',
                                    'accept' => 'jpeg|jpg|gif|png', // useful for verifying files
                                    //'duplicate' => 'Archivo ya existe', // useful, i think
                                    'denied' => 'Tipo de archivo inválido', // useful, i think
                                    'remove'=>Yii::t('ui','Remover'),
                                    'max'=>3,
                                )); ?>
           <?php echo $form->error($model, 'imagen'); ?> 
        </div>
    </fieldset>
    

<!--  <div class="button-row">
    <a href="#">Cancel</a> or <input type="submit" value="Save Changes">
  </div>  -->
    
      <div class="SubmitButton" id="SubButton" style="vertical-align:-10px;">
        <?php echo CHtml::submitButton('Guardar', array('name' => 'buttonSubmit','style'=>'width: 95px; height: 35px; background: url(/proj/themes/shadow_dancer/images/small_icons/disk.png) no-repeat 15px 7px; padding-left: 24px; vertical-align: bottom;')); ?>
      </div>

    <div class="HideSubmitButton" id="HideSubButton" style="display: none; vertical-align:-10px;">
        <?php echo CHtml::submitButton('Guardash', array('name' => 'update','style'=>'width: 95px; height: 35px;background: url(/proj/themes/shadow_dancer/images/small_icons/disk.png) no-repeat 15px 7px; padding-left: 24px; vertical-align: bottom;')); ?>
    </div>
    
    <div>
        <?php echo CHtml::resetButton('Resetear', array('name' => 'update','style'=>'width: 95px; height: 35px;background: url(/proj/themes/shadow_dancer/images/small_icons/arrow_refresh.png) no-repeat 12px 7px; padding-left: 24px; vertical-align: bottom;')); ?>
    </div>
<?php $this->endWidget(); ?>
 

</div>

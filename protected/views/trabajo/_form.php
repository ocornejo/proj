<?php
/* @var $this TrabajoController */
/* @var $model Trabajo */
/* @var $form CActiveForm */
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl . '/css/jquery.css');
?>

<script type="text/javascript">
        window.arreglo= new Array();
        window.global=1;
        window.notasFinales=new Array();
        window.temp = new Object();
        window.tamano=0;
        
        $(document).ready(function(){
            $("#showDialogEvaluacion").hide();
        })
        
        Object.size = function(obj) {
            var size = 0, key;
            for (key in obj) {
                if (obj.hasOwnProperty(key)) size++;
            }
            return size;
        };

        function inicia(var1){
            var i;
            for(i=0;i<var1.length;i++){
                window.temp[var1[i]['evaluacion_id_evaluacion']]=0;
                window.arreglo[i]=0;   
            }
            for(var key in window.temp){
                tamano=parseInt(key);
            }
        }
        function updateTag(var1,var2,var3){
            final=0;
            count=0;
            total=0;
            notaFinal=0;
            var1=var1+1;
            
            for(var j=0;j<var2.length;j++){
                if(var2[j]['evaluacion_id_evaluacion'] == var1){
                    count=count+1;
                    total = total + parseFloat(window.arreglo[j]);
                    //console.log("total :"+total+" count: "+count+" parse: "+parseFloat(window.arreglo[j]));
                }
                
           }
           
           final=Number(((total/count)*100).toFixed(0));
           window.temp[var1]=(final*var3[var1-1]['ponderacion'])/100;
           
           for(var i=1;i<=window.tamano;i++){
                if(window.temp[i]!=null)
                    notaFinal=Number((notaFinal+window.temp[i]).toFixed(0));
           }
           //console.log("temp: "+window.temp[var1]+" notaFinal: "+notaFinal);
           var1= var1-1;
           variable1= "notaPond["+var1+"]";
           
           document.getElementById(variable1).innerHTML=final+"%";
           $('#NotaFinal').val(notaFinal);
           <?php print('$("#'.CHtml::activeId($model, 'CALIFICACION').'").val(notaFinal);');?>
           

        } 
        </script> 

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'trabajo-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>

    <p class="note">Campos con<span class="required">*</span> son requeridos.</p>
    <?php echo $form->errorSummary($model); ?>

    <table>
        <tr>
            <td>
                <?php Usuario::model()->NOMBRE = Usuario::model()->FindByPk(Yii::app()->user->getId())->NOMBRE; ?>
                <?php echo $form->labelEx(Usuario::model(), 'NOMBRE'); ?>
            </td>
            <td>
                <?php echo $form->textField(Usuario::model(), 'NOMBRE', array('style' => 'width:100px', 'maxlength' => 30,'readonly'=>true)); ?>
            </td>
            
            <td>
                <?php echo $form->labelEx($modelT, 'FECHA'); ?>
            </td>
            <td>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $modelT,
                    'attribute' => 'FECHA',
                    'language' => 'es',
                    // additional javascript options for the date picker plugin
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'showAnim' => 'fold',
                    ),
                    'htmlOptions' => array(
                        'class' => 'shadowdatepicker',
                        'style' => 'width:74px',
                        'readonly' => 'readonly',
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'FECHA'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($modelT, 'TIPO_TURNO_ID_TIPO_TURNO'); ?>
            </td>
            <td>
                <?php
                echo $form->dropDownList($modelT, 'TIPO_TURNO_ID_TIPO_TURNO', CHtml::listData(TipoTurno::model()->findAll(), 'ID_TIPO_TURNO', 'TIPO'), array('empty' => ' '));
                echo $form->error($modelT, 'TIPO_TURNO_ID_TIPO_TURNO');
                ?>
            </td>

        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($model, 'FECHA'); ?>
            </td>
            <td>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'FECHA',
                    'language' => 'es',
                    // additional javascript options for the date picker plugin
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'showAnim' => 'fold',
                    ),
                    'htmlOptions' => array(
                        'class' => 'shadowdatepicker',
                        'style' => 'width:74px',
                        'readonly' => 'readonly',
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'FECHA'); ?>
            </td>

            <td>
                <?php echo $form->labelEx($model, 'AVION_MATRICULA'); ?>
            </td>
            <td>
                <?php
                echo $form->dropDownList($model, 'AVION_MATRICULA', CHtml::listData(Avion::model()->findAll(), 'MATRICULA', 'MATRICULA'), array('empty' => ' ',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createUrl('Flota/GetFlotaByMat'),
                        'dataType' => 'json',
                        'data' => array('matricula' => 'js:this.value'),
                        'success' => 'function(data) {
                                   $("#flotaId").val(data[0].NOMBRE_FLOTA);
                                             }',
                )));
                echo $form->error($model, 'AVION_MATRICULA');
                ?>
            </td>
            <td>
                <?php echo CHtml::label('Flota:', ''); ?>
            </td>
            <td>
                <?php echo CHtml::textField('flotaId', '', array('style' => 'width:43px', 'readonly' => 'readonly')); ?>
            </td> 
        </tr> 
        <tr><td colspan="6"><hr></td></tr>
        <tr>
            <td>
                <?php echo $form->labelEx($model, 'ASEO_ID_ASEO'); ?>
            </td>
            <td>
                <?php
                echo $form->dropDownList($model, 'ASEO_ID_ASEO', CHtml::listData(Aseo::model()->findAll(), 'ID_ASEO', 'TIPO_ASEO'), array('empty' => ' ',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createUrl('Aseo/GetTipoByPond'),
                        'dataType' => 'json',
                        'data' => array('id_aseo' => 'js:this.value'),
                        'success' => 'function(data) {
                                                        
                                                        if(data=="1"){
                                                           
                                                            $("#showDialogEvaluacion").show();
                                                        }
                                                        else{
                                                            
                                                            $("#showDialogEvaluacion").hide();            
                                                        }

                                                    }',
                )));
                ?>
                <?php echo $form->error($model, 'ASEO_ID_ASEO'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($model, 'PLANIFICADO'); ?>
            </td>
            <td>
                <?php echo $form->checkBox($model, 'PLANIFICADO', false, array('value' => 1, 'uncheckValue' => 0)) ?>
                <?php echo $form->error($model, 'PLANIFICADO'); ?>
            </td>
           
            <td>
                <?php echo $form->labelEx($model, 'LUGAR_ID_LUGAR'); ?>
            </td>
            <td>
                <?php echo $form->dropDownList($model, 'LUGAR_ID_LUGAR', CHtml::listData(Lugar::model()->findAll(), 'ID_LUGAR', 'LUGAR'), array('empty' => ' ')); ?>
                <?php echo $form->error($model, 'LUGAR_ID_LUGAR'); ?>
            </td>
        </tr>
        <tr>
            
            <td>
                <?php echo $form->labelEx($model, 'ESTADO_ID_ESTADO'); ?>
            </td>
            <td>
                <?php echo $form->dropDownList($model, 'ESTADO_ID_ESTADO', CHtml::listData(Estado::model()->findAll(), 'ID_ESTADO', 'NOMBRE_ESTADO'), array('empty' => ' ')); ?>
                <?php echo $form->error($model, 'ESTADO_ID_ESTADO'); ?>
            </td>
            
             <td>
                <?php echo $form->labelEx($model, 'HORA_INICIO'); ?>
            </td>
            <td>
                <?php
                $this->widget('application.extensions.jui_timepicker.JTimePicker', array(
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
                ));
                ?>

                <?php echo $form->error($model, 'HORA_INICIO'); ?>
            </td>

            <td>
                <?php echo $form->labelEx($model, 'HORA_TERMINO'); ?>
            </td>
            <td>
                <?php
                $this->widget('application.extensions.jui_timepicker.JTimePicker', array(
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
                ));
                ?>
                <?php echo $form->error($model, 'HORA_TERMINO'); ?>
            </td>
            
           

        </tr>
        <tr>
             <td>
                <?php echo $form->labelEx($model, 'OT'); ?>
            </td>
            <td>   <?php echo $form->textField($model, 'OT', array('style' => 'width:50px', 'maxlength' => 6)); ?>
                    <?php echo $form->error($model, 'OT'); ?>
            </td>
             <td>
                <?php echo $form->labelEx($model, 'CALIFICACION'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'CALIFICACION', array('style' => 'width:30px', 'maxlength' => 3, 'readonly' => 'true')); ?>
                
                <?php echo CHtml::ajaxLink(Yii::t('nota','Evaluar'),$this->createUrl('nota/addnewevaluacion'),
                        array(
                'type'=>'POST',
                'data'=>array('id_aseo'=> 'js:$("#' . CHtml::activeId($model, 'ASEO_ID_ASEO') . '").val()',
                               'id_flota' => 'js:$("#flotaId").val()' ),
                'onclick'=>'$("#dialogEvaluacion").dialog("option", "position", "top").dialog("open"); return false;',
                'update'=>'#dialogEvaluacion'
                ),array('id'=>'showDialogEvaluacion','type'=>"hidden"));?>
                <div id="dialogEvaluacion"></div>
                
            </td>


        </tr>
        <tr>

        <td colspan=6>
            <?php echo $form->labelEx($model, 'imagen');?>
            <?php echo CHtml::activeFileField($model, 'imagen');?>
            <?php echo $form->error($model, 'imagen'); ?>

        </td>
        </tr>
        <tr>
        <td colspan=6>
            <?php echo $form->labelEx($model, 'COMENTARIO'); ?>
            <?php echo $form->textArea($model, 'COMENTARIO', array('maxlength' => 255, 'rows' => 3, 'cols' => 50)); ?>
            <?php echo $form->error($model, 'COMENTARIO'); ?>
        </td>
        </tr>
    </table>
    
    <hr>


    <div class="row">
        <?php $model->USUARIO_BP = Yii::app()->user->getId(); ?>
        <?php echo $form->hiddenField($model,'USUARIO_BP'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Modificar'); ?>
    </div>



<?php $this->endWidget(); ?>

</div><!-- form -->
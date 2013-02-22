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
        window.var2=new Array();
        window.var3 =new Array();
        
        
        $(document).ready(function(){
            $("#showDialogEvaluacion").hide();
        });
        
        Object.size = function(obj) {
            var size = 0, key;
            for (key in obj) {
                if (obj.hasOwnProperty(key)) size++;
            }
            return size;
        };

        function inicia(variable2,variable3){
            var i;
            window.var2=variable3;
            window.var3=variable2;
            for(i=0;i<window.var3.length;i++){
                window.temp[window.var3[i]['evaluacion_id_evaluacion']]=0;
                console.log(window.var3[i]['evaluacion_id_evaluacion']);
                window.arreglo[i]=101;   
            }
            for(var key in window.temp){
                tamano=parseInt(key);
            }
            
        }
        function updateTag(var1){
            final=0;
            count=0;
            total=0;
            notaFinal=0;
            var1=var1+1;
            
            for(var j=0;j<window.var3.length;j++){
                if(window.var3[j]['evaluacion_id_evaluacion'] == var1){
                    count=count+1;
                    if(parseInt(window.arreglo[j])==101)
                        total = total + 0;
                    else
                        total = total + parseInt(window.arreglo[j]);
                    //console.log("total :"+total+" count: "+count+" parse: "+parseFloat(window.arreglo[j]));
                }
                
           }
           
           final=Number((total/count).toFixed(0));
           window.temp[var1]=(final*window.var2[var1-1]['ponderacion'])/100;
           
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
        function updateAll(var2,var3){
            for(var i=1;i<=window.tamano;i++){
                if(window.temp[i]!=null)
                    updateTag(i-1);
           }
            
        }
        </script> 

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'trabajo-form',
        'action' => Yii::app()->createUrl('trabajo/guardar',array('id'=>$model->ID_TRABAJO)),
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>

    <p class="note">Campos con<span class="required">*</span> son requeridos.</p>
    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->errorSummary($modelT); ?>
    
    <div class="row">
        <?php $model->USUARIO_BP = Yii::app()->user->getId(); ?>
        <?php echo $form->hiddenField($model,'USUARIO_BP'); ?>
    </div>
    <div class="span-17">
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
                <?php echo $form->error($modelT, 'FECHA'); ?>
            </td>
            <td>
                <?php echo $form->labelEx($modelT, 'TIPO_TURNO_ID_TIPO_TURNO'); ?>
            </td>
            <td>
                <?php
                echo $form->dropDownList($modelT, 'TIPO_TURNO_ID_TIPO_TURNO', CHtml::listData(TipoTurno::model()->findAll(), 'ID_TIPO_TURNO', 'TIPO'), array('empty' => 'Seleccione'));
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
                echo $form->dropDownList($model, 'AVION_MATRICULA', CHtml::listData(Avion::model()->findAll(), 'MATRICULA', 'MATRICULA'), array('empty' => 'Seleccione',
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
    </table>
    
<!--        <tr><td colspan="6"><hr></td></tr>-->
    <?php
    $this->widget('ext.jqrelcopy.JQRelcopy',array(
 
        //the id of the 'Copy' link in the view, see below.
        'id' => 'copylink',

         //add a icon image tag instead of the text
         //leave empty to disable removing
        'removeText'=> '<img src="'.$baseUrl.'/images/minusButton.png"><a>Borrar</a>',
        //htmlOptions of the remove link
        'removeHtmlOptions' => array('style'=>'color:red;'),

        //options of the plugin, see http://www.andresvidal.com/labs/relcopy.html
        'options' => array(

              //A class to attach to each copy
             'copyClass'=>'newcopy',
             'slideUp'=>true,

             // The number of allowed copies. Default: 0 is unlimited
             'limit'=>5,

             //Option to clear each copies text input fields or textarea
             'clearInputs'=>true,

             //A jQuery selector used to exclude an element and its children
             'excludeSelector'=>'.skipcopy',

             //Additional HTML to attach at the end of each copy.
             //'append'=>CHtml::tag('span',array('class'=>'hint'),'You can remove this line'),
          )
       ));?>
    
    <table class="row copy"> 
     <tr><td colspan="6">   <hr></td></tr>
    <tr>
            <td>
                <?php echo $form->labelEx($model, 'ASEO_ID_ASEO'); ?>
            </td>
            <td>
                <?php
                echo $form->dropDownList($model, 'ASEO_ID_ASEO', CHtml::listData(Aseo::model()->findAll(), 'ID_ASEO', 'TIPO_ASEO'), array('empty' => 'Seleccione',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createUrl('Aseo/GetTipoByPond'),
                        'dataType' => 'json',
                        'data' => array('id_aseo' => 'js:this.value'),
                        'success' => 'function(data) {
                                                        if(data=="1"){
                                                            $("#showDialogEvaluacion").show();
                                                            $("#'.CHtml::activeId($model, 'CALIFICACION').'").show();
                                                            $("#CALIFICACION_LABEL").show();
                                                        }
                                                        else{
                                                            $("#showDialogEvaluacion").hide();
                                                            $("#'.CHtml::activeId($model, 'CALIFICACION').'").hide();
                                                            $("#CALIFICACION_LABEL").hide();
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
                <?php echo $form->dropDownList($model, 'LUGAR_ID_LUGAR', CHtml::listData(Lugar::model()->findAll(), 'ID_LUGAR', 'LUGAR'), array('empty' => 'Seleccione')); ?>
                <?php echo $form->error($model, 'LUGAR_ID_LUGAR'); ?>
            </td>
        </tr>
        <tr>
            
            <td>
                <?php echo $form->labelEx($model, 'ESTADO_ID_ESTADO'); ?>
            </td>
            <td>
                <?php echo $form->dropDownList($model, 'ESTADO_ID_ESTADO', CHtml::listData(Estado::model()->findAll(), 'ID_ESTADO', 'NOMBRE_ESTADO'), array('empty' => 'Seleccione')); ?>
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
                <?php echo $form->labelEx($model, 'CALIFICACION',array('id'=>'CALIFICACION_LABEL')); ?>
            </td>
            <td >
                <?php echo $form->textField($model, 'CALIFICACION', array('style' => 'width:30px', 'maxlength' => 3, 'readonly' => 'true')); ?>
                
                <?php 
                $baseUrl = Yii::app()->theme->baseUrl;; 
                $imageId = "img"; 
                $normalImageSrc = "{$baseUrl}/images/write.png";
                
                $img = "<img style=\"vertical-align:-10px;\" id=\"{$imageId}\" class=\"showDialogEvaluacion\" src=\"{$normalImageSrc}\"/ >";
                
                echo CHtml::ajaxLink($img,
                        $this->createUrl('nota/addnewevaluacion'),
                        array(
                'type'=>'POST',
                'data'=>array('id_aseo'=> 'js:$("#' . CHtml::activeId($model, 'ASEO_ID_ASEO') . '").val()',
                               'id_flota' => 'js:$("#flotaId").val()',
                                'id_trabajo'=>$model->ID_TRABAJO),
                'onclick'=>'$("#dialogEvaluacion").dialog("option", "position", "top").dialog("open"); return false;',
                'update'=>'#dialogEvaluacion'
                ),array('id'=>'showDialogEvaluacion','type'=>'hidden'));?>
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
    <a id="copylink" href="#" rel=".copy" ><img style="vertical-align:-10px;" src="<?php echo $baseUrl?>/images/addButton.png">Añadir</a>
    
    </div>
    <br>
    
    <div class="row buttons" style="vertical-align:-10px;">
        
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar'); ?>
    </div>
    


<?php $this->endWidget(); ?>

</div><!-- form -->
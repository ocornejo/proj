<?php 
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/jquery.css');
?>

    <script type="text/javascript">

        $(document).ready(function(){
            if(window.global==1){                                                                 
               window.global=0;                                                               
               <?php print("inicia(".json_encode($sql2).",".json_encode($sql).");");?>
              }
        });
    </script>
<div class="form" id="evaluacionDialogForm">
    <?php
    $form=$this->beginWidget('CActiveForm', array(
    'id'=>'nota-form',
    'enableAjaxValidation'=>true,
)); 
    $this->widget('application.extensions.ajaxvalidationmessages.EAjaxValidationMessages',
                    array(
                       'errorCssClass'=>'clsError',
                       'errorMessageCssClass'=>'clsErrorMessage',
                       'errorSummaryCssClass'=>'clsErrorSummary'));?>
    
    <h1 class="note">Campos con<span class="required">*</span> son requeridos.</h1>
    <?php echo $form->errorSummary($model); ?>

    <table valign="top" style="font-size:large;"> 
        <tr>
            <td> <?php echo CHtml::activeLabel(Trabajo::model(), 'ASEO_ID_ASEO'); ?></td>
            <td><?php echo Chtml::textField('tipoAseo', Aseo::model()->FindByPk($id_aseo)->TIPO_ASEO, array('style' => 'width:80px', 'readonly' => 'readonly')); ?></td>

            <td><?php echo CHtml::activeLabel(Flota::model(), 'NOMBRE_FLOTA'); ?></td>
            <td> <?php echo Chtml::textField('nombreFlota', Flota::model()->findByPk($id_flota)->NOMBRE_FLOTA, array('style' => 'width:50px', 'readonly' => 'readonly')); ?></td>    
            <td><?php echo CHtml::label('Nota Final', 'notaFinal'); ?></td>
            <td> <?php echo Chtml::textField('NotaFinal','0%', array('style' => 'width:50px', 'readonly' => 'readonly')); ?></td>
        </tr>
    </table>
    <table valign="top" style="font-size:large;">
 <?php for ($i = 0; $i < count($sql); $i++) {
       
     if((int)$sql[$i]['ponderacion']!=0){
        echo '<tr><td><br></td></tr> 
              <tr>
                    <td><h1>'.CHtml::label($sql[$i]['nombre'].'  ('.$sql[$i]['ponderacion'].'%)', 'nombre', array('id'=>'nombre['.$i.']')).'</h1></td>
                    <td><h1>'.CHtml::label('0%', 'ponderacion',array('id'=>'notaPond['.$i.']')).'</h1></td>
                </tr>';
        for ($j = $i; $j < count($sql2); $j++) {
            if($sql2[$j]['evaluacion_id_evaluacion']==$sql[$i]['id_evaluacion']){
                echo '<tr>
                <td>'. CHtml::label($sql2[$j]['nombre'], 'nombreItem') .'</td>
                <td>'; echo $form->radioButtonList($model,'NOTA', array(0=>'1',25=>'2',50=>'3',75=>'4',100=>'5'), 
                                                            array('name'=>'NOTA['.$j.'][NOTA]',
                                                                  'separator'=>' | ',
                                                                  'onchange'=>'{
                                                                                window.arreglo['.$j.']=$(this).val();
                                                                                updateTag('.$i.');
                                                                                }')).$form->error($model, 'NOTA',array('name'=>'NOTA['.$j.'][NOTA]')).
                '</td>
                </tr>';
             $model->ITEM_ID_ITEM=$sql2[$j]['item_id_item'];
             echo $form->hiddenField($model,'ITEM_ID_ITEM',array('name'=>'NOTA['.$j.'][ITEM_ID_ITEM]'));
             
             $model->TRABAJO_ID_TRABAJO=$id_trabajo;
             echo $form->hiddenField($model,'TRABAJO_ID_TRABAJO',array('name'=>'NOTA['.$j.'][TRABAJO_ID_TRABAJO]'));
             echo '<tr><td></td><td id="AjaxLoader'.$j.'" style="display: none; color:red; font-size: small;">Rellenar</td></tr>';
             
            }
        }
       }       
 }?>
    </table>
    <div id="ErrorEval" style="display: none; color: red;">Faltaron ítems por evaluar, por favor complete los datos faltantes</div>
    <div id="AjaxLoaderS" style="display: none">Guardando evaluación<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/spinner.gif"></div>
    <div id="AjaxLoaderE" style="display: none">Cancelando evaluación<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/spinner.gif"></div>

    <div colspan="2" class="row buttons">
        <?php echo CHtml::ajaxSubmitButton(Yii::t('nota','Evaluar'),
                                            CHtml::normalizeUrl(array('nota/addnewevaluacion','render'=>false)),
                                            array("success"=>"function(html,textStatus,jqXHR) {
                                                $('#AjaxLoaderS').hide();
                                                    if (html.indexOf('{')==0) {
                                                       $('#ErrorEval').show();
                                                          
                                                    }
                                                    else {
                                                        
                                                        $('#dialogEvaluacion').dialog('close');
                                                        $('#showDialogEvaluacion').hide();
                                                        }
                                                    }",
                                                'error'=>"function(html) {
                        
                                                    jQuery('#nota-form').ajaxvalidationmessages('hide');
                        
                                                }",'beforeSend'=>'js:function(){
                                                   $("#AjaxLoaderS").show();
                                                   for(var i=0;i<window.arreglo.length;i++){
                                                            if(window.arreglo[i]==101)
                                                                $("#AjaxLoader"+i).show();
                                                            else
                                                                $("#AjaxLoader"+i).hide();  
                                                        } 
                                                }'),array('id'=>'closeEvaluacionDialog'));?>
        
        <?php echo CHtml::ajaxSubmitButton(Yii::t('','Cancelar'),
                                            CHtml::normalizeUrl(array('trabajo/Delete','id'=>$id_trabajo,'render'=>false)),
                                            array("success"=>"function(html,textStatus,jqXHR) {
                                                                $('#SubButton').show();
                                                                $('#HideSubButton').hide();
                                                                $('#dialogEvaluacion').dialog('close');
                                                                $('#showDialogEvaluacion').hide();
                                                                
                                                            }",
                                                'beforeSend'=>'js:function(){
                                                   $("#AjaxLoaderE").show();
                                                }'),array('id'=>'cancelEvaluacionDialog'));?>
        
         
    </div>
       
<?php $this->endWidget(); ?>
 
</div>
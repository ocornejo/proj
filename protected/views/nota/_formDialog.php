<div class="form" id="evaluacionDialogForm">
 
<?php 
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/jquery.css');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'nota-form',
    'enableAjaxValidation'=>true,
)); 


?> 

    <table valign="top" style="font-size:large;"> 
        <tr>
            <td> <?php echo CHtml::activeLabel(Trabajo::model(), 'ASEO_ID_ASEO'); ?></td>
            <td><?php echo Chtml::textField('tipoAseo', Aseo::model()->FindByPk($id_aseo)->TIPO_ASEO, array('style' => 'width:60px', 'readonly' => 'readonly')); ?></td>

            <td><?php echo CHtml::activeLabel(Flota::model(), 'NOMBRE_FLOTA'); ?></td>
            <td> <?php echo Chtml::textField('nombreFlota', Flota::model()->findByPk($id_flota)->NOMBRE_FLOTA, array('style' => 'width:40px', 'readonly' => 'readonly')); ?></td>    
            <td><?php echo CHtml::label('Nota Final', 'notaFinal'); ?></td>
            <td> <?php echo Chtml::textField('NotaFinal',0, array('style' => 'width:40px', 'readonly' => 'readonly')); ?></td>
        </tr>
    </table>
    <table valign="top" style="font-size:large;">
 <?php for ($i = 0; $i < count($sql); $i++) {
       
     if((int)$sql[$i]['ponderacion']!=0){
        echo '<tr><td><br></td></tr> 
              <tr>
                    <td><h1>'.CHtml::label($sql[$i]['nombre'].'  '.$sql[$i]['ponderacion'].'%', 'nombre', array('id'=>'nombre['.$i.']')).'</h1></td>
                    <td><h1>'.CHtml::label('0%', 'ponderacion',array('id'=>'notaPond['.$i.']')).'</h1></td>
                </tr>';
        for ($j = $i; $j < count($sql2); $j++) {
            if($sql2[$j]['evaluacion_id_evaluacion']==$sql[$i]['id_evaluacion']){
                echo '<tr>
                <td>'. CHtml::label($sql2[$j]['nombre'], 'nombreItem') .'</td>
                <td>'. $form->radioButtonList($model,'NOTA', array('0'=>'1','0.25'=>'2','0.5'=>'3','0.75'=>'4','1'=>'5'), 
                                                            array('name'=>'NOTA['.$j.'][NOTA]',
                                                                  'separator'=>' | ',
                                                                  'onchange'=>'{
                                                                                if(window.global==1){
                                                                                    inicia('.json_encode($sql2).');
                                                                                    window.global=0;
                                                                                }
                                                                                window.arreglo['.$j.']=$(this).val();
                                                                                updateTag('.$i.','.json_encode($sql2).','.json_encode($sql).');
                                                                                }')) .
                      $form->error($model,'NOTA').
                '</td>
                </tr>';
             $model->ITEM_ID_ITEM=$sql2[$j]['item_id_item'];
             echo $form->hiddenField($model,'ITEM_ID_ITEM',array('name'=>'NOTA['.$j.'][ITEM_ID_ITEM]'));
             $model->TRABAJO_ID_TRABAJO=1;
             echo $form->hiddenField($model,'TRABAJO_ID_TRABAJO',array('name'=>'NOTA['.$j.'][TRABAJO_ID_TRABAJO]'));
            }
        }
       }       
 }?>
    </table>
    
    <div class="row buttons">
        <?php echo CHtml::ajaxSubmitButton(Yii::t('nota','Evaluar'),CHtml::normalizeUrl(array('nota/addnewevaluacion','render'=>false)),array('success'=>'js: function(data) {
                        
                        $("#dialogEvaluacion").dialog("close");
                    }'),array('id'=>'closeEvaluacionDialog'));?>
    </div>
<?php $this->endWidget(); ?>
 
</div>
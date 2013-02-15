<div class="form" id="evaluacionDialogForm">
 
<?php 
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
//document.getElementById('nombre[0]').innerHTML='hola';
$cs->registerCssFile($baseUrl.'/css/jquery.css');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'nota-form',
    'enableAjaxValidation'=>true,
)); 


?> 

<script type="text/javascript">
        window.arreglo= new Array();
        window.global=1;
        function inicia(var1){
            
            for(var i=0;i<var1.length;i++){
                window.arreglo[i]=0;
                console.log("llenando: "+window.arreglo[i]);
            }
        }
        function updateTag(var1,var2){
            final=0;
            count=0;
            total=0;
            var1=var1+1;
            
            for(var j=0;j<var2.length;j++){
                if(var2[j]['evaluacion_id_evaluacion'] == var1){
                    count=count+1;
                    total = total + parseInt(window.arreglo[j]);
                    console.log("total :"+total);
                }
           }
           
           final=total/count;
           console.log("final: "+final);
           variable1= "nombre["+var1+"]";
           <?php //print("console.log(variable1);");?>
           document.getElementById(variable1).innerHTML='hola';


        }
        
        
        </script>    
 

    <table valign="top" style="font-size:large;"> 
        <tr>
            <td> <?php echo CHtml::activeLabel(Trabajo::model(), 'ASEO_ID_ASEO'); ?></td>
            <td><?php echo Chtml::textField('tipoAseo', Aseo::model()->FindByPk($id_aseo)->TIPO_ASEO, array('style' => 'width:60px', 'readonly' => 'readonly')); ?></td>

            <td><?php echo CHtml::activeLabel(Flota::model(), 'NOMBRE_FLOTA'); ?></td>
            <td> <?php echo Chtml::textField('nombreFlota', Flota::model()->findByPk($id_flota)->NOMBRE_FLOTA, array('style' => 'width:40px', 'readonly' => 'readonly')); ?></td>    
        </tr>
    </table>
    <table valign="top" style="font-size:large;">
 <?php for ($i = 0; $i < count($sql); $i++) {
     if((int)$sql[$i]['ponderacion']!=0){
        echo '<tr><td><br></td></tr> 
              <tr>
                    <td><h1>'.CHtml::label($sql[$i]['nombre'], 'nombre', array('id'=>'nombre['.$i.']')).'</h1></td>
                    <td><h1>'.CHtml::label($sql[$i]['ponderacion'].'%', 'ponderacion').'</h1></td>
                </tr>';
        for ($j = $i; $j < count($sql2); $j++) {
            if($sql2[$j]['evaluacion_id_evaluacion']==$sql[$i]['id_evaluacion']){
                echo '<tr>
                <td>'. CHtml::label($sql2[$j]['nombre'], 'nombreItem') .'</td>
                <td>'. $form->radioButtonList($model,'NOTA', array('0'=>'1','1'=>'2','2'=>'3','3'=>'4','4'=>'5'), array('name'=>$sql2[$j]['item_id_item'],'id'=>'item['.$j.']','separator'=>' | ','onchange'=>'{
                                                                                                                                                                                                               if(window.global==1){
                                                                                                                                                                                                                    inicia('.json_encode($sql2).');
                                                                                                                                                                                                                    window.global=0;
                                                                                                                                                                                                               } 
                                                                                                                                                                                                                
                                                                                                                                                                                                               updateTag('.$i.','.json_encode($sql2).');
                                                                                                                                                                                                                    
                                                                                                                                                                                                                window.arreglo['.$j.']=$(this).val();
                                                                                                                                                                                                                }')) .'</td>
                
                </tr>';
                
            }
        }
       }
//        
 }?>
    </table>
    

<?php $this->endWidget(); ?>
 
</div>
<?php

$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/jquery.css');
  
$this->pageTitle=Yii::app()->name . ' - Críticos';
$this->breadcrumbs=array(
	'Críticos',
);


?>

<h1>Críticos</h1>

<div class="form">
    <div class="span-20">
<?php 
   

 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'avion-grid',
	'dataProvider'=>$model->searchAvion(),
	'filter'=>$model,
	'columns'=> array(
                        array(
                            'name'=>'MATRICULA',
                            'type'=>'raw',
                            'filter'=>$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                'model'=>$model,
                                'attribute'=>'MATRICULA',
                                'source'=>$this->createUrl('request/suggestMatricula'),
                                'options'=>array(
                                    'focus'=>"js:function(event, ui) {
                                        $('#".CHtml::activeId($model,'MATRICULA')."').val(ui.item.value);
                                    }",
                                    'select'=>"js:function(event, ui) {
                                        $.fn.yiiGridView.update('avion-grid', {
                                            data: $('#avion-grid .filters input, #avion-grid .filters select').serialize()
                                        });
                                    }"
                                ),
                            ),true),
                            'htmlOptions'=>array('style' => 'text-align: center;'),
                        ),
                        array(
                            'name'=> 'FLOTA_ID_FLOTA',
                            'header'=>'Flota',
                            'value'=>'$data->fLOTAIDFLOTA->NOMBRE_FLOTA', // this will access the current group's 1st member and give out the firstname of that member
                            'filter'=>Flota::model()->options,
                            'htmlOptions'=>array('style' => 'text-align: center;'),
                        ),
                        array(
                            'name'=>'alfombra_count',
                            'value'=>function($data){

                                            if(Criticos::model()->exists("ASEO_ID_ASEO=2 AND FLOTA_ID_FLOTA='".$data->FLOTA_ID_FLOTA."'")){
                                                $lim1 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>2))->LIMITE1;
                                                $lim2 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>2))->LIMITE2;
                                                $lim3 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>2))->LIMITE3;
                                                
                                                
                                                if($data->alfombra_count>$lim3)
                                                    $value= CHtml::link($data->alfombra_count,array("trabajo/index"),array("style"=>"color: red;font-weight:bold;font-size:medium;"));
                                                elseif($data->alfombra_count>$lim2)
                                                    $value= CHtml::link($data->alfombra_count,array("trabajo/index"),array("style"=>"color: orange;font-weight:bold;font-size:medium; "));
                                                else
                                                    $value= CHtml::link($data->alfombra_count,array("trabajo/index"),array("style"=>"color: green;font-weight:bold;font-size:medium;"));
                                                return $value;
                                            }

                                        return $value; 
                                     },
                            'type'=>'raw',
                            'htmlOptions'=>array('style' => 'text-align: center;'),
                        ),
                        'fuselaje_count',
                        'profundo_count',
                        'tapiz_count',
                        'banos_count',
//                        array(
//                            'name'=>'ASEO.TIPO_ASEO',
//                            'header'=>Aseo::model()->findByPk(2)->TIPO_ASEO,
//                            'value'=>function($data){
//                                        
//                                        if(Trabajo::model()->exists("ASEO_ID_ASEO=2 AND AVION_MATRICULA='".$data->MATRICULA."'")){
//                                           
//                                            $result=Trabajo::model()->findAllByAttributes(array("ASEO_ID_ASEO"=>2,"AVION_MATRICULA"=>$data->MATRICULA),array('order'=>'FECHA DESC','limit'=>1));
//                                            
//                                            $date= new DateTime($result[0]['FECHA']);
//                                            $dateNow =new DateTime();
//                                            $interval= $date->diff($dateNow)->d;
//                                            if(Criticos::model()->exists("ASEO_ID_ASEO=2 AND FLOTA_ID_FLOTA='".$data->FLOTA_ID_FLOTA."'")){
//                                                $lim1 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>2))->LIMITE1;
//                                                $lim2 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>2))->LIMITE2;
//                                                $lim3 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>2))->LIMITE3;
//                                                
//                                                
//                                                if($interval>$lim3)
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: red; background-color:#E54242;"));
//                                                elseif($interval>$lim2)
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: orange; background-color:#F66E2A; "));
//                                                else
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: green; background-color:#10F500;"));
//                                                return $value;
//                                            }
//                                            else
//                                                $value="";
//                                        }
//                                        else
//                                            $value="";
//                                        
//                                        return $value; 
//                                     },
//                               'type'=>'raw',
//                               'htmlOptions'=>array('style' => 'text-align: center;'),
//                        ),
//                        array(
//                            'name'=>'ASEO.TIPO_ASEO',
//                            'header'=>Aseo::model()->findByPk(4)->TIPO_ASEO,
//                            'value'=>function($data){
//                                        if(Trabajo::model()->exists("ASEO_ID_ASEO=4 AND AVION_MATRICULA='".$data->MATRICULA."'")){
//                                            $result=Trabajo::model()->findAllByAttributes(array("ASEO_ID_ASEO"=>4,"AVION_MATRICULA"=>$data->MATRICULA),array('order'=>'FECHA DESC','limit'=>1));
//                                            
//                                            $date= new DateTime($result[0]['FECHA']);
//                                            $dateNow =new DateTime();
//                                            $interval= $date->diff($dateNow)->d;
//                                            if(Criticos::model()->exists("ASEO_ID_ASEO=4 AND FLOTA_ID_FLOTA='".$data->FLOTA_ID_FLOTA."'")){
//                                                $lim1 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>4))->LIMITE1;
//                                                $lim2 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>4))->LIMITE2;
//                                                $lim3 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>4))->LIMITE3;
//                                                if($interval>$lim3)
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: red; background-color:#E54242;"));
//                                                elseif($interval>$lim2)
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: orange; background-color:#F66E2A;"));
//                                                else
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: green;background-color:#10F500;"));
//                                                return $value;
//                                            }
//                                            else
//                                                $value="-";
//                                        }
//                                        else
//                                            $value="-";
//                                        return $value; 
//                                     },
//                               'type'=>'html',
//                               'htmlOptions'=>array('style' => 'text-align: center;'),
//                        ),
//                        array(
//                            'name'=>'ASEO.TIPO_ASEO',
//                            'header'=>Aseo::model()->findByPk(5)->TIPO_ASEO,
//                            'value'=>function($data){
//                                        if(Trabajo::model()->exists("ASEO_ID_ASEO=5 AND AVION_MATRICULA='".$data->MATRICULA."'")){
//                                            //$result=Trabajo::model()->findAllByAttributes(array("ASEO_ID_ASEO"=>2,"AVION_MATRICULA"=>"BAL"),array('order'=>'FECHA DESC','limit'=>1));
//                                            $result=Trabajo::model()->findAllByAttributes(array("ASEO_ID_ASEO"=>5,"AVION_MATRICULA"=>$data->MATRICULA),array('order'=>'FECHA DESC','limit'=>1));
//                                            
//                                            $date= new DateTime($result[0]['FECHA']);
//                                            $dateNow =new DateTime();
//                                            $interval= $date->diff($dateNow)->d;
//                                            if(Criticos::model()->exists("ASEO_ID_ASEO=5 AND FLOTA_ID_FLOTA='".$data->FLOTA_ID_FLOTA."'")){
//                                                $lim1 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>5))->LIMITE1;
//                                                $lim2 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>5))->LIMITE2;
//                                                $lim3 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>5))->LIMITE3;
//                                                if($interval>$lim3)
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: red; background-color:#E54242;"));
//                                                elseif($interval>$lim2)
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: orange; background-color:#F66E2A;"));
//                                                else
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: green;background-color:#10F500;"));
//                                                return $value;
//                                            }
//                                            else
//                                                $value="-";
//                                        }
//                                        else
//                                            $value="-";
//                                        return $value; 
//                                     },
//                               'type'=>'html',
//                               'htmlOptions'=>array('style' => 'text-align: center;'),
//                        ),
//                        array(
//                            'name'=>'ASEO.TIPO_ASEO',
//                            'header'=>Aseo::model()->findByPk(6)->TIPO_ASEO,
//                            'value'=>function($data){
//                                        if(Trabajo::model()->exists("ASEO_ID_ASEO=6 AND AVION_MATRICULA='".$data->MATRICULA."'")){
//                                            //$result=Trabajo::model()->findAllByAttributes(array("ASEO_ID_ASEO"=>2,"AVION_MATRICULA"=>"BAL"),array('order'=>'FECHA DESC','limit'=>1));
//                                            $result=Trabajo::model()->findAllByAttributes(array("ASEO_ID_ASEO"=>6,"AVION_MATRICULA"=>$data->MATRICULA),array('order'=>'FECHA DESC','limit'=>1));
//                                            
//                                            $date= new DateTime($result[0]['FECHA']);
//                                            $dateNow =new DateTime();
//                                            $interval= $date->diff($dateNow)->d;
//                                            if(Criticos::model()->exists("ASEO_ID_ASEO=6 AND FLOTA_ID_FLOTA='".$data->FLOTA_ID_FLOTA."'")){
//                                                $lim1 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>6))->LIMITE1;
//                                                $lim2 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>6))->LIMITE2;
//                                                $lim3 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>6))->LIMITE3;
//                                                if($interval>$lim3)
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: red; background-color:#E54242;"));
//                                                elseif($interval>$lim2)
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: orange; background-color:#F66E2A;"));
//                                                else
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: green;background-color:#10F500;"));
//                                                return $value;
//                                            }
//                                            else
//                                                $value="-";
//                                        }
//                                        else
//                                            $value="-";
//                                        return $value; 
//                                     },
//                               'type'=>'html',
//                               'htmlOptions'=>array('style' => 'text-align: center;'),
//                        ),
//                        array(
//                            'name'=>'ASEO.TIPO_ASEO',
//                            'header'=>Aseo::model()->findByPk(8)->TIPO_ASEO,
//                            'value'=>function($data){
//                                        if(Trabajo::model()->exists("ASEO_ID_ASEO=8 AND AVION_MATRICULA='".$data->MATRICULA."'")){
//                                            //$result=Trabajo::model()->findAllByAttributes(array("ASEO_ID_ASEO"=>2,"AVION_MATRICULA"=>"BAL"),array('order'=>'FECHA DESC','limit'=>1));
//                                            $result=Trabajo::model()->findAllByAttributes(array("ASEO_ID_ASEO"=>8,"AVION_MATRICULA"=>$data->MATRICULA),array('order'=>'FECHA DESC','limit'=>1));
//                                            
//                                            $date= new DateTime($result[0]['FECHA']);
//                                            $dateNow =new DateTime();
//                                            $interval= $date->diff($dateNow)->d;
//                                            if(Criticos::model()->exists("ASEO_ID_ASEO=8 AND FLOTA_ID_FLOTA='".$data->FLOTA_ID_FLOTA."'")){
//                                                $lim1 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>8))->LIMITE1;
//                                                $lim2 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>8))->LIMITE2;
//                                                $lim3 = Criticos::model()->findByAttributes(array("FLOTA_ID_FLOTA"=>$data->FLOTA_ID_FLOTA,"ASEO_ID_ASEO"=>8))->LIMITE3;
//                                                if($interval>$lim3)
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: red; background-color:#E54242;"));
//                                                elseif($interval>$lim2)
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: orange; background-color:#F66E2A;"));
//                                                else
//                                                    $value= CHtml::link($interval,array("trabajo/view","id"=>$result[0]['ID_TRABAJO']),array("style"=>"color: green;background-color:#10F500;"));
//                                                return $value;
//                                            }
//                                            else
//                                                $value="-";
//                                        }
//                                        else
//                                            $value="-";
//                                        return $value; 
//                                     },
//                               'type'=>'html',
//                               'htmlOptions'=>array('style' => 'text-align: center;'),
//                        ),
        ),

        'afterAjaxUpdate'=>"function(){
            jQuery('#".CHtml::activeId($model,'MATRICULA')."').autocomplete({
                'delay':300,
                'minLength':1,
                'source':'".$this->createUrl('request/suggestMatricula')."',
                'focus':function(event, ui) {
                    $('#".CHtml::activeId($model,'MATRICULA')."').val(ui.item.value);
                },
                'select':function(event, ui) {
                    $.fn.yiiGridView.update('avion-grid', {
                        data: $('#avion-grid .filters input, #avion-grid .filters select').serialize()
                    });
                }
            });
        }",
)); 
    
?>
   </div>
</div>

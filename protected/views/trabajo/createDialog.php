<?php
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/jquery.css');

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'dialogEvaluacion',
                'options'=>array(
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'900',
                    'height'=>'auto',
                    'resizable' => false,
                    'draggable' => false,
                    'closeOnEscape'=>false,
                   // 'open'=> 'js:function(event, ui) { $(".ui-dialog-titlebar-close").hide(); }',
                ),
                ));



   
echo $this->renderPartial('_formDialog', array('model'=>$model,
                                                'id_aseo'=>$id_aseo,
                                                'id_flota'=>$id_flota,
                                                'sql2'=>$sql2,
                                                'sql'=>$sql,
                                                'id_trabajo'=>$id_trabajo));

?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>


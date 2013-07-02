<?php $this->pageTitle=Yii::app()->name . ' - Ingresar aseo';
$this->breadcrumbs=array(
	'Trabajos'=>array('index'),
        'Masiva',
);?>

<h1>Subida masiva de aseos</h1>

<div class="flash-notice">
Para subir los aseos planificados use
<a  href="<?php echo $this->createUrl('site/DownloadPlanFile') ;?>"  target="helperFrame" >esta</a> plantilla excel
</div>	
    <?php if($success==true && $success!=3):?>
        <div class="flash-success" id="success" style="display: block;">Los aseos han sido guardados con éxito.</div>
    <?php endif;?>
        <?php if($success===3):?>
        <div class="flash-error" id="failed" style="display: block;">La plantilla cargada posee errores.</div>
    <?php endif;?>
    

<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl('trabajo/masiva'),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        ),
        'clientOptions' => array(
            'validateOnSubmit' => true,
       ))); ?>


	<?php //echo $form->errorSummary($model); ?>

	<?php $this->widget('CMultiFileUpload',array(
		'name'=>'files',
		'accept'=>'xls',
		'max'=>3,
		'remove'=>Yii::t('ui','Remove'),
		//'denied'=>'', message that is displayed when a file type is not allowed
		//'duplicate'=>'', message that is displayed when a file appears twice
		'htmlOptions'=>array('size'=>25),
	)); ?>
	<br />

	<div class="row buttons">
		<?php echo CHtml::submitButton('Cargar'); ?>
	</div>

<?php $this->endWidget(); ?>









<script type="text/javascript">
// close the div in 5 secs
window.setTimeout("closeSuccessDiv();", 3500);

function closeSuccessDiv(){
document.getElementById("success").style.display=" none";
}
</script>  


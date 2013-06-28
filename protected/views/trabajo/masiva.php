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
    <?php if($success==true):?>
        <div class="flash-success" id="success" style="display: block;">Los aseos han sido guardados con éxito.</div>
    <?php endif;?>
        <?php if($success=='error'):?>
        <div class="flash-error" id="error" style="display: block;">La plantilla cargada tiene errores de formato.</div>
    <?php endif;?>
    
<?php echo CHtml::form($this->createUrl('trabajo/masiva'),'post',array('enctype'=>'multipart/form-data')); ?>

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
<?php echo CHtml::submitButton(Yii::t('ui', 'Cargar')); ?>&nbsp;

<?php echo CHtml::endForm(); ?>

<script type="text/javascript">
// close the div in 5 secs
window.setTimeout("closeSuccessDiv();", 3500);

function closeSuccessDiv(){
document.getElementById("success").style.display=" none";
}
</script>  


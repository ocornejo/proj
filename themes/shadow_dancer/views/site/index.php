<style>
div.centre
{
  width: 630px;
  display: boxes;
  margin-left: auto;
  margin-right: auto;
  
}
div.boxes
{ 
width:170px;
height:175px;
background-color: #F9F9F9;
border:1px solid grey;
float: left;
text-align:center;
padding-bottom: 30px;
font-family:Arial,Helvetica,sans-serif;
      -moz-border-radius-topright:5px;
      -moz-border-radius-topleft:5px;
      -webkit-border-top-right-radius:5px;
      -webkit-border-top-left-radius:5px;
margin:15px;
}
div.boxes label{
 
 width:170px;
 height: 125px;
 float: start;
 display: block;
 font-size: 80px;
 margin: 0 auto;
 box-shadow: 5px -25px 50px -20px #E0E0E0 inset;


}
div.boxes p{
    font-size: 23px;
    background:#002955;
    color:white;
    padding:10px;
    
}
</style>




<?php $this->pageTitle=Yii::app()->name;
      $today= date('Y-m-d');
      $from= date('Y-m-d', strtotime($today . ' - 1 day'));
      $to= date('Y-m-d', strtotime($from . ' + 2 day'));
      $variable= $model->findAll(array('condition'=>'PLANIFICADO=1 AND FECHA BETWEEN :from_date AND :to_date','order'=>'FECHA','params'=>array(':from_date'=>$from,':to_date'=>$to)));
      $pendientes= $model->findAll(array('condition'=>'ESTADO_ID_ESTADO=2 AND FECHA BETWEEN :from_date AND :to_date','order'=>'FECHA','params'=>array(':from_date'=>$from,':to_date'=>$to)));
      $desasignados= $model->findAll(array('condition'=>'ESTADO_ID_ESTADO>=3 AND ESTADO_ID_ESTADO<=8 AND FECHA BETWEEN :from_date AND :to_date','order'=>'FECHA','params'=>array(':from_date'=>$from,':to_date'=>$to)));
      ?>


<div class="flash-error"><b>AVISO:</b> Página web en construcción.</div>
<div class="flash-notice"><b>RECOMENDACIÓN:</b> Para un mejor funcionamiento, usar Google Chrome o Mozilla Firefox.</div>

<p style="font-size: medium;">Trabajos del día</p>

<div class="centre">
<a href="index.php?r=trabajo/adminPlan">
<div class="boxes">
    
    <p>Planificados</p>
    <label><?php echo count($variable);?></label>
   
</div> 
</a>
<a href="index.php?r=trabajo/adminPend">
<div class="boxes">
    <p>Pendientes</p>
    <label><?php echo count($pendientes);?></label>
</div>
</a>    
<a href="index.php?r=trabajo/adminDesa">
<div class="boxes">
    <p>Desasignados</p>
    <label><?php echo count($desasignados);?></label>
</div>
</a> 
</div>

<div class="hr" style="margin-top: 280px;"><hr /></div>

<?php
echo $this->renderPartial('gantt',array(
                                        'model'=>$model,
                                        'variable'=>$variable,
                                        'from'=>$from,
                                        'to'=>$to,
                                        false,true));?>

  
    
    

   
    
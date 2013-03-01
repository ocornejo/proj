<style>
    
div.centre
{
  width: 600px;
  display: boxes;
  margin-left: auto;
  margin-right: auto;
  
}
div.boxes
{
   
width:170px;
height:170px;
background-color: #F9F9F9;

border:1px solid grey;
float: left;
text-align:center;
font-family:Arial,Helvetica,sans-serif;
      -moz-border-radius-topright:5px;
      -moz-border-radius-topleft:5px;
      -webkit-border-top-right-radius:5px;
      -webkit-border-top-left-radius:5px;
}
div.boxes label{
 
 width:170px;
 height: 89px;
 display:boxes;
 float:left;
 font-size: 100px;
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

<?php $this->pageTitle=Yii::app()->name; ?>

<h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>


<div class="centre">
<div class="boxes">
    <p>Planificados</p>
    <label>8</label>
</div>
<div class="boxes">
    <p>Pendientes</p>
    <label>9</label>
</div>
<div class="boxes">
    <p>Desasignados</p>
    <label>10</label>
</div>
    </div>
<?php
echo $this->renderPartial('gantt',array('model'=>$model),false,true);
?>

  
    
    

   
    
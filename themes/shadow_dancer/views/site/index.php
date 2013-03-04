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

<?php $this->pageTitle=Yii::app()->name; ?>


<div class="flash-error"><b>AVISO:</b> Página web en construcción.</div>


<div class="centre">
<div class="boxes">
    <p>Planificados</p>
    <label>10</label>
</div>
<div class="boxes">
    <p>Pendientes</p>
    <label>9</label>
</div>
<div class="boxes">
    <p>Desasignados</p>
    <label>1</label>
</div>
    </div>
<?php
echo $this->renderPartial('gantt',array('model'=>$model),false,true);
?>

  
    
    

   
    
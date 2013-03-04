     <?php  
      $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCSSFile($baseUrl . '/protected/extensions/gantt/css/style.css');
    $cs->registerCSSFile("http://taitems.github.com/UX-Lab/core/css/prettify.css");
    $cs->registerScriptFile($baseUrl . '/protected/extensions/gantt/js/jquery-1.7.2.min.js');
    $cs->registerScriptFile($baseUrl . '/protected/extensions/gantt/js/jquery.fn.gantt.js');
    $cs->registerScriptFile($baseUrl . '/protected/extensions/gantt/js/bootstrap-tooltip.js');
    $cs->registerScriptFile($baseUrl . '/protected/extensions/gantt/js/bootstrap-popover.js');
    $cs->registerScriptFile($baseUrl . '/protected/extensions/gantt/js/prettify.js');
    $from= date('Y-m-d');
    $to= date('Y-m-d', strtotime($from . ' + 1 day'));
    $variable= $model->findAll(array('condition'=>'PLANIFICADO=1 AND FECHA BETWEEN :from_date AND :to_date','order'=>'FECHA','params'=>array(':from_date'=>$from,':to_date'=>$to)));

    ?>
<div class="span-23">
    <h1>Planificados para hoy <?php echo date('d-m-Y'); ?></h1>
    
    <?php if(count($variable)>0):?>
        <div>
           <div class="gantt"></div>   
	</div>
    <?php endif;?>
        
    <?php if(count($variable)==0):?>
        <div class="flash-notice"><b>Aviso:</b> No hay aseos planificados para hoy.</div>
    <?php endif;?>

</div>


    
        <script type="text/javascript">

		$(function() {

			"use strict";
                       
			$(".gantt").gantt({
                            
				source: [
                                    
                          <?php
                          
                          foreach($variable as $value){
                              $horaInicio = date('Y-m-d H:i:s',  strtotime($value->FECHA.' '.$value->HORA_INICIO));
                              $finalInicio= strtotime($horaInicio)*1000;
                              $horaFinal = date('Y-m-d H:i:s',  strtotime($value->FECHA.' '.$value->HORA_TERMINO));
                              $finalFinal = strtotime($horaFinal)*1000;
                              print('         
                                {
					name: "'.$value->AVION_MATRICULA.'",
					desc: "'.Flota::model()->findByPk(Avion::model()->findByPk($value->AVION_MATRICULA)->FLOTA_ID_FLOTA)->NOMBRE_FLOTA.'",
					values: [{
						from: "/Date('.$finalInicio.')/",
						to: "/Date('.$finalFinal.')/",
						label: "'.Aseo::model()->findByPk($value->ASEO_ID_ASEO)->TIPO_ASEO.'", 
						customClass: "ganttGreen"
					}]
                          },');
                          
                          }
                          ?>
                            
                                ],
				navigate: "scroll",
				scale:"hours",
				maxScale: "days",
				minScale: "hours",
				itemsPerPage: 8,
				onItemClick: function(data){
					alert("Item clicked - show some details");
				},
				onAddClick: function(dt, rowId){
					alert("Empty space clicked - add an item!");
				},
				onRender: function() {
					if (window.console && typeof console.log === "function") {
						console.log("chart rendered");
					}
				}
			});

			$(".gantt").popover({
				selector: ".bar",
				title: "I'm a popover",
				content: "And I'm the content of said popover.",
				trigger: "hover"
			});

			prettyPrint();

		});

    </script>

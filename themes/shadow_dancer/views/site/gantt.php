     <?php  
      $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCSSFile($baseUrl . '/protected/extensions/gantt/css/style.css');
    $cs->registerCSSFile($baseUrl . '/protected/extensions/gantt/css/prettify.css');
    $cs->registerScriptFile($baseUrl . '/protected/extensions/gantt/js/jquery-1.7.2.min.js');
    $cs->registerScriptFile($baseUrl . '/protected/extensions/gantt/js/jquery.fn.gantt.js');
    $cs->registerScriptFile($baseUrl . '/protected/extensions/gantt/js/bootstrap-tooltip.js');
    $cs->registerScriptFile($baseUrl . '/protected/extensions/gantt/js/bootstrap-popover.js');
    $cs->registerScriptFile($baseUrl . '/protected/extensions/gantt/js/prettify.js');
 
    ?>


               <script type="text/javascript">

		$(function() {

			"use strict";
                       
			$(".gantt").gantt({
                            
				source: [
                                    
                          <?php
                          $aviso=false;
                          foreach($variable as $value){
                                    
                                    $horaInicio = date('Y-m-d H:i:s',  strtotime($value->FECHA.' '.$value->HORA_INICIO));
                                    $finalInicio= strtotime($horaInicio)*1000;
                                    $horaFinal = date('Y-m-d H:i:s',  strtotime($value->FECHA.' '.$value->HORA_TERMINO));
                                    $finalFinal = strtotime($horaFinal)*1000;
                                     if($value->HORA_INICIO!=NULL){
                                     print('         
                                      {
                                              name: "'.$value->AVION_MATRICULA.'",
                                              desc: "'.Flota::model()->findByPk(Avion::model()->findByPk($value->AVION_MATRICULA)->FLOTA_ID_FLOTA)->NOMBRE_FLOTA.'",
                                              values: [{
                                                      from: "/Date('.$finalInicio.')/",
                                                      to: "/Date('.$finalFinal.')/",
                                                      label: "'.Aseo::model()->findByPk($value->ASEO_ID_ASEO)->TIPO_ASEO.'-'.Estado::model()->findByPk($value->ESTADO_ID_ESTADO)->NOMBRE_ESTADO.'", 
                                                      customClass: "ganttGreen"
                                              }]
                                },');
                                     }
                                     else{
                                     print('         
                                      {
                                              name: "'.$value->AVION_MATRICULA.'",
                                              desc: "'.Flota::model()->findByPk(Avion::model()->findByPk($value->AVION_MATRICULA)->FLOTA_ID_FLOTA)->NOMBRE_FLOTA.'",
                                              values: [{
                                                      from: "/Date('.$finalInicio.')/",
                                                      to: "/Date('.($finalFinal+83400000).')/",
                                                      label: "'.Aseo::model()->findByPk($value->ASEO_ID_ASEO)->TIPO_ASEO.'-Aseo sin hora-'.Estado::model()->findByPk($value->ESTADO_ID_ESTADO)->NOMBRE_ESTADO.'", 
                                                      customClass: "ganttOrange"
                                              }]
                                },');
                                     }
                          }
                          ?>
                            
                                ],
				navigate: "scroll",
				scale:"hours",
				maxScale: "days",
				minScale: "hours",
				itemsPerPage: 8,
				onItemClick: function(data){
					alert("Aseo cabina");
				},
				onAddClick: function(dt, rowId){
					
				},
				onRender: function() {
					if (window.console && typeof console.log === "function") {
						console.log("chart rendered");
					}
				}
			});

			$(".gantt").popover({
				selector: ".bar",
				title: "Aseo",
				content: "Base de Mantto.",
				trigger: "hover"
			});

			prettyPrint();

		});

    </script>
    
    
<div class="span-23">
    <p style="font-size: medium; padding-top: 15px;">Carta Gantt (<?php echo date('d-m-Y'); ?>)</p>
    
    <?php if(count($variable)>0):?>
        <div>
           <div class="gantt"></div>   
	</div>
    <?php endif;?>
        
    <?php if(count($variable)==0):?>
        <div class="flash-notice"><b>Aviso:</b> No hay aseos planificados para hoy.</div>
    <?php endif;?>

</div>
        
    <?php if($aviso==true):?>
        
            <div class="flash-notice"><b>Aviso:</b> Hay aseos planificados sin hora de inicio y término.</div>   
	
          <?php endif;?>



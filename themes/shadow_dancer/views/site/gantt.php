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
                            <?php foreach($variable as $value){
                                    $hinicio_array= explode(':', $value->HORA_INICIO);
                                    $hinicio = $hinicio_array[0].':00:00';
                                    $htermino_array= explode(':', $value->HORA_TERMINO);
                                    $htermino = $htermino_array[0].':00:00';
                                    $horaInicio = date('Y-m-d H:i:s',  strtotime($value->FECHA.' '.$hinicio));
                                    $finalInicio= strtotime($horaInicio)*1000;
                                    $horaFinal = date('Y-m-d H:i:s',  strtotime($value->FECHA.' '.$htermino));
                                    $finalFinal= strtotime($horaFinal)*1000;
                                    if($finalFinal < $finalInicio || $finalFinal==$finalInicio){
                                        
                                        $finalFinal = strtotime($horaFinal.'+ 22 hour')*1000;                                        
                                    }
                                    
                           
                                     print('         
                                      {       name: "'.$value->AVION_MATRICULA.'",
                                              desc: "'.Flota::model()->findByPk(Avion::model()->findByPk($value->AVION_MATRICULA)->FLOTA_ID_FLOTA)->NOMBRE_FLOTA.'",
                                              values: [{
                                                      to: "/Date('.$finalFinal.')/",
                                                      from: "/Date('.$finalInicio.')/",
                                                      label: "'.Aseo::model()->findByPk($value->ASEO_ID_ASEO)->TIPO_ASEO.'-'.Estado::model()->findByPk($value->ESTADO_ID_ESTADO)->NOMBRE_ESTADO.'", 
                                                      customClass: "ganttGreen"
                                              }],
                                },');
                                    
                                  
                          }
                          ?>
                            
                                ],
				navigate: "scroll",
				scale:"hours",
				maxScale: "days",
				minScale: "hours",
				itemsPerPage: 10,
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




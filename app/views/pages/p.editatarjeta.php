<div class="row">
	<?php $tarjeta = "";?>
		<?php foreach ($exec as $data): ?>
	<div class="col-lg-12">
		<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <small>Detalles de ODT, Tarjeta <?php echo $data->TARJETA; ?></small>
                        </h1>   
                        <!--<a href="./image/2016">Fotos</a>-->
                        
                    </div>
                </div>
            <div class="row">
                <div class="col-lg-12 alert-info">
                    <h4><?php echo $data->NOMBRE;?></h4>
                </div>                
            </div>
                <div class="row">
                	<div class="col-lg-12 above">
                		<center><h4>Datos del Reloj</h4></center>
                		<hr />
                		<div class="col-lg-6">
                			<label>MARCA</label>
			                <p class="help-block"><?php echo $data->MARCA;?></p><br />
			                <label>MODELO</label>
			                <p class="help-block"><?php echo $data->MODELO;?></p><br />
			                <label>NUM. CAJA</label>
			                <p class="help-block"><?php echo $data->NO_CAJA;?></p><br />
			                <label>CALIBRE</label>
			                <p class="help-block"><?php echo $data->CALIBRE;?></p><br />
			                <label>MAQUINA</label>
			                <p class="help-block"><?php echo $data->MAQUINA;?></p><br />
                                        <label>FOLIO JOYERÍA</label>
			                <p class="help-block"><?php echo $data->FOLIOJY;?></p><br />
                                        <label>GARANTIA</label>
			                <p class="help-block"><?php echo $data->GARANTIA;?></p><br />
                                        
                		</div>
                		<div class="col-lg-6">
                			<label>MATERIAL CAJA</label>
			                <p class="help-block"><?php echo $data->MAT_CAJA;?></p><br />
			                <label>MATERIAL PULSO</label>
			                <p class="help-block"><?php echo $data->MAT_PULSO;?></p><br />
			                <label>TIPO MAQUINA</label>
			                <p class="help-block"><?php echo $data->TIPO_MAQUINA;?></p><br />
			                <label>DETALLE CAJA</label>
			                <p class="help-block"><?php echo $data->DETALLE_CAJA;?></p><br />
                                        <label>FECHA RECIBIDO</label>
                                        <p class="help-block"><?php echo date('d-m-Y', strtotime($data->ENTRADA_CAJA));?></p><br />
                                        <label>DESCRIPCION RELOJ</label>
                                        <p class="help-block"><?php echo $data->DESCR_RELOJ;?></p><br />
                                        <label>CARATULA</label>
                                        <p class="help-block"><?php echo $data->CARATULA;?></p>
                		</div>
                	</div>
                </div>
			<?php if($data->ESTATUS == 'Finalizado'):?>
				<div class="alert alert-success">ODT Finalizada</div>
			<?php endif;?>
			<form role="form" action="index.php" method="post">
				<div class="col-lg-6">
					<div class="checkbox">
					    <label>
					     <?php if($data->AUTORIZADO != 'Autorizado'):?>	
                                                <div class="col-lg-6">
                                                    <input name="accion" type="radio" value="autorizado"><div class="alert alert-info"><center>Autorizar ODT</center></div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input name="accion" type="radio" value="cancelado"><div class="alert alert-warning"><center>Cancelar ODT</center></div>
                                                </div>                                              
					      <?php else: ?>
					      <p class="help-block"><div class="alert alert-success"><center><?php echo $data->AUTORIZADO;?></center></div></p>
					      <input type="hidden" name="autorizado" value="true" />
					      <?php endif;?>
					    </label>
					  </div>
					<div class="form-group">
		                <label>Tarjeta</label>
		                <p class="help-block"><?php echo $data->TARJETA;?></p>
		                <!--<span class="input-group-addon"><?php echo $data->TARJETA;?></span>-->
		            </div>
				
					<div class="form-group">
			                <label>Cliente</label>
			                <p class="help-block"><?php echo $data->NOMBRE;?></p>
			        </div>
			        <!--<div class="form-group">
			                <label>Marca Reloj</label>
			                <p class="help-block"><?php echo $data->MARCA;?></p>
			        </div>-->
			        <div class="form-group">
			                <label>Referencia</label>
			                <p class="help-block"><?php echo $data->REFERENCIA;?></p>
			                <!--<input name="referencia" id="disabledInput" class="form-control" placeholder="<?php echo $data->REFERENCIA;?>" <?php echo $data->REFERENCIA == '' ? '' : 'disabled' ?>>-->
			                <!--<p class="help-block"><?php echo $data->MARCA;?></p>-->
			        </div>
			        
			        <div class="form-group">			        	
			        	<?php if($data->CVE_SERVICIO == ""):?>
			                <label>Servicios</label><br />
			                <button id="btnserv" class="btn btn-default">Agregar Servicio y Costo</button>
			                <!--<input name="servicio" id="servicio" class="form-control" required="required" placeholder="<?php echo $data->CVE_SERVICIO;?>" <?php echo $data->CVE_SERVICIO == '' ? '' : 'disabled' ?>-->
			            <?php else:?>
			            	<label>Servicio(s) Asignado(s)</label><br />
			            	<table>
			            		<tr>
			            		<th></th>
			            		<th></th>
			            		<th></th>
			            		</tr>
			            		<tr>
			            			<td><p class="help-block"><?php echo $data->CVE_SERVICIO;?></p></td>
			            			<td> <div class="col-md-3"></div> </td>
			            			<td>
			            				<p class="help-block">			            						
			            						<?php echo $data->COSTOS;?>
					            		</p>
				            		</td>
			            		</tr>
			            	</table>
			            	<!--<input type="hidden" name="servicio" value="<?php echo $data->CVE_SERVICIO; ?>" />-->
			            <?php endif;?>          
			        </div><br />
			        
			        <div class="form-group">
			        	<label>Costo Total</label><br />
			                <p class="help-block">$ <?php echo number_format($data->MN, 2, ".", ",");?></p>
			                <!--<input type="hidden" name="costo" value="<?php echo $data->MN;?>" />-->
			        	<!--<?php if($data->MN == 0):?>
			                <label>Costo Total</label>
			                <input name="costo" id="costo" class="form-control" required="required" placeholder="<?php echo $data->MN; ?>" <?php echo $data->MN == '0' ? '' : 'disabled' ?>>
			         <?php else:?>-->
			            	
			            <!--<?php endif;?>		-->	                
			        </div>
                                <div class="form-group">
                                    <label>Enviar por E-Mail</label><br />
                                    <input type="checkbox" name="enviarmail" /> Enviar <br />
                                    <input type="text" name="email" class="form-control" value="<?php echo $data->EMAIL; ?>" /><br />
                                </div>
                                <div class="form-group">
                                    <div class="alert alert-info">
                                       
                                        <center><a href="index.php?action=zoom&ruta=<?php echo $data->RUTA_FOTOS;?>" target="_blank">Ver Fotos</a></center>
                                    </div>                                    
                                </div>
		        </div>
		        <!--Segundo Bloque-->
				<div class="col-lg-6">
					<div class="form-group">
			                <label>Entrada Caja</label>
			                <p class="help-block"><?php echo date('d-m-Y', strtotime($data->ENTRADA_CAJA));?></p>
			                <!--<span class="input-group-addon"><?php echo $data->ENTRADA_CAJA;?></span>-->
			                <!--<input name="entrada_caja" class="form-control" id="datepickerec" type="text" name="fecha" placeholder="<?php echo $data->ENTRADA_CAJA;?>" <?php echo $data->ENTRADA_CAJA == '' ? '' : 'disabled' ?> />-->
			        </div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">				         		                
			                <?php if($data->RECIBE_RELOJERO == '0101-01-01'):?>
			                	<label>Recibe Relojero</label>
			                <input name="recibe_relojero" class="form-control" id="datepickerrr" type="text" />
			                <?php else:?>
			                	<label>Recibe Relojero</label>
			                	<p class="help-block"><?php echo date('d-m-Y', strtotime($data->RECIBE_RELOJERO));?></p>
			                	<input type="hidden" name="recibe_relojero" value="<?php echo $data->RECIBE_RELOJERO;?>" />
			                <?php endif;?>
			                <!--<span class="input-group-addon">$</span>-->
			                <!--<input name="recibe_relojero" class="form-control" id="datepickerrr" type="text" value="<?php echo $data->RECIBE_RELOJERO;?>" placeholder="<?php echo $data->RECIBE_RELOJERO;?>" />-->
			        </div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
					<?php if($data->ENTREGA_RELOJERO == '0101-01-01'):?>
						<?php if($data->RECIBE_RELOJERO == '0101-01-01'):?>
							<label>Entrega Relojero</label>
			                <input name="entrega_relojero" class="form-control" id="datepickerer" type="text" disabled />
						<?php elseif($data->RECIBE_RELOJERO != '0101-01-01'): ?>
							<label>Entrega Relojero</label>
							<input name="entrega_relojero" class="form-control" id="datepickerer" type="text" />			                	
			            <?php endif;?>
			         <?php else:?>
			            	<label>Entrega Relojero</label>
			            	<p class="help-block"><?php echo date('d-m-Y', strtotime($data->ENTREGA_RELOJERO));?></p>
			                <input type="hidden" value="<?php echo $data->ENTREGA_RELOJERO;?>" />
			         <?php endif;?>
			        </div>
			        <div class="form-group">
			        <?php if($data->ENTREGA_CLIENTE == '0101-01-01'):?>
						<?php if($data->ENTREGA_RELOJERO == '0101-01-01'):?>
							<label>Entrega Cliente</label>
			                <input name="entrega_cliente" class="form-control" id="datepickerec" type="text" disabled />
						<?php elseif($data->RECIBE_RELOJERO != '0101-01-01'): ?>
							<label>Entrega Cliente</label>
							<input name="entrega_cliente" class="form-control" id="datepickerec" type="text" />		                	
			            <?php endif;?>
			         <?php else:?>
			            	<label>Entrega Cliente</label>
			            	<p class="help-block"><?php echo date('d-m-Y', strtotime($data->ENTREGA_CLIENTE));?></p>
			                <input type="hidden" value="<?php echo $data->ENTREGA_CLIENTE;?>" />
			         <?php endif;?>			         
			        </div>
			        <div class="form-group">
			        	<label>Relojero Asignado</label>
			        	<?php if($data->CVE_RELOJERO == '0'):?>
			        		<p class="help-block">No hay Relojero asignado</p>
			        		<?php else:?>
			        	<p class="help-block"><?php echo $data->NOMBRE_RELOJERO;?></p>
			        	<?php endif;?>
			                <!--<?php if($data->CVE_RELOJERO == '0'):?>
			                		<label>Asignar Relojero</label>
			                		<select id="cverelojero" name="cverelojero" class="form-control" required="required">	
			                		<option value="">--Selecionar Relojero--</option>		                		
				                	<?php foreach($relojeros as $reloj):?>
				                	<option value="<?php echo $reloj->CLAVE;?>"><?php echo $reloj->NOMBRE;?></option>
				                	<?php endforeach;?>	
				                	</select>			                	
				                <?php else: ?>
				                	<label>Relojero Asignado</label>
				                	<!--<span class="input-group-addon"><?php echo $data->NOMBRE_RELOJERO;?></span>--
				                	<p class="help-block"><?php echo $data->NOMBRE_RELOJERO;?></p>
				                <?php endif;?>-->
				    </div>
			        <div class="form-group">
			        	<label>Observacion Cliente</label>
			        	<p class="help-block"><?php echo trim($data->TRABAJOS);?></p>
			        	<!--<span class="input-group-addon"><?php echo $data->TRABAJOS;?></span>-->
			        </div>
			        <div class="form-group">
			        		<label>Condiciones del Reloj</label>
			        		<p class="help-block"><?php echo $data->CONDICION_RELOJ;?></p>
			        </div>
                                <div class="form-group">
                                    <?php if($data->DIAGNOSTICO == ''):?>
			        	<label>Diagnostico Relojero</label>
                                        <p class="help-block">Aún no hay un Diagnostico</p>
                                    <?php else:?>
                                        <label>Diagnostico Relojero</label>
			        	<p class="help-block"><?php echo trim($data->DIAGNOSTICO);?></p>
                                    <?php endif;?>
			        </div>
			        <div class="form-group">
			        	<label></label>
			        	<input type="hidden" name="tarjeta" value="<?php echo $data->TARJETA;?>" />
			        	<button type="submit" class="form-control btn btn-warning" name="cambiosodt">GUARDAR CAMBIOS!</button>
			        	<!--<span class="input-group-addon"><?php echo $data->TRABAJOS;?></span>-->
			        </div>
				</div>
			</form>
			<?php $tarjeta = $data->TARJETA;
                              $email = $data->EMAIL;
                        ?>
			
		<?php endforeach; ?>
	</div>
</div>
<div id="dialog" title="Basic dialog">
	<form action="index.php" method="post">
		<div class="col-md-12">
			<a id="agregarCampo" class="btn btn-info" href="#">Agregar Campo</a><br /><br />
				<div id="contenedor">					
					<div class="added">
						<div class="col-md-6">
							<input type="text" class="form-control" name="servicio[]" id="servicio1" placeholder="Servicio"/><a href="#" class="eliminar"><i class="fa fa-times-circle"></i></a>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" name="costo[]" id="costo1" placeholder="Costo"/><a href="#" class="eliminar"><i class="fa fa-times-circle"></i></a>	
						</div>
				    </div>
				    
				</div>
			<br />
		</div>
		<br /><br />
		<input type="hidden" name="tarjeta" value="<?php echo $tarjeta;?>" />
		<input type="submit" name="servicioCosto" class="alert-warning form-control" value="Guardar" />
	</form>
	
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
var delay = 2500; //delay
		setTimeout(function()
		{ $('#su').hide(); }, delay);
    
$(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      modal: true,
	  title: "Alta de Servicio y Costo",
	  width: 600,
	  height: 400,
	  show: "fold",
	  hide: "scale"
      /*show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }*/
    });
 
    $( "#btnserv" ).click(function() {
      $( "#dialog" ).dialog( "open" );
    });
  });
/*Agreaga campos servicio/costo*/

$(function(){
	var MaxInputs       = 8; //Número Maximo de Campos
    var contenedor       = $("#contenedor"); //ID del contenedor
    var AddButton       = $("#agregarCampo"); //ID del Botón Agregar

    //var x = número de campos existentes en el contenedor
    var x = $("#contenedor div").length + 1;
    var FieldCount = x-1; //para el seguimiento de los campos

    $(AddButton).click(function (e) {
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++;
            //agregar campo
            $(contenedor).append('<div class="col-md-6"><input type="text" class="form-control" name="servicio[]" id="servicio'+ FieldCount +'" placeholder="Servicio"/><a href="#" class="eliminar"><i class="fa fa-times-circle"></i></a></div>');
            $(contenedor).append('<div class="col-md-6"><input type="text" class="form-control" name="costo[]" id="costo'+ FieldCount +'" placeholder="Costo"/><a href="#" class="eliminar"><i class="fa fa-times-circle"></i></a></div>');
            x++; //text box increment
        }
        return false;
    });

    $("body").on("click",".eliminar", function(e){ //click en eliminar campo
        if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
            x--;
        }
        return false;
    });
})

$(function() {
    $( "#datepickerer" ).datepicker({
    	 altFormat: "mm-dd-yy",
    	 closeText: 'Cerrar',
		 prevText: '<Ant',
		 nextText: 'Sig>',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		 weekHeader: 'Sm',
		 //dateFormat: 'mm/dd/yy',
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: ''
    });
  });
  
  $(function() {
    $( "#datepickerrr" ).datepicker({
    	 altFormat: "mm-dd-yy",
    	 closeText: 'Cerrar',
		 prevText: '<Ant',
		 nextText: 'Sig>',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		 weekHeader: 'Sm',
		 //dateFormat: 'mm/dd/yy',
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: ''
    });
  });
  
  $(function() {
    $( "#datepickerec" ).datepicker({
    	 altFormat: "mm-dd-yy",
    	 closeText: 'Cerrar',
		 prevText: '<Ant',
		 nextText: 'Sig>',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		 weekHeader: 'Sm',
		 //dateFormat: 'mm/dd/yy',
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: ''
    });
  });
</script>
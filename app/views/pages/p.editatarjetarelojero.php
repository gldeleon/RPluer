
<div class="row">
	<?php $tarjeta = "";?>
		<?php foreach ($exec as $data): ?>
	<div class="col-lg-12">
		<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <small>Detalles de ODT, Tarjeta <?php echo $data->TARJETA; ?></small>
                        </h1>               
                        
                    </div>
                </div>
            <div class="row">
                <div class="col-lg-12 alert-info">
                    <h4>Cliente: <?php echo $data->NOMBRE;?></h4>
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
					<div class="form-group">
			                <?php if($data->MAQUINA == '0'):?>
			                		<label>Maquina</label>
			                		<input type="text" class="form-control" name="maquina" />	                	
				                <?php else: ?>
				                	<label>Maquina Asignada</label>
				                	<span class="input-group-addon"><?php echo $data->MAQUINA;?></span>
                                                        <input type="hidden" class="form-control" name="maquina" value="<?php echo $data->MAQUINA;?>" />	
				                <?php endif;?>
				    </div>
					
					<div class="form-group">
			                <?php if($data->REFERENCIA == '0'):?>
			                		<label>Referencia</label>
			                		<input type="text" class="form-control" name="referencia" />	                	
				                <?php else: ?>
				                	<label>Referencia Asignada</label>
				                	<span class="input-group-addon"><?php echo $data->REFERENCIA;?></span>
                                                        <input type="hidden" class="form-control" name="referencia" value="<?php echo $data->REFERENCIA;?>" />	
				                <?php endif;?>
				    </div>
					
					<div class="form-group">
			                <?php if($data->CALIBRE == '0'):?>
			                		<label>Calibre</label>
			                		<input type="text" class="form-control" name="calibre" />	                	
				                <?php else: ?>
				                	<label>Calibre Asignado</label>
				                	<span class="input-group-addon"><?php echo $data->CALIBRE;?></span>
                                                        <input type="hidden" class="form-control" name="calibre" value="<?php echo $data->CALIBRE;?>" />
				                <?php endif;?>
				    </div>
				    
					<div class="form-group">
			        	<!--<label>Relojero Asignado</label>
			        	<?php if($data->CVE_RELOJERO == '0'):?>
			        		<p class="help-block">No hay Relojero asignado</p>
			        		<?php else:?>
			        	<p class="help-block"><?php echo $data->NOMBRE_RELOJERO;?></p>
			        	<?php endif;?>-->
			                <?php if($data->CVE_RELOJERO == '0'):?>
			                		<label>Relojero</label>
			                		<select id="cverelojero" name="cverelojero" class="form-control" >	
			                		<option value="">--Selecionar Relojero--</option>		                		
				                	<?php foreach($relojeros as $reloj):?>
				                	<option value="<?php echo $reloj->CLAVE;?>"><?php echo $reloj->NOMBRE;?></option>
				                	<?php endforeach;?>	
				                	</select>			                	
				                <?php else: ?>
				                	<label>Relojero Asignado</label>
				                	<span class="input-group-addon"><?php echo $data->NOMBRE_RELOJERO;?></span>
                                                        <input type="hidden" class="form-control" name="cverelojero" value="<?php echo $data->CVE_RELOJERO;?>" />
                                                        
				                <?php endif;?>
				    </div>
				    <div class="form-group">
			        	<label></label>
			        	<input type="hidden" name="tarjeta" value="<?php echo $data->TARJETA;?>" />
			        	
			        	<!--<span class="input-group-addon"><?php echo $data->TRABAJOS;?></span>-->
			        </div>
			        <div class="form-group">
                                    <div class="alert alert-info">
                                       
                                        <center><a href="index.php?action=zoom&ruta=<?php echo $data->RUTA_FOTOS;?>" target="_blank">Ver Fotos</a></center>
                                    </div>                                    
                                </div>
				</div>		
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <br />
                                    <label>Condicion del Reloj</label>
                                    <span class="input-group-addon"><?php echo $data->CONDICION_RELOJ;?></span>
                                </div>
                                <div class="form-group">
                                    <br />
                                    <label>Comentario Cliente</label>
                                    <span class="input-group-addon"><?php echo trim($data->TRABAJOS);?></span>
                                    <br />
                                    <!--<button type="submit" class="form-control btn btn-warning" name="cambiorelojero">GUARDAR CAMBIOS!</button>-->
                                </div>
                                <div class="form-group">
                                    <br />
                                    <label>Diagnostico</label><br />
                                    <textarea class="form-control" rows="3" name="diagnostico">
                                        
                                    </textarea>
                                    <br />
                                    <!--<button type="submit" class="form-control btn btn-warning" name="cambiorelojero">GUARDAR CAMBIOS!</button>-->
                                </div>
                                <div class="form-group">
                                    <br />
                                    <button type="submit" class="form-control btn btn-warning" name="cambiorelojero">GUARDAR CAMBIOS!</button>
                                </div>
                            </div>
			</form>
			<?php $tarjeta = $data->TARJETA;?>
		<?php endforeach; ?>
	</div>
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
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
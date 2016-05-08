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
                
			<?php if($data->ESTATUS == 'Finalizado'):?>
				<div class="alert alert-success">ODT Finalizada</div>
			<?php endif;?>
			<form role="form" action="index.php" method="post">
				<div class="col-lg-4">					
					<div class="form-group">
		                <label>Tarjeta</label>
		                <p class="help-block"><?php echo $data->TARJETA;?></p>
		            </div>
				
					<div class="form-group">
			                <label>Cliente</label>
			                <p class="help-block"><?php echo $data->NOMBRE;?></p>
			        </div>
			        <div class="form-group">
			                <label>Marca Reloj</label>
			                <p class="help-block"><?php echo $data->MARCA;?></p>
			        </div>
			        <div class="form-group">
			                <label>Referencia</label>
			                <p class="help-block"><?php echo $data->REFERENCIA;?></p>
			                <!--<input name="referencia" id="disabledInput" class="form-control" placeholder="<?php echo $data->REFERENCIA;?>" <?php echo $data->REFERENCIA == '' ? '' : 'disabled' ?>>-->
			                <!--<p class="help-block"><?php echo $data->MARCA;?></p>-->
			        </div>			        
			        <div class="form-group">
			        	<!--<label>Relojero Asignado</label>
			        		<?php if($data->CVE_RELOJERO == '0'):?>
			        		<p class="help-block">No hay Relojero asignado</p>
			        		<?php else:?>
			        	<p class="help-block"><?php echo $data->NOMBRE_RELOJERO;?></p>
			        	<?php endif;?>-->
			                <?php if($data->CVE_RELOJERO == '0'):?>
			                		<label>Asignar Relojero</label>
			                		<select id="cverelojero" name="cverelojero" class="form-control" required="required">	
			                		<option value="">--Selecionar Relojero--</option>		                		
				                	<?php foreach($relojeros as $reloj):?>
				                	<option value="<?php echo $reloj->CLAVE;?>"><?php echo $reloj->NOMBRE;?></option>
				                	<?php endforeach;?>	
				                	</select>			                	
				                <?php else: ?>
				                	<label>Relojero Asignado</label>
				                	<span class="input-group-addon"><?php echo $data->NOMBRE_RELOJERO;?></span>--
				                	<p class="help-block"><?php echo $data->NOMBRE_RELOJERO;?></p>
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
			<?php $tarjeta = $data->TARJETA;?>
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
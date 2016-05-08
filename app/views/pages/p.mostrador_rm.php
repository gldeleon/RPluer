<div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <!--<div class="col-lg-12">
                        <h1 class="page-header">
                            R. Pluer Relojero <small>Ingeniería Suiza</small>
                        </h1>                       
                    </div>-->
                </div>
                <!-- /.row -->
                <div class="row">
                	<img class="img-responsive" src="app/views/images/logos.jpg" />
                </div>
                <div class="row">
                	<div id="creado" class="alert alert-success"><center><h2>ODT Generada Correctamente</h2></center></div>
                	<br />
                	<form action="index.php" method="post">
                		<div class="col-md-6">
                			<input type="hidden" name="formulariofolio" />                			
                			<div class="input-group">
						        <input type="text" class="form-control" id="cvecte" name="cvecte" placeholder="CLIENTE">
						        <div class="input-group-addon"><a href="#" id="opener"><i class="fa fa-plus"></i></a></div>
					        </div>	
					        <br />
					        <select name="marcas" class="form-control">
					        	<option>--Selecciona Marca--</option>
					        	<option value="Frank Muller">Frank Muller</option>
					        	<option value="bvlgari">Bvlgari</option>
					        	<option value="hublot">Hublot</option>
					        	<option value="Audemars Piguet">Audemars Piguet</option>
					        	<option value="iwc">IWC</option>
					        	<option value="chopard">Chopard</option>
					        	<option value="Jaeger LeCoultre">Jaeger LeCoultre</option>
					        </select>             			
                			<br />
                			<select name="maquina" class="form-control">
					        	<option>--Selecciona Tipo Maquina--</option>
					        	<option value="Cuarzo">Cuarzo</option>
					        	<option value="Mecanico">Mecanico</option>
					        	<option value="Automatico">Automatico</option>					        	
					        </select>  
					        <br />
					        <input class="form-control" type="text" name="marca_desc" placeholder="Descripción del reloj" />
					        <br />
                			<input class="form-control" type="text" name="nocaja" placeholder="No. CAJA" />
                			<!--<label for="calibre">Calibre: </label>-->
                			<br />
                			<input class="form-control" type="text" name="calibre" placeholder="CALIBRE" />
                			<br />
                			<!--<input class="form-control" type="text" name="maquina" placeholder="MAQUINA" />-->
                			<!--<label for="matcaja">Mat. Caja</label>-->                			
                		</div>
                		<div class="col-md-6">
                			<!--<label for="fecha">Fecha: </label>-->
                			<input class="form-control" id="datepicker" type="text" name="fecha" placeholder="FECHA" />
                			<!--<label for="referencia">Referencia: </label>-->
                			<br />
                			<select name="matcaja" class="form-control">
					        	<option>--Selecciona Material de Caja--</option>
					        	<option value="Acero">Acero</option>
					        	<option value="Oro Amarillo">Oro Amarillo</option>
					        	<option value="Oro Rosa">Oro Rosa</option>
					        	<option value="Oro Blanco">Oro Blanco</option>
					        	<option value="Platino">Platino</option>
					        	<option value="Fibra de Carbono">Fibra de Carbono</option>
					        	<option value="Ceramica">Ceramica</option>					        	
					        </select> 
                			<br />
                			<input class="form-control" type="text" name="cajaadc" placeholder="DETALLES DE CAJA" />
                			<br />
                			<input class="form-control" type="text" name="modelo" placeholder="MODELO" />
                			<br />
                			<input class="form-control" type="text" name="referencia" placeholder="REFERENCIA" />
                			
                			<br />
                			<input class="form-control" type="text" name="matpulso" placeholder="MATERIAL DE PULSO" required="required" />
                			
                		</div>
                		<div class="col-lg-12">
                			<br />
                			<textarea placeholder="TRABAJOS A REALIZAR / PRESUPUESTO" class="form-control" name="trabajos" ></textarea>
                		</div>
                		<div class="col-lg-12">
                			<br />
                			<input type="submit" class="btn alert-warning" value="Crear ODT" />
                		</div>                		
                	</form>
                </div>
			</div>
		</div>

<div id="dialog" title="Basic dialog">
	<form action="index.php" method="post">
		<div class="col-md-12">
			<input type="hidden" name="formaltcte" />
			<input class="form-control" type="text" name="nombre" placeholder="NOMBRE" required="required" />
			<br />
			<input class="form-control" type="email" name="email" placeholder="EMAIL" required="required" />
			<br />
			<input class="form-control" type="text" name="tel" placeholder="TELEFONO" required="required" />
			<br />
			<input class="form-control" type="text" name="cel" placeholder="CELULAR" required="required" />
			<br />
		</div>
		<br />
		<input type="submit" class="alert-warning form-control" value="Guardar" />
	</form>
	
</div>
		
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
  .ui-autocomplete-loading {
    background: white url("http://localhost/RPluer/app/views/images/wait.gif") right center no-repeat;
  }
  </style>
 
  <script>
  var delay = 2500; //delay
		setTimeout(function(){ 
			$('#creado').hide(); 
		}, delay);
		
		setTimeout(function(){
			window.location.href = 'index.php?action=odtm';
		}, delay);
  /*$(function() {    
    $( "#cvecte" ).autocomplete({
      //source: availableTags
      source: "app/views/pages/ajaxclientes.php"
    });
  });*/
 $("#cvecte").autocomplete({
source: "app/views/pages/ajaxclientes.php",
minLength: 2,//search after two characters
select: function(event,ui){
    //do something
    }
});

/*datepicker*/
 $(function() {
    $( "#datepicker" ).datepicker({
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
    $( "#dialog" ).dialog({
      autoOpen: false,
      modal: true,
	  title: "Alta de nuevo Cliente",
	  width: 1250,
	  height: 900,
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
 
    $( "#opener" ).click(function() {
      $( "#dialog" ).dialog( "open" );
    });
  });
  </script>
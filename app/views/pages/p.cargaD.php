<?php foreach($exec as $data): ?>
<p id="marca" class="hide"><?php echo $data->MARCA;?></p>
<p id="maquina" class="hide"><?php echo $data->MAQUINA;?></p>
<p id="mat_caja" class="hide"><?php echo $data->MAT_CAJA;?></p>
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
                	<br />
                	<form action="index.php" method="post">
                		<div class="col-md-6">
                			<input type="hidden" name="formulariofolio" />                			
                			<div class="input-group">
						        <input type="text" class="form-control" id="cvecte" name="cvecte" required="required"> 
						        <div class="input-group-addon"><a href="#" id="opener"><i class="fa fa-plus"></i></a></div>
						        <div id="result"></div>
					        </div>	
					        <br />
					        <select name="marcas" class="form-control" required="required">
					        	<option value="">--Selecciona Marca--</option>
					        	<option value="Frank Muller">Frank Muller</option>
					        	<option value="bvlgari">Bvlgari</option>
					        	<option value="hublot">Hublot</option>
					        	<option value="Audemars Piguet">Audemars Piguet</option>
					        	<option value="iwc">IWC</option>
					        	<option value="chopard">Chopard</option>
					        	<option value="Jaeger LeCoultre">Jaeger LeCoultre</option>
					        	<option value="Otro">Otro</option>
					        </select>             			
                			<!--<br />
                			<select name="maquina" class="form-control" required="required">
					        	<option value="">--Selecciona Tipo Maquina--</option>
					        	<option value="Cuarzo">Cuarzo</option>
					        	<option value="Mecanico">Mecanico</option>
					        	<option value="Automatico">Automatico</option>					        	
					        </select>  -->
					        <br />
					        <input class="form-control" type="text" name="marca_desc" placeholder="Descripción del reloj" value="<?php echo $data->DESCR_RELOJ; ?>" required="required" />
					        <br />
                			<input id="nocaja" class="form-control" type="text" name="nocaja" value="<?php echo $data->NO_CAJA;?>" placeholder="No. CAJA" required="required" />
                			<div id="resultado"></div>
                			<!--<label for="calibre">Calibre: </label>-->
                			<!--<br />
                			<input class="form-control" type="text" name="calibre" placeholder="CALIBRE" value="<?php echo $data->CALIBRE;?>" required="required" />-->
                			<br />
                			<textarea placeholder="TRABAJOS A REALIZAR / PRESUPUESTO" class="form-control" name="trabajos" required="required" ></textarea>
                			<br />
                			<!--<input class="form-control" type="text" name="maquina" placeholder="MAQUINA" />-->
                			<!--<label for="matcaja">Mat. Caja</label>-->                			
                		</div>
                		<div class="col-md-6">
                			<!--<label for="fecha">Fecha: </label>-->
                			<input class="form-control" id="datepicker" type="text" name="fecha" placeholder="FECHA" required="required" />
                			<!--<label for="referencia">Referencia: </label>-->
                			<br />
                			<select name="matcaja" class="form-control" required="required">
					        	<option value="">--Selecciona Material de Caja--</option>
					        	<option value="Acero">Acero</option>
					        	<option value="Oro Amarillo">Oro Amarillo</option>
					        	<option value="Oro Rosa">Oro Rosa</option>
					        	<option value="Oro Blanco">Oro Blanco</option>
					        	<option value="Platino">Platino</option>
					        	<option value="Fibra de Carbono">Fibra de Carbono</option>
					        	<option value="Ceramica">Ceramica</option>		
					        	<option value="Otro">Otro</option>			        	
					        </select> 
                			<br />
                			<input class="form-control" type="text" name="cajaadc" value="<?php echo $data->DETALLE_CAJA;?>" placeholder="DETALLES DE CAJA" required="required" />                			
                			<br />
                			<input class="form-control" type="text" name="modelo" value="<?php echo $data->MODELO;?>" placeholder="MODELO" required="required" />
                			<!--<br />
                			<input class="form-control" type="text" name="referencia" <?php echo $data->REFERENCIA;?> placeholder="REFERENCIA" required="required" />-->
                			
                			<br />
                			<input class="form-control" type="text" name="matpulso" value="<?php echo $data->MAT_PULSO;?>" placeholder="MATERIAL DE PULSO" required="required" />
                			<br />
                			<textarea placeholder="CONDICIONES EN QUE SE RECIBE EL RELOJ" class="form-control" name="condiciones" required="required" ></textarea>
                			<br />
                		</div>
                		</div>
                		<!--<div class="col-md-8">
							<a id="agregarCampo" class="btn btn-info" href="#">Agregar Foto</a><br /><br />
								<div id="contenedor">					
									<div class="added">
										<div class="col-md-8">
											<input type="file" class="form-control" name="foto[]" id="foto" placeholder="Foto"/><a href="#" class="eliminar"><i class="fa fa-times-circle"></i></a>
										</div><br />
								    </div>
								</div>
							<br />
						</div>-->
                		<div class="col-lg-12">
                			<input type="submit" class="btn alert-warning form-control" value="Crear ODT" />
                		</div>                		
                	</form>
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
		
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
  <style>
  .ui-autocomplete-loading {
    background: white url("http://localhost/RPluer/app/views/images/wait.gif") right center no-repeat;
  }
  </style>
  <script>
  
  /*$(function() {    
    $( "#cvecte" ).autocomplete({
      //source: availableTags
      source: "app/views/pages/ajaxclientes.php"
    });
  });*/
 $("#cvecte").autocomplete({
//source: "app/views/pages/ajaxclientes.php",
source: "index.php",
//source: "index.php",
minLength: 2,//search after two characters
select: function(event,ui){
    
    }
});
/*Busca si el cliente ya existe*/
/*$(function(){
	var consulta;
	//comprobamos si se pulsa una tecla
        $("#cvecte").focusout(function(e){
                                     
              //obtenemos el texto introducido en el campo de búsqueda
              cte = $("#cvecte").val();
                                                                           
              //hace la búsqueda
                                                                                  
              $.ajax({
                    type: "POST",
                    url: "index.php",
                    data: "cteE="+cte,
                    dataType: "html",
                    beforeSend: function(){
                          //imagen de carga
                          $("#result").html("<p align='center'><img src='ajax-loader.gif' /></p>");
                    },
                    error: function(){
                          alert("error petición ajax");
                    },
                    success: function(data){                                                    
                          $("#result").empty();
                          //alert(data)
                          $("#result").append(data);
                                                             
                    }
              });
                                                                                  
                                                                           
        });
})*/

/*Funcion para colocar los combobox en datos*/
$(document).ready(function(){
	var marca = $('#marca').text();
	var maquina = $('#maquina').text();
	var mat_caja = $('#mat_caja').text();
	/*para marca*/
	$("select[name='marcas']").find("option[value='"+marca+"']").attr("selected",true);
    /*para maquina*/
   	$("select[name='maquina']").find("option[value='"+maquina+"']").attr("selected",true);
   	/*para mat_caja*/
  	$("select[name='matcaja']").find("option[value='"+mat_caja+"']").attr("selected",true);
});

/*Busca si el reloj ya esta agregado*/
$(function(){
	var consulta;
	//comprobamos si se pulsa una tecla
        $("#nocaja").focusout(function(e){
                                     
              //obtenemos el texto introducido en el campo de búsqueda
              consulta = $("#nocaja").val();
                                                                           
              //hace la búsqueda
                                                                                  
              $.ajax({
                    type: "POST",
                    url: "index.php",
                    data: "b="+consulta,
                    dataType: "html",
                    beforeSend: function(){
                          //imagen de carga
                          $("#resultado").html("<p align='center'><img src='ajax-loader.gif' /></p>");
                    },
                    error: function(){
                          alert("error petición ajax");
                    },
                    success: function(data){                                                    
                          $("#resultado").empty();
                          //alert(data)
                          $("#resultado").append(data);
                                                             
                    }
              });
                                                                                  
                                                                           
        });
})

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
	  width: 500,
	  height: 320,
	  show: "fold",
	  hide: "scale",
	  hide: {
        effect: "explode",
        duration: 1000
      }
      /*show: {
        effect: "blind",
        duration: 1000
      },
      */
    });
 
    $( "#opener" ).click(function() {
      $( "#dialog" ).dialog( "open" );
    });
  });
  
  /*funcion para agregar boton de fotos*/
  $(function(){
	var MaxInputs       = 6; //Número Maximo de Campos
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
            $(contenedor).append('<div class="col-md-8"><input type="file" class="form-control" name="foto[]" id="foto" placeholder="Foto"/><a href="#" class="eliminar"><i class="fa fa-times-circle"></i></a></div><br />');
            //$(contenedor).append('<div class="col-md-6"><input type="text" class="form-control" name="costo[]" id="costo'+ FieldCount +'" placeholder="Costo"/><a href="#" class="eliminar"><i class="fa fa-times-circle"></i></a></div>');
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
  </script>
  <?php endforeach; ?>
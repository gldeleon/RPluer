
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            R. Pluer Relojero <small>Ingeniería Suiza</small>
                        </h1>                       
                    </div>
                </div>
                <!--<div class="input-group-addon"><a href="#" id="abre">Nuevo Usuario<i class="fa fa-plus"></i></a></div>-->
                <div class="row">
                    <label>Ingresa el tipo de servicio a buscar</label>
                    <br />
                    <form action="index.php" method="post">
                    <br />
                    <div class="col-md-4">
                              <input class="form-control" type="text" name="servicio" placeholder="Servicio" required="required" />
                    </div>
                        <div class="col-md-4">
                            <button type="submit" name="rservicio" class="btn btn-warning">Buscar! </button>
                        </div>                        
                        </form>
		</div>
               	<br />
                <?php if(isset($reporte)): ?>
                <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-servicio">
                                    <thead>
                                        <tr>
                                            <th>Tarjeta</th>
                                            <th>Cliente</th>
                                            <th>Marca</th>   
                                            <th>Costo Total</th>     
                                            <th>Estatus</th>  
                                            <th>Trabajos</th>
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                    	<?php
                                    	//var_dump($exec); 
                                    	foreach ($reporte as $data): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $data->TARJETA;?></td> 
                                            <td><?php echo $data->NOMBRE;?></td>
                                            <td><?php echo $data->MARCA;?></td>
                                            <td><?php echo $data->MN;?></td>
                                            <td><?php echo $data->ESTATUS;?></td>
                                            <td><?php echo $data->TRABAJOS;?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                 </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                </div>
                <?php endif;?>
            </div>
</div>

<!--Para agregar nuevo-->

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="app/views/bower_components/DataTables/media/js/jquery.dataTables.js"></script>      
<script src="app/views/bower_components/DataTables/media/js/dataTables.bootstrap.js"></script>    
<script>
     /*datepicker*/
 $(function() {
    $( "#datepicker" ).datepicker({
    	 //altFormat: "mm-dd-yy",
         altFormat: "yy-mm-dd",
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
  
   /*datepicker*/
 $(function() {
    $( "#datepicker1" ).datepicker({
    	 altFormat: "yy-mm-dd",
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
  
  $('#dataTables-servicio').DataTable({
    language: {
                    lengthMenu: "Mostrando _MENU_ por pagina",
                    zeroRecords: "No hay dato para mostrar",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    sSearch: "Buscar: ",
                    sInfoFiltered:   "(Filtrado de un total de _MAX_ registros)",					
                    oPaginate: {
                                                    "sFirst":    "Primero",
                                                    "sLast":     "Último",
                                                    "sNext":     "Siguiente",
                                                    "sPrevious": "Anterior"
                                    }
            },
            scrollY:        "400px",
    scrollCollapse: true,
    paging:         true
    });
  
$(function() {
    $( "#alta" ).dialog({
      autoOpen: false,
      modal: true,
    title: "Alta Nuevo Usuario",
    width: 420, 
    height: 320,
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
 
    $( "#abre" ).click(function() {
      $( "#alta" ).dialog( "open" );
    });
  });
  
  
    
   
  
  </script>
                

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
                    <label>Selecciona Marca</label>
                    <br />
                    <form action="index.php" method="post">
                    <br />
                    <div class="col-md-4">
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
                    </div>
                        <div class="col-md-4">
                            <button type="submit" name="rmarca" class="btn btn-warning">Buscar! </button>
                        </div>                        
                        </form>
		</div>
               	<br />
                <?php if(isset($reporte)): ?>
                <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-marcas">
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
  
  $('#dataTables-marcas').DataTable({
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
  </script>
                
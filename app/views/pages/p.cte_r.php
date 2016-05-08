
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
                <div id="su" class="alert alert-success"><center><h2>Alta de Cliente Correctamente</h2></center></div>
                <!--<div class="input-group-addon"><a href="#" id="abre">Nuevo Usuario<i class="fa fa-plus"></i></a></div>-->
                <div class="row">
					<button id="abre" class="btn btn-warning">Nuevo Cliente <i class="fa fa-plus-circle"></i></button>
				</div>
               	<br />
                <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-usuarios">
                                    <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Email</th> 
                                            <th>Telefono 1</th>
                                            <th>Telefono 2</th>
                                            <th>Editar</th>     
                                            <th>Eliminar</th>                                                                    
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                    	<?php
                                    	//var_dump($exec); 
                                    	foreach ($exec as $data): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $data->NOMBRE;?></td>
                                            <td><?php echo $data->EMAIL;?></td>
                                            <td><?php echo $data->TELEFONO;?></td>
                                            <td><?php echo $data->CALLE;?></td>
                                            <td><a href="index.php?action=editcte&id=<?php echo $data->CLAVE;?>"><center><i class="fa fa-pencil-square-o"></i></center></a></td>
                                            <td><a href="index.php?action=elimcte&id=<?php echo $data->CLAVE;?>"><center><i class="fa fa-trash-o"></i></center></a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                 </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
			          </div>
                
            </div>
</div>

<!--Para agregar nuevo-->
<div id="alta" title="Basic dialog">
  <form action="index.php" method="post">
		<div class="col-md-12">
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
		<input type="submit" name="formaltctef" class="alert-warning form-control" value="Guardar" />
	</form>
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
$(function() {
    $( "#alta" ).dialog({
      autoOpen: false,
      modal: true,
    title: "Alta Nuevo Cliente",
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
  
  var delay = 2500; //delay
		setTimeout(function()
		{ $('#su').hide(); }, delay);
  </script>
                
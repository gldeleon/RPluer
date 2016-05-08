
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
                <div id="su" class="alert-warning"><center><h2>Usuario Eliminado Correctamente</h2></center></div>
                <!--<div class="input-group-addon"><a href="#" id="abre">Nuevo Usuario<i class="fa fa-plus"></i></a></div>-->
                <div class="row">
					<button id="abre" class="btn btn-warning">Nuevo Usuario <i class="fa fa-plus-circle"></i></button>
				</div>
               	<br />
                <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-usuarios">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Email</th>
                                            <th>Estatus</th>
                                            <th>Rol</th>   
                                            <th>Editar</th>     
                                            <th>Eliminar</th>                                                                    
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                    	<?php
                                    	//var_dump($exec); 
                                    	foreach ($exec as $data): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $data->USER_LOGIN;?></td>
                                            <td><?php echo $data->USER_EMAIL;?></td>
                                            <td><?php echo $data->USER_STATUS;?></td>
                                            <td><?php echo $data->USER_ROL;?></td>
                                            <td><a href="index.php?action=edituser&id=<?php echo $data->ID;?>"><center><i class="fa fa-pencil-square-o"></i></center></a></td>
                                            <td><a href="index.php?action=elimuser&id=<?php echo $data->ID;?>"><center><i class="fa fa-trash-o"></i></center></a></td>
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
      <input class="form-control" type="text" name="usuario" placeholder="Usuario" />
      <br />
      <input class="form-control" type="password" name="contrasena" placeholder="Contraseña" />
      <br />
      <input class="form-control" type="email" name="email" placeholder="E-Mail"  />
      <br /><select name="rol" class="form-control">
      	<option value="administracion">Administracion</option>
      	<option value="relojero">Relojero</option>
      	<option value="mostrador">Mostrador</option>
      </select>
      <br />
      <input type="submit" class="alert-warning form-control" name="altanuser" value="Guardar" />
    </div>
    
  </form>  
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
  var delay = 2500; //delay
		setTimeout(function()
		{ $('#su').hide(); }, delay);
  </script>
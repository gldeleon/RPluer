
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
                <div id="creado" class="alert alert-success"><center><h2>ODT Generada Correctamente</h2></center></div>
                	<br />
                <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover letra" id="dataTables-usuarios">
                                    <thead>
                                    	<th colspan="2"><center>IMPRIMIR</center></th>
                                    	<th colspan="8"></th>
                                    	<th colspan="2"><center>ENTRADA</center></th>
                                    	<th colspan="2"><center>SALIDA</center></th>
                                    	<th></th>
                                        <tr>
                                        	<th><center>C</center></th>
                                            <th><center>P</center></th>
                                            <th><center>E</center></th>
                                            <th>TARJETA</th>
                                            <th>CLIENTE</th>
                                            <th>RELOJ</th>
                                            <th>REFERENCIA</th>
                                            <th>SERVICIOS</th>
                                            <th>COSTO</th>
                                            <th>AUTORIZA</th>    
                                            <th>ENTRADA CAJA</th>
                                            <th>ENTRADA RELOJERO</th>
                                            <th>SALIDA RELOJERO</th>
                                            <th>ENTREGA A CLIENTE</th>
                                            <th>RELOJERO</th>                                                                              
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                    	<?php
                                    	//var_dump($exec); 
                                    	foreach ($exec as $data): ?>
                                        <tr class="odd gradeX <?php echo $data->AUTORIZADO == 'Autorizado' ? 'success' : '' ?>">
                                        	<td><center><a href="index.php?action=imprimecliente&tarjeta=<?php echo $data->TARJETA;?>"><i class="fa fa-print"></i></a></center></td>
                                            <td><center><a href="index.php?action=imprimepluer&tarjeta=<?php echo $data->TARJETA;?>"><i class="fa fa-print"></i></a></center></td>
                                            <td><center><a href="index.php?action=editatarjeta&tarjeta=<?php echo $data->TARJETA;?>"><i class="fa fa-pencil-square-o"></i></a></center></td>
                                            <td><?php echo $data->TARJETA;?></td>
                                            <td><?php echo $data->NOMBRE;?></td>
                                            <td><?php echo $data->CVE_RELOJ;?></td>
                                            <td><?php echo $data->REFERENCIA;?></td>
                                            <td><?php echo $data->CVE_SERVICIO;?></td>
                                            <td><?php echo '$ '.$data->MN;?></td>
                                            <td><?php echo $data->AUTORIZADO;?></td>
                                            <td><?php echo $data->ENTRADA_CAJA;?></td>
                                            <td><?php echo $data->RECIBE_RELOJERO == '0101-01-01' ? 'Sin Asignar' : $data->RECIBE_RELOJERO;?></td>
                                            <td><?php echo $data->ENTREGA_RELOJERO == '0101-01-01' ? 'Sin Asignar' : $data->ENTREGA_RELOJERO;?></td>
                                            <td><?php echo $data->ENTREGA_CLIENTE == '0101-01-01' ? 'Sin Asignar' : $data->ENTREGA_CLIENTE;?></td>
                                            <td><?php echo $data->CVE_RELOJERO == 0 ? 'No hay relojero Asignado' : $data->CVE_RELOJERO;?></td>                                             
                                        </tr>
                                        <?php endforeach; ?>
                                 </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
			          </div>
                
            </div>
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>  
<script>
  var delay = 2500; //delay
		setTimeout(function()
		{ $('#creado').hide(); }, delay);
</script>
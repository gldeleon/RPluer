
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
                
                <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-usuarios">
                                    <thead>
                                        <tr>
                                        	<th>Imprimir Cliente</th>
                                            <th>Imprimir Pluer</th>
                                            <th>TARJETA</th>
                                            <th>CLIENTE</th>
                                            <th>MARCA RELOJ</th>
                                            <th>REFERENCIA</th>
                                            <th>SERVICIO</th>
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
                
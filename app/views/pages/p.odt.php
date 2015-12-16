<div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index.php?action=madmin"><i class="fa fa-fw fa-dashboard"></i> Mostrador</a>
                    </li>
                    <li>
                        <a href="index.php?action=odt"><i class="fa fa-fw fa-bar-chart-o"></i> ODTs</a>
                    </li>                    
                </ul>
            </div>
            
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
                                            <th>REMISION</th>
                                            <th>TARJETA</th>
                                            <th>CLIENTE</th>
                                            <th>JOYERIA</th>
                                            <th>MARCA</th>
                                            <th>MODELO</th>
                                            <th>CAJA</th>
                                            <th>REFERENCIA</th>
                                            <th>CALIBRE</th>
                                            <th>MAQUINA</th>
                                            <th>SERVICIO</th>
                                            <th>COSTO</th>
                                            <th>RECIBO_RPLUER</th>
                                            <th>AUTORIZA</th>    
                                            <th>ENTRADA_CAJA</th>
                                            <th>ENTRADA_RELOJERO</th>
                                            <th>SALIDA_RELOJERO</th>
                                            <th>ENTREGA</th>
                                            <th>RELOJERO</th>                                     
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                    	<?php
                                    	//var_dump($exec); 
                                    	foreach ($exec as $data): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $data['REMISION'];?></td>
                                            <td><?php echo $data['TARJETA'];?></td>
                                            <td><?php echo $data['NOMBRE_CLIENTE'];?></td>
                                            <td><?php echo $data['JOYERIA'];?></td>
                                            <td><?php echo $data['MARCA'];?></td>
                                            <td><?php echo $data['MODELO'];?></td>
                                            <td><?php echo $data['NO_CAJA'];?></td>
                                            <td><?php echo $data['REFERENCIA'];?></td>
                                            <td><?php echo $data['CALIBRE'];?></td>
                                            <td><?php echo $data['MAQUINA'];?></td>
                                            <td><?php echo $data['SERVICIO'];?></td>
                                            <td><?php echo $data['MN'];?></td>
                                            <td><?php echo $data['RECIBO_PLUER'];?></td>
                                            <td><?php echo $data['AUTORIZA'];?></td>
                                            <td><?php echo $data['ENTRADA_CAJA'];?></td>
                                            <td><?php echo $data['ENTR_R'];?></td>
                                            <td><?php echo $data['SALIDA_R'];?></td>
                                            <td><?php echo $data['ENTREGADO'];?></td>
                                            <td><?php echo $data['RELOJERO'];?></td>         
                                        </tr>
                                        <?php endforeach; ?>
                                 </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
			          </div>
                
            </div>
</div>
                
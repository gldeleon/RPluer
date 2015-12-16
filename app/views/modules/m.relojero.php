<div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index.php?action=pendientes"><i class="fa fa-fw fa-dashboard"></i> Trabajos</a>
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
                <!-- /.row -->
                <!--<div class="row">
                	<img class="img-responsive" src="app/views/images/logos.png" />
                </div>-->
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Trabajos Pendientes
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-usuarios">
                                    <thead>
                                        <tr>
                                            <th>CLAVE</th>
                                            <th>TARJETA</th>
                                            <th>REFERENCIA</th>
                                            <th>SERVICIOS</th>
                                            <th>FECHA ENTRADA REPARACION</th>
                                            <th>CALIBRE</th>
                                            <th>MARCA</th>
                                            <th>MATERIAL CAJA</th>
                                            <th>MATERIAL PULSO</th>
                                            <th>No CAJA</th>
                                            <th>MODELO</th>
                                            <th>AVANZAR</th>
                                        </tr>
                                    </thead>                                   
                                  <tbody>
                                    	<?php
                                    	//var_dump($exec); 
                                    	foreach ($exec as $data): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $data['CLAVE'];?></td>
                                            <td><?php echo $data['TARJETA'];?></td>
                                            <td><?php echo $data['REFERENCIA'];?></td>
                                            <td><?php echo $data['CVE_SERVICIO'];?></td>
                                            <td><?php echo $data['RECIBE_RELOJERO'];?></td>
                                            <td><?php echo $data['CALIBRE'];?></td> 
                                            <td><?php echo $data['MARCA'];?></td> 
                                            <td><?php echo $data['MAT_CAJA'];?></td> 
                                            <td><?php echo $data['MAT_PULSO'];?></td> 
                                            <td><?php echo $data['NO_CAJA'];?></td> 
                                            <td><?php echo $data['MODELO'];?></td>    
                                            <td><a href="#"><i class="fa fa-hand-o-right"></i></a></td>      
                                        </tr>
                                        <?php endforeach; ?>
                                 </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
			          </div>
			</div>
		</div>
                </div>
			</div>
		</div>
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
                <!-- /.row -->
                <div class="row">
                	<img class="img-responsive" src="app/views/images/logos.png" />
                </div>
                <div class="row">
                	<br />
                	<form action="index.php" method="post">
                		<div class="col-md-6">
                			<input type="hidden" name="formulariofolio" />
                			<!--<label for="nombre">Nombre: </label>-->
                			<input class="form-control" type="text" name="nombre" placeholder="NOMBRE" />
                			<!--<label for="correo">Correo: </label>-->
                			<br />
                			<input class="form-control" type="email" name="correo" placeholder="CORREO ELECTRONICO" />
                			<!--<label for="marca">Marca: </label>-->
                			<br />
                			<input class="form-control" type="text" name="marca" placeholder="MARCA" />
                			<!--<label for="nocaja">No. Caja: </label>-->
                			<br />
                			<input class="form-control" type="number" name="nocaja" placeholder="No. CAJA" />
                			<!--<label for="calibre">Calibre: </label>-->
                			<br />
                			<input class="form-control" type="text" name="calibre" placeholder="CALIBRE" />
                			<!--<label for="matcaja">Mat. Caja</label>-->
                			<br />
                			<input class="form-control" type="text" name="matcaja" placeholder="MATERIAL DE CAJA" />
                			
                		</div>
                		<div class="col-md-6">
                			<!--<label for="fecha">Fecha: </label>-->
                			<input class="form-control" type="text" name="fecha" placeholder="FECHA" />
                			<!--<label for="tel">Tel. </label>-->
                			<br />
                			<input class="form-control" type="number" name="tel" placeholder="TELEFONO" />
                			<!--<label for="referencia">Referencia: </label>-->
                			<br />
                			<input class="form-control" type="text" name="referencia" placeholder="REFERENCIA" />
                			<br />
                			<input class="form-control" type="text" name="maquina" placeholder="MAQUINA" />
                			<br />
                			<input class="form-control" type="text" name="matpulso" placeholder="MATERIAL DE PULSO" />
                			
                		</div>
                		<div class="col-lg-12">
                			<br />
                			<textarea placeholder="TRABAJOS A REALIZAR / PRESUPUESTO" class="form-control" name="trabajos"></textarea>
                		</div>
                		<div class="col-lg-12">
                			<br />
                			<button class="alert-warning" type="submit">Guardar e Imprimir! </button>
                		</div>                		
                	</form>
                </div>
			</div>
		</div>
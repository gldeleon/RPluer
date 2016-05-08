<?php
foreach($insert as $data){
?>
<div class="row">
	<center><h2>Modificar Cliente</h2></center>
</div>
<br />
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-6">
			<form action="index.php" method="post">
				<input type="hidden" name="id" value="<?php echo $data->CLAVE;?>" />
			<input type="text" name="login" class="form-control" placeholder="Usuario: <?php echo $data->NOMBRE; ?>" /><br />
			<input type="text" name="email" class="form-control" placeholder="Email: <?php echo $data->EMAIL; ?>" /><br />
			<!--<input type="text" name="status" class="form-control" placeholder="Estatus: <?php echo $data->USER_STATUS == 1 ? "Alta" : "Baja"; ?>" /><br />-->
			<input type="text" name="rol" class="form-control" placeholder="Rol: <?php echo $data->CALLE; ?>" /><br />
			<input type="text" name="rol" class="form-control" placeholder="Rol: <?php echo $data->TELEFONO; ?>" /><br />
			<button type="submit" name="actualizacte" class="btn btn-warning" >Guardar Cambios</button>
		</form>
		</div>		
	</div>
</div>
<?php
}
?>
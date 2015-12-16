<?php

require_once 'app/model/database.php';

/*Clase para hacer uso de database*/
class rpluer extends database{
	
	/*Comprueba datos de login*/
	function AccesoLogin($user, $pass){
		$u = strtolower($user);
		$this->query = "SELECT USER_LOGIN, USER_PASS, USER_ROL
						FROM rp_users 
						WHERE USER_LOGIN = '$u' and USER_PASS = '$pass'"; /*Contraseña va encriptada con MD5*/
		  $log = $this->QueryObtieneDatos();
			if(count($log) > 0){
				/*Creamos variable de sesion*/
					$_SESSION['user'] = $log;
					//var_dump($_SESSION['user']);
					return $_SESSION['user'];				
			}else{
				return 0;
			}
	}
	
	/*Funcion para mostrar los trabajos pendientes*/
	function ConsultaOdt(){
		$this->query = "SELECT a.CLAVE, a.TARJETA, a.REFERENCIA, a.CVE_SERVICIO, a.RECIBE_RELOJERO, b.CALIBRE, b.MARCA, b.MAT_CAJA, b.MAT_PULSO, b.NO_CAJA, b.MODELO
						FROM odts a 
						JOIN RELOJ b on (a.cve_reloj = b.CVE_RELOJ)
						WHERE a.ESTATUS = 'proceso'";
		$result = $this->EjecutaQuerySimple();
		//$r = $this->FetchAs($result);
		//var_dump($r);
		if($this->NumRows($result) > 0){
			while ( $tsArray = $this->FetchAs($result) ) 
					$data[] = $tsArray;			
		
				return $data;
		}
		
		return 0;
	}
		
	function ConsultaEjemplo(){
		$this->query = "SELECT a.REMISION, a.TARJETA, a.NOMBRE_CLIENTE, a.JOYERIA, a.MARCA, a.MODELO, a.NO_CAJA, a.REFERENCIA, 
		a.CALIBRE, a.MAQUINA, a.SERVICIO, a.MN, a.RECIBO_PLUER, a.AUTORIZA, a.ENTRADA_CAJA, a.ENTR_R, a.SALIDA_R, a.ENTREGADO, 
		a.RELOJERO FROM EJEMPLO a";
		
		$result = $this->EjecutaQuerySimple();
		if($this->NumRows($result) > 0){
			while ( $tsArray = $this->FetchAs($result) ) 
					$data[] = $tsArray;			
		
				return $data;
		}
		
		return 0;
	}
	
	
	/*consulta para mostrar los componentes dados de alta*/
	function MuestraComp(){
		$this->query = "SELECT a.ID, a.SEG_NOMBRE, a.SEG_DURACION, a.SEG_TIPO, a.USUARIO, a.FECHA_CREACION, a.FECHA_MODIFICACION, a.STATUS
						FROM PG_SEGCOMP a 
						WHERE status = 'alta' ORDER BY a.SEG_NOMBRE ASC";
		$result = $this->EjecutaQuerySimple();
		if($this->NumRows($result) > 0){
			while ( $tsArray = $this->FetchAs($result) ) 
					$data[] = $tsArray;			
		
				return $data;
		}
		
		return 0;
	}
	
	function CompruebaRol($user){
		$this->query = "SELECT USER_ROL FROM RP_USERS WHERE USER_LOGIN = '$user'";/*Falta Tabla*/
		 $log = $this->QueryObtieneDatos();
			if(count($log) > 0){
				return $log;
			}else{
				return 0;
			}
			
	}
		
	function ObtieneReg(){
		$this->query = "SELECT COUNT(*)
  						FROM PG_USERS";
						
		$r = $this->QueryObtieneDatos();
		
		return	$r;
	}
	
	function ObtieneRegSC(){
		$this->query = "SELECT COUNT(*)
  						FROM PG_SEGCOMP";
						
		$r = $this->QueryObtieneDatos();
		
		return	$r;
	}
	
	function NuevoUser($usuario, $contra, $email, $rol, $id){
		$fecha = date('d-m-Y');
		$u = strtolower($usuario);
		//echo $fecha;
		$this->query = "INSERT INTO PG_USERS VALUES ($id, '$u', '$contra', strtolower('$email'), '$fecha', 'alta', '$rol')";
		$rs = $this->EjecutaQuerySimple();
		//echo $rs;
		return $rs;
	}		
	
	function InsertaCompo($nombre, $duracion, $tipo, $usuario){
		//$usuario = $_SESSION['user']; antes de insertar tomar el ultimo valor de id sumarle 1 e insertar
		$user = $_SESSION['user']["USER_LOGIN"];
		//print_r($user);
		$fecha = date('d-m-Y');
		$rs = $this->ObtieneRegSC();
		$id = (int) $rs["COUNT"] + 1;
		$this->query = "INSERT INTO PG_SEGCOMP VALUES ($id, '$nombre', '$duracion', '$tipo', '$user', '$fecha', '$fecha', 'alta')";
		$result = $this->EjecutaQuerySimple();
		//print_r($result);
		return $result;
	}
	
	function ConsultaProd(){
		$this->query ="SELECT a.cve_art, e.nombre as Proveedor, d.costo, b.camplib7 as Nombre, b.camplib1 as Marca, c.cve_alm as Almacen, b.camplib8 as Categoria, 
						b.camplib2 as modelo, b.camplib3 as division, b.camplib4 as piezas, b.camplib9 as subcategoria, b.camplib10 as Codigo_Fabricante, b.camplib11 as Proveedor_Empaque, 
						b.camplib12 as Costo_x_Empaque, b.camplib13 as Unidad_de_Empaque, b.camplib14 as Piezas_por_empaque
						from inve01  a 
						left join inve_clib01 b on a.cve_art = b.cve_prod 
						left join mult01 c on a.cve_art = c.cve_art 
						left join prvprod01 d on a.cve_art = d.cve_art 
						left join prov01 e on d.cve_prov = e.clave 
						where c.cve_alm = '8'";
		
		$result = $this->EjecutaQuerySimple();
		if($this->NumRows($result) > 0){
			while ( $tsArray = $this->FetchAs($result) ) 
					$data[] = $tsArray;			
		
				return $data;
		}
		
		return 0;
	}
	
	function ConsultaUsur(){
		
			$this->query ="SELECT a.ID, a.USER_LOGIN, a.USER_EMAIL, a.USER_STATUS, a.USER_ROL
						FROM PG_USERS a";
		
		$result = $this->EjecutaQuerySimple();
		if($this->NumRows($result) > 0){
			while ( $tsArray = $this->FetchAs($result) ) 
					$data[] = $tsArray;			
		
				return $data;
				unset($data);
		}
		
		return 0;
	}
	
	function ConsultaUsurEmail($email){
			$this->query ="SELECT a.ID, a.USER_LOGIN, a.USER_EMAIL, a.USER_STATUS, a.USER_ROL
							FROM PG_USERS a WHERE a.USER_EMAIL = '$email'";
		
		//unset($data);
		$result = $this->QueryObtieneDatos();
		//var_dump($result);
		//if($this->NumRows($result) > 0){			
			//while ( $tsArray = $result) {
				//echo "dentro del while";
				$data[] = $result;
			//}
			//var_dump($data);
				return $data;
				//unset($data1);
		//}
		
		return 0;
		}
	
	function ActualizaUsr($mail, $usuario, $contrasena, $email, $rol, $estatus){
	$this->query = "UPDATE PG_USERS 
						SET USER_LOGIN = '$usuario', USER_PASS = '$contrasena', USER_EMAIL = '$email', USER_ROL = '$rol', USER_STATUS = '$estatus'
						WHERE USER_EMAIL = '$mail'"; /*actualizamos datos y retornamos ConsultaUsur()*/
		
	$result = $this->EjecutaQuerySimple();
	//var_dump($result);
	if(count($result) > 0){		
		$d = $this->ConsultaUsur();
		return $d;
	}else{
		return 0;
	}
	}
	
	function ObtieneRegIC(){
		$this->query = "SELECT COUNT(*)
  						FROM PG_SEGDOC";
						
		$r = $this->QueryObtieneDatos();
		
		return	$r;
	}
	
	function InsertaComp($comp, $nombre, $desc){
		$rs = $this->ObtieneRegIC();
		$id = (int) $rs["COUNT"] + 1;
		if(isset($comp[0])){$_1 = $comp[0];}else{$_1 =  0;}
		if(isset($comp[1])){$_2 = $comp[1];}else{$_2 =  0;}
		if(isset($comp[2])){$_3 = $comp[2];}else{$_3 =  0;}
		if(isset($comp[3])){$_4 = $comp[3];}else{$_4 =  0;}
		if(isset($comp[4])){$_5 = $comp[4];}else{$_5 =  0;}
		if(isset($comp[5])){$_6 = $comp[5];}else{$_6 =  0;}
		if(isset($comp[6])){$_7 = $comp[6];}else{$_7 =  0;}
		if(isset($comp[7])){$_8 = $comp[7];}else{$_8 =  0;}
		if(isset($comp[8])){$_9 = $comp[8];}else{$_9 =  0;}
		if(isset($comp[9])){$_10 = $comp[9];}else{$_10 =  0;}
		if(isset($comp[10])){$_11 = $comp[10];}else{$_11 =  0;}
		if(isset($comp[11])){$_12 = $comp[11];}else{$_12 =  0;}
		if(isset($comp[12])){$_13 = $comp[12];}else{$_13 =  0;}
		if(isset($comp[13])){$_14 = $comp[13];}else{$_14 =  0;}
		if(isset($comp[14])){$_15 = $comp[14];}else{$_15 =  0;}
		if(isset($comp[15])){$_16 = $comp[15];}else{$_16 =  0;}
		if(isset($comp[16])){$_17 = $comp[16];}else{$_17 =  0;}
		if(isset($comp[17])){$_18 = $comp[17];}else{$_18 =  0;}
		if(isset($comp[18])){$_19 = $comp[18];}else{$_19 =  0;}
		if(isset($comp[19])){$_20 = $comp[19];}else{$_20 =  0;}
		
		$this->query = "INSERT INTO PG_SEGDOC 
					VALUES ($id, '$nombre', '$desc', '$_1', '$_2', '$_3', '$_4', '$_5', 
					'$_6', '$_7', '$_8', '$_9', '$_10', '$_11', '$_12', '$_13', '$_14', '$_15', '$_16', '$_17', '$_18', 
					'$_19', '$_20')";
		//echo $this->query;
		$result = $this->EjecutaQuerySimple();
		
		return $result;
			
	}

	function CompruebaComp($nombre){
		$this->query = "SELECT SEG_NOMBRE FROM PG_SEGCOMP WHERE SEG_NOMBRE = '$nombre'";
		$result = $this->EjecutaQuerySimple();
		return count($result);
	}
	
	/*Funcion que obtiene los componentes existentes*/
	function ConsultaComp(){
		$this->query = "SELECT ID, SEG_NOMBRE 
						FROM PG_SEGCOMP 
						WHERE status = 'alta'";
						
		$result = $this->EjecutaQuerySimple();
		if($this->NumRows($result) > 0){
			while ( $tsArray = $this->FetchAs($result) ) 
					$data[] = $tsArray;			
		
				return $data;
				unset($data);
		}
		
		return 0;
				
	}
	
	function ConsultaFac(){
		$this->query = "SELECT CVE_DOC, TIP_DOC, CVE_CLPV, STATUS, ID_SEG 
						FROM FACTF01 
						WHERE status != 'C'";
										
		$result = $this->EjecutaQuerySimple();
		if($this->NumRows($result) > 0){
			while ( $tsArray = $this->FetchAs($result) ) 
					$data[] = $tsArray;			
		
				return $data;
				unset($data);
		}
		
		return 0;
	}

	function ConsultaFlu(){
		$this->query = "SELECT ID, NOMBRE FROM PG_SEGDOC";
										
		$result = $this->EjecutaQuerySimple();
		if($this->NumRows($result) > 0){
			while ( $tsArray = $this->FetchAs($result) ) 
					$data[] = $tsArray;			
		
				return $data;
				unset($data);
		}
		
		return 0;
	}
	
}
?>
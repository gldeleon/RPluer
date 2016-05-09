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
		  //var_dump($log);
			if(isset($log->USER_LOGIN)){
				/*Creamos variable de sesion*/
					$_SESSION['user'] = $log;
					//var_dump($_SESSION['user']);
					return $_SESSION['user'];				
			}else{
				return 0;
			}
	}
	
	function ObtieneAlertas(){
		$this->query = "SELECT * FROM ODTs WHERE ";	
		$r = $this->QueryObtieneDatos();
		return	$r;
	}
	
	
	/*funcion para obtener datos del cliente*/
	function ObtieneCte($cte){
		$this->query="SELECT nombre, rfc, telefono, email
					  FROM clientes
					  WHERE nombre = '$cte'";
		$res = $this->QueryObtieneDatos();
		if(count($res) > 0){
				//$data[] = $res;
				return $res;
		}
		return 0;
	}	
	
	/*Obtiene clave del reloj*/
	function ObtieneReloj($tarjeta){
		$this->query="SELECT * FROM odt 
				WHERE tarjeta = $tarjeta";
		$res = $this->QueryObtieneDatos();
		if(count($res) > 0){
				return $res;
		}
		return 0;
	}
	/*obtiene los datos del reloj para imprimir*/
	function ObtieneDatosReloj($r){
		$this->query="SELECT * FROM RELOJ
				WHERE CVE_RELOJ = $r";
		$res = $this->QueryObtieneDatos();
		if(count($res) > 0){
				return $res;
		}
		return 0;
	}
	
	/*funcion pàra insertar nuevas odt*/
	function InsertDataOdts($user, $nombre, $marca, $mod, $nocaja, $calibre, $matcaja, $fecha, $ref, $maquina, $matpulso, $trabajos, $desc_reloj, $tipomaq, $detalleCaja, $condiciones, $garantia, $fotos, $tipo, $folioJy, $caratula){
		$rs = $this->ObtieneRegSC();
		$id = (int) $rs->ID + 1;
		//echo $id;
		/*$clave = (int) $rs->COUNT + 1;*/
		$t = $this->ObtieneTarjeta();
		$tarjeta = (int) $t->TARJETA + 1;
		$r = $this->GuardaReloj($tarjeta, $marca, $mod, $nocaja, $calibre, $matcaja, $maquina, $matpulso, $desc_reloj, $tipomaq, $detalleCaja, $caratula);
		if($r >0){
			$cve_reloj = $this->ObtieneCveReloj();
			$reloj = $cve_reloj->CVE_RELOJ;
		}		
                
                /*Guarda fotos*/
                $ruta = $this->GuardaFotos($fotos, $tarjeta);
		//echo $trabajos;
		$cve_cte = $this->ObtieneClaveCte($nombre);
		$cliente = $cve_cte->CLAVE;
		//$fec = date('m-d-Y');
		//var_dump($user);
		$user1 = $user->USER_LOGIN;
		$this->query = "INSERT INTO odt (ID, CLAVE, TARJETA, CVE_CTE, CVE_RELOJ, REFERENCIA, CVE_SERVICIO, COSTOS, MN, 
						RECIBO_PLUER, CONDICION_RELOJ, AUTORIZADO, ENTRADA_CAJA, RECIBE_RELOJERO, ENTREGA_RELOJERO, ENTREGA_CLIENTE, CVE_RELOJERO, ESTATUS, TRABAJOS, FECHACREACION_ODT, ULTIMO_CAMBIO, GARANTIA, TIPO, FOLIOJY, RUTA_FOTOS, CARATULA)
						VALUES ($id,'$tarjeta','$tarjeta','$cliente','$reloj','$ref','', '',0,'', '$condiciones', 'espera', '$fecha', '01.01.0101', '01.01.0101', '01.01.0101', '0','proceso', '".trim($trabajos)."', '$fecha', 
						'$user1', '$garantia', '$tipo', '$folioJy', '$ruta', '$caratula')";
		$result = $this->EjecutaQuerySimple();
		//var_dump($result);
		return $result;
		unset($result);
	}
        
        function GuardaFotos($fotos, $tarjeta){
            /*Function para guardar las fotos*/
        if (isset($fotos['archivo']["error"]))
                {
                    echo "Error: " . $fotos['archivo']['error'] . "<br>";
                }
              else
                {
                  //var_dump($_FILES);
                  //$test = $_POST['test'];
                 $ruta = "./image/".date('Y')."/".date('m')."/".date('d')."/".$tarjeta;
                 $ruta2 = "image/".date('Y')."/".date('m')."/".date('d')."/".$tarjeta."/";
                 //mkdir($ruta, 0700);
                 if(file_exists($ruta)){
                     echo 'la ruta ya existe';
                 }else{
                     mkdir($ruta, 0777, true);
                 }
                 //var_dump($fotos);
                 //echo count($fotos['name']);

                 for($i = 0; $i<count($fotos['name']);$i++){
                      /*echo $test;
                      echo "Nombre: " . $_FILES['archivo']['name'][$i] . "<br>";
                      echo "Tipo: " . $_FILES['archivo']['type'][$i] . "<br>";
                      echo "Tamaño: " . ($_FILES["archivo"]['tmp_name'][$i] / 1024) . " kB<br>";
                      echo "Carpeta temporal: " . $_FILES['archivo']['size'][$i];*/
                      /*ahora con la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
                      move_uploaded_file($fotos['tmp_name'][$i], $ruta2.$fotos['name'][$i] );
                }

                }
                
                return $ruta;
        }

	function ObtieneRegSC(){
		$this->query = "SELECT first 1 ID
                                FROM ODT
                                ORDER BY ID DESC";
						
		$r = $this->QueryObtieneDatos();
		
		return	$r;
	}

	function ObtieneClaveCte($nombre){
		$this->query = "SELECT first 1 clave
                                FROM clientes
                                WHERE nombre CONTAINING '$nombre'";	
		$r = $this->QueryObtieneDatos();		
		return	$r;
	}

	/*guarda datos de reloj*/
	function GuardaReloj($tarjeta, $marca, $mod, $nocaja, $calibre, $matcaja, $maquina, $matpulso, $desc_reloj, $tipomaq, $detalleCaja){
		$rs = $this->ObtieneCveReloj();
		$cveReloj = (int) $rs->CVE_RELOJ + 1;
		$this->query = "INSERT INTO reloj (ID, TARJETA, CVE_RELOJ, MARCA, MODELO, NO_CAJA, CALIBRE, MAQUINA, MAT_CAJA, MAT_PULSO, TIPO_MAQUINA, DESCR_RELOJ, DETALLE_CAJA)
						VALUES ($cveReloj, $tarjeta, $cveReloj, '$marca', '$mod', '$nocaja', '$calibre', '$maquina', '$matcaja', '$matpulso', '$tipomaq', '$desc_reloj', '$detalleCaja')";
		$result = $this->EjecutaQuerySimple();
		return $result;
	}

	/*para obtener clave del ultimo reloj insertado*/
	function ObtieneCveReloj(){
		$this->query = "SELECT first 1 cve_reloj
  						FROM reloj
  						ORDER BY id DESC";	 					
		$r = $this->QueryObtieneDatos();		
		return	$r;
	}
	
	
	function ObtieneCteT($tarjeta){
		$this->query = "SELECT b.NOMBRE, b.TELEFONO, b.EMAIL, b.RFC
						FROM ODT a
						INNER JOIN CLIENTES b on a.CVE_CTE = b.CLAVE
						WHERE a.TARJETA = $tarjeta";
		$res = $this->QueryObtieneDatos();
		if(count($res) > 0){
				return $res;
		}
		return 0;
	}
	
	function ConsultaUsuarios(){
		$this->query = "SELECT *
						FROM RP_USERS
						WHERE USER_STATUS != 2"; 					
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
	}
	/*Trae clientes*/
	function ConsultaClientes(){
		$this->query = "SELECT a.CLAVE, a.NOMBRE, a.TELEFONO, a.CALLE, a.EMAIL
						FROM CLIENTES a
						WHERE ESTATUS = 1"; 
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
	}
	
	function TraeDatosCajaExistente($nocaja){
		$this->query = "SELECT b.MARCA, b.MAQUINA, b.DESCR_RELOJ, b.NO_CAJA, b.CALIBRE, b.MAT_CAJA, b.DETALLE_CAJA, 
						b.MODELO, a.REFERENCIA, b.MAT_PULSO
						FROM ODT a
						RIGHT JOIN RELOJ b
						ON a.TARJETA = b.TARJETA
						WHERE b.NO_CAJA = '$nocaja'";
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
	}
	
	
	function ConsultaEditaTarjeta($tarjeta){
		$this->query = "SELECT a.ID, a.CLAVE, a.TARJETA, b.NOMBRE, c.MARCA, a.REFERENCIA, a.CVE_SERVICIO, a.COSTOS, a.MN, a.RECIBO_PLUER, a.CONDICION_RELOJ, a.AUTORIZADO, a.ENTRADA_CAJA, 
                                a.RECIBE_RELOJERO, a.ENTREGA_RELOJERO, a.ENTREGA_CLIENTE, a.CVE_RELOJERO, a.ESTATUS, a.TRABAJOS, a.FECHACREACION_ODT, a.ULTIMO_CAMBIO, c.MAQUINA, a.REFERENCIA, c.CALIBRE,
                                d.NOMBRE as NOMBRE_RELOJERO, c.MODELO, c.NO_CAJA, c.MAT_CAJA, c.MAT_PULSO, c.TIPO_MAQUINA, c.DETALLE_CAJA, a.TRABAJOS, a.RUTA_FOTOS, a.FOLIOJY,
                                b.EMAIL, c.DESCR_RELOJ, a.GARANTIA, a.DIAGNOSTICO, a.CARATULA
                                FROM ODT a 
                                LEFT JOIN CLIENTES b
                                ON a.CVE_CTE = b.CLAVE
                                LEFT JOIN RELOJ c
                                ON a.CVE_RELOJ= c.CVE_RELOJ
                                LEFT JOIN RELOJERO d
                                on a.CVE_RELOJERO=d.CLAVE
                                WHERE a.tarjeta = '$tarjeta'"; 
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
	}
        
        function TraeCostServ($tarjeta){
		$this->query = "SELECT CVE_SERVICIO, COSTOS FROM ODT
                                WHERE TARJETA = '$tarjeta'"; 
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
	}
        
        /*Reportes*/
        function ObtieneReporteMarca($marca){
            $this->query = "SELECT a.ID, a.CLAVE, a.TARJETA, b.NOMBRE, c.MARCA, a.REFERENCIA, a.CVE_SERVICIO, a.COSTOS, a.MN, a.RECIBO_PLUER, a.CONDICION_RELOJ, a.AUTORIZADO, a.ENTRADA_CAJA, 
                                a.RECIBE_RELOJERO, a.ENTREGA_RELOJERO, a.ENTREGA_CLIENTE, a.CVE_RELOJERO, a.ESTATUS, a.TRABAJOS, a.FECHACREACION_ODT, a.ULTIMO_CAMBIO, c.MAQUINA, a.REFERENCIA, c.CALIBRE,
                                d.NOMBRE as NOMBRE_RELOJERO, c.MODELO, c.NO_CAJA, c.MAT_CAJA, c.MAT_PULSO, c.TIPO_MAQUINA, c.DETALLE_CAJA, a.TRABAJOS, a.RUTA_FOTOS,
                                b.EMAIL
                                FROM ODT a 
                                LEFT JOIN CLIENTES b
                                ON a.CVE_CTE = b.CLAVE
                                LEFT JOIN RELOJ c
                                ON a.CVE_RELOJ= c.CVE_RELOJ
                                LEFT JOIN RELOJERO d
                                on a.CVE_RELOJERO=d.CLAVE
                                WHERE c.MARCA = '$marca'"; 
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
        }
        
        function ObtieneReporteMarcaMod($marca, $mod){
             $this->query = "SELECT * FROM ODT o
                            JOIN RELOJ r on o.TARJETA = r.TARJETA
                            JOIN CLIENTES c on o.CVE_CTE = c.CLAVE
                            WHERE r.MARCA like '%$marca%' and MODELO like '%$mod%'"; 
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
        }
        
        function ObtieneReporteFechas($fecha1, $fecha2){
            $this->query = "SELECT a.ID, a.CLAVE, a.TARJETA, b.NOMBRE, c.MARCA, a.REFERENCIA, a.CVE_SERVICIO, a.COSTOS, a.MN, a.RECIBO_PLUER, a.CONDICION_RELOJ, a.AUTORIZADO, a.ENTRADA_CAJA, 
                                a.RECIBE_RELOJERO, a.ENTREGA_RELOJERO, a.ENTREGA_CLIENTE, a.CVE_RELOJERO, a.ESTATUS, a.TRABAJOS, a.FECHACREACION_ODT, a.ULTIMO_CAMBIO, c.MAQUINA, a.REFERENCIA, c.CALIBRE,
                                d.NOMBRE as NOMBRE_RELOJERO, c.MODELO, c.NO_CAJA, c.MAT_CAJA, c.MAT_PULSO, c.TIPO_MAQUINA, c.DETALLE_CAJA, a.TRABAJOS, a.RUTA_FOTOS,
                                b.EMAIL
                                FROM ODT a 
                                LEFT JOIN CLIENTES b
                                ON a.CVE_CTE = b.CLAVE
                                LEFT JOIN RELOJ c
                                ON a.CVE_RELOJ= c.CVE_RELOJ
                                LEFT JOIN RELOJERO d
                                on a.CVE_RELOJERO=d.CLAVE
                                WHERE a.ENTRADA_CAJA between '$fecha1' and '$fecha2'"; 
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
        }
        
        function ObtieneReporteServicio($servicio){
            $this->query = "SELECT a.ID, a.CLAVE, a.TARJETA, b.NOMBRE, c.MARCA, a.REFERENCIA, a.CVE_SERVICIO, a.COSTOS, a.MN, a.RECIBO_PLUER, a.CONDICION_RELOJ, a.AUTORIZADO, a.ENTRADA_CAJA, 
                                a.RECIBE_RELOJERO, a.ENTREGA_RELOJERO, a.ENTREGA_CLIENTE, a.CVE_RELOJERO, a.ESTATUS, a.TRABAJOS, a.FECHACREACION_ODT, a.ULTIMO_CAMBIO, c.MAQUINA, a.REFERENCIA, c.CALIBRE,
                                d.NOMBRE as NOMBRE_RELOJERO, c.MODELO, c.NO_CAJA, c.MAT_CAJA, c.MAT_PULSO, c.TIPO_MAQUINA, c.DETALLE_CAJA, a.TRABAJOS, a.RUTA_FOTOS,
                                b.EMAIL
                                FROM ODT a 
                                LEFT JOIN CLIENTES b
                                ON a.CVE_CTE = b.CLAVE
                                LEFT JOIN RELOJ c
                                ON a.CVE_RELOJ= c.CVE_RELOJ
                                LEFT JOIN RELOJERO d
                                on a.CVE_RELOJERO=d.CLAVE
                                WHERE a.TRABAJOS containing '$servicio'"; 
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
        }
	
	function TraeRelojeros(){
		$this->query = "SELECT * FROM RELOJERO"; 
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
	}
	
	function ConsultaRelojeros(){
		$this->query = "SELECT a.CLAVE, a.NOMBRE, a.TELEFONO, a.ESTADO
						FROM RELOJERO a";
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
	}
	
	function InsertaNuevoRelojero($nombre, $tel, $email){
		$rs = $this->ObtieneCveCelojero();
		$id = (int) $rs->CLAVE + 1;
		$this->query = "INSERT INTO RELOJERO 
                                (CLAVE, NOMBRE, CALLE, COLONIA, MUNICIPIO, ESTADO, TELEFONO)
                                VALUES 
                                ($id, '$nombre', '', '', '', '$email', '$tel')";
		$rs = $this->EjecutaQuerySimple();
		return $rs;
	}
	
	function ObtieneCveCelojero(){
		$this->query = "SELECT first 1 CLAVE
  						FROM RELOJERO
  						ORDER BY CLAVE DESC";	 					
		$r = $this->QueryObtieneDatos();		
		return	$r;
	}

	function ObtieneTarjeta(){
		$this->query = "SELECT first 1 tarjeta
  						FROM odt
  						ORDER BY tarjeta DESC";	 					
		$r = $this->QueryObtieneDatos();		
		return	$r;
	}
	/*Funcion para mostrar los trabajos pendientes*/
	function ConsultaOdt(){
		$this->query = "SELECT a.CLAVE, a.TARJETA, a.REFERENCIA, a.TRABAJOS, a.RECIBE_RELOJERO, b.CALIBRE, 
                                b.MARCA, b.MAT_CAJA, b.MAT_PULSO, b.NO_CAJA, b.MODELO, a.FECHACREACION_ODT, a.AUTORIZADO
                                FROM odt a 
                                JOIN RELOJ b on (a.cve_reloj = b.CVE_RELOJ)
                                WHERE a.ESTATUS = 'proceso'
                                ORDER BY a.TARJETA DESC";
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
	}
		
	function ConsultaEjemplo(){
		/*$this->query = "SELECT a.REMISION, a.TARJETA, a.NOMBRE_CLIENTE, a.JOYERIA, a.MARCA, a.MODELO, a.NO_CAJA, a.REFERENCIA, 
		a.CALIBRE, a.MAQUINA, a.SERVICIO, a.MN, a.RECIBO_PLUER, a.AUTORIZA, a.ENTRADA_CAJA, a.ENTR_R, a.SALIDA_R, a.ENTREGADO, 
		a.RELOJERO FROM EJEMPLO a"; WHERE a.ESTATUS = 'finalizado' and a.ESTATUS = 'Cancelado'*/
		$this->query = "SELECT a.ID, a.CLAVE, a.TARJETA, b.NOMBRE, a.CVE_RELOJ, a.REFERENCIA, a.CVE_SERVICIO, a.MN, a.RECIBO_PLUER, a.AUTORIZADO, 
						a.ENTRADA_CAJA, a.RECIBE_RELOJERO, a.ENTREGA_RELOJERO, a.ENTREGA_CLIENTE, a.CVE_RELOJERO, a.ESTATUS, a.TRABAJOS, 
						a.FECHACREACION_ODT
						FROM ODT a
						LEFT JOIN CLIENTES b on a.CVE_CTE = b.CLAVE
						WHERE a.ESTATUS in('finalizado', 'Cancelado')
						ORDER BY a.TARJETA DESC";
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
		/*$result = $this->EjecutaQuerySimple();
		if($this->NumRows($result) > 0){
			while ( $tsArray = $this->FetchAs($result) ) 
					$data[] = $tsArray;
				return $data;
			}		
		return 0;*/
	}
	
	function ConsultaOdtAct(){
		$this->query = "SELECT a.ID, a.CLAVE, a.TARJETA, b.NOMBRE, c.MARCA as CVE_RELOJ, a.REFERENCIA, a.CVE_SERVICIO, a.MN, a.RECIBO_PLUER, a.AUTORIZADO, 
						a.ENTRADA_CAJA, a.RECIBE_RELOJERO, a.ENTREGA_RELOJERO, a.ENTREGA_CLIENTE, a.CVE_RELOJERO, a.ESTATUS, a.TRABAJOS, 
						a.FECHACREACION_ODT
						FROM ODT a
						LEFT JOIN CLIENTES b on a.CVE_CTE = b.CLAVE
						LEFT JOIN RELOJ c on a.CVE_RELOJ=c.CVE_RELOJ
						WHERE a.ESTATUS = 'proceso'
						ORDER BY a.TARJETA DESC";
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
	}
	
	function TraeCte(){
		$this->query = "SELECT first 1 clave, nombre FROM clientes 
                                ORDER BY cast(clave as decimal) DESC";
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
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
	
	/*inserta nuevo cliente*/
	function InsertAltCte($nombre, $rfc, $calle, $colonia, $municipio, $estado, $tel, $email, $joyeria){
		$rs = $this->ObtieneCveCte();
		//var_dump($rs);
		$id = (int) $rs->CLAVE + 1;
		$this->query = "INSERT INTO CLIENTES 
                                (CLAVE, ESTATUS, NOMBRE, RFC, CALLE, COLONIA, MUNICIPIO, ESTADO, TELEFONO, EMAIL, SALDO, JOYERIA)
                                VALUES 
                                ($id, 1, '$nombre', '$rfc', '$calle', '$colonia', '$municipio', '$estado', '$tel', '$email', 0.00, '$joyeria')";
		$rs = $this->EjecutaQuerySimple();
		return $rs;
		}
	
	function ObtieneCveCte(){
		$this->query = "SELECT first 1 clave
                                FROM CLIENTES
                                ORDER BY cast(clave as decimal) DESC";					
		$r = $this->QueryObtieneDatos();		
		return	$r;
	}
	
	function InsertaNuevoUser($user, $pass, $email, $rol){
		$rs = $this->ObtieneCveUser();
		$id = (int) $rs->COUNT + 1;
		$this->query = "INSERT INTO RP_USERS 
						(ID, USER_LOGIN, USER_PASS, USER_EMAIL, USER_STATUS, USER_ROL)
 						VALUES ('$id', '$user', '$pass', '$email', 1, '$rol')";
		$rs = $this->EjecutaQuerySimple();
		//var_dump($rs);
		return $rs;
	}
	
	function ObtieneDatoUser($id){
		$this->query = "SELECT *
  						FROM RP_USERS 
  						WHERE id = $id"; 					
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
	}
	
	function ObtieneDatoRelojero($id){
		$this->query = "SELECT *
                                FROM RELOJERO 
                                WHERE CLAVE = $id"; 					
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
	}
	
	function ObtieneDatoCte($id){
		$this->query = "SELECT *
  						FROM CLIENTES 
  						WHERE CLAVE = $id"; 					
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
	}
	
	function EliminaUsuario($id){
		$this->query = "DELETE FROM RP_USERS 
						WHERE id = $id";
		$rs = $this->EjecutaQuerySimple();
		return $rs;
		
	}
	
	function EliminaRelojeros($id){
		$this->query = "DELETE FROM RELOJERO 
						WHERE CLAVE = $id";
		$rs = $this->EjecutaQuerySimple();
		return $rs;
	}
	
	function EliminaCtes($id){
		$this->query = "DELETE FROM CLIENTES 
						WHERE CLAVE = $id";
		$rs = $this->EjecutaQuerySimple();
		return $rs;
	}
	
	function ObtieneCveUser(){
		$this->query = "SELECT COUNT(*)
  						FROM RP_USERS";						
		$r = $this->QueryObtieneDatos();		
		return	$r;
	}

	/*function InsertDatOdt($nombre, $marca, $mod, $nocaja, $calibre, $matcaja, $fecha, $ref, $maquina, $matpulso, $trabajos){
		$rs = $this->ObtieneClaveCte();
		$id = (int) $rs["COUNT"] + 1;
	}*/

	function ObtieneClaveOdt(){
		$this->query = "SELECT COUNT(*)
  						FROM odt";						
		$r = $this->QueryObtieneDatos();		
		return	$r;
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
  						FROM ODTS";
						
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
	
	function ActualizaServiciosCosto($servicios, $costos, $total, $tarjeta){
		
		$this->query = "UPDATE odt 
						SET CVE_SERVICIO = '$servicios', COSTOS = '$costos', MN = '$total'						
						WHERE TARJETA = '$tarjeta'"; 
		
		$result = $this->EjecutaQuerySimple();
		//var_dump($result);
		if(count($result) > 0){		
			return true;
		}else{
			return 0;
		}
	}
	
	function BuscaReloj($numerocaja){
		$this->query = "SELECT * FROM RELOJ 
						WHERE NO_CAJA = '$numerocaja'"; 					
		$data = "";
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				if($data){
					return true;
				}else{
					return false;
				}
	}
	
	function CompruebaCte($term){
		echo $this->query = "SELECT nombre
						FROM clientes 
						WHERE nombre CONTAINING '".$term."'"; 		
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$tsArray->NOMBRE =  htmlentities(stripslashes($tsArray->NOMBRE));
					//$row->CLAVE = (int)$row->CLAVE;
					$row_set[] = $row->NOMBRE;//build an array		
			}
				if(isset($row_set)){
						return json_encode($row_set);
					}else{
						$dardealta[] = "¡¡EL CLIENTE NO ESTA REGISTRADO, FAVOR DE DARLO DE ALTA!!";	
						return json_encode($dardealta);
					}
	}
	
	function ActualizaRelojeroOdt($tarjeta, $relojero, $calibre, $referencia, $maquina, $trabajos){
		//$cve_relojero = $this->ObtieneCveReloero($relojero);
                $this->query = "SELECT a.cve_relojero, a.referencia, b.maquina, b.calibre
                                FROM ODT a
                                LEFT JOIN reloj b
                                on (a.TARJETA = b.TARJETA)
                                WHERE a.TARJETA = '$tarjeta'";
                $resultQ = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($resultQ)){ 
					$data[] = $tsArray;			
			}
                /*if($relojero == ''){
                    $relojero = 0;
                }
                
                if($calibre == ''){
                    $calibre = 0;
                }*/
            
		$this->query = "UPDATE odt 
                                SET CVE_RELOJERO = '$relojero',  REFERENCIA = '$referencia', DIAGNOSTICO = '".trim($trabajos)."'
                                WHERE TARJETA = '$tarjeta'";
		$result = $this->EjecutaQuerySimple();
		
		$this->query = "UPDATE reloj
                                SET MAQUINA = '$maquina', CALIBRE = '$calibre'
                                WHERE TARJETA = '$tarjeta'";
						
		$result1 = $this->EjecutaQuerySimple();
		//var_dump($result);
		if(count($result) > 0){		
			return true;
		}else{
			return 0;
		} 
	}
	
	function ActualizaOdt($tarjeta, $autorizado, $servicio, $recibe_relojero, $entrega_relojero, $entrega_cliente, $cve_relojero, $user){
			
		$datos = $this->ObtieneDatosAntesActualizar($tarjeta);
		
		$usuario = $user->USER_LOGIN;
		//$servicio1 = $servicio == 0 ? NULL : $servicio;
		//$costo1 = $costo == 0 ? 0 : $costo;
		//$autorizado1 = $autorizado == 'Autorizado' ? 'Autorizado' : 'Espera';
		$recibe_relojero1 = $recibe_relojero == 0 ? '01.01.0101' : $recibe_relojero;
		$entrega_relojero1 = $entrega_relojero == 0 ? '01.01.0101' : $entrega_relojero;
		$entrega_cliente1 = $entrega_cliente == 0 ? '01.01.0101' : $entrega_cliente;
		$cve_relojero1 = $cve_relojero == 0 ? 0 : $cve_relojero;
		if($entrega_cliente1 != '01.01.0101'){
			$status = 'finalizado';
		}else{
			$status = 'proceso';
		}
                if($autorizado == 'Cancelado'){
                    $this->query = "UPDATE odt 
                                SET ESTATUS = '$autorizado', AUTORIZADO = '$autorizado'
                                WHERE TARJETA = '$tarjeta'";
                }else{
                    $this->query = "UPDATE odt 
                                SET AUTORIZADO = '$autorizado', RECIBE_RELOJERO = '$recibe_relojero1', 
                                ENTREGA_RELOJERO = '$entrega_relojero1', ENTREGA_CLIENTE = '$entrega_cliente1', ESTATUS = '$status',
                                CVE_RELOJERO = '$cve_relojero1', ULTIMO_CAMBIO = '$usuario'
                                WHERE TARJETA = '$tarjeta'"; 
                }
		
		
		$result = $this->EjecutaQuerySimple();
		//var_dump($result);
		if(count($result) > 0){		
			return true;
		}else{
			return 0;
		}
	}
	
	function ObtieneDatosAntesActualizar($tarjeta){
		$this->query = "SELECT cve_servicio, mn, autorizado, recibe_relojero, entrega_relojero, entrega_cliente, cve_relojero
						FROM odt WHERE tarjeta = '$tarjeta'"; 					
		
		$result = $this->QueryObtieneDatosN();
			while ( $tsArray = ibase_fetch_object($result)){ 
					$data[] = $tsArray;			
			}
				return $data;
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
	/*funcion clientes ajax autocomplete*/
	function TraeClientes($buscar){
    	$this->query = "SELECT nombre
                        FROM clientes 
                        WHERE nombre CONTAINING '".$buscar."'";
    	$result = $this->QueryDevuelveAutocomplete();
        /*$result = $this->QueryObtieneDatosN();
        while ($tsArray = ibase_fetch_object($result)){
                $data[] = $tsArray;
        }*/
        return $result;
    }
	
}
?>
<?php
session_start();
session_cache_limiter('private_no_expire');
require_once('app/controller/rpluer.controller.php');
$controller = new rpluer_controller;

/*funcion para consultar clientes*/
if(isset($_GET['term'])){
	$buscar = $_GET['term'];
	$nombre = $controller->TraeClientes($buscar);
	if($nombre > 0){
            echo json_encode($nombre);
	}else{
            $dardealta[] = "¡¡EL CLIENTE NO ESTA REGISTRADO, FAVOR DE DARLO DE ALTA!!";	
            echo json_encode($dardealta);
	}

}else{

if(isset($_POST['formulariofolio'])){
	//$tipomaq = $_POST['maquina'];
        if(isset($_POST['marca_desc'])){
            $desc_reloj = $_POST['marca_desc'];
        }else{
            $desc_reloj = 0;
        }        
        //$nombre = $_POST['cvecte'] == '' ? 0 : $_POST['cvecte'];
        if(isset($_POST['cvecte'])){
            $nombre = $_POST['cvecte'];
        }else{
            $nombre = 0;
        }
        //$marca = $_POST['marcas'] == '' ? 0 : $_POST['marcas'];
        if(isset($_POST['marcas'])){
            $marca = $_POST['marcas'];
        }else{
            $marca = 0;
        }
        //$nocaja = $_POST['nocaja'] == '' ? 0 : $_POST['nocaja'];
        if(isset($_POST['nocaja'])){
            $nocaja = $_POST['nocaja'];
        }else{
            $nocaja = 0;
        }
        //$matcaja = $_POST['matcaja'] == '' ? 0 : $_POST['matcaja'];
        if(isset($_POST['matcaja'])){
            $matcaja = $_POST['matcaja'];
        }else{
            $matcaja = 0;
        }
        //$fecha = $_POST['fecha'] == '' ? 0 : $_POST['fecha'];
        if(isset($_POST['fecha'])){
            $fecha = $_POST['fecha'];
        }else{
            $fecha = 0;
        }
        //$mod = $_POST['modelo'] == '' ? 0 : $_POST['modelo'];
        if(isset($_POST['modelo'])){
            $mod = $_POST['modelo'];
        }else{
            $mod = 0;
        }
	
	//$tipomaq = 0;
        if(isset($_POST['maquina'])){
            $tipomaq = $_POST['maquina'];
        }else{
            $tipomaq = 0;
        }
	
	//$ref = 0;
        if(isset($_POST['referencia'])){
            $ref = $_POST['referencia'];
        }else{
            $ref = 0;
        }
	/*$calibre = $_POST['calibre'];*/
	
	$calibre = 0;
	
	$maquina = 0;
        
        
	//$matpulso = $_POST['matpulso'] == '' ? 0 : $_POST['matpulso'];
        if(isset($_POST['matpulso'])){
            $matpulso = $_POST['matpulso'];
        }else{
            $matpulso = 0;
        }
	//$trabajos = $_POST['trabajos'] == '' ? 0 : $_POST['trabajos'];
        if(isset($_POST['trabajos'])){
            $trabajos = $_POST['trabajos'];
        }else{
            $trabajos = 0;
        }
	//$detalleCaja = $_POST['cajaadc'] == '' ? 0 : $_POST['cajaadc'];
        if(isset($_POST['cajaadc'])){
            $detalleCaja = $_POST['cajaadc'];
        }else{
            $detalleCaja = 0;
        }
	//$condiciones = $_POST['condiciones'] == '' ? 0 : $_POST['condiciones'];
        if(isset($_POST['condiciones'])){
            $condiciones = $_POST['condiciones'];
        }else{
            $condiciones = 0;
        }
	//$garantia = $_POST['garantia'] == '' ? 0 : $_POST['garantia'];
        if(isset($_POST['garantia'])){
            $garantia = $_POST['garantia'];
        }else{
            $garantia = 0;
        }
        $tipo = $_POST['tipo'];
        //$foliojy = $_POST['foliojoyeria'];
        if(isset($_POST['foliojoyeria'])){
            $foliojy = $_POST['foliojoyeria'];
        }else{
            $foliojy = 0;
        }
        
        if(isset($_POST['caratula'])){
            $caratula = $_POST['caratula'];
        }else{
            $caratula = 0;
        }
        
        $fotos = $_FILES['archivo'];
        
        
        //var_dump($_FILES['archivo']);
        //var_dump($fotos);
        
	$controller->CreaFolio($nombre, $marca, $mod, $nocaja, $calibre, $matcaja, $fecha, $ref, $maquina, $matpulso, $trabajos, $desc_reloj, $tipomaq, $detalleCaja, $condiciones, $garantia, $fotos, $tipo, $foliojy, $caratula);
	
}elseif(isset($_POST['sesion'])){
	$controller->LoginA($_POST['user'], $_POST['contra']);
}elseif(isset($_POST['formaltrelojero'])){
	$nombre = $_POST['nombre'];
	$tel = $_POST['telefono'];
	$email = $_POST['email'];
	$controller->AltaRelojero($nombre, $tel, $email);
	
}elseif(isset($_POST['b'])){
	$numerocaja = $_POST['b'];
	$result = $controller->BuscaReloj($numerocaja);
	if($result == true){
		echo "El reloj ya esta registrado en la base de datos, ¿deseas cargar sus datos? <a href='index.php?action=CargaDatosCaja&caja=".$numerocaja."'><div class='btn btn-alert'>Cargar!</div></a>";
	}else{
		echo "El reloj no se encuentra en la base de datos";
	}
	exit;
}elseif(isset($_POST['cteE'])){/*No se usara, queda el de autocomplete*/
	$cliente = $_POST['cteE'];
	$result = $controller->BuscaCte($numerocaja);
	if($result == true){
		echo "El Cliente ya esta registrado en la base de datos, agregar <button class='btn btn-alert'>Agregar!</button>";
	}else{
		echo "El reloj no se encuentra en la base de datos";
	}
	exit;
}elseif(isset($_POST['servicioCosto'])){
	$tarjeta = $_POST['tarjeta'];
	$servicios = "";
	for($i = 0; $i < count($_POST['servicio']); $i++){
		$servicios .= $_POST['servicio'][$i] . "<br />";
	}
	//echo $servicios;
	$total = 0;
	$costos = "";
	for($i = 0; $i < count($_POST['costo']); $i++){
		$costos .= "$ " . $_POST['costo'][$i] . "<br />";
		$total += $_POST['costo'][$i];
	}
        
	//echo $costos[0];
	//echo $total;
	//var_dump($servicios);
	//var_dump($costos);
	$controller->GuardaServiciosCosto($servicios, $costos, $total, $tarjeta);
	//var_dump($_POST);
	
}elseif(isset($_POST['cambiosodt'])){
	$tarjeta = $_POST['tarjeta'];
	/*revisar si traen daros los post*/
		//$autorizado = $_POST['accion'] == true ? 'Autorizado' : 'Espera';
                if(isset($_POST['accion'])){
                    if($_POST['accion'] == 'autorizado'){
                        $autorizado = 'Autorizado';
                    }elseif($_POST['accion'] == 'cancelado'){
                        $autorizado = 'Cancelado';
                    }elseif($_POST['accion'] == ''){
                        $autorizado = 'Espera';
                    }
                }else{
                    $autorizado = 'Espera';
                }
                //echo $autorizado;
		$servicio = isset($_POST['servicio']) ? $_POST['servicio'] : 0;
		//$costo = isset($_POST['costo']) ? $_POST['costo']  : 0;
		$recibe_relojero = isset($_POST['recibe_relojero']) ? $_POST['recibe_relojero'] : 0;
		$entrega_relojero = isset($_POST['entrega_relojero']) ? $_POST['entrega_relojero'] : 0;
		$entrega_cliente = isset($_POST['entrega_cliente']) ? $_POST['entrega_cliente'] : 0;
		$cve_relojero = isset($_POST['cverelojero']) ? $_POST['cverelojero'] : 0;
                if(isset($_POST['enviarmail'])){
                        $enviar = $_POST['enviarmail'];
                    }else{
                        $enviar = 'off';
                    }

                    $email = $_POST['email'];
		$controller->ActualizaOdt($tarjeta, $autorizado, $servicio, $recibe_relojero, $entrega_relojero, $entrega_cliente, $cve_relojero, $enviar, $email);
	
	
}elseif(isset($_POST['cambiorelojero'])){
        /*$maquina = '';
        $referencia = '';
        $calibre = '';
        $relojero = '';
        $tarjeta = '';
        $trabajos = '';*/
        if(isset($_POST['maquina']) && $_POST['maquina'] != ''){
            $maquina = $_POST['maquina'];
        }else{
            $maquina = 0;
        }
        if(isset($_POST['referencia']) && $_POST['referencia'] != ''){
            $referencia = $_POST['referencia'];
        }else{
            $referencia = 0;
        }
        if(isset($_POST['calibre']) && $_POST['calibre'] != ''){
            $calibre = $_POST['calibre'];
        }else{
            $calibre = 0;
        }
        if(isset($_POST['cverelojero']) && $_POST['cverelojero'] != ''){
            $relojero = $_POST['cverelojero'];
        }else{
            $relojero = 0;
        }
        
        if(isset($_POST['tarjeta']) && $_POST['tarjeta'] != ''){
            $tarjeta = $_POST['tarjeta'];
        }else{
            $tarjeta = 0;
        }
        
        if(isset($_POST['diagnostico']) && $_POST['diagnostico'] != ''){
            $trabajos = $_POST['diagnostico'];
        }else{
            $trabajos = 0;
        }
        
	/*echo $maquina = isset($_POST['maquina']) ? $_POST['maquina'] : 0;
	echo $referencia = isset($_POST['referencia']) ? $_POST['referencia'] : 0;
	echo $calibre = isset($_POST['calibre']) ? $_POST['calibre'] : 0;
	echo $relojero = isset($_POST['cverelojero']) ? $_POST['cverelojero'] : 0;
	echo $tarjeta = isset($_POST['tarjeta']) ? $_POST['tarjeta'] : 0;
        echo $trabajos = $_POST['trabajos'];*/
        
        //echo "test".$maquina;
        //var_dump($_POST);
	$controller->AsignaRelojero($tarjeta, $relojero, $calibre, $referencia, $maquina, $trabajos);
        
}elseif(isset($_POST['formaltctef'])){
	$nombre = $_POST['nombre'];
	$tel = $_POST['tel'];
	$email = $_POST['email'];
	$rfc = '';
	$calle = $_POST['cel'];
	$colonia = '';
	$municipio = '';
	$estado = '';
	$joyeria = '';
	$controller->AltaClientef($nombre, $rfc, $calle, $colonia, $municipio, $estado, $tel, $email, $joyeria);
}elseif(isset($_POST['formaltcte'])){
	$nombre = $_POST['nombre'];
	$tel = $_POST['tel'];
	$email = $_POST['email'];
	$rfc = '';
	$calle = $_POST['cel'];
	$colonia = '';
	$municipio = '';
	$estado = '';
	$joyeria = '';
	/*
	$calle = $_POST['calle'];
	$colonia = $_POST['colonia'];
	$municipio = $_POST['municipio'];
	$estado = $_POST['estado'];	
	$joyeria =	$_POST['joyeria'];
	*/
	$controller->AltaCliente($nombre, $rfc, $calle, $colonia, $municipio, $estado, $tel, $email, $joyeria);
}elseif(isset($_POST['formaltctejy'])){
	$nombre = $_POST['nombre'];
	$tel = $_POST['tel'];
	$email = $_POST['email'];
	$rfc = '';
	$calle = $_POST['cel'];
	$colonia = '';
	$municipio = '';
	$estado = '';
	$joyeria = '';
	/*
	$calle = $_POST['calle'];
	$colonia = $_POST['colonia'];
	$municipio = $_POST['municipio'];
	$estado = $_POST['estado'];	
	$joyeria =	$_POST['joyeria'];
	*/
	$controller->AltaClientejy($nombre, $rfc, $calle, $colonia, $municipio, $estado, $tel, $email, $joyeria);
}elseif(isset($_POST['altanuserf'])){
	$user1 = $_POST['usuario'];
	$pass = $_POST['contrasena'];
	$email = $_POST['email'];
	$rol = $_POST['rol'];
	$controller->AltaUsuario($user1, $pass, $email, $rol);
}elseif(isset($_POST['rmarca'])){
    $marca = $_POST['marcas'];
    $controller->MuestraReporteMarca($marca);
}elseif(isset($_POST['rfecha'])){
    $fecha1 = $_POST['fecha'];
    $fecha2 = $_POST['fecha1'];
    $controller->MuestraReporteFechas($fecha1, $fecha2);
}elseif(isset($_POST['rservicio'])){
    $rservicio = $_POST['servicio'];
    $controller->MuestraReporteServicios($rservicio);
}elseif(isset($_POST['actualizausuario'])){
	$id = $_POST['id'];
}elseif(isset($_POST['rmarcamod'])){
    $marca = $_POST['marcas'];
    $mod = $_POST['modelo'];
    $controller->MuestraReporteMarcaMod($marca, $mod);
}else{

switch ($_GET['action']){
	case 'login':
		$controller->Login();
		break;
	/*case 'term':
		$term = $_GET['term'];
		$result = $controller->CompruebaCte($term);
		echo $result;
		exit;
		break;*/
	case 'CargaDatosCaja':
		$nocaja = $_GET['caja'];
		$controller->CargaDatosCaja($nocaja);
		break;
	case 'madmin':
		$controller->MenuAdmin();
		break;
	case 'inicio':
		$controller->Inicio();
		break;
        case 'zoom':
		$ruta = $_GET['ruta'];
                $controller->MuestraFotos($ruta);
                break;
	case 'joyeria':
		$controller->MenuJoyeria();
		break;
	case 'salir':
		$controller->CSesion();
		break;
	case 'odt':
		$controller->COdt();
		break;
	case 'hist':
		$controller->Hist();
		break;
	case 'usr':
		$controller->Usuarios();
		break;
	case 'ctes':
		$controller->Clientes();
		break;
	case 'relojeros':
		$controller->Relojeros();
		break;
	case'editrelojero':
		$id = $_GET['id'];
		$controller->EditaRelojero($id);
		break;
	case 'editreloj':
		$tarjeta = $_GET['tarjeta'];
		$controller->EditaReloj($tarjeta);
		break;
	case 'mmostrador':
		$controller->MenuMostrador();
		break;
	case 'edituser':
		$id = $_GET['id'];
		$controller->EditaUser($id);
		break;	
	case 'elimuser':
		$id = $_GET['id'];
		$controller->EliminaUser($id);
		break;
	case 'imprimecliente':
		$tarjeta = $_GET['tarjeta'];
		$controller->TarjetaCte($tarjeta);
		break;
	case 'imprimepluer':
		$tarjeta = $_GET['tarjeta'];
		$controller->TarjetaPluer($tarjeta);
		break;
	case 'elimrelojero':
		$id = $_GET['id'];
		$controller->EliminaRelojero($id);
		break;
	case 'elimcte':
		$id = $_GET['id'];
		$controller->EliminaCte($id);
		break;
	case 'odtm':
		$controller->AbreOdtm();
		break;
	case 'editatarjeta':
		$tarjeta = $_GET['tarjeta'];
		$controller->EditaTarjeta($tarjeta);
		break;
	case 'editcte':
		$id = $_GET['id'];
		$controller->EditCte($id);
		break;
        case 'rmarca':
                $controller->RMarca();
                break;
        case 'rfecha':
                $controller->RFecha();
                break;
        case 'rservicio':
                $controller->RServicio();
                break;
        case 'rmarcamod':
                $controller->RMarcamod();
                break;
	default:
		header('Location: index.php?action=login');
		break;
}
}
}
?>
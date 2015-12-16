<?php
session_start();
session_cache_limiter('private_no_expire');
require_once('app/controller/rpluer.controller.php');
$controller = new rpluer_controller;

if(isset($_POST['formulariofolio'])){
	$nombre = $_POST['nombre'];
	$email = $_POST['correo'];
	$marca = $_POST['marca'];
	$nocaja = $_POST['nocaja'];
	$calibre = $_POST['calibre'];
	$matcaja = $_POST['matcaja'];
	$fecha = $_POST['fecha'];
	$tel = $_POST['tel'];
	$ref = $_POST['referencia'];
	$maquina = $_POST['maquina'];
	$matpulso = $_POST['matpulso'];
	//$trabajos = $_POST['trabajos'];
	
	$controller->CreaFolio($nombre, $email, $marca, $nocaja, $calibre, $matcaja, $fecha, $tel, $ref, $maquina, $matpulso);
	
}elseif(isset($_POST['sesion'])){
	$controller->LoginA($_POST['user'], $_POST['contra']);
}else{

switch ($_GET['action']){
	case 'login':
		$controller->Login();
		break;
	case 'madmin':
		$controller->MenuAdmin();
		break;
	case 'inicio':
		$controller->Inicio();
		break;
	case 'salir':
		$controller->CSesion();
		break;
	case 'odt':
		$controller->COdt();
		break;
	default:
		header('Location: index.php?action=login');
		break;
}
}
?>
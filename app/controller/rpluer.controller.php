<?php
//session_start();
session_cache_limiter('private_no_expire');
require_once('app/model/rpluer.model.php');
require_once('fpdf/fpdf.php');

class rpluer_controller{
	
	function Login(){
			$pagina = $this->load_templateL('Login');
			$html = $this->load_page('app/views/modules/m.login.php');
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$this->view_page($pagina);
	}
	
	function LoginA($user, $pass){
		session_cache_limiter('private_no_expire');
		$data = new rpluer;
			$rs = $data->AccesoLogin($user, $pass);
			//var_dump($rs);
				if(count($rs) > 0){					
					$r = $data->CompruebaRol($user);
					//var_dump($r);
					if($r['USER_ROL'] == 'administrador'){ /*Cambio el fetch_assoc cambia la forma en acceder al dato*/
						$this->MenuAdmin();
					}elseif($r['USER_ROL'] == 'administracion'){
						$this->MenuAd();
					}elseif($r['USER_ROL'] == 'relojero'){
						$this->MenuRelojero();
					}else{
						
						$e = "Error en acceso 1, favor de revisar usuario y/o contraseña";
						header('Location: index.php?action=login&e='.urlencode($e)); exit;
					}
				}else{
					$e = "Error en acceso 2, favor de revisar usuario y/o contraseña";
						header('Location: index.php?action=login&e='.urlencode($e)); exit;
				}
	}
	
	function Inicio(){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$o = $_SESSION['user'];
			if($o['USER_ROL'] == 'administrador'){
				$this->MenuAdmin();
			}elseif($o['USER_ROL'] == 'administracion'){
				$this->MenuAd();
			}else{
				$this->MenuRelojero();
			}
		}
	}
	
	/*Carga menu de administrador*/
	function MenuAdmin(){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user']) && $_SESSION['user']['USER_ROL'] == 'administrador'){
			session_cache_limiter('private_no_expire');			
				$pagina = $this->load_template('Menu Admin');			
				$html = $this->load_page('app/views/modules/m.madmin.php');
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
				$this-> view_page($pagina);		
		}else{
				$e = "Favor de Revisar sus datos";
				header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}

	function MenuAd(){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/modules/m.mad.php');
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}
	
	/*Metodo para mostrar relojes en estatus 'porReparar'*/
	function MenuRelojero(){
		session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/modules/m.relojero.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			ob_start();	
			$exec = $data->ConsultaOdt();
			//var_dump($exec);
			if($exec > 0){						
				include 'app/views/modules/m.relojero.php';
				$table = ob_get_clean();
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$table , $pagina);
			}else{
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html.'<h2>No hay trabajos pendientes</h2>', $pagina);
			}
			
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}
	
	function COdt(){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra ODT');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.odt.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		ob_start(); 
		//generamos consulta
		$exec = $data->ConsultaEjemplo();
		if($exec > 0){
			include 'app/views/pages/p.odt.php';
			/* hasta aqui podemos utilizar los datos almacenados en buffer desde la vista, por ejemplo el arreglo $exec 
			 * sin tener que aparecer el arreglo en la vista, ya que lo llama desde memoria (Y), de nuevo, es necesario incluir la vista
			 * desde la cual haremos uso de los datos y luego mandarlo en el replace content como la nueva vista*/
			$table = ob_get_clean(); 
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$table , $pagina);
					}else{
						$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html.'<div class="alert-danger"><center><h2>No hay datos para mostrar</h2><center></div>', $pagina);
					}		
					$this->view_page($pagina);
			
			}else{
				$e = "Favor de Iniciar Sesión";
				header('Location: index.php?action=login&e='.urlencode($e)); exit;
			}
	}
	
	function CreaFolio($nombre, $email, $marca, $nocaja, $calibre, $matcaja, $fecha, $tel, $ref, $maquina, $matpulso){
		/*Insertarlos en una base de datos*/
		/*Crear formato de impresion*/
		$pdf = new FPDF();
			//Primera página
			/*$pdf->AddPage();
			$pdf->SetFont('Arial','',15);
			$pdf->Cell(2,20);
			$pdf->Image('app/views/images/Imagen1.png');
			$pdf->Ln();
			$pdf->Image('app/views/images/logos.png');
			$pdf->Cell(10, 20);
			$pdf->Ln();
			$pdf->Write(5, 'Ingenieria Suiza ');
			$pdf->Ln();
			$pdf->Write(6, $nombre);
			$pdf->Ln();
			$pdf->Write(7, $email);
			$pdf->Ln();
			$pdf->Write(8, $marca);
			$pdf->Ln();
			$pdf->Write(9, $nocaja);
			$pdf->Ln();
			$pdf->Write(10, $calibre);
			$pdf->Ln();
			$pdf->Write(11, $matcaja);
			$pdf->Ln();
			$pdf->Write(12, $fecha);
			$pdf->Ln();
			$pdf->Write(13, $tel);
			$pdf->Ln();
			$pdf->Write(14, $ref);
			$pdf->Ln();
			$pdf->Write(15, $maquina);
			$pdf->Ln();
			$pdf->Write(16, $matpulso);	*/
			
			$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
//inserto la cabecera poniendo una imagen dentro de una celda
$pdf->Cell(700,85,$pdf->Image('app/views/images/Imagen2.jpg',30,12,160),0,0,'C');
$pdf->Ln(9);
$pdf->Cell(100,12,"Nombre: ". $nombre);
$pdf->Cell(100,12,"No. Caja:  ". $nocaja);
$pdf->Line(35,40,190,40);
$pdf->Ln(7);
$pdf->Cell(100,12,"Calibre : ". $calibre);
$pdf->Cell(90,12,"Material Caja: " . $matcaja);
$pdf->Line(35,48,190,48);
$pdf->Ln(7);
$pdf->Cell(100,12,"Fecha: ". $fecha);
$pdf->Line(35,56,190,56);
$pdf->Ln(7);
$pdf->Cell(90,12,"Telefono: ".$tel);
$pdf->Line(35,62,190,62);
$pdf->Ln(7);
$pdf->Cell(100,12,"Referencia: ".$ref);
$pdf->Line(35,68,190,68);
$pdf->Ln(9);
$pdf->Cell(100,12,"Maquina: ".$maquina);
$pdf->Line(35,68,190,68);
$pdf->Ln(9);
$pdf->Cell(100,12,"Materia Pulso: ".$matpulso);
$pdf->Line(35,68,190,68);
$pdf->Ln(9);
$pdf->SetFont('Arial','B',10);
 
$pdf->Cell(60,12,'AUTORIZADO');
$pdf->Ln(9);
$pdf->Line(35,68,190,68);
$pdf->Cell(60,12,'Nombre y Firma');
 
$pdf->Ln(2);
 
$pdf->SetFont('Arial','',8);

			$pdf->Output('foliodepdf.pdf', 'd');
	}
	
	function CSesion(){
		session_destroy($_SESSION['user']);
		session_unset($_SESSION['user']);
		$e = "Session Finalizada";
		header('Location: index.php?action=login&e='.urlencode($e)); exit;
	}
	/*Obtiene y carga el template*/
	function load_template($title='Sin Titulo'){
		$pagina = $this->load_page('app/views/master.php');
		$header = $this->load_page('app/views/sections/s.header.php');
		$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
		$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
		return $pagina;
	}
	
	/*Header para login*/
	function load_templateL($title='Sin Titulo'){
		$pagina = $this->load_page('app/views/master.php');
		$header = $this->load_page('app/views/sections/header.php');
		$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
		$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
		return $pagina;
	}
	
	/* METODO QUE CARGA UNA PAGINA DE LA SECCION VIEW Y LA MANTIENE EN MEMORIA
		INPUT
		$page | direccion de la pagina 
		OUTPUT
		STRING | devuelve un string con el codigo html cargado
	*/	
   private function load_page($page){
		return file_get_contents($page);
	}
   
   /* METODO QUE ESCRIBE EL CODIGO PARA QUE SEA VISTO POR EL USUARIO
		INPUT
		$html | codigo html
		OUTPUT
		HTML | codigo html		
	*/
   private function view_page($html){
		echo $html;
	}
   
   /* PARSEA LA PAGINA CON LOS NUEVOS DATOS ANTES DE MOSTRARLA AL USUARIO
		INPUT
		$out | es el codigo html con el que sera reemplazada la etiqueta CONTENIDO
		$pagina | es el codigo html de la pagina que contiene la etiqueta CONTENIDO
		OUTPUT
		HTML 	| cuando realiza el reemplazo devuelve el codigo completo de la pagina
	*/
   private function replace_content($in='/\#CONTENIDO\#/ms', $out,$pagina){
		 return preg_replace($in, $out, $pagina);	 	
	}
}
?>
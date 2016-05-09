<?php
//session_start();
session_cache_limiter('private_no_expire');
require_once('app/model/rpluer.model.php');
require_once('./app/fpdf/fpdf.php');
require_once('./app/mailer/PHPMailerAutoload.php');

class rpluer_controller{
	
	function Login(){
			$pagina = $this->load_templateL('Login');
			$html = $this->load_page('app/views/modules/m.login_m.php');
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
					if($r->USER_ROL == 'administrador'){ /*Cambio el fetch_assoc cambia la forma en acceder al dato*/
						$this->MenuAdmin();
					}elseif($r->USER_ROL == 'administracion'){
						$this->MenuAd();
					}elseif($r->USER_ROL == 'relojero'){
						$this->MenuRelojero();
					}elseif($r->USER_ROL == 'mostrador'){
						$this->MenuMostrador();
					}else{
						
						$e = "Error en acceso";
						header('Location: index.php?action=login&e='.urlencode($e)); exit;
					}
				}else{
					$e = "Error en acceso";
						header('Location: index.php?action=login&e='.urlencode($e)); exit;
				}
	}
	
	function Inicio(){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$o = $_SESSION['user'];
			if($o->USER_ROL == 'administrador'){
				$this->MenuAdmin();
			}elseif($o->USER_ROL == 'administracion'){
				$this->MenuAd();
			}elseif($o->USER_ROL == 'mostrador'){
				$this->MenuMostrador();
			}elseif($o->USER_ROL == 'relojero'){
				$this->MenuRelojero();
			}
		}
	}
	
	/*Carga menu de administrador*/
	function MenuAdmin(){
		session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/modules/m.madmin.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			//var_dump($exec);
			$user = $_SESSION['user'];			
			//var_dump($user);
			if(isset($user)){
				//$alertas = $data->ObtieneAlertas();
				include 'app/views/sections/s.'.$sheader.'.php';
				include 'app/views/modules/m.madmin.php';
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

	function MenuJoyeria(){
		session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Joyería');
			$html = $this->load_page('app/views/pages/p.joyeria.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			$user = $_SESSION['user'];
			if(isset($user)){
				//$alertas = $data->ObtieneAlertas();
				include 'app/views/sections/s.'.$sheader.'.php';
				include 'app/views/pages/p.joyeria.php';
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
	
	function MenuMostrador(){
		session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/modules/m.mmostrador.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			//var_dump($exec);
			$user = $_SESSION['user'];
			//var_dump($user);
			if(isset($user)){
				include 'app/views/sections/s.'.$sheader.'.php';
				include 'app/views/modules/m.mmostrador.php';
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

	function MenuAd(){
		session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/modules/m.mad.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			//var_dump($exec);
			$user = $_SESSION['user'];
			//var_dump($user);
			if(isset($user)){
				include 'app/views/sections/s.'.$sheader.'.php';
				include 'app/views/modules/m.mad.php';
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
	
	/*Metodo para mostrar relojes en estatus 'porReparar'*/
	function MenuRelojero(){
		session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/modules/m.relojero.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();
					$user = $_SESSION['user'];
					$exec = $data->ConsultaOdt();
			if(isset($user)){
				include 'app/views/sections/s.'.$sheader.'.php';
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
	
	function Hist(){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra ODT');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.hist.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$exec = $data->ConsultaEjemplo();
		if($exec > 0){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.hist.php';
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

	function COdt(){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra ODT');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.odt.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$exec = $data->ConsultaOdtAct();
		if($exec > 0){
			include 'app/views/sections/s.'.$sheader.'.php';
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

	function AbreOdtm(){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra ODT');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.odtm.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$exec = $data->ConsultaOdtAct();
		if($exec > 0){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.odtm.php';
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
	
	function CreaFolio($nombre, $marca, $mod, $nocaja, $calibre, $matcaja, $fecha, $ref, $maquina, $matpulso, $trabajos, $desc_reloj, $tipomaq, $detalleCaja, $condiciones, $garantia, $fotos, $tipo, $foliojy, $caratula){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra ODT');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.mostrador_r.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];
                //var_dump($fotos);
		$exec = $data->AsignaRelojero($user, $nombre, $marca, $mod, $nocaja, $calibre, $matcaja, $fecha, $ref, $maquina, $matpulso, $trabajos, $desc_reloj, $tipomaq, $detalleCaja, $condiciones, $garantia, $fotos, $tipo, $foliojy, $caratula);
		if($exec > 0){
			//header ('Location: http://localhost/rpluer/index.php?action=odt');
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.mostrador_r.php';
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

	function AltaCliente($nombre, $rfc, $calle, $colonia, $municipio, $estado, $tel, $email, $joyeria){
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/pages/p.mostrador.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			$user = $_SESSION['user'];		
			$exec = $data->InsertAltCte($nombre, $rfc, $calle, $colonia, $municipio, $estado, $tel, $email, $joyeria);
			$cte = $data->TraeCte();
			//var_dump($exec);
			if($exec > 0){
				include 'app/views/sections/s.'.$sheader.'.php';						
				include 'app/views/pages/p.mostrador.php';
				$table = ob_get_clean();
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$table , $pagina);
			}else{
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html.'<h2>Ocurrio un error</h2>', $pagina);
			}
			
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}

	function AltaClientejy($nombre, $rfc, $calle, $colonia, $municipio, $estado, $tel, $email, $joyeria){
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/pages/p.mostradorjy.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			$user = $_SESSION['user'];		
			$exec = $data->InsertAltCte($nombre, $rfc, $calle, $colonia, $municipio, $estado, $tel, $email, $joyeria);
			$cte = $data->TraeCte();
			//var_dump($exec);
			if($exec > 0){
				include 'app/views/sections/s.'.$sheader.'.php';						
				include 'app/views/pages/p.mostradorjy.php';
				$table = ob_get_clean();
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$table , $pagina);
			}else{
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html.'<h2>Ocurrio un error</h2>', $pagina);
			}
			
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}

	function AsignaRelojero($tarjeta, $relojero, $calibre, $referencia, $maquina, $trabajos){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra ODT');				
		$html = $this->load_page('app/views/pages/p.relojero_r.php');
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];
                $resodt = $data->ActualizaRelojeroOdt($tarjeta, $relojero, $calibre, $referencia, $maquina, $trabajos);
		$exec = $data->ConsultaOdt();		
		if($resodt == true){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.relojero_r.php';
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
	
	function ActualizaOdt($tarjeta, $autorizado, $servicio, $recibe_relojero, $entrega_relojero, $entrega_cliente, $cve_relojero, $enviar, $email){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra ODT');				
		$html = $this->load_page('app/views/pages/p.odt_r.php');
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];
		$resodt = $data->ActualizaOdt($tarjeta, $autorizado, $servicio, $recibe_relojero, $entrega_relojero, $entrega_cliente, $cve_relojero, $user);
		$exec = $data->ConsultaOdtAct();
                /*Comprobamos si se desea enviar el mail*/
                if($enviar == 'on'){
                    $enviar = $this->EnviaMail($tarjeta, $enviar, $email);
                }
		if($resodt == true){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.odt_r.php';
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

	function AltaClientef($nombre, $rfc, $calle, $colonia, $municipio, $estado, $tel, $email, $joyeria){
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/pages/p.cte_r.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			$user = $_SESSION['user'];		
			$insr = $data->InsertAltCte($nombre, $rfc, $calle, $colonia, $municipio, $estado, $tel, $email, $joyeria);
			$exec = $data->ConsultaClientes();
			//var_dump($exec);
			if($exec > 0){
				include 'app/views/sections/s.'.$sheader.'.php';						
				include 'app/views/pages/p.cte_r.php';
				$table = ob_get_clean();
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$table , $pagina);
			}else{
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html.'<h2>Ocurrio un error</h2>', $pagina);
			}
			
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}
	
	/*function AltaClientef($nombre, $rfc, $calle, $colonia, $municipio, $estado, $tel, $email, $joyeria){
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/pages/p.cte_r.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			$user = $_SESSION['user'];		
			$insr = $data->InsertAltCte($nombre, $rfc, $calle, $colonia, $municipio, $estado, $tel, $email, $joyeria);
			$exec = $data->ConsultaClientes();
			//var_dump($exec);
			if($exec > 0){
				include 'app/views/sections/s.'.$sheader.'.php';						
				include 'app/views/pages/p.cte_r.php';
				$table = ob_get_clean();
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$table , $pagina);
			}else{
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html.'<h2>Ocurrio un error</h2>', $pagina);
			}
			
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}*/

	function TarjetaCte($tarjeta){
		$data = new rpluer;
		//$datoscte = $data->ObtieneCte($nombre);	
		$reloj = $data->ObtieneReloj($tarjeta);
		//var_dump($reloj);
		$r = $reloj->CVE_RELOJ;
		$datosreloj = $data->ObtieneDatosReloj($r);
		
		//fcvar_dump($datosreloj);
		/*$snombre = $datoscte->NOMBRE;
		$rfc = $datoscte->RFC;
		$tel = $datoscte->TELEFONO;
		$mail = $datoscte->EMAIL;*/
		/*Crear formato de impresion*/
		/*$pdf = new FPDF('L','mm','Legal');
			$pdf->AddPage();
			$pdf->Image('app/views/images/Imagen2.jpg',10,15,150,65);
			$pdf->SetFont('Arial', 'I', 10);
			//$pdf->Cell(110,.5,".");
			$pdf->Cell(110,.5,"Nota: " . strtoupper($tarjeta));
			//$pdf->Cell(30,10,'Titulo',1,0,'C');
			$pdf->Ln(70);
			$pdf->Cell(60,10,"Fecha: " . date('d-m-Y', strtotime($reloj->FECHACREACION_ODT)));
                        $pdf->Cell(60,10,"Descripcion: " . strtoupper($datosreloj->DESCR_RELOJ));
			$pdf->Ln(6);
                        $pdf->Cell(60,10,"Folio Joyeria: " . strtoupper($reloj->FOLIOJY));
			//$pdf->Cell(110,10,"Tipo Maquina: " . strtoupper($datosreloj->TIPO_MAQUINA));
			$pdf->Cell(60,10,"Modelo: " . strtoupper($datosreloj->MODELO));			
			$pdf->Ln(6);
			$pdf->Cell(60,10,"Marca: " . strtoupper($datosreloj->MARCA));
			$pdf->Cell(60,10,"Material Caja: " . strtoupper($datosreloj->MAT_CAJA));
			$pdf->Ln(6);
			$pdf->Cell(60,10,"No. Caja: " . strtoupper($datosreloj->NO_CAJA));
                        $pdf->Cell(60,10,"Material Pulso: " . strtoupper($datosreloj->MAT_PULSO));			
			$pdf->Ln(6);
			$pdf->Cell(60,10,"Trabajos: " . strtoupper(trim($reloj->TRABAJOS)));		
			$pdf->Ln(12);
			$pdf->Cell(41,10,strtoupper("--------------------------------------------------IMPORTANTE-------------------------------------------------------"));
			$pdf->Ln(10);
			$pdf->Cell(41,10,strtoupper("AL ACEPTAR ESTE RECIBO EL CLIENTE ESTA DE ACUERDO CON TODOS LOS DATOS"));
			$pdf->Ln(4);
			$pdf->Cell(42,10,strtoupper("Y CONDICIONES EN EL EXPRESADOS, EL RELOJ SERA ENTREGADO AL PORTADOR DE "));
			$pdf->Ln(4);
			$pdf->Cell(43,10,strtoupper("ESTE RECIBO SIN RESPONSABILIDAD PARA ESTA CASA, SIENDO EL PLAZO MAXIMO "));
			$pdf->Ln(4); 
			$pdf->Cell(44,10,strtoupper("PARA RECOGERLO DE 6 MESES A PARTIR DE LA FECHA DE DEVOLUCION INDICADA, "));
			$pdf->Ln(4);
			$pdf->Cell(45,10,strtoupper("PASADO EL CUAL NO ACEPTAREMOS NINGUNA RESPONSABILIDAD, "));
			$pdf->Ln(4);
			$pdf->Cell(46,10,strtoupper("ESTA ORDEN DE REPARACION NO ES CANCELABLE. ES ESTRICTAMENTE NECESARIO "));
			$pdf->Ln(4);
			$pdf->Cell(46,10,strtoupper("PRESENTAR ESTA REMISION PARA LA DEVOLUCION DE SU RELOJ."));
			$pdf->Ln(10);
			$pdf->Cell(41,10,strtoupper("                                      Acepto Terminos y Condiciones"));
			$pdf->Ln(7);
			$pdf->Line(20,185,140,185);
			$pdf->Ln(15);
			$pdf->Cell(41,10,strtoupper("                                                              FIRMA"));
			$pdf->Output('Cliente '.$tarjeta .'.pdf', 'd'); /*Falta crear consulta que traiga el número de folio generado*/
		//header('Location: index.php?action=inicio'); exit;
                        $pdf = new FPDF('P','mm','A5');
			$pdf->AddPage();
			$pdf->Image('app/views/images/Imagen2.jpg',10,15,130,55);
			$pdf->SetFont('Arial', 'B', 16);
                        $pdf->SetTextColor(253,10,10);
			//$pdf->Cell(110,.5,".");
			$pdf->Cell(96,.5,"Nota: ".strtoupper($tarjeta));
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->SetTextColor(6,5,5);
                        $pdf->Cell(75,5,"Fecha: " . date('d-m-Y', strtotime($reloj->FECHACREACION_ODT)));    
			//$pdf->Cell(30,10,'Titulo',1,0,'C');
                        $pdf->SetFont('Arial', 'I', 9);
                        $pdf->SetTextColor(6,5,5);
			//$pdf->Cell(30,10,'Titulo',1,0,'C');
			$pdf->Ln(65);	
                        $pdf->Cell(75,5,"Folio Joyeria: " . strtoupper($reloj->FOLIOJY));
			//$pdf->Cell(110,10,"Tipo Maquina: " . strtoupper($datosreloj->TIPO_MAQUINA));
			$pdf->Cell(75,5,"Modelo: " . strtoupper($datosreloj->MODELO));			
			$pdf->Ln(6);
			$pdf->Cell(75,5,"Marca: " . strtoupper($datosreloj->MARCA));
			$pdf->Cell(75,5,"Material Caja: " . strtoupper($datosreloj->MAT_CAJA));
			$pdf->Ln(6);
			$pdf->Cell(75,5,"No. Caja: " . strtoupper($datosreloj->NO_CAJA));
                        $pdf->Cell(75,5,"Material Pulso: " . strtoupper($datosreloj->MAT_PULSO));
                        $pdf->Ln(6);
                        //$pdf->Cell(75,5,"Descripcion: " . strtoupper($datosreloj->DESCR_RELOJ));
                        $pdf->Cell(75,5,"Tipo de Maq: " . strtoupper($datosreloj->TIPO_MAQUINA));
                        //$pdf->Cell(75,10,"Caratula: " . strtoupper($datosreloj->CARATULA));
                        $pdf->Ln(6);
                        $pdf->Cell(75,5,"Descripcion: " . strtoupper($datosreloj->DESCR_RELOJ));
			$pdf->Ln(6);
			$pdf->Cell(75,5,"Trabajos: " . strtoupper(trim($reloj->TRABAJOS)));	                        
			$pdf->Ln(6);
                        //$pdf->Cell(20,10,'Title',1,1,'C');
			$pdf->Cell(41,5,strtoupper("-------------------------------------------IMPORTANTE-------------------------------------------------"));
			$pdf->Ln(8);
			$pdf->Cell(41,5,strtoupper("AL ACEPTAR ESTE RECIBO EL CLIENTE ESTA DE ACUERDO CON TODOS LOS"));
			$pdf->Ln(4);
			$pdf->Cell(42,5,strtoupper("DATOS Y CONDICIONES EN EL EXPRESADOS, EL RELOJ SERA ENTREGADO"));
			$pdf->Ln(4);
			$pdf->Cell(43,5,strtoupper("AL PORTADOR DE ESTE RECIBO SIN RESPONSABILIDAD PARA ESTA CASA,"));
			$pdf->Ln(4); 
			$pdf->Cell(44,5,strtoupper("SIENDO EL PLAZO MAXIMO PARA RECOGERLO DE 6 MESES A PARTIR DE"));
			$pdf->Ln(4);
			$pdf->Cell(45,5,strtoupper("LA FECHA DE DEVOLUCION INDICADA, PASADO EL CUAL NO"));
			$pdf->Ln(4);
			$pdf->Cell(46,5,strtoupper("RESPONSABILIDAD ESTA ORDEN DE REPARACION NO ES CANCELABLE."));
			$pdf->Ln(4);
			$pdf->Cell(46,5,strtoupper("ES ESTRICTAMENTE NECESARIO PRESENTAR ESTA REMISION PARA"));
                        $pdf->Ln(4);
			$pdf->Cell(46,5,strtoupper("LA DEVOLUCION DE SU RELOJ.."));
			$pdf->Ln(10);
			$pdf->Cell(41,5,strtoupper("                                      Acepto Terminos y Condiciones"));
			$pdf->Ln(7);
			$pdf->Line(20,177,130,177);
			$pdf->Ln(15);
			$pdf->Cell(41,10,strtoupper("                                                              FIRMA"));
			$pdf->Output('Cliente '.$tarjeta .'.pdf', 'd'); /*Falta crear consulta que traiga el número de folio generado*/
	}
	
	function TarjetaPluer($tarjeta){
		$data = new rpluer;
		
		//$datoscte = $data->ObtieneCte($nombre);	
		$reloj = $data->ObtieneReloj($tarjeta);
		//var_dump($reloj);
		$r = $reloj->CVE_RELOJ;
		$datosreloj = $data->ObtieneDatosReloj($r);
		$datoscte = $data->ObtieneCteT($tarjeta);	
		$snombre = $datoscte->NOMBRE;
		$rfc = $datoscte->RFC;
		$tel = $datoscte->TELEFONO;
		$mail = $datoscte->EMAIL;	
		/*Crear formato de impresion*/
		/*$pdf = new FPDF('L','mm','Legal'); 
			$pdf->AddPage();
			$pdf->Image('app/views/images/Imagen2.jpg',10,15,150,65);
			$pdf->SetFont('Arial', 'I', 10);
			//$pdf->Cell(110,.5,".");
			$pdf->Cell(110,.5,"Nota: ".strtoupper($tarjeta));
			//$pdf->Cell(30,10,'Titulo',1,0,'C');
			$pdf->Ln(70);
			$pdf->Cell(110,10,"Nombre: ". strtoupper($snombre));
			$pdf->Cell(110,10,"Fecha: " . date('d-m-Y', strtotime($reloj->FECHACREACION_ODT)));
			$pdf->Ln(8);
			$pdf->Cell(110,10,"Tel: " . strtoupper($tel));
			$pdf->Cell(110,10,"Email: " . strtoupper($mail));
			$pdf->Ln(8);
			$pdf->Cell(110,10,"Tipo Maquina: " . strtoupper($datosreloj->TIPO_MAQUINA));
			$pdf->Cell(110,10,"Descripcion: " . strtoupper($datosreloj->DESCR_RELOJ));				
			$pdf->Ln(8);
			$pdf->Cell(110,10,"Marca: " . strtoupper($datosreloj->MARCA));
			$pdf->Cell(110,10,"Modelo: " . strtoupper($datosreloj->MODELO));
			$pdf->Ln(8);
			$pdf->Cell(110,10,"No. Caja: " . strtoupper($datosreloj->NO_CAJA));
			$pdf->Cell(110,10,"Material Caja: " . strtoupper($datosreloj->MAT_CAJA));
			$pdf->Ln(8);
			$pdf->Cell(110,10,"Material Pulso: " . strtoupper($datosreloj->MAT_PULSO));
			$pdf->Cell(110,10,"Maquina: " . strtoupper($datosreloj->TIPO_MAQUINA));
			$pdf->Ln(45);
			$pdf->Cell(41,10,strtoupper("Presupuesto"));
			$pdf->Line(10,180,40,180);
			$pdf->Cell(41,10,strtoupper("Entrada Rep"));
			$pdf->Line(50,180,80,180);
			$pdf->Cell(41,10,strtoupper("Termino Rep"));
			$pdf->Line(90,180,120,180);
			$pdf->Cell(41,10,strtoupper("Salida"));
			$pdf->Line(130,180,160,180);
			$pdf->Output('Pluer '.$tarjeta.'.pdf', 'd'); /*Falta crear consulta que traiga el número de folio generado*/
		//header('Location: index.php?action=inicio'); exit;
                
                        $pdf = new FPDF('P','mm','A5');
			$pdf->AddPage();
			$pdf->Image('app/views/images/Imagen2.jpg',10,15,130,55);
			$pdf->SetFont('Arial', 'B', 16);
                        $pdf->SetTextColor(253,10,10);
			//$pdf->Cell(110,.5,".");
			$pdf->Cell(96,.5,"Nota: ".strtoupper($tarjeta));
                        $pdf->SetFont('Arial', 'B', 10);
                        $pdf->SetTextColor(6,5,5);
                        $pdf->Cell(75,5,"Fecha: " . date('d-m-Y', strtotime($reloj->FECHACREACION_ODT)));    
			//$pdf->Cell(30,10,'Titulo',1,0,'C');
                        $pdf->SetFont('Arial', 'I', 9);
                        $pdf->SetTextColor(6,5,5);
			//$pdf->Cell(30,10,'Titulo',1,0,'C');
			$pdf->Ln(65);
			$pdf->Cell(75,10,"Nombre Cliente: ". strtoupper($snombre));
			//$pdf->Cell(75,10,"Fecha: " . date('d-m-Y', strtotime($reloj->FECHACREACION_ODT)));
			$pdf->Ln(8);
			$pdf->Cell(75,10,"Tel: " . strtoupper($tel));
			$pdf->Cell(75,10,"Email: " . strtoupper($mail));
			$pdf->Ln(8);
			$pdf->Cell(75,10,"Tipo Maquina: " . strtoupper($datosreloj->TIPO_MAQUINA));			
                        //$pdf->Cell(75,10,"Caratula: " . strtoupper($datosreloj->CARATULA));
			$pdf->Ln(8);
			$pdf->Cell(75,10,"Marca: " . strtoupper($datosreloj->MARCA));
			$pdf->Cell(75,10,"Modelo: " . strtoupper($datosreloj->MODELO));
			$pdf->Ln(8);
			$pdf->Cell(75,10,"No. Caja: " . strtoupper($datosreloj->NO_CAJA));
			$pdf->Cell(75,10,"Material Caja: " . strtoupper($datosreloj->MAT_CAJA));
			$pdf->Ln(8);
			$pdf->Cell(75,10,"Material Pulso: " . strtoupper($datosreloj->MAT_PULSO));
			$pdf->Cell(75,10,"Maquina: " . strtoupper($datosreloj->TIPO_MAQUINA));
                        $pdf->Ln(8);
                        $pdf->Cell(75,10,"Descripcion: " . strtoupper($datosreloj->DESCR_RELOJ));				
			$pdf->Ln(45);
			$pdf->Cell(31,10,strtoupper("Presupuesto"));
			$pdf->Line(10,180,30,180);
			$pdf->Cell(36,10,strtoupper("Entrada Rep"));
			$pdf->Line(40,180,65,180);
			$pdf->Cell(38,10,strtoupper("Termino Rep"));
			$pdf->Line(75,180,100,180);
			$pdf->Cell(31,10,strtoupper("Salida"));
			$pdf->Line(110,180,140,180);
			$pdf->Output('Pluer '.$tarjeta.'.pdf', 'd');
	}

	function BuscaReloj($numerocaja){
		$data = new rpluer;
		$reloj = $data->BuscaReloj($numerocaja);		
		return $reloj;
	}
	
	function CompruebaCte($term){
		$data = new rpluer;
		$cte = $data->CompruebaCte($term);		
		return $cte;
	}
	
	function GuardaServiciosCosto($servicios, $costos, $total, $tarjeta){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Guarda Servicios');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.editatarjeta.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
                
                
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$costos;
		$totales = $data->ActualizaServiciosCosto($servicios, $costos, $total, $tarjeta);
		$exec = $data->ConsultaEditaTarjeta($tarjeta);
		$relojeros = $data->TraeRelojeros();
                
                
		if($exec){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.editatarjeta.php';
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
        
        /*enviar email*/
        function EnviaMail($tarjeta, $enviar, $email){
            
            $data = new rpluer;
            $rs = $data->ConsultaEditaTarjeta($tarjeta);
            
            foreach($rs as $t){
                $total = $t->MN;
                $nombre = $t->NOMBRE;
                $email = $t->EMAIL;
            }
            $costServ = $data->TraeCostServ($tarjeta);
            foreach($costServ as $s){
                $servicios = $s->CVE_SERVICIO;
                $costos = $s->COSTOS;
            }
            
            //Create a new PHPMailer instance
                $mail = new PHPMailer;

                //Tell PHPMailer to use SMTP
                $mail->isSMTP();

                //Enable SMTP debugging
                // 0 = off (for production use)
                // 1 = client messages
                // 2 = client and server messages
                //$mail->SMTPDebug = 2;

                //Ask for HTML-friendly debug output
                $mail->Debugoutput = 'html';

                //Set the hostname of the mail server.smtp.tudominio.com
                $mail->Host = 'smtp.rpluer-relojero.com.mx';
                // use
                // $mail->Host = gethostbyname('smtp.gmail.com');
                // if your network does not support SMTP over IPv6

                //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
                $mail->Port = 25;

                //Set the encryption system to use - ssl (deprecated) or tls
                $mail->SMTPSecure = 'ssl';

                //Whether to use SMTP authentication
                $mail->SMTPAuth = false;

                //Username to use for SMTP authentication - use full email address for gmail
                $mail->Username = "presupuestos@rpluer-relojero.com.mx";

                //Password to use for SMTP authentication
                $mail->Password = "Rpluer*1234";

                //Set who the message is to be sent from
                $mail->setFrom('presupuestos@rpluer-relojero.com.mx', 'Rpluer Relojero');

                //Set an alternative reply-to address
                $mail->addReplyTo('noreply@example.com', 'First Last');

                //Set who the message is to be sent to
                $mail->addAddress($email, $nombre);

                //Set the subject line
                $mail->Subject = 'Detalle de presupuesto';

                //Read an HTML message body from an external file, convert referenced images to embedded,
                //convert HTML into a basic plain-text alternative body
                //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
                //$mail->Body = $servicios."test test test".$costos;
                $mail->Body = '
                    <html>                        
                        <header><title></title></header>
                        <body>
                            <h2>Detalle de presupuesto.</h2>
                            <p>A continuacion se detallan los servicios:</p>
                            <label>Servicio(s) Asignado(s)</label><br />
			            	<table>
			            		<tr>
			            		<th></th>
			            		<th></th>
			            		<th></th>
			            		</tr>
			            		<tr>
			            			<td><p class="help-block">'.$servicios.'</p></td>
			            			<td> <div class="col-md-3"></div> </td>
			            			<td>
			            				<p class="help-block">			            						
			            						'.$costos.'
					            		</p>
				            		</td>
			            		</tr>
                                                <tr>
                                                    <td>
                                                    <p>Costo Total: $'.number_format($total, 2, '.', ',').'</p>
                                                    </td>
                                                </tr>
			            	</table>
                              <h3>Precio expresado en moneda nacional al publico sin iva, sujeto a cambio sin previo aviso, presupuesto valido unicamente <strong>por 2 meses</strong></h3>
                        </body>
                    </html>
                    ';

                //Replace the plain text body with one created manually
                $mail->AltBody = 'This is a plain-text message body';

                //Attach an image file
                //$mail->addAttachment('images/phpmailer_mini.png');

                //send the message, check for errors
                if (!$mail->send()) {
                    echo "<div id='su' class='alert alert-danger'>Error: " . $mail->ErrorInfo."</div>";
                } else {
                    echo "<div id='su' class='alert alert-success'>Correo enviado correctamente!</div>";
                }
        }

	function CargaDatosCaja($nocaja){
		session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu con Datos');
			$html = $this->load_page('app/views/pages/p.cargaD.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			$exec = $data->TraeDatosCajaExistente($nocaja);
			//var_dump($exec);
			$user = $_SESSION['user'];			
			//var_dump($user);
			if(isset($user)){
				//$alertas = $data->ObtieneAlertas();
				include 'app/views/sections/s.'.$sheader.'.php';
				include 'app/views/pages/p.cargaD.php';
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
		//echo "test" . $nocaja;
	}

	/*busca clientes autocomplete*/
	function TraeClientes($buscar){	
		$data = new rpluer;
		$exec = $data->TraeClientes($buscar);
		return $exec;
	}
	
	function EditaTarjeta($tarjeta){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Edita Tarjeta ODT');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.editatarjeta.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$exec = $data->ConsultaEditaTarjeta($tarjeta);
		$relojeros = $data->TraeRelojeros();
		if($exec){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.editatarjeta.php';
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
        
        /*funcion para acceder a la carpeta donde se encuentran alojadas las fotos y mostrarlas en el navegador*/
        function MuestraFotos($ruta){
            session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_templateL('Muestra ODT');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.zoom.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
                $ruta_foto = $ruta;
		$user = $_SESSION['user'];	
		if(isset($ruta_foto)){
			include 'app/views/sections/header.php';
			include 'app/views/pages/p.zoom.php';
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

	function EditaRelojero($id){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra Usuarios');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.editarelojero.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$insert = $data->ObtieneDatoRelojero($id);
		if($insert > 0){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.editarelojero.php';
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

	function EditaTarjetaRelojero($tarjeta){
		session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/pages/p.editrelojero.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
				$sheader = 'headerAdmin';
				}elseif($_SESSION['user']->USER_ROL == 'administracion'){
					$sheader = 'headerAdminis';
				}elseif($_SESSION['user']->USER_ROL == 'relojero'){
					$sheader = 'headerRelojero';
				}else{
					$sheader = 'headerMost';
			}
			ob_start();
				$user = $_SESSION['user'];		
				$exec = $data->ConsultaEditaTarjeta($tarjeta);
				$relojeros = $data->TraeRelojeros();
			if(isset($user)){
				include 'app/views/sections/s.'.$sheader.'.php';
				include 'app/views/pages/p.editrelojero.php';
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

	/*crea la odt*/
	function InsertaDatosOdt($nombre, $marca, $mod, $nocaja, $calibre, $matcaja, $fecha, $ref, $maquina, $matpulso, $trabajos, $desc_reloj, $tipomaq){
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/pages/p.mostrador.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			//$alertas = "";
			$user = $_SESSION['user'];		
			$exec = $data->InsertDataOdts($nombre, $marca, $mod, $nocaja, $calibre, $matcaja, $fecha, $ref, $maquina, $matpulso, $trabajos, $desc_reloj, $tipomaq);
			//var_dump($exec);
			if($exec > 0){
				header('Location: index.php?action=inicio'); exit;
				/*include 'app/views/sections/s.'.$sheader.'.php';					
				include 'app/views/pages/p.mostrador.php';
				$table = ob_get_clean();
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,$table , $pagina);*/
			}else{
				$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html.'<h2>No hay trabajos pendientes</h2>', $pagina);
			}
			
			$this-> view_page($pagina);
		}else{
			$e = "Favor de Revisar sus datos";
			header('Location: index.php?action=login&e='.urlencode($e)); exit;
		}
	}

	function Usuarios(){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra Usuarios');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.users.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$exec = $data->ConsultaUsuarios();
		if($exec){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.users.php';
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

	function Clientes(){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra Usuarios');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.cte.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$exec = $data->ConsultaClientes();
		if($exec){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.cte.php';
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

	function Relojeros(){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra Usuarios');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.relojeros.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$exec = $data->ConsultaRelojeros();
		if($exec){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.relojeros.php';
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
	
	function AltaRelojero($nombre, $tel, $email){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra Usuarios');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.users_r.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$insert = $data->InsertaNuevoRelojero($nombre, $tel, $email);
		$exec = $data->ConsultaRelojeros();
		if($insert > 0){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.relojeros_r.php';
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

	function AltaUsuario($user1, $pass, $email, $rol){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra Usuarios');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.users_r.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$insert = $data->InsertaNuevoUser($user1, $pass, $email, $rol);
		$exec = $data->ConsultaUsuarios();
		if($insert > 0){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.users_r.php';
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

	function EditaUser($id){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra Usuarios');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.editauser.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$insert = $data->ObtieneDatoUser($id);
		if($insert > 0){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.editauser.php';
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

	function EditCte($id){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra Usuarios');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.editcte.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$insert = $data->ObtieneDatoCte($id);
		if($insert > 0){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.editcte.php';
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
	
	function EliminaUser($id){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra Usuarios');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.user_e.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$insert = $data->EliminaUsuario($id);
		$exec = $data->ConsultaUsuarios();
		if($insert > 0){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.user_e.php';
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

	function EliminaRelojero($id){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra Usuarios');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.relojeros_e.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$insert = $data->EliminaRelojeros($id);
		$exec = $data->ConsultaRelojeros();
		if($insert > 0){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.relojeros_e.php';
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
	
	function EliminaCte($id){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Muestra Usuarios');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.cte_e.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$insert = $data->EliminaCtes($id);
		$exec = $data->ConsultaClientes();
		if($insert > 0){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.cte_e.php';
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
        
        /*Reportes*/
        function RMarca(){
            session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/pages/p.rmarca.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			//var_dump($exec);
			$user = $_SESSION['user'];			
			//var_dump($user);
			if(isset($user)){
				//$alertas = $data->ObtieneAlertas();
				include 'app/views/sections/s.'.$sheader.'.php';
				include 'app/views/pages/p.rmarca.php';
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
        
        function MuestraReporteMarca($marca){
             session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/pages/p.rmarca.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			//var_dump($exec);
			$user = $_SESSION['user'];			
			//var_dump($user);
			if(isset($user)){
				$reporte = $data->ObtieneReporteMarca($marca);
				include 'app/views/sections/s.'.$sheader.'.php';
				include 'app/views/pages/p.rmarca.php';
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
        
        function RFecha(){
            session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/pages/p.rfecha.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			//var_dump($exec);
			$user = $_SESSION['user'];			
			//var_dump($user);
			if(isset($user)){
				//$alertas = $data->ObtieneAlertas();
				include 'app/views/sections/s.'.$sheader.'.php';
				include 'app/views/pages/p.rfecha.php';
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
        
        function MuestraReporteFechas($fecha1, $fecha2){
            session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/pages/p.rfecha.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			//var_dump($exec);
			$user = $_SESSION['user'];			
			//var_dump($user);
			if(isset($user)){
				$reporte = $data->ObtieneReporteFechas($fecha1, $fecha2);
				include 'app/views/sections/s.'.$sheader.'.php';
				include 'app/views/pages/p.rfecha.php';
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
        
        function RServicio(){
            session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/pages/p.rservicio.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			//var_dump($exec);
			$user = $_SESSION['user'];			
			//var_dump($user);
			if(isset($user)){
				//$alertas = $data->ObtieneAlertas();
				include 'app/views/sections/s.'.$sheader.'.php';
				include 'app/views/pages/p.rservicio.php';
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
        
        function MuestraReporteServicios($servicio){
            session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/pages/p.rservicio.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			//var_dump($exec);
			$user = $_SESSION['user'];			
			//var_dump($user);
			if(isset($user)){
				$reporte = $data->ObtieneReporteServicio($servicio);
				include 'app/views/sections/s.'.$sheader.'.php';
				include 'app/views/pages/p.rservicio.php';
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
        
        function RMarcamod(){
            session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/pages/p.rmarcamod.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			//var_dump($exec);
			$user = $_SESSION['user'];			
			//var_dump($user);
			if(isset($user)){
				//$alertas = $data->ObtieneAlertas();
				include 'app/views/sections/s.'.$sheader.'.php';
				include 'app/views/pages/p.rmarcamod.php';
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
        
        function MuestraReporteMarcaMod($marca, $mod){
            session_cache_limiter('private_no_expire');
		$data = new rpluer;
		if(isset($_SESSION['user'])){
			$pagina = $this->load_template('Menu Admin');
			$html = $this->load_page('app/views/pages/p.rmarcamod.php');
			//$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $html, $pagina);
			$sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
			ob_start();	
			//var_dump($exec);
			$user = $_SESSION['user'];			
			//var_dump($user);
			if(isset($user)){
				$reporte = $data->ObtieneReporteMarcaMod($marca, $mod);
				include 'app/views/sections/s.'.$sheader.'.php';
				include 'app/views/pages/p.rmarcamod.php';
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

	function EditaReloj($tarjeta){
		session_cache_limiter('private_no_expire');
		if(isset($_SESSION['user'])){
			$data = new rpluer;
				
			$pagina=$this->load_template('Edita Tarjeta ODT');				
		//$html = $this->load_page('app/views/modules/m.reporte_result.php');
		$html = $this->load_page('app/views/pages/p.editatarjetarelojero.php');
		/*OB_START a partir de aqui guardara un buffer con la informacion que haya entre este y ob_get_clean(),  
		 * es necesario incluir la vista donde haremos uso de los datos como aqui el arreglo $exec*/
		 $sheader = '';
			if($_SESSION['user']->USER_ROL == 'administrador'){
			$sheader = 'headerAdmin';
			}elseif($_SESSION['user']->USER_ROL == 'administracion'){
				$sheader = 'headerAdminis';
			}elseif($_SESSION['user']->USER_ROL == 'relojero'){
				$sheader = 'headerRelojero';
			}else{
				$sheader = 'headerMost';
			}
		ob_start(); 
		//generamos consulta
		$user = $_SESSION['user'];		
		$exec = $data->ConsultaEditaTarjeta($tarjeta);
		$relojeros = $data->TraeRelojeros();
		if($exec){
			include 'app/views/sections/s.'.$sheader.'.php';
			include 'app/views/pages/p.editatarjetarelojero.php';
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
	
	function CSesion(){
		session_destroy($_SESSION['user']);
		session_unset($_SESSION['user']);
		$e = "Session Finalizada";
		header('Location: index.php?action=login&e='.urlencode($e)); exit;
	}
	/*Obtiene y carga el template*/
	function load_template($title='Sin Titulo'){
		/*comprobamos el tipo de rol para determinar que header mostrar*/
		$header = "";
		
		$pagina = $this->load_page('app/views/master.php');
		//$header = $this->load_page('app/views/sections/s.' . $sheader . '.php');
		$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
		$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
		return $pagina;
	}
	
	/*Header para login*/
	function load_templateL($title='Sin Titulo'){
		$pagina = $this->load_page('app/views/masterL.php');
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
<?php

/*Clase para acceder a datos*/
    abstract class database{
    	private static $usr = "SYSDBA";
		private static $pwd = "masterkey";
		private $cnx;
		protected $query;
		//private $host = "C:\\Program Files (x86)\\Common Files\\Aspel\\Sistemas Aspel\\SAE6.00\\Empresa01\\Datos\\SAE50EMPRE01.FDB";/*Editar según la ubicación de la base de datos*/
		private $host = "C:\\xampp\\htdocs\\rpluer\\bd\\RPLUER.FDB";/*Editar según la ubicación de la base de datos*/
		//private $host = "C:\\Program Files\\Common Files\\Aspel\\Sistemas Aspel\\SAE5.00\\Empresa01\\Datos\\SAE50EMPRE01.FDB";
		
		#Abre la conexión a la base de datos
		private function AbreCnx(){
			$this->cnx = ibase_connect($this->host, self::$usr, self::$pwd);
		}
		
		#Cierra la conexion a la base de datos
		private function CierraCnx(){
			ibase_close($this->cnx);
		}
		
		#Ejecuta un query simple del tipo INSERT, DELETE, UPDATE
		protected function EjecutaQuerySimple(){
			$this->AbreCnx();
			$rs = ibase_query($this->cnx, $this->query);
			//print_r($rs);
			//echo $this->query;
			return $rs;
			unset($this->query);
			$this->CierraCnx();
		}
		
		#Ejecuta query de tipo SELECT
		protected function QueryObtieneDatos(){
			$this->AbreCnx();
			//echo $this->query;
			$rs = ibase_query($this->cnx, $this->query);
			return $this->FetchAs($rs);
			//var_dump($rs);	
			//echo $this->query;	
			unset($this->query);	
			$this->CierraCnx();
		}
		
		protected function QueryObtieneDatosN(){
			$this->AbreCnx();
			//echo $this->query;
			$rs = ibase_query($this->cnx, $this->query);
			return $rs;
			//var_dump($rs);	
			//echo $this->query;	
			unset($this->query);	
			$this->CierraCnx();
		}
		
		/*funcion para utilizar ajax autocomplete*/
		protected function QueryDevuelveAutocomplete(){
			$this->AbreCnx();
			$rs = ibase_query($this->cnx, $this->query);
			while($row = ibase_fetch_object($rs)){
				$row->NOMBRE = htmlentities(stripcslashes($row->NOMBRE));
				$row_set[] = $row->NOMBRE;
			}
                        if(isset($row_set)){
                            return $row_set;
                        }else{
                            return 0;
                        }
			
			unset($this->query);	
			$this->CierraCnx();
		}
				
		#Obtiene la cantidad de filas afectadas en BD
		function NumRows($result){
		if(!is_resource($result)) return false;
		return ibase_fetch_row($result);
		}
		
		#Regresa arreglo de datos asociativo, para mejor manejo de la informacion
		#Comprueba si es un recurso el cual se compone de 
		function FetchAs($result){
			if(!is_resource($result)) return false;
				return ibase_fetch_object($result);
		}
		 
    }
?>
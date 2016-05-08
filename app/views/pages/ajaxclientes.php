<?php
$usr = "SYSDBA";
$pwd = "masterkey";
//$cnx;
$query;
$host = "C:\\xampp\\htdocs\\rpluer\\bd\\RPLUER.FDB";
$cnx = ibase_connect($host, $usr, $pwd);


$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

$qstring = "SELECT nombre
			FROM clientes 
			WHERE nombre CONTAINING '".$term."'";
$result = ibase_query($cnx, $qstring);//query the database for entries containing the term

/*while ( $tsArray = ibase_fetch_object($result) ){
	$data[] = $tsArray;
} */
while ($row = ibase_fetch_object($result))//loop through the retrieved values
{
		$row->NOMBRE =  htmlentities(stripslashes($row->NOMBRE));
		//$row->CLAVE = (int)$row->CLAVE;
		$row_set[] = $row->NOMBRE;//build an array
}

//$nombres = array_column($row_set, 'nombre');

//echo json_encode($row_set);//format the array into json data
if(isset($row_set)){
	echo json_encode($row_set);
}else{
	$dardealta[] = "¡¡EL CLIENTE NO ESTA REGISTRADO, FAVOR DE DARLO DE ALTA!!";	
	echo json_encode($dardealta);
}

//$valor = ["resultado de consulta"];
//echo json_encode($valor);
exit;

?>
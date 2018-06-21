<?php    
// incluyo nusoap 
require_once "lib/nusoap.php";
//require('Final/lacucharabrava.php');

$client = new nusoap_client("http://localhost/final/lacucharabrava.php?wsdl");
$mesas = $client->call("cargarMesas",array("id"=>1));
$mesas = json_decode($mesas);

echo "<ul>";
foreach ($mesas as $mesa) {
	echo "<li>".$mesa->id." ".$mesa->nmesa." ".$mesa->tipo." ".$mesa->estado." "."</li>";
}
echo "</ul>";
 
/*
$l_oClient = new nusoap_client('http://localhost/final/lacucharabrava.php?wsdl', 'wsdl');
$l_oProxy  = $l_oClient->getProxy();
        
// llama al webmethod (obtenerProducto)
$parametro = isset($_GET['id'])?$_GET['id']:'';
$l_stResult = $l_oProxy->obtenerProductos($parametro);  
// print('<pre>');
// print_r($l_stResult); 
// print('</pre>');
 
$cadena = ''; 
$cadena .='<?xml version="1.0" encoding="utf-8"?><mesas>
        <mesa>';
foreach($l_stResult as $row){
$cadena .=' <id>'.$row['id'].'</codigo>
            <nmesa>'.$row['nmesa'].'</nombre>
            <estado>'.$row['estado'].'</descripcion>';
}   
$cadena .=' </mesa>
            </mesas>'; 
            
print($cadena);
*/
 
 ?>
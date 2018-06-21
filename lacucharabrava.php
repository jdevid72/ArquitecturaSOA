<?php
include('lib/nusoap.php');
$server = new soap_server;
// $server->configureWSDL('obtenerProductos', 'urn:obtenerProductos');  
 
$ns     = "urn:mundopccmb"; 
$server->configureWSDL("obtenerDisponibilidad",$ns);
//$server->wsdl->schematargetnamespace=$ns;

if(!isset($HTTP_RAW_POST_DATA)){
  $HTTP_RAW_POST_DATA = file_get_contents("php://input");
}


function cargarMesas($id){
  $cn = mysqli_connect("localhost","root","","lacucharabrava");
  $mesas = $cn->query("SELECT id,nmesa,tipo,estado FROM mesas WHERE id=".$id);
  $ArrMesas = [];
  while ($mesa = mysqli_fetch_array($mesas,MYSQLI_ASSOC)) {
    $ArrMesas[] = $mesa ;
  }
  return json_encode($ArrMesas);
}

$server->register("cargarMesas",array("id"=>"xsd:int"),
                    array("return"=>"xsd:string"),
                    "urn:mundopccmb",
                    "urn:mundopccmb#cargarMesas",
                    "rpc",
                    "encoded",
                    "Carga todas mesas"
          );

$server->service($HTTP_RAW_POST_DATA);
 /*
$server->wsdl->addComplexType('RenglonDisponibilidad','complexType','struct','all','',
               array(
                        'nmesa'            => array('name' => 'nmesa', 'type' => 'xsd:string'),
                        'estado'            => array('name' => 'estado', 'type' => 'xsd:string'),
                        ));
                        
$server->wsdl->addComplexType('ArrayOfRenglonProducto','complexType','array','','SOAP-ENC:Array',
                                array(),
                                array(        
                                            array('ref' => 'SOAP-ENC:arrayType',
                                                  'wsdl:arrayType' => 'tns:RenglonDisponibilidad[]'                              
                                                  )                                       
                                    ),
                                'tns:RenglonProducto');                        
 
function obtenerProductos($id=false){

$conexion = mysqli_connect("localhost","root","","lacucharabrava");//host,usu,password,bd
$consultas = "SELECT * FROM mesas";
$regitros = mysqli_query($conexion,$consultas);
 
//$sql = "SELECT ID_PRODUCTO, NOM_PRODUCTO, DES_PRODUCTO, STOCK FROM tab_producto order by ID_PRODUCTO";//$consulta
//$link = ConectarBase(); //$conexion
//$rs = ConsultarBase($link,$sql); $resgistros
$n=0; 
while ($row = mysql_fetch_array($regitros)) {
 
    $html[$n]['nmesa']          =$row[0];
    $html[$n]['estado']          =$row[1];
    $n++; 
    // $rows[] = $html; 
}
 
return $html;
 
}
 
$server->xml_encoding = "utf-8";
$server->soap_defencoding = "utf-8";
$server->register('obtenerProductos',
                  array('Codigo' => 'xsd:int'),
                  array('return'=>'tns:ArrayOfRenglonProducto'),
                  $ns 
                  // 'urn:Servicio',
                  // 'urn:Servicio#obtenerProductos',
                  // 'rpc',
                  // 'literal',
                  // 'Este método devuelve la lista de  productos.'
                  );    
                  
// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
*/ 
?>
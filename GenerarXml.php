  <?php
//require("phpsqlajax_dbinfo.php");
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

$host = "127.0.0.1";
$dbname = "ubicaciones";
$user = "postgres";
$pass = "12345";

$con = pg_connect("host = $host dbname = $dbname user = $user password = $pass");

if (!$con) {
  die('Not connected : ' . mysql_error());
}

/*
// Set the active MySQL database
$db_selected = mysql_select_db($database, $con);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}
*/

// Select all the rows in the markers table
$query = "SELECT * FROM mapas ORDER BY id";
$result = pg_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}
header("Content-type: text/xml charset=UTF-8");
//header('Content-Disposition: attachment; readfile("htdocs/Final/mapas.xml")');
header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename="mapas.xml"');
// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = pg_fetch_assoc($result)){
  // Add to XML document node
  echo '<marker ';
  echo 'id="' . $row['id']. '" ';
  echo 'name="' . parseToXML($row['nombre']) . '" ';
  echo 'address="' . parseToXML($row['direccion']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'type="' . $row['tipo'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';
//echo readfile("htdocs/Final/test.xml");
?>
<?php require_once "conexion.php";
$conexion=conexion();

$id=$_POST['id_Distribuidor'];
$sql="CALL obtener_distribuidor($id)";

$result=mysqli_query($conexion, $sql);

$ver=mysqli_fetch_row($result);

$datos=array(
	'idDistribuidor'=>$ver[0],
	'NombreU'=>$ver[1],
	'idFundadorU'=>$ver[2],
	'FundacionU'=>$ver[3],
	'SitioU'=>$ver[4]
);
echo json_encode($datos);
?>
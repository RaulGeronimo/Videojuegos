<?php require_once "conexion.php";
$conexion=conexion();

$id=$_POST['id_Desarrollador'];
$sql="CALL obtener_desarrollador($id)";

$result=mysqli_query($conexion, $sql);

$ver=mysqli_fetch_row($result);

$datos=array(
	'idDesarrollador'=>$ver[0],
	'NombreU'=>$ver[1],
	'GeneroU'=>$ver[2],
	'idFundadorU'=>$ver[3],
	'OrigenU'=>$ver[4],
	'FundacionU'=>$ver[5],
	'SitioU'=>$ver[6]
);
echo json_encode($datos);
?>
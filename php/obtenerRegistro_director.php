<?php require_once "conexion.php";
$conexion=conexion();

$id=$_POST['id_Director'];
$sql="CALL obtener_director($id)";

$result=mysqli_query($conexion, $sql);

$ver=mysqli_fetch_row($result);

$datos=array(
	'idDirector'=>$ver[0],
	'NombreU'=>$ver[1],
	'AliasU'=>$ver[2],
	'FechaNacimientoU'=>$ver[3],
	'idNacionalidadU'=>$ver[4]
);
echo json_encode($datos);
?>
<?php require_once "conexion.php";
$conexion=conexion();

$id=$_POST['id_Pais'];
$sql="CALL obtener_pais($id)";

$result=mysqli_query($conexion, $sql);

$ver=mysqli_fetch_row($result);

$datos=array(
	'idPais'=>$ver[0],
	'NombreU'=>$ver[1],
	'ContinenteU'=>$ver[2],
	'NacionalidadU'=>$ver[3],
	'BanderaU'=>$ver[4]
);
echo json_encode($datos);
?>
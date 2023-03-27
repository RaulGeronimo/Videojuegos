<?php require_once "conexion.php";
$conexion=conexion();

$id=$_POST['id_Juego'];
$sql="CALL obtener_juego($id)";

$result=mysqli_query($conexion, $sql);

$ver=mysqli_fetch_row($result);

$datos=array(
	'idJuego'=>$ver[0],
	'NombreU'=>$ver[1],
	'GeneroU'=>$ver[2],
	'ModalidadU'=>$ver[3],
	'PlataformaU'=>$ver[4],
	'LanzamientoU'=>$ver[5],
	'idDesarrolladorU'=>$ver[6],
	'idDistribuidorU'=>$ver[7],
	'idDirectorU'=>$ver[8]
);
echo json_encode($datos);
?>
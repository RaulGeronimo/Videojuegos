<?php require_once "conexion.php";

$conexion=conexion();
$id=$_POST['id_Juego'];
$sql="CALL elimina_juego('$id')";
echo mysqli_query($conexion, $sql);
?>
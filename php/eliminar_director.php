<?php require_once "conexion.php";

$conexion=conexion();
$id=$_POST['id_Director'];
$sql="CALL elimina_director('$id')";
echo mysqli_query($conexion, $sql);
?>
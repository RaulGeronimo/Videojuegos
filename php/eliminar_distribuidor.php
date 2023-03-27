<?php require_once "conexion.php";

$conexion=conexion();
$id=$_POST['id_Distribuidor'];
$sql="CALL elimina_distribuidor('$id')";
echo mysqli_query($conexion, $sql);
?>
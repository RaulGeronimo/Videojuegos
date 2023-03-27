<?php require_once "conexion.php";

$conexion=conexion();
$id=$_POST['id_Desarrollador'];
$sql="CALL elimina_desarrollador('$id')";
echo mysqli_query($conexion, $sql);
?>
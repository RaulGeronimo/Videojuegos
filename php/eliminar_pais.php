<?php require_once "conexion.php";

$conexion=conexion();
$id=$_POST['id_Pais'];
$sql="CALL elimina_pais('$id')";
echo mysqli_query($conexion, $sql);
?>
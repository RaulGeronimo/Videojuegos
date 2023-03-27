<?php require_once "conexion.php";

$conexion=conexion();

$nombre=$_POST['Nombre'];
$continente=$_POST['Continente'];
$nacionalidad=$_POST['Nacionalidad'];
$bandera=$_POST['Bandera'];

$sql="CALL inserta_pais('$nombre','$continente','$nacionalidad', '$bandera')";

echo mysqli_query($conexion, $sql);

?>
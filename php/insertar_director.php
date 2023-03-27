<?php require_once "conexion.php";

$conexion=conexion();

$nombre=$_POST['Nombre'];
$alias=$_POST['Alias'];
$fechaNacimiento=$_POST['FechaNacimiento'];
$idnacionalidad=$_POST['idNacionalidad'];

$sql="CALL inserta_director('$nombre','$alias','$fechaNacimiento', '$idnacionalidad')";

echo mysqli_query($conexion, $sql);

?>
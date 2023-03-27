<?php require_once "conexion.php";

$conexion=conexion();

$Nombre=$_POST['Nombre'];
$idFundador=$_POST['idFundador'];
$Fundacion=$_POST['Fundacion'];
$Sitio=$_POST['Sitio'];

$sql="CALL inserta_distribuidor('$Nombre','$idFundador','$Fundacion', '$Sitio')";

echo mysqli_query($conexion, $sql);

?>
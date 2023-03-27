<?php require_once "conexion.php";

$conexion=conexion();

$Nombre=$_POST['Nombre'];
$Genero=$_POST['Genero'];
$idFundador=$_POST['idFundador'];
$Origen=$_POST['Origen'];
$Fundacion=$_POST['Fundacion'];
$Sitio=$_POST['Sitio'];

$sql="CALL inserta_desarrollador('$Nombre','$Genero','$idFundador', '$Origen', '$Fundacion', '$Sitio')";

echo mysqli_query($conexion, $sql);

?>
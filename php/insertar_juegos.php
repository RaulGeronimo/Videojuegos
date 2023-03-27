<?php require_once "conexion.php";

$conexion=conexion();

$Nombre=$_POST['Nombre'];
$Genero=$_POST['Genero'];
$Modalidad=$_POST['Modalidad'];
$Plataforma=$_POST['Plataforma'];
$Lanzamiento=$_POST['Lanzamiento'];
$idDesarrollador=$_POST['idDesarrollador'];
$idDistribuidor=$_POST['idDistribuidor'];
$idDirector=$_POST['idDirector'];

$sql="CALL inserta_juego('$Nombre','$Genero','$Modalidad', '$Plataforma', '$Lanzamiento','$idDesarrollador','$idDistribuidor', '$idDirector')";

echo mysqli_query($conexion, $sql);

?>
<?php require_once "conexion.php";

$conexion=conexion();

$idPais=$_POST['idPais'];
$nombre=$_POST['NombreU'];
$continente=$_POST['ContinenteU'];
$nacionalidad=$_POST['NacionalidadU'];
$bandera=$_POST['BanderaU'];

$sql="CALL actualiza_pais('$nombre','$continente','$nacionalidad', '$bandera','$idPais')";

echo mysqli_query($conexion, $sql);
?>
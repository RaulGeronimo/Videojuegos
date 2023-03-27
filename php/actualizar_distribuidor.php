<?php require_once "conexion.php";

$conexion=conexion();

$idDistribuidor=$_POST['idDistribuidor'];
$NombreU=$_POST['NombreU'];
$idFundadorU=$_POST['idFundadorU'];
$FundacionU=$_POST['FundacionU'];
$SitioU=$_POST['SitioU'];

$sql="CALL actualiza_distribuidor('$NombreU','$idFundadorU','$FundacionU', '$SitioU','$idDistribuidor')";

echo mysqli_query($conexion, $sql);
?>
<?php require_once "conexion.php";

$conexion=conexion();

$idDesarrollador=$_POST['idDesarrollador'];
$NombreU=$_POST['NombreU'];
$GeneroU=$_POST['GeneroU'];
$idFundadorU=$_POST['idFundadorU'];
$OrigenU=$_POST['OrigenU'];
$FundacionU=$_POST['FundacionU'];
$SitioU=$_POST['SitioU'];

$sql="CALL actualiza_desarrollador('$NombreU','$GeneroU','$idFundadorU', '$OrigenU','$FundacionU', '$SitioU', '$idDesarrollador')";

echo mysqli_query($conexion, $sql);
?>
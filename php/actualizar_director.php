<?php require_once "conexion.php";

$conexion=conexion();

$idDirector=$_POST['idDirector'];
$nombreU=$_POST['NombreU'];
$aliasU=$_POST['AliasU'];
$fechaNacimientoU=$_POST['FechaNacimientoU'];
$idnacionalidadU=$_POST['idNacionalidadU'];

$sql="CALL actualiza_director('$nombreU','$aliasU','$fechaNacimientoU', '$idnacionalidadU','$idDirector')";

echo mysqli_query($conexion, $sql);
?>
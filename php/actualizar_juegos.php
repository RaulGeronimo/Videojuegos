<?php require_once "conexion.php";

$conexion=conexion();

$idJuego=$_POST['idJuego'];
$NombreU=$_POST['NombreU'];
$GeneroU=$_POST['GeneroU'];
$ModalidadU=$_POST['ModalidadU'];
$PlataformaU=$_POST['PlataformaU'];
$LanzamientoU=$_POST['LanzamientoU'];
$idDesarrolladorU=$_POST['idDesarrolladorU'];
$idDistribuidorU=$_POST['idDistribuidorU'];
$idDirectorU=$_POST['idDirectorU'];

$sql="CALL actualiza_juego('$NombreU','$GeneroU','$ModalidadU', '$PlataformaU', '$LanzamientoU','$idDesarrolladorU','$idDistribuidorU', '$idDirectorU','$idJuego')";

echo mysqli_query($conexion, $sql);
?>
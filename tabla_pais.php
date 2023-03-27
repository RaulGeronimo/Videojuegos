<?php 
	require_once "php/conexion.php";
	$conexion=conexion();

	$sql="CALL mostrar_pais";
	$result=mysqli_query($conexion,$sql);
 ?>

<span class="btn btn-raised btn-primary btn-lg" data-toggle="modal" data-target="#addmodal">
    <span class="fa fa-plus-circle"></span> agrega nuevo
</span>

<div class="row">
    <?php while ($ver=mysqli_fetch_row($result)): ?>
    <div style="margin-block-start: 10px;" id="example" class="col-md-4" style="margin-bottom: 1.5rem;">
        <div class="card text-center bg-dark scrollmenu">
            <div class="card-header text-white d-flex justify-content-between align-items-center text-center">
                <?php echo $ver[1]; ?>
                <span class="btn btn-raised btn-danger btn-xs" onclick="elimina('<?php echo $ver[0]; ?>')">
                    <span class="fa fa-trash"></span>
                </span>
            </div>
            <img src="<?php echo $ver[4]; ?>" style="margin-left: auto; margin-right: auto;"
                alt="imagen del Deporte">
            <div class="card-body text-white">
                <p style="font-weight: bold;">Nacionalidad</p>
                <p><?php echo $ver[3]; ?></p>
                <p style="font-weight: bold;">Continente</p>
                <p><?php echo $ver[2]; ?></p>
                <span class="btn btn-raised btn-warning btn-xs" onclick="obtenDatos('<?php echo $ver[0]; ?>')"
                    data-toggle="modal" data-target="#updatemodal">
                    <span class="fa fa-pencil-square-o"></span>
                </span>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>
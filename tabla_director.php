<?php 
	require_once "php/conexion.php";
	$conexion=conexion();
    $conexion->query("SET lc_time_names = 'es_ES'");
	$sql="CALL mostrar_director";
	$result=mysqli_query($conexion,$sql);
 ?>

<span class="btn btn-raised btn-primary btn-lg" data-toggle="modal" data-target="#addmodal">
    <span class="fa fa-plus-circle"></span> agrega nuevo
</span>

<div class="scroll">
    <table style="margin-block-start: 10px; text-align: center;" id="example"
        class="table table-sm table-inverse table-bordered">
        <tr style="font-weight: bold">
            <td>Nombre</td>
            <td>Alias</td>
            <td>Fecha Nacimiento</td>
            <td>Edad</td>
            <td>Nacionalidad</td>
            <td style="text-align: center;">Acciones</td>
        </tr>
        <?php while ($ver=mysqli_fetch_row($result)): ?>
        <tr>
            <td><?php echo $ver[1]; ?></td>
            <td><?php echo $ver[2]; ?></td>
            <td><?php echo $ver[3]; ?></td>
            <td><?php echo $ver[5]; ?></td>
            <td><?php echo $ver[4]; ?></td>
            <td>
                <span class="btn btn-raised btn-warning btn-xs" onclick="obtenDatos('<?php echo $ver[0]; ?>')"
                    data-toggle="modal" data-target="#updatemodal">
                    <span class="fa fa-pencil-square-o"></span>
                </span>
                <span class="btn btn-raised btn-danger btn-xs" onclick="elimina('<?php echo $ver[0]; ?>')">
                    <span class="fa fa-trash"></span>
                </span>
            </td>
        </tr>

        <?php endwhile; ?>
    </table>
</div>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Videojuegos</title>
    <!-- Estilos -->
    <?php require_once "dependencias.php"; 
    require_once "php/conexion.php";?>

</head>

<body>
    <!-- Navegacion -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php" aria-current="page">Juegos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="desarrollador.php">Desarrollador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="distribuidor.php">Distribuidor</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Director
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"><strong>Creador</strong></a></li>
                            <li><a class="dropdown-item" href="pais.php">Pais</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Titulo -->
    <div class="container">
        <br>
        <h1>Videojuegos</h1>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <div id="tablastores"></div>
            </div>
        </div>
    </div>

    <!-- AGREGAR INICIO -->
    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo director</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmAgrega">

                        <label>Nombre</label>
                        <input type="text" class="form-control form-control-sm" name="Nombre" id="Nombre"
                            placeholder="Nombre Completo">

                        <label>Alias</label>
                        <input type="text" class="form-control form-control-sm" name="Alias" id="Alias"
                            placeholder="Alias">

                        <label>FechaNacimiento</label>
                        <input type="date" class="form-control form-control-sm" name="FechaNacimiento"
                            id="FechaNacimiento">

                        <label>Pais de Origen</label>
                        <select class="form-control form-control-sm" name="idNacionalidad" id="idNacionalidad" required>
                            <option selected disabled value="">Selecciona una Nacionalidad</option>
                            <?php 
                                $conexion=conexion();

                                $sql="SELECT * FROM Pais ORDER BY Nombre";
                                $result=mysqli_query($conexion,$sql);
                            ?>
                            <?php while ($ver=mysqli_fetch_row($result)): ?>
                            <option value="<?php echo $ver[0]; ?>"><?php echo $ver[1]; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-raised btn-primary" id="btnAgregarJuego">Agregar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- AGREGAR FIN -->

    <!-- ACTUALIZAR INICIO -->
    <div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Actualiza Director</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmactualiza">

                        <input type="text" hidden="" name="idDirector" id="idDirector">

                        <label>Nombre</label>
                        <input type="text" class="form-control form-control-sm" name="NombreU" id="NombreU"
                            placeholder="Nombre Completo">

                        <label>Alias</label>
                        <input type="text" class="form-control form-control-sm" name="AliasU" id="AliasU"
                            placeholder="Alias">

                        <label>FechaNacimiento</label>
                        <input type="date" class="form-control form-control-sm" name="FechaNacimientoU"
                            id="FechaNacimientoU">

                        <label>Pais de Origen</label>
                        <select class="form-control form-control-sm" name="idNacionalidadU" id="idNacionalidadU"
                            required>
                            <option selected disabled value="">Selecciona una Nacionalidad</option>
                            <?php 
                                $conexion=conexion();

                                $sql="SELECT * FROM Pais ORDER BY Nombre";
                                $result=mysqli_query($conexion,$sql);
                            ?>
                            <?php while ($ver=mysqli_fetch_row($result)): ?>
                            <option value="<?php echo $ver[0]; ?>"><?php echo $ver[1]; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-raised btn-warning" id="btnactualizar">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ACTUALIZAR FIN -->
</body>

</html>

<script type="text/javascript">
    $(document).ready(function () {
        $('#tablastores').load('tabla_director.php');

        $('#btnAgregarJuego').click(function () {
            if (validarFormVacio('frmAgrega') > 0) {
                alertify.alert("Debes llenar todos los campos por favor!");
                return false;
            }

            datos = $('#frmAgrega').serialize();

            $.ajax({
                type: "POST",
                data: datos,
                url: "php/insertar_director.php",
                success: function (r) {
                    if (r == 1) {
                        $('#frmAgrega')[0].reset();
                        $('#tablastores').load('tabla_director.php');
                        alertify.success("Agregado con exito :)");
                    } else {
                        alertify.error("No se pudo agregar :(");
                    }
                }
            });
        });


    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#btnactualizar').click(function () {

            datos = $('#frmactualiza').serialize();
            $.ajax({
                type: "POST",
                data: datos,
                url: "php/actualizar_director.php",
                success: function (r) {
                    if (r == 1) {
                        $('#tablastores').load('tabla_director.php');
                        alertify.success("Actualizado con exito :)");
                    } else {
                        alertify.error("No se pudo actualizar :(");
                    }
                }
            });
        });
    });
</script>

<script type="text/javascript">
    function obtenDatos(id_Director) {
        $.ajax({
            type: "POST",
            data: "id_Director=" + id_Director,
            url: "php/obtenerRegistro_director.php",
            success: function (r) {
                datos = jQuery.parseJSON(r);

                $('#idDirector').val(datos['idDirector']);
                $('#NombreU').val(datos['NombreU']);
                $('#AliasU').val(datos['AliasU']);
                $('#FechaNacimientoU').val(datos['FechaNacimientoU']);
                $('#idNacionalidadU').val(datos['idNacionalidadU']);
            }
        });
    }


    function validarFormVacio(formulario) {
        datos = $('#' + formulario).serialize();
        d = datos.split('&');
        vacios = 0;
        for (i = 0; i < d.length; i++) {
            controles = d[i].split("=");
            if (controles[1] == "A" || controles[1] == "") {
                vacios++;
            }
        }
        return vacios;
    }

    function elimina(id_Director) {
        alertify.confirm('Eliminar juego', '¿Desea eliminar este registro?',
            function () {
                $.ajax({
                    type: "POST",
                    data: "id_Director=" + id_Director,
                    url: "php/eliminar_director.php",
                    success: function (r) {
                        if (r == 1) {
                            $('#tablastores').load('tabla_director.php');
                            alertify.success("Eliminado con exito :)");
                        } else {
                            alertify.error("No se pudo eliminar :(");
                        }
                    }
                });
            },
            function () {
                alertify.error('Cancelo')
            });
    }
</script>
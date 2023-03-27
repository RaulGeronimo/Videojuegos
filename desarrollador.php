<!DOCTYPE html>
<html lang="es">

<head>
    <title>Videojuegos</title>
    <!-- Estilos -->
    <?php require_once "dependencias.php"; 
    require_once "php/conexion.php";
    $conexion=conexion(); ?>

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
                        <a class="nav-link" href="index.php" aria-current="page">Juegos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="desarrollador.php"><strong>Desarrollador</strong></a>
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
                            <li><a class="dropdown-item" href="director.php">Creador</a></li>
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
                    <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo desarrollador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmAgrega">
                        <!-- Nombre -->
                        <label>Nombre</label>
                        <input type="text" class="form-control form-control-sm" name="Nombre" id="Nombre"
                            placeholder="Nombre Desarrollador">

                        <!-- Genero -->
                        <label>Genero</label>
                        <input type="text" class="form-control form-control-sm" name="Genero" id="Genero"
                            placeholder="Genero">

                        <!-- Fundador -->
                        <label>Fundador</label>
                        <select class="form-control form-control-sm" name="idFundador" id="idFundador" required>
                            <option selected disabled value="">Selecciona un Fundador</option>
                            <?php 
                                $sql="SELECT * FROM Director ORDER BY Nombre";
                                $result=mysqli_query($conexion,$sql);
                            ?>
                            <?php while ($ver=mysqli_fetch_row($result)): ?>
                            <option value="<?php echo $ver[0]; ?>"><?php echo $ver[1]; ?></option>
                            <?php endwhile; ?>
                        </select>

                        <!-- Origen -->
                        <label>Origen del Desarrollador</label>
                        <input type="text" class="form-control form-control-sm" name="Origen" id="Origen"
                            placeholder="Origen">

                        <!-- Fundacion -->
                        <label>Fundacion</label>
                        <input type="date" class="form-control form-control-sm" name="Fundacion" id="Fundacion">

                        <!-- Sitio -->
                        <label>Sitio</label>
                        <input type="text" class="form-control form-control-sm" name="Sitio" id="Sitio"
                            placeholder="Sitio">
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

                    <h5 class="modal-title" id="exampleModalLabel">Actualiza Desarrollador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmactualiza">

                        <input type="text" hidden="" name="idDesarrollador" id="idDesarrollador">

                        <!-- Nombre -->
                        <label>Nombre</label>
                        <input type="text" class="form-control form-control-sm" name="NombreU" id="NombreU"
                            placeholder="Nombre Desarrollador">

                        <!-- Genero -->
                        <label>Genero</label>
                        <input type="text" class="form-control form-control-sm" name="GeneroU" id="GeneroU"
                            placeholder="Genero">

                        <!-- Fundador -->
                        <label>Fundador</label>
                        <select class="form-control form-control-sm" name="idFundadorU" id="idFundadorU" required>
                            <option selected disabled value="">Selecciona un Fundador</option>
                            <?php 
                                $sql="SELECT * FROM Director ORDER BY Nombre";
                                $result=mysqli_query($conexion,$sql);
                            ?>
                            <?php while ($ver=mysqli_fetch_row($result)): ?>
                            <option value="<?php echo $ver[0]; ?>"><?php echo $ver[1]; ?></option>
                            <?php endwhile; ?>
                        </select>

                        <!-- Origen -->
                        <label>Origen del Desarrollador</label>
                        <input type="text" class="form-control form-control-sm" name="OrigenU" id="OrigenU"
                            placeholder="Origen">

                        <!-- Fundacion -->
                        <label>Fundacion</label>
                        <input type="date" class="form-control form-control-sm" name="FundacionU" id="FundacionU">

                        <!-- Sitio -->
                        <label>Sitio</label>
                        <input type="text" class="form-control form-control-sm" name="SitioU" id="SitioU"
                            placeholder="Sitio">
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
        $('#tablastores').load('tabla_desarrollador.php');

        $('#btnAgregarJuego').click(function () {
            if (validarFormVacio('frmAgrega') > 0) {
                alertify.alert("Debes llenar todos los campos por favor!");
                return false;
            }

            datos = $('#frmAgrega').serialize();

            $.ajax({
                type: "POST",
                data: datos,
                url: "php/insertar_desarrollador.php",
                success: function (r) {
                    if (r == 1) {
                        $('#frmAgrega')[0].reset();
                        $('#tablastores').load('tabla_desarrollador.php');
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
                url: "php/actualizar_desarrollador.php",
                success: function (r) {
                    if (r == 1) {
                        $('#tablastores').load('tabla_desarrollador.php');
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
    function obtenDatos(id_Desarrollador) {
        $.ajax({
            type: "POST",
            data: "id_Desarrollador=" + id_Desarrollador,
            url: "php/obtenerRegistro_desarrollador.php",
            success: function (r) {
                datos = jQuery.parseJSON(r);

                $('#idDesarrollador').val(datos['idDesarrollador']);
                $('#NombreU').val(datos['NombreU']);
                $('#GeneroU').val(datos['GeneroU']);
                $('#idFundadorU').val(datos['idFundadorU']);
                $('#OrigenU').val(datos['OrigenU']);
                $('#FundacionU').val(datos['FundacionU']);
                $('#SitioU').val(datos['SitioU']);
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

    function elimina(id_Desarrollador) {
        alertify.confirm('Eliminar juego', '¿Desea eliminar este registro?',
            function () {
                $.ajax({
                    type: "POST",
                    data: "id_Desarrollador=" + id_Desarrollador,
                    url: "php/eliminar_desarrollador.php",
                    success: function (r) {
                        if (r == 1) {
                            $('#tablastores').load('tabla_desarrollador.php');
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
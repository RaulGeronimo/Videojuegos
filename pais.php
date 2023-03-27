<!DOCTYPE html>
<html lang="es">

<head>
    <title>Videojuegos</title>
    <!-- Estilos -->
    <?php require_once "dependencias.php"; ?>

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
                            <li><a class="dropdown-item" href="director.php">Creador</a></li>
                            <li><a class="dropdown-item"><strong>Pais</strong></a></li>
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
                <div id="tablapais"></div>
            </div>
        </div>
    </div>

    <!-- AGREGAR DATOS INICIO -->
    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo pais</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmAgrega">
                        <label>Nombre</label>
                        <input type="text" class="form-control form-control-sm" name="Nombre" id="Nombre"
                            placeholder="Nombre del Pais">

                        <label>Continente</label>
                        <select class="form-control form-control-sm" name="Continente" id="Continente" required>
                            <option selected disabled value="">Selecciona un Continente</option>
                            <option value="America">America</option>
                            <option value="Asia">Asia</option>
                            <option value="Africa">Africa</option>
                            <option value="Antartida">Antartida</option>
                            <option value="Europa">Europa</option>
                            <option value="Oceania">Oceania</option>
                        </select>

                        <label>Nacionalidad</label>
                        <input type="text" class="form-control form-control-sm" name="Nacionalidad" id="Nacionalidad"
                            placeholder="Nacionalidad de los residentes">

                        <label>Bandera</label>
                        <input type="url" class="form-control form-control-sm" name="Bandera" id="Bandera"
                            placeholder="URL de la Bandera">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-raised btn-primary" id="btnAgregarJuego">Agregar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- AGREGAR DATOS FIN -->

    <!-- ACTUALIZAR INICIO -->
    <div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Actualiza Pais</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmactualiza">
                        <input type="text" hidden="" name="idPais" id="idPais">

                        <label>Nombre</label>
                        <input type="text" class="form-control form-control-sm" name="NombreU" id="NombreU"
                            placeholder="Nombre del Pais">

                        <label>Continente</label>
                        <select class="form-control form-control-sm" name="ContinenteU" id="ContinenteU" required>
                            <option selected disabled value="">Selecciona un Continente</option>
                            <option value="America">America</option>
                            <option value="Asia">Asia</option>
                            <option value="Africa">Africa</option>
                            <option value="Antartida">Antartida</option>
                            <option value="Europa">Europa</option>
                            <option value="Oceania">Oceania</option>
                        </select>

                        <label>Nacionalidad</label>
                        <input type="text" class="form-control form-control-sm" name="NacionalidadU" id="NacionalidadU">

                        <label>Bandera</label>
                        <input type="url" class="form-control form-control-sm" name="BanderaU" id="BanderaU">
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
        $('#tablapais').load('tabla_pais.php');

        $('#btnAgregarJuego').click(function () {
            if (validarFormVacio('frmAgrega') > 0) {
                alertify.alert("Debes llenar todos los campos por favor!");
                return false;
            }

            datos = $('#frmAgrega').serialize();

            $.ajax({
                type: "POST",
                data: datos,
                url: "php/insertar_pais.php",
                success: function (r) {
                    if (r == 1) {
                        $('#frmAgrega')[0].reset();
                        $('#tablapais').load('tabla_pais.php');
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
                url: "php/actualizar_pais.php",
                success: function (r) {
                    if (r == 1) {
                        $('#tablapais').load('tabla_pais.php');
                        alertify.success("Actualizado con exito :)");
                    } else {
                        alertify.error("No se pudo actualizar :(");
                    }
                }
            });
        });
    });
</script>

<!-- ACTUALIZAR -->
<script type="text/javascript">
    function obtenDatos(id_Pais) {
        $.ajax({
            type: "POST",
            data: "id_Pais=" + id_Pais,
            url: "php/obtenerRegistro_pais.php",
            success: function (r) {
                datos = jQuery.parseJSON(r);

                $('#idPais').val(datos['idPais']);
                $('#NombreU').val(datos['NombreU']);
                $('#ContinenteU').val(datos['ContinenteU']);
                $('#NacionalidadU').val(datos['NacionalidadU']);
                $('#BanderaU').val(datos['BanderaU']);
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

    function elimina(id_Pais) {
        alertify.confirm('Eliminar Pais', '¿Desea eliminar este registro?',
            function () {
                $.ajax({
                    type: "POST",
                    data: "id_Pais=" + id_Pais,
                    url: "php/eliminar_pais.php",
                    success: function (r) {
                        if (r == 1) {
                            $('#tablapais').load('tabla_pais.php');
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
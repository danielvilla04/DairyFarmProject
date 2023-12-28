<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Starter</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php
        include '../fragments/nav_menu.php'
            ?>

        <!--  Main Sidebar Container -->
        <aside class="main-sidebar  elevation-4">
            <div class="sidebar">
                <!--  Fragmento que incluye el logo y la foto del usuario usuario -->
                <!-- Brand Logo -->
                <a href="index.php" class="brand-link">
                    <img src="../assets/imagenes/logo.png" alt=" Logo" height="100px" style="opacity: .8">
                    <hr>

                </a>

                <!-- Sidebar -->

                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block text-white">Juanito Mora</a>
                    </div>
                </div>
                <!-- /.sidebar -->

                <!-- Sidebar Menu -->
                <?php
                include '../fragments/main_aside_Animales.php'
                    ?>
                <!-- /.sidebar-menu -->
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Formulario Agregar-->
                    <div class="row mb-5" id="form-agregar">
                        <div class="col-1"></div>
                        <div class="col-10">
                            <div class="card " style="background-color:#4CAF50;">
                                <div class="card-header text-center">
                                    <h3 class="card-title text-white">Nuevo Animal</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form style= "background-color: #28a745;" id="formulario-agregar" method="POST">
                                    <div class="card-body text-white ">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                                        placeholder="Ingrese el nombre " required>
                                                </div>
                                            </div>
                                            <div class="col-4 input-group-lg">
                                                <div class="form-group">
                                                    <label for="">Imagen</label>
                                                    <input type="file" class="form-control" id="images" name="images"
                                                        placeholder="Ingrese el nombre " required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Numero Arete</label>
                                                    <input type="number" class="form-control" id="numero_arete"
                                                        name="numero_arete" placeholder="Ingrese numero arete" required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Raza</label>
                                                    <select class="form-control select2" id="raza" name="raza">
                                                        <option selected="selected">Jersey</option>
                                                        <option>Holstein</option>
                                                        <option>Pardo Suizo</option>
                                                        <option>Criollo</option>
                                                        <option>Gyr Lechero</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Fecha</label>
                                                    <input type="date" class="form-control" id="fecha_nacimiento"
                                                        name="fecha_nacimiento" placeholder="Ingrese la fecha" required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Peso</label>
                                                    <input type="number" class="form-control" id="peso" name="peso"
                                                        placeholder="Ingrese el peso" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Caracteristicas</label>
                                                    <input type="text" class="form-control" id="colores_caracteristicas"
                                                        name="colores_caracteristicas"
                                                        placeholder="Ingrese la caracteristicas" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Observaciones</label>
                                                    <input type="text" class="form-control" id="observaciones"
                                                        name="observaciones" placeholder="Ingrese la observacion"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer text-center">
                                        <div class="row">
                                            <div class="col-6"><button type="submit" id="btnRegistrar"
                                                    name="btnRegistrar"
                                                    class="btn btn-primary btnRegistrar">Guardar</button>
                                            </div>
                                            <div class="col-6"><input type="reset" class=" btn btn-info"
                                                    value="Limpiar datos"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <!-- /.fromulario -->

                    <!-- Formulario Modificar-->
                    <div class="row mb-5" id="form-modificar">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <div class="card " style="background-color:#4CAF50;">
                                <div class="card-header text-center">
                                    <h3 class="card-title text-white">Modificar Animal</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form id="formulario-modificar" method="POST">
                                    <div class="card-body text-white ">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Nombre</label>
                                                    <input type="text" class="form-control" id="xnombre" name="nombre"
                                                        placeholder="Ingrese el nombre " required>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Numero Arete</label>
                                                    <input type="number" class="form-control" id="xnumero_arete"
                                                        name="numero_arete" placeholder="Ingrese el peso" required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Raza</label>
                                                    <select class="form-control select2" id="xraza" name="raza">
                                                        <option selected="selected">Jersey</option>
                                                        <option>Holstein</option>
                                                        <option>Pardo Suizo</option>
                                                        <option>Criollo</option>
                                                        <option>Gyr Lechero</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Fecha</label>
                                                    <input type="date" class="form-control" id="xfecha_nacimiento"
                                                        name="fecha_nacimiento" placeholder="Ingrese la fecha" required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Peso</label>
                                                    <input type="number" class="form-control" id="xpeso" name="peso"
                                                        placeholder="Ingrese el peso" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Caracteristicas</label>
                                                    <input type="text" class="form-control"
                                                        id="xcolores_caracteristicas" name="colores_caracteristicas"
                                                        placeholder="Ingrese la caracteristicas" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Observaciones</label>
                                                    <input type="text" class="form-control" id="xobservaciones"
                                                        name="observaciones" placeholder="Ingrese la observacion"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer text-center">
                                        <div class="row">
                                            <div class="col-6"><button type="submit" id="btnRegistrar"
                                                    name="btnRegistrar"
                                                    class="btn btn-primary btnRegistrar">Guardar</button>
                                            </div>
                                            <div class="col-6"><input type="reset" class=" btn btn-info"
                                                    value="Limpiar datos"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <!-- /.formulario-->
                    <!-- /.row -->

                    <!-- Tabla -->
                    <div class="row mb-5" id="tabla-vacas">
                        <div class="col-md-12">
                            <div class="card card-dark p-2" style="overflow: scroll;">
                                <div class="card-body p-0">
                                    <table id="tablalistado" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <th>ID</th>
                                            <th>Número de Arete</th>
                                            <th>Nombre del Animal</th>
                                            <th>Fecha Nacimiento</th>
                                            <th>Raza</th>
                                            <th>Peso</th>
                                            <th>Características</th>
                                            <th>Observaciones</th>
                                            <th>Imagen</th>
                                            <th>Opciones</th>
                                        </thead>
                                        <tbody>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->




        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>

</body>




<!--   JQUERY -->
<script src="../plugins/jquery/jquery.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Bootbox -->
<script src="../plugins/bootbox/bootbox.min.js"></script>
<!-- toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- CSS styles -->
<link rel="stylesheet" href="../assets/css/index.css">
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

<!-- JS SCRIPTS -->
<script src="../assets/js/animales.js"></script>



</html>
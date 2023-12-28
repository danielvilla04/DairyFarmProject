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

        <!--  Main nav-menu  -->

        <?php
        include '../fragments/nav_menu.php'
            ?>

        <!--  Main Sidebar  -->
        <aside class="main-sidebar  elevation-4">
            <?php
            include '../fragments/main_aside_reproduccion.php'
                ?>
        </aside><!--  Main Sidebar  -->


        <!-- Main-->
        <div class="bg-white content-wrapper">

            <!-- Content Header-->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Reproduccion</a></li>
                                <li class="breadcrumb-item active">Servicios</li>

                            </ol>
                        </div>
                        <div class="col-sm-6">
                            <h1 class="m-0"></h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div><!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Formulario Agregar-->
                    <div class="row mb-5" id="form-agregar">
                        <div class="col-md-1"></div>

                        <div class="col-10">

                            <div class="card " style="background-color:#4CAF50;">

                                <div class="card-header text-center">
                                    <h3 class="card-title text-white">Nuevo Servicio</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form id="formulario-agregar" method="POST">
                                    <div class="card-body text-white ">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Numero de Arete</label>
                                                    <select id="selectAnimales" name="id_animal"
                                                        class="form-control select2" style="width: 100%; padding: 15px;"
                                                        required>
        
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Fecha de servicio</label>
                                                    <input type="date" class="form-control" id="fecha_servicio"
                                                        name="fecha_servicio" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Tipo de Servicio</label>
                                                    <select class="form-control select2" id="tipo_servicio"
                                                        name="tipo_servicio" style="width: 100%;">
                                                        <option selected="selected">Tipo de servicio</option>
                                                        <option selected="selected">Natural</option>
                                                        <option>Inseminación</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Observaciones</label>
                                                    <input type="text" class="form-control" id="observaciones"
                                                        name="observaciones"
                                                        placeholder="Ingrese aquí sus observaciones">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="row">
                                            <div class="col-6"><button type="submit"
                                                    class="btn btn-primary btnRegistrar">Guardar</button>
                                            </div>
                                            <div class="col-6"><input type="reset" class=" btn btn-info"
                                                    value="Limpiar datos">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-1"></div>

                    </div>







                    <!-- /.row -->



                    <!-- Tabla -->
                    <div class="row mb-5" id="tabla-servicio">
                        <div class="col-md-12">
                            <div class="card card-dark">
                                <div class="card-body p-0">
                                    <table id="tablalistado" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <th>Id</th>
                                            <th>Numero de Arete </th>
                                            <th>Fecha de Servicio</th>
                                            <th>Tipo de Servicio</th>
                                            <th>Observaciones</th>
 

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



        </div><!-- ./Content Wrapper-->

        <!-- Main Footer -->
        <footer class="main-footer">
            <?php
            include '../fragments/footer.php'
                ?>
        </footer>

    </div><!-- ./wrapper -->

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
<script src="../assets/js/servicio.js"></script>

</html>
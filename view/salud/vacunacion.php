<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SG GANADERIA| GANADERIA</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">



</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php
    include '../fragments/nav_menu.php'
      ?>

        <!--  Main Sidebar  -->
        <aside class="main-sidebar  elevation-4">
            <?php
      include '../fragments/main_aside_enfermedades.php'
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
                                <li class="breadcrumb-item Active"><a href="#">Vacunacion</a></li>
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-6">
                                    <!-- small box -->
                                    <div class="small-box text-center text-white " style="background-color:#4CAF50;">
                                        <div class="inner">
                                            <p>Animales <br>
                                                Vacunados</p>
                                            <h3 id="card-animales-vacunados"></h3>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-6">
                                    <!-- small box -->
                                    <div class="small-box text-center text-white" style="background-color:#4CAF50;">
                                        <div class="inner">
                                            <p>Total de Vacunas Aplicadas</p>
                                            <h3 id="card-vacunas-aplicadas"></h3>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>

                            <div class="col-lg-12">
                                <div class="card p-2" style="height: 370px; overflow-y:scroll ;">
                                    <div class="card-header border-0">
                                        <h3 class="card-title">Vacunas Registradas</h3>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table id="tablavacunas" class="table table-striped table-valign-middle">
                                            <thead>
                                                <tr>
                                                    <th>Lote</th>
                                                    <th>Nombre Vacuna</th>
                                                    <th>Tipo</th>
                                                    <th>Fecha Expiracion</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

                        
                    </div>
                    <!-- /.row -->
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
<!-- REQUIRED SCRIPTS -->

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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>




<!-- JD Scripts -->
<script src="../assets/js/vacunas_main.js"></script>

</html>
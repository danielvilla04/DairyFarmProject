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
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

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
        <div class=" content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-3">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="#" style="color: #0799b6;">Animales</a></li>


                            </ol>
                        </div><!-- /.col -->
                        <div class="col-sm-9">
                            <h1 class="m-0"></h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div><!-- /.content-header -->


            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- carrusel  vacas  -->
                            <div class="card ">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        Carrusel vacas
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carouselExampleIndicators" data-slide-to="0"
                                                class="active"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner">

                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                            data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                            data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>

                            <!-- /.card -->
                        </div>


                        <!-- tabla de Animales -->
                        <div class="col-sm-6">
                            <!-- grafico de Animales ingreados  -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Vacas Ingresados por Mes</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="graficoAnimal"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                    </div>

            </section>
            <section class="content">
                <div class="container-fluid">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box text-center text-white " style="background-color:#4CAF50;">
                                <div class="inner">
                                    <p>Animales Ingresados</p>
                                    <h3 id="promedioAnimales">Calculando...</h3>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box text-center text-white" style="background-color:#4CAF50;">
                                <div class="inner">
                                    <p>Promedio de Producción</p>
                                    <h3 id="promedioProduccion"></h3>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box text-center text-white" style="background-color:#4CAF50;">
                                <div class="inner">
                                    <p>Vacas en producción</p>
                                    <h3 id="produccion"></h3>
                                </div>

                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                </div> <!-- /.content-fluid -->
            </section><!-- /section -->

</body>
<!-- CSS styles -->

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
<!-- Chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script src="../assets/js/estadoAnimal.js"></script>

</html>
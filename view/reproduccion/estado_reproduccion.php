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
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />






</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">


        <?php
        include '../fragments/nav_menu.php'
            ?>



        <!--  Main Sidebar  -->
        <aside class="main-sidebar  elevation-4">
            
                <?php
                include '../fragments/main_aside_reproduccion.php'
                    ?>
           
        </aside><!--  Main Sidebar  -->


        <!-- Content Wrapper. Contains page content -->
        <div class=" content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-3">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="#" style="color: #0799b6;">Reproduccion y Control
                                        de Celos</a></li>
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
                        <div class="col-1"></div>
                        <div class="col-10">
                            <div class="card card-primary card-outline mb-5">
                                <div class="card-header">
                                    <div class="card-title">Servicios Y Celos</div>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="calendario"></div>

                                </div>
                                <!-- /.card-body -->

                            </div>
                        </div>
                        <div class="col-1"></div>


                        <!-- grafico de Animales ingreados  -->
                        <div class="col-sm-9">

                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i>
                                        Grafico Animales
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="graficoReproduccion"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                            </div>
                        </div>

                        <!-- cards -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box text-center text-white " style="background-color:#4CAF50;">
                                <div class="inner">
                                    <p>Vacas Vacias</p>
                                    <h3 id="card-vacas-vacias"></h3>
                                </div>
                            </div>
                            <!-- small box -->
                            <div class="small-box text-center text-white " style="background-color:#4CAF50;">
                                <div class="inner">
                                    <p>Vacas Preñadas</p>
                                    <h3 id="card-vacas-prenadas"></h3>
                                </div>
                            </div>



                        </div>
                        <!-- ./col -->

                        <!-- tabla de vacas con servicio el ultimo mes -->
                        <div class="col-sm-6">
                            <div class="card" style="height: 400px">
                                <div class="card-header border-0">
                                    <h3 class="card-title">Servicios del Ultimo Mes</h3>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-striped " id="tablaservicios">
                                        <thead>
                                            <th>Número de Arete</th>
                                            <th>Fecha Servicio</th>
                                            <th>Tipo de Servicio</th>

                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- tabla de vacas con servicio el ultimo mes -->
                        <div class="col-sm-6">
                            <div class="card" style="height: 400px">
                                <div class="card-header border-0">
                                    <h3 class="card-title">Celos del Ultimo Mes</h3>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-striped " id="tablacelos">
                                        <thead>
                                            <th>Número de Arete</th>
                                            <th>Fecha del Celo</th>
                                            <th>Detalles del Celo</th>

                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>




        </div><!-- ./Content Wrapper-->



        <!-- Main Footer -->
        <footer class="main-footer">
            <?php
            include '../fragments/footer.php'
                ?>
        </footer>

    </div><!-- ./wrapper -->


</body>
<!-- CSS styles -->
<!-- REQUIRED SCRIPTS -->

<!--   JQUERY -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!--  FullCalendar JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

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
<!-- Chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>




<script src="../assets/js/reproduccion_celo.js"></script>

</html>
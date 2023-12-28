<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SG GANADERIA| SALUD</title>

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
      ?><!-- /.navbar -->


    <!--  Main Sidebar  -->
    <aside class="main-sidebar  elevation-4">
      <?php
      include '../fragments/main_aside_enfermedades.php'
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
                <li class="breadcrumb-item"><a href="#" style="color: #0799b6;">Salud</a></li>


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

          <!-- Small boxes (Stat box) -->
          <div class="row">

            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box text-center text-white " style="background-color:#4CAF50;">
                <div class="inner">
                  <p>Vacas Enfermas</p>
                  <h3 id="card-animales-enfermos"></h3>
                </div>

                <a href="./enfermedades.php" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->


            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box text-center text-white" style="background-color:#4CAF50;">
                <div class="inner">
                  <p>Vacas con Antibiótico</p>
                  <h3 id="card-animales-antibiotico"></h3>
                </div>

                <a href="./medicamentos.php" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box text-center text-white" style="background-color:#4CAF50;">
                <div class="inner">
                  <p>Vacas con Mastitis</p>
                  <h3 id="card-vacas-mastitis"></h3>
                </div>

                <a href="./mastitis.php" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div> <!-- /.content-fluid -->
      </section><!-- /section -->

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <!-- grafico de vacas enfermas  -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Vacas Enfermas por Mes</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="graficoEnfermas"
                      style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div><!-- /.col -->

            <!-- tabla de vacas inyectadas -->
            <div class="col-sm-6">
              <div class="card p-2" >
                <div class="card-header border-0">
                  <h3 class="card-title">Vacas Injectadas</h3>
                </div>

                <div class="card-body table-responsive p-0" style="height: 280px">
                  <table class="table table-striped table-valign-middle" id="tablainyecciones" style="; overflow-y: scroll;">
                    <thead>
                      <tr>
                        <th>Arete</th>
                        <th>Fecha</th>
                        <th>Nombre Injectable</th>
                      </tr>
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



<script src="../assets/js/salud.js"></script>

</html>
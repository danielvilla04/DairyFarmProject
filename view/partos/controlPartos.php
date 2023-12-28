<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SG GANADERIA | CONTROL DE PARTOS</title>

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
        include '../fragments/main_aside_partos.php'
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
                <li class="breadcrumb-item"><a href="#" style="color: #0799b6;">Control de Partos y Abortos</a></li>


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
            <div class="col-1"></div>
            
            <div class="col-sm-10">
              <!-- grafico   -->
              <div class="card ">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    Abortos por mes
                  </h3>
                  <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas class="chart" id="graficoAbortos"
                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
              <!-- /.col-7 -->
              <div class="col-1"></div>


            
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- tabla de vacas Preñadas -->
            <div class="col-sm-5">
              <div class="card p-2" style="height: 345px;">
                <div class="card-header border-0">
                  <h3 class="card-title">Vacas Preñadas</h3>
                </div>

                <div class="card-body table-responsive p-0">
                  <table class="table table-striped table-valign-middle" id="tablaprenos">
                    <thead>
                      <tr>
                        <th>Numero de Arete</th>
                        <th>Fecha de Servicio</th>
                        <th>Tipo de Servicio</th>
                      </tr>
                    </thead>
                    <tbody>
                     

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-sm-7">
              <!-- grafico de vacas enfermas  -->
              <div class="card ">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    Partos por mes
                  </h3>
                  <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas class="chart" id="graficoPartos"
                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            
          </div>
          <!-- /.row -->
        </div> <!-- /.content-fluid -->
      </section><!-- /section -->



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

<script src="../assets/js/controlPartos.js"></script>

</html>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SG GANADERIA| NUEVO ABORTO</title>

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
  <!--  FullCalendar CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
  
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php
    include '../fragments/nav_menu.php'
      ?>

    <!--  Main Sidebar  -->
    <aside class="main-sidebar  elevation-4">
      <?php
      include '../fragments/main_aside_partos.php'
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
                <li class="breadcrumb-item "><a href="#">Control de Abortos</a></li>
                <li class="breadcrumb-item Active"><a href="#">Añadir Aborto</a></li>
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

          <div class="row mb-5" >
            <!-- calendario -->
            <div class="col-1"></div>
            <div class="col-10">
              <div class="card card-primary card-outline mb-5">
                <div class="card-header">
                  <div class="card-title">Abortos</div>
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
          </div>

          <!-- Formulario Agregar-->
          <div class="row mb-5" id="form-agregar">
            <div class="col-2"></div>
            <div class="col-8">
              <div class="card " style="background-color: #52AA5E;">
                <div class="card-header text-center">
                  <h3 class="card-title text-white">Nuevo Aborto</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="formulario-agregar" method="POST">
                  <div class="card-body text-white ">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label>Número de Arete</label>
                          <select id="selectAnimales" name="idAnimal" class="form-control select2"
                            style="width: 100%; padding: 15px;" required>
                            <option selected="selected">Seleccione un número de arete</option>

                          </select>
                        </div>
                      

                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Fecha del Aborto</label>
                          <input type="date" class="form-control" id=""
                            placeholder="Ingrese la fecha del aborto de la vaca">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="fecha_nacimiento">Estado de la Vaca</label>
                          <input type="text" class="form-control" id="" placeholder="Ingrese el estado de la vaca">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Observaciones</label>
                          <input type="text" class="form-control" id=""
                            placeholder="Ingrese las observaciones correspondientes">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-2"></div>
          </div>
          <!-- /.row -->



          <!-- Tabla -->

          <div class="row mb-5" id="tabla-vacas-enfermas">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <div class="card card-dark" style="overflow-x:scroll;">
                <div class="card-body p-3">
                  <div class="card-title">Palabra</div>
                  <table id="tablalistado" class="table table-striped table-bordered table-hover">
                    <thead>
                    <th>ID de la Vaca</th>
                      <th>fecha del aborto</th>
                      <th>Estado de la Vaca</th>
                      <th>Observaciones</th>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <div class="col-md-1"></div>

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

<!-- REQUIRED SCRIPTS -->

<!--   JQUERY -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- FullCalendar JS y dependencias -->
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

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- JD Scripts -->
<script src="../assets/js/abortos.js"></script>

</html>
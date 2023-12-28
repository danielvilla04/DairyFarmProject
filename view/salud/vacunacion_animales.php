<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SG GANADERIA | VACUNACION ANIMALES</title>

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
                <li class="breadcrumb-item "><a href="#">Vacunacion</a></li>
                <li class="breadcrumb-item Active"><a href="#">Nueva Vacunacion</a></li>
              </ol>
            </div>
            <div class="col-sm-6">
              <h1 class="m-0"></h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div><!-- /.content-header -->

      <!-- Main content -->
      <section class="content mb-5">
        <div class="container-fluid">

          
        <!-- form agregar -->
          <div class="row mb-5">

            <!-- /.card -->
            <div class="col-1"></div>
            <div class="col-10">
              <form id="formulario-agregar" method="POST">

                <div class="card text-white" style="background-color:#4CAF50;">
                  <div class="card-header text-center">

                    <h3 class="card-title text-white">Nueva Vacunación</h3>
                  </div>
                  <!-- /.card-header -->

                  <div style="background-color:#28a745;" class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <div class="form-group text-white"> 
                          <label for="">Vacuna</label>

                          <select id="selectVacunas" name="idVacuna" class="form-control select2"
                            style="width: 100%; padding: 15px;" >
                          </select>
                        </div>

                      </div>
                      <div class="col-4">
                        <div class="form-group text-white">
                          <label for="">Lugar de Aplicacion</label>

                          <input type="text" id="lugarAplicacion" name="lugarAplicacion" class="form-control"
                            placeholder="Lugar de Aplicación" required>
                        </div>

                      </div>
                      <div class="col-4">
                        <div class="form-group text-white">
                          <label for="">Fecha de Aplicacion</label>
                          <input type="date" id="fechaAplicacion" name="fechaAplicacion" class="form-control" required>

                        </div>

                      </div>
                      <div class="col-12">
                        <div class="form-group text-white">
                          <label for="">Dosis</label>
                          <input type="text" id="dosis" name="dosis" class="form-control" required>

                        </div>

                      </div>
                    </div>
                  </div>

                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label>Vacas Vacunadas</label>
                          <select id="selectAnimales" name="animalesVacunados[]" class="duallistbox"
                            multiple="multiple" required>
                          </select>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.card-body -->
                </div>

                <div class="card-footer text-center">
                  <div class="row">
                    <div class="col-6"><button type="submit" class="btn btn-primary btnRegistrar">Guardar</button>
                    </div>
                    <div class="col-6"><input type="reset" class=" btn btn-info" value="Limpiar datos"></div>
                  </div>
                </div>
 
              </form>
            </div>
            <div class="col-1"></div>
          </div>

          <!-- Tabla -->
          <div class="row mb-5" id="tabla-vacas-enfermas">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <div class="card card-dark" style="overflow-x:scroll;">
                <div class="card-body p-3">
                  <table id="tablalistado" class="table table-striped table-bordered table-hover">
                    <thead>
                      <th>Id</th>
                      <th>Nombre Vacuna</th>
                      <th>Lugar de Aplicacion</th>
                      <th>Fecha Aplicacion</th>
                      <th>Dosis</th> 
                      <th>Animales Vacunados</th>
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


<!-- JD Scripts -->

<script src="../assets/js/vacunacion.js"></script>



</html>
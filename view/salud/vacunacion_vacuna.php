<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SG GANADERIA| VACUNACION</title>

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
                <li class="breadcrumb-item Active"><a href="#">Nueva Vacuna</a></li>
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


          <!-- /Fromulario agregar -->
          <div class="row mb-5" id="form-agregar">
            <div class="col-12">

              <div class="card text-white" style="background-color:#4CAF50;">
                <div class="card-header text-center">
                  <h3 class="card-title ">Nueva Vacuna</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form style="background-color:#28a745; " id="formulario-agregar" method="POST">
                  <div class="card-body ">
                    <div class="row ">
                      <div class="col-6">
                        <div class="form-group text-white ">
                          <label for="">Nombre de la Vacuna</label>
                          <input type="text" class="form-control" name="nombreVacuna" id="nombreVacuna"
                            placeholder="Ingrese el nombre de la vacuna" required>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group text-white">
                          <label for="">Fecha de Vencimiento</label>
                          <input type="date" class="form-control" name="fechaVencimiento" id="fechaVencimiento" required>
                        </div>
                      </div>
                      <div class="col-8">
                        <div class="form-group text-white ">
                          <label for="">Casa Distribuidora</label>
                          <input type="text" class="form-control" name="casaDistribuidora" id="casaDistribuidora" placeholder="Ingrese la casa de la vacuna" required>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group text-white">
                          <label for="">Lote</label>
                          <input type="text" class="form-control" name="lote" id="lote" placeholder="Ingrese el lote" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group text-white">
                          <label for="">Descripción</label>
                          <input type="text" class="form-control" name="descripcion" id="descripcion"
                            placeholder="Ingrese la descripcion" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group text-white">
                          <label for="">Observaciones</label>
                          <input type="text" class="form-control" name="observaciones" id="observaciones"
                            placeholder="Ingrese aquí sus observaciones" required>
                        </div>
                      </div>
                    </div>
                  </div> <!-- /.card-body -->

                  <div class="card-footer text-center">
                    <div class="row">
                      <div class="col-6"><button type="submit" class="btn btn-primary btnRegistrar">Guardar</button>
                      </div>
                      <div class="col-6"><input type="reset" class=" btn btn-info" value="Limpiar datos"></div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>

          </div>
          <!-- /.row -->


          <!-- Tabla -->
          <div class="row mb-5" id="tabla-vacunas">
            <div class="col-md-12 ">
              <div class="card card-dark">
                <div class="card-body ">
                  <table id="tablalistado" class="table table-striped table-bordered table-hover">
                    <thead>
                      <th>Id</th>
                      <th>Nombre de la Vacuna</th>
                      <th>Casa Distribuidora</th>
                      <th>Descripcion</th>
                      <th>Lote</th>
                      <th>Fecha de Vencimiento</th>
                      <th>Observaciones</th>
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

<!-- JD Scripts -->
<script src="../assets/js/vacunas.js"></script>

</html>
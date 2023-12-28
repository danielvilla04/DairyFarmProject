<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SG GANADERIA| NUEVA PRODUCCION</title>

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
            <a href="#" class="d-block text-white">Juanito Mena Mora</a>
          </div>
        </div>



        <!-- /.sidebar -->

        <!-- Sidebar Menu -->
        <?php
        include '../fragments/main_aside_produccion.php'
          ?>
        <!-- /.sidebar-menu -->
      </div>
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="bg-white content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Producción</a></li>
                <li class="breadcrumb-item active">Añadir Producción</li>
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
          <div class="row mb-5" IdProduccion="form-agregar">
            <div class="col-md-1"></div>

            <div class="col-10">
              <div class="card " style="background-color:#4CAF50;">
                <div class="card-header text-center">
                  <h3 class="card-title text-white">Nueva Produccion</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="formulario-agregar" method="POST">
                  <div class="card-body text-white ">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label>Numero de Arete</label>
                          <select id="selectAnimales" name="IdAnimal" class="form-control select2" required>
                            <option selected="selected">Seleccione un numero de Arete</option>
                          </select>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Fecha de Produccion</label>
                          <input type="date" class="form-control" id="Fecha" name="Fecha" required>
                        </div>

                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Observaciones</label>
                          <input type="text" class="form-control" id="observaciones" name="observaciones"
                            placeholder="Ingrese aquí sus observaciones" required>
                        </div>
                        <div class="form-group">
                          <label for="">Litros</label>
                          <input type="text" class="form-control" id="Litros" name="Litros"
                            placeholder="Ingrese los Litros" required>
                        </div>
                      </div>

                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer text-center">
                    <div class="row">
                      <div class="col-6"><button type="submit" class="btn btn-primary btnRegistrar">Guardar</button>
                      </div>
                      <div class="col-6"><input type="reset" class=" btn btn-info" value="Limpiar datos"></div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-md-1"></div>


          </div>


          <!-- /.row -->




          <!-- Tabla -->
          <div class="row mb-5" id="tabla-vacas-enfermas">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <div class="card card-dark" style="overflow-x:scroll;">
                <div class="card-body p-3">
                  <table id="tablalistado" class="table table-striped table-bordered table-hover">
                    <thead>
                      <th>Id</th>
                      <th>Numero Arete</th>
                      <th>Fecha</th>
                      <th>Litros Producidos</th>
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
            <div class="col-md-1"></div>

          </div>
          <!-- /.row -->





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


  <!-- REQUIRED SCRIPTS -->



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



<!-- JD Scripts -->
<script src="../assets/js/produccion.js"></script>




</html>
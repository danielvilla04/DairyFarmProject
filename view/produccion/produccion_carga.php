<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SG GANADERIA | PRODUCCION</title>

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
                <li class="breadcrumb-item"><a href="#">Añadir Producción Semanal</a></li>
            </div>
            <div class="col-sm-6">
              <h1 class="m-0"></h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div><!-- /.content-header -->

      <section class="content">
        <div class="container-fluid">

          <div class="col-md-12">

            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">

                <!-- Formulario Agregar-->
                <div class="row mb-5" IdProduccion="form-agregar">
                  <div class="col-md-1"></div>

                  <div class="col-10">
                    <div class="card " style="background-color:#4CAF50;">
                      <div class="card-header text-center">
                        <h3 class="card-title text-white">Nueva Produccion Semanal </h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form id="formulario-agregar" method="POST">
                        <div class="card-body text-white ">
                          <div class="row">

                            <div class="col-4">
                              <div class="form-group">
                                <label for="">Fecha de Produccion</label>
                                <input type="date" class="form-control" id="Fecha" name="Fecha" required>
                              </div>
                            </div>

                            <div class="col-4">
                              <div class="form-group">
                                <label for="">Litros</label>
                                <input type="text" class="form-control" id="litros" name="litros"
                                  placeholder="Ingrese aquí los Litros Producidos" required>
                              </div>
                            </div>
                            <div class="col-4">
                              <div class="form-group">
                                <label for="">Celulas Somaticas</label>
                                <input type="text" class="form-control" id="celulassomaticas" name="celulassomaticas"
                                  placeholder="Ingrese las celulas Somaticas" required>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group">
                                <label for="">Presencia Inhibidores</label>
                                <select class="form-control select2" name="presenciainhibidores"
                                  id="presenciainhibidores">
                                  <option value="Positivo">Positivo</option>
                                  <option value="Negativo">Negativo</option>

                                </select>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group">
                                <label for="">Calidad Bacteriologica</label>
                                <select class="form-control select2" name="calidadbacteriologica"
                                  id="calidadbacteriologica">
                                  <option value="Excelente">Excelente</option>
                                  <option value="Buena">Buena</option>
                                  <option value="Intermedia">Intermedia</option>
                                  <option value="Mala">Mala</option>

                                </select>
                              </div>
                            </div>

                            <div class="col-4">
                              <div class="form-group">
                                <label for="">Porcentaje Grasa</label>
                                <input type="text" class="form-control" id="porcentajegrasa" name="porcentajegrasa"
                                  placeholder="Ingrese el procentaje de Grasa" required>
                              </div>
                            </div>
                            <div class="col-4">
                              <div class="form-group">
                                <label for="">Porcentaje Proteina</label>
                                <input type="text" class="form-control" id="porcentajeproteina"
                                  name="porcentajeproteina" placeholder="Ingrese el procentaje de Proteina" required>
                              </div>
                            </div>
                            <div class="col-4">
                              <div class="form-group">
                                <label for="">Punto Crioscopico</label>
                                <input type="text" class="form-control" id="puntocrioscopico" name="puntocrioscopico"
                                  placeholder="Ingrese el punto crioscopico" required>
                              </div>
                            </div>


                          </div>
                          <!-- /.card-body -->

                          <div class="card-footer text-center">
                            <div class="row">
                              <div class="col-6"><button type="submit"
                                  class="btn btn-primary btnRegistrar">Guardar</button>
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
                            <th>Fecha Semana</th>
                            <th>Litros Semanales</th>
                            <th>Calidad Bacteriologica</th>
                            <th>Celulas Somaticas</th>
                            <th>Porcentaje Grasa</th>
                            <th>Porcentaje Proteina</th>
                            <th>Punto Crioscopico</th>
                            <th>Presencia inhibidores</th>
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

            <!-- Formulario Agregar-->
            <div class="row mb-5" id="form-agregar ">
              <div class="col-md-1"></div>
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

<script src="../assets/js/produccionSem.js"></script>


</html>
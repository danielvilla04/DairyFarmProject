<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SG GANADERIA | ENFERMEDADES </title>

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

    <!--  Main nav-menu  -->

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
                <li class="breadcrumb-item"><a href="#">Enfermedades</a></li>
                <li class="breadcrumb-item active">Animales Enfermos</li>
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
          <div  class="row mb-5" id="form-agregar">
            <div class="col-md-1"></div>

            <div class="col-10">
              <div class="card " style="background-color:#4CAF50;">
                <div class="card-header text-center">
                  <h3 class="card-title text-white">Nuevo Animal Enfermo</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form style="background-color:#28a745;" id="formulario-agregar" method="POST">
                  <div class="card-body text-white ">
                    <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <label>Número de Arete</label>
                          <select id="selectAnimales" name="idAnimal" class="form-control select2"
                            style="width: 100%; padding: 15px;" required>
                            <option selected="selected">Seleccione un número de arete</option>

                          </select>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label>Estado de la Enfermedad</label>
                          <select class="form-control select2" id="estadoEnfermedad" name="estadoEnfermedad"
                            style="width: 100%;" required>
                            <option selected="selected">En Curso</option>
                            <option>Recuperada</option>
                            <option>Fallecida</option>
                            <option>Crónica</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-4">

                        <div class="form-group">
                          <label>Enfermedad</label>
                          <select id="selectEnfermedades" name="idEnfermedad" class="form-control select2"
                            style="width: 100%; padding: 15px;" required>
                            <option selected="selected">Seleccione una enfermedad</option>

                          </select>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Síntomas</label>
                          <input type="text" class="form-control" id="sintomas" name="sintomas"
                            placeholder="Ingrese los sintomas" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Fecha del Diagnóstico</label>
                          <input type="date" class="form-control" id="fechaDiagnostico" name="fechaDiagnostico" required>
                        </div>

                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Observaciones</label>
                          <input type="text" class="form-control" id="observaciones" name="observaciones"
                            placeholder="Ingrese aquí sus observaciones" required>
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


          <!-- Formulario Modificar-->
          <div style="background-color:#28a745;" class="row mb-5" id="form-modificar">
            <div class="col-2"></div>
            <div class="col-8">
              <div class="card " >
                <div class="card-header text-center">
                  <h3 class="card-title text-white">Modificar Animal Enfermo</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="formulario-modificar" method="POST">
                  <div class="card-body text-white ">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Numero Arete</label>
                          <input type="text" class="form-control" id="XnumeroArete" name="areteAnimal" readonly>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Fecha del Diagnóstico</label>
                          <input type="date" class="form-control" id="XfechaDiagnostico" name="fechaDiagnostico"
                            readonly>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Síntomas</label>
                          <input type="text" class="form-control" id="Xsintomas" name="sintomas"
                            placeholder="Ingrese los sintomas">
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label>Enfermedad</label>
                          <input type="text" class="form-control" id="Xenfermedad" name="nombreEnfermedad" readonly>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label>Estado de la Enfermedad</label>
                          <select class="form-control select2" id="XestadoEnfermedad" name="estadoEnfermedad"
                            style="width: 100%;">
                            <option selected="selected">Seleccione una opcion</option>
                            <option>En Curso</option>
                            <option>Recuperada</option>
                            <option>Fallecida</option>
                            <option>Crónica</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Observaciones</label>
                          <input type="text" class="form-control" id="Xobservaciones" name="observaciones"
                            placeholder="Ingrese aquí sus observaciones">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <div class="row">
                      <div class="col-6"><button type="submit" class="btn btn-primary">Editar</button></div>
                      <div class="col-6"><input type="button" class=" btn btn-info" value="Cancelar"
                          onclick="cancelarForm()"></div>
                    </div>
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
                  <table id="tablalistado" class="table table-striped table-bordered table-hover">
                    <thead>
                      <th>Id</th>
                      <th>Número de Arete</th>
                      <th>Nombre del Animal</th>
                      <th>Enfermedad o Padecimiento</th>
                      <th>Fecha del Diagnóstico</th>
                      <th>Síntomas</th>
                      <th>Estado del Animal</th>
                      <th>Tratamiento Recomendado</th>
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
<script src="../assets/js/enfermedades_animales.js"></script>

</html>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SG GANADERIA | REGISTRO MEDICAMENTO</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />




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


    <!-- Content Wrapper. Contains page content -->
    <div class="bg-white content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Medicamentos</a></li>

                <li class="breadcrumb-item active">Nueva Injeccion/Aplicacion de Medicamento</li>
              </ol>
            </div>
            <div class="col-sm-6">
              <h1 class="m-0"></h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div><!-- /.content-header -->

      <section class="content">
        <div class="container-fluid">

          <!-- /.antibiotico -->
          <!-- /.form agregar -->
          <div class="row " id="form-agregar-antibiotico">
            <div class="col-1"></div>

            <div class="col-10">
              <div class="card" style="background-color:#4CAF50;">
                <div class="card-header text-center text-white">
                  <h3 class="card-title ">Nueva Aplicacion de Antibiotico</h3>

                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="formulario-agregar-antibiotico" method="POST">

                  <div style="background-color:#28a745; " class="card-body  text-white ">
                    <div class="row">
                      <div class="col-6">
                        <label>Antibiotico</label>
                        <select id="selectAntibioticos" name="idAntibiotico" class="form-control select2"
                          style="width: 100%; padding: 15px;" required>
                          <option selected="selected">Seleccione un antibiotico</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label>Número de Arete</label>
                        <select id="selectAnimalesAn" name="idAnimal" class="form-control select2"
                          style="width: 100%; padding: 15px;" required>
                          <option selected="selected">Seleccione un número de arete</option>

                        </select>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Fecha de Aplicacion</label>
                          <input type="date" class="form-control" name="fechaAplicacion" id="fechaAplicacion"
                            required>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Dosis Aplicada</label>
                          <input type="text" class="form-control" name="dosisAplicada" id="dosisAplicada" placeholder="Ingrese la dosis" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Lugar de Aplicacion</label>
                          <input type="text" class="form-control" name="lugarAplicacion" id="lugarAplicacion"
                            placeholder="Ingrese el lugar de aplicacion">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer text-center">
                    <div class="row">
                      <div class="col-6"><button type="submit"
                          class="btn btn-primary btnRegistrarAntibiotico">Guardar</button>
                      </div>
                      <div class="col-6"><input type="reset" class=" btn btn-info" value="Limpiar datos"></div>
                    </div>
                  </div>
                </form>
              </div>

              <!-- /.card -->

            </div>
            <div class="col-1"></div>
          </div>
          <!-- /.row -->


          <!-- /.medicamento -->
          <!-- /.form agregar -->
          <div class="row " id="form-agregar-medicamento">
            <div class="col-1"></div>

            <div class="col-10">

              <div class="card" style="background-color:#4CAF50;">
                <div class="card-header text-center">
                  <h3 class="card-title ">Nuevo Medicamento</h3>

                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="formulario-agregar-medicamento" method="POST">

                  <div class="card-body  text-white">
                    <div class="row">
                      <div class="col-6">
                        <label> Medicamento</label>
                        <select id="selectMedicamentos" name="idMedicamento" class="form-control select2"
                          style="width: 100%; padding: 15px;" required>
                          <option selected="selected">Seleccione un medicamento</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label>Número de Arete</label>
                        <select id="selectAnimalesMe" name="idAnimal" class="form-control select2"
                          style="width: 100%; padding: 15px;" required>
                          <option selected="selected">Seleccione un número de arete</option>

                        </select>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Fecha de Aplicacion</label>
                          <input type="date" class="form-control" name="fechaAplicacion" id="fechaAplicacion"
                            required>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Dosis Aplicada</label>
                          <input type="text" class="form-control" name="dosisAplicada" id="dosisAplicada" placeholder="Ingrese la dosis" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Lugar de Aplicacion</label>
                          <input type="text" class="form-control" name="lugarAplicacion" id="lugarAplicacion"
                            placeholder="Ingrese el lugar de aplicacion">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer text-center">
                    <div class="row">
                      <div class="col-6"><button type="submit"
                          class="btn btn-primary btnRegistrarMedicamento">Guardar</button>
                      </div>
                      <div class="col-6"><input type="reset" class=" btn btn-info" value="Limpiar datos"></div>
                    </div>
                  </div>
                </form>
              </div>

              <!-- /.card -->

            </div>
            <div class="col-1"></div>
          </div>
          <!-- /.row -->


          <!-- Tabla -->
          <div class="row mb-5" id="tabla-medicamentos">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <div class="card " style="overflow-y: scroll;">
                <div class="card-header text-center">
                  <h3 class="card-title ">Aplicaciones de Medicamentos</h3>
                </div>
                <div class="card-body p-3">
                  <table id="tablalistadomedicamento" class="table table-striped table-bordered table-hover">
                    <thead>
                      <th>Id</th>
                      <th>Nombre Medicamento</th>
                      <th>Número de Arete</th>
                      <th>Lugar de la Aplicacion</th>
                      <th>Dosis Aplicada</th>
                      <th>Fecha Aplicacion</th>
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
          <!-- /.tabla -->

          <!-- Tabla -->
          <div class="row mb-5" id="tabla-antibioticos">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <div class="card " style="overflow-y: scroll;">
                <div class="card-header text-center">
                  <h3 class="card-title ">Aplicacion de Antibioticos</h3>
                </div>
                <div class="card-body p-3">
                  <table id="tablalistadoantibiotico" class="table table-striped table-bordered table-hover">
                    <thead>
                      <th>Id</th>
                      <th>Nombre Antibiotico</th>
                      <th>Número de Arete</th>
                      <th>Lugar de la Aplicacion</th>
                      <th>Dosis Aplicada</th>
                      <th>Fecha Aplicacion</th>
                      <th>Dias de Retiro de Leche</th>
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
          <!-- /.tabla -->

          <div class="text-center py-5">
            <!-- Button trigger modal -->
            <button type="button" style="background-color:#4CAF50;" class="btn text-white " data-toggle="modal" data-target="#exampleModalCenter">
              Añadir un Registro de Inyectable
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar Aplicacion de Inyectable</h5>
                    <button type="button" style="background-color:#4CAF50;" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-center mb-3">
                    <h5>Qué desea agregar?</h5>

                    <a href="#" role="button" id="medicamento" style="background-color:#4CAF50;" class="btn text-white popover-test m-3"
                      data-content="Popover body content is set in this attribute." data-dismiss="modal">Aplicacion de
                      Medicamento</a>

                    <a href="#" role="button" id="antibiotico" style="background-color:#4CAF50;" class="btn text-white popover-test m-3"
                      data-content="Popover body content is set in this attribute." data-dismiss="modal">Aplicacion de
                      Antibiótico</a>
                  </div>

                </div>
              </div>
            </div>
          </div>

          


          <!-- Tabla -->
          <div class="row mb-5" id="tabla-medicamentos">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <div class="card " style="overflow-y: scroll;">
                <div class="card-header text-center">
                  <h3 class="card-title ">Aplicaciones de Medicamentos</h3>
                </div>
                <div class="card-body p-3">
                  <table id="tablalistadomedicamento" class="table table-striped table-bordered table-hover">
                    <thead>
                      <th>Id</th>
                      <th>Nombre Medicamento</th>
                      <th>Número de Arete</th>
                      <th>Lugar de la Aplicacion</th>
                      <th>Dosis Aplicada</th>
                      <th>Fecha Aplicacion</th>
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
          <!-- /.tabla -->

          <!-- Tabla -->
          <div class="row mb-5" id="tabla-antibioticos">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <div class="card " style="overflow-y: scroll;">
                <div class="card-header text-center">
                  <h3 class="card-title ">Aplicacion de Antibioticos</h3>
                </div>
                <div class="card-body p-3">
                  <table id="tablalistadoantibiotico" class="table table-striped table-bordered table-hover">
                    <thead>
                      <th>Id</th>
                      <th>Nombre Antibiotico</th>
                      <th>Número de Arete</th>
                      <th>Lugar de la Aplicacion</th>
                      <th>Dosis Aplicada</th>
                      <th>Fecha Aplicacion</th>
                      <th>Dias de Retiro de Leche</th>
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
          <!-- /.tabla -->

          <div class="text-center py-5">
            <!-- Button trigger modal -->
            <button type="button" style="background-color:#4CAF50;" class="btn text-white " data-toggle="modal" data-target="#exampleModalCenter">
              Añadir un Registro de Inyectable
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar Aplicacion de Inyectable</h5>
                    <button type="button" style="background-color:#4CAF50;" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-center mb-3">
                    <h5>Qué desea agregar?</h5>

                    <a href="#" role="button" id="medicamento" style="background-color:#4CAF50;" class="btn text-white popover-test m-3"
                      data-content="Popover body content is set in this attribute." data-dismiss="modal">Aplicacion de
                      Medicamento</a>

                    <a href="#" role="button" id="antibiotico" style="background-color:#4CAF50;" class="btn text-white popover-test m-3"
                      data-content="Popover body content is set in this attribute." data-dismiss="modal">Aplicacion de
                      Antibiótico</a>
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
<script src="../assets/js/inyeccion_antibiotico.js"></script>



</html>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SG GANADERIA | MEDICAMENTOS</title>

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

                <li class="breadcrumb-item active">Nuevo Medicamento</li>
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

          <!-- Tabla -->
          <div class="row mb-5" id="tabla-medicamentos">
            <div class="col-md-1"></div>
            <div class="col-md-10">
              <div class="card " style="overflow-y: scroll;">
                <div class="card-header text-center">
                  <h3 class="card-title ">Medicamentos</h3>
                </div>
                <div class="card-body p-3">
                  <table id="tablalistadomedicamento" class="table table-striped table-bordered table-hover">
                    <thead>
                      <th>Id</th>
                      <th>Nombre Enfermedad</th>
                      <th>Tipo de Medicamento</th>
                      <th>Fecha de Vencimiento</th>
                      <th>Lote</th>
                      <th>Descripcion</th>
                      <th>Presentacion</th>
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
                  <h3 class="card-title ">Antibioticos</h3>
                </div>
                <div class="card-body p-3">
                  <table id="tablalistadoantibiotico" class="table table-striped table-bordered table-hover">
                    <thead>
                      <th>Id</th>
                      <th>Nombre Antibiotico</th>
                      <th>Tipo de Antibiotico</th>
                      <th>Fecha de Vencimiento</th>
                      <th>Lote</th>
                      <th>Descripcion</th>
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
            <button type="button" style="background-color:#4CAF50;" class="btn text-white" data-toggle="modal" data-target="#exampleModalCenter">
              Añadir un Medicamento
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar Medicamentos</h5>
                    <button type="button" style="background-color:#4CAF50;" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-center mb-3">
                    <h5>Qué desea agregar?</h5>

                    <a href="#" role="button" id="medicina" style="background-color:#4CAF50;" class="btn text-white popover-test m-3"
                      data-content="Popover body content is set in this attribute." data-dismiss="modal">Medicamento</a>

                    <a href="#" role="button" id="antibiotico" style="background-color:#4CAF50;" class="btn text-white popover-test m-3"
                      data-content="Popover body content is set in this attribute." data-dismiss="modal">Antibiótico</a>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <!-- /.antibiotico -->
          <!-- /.form agregar -->
          <div class="row " id="form-agregar-antibiotico">
            <div class="col-1"></div>

            <div class="col-10">

              <div style="background-color:#28a745;" class="card">


                <div class="card-header text-center">
                  <h3 class="card-title  text-white">Nuevo Antibiotico</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="formulario-agregar-antibiotico">

                  <div class="card-body  text-white">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group ">
                          <label for="">Nombre del Antibiotico</label>
                          <input type="text" class="form-control" name="nombreAntibiotico" id="nombreAntibiotico"
                            placeholder="Ingrese el nombre de la vacuna">
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                        <label for="">Tipo de Antibiotico</label>
                            <select name="tipoAntibiotico" id="tipoAntibiotico" class="form-control select2">
                              <option value="Penicilinas">Penicilinas</option>
                              <option value="Cefalosporinas">Cefalosporinas</option>
                              <option value="Tetraciclinas">Tetraciclinas</option>
                              <option value="Aminoglucósidos">Aminoglucósidos</option>
                              <option value="Sulfonamidas y trimetoprim">Sulfonamidas y trimetoprim</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Fecha de Vencimiento</label>
                          <input type="date" class="form-control" name="fechaVencimiento" id="fechaVencimiento"
                            placeholder="xx/xx/xxxx">
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Lote</label>
                          <input type="text" class="form-control" name="lote" id="lote" placeholder="Ingrese el lote">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Descripción</label>
                          <input type="text" class="form-control" name="descripcion" id="descripcion"
                            placeholder="Ingrese la descripcion">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Dias Retiro</label>
                          <input type="number" class="form-control" name="diasRetiro" id="diasRetiro"
                            placeholder="Ingrese los dias de retiro de la leche">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer text-center">
                    <div class="row">
                      <div class="col-6"><button type="submit" class="btn btn-primary btnRegistrarAntibiotico">Guardar</button>
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

              <div class="card " style="background-color:#28a745;">

                <div class="card-header text-center">
                  <h3 class="card-title  text-white">Nuevo Medicamento</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="formulario-agregar-medicamento" method="POST">

                  <div class="card-body  text-white">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Nombre del Medicamento</label>
                          <input type="text" class="form-control" name="nombreMedicamento" id="nombreMedicamento"
                            placeholder="Ingrese el nombre del medicamento">
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Tipo de Medicamento</label>
                          <input type="text" class="form-control" name="tipoMedicamento" id="tipoMedicamento"
                            placeholder="Ingrese el tipo de medicamento">
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Fecha de Vencimiento</label>
                          <input type="date" class="form-control" name="fechaVencimiento" id="fechaVencimiento">
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label for="">Lote</label>
                          <input type="text" class="form-control" name="lote" id="lote" placeholder="Ingrese el lote">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Descripción</label>
                          <input type="text" class="form-control" name="descripcion" id="descripcion"
                            placeholder="Ingrese la descripcion">
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">Presentación</label>
                          <input type="text" class="form-control" name="presentacion" id="presentacion"
                            placeholder="Ingrese la presentación">
                        </div>
                      </div>





                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer text-center">
                    <div class="row">
                      <div class="col-6"><button type="submit" class="btn btn-primary btnRegistrarMedicamento">Guardar</button>
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
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- CSS styles -->
<link rel="stylesheet" href="../assets/css/index.css">


<!-- JD Scripts -->
<script src="../assets/js/medicamentos.js"></script>

</html>
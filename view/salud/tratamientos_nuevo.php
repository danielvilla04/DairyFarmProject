<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SG GANADERIA | NUEVO TRATAMIENTO</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

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
            <div class="col-sm-3">
              <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Salud</a></li>
                <li class="breadcrumb-item active">Tratamientos</li>
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
          <div class="row">
            <div class="col-12">
            <div class="card " style="background-color:#4CAF50;">
              <div class="card-header text-center">
                <h3 class="card-title text-white">Nuevo Tratamiento</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body text-white ">
                  <div class="form-group">
                    <label for="">Número de Arete</label>
                    <input type="number" class="form-control" id="" placeholder="Ingrese el número de arete">
                  </div>
                  <div class="form-group">
                    <label for="">Medicina Utilizada</label>
                    <input type="text" class="form-control" id="" placeholder="Ingrese la medicina">
                  </div>
                  <div class="form-group">
                    <label for="">Fecha de Inicio</label>
                    <input type="text" class="form-control" id="" placeholder="Ingrese los sintomas">
                  </div>
                  <div class="form-group">
                    <label for="">Duración del tratamiento</label>
                    <input type="text" class="form-control" id="" placeholder="Ingrese la duracion">
                  </div>
                  <div class="form-group">
                    <label for="">Tipo de Tratamiento</label>
                    <input type="text" class="form-control" id="" placeholder="Ingrese el tipo">
                  </div>
                  <div class="form-group">
                    <label for="">Persona Encargada</label>
                    <input type="text" class="form-control" id="" placeholder="Ingrese la persona encargada">
                  </div>
                  <div class="form-group">
                    <label for="">Observaciones</label>
                    <input type="text" class="form-control" id="" placeholder="Ingrese las observaciones">
                  </div>
                  

                  



                </div>
                <!-- /.card-body -->

                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
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

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
</body>
<!-- CSS styles -->
<link rel="stylesheet" href="../css/index.css">

</html>
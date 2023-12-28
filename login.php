<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Inicio de sesión</title>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./view/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./view/dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


</head>

<body>

  <div class="container text-center">
    <div class="row mt-5">
      <div class="col-3"></div>

      <div class="col-6 mt-5">
        <div style="background-color:#28a745;">
          <div class="login-logo">
            <a style="color: #f3f1ff;" href="LandPage.php"><b>SG GANADERIA</b></a>
          </div>

          <div class="card ">
            <div style="background-color:#28a745;" class="card-body login-card-body">
              <p style="color: #f3f1ff;">Inicia sesión</p>
              <form id="formulario-login" method="post">
                <div class="input-group mb-3">
                  <input type="email" name="email" class="form-control" placeholder="Correo">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span style="color: #f3f1ff;" class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Contraseña">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span style="color: #f3f1ff;" class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="row">


                  <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                  </div>

                </div>
              </form>

            
              <p class="mb-0">
                <a style="color: #f3f1ff;" href="Registrarse.php" class="text-center">¿Eres nuevo por
                  aquí? ¡Regístrate! </a>
              </p>
            </div>

          </div>
        </div>

      </div>
      <div class="col-3"></div>
    </div>
  </div>





</body>
<!--   JQUERY -->
<script src="./view/plugins/jquery/jquery.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<!-- Bootstrap 4 -->
<script src="./view/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./view/dist/js/adminlte.min.js?v=3.2.0"></script>
<!-- Bootbox -->
<script src="./view/plugins/bootbox/bootbox.min.js"></script>
<!-- toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- CSS styles -->
<link rel="stylesheet" href="./view/assets/css/index.css">
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="./view/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

<!-- JS SCRIPTS -->
<script src="./view/assets/js/user.js"></script>




</html>
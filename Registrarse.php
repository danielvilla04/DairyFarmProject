<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Registro</title>

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



    <link rel="stylesheet" href="./view/dist/css/adminlte.min.css?v=3.2.0">

</head>

<body class="login-page" style="min-height: 496.781px;">

    <div class="login-box">
        <div class="login-logo">
            <a href="index.php"><b>SG GANADERIA</b></a>
        </div>

        <div class="card">
            <div style="background-color:#28a745;" class="card-body login-card-body">
                <p style="color: #f3f1ff;" class="login-box-msg">Registrate</p>
                <form method="post" id="formulario-registro">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nombre"  placeholder="Nombre">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span style="color: #f3f1ff;" class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Correo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span style="color: #f3f1ff;" class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password_hash" placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span style="color: #f3f1ff;" class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirmar Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span style="color: #f3f1ff;" class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label style="color: #f3f1ff;" for="agreeTerms">
                                    Estoy de acuerdo con los <a style="color: #f3f1ff;" href="#">Terminos de
                                        privacidad</a>
                                </label>
                            </div>
                        </div>


                        <div class="col-12 my-2">
                            <button type="submit" id="btnRegistrar" name="btnRegistrar"
                                class="btn btn-primary btn-block">Regístrame</button>
                        </div>


                    </div>
                </form>

                <a href="login.php" class="text-center text-white">Tengo una cuenta activa ¡Inicia Sesion!</a>
            </div>

        </div>
        </form>

    </div>


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
<script src="./view/dist/js/adminlte.min.js"></script>
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
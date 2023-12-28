<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Inicio</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./view/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./view/assets/css/landPage.css">

</head>

<body>
  <div class="wrapper">



    <nav id="main-navbar" class="navbar navbar-expand-lg ">
      <div class="container-fluid ">
        <a class="navbar-brand text-white" href="#">
          <img src="./view/assets/imagenes/logo.png" alt="" width="130px">
        </a>

        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0  " style="z-index: 1;">
            <li class="nav-item mx-5 float-sm-right">
              <a href="login.php" class="btn btn-success" tabindex="-1" role="button"> Iniciar Sesión</a>
            </li>
            <li class="nav-item mx-5 float-sm-right">
              <a href="Registrarse.php" class="btn btn-success" tabindex="-1" role="button"> Registrarse </a>
            </li>

          </ul>

        </div>
      </div>
    </nav>

    <div class=" content-wrapper">


      <section class="content">
        <div class="container-fluid">

          <div class="row mt-2">
            <div id="carouselExampleCaptions" class="carousel slide" style="z-index: 0;">

              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="./view/assets/imagenes/VacaCarrusel.png" alt="imagen ganaderia" class="d-block w-100"
                    max-height="700">
                  <div class="carousel-caption d-none d-md-block">


                  </div>
                </div>
                <div class="carousel-item">
                  <img src="./view/assets/imagenes/VacaCarrusel2.jpg" class="d-block w-100" max-height="700">
                  <div class="carousel-caption d-none d-md-block">

                  </div>
                </div>
                <div class="carousel-item">
                  <img src="./view/assets/imagenes/VacaCarrusel3.png" class="d-block w-100" max-height="700">
                  <div class="carousel-caption d-none d-md-block">

                  </div>
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>


          <div class="row mb-2">
            <div class="col-12 mt-5">
              <h1 style="text-align: center"> ¿Por qué elegirnos? </h1>
            </div>
          </div>

          <div class="row my-5 ">
            <div class="col-md-6 mt-5 pt-5 pl-5">
              <div class="narrow-paragraph float-sm-right text-center">
                <h1 class="font-weight-bold">
                  Automatización Inteligente
                </h1>
                <p class="texto-inicio text-center ">
                  Nuestra plataforma automatiza tareas rutinarias, lo que te permite centrarte en lo que realmente
                  importa.
                </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mx-auto d-block">
                <img src="./view/assets/imagenes/GanaderiaInteligente.jpg" alt="imagen ganaderia" width="600px">
              </div>
            </div>
          </div>

          <div class="row my-5 ">

            <div class="col-md-6">
              <div class="mx-auto d-block">
                <img src="./view/assets/imagenes/GanaderiaDatos.jpg" alt="imagen ganaderia" width="600px">
              </div>
            </div>
            <div class="col-md-6 mt-5 pt-5 pr-5">
              <div class="narrow-paragraph float-sm-left text-center">
                <h1 class="font-weight-bold">
                  Registro Detallado de Animales
                </h1>
                <p class="texto-inicio text-center " style="font">
                  Lleva un seguimiento completo de cada uno de tus animales, desde su nacimiento hasta su producción de
                  leche y salud.
                </p>
              </div>
            </div>
          </div>

          <div class="row my-5 ">
            <div class="col-sm-1">
            </div>
            <div class="col-md-5 mt-5 pt-5 pl-5">
              <div class="narrow-paragraph float-sm-right text-center">
                <h1 class="font-weight-bold">
                  Análisis de Datos Avanzado
                </h1>
                <p class="texto-inicio text-center ">
                  Convierte datos en información valiosa. Obtén informes detallados para tomar decisiones fundamentadas.
                </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mx-auto d-block">
                <img src="./view/assets/imagenes/AnalisisDatos.jpg" alt="imagen ganaderia" width="600px">
              </div>
            </div>
          </div>

          <div class="row my-5 ">
            <div class="col-md-6">
              <div class="mx-auto d-block">
                <img src="./view/assets/imagenes/NotificacionesAlertas.jpg" alt="imagen ganaderia" width="600px">
              </div>
            </div>
            <div class="col-md-6 mt-5 pt-5 pr-5">
              <div class="narrow-paragraph float-sm-left text-center">
                <h1 class="font-weight-bold">
                  Notificaciones y Alertas
                </h1>
                <p class="texto-inicio text-center ">
                  Mantén el control con alertas instantáneas sobre eventos críticos en tu finca.
                </p>
              </div>
            </div>
          </div>



        </div>
      </section>

    </div>

    <footer>
      <div style="background-color:#28a745" class=" text-center">

        <h1 style="color: #f3f1ff;"> Contacto </h1>
        <div class="row">
          <div class="col-6">
            <div style="color: #f3f1ff;" class="mt-5">
              <h5 class="card-title">Correo electrónico</h5>
              <p class="card-text">DVilallobos@gmail.com</p>


            </div>
          </div>
          <div class="col-6">
            <div style="color: #f3f1ff;" class="mt-5">
              <h5 class="card-title">Número de teléfono</h5>
              <p class="card-text">8415 3390</p>

            </div>
          </div>
          <div class="col-12">
            <div style="color: #f3f1ff;" class="mb-4">
              <?php
              include './view/fragments/footer.php'
                ?>
            </div>
          </div>

        </div>











      </div>
    </footer>
  </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>
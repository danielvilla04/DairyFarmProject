
$(document).ready(function () {
  const smallBox = $('.small-box');
  const cantidadAnimalesElement = $('#promedioAnimales');

  function mostrarCantidadAnimales(data) {
      const cantidadAnimales = parseInt(data);
      if (!isNaN(cantidadAnimales)) {
          cantidadAnimalesElement.text(cantidadAnimales);
      } else {
          console.error('La respuesta del servidor no es un número válido:', data);
          cantidadAnimalesElement.text('Error al obtener la cantidad de animales');
      }
  }

  $.ajax({
      url: '../../controller/animales/AnimalController.php?op=obtenerCantidadAnimales',
      method: 'GET',
      success: mostrarCantidadAnimales,
      error: function (jqXHR, textStatus, errorThrown) {
          console.error('Error obteniendo la cantidad de animales:', textStatus, errorThrown);
          cantidadAnimalesElement.text('Error al obtener la cantidad de animales');
      }
  });
});
$(document).ready(function () {
  const smallBox = $('.small-box');
  const cantidadProduccionElement = $('#produccion');

  function mostrarCantidadProduccion(data) {
      const cantidadProduccion = parseInt(data);
      if (!isNaN(cantidadProduccion)) {
        cantidadProduccionElement.text(cantidadProduccion);
      } else {
          console.error('La respuesta del servidor no es un número válido:', data);
          cantidadProduccionElement.text('Error al obtener la cantidad de animales');
      }
  }

  $.ajax({
      url: '../../controller/produccion/produccionNController.php?op=obtenerCantidadProduccion',
      method: 'GET',
      success: mostrarCantidadProduccion,
      error: function (jqXHR, textStatus, errorThrown) {
          console.error('Error obteniendo la cantidad de produccion:', textStatus, errorThrown);
          cantidadProduccionElement.text('Error al obtener la cantidad de produccion');
      }
  });
});

$(document).ready(function () {
  const smallBox = $('.small-box');
  const promedioProduccionElement = $('#promedioProduccion');

  function mostrarpromedioProduccion(data) {
      const promedioProduccion = parseInt(data);
      if (!isNaN(promedioProduccion)) {
        promedioProduccionElement.text(promedioProduccion);
      } else {
          console.error('La respuesta del servidor no es un número válido:', data);
          promedioProduccionElement.text('Error al obtener la promedio de produccion');
      }
  }

  $.ajax({
      url: '../../controller/produccion/produccionNController.php?op=obtenerPromedioProduccion',
      method: 'GET',
      success: mostrarpromedioProduccion,
      error: function (jqXHR, textStatus, errorThrown) {
          console.error('Error obteniendo la cantidad de produccion:', textStatus, errorThrown);
          promedioProduccionElement.text('Error al obtener la cantidad de produccion');
      }
  });
});
$(document).ready(function () {
  function obtenerAnimalesGrafica() {
      $.ajax({
        url: '../../controller/animales/animalController.php?op=listar_animales_grafica',
        type: "GET",
        data: { obtenerAnimalesGrafica: true },
        dataType: "json",
        success: function (data) {
          console.log(data)
          if (data) {

            const ctx = document.getElementById('graficoAnimal');
            new Chart(ctx, {
              type: 'bar',
              data: {
                labels: data.meses, // Meses obtenidos de PHP
                datasets: [{
                    label: 'Cantidad de Vacas ingresas por Mes',
                    data: data.cantidadAnimales, // Cantidad de animales obtenidas de PHP
                    backgroundColor: 'rgba(54, 162, 235, 0.5)', // Color del gráfico
                    borderColor: 'rgba(54, 162, 235, 1)', // Borde del gráfico
                    borderWidth: 1
                }]
            },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          


          } else {
            console.log("No se encontraron enfermedades");
          }
        },
        error: function (xhr, status, error) {
          console.error(error);
        }
      });
    
    }

  obtenerAnimalesGrafica();

  function listaranimales() {
    tabla = $('#tablaAnimal').dataTable({
      aProcessing: true, //actiavmos el procesamiento de datatables
      aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
      dom: 'Bfrtip', //definimos los elementos del control de tabla
      buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
      ajax: {
        url: '../../controller/animales/animalController.php?op=listarAnimales',
        type: 'get',
        dataType: 'json',
        error: function (e) {
          console.log(e.responseText);
        }
      },
      bDestroy: true,
      iDisplayLength: 5
    });
  }
  listaranimales();

  $(document).ready(function () {
    $.ajax({
        url: '../../controller/animales/animalController.php?op=listarImagen',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            var carouselInner = $('#carouselExampleIndicators .carousel-inner');

            data.forEach(function (imageHTML, index) {
                carouselInner.append(imageHTML);
            });

            $('#carouselExampleIndicators .carousel-inner .carousel-item:first').addClass('active');
        },
        error: function (xhr, status, error) {
          console.error(error);
        }
    });
});
  
});

$('#logoutButton').on('click', function(e) {
  e.preventDefault(); 

  $.ajax({
    url: '../../controller/login/logout.php', 
    type: 'GET',
    success: function(response) {
      if(response==1)
      {
        window.location.href = '../../landingPage.php';

      }
      else
      {
        console.log("no tiene una sesion iniciada")
      }
    },
    error: function(error) {
      console.log('Error al cerrar sesión:', error);
     
    }
  });
});


$(document).ready(function () {
    const smallBox = $('.small-box');
    const $cantidadCeloElement = $('#cantidadCelos');
  
    function mostrarCantidadCelo(data) {
        const cantidadCelo = parseInt(data);
        if (!isNaN(cantidadCelo)) {
            $cantidadCeloElement.text(cantidadCelo);
        } else {
            console.error('La respuesta del servidor no es un número válido:', data);
            $cantidadCeloElement.text('Error al obtener la cantidad de animales');
        }
    }
  
    $.ajax({
        url: '../../controller/reproduccion_celos/celosController.php?op=obtenerCantidadCelo',
        method: 'GET',
        success: mostrarCantidadCelo,
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error obteniendo la cantidad de animales:', textStatus, errorThrown);
            $cantidadCeloElement.text('Error al obtener la cantidad de animales');
        }
    });
  });
  $(document).ready(function () {
    const smallBox = $('.small-box');
    const cantidadServicioElement = $('#cantidadServicio');
  
    function mostrarcantidadServicio(data) {
        const cantidadServicio = parseInt(data);
        if (!isNaN(cantidadServicio)) {
          cantidadServicioElement.text(cantidadServicio);
        } else {
            console.error('La respuesta del servidor no es un número válido:', data);
            cantidadServicioElement.text('Error al obtener la cantidad de animales');
        }
    }
  
    $.ajax({
        url: '../../controller/reproduccion_celos/servicioController.php?op=obtenerCantidadServicio',
        method: 'GET',
        success: mostrarcantidadServicio,
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error obteniendo la cantidad de produccion:', textStatus, errorThrown);
            cantidadServicioElement.text('Error al obtener la cantidad de produccion');
        }
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
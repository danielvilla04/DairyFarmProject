

$(document).ready(function () {
  $('#calendario').fullCalendar({
    initialView: 'dayGridMonth',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month'
    },
    events:'../../controller/reproduccion_celos/servicioController.php?op=obtener_servicios',
    editable: false, 
    eventRender: function (event, element) {

      if (event.tipo === 'servicio') {
        element.css('background-color', '#52AA5E'); 
    } else if (event.tipo === 'celo') {
        element.css('background-color', '#ff5733'); 
    }
    }
    

  });

});


function obtener() {
  $.ajax({
    url: '../../controller/reproduccion_celos/servicioController.php?op=obtener_servicios',
    type: "GET",
    dataType: "json",
    success: function (data) {

      console.log(data)
    },
    error: function (xhr, status, error) {
      console.error(error);
    }
  });
}



function obtenerVacasPrenadas() {
  $.ajax({
    url: '../../controller/animales/animalController.php?op=listar_vacas_prenadas',
    type: "GET",
    data: { obtenerVacasPrenadas: true },
    dataType: "text",
    success: function (data) {

      if (data) {
        // Llenar el select con la cantidad de vacas
        $('#card-vacas-prenadas').text(data);
      } else {
        console.log("No se encontraron vacas preñadas");
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    }
  });
}

function obtenerVacasVacias() {
  $.ajax({
    url: '../../controller/animales/animalController.php?op=listar_vacas_vacias',
    type: "GET",
    data: { obtenerVacasVacias: true },
    dataType: "text",
    success: function (data) {
      console.log(data)
      if (data) {
        // Llenar el select con la cantidad de vacas
        $('#card-vacas-vacias').text(data);
      } else {
        console.log("No se encontraron vacas vacias");
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    }
  });
}

function obtenerGrafica() {
  $.ajax({
    url: '../../controller/reproduccion_celos/celosController.php?op=listar_celos_grafica',
    type: "GET",
    data: { obtenerGrafica: true },
    dataType: "json",
    success: function (data) {
      console.log(data)
      if (data) {

        const ctx = document.getElementById('graficoReproduccion');
        new Chart(ctx, {
          type: 'line',
          data: {
            labels: data.meses, // Meses obtenidos de PHP
            datasets: [{
              label: 'Cantidad de Celos por Mes',
              data: data.cantidadCelos, // Cantidad de enfermedades obtenidas de PHP
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
        console.log("No se encontraron celos");
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    }
  });
}

/*Funcion para cargar el listado en el Datatable*/
function listarServicios() {
  tabla = $('#tablaservicios').dataTable({
    aProcessing: true, //actiavmos el procesamiento de datatables
    aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
    dom: 'Bfrtip', //definimos los elementos del control de tabla
    ajax: {
      url: '../../controller/reproduccion_celos/servicioController.php?op=listar_servicios',
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

/*Funcion para cargar el listado en el Datatable*/
function listarCelos() {
  tabla = $('#tablacelos').dataTable({
    aProcessing: true, //actiavmos el procesamiento de datatables
    aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
    dom: 'Bfrtip', //definimos los elementos del control de tabla
    ajax: {
      url: '../../controller/reproduccion_celos/celosController.php?op=listar_celos',
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


obtenerGrafica()
obtenerVacasVacias()
obtenerVacasPrenadas()
listarServicios()
listarCelos()
obtener()



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














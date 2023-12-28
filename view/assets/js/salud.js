
$(document).ready(function () {
  // Función para obtener los animales y llenar el select
  function obtenerAnimalesEnfermos() {
    $.ajax({
      url: '../../controller/salud/enfermedadAnimalController.php?op=listar_animales_enfermos',
      type: "GET",
      data: { obtenerAnimalesEnfermos: true },
      dataType: "text",
      success: function (data) {
        console.log(data)
        if (data) {
          // Llenar el select con la cantidad de vacas
          $('#card-animales-enfermos').text(data);
        } else {
          console.log("No se encontraron animales enfermos");
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });
  }

  function obtenerAnimalesAntibiotico() {
    $.ajax({
      url: '../../controller/salud/inyeccionAnController.php?op=listar_animales_antibiotico',
      type: "GET",
      data: { obtenerAnimalesAntibiotico: true },
      dataType: "text",
      success: function (data) {
        if (data) {
          // Llenar el select con la cantidad de vacas
          $('#card-animales-antibiotico').text(data);
        } else {
          console.log("No se encontraron animales con antibiotico");
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });
  }

  function obtenerVacasMastitis() {
    $.ajax({
      url: '../../controller/salud/mastitisController.php?op=listar_vacas_mastitis',
      type: "GET",
      data: { obtenerVacasMastitis: true },
      dataType: "text",
      success: function (data) {
        console.log(data) 
        if (data) {
          // Llenar el select con la cantidad de vacas
          $('#card-vacas-mastitis').text(data);
        } else {
          console.log("No se encontraron vacas con mastitis");
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });
  }

  function obtenerEnfermedadesGrafica() {
    $.ajax({
      url: '../../controller/salud/enfermedadAnimalController.php?op=listar_enfermedades_grafica',
      type: "GET",
      data: { obtenerEnfermedadesGrafica: true }, 
      dataType: "json",
      success: function (data) {
        console.log(data)
        if (data) {

          const ctx = document.getElementById('graficoEnfermas');
          new Chart(ctx, {
            type: 'bar',
            data: {
              labels: data.meses, // Meses obtenidos de PHP
              datasets: [{
                  label: 'Cantidad de Vacas Enfermas por Mes',
                  data: data.cantidadEnfermedades, // Cantidad de enfermedades obtenidas de PHP
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

  /*Funcion para cargar el listado en el Datatable*/
function listarInyecciones() {
  tabla = $('#tablainyecciones').dataTable({
    aProcessing: true, //actiavmos el procesamiento de datatables
    aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
    dom: 'Bfrtip', //definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
    ajax: {
      url: '../../controller/salud/inyeccionMeController.php?op=listar_inyecciones',
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

  

 
  obtenerAnimalesEnfermos();
  obtenerAnimalesAntibiotico();
  obtenerVacasMastitis();
  obtenerEnfermedadesGrafica();
  listarInyecciones();

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






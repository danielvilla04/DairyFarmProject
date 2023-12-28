$(document).ready(function () {
  // Función para obtener los animales y llenar el select
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

  function obtenerMastitisGrafica() {
    $.ajax({
      url: '../../controller/salud/mastitisController.php?op=listar_mastitis_grafica',
      type: "GET",
      data: { obtenerMastitisGrafica: true },
      dataType: "json",
      success: function (data) {
        console.log(data)
        if (data) {

          const ctx = document.getElementById('grafico-mastitis'); 
          new Chart(ctx, {
            type: 'line',
            data: {
              labels: data.meses, 
              datasets: [{
                  label: 'Cantidad de Vacas con Mastitis por Mes',
                  data: data.cantidadmastitis, 
                  backgroundColor: 'rgba(54, 162, 235, 0.5)',
                  borderColor: 'rgba(54, 162, 235, 1)', 
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
          console.log("No se encontraron mastitis");
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });
  }

  function listarMastitisUltimoMes() {
    tabla = $('#tablamastitis').dataTable({
      aProcessing: true, //actiavmos el procesamiento de datatables
      aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
      dom: 'Bfrtip', //definimos los elementos del control de tabla
      buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
      ajax: {
        url: '../../controller/salud/mastitisController.php?op=listar_mastitis',
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

  function obtenerVacasMastitisInyeccion() {
    $.ajax({
      url: '../../controller/salud/mastitisController.php?op=listar_mastitis_inyeccion',
      type: "GET",
      data: { obtenerMastitisInyeccion: true },
      dataType: "text",
      success: function (data) {
        console.log(data) 
        if (data) {
          // Llenar el select con la cantidad de vacas
          $('#card-mastitis-inyeccion').text(data);
        } else {
          console.log("No se encontraron vacas con mastitis");
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });
  }

  function obtenerVacasMastitisDirecto() {
    $.ajax({
      url: '../../controller/salud/mastitisController.php?op=listar_mastitis_directo',
      type: "GET",
      data: { obtenerMastitisDirecto: true },
      dataType: "text",
      success: function (data) {
        console.log(data) 
        if (data) {
          // Llenar el select con la cantidad de vacas
          $('#card-mastitis-directo').text(data);
        } else {
          console.log("No se encontraron vacas con mastitis");
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });
  }



  obtenerVacasMastitis();
  obtenerMastitisGrafica();
  listarMastitisUltimoMes();
  obtenerVacasMastitisDirecto();
  obtenerVacasMastitisInyeccion();
  

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

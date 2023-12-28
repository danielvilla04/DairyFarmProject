
$(document).ready(function () {

  function obtenerPartosGrafica() {
    $.ajax({
      url: '../../controller/partos/partoController.php?op=listar_partos_grafica',
      type: "GET",
      data: { obtenerPartosGrafica: true },
      dataType: "json",
      success: function (data) {
        console.log(data)
        if (data) {

          const ctx = document.getElementById('graficoPartos');
          new Chart(ctx, {
            type: 'bar',
            data: {
              labels: data.meses,
              datasets: [{
                label: 'Cantidad de Partos por Mes',
                data: data.cantidadPartos,
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
          console.log("No se encontraron partos");
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });
  }

  function obtenerAbortosGrafica() {
    $.ajax({
      url: '../../controller/partos/abortoController.php?op=listar_abortos_grafica',
      type: "GET",
      data: { obtenerAbortosGrafica: true },
      dataType: "json",
      success: function (data) {
        console.log(data)
        if (data) {

          const ctx = document.getElementById('graficoAbortos');
          new Chart(ctx, {
            type: 'bar',
            data: {
              labels: data.meses,
              datasets: [{
                label: 'Cantidad de Abortos por Mes',
                data: data.cantidadAbortos,
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
          console.log("No se encontraron Abortos");
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });
  }
  /*Funcion para cargar el listado en el Datatable*/
  function listarPrenos() {
    tabla = $('#tablaprenos').dataTable({
      aProcessing: true, //actiavmos el procesamiento de datatables
      aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
      dom: 'Bfrtip', //definimos los elementos del control de tabla
      buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
      ajax: {
        url: '../../controller/reproduccion_celos/vacaPrenadaController.php?op=listar_prenos',
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


  obtenerPartosGrafica();
  listarPrenos()
  obtenerAbortosGrafica()

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







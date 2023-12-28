$(document).ready(function () {
  // Función para obtener los animales y llenar el select
  function obtenerAnimalesVacunados() {
    $.ajax({
      url: '../../controller/salud/vacunacionController.php?op=listar_animales_vacunados',
      type: "GET",
      data: { obtenerAnimalesVacunados: true },
      dataType: "text",
      success: function (data) {
        console.log(data)
        if (data) {
          // Llenar el select con la cantidad de vacas
          $('#card-animales-vacunados').text(data);
        } else {
          console.log("No se encontraron animales vacunados");
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });
  }

  

  function listarAnimalesNoVacunados() {
    tabla = $('#tablasinvacunar').dataTable({
      aProcessing: true, //actiavmos el procesamiento de datatables
      aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
      dom: 'Bfrtip', //definimos los elementos del control de tabla
      buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
      ajax: {
        url: '../../controller/animales/animalController.php?op=listar_animales_no_vacunados',
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
function listarVacunas() {
  tabla = $('#tablavacunas').dataTable({
    aProcessing: true, //actiavmos el procesamiento de datatables
    aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
    dom: 'Bfrtip', //definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
    ajax: {
      url: '../../controller/salud/vacunaController.php?op=listar_vacunas',
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

function obtenerCantidadVacunas() {
  $.ajax({
    url: '../../controller/salud/vacunacionController.php?op=obtener_vacunas_puestas',
    type: "GET",
    data: { obtenerVacunasPuestas: true },
    dataType: "text",
    success: function (data) { 
      console.log(data)
      if (data) {
        // Llenar el select con la cantidad de vacas
        $('#card-vacunas-aplicadas').text(data);
      } else {
        console.log("No se encontraron animales vacunados");
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    }
  });
}

  obtenerAnimalesVacunados();
  listarAnimalesNoVacunados();
  listarVacunas();
  obtenerCantidadVacunas();
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


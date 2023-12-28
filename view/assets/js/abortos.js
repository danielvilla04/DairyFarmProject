$(document).ready(function () {

  $('.select2').select2();
  // Función para obtener los animales y llenar el select
  function obtenerAnimales() {
      $.ajax({ 
          url: '../../controller/animales/AnimalController.php?op=listar_animales',
          type: "GET",
          data: { obtenerAnimales: true },
          dataType: "json",
          success: function(data) {
              if (data) {
                  // Llenar el select con las vacas obtenidas
                  $.each(data, function(index, animal) {
                      $('#selectAnimales').append('<option value="' + animal.id_animal + '">' + animal.numero_arete + '</option>');
                  });
              } else {
                  console.log("No se encontraron animales.");
              }
          },
          error: function(xhr, status, error) {
              console.error(error);
          }
      });
  }

  obtenerAnimales();

  $('#calendario').fullCalendar({
    initialView: 'dayGridMonth',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month'
    },
    events:'../../controller/partos/abortoController.php?op=obtener_abortos',
    editable: false, 
    eventRender: function (event, element) {
        element.css('background-color', '#52AA5E'); 

    }
  
  });

});
function obtener() {
  $.ajax({
    url: '../../controller/partos/abortoController.php?op=obtener_abortos',
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
obtener()

/*Funcion para cargar el listado en el Datatable*/
function listarAbortos() {
    tabla = $('#tablalistado').dataTable({
      aProcessing: true, //actiavmos el procesamiento de datatables
      aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/abortoController.php?op=listar_tabla'
      dom: 'Bfrtip', //definimos los elementos del control de tabla
      buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
      ajax: {
        url: '../../controller/partos/abortoController.php?op=listar_tabla',
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

  // Funcion principal

$(function(){
    $('#form-modificar').hide();
    listarAbortos();
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
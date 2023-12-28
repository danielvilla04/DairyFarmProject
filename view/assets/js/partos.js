//funcion para insertar animales
$(document).ready(function() {
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


  $('#calendario').fullCalendar({
    initialView: 'dayGridMonth',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month'
    },
    events:'../../controller/partos/partoController.php?op=obtener_partos',
    editable: false, 
    eventRender: function (event, element) {
        element.css('background-color', '#52AA5E'); 

    }
  
  });



  // Llamar a la función para obtener las vacas cuando el documento esté listo
  obtenerAnimales();
 
});
//funcion para limpiar forms
function limpiarForms() {
  $('#formulario-agregar').trigger('reset');
  $('#formulario-modificar').trigger('reset');
}


//cancelar formulario de modificacion

function cancelarForm() {
  limpiarForms();
  $('#form-agregar').show();
  $('#form-modificar').hide();

}



/*Funcion para cargar el listado en el Datatable*/
function listarParto() {
  tabla = $('#tablalistado').dataTable({
    aProcessing: true, //activamos el procesamiento de datatables
    aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
    dom: 'Bfrtip', //definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
    ajax: {
      url: '../../controller/partos/partoController.php?op=listar_tabla',
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

$(function () {

  listarParto();
});


// Añadir datos a la db
$('#formulario-agregar').on('submit', function (event) {
  event.preventDefault();
  $('#btnRegistar').prop('disabled', true);
  var formData = new FormData($('#formulario-agregar')[0]);
  $.ajax({
    url: '../../controller/partos/partoController.php?op=insertar',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      switch (datos) {
        case '1':
          toastr.success(
            'Parto registrado'
          );
          $('#formulario-agregar')[0].reset();
          tabla.api().ajax.reload();
          break;

        case '2':
          toastr.error(
            'Error al guardar la información, este registro ya existe en la base de datos'
          );
          break;

        case '3':
          toastr.error('Hubo un error al tratar de ingresar los datos.');
          break;
        default:
          toastr.error(datos);
          break;
      }
      $('#btnRegistar').removeAttr('disabled');
    },
  });
});



/*Funcion para eliminar datos*/
function eliminar(id) {
  bootbox.confirm('¿Esta seguro de eliminar el parto?', function (result) {
    if (result) {
      $.post(
        '../../controller/partos/partoController.php?op=eliminar',
        { idRegistro: id },
        function (data, textStatus, xhr) {
          switch (data) {
            case '0':
              toastr.success('Parto eliminado');
              tabla.api().ajax.reload();
              break;

            case '1':
              toastr.error(
                'Error: El dato no se ha podido eliminar..'
              );
              break;
 
            default:
              toastr.error(data);
              break;
          }
        }
      );
    }
  });
}

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

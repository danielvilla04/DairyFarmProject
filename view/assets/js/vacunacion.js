//funcion para insertar animales
$(document).ready(function () {
  $('.duallistbox').bootstrapDualListbox()
  $('.select2').select2({
  });
  // Función para obtener los animales y llenar el select
  function obtenerAnimales() {
    $.ajax({
      url: '../../controller/animales/animalController.php?op=listar_animales',
      type: "GET",
      data: { obtenerAnimales: true },
      dataType: "json",
      success: function (data) {
        if (data) {
          // Limpiar el select antes de agregar nuevas opciones
          $('#selectAnimales').empty();

          // Agregar los animales al DualListBox
          $.each(data, function (index, animal) {
            $('#selectAnimales').append('<option value="' + animal.id_animal + '">' + animal.numero_arete + '</option>');
          });

          // Actualizar el DualListBox después de agregar las opciones
          $('#selectAnimales').bootstrapDualListbox('refresh', true);
        } else {
          console.log("No se encontraron animales.");
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });
  }

  // Función para obtener las enfermedades y llenar el select
  function obtenerVacunas() {
    $.ajax({ 
        url: '../../controller/salud/vacunaController.php?op=obtener_vacunas',
        type: "GET",
        data: { obtenerVacunas: true },
        dataType: "json",
        success: function(data) {
          console.log(data)
            if (data) {
                // Llenar el select con las enfermedades obtenidas
                $.each(data, function(index, vacuna) {
                    $('#selectVacunas').append('<option value="' + vacuna.id + '">' + vacuna.nombre +  '</option>');
                });
            } else {
                console.log("No se encontraron vacunas.");
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

  // Llamar a la función para obtener las vacas cuando el documento esté listo
  obtenerAnimales();
  obtenerVacunas();

});



//funcion para limpiar forms
function limpiarForms() {
  $('#formulario-agregar').trigger('reset');
  $('#formulario-modificar').trigger('reset');
}




/*Funcion para cargar el listado en el Datatable*/
function listarVacunacion() {
  tabla = $('#tablalistado').dataTable({
    aProcessing: true, //actiavmos el procesamiento de datatables
    aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
    dom: 'Bfrtip', //definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
    ajax: {
      url: '../../controller/salud/vacunacionController.php?op=listar_tabla',
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
  $('#form-modificar').hide();
  listarVacunacion();
});


// Añadir datos a la db
$('#formulario-agregar').on('submit', function (event) {
  event.preventDefault();
  $('#btnRegistrar').prop('disabled', true);
  var formData = new FormData($('#formulario-agregar')[0]);

  $.ajax({
    url: '../../controller/salud/vacunacionController.php?op=insertar',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      switch (datos) {
        case '1':
          toastr.success(
            'Vacunacion registrada'
          );
          $('#formulario-agregar')[0].reset();
          tabla.api().ajax.reload();
          break;

        case '2':
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




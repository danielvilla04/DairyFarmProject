$(document).ready(function() {
  $('.select2').select2();
});


//funciones para el modal
$('#antibiotico').on('click', function(event) {
  $('#form-agregar-antibiotico').show();
  $('#form-agregar-medicamento').hide();
});
$('#medicina').on('click', function(event) {
  $('#form-agregar-medicamento').show();
  $('#form-agregar-antibiotico').hide();
});

//funcion para limpiar forms
function limpiarForms() {
  $('#formulario-agregar-antibiotico').trigger('reset');
  $('#formulario-modificar').trigger('reset');
}


//cancelar formulario de modificacion

function cancelarForm() {
  limpiarForms();
  $('#form-agregar').show();
  $('#form-modificar').hide();

}

/*Funcion para cargar el listado en el Datatable*/
function listarMedicamentos() {
  tabla = $('#tablalistadomedicamento').dataTable({
    aProcessing: true, //actiavmos el procesamiento de datatables
    aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
    dom: 'Bfrtip', //definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
    ajax: {
      url: '../../controller/salud/medicamentoController.php?op=listar_tabla',
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
function listarAntibioticos() {
  tabla = $('#tablalistadoantibiotico').dataTable({
    aProcessing: true, //actiavmos el procesamiento de datatables
    aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
    dom: 'Bfrtip', //definimos los elementos del control de tabla
    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
    ajax: {
      url: '../../controller/salud/antibioticoController.php?op=listar_tabla',
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

  $('#form-agregar-antibiotico').hide();
  $('#form-agregar-medicamento').hide();
  listarMedicamentos();
  listarAntibioticos();
});


// Añadir datos a la db
$('#formulario-agregar-medicamento').on('submit', function (event) {
  event.preventDefault();
  $('#btnRegistrarm').prop('disabled', true);
  var formData = new FormData($('#formulario-agregar-medicamento')[0]);
  $.ajax({
    url: '../../controller/salud/medicamentoController.php?op=insertar',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      switch (datos) {
        case '1':
          $('#tablalistadomedicamento').DataTable().ajax.reload();
          toastr.success(
            'Antibiotico registrado'
          );
          $('#formulario-agregar-medicamento')[0].reset();
          
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
      $('#btnRegistarMedicamento').removeAttr('disabled');
    },
  });
});

// Añadir datos a la db
$('#formulario-agregar-antibiotico').on('submit', function (event) {
  event.preventDefault();
  $('#btnRegistrarAntibiotico').prop('disabled', true);
  var formData = new FormData($('#formulario-agregar-antibiotico')[0]);
  $.ajax({
    url: '../../controller/salud/antibioticoController.php?op=insertar',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      switch (datos) {
        case '1':
          toastr.success(
            'Antibiotico registrado'
          );
          $('#formulario-agregar-antibiotico')[0].reset();
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
  bootbox.confirm('¿Esta seguro de eliminar el medicamento?', function (result) {
    if (result) {
      $.post(
        '../../controller/salud/medicamentoController.php?op=eliminar',
        { idMedicamento: id },
        function (data, textStatus, xhr) {
          switch (data) {
            case '0':
              tabla.api().ajax.reload();
              toastr.success('Medicamento eliminado');
              
              break;

            case '1':
              toastr.error(
                'Error: El dato no se ha podido eliminar.'
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

/*Funcion para eliminar datos*/
function eliminarAntibiotico(id) {
  bootbox.confirm('¿Esta seguro de eliminar el antibiotico?', function (result) {
    if (result) {
      $.post(
        '../../controller/salud/antibioticoController.php?op=eliminar',
        { idAntibiotico: id },
        function (data, textStatus, xhr) {
          switch (data) {
            case '0':
              tabla.api().ajax.reload();
              toastr.success('Antibiotico eliminado');
              
              break;

            case '1':
              toastr.error(
                'Error: El dato no se ha podido eliminar.'
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


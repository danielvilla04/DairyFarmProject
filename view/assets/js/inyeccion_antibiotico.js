
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
                      $('#selectAnimalesAn').append('<option value="' + animal.id_animal + '">' + animal.numero_arete + '</option>');
                  });
                  $.each(data, function(index, animal) {
                    $('#selectAnimalesMe').append('<option value="' + animal.id_animal + '">' + animal.numero_arete + '</option>');
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

  // Función para obtener las antibioticos y llenar el select
  function obtenerAntibioticos() {
    $.ajax({ 
        url: '../../controller/salud/antibioticoController.php?op=obtener_antibioticos',
        type: "GET",
        data: { obtenerAntibioticos: true },
        dataType: "json",
        success: function(data) {
            if (data) {
                // Llenar el select con las Antibioticoes obtenidas
                $.each(data, function(index, Antibiotico) {
                    $('#selectAntibioticos').append('<option value="' + Antibiotico.id_antibiotico + '">' + Antibiotico.nombre_antibiotico + '.' + Antibiotico.id_antibiotico + '</option>');
                });
            } else {
                console.log("No se encontraron Antibioticos.");
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

// Función para obtener las antibioticos y llenar el select
function obtenerMedicamentos() {
  $.ajax({ 
      url: '../../controller/salud/medicamentoController.php?op=obtener_medicamentos',
      type: "GET",
      data: { obtenerMedicamentos: true },
      dataType: "json",
      success: function(data) {
          if (data) {
              // Llenar el select con las Antibioticoes obtenidas
              $.each(data, function(index, Medicamento) {
                  $('#selectMedicamentos').append('<option value="' + Medicamento.id_medicamento + '">' + Medicamento.nombre_medicamento + '</option>');
              });
          } else {
              console.log("No se encontraron Medicamentos.");
          }
      },
      error: function(xhr, status, error) {
          console.error(error);
      }
  });
}

  // Llamar a la función para obtener las vacas cuando el documento esté listo
  obtenerAnimales();
  obtenerAntibioticos();
  obtenerMedicamentos()

});



//funciones para el modal
$('#antibiotico').on('click', function(event) {
  $('#form-agregar-antibiotico').show();
  $('#form-agregar-medicamento').hide();
});
$('#medicamento').on('click', function(event) {
  $('#form-agregar-medicamento').show();
  $('#form-agregar-antibiotico').hide();
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
  function listarInyeccionAntibioticos() {
    tabla = $('#tablalistadoantibiotico').dataTable({
      aProcessing: true, //actiavmos el procesamiento de datatables
      aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
      dom: 'Bfrtip', //definimos los elementos del control de tabla
      buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
      ajax: {
        url: '../../controller/salud/inyeccionAnController.php?op=listar_tabla',
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

  function listarInyeccionMedicamentos() {
    tabla = $('#tablalistadomedicamento').dataTable({
      aProcessing: true, //actiavmos el procesamiento de datatables
      aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
      dom: 'Bfrtip', //definimos los elementos del control de tabla
      buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
      ajax: {
        url: '../../controller/salud/inyeccionMeController.php?op=listar_tabla',
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

    listarInyeccionAntibioticos()
    listarInyeccionMedicamentos()
  });


  // Añadir datos a la db
  $('#formulario-agregar-antibiotico').on('submit', function (event) {
    event.preventDefault();
    $('#btnRegistrarAntibiotico').prop('disabled', true);
    console.log('aqui llega')
    var formData = new FormData($('#formulario-agregar-antibiotico')[0]);
    $.ajax({
      url: '../../controller/salud/inyeccionAnController.php?op=insert',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (datos) {
        switch (datos) {
          case '1':
            $('#tablalistadoantibiotico').DataTable().ajax.reload();
            toastr.success(
              'Registro Exitoso'
            );
            $('#formulario-agregar-antibiotico')[0].reset();
            
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
        $('#btnRegistrarAntibiotico').removeAttr('disabled');
      },
    });
  });

  $('#formulario-agregar-medicamento').on('submit', function (event) {
    event.preventDefault();
    $('#btnRegistrarMedicamento').prop('disabled', true);
    console.log('aqui llega')
    var formData = new FormData($('#formulario-agregar-medicamento')[0]);
    $.ajax({
      url: '../../controller/salud/inyeccionMeController.php?op=insert',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (datos) {
        switch (datos) {
          case '1':
            toastr.success(
              'Registro Exitoso');
            $('#formulario-agregar-medicamento')[0].reset();
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
        $('#btnRegistrarAntibiotico').removeAttr('disabled');
      },
    });
  });

 

 
  /*Funcion para eliminar datos*/
  function eliminarAn(id) {
    bootbox.confirm('¿Esta seguro de eliminar la Antibiotico?', function (result) {
      if (result) {
        $.post(
          '../../controller/salud/inyeccionAnController.php?op=eliminar',
          { idRegistro: id },
          function (data, textStatus, xhr) {
            switch (data) {
              case '0':
                toastr.success('Registro eliminado');
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

   /*Funcion para eliminar datos*/
   function eliminarMe(id) {
    bootbox.confirm('¿Esta seguro de eliminar el medicamento?', function (result) {
      if (result) {
        $.post(
          '../../controller/salud/inyeccionMeController.php?op=eliminar',
          { idRegistro: id },
          function (data, textStatus, xhr) {
            switch (data) {
              case '0':
                toastr.success('Registro eliminado');
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




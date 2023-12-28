

/*Funcion para cargar el listado en el Datatable*/
function listarAnimales() {
    tabla = $('#tablalistado').dataTable({
      aProcessing: true, //actiavmos el procesamiento de datatables
      aServerSide: true, //paginacion y filtrado del lado del serevr ../controller/animalController.php?op=listar_tabla'
      dom: 'Bfrtip', //definimos los elementos del control de tabla
      buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdf'],
      ajax: {
        url: '../../controller/animales/animalController.php?op=listar_tabla',
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
    listarAnimales();
});

//funcion para insertar animales
$('#formulario-agregar').on('submit', function (event) {
  event.preventDefault();
  $('#btnRegistrar').prop('disabled', true); // Asegúrate de que el ID del botón sea correcto

  // Crear FormData y agregar datos del formulario
  var formData = new FormData(this);
  
  $.ajax({
    url: '../../controller/animales/animalController.php?op=insert',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      switch (datos) {
        case '1':
          toastr.success('Registro Exitoso');
          $('#formulario-agregar')[0].reset();
          tabla.api().ajax.reload();
          break;
        case '2':
          toastr.error('Error al guardar la información, este registro ya existe en la base de datos');
          break;
        case '3':
          toastr.error('Hubo un error al tratar de ingresar los datos.');
          break;
        default:
          toastr.error(datos);
          break;
      }
      $('#btnRegistrar').removeAttr('disabled');
    },
  });
});
  // Llamar a la función para obtener las vacas cuando el documento esté listo
//obtenerAnimales();
//obtener();


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

 


  // Funcion principal

  $(function () {
    $('#form-modificar').hide();
    listarAnimales();
  });


  // Añadir datos a la db
  $('#formulario-agregar').on('submit', function (event) {
    event.preventDefault();
    $('#btnRegistrar').prop('disabled', true);
    var formData = new FormData($('#formulario-agregar')[0]);
    $.ajax({
      url: '../../controller/animales/animalController.php?op=insert',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (datos) {
        switch (datos) {
          case '1':
            toastr.success(
              'Registro Exitoso'
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

  // funcion para boton modificar
  $('#tablalistado tbody').on(
    'click',
    'button[id="modificarDato"]',

    function () {
      var data = $('#tablalistado').DataTable().row($(this).parents('tr')).data();
      limpiarForms();
      $('#form-agregar').hide();
      $('#form-modificar').show();
      console.log(data)
      $('#xnombre').val(data[2]);
      $('#xnumero_arete').val(data[1]);
      $('#xraza').val(data[4]);
      $('#xfecha_nacimiento').val(data[3]);
      $('#xpeso').val(data[5]);
      $('#xcolores_caracteristicas').val(data[6]);
      $('#xobservaciones').val(data[7]);
      return false;
    }
  );

  /*Funcion para modificacion de datos de usuario*/
  $('#formulario-modificar').on('submit', function (event) {
    event.preventDefault();
    bootbox.confirm('¿Desea modificar los datos?', function (result) {
      if (result) {
        var formData = new FormData($('#formulario-modificar')[0]);
        $.ajax({
          url: '../../controller/animales/animalController.php?op=modificar',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (datos) {
            //alert(datos);
            switch (datos) {
              case '0':
                toastr.error('Error: No se pudieron actualizar los datos');
                break;
              case '1':
                toastr.success('Registro actualizado exitosamente');
                tabla.api().ajax.reload();
                limpiarForms();
                $('#form-modificar').hide();
                $('#form-agregar').show();
                break;
              case '2':
                toastr.error('Error: No hay datos pertenecientes.');
                break;
            }
          },
        });
      }
    });
  });

  /*Funcion para eliminar datos*/
  function eliminar(id) {
    bootbox.confirm('¿Esta seguro de eliminar el animal?', function (result) {
      if (result) {
        $.post(
          '../../controller/animales/animalController.php?op=eliminar',
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
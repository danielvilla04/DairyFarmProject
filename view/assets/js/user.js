$('#formulario-registro').on('submit', function (event) {
  event.preventDefault();
  $('#btnRegistar').prop('disabled', true);

  var formData = new FormData($('#formulario-registro')[0]);
  $.ajax({
    url: './controller/user/userController.php?op=insert',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      switch (datos) {
        case '1':

          bootbox.alert(
            'Registro exitoso');
          setTimeout(function () {
            window.location.href = 'login.php'
          }, 2000);
          break;

        case '2':
          toastr.error(
            'Error al guardar la información, este usuario ya existe en la base de datos'
          );
          break;

        case '3':
          toastr.error('Hubo un error al tratar de ingresar los datos.');
          break;
        case '4':
          toastr.error('Debe de aceptar los términos y condiciones.');
          break;
        case '5':
          toastr.error('Las contraseñas no coinciden.');
          $('#btnRegistar').removeAttr('disabled');
          break;



        default:
          console.error(datos);
          break;
      }
      $('#btnRegistar').removeAttr('disabled');
    },
  });
});


//funcion para limpiar forms
function limpiarForms() {
  $('#formulario-login').trigger('reset');
}


$('#formulario-login').on('submit', function (event) {
  event.preventDefault();
  
  var formData = new FormData($('#formulario-login')[0]);
  
  $.ajax({
    type: 'POST',
    url: './controller/login/login.php', 
    data: formData,
    contentType: false,
    processData: false, 
    success: function (datos) {
      if (datos == 1) {
        window.location.href = 'index.php';
      } else {
        console.log(datos)
        toastr.error('El correo electrónico o la contraseña son incorrectos.' );
        limpiarForms()

      }
    }
    

  });
});


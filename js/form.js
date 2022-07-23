$(document).ready(function(){
    $("#botonFormulario").click(function(){
        var miNombre = document.getElementById('FormularioNombre').value;
        var miCorreo = document.getElementById('FormularioCorreo').value;
        var miTelefono = document.getElementById('FormularioTelefono').value;
        var miMensaje = document.getElementById('FormularioMensaje').value;
        var cajita2 = $('#checkbox').prop('checked');
        var cajita = $('#micheckbox').prop('checked');

        if ($('#checkbox').prop('checked') == false) {
            Swal.fire({
                type: 'error',
                text: 'Debes marcar la casilla de "Aceptar politica de privacidad".',
                confirmButtonColor: "#ff5757"
            });

        }else if ($('#checkbox').prop('checked') == false) {
            Swal.fire({
                type: 'error',
                text: 'Ha ocurrido un error inesperado.',
                confirmButtonColor: "#ff5757"
            });
        
        }else if (miNombre == "" || miNombre == null || miCorreo == "" || miCorreo == null || miMensaje == "" || miMensaje == null) {
            Swal.fire({
                type: 'error',
                text: 'Por favor, rellena correctamente los campos obligatorios.',
                confirmButtonColor: "#ff5757"
            });
        }else{
            $.get("https://thetreehousestudio.es/formulario_de_contacto.php", {  
                nombre: miNombre,
                correo: miCorreo,
                telefono: miTelefono,
                mensaje: miMensaje,
                caja: cajita
            }, function(data, status){
                console.log(data);
                if (data == '-1') {
                    Swal.fire({
                        type: 'error',
                        text: 'Ha ocurrido un error, inténtalo de nuevo más tarde.',
                        confirmButtonColor: "#ff5757"
                    }).then((result) => {
                        if (result.value) {
                            window.location = "index.html";
                        }
                    });
                    document.getElementById('formulario_contacto').reset();
                }else if (data == '-2') {
                    Swal.fire({
                        type: 'error',
                        text: 'Esa dirección de correo no es válida.',
                        confirmButtonColor: "#ff5757"
                    }); 
                }else {
                    Swal.fire({
                        type: 'success',
                        title: '¡Mensaje recibido!',
                        text: 'En breve me pondré en contacto contigo.',
                        confirmButtonColor: "#ff5757"
                    }); 
                    document.getElementById('formulario_contacto').reset();
                }
                
            });
        } 
    });
});
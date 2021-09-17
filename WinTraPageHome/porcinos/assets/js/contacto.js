$(document).ready(function(){
	
	$("#btnSendMail").off("click").on("click",function(ev){
        
        ev.preventDefault();
        blockUISystem();
        var first_name = $('#form-first-name').val();
        var last_name = $('#form-last-name').val();
        var email = $('#form-email').val();
        var message = $('#form-about-yourself').val();
        var valid = true;
        $(".error").remove();
     
        if (first_name.length < 1) {
          $('#form-first-name').after('<span class="error">Campo requerido</span>');
          valid = false;
        }
        if (last_name.length < 1) {
          $('#form-last-name').after('<span class="error">Campo requerido</span>');
          valid = false;
        }
        if (email.length < 1) {
          $('#form-email').after('<span class="error">Campo requerido</span>');
          valid = false;
        } else {
          var validEmail = email.match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/);
          if (!validEmail) {
            $('#form-email').after('<span class="error">Ingrese una cuenta de correo valido</span>');
            valid = false;
          }
        } 
        if (message.length < 1) {
            $('#form-about-yourself').after('<span class="error">Campo requerido</span>');
            valid = false;
        }      
        
        if(valid){
            
            $('#contactUser').off("submit").one("submit", function(e){
                //var datosFormEmp = new FormData(this);
                var datosFormEmp = $('#contactUser').serialize();
                $.ajax( {
                    type:"post",
                    data: datosFormEmp,
                    url: "contact-form/contacto.php", 
                    cache:false
                }).done(function(doneNew){
                    unblockUISystem();
                    if(doneNew == 1){
                        $("#divForm").notify("Correo enviado correctamente, pronto nos contactaremos con usted", "success", { position:"right", elementPosition: 'top right', globalPosition: 'top right' });
                    }else{
                        $("#divForm").notify("Error al enviar correo", "error", { position:"right", elementPosition: 'top right', globalPosition: 'top right' });
                    }
                }).fail(function( jqXHR, textStatus, errorThrown ) {
                    unblockUISystem();
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    swal({ title: "Mensaje!", text: msg, type: "error", html: true});      
                });
                e.preventDefault();
            });
            $("#contactUser").trigger("submit");
        }else{
            $("#divForm").notify("Verifique Informacion", "error", { position:"right", elementPosition: 'top right', globalPosition: 'top right' });
        }
        unblockUISystem();
    });
	
});

function blockUISystem(){
    $.blockUI({
        baseZ: 999990, 
        message: '<span><i class="icon-spinner4 spinner position-left"></i>&nbsp; Por favor Espere...</span>',
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            color: '#900',
            padding: 0,
            backgroundColor: 'transparent',
            zIndex:999990
        }
    });    
}

function unblockUISystem(){
    $.unblockUI();
}
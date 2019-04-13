$(document).ready(function () {

});

function validacionMaestraLogin(padre) {
    temp = true;
    var name = "";
    if (!$(padre).length) {
        padre = "";
    }
    
    $(padre + ' .noVacio').each(function () {
    	
        if ($(this).val().match(/./)) {//existencia cualquier caracter
            temp = true;
        } else {
        	
            if ($(this).attr("placeholder") !== "" && $(this).attr("placeholder") !== undefined) {
                name = $(this).attr("placeholder");
            } else {
                name = $(this).attr("id");
            }
            swal({ title: "Cancelado!", text: 'Faltan campos por llenar <span style="color:#FF3333">'+name+'<span>',  type: "error", html: true });
            $(this).focus();
            temp = false;
            return false;
        }
        
    });
    
    return temp;
}

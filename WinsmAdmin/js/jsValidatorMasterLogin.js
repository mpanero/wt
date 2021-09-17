var originalFormData;
$(document).ready(function () {
    originalFormData = $('form#formLogin').serialize();
});

function validacionMaestraLogin(padre) {
    temp = true;
    var name = "";
    if (!$(padre).length) {
        padre = "";
    }
    
    if(originalFormData === $('form#formLogin').serialize()) {
        //it's dirty!
        swal({ title: "Mensaje!", text: 'Por favor complete <span style="color:#FF3333"> nombre de usuario y contraseña</span>',  type: "info", html: true });
        $(this).focus();
        temp = false;
        return false;        
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
            swal({ title: "Cancelado!", text: 'Faltan campos por llenar <span style="color:#FF3333">'+name+'</span>',  type: "error", html: true });
            $(this).focus();
            temp = false;
            return false;
        }
        
    });
    
    $(padre + ' .cuit').each(function () {
    	
        if (esCUITValida($(this).val())) {//cuit argentino valido
            temp = true;
        } else {
        	
            if ($(this).attr("placeholder") !== "" && $(this).attr("placeholder") !== undefined) {
                name = $(this).attr("placeholder");
            } else {
                name = $(this).attr("id");
            }
            swal({ title: "Cancelado!", text: 'Valor NO valido para campo <span style="color:#FF3333">'+name+'</span>',  type: "error", html: true });
            $(this).focus();
            temp = false;
            return false;
        }
        
    });

    if (!temp) {
        return false;
    }

    $(padre + ' .only-alfa').each(function () { // solo letras
        if ($(this).val().match(/^[a-zA-Z_áéíóúñ\.\-\s]*$/)) {
            temp = true;
        } else {

            if ($(this).attr("placeholder") !== "" && $(this).attr("placeholder") !== undefined) {
                name = $(this).attr("placeholder");
            } else {
                name = $(this).attr("id");
            }

            swal("Cancelado", 'Solo Letras <span style="color:#FF3333">'+name+'<span>', "error");
            $(this).focus();
            temp = false;
            return false;

        }
    });

    if (!temp) {
        return false;
    }

    $(padre + ' .only-number').each(function () {
        
        if ($(this).val().match(/^[0-9]+$/)) {
            temp = true;
        } else {
            
            if ($(this).attr("placeholder") !== "" && $(this).attr("placeholder") !== undefined) {
                name = $(this).attr("placeholder");
            } else {
                name = $(this).attr("id");
            }
            swal({ title: "Cancelado!", text: 'Faltan campos por llenar <span style="color:#FF3333">'+name+'</span>',  type: "error", html: true });
            $(this).focus();
            temp = false;
            return false;
        }
        
    });
    
    if (!temp) {
        return false;
    }

    $(padre + ' .number').each(function () {
        
        if($(this).val() != ""){
            if ($(this).val().match(/^[0-9]+$/)) {
                temp = true;
            } else {
                
                if ($(this).attr("placeholder") !== "" && $(this).attr("placeholder") !== undefined) {
                    name = $(this).attr("placeholder");
                } else {
                    name = $(this).attr("id");
                }
                swal({ title: "Cancelado!", text: 'Faltan campos por llenar <span style="color:#FF3333">'+name+'</span>',  type: "error", html: true });
                $(this).focus();
                temp = false;
                return false;
            }
        }else{
            temp = true;
        }

        
    });
    
    if (!temp) {
        return false;
    }

    $(padre + ' .range').each(function () {
        
        if($(this).val().toString().match(/^[0-9]+$/)){
            var min = isBlank($(this).attr("ngMin")) ? 0 : $(this).attr("ngMin");
            var max = isBlank($(this).attr("ngMax")) ? Infinity : $(this).attr("ngMax");
            
            if ($(this).attr("placeholder") !== "" && $(this).attr("placeholder") !== undefined) {
                name = $(this).attr("placeholder");
            } else {
                name = $(this).attr("id");
            }

            if (isBlank($(this).val())) {
                temp = false;
                return false;
            }

            if (!isBlank($(this).val()) && parseInt($(this).val()) <= parseInt(max) && parseInt($(this).val()) >= parseInt(min) ) {
                $(this).attr("style","border-bottom: solid 1px #388E3C;"); 
                temp = true;
                return true;
            }else{
                swal({ title: "Cancelado!", text: 'Valor Fuera de Rango <span style="color:#FF3333">'+name+'</span>',  type: "error", html: true });
                $(this)[0].focus();
                $(this).attr("style","border-bottom: solid 1px #f00;"); 
                temp = false;
                return false;
            }
        }else{
            $(this).attr("style","border-bottom: solid 1px #f00;"); 
            swal({ title: "Cancelado!", text: 'Faltan campos por llenar <span style="color:#FF3333">'+name+'</span>',  type: "error", html: true });
            $(this)[0].focus();   
            temp = false;         
            return false;
        }      
    });
    
    if (!temp) {
        return false;
    }

    $(padre + ' input:radio.radioCheked').each(function () {
        var element = $(this).attr("name");
        
        if($("input:radio[name="+element+"]").is(":checked")){
            temp = true;
        } else {
            
            if ($(this).attr("placeholder") !== "" && $(this).attr("placeholder") !== undefined) {
                name = $(this).attr("placeholder");
            } else {
                name = $(this).attr("id");
            }
            swal({ title: "Cancelado!", text: 'Faltan campos por seleccionar <span style="color:#FF3333">&nbsp;</span>',  type: "error", html: true });
            $(this).focus();
            temp = false;
            return false;
        }   
    });

    if (!temp) {
        return false;
    }

    $(padre + ' select').each(function () { // select selected

        if ($(this).hasClass("selected")) {
            var elemento = $(this).attr("id");
            var datas;
            var texts;

            if (elemento.indexOf("_") != -1) {
                datas = elemento.split("id");
                texts = datas[1];
            } else {
                texts = elemento;
            }
            
            if ($("#" + elemento + " option:selected").val() != 0 && $("#" + elemento + " option:selected").val() != "" && $("#" + elemento + " option:selected").val() != undefined) {
                temp = true;
            } else {
                if ($(this).attr("placeholder") !== "" && $(this).attr("placeholder") !== undefined) {
                    name = $(this).attr("placeholder");
                } else {
                    name = $(this).attr("id");
                }
                swal({ title: "Cancelado!", text: 'Faltan campos por seleccionar <span style="color:#FF3333">'+name+'</span>',  type: "error", html: true });
                $(this).focus();
                temp = false;
                return false;

            }
        }

    });

    if (!temp) {
        return false;
    }  

    $(padre + ' .onlyEmail').each(function () {
        
        if($(this).val() != ""){
            if ($(this).val().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)) {
                temp = true;
            } else {
                
                if ($(this).attr("placeholder") !== "" && $(this).attr("placeholder") !== undefined) {
                    name = $(this).attr("placeholder");
                } else {
                    name = $(this).attr("id");
                }
                swal({ title: "Cancelado!", text: 'Faltan campos por llenar <span style="color:#FF3333">'+name+'</span>',  type: "error", html: true });
                $(this).focus();
                temp = false;
                return false;
            }
        }else{
            temp = true;
        }

        
    });  

    return temp;
}

function esCUITValida(inputValor) {
    inputString = inputValor.toString();
    if (inputString.length == 11) {
        var Caracters_1_2 = inputString.charAt(0) + inputString.charAt(1)
        if (Caracters_1_2 == "20" || Caracters_1_2 == "23" || Caracters_1_2 == "24" || Caracters_1_2 == "27" || Caracters_1_2 == "30" || Caracters_1_2 == "33" || Caracters_1_2 == "34") {
            var Count = inputString.charAt(0) * 5 + inputString.charAt(1) * 4 + inputString.charAt(2) * 3 + inputString.charAt(3) * 2 + inputString.charAt(4) * 7 + inputString.charAt(5) * 6 + inputString.charAt(6) * 5 + inputString.charAt(7) * 4 + inputString.charAt(8) * 3 + inputString.charAt(9) * 2 + inputString.charAt(10) * 1
            Division = Count / 11;
            if (Division == Math.floor(Division)) {
                return true
            }
        }
    }
    return false
}

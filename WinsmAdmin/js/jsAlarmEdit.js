var counterBlockEditReq = 0;
var tAlarm = null;
$(document).ready(function(){    
    
    $("#pagActual").html("Actualizar Alarma");

    getTproduc();
    getProduct();
    getToperac();
    getLugares();
    getPositio();
    getMonedas();
    getOperaci();
});   

function deleteAlarm(){
    blockUISystem();
    var datosSend = "";
    $.each(linksWs["tAlarm"], function(nombre,data) { 
        //console.log(nombre+"(d:n)"+data);
        if(String(nombre).indexOf("t_") == -1){
            datosSend +="&"+String(nombre)+"="+data;
        }
    });           
    
    $.ajax( {
        method: 'post',
        dataType:"json",
        url: root+"/TAlarms/deleteAlarm.json?"+datosSend, 
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false,
        processData: false,
        contentType: false
    }).done(function(doneNew){
        unblockUISystem();
        if (evalResponseAjax(doneNew)) {
            //linksWs.alarms.destroy(index);
            linksWs["tAlarms"].data.splice(idAlm[1], 1);
            //alert("Requests: "+linksWs.requests.length );
            linksWs["tAlarms"].rows -= 1; 
            if(linksWs["tAlarms"].rows < 1){
                linksWs["tAlarms"] = null;
                swal({
                    title: "Mensaje!",
                    text: 'No posee Alarmas <span style="color:#4CAF50">"activas"<span>',
                    type: "success",
                    confirmButtonColor: "#66BB6A",
                    confirmButtonText: "Ok!",
                    html:true
                },
                function(isConfirm){
                    if (isConfirm) {
                    }
                });                
                         
            }else{
                swal({
                    title: "Mensaje!",
                    text: 'Alarma Borrada con <span style="color:#4CAF50">"éxito"<span>',
                    type: "success",
                    confirmButtonColor: "#66BB6A",
                    confirmButtonText: "Ok!",
                    html:true
                },
                function(isConfirm){
                    if (isConfirm) {
                        $(".modalViewAlarm").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeOutRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                            $('body').attr("style","padding-right: 0px;");
                            $(this).removeClass("animated " + "fadeOutRight");
                            $(this).modal('hide');
                            eachListAlarm();
                        });
                        $('body').attr("style","padding-right: 0px;");
                    }
                });                
            }            

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
 
}

function updAlarm(estatusTrade,sms){     
    blockUISystem();    
    var datosSend = "";
    var active = $("#ACTIVE").val();
    var auto = $("#AUTO1").prop('checked') ? 1:0;
    datosSend = $('#formEditAlarm').serialize()+"&ACTIVE="+active+"&AUT_GENERATION="+auto;
    //datosSend = $('#formEditAlarm').serialize();
    $.ajax( {
        method: 'post',
        dataType:"json",
        url: root+"/TAlarms/editAlarm.json?"+datosSend, 
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false,
        processData: false,
        contentType: false
    }).done(function(doneNew){
       
        if (evalResponseAjax(doneNew)) {
            linksWs["tAlarms"].data[idAlm[1]] = doneNew.tAlarm[0];
            setTimeout(function(){
            
                unblockUISystem();
                swal({
                    title: "Mensaje!",
                    text: 'Alarma Actualizada con <span style="color:#4CAF50">"éxito"<span>',
                    type: "success",
                    confirmButtonColor: "#66BB6A",
                    confirmButtonText: "Ok!",
                    html:true
                },
                function(isConfirm){
                    if (isConfirm) {
                        $(".modalViewAlarm").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeOutRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                            $('body').attr("style","padding-right: 0px;");
                            $(this).removeClass("animated " + "fadeOutRight");
                            $(this).modal('hide');
                            eachListAlarm();
                        });
                        $('body').attr("style","padding-right: 0px;");
                    }
                });             
            
            }, 1700);

        }else{
            unblockUISystem();
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
 
}

function checkedElementView(){
    initStyleRadio();  
    initStyleCheckBox(); 
    $('#ACTIVE').on('click', function(){
        //this.checked = this.value == 1 ? true : false;
        this.value = this.checked ? 1 : 0;
        
        // alert(this.value);
    }); 
    
    var tPrice = $("#ID_TYPE_PRICE option:selected").val();
    //var auto = $("#AUT_GENERATION checked:selected").val();
    if(tPrice == 300){
        $("#divPosi").prop("style","display:block;");
        $("#divPrice").prop("style","display:none;");
    }else{
        $("#divPosi").prop("style","display:none;");
        $("#divPrice").prop("style","display:block;");            
    }

    $("#ID_TYPE_PRICE").off("change").on("change",function(e){
        tPrice = $(this).val();
        if(tPrice == 300){
            $("#divPosi").prop("style","display:block;");
            $("#divPrice").prop("style","display:none;");
        }else{
            $("#divPosi").prop("style","display:none;");
            $("#divPrice").prop("style","display:block;");            
        }
    });    
    
}

function loadEventsEditAlm(){
    
    /*** add new ***/
    $(".btnRenew").off("click").on("click",function(events){
        blockUISystem();
        $("#ID_USER_OWNER").val(localStorage.getItem('user'));
        if(validacionMaestra("#renewAlarm")){
            $('#renewAlarm').off("submit").one("submit", function(e){
                //var datosFormEmp = new FormData(this);
                var datosFormEmp = $('#renewAlarm').serialize();
                $.ajax( {
                    method: 'post',
                    dataType:"json",
                    url: root+"/TAlarms/editAlarm.json?"+datosFormEmp, 
                    headers: {
                        'Authorization':"Bearer "+localStorage.getItem('accessToken')
                    },                
                    cache:false,
                    processData: false,
                    contentType: false
                }).done(function(doneNew){
                    unblockUISystem();
                    if (evalResponseAjax(doneNew)) {
                        swal({
                            title: "Mensaje!",
                            text: 'Alarma Actualizada <span style="color:#4CAF50">Correctamente<span>',
                            type: "success",
                            confirmButtonColor: "#66BB6A",
                            confirmButtonText: "Ok!",
                            html:true
                        },
                        function(isConfirm){
                            if (isConfirm) {
                                linksWs["tAlarms"].data[idReq[1]] = doneNew.tAlarm;
                                /****************************** Cerrar Modal Edit   *************************/
                                $(".modalEditAlarm").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "zoomOut").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                                    $('body').attr("style","padding-right: 0px;");
                                    $(this).modal('hide');
                                    $(this).removeClass("animated " + "zoomOut");
                                });
                                $('body').attr("style","padding-right: 0px;");
                                //listRequests();
                            }
                        });
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
            $("#renewAlarm").trigger("submit");
        }else{
            unblockUISystem();
        }
    });
    
    /************************************* Edit Alarm **********************************************/
    $("#btnEditAlarm").off('click').on("click",function(events){
        updAlarm();
        events.preventDefault();
    }); 

    /************************************* Edit Alarm **********************************************/
     $("#btnDeleteAlarm").off('click').on("click",function(events){
        deleteAlarm();
        events.preventDefault();
    }); 

    checkedElementView()
    
}

function showAlarm(){
    if(linksWs["tAlarm"] != null){
        $.each(linksWs["tAlarm"], function (atributo, value) { 
            //alert(atributo+":"+value);

            if (value !== null && value != "") {
                if ($("input[name*='"+atributo+"']").length || $("#" + atributo + "").length) {

                    if ($("#" + atributo + "").is("select")) {

                        $('#' + atributo + ' option[value="' + value + '"]').prop('selected', true);

                    }else{
                        if($("#" + atributo + "").is("span")) {
                            $("#" + atributo + "").html(value);
                        }else{

                            if($("input[name*='"+atributo+"']").attr('type') == "radio"){
                                $("input[name*='"+atributo+"'][value='"+value+"']").prop('checked',true).trigger("change");
                                $("input[name*='"+atributo+"'][value='"+value+"']").prop('checked',"checked").trigger("change");
                            }else{
                                if($("input[name*='"+atributo+"']").attr('type') == "checkbox"){
                                    $("input[name*='"+atributo+"']").val(value);
                                    value == 1 ? $("input[name*='"+atributo+"']").trigger('click') : null;
                                    //$("input[name*='"+atributo+"']").change();  
                                }else{
                                    if (typeof (response) === 'string') {
                                        if(value.match(/^\d{2}-\d{2}-\d{4} ([0-1]\d|2[0-3]):([0-5]\d):([0-5]\d)$/)) {
                                            dateF = value.split(" ");
                                            $("#" + atributo + "").val(dateF[0]);
                                        }else{
                                            if(value.match(/^\d{4}-\d{2}-\d{2}$/)) {
                                                $("#" + atributo + "").val(value);
                                            }else{
                                                $("#" + atributo + "").val(value);
                                            }
                                        }
                                    }else{
                                        $("#" + atributo + "").val(value);
                                    }
                                }
                            }
                        }
                    }
                }
            }            
        }); 
              
        applyMask();    
        loadEventsEditAlm();
    }else{
        swal({ title: "Mensaje!", text: 'Recargue la pagina', type: "error", html: true});
    }

    
}

function validateLoadComplete() {
    counterBlockEditReq++;
    if (counterBlockEditReq === 7) {
        counterBlockEditReq = 0;
        //applyMask();
        setTimeout(function () {
            showAlarm();
        }, 1700);
        
    }

}

function getOperaci(){
    
    findOperaci("", function(operaciones){
        var optRep = '<label class="display-block text-semibold">Que operación desea realizar?</label>';
        
        if(operaciones.length > 0){
            $.each(operaciones, function (index, operacion) {                
                optRep += ''+
                '<label class="radio-inline">'+
                    '<input type="radio" id="opera_'+operacion.ID_TYPE+'" value="'+operacion.ID_TYPE+'" name="ID_TP_OPERATION" class="styled radioBtn" >'+
                    operacion.INFO+
                '</label>';
            });
        
        }
        $("#divOperacion").html(optRep);         
        validateLoadComplete();
    });

}

function getMonedas(){
    findMonedas("", function(monedas){
        var optRep = '<option value="">Seleccione</option>';
            
        if(monedas.length > 0){
            $.each(monedas, function (index, moneda) {
                optRep += '<option value="'+moneda.ID_CURRENCY+'" >'+moneda.CURRENCY_NAME+'</option>';
            });
          
        }
        $("#ID_CURRENCY").html(optRep);
        
        // Select2 selects
        $('#ID_CURRENCY').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });          
        validateLoadComplete();
    });

}

function getPositio(){
    findPosition("", function(positions){
        var optRep = '<option value="">Seleccione</option>';
            
        if(positions.length > 0){
            $.each(positions, function (index, position) {
                optRep += '<option value="'+position.ID_POSITION+'" >'+position.POSITION+'</option>';
            });
          
        }
        $("#ID_POSITION").html(optRep);
        
        // Select2 selects
        $('#ID_POSITION').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });          
        validateLoadComplete();
    });

}

function getLugares(){
    findPricePlace("", function(places){
        var optRep = '<option value="">Seleccione</option>';
            
        if(places.length > 0){
            $.each(places, function (index, place) {
                optRep += '<option value="'+place.t_places_price.ID_PLACE_PRICE+'" >'+place.t_places_price.PLACE_NAME+'</option>';
            });
          
        }
        $("#ID_PLACE_PRICE").html(optRep);
        
        // Select2 selects
        $('#ID_PLACE_PRICE').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });  

        validateLoadComplete();
    });

}

function getToperac(){
    blockUISystem();
    findTOperaci("", function(toperaciones){
        var optRep = '<option value="">Seleccione</option>';
            
        if(toperaciones.length > 0){
            $.each(toperaciones, function (index, toperacion) {
                if(linksWs["tAlarm"].ID_TYPE_PRICE == toperacion.ID_TYPE){
                    optRep += '<option value="'+toperacion.ID_TYPE+'" selected>'+toperacion.INFO+'</option>';
                }else{
                    optRep += '<option value="'+toperacion.ID_TYPE+'" >'+toperacion.INFO+'</option>';
                }
                
            });
          
        }
        $("#ID_TYPE_PRICE").html(optRep);
        
        // Select2 selects
        $('#ID_TYPE_PRICE').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });          
        validateLoadComplete();
    });
    
}

function getProduct(){
    blockUISystem();
    findProdPrice("", function(productos){
        var optRep = '<option value="">Seleccione</option>';
            
        if(productos.length > 0){
            $.each(productos, function (index, producto) {
               optRep += '<option value="'+producto.ID_PRODUCT_PRICE+'" >'+producto.PRODUCT_NAME+'</option>';
            });
          
        }
        $("#ID_PRODUCT").html(optRep);
        
        // Select2 selects
        $('#ID_PRODUCT').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });          
        validateLoadComplete();
    });
    
}

function getTproduc(){
    findTipoProducto("", function(tProductos){
        var optRep = '<option value="">Seleccione</option>';
            
        if(tProductos.length > 0){
            $.each(tProductos, function (index, tproducto) {
                optRep += '<option value="'+tproducto.ID_CATEGORY_PROD+'" >'+tproducto.CATEGORY_PROD_NAME+'</option>';
            });
          
        }
        $("#tipoProducto").html(optRep);
        
        // Select2 selects
        $('#tipoProducto').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });          
        validateLoadComplete();
    });
}
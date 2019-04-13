var counterBlock = 0;
$(document).ready(function(){    
    $("#pagActual").html("Filtros de Busqueda");
    $("#tipoProducto").off("change").on("change",function(e){
        var tp = $(this).val();
        var mk = $("#ID_MARKET").val();;
        //alert(tp);
        if(!isBlank(mk) && !isBlank(tp)){
            getProduct(mk,tp);
        }
        
    }); 

    getTproduc();
    getOperaci();
    getMonedas();
    getUnidads();
    getLugares();
    
});   


function validateForm(){

    /*** add new ***/
    $(".btnFilterMarket").off("click").on("click",function(events){
        blockUISystem();
        var filterAll = false;
        $("#ID_USER_OWNER").val(localStorage.getItem('user'));
        if($("#PRICE_FROM").val() != "" && $("#PRICE_TO").val() != ""){            
            if($("#ID_TP_CURRENCY option:selected").val() != "" ){
                filterAll = true;               
            }else{
                filterAll = false;
                swal({ title: "Mensaje!", text: 'Debe Seleccionar campo <span style="color:#00ACC1">Moneda<span>', type: "warning", html: true});
            }
        }else{
            if($("#PRICE_FROM").val() != ""){
                $("#PRICE_TO").val($("#PRICE_FROM").val());
                if($("#ID_TP_CURRENCY option:selected").val() != "" ){
                    filterAll = true;               
                }else{
                    filterAll = false;
                    swal({ title: "Mensaje!", text: 'Debe Seleccionar campo <span style="color:#00ACC1">Moneda<span>', type: "warning", html: true});
                }                
            }else{
                if($("#PRICE_TO").val() != ""){
                    $("#PRICE_FROM").val($("#PRICE_TO").val());
                    if($("#ID_TP_CURRENCY option:selected").val() != "" ){
                        filterAll = true;               
                    }else{
                        filterAll = false;
                        swal({ title: "Mensaje!", text: 'Debe Seleccionar campo <span style="color:#00ACC1">Moneda<span>', type: "warning", html: true});
                    }                    
                }else{
                    filterAll = true;
                }   
            }
        }

        if($("#QT_FROM").val() != "" && $("#QT_TO").val() != ""){            
            if($("#ID_UM option:selected").val() != "" ){
                filterAll = true;               
            }else{
                filterAll = false;
                swal({ title: "Mensaje!", text: 'Debe Seleccionar campo <span style="color:#00ACC1">UM<span>', type: "warning", html: true});
            }
        }else{
            if($("#QT_FROM").val() != ""){
                $("#QT_TO").val($("#QT_FROM").val());
                if($("#ID_UM option:selected").val() != "" ){
                    filterAll = true;               
                }else{
                    filterAll = false;
                    swal({ title: "Mensaje!", text: 'Debe Seleccionar campo <span style="color:#00ACC1">UM<span>', type: "warning", html: true});
                }                
            }else{
                if($("#QT_TO").val() != ""){
                    $("#QT_FROM").val($("#QT_TO").val());
                    if($("#ID_UM option:selected").val() != "" ){
                        filterAll = true;               
                    }else{
                        filterAll = false;
                        swal({ title: "Mensaje!", text: 'Debe Seleccionar campo <span style="color:#00ACC1">UM<span>', type: "warning", html: true});
                    }                    
                }else{
                    filterAll = true;
                }   
            }
        }

        if(filterAll){
            if(validacionMaestra("#filterMarket")){
                $('#filterMarket').off("submit").one("submit", function(e){
                    //var datosFormEmp = new FormData(this);
                    linksWs["formSubmit"] = $('#filterMarket').serialize();
                    $.ajax( {
                        method: 'post',
                        dataType:"json",
                        url: root+"/TRequest/filter.json?"+linksWs["formSubmit"], 
                        headers: {
                            'Authorization':"Bearer "+localStorage.getItem('accessToken')
                        },                
                        cache:false,
                        processData: false
                    }).done(function(doneFilter){
                        unblockUISystem();
                        if (evalResponseAjax(doneFilter)) {
                            if(typeof (doneFilter.tRequest) === 'string' ){
                                swal({ title: "Resultado de la búsqueda!", text: doneFilter.tRequest, type: "error", html: true});
                            }else{
                                if(doneFilter.tRequest.length > 0){
                                    linksWs["tRequests"] = $.parseJSON(JSON.stringify(doneFilter.tRequest));
                                    swal({
                                        title: "Resultado de la búsqueda!",
                                        text: 'Se encontraron <span style="color:#4CAF50">'+doneFilter.tRequest.length+' Coincidencias<span>',
                                        type: "success",
                                        confirmButtonColor: "#66BB6A",
                                        confirmButtonText: "Ok!",
                                        html:true
                                    },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            $("#divRootContent").load("../vista/marketList.html?x="+Math.random(), function () {});
                                        }
                                    });
                                }
        
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
                        swal({ title: "Resultado de la búsqueda!", text: msg, type: "error", html: true});      
                    });
                    e.preventDefault();
                });
                $("#filterMarket").trigger("submit");
            }else{
                unblockUISystem();
            }
        }else{
            unblockUISystem();
        }            
    });   
    
}

function validateLoadComplete() {
    counterBlock++;
    if (counterBlock === 5) {
        counterBlock = 0;
        applyMask();
    
        setTimeout(function () {
            unblockUISystem();
            initStyleRadio();  
            validateForm();
        }, 1700);
        
    }

}

function getLugares(){
    findPlaces("", function(places){
        var optRep = '<option value="">Seleccione</option>';
            
        if(places.length > 0){
            $.each(places, function (index, place) {
                optRep += '<option value="'+place.ID_PLACE+'" >'+place.PLACE_NAME+'</option>';
            });
          
        }
        $("#ID_PLACE_ORIGIN").html(optRep);
        
        // Select2 selects
        $('#ID_PLACE_ORIGIN').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });  
        
        $("#ID_PLACE_DELIVERY").html(optRep);
        
        // Select2 selects
        $('#ID_PLACE_DELIVERY').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });

        validateLoadComplete();
    });

}

function getUnidads(){
    findUnidad("", function(unidades){
        var optRep = '<option value="">Seleccione</option>';
            
        if(unidades.length > 0){
            $.each(unidades, function (index, unidad) {
                optRep += '<option value="'+unidad.ID_UM+'" >'+unidad.UM_NAME+'</option>';
            });
          
        }
        $("#ID_UM").html(optRep);
        
        // Select2 selects
        $('#ID_UM').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });          
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
        $("#ID_TP_CURRENCY").html(optRep);
        
        // Select2 selects
        $('#ID_TP_CURRENCY').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });          
        validateLoadComplete();
    });

}

function getOperaci(){
    
    findOperaci("", function(operaciones){
        var optRep = '<label class="display-block">Que operación desea realizar?</label>';
        
        if(operaciones.length > 0){
            $.each(operaciones, function (index, operacion) {                
                optRep += ''+
                '<label class="radio-inline">'+
                    '<input type="radio" id="opera_'+operacion.ID_TYPE+'" value="'+operacion.ID_TYPE+'" name="ID_TP_OPERATION" class="radioBtn radioCheked" >'+
                    operacion.INFO+
                '</label>';
            });
        
        }
        $("#divOperacion").html(optRep);         
        validateLoadComplete();
    });

}

function getProduct(mk,tp){
    blockUISystem();
    findProduct(mk,tp, function(productos){
        var optRep = '<option value="">Seleccione</option>';
            
        if(productos.length > 0){
            $.each(productos, function (index, producto) {
                optRep += '<option value="'+producto.ID_PRODUCT+'" >'+producto.PRODUCT_NAME+'</option>';
            });
          
        }
        $("#ID_PRODUCT").html(optRep);
        
        // Select2 selects
        $('#ID_PRODUCT').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });          
        unblockUISystem();
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
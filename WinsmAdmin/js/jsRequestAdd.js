var counterBlock = 0;
$(document).ready(function(){    
    $("#pagActual").html("Nueva Solicitud");
    $("#tipoProducto").off("change").on("change",function(e){
        var tProdSelected = $(this).val();
        checkedElementView(tProdSelected);
    });
    
    $("#ID_PRICE_REF").off("change").on("change",function(e){
        var precioRef = $(this).val();
        if(precioRef == 220){ /* Chicago */
            $("#divPos").prop("style","display:block;");
        }else{
            $("#divPos").prop("style","display:none;");
        }
        
    });

    $("#ID_TYPE_PRICE").off("change").on("change",function(e){
        var tipoPrice = $(this).val();
        if(tipoPrice == 210){ /* Fijo */
            $("#divfechFijD").prop("style","display:none;");
            $("#divfechFijH").prop("style","display:none;");
            $("#divPreRef").prop("style","display:none;");
            $("#divPos").prop("style","display:none;");

            $("#divPFr").prop("style","display:block;");
            $("#divPTo").prop("style","display:block;");
            
            
        }else{
            if(tipoPrice == 211){ /* A fijar */
                $("#divfechFijD").prop("style","display:block;");
                $("#divfechFijH").prop("style","display:block;");
                $("#divPreRef").prop("style","display:block;");
                /* $("#divPos").prop("style","display:block;"); */

                $("#divPFr").prop("style","display:none;");
                $("#divPTo").prop("style","display:none;");
            }
            
        }
        
    });    
    
    getTproduc();
    getCosecha();
    getTprices();
    getMonedas();
    getPriceRf();
    getPositio();
    getUnidads();
    getTipoPay();
    getLugares();
    getTEntreg();
    getCalidad();
    getOperaci();
});   

function checkedElementView(tProdSelected){
    if(tProdSelected != "" && tProdSelected != 0){
        $("#divProd").prop("style","display:block;");
        $("#divTPri").prop("style","display:block;");
        $("#divPFr").prop("style","display:block;");
        $("#divPTo").prop("style","display:block;");
        $("#divMone").prop("style","display:block;");
        $("#divUM").prop("style","display:block;");
        
        if(tProdSelected >= 1  && tProdSelected <= 3 ){
            $("#divCant").prop("style","display:block;");
            $("#divTpay").prop("style","display:block;");
            
        }else{
            $("#divCant").prop("style","display:none;");
            $("#divTpay").prop("style","display:none;");
        }

        if(tProdSelected == 1 ){
            if(tProdSelected != 210 ){
                $("#divPrePos").prop("style","display:block;");
                $("#divfech").prop("style","display:block;");
            }else{
                $("#divPrePos").prop("style","display:none;");
                $("#divfech").prop("style","display:none;");
            }

            $("#divCose").prop("style","display:block;");
            $("#divPreRef").prop("style","display:block;");
            $("#divPos").prop("style","display:block;");
            $("#divfechFijD").prop("style","display:block;");
            $("#divfechFijH").prop("style","display:block;");
            $("#divOrig").prop("style","display:block;");
            $("#divTEntrega").prop("style","display:block;");
            $("#divLEntrega").prop("style","display:block;");
            $("#divDT").prop("style","display:block;");
            $("#divQa").prop("style","display:block;");
            $("#divQaInf").prop("style","display:block;");
            
        }else{

            $("#divCose").prop("style","display:none;");
            $("#divPreRef").prop("style","display:none;");
            $("#divPos").prop("style","display:none;");
            $("#divfechFijD").prop("style","display:none;");
            $("#divfechFijH").prop("style","display:none;");
            $("#divOrig").prop("style","display:none;");
            $("#divTEntrega").prop("style","display:none;");
            $("#divLEntrega").prop("style","display:none;");
            $("#divDT").prop("style","display:none;");
            $("#divQa").prop("style","display:none;");
            $("#divQaInf").prop("style","display:none;");
        }
    }else{
        $("#divProd").prop("style","display:none;");
        $("#divTPri").prop("style","display:none;");
        $("#divPFr").prop("style","display:none;");
        $("#divPTo").prop("style","display:none;");
        $("#divMone").prop("style","display:none;");
    }
    blockUISystem();
    counterBlock = 11;
    getProduct(tProdSelected);
}

function validateForm(){

    /*** add new ***/
    $(".btnAddNew").off("click").on("click",function(events){
        blockUISystem();
        $("#ID_USER_OWNER").val(localStorage.getItem('user'));
        if(validacionMaestra("#newRequest")){
            $('#newRequest').off("submit").one("submit", function(e){
                //var datosFormEmp = new FormData(this);
                var datosFormEmp = $('#newRequest').serialize();
                $.ajax( {
                    method: 'post',
                    dataType:"json",
                    url: root+"/TRequest/newRequest.json?"+datosFormEmp, 
                    headers: {
                        'Authorization':"Bearer "+localStorage.getItem('accessToken')
                    },                
                    cache:false,
                    processData: false,
                    contentType: false
                }).done(function(doneNew){
                    unblockUISystem();
                    if (evalResponseAjax(doneNew)) {
                        if( typeof (doneNew.tRequest) === 'string'){
                            swal({
                                title: "Mensaje!",
                                text: 'Solicitud <span style="color:#FF3333">NO Registrada<span>',
                                type: "error",
                                confirmButtonColor: "#FF3333",
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
                                text: 'Solicitud Registrada <span style="color:#4CAF50">Correctamente<span>',
                                type: "success",
                                confirmButtonColor: "#66BB6A",
                                confirmButtonText: "Ok!",
                                html:true
                            },
                            function(isConfirm){
                                if (isConfirm) {
                                    $("#divRootContent").load("../vista/requestAdd.html?x="+Math.random(), function () {});
                                    //resetForm('#newRequest');
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
                e.preventDefault();
            });
            $("#newRequest").trigger("submit");
        }else{
            unblockUISystem();
        }
    });       
}

function validateLoadComplete() {
    counterBlock++;
    if (counterBlock === 12) {
        counterBlock = 0;
        applyMask();
    
        setTimeout(function () {
            unblockUISystem();
            validateForm();
        }, 1700);
        
    }

}

function getOperaci(){
    
    findOperaci("", function(operaciones){
        var optRep = '<label class="display-block">Que operación desea realizar?</label>';
        
        if(operaciones.length > 0){
            $.each(operaciones, function (index, operacion) {                
                optRep += ''+
                '<label class="radio-inline">'+
                    '<input type="radio" id="opera_'+operacion.ID_TYPE+'" value="'+operacion.ID_TYPE+'" name="ID_TP_OPERATION" class="styled radioCheked" >'+
                    operacion.INFO+
                '</label>';
            });
        
        }
        $("#divOperacion").html(optRep);         
        validateLoadComplete();
    });

}
    
function getCalidad(){
    
    findCalidad("", function(tcalidad){
        var optRep = '<option value="">Seleccione</option>';
            
        if(tcalidad.length > 0){
            $.each(tcalidad, function (index, calidad) {
                optRep += '<option value="'+calidad.ID_TYPE+'" >'+calidad.INFO+'</option>';
            });
            
        }
        $("#TYPE_QUALITY").html(optRep);
        
        // Select2 selects
        $('#TYPE_QUALITY').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });          
        validateLoadComplete();
    });

}
    
function getTEntreg(){
    findTEntrega("", function(tentrega){
        var optRep = '<label class="display-block">Tipo Entrega:</label>';
            
        if(tentrega.length > 0){
            $.each(tentrega, function (index, entrega) {                
                optRep += ''+
                '<label class="radio-inline">'+
                    '<input type="radio" id="deli_'+entrega.ID_TYPE+'" value="'+entrega.ID_TYPE+'" name="ID_TYPE_DELIVERY" class="styled" >'+
                    entrega.INFO+
                '</label>';
                //optRep += '<option value="'+entrega.ID_TYPE+'" >'+entrega.INFO+'</option>';
            });
          
        }
        $("#divTEntrega").html(optRep);
       
        validateLoadComplete();
    });

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

function getTipoPay(){

    findTPago("", function(paytypes){
        var optRep = '<option value="">Seleccione</option>';
            
        if(paytypes.length > 0){
            $.each(paytypes, function (index, paytype) {
                optRep += '<option value="'+paytype.ID_TYPE+'" >'+paytype.INFO+'</option>';
            });
          
        }
        $("#ID_TYPE_PAYMENT").html(optRep);
        
        // Select2 selects
        $('#ID_TYPE_PAYMENT').select2({
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

function getPriceRf(){
    findPriceRf("", function(pricerefs){
        var optRep = '<option value="">Seleccione</option>';
            
        if(pricerefs.length > 0){
            $.each(pricerefs, function (index, priceref) {
                optRep += '<option value="'+priceref.ID_TYPE+'" >'+priceref.INFO+'</option>';
            });
          
        }
        $("#ID_PRICE_REF").html(optRep);
        
        // Select2 selects
        $('#ID_PRICE_REF').select2({
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

function getTprices(){
    findTPrices("", function(tprices){
        var optRep = '<option value="">Seleccione</option>';
            
        if(tprices.length > 0){
            $.each(tprices, function (index, tprice) {
                optRep += '<option value="'+tprice.ID_TYPE+'" >'+tprice.INFO+'</option>';
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

function getCosecha(){
    findCosecha("", function(cosechas){
        var optRep = '<option value="">Seleccione</option>';
            
        if(cosechas.length > 0){
            $.each(cosechas, function (index, cosecha) {
                optRep += '<option value="'+cosecha.ID_TYPE+'" >'+cosecha.INFO+'</option>';
            });
          
        }
        $("#ID_CROP").html(optRep);
        
        // Select2 selects
        $('#ID_CROP').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });          
        validateLoadComplete();
    });

}

function getProduct(tp){
    findProduct(1,tp, function(productos){
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
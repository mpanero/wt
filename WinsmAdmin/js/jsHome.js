var tipoAnxCampo = "";
var counterLC = 0;
var products = null;
var positions = null;
var places = null;
$(document).ready(function () {
    
    if(localStorage.getItem('rol') == '1'){
        $("#liUser").removeClass("hide");
        $("#liUser").addClass("show");
    }else{
        $("#liUser").removeClass("show");
        $("#liUser").addClass("hide");
    }

    $("img").mousedown(function(){
        return false;
    });

	/* logout */
    $('#linkLogout').off("click").on("click", function(){
		sessionLogout();        
    });

    
    /* Home */
    $('#linkHome').off("click").on("click", function(){
        
        window.location = '../vista/home.html'
        
    });
    
    /* Nueva Solicitud */
    $('#linkRequestAdd').off("click").on("click", function(){
        $("#ulMenu li").removeClass("active");
        blockUISystem();
        $("#liRequest").addClass("active");
        $("#divRootContent").load("../vista/requestAdd.html?x="+Math.random(), function () {
            
        });
        
    });

    /* Listar Solicitudes */
    $("#linkRequestList").off("click").on("click",function(){
        $("#ulMenu li").removeClass("active");
        blockUISystem();
        $("#liRequest").addClass("active");
        $("#divRootContent").load("../vista/requestList.html?x="+Math.random(), function () {
            
        });
    });
    
    /* Mis Negocios */
    $("#linkTradesList").off("click").on("click",function(){
        $("#ulMenu li").removeClass("active");
        blockUISystem();
        $("#liTrade").addClass("active");
        $("#divRootContent").load("../vista/tradeList.html?x="+Math.random(), function () {
            
        });
    }); 

    /* Consultar Mercado */
    $("#linkMarketsList").off("click").on("click",function(){
        $("#ulMenu li").removeClass("active");
        blockUISystem();
        $("#liMarket").addClass("active");
        $("#divRootContent").load("../vista/marketFilter.html?x="+Math.random(), function () {
            
        });
    });    
    
    /* Mis Alamas */
    $("#linkAlarmList").off("click").on("click",function(){
        $("#ulMenu li").removeClass("active");
        blockUISystem();
        $("#liAlarm").addClass("active");
        $("#divRootContent").load("../vista/alarmList.html?x="+Math.random(), function () {
            
        });
    });
    
    /* Precios */
    $("#linkPrecios").off("click").on("click",function(){
        counterLC = 0;
        $("#ulMenu li").removeClass("active");
        blockUISystem();
        $("#liPrice").addClass("active");
        blockUISystem();
        $("#pagActual").html("Precios Mercado");
        findPoductos();
        findPricePos();
        findPlace();
    });
    
    /* Usuarios */
    $("#linkUsers").off("click").on("click",function(){
        $("#ulMenu li").removeClass("active");
        blockUISystem();
        $("#liUser").addClass("active");
        blockUISystem();
        $("#pagActual").html("Usuarios");
        $("#divRootContent").load("../vista/usersList.html?x="+Math.random(), function () {
            
        });
    });

    /**
     * resumen
     */
    
    $("#divRootContent").load("../vista/resumen.html?x="+Math.random(), function () {
        
    });    

    findNotifys();

    datosUsuario();

    setInterval(findNotifys, 300000); /* 5 min */
    
});

function loadView(){
    var reg = 0;
    var colsHtml = "";
    var rowsHtml = "";
    var tablaPizarra = "";
    var tablaChicago = "";
    var dateCotiza = "";
    var dateUpdate = "";
    $.each(products, function (indexPro, producto) {

        $.each(places, function (indexPla, place) {

            if(producto.ID_PRODUCT_PRICE == place.t_prices.ID_PRODUCT){

                dateCotiza =  moment(place.t_prices.DATE_PRICE).utc().add(0,'d').format('DD/MM/YYYY');
                dateUpdate =  moment(place.t_prices.UPDATED).utc().add(0,'d').format('DD/MM/YYYY h:mm:ss');
                tablaPizarra += ''+
                '<tr>'+
                    '<td>'+
                        '<div class="media-left">'+
                            '<div class=""><a class="text-default text-semibold"><span class="status-mark border-blue position-left"></span>'+place.t_places_price.PLACE_NAME+'</a></div>'+
                        '</div>'+
                    '</td>'+
                    '<td><span class="text-muted">'+place.t_prices.PRICE_VALUE+'</span></td>'+
                    '<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> '+place.t_prices.VAR+'</span></td>'+
                    '<td><h6 class="text-semibold">'+place.t_currency.CURRENCY_NAME+'</h6></td>'+
                '</tr>';           
            }
        });

        $.each(positions, function (indexPos, position) {
            if(producto.ID_PRODUCT_PRICE == position.t_prices.ID_PRODUCT){
                dateUpdate = moment(position.t_prices.UPDATED).utc().add(0,'d').format('DD/MM/YYYY h:mm:ss');
                tablaChicago += ''+
                '<tr>'+
                    '<td>'+
                        '<div class="media-left">'+
                            '<div class=""><a href="#" class="text-default text-semibold"><span class="status-mark border-blue position-left"></span>'+position.t_position.POSITION+'</a></div>'+
                        '</div>'+
                    '</td>'+
                    '<td><span class="text-muted">'+position.t_prices.PRICE_VALUE+'</span></td>'+
                    '<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> '+position.t_prices.VAR+'</span></td>'+
                    '<td><h6 class="text-semibold">'+position.t_currency.CURRENCY_NAME+'</h6></td>'+
                '</tr>';         
            }    
        }); 
        if(tablaPizarra == ''){
            tablaPizarra = ''+
            '<tr>'+
                '<td colspan="4">'+
                    'Sin Informaci&oacute;n'+
                '</td>'+
            '</tr>';
        }
        if(tablaChicago == ''){
            tablaChicago = ''+
            '<tr>'+
                '<td colspan="4">'+
                    'Sin Informaci&oacute;n'+
                '</td>'+
            '</tr>';
        }     
        rowsHtml += ''+
        '<div class="panel animated fadeInUp col-md-12" >'+
            '<div class="panel-heading bg-teal">'+
                '<h6 class="panel-title">'+
                    '<a data-toggle="collapse" data-parent="#divRootContent" href="#accordion-control-right-group'+reg+'">'+producto.PRODUCT_NAME+'</a>'+
                '</h6>'+
            '</div>'+
            '<div id="accordion-control-right-group'+reg+'" class="panel-collapse collapse">'+
                '<div class="panel-body">'+
                    '<div class="panel panel-flat animated zoomIn">'+
                        '<div class="table-responsive">'+
                            '<table class="table text-nowrap">'+
                                '<thead>'+
                                    '<tr>'+
                                        '<th>Lugar</th>'+
                                        '<th class="col-md-2">Cotizaci&oacute;n</th>'+
                                        '<th class="col-md-2">Var</th>'+
                                        '<th class="col-md-2">Moneda</th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>'+
                                    '<tr class="active border-double">'+
                                        '<td colspan="3">Precio Pizarra <div class="text-muted text-size-small">Fecha Cotizaci&oacute;n: '+dateCotiza+'</div> <div class="text-muted text-size-small">Última Actualizaci&oacute;n: '+dateUpdate+'</div></td>'+
                                        '<td class="text-right">'+
                                            '<span class="progress-meter" id="today-progress" data-progress="30"></span>'+
                                        '</td>'+
                                    '</tr>'+
                                    tablaPizarra+
                                    '<tr class="active border-double">'+
                                        '<td colspan="3">Precio Chicago </td>'+
                                        '<td class="text-right">'+
                                            '<span class="progress-meter" id="yesterday-progress" data-progress="65"></span>'+
                                        '</td>'+
                                    '</tr>'+
                                    tablaChicago+
                                '</tbody>'+
                            '</table>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>';
       
        reg += 1;  
        tablaPizarra = '';
        tablaChicago = '';        
    });

    reg = 0;
    $("#divRootContent").html(rowsHtml);
    
}

function validateLoadCompletePrices() {
    counterLC++;
    if (counterLC === 3) {
        counterLC = 0;
       
        setTimeout(function () {
            unblockUISystem();
            loadView();
        }, 1700);
        
    }

}

function findPlace(){
    $.ajax({
        data: {
            user:1
        },
        type: 'POST',
        dataType:"json",
        url: root+'/TProductsPrice/findPlace'+'.json',
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false
    }).done(function(response){
       
        if (evalResponseAjax(response)) {
            validateLoadCompletePrices();
            //alert("Login: "+JSON.stringify(response));
            places = $.parseJSON(JSON.stringify(response.tProductsPrice));
            //document.getElementById('captcha').src = 'lib/securimage2/securimage_show.php?' + Math.random();
            if(typeof places !== null && typeof places !== typeof undefined){

            }else{
                unblockUISystem();
                swal({ title: "Error!", text: 'Datos Incorrecto',  type: "error", html: true });
            }                
            
        }
        
    }).fail(function (jqXHR, textStatus, errorThrown) {

        unblockUISystem();
        if(jqXHR.status == 401){
            swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });    
        }else{
            if(jqXHR.status == 403){
                swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
            }else{
                if(jqXHR.status == 404){
                    swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                }else{
                    if(jqXHR.status == 500){
                        swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });    
                    }
                }
            }
        }
        
    });
}

function findPricePos(){
    $.ajax({
        data: {
            user:1
        },
        type: 'POST',
        dataType:"json",
        url: root+'/TProductsPrice/findPosition'+'.json',
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false
    }).done(function(response){
       
        if (evalResponseAjax(response)) {
            validateLoadCompletePrices();
            //alert("Login: "+JSON.stringify(response));
            positions = $.parseJSON(JSON.stringify(response.tProductsPrice));
            //document.getElementById('captcha').src = 'lib/securimage2/securimage_show.php?' + Math.random();
            if(typeof positions !== null && typeof positions !== typeof undefined){

            }else{
                unblockUISystem();
                swal({ title: "Error!", text: 'Datos Incorrecto',  type: "error", html: true });
            }                
            
        }
        
    }).fail(function (jqXHR, textStatus, errorThrown) {

        unblockUISystem();
        if(jqXHR.status == 401){
            swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });    
        }else{
            if(jqXHR.status == 403){
                swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
            }else{
                if(jqXHR.status == 404){
                    swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                }else{
                    if(jqXHR.status == 500){
                        swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });    
                    }
                }
            }
        }
        
    });
}

function findPoductos(){
    $.ajax({
        data: {
            user:1
        },
        type: 'POST',
        dataType:"json",
        url: root+'/TProductsPrice/find'+'.json',
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false
    }).done(function(response){
        
        if (evalResponseAjax(response)) {
            validateLoadCompletePrices();
            //alert("Login: "+JSON.stringify(response));
            products = $.parseJSON(JSON.stringify(response.tProductsPrice));
            //document.getElementById('captcha').src = 'lib/securimage2/securimage_show.php?' + Math.random();
            if(typeof products !== null && typeof products !== typeof undefined){

            }else{
                unblockUISystem();
                swal({ title: "Error!", text: 'Datos Incorrecto',  type: "error", html: true });
            }                
            
        }
        
    }).fail(function (jqXHR, textStatus, errorThrown) {
        unblockUISystem();
        if(jqXHR.status == 401){
            swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });    
        }else{
            if(jqXHR.status == 403){
                swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
            }else{
                if(jqXHR.status == 404){
                    swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                }else{
                    if(jqXHR.status == 500){
                        swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });    
                    }
                }
            }
        }
        
    });
}

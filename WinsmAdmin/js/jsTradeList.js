var trdListPage = 1;
var maxPage = 1;
var regNum = 1;
var counterBlock = 0;
var optsReg = null;
var wordFind = "";
var idTrd = null;
$(document).ready(function () {
    $("#pagActual").html("Mis Negocios");
    /* list paginas*/
    $("#btnforward").off().on('click', function () {
        if (maxPage > 1) {
            if (trdListPage < maxPage) {
            	trdListPage += 1;
            	listTrades();
            }
        }
    });

    $("#btnbacward").off().on('click', function () {
        if (maxPage > 1) {
            if (trdListPage > 1) {
            	trdListPage -= 1;
                listTrades();
            }
        }
    });
        
    $("#btnbacwardInit").off("click").on('click', function () {
        if (maxPage > 1) {
            if (trdListPage > 1) {
                trdListPage = 1;
                listTrades();
            }
        }
    });
    
    $("#btnforwardEnd").off("click").on('click', function () {
        if (maxPage > 1) {
            if (trdListPage < maxPage) {
                trdListPage = maxPage;
                listTrades();
            }
        }
    });
    
    // Tooltip
    $('[data-popup="tooltip"]').tooltip(); 

    listTrades();
    
});

function deleteTrade(){
    var datosSend = "";
    $.each(linksWs["tTrade"], function(nombre,data) { 
        //console.log(nombre+"(d:n)"+data);
        if(String(nombre).indexOf("t_") == -1){
            datosSend +="&"+String(nombre)+"="+data;
        }
    });           
    datosSend +="&USER="+localStorage.getItem("user");
    $.ajax( {
        method: 'post',
        dataType:"json",
        url: root+"/TTrade/deleteTrade.json?"+datosSend, 
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
            linksWs["tTrades"].data.splice(idTrd[1], 1);
            //alert("Requests: "+linksWs.requests.length );
            linksWs["tTrades"].rows -= 1; 
            if(linksWs["tTrades"].rows < 1){
                linksWs["tTrades"] = null;
                swal({
                    title: "Mensaje!",
                    text: 'No posee Negocios <span style="color:#4CAF50">"activos"<span>',
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
                    text: 'Negocio Borrado con éxito <span style="color:#4CAF50">"éxito"<span>',
                    type: "success",
                    confirmButtonColor: "#66BB6A",
                    confirmButtonText: "Ok!",
                    html:true
                },
                function(isConfirm){
                    if (isConfirm) {
                        $(".modalViewTrade").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeOutRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                            $('body').attr("style","padding-right: 0px;");
                            $(this).removeClass("animated " + "fadeOutRight");
                            $(this).modal('hide');
                            eachListTrade();
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

function upStatusTrade(estatusTrade,sms){
    var datosSend = "";
    $.each(linksWs["tTrade"], function(nombre,data) { 
        //console.log(nombre+"(d:n)"+data);
        if(String(nombre).indexOf("t_") == -1){
            if(nombre == "ID_TP_STATUS_TRADE"){
                datosSend +="&"+String(nombre)+"="+estatusTrade;
            }else{
                datosSend +="&"+String(nombre)+"="+data;
            }            
        }
    });           
    datosSend +="&USER="+localStorage.getItem("user");
    $.ajax( {
        method: 'post',
        dataType:"json",
        url: root+"/TTrade/confirmTrade.json?"+datosSend, 
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false,
        processData: false,
        contentType: false
    }).done(function(doneNew){
       
        if (evalResponseAjax(doneNew)) {
            linksWs["tTrades"].data[idTrd[1]] = doneNew.tTrade[0];
            setTimeout(function(){ countDown(); 
            
                unblockUISystem();
                swal({
                    title: "Mensaje!",
                    text: 'Negocio '+sms+' con <span style="color:#4CAF50">"éxito"<span>',
                    type: "success",
                    confirmButtonColor: "#66BB6A",
                    confirmButtonText: "Ok!",
                    html:true
                },
                function(isConfirm){
                    if (isConfirm) {
                        $(".modalViewTrade").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeOutRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                            $('body').attr("style","padding-right: 0px;");
                            $(this).removeClass("animated " + "fadeOutRight");
                            $(this).modal('hide');
                            eachListTrade();
                        });
                        $('body').attr("style","padding-right: 0px;");
                        findNotifys();
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

function eventsEditModal(){
    
    /************************************* Cancelar Negocio   ************************************/
    $("#linkCancelTrade").off('click').on("click",function(events){
        swal({
            html: true,
            title: 'Confirmacion..!!',
            text: "¿Seguro de Cancelar el Negocio ?",   
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#66BB6A',
            cancelButtonColor: '#FF3333',
            confirmButtonText: 'Si, cancelar!',
            cancelButtonText: 'Cancelar!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
            },
            function(isConfirm){
                if (isConfirm) {
                    blockUISystem();
                    upStatusTrade(105,"Cancelado");
                } else {

                }
        });
        events.preventDefault();
    }); 
    
    /************************************* Terminar Negocio   ************************************/
    $("#linkFinishTrade").off('click').on("click",function(events){
        swal({
            html: true,
            title: 'Confirmacion..!!',
            text: "¿Seguro de Terminar el Negocio ?",   
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#66BB6A',
            cancelButtonColor: '#FF3333',
            confirmButtonText: 'Si, terminar!',
            cancelButtonText: 'Cancelar!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
            },
            function(isConfirm){
                if (isConfirm) {
                    blockUISystem();
                    upStatusTrade(104,"Terminado");
                } else {

                }
        });
        events.preventDefault();
    }); 

    /************************************* Iniciar Owner Negocio   ************************************/
    $("#linkConfirmOwnerTrade").off('click').on("click",function(events){
        swal({
            html: true,
            title: 'Confirmacion',
            text: "¿Seguro de Confirmar el Negocio ?",   
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#66BB6A',
            cancelButtonColor: '#FF3333',
            confirmButtonText: 'Si, confirmar!',
            cancelButtonText: 'Cancelar!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
            },
            function(isConfirm){
                if (isConfirm) {
                    blockUISystem();
                    upStatusTrade(103,"Confirmado");
                } else {

                }
        });
        events.preventDefault();
    }); 
    
    /************************************* Iniciar Cpart Negocio   ************************************/
    $("#linkConfirmCPartTrade").off('click').on("click",function(events){
        swal({
            html: true,
            title: 'Confirmacion',
            text: "¿Seguro de Confirmar el Negocio ?",   
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#66BB6A',
            cancelButtonColor: '#FF3333',
            confirmButtonText: 'Si, confirmar!',
            cancelButtonText: 'Cancelar!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
            },
            function(isConfirm){
                if (isConfirm) {
                    blockUISystem();
                    upStatusTrade(102,"Confirmado");
                } else {

                }
        });
        events.preventDefault();
    }); 
    
    /************************************* Iniciar Negocio   ************************************/
    $("#linkInitTrade").off('click').on("click",function(events){
        swal({
            html: true,
            title: 'Confirmacion',
            text: "Está por iniciar un negocio, confirma la operación? ",   
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#66BB6A',
            cancelButtonColor: '#FF3333',
            confirmButtonText: 'Si, iniciar Negocio!',
            cancelButtonText: 'Cancelar!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
            },
            function(isConfirm){
                if (isConfirm) {
                    blockUISystem();
                    upStatusTrade(101,"Iniciado");
                } else {

                }
        });
        events.preventDefault();
    }); 
    /************************************* Borrar Negocio   ************************************/
    $("#linkDeleteTrade").off('click').on("click",function(events){
        swal({
            html: true,
            title: 'Confirmacion..!!',
            text: "¿Seguro que no le intersa el Negocio ?",   
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#66BB6A',
            cancelButtonColor: '#FF3333',
            confirmButtonText: 'Si, no me Interesa!',
            cancelButtonText: 'Cancelar!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
            },
            function(isConfirm){
                if (isConfirm) {
                    blockUISystem();
                    deleteTrade();
                } else {

                }
        });
        events.preventDefault();
    });    

    /************************************* Cerrar Modal Edit   ************************************/
    $(".btnCloseModalViewTrade").off('click').on("click",function(events){
        $(".modalViewTrade").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeOutRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
            $('body').attr("style","padding-right: 0px;");
            $(this).removeClass("animated " + "fadeOutRight");
            $(this).modal('hide');
            
        });
        $('body').attr("style","padding-right: 0px;");
        events.preventDefault();
    });

    activatedOnClick();
    unblockUISystem();
}

function loadTrade(info){
    blockUISystem();  
    linksWs["tTrade"] = linksWs["tTrades"][info];
    var DT_FROM = (linksWs["tTrade"].t_request != null) ? String(linksWs["tTrade"].t_request.DT_FROM) : "";
    var DT_TO = (linksWs["tTrade"].t_request != null) ? String(linksWs["tTrade"].t_request.DT_TO) : "";
    var html = ''+
    '<div class="panel-body">'+
        '<h5 class="text-semibold no-margin-top text-center">'+linksWs["tTrade"].t_product.PRODUCT_NAME+'</h5>'+
        '<h6 class="text-semibold no-margin-top text-center">'+linksWs["tTrade"].MARKET_NAME+'</h6>'+
        '<div class="row">'+
            '<div class="col-sm-7">'+
                '<ul class="list list-unstyled">'+
                    '<li><span class="text-semibold">Precio</span></li>'+
                    '<li><span class="status-mark border-success position-left"></span>'+linksWs["tTrade"].PRICE+'</li>'+
                    '<li><span class="text-semibold">Cantidad</span></li>'+
                    '<li><span class="status-mark border-success position-left"></span>'+linksWs["tTrade"].QT+'</li>'+
                    '<li><span class="text-semibold">Fecha de Entrega</span></li>'+
                    '<li><span class="status-mark border-success position-left"></span>'+DT_FROM.split(" ")[0]+' a '+DT_TO.split(" ")[0]+'</li>'+
                '</ul>'+
            '</div>'+
            '<div class="col-sm-5">'+
                '<ul class="list list-unstyled">'+
                    '<li><span class="text-semibold">Moneda</span></li>'+
                    '<li><span class="status-mark border-success position-left"></span>'+linksWs["tTrade"].t_currency.CURRENCY_NAME+'</li>'+
                    '<li><span class="text-semibold">Unidad Medida</span></li>'+
                    '<li><span class="status-mark border-success position-left"></span>'+linksWs["tTrade"].t_um.UM_NAME+'</li>'+
                    '<li><span class="text-semibold">Lugar de Entrega</span></li>'+
                    '<li><span class="status-mark border-success position-left"></span>'+linksWs["tTrade"].PLACE_CPART+'</li>'+
                '</ul>'+
            '</div>'+
        '</div>  '+                            
    '</div>'+
    '<div class="panel-footer panel-footer-condensed"><a class="heading-elements-toggle"><i class="icon-more"></i></a>'+
        '<div class="heading-elements" style="position:inherit !important;">'+
            '<span class="heading-text">'+
                '&nbsp;'+
            '</span>'+
            '<ul class="list-inline list-inline-condensed heading-text pull-right">'+
                '<li class="dropdown">'+
                    '<a href="#" class="text-default dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>'+
                    '<ul class="dropdown-menu dropdown-menu-right">';
                        if( parseInt(localStorage.getItem("user")) == parseInt(linksWs["tTrade"].ID_USER_CPART) && 100 == parseInt(linksWs["tTrade"].ID_TP_STATUS_TRADE) ){
                            html += '<li><a id="linkDeleteTrade"><i class=" icon-cancel-circle2 text-danger-700"></i> Ya no me interesa</a></li>';
                        }
                        if( parseInt(localStorage.getItem("user")) == parseInt(linksWs["tTrade"].ID_USER_OWNER) && 100 == parseInt(linksWs["tTrade"].ID_TP_STATUS_TRADE) ){
                            html += '<li><a id="linkInitTrade"><i class=" icon-target text-success-700"></i> Iniciar Negocio</a></li>';
                        }
                        if( parseInt(localStorage.getItem("user")) == parseInt(linksWs["tTrade"].ID_USER_CPART) && 101 == parseInt(linksWs["tTrade"].ID_TP_STATUS_TRADE) ){
                            html += '<li><a id="linkConfirmCPartTrade"><i class=" icon-checkmark-circle text-success-700"></i> Confirmar Negocio</a></li>';
                        }
                        if( parseInt(localStorage.getItem("user")) == parseInt(linksWs["tTrade"].ID_USER_OWNER) && 102 == parseInt(linksWs["tTrade"].ID_TP_STATUS_TRADE) ){
                            html += '<li><a id="linkConfirmOwnerTrade"><i class="icon-checkmark-circle text-success-700"></i> Confirmar Negocio</a></li>';
                        }
                        if( parseInt(localStorage.getItem("user")) == parseInt(linksWs["tTrade"].ID_USER_OWNER) && 103 == parseInt(linksWs["tTrade"].ID_TP_STATUS_TRADE) ){
                            html += '<li><a id="linkFinishTrade"><i class="  icon-circle2 text-indigo-700"></i> Terminar Negocio</a></li>';
                        }
                        if( parseInt(linksWs["tTrade"].ID_TP_STATUS_TRADE) >= 101 && parseInt(linksWs["tTrade"].ID_TP_STATUS_TRADE) <= 103 ){
                            html += '<li><a id="linkCancelTrade"><i class=" icon-cancel-circle2 text-danger-700"></i> Cancelar Negocio</a></li>';
                        }
                        html += ''+ 
                    '</ul>'+
                '</li>'+
            '</ul>'+
        '</div>'+
    '</div>';
    $("#divViewTrade").html(html);
    eventsEditModal();
}

function initEventsTable(){
    
    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        responsive: true,
        columnDefs: [{ 
            orderable: false,
            width: '100px'
        }],
        paging: true,
        dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filtro:</span> _INPUT_',
            lengthMenu: '<span>Ver:</span> _MENU_',
            paginate: { 'first': 'Primera', 'last': 'Ultima', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

    // Basic responsive configuration
    $('#tableListTrades').DataTable();

    // External table additions
    // ------------------------------

    // Add placeholder to the datatable filter option
    $('#tableListTrades input[type=search]').attr('placeholder','Filtrar...');
    
    
    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });  

    $(".menuList").off("click").on("click",function(){
        var ancla = $(this);
        idTrd = ancla.attr("id").split("-");

        if(idTrd[0] == "upd"){     
            $(".modalViewTrade").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeInRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                $('body').attr("style","padding-right: 0px;");
                $(this).removeClass("animated " + "fadeInRight");
                loadTrade(idTrd[1]);
                
            });                 
            
        }
        
    });  

    // Popover
    $('[data-popup="popover"]').popover({
        html: true,
        container: 'body',
        content: function() {
        var id = $(this).attr('id')
            return $('#popover-content-' + id).html();
        }
    });     
    /*
    $('[data-popup="popover"]').each(function(i, obj) {
        
        $(this).popover({
            html: true,
            content: function() {
            var id = $(this).attr('id')
                return $('#popover-content-' + id).html();
            }
        });
    
    });
    */     
    unblockUISystem();
}

function eachListTrade(){

    if (linksWs["tTrades"].length > 0) {

        var listReg = '';
        var classColor = '';
        if (trdListPage < maxPage){

        }
        var rowNum = 0;
        var htmlCpart = "";
        $.each(linksWs["tTrades"], function (reg, atributo) {
            var DT_FROM = (atributo.t_request != null) ? String(atributo.t_request.DT_FROM):"";
            var DT_TO = (atributo.t_request != null) ? String(atributo.t_request.DT_TO):"";

            htmlCpart = ''+
            '<div class=\"col-md-15\" style="min-width:100%;">'+
                '<div class=\"panel panel-flat border-bottom-lg border-bottom-warning border-right-lg border-right-danger\">'+
                    '<div class=\"panel-body\">'+
                        '<span class="status-mark border-danger position-left text-semibold"></span>Nombre:<br>'+
                        '<span class="text-muted">'+atributo.t_user_cpart.NAME+'&nbsp;'+atributo.t_user_cpart.SURNAME+'</span><br>'+
                        '<span class="status-mark border-danger position-left text-semibold"></span>Mail:<br>'+
                        '<span class="text-muted">'+atributo.t_user_cpart.MAIL+'</span><br>'+
                        '<span class="status-mark border-danger position-left text-semibold"></span>Mobile:<br>'+
                        '<span class="text-muted">'+atributo.t_user_cpart.PHONE_MOBILE_COUNTRY+'</span><br>'+
                    '</div>'+
                '</div>'+
            '</div>';
            listReg += ''+
            '<tr id="upd-'+rowNum+'" data-popup="popover" title="Datos Contraparte" data-trigger="hover" data-placement="top" data-content=\''+htmlCpart+'\' class="menuList animation" data-animation="fadeInRight" data-toggle="modal" data-target="#modal_ViewTrade" >'+
                '<td >'+
                    '<div class="media-left media-middle">'+
                        '<a class="btn border-indigo-800 text-indigo-800 btn-flat btn-rounded btn-icon btn-xs"><i class="icon-briefcase"></i></a>'+
                   '</div>'+
                    '<div class="media-left">'+
                        '<div class=""><a href="#" class="text-default text-semibold">'+atributo.t_product.PRODUCT_NAME+'</a></div>'+
                        '<div class="text-muted text-size-small">'+
                            '<span class="status-mark border-'+atributo.COLOR.toLowerCase()+' position-left"></span>'+
                            ''+atributo.INFO1+''+
                        '</div>'+
                    '</div>'+
                '</td>'+
                '<td><span class="text-regular">'+atributo.OPERATION+'</span></td>'+                       
                '<td><span class="text-regular">'+atributo.QT+'</span></td>'+
                '<td><span class="text-regular">'+atributo.t_um.UM_NAME+'</span></td>'+
                '<td><h6 class="text-regular"><i class="icon-price-tags2 position-left text-muted"></i>&nbsp;'+atributo.PRICE+'</h6></td>'+
                '<td><span class="text-regular"><i class="icon-coins position-left text-muted"></i>&nbsp;'+atributo.t_currency.CURRENCY_NAME+'</span></td>'+
                '<td><span class="text-regular"><i class="icon-calendar2 position-left text-muted"></i>&nbsp;'+DT_FROM.split(" ")[0]+' a '+DT_TO.split(" ")[0]+'</span></td>'+
            '</tr>';

            rowNum += 1;
        });
        $("#tableListTrades tbody").html(listReg);
        setTimeout(function(){ initEventsTable(); }, 1700);

    }else{
        unblockUISystem();
        if(trdListPage >= 10){
            $("#numPag").attr("style","font-size: 15px;"); //style="font-size: 10px; padding: 6px 7px;"
            $("#linkPag").attr("style","font-size: 10px; padding: 6px 7px;"); //style="font-size: 10px; padding: 6px 7px;"
        }else{
            $("#numPag").attr("style","font-size: 17px;");//style="font-size: 10px; padding: 3px 9px;"
            $("#linkPag").attr("style","font-size: 10px; padding: 3px 9px;");//style="font-size: 10px; padding: 3px 9px;"
        }
        $("#numPag").html("0");
        swal({ title: "Mensaje!", text: 'No se encontraron <span style="color:#00ACC1">Registros<span>', type: "info", html: true});
    }
}


function listTrades(){
    blockUISystem();
    $.ajax({
        method: 'post',
        dataType:"json",
        url: root+"/TTrade/find.json?page="+trdListPage+"&user="+localStorage.getItem("user"), 
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false
    }).done(function(doneList){
        if (evalResponseAjax(doneList)) {
            if(typeof (doneList.tTrade) === 'string' ){
                unblockUISystem();
                swal({ title: "Mensaje!", text: 'No se encontraron <span style="color:#00ACC1">Registros<span>', type: "info", html: true});
                //swal({ title: "Error!", text: doneList.tTrade,  type: "error", html: true });
            }else{
                if(doneList != "" && doneList != 0){
                    linksWs["tTrades"] = $.parseJSON(JSON.stringify(doneList.tTrade));                
                    eachListTrade();
                }else{
                    unblockUISystem();
                    swal({ title: "Mensaje!", text: 'No se encontraron <span style="color:#00ACC1">Registros<span>', type: "info", html: true});
                }
            }
            
        }else{
            unblockUISystem();
        }
    }); 
}

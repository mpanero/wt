var mrkListPage = 1;
var maxPage = 1;
var regNum = 1;
var counterBlock = 0;
var optsReg = null;
var wordFind = "";
var idReq = null;
$(document).ready(function () {
    $("#pagActual").html("Consulta de Mercado");
    blockUISystem();
    /* list paginas*/
    $("#btnforward").off().on('click', function () {
        if (maxPage > 1) {
            if (mrkListPage < maxPage) {
            	mrkListPage += 1;
            	listMarkets();
            }
        }
    });

    $("#btnbacward").off().on('click', function () {
        if (maxPage > 1) {
            if (mrkListPage > 1) {
            	mrkListPage -= 1;
                listMarkets();
            }
        }
    });
        
    $("#btnbacwardInit").off("click").on('click', function () {
        if (maxPage > 1) {
            if (mrkListPage > 1) {
                mrkListPage = 1;
                listMarkets();
            }
        }
    });
    
    $("#btnforwardEnd").off("click").on('click', function () {
        if (maxPage > 1) {
            if (mrkListPage < maxPage) {
                mrkListPage = maxPage;
                listMarkets();
            }
        }
    });

    $("#linkAddRepre").off().on('click', function () {
        $("#divRootContent").load("repreNacionalAdd.html?r="+Math.random(), function () {
            $('body').addClass('sidebar-xs');            
        }); 
    });  

    $("#numPag").html(mrkListPage);
    
    // Tooltip
    $('[data-popup="tooltip"]').tooltip(); 

    setTimeout(function () {
        eachListMarket();
    }, 1300);       

});

function addNegocio(){
    $('#formEditMarket').off("submit").one("submit", function(e){  
        var datosFormEmp = $('#formEditMarket').serialize();
        $.each(linksWs["tRequest"], function(nombre,data) { 
            //console.log(nombre+"(d:n)"+data);
            if(String(nombre).indexOf("t_") == -1){
                if(nombre == "ID_USER_OWNER"){
                    datosFormEmp +="&"+String(nombre)+"="+localStorage.getItem("user");
                    datosFormEmp += '&ID_USER_CPART='+data;
                }else{
                    datosFormEmp +="&"+String(nombre)+"="+data;
                }
                
                //dataPost.push(obj);                    
            }
        });           

        $.ajax( {
            method: 'post',
            dataType:"json",
            url: root+"/TTrade/newTrade.json?"+datosFormEmp, 
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
                    text: 'Te interesa! Puedes Consultar este negocio en <span style="color:#4CAF50">"Mis negocios"<span>',
                    type: "success",
                    confirmButtonColor: "#66BB6A",
                    confirmButtonText: "Ok!",
                    html:true
                },
                function(isConfirm){
                    if (isConfirm) {
                        $(".modalViewMarket").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeOutRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                            $('body').attr("style","padding-right: 0px;");
                            $(this).removeClass("animated " + "fadeOutRight");
                            $(this).modal('hide');
                            
                        });
                        $('body').attr("style","padding-right: 0px;");
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
    $("#formEditMarket").trigger("submit");    
}

function eventsEditModal(){
    /************************************* Cerrar Modal Edit   ************************************/
    $(".btnCloseModalViewMarket").off('click').on("click",function(events){
        $(".modalViewMarket").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeOutRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
            $('body').attr("style","padding-right: 0px;");
            $(this).removeClass("animated " + "fadeOutRight");
            $(this).modal('hide');
            
        });
        $('body').attr("style","padding-right: 0px;");
        events.preventDefault();
    });

    /************************************* Confirmacion Negocio   ************************************/
    $("#linkConfirm").off('click').on("click",function(events){
        if(validacionMaestra("#formEditMarket")){
           blockUISystem();
           addNegocio();
        }else{
            $("#divConfirm").prop("style","display:block;");
            swal({
                html: true,
                title: 'Confirmacion..!!',
                text: "Debe llenar los campos requeridos",   
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#66BB6A',
                cancelButtonColor: '#FF3333',
                confirmButtonText: 'Confirmar!',
                cancelButtonText: 'No, cancelar!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger'
                },
                function(isConfirm){
                    if (isConfirm) {
                        //alert("Si");
                    } else {
                        //alert("No");
                        resetForm("#formEditMarket");
                        $("#divConfirm").prop("style","display:none;");
                    }
            });
        }

        events.preventDefault();
    });    
    activatedOnClick();
    unblockUISystem();
}

function loadRequest(info){
    blockUISystem();  
    linksWs["tRequest"] = linksWs["tRequests"][info];
    var html = ''+
    '<div class="panel-body">'+
        '<h5 class="text-semibold no-margin-top text-center">'+linksWs["tRequest"].t_product.PRODUCT_NAME+'</h5>'+
        '<h6 class="text-semibold no-margin-top text-center">'+linksWs["tRequest"].t_market.MARKET_NAME+'</h6>'+
        '<div class="row">'+
            '<div class="col-sm-7">'+
                '<ul class="list list-unstyled">'+
                    '<li><span class="text-semibold">Precio</span></li>'+
                    '<li><span class="status-mark border-success position-left"></span>'+(linksWs["tRequest"].PRICE_FROM == linksWs["tRequest"].PRICE_TO ? linksWs["tRequest"].PRICE_FROM : linksWs["tRequest"].PRICE_FROM +' a '+ linksWs["tRequest"].PRICE_TO)+'</li>'+
                    '<li><span class="text-semibold">Cantidad</span></li>'+
                    '<li><span class="status-mark border-success position-left"></span>'+(linksWs["tRequest"].QT_FROM == linksWs["tRequest"].QT_TO ? linksWs["tRequest"].QT_FROM : linksWs["tRequest"].QT_FROM +' a '+ linksWs["tRequest"].QT_TO)+'</li>'+
                    '<li><span class="text-semibold">Fecha de Entrega</span></li>'+
                    '<li><span class="status-mark border-success position-left"></span>'+String(linksWs["tRequest"].DT_FROM).split(" ")[0]+' a '+String(linksWs["tRequest"].DT_TO).split(" ")[0]+'</li>'+
                '</ul>'+
            '</div>'+
            '<div class="col-sm-5">'+
                '<ul class="list list-unstyled">'+
                    '<li><span class="text-semibold">Moneda</span></li>'+
                    '<li><span class="status-mark border-success position-left"></span>'+linksWs["tRequest"].t_currency.CURRENCY_NAME+'</li>'+
                    '<li><span class="text-semibold">Unidad Medida</span></li>'+
                    '<li><span class="status-mark border-success position-left"></span>'+linksWs["tRequest"].t_um.UM_NAME+'</li>'+
                    '<li><span class="text-semibold">Lugar de Entrega</span></li>'+
                    '<li><span class="status-mark border-success position-left"></span>'+linksWs["tRequest"].t_place.PLACE_NAME+'</li>'+
                '</ul>'+
            '</div>'+
        '</div>  '+
        '<div class="row" id="divConfirm" style="display:none;">'+
            '<div class="col-sm-6">'+
                '<ul class="list list-unstyled">'+
                    '<li><span class="text-semibold">Rango Precio</span></li>'+
                    '<li><span class="status-mark border-success position-left"></span>'+(linksWs["tRequest"].PRICE_FROM == linksWs["tRequest"].PRICE_TO ? '1 a '+linksWs["tRequest"].PRICE_FROM : linksWs["tRequest"].PRICE_FROM +' a '+ linksWs["tRequest"].PRICE_TO)+'</li>'+
                '</ul>'+
                '<div class="form-group" >'+
                    '<input id="PRICE" name="PRICE" type="text" placeholder="Precio" ngMin="'+linksWs["tRequest"].PRICE_FROM+'" ngMax="'+linksWs["tRequest"].PRICE_TO+'" class="form-control range only-number">'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-6">'+
                '<ul class="list list-unstyled">'+
                    '<li><span class="text-semibold">Rango Cantidad</span></li>'+
                    '<li><span class="status-mark border-success position-left"></span>'+(linksWs["tRequest"].QT_FROM == linksWs["tRequest"].QT_TO ? '1 a '+linksWs["tRequest"].QT_FROM : linksWs["tRequest"].QT_FROM +' a '+ linksWs["tRequest"].QT_TO)+'</li>'+
                '</ul>'+
                '<div class="form-group" >'+
                    '<input id="QT" name="QT" type="text" placeholder="Cantidad" ngMin="'+linksWs["tRequest"].QT_FROM+'" ngMax="'+linksWs["tRequest"].QT_TO+'" class="form-control range only-number">'+
                '</div>'+
            '</div>'+
        '</div>'+                             
    '</div>'+
    '<div class="panel-footer panel-footer-condensed"><a class="heading-elements-toggle"><i class="icon-more"></i></a>'+
        '<div class="heading-elements" style="position:inherit !important;">'+
            '<span class="heading-text">'+
                '&nbsp;'+
            '</span>'+
            '<ul class="list-inline list-inline-condensed heading-text pull-right">'+
                '<li class="dropdown">'+
                    '<a href="#" class="text-default dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>'+
                    '<ul class="dropdown-menu dropdown-menu-right">'+
                        '<li><a id="linkConfirm"><i class=" icon-star-full2 text-success-700"></i> Me Interesa</a></li>'+
                    '</ul>'+
                '</li>'+
            '</ul>'+
        '</div>'+
    '</div>';
    $("#divViewMarket").html(html);
    eventsEditModal();
    //unblockUISystem();
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
    $('#tableListMarkets').DataTable();

    // External table additions
    // ------------------------------

    // Add placeholder to the datatable filter option
    $('#tableListMarkets input[type=search]').attr('placeholder','Filtrar...');
    
    
    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });      

    $(".menuList").off("click").on("click",function(){
        var ancla = $(this);
        idReq = ancla.attr("id").split("-");

        if(idReq[0] == "upd"){     
            $(".modalViewMarket").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeInRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                $('body').attr("style","padding-right: 0px;");
                $(this).removeClass("animated " + "fadeInRight");
                loadRequest(idReq[1]);
                
            });                 
            
        }
        
    });    
    unblockUISystem();
}

function eachListMarket(){

    if (linksWs["tRequests"].length > 0) {

        var listReg = '';
        var classActivo = '';
        var descripActivo = '';
        var rowNum = 0;
        $.each(linksWs["tRequests"], function (reg, atributo) {

            if(atributo.ACTIVE == 1){
                classActivo = 'label-success';
                descripActivo = 'Activo';
            }else{
                classActivo = 'label-danger';
                descripActivo = 'Desactivado';
            }

            listReg += ''+
            '<tr id="upd-'+rowNum+'" class="menuList animation" data-animation="fadeInRight" data-toggle="modal" data-target="#modal_ViewMarket">'+
                '<td>'+atributo.t_product.PRODUCT_NAME+'</td>'+
                '<td>'+atributo.TP_OPERATION+'</td>'+
                '<td>'+atributo.QT_FROM+' a '+atributo.QT_TO+'</td>'+
                '<td>'+atributo.t_um.UM_NAME+'</td>'+
                '<td>'+atributo.PRICE_FROM+' a '+atributo.PRICE_TO+'</td>'+
                '<td>'+atributo.t_currency.CURRENCY_NAME+'</td>'+
            '</tr>';
            rowNum += 1;
        });
        $("#tableListMarkets tbody").html(listReg);
        setTimeout(function(){ initEventsTable(); }, 3000);

    }else{
        unblockUISystem();
        swal({ title: "Mensaje!", text: 'No se encontraron <span style="color:#00ACC1">Coincidencias<span>', type: "info", html: true});
    }
}


function listMarkets(){
    blockUISystem();
    $.ajax({
        method: 'post',
        dataType:"json",
        url: root+"/TRequest/filter.json?"+linksWs["formSubmit"]+"&page="+mrkListPage+"&user="+localStorage.getItem("user"), 
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false
    }).done(function(doneList){
        if (evalResponseAjax(doneList)) {
            if(typeof (doneList.tRequest) === 'string' ){
                unblockUISystem();
                swal({ title: "Error!", text: doneList.tRequest,  type: "error", html: true });
            }else{
                if(doneList != "" && doneList != 0){
                    linksWs["tRequests"] = $.parseJSON(JSON.stringify(doneList.tRequest));                
                    eachListMarket();
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

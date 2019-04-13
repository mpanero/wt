var reqListPage = 1;
var maxPage = 1;
var regNum = 1;
var counterBlock = 0;
var optsReg = null;
var wordFind = "";
var idReq = null;
$(document).ready(function () {
    $("#pagActual").html("Mis Solicitudes");
    blockUISystem();
    /* list paginas*/
    $("#btnforward").off().on('click', function () {
        if (maxPage > 1) {
            if (reqListPage < maxPage) {
            	reqListPage += 1;
            	listRequests();
            }
        }
    });

    $("#btnbacward").off().on('click', function () {
        if (maxPage > 1) {
            if (reqListPage > 1) {
            	reqListPage -= 1;
                listRequests();
            }
        }
    });
        
    $("#btnbacwardInit").off("click").on('click', function () {
        if (maxPage > 1) {
            if (reqListPage > 1) {
                reqListPage = 1;
                listRequests();
            }
        }
    });
    
    $("#btnforwardEnd").off("click").on('click', function () {
        if (maxPage > 1) {
            if (reqListPage < maxPage) {
                reqListPage = maxPage;
                listRequests();
            }
        }
    }); 

    $("#numPag").html(reqListPage);
    // Tooltip
    $('[data-popup="tooltip"]').tooltip();    
    listRequests();
});

function eventsEditModal(){
    /************************************* Cerrar Modal Edit   ************************************/
    $(".btnCloseModalEditRequest").off('click').on("click",function(events){
        $(".modalEditRequest").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "zoomOut").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
            $('body').attr("style","padding-right: 0px;");
            $(this).modal('hide');
            $(this).removeClass("animated " + "zoomOut");
        });
        $('body').attr("style","padding-right: 0px;");
        events.preventDefault();
    });
}

function loadRequest(info){
    blockUISystem();
    linksWs["tRequest"] = linksWs["tRequests"].data[info];
    $("#divEditRequest").load("requestEdit.html?r="+Math.random(), function () {
        eventsEditModal();
    });    
    
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
    $('#tableListRequests').DataTable();

    // External table additions
    // ------------------------------

    // Add placeholder to the datatable filter option
    $('#tableListRequests input[type=search]').attr('placeholder','Filtrar...');
    
    
    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });    

    $(".menuList").off("click").on("click",function(){
        var ancla = $(this);
        idReq = ancla.attr("id").split("-");

        if(idReq[0] == "upd"){    
            $(".modalEditRequest").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "zoomIn").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                $('body').attr("style","padding-right: 0px;");
                $(this).removeClass("animated " + "zoomIn");
                loadRequest(idReq[1]);
                
            });                   
            
        }
        
    });    

    /* Nueva Solicitud */
    $('#linkAddRequest').off("click").on("click", function(){
        blockUISystem();
        $("#divRootContent").load("../vista/requestAdd.html?x="+Math.random(), function () {
        });
    });

    unblockUISystem();
}

function eachList(doneList){
    if(doneList != "" && doneList != 0){
        linksWs["tRequests"] = $.parseJSON(JSON.stringify(doneList.tRequest));
        if (linksWs["tRequests"].length > 0) {
            var rowNum = 0;
            var listReg = '';
            $.each(linksWs["tRequests"], function (reg, atributo) {

                if(atributo.ACTIVE == 1){
                    classActivo = 'label-success';
                    descripActivo = 'Activo';
                }else{
                    classActivo = 'label-danger';
                    descripActivo = 'Desactivado';
                }

                listReg += ''+
                '<tr>'+
                    '<td>'+atributo.t_product.PRODUCT_NAME+'</td>'+
                    '<td>'+atributo.TP_OPERATION+'</td>'+
                    '<td>'+atributo.QT_FROM+' a '+atributo.QT_TO+'</td>'+
                    '<td>'+atributo.t_um.UM_NAME+'</td>'+
                    '<td>'+atributo.PRICE_FROM+' a '+atributo.PRICE_TO+'</td>'+
                    '<td>'+atributo.t_currency.CURRENCY_NAME+'</td>'+
                    '<td class="text-center">'+
                        '<ul class="icons-list">'+
                            '<li class="dropdown">'+
                                '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>'+
                                '<ul class="dropdown-menu dropdown-menu-right">'+
                                    '<li><a href="#" id="upd-'+rowNum+'" class="menuList animation" data-animation="zoomIn" data-toggle="modal" data-target="#modalEditRequest"><i class="icon-pencil text-success-700"></i> Editar Solicitud</a></li>'+
                                '</ul>'+
                            '</li>'+
                        '</ul>'+
                    '</td>'+                    
                '</tr>';

                rowNum += 1;
            });
            $("#tableListRequests tbody").html(listReg);
            setTimeout(function(){ initEventsTable(); }, 1700);
        }               
    }else{
        unblockUISystem();
        swal({ title: "Mensaje!", text: 'No se encontraron <span style="color:#00ACC1">Registros<span>', type: "info", html: true});
    }
}

function listRequests(){
    blockUISystem();
    $.ajax({
        method: 'post',
        dataType:"json",
        url: root+"/TRequest/find.json?page="+reqListPage+"&user="+localStorage.getItem("user"), 
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
                eachList(doneList);
            }
            
        }else{
            unblockUISystem();
        }
    }); 
}

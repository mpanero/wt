var almListPage = 1;
var maxPage = 1;
var regNum = 1;
var counterBlock = 0;
var optsReg = null;
var wordFind = "";
var idAlm = null;
$(document).ready(function () {
    $("#pagActual").html("Mis Alarmas");
    /* list paginas*/
    $("#btnforward").off().on('click', function () {
        if (maxPage > 1) {
            if (almListPage < maxPage) {
            	almListPage += 1;
            	listAlarms();
            }
        }
    });

    $("#btnbacward").off().on('click', function () {
        if (maxPage > 1) {
            if (almListPage > 1) {
            	almListPage -= 1;
                listAlarms();
            }
        }
    });
        
    $("#btnbacwardInit").off("click").on('click', function () {
        if (maxPage > 1) {
            if (almListPage > 1) {
                almListPage = 1;
                listAlarms();
            }
        }
    });
    
    $("#btnforwardEnd").off("click").on('click', function () {
        if (maxPage > 1) {
            if (almListPage < maxPage) {
                almListPage = maxPage;
                listAlarms();
            }
        }
    });
    
    // Tooltip
    $('[data-popup="tooltip"]').tooltip(); 

    listAlarms();
    
});

function eventsEditModal(){
    
    /************************************* Cerrar Modal Edit   ************************************/
    $(".btnCloseModalViewAlarm").off('click').on("click",function(events){
        $(".modalViewAlarm").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeOutRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
            $('body').attr("style","padding-right: 0px;");
            $(this).removeClass("animated " + "fadeOutRight");
            $(this).modal('hide');
            
        });
        $('body').attr("style","padding-right: 0px;");
        events.preventDefault();
    });
}

function loadAlarm(info){
    blockUISystem();  
    linksWs["tAlarm"] = linksWs["tAlarms"][info];
    $("#divViewAlarm").load("alarmEdit.html?r="+Math.random(), function () {
        setTimeout(function(){ eventsEditModal(); }, 1700);
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
    $('#tableListAlarms').DataTable();

    // External table additions
    // ------------------------------

    // Add placeholder to the datatable filter option
    $('#tableListAlarms input[type=search]').attr('placeholder','Filtrar...');
    
    
    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });    


    $(".menuList").off("click").on("click",function(){
        var ancla = $(this);
        idAlm = ancla.attr("id").split("-");

        if(idAlm[0] == "upd"){     
            $(".modalViewAlarm").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeInRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                $('body').attr("style","padding-right: 0px;");
                $(this).removeClass("animated " + "fadeInRight");
                loadAlarm(idAlm[1]);
                
            });                 
            
        }
        
    });  
   
    unblockUISystem();
}

function eachListAlarm(){

    if (linksWs["tAlarms"].length > 0) {

        var listReg = '';
        var classColor = '';
        var rowNum = 0;
        var htmlCpart = "";
        var status = "";
        var statusClass = "";
        $.each(linksWs["tAlarms"], function (reg, atributo) {

            if(atributo.ACTIVE == 1){
                statusClass = "text-success-700";
                status = "ACTIVA";
            }else{
                statusClass = "text-danger-700";
                status = "INACTIVA";
            }

            listReg += ''+
            '<tr id="upd-'+rowNum+'" class="menuList animation" data-animation="fadeInRight" data-toggle="modal" data-target="#modal_ViewAlarm" >'+
                '<td >'+
                    '<div class="media-left media-middle">'+
                        '<a class="btn border-indigo-800 text-indigo-800 btn-flat btn-rounded btn-icon btn-xs"><i class="icon-feed"></i></a>'+
                   '</div>'+
                    '<div class="media-left">'+
                        '<div class=""><a href="#" class="text-default text-semibold">'+atributo.t_products_price.PRODUCT_NAME+'</a></div>'+
                        '<div class="text-muted text-size-small">'+
                            '<span class="status-mark border-yellow position-left"></span>'+
                            ''+atributo.TYPE_PRICE+''+
                        '</div>'+
                    '</div>'+
                '</td>'+
                '<td><span class="text-regular">'+atributo.PRICE_FROM+' a '+atributo.PRICE_TO+'</span></td>'+
                '<td><span class="text-regular">'+atributo.t_currency.CURRENCY_NAME+'</span></td>'+
                '<td><span class="text-regular">'+((atributo.t_places_price != null) ? atributo.t_places_price.PLACE_NAME : 'Sin Informacion') +'</span></td>'+
                '<td><span class="'+statusClass+'">'+status+'</span></td>'+
            '</tr>';
            rowNum += 1;
        });
        $("#tableListAlarms tbody").html(listReg);
        setTimeout(function(){ initEventsTable(); }, 3000);
    }else{
        unblockUISystem();
        swal({ title: "Mensaje!", text: 'No se encontraron <span style="color:#00ACC1">Registros<span>', type: "info", html: true});
    }
}


function listAlarms(){
    blockUISystem();
    $.ajax({
        method: 'post',
        dataType:"json",
        url: root+"/TAlarms/find.json?page="+almListPage+"&user="+localStorage.getItem("user"), 
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false
    }).done(function(doneList){
        if (evalResponseAjax(doneList)) {
            if(typeof (doneList.tAlarm) === 'string' ){
                unblockUISystem();
                swal({ title: "Error!", text: doneList.tAlarm,  type: "error", html: true });
            }else{
                if(doneList != "" && doneList != 0){
                    linksWs["tAlarms"] = $.parseJSON(JSON.stringify(doneList.tAlarm));                
                    eachListAlarm();
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

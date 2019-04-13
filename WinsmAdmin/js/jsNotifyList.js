var ntfListPage = 1;
var maxPage = 1;
var regNum = 1;
var counterBlock = 0;
var optsReg = null;
var wordFind = "";
var idNtf = null;
$(document).ready(function () {
    $("#pagActual").html("Notificaciones");
    // Tooltip
    $('[data-popup="tooltip"]').tooltip(); 

    listNotifys();
    
});

function eventsEditModal(){
    
    /************************************* Cerrar Modal Edit   ************************************/
    $(".btnCloseModalViewNotify").off('click').on("click",function(events){
        $(".modalViewNotify").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeOutRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
            $('body').attr("style","padding-right: 0px;");
            $(this).removeClass("animated " + "fadeOutRight");
            $(this).modal('hide');
            
        });
        $('body').attr("style","padding-right: 0px;");
        var table = $('#tableListNotifys').DataTable();
        
        //clear datatable
        table.clear().draw();
        
        //destroy datatable
        table.destroy();
        blockUISystem();
        showNotifys();
        eachListNotify();        
        events.preventDefault();
    });
}

function loadNotify(info){
    blockUISystem();  
    linksWs["tNotify"] = linksWs["tNotifys"][info];
    $("#divViewNotify").load("notifyEdit.html?r="+Math.random(), function () {
        setTimeout(function(){ eventsEditModal(); }, 1700);
    });
}

function initEventsTableNotifys(){
    
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
    $('#tableListNotifys').DataTable();

    // External table additions
    // ------------------------------

    // Add placeholder to the datatable filter option
    $('#tableListNotifys input[type=search]').attr('placeholder','Filtrar...');
    
    
    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });    


    $(".menuList").off("click").on("click",function(){

        var ancla = $(this);
        idNtf = ancla.attr("id").split("-");
        
        if(idNtf[0] == "upd"){     
            $(".modalViewNotify").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeInRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                $('body').attr("style","padding-right: 0px;");
                $(this).removeClass("animated " + "fadeInRight");
                loadNotify(idNtf[1]);
                
            });                 
            
        }
        
    });  
   
    unblockUISystem();
}

function eachListNotify(){

    if (linksWs["tNotifys"].length > 0) {

        var listReg = '';
        var classColor = '';
        var rowNum = 0;
        var htmlCpart = "";
        var status = "";
        var statusClass = "";
        $.each(linksWs["tNotifys"], function (reg, atributo) {

            if(atributo.READ_NOTIF == 1){
                statusClass = "text-success-700";
                status = "Leida";
            }else{
                statusClass = "text-danger-700";
                status = "No leida";
            }
            var resDate = atributo.DT_CREATED.split("T");
            listReg += ''+
            '<tr id="upd-'+rowNum+'" class="menuList animation" data-animation="fadeInRight" data-toggle="modal" data-target="#modal_ViewNotify" >'+
                '<td >'+
                    '<div class="media-left media-middle">'+
                        '<a class="btn border-indigo-800 text-indigo-800 btn-flat btn-rounded btn-icon btn-xs"><i class="icon-feed"></i></a>'+
                   '</div>'+
                    '<div class="media-left">'+
                        '<div class=""><a href="#" class="text-default text-semibold">'+atributo.DESCRIPTION+'</a></div>'+
                        '<div class="text-muted text-size-small">'+
                            '<span class="status-mark border-yellow position-left"></span>'+
                        '</div>'+
                    '</div>'+
                '</td>'+
                '<td><span class="text-regular">'+resDate[0]+'</span></td>'+
                '<td><span class="'+statusClass+'">'+status+'</span></td>'+
            '</tr>';
            rowNum += 1;
        });
        $("#tableListNotifys tbody").html(listReg);
        setTimeout(function(){ initEventsTableNotifys(); }, 3000);
    }else{
        unblockUISystem();
        swal({ title: "Mensaje!", text: 'No se encontraron <span style="color:#00ACC1">Registros<span>', type: "info", html: true});
    }
}


function listNotifys(){
    blockUISystem();
    if(linksWs["tNotifys"] != null){
        eachListNotify();
    }else{
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TNotifications/find.json?page="+ntfListPage+"&user="+localStorage.getItem("user"), 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneList){
            if (evalResponseAjax(doneList)) {
                if(typeof (doneList.tNotification) === 'string' ){
                    unblockUISystem();
                    swal({ title: "Error!", text: doneList.tNotification,  type: "error", html: true });
                }else{
                    if(doneList != "" && doneList != 0){
                        linksWs["tNotifys"] = $.parseJSON(JSON.stringify(doneList.tNotification));                
                        eachListNotify();
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

}

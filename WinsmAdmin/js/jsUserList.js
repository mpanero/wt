var usrListPage = 1;
var maxPage = 1;
var regNum = 1;
var counterBlock = 0;
var optsReg = null;
var wordFind = "";
var idUsr = null;
$(document).ready(function () {
    $("#pagActual").html("Usuario");
    blockUISystem();
    /* list paginas*/
    $("#btnforward").off().on('click', function () {
        if (maxPage > 1) {
            if (usrListPage < maxPage) {
            	usrListPage += 1;
            	listUsers();
            }
        }
    });

    $("#btnbacward").off().on('click', function () {
        if (maxPage > 1) {
            if (usrListPage > 1) {
            	usrListPage -= 1;
                listUsers();
            }
        }
    });
        
    $("#btnbacwardInit").off("click").on('click', function () {
        if (maxPage > 1) {
            if (usrListPage > 1) {
                usrListPage = 1;
                listUsers();
            }
        }
    });
    
    $("#btnforwardEnd").off("click").on('click', function () {
        if (maxPage > 1) {
            if (usrListPage < maxPage) {
                usrListPage = maxPage;
                listUsers();
            }
        }
    });

    $("#numPag").html(usrListPage);
    // Tooltip
    $('[data-popup="tooltip"]').tooltip();    
    listUsers();
});

function eventsEditModal(){
    /************************************* Cerrar Modal Edit   ************************************/
    $(".btnCloseModalEditUser").off('click').on("click",function(events){
        $(".modalEditUser").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "zoomOut").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
            $('body').attr("style","padding-right: 0px;");
            $(this).modal('hide');
            $(this).removeClass("animated " + "zoomOut");
        });
        $('body').attr("style","padding-right: 0px;");
        events.preventDefault();
    });
}

function loadUser(info){
    blockUISystem();
    linksWs["tUser"] = linksWs["tUsers"].data[info];
    $("#divEditUser").load("userEdit.html?r="+Math.random(), function () {
        eventsEditModal();
    });    
    
}

function initEventsTable(){
    
    // Table setup
    // ------------------------------
    // Initialize responsive functionality
    $('#tableListUsers').footable({
       breakpoints: {
            phone: 540,
            tablet: 600
       }
    }).bind({
    '   footable_breakpoint' : function(e) {
            //console.log(e.breakpoint);      
        }
    });

    $(".menuList").off("click").on("click",function(){
        var ancla = $(this);
        idUsr = ancla.attr("id").split("-");

        if(idUsr[0] == "upd"){    
            $(".modalEditUser").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "zoomIn").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                $('body').attr("style","padding-right: 0px;");
                $(this).removeClass("animated " + "zoomIn");
                loadUser(idUsr[1]);
                
            });                   
            
        }
        
    });    

    /* Nueva Solicitud */
    $('#linkAddUser').off("click").on("click", function(){
        blockUISystem();
        $("#divRootContent").load("../vista/userAdd.html?x="+Math.random(), function () {
        });
    });

    unblockUISystem();
}

function eachList(doneList){
    if(doneList != "" && doneList != 0){
        linksWs["tUsers"] = $.parseJSON(JSON.stringify(doneList.tUser));
        if (linksWs["tUsers"]) {

            var pages = parseInt(linksWs["tUsers"].rows) / 10;
            var intPages = pages.toFixed(0);
            var decPage = pages - intPages;
            if (decPage > 0)
                intPages++;
            
            maxPage = intPages;
            if(usrListPage >= 10){
                if(maxPage < 10){
                    //$("#numPag").attr("style","font-size: 14px;"); //style="font-size: 10px; padding: 6px 7px;"
                    //$("#linkPag").attr("style","font-size: 10px; padding: 5px 3px;"); //style="font-size: 10px; padding: 6px 7px;"    
                }else{
                    $("#numPag").attr("style","font-size: 14px;"); //style="font-size: 10px; padding: 6px 7px;"
                    $("#linkPag").attr("style","font-size: 10px; padding: 7px 2px;"); //style="font-size: 10px; padding: 6px 7px;"
                }
                
            }else{
                if(maxPage < 10){
                    $("#numPag").attr("style","font-size: 16px;");//style="font-size: 10px; padding: 3px 9px;"
                    $("#linkPag").attr("style","font-size: 10px; padding: 5px 7px;");//style="font-size: 10px; padding: 3px 9px;"    
                }else{
                    $("#numPag").attr("style","font-size: 16px;");//style="font-size: 10px; padding: 3px 9px;"
                    $("#linkPag").attr("style","font-size: 10px; padding: 6px 5px;");//style="font-size: 10px; padding: 3px 9px;"
                }
                
            }

            $("#numPag").html(usrListPage);
            $("#maxPag").html(maxPage);                    
            //$("#totalPages").html(maxPage);
            var listReg = '';
            
            //regNum = ((usrListPage*10)-9);
            regNum = parseInt(linksWs["tUsers"].rows) - ((usrListPage*10) - 10);
            var classActivo = '';
            var descripActivo = '';
            if (usrListPage < maxPage){

            }
            var rowNum = 0;
            $.each(linksWs["tUsers"].data, function (reg, atributo) {

                if(atributo.ACTIVE == 1){
                    classActivo = 'label-success';
                    descripActivo = 'Activo';
                }else{
                    classActivo = 'label-danger';
                    descripActivo = 'Desactivado';
                }
                listReg += ''+
                '<tr>'+
                    '<td>'+atributo.NAME+'</td>'+
                    '<td>'+atributo.SURNAME+'</td>'+
                    '<td>'+atributo.MAIL+'</td>'+
                    '<td>'+atributo.PHONE_MOBILE_NUM+'</td>'+
                    '<td>'+atributo.t_place.PLACE_NAME+'</td>'+
                    '<td class="text-center">'+
                        '<ul class="icons-list">'+
                            '<li class="dropdown">'+
                                '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>'+
                                '<ul class="dropdown-menu dropdown-menu-right">'+
                                    '<li><a href="#" id="upd-'+rowNum+'" class="menuList animation" data-animation="zoomIn" data-toggle="modal" data-target="#modalEditUser"><i class="icon-pencil text-success-700"></i> Editar Usuario</a></li>'+
                                '</ul>'+
                            '</li>'+
                        '</ul>'+
                    '</td>'+                    
                '</tr>';

                regNum -= 1;
                rowNum += 1;
            });
            $("#tableListUsers tbody").html(listReg);
            initEventsTable();
        }               
    }else{
        unblockUISystem();
        if(usrListPage >= 10){
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

function listUsers(){
    blockUISystem();
    $.ajax({
        method: 'post',
        dataType:"json",
        url: root+"/TUser/page.json?page="+usrListPage+"&user="+localStorage.getItem("user"), 
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false
    }).done(function(doneList){
        if (evalResponseAjax(doneList)) {
            if(typeof (doneList.tUser) === 'string' ){
                unblockUISystem();
                swal({ title: "Error!", text: doneList.tUser,  type: "error", html: true });
            }else{
                eachList(doneList);
            }
            
        }else{
            unblockUISystem();
        }
    }); 
}

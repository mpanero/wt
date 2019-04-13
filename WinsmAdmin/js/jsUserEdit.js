var counterBlockEditUsr = 0;
var tUser = null;
$(document).ready(function(){    
    $("#pagActual").html("Actualizar Usuario");
    getLugares();
});   

function loadEventsEditUsr(){
    
    /*** add new ***/
    $(".btnRenew").off("click").on("click",function(events){
        blockUISystem();
        if(validacionMaestra("#formEditUser")){
            $('#formEditUser').off("submit").one("submit", function(e){
                //var datosFormEmp = new FormData(this);
                var datosFormEmp = $('#formEditUser').serialize();
                $.ajax( {
                    method: 'post',
                    dataType:"json",
                    url: root+"/TUser/editUser.json?"+datosFormEmp, 
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
                            text: 'Usuario Actualizado <span style="color:#4CAF50">Correctamente<span>',
                            type: "success",
                            confirmButtonColor: "#66BB6A",
                            confirmButtonText: "Ok!",
                            html:true
                        },
                        function(isConfirm){
                            if (isConfirm) {
                                linksWs["tUsers"].data[idUsr[1]] = doneNew.tUser;
                                /****************************** Cerrar Modal Edit   *************************/
                                $(".modalEditUser").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "zoomOut").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                                    $('body').attr("style","padding-right: 0px;");
                                    $(this).modal('hide');
                                    $(this).removeClass("animated " + "zoomOut");
                                    $("#divRootContent").load("./usersList.html?x="+Math.random(), function () {
                                        
                                    });                                    
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
            $("#formEditUser").trigger("submit");
        }else{
            unblockUISystem();
        }
    });
    checkedElementView()
    
}

function showUser(){
    if(linksWs["tUser"] != null){
        $.each(linksWs["tUser"], function (atributo, value) { 
            /*alert(atributo+":"+value);*/

            if (value !== null && value != "") {
                if ($("input[name*='"+atributo+"']").length || $("#" + atributo + "").length) {

                    if ($("#" + atributo + "").is("select")) {

                        $('#' + atributo + ' option[value="' + value + '"]').prop('selected', true);

                    }else{
                        if($("#" + atributo + "").is("span")) {
                            $("#" + atributo + "").html(value);
                        }else{

                            if($("input[name*='"+atributo+"']").attr('type') == "radio"){
                                $("input[name*='"+atributo+"'][value='"+value+"']").prop('checked',true);
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
        }); 
             
        applyMask();    
        loadEventsEditUsr();
    }else{
        swal({ title: "Mensaje!", text: 'Recargue la pagina', type: "error", html: true});
    }

    
}

function validateLoadComplete() {
    counterBlockEditUsr++;
    if (counterBlockEditUsr === 1) {
        counterBlockEditUsr = 0;
        //applyMask();
        setTimeout(function () {
            showUser();
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
        $("#ID_PLACE").html(optRep);
        
        // Select2 selects
        $('#ID_PLACE').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });  

        validateLoadComplete();
    });

}
var counterBlockEditNot = 0;
var tNotify = null;
$(document).ready(function(){    
    
    $("#pagActual").html("Detalle Notificacion");
    validateLoadComplete();
});   

function deleteNotify(){
    blockUISystem();
    var datosSend = "";
    $.each(linksWs["tNotify"], function(nombre,data) { 
        //console.log(nombre+"(d:n)"+data);
        if(String(nombre).indexOf("t_") == -1){
            datosSend +="&"+String(nombre)+"="+data;
        }
    });           
    
    $.ajax( {
        method: 'post',
        dataType:"json",
        url: root+"/TNotifications/deleteNotify.json?"+datosSend, 
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
            linksWs["tNotifys"].splice(idNtf[1], 1);
            //alert("Requests: "+linksWs.requests.length );
            linksWs["tNotifys"].length -= 1; 
            if(linksWs["tNotifys"].length < 1){
                linksWs["tNotifys"] = null;
                swal({
                    title: "Mensaje!",
                    text: 'No posee Notificaciones <span style="color:#4CAF50"><span>',
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
                    text: 'Notificacion Borrada con <span style="color:#4CAF50">"éxito"<span>',
                    type: "success",
                    confirmButtonColor: "#66BB6A",
                    confirmButtonText: "Ok!",
                    html:true
                },
                function(isConfirm){
                    if (isConfirm) {
                        $(".modalViewNotify").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeOutRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                            $('body').attr("style","padding-right: 0px;");
                            $(this).removeClass("animated " + "fadeOutRight");
                            $(this).modal('hide');
                            var table = $('#tableListNotifys').DataTable();
                            
                            //clear datatable
                            table.clear().draw();
                            
                            //destroy datatable
                            table.destroy();
                            blockUISystem();
                            showNotifys();
                            eachListNotify();
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

function updNotify(){     
    blockUISystem();    
    var datosSend = "";
    datosSend = $('#formEditNotify').serialize();
    //datosSend = $('#formEditNotify').serialize();
    $.ajax( {
        method: 'post',
        dataType:"json",
        url: root+"/TNotifications/readNotify.json?"+datosSend, 
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false,
        processData: false,
        contentType: false
    }).done(function(doneNew){
       
        if (evalResponseAjax(doneNew)) {
            linksWs["tNotifys"][idNtf[1]] = doneNew.tNotification[0];
            setTimeout(function(){
            
                unblockUISystem();
                $(".modalViewAlarm").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "fadeOutRight").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                    $('body').attr("style","padding-right: 0px;");
                    $(this).removeClass("animated " + "fadeOutRight");
                    $(this).modal('hide');
                    eachListNotify();
                });
                $('body').attr("style","padding-right: 0px;");            
            
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

function loadEventsEditNtf(){
    
    /************************************* Delete Notify **********************************************/
    $("#btnDeleteNotify").off('click').on("click",function(events){
        deleteNotify();
    }); 
    updNotify();
}

function showEditNotify(){
    if(linksWs["tNotify"] != null){
        $.each(linksWs["tNotify"], function (atributo, value) { 
            //alert(atributo+":"+value);

            if (value !== null && value != "") {
                if ($("input[name*='"+atributo+"']").length || $("#" + atributo + "").length) {

                    if ($("#" + atributo + "").is("select")) {

                        $('#' + atributo + ' option[value="' + value + '"]').prop('selected', true);

                    }else{
                        if($("#" + atributo + "").is("span")) {
                            $("#" + atributo + "").html(value);
                        }else{

                            if($("input[name*='"+atributo+"']").attr('type') == "radio"){
                                $("input[name*='"+atributo+"'][value='"+value+"']").prop('checked',true).trigger("change");
                                $("input[name*='"+atributo+"'][value='"+value+"']").prop('checked',"checked").trigger("change");
                            }else{
                                if($("input[name*='"+atributo+"']").attr('type') == "checkbox"){
                                    $("input[name*='"+atributo+"']").val(value);
                                    value == 1 ? $("input[name*='"+atributo+"']").trigger('click') : null;
                                    //$("input[name*='"+atributo+"']").change();  
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
            }            
        }); 
              
        applyMask();    
        loadEventsEditNtf();
    }else{
        swal({ title: "Mensaje!", text: 'Recargue la pagina', type: "error", html: true});
    }

    
}

function validateLoadComplete() {
    counterBlockEditNot++;
    if (counterBlockEditNot === 1) {
        counterBlockEditNot = 0;
        //applyMask();
        setTimeout(function () {
            showEditNotify();
        }, 1700);
        
    }

}

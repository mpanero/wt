var counterBlockEditUsr = 0;
var tUser = null;
$(document).ready(function(){    
    $("#pagActual").html("Actualizar Usuario");

   /* $(".cuit").off().on("blur",function(){
        if(esCUITValida($(this).val())){
            alert("Valido CUIT");
        }else{
            alert("CUIT No valido");
        }
        
    });
    */
    /**
     * on shown localidades
     */
    $('#modalLocalidades').on('shown.bs.modal', function (e) {
        // do something...
        $('#ID_LOCALITY').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });  
        getProvincias();
        eventsLocalityModal();
    });

    
    /**
     * on hidden localidades
     */
    $('#modalLocalidades').on('hidden.bs.modal', function (e) {
        // do something...
    });

    $("#ID_PLACE_NAME").off().on("click",function(evt){
        /*$(".modalLocalidades").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "zoomIn").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
            $('body').attr("style","padding-right: 0px;");
            $(this).removeClass("animated " + "zoomIn");
            eventsLocalityModal();          
        });*/
        $('#modalLocalidades').modal({
            show: true
        });
        evt.preventDefault();         
    });   

    $("#produc").off().on("click",function(evt){
        if($(this).is(':checked')) {  
            //alert("Está activado");  
            $("#Q1").prop("disabled", false); 
            $("#Q2").prop("disabled", false); 
        } else {  
            //alert("No está activado");  
            $("#Q1").prop("disabled", true); 
            $("#Q2").prop("disabled", true); 
            $("#Q1").val("");
            $("#Q2").val("");

        }  
    });

    $("#compra").off().on("click",function(evt){
        if($(this).is(':checked')) {  
            //alert("Está activado"); 
            $("#Q3").prop("disabled", false); 
        } else {  
            //alert("No está activado"); 
            $("#Q3").prop("disabled", true);  
            $("#Q3").val("");
        }  
    });    

    $("#ID_PROVINCE").off("change").on("change",function(e){
        var provi = $(this).val();
        if(provi != ""){
            getLocalidades(provi);
        }else{
            
        }
        
    }); 
    
    $("#ID_LOCALITY").off("change").on("change",function(e){
        var localitySelect = $( "#ID_LOCALITY option:selected" ).val();
        if(localitySelect != ""){
           $("#ID_PLACE_NAME").val( $( "#ID_LOCALITY option:selected" ).text());
           $("#ID_PLACE").val( $( "#ID_LOCALITY option:selected" ).val());
        }else{
            $("#ID_PLACE_NAME").val("");
            $("#ID_PLACE").val("");           
        }
        
    }); 

    getActividades();
});   

function eventsLocalityModal(){
    /************************************* Cerrar Modal Loclaidades   ************************************/
    $(".btnCloseModalLocalidades").off('click').on("click",function(events){
        $("#modalLocalidades").modal('hide');
        $('#modalEditUser').css('overflow', 'scroll');
        //events.preventDefault();
    });
}

function loadEventsEditUsr(){
    
    /*** add new ***/
    $(".btnRenew").off("click").on("click",function(events){
        blockUISystem();
        if(validacionMaestra("#formEditUser")){
            if($("#produc").is(':checked')) {  
            } else {  
                $("#Q1").val("");
                $("#Q2").val("");
            } 
            if($("#compra").is(':checked')) {  
            } else {  
                $("#Q3").val("");
            }              
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
                    swal({ title: "Mensaje!", text: msg+" Please sign in again", type: "error", html: true});      
                });
                e.preventDefault();
            });
            $("#formEditUser").trigger("submit");
        }else{
            unblockUISystem();
        }
    });
    /*checkedElementView()*/
    customScroll("#divEditUser");
    initStyleCheckBox();
    initCheckSwitch();
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
                        if($('input[name="'+atributo+'[]"]').attr("type") == "checkbox"){
                            var valNew=String(value).split(',');
                            $('input[name="'+atributo+'[]"]').each(function(i,inputV){
                                if(jQuery.inArray($(inputV).val(), valNew) != -1){
                                    $(inputV).prop('checked', true);
                                }
                            });
                        }else{
                            if($("#" + atributo + "").is("span")) {
                                $("#" + atributo + "").html(value);
                            }else{
    
                                if($("input[name*='"+atributo+"']").attr('type') == "radio"){
                                    $("input[name*='"+atributo+"'][value='"+value+"']").prop('checked',true);
                                }else{
                                    if (typeof (value) === 'string') {
                                        if(value.match(/^\d{2}-\d{2}-\d{4} ([0-1]\d|2[0-3]):([0-5]\d):([0-5]\d)$/)) {
                                            dateF = value.split(" ");
                                            $("#" + atributo + "").val(dateF[0]);
                                        }else{
                                            if(value.match(/\d{4}-[01]\d-[0-3]\dT[0-2]\d:[0-5]\d:[0-5]\d(?:\.\d+)?Z?/)) {
                                                dateF = value.split("T");
                                                $("#" + atributo + "").val(dateF[0]);
                                            }else{
                                                if(value.match(/^\d{4}-\d{2}-\d{2}$/)) {
                                                    $("#" + atributo + "").val(value);
                                                }else{
                                                    $("#" + atributo + "").val(value);
                                                }
                                            }
                                            
                                        }
                                    }else{
                                        if(atributo == 'ID_PLACE'){
                                            $("#" + atributo + "").val(value);
                                            findLocality(value,function(dataLocality){
                                                
                                                $("#ID_PLACE_NAME").val(dataLocality[0].PLACE_NAME);
                                            });
                                            
                                        }else{
                                            if(atributo == 'Q1'){
                                                $("#produc").prop('checked', true);
                                                $('#produc').trigger('change');
                                                $("#" + atributo + "").val(value);
                                                $("#" + atributo + "").prop("disabled", false); 
                                            }else{
                                                if(atributo == 'Q2'){
                                                    $("#produc").prop('checked', true);
                                                    $('#produc').trigger('change');
                                                    $("#" + atributo + "").val(value);
                                                    $("#" + atributo + "").prop("disabled", false); 
                                                }else{
                                                    if(atributo == 'Q3'){
                                                        $("#compra").prop('checked', true);
                                                        $('#compra').trigger('change');
                                                        $("#" + atributo + "").val(value);
                                                        $("#" + atributo + "").prop("disabled", false); 
                                                    }else{
                                                        $("#" + atributo + "").val(value);
                                                        
                                                    }
                                                }
                                                    
                                            }
                                            
                                        }
                                       
                                    }
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


function getLocalidades(provincia){
    blockUISystem();
    findLocalitys(provincia, function(localities){
        var optRep = '<option value="">Seleccione</option>';
            
        if(localities.length > 0){
            $.each(localities, function (index, locality) {
                optRep += '<option value="'+locality.ID_PLACE+'" >'+locality.PLACE_NAME+'</option>';
            });          
        }
        $("#ID_LOCALITY").html(optRep);
        
        // Select2 selects
        $('#ID_LOCALITY').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });  
        unblockUISystem();
    });

}

function getProvincias(){
    blockUISystem();
    findProvinces("", function(provinces){
        var optRep = '<option value="">Seleccione</option>';
            
        if(provinces.length > 0){
            $.each(provinces, function (index, province) {
                optRep += '<option value="'+province.ID_PROVINCE+'" >'+province.PROVINCE_NAME+'</option>';
            });          
        }
        $("#ID_PROVINCE").html(optRep);
        
        // Select2 selects
        $('#ID_PROVINCE').select2({
            minimumResultsForSearch: 1,
            dropdownCssClass: 'border-indigo',
            containerCssClass: 'border-indigo text-indigo-700 select-xs'
        });  
        unblockUISystem();
    });

}

function getActividades(){
    findActivity("", function(activities){
        var optAct = '<div class="col-md-4">';
        var divActivity = '';    
        if(activities.length > 0){
            var countCheck = 1;
            $.each(activities, function (index, activity) {
                optAct += ''+
                '<div class="checkbox">'+
                    '<label>'+
                        '<input id="actv-'+activity.ID_ACTIVITY+'" name="ACTIVITY[]" type="checkbox" class="control-custom" value="'+activity.ID_ACTIVITY+'">'+
                        activity.ACTIVITY_NAME+
                    '</label>'+
                '</div>';                        
                if(countCheck < 2){}else{
                    divActivity +=  optAct +'</div>';
                    optAct = '<div class="col-md-4">';
                    countCheck = 0;
                }
                countCheck += 1;
            });

            divActivity += optAct +'</div>';        
        }
        
        $("#divActivity").html(divActivity);

        validateLoadComplete();
    });

}
var counterBlock = 0;
$(document).ready(function () {  
    getActividades();

    $("#MAIL").on("focusout",function(){
        var maiNew = $(this).val();
        var exist = false
        $.each(linksWs["idsUsers"], function (reg, atributo) {
            if(maiNew == atributo.MAIL){
                exist = true;
            }
            
        });

        if(exist){
            $(".btnAddNew").attr("disabled",true);
            swal({
                title: "Mensaje!",
                text: 'Correo <span style="color:#FF3333">YA Registrado ingrese otro diferente<span>',
                type: "error",
                confirmButtonColor: "#FF3333",
                confirmButtonText: "Ok!",
                html:true
            },
            function(isConfirm){
                if (isConfirm) {

                }
            });             
        }else{
            $(".btnAddNew").attr("disabled",false);
        }
        
    });

     
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

    $("#produc").off("click").on("click",function(evt){
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

    $("#compra").off("click").on("click",function(evt){
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
    
});

function eventsLocalityModal(){
    /************************************* Cerrar Modal Loclaidades   ************************************/
    $(".btnCloseModalLocalidades").off('click').on("click",function(events){
        $("#modalLocalidades").modal('hide');
        $('#modalRegiUser').css('overflow', 'scroll');
        //events.preventDefault();
    });
}

function eventForm(){

    /*** add new ***/
    $(".btnAddNew").off("click").on("click",function(events){
        blockUISystem();
        if(validacionMaestraLogin("#newUser")){
            $('#newUser').off("submit").one("submit", function(e){
                //var datosFormEmp = new FormData(this);
                var datosFormEmp = $('#newUser').serialize();
                $.ajax( {
                    method: 'post',
                    dataType:"json",
                    url: root+"/TUser/addUser.json?"+datosFormEmp, 
                    headers: {
                        'Authorization':"Bearer "+localStorage.getItem('accessToken')
                    },                
                    cache:false,
                    processData: false,
                    contentType: false
                }).done(function(doneNew){
                    unblockUISystem();
                    if (evalResponseAjax(doneNew)) {
                        if( typeof (doneNew.tRequest) === 'string'){
                            swal({
                                title: "Mensaje!",
                                text: 'Usuario <span style="color:#FF3333">NO Registrado<span>',
                                type: "error",
                                confirmButtonColor: "#FF3333",
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
                                text: 'Su usuario se ha creado con éxito. <span style="color:#4CAF50">La activación se realizará a la brevedad<span>',
                                type: "success",
                                confirmButtonColor: "#66BB6A",
                                confirmButtonText: "Ok!",
                                html:true
                            },
                            function(isConfirm){
                                if (isConfirm) {
                                    $(".modalRegiUser").off("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend").addClass("animated " + "zoomOut").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
                                        $('body').attr("style","padding-right: 0px;");
                                        $(this).modal('hide');
                                        $(this).removeClass("animated " + "zoomOut");
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
                e.preventDefault();
            });
            $("#newUser").trigger("submit");
        }else{
            unblockUISystem();
        }
    });       
}

function validateLoadComplete() {
    counterBlock++;
    if (counterBlock === 1) {
        counterBlock = 0;
        applyMask();
        initStyleCheckBox();
        initCheckSwitch();
        setTimeout(function () {
            unblockUISystem();
            eventForm();
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
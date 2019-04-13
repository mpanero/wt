var counterBlock = 0;
$(document).ready(function () {  
    getLugares();
});

function eventForm(){

    /*** add new ***/
    $(".btnAddNew").off("click").on("click",function(events){
        blockUISystem();
        if(validacionMaestra("#newUser")){
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
                                text: 'Usuario Registrada <span style="color:#4CAF50">Correctamente<span>',
                                type: "success",
                                confirmButtonColor: "#66BB6A",
                                confirmButtonText: "Ok!",
                                html:true
                            },
                            function(isConfirm){
                                if (isConfirm) {
                                    $("#divRootContent").load("./userList.html?x="+Math.random(), function () {});
                                    //resetForm('#newRequest');
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
    
        setTimeout(function () {
            unblockUISystem();
            eventForm();
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
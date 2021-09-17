var toDate = new Date();
var dias = ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado"];
var meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
var mesesDig = ["01","02","03","04","05","06","07","08","09","10","11","12"];
var diasMesesDig = ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"];
// 60.000 milseg = 60 seg = 1 min, 2.400.000 milseg = 2.400 seg = 40 min
var time = 2400000;
//var time = 60000;
var timerest = 60; // 1 min 
var timeDown = 2400; // 40 min 
var displayText = "60 seg.";
var validateSession = null;
var countD = null;
/** server */
//var root = "../../core";
/** localhost */
var root = "../../wtagro_wt";

var linksWs = {
    formSubmit: null,
    mercados:"",
    Tpro:"", 
    prod:"", 
    cosechas:"",
    tPrices:"",
    monedas:"",
    precref:"",
    positions:"",
    ums:"",
    paytypes:"",
    places:"",
    tentrega:"",
    calidad:"",
    operaciones:"",
    toperaciones:"",
    pricePlaces:"",
    prodPrice:"",
    provinces:"",
    tProvince:"",
    localities:"",
    tLocality:"",
    tActivities:"",
    tActivity:"",
    tNotify:null,
    tNotifys:null,
    tRequest:null,
    tRequests:null,
    tTrade:null,
    tTrades:null,
    tAlarm:null,
    tAlarms:null,
    tUser:null,
    tUsers:null,
    idsUsers:null
};
$(document).ready(function () {
    findUsers();
});

function showNotifys(){
    if(linksWs["tNotifys"] != null){
        if(linksWs["tNotifys"].length > 0){
            var numNotify = linksWs["tNotifys"].length;
            var htmlNotify = ''+
                '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'+
                '<i class="icon-bubbles4"></i>'+
                '<span class="visible-xs-inline-block position-right">Notificaciones</span>'+
                '<span class="badge bg-warning-400">'+numNotify+'</span>'+
            '</a>'+
            '<div class="dropdown-menu dropdown-content width-350">'+
                '<div class="dropdown-content-heading">'+
                    'Notificaciones'+
                '</div>'+
                '<ul class="media-list dropdown-content-body">';
            var reg = 0;
            $.each(linksWs["tNotifys"], function (reg, atributo) {
                if(reg < 3){
                    var resDate = atributo.DT_CREATED.split("T");
                    htmlNotify += ''+
                        '<li class="media">'+
                            '<div class="media-left"><img src="../assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></div>'+
                            '<div class="media-body">'+
                                '<a class="media-heading listNotifys">'+
                                    '<span class="text-semibold">'+atributo.DESCRIPTION+'</span>'+
                                    '<span class="media-annotation pull-right">'+resDate[0]+'</span>'+
                                '</a>'+
                                '<span class="text-muted">'+(atributo.READ_NOTIF == 1 ? 'Leida' : 'No leida')+'...</span>'+
                            '</div>'+
                        '</li>';
    
                }
                reg += 1;
            });
            htmlNotify += ''+
                '</ul>'+
                '<div class="dropdown-content-footer">'+
                    '<a data-popup="tooltip" title="Ver todas" class="listNotifys"><i class="icon-menu display-block"></i></a>'+
                '</div>'+
            '</div>';
            $("#liNotify").html(htmlNotify);

            // Initialize nicescroll on tablets+
            $(".media-list").niceScroll({
                mousescrollstep: 100,
                cursorcolor: '#ccc',
                cursorborder: '',
                cursorwidth: 5,
                hidecursordelay: 307,
                autohidemode: 'scroll',
                railpadding: { right: 0.5 }
            });
            // Tooltip
            $('[data-popup="tooltip"]').tooltip();  
            $("#liNotify").attr("style","display:block;");       
            
            $(".listNotifys").off("click").on("click",function(){
                $("#ulMenu li").removeClass("active");
                blockUISystem();
                $("#pagActual").html("Notificaciones");
                $("#divRootContent").load("../vista/notifyList.html?x="+Math.random(), function () {
                    
                });
            });

        }else{
            $("#liNotify").attr("style","display:none;");
        }
    }else{
        $("#liNotify").attr("style","display:none;");
    }
}

function findNotifys() {

    $.ajax({
        method: 'post',
        dataType:"json",
        url: root+'/TNotifications/find.json', 
        data:{
            user:+localStorage.getItem('user')
        },
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false
    }).done(function(doneTnoti){
        if (evalResponseAjax(doneTnoti)) {
            var notifys = $.parseJSON(JSON.stringify(doneTnoti.tNotification));
            if(typeof notifys !== null && typeof notifys !== typeof undefined && typeof (notifys) !== 'string'){
                linksWs["tNotifys"] = notifys;
            }else{
                linksWs["tNotifys"] = null;
            }
        }else{
            linksWs["tNotifys"] = null;
        }           
        showNotifys();
    }); 
}

function valueRange(obj,val){
    //console.log("validando: "+val);
    if(val.toString().match(/^[0-9]+$/)){
        var min = isBlank(obj.attr("ngMin")) ? 0 : obj.attr("ngMin");
        var max = isBlank(obj.attr("ngMax")) ? Infinity : obj.attr("ngMax");
        //console.log("min: "+min+"/ max:"+max);
        if (isBlank(val)) {
            return false;
        }

        if (!isBlank(val) && parseInt(val) <= parseInt(max) && parseInt(val) >= parseInt(min) ) {
            obj.attr("style","border-bottom: solid 1px #388E3C;"); 
            return true;
        }else{
            obj.focus();
            obj.attr("style","border-bottom: solid 1px #f00;"); 
            return false;
        }
    }else{
        obj.attr("style","border-bottom: solid 1px #f00;"); 
        return false;
    }     
}

function activatedOnClick(){
    $(".range").keyup(function (e) {
        var esIE = (document.all);
        var obj = $(this);
        tecla = (esIE) ? event.keyCode : e.which;
        if (tecla !== 13) {
            valueRange(obj,this.value);
        } else {
            var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
            if (key !== 13) {
                valueRange(obj,this.value); 
            }
        }
    });
  
}

function isBlank(str) {
    var regexp = /^\s*$/;
    return (!str || regexp.test(str));
}

function dateFromMysql(mysql_string){ 
   var t, result = null;

   if( typeof mysql_string === 'string' )
   {
      t = mysql_string.split(/[- :]/);

      //when t[3], t[4] and t[5] are missing they defaults to zero
      result = new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);          
   }

   return result;   
}

function initCheckSwitch(){
    var elems = document.querySelectorAll('.switchery');
    for (var i = 0; i < elems.length; i++) {
        var switchery = new Switchery(elems[i]);
    }
}

function initStyleRadio(){
    // Indigo radios
    $(".radioBtn").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-indigo-800 text-indigo-800'
    }); 

}
function initStyleCheckBox(){
    // Custom color Checkboxes
    $(".control-custom").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-indigo-600 text-indigo-800'
    });
}
function updateStyleRadio(){
    //$(".radioBtn").uniform("refresh");
    $(".radioBtn").uniform({resetDefaultHtml: "Clear"});
    
}

function resetRadio(){
    $(".radioBtn").each(function() {
        // ...
        $(this).prop("checked",false);
        $(this).attr("checked",false);
    });
}

function countDown(){
    
    countD = setInterval(function(){  
       
        //$("#userN").html(timeDown);
        if(timeDown < 1){
            timerest--;
            if(timerest < 1){
                sessionLogout();
            }
        }else{
            timeDown--;
        }
    
        $('.sweet-alert > p > div').html(displayText.replace('60', timerest));    

    }, 1000);

}

function session_checking()
{

    swal({
        html: true,
        title: 'Sesi&oacute;n Agotada..!!',
        text: "Deseas continuar Logeado..? <div style='color:#FF3333'>60 seg.</div>",   
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#66BB6A',
        cancelButtonColor: '#FF3333',
        confirmButtonText: 'Si, Mantenme Logeado!',
        cancelButtonText: 'No, Cerrar Sesión!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger'
        },
        function(isConfirm){
            if (isConfirm) {
                /*timerest = 60; // 1 min
                timeDown = 2400; // 40 min
                clearInterval(countD);
                clearInterval(validateSession);*/
                validarSesion();
            } else {
                sessionLogout();
            }
    });
        
}

function initEditor(elemento, height){
    if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
    CKEDITOR.tools.enableHtml5Elements( document );

    CKEDITOR.config.height = height;
    CKEDITOR.config.width = 'auto';
    var wysiwygareaAvailable = isWysiwygareaAvailable(), isBBCodeBuiltIn = !! CKEDITOR.plugins.get( 'bbcode' );
    var editorElement = CKEDITOR.document.getById( elemento );

    // :(((
    if ( isBBCodeBuiltIn ) {
        editorElement.setHtml('');
    }

    // Depending on the wysiwygare plugin availability initialize classic or inline editor.
    if ( wysiwygareaAvailable ) {
        CKEDITOR.replace( elemento , {height: height} );
    } else {
        editorElement.setAttribute( 'contenteditable', 'true' );
        CKEDITOR.inline( elemento , {height: height});

        // TODO we can consider displaying some info box that
        // without wysiwygarea the classic editor may not work.
    }
}

function isWysiwygareaAvailable() {
    // If in development mode, then the wysiwygarea must be available.
    // Split REV into two strings so builder does not replace it :D.
    if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
        return true;
    }

    return !!CKEDITOR.plugins.get( 'wysiwygarea' );
}

function initAnimationModals(){

    // Toggle animations
    $("body").off("click").on("click", ".animation", function (e) {

        // Get animation class from "data" attribute
        var animation = $(this).data("animation");
        var target = $(this).attr("data-target"); 
        // Apply animation once per click
        $(target).addClass("animated " + animation).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
            $(this).removeClass("animated " + animation);            
        });
        e.preventDefault();
    });

}   

function letterIcon(){
    // Grab first letter and insert to the icon
    $(".table tr").each(function (i) {

        // Title
        var $title = $(this).find('.letter-icon-title'),
            letter = $title.eq(0).text().charAt(0).toUpperCase();

        // Icon
        var $icon = $(this).find('.letter-icon');
            $icon.eq(0).text(letter);
    });
}    

function truncateString(cadena, cadenaLeng, cadenaDots) {
    cadenaDots = (cadenaDots !== undefined) ? cadenaDots : "...";
    var newString = "";
    newString = (cadena.length > cadenaLeng) ? cadena.substring(0, (cadenaLeng - cadenaDots.length)) + cadenaDots : cadena;
    
    //alert(newString);
    
    return newString;
}

function destroyCKEDITORInstancias(){
    for ( instance in CKEDITOR.instances ){
        CKEDITOR.instances[instance].destroy(true);  
    }
}

function updateCKEDITORInstancias(){
    for ( instance in CKEDITOR.instances ){
        CKEDITOR.instances[instance].updateElement();    
    }
}

function blockUISystem(){
    $.blockUI({
        baseZ: 999990, 
        message: '<span><i class="icon-spinner4 spinner position-left"></i>&nbsp; Por favor Espere...</span>',
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            color: '#900',
            padding: 0,
            backgroundColor: 'transparent',
            zIndex:999990
        }
    });    
}

function unblockUISystem(){
    $.unblockUI();
}

function blockUIElement(element){
    $(element).block({ 
        message: '<span><i class="icon-spinner4 spinner position-left"></i>&nbsp; Por favor Espere...</span>',
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            color: '#900',
            padding: 0,
            backgroundColor: 'transparent'
        }
    });    
}

function unblockUIElement(element){
    $(element).unblock();
}

function applyMask() {
    $("#spanToday").html(dias[toDate.getDay()]+", "+toDate.getDate()+" de "+meses[toDate.getMonth()]+" del "+toDate.getFullYear() );
    
    $('.money').maskMoney({thousands:'.', decimal:',', allowZero:false});
    
    $('.codOficio').mask('####');
    
    $('.codPtc').mask('####');
    
    $('.civ').mask('########');

    $('.codsica').mask('######');

    $('.rif').mask('Z#########', {
        translation: {
            Z: { pattern: /[v|V|j|J|g|G|E|e]/ }
        }
    });

    $('.phoneHome').mask('ASYZ-#######', {
        translation: {
            A: {  pattern: /[0]/ },
            S: {  pattern: /[2]/ },
            Y: {  pattern: /[6|7]/ },
            Z: {  pattern: /[1-7]/ }
        }
    });

    $('.phoneCel').mask('ASYZ-#######', {
        translation: {
            A: {  pattern: /[0]/ },
            S: {  pattern: /[4]/ },
            Y: {  pattern: /[1|2]/ },
            Z: {  pattern: /[2|4|6]/ }
        }
    });
    
    $('.codMinuta').mask('DG-MR-'+toDate.getFullYear().toString().substr(-2)+'-NNNN', {
        translation: {
            N: { pattern: /[\d{4}]/ }
        }
    });

    // Basic options
    $('.pickadate').each(function() {
        var val = $(this).val();
        //date = moment(val).toDate();
        var date = "";
        if(val != "" && val != undefined && val != 0){
            if(val.match(/^\d{4}-\d{2}-\d{2}$/)){
                date = new Date(val.split("-")[0], parseInt(val.split("-")[1])-1, val.split("-")[2]);
            }else{
                if(val.match(/^\d{2}-\d{2}-\d{4}$/)){
                    date = new Date(val.split("-")[2], parseInt(val.split("-")[1])-1, val.split("-")[0]);
                }
            }
            
        }
        //alert(date);
        $(this).pickadate({
            monthsFull: [ 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre' ],
            monthsShort: [ 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic' ],
            weekdaysFull: [ 'domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado' ],
            weekdaysShort: [ 'dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb' ],
            today: 'Hoy',
            clear: 'Borrar',
            close: 'Cerrar',
            format: 'dddd d !de mmmm !del yyyy',
            formatSubmit: 'yyyy-mm-dd',
            onStart: function() {
                this.set('select', date); // Set to current date on load en error probar {}
                this.render(true); // Refresh the picker date on load
            }
        });
    });

    // Basic options
    $('.pickadateClear').each(function() {
        
        $(this).pickadate({
            monthsFull: [ 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre' ],
            monthsShort: [ 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic' ],
            weekdaysFull: [ 'domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado' ],
            weekdaysShort: [ 'dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb' ],
            today: 'Hoy',
            clear: 'Borrar',
            close: 'Cerrar',
            format: 'dddd d !de mmmm !del yyyy',
            formatSubmit: 'yyyy-mm-dd'
            
        });

    });
    
    // Basic options
    $('.pickadateBirthday').each(function() {
        var val = $(this).val();
        //date = moment(val).toDate();
        var date = "";
        var dateF = null;

        if(val != "" && val != undefined && val != 0){
            if(val.match(/^\d{4}-\d{2}-\d{2}$/)){
                date = new Date(val.split("-")[0], parseInt(val.split("-")[1])-1, val.split("-")[2]);
            }else{
                if(val.match(/^\d{2}-\d{2}-\d{4}$/)){
                    date = new Date(val.split("-")[2], parseInt(val.split("-")[1])-1, val.split("-")[0]);
                }else{
                    if(val.match(/^\d{2}-\d{2}-\d{4} ([0-1]\d|2[0-3]):([0-5]\d):([0-5]\d)$/)){
                        dateF = val.split(" ");
                        date = new Date(dateF[0].split("-")[2], parseInt(dateF[0].split("-")[1])-1, dateF[0].split("-")[0]);
                    }
                }
            }

            $(this).pickadate({
                monthsFull: [ 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre' ],
                monthsShort: [ 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic' ],
                weekdaysFull: [ 'domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado' ],
                weekdaysShort: [ 'dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb' ],
                today: 'Hoy',
                clear: 'Borrar',
                close: 'Cerrar',
                format: 'dddd d !de mmmm !del yyyy',
                formatSubmit: 'yyyy-mm-dd',
                selectMonths: true,
                selectYears: 70,
                max: true,
                onStart: function() {
                    this.set('select', date); // Set to current date on load en error probar {}
                    this.render(true); // Refresh the picker date on load
                }                 
                
            });
        }else{
            $(this).pickadate({
                monthsFull: [ 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre' ],
                monthsShort: [ 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic' ],
                weekdaysFull: [ 'domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado' ],
                weekdaysShort: [ 'dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb' ],
                today: 'Hoy',
                clear: 'Borrar',
                close: 'Cerrar',
                format: 'dddd d !de mmmm !del yyyy',
                formatSubmit: 'yyyy-mm-dd',
                selectMonths: true,
                selectYears: 70,
                max: true               
                
            });      
        }      

    });

    // Basic options
    $('.pickadateLoad').each(function() {
        var val = $(this).val();
        //date = moment(val).toDate();
        var date = "";
        var dateF = null;

        if(val != "" && val != undefined && val != 0){
            if(val.match(/^\d{4}-\d{2}-\d{2}$/)){
                date = new Date(val.split("-")[0], parseInt(val.split("-")[1])-1, val.split("-")[2]);
            }else{
                if(val.match(/^\d{2}-\d{2}-\d{4}$/)){
                    date = new Date(val.split("-")[2], parseInt(val.split("-")[1])-1, val.split("-")[0]);
                }else{
                    if(val.match(/^\d{2}-\d{2}-\d{4} ([0-1]\d|2[0-3]):([0-5]\d):([0-5]\d)$/)){
                        dateF = val.split(" ");
                        date = new Date(dateF[0].split("-")[2], parseInt(dateF[0].split("-")[1])-1, dateF[0].split("-")[0]);
                    }
                }
            }

            $(this).pickadate({
                monthsFull: [ 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre' ],
                monthsShort: [ 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic' ],
                weekdaysFull: [ 'domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado' ],
                weekdaysShort: [ 'dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb' ],
                today: 'Hoy',
                clear: 'Borrar',
                close: 'Cerrar',
                format: 'dddd d !de mmmm !del yyyy',
                formatSubmit: 'yyyy-mm-dd',
                onStart: function() {
                    this.set('select', date); // Set to current date on load en error probar {}
                    this.render(true); // Refresh the picker date on load
                }            
            });            
            
        }else{
            $(this).pickadate({
                monthsFull: [ 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre' ],
                monthsShort: [ 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic' ],
                weekdaysFull: [ 'domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado' ],
                weekdaysShort: [ 'dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb' ],
                today: 'Hoy',
                clear: 'Borrar',
                close: 'Cerrar',
                format: 'dddd d !de mmmm !del yyyy',
                formatSubmit: 'yyyy-mm-dd'  
            });
        }




    });

    // Time picker
    $('.timer').each(function() {
        var val = $(this).attr("placeholder");
        //$(this).destroy();
        //date = moment(val).toDate();
        var date = "";
        if($(this).AnyTime_noPicker($(this).attr("id"))){
            if(val != "" && val != undefined && val != 0){
                $(this).AnyTime_picker({
                    format: "%H:%i",
                    labelTitle: val,
                    labelHour: "Hora", 
                    labelMinute: "Minuto"
                });
            }            
        }else{
            if(val != "" && val != undefined && val != 0){
                $(this).AnyTime_picker({
                    format: "%H:%i",
                    labelTitle: val,
                    labelHour: "Hora", 
                    labelMinute: "Minuto"
                });
            }
        } 
          
    }); 

    // Select2 select
    // ------------------------------
    $('.select').select2({
        minimumResultsForSearch: 1,
        dropdownCssClass: 'border-indigo',
        containerCssClass: 'border-indigo text-indigo-700'
    });    

    // Checkboxes, radios
    //$(".styled").uniform({ radioClass: 'choice' });    

    setTimeout(function(){ unblockUISystem(); }, 3000);
    
}

function registrarEnter(idEmisor, idSiguiente, isClick) {
    
    $("#" + idEmisor).keypress(function (e) {
        var esIE = (document.all);
        tecla = (esIE) ? event.keyCode : e.which;
        if (tecla === 13) {
            if (isClick) {
                var obj = document.getElementById(idSiguiente);
                if (obj) {
                    obj.click();
                }
            } else {
                $("#" + idSiguiente).focus();
            }
        } else {
            var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
            if (key === 13) {
                if (isClick) {
                    var obj = document.getElementById(idSiguiente);
                    if (obj) {
                        obj.click();
                    }
                }
                else {
                    $("#" + idSiguiente).focus();
                }
            }
        }
    });
}

function registrarEnterFunction(idEmisor, nombreFuncion) {
    $("#" + idEmisor).keypress(function (e) {
        var esIE = (document.all);
        tecla = (esIE) ? event.keyCode : e.which;
        if (tecla === 13) {
            window[nombreFuncion](); 
            
        } else {
            var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
            if (key === 13) {
                window[nombreFuncion](); 
            }
        }
    });
}

function mostrarFechaActual() {
    var d = new Date();
    var dayname = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
    var monthname = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    var resp = "";
    resp += dayname[d.getDay()];
    resp += ', ';
    resp += d.getDate();
    resp += ' de ';
    resp += monthname[d.getMonth()];
    resp += ' de ';
    resp += d.getFullYear();

    return resp;
}

function evalResponseAjax(response) {
	if (typeof (response) === 'string') {
	    if (response.substring(0, 5) === "<br /") {
	        showGeneralError(response);
	        return false;
	    }
	    if (response.substring(0, 5) === ("ERROR")) {
	        showGeneralError(response);
	        return false;
	    }
	    if (response.substring(0, 5) === ("<h4><")) {
	        showGeneralError(response);
	        return false;
	    }
	    if (response.substring(0, 5).toLowerCase() === ("selec")) {
            showGeneralError(response);
            return false;
        }        
        if (response.substring(0, 5) === ("Expir")) {
            showSessionError();
            return false;
        }
        
	}
    return true;
}

function showGeneralError(menssage) {
	swal({ title: "Mensaje!", text: 'Error en el servidor: '+menssage+'', type: "error", html: true});
}


function showSessionError(menssage) {
	swal({ title: "Información del Sistema!", text: 'Sesion <span style="color:#FF3333">Expirada</span>', type: "warning", html: true});
	window.location = "../index.html";
}


function resetForm(form) {
    $(form)[0].reset();
    $(form).each (function(){
        this.reset();
        var ids = $(this).attr("id");
        //alert("mas"+ids);
        if ($("#"+ids).is("select")) {
           
            $('#'+ids).val(null).trigger('change');
            $('#'+ids).select2('refresh');
            
        }
    });
    $.fn.select2.defaults.reset();  
}

function validarSesion() {
	
	$.ajax({
        data: {
        	accion:'VS'
        },
        type: 'get',
        url: '../control/ControlUsuario.php',
        success: function (response) {
        	if (evalResponseAjax(response)) {
        		if(response == "0"){
        			showSessionError("");
        		}else{
        			/* Futuro bloqueo de menu*/
                    clearInterval(countD);
                    clearInterval(validateSession);
                    timerest = 60; // 1 min
                    timeDown = 2400; // 40 min                    
                	//datosUsuario();	
        		}
        		
        	}
        }

    });
    
}

function datosUsuario() {
    $('.userWell').html(localStorage.getItem('username'));
}

function sessionLogout() {
    blockUISystem();
    clearInterval(countD);
    clearInterval(validateSession);
	$.ajax({
        method: 'post',
        url: root+"/TUser/logout"+'.json', 
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false,
        success: function (response) {
            localStorage.setItem('accessToken',null);
            localStorage.setItem('user',null);
            localStorage.setItem('username',null);
        	window.location = "../index.html";
        }

    });

}

function initTooltipOptions(){
    if($('ul.select2-puntosCuenta-results li').length){
        $('ul.select2-puntosCuenta-results li').tooltip({
            title: function() {
                return '<div class="tooltip"><div class="bg-teal"><div class="tooltip-arrow"></div><div class="tooltip-inner">'+$(this).next().attr("title")+'</div></div></div>'
            },
        });          
    }
}

/************************************************** geters ***************************************************/
function findLocality(pv, cbs) {
    
    $.ajax({
        method: 'post',
        dataType:"json",
        url: root+"/TLocality/load"+'.json?'+$.param({loc:pv}), 
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false
    }).done(function(doneLocalities){
        if (evalResponseAjax(doneLocalities)) {
            linksWs["tLocality"] = $.parseJSON(JSON.stringify(doneLocalities.tLocality));
            if(typeof linksWs["tLocality"] !== null && typeof linksWs["tLocality"] !== typeof undefined){
                cbs(linksWs["tLocality"]);
            }else{
                cbs("");
            }
        }else{
            cbs("");
        }           
        
    }).fail(function (jqXHR, textStatus, errorThrown) {
        //unblockUISystem();
        if(jqXHR.status == 401){
            swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
            sessionLogout();   
            cbs(""); 
        }else{
            if(jqXHR.status == 403){
                swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                sessionLogout();
                cbs("");
            }else{
                if(jqXHR.status == 404){
                    swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                    cbs("");
                }else{
                    if(jqXHR.status == 500){
                        swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                        cbs("");    
                    }
                }
            }
        }
        
    });

}

function findLocalitys(pv, cbs) {
    if(linksWs["localities"] != ""){
        cbs(linksWs["localities"]);
    }else{     
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TLocality/find"+'.json?'+$.param({provi:pv}), 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneLocalities){
            if (evalResponseAjax(doneLocalities)) {
                linksWs["localities"] = $.parseJSON(JSON.stringify(doneLocalities.tLocality));
                if(typeof linksWs["localities"] !== null && typeof linksWs["localities"] !== typeof undefined){
                    cbs(linksWs["localities"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findProvinces(pv, cbs) {
    if(linksWs["provinces"] != ""){
        cbs(linksWs["provinces"]);
    }else{     
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TProvince"+'.json', 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneProvinces){
            if (evalResponseAjax(doneProvinces)) {
                linksWs["provinces"] = $.parseJSON(JSON.stringify(doneProvinces.tProvince));
                if(typeof linksWs["provinces"] !== null && typeof linksWs["provinces"] !== typeof undefined){
                    cbs(linksWs["provinces"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findUsers(){
    $.ajax({
        method: 'post',
        dataType:"json",
        url: root+'/TUser/findUsers.json', 
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false
    }).done(function(doneUsersIds){
        if (evalResponseAjax(doneUsersIds)) {
            var users = $.parseJSON(JSON.stringify(doneUsersIds.tUser));
            if(typeof users !== null && typeof users !== typeof undefined && typeof (users) !== 'string'){
                linksWs["idsUsers"] = users;
            }else{
                
            }
        }else{
           
        }           
        
    }).fail(function (jqXHR, textStatus, errorThrown) {
        //unblockUISystem();
        if(jqXHR.status == 401){
            sessionLogout();   
        }else{
            if(jqXHR.status == 403){
                sessionLogout();
            }else{
                if(jqXHR.status == 404){
                }else{
                    if(jqXHR.status == 500){
                    }
                }
            }
        }
        
    });   
}

function findActivity(pv, cbs) {

    if(linksWs["tActivities"] != ""){
        cbs(linksWs["tActivities"]);
    }else{
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+'/TTypeActivity/index.json', 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneActivi){
            if (evalResponseAjax(doneActivi)) {
                linksWs["tActivities"] = $.parseJSON(JSON.stringify(doneActivi.tTypeActivity));
                if(typeof linksWs["tActivities"] !== null && typeof linksWs["tActivities"] !== typeof undefined && typeof (linksWs["tActivities"]) !== 'string'){
                    cbs(linksWs["tActivities"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
   
}

function resumenPrice(ind, cbs) {

    $.ajax({
        method: 'post',
        dataType:"json",
        url: root+'/TProductsPrice/resumen.json', 
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false
    }).done(function(doneRPrice){
        if (evalResponseAjax(doneRPrice)) {
            var resumen = $.parseJSON(JSON.stringify(doneRPrice.tProductsPrice));
            if(typeof resumen !== null && typeof resumen !== typeof undefined && typeof (resumen) !== 'string'){
                cbs(resumen);
            }else{
                cbs("");
            }
        }else{
            cbs("");
        }           
        
    }).fail(function (jqXHR, textStatus, errorThrown) {
        //unblockUISystem();
        if(jqXHR.status == 401){
            swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
            sessionLogout();   
            cbs(""); 
        }else{
            if(jqXHR.status == 403){
                swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                sessionLogout();
                cbs("");
            }else{
                if(jqXHR.status == 404){
                    swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                    cbs("");
                }else{
                    if(jqXHR.status == 500){
                        swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                        cbs("");    
                    }
                }
            }
        }
        
    });     
    
}

    
function resumenTrade(ind, cbs) {

    $.ajax({
        method: 'post',
        dataType:"json",
        url: root+'/TTrade/resumen.json', 
        data:{
            user:+localStorage.getItem('user')
        },
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false
    }).done(function(doneRTrad){
        if (evalResponseAjax(doneRTrad)) {
            var resumen = $.parseJSON(JSON.stringify(doneRTrad.tTrade));
            if(typeof resumen !== null && typeof resumen !== typeof undefined && typeof (resumen) !== 'string'){
                cbs(resumen);
            }else{
                cbs("");
            }
        }else{
            cbs("");
        }           
        
    }).fail(function (jqXHR, textStatus, errorThrown) {
        //unblockUISystem();
        if(jqXHR.status == 401){
            swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
            sessionLogout();   
            cbs(""); 
        }else{
            if(jqXHR.status == 403){
                swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                sessionLogout();
                cbs("");
            }else{
                if(jqXHR.status == 404){
                    swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                    cbs("");
                }else{
                    if(jqXHR.status == 500){
                        swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                        cbs("");    
                    }
                }
            }
        }
        
    });   
    
}

function resumenRequest(ind, cbs) {

    $.ajax({
        method: 'post',
        dataType:"json",
        url: root+'/TRequest/resumen.json', 
        data:{
            user:+localStorage.getItem('user')
        },
        headers: {
            'Authorization':"Bearer "+localStorage.getItem('accessToken')
        },                
        cache:false
    }).done(function(doneTpro){
        if (evalResponseAjax(doneTpro)) {
            var resumen = $.parseJSON(JSON.stringify(doneTpro.tRequest));
            if(typeof resumen !== null && typeof resumen !== typeof undefined && typeof (resumen) !== 'string'){
                cbs(resumen);
            }else{
                cbs("");
            }
        }else{
            cbs("");
        }           
        
    }).fail(function (jqXHR, textStatus, errorThrown) {
        //unblockUISystem();
        if(jqXHR.status == 401){
            swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
            sessionLogout();   
            cbs(""); 
        }else{
            if(jqXHR.status == 403){
                swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                sessionLogout();
                cbs("");
            }else{
                if(jqXHR.status == 404){
                    swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                    cbs("");
                }else{
                    if(jqXHR.status == 500){
                        swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                        cbs("");    
                    }
                }
            }
        }
        
    });    
    
}
    
function findProdPrice(pv, cbs) {
    if(linksWs["prodPrice"] != ""){
        cbs(linksWs["prodPrice"]);
    }else{     
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TProductsPrice/getall"+'.json', 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneProdPri){
            if (evalResponseAjax(doneProdPri)) {
                linksWs["prodPrice"] = $.parseJSON(JSON.stringify(doneProdPri.tProductsPrice));
                if(typeof linksWs["prodPrice"] !== null && typeof linksWs["prodPrice"] !== typeof undefined){
                    cbs(linksWs["prodPrice"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findPricePlace(pv, cbs) {
    if(linksWs["pricePlaces"] != ""){
        cbs(linksWs["pricePlaces"]);
    }else{     
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TTypePricePlaces/find"+'.json?'+$.param({type:'TYPE_PRICE_INFO'}), 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(donePriPla){
            if (evalResponseAjax(donePriPla)) {
                linksWs["pricePlaces"] = $.parseJSON(JSON.stringify(donePriPla.tTypePricePlaces));
                if(typeof linksWs["pricePlaces"] !== null && typeof linksWs["pricePlaces"] !== typeof undefined){
                    cbs(linksWs["pricePlaces"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findTOperaci(pv, cbs) {
    if(linksWs["toperaciones"] != ""){
        cbs(linksWs["toperaciones"]);
    }else{     
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TTypes/find"+'.json?'+$.param({type:'TYPE_PRICE_INFO'}), 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneTOpera){
            if (evalResponseAjax(doneTOpera)) {
                linksWs["toperaciones"] = $.parseJSON(JSON.stringify(doneTOpera.tTypes));
                if(typeof linksWs["toperaciones"] !== null && typeof linksWs["toperaciones"] !== typeof undefined){
                    cbs(linksWs["toperaciones"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findOperaci(pv, cbs) {
    if(linksWs["operaciones"] != ""){
        cbs(linksWs["operaciones"]);
    }else{     
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TTypes/find"+'.json?'+$.param({type:'OPERATION'}), 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneOpera){
            if (evalResponseAjax(doneOpera)) {
                linksWs["operaciones"] = $.parseJSON(JSON.stringify(doneOpera.tTypes));
                if(typeof linksWs["operaciones"] !== null && typeof linksWs["operaciones"] !== typeof undefined){
                    cbs(linksWs["operaciones"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findCalidad(pv, cbs) {
    if(linksWs["calidad"] != ""){
        cbs(linksWs["calidad"]);
    }else{     
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TTypes/find"+'.json?'+$.param({type:'TYPE_QUALITY'}), 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneCali){
            if (evalResponseAjax(doneCali)) {
                linksWs["calidad"] = $.parseJSON(JSON.stringify(doneCali.tTypes));
                if(typeof linksWs["calidad"] !== null && typeof linksWs["calidad"] !== typeof undefined){
                    cbs(linksWs["calidad"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findTEntrega(pv, cbs) {
    if(linksWs["tentrega"] != ""){
        cbs(linksWs["tentrega"]);
    }else{     
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TTypes/find"+'.json?'+$.param({type:'TYPE_DELIVERY'}), 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneTDeli){
            if (evalResponseAjax(doneTDeli)) {
                linksWs["tentrega"] = $.parseJSON(JSON.stringify(doneTDeli.tTypes));
                if(typeof linksWs["tentrega"] !== null && typeof linksWs["tentrega"] !== typeof undefined){
                    cbs(linksWs["tentrega"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findPlaces(pv, cbs) {
    if(linksWs["places"] != ""){
        cbs(linksWs["places"]);
    }else{     
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TPlace"+'.json', 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(donePlaces){
            if (evalResponseAjax(donePlaces)) {
                linksWs["places"] = $.parseJSON(JSON.stringify(donePlaces.tPlace));
                if(typeof linksWs["places"] !== null && typeof linksWs["places"] !== typeof undefined){
                    cbs(linksWs["places"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findTPago(pv, cbs) {
    if(linksWs["paytypes"] != ""){
        cbs(linksWs["paytypes"]);
    }else{      
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TTypes/find"+'.json?'+$.param({type:'TYPE_PAYMENT'}), 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(donePayTy){
            if (evalResponseAjax(donePayTy)) {
                linksWs["paytypes"] = $.parseJSON(JSON.stringify(donePayTy.tTypes));
                if(typeof linksWs["paytypes"] !== null && typeof linksWs["paytypes"] !== typeof undefined){
                    cbs(linksWs["paytypes"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findUnidad(pv, cbs) {
    if(linksWs["ums"] != ""){
        cbs(linksWs["ums"]);
    }else{      
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TUm/index"+'.json', 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneUms){
            if (evalResponseAjax(doneUms)) {
                linksWs["ums"] = $.parseJSON(JSON.stringify(doneUms.tUm));
                if(typeof linksWs["ums"] !== null && typeof linksWs["ums"] !== typeof undefined){
                    cbs(linksWs["ums"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findPosition(pv, cbs) {
    if(linksWs["positions"] != ""){
        cbs(linksWs["positions"]);
    }else{      
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TPosition/index.json", 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(donePosit){
            if (evalResponseAjax(donePosit)) {
                linksWs["positions"] = $.parseJSON(JSON.stringify(donePosit.tPosition));
                if(typeof linksWs["positions"] !== null && typeof linksWs["positions"] !== typeof undefined){
                    cbs(linksWs["positions"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findPriceRf(pv, cbs) {
    if(linksWs["precref"] != ""){
        cbs(linksWs["precref"]);
    }else{       
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TTypes/find"+'.json?'+$.param({type:'TYPE_PRICE_REF'}), 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(donePreRf){
            if (evalResponseAjax(donePreRf)) {
                linksWs["precref"] = $.parseJSON(JSON.stringify(donePreRf.tTypes));
                if(typeof linksWs["precref"] !== null && typeof linksWs["precref"] !== typeof undefined){
                    cbs(linksWs["precref"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findMonedas(pv, cbs) {
    if(linksWs["monedas"] != ""){
        cbs(linksWs["monedas"]);
    }else{     
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TCurrency"+'.json', 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneMone){
            if (evalResponseAjax(doneMone)) {
                linksWs["monedas"] = $.parseJSON(JSON.stringify(doneMone.tCurrency));
                if(typeof linksWs["monedas"] !== null && typeof linksWs["monedas"] !== typeof undefined){
                    cbs(linksWs["monedas"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findTPrices(pv, cbs) {
    if(linksWs["tPrices"] != ""){
        cbs(linksWs["tPrices"]);
    }else{      
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TTypes/find"+'.json?'+$.param({type:'TYPE_PRICE'}), 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneTpre){
            if (evalResponseAjax(doneTpre)) {
                linksWs["tPrices"] = $.parseJSON(JSON.stringify(doneTpre.tTypes));
                if(typeof linksWs["tPrices"] !== null && typeof linksWs["tPrices"] !== typeof undefined){
                    cbs(linksWs["tPrices"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findCosecha(pv, cbs) {
    if(linksWs["cosechas"] != ""){
        cbs(linksWs["cosechas"]);
    }else{    
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TTypes/find"+'.json?'+$.param({type:'TYPE_CROP'}), 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneCose){
            if (evalResponseAjax(doneCose)) {
                linksWs["cosechas"] = $.parseJSON(JSON.stringify(doneCose.tTypes));
                if(typeof linksWs["cosechas"] !== null && typeof linksWs["cosechas"] !== typeof undefined){
                    cbs(linksWs["cosechas"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    }
}

function findProduct(mk, tp, cbs) {
    /*if(linksWs["prod"] != "" && typeof linksWs["prod"] !== null && typeof linksWs["prod"] !== typeof undefined){
        cbs(linksWs["prod"]);
    }else{*/     
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TProduct/find"+'.json?'+$.param({ mk:mk, tp:tp }), 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneProd){
            if (evalResponseAjax(doneProd)) {
                linksWs["prod"] = $.parseJSON(JSON.stringify(doneProd.tProduct));
                if(typeof linksWs["prod"] !== null && typeof linksWs["prod"] !== typeof undefined && typeof linksWs["prod"] != "string"){
                    cbs(linksWs["prod"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });
    //}
}

function findTipoProducto(ind, cbs) {
    if(linksWs["Tpro"] != ""){
        cbs(linksWs["Tpro"]);
    }else{
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TCategoryProd"+'.json', 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneTpro){
            if (evalResponseAjax(doneTpro)) {
                linksWs["Tpro"] = $.parseJSON(JSON.stringify(doneTpro.tCategoryProd));
                //document.getElementById('captcha').src = 'lib/securimage2/securimage_show.php?' + Math.random();
                if(typeof linksWs["Tpro"] !== null && typeof linksWs["Tpro"] !== typeof undefined){
                    cbs(linksWs["Tpro"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });    
    }
}

function findTMarket(ind, cbs) {
    if(linksWs["mercados"] != ""){
        cbs(linksWs["mercados"]);
    }else{
        $.ajax({
            method: 'post',
            dataType:"json",
            url: root+"/TMarket"+'.json', 
            headers: {
                'Authorization':"Bearer "+localStorage.getItem('accessToken')
            },                
            cache:false
        }).done(function(doneMark){
            if (evalResponseAjax(doneMark)) {
                linksWs["mercados"] = $.parseJSON(JSON.stringify(doneMark.tMarket));
                //document.getElementById('captcha').src = 'lib/securimage2/securimage_show.php?' + Math.random();
                if(typeof linksWs["mercados"] !== null && typeof linksWs["mercados"] !== typeof undefined){
                    cbs(linksWs["mercados"]);
                }else{
                    cbs("");
                }
            }else{
                cbs("");
            }           
            
        }).fail(function (jqXHR, textStatus, errorThrown) {
            //unblockUISystem();
            if(jqXHR.status == 401){
                swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });
                sessionLogout();   
                cbs(""); 
            }else{
                if(jqXHR.status == 403){
                    swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                    sessionLogout();
                    cbs("");
                }else{
                    if(jqXHR.status == 404){
                        swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                        cbs("");
                    }else{
                        if(jqXHR.status == 500){
                            swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });
                            cbs("");    
                        }
                    }
                }
            }
            
        });    
    }
}

/****  Custom Scrollbar  ****/
/* Create Custom Scroll for elements like Portlets or Dropdown menu */
function customScroll(elemento) {
    if ($.fn.mCustomScrollbar) {
        //$('.withScroll').each(function() {
            $(elemento).mCustomScrollbar("destroy");
            var scroll_height = $(elemento).data('height') ? $(elemento).data('height') : 'auto';
            var data_padding = $(elemento).data('padding') ? $(elemento).data('padding') : 0;
            if ($(elemento).data('height') == 'window') {
                thisHeight = $(elemento).height();
                windowHeight = $(window).height() - data_padding - 50;
                if (thisHeight < windowHeight) scroll_height = thisHeight;
                else scroll_height = windowHeight;
            }
            $(elemento).mCustomScrollbar({
                scrollButtons: {
                    enable: false
                },
                autoHideScrollbar: $(elemento).hasClass('show-scroll') ? false : true,
                scrollInertia: 150,
                theme: "light",
                set_height: scroll_height,
                advanced: {
                    updateOnContentResize: true
                }
            });
        //});
    }
}
/* Create custom scroll for sidebar used for fixed sidebar */
function createSideScroll() {
    if ($.fn.mCustomScrollbar) {
        destroySideScroll();
        if (!$('body').hasClass('sidebar-collapsed') && !$('body').hasClass('sidebar-collapsed') && !$('body').hasClass('submenu-hover') && $('body').hasClass('fixed-sidebar')) {
            $('.sidebar-inner').mCustomScrollbar({
                scrollButtons: {
                    enable: false
                },
                autoHideScrollbar: true,
                scrollInertia: 150,
                theme: "light-thin",
                advanced: {
                    updateOnContentResize: true
                }
            });
        }
        if ($('body').hasClass('sidebar-top')) {
            destroySideScroll();
        }
    }
}

/* Destroy sidebar custom scroll */
function destroySideScroll() {
    $('.sidebar-inner').mCustomScrollbar("destroy");
}

function loadGeneral(ruta,datos) {
    $("#divRootContent").load(ruta+".html?r="+Math.random(), function () {
        saveDataGeneral(datos);
    });    
}

// Setup
function initScroll(elemento) {
    $(elemento).niceScroll({
        mousescrollstep: 100,
        cursorcolor: '#ccc',
        cursorborder: '',
        cursorwidth: 3,
        hidecursordelay: 100,
        autohidemode: 'scroll',
        horizrailenabled: false,
        preservenativescrolling: false,
        railpadding: {
            right: 0.5,
            top: 1.5,
            bottom: 1.5
        }
    });
}

    // Resize
function resizeScroll(elemento) {
    $(elemento).getNiceScroll().resize();
}

// Remove
function removeScroll(elemento) {
    $(elemento).getNiceScroll().remove();
    $(elemento).removeAttr('style').removeAttr('tabindex');
}
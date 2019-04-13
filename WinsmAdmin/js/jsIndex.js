$(document).ready(function () {
    $("#btnLogin").off().on("click",function () {
        enviarDatos();
    });
    //$('#captcha').on('dragstart', function(event) { /*event.preventDefault();*/  return false;});
    $("img").mousedown(function(){
        return false;
    });
    registrarEnter("username", "clave", false);
    registrarEnter("password", "captcha_code", false);
    registrarEnter("captcha_code", "btnLogin", true);    
    unblockUISystem();
});

function enviarDatos() {

    if (validacionMaestraLogin("#formLogin")) {
        blockUISystem();
        var datos = $("#formLogin").serialize();
        //var jsonData = CryptoJS.AES.encrypt(JSON.stringify($("#formLogin").serialize()), '714', {format: CryptoJSAesJson}).toString();
        $.ajax({
            data: datos,
            type: 'POST',
            dataType:"json",
            url: root+'/TUser/login'+'.json',
            cache:false
        }).done(function(response){
            if (evalResponseAjax(response)) {
                //alert(typeof (response.login));
                //alert("Login: "+JSON.stringify(response));
                
                //document.getElementById('captcha').src = 'lib/securimage2/securimage_show.php?' + Math.random();
                if(typeof response.login !== null && typeof response.login !== typeof undefined){

                    var token = $.parseJSON(JSON.stringify(response));
                    if (typeof (response.login) === 'string') {                    
                    //if($.type( new String(token.login) ) === "string"){
                        if(token.login == "allreadyLogin"){
                            unblockUISystem();
                            localStorage.setItem("accessToken","");        
                            localStorage.setItem("user","");        
                            //wsLogout();
                            //requestLogin(token.login);
                            swal({ title: "Atencio!", text: 'Sesion Expirada, Inicie Nuevamente',  type: "warning", html: true });                
                        }else{
                            unblockUISystem();
                            localStorage.setItem("accessToken","");        
                            localStorage.setItem("user","");        
                            //wsLogout();
                            //requestLogin(token.login);
                            swal({ title: "Atencio!", text: token.login+', Inicie Nuevamente',  type: "warning", html: true });                               
                        }

                    }else{
                        //linksWs.accessToken = token.login.token;
                        //linksWs.user = token.login.sub;
                        localStorage.setItem('accessToken',token.login.token);
                        localStorage.setItem('user',token.login.sub);
                        localStorage.setItem('rol',token.login.role);
                        localStorage.setItem('username',token.login.user);
                        window.location = "vista/home.html";
                        
                    }

                }else{
                    unblockUISystem();
                    swal({ title: "Error!", text: 'Datos Incorrecto',  type: "error", html: true });
                }                
            	
            }
        	
        }).fail(function (jqXHR, textStatus, errorThrown) {
            unblockUISystem();
            if(jqXHR.status == 401){
            	swal({ title: "Error!", text: 'Error 401: No Autorizado',  type: "error", html: true });    
            }else{
                if(jqXHR.status == 403){
                	swal({ title: "Error!", text: 'Error 403: Acceso Prohibido',  type: "error", html: true });    
                }else{
                    if(jqXHR.status == 404){
                    	swal({ title: "Error!", text: 'Error 404: Objeto No Localizado',  type: "error", html: true });    
                    }else{
                        if(jqXHR.status == 500){
                        	swal({ title: "Error!", text: 'Error 500: Interno',  type: "error", html: true });    
                        }
                    }
                }
            }
            
        });
    }

}
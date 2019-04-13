/* global angular, document, window */
angular.module('starter.controllers', ['ionic', 'ngMaterial', 'ui.router', 'ui.router.history','ionic-datepicker','angular-notification-icons'])
.config(function($mdThemingProvider) {
  $mdThemingProvider.theme('default')
    .primaryPalette('indigo')
    .accentPalette('indigo');
})
.controller('AppCtrl', function($scope, $ionicModal, $ionicPopover, $timeout,  $location, linksWs) {
    // Form data for the login modal
    /* $scope.loginData = {}; */
    var navIcons = document.getElementsByClassName('ion-navicon');
    for (var i = 0; i < navIcons.length; i++) {
        navIcons[i].addEventListener('click', function() {
            this.classList.toggle('active');
        });
    }

    $scope.hideNavBar = function() {
        document.getElementsByTagName('ion-nav-bar')[0].style.display = 'none';
    };

    $scope.showNavBar = function() {
        document.getElementsByTagName('ion-nav-bar')[0].style.display = 'block';
    };

    $scope.noHeader = function() {
        var content = document.getElementsByTagName('ion-content');
        for (var i = 0; i < content.length; i++) {
            if (content[i].classList.contains('has-header')) {
                content[i].classList.toggle('has-header');
            }
        }
    };

    $scope.setExpanded = function(bool) {
        $scope.isExpanded = bool;
    };

    $scope.setHeaderFab = function(location) {
        var hasHeaderFabLeft = false;
        var hasHeaderFabRight = false;

        switch (location) {
            case 'left':
                hasHeaderFabLeft = true;
                break;
            case 'right':
                hasHeaderFabRight = true;
                break;
        }

        $scope.hasHeaderFabLeft = hasHeaderFabLeft;
        $scope.hasHeaderFabRight = hasHeaderFabRight;
    };

    $scope.hasHeader = function() {
        var content = document.getElementsByTagName('ion-content');
        for (var i = 0; i < content.length; i++) {
            if (!content[i].classList.contains('has-header')) {
                content[i].classList.toggle('has-header');
            }
        }
    };

    $scope.hideHeader = function() {
        $scope.hideNavBar();
        $scope.noHeader();
    };

    $scope.showHeader = function() {
        $scope.showNavBar();
        $scope.hasHeader();
    };

    $scope.clearFabs = function() {
        var fabs = document.getElementsByClassName('button-fab');
        if (fabs.length && fabs.length > 1) {
            fabs[0].remove();
        }
    };    
    
})

.controller('InitCtrl', function($scope, $timeout, $rootScope, $state, $stateParams, $location, $ionicHistory, $history, $ionicPopup,  $ionicLoading, $mdDialog, ionicMaterialInk, linksWs) {
    
    $scope.$parent.clearFabs();
    
    $timeout(function() {
        $scope.$parent.hideHeader();
    }, 0);
    
    ionicMaterialInk.displayEffect();
    $ionicLoading.show({});
    $timeout(function() {
        if(window.localStorage.getItem("winSMTokenAccess") !== null && typeof window.localStorage.winSMTokenAccess !== typeof undefined  && window.localStorage.getItem("winSMTokenAccess") != ""){
            linksWs.accessToken = window.localStorage.getItem("winSMTokenAccess");
            linksWs.user = window.localStorage.getItem("winSMUserAccess");
            $ionicLoading.hide();
            $state.go('app.home');
        }else{
            wsLogout(function(requestLogout){
                $ionicLoading.hide();
                $state.go('app.login');
            });        
        }
    }, 1700);
})

.controller('LoginCtrl', function($scope, $timeout, $rootScope, $state, $stateParams, $location, $ionicHistory, $history, $ionicPopup,  $ionicLoading, $mdDialog, ionicMaterialInk, linksWs) {
    
    $scope.$parent.clearFabs();
    
    $timeout(function() {
        $scope.$parent.hideHeader();
    }, 0);
    
    ionicMaterialInk.displayEffect();
    $scope.formData = {};
    
    if(window.localStorage.getItem('remember')){
        $scope.formData.username = window.localStorage.getItem('remember_u');
        $scope.formData.password = window.localStorage.getItem('remember_p');
    }else{
        window.localStorage.setItem('remember', false);
        window.localStorage.setItem('remember_u', '');
        window.localStorage.setItem('remember_p', '');   
        $scope.formData.username = "";
        $scope.formData.password = "";        
    }
    
    $scope.validRemember = function(event){
        if($scope.formData.cb1){
            window.localStorage.setItem('remember', false);
            window.localStorage.setItem('remember_u', "");
            window.localStorage.setItem('remember_p', "");                   
        }else{
            window.localStorage.setItem('remember', true);
            window.localStorage.setItem('remember_u', $scope.formData.username);
            window.localStorage.setItem('remember_p', $scope.formData.password);            
        }
    }
    
    $scope.validData = function(valid,event) {
        event.preventDefault();
        if (valid) {
            $ionicLoading.show({});
            var datos = {username: $scope.formData.username,password: $scope.formData.password};          
            
            wsLogin(datos,function(requestLogin){
                //alert("calback response: "+JSON.stringify(responsePost));
                $ionicLoading.hide();
                if(requestLogin == 1){
                    //console.log(linksWs.accessToken);
                    $state.go('app.home');
                }else{
                    //console.log("requestLogin: "+requestLogin);
                    $ionicPopup.alert({
                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                        content: requestLogin,
                        type : 'button-dark',
                    }).then(function(res) {
                    });                    
                }
            });
            
        }else{
            $ionicPopup.alert({
                title: "Mensaje <i class='icon ion-close-circled error'></i>",
                content: "Faltan campos por llenar ",
                type : 'button-dark',
            }).then(function(res) {
            });            
        }
    };
    
    var originatorEv;
    $scope.openMenu = function($mdMenu, ev) {
      originatorEv = ev;
      $mdMenu.open(ev);
    };  
    
    $scope.exitApp = function(e) {
        e.preventDefault();
        ionic.Platform.exitApp();
    };   
    
    $scope.userAdd = function() {
        $state.go('app.userAdd');
    };
    
    $scope.newPass = function() {
        $state.go('app.newPass');
    };    
})
.controller('NewPassCtrl', function($scope, $timeout, $rootScope, $state, $stateParams, $location, $ionicHistory, $history, $ionicPopup,  $ionicLoading, $mdDialog, ionicMaterialMotion, ionicMaterialInk, linksWs) {
    
    $timeout(function() {
        $scope.$parent.hideHeader();
    }, 0); 
    
    $scope.cancelar = function() {
        $state.go('app.login');
    }; 
    
    $scope.formUser = {};  
    $scope.submitForm = function(valid) {  
        if (valid) {
            $ionicLoading.show({});
            
            var dataPass = [];
            
            angular.forEach(this.formUser, function(data, nombre) { 
                dataPass[nombre] = data;
            });
            
            //console.log(dataPostUser);
            onWsAction(linksWs.link_root+"/TUser/newPass.json",dataPass,function(responsePost){
                //alert("calback response: "+JSON.stringify(responsePost));
                $ionicLoading.hide();
                if(!isBlank(responsePost.data)){
                    if(angular.isString(responsePost.data.tUser)){
                        //console.log("143: "+responsePost.data.tRequest);
                        var alertPopup = $ionicPopup.alert({
                            title: "Mensaje <i class='icon ion-close-circled error'></i>",
                            content: "Error: "+responsePost.data.tUser,
                            type : 'button-dark',
                        }).then(function(res) {
                        });                         
                    }else{
                        var alertPopup = $ionicPopup.alert({
                            title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                            content: "Contrase&ntilde;a actualizada con &eacute;xito, Revice correo para activar su usuario nuevamente",
                            type : 'button-dark',
                        }).then(function(res) {
                            $history.back();
                        });                      
                    }
                }else{
                    var alertPopup = $ionicPopup.alert({
                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                        content: "Error: "+responsePost.data.tUser,
                        type : 'button-dark',
                    }).then(function(res) {
                    });                      
                    //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                }
            });            
        } else {
            $ionicPopup.alert({
                title: "Mensaje <i class='icon ion-close-circled error'></i>",
                content: "Faltan campos por llenar ",
                type : 'button-dark',
            }).then(function(res) {
            });             
            //console.log(JSON.stringify($scope.newRequest));
        }        
        
    };    
    
    $timeout(function() {
        ionicMaterialMotion.fadeSlideIn({
            selector: '.animate-fade-slide-in .item'
        });
    }, 200);
    // Activate ink for controller
    ionicMaterialInk.displayEffect();     
})

.controller('UserAddCtrl', function($scope, $timeout, $rootScope, $state, $stateParams, $location, $ionicHistory, $history, $ionicPopup,  $ionicLoading, ionicMaterialMotion, ionicMaterialInk, linksWs) {   
    
    $ionicLoading.show({});
    //$scope.actividades = ["PRODUCTOR AGROPECUARIO", "PRODUCTOR GANADERO", "ACTIVIDAD INDUSTRIAL", "CORREDOR", "COMERCIAL",  "OTRO"];
    var counterBlock = 0;
    
    $timeout(function() {
        $scope.$parent.hideHeader();
    }, 0); 
    
    $scope.cancelar = function() {
        $state.go('app.login');
    };
    
    function validateLoadComplete() {
        counterBlock += 1;
        if (counterBlock == 2) {
            $ionicLoading.hide();
            counterBlock = 0;
            // Set Motion
            $timeout(function() {
                ionicMaterialMotion.fadeSlideIn({
                    selector: '.animate-fade-slide-in .item'
                });
            }, 200);
            // Activate ink for controller
            ionicMaterialInk.displayEffect();            
        }else{
            //console.log("else validate: "+counterBlock);
        }
    } 
    
     
    if(!isBlank(linksWs.lu)){
        $scope.lugares = linksWs.lu;
        validateLoadComplete();      
    }else{
        onWsAction(linksWs.link_root+"/TPlace.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tPlace)){
                    //console.log(responsePost.data.tPlace);
                    validateLoadComplete();
                }else{  
                    linksWs.lu = responsePost.data.tPlace;
                    //console.log("167"+responsePost.data.tPlace);
                    $scope.lugares = responsePost.data.tPlace;
                    validateLoadComplete();
                }
            }else{
                //console.log(JSON.stringify(responsePost));    
                validateLoadComplete();
            }
        });
    }
     
    if(!isBlank(linksWs.at)){
        $scope.actividades = linksWs.at;
        validateLoadComplete();      
    }else{
        onWsAction(linksWs.link_root+"/TTypeActivity.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypeActivity)){
                    //console.log(responsePost.data.tTypeActivity);
                    validateLoadComplete();
                }else{  
                    linksWs.lu = responsePost.data.tTypeActivity;
                    //console.log("208"+responsePost.data.tTypeActivity);
                    $scope.actividades = responsePost.data.tTypeActivity;
                    validateLoadComplete();
                }
            }else{
                //console.log(JSON.stringify(responsePost));    
                validateLoadComplete();
            }
        });
    }    
     
    if(!isBlank(linksWs.ge)){
        $scope.generos = linksWs.ge;
        validateLoadComplete();      
    }else{
        onWsAction(linksWs.link_root+"/TGender.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tGender)){
                    //console.log(responsePost.data.tTypeActivity);
                    validateLoadComplete();
                }else{  
                    linksWs.ge = responsePost.data.tGender;
                    //console.log("208"+responsePost.data.tTypeActivity);
                    $scope.generos = responsePost.data.tGender;
                    validateLoadComplete();
                }
            }else{
                //console.log(JSON.stringify(responsePost));    
                validateLoadComplete();
            }
        });
    }    
    
    $scope.formUser = {};
    $scope.selects = [];

    $scope.toggle = function (item, list) {
        var idx = list.indexOf(item);
        if (idx > -1) {
          list.splice(idx, 1);
        }
        else {
          list.push(item);
        }
    };

    $scope.exists = function (item, list) {
        return list.indexOf(item) > -1;
    };
    
    $scope.submitForm = function(valid) {  
        if (valid) {
            $ionicLoading.show({});
            $scope.formUser.COMPANY = $scope.selects.toString();
            var dataPostUser = [];
            
            angular.forEach(this.formUser, function(data, nombre) { 
                dataPostUser[nombre] = data;
            });
            
            //console.log(dataPostUser);
            onWsAction(linksWs.link_root+"/TUser/newUser.json",dataPostUser,function(responsePost){
                //alert("calback response: "+JSON.stringify(responsePost));
                $ionicLoading.hide();
                if(!isBlank(responsePost.data)){
                    if(angular.isString(responsePost.data.tUser)){
                        //console.log("143: "+responsePost.data.tRequest);
                        var alertPopup = $ionicPopup.alert({
                            title: "Mensaje <i class='icon ion-close-circled error'></i>",
                            content: "Error: "+responsePost.data.tUser,
                            type : 'button-dark',
                        }).then(function(res) {
                        });                         
                    }else{
                        var alertPopup = $ionicPopup.alert({
                            title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                            content: "Usuario Registrado con &eacute;xito",
                            type : 'button-dark',
                        }).then(function(res) {
                            $history.back();
                        });                      
                    }
                }else{
                    var alertPopup = $ionicPopup.alert({
                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                        content: "Error: "+responsePost.data.tUser,
                        type : 'button-dark',
                    }).then(function(res) {
                    });                      
                    //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                }
            });            
        } else {
            $ionicPopup.alert({
                title: "Mensaje <i class='icon ion-close-circled error'></i>",
                content: "Faltan campos por llenar ",
                type : 'button-dark',
            }).then(function(res) {
            });             
            //console.log(JSON.stringify($scope.newRequest));
        }        
        
    };
    
    $scope.changeDate= function (elem, val) {   
        //alert("entro: "+elem+":"+val);
        $scope.formUser[elem] = val;
    }    
    
})
.controller('HomeCtrl', function($scope, $timeout, $rootScope, $state, $stateParams, $location, $ionicHistory, $history, $ionicPopup,  $ionicLoading, ionicMaterialInk, linksWs) {
    $scope.$parent.clearFabs();
    $timeout(function() {
        $scope.$parent.hideHeader();
    }, 0);
    
    ionicMaterialInk.displayEffect();

    $scope.newSolicitud = function() {
        $state.go('app.solicitud');
    };
    
    $scope.listSolicitud = function() {
        $state.go('app.lista');
    };
    
    $scope.listMercado = function() {
        $state.go('app.filtro');
    }; 
    
    $scope.listNegocio = function() {
        $state.go('app.negocio');
    };
    
    $scope.listAlarm = function() {
        $state.go('app.alarmaList');
    };
    
    $scope.listNotification = function() {
        $state.go('app.notifyList');
    };    

    $scope.listPrecios = function() {
        $state.go('app.priceList');
    };    

    $scope.chatList = function() {
        $state.go('app.chatList');
    };    
    
    $scope.logoutApp = function(e) {
        e.preventDefault();
        $ionicLoading.show({});
        wsLogout(function(requestLogout){
            if(requestLogout == 1){
                $ionicLoading.hide();
                $state.go('app.login');
            }
        });
    };
    
    var originatorEv;
    $scope.openMenu = function($mdMenu, ev) {
      originatorEv = ev;
      $mdMenu.open(ev);
    }; 
    
    $scroll = document.getElementsByClassName('myScroll');
    $spandNotif = document.getElementsByClassName('spandNotif');
    $history.clear();   

    angular.element($scroll).css({"height":((window.innerHeight/2)+9)+"pt", "margin-top": "-8pt"});
    
    
    $ionicLoading.show({});
    var counterBlock = 0;
    function validateLoadComplete() {
        counterBlock++;
        if (counterBlock === 14) {
            counterBlock = 0;
            $ionicLoading.hide();
        }
    } 
    
    function isVacio(str) {
        var regexp = /^\s*$/;
        return (!str || regexp.test(str));
    };
    
    if(!isVacio(linksWs.ql)){
        $scope.calidad = linksWs.ql;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_QUALITY'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isVacio(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.ql = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }
    
    if(!isVacio(linksWs.en)){
        $scope.tentrega = linksWs.en;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_DELIVERY'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isVacio(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.en = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    } 
    
    if(!isVacio(linksWs.pa)){
        $scope.tpago = linksWs.pa;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_PAYMENT'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isVacio(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.pa = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }     

    if(!isVacio(linksWs.co)){
        $scope.cosecha = linksWs.co;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_CROP'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isVacio(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.co = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }     

    if(!isVacio(linksWs.po)){
        $scope.posicion = linksWs.po;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TPosition/index.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isVacio(responsePost.data)){
                if(angular.isString(responsePost.data.tPosition)){
                    console.log("471: "+responsePost.data.tPosition);
                }else{  
                    linksWs.po = responsePost.data.tPosition;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }    

    if(!isVacio(linksWs.pr)){
        $scope.precref = linksWs.pr;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_PRICE_REF'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isVacio(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.pr = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }    
    
    if(!isVacio(linksWs.pc)){
        $scope.tprecios = linksWs.pc;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_PRICE'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isVacio(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("491: "+responsePost.data.tTypes);
                }else{  
                    linksWs.pc = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }    

    if(!isVacio(linksWs.me)){
        $scope.mercados = linksWs.me;
        validateLoadComplete();      
    }else{   
        onWsAction(linksWs.link_root+"/TMarket.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isVacio(responsePost.data)){
                if(angular.isString(responsePost.data.tMarket)){
                    console.log("468: "+responsePost.data.tMarket);
                }else{  
                    linksWs.me = responsePost.data.tMarket;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        });
    }

    if(!isVacio(linksWs.tp)){
        $scope.tproductos = linksWs.tp;
        validateLoadComplete();      
    }else{ 
        onWsAction(linksWs.link_root+"/TCategoryProd.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isVacio(responsePost.data)){
                if(angular.isString(responsePost.data.tCategoryProd)){
                    console.log("211: "+responsePost.data.tCategoryProd);
                }else{  
                    linksWs.tp = responsePost.data.tCategoryProd;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }

    if(!isVacio(linksWs.mo)){
        $scope.monedas = linksWs.mo;
        validateLoadComplete();      
    }else{     
        onWsAction(linksWs.link_root+"/TCurrency.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isVacio(responsePost.data)){
                if(angular.isString(responsePost.data.tCurrency)){
                    console.log("231: "+responsePost.data.tCurrency);
                }else{  
                    linksWs.mo = responsePost.data.tCurrency;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        });
    }

    if(!isVacio(linksWs.um)){
        $scope.ums = linksWs.um;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TUm.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isVacio(responsePost.data)){
                if(angular.isString(responsePost.data.tUm)){
                    console.log("251: "+responsePost.data.tUm);
                }else{  
                    linksWs.um = responsePost.data.tUm;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        });
    }

     if(!isVacio(linksWs.lu)){
        $scope.lugares = linksWs.lu;
        validateLoadComplete();      
    }else{
        onWsAction(linksWs.link_root+"/TPlace.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isVacio(responsePost.data)){
                if(angular.isString(responsePost.data.tPlace)){
                    console.log("271: "+responsePost.data.tPlace);
                }else{  
                    linksWs.lu = responsePost.data.tPlace;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        });
    }

    if(!isVacio(linksWs.op)){
        $scope.operaciones = linksWs.op;
        validateLoadComplete();      
    }else{
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'OPERATION'},function(responsePost){
           // alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isVacio(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("291: "+responsePost.data.tTypes);
                }else{  
                    linksWs.op = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        });
    }

    if(!isVacio(linksWs.ne)){
        $scope.negocios = linksWs.ne;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'BUSINESS'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isVacio(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("311: "+responsePost.data.tTypes);
                }else{  
                    linksWs.ne = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }  
    
    checkRed(function(red){
        if(red){
            onWsAction(linksWs.link_root+"/TNotifications/find.json",{user:linksWs.user},function(responsePost){
                //console.log("calback TRequest 3160: "+JSON.stringify(responsePost.data));
                if(!isVacio(responsePost.data)){
                    //linksWs.request = responsePost.data.tAlarm;
                    linksWs.notifys = responsePost.data.tNotification;
                    if(angular.isString(linksWs.notifys)){
                        $scope.notifyCount = "";
                        $scope.notifClass = "badgeNone";
                    }else{
                        if(linksWs.notifys.length > 0 && linksWs.notifys.length <10){
                            $scope.notifClass = "badge bg-danger-400 media-badge"; 
                        }else{
                            if(linksWs.notifys.length < 1){
                                $scope.notifClass = "badgeNone";
                            }else{
                                $scope.notifClass = "badgeTen bg-danger-400 media-badge";
                            }
                        }
                        $scope.notifyCount = linksWs.notifys.length;
                    }
                }else{
                    $scope.notifyCount = "";
                    $scope.notifClass = "badgeNone";
                }
            });                

        }else{
            $scope.notifyCount = "";
            $scope.notifClass = "badgeNone";
        }
                
    });  
    
})
.controller('SolicitudCtrl', function($scope, $rootScope, $state, $stateParams, $timeout, $filter, $ionicPopup, $ionicLoading, ionicMaterialInk, ionicMaterialMotion, $history,linksWs,ionicDatePicker) {
    $ionicLoading.show({});
    $scope.$parent.clearFabs();
    $timeout(function() {
        $scope.$parent.hideHeader();
    }, 0);    
    $scope.formData = {};
    
    var counterBlock = 0;
    function validateLoadComplete() {
        counterBlock++;
        if (counterBlock === 14) {
            counterBlock = 0;
            // Set Motion
            $timeout(function() {
                ionicMaterialMotion.fadeSlideIn({
                    selector: '.animate-fade-slide-in .item'
                });
            }, 200);
            $scope.formData.ID_TYPE_PRICE = 210;
            // Activate ink for controller
            ionicMaterialInk.displayEffect();            
            $ionicLoading.hide();
        }
    } 
    
    if(!isBlank(linksWs.ql)){
        $scope.calidad = linksWs.ql;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_QUALITY'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.ql = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }
    
    if(!isBlank(linksWs.en)){
        $scope.tentrega = linksWs.en;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_DELIVERY'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.en = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    } 
    
    if(!isBlank(linksWs.pa)){
        $scope.tpago = linksWs.pa;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_PAYMENT'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.pa = responsePost.data.tTypes;
                    $scope.tpago = linksWs.pa;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }     

    if(!isBlank(linksWs.co)){
        $scope.cosecha = linksWs.co;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_CROP'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.co = responsePost.data.tTypes;
                    $scope.cosecha = linksWs.co;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }     

    if(!isBlank(linksWs.po)){
        $scope.posicion = linksWs.po;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TPosition/index.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tPosition)){
                    console.log("471: "+responsePost.data.tPosition);
                }else{  
                    linksWs.po = responsePost.data.tPosition;
                    $scope.posicion = linksWs.po;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }    

    if(!isBlank(linksWs.pr)){
        $scope.precref = linksWs.pr;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_PRICE_REF'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.pr = responsePost.data.tTypes;
                    $scope.precref = linksWs.pr;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }    
    
    if(!isBlank(linksWs.pc)){
        $scope.tprecios = linksWs.pc;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_PRICE'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("491: "+responsePost.data.tTypes);
                }else{  
                    linksWs.pc = responsePost.data.tTypes;
                    $scope.tprecios = linksWs.pc;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }    

    
    /**********************/
    if(!isBlank(linksWs.me)){
        $scope.mercados = linksWs.me;
        validateLoadComplete();      
    }else{   
        onWsAction(linksWs.link_root+"/TMarket.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tMarket)){
                    console.log("127: "+responsePost.data.tMarket);
                }else{  
                    linksWs.me = responsePost.data.tMarket;
                    $scope.mercados = responsePost.data.tMarket;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 135: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.tp)){
        $scope.tproductos = linksWs.tp;
        validateLoadComplete();      
    }else{ 
        onWsAction(linksWs.link_root+"/TCategoryProd.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tCategoryProd)){
                    console.log("143: "+responsePost.data.tCategoryProd);
                }else{  
                    linksWs.tp = responsePost.data.tCategoryProd;
                    $scope.tproductos = responsePost.data.tCategoryProd;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 151: "+JSON.stringify(responsePost));    
            }
        }); 
    }

    $scope.getProduct = function(form){
        // use $scope.ng-model.code and $scope.ng-model.name here
        var mk = 1;
        var tp = $scope.formData.tipoProducto;
        //alert(tp);

        $scope.formData = { tipoProducto: tp, operaciones: linksWs.op, tproductos: linksWs.tp,tprecios: linksWs.pc, cosecha:linksWs.co,tentrega: linksWs.en, calidad: linksWs.ql, monedas: linksWs.mo, lugares: linksWs.lu, negocios: linksWs.ne};
        //$scope.newRequest.$setPristine();
        form.$setPristine();

        
        if(!isBlank(mk) && !isBlank(tp)){
            $ionicLoading.show({});
            // for other stuff ...
            
            
            //this.newRequest.$setPristine();
            //this.newRequest.$setUntouched(); 
            //resetForm();
            
            if(tp != 1){
                $scope.isDisabled = true;
            }else{
                $scope.isDisabled = false;
            }
            
            onWsAction(linksWs.link_root+"/TProduct/find.json",{mk:mk,tp:tp},function(responsePost){
                //alert("calback response: "+JSON.stringify(responsePost.data));
                if(!isBlank(responsePost.data)){
                    if(angular.isString(responsePost.data.tProduct)){
                        $ionicLoading.hide();
                        $scope.productos = [];
                        console.log("159: "+responsePost.data.tProduct);
                    }else{  
                        linksWs.pr = responsePost.data.tProduct;
                        $scope.productos = responsePost.data.tProduct;
                        $ionicLoading.hide();
                    }
                }else{
                    $ionicLoading.hide();
                    console.log("calback token no set 167: "+JSON.stringify(responsePost));    
                }
            });            
        }
        
    }

    if(!isBlank(linksWs.mo)){
        $scope.monedas = linksWs.mo;
        validateLoadComplete();      
    }else{     
        onWsAction(linksWs.link_root+"/TCurrency.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tCurrency)){
                    console.log("159: "+responsePost.data.tCurrency);
                }else{  
                    linksWs.mo = responsePost.data.tCurrency;
                    $scope.monedas = responsePost.data.tCurrency;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 167: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.um)){
        $scope.ums = linksWs.um;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TUm.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tUm)){
                    console.log("243: "+responsePost.data.tUm);
                }else{  
                    linksWs.um = responsePost.data.tUm;
                    $scope.ums = responsePost.data.tUm;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback error 251: "+JSON.stringify(responsePost));    
            }
        });
    }
    
     if(!isBlank(linksWs.lu)){
        $scope.lugares = linksWs.lu;
        validateLoadComplete();      
    }else{
        onWsAction(linksWs.link_root+"/TPlace.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tPlace)){
                    console.log("159: "+responsePost.data.tPlace);
                }else{  
                    linksWs.lu = responsePost.data.tPlace;
                    $scope.lugares = responsePost.data.tPlace;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 167: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.op)){
        $scope.operaciones = linksWs.op;
        validateLoadComplete();      
    }else{
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'OPERATION'},function(responsePost){
           // alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("159: "+responsePost.data.tTypes);
                }else{  
                    linksWs.op = responsePost.data.tTypes;
                    $scope.operaciones = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 167: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.ne)){
        $scope.negocios = linksWs.ne;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'BUSINESS'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("159: "+responsePost.data.tTypes);
                }else{  
                    linksWs.ne = responsePost.data.tTypes;
                    $scope.tnegocios = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 167: "+JSON.stringify(responsePost));    
            }
        }); 
    }
    
    $scope.submitForm = function(valid) {  
        if (valid) {
            $ionicLoading.show({});
            $scope.formData.ID_USER_OWNER = linksWs.user;
            $scope.formData.ID_MARKET = 1;
            //var dataPost = [];
            //console.log(this.formData);
            var dataPost = [];
            //console.log(this.formData);
            var formD = this.formData;
            angular.forEach(this.formData, function(data, nombre) { 
                if(nombre.indexOf("t_") == -1){
                    var obj = {};
                    obj[nombre] = data;
                    dataPost[nombre] = data;
                }
            });           
            
            onWsAction(linksWs.link_root+"/TRequest/newRequest.json",dataPost,function(responsePost){
                //alert("calback response: "+JSON.stringify(responsePost));
                $ionicLoading.hide();
                if(!isBlank(responsePost.data)){
                    if(angular.isString(responsePost.data.tRequest)){
                        //console.log("143: "+responsePost.data.tRequest);
                        var alertPopup = $ionicPopup.alert({
                            title: "Mensaje <i class='icon ion-close-circled error'></i>",
                            content: "Error: "+responsePost.data.tRequest,
                            type : 'button-dark',
                        }).then(function(res) {
                        });                         
                    }else{
                        var alertPopup = $ionicPopup.alert({
                            title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                            content: "La solicitud se grab&oacute; con &eacute;xito",
                            type : 'button-dark',
                        }).then(function(res) {
                            linksWs.request = "";
                            linksWs.requests = "";
                            $history.back();
                        });                      
                    }
                }else{
                    var alertPopup = $ionicPopup.alert({
                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                        content: "Error: "+responsePost.data.tRequest,
                        type : 'button-dark',
                    }).then(function(res) {
                    });                      
                    //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                }
            });            
        } else {
            $ionicPopup.alert({
                title: "Mensaje <i class='icon ion-close-circled error'></i>",
                content: "Faltan campos por llenar ",
                type : 'button-dark',
            }).then(function(res) {
            });             
            //console.log(JSON.stringify($scope.newRequest));
        }        
        
    };
    
    $scope.cancelar = function() {
        $state.go('app.home');
    };

    $scope.changeDate= function (elem, val) {   
        //alert("entro: "+elem+":"+val);
        $scope.formData[elem] = val;
    }    
    var $scroll = document.getElementsByClassName('myScroll');
    angular.element($scroll).css({"height":(window.innerHeight) - 30 +"px"});      
})
.controller('ListaCtrl', function($scope, $http, $state, $stateParams, $timeout, $history, $ionicLoading, $ionicPopup, ionicMaterialInk, ionicMaterialMotion, linksWs) {
    // Set Header
    $ionicLoading.show({});
    
    $timeout(function() {
        $scope.$parent.hideHeader();
        $scope.isExpanded = false;
        $scope.$parent.setExpanded(false);        
        
    }, 0);      

    $scope.requests = [];
    var $itemFloat, 
        $itemSelected, 
        $profile = document.querySelector('.profile'),
        $details = document.getElementsByClassName('details'),
        $scroll = document.getElementsByClassName('myScroll'),
        
        $divBack = document.getElementsByClassName('list-actions'),
        $divTitl = document.getElementsByClassName('list-title'),
        $section = $profile.parentNode,
        $list = $section.querySelector('ul'),
        pos,
        contentSpeed = 50;
    

    $scope.closeProfile = function(e) {
        e.preventDefault();
        
        var $profile = document.querySelector('.profile'),
            $section = $profile.parentNode;
         
        _animateInfo(false)
            .then(function(){
             
            setTimeout(function(){
                var $icons = document.getElementsByClassName('iconWinsm');

                angular.element($icons).css({"color":"#04204a"});                
                $profile.classList.remove('show');
                $itemFloat.style.top = pos + 'px';
                $itemFloat.classList.remove('centered');
            }, contentSpeed * 2);
 
            setTimeout(function() {
                $itemSelected.style.opacity = 1;
            }, 500);
 
            setTimeout(function() {
                $section.removeChild($itemFloat);
            }, 600); 
            //$scope.$parent.showHeader();
            //$divBack.style.display = 'block';
            angular.element($divBack).css({"display": "block"});
            angular.element($divTitl).css({"display": "block"});
            angular.element($section).attr("style","margin-top: 5% !important");
        });
    }
     
    $scope.showProfile = function(e, i) {
        e.preventDefault();
        //$divBack.style.display = 'none';
        angular.element($divBack).css({"display": "none"});
        angular.element($divTitl).css({"display": "none"});
        $scope.$parent.hideHeader();
        angular.element($section).attr("style","margin-top: 0% !important");
        var $selectedItem = e.target.closest('a'),
            $floatingItem = document.createElement('div');
         
        $scope.mercado = $scope.requests[i];
        linksWs.request = i;
        
        pos = ($selectedItem.offsetTop - $list.scrollTop);
         
        $floatingItem.innerHTML = $selectedItem.innerHTML;
        $floatingItem.classList.add('floating-item');
        $floatingItem.style.height = $selectedItem.offsetHeight + 'px';
        $floatingItem.style.top = pos + 'px';
        $floatingItem.style['will-change'] = 'left, top';
         
        $section.appendChild($floatingItem);
        $itemFloat = $floatingItem;
        $itemSelected = $selectedItem;
        $selectedItem.style.opacity = 0;
         
        setTimeout(function() {
            var $imageWrapper = $floatingItem.querySelector('.imageWrapper');
            var $icon = document.getElementsByClassName('iconWinsm');
            
            angular.element($icon).css({"color":"#fff"});
            $profile.style.zIndex = 1;
            $profile.classList.add('show');
            $floatingItem.style.top = '16px';
            $floatingItem.classList.add('centered');
            angular.element($details).css({"height":(window.innerHeight-145)+"px"});
            //angular.element($details).css({"overflow-x":"hidden"});
            //angular.element($details).css({"overflow-y":"scroll"});
            
        }, 50);
         
        setTimeout(function () {
            _animateInfo(true);
        }, 600);
 
    }
     
    function _animateInfo(show) {
        return new Promise(function(resolve, reject) {
            var $contentItems = document.querySelectorAll('.profile li'),
            i = 0, length = $contentItems.length, arr = [];
         
            if (length === 0) return;
 
            for (i = 0; i < length; i++) {
                arr.push($contentItems[i]);
            }
 
            i = show ? 0 : length;
            arr.forEach(function(item) {
                var delay = (show ? i++ : i--) * contentSpeed;
 
                setTimeout(function(){
                    if (show)
                        item.classList.add('show');
                    else
                        item.classList.remove('show');
                     
                    hasFinished(delay);
                }, delay);
            });
             
            function hasFinished(d) {
                if (d === ((length - 1) * contentSpeed))
                    resolve();
            }
        });
    }
    
    $scope.editRequest = function(e) {
        e.preventDefault();
        $ionicLoading.show({});
        $state.go('app.solicitudEdit');
    }; 
    
    $scope.deleteRequest = function(ev) {
        ev.preventDefault();
        
        $ionicPopup.show({
            cssClass: 'confirmDeletePopup',
            title: '&#191;Est&aacute; seguro de Eliminar la Solicitud &#63;',
            /*subTitle: 'Are you sure you want to create this case?',*/
            buttons: [{
                text: 'No',
                onTap: function(e) {
                    return 0;
                }
            }, {
                text: 'Si',
                type: 'button-positive',
                onTap: function(e) {
                    return 1;
                }
            }, ]
        }).then(function(res) {
            if (res === 1) {
                //console.log('ok clicked');
                checkRed(function(red){
                    if(red){
                        $ionicLoading.show({});
                        var dataPost = new Object();
                        var formD = linksWs.requests[linksWs.request];
                        angular.forEach(formD, function(data, nombre) { 
                            if(nombre.indexOf("t_") == -1){
                                //var obj = {};
                                //obj[nombre] = data;
                                dataPost[nombre] = data;
                                //dataPost.push({nombre:data});                    
                            }
                        }); 
                        onWsAction(linksWs.link_root+"/TRequest/deleteRequest.json",dataPost,function(responsePost){
                            //alert("calback response: "+JSON.stringify(responsePost));
                            $ionicLoading.hide();
                            if(!isBlank(responsePost.data)){
                                if(angular.isString(responsePost.data.tRequest)){
                                    //console.log("143: "+responsePost.data.tRequest);
                                    var alertPopup = $ionicPopup.alert({
                                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                        content: "Error: "+responsePost.data.tRequest,
                                        type : 'button-dark',
                                    }).then(function(res) {
                                    });                         
                                }else{
                                    var alertPopup = $ionicPopup.alert({
                                        title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                                        content: "Solicitud Eliminada con &eacute;xito",
                                        type : 'button-dark',
                                    }).then(function(res) {
                                        //linksWs.request = "";
                                        //linksWs.requests = "";
                                        $scope.closeProfile(ev);
                                        validRequest(linksWs.request);
                                    });                      
                                }
                            }else{
                                var alertPopup = $ionicPopup.alert({
                                    title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                    content: "Error: "+responsePost.data.tRequest,
                                    type : 'button-dark',
                                }).then(function(res) {
                                });                      
                                //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                            }
                        });
                    }
                });
                                
            } else if (res === 0) {
                //console.log('cancel clicked');
            }            

        });        
    }; 
                    
    
    function validRequest(index){
        
        checkRed(function(red){
            if(red){
                 if(!isBlank(linksWs.requests)){
                    //alert(index);
                    if(!angular.isUndefined(index)){
                        //linksWs.alarms.destroy(index);
                        linksWs.requests.splice(index, 1);
                        //alert("Requests: "+linksWs.requests.length );
                        $scope.requests = linksWs.requests;
                        if(linksWs.requests.length < 1){
                            $scope.requests = null;
                            $ionicPopup.alert({
                                title: "No posee solicitudes activas. Por favor crear nuevas alarmas",
                                type : 'button-dark',
                            });                            
                        }else{
                            $scope.requests = linksWs.requests;
                        }
                    }else{
                        $scope.requests = null;
                        $ionicPopup.alert({
                            title: "No posee solicitudes activas. Por favor crear nuevas alarmas",
                            type : 'button-dark',
                        });                        
                    }
                }else{
                    $scope.requests = null;
                    $ionicPopup.alert({
                        title: "No posee solicitudes activas. Por favor crear nuevas alarmas",
                        type : 'button-dark',
                    });                      
                }               
            } 
        });
    }
    
    function findRequest(){
        checkRed(function(red){
            if(red){
                onWsAction(linksWs.link_root+"/TRequest/find.json",{user:linksWs.user},function(responsePost){
                    //console.log("calback TRequest 621: "+JSON.stringify(responsePost.data));
                    if(!isBlank(responsePost.data)){
                        //linksWs.request = responsePost.data.tRequest;
                        linksWs.requests = responsePost.data.tRequest;
                        if(angular.isString(linksWs.requests)){
                            linksWs.requests = "";
                            $ionicLoading.hide();
                            var alertPopup = $ionicPopup.alert({
                                title: "No posee solicitudes activas. Por favor crear nuevas solicitudes",
                                type : 'button-dark',
                            });
                            //alert(linksWs.couponInfo);
                        }else{
                            $scope.requests = linksWs.requests;
                            angular.element($scroll).css({"height":(window.innerHeight-33)+"px"});
                            //angular.element($section).css({"height":(window.innerHeight+10)+"px"});
                            //linksWs.requests = linksWs.requests;
                            $timeout(function() {
                                ionicMaterialMotion.fadeSlideInRight({
                                    selector: '.animate-fade-slide-in-right .item'
                                });
                                ionicMaterialInk.displayEffect();
                                $ionicLoading.hide();
                            }, 3700);                        
                        }
                    }else{
                        $ionicLoading.hide();
                        var alertPopup = $ionicPopup.alert({
                            title: "Error con el servidor, Reinicie la Aplicaci&oacute;n",
                            type : 'button-dark',
                        });                            
                        //alert("calback 623: "+JSON.stringify(responsePost));    
                    }
                });

            }else{
                $ionicLoading.hide();
                var alertPopup = $ionicPopup.alert({
                    title: "No hay Red",
                    type : 'button-dark',
                });
            }
        });       
    }
    findRequest();
    
    $scope.back = function(e){
        //$history.back();
        $state.go('app.home');
    }    
})
.controller('SolicitudEditCtrl', function($scope, $rootScope, $state, $stateParams, $timeout, $filter, $ionicPopup, $ionicLoading, ionicMaterialInk, ionicMaterialMotion, $history,linksWs,ionicDatePicker) {
    $ionicLoading.show({});
    $scope.$parent.clearFabs();
    $timeout(function() {
        $scope.$parent.hideHeader();
    }, 0);      

    var counterBlock = 0;
    
    function validateLoadComplete() {
        counterBlock++;
        if (counterBlock === 14) {
            // for other stuff ...
            $scope.formData.tipoProducto = linksWs.requests[linksWs.request].t_product.ID_CATEGORY_PROD;
            $scope.formData.ID_MARKET = 1;
            var mk = 1;
            var tp = $scope.formData.tipoProducto;            
            onWsAction(linksWs.link_root+"/TProduct/find.json",{mk:mk,tp:tp},function(responsePost){
                //alert("calback response: "+JSON.stringify(responsePost.data));
                //console.log("entro complete");
                if(!isBlank(responsePost.data)){
                    if(angular.isString(responsePost.data.tProduct)){
                        $ionicLoading.hide();
                        //$scope.productos = [];
                        console.log("159: "+responsePost.data.tProduct);
                    }else{  
                        linksWs.pr = responsePost.data.tProduct;
                        $scope.productos = responsePost.data.tProduct;
                        $ionicLoading.hide();
                    }
                }else{
                    $ionicLoading.hide();
                    console.log("calback token no set 167: "+JSON.stringify(responsePost));    
                }
            });            
         
            counterBlock = 0;
            // Set Motion
            $timeout(function() {
                ionicMaterialMotion.fadeSlideIn({
                    selector: '.animate-fade-slide-in .item'
                });
                $scope.formData = linksWs.requests[linksWs.request];
                $scope.formData.DT_FROM = $scope.formData.DT_FROM.split(' ')[0];
                $scope.formData.DT_TO = $scope.formData.DT_TO.split(' ')[0];
            }, 200);
            
            // Activate ink for controller
            ionicMaterialInk.displayEffect();            
            $ionicLoading.hide();
        }else{
            $scope.formData = linksWs.requests[linksWs.request];
        }
    } 
    
    if(!isBlank(linksWs.ql)){
        $scope.calidad = linksWs.ql;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_QUALITY'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.ql = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }
    
    if(!isBlank(linksWs.en)){
        $scope.tentrega = linksWs.en;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_DELIVERY'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.en = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    } 
    
    if(!isBlank(linksWs.pa)){
        $scope.tpago = linksWs.pa;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_PAYMENT'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.pa = responsePost.data.tTypes;
                    $scope.tpago = linksWs.pa;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }     

    if(!isBlank(linksWs.co)){
        $scope.cosecha = linksWs.co;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_CROP'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.co = responsePost.data.tTypes;
                    $scope.cosecha = linksWs.co;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }     

    if(!isBlank(linksWs.po)){
        $scope.posicion = linksWs.po;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TPosition/index.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tPosition)){
                    console.log("471: "+responsePost.data.tPosition);
                }else{  
                    linksWs.po = responsePost.data.tPosition;
                    $scope.posicion = linksWs.po;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }    

    if(!isBlank(linksWs.pr)){
        $scope.precref = linksWs.pr;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_PRICE_REF'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("471: "+responsePost.data.tTypes);
                }else{  
                    linksWs.pr = responsePost.data.tTypes;
                    $scope.precref = linksWs.pr;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }    
    
    if(!isBlank(linksWs.pc)){
        $scope.tprecios = linksWs.pc;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_PRICE'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("491: "+responsePost.data.tTypes);
                }else{  
                    linksWs.pc = responsePost.data.tTypes;
                    $scope.tprecios = linksWs.pc;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }    

    
    /**********************/
    if(!isBlank(linksWs.me)){
        $scope.mercados = linksWs.me;
        validateLoadComplete();      
    }else{   
        onWsAction(linksWs.link_root+"/TMarket.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tMarket)){
                    console.log("127: "+responsePost.data.tMarket);
                }else{  
                    linksWs.me = responsePost.data.tMarket;
                    $scope.mercados = responsePost.data.tMarket;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 135: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.tp)){
        $scope.tproductos = linksWs.tp;
        validateLoadComplete();      
    }else{ 
        onWsAction(linksWs.link_root+"/TCategoryProd.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tCategoryProd)){
                    console.log("143: "+responsePost.data.tCategoryProd);
                }else{  
                    linksWs.tp = responsePost.data.tCategoryProd;
                    $scope.tproductos = responsePost.data.tCategoryProd;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 151: "+JSON.stringify(responsePost));    
            }
        }); 
    }
    
    $scope.getProduct = function(){
        // use $scope.ng-model.code and $scope.ng-model.name here
        var mk = 1;
        var tp = $scope.formData.tipoProducto;
        //alert(tp);
        if(!isBlank(mk) && !isBlank(tp)){
            $ionicLoading.show({});
            // for other stuff ...
            onWsAction(linksWs.link_root+"/TProduct/find.json",{mk:mk,tp:tp},function(responsePost){
                //alert("calback response: "+JSON.stringify(responsePost.data));
                if(!isBlank(responsePost.data)){
                    if(angular.isString(responsePost.data.tProduct)){
                        $ionicLoading.hide();
                        $scope.productos = [];
                        console.log("159: "+responsePost.data.tProduct);
                    }else{  
                        linksWs.pr = responsePost.data.tProduct;
                        $scope.productos = responsePost.data.tProduct;
                        $ionicLoading.hide();
                    }
                }else{
                    $ionicLoading.hide();
                    console.log("calback token no set 167: "+JSON.stringify(responsePost));    
                }
            });            
        }
        
    }

    if(!isBlank(linksWs.mo)){
        $scope.monedas = linksWs.mo;
        validateLoadComplete();      
    }else{     
        onWsAction(linksWs.link_root+"/TCurrency.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tCurrency)){
                    console.log("159: "+responsePost.data.tCurrency);
                }else{  
                    linksWs.mo = responsePost.data.tCurrency;
                    $scope.monedas = responsePost.data.tCurrency;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 167: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.um)){
        $scope.ums = linksWs.um;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TUm.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tUm)){
                    console.log("243: "+responsePost.data.tUm);
                }else{  
                    linksWs.um = responsePost.data.tUm;
                    $scope.ums = responsePost.data.tUm;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback error 251: "+JSON.stringify(responsePost));    
            }
        });
    }
    
     if(!isBlank(linksWs.lu)){
        $scope.lugares = linksWs.lu;
        validateLoadComplete();      
    }else{
        onWsAction(linksWs.link_root+"/TPlace.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tPlace)){
                    console.log("159: "+responsePost.data.tPlace);
                }else{  
                    linksWs.lu = responsePost.data.tPlace;
                    $scope.lugares = responsePost.data.tPlace;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 167: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.op)){
        $scope.operaciones = linksWs.op;
        validateLoadComplete();      
    }else{
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'OPERATION'},function(responsePost){
           // alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("159: "+responsePost.data.tTypes);
                }else{  
                    linksWs.op = responsePost.data.tTypes;
                    $scope.operaciones = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 167: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.ne)){
        $scope.negocios = linksWs.ne;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'BUSINESS'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("159: "+responsePost.data.tTypes);
                }else{  
                    linksWs.ne = responsePost.data.tTypes;
                    $scope.tnegocios = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 167: "+JSON.stringify(responsePost));    
            }
        }); 
    }
    
    
    $scope.formData = {};
    $scope.submitForm = function(valid) {
        
        if (valid) {
            $ionicLoading.show({});
            $scope.ID_USER_OWNER = linksWs.user;
            //var dataPost = new Object();
            var dataPost = [];
            //console.log(this.formData);
            var formD = this.formData;
            angular.forEach(this.formData, function(data, nombre) { 
                if(nombre.indexOf("t_") == -1){
                    var obj = {};
                    obj[nombre] = data;
                    dataPost[nombre] = data;
                }
            }); 
            var toDate = new Date();
            dformat = [toDate.getFullYear(),
                       toDate.getDate().padLeft(),
                       (toDate.getMonth()+1).padLeft()].join('-')+' '+
                      [toDate.getHours().padLeft(),
                       toDate.getMinutes().padLeft(),
                       toDate.getSeconds().padLeft()].join(':');            
            dataPost['DH_LAST_UPDATE'] = dformat;
  
            onWsAction(linksWs.link_root+"/TRequest/editRequest.json",dataPost,function(responsePost){
                //alert("calback response: "+JSON.stringify(responsePost));
                $ionicLoading.hide();
                if(!isBlank(responsePost.data)){
                    if(angular.isString(responsePost.data.tRequest)){
                        //console.log("143: "+responsePost.data.tRequest);
                        var alertPopup = $ionicPopup.alert({
                            title: "Mensaje <i class='icon ion-close-circled error'></i>",
                            content: "Error: "+responsePost.data.tRequest,
                            type : 'button-dark',
                        }).then(function(res) {
                        });                         
                    }else{
                        var alertPopup = $ionicPopup.alert({
                            title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                            content: "La solicitud se actualiz&oacute; con &eacute;xito",
                            type : 'button-dark',
                        }).then(function(res) {
                            linksWs.requests[linksWs.request] = responsePost.data.tRequest;
                            $history.back();
                        });                      
                    }
                }else{
                    var alertPopup = $ionicPopup.alert({
                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                        content: "Error: "+responsePost.data.tRequest,
                        type : 'button-dark',
                    }).then(function(res) {
                    });                      
                    //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                }
            });            
        } else {
            $ionicPopup.alert({
                title: "Mensaje <i class='icon ion-close-circled error'></i>",
                content: "Error en el Formulario: ",
                type : 'button-dark',
            }).then(function(res) {
            });              
            //console.log("No valid"+JSON.stringify($scope.newRequest));
        }        
    };
    
    $scope.cancelar = function() {
        $history.back();
    };

    $scope.changeDate= function (elem, val) {   
        //alert("entro: "+elem+":"+val);
        $scope.formData[elem] = val;
    }    
})
.controller('FiltroCtrl', function($scope, $http, $stateParams, $state, $history, $timeout, $ionicLoading, $ionicPopup, $ionicSideMenuDelegate, $filter, ionicMaterialInk, ionicMaterialMotion, ionicDatePicker, linksWs) {
    // Set Header
    $ionicLoading.show({});
    $scope.$parent.clearFabs();
    $timeout(function() {
        $scope.$parent.hideHeader();
    }, 0);      
    
    linksWs.requests = "";
    $scope.formData = {};
    var counterBlock = 0;
    var $scroll = document.getElementsByClassName('myScroll');
    angular.element($scroll).css({"height":(window.innerHeight) - 30 +"px"});    
    function validateLoadComplete() {
        counterBlock++;
        if (counterBlock === 7) {
            counterBlock = 0;
            // Set Motion
            $timeout(function() {
                ionicMaterialMotion.fadeSlideIn({
                    selector: '.animate-fade-slide-in .item'
                });
            }, 200);

            // Activate ink for controller
            ionicMaterialInk.displayEffect();            
            $ionicLoading.hide();
        }
    } 
    
    if(!isBlank(linksWs.me)){
        $scope.mercados = linksWs.me;
        $scope.formData.ID_MARKET = 1;
        validateLoadComplete();      
    }else{   
        onWsAction(linksWs.link_root+"/TMarket.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tMarket)){
                    console.log("127: "+responsePost.data.tMarket);
                }else{  
                    linksWs.me = responsePost.data.tMarket;
                    /*$scope.mercados = responsePost.data.tMarket;*/
                    $scope.formData.ID_MARKET = 1;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 135: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.tp)){
        $scope.tproductos = linksWs.tp;
        validateLoadComplete();      
    }else{ 
        onWsAction(linksWs.link_root+"/TCategoryProd.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tCategoryProd)){
                    console.log("143: "+responsePost.data.tCategoryProd);
                }else{  
                    linksWs.tp = responsePost.data.tCategoryProd;
                    $scope.tproductos = responsePost.data.tCategoryProd;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 151: "+JSON.stringify(responsePost));    
            }
        }); 
    }
    
    $scope.getProduct = function(){
        // use $scope.ng-model.code and $scope.ng-model.name here
        var mk = $scope.formData.ID_MARKET;
        var tp = $scope.formData.tipoProducto;
        //alert(tp);
        if(!isBlank(mk) && !isBlank(tp)){
            $ionicLoading.show({});
            // for other stuff ...
            onWsAction(linksWs.link_root+"/TProduct/find.json",{mk:mk,tp:tp},function(responsePost){
                //alert("calback response: "+JSON.stringify(responsePost.data));
                if(!isBlank(responsePost.data)){
                    if(angular.isString(responsePost.data.tProduct)){
                        $ionicLoading.hide();
                        $scope.productos = [];
                        console.log("159: "+responsePost.data.tProduct);
                    }else{  
                        linksWs.pr = responsePost.data.tProduct;
                        $scope.productos = responsePost.data.tProduct;
                        $ionicLoading.hide();
                    }
                }else{
                    $ionicLoading.hide();
                    console.log("calback token no set 167: "+JSON.stringify(responsePost));    
                }
            });            
        }
        
    }

    if(!isBlank(linksWs.mo)){
        $scope.monedas = linksWs.mo;
        validateLoadComplete();      
    }else{     
        onWsAction(linksWs.link_root+"/TCurrency.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tCurrency)){
                    console.log("159: "+responsePost.data.tCurrency);
                }else{  
                    linksWs.mo = responsePost.data.tCurrency;
                    $scope.monedas = responsePost.data.tCurrency;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 167: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.um)){
        $scope.ums = linksWs.um;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TUm.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tUm)){
                    console.log("159: "+responsePost.data.tUm);
                }else{  
                    linksWs.um = responsePost.data.tUm;
                    $scope.ums = responsePost.data.tUm;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 167: "+JSON.stringify(responsePost));    
            }
        });
    }
    
     if(!isBlank(linksWs.lu)){
        $scope.lugares = linksWs.lu;
        validateLoadComplete();      
    }else{
        onWsAction(linksWs.link_root+"/TPlace.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tPlace)){
                    console.log("159: "+responsePost.data.tPlace);
                }else{  
                    linksWs.lu = responsePost.data.tPlace;
                    $scope.lugares = responsePost.data.tPlace;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 167: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.op)){
        $scope.operaciones = linksWs.op;
        validateLoadComplete();      
    }else{
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'OPERATION'},function(responsePost){
           // alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("159: "+responsePost.data.tTypes);
                }else{  
                    linksWs.op = responsePost.data.tTypes;
                    $scope.operaciones = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 167: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.ne)){
        $scope.negocios = linksWs.ne;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'BUSINESS'},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("159: "+responsePost.data.tTypes);
                }else{  
                    linksWs.ne = responsePost.data.tTypes;
                    $scope.negocios = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 167: "+JSON.stringify(responsePost));    
            }
        }); 
    }

    $scope.openDateEntregaD = function (val) {    
      var ipObj1 = {
        callback: function (val) {  //Mandatory
          $scope.formData.DT_FROM = $filter('date')(new Date(val), "yyyy-MM-dd");
        },
        templateType: 'popup'
      };
      ionicDatePicker.openDatePicker(ipObj1);    
    }
    
    $scope.openDateEntregaH = function (val) {    
      var objDate = {
        callback: function (val) {  //Mandatory
          $scope.formData.DT_TO = $filter('date')(new Date(val), "yyyy-MM-dd");
        },
        templateType: 'popup'
      };
      ionicDatePicker.openDatePicker(objDate);    
    }
    
    
    $scope.submitForm = function(valid) {  
        if (valid) {
            $ionicLoading.show({});
            $scope.formData.ID_USER_OWNER = linksWs.user;
            //var dataPost = [];
            //console.log(this.formData);
            var formD = this.formData;
            /*angular.forEach(this.formData, function(data, nombre) { 
                dataPost[nombre] = data;
            });*/         
            
            onWsAction(linksWs.link_root+"/TRequest/filter.json",formD,function(responsePost){
                //alert("calback response: "+JSON.stringify(responsePost));
                $ionicLoading.hide();
                if(!isBlank(responsePost.data)){
                    if(angular.isString(responsePost.data.tRequest)){
                         $ionicLoading.hide();
                        //console.log("143: "+responsePost.data.tRequest);
                        var alertPopup = $ionicPopup.alert({
                            title: "Mensaje <i class='icon ion-close-circled error'></i>",
                            content: "No hay solicitudes que coincidan con su busqueda",
                            type : 'button-dark',
                        }).then(function(res) {
                        });                         
                    }else{
                        linksWs.requests = responsePost.data.tRequest;
                        $state.go('app.mercado');
                        
                    }
                }else{
                    $ionicLoading.hide();
                    var alertPopup = $ionicPopup.alert({
                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                        content: "No hay solicitudes que coincidan con su busqueda",
                        type : 'button-dark',
                    }).then(function(res) {
                    });                      
                    //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                }
            });            
        } else {
             $ionicLoading.hide();
            //console.log(JSON.stringify($scope.newRequest));
        }        

    };
    
    $scope.cancelar = function() {
        $state.go('app.home');
    };
  
})
.controller('MercadoCtrl', function($scope, $http, $rootScope, $state, $stateParams, $timeout, $history, $ionicLoading, $ionicPopup, ionicMaterialInk, ionicMaterialMotion, linksWs) {
    // Set Header
    $ionicLoading.show({});
    $scope.$parent.clearFabs();
    $timeout(function() {
        $scope.$parent.hideHeader();
    }, 0);      

    $scope.requests = [];
    
    $scope.confirm = {};
    
    $scope.confirmbtn = false;
    var confirmRequest = null;
    
    var $itemFloat, 
        $itemSelected, 
        $profile = document.querySelector('.profile'),
        $scroll = document.getElementsByClassName('myScroll'),
        $divBack = document.getElementsByClassName('list-actions'),
        $divTitl = document.getElementsByClassName('list-title'),
        $section = $profile.parentNode,
        $list = $section.querySelector('ul'),
        pos,
        contentSpeed = 50;
    
    $scope.back = function(e){
        //$history.back();
        $state.go('app.filtro');
    }
    
    $scope.closeProfile = function(e) {
        e.preventDefault();
        
        var $profile = document.querySelector('.profile'),
            $section = $profile.parentNode;
         
        _animateInfo(false)
            .then(function(){
             
            setTimeout(function(){
                var $icons = document.getElementsByClassName('iconWinsm');

                angular.element($icons).css({"color":"#04204a"});
                
                $profile.classList.remove('show');
                $itemFloat.style.top = pos + 'px';
                $itemFloat.classList.remove('centered');
            }, contentSpeed * 2);
 
            setTimeout(function() {
                $itemSelected.style.opacity = 1;
            }, 500);
 
            setTimeout(function() {
                $section.removeChild($itemFloat);
            }, 600); 
            //$scope.$parent.showHeader();
            angular.element($divBack).css({"display": "block"});
            angular.element($divTitl).css({"display": "block"});
            angular.element($section).attr("style","margin-top: 5% !important");
        });
    }
     
    $scope.showProfile = function(e, i) {
        e.preventDefault();
        angular.element($divBack).css({"display": "none"});
        angular.element($divTitl).css({"display": "none"});
        $scope.$parent.hideHeader();
        angular.element($section).attr("style","margin-top: 0% !important");
        var $selectedItem = e.target.closest('a'),
            $floatingItem = document.createElement('div');
         
        $scope.mercado = $scope.requests[i];
        linksWs.request = i;
        
        pos = ($selectedItem.offsetTop - $list.scrollTop);
         
        $floatingItem.innerHTML = $selectedItem.innerHTML;
        $floatingItem.classList.add('floating-item');
        $floatingItem.style.height = $selectedItem.offsetHeight + 'px';
        $floatingItem.style.top = pos + 'px';
        $floatingItem.style['will-change'] = 'left, top';
         
        $section.appendChild($floatingItem);
        $itemFloat = $floatingItem;
        $itemSelected = $selectedItem;
        $selectedItem.style.opacity = 0;
         
        setTimeout(function() {
            var $imageWrapper = $floatingItem.querySelector('.imageWrapper');
            
            var $icon = document.getElementsByClassName('iconWinsm');

            angular.element($icon).css({"color":"#fff"});            
            $profile.style.zIndex = 1;
            $profile.classList.add('show');
            $floatingItem.style.top = '16px';
            $floatingItem.classList.add('centered');
        }, 50);
         
        setTimeout(function () {
            _animateInfo(true);
        }, 600);
 
    }
     
    function _animateInfo(show) {
        return new Promise(function(resolve, reject) {
            var $contentItems = document.querySelectorAll('.profile li'),
            i = 0, length = $contentItems.length, arr = [];
         
            if (length === 0) return;
 
            for (i = 0; i < length; i++) {
                arr.push($contentItems[i]);
            }
 
            i = show ? 0 : length;
            arr.forEach(function(item) {
                var delay = (show ? i++ : i--) * contentSpeed;
 
                setTimeout(function(){
                    if (show)
                        item.classList.add('show');
                    else
                        item.classList.remove('show');
                     
                    hasFinished(delay);
                }, delay);
            });
             
            function hasFinished(d) {
                if (d === ((length - 1) * contentSpeed))
                    resolve();
            }
        });
    }
    
    $scope.confirmNegocio = function(e) {
        e.preventDefault();
        $scope.requestData = linksWs.requests[linksWs.request];
        confirmRequest = $ionicPopup.show({
            title : '<i class="icon-briefcase" style="font-size: 20px !important;"></i>  Corfirmaci&oacute;n de informaci&oacute;n',
            cssClass: 'storagePopup',
            scope: $scope,
            templateUrl: "templates/modalConfirm.html"
        });        
    };
    
    $scope.closeConfirm = function(e) {
        e.preventDefault();
        confirmRequest.close();       
    };    
    
    $scope.addNegocio = function(valid,e){
        e.preventDefault();
        if(valid){
            $scope.confirmbtn = true;
            $ionicLoading.show({});
            checkRed(function(red){
                if(red){     
                    //var dataPost = new Object();
                    var dataPost = [];
                    var formD = linksWs.requests[linksWs.request];
                    angular.forEach(formD, function(data, nombre) { 
                        if(nombre.indexOf("t_") == -1){
                            //var obj = {};
                            //obj[nombre] = data;
                            dataPost[nombre] = data;
                            //dataPost.push(obj);                    
                        }
                    }); 
                    formD = $scope.confirm;
                    angular.forEach(formD, function(data, nombre) { 
                        if(nombre.indexOf("t_") == -1){
                            var obj = {};
                            //obj[nombre] = data;
                            dataPost[nombre] = data;
                            //dataPost.push(obj);                    
                        }
                    });                           
                    dataPost['ID_USER_OWNER'] = linksWs.user;
                    dataPost['ID_USER_CPART'] = linksWs.requests[linksWs.request].ID_USER_OWNER;
                    
                    //var obj = {};
                    //obj['ID_USER_CPART'] = linksWs.user;                    
                    //dataPost.push(obj); 
                    console.log("post: "+JSON.stringify(dataPost));
                    onWsAction(linksWs.link_root+"/TTrade/newTrade.json",dataPost,function(responsePost){
                        //alert("calback response: "+JSON.stringify(responsePost));
                        $ionicLoading.hide();
                        if(!isBlank(responsePost.data)){
                            if(angular.isString(responsePost.data.tTrade)){
                                //console.log("143: "+responsePost.data.tTrade);
                                var alertPopup = $ionicPopup.alert({
                                    title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                    content: "Error: "+responsePost.data.tTrade,
                                    type : 'button-dark',
                                }).then(function(res) {
                                });                         
                            }else{
                                var alertPopup = $ionicPopup.alert({
                                    title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                                    content: 'Te interesa! Puedes Consultar este negocio en "Mis negocios" <br/> Cod: #'+responsePost.data.tTrade.COD_REF,
                                    type : 'button-dark',
                                }).then(function(res) {
                                    //linksWs.request = "";
                                    //linksWs.requests = "";
                                    confirmRequest.close();
                                    $scope.closeProfile(e);
                                    findRequest(linksWs.request);
                                });                      
                            }
                        }else{
                            var alertPopup = $ionicPopup.alert({
                                title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                content: "Error: "+responsePost.data.tTrade,
                                type : 'button-dark',
                            }).then(function(res) {
                            });                      
                            //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                        }
                    });
                }else{
                    $ionicLoading.hide();
                }
            });
            
        }else{
            $ionicPopup.alert({
                title: "Mensaje <i class='icon ion-close-circled error'></i>",
                content: "Error: datos fuera de rango",
                type : 'button-dark',
            }).then(function(res) {
            });              
        }
        
    };

    function findRequest(index){

        $scope.requests = linksWs.requests;
        angular.element($scroll).css({"height":(window.innerHeight-33)+"px"});
        //angular.element($section).css({"height":(window.innerHeight+10)+"px"});
        //linksWs.requests = linksWs.requests;
        $timeout(function() {
            ionicMaterialMotion.fadeSlideInRight({
                selector: '.animate-fade-slide-in-right .item'
            });
            ionicMaterialInk.displayEffect();
            $ionicLoading.hide();
        }, 3700);                        
      
    }
    findRequest();    
})
.controller('NegocioCtrl', function($scope, $http, $state, $stateParams, $timeout, $history, $ionicLoading, $ionicPopup, $mdDialog, ionicMaterialInk, ionicMaterialMotion, linksWs) {
    // Set Header
    $ionicLoading.show({});
    $scope.$parent.clearFabs();
    $timeout(function() {
        $scope.$parent.hideHeader();
    }, 0);      

    $scope.negocios = [];
    var $itemFloat, 
        $itemSelected, 
        $profile = document.querySelector('.profile'),
        $details = document.getElementsByClassName('details'),
        $scroll = document.getElementsByClassName('myScroll'),
        $divBack = document.getElementsByClassName('list-actions'),
        $divTitl = document.getElementsByClassName('list-title'),
        $section = $profile.parentNode,
        $list = $section.querySelector('ul'),
        pos,
        contentSpeed = 50;
    
    
    function DialogController($scope, $mdDialog) {
        $scope.negocioCpart = [];
        $scope.negocioCpart = linksWs.negocios[linksWs.negocio];
        
        $scope.hide = function() {
            $mdDialog.hide();
        };

        $scope.cancel = function() {
            $mdDialog.cancel();
        };

        $scope.answer = function(answer) {
            $mdDialog.hide(answer);
        };
        
        $scope.callNumber = function(evento) {
            evento.preventDefault();
            var numercall = $scope.negocioCpart.t_user_cpart.PHONE_MOBILE_COUNTRY+$scope.negocioCpart.t_user_cpart.PHONE_MOBILE_NUM;
            //alert(numercall);
            if(window.plugins){
                window.plugins.CallNumber.callNumber(function(resultSuccess){
                    console.log("Success:"+resultSuccess);
                }, function(resultError) {
                    console.log("Error:"+resultError);
                }, numercall, true);               
            }else{
                var alertCallNumber = $ionicPopup.alert({
                    title: 'No se puede realizar la llamada',
                    type : 'button-dark',
                });               
            }
        }; 
        
        /* view Chat */
        $scope.initChat = function(evento) {
            $mdDialog.cancel();
            $state.go('app.chat');
        };
        
    }
    
    $scope.userCpart = function(ev) {
        $mdDialog.show({
            controller: DialogController,
            templateUrl: 'templates/userInfo.html',
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose:true,
            fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
        })
        .then(function(answer) {
            //yes
        }, function() {
            // cancel
        });
    };
    
    $scope.closeProfile = function(e) {
        e.preventDefault();
        
        var $profile = document.querySelector('.profile'),
            $section = $profile.parentNode;
         
        _animateInfo(false)
            .then(function(){
             
            setTimeout(function(){
                var $icons = document.getElementsByClassName('iconWinsm');

                angular.element($icons).css({"color":"#04204a"});
                
                $profile.classList.remove('show');
                $itemFloat.style.top = pos + 'px';
                $itemFloat.classList.remove('centered');
            }, contentSpeed * 2);
 
            setTimeout(function() {
                $itemSelected.style.opacity = 1;
            }, 500);
 
            setTimeout(function() {
                $section.removeChild($itemFloat);
            }, 600); 
            angular.element($divBack).css({"display": "block"});
            angular.element($divTitl).css({"display": "block"});
            angular.element($section).attr("style","margin-top: 5% !important");
        });
    }
     
    $scope.showProfile = function(e, i) {
        e.preventDefault();
        
        angular.element($divBack).css({"display": "none"});
        angular.element($divTitl).css({"display": "none"});
        $scope.$parent.hideHeader();
        angular.element($section).attr("style","margin-top: 0% !important");
        var $selectedItem = e.target.closest('a'),
            $floatingItem = document.createElement('div');
         
        $scope.negocio = $scope.negocios[i];
        linksWs.negocio = i;
        
        pos = ($selectedItem.offsetTop - $list.scrollTop);
         
        $floatingItem.innerHTML = $selectedItem.innerHTML;
        $floatingItem.classList.add('floating-item');
        $floatingItem.style.height = $selectedItem.offsetHeight + 'px';
        $floatingItem.style.top = pos + 'px';
        $floatingItem.style['will-change'] = 'left, top';
         
        $section.appendChild($floatingItem);
        $itemFloat = $floatingItem;
        $itemSelected = $selectedItem;
        $selectedItem.style.opacity = 0;
         
        if($scope.negocio.ID_USER_OWNER == linksWs.user){
            
            $btnDelete = document.querySelector('.delete-button');
            angular.element($btnDelete).css({"display":"block"});
       
        }else{
            if($scope.negocio.ID_USER_CPART == linksWs.user){
                $btnDelete = document.querySelector('.delete-button');
                angular.element($btnDelete).css({"display":"block"});
           
            }
        }
        
        setTimeout(function() {
            var $imageWrapper = $floatingItem.querySelector('.imageWrapperTrade');
            var $icons = document.getElementsByClassName('iconWinsm');

            angular.element($icons).css({"color":"#fff"});            
            $profile.style.zIndex = 1;
            $profile.classList.add('show');
            $floatingItem.style.top = '16px';
            $floatingItem.classList.add('centered');
            angular.element($details).css({"height":(window.innerHeight-145)+"px"});
            
        }, 50);
         
        setTimeout(function () {
            _animateInfo(true);
        }, 600);
 
    }
     
    function _animateInfo(show) {
        return new Promise(function(resolve, reject) {
            var $contentItems = document.querySelectorAll('.profile li'),
            i = 0, length = $contentItems.length, arr = [];
         
            if (length === 0) return;
 
            for (i = 0; i < length; i++) {
                arr.push($contentItems[i]);
            }
 
            i = show ? 0 : length;
            arr.forEach(function(item) {
                var delay = (show ? i++ : i--) * contentSpeed;
 
                setTimeout(function(){
                    if (show)
                        item.classList.add('show');
                    else
                        item.classList.remove('show');
                     
                    hasFinished(delay);
                }, delay);
            });
             
            function hasFinished(d) {
                if (d === ((length - 1) * contentSpeed))
                    resolve();
            }
        });
    }
    //var redOn = 0;
    $scope.deleteTrade = function(ev) {
        ev.stopPropagation();
        $ionicPopup.show({
            cssClass: 'confirmDeletePopup',
            title: '&#191;Seguro que no le intersa el Negocio &#63;',
            /*subTitle: 'Are you sure you want to create this case?',*/
            buttons: [{
                text: 'No',
                onTap: function(e) {
                    return 0;
                }
            }, {
                text: 'Si',
                type: 'button-positive',
                onTap: function(e) {
                    return 1;
                }
            }, ]
        }).then(function(res) {
            //redOn += 1;
            if (res === 1) {
                //console.log('ok clicked');
                //if(redOn < 2){
                    checkRed(function(red){
                        if(red){   
                            $ionicLoading.show({});
                            var dataPost = new Object();
                            var formD = linksWs.negocios[linksWs.negocio];
                            angular.forEach(formD, function(data, nombre) { 
                                if(nombre.indexOf("t_") == -1){
                                    //var obj = {};
                                    //obj[nombre] = data;
                                    dataPost[nombre] = data;
                                    //dataPost.push({nombre:data});                    
                                }
                            }); 
                            dataPost['USER'] = linksWs.user;
                            onWsAction(linksWs.link_root+"/TTrade/deleteTrade.json",dataPost,function(responsePost){
                                //alert("calback response: "+JSON.stringify(responsePost));
                                $ionicLoading.hide();

                                if(!isBlank(responsePost.data)){
                                    if(angular.isString(responsePost.data.tTrade)){
                                        //console.log("143: "+responsePost.data.tRequest);
                                        var alertPopup = $ionicPopup.alert({
                                            title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                            content: "Error: "+responsePost.data.tTrade,
                                            type : 'button-dark',
                                        }).then(function(res) {
                                        });                         
                                    }else{
                                        var alertPopup = $ionicPopup.alert({
                                            title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                                            content: "Negocio Borrado con &eacute;xito",
                                            type : 'button-dark',
                                        }).then(function(res) {
                                            $scope.closeProfile(ev);
                                            findTrade(linksWs.negocio);
                                        });                      
                                    }
                                }else{
                                    var alertPopup = $ionicPopup.alert({
                                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                        content: "Error: "+responsePost.data.tTrade,
                                        type : 'button-dark',
                                    }).then(function(res) {
                                    });                      
                                    //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                                }
                            });
                        }
                    });                
                //}                
            } else if (res === 0) {
                console.log('cancel clicked');
            }            

        });        
    }; 
    
    $scope.initTrade = function(ev) {
        ev.preventDefault();
        $ionicPopup.show({
            cssClass: 'confirmDeletePopup',
            title: '&#191;Seguro que le intersa Iniciar el Negocio &#63;',
            /*subTitle: 'Are you sure you want to create this case?',*/
            buttons: [{
                text: 'No',
                onTap: function(e) {
                    return 0;
                }
            }, {
                text: 'Si',
                type: 'button-positive',
                onTap: function(e) {
                    return 1;
                }
            }, ]
        }).then(function(res) {
            //redOn += 1;
            if (res === 1) {
                //console.log('ok clicked');
                //if(redOn < 2){
                    checkRed(function(red){
                        if(red){   
                            $ionicLoading.show({});
                            var dataPost = new Object();
                            var formD = linksWs.negocios[linksWs.negocio];
                            angular.forEach(formD, function(data, nombre) { 
                                if(nombre.indexOf("t_") == -1){
                                    //var obj = {};
                                    //obj[nombre] = data;
                                    dataPost[nombre] = data;
                                    //dataPost.push({nombre:data});                    
                                }
                            }); 
                            dataPost['ID_TP_STATUS_TRADE'] = 101;
                            dataPost['USER'] = linksWs.user;
                            onWsAction(linksWs.link_root+"/TTrade/confirmTrade.json",dataPost,function(responsePost){
                                //alert("calback response: "+JSON.stringify(responsePost));
                                $ionicLoading.hide();

                                if(!isBlank(responsePost.data)){
                                    if(angular.isString(responsePost.data.tTrade)){
                                        //console.log("143: "+responsePost.data.tRequest);
                                        var alertPopup = $ionicPopup.alert({
                                            title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                            content: "Error: "+responsePost.data.tTrade,
                                            type : 'button-dark',
                                        }).then(function(res) {
                                        });                         
                                    }else{
                                        var alertPopup = $ionicPopup.alert({
                                            title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                                            content: "Negocio Iniciado con &eacute;xito",
                                            type : 'button-dark',
                                        }).then(function(res) {
                                            linksWs.negocios[linksWs.negocio] = responsePost.data.tTrade[0];
                                            $scope.negocios = linksWs.negocios; 
                                            //console.log($scope.negocios[linksWs.negocio]);
                                            $timeout(function() {
                                                $scope.closeProfile(ev);
                                            }, 303);                                            
                                            
                                            //findTrade(linksWs.negocio);
                                        });                      
                                    }
                                }else{
                                    var alertPopup = $ionicPopup.alert({
                                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                        content: "Error: "+responsePost.data.tTrade,
                                        type : 'button-dark',
                                    }).then(function(res) {
                                    });                      
                                    //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                                }
                            });
                        }
                    });                
                //}                
            } else if (res === 0) {
                console.log('cancel clicked');
            }            

        });           
    }; 
    
    $scope.confirmCPartTrade = function(ev) {
        ev.preventDefault();
        $ionicPopup.show({
            cssClass: 'confirmDeletePopup',
            title: '&#191;Seguro de Confirmar el Negocio &#63;',
            /*subTitle: 'Are you sure you want to create this case?',*/
            buttons: [{
                text: 'No',
                onTap: function(e) {
                    return 0;
                }
            }, {
                text: 'Si',
                type: 'button-positive',
                onTap: function(e) {
                    return 1;
                }
            }, ]
        }).then(function(res) {
            //redOn += 1;
            if (res === 1) {
                //console.log('ok clicked');
                //if(redOn < 2){
                    checkRed(function(red){
                        if(red){   
                            $ionicLoading.show({});
                            var dataPost = new Object();
                            var formD = linksWs.negocios[linksWs.negocio];
                            angular.forEach(formD, function(data, nombre) { 
                                if(nombre.indexOf("t_") == -1){
                                    //var obj = {};
                                    //obj[nombre] = data;
                                    dataPost[nombre] = data;
                                    //dataPost.push({nombre:data});                    
                                }
                            }); 
                            dataPost['ID_TP_STATUS_TRADE'] = 102;
                            dataPost['USER'] = linksWs.user;
                            onWsAction(linksWs.link_root+"/TTrade/confirmTrade.json",dataPost,function(responsePost){
                                //alert("calback response: "+JSON.stringify(responsePost));
                                $ionicLoading.hide();

                                if(!isBlank(responsePost.data)){
                                    if(angular.isString(responsePost.data.tTrade)){
                                        //console.log("143: "+responsePost.data.tRequest);
                                        var alertPopup = $ionicPopup.alert({
                                            title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                            content: "Error: "+responsePost.data.tTrade,
                                            type : 'button-dark',
                                        }).then(function(res) {
                                        });                         
                                    }else{
                                        var alertPopup = $ionicPopup.alert({
                                            title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                                            content: "Negocio Confirmado con &eacute;xito",
                                            type : 'button-dark',
                                        }).then(function(res) {
                                            linksWs.negocios[linksWs.negocio] = responsePost.data.tTrade[0];
                                            $scope.negocios = linksWs.negocios; 
                                            $scope.closeProfile(ev);
                                            //findTrade(linksWs.negocio);
                                        });                      
                                    }
                                }else{
                                    var alertPopup = $ionicPopup.alert({
                                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                        content: "Error: "+responsePost.data.tTrade,
                                        type : 'button-dark',
                                    }).then(function(res) {
                                    });                      
                                    //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                                }
                            });
                        }
                    });                
                //}                
            } else if (res === 0) {
                console.log('cancel clicked');
            }            

        });              
    }; 
    
    $scope.confirmOwnerTrade = function(ev) {
        ev.preventDefault();
        $ionicPopup.show({
            cssClass: 'confirmDeletePopup',
            title: '&#191;Seguro de Confirmar el Negocio &#63;',
            /*subTitle: 'Are you sure you want to create this case?',*/
            buttons: [{
                text: 'No',
                onTap: function(e) {
                    return 0;
                }
            }, {
                text: 'Si',
                type: 'button-positive',
                onTap: function(e) {
                    return 1;
                }
            }, ]
        }).then(function(res) {
            //redOn += 1;
            if (res === 1) {
                //console.log('ok clicked');
                //if(redOn < 2){
                    checkRed(function(red){
                        if(red){   
                            $ionicLoading.show({});
                            var dataPost = new Object();
                            var formD = linksWs.negocios[linksWs.negocio];
                            angular.forEach(formD, function(data, nombre) { 
                                if(nombre.indexOf("t_") == -1){
                                    //var obj = {};
                                    //obj[nombre] = data;
                                    dataPost[nombre] = data;
                                    //dataPost.push({nombre:data});                    
                                }
                            }); 
                            dataPost['ID_TP_STATUS_TRADE'] = 103;
                            dataPost['USER'] = linksWs.user;
                            onWsAction(linksWs.link_root+"/TTrade/confirmTrade.json",dataPost,function(responsePost){
                                //alert("calback response: "+JSON.stringify(responsePost));
                                $ionicLoading.hide();

                                if(!isBlank(responsePost.data)){
                                    if(angular.isString(responsePost.data.tTrade)){
                                        //console.log("143: "+responsePost.data.tRequest);
                                        var alertPopup = $ionicPopup.alert({
                                            title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                            content: "Error: "+responsePost.data.tTrade,
                                            type : 'button-dark',
                                        }).then(function(res) {
                                        });                         
                                    }else{
                                        var alertPopup = $ionicPopup.alert({
                                            title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                                            content: "Negocio Confirmado con &eacute;xito",
                                            type : 'button-dark',
                                        }).then(function(res) {
                                            linksWs.negocios[linksWs.negocio] = responsePost.data.tTrade[0];
                                            $scope.negocios = linksWs.negocios; 
                                            $scope.closeProfile(ev);
                                            //findTrade(linksWs.negocio);
                                        });                      
                                    }
                                }else{
                                    var alertPopup = $ionicPopup.alert({
                                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                        content: "Error: "+responsePost.data.tTrade,
                                        type : 'button-dark',
                                    }).then(function(res) {
                                    });                      
                                    //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                                }
                            });
                        }
                    });                
                //}                
            } else if (res === 0) {
                console.log('cancel clicked');
            }            

        });         
       
    }; 
    
    $scope.finishTrade = function(ev) {
        ev.preventDefault();
        $ionicPopup.show({
            cssClass: 'confirmDeletePopup',
            title: '&#191;Seguro de Terminar el Negocio &#63;',
            /*subTitle: 'Are you sure you want to create this case?',*/
            buttons: [{
                text: 'No',
                onTap: function(e) {
                    return 0;
                }
            }, {
                text: 'Si',
                type: 'button-positive',
                onTap: function(e) {
                    return 1;
                }
            }, ]
        }).then(function(res) {
            //redOn += 1;
            if (res === 1) {
                //console.log('ok clicked');
                //if(redOn < 2){
                    checkRed(function(red){
                        if(red){   
                            $ionicLoading.show({});
                            var dataPost = new Object();
                            var formD = linksWs.negocios[linksWs.negocio];
                            angular.forEach(formD, function(data, nombre) { 
                                if(nombre.indexOf("t_") == -1){
                                    //var obj = {};
                                    //obj[nombre] = data;
                                    dataPost[nombre] = data;
                                    //dataPost.push({nombre:data});                    
                                }
                            }); 
                            dataPost['ID_TP_STATUS_TRADE'] = 104;
                            dataPost['USER'] = linksWs.user;
                            onWsAction(linksWs.link_root+"/TTrade/confirmTrade.json",dataPost,function(responsePost){
                                //alert("calback response: "+JSON.stringify(responsePost));
                                $ionicLoading.hide();

                                if(!isBlank(responsePost.data)){
                                    if(angular.isString(responsePost.data.tTrade)){
                                        //console.log("143: "+responsePost.data.tRequest);
                                        var alertPopup = $ionicPopup.alert({
                                            title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                            content: "Error: "+responsePost.data.tTrade,
                                            type : 'button-dark',
                                        }).then(function(res) {
                                        });                         
                                    }else{
                                        var alertPopup = $ionicPopup.alert({
                                            title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                                            content: "Negocio Terminado con &eacute;xito",
                                            type : 'button-dark',
                                        }).then(function(res) {
                                            linksWs.negocios[linksWs.negocio] = responsePost.data.tTrade[0];
                                            $scope.negocios = linksWs.negocios; 
                                            $scope.closeProfile(ev);
                                            //findTrade(linksWs.negocio);
                                        });                      
                                    }
                                }else{
                                    var alertPopup = $ionicPopup.alert({
                                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                        content: "Error: "+responsePost.data.tTrade,
                                        type : 'button-dark',
                                    }).then(function(res) {
                                    });                      
                                    //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                                }
                            });
                        }
                    });                
                //}                
            } else if (res === 0) {
                console.log('cancel clicked');
            }            

        });                  
    }; 
    
    $scope.cancelTrade = function(ev) {
        ev.preventDefault();
        $ionicPopup.show({
            cssClass: 'confirmDeletePopup',
            title: '&#191;Seguro de Cancelar el Negocio &#63;',
            /*subTitle: 'Are you sure you want to create this case?',*/
            buttons: [{
                text: 'No',
                onTap: function(e) {
                    return 0;
                }
            }, {
                text: 'Si',
                type: 'button-positive',
                onTap: function(e) {
                    return 1;
                }
            }, ]
        }).then(function(res) {
            //redOn += 1;
            if (res === 1) {
                //console.log('ok clicked');
                //if(redOn < 2){
                    checkRed(function(red){
                        if(red){   
                            $ionicLoading.show({});
                            var dataPost = new Object();
                            var formD = linksWs.negocios[linksWs.negocio];
                            angular.forEach(formD, function(data, nombre) { 
                                if(nombre.indexOf("t_") == -1){
                                    //var obj = {};
                                    //obj[nombre] = data;
                                    dataPost[nombre] = data;
                                    //dataPost.push({nombre:data});                    
                                }
                            }); 
                            dataPost['ID_TP_STATUS_TRADE'] = 105;
                            dataPost['USER'] = linksWs.user;
                            onWsAction(linksWs.link_root+"/TTrade/confirmTrade.json",dataPost,function(responsePost){
                                //alert("calback response: "+JSON.stringify(responsePost));
                                $ionicLoading.hide();

                                if(!isBlank(responsePost.data)){
                                    if(angular.isString(responsePost.data.tTrade)){
                                        //console.log("143: "+responsePost.data.tRequest);
                                        var alertPopup = $ionicPopup.alert({
                                            title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                            content: "Error: "+responsePost.data.tTrade,
                                            type : 'button-dark',
                                        }).then(function(res) {
                                        });                         
                                    }else{
                                        var alertPopup = $ionicPopup.alert({
                                            title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                                            content: "Negocio Cancelado con &eacute;xito",
                                            type : 'button-dark',
                                        }).then(function(res) {
                                            linksWs.negocios[linksWs.negocio] = responsePost.data.tTrade[0];
                                            $scope.negocios = linksWs.negocios; 
                                            $scope.closeProfile(ev);
                                            //findTrade(linksWs.negocio);
                                        });                      
                                    }
                                }else{
                                    var alertPopup = $ionicPopup.alert({
                                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                        content: "Error: "+responsePost.data.tTrade,
                                        type : 'button-dark',
                                    }).then(function(res) {
                                    });                      
                                    //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                                }
                            });
                        }
                    });                
                //}                
            } else if (res === 0) {
                console.log('cancel clicked');
            }            

        });        
     
    }; 
        
    function findTrade(index){
        checkRed(function(red){
            if(red){
                onWsAction(linksWs.link_root+"/TTrade/find.json",{user:linksWs.user},function(responsePost){
                    //alert("calback response: "+JSON.stringify(responsePost.data));
                    if(!isBlank(responsePost.data)){
                        //linksWs.request = responsePost.data.tRequest;
                        linksWs.negocios = responsePost.data.tTrade;
                        $scope.user = linksWs.user;
                        if(angular.isString(linksWs.negocios)){
                            $ionicLoading.hide();
                            linksWs.negocios = "";
                            var alertPopup = $ionicPopup.alert({
                                title: "No posee Negocios Activos",
                                type : 'button-dark',
                            });
                            //alert(linksWs.couponInfo);
                        }else{
                            $scope.negocios = linksWs.negocios;
                            angular.element($scroll).css({"height":(window.innerHeight-33)+"px"});
                            //angular.element($section).css({"height":(window.innerHeight+10)+"px"});
                            //linksWs.requests = linksWs.requests;
                            $timeout(function() {
                                ionicMaterialMotion.fadeSlideInRight({
                                    selector: '.animate-fade-slide-in-right .item'
                                });
                                ionicMaterialInk.displayEffect();
                                $ionicLoading.hide();
                            }, 3700);                        
                        }
                    }else{
                        $ionicLoading.hide();
                        linksWs.negocios = "";
                        var alertPopup = $ionicPopup.alert({
                            title: "Error con el servidor, Reinicie la Aplicaci&oacute;n",
                            type : 'button-dark',
                        });                            

                    }
                });                
            }else{
                var alertPopup = $ionicPopup.alert({
                    title: "Sin Conexi&oacute;n, Reinicie la Aplicaci&oacute;n",
                    type : 'button-dark',
                });
            }
        });       
    }
    findTrade();
    
    $scope.back = function(e){
        //$history.back();
        $state.go('app.home');
    }    
})
.controller('AlarmaCtrl', function($scope, $timeout, $rootScope, $state, $stateParams, $location, $ionicHistory, $history, $ionicPopup,  $ionicLoading, $mdDialog, ionicMaterialMotion, ionicMaterialInk, linksWs) {
    
    $scope.$parent.clearFabs();
    $timeout(function() {
        $scope.$parent.hideHeader();
    }, 0); 
    
    $scope.cancelar = function() {
        $state.go('app.alarmaList');
    };
    
    $ionicLoading.show({});
   
    var counterBlock = 0;
    function validateLoadComplete() {
        counterBlock++;
        if (counterBlock === 7) {
            counterBlock = 0;
            // Set Motion
            $timeout(function() {
                ionicMaterialMotion.fadeSlideIn({
                    selector: '.animate-fade-slide-in .item'
                });
            }, 200);

            // Activate ink for controller
            ionicMaterialInk.displayEffect();            
            $ionicLoading.hide();
        }
    } 
    
    $scope.formAlarm = {};    
    
    if(!isBlank(linksWs.tp)){
        $scope.tproductos = linksWs.tp;
        validateLoadComplete();      
    }else{ 
        onWsAction(linksWs.link_root+"/TCategoryProd.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tCategoryProd)){
                    console.log("3141: "+responsePost.data.tCategoryProd);
                }else{  
                    linksWs.tp = responsePost.data.tCategoryProd;
                    $scope.tproductos = responsePost.data.tCategoryProd;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 3149: "+JSON.stringify(responsePost));    
            }
        }); 
    }
    
    if(!isBlank(linksWs.pt)){
        $scope.toperaciones = linksWs.pt;
        validateLoadComplete();      
    }else{       
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_PRICE_INFO'},function(responsePost){
           // alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("3161: "+responsePost.data.tTypes);
                }else{  
                    linksWs.pt = responsePost.data.tTypes;
                    $scope.toperaciones = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 3170: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.op)){
        $scope.operaciones = linksWs.op;
        validateLoadComplete();      
    }else{
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'OPERATION'},function(responsePost){
           // alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("291: "+responsePost.data.tTypes);
                }else{  
                    linksWs.op = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.po)){
        $scope.posicion = linksWs.po;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TPosition/index.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tPosition)){
                    console.log("471: "+responsePost.data.tPosition);
                }else{  
                    linksWs.po = responsePost.data.tPosition;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }
    
    if(!isBlank(linksWs.pp)){
        $scope.productos = linksWs.pp;
        validateLoadComplete();      
    }else{       
        // for other stuff ...
        onWsAction(linksWs.link_root+"/TProductsPrice/getall.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tProductsPrice)){
                    $ionicLoading.hide();
                    $scope.productos = [];
                    console.log("3186: "+responsePost.data.tProductsPrice);
                }else{  
                    linksWs.pp = responsePost.data.tProductsPrice;
                    $scope.productos = responsePost.data.tProductsPrice;
                    validateLoadComplete();      
                }
            }else{
                validateLoadComplete();      
                console.log("calback token no set 3194: "+JSON.stringify(responsePost));    
            }
        });            
    }
    
    if(!isBlank(linksWs.mo)){
        $scope.monedas = linksWs.mo;
        validateLoadComplete();      
    }else{     
        onWsAction(linksWs.link_root+"/TCurrency.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tCurrency)){
                    console.log("3207: "+responsePost.data.tCurrency);
                }else{  
                    linksWs.mo = responsePost.data.tCurrency;
                    $scope.monedas = responsePost.data.tCurrency;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 3215: "+JSON.stringify(responsePost));    
            }
        });
    }

    if(!isBlank(linksWs.lp)){
        $scope.lugares = linksWs.lp;
        validateLoadComplete();      
    }else{     
        onWsAction(linksWs.link_root+"/TTypePricePlaces/find.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypePricePlaces)){
                    console.log("3228: "+responsePost.data.tTypePricePlaces);
                }else{  
                    linksWs.lp = responsePost.data.tTypePricePlaces;
                    $scope.lugares = responsePost.data.tTypePricePlaces;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 3236: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    $scope.submitForm = function(valid) {  
        if (valid) {
            $ionicLoading.show({});
            $scope.formAlarm.ID_USER = linksWs.user;
            //var dataPost = [];
            //console.log(this.formData);
            var dataPost = [];
            //console.log(this.formData);
            var formD = this.formAlarm;
            angular.forEach(this.formAlarm, function(data, nombre) { 
                if(nombre.indexOf("t_") == -1){
                    var obj = {};
                    obj[nombre] = data;
                    dataPost[nombre] = data;
                }
            });           
            
            onWsAction(linksWs.link_root+"/TAlarms/newAlarm.json",dataPost,function(responsePost){
                //alert("calback response: "+JSON.stringify(responsePost));
                $ionicLoading.hide();
                if(!isBlank(responsePost.data)){
                    if(angular.isString(responsePost.data.tAlarm)){
                        //console.log("143: "+responsePost.data.tRequest);
                        var alertPopup = $ionicPopup.alert({
                            title: "Mensaje <i class='icon ion-close-circled error'></i>",
                            content: "Error: "+responsePost.data.tAlarm,
                            type : 'button-dark',
                        }).then(function(res) {
                        });                         
                    }else{
                        var alertPopup = $ionicPopup.alert({
                            title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                            content: "Alarma configurada con &eacute;xito",
                            type : 'button-dark',
                        }).then(function(res) {

                            $history.back();
                        });                      
                    }
                }else{
                    var alertPopup = $ionicPopup.alert({
                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                        content: "Error: "+responsePost.data.tAlarm,
                        type : 'button-dark',
                    }).then(function(res) {
                    });                      
                    //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                }
            });            
        } else {
            $ionicPopup.alert({
                title: "Mensaje <i class='icon ion-close-circled error'></i>",
                content: "Faltan campos por llenar ",
                type : 'button-dark',
            }).then(function(res) {
            });             
            //console.log(JSON.stringify($scope.newRequest));
        }        
        
    };
    
    $scope.changeValue = function(value) {
        if(value == 0){
            $scope.formAlarm.ID_TP_OPERATION = "";
        }
    };    
    
    $scope.validCombo = function(value){
        if(value == 300){//pos
            $scope.formAlarm.ID_PLACE_PRICE = "";
        }else{
            if(value == 301){//pri
                $scope.formAlarm.ID_POSITION = "";
            }
        }        
    };
    
})
.controller('AlarmaListCtrl', function($scope, $http, $state, $stateParams, $timeout, $history, $ionicLoading, $ionicPopup, ionicMaterialInk, ionicMaterialMotion, linksWs) {
    // Set Header
    $ionicLoading.show({});
    
    $timeout(function() {
        $scope.$parent.hideHeader();
        //$scope.isExpanded = false;
        //$scope.$parent.setExpanded(false);        
        
    }, 0);      

    $scope.alarms = [];
    var $itemFloat, 
        $itemSelected, 
        $profile = document.querySelector('.profile'),
        $details = document.getElementsByClassName('details'),
        $scroll = document.getElementsByClassName('myScroll'),
        
        $divBack = document.getElementsByClassName('list-actions'),
        $divTitl = document.getElementsByClassName('list-title'),
        $section = $profile.parentNode,
        $list = $section.querySelector('ul'),
        pos,
        contentSpeed = 50;
    

    $scope.closeProfile = function(e) {
        e.preventDefault();
        
        var $profile = document.querySelector('.profile'),
            $section = $profile.parentNode;
         
        _animateInfo(false)
            .then(function(){
             
            setTimeout(function(){
                var $icons = document.getElementsByClassName('iconWinsm');

                angular.element($icons).css({"color":"#04204a"});                
                $profile.classList.remove('show');
                $itemFloat.style.top = pos + 'px';
                $itemFloat.classList.remove('centered');
            }, contentSpeed * 2);
 
            setTimeout(function() {
                $itemSelected.style.opacity = 1;
            }, 500);
 
            setTimeout(function() {
                $section.removeChild($itemFloat);
            }, 600); 
            //$scope.$parent.showHeader();
            //$divBack.style.display = 'block';
            angular.element($divBack).css({"display": "block"});
            angular.element($divTitl).css({"display": "block"});
            angular.element($section).attr("style","margin-top: 5% !important");
        });
    }
     
    $scope.showProfile = function(e, i) {
        e.preventDefault();
        //$divBack.style.display = 'none';
        angular.element($divBack).css({"display": "none"});
        angular.element($divTitl).css({"display": "none"});
        $scope.$parent.hideHeader();
        angular.element($section).attr("style","margin-top: 0% !important");
        var $selectedItem = e.target.closest('a'),
            $floatingItem = document.createElement('div');
         
        $scope.alarm = $scope.alarms[i];
        linksWs.alarm = i;
        
        pos = ($selectedItem.offsetTop - $list.scrollTop);
         
        $floatingItem.innerHTML = $selectedItem.innerHTML;
        $floatingItem.classList.add('floating-item');
        $floatingItem.style.height = $selectedItem.offsetHeight + 'px';
        $floatingItem.style.top = pos + 'px';
        $floatingItem.style['will-change'] = 'left, top';
         
        $section.appendChild($floatingItem);
        $itemFloat = $floatingItem;
        $itemSelected = $selectedItem;
        $selectedItem.style.opacity = 0;
         
        setTimeout(function() {
            var $imageWrapper = $floatingItem.querySelector('.imageWrapper');
            var $icon = document.getElementsByClassName('iconWinsm');
            
            angular.element($icon).css({"color":"#fff"});
            $profile.style.zIndex = 2;
            $profile.classList.add('show');
            $floatingItem.style.top = '16px';
            $floatingItem.classList.add('centered');
            //angular.element($details).css({"height":(window.innerHeight-145)+"px"});
            //angular.element($details).css({"overflow-x":"hidden"});
            //angular.element($details).css({"overflow-y":"scroll"});
            
        }, 50);
         
        setTimeout(function () {
            _animateInfo(true);
        }, 600);
 
    }
     
    function _animateInfo(show) {
        return new Promise(function(resolve, reject) {
            var $contentItems = document.querySelectorAll('.profile li'),
            i = 0, length = $contentItems.length, arr = [];
         
            if (length === 0) return;
 
            for (i = 0; i < length; i++) {
                arr.push($contentItems[i]);
            }
 
            i = show ? 0 : length;
            arr.forEach(function(item) {
                var delay = (show ? i++ : i--) * contentSpeed;
 
                setTimeout(function(){
                    if (show)
                        item.classList.add('show');
                    else
                        item.classList.remove('show');
                     
                    hasFinished(delay);
                }, delay);
            });
             
            function hasFinished(d) {
                if (d === ((length - 1) * contentSpeed))
                    resolve();
            }
        });
    }
    
    $scope.editAlarm = function(e) {
        e.preventDefault();
        $ionicLoading.show({});
        $state.go('app.alarmaEdit');
    }; 
    
    $scope.deleteAlarm = function(ev) {
        ev.preventDefault();
        
        $ionicPopup.show({
            cssClass: 'confirmDeletePopup',
            title: '&#191;Est&aacute; seguro de Eliminar la Alarma &#63;',
            /*subTitle: 'Are you sure you want to create this case?',*/
            buttons: [{
                text: 'No',
                onTap: function(e) {
                    return 0;
                }
            }, {
                text: 'Si',
                type: 'button-positive',
                onTap: function(e) {
                    return 1;
                }
            }, ]
        }).then(function(res) {
            if (res === 1) {
                //console.log('ok clicked');
                checkRed(function(red){
                    if(red){   
                        $ionicLoading.show({});
                        var dataPost = new Object();
                        var formD = linksWs.alarms[linksWs.alarm];
                        angular.forEach(formD, function(data, nombre) { 
                            if(nombre.indexOf("t_") == -1){
                                //var obj = {};
                                //obj[nombre] = data;
                                dataPost[nombre] = data;
                                //dataPost.push({nombre:data});                    
                            }
                        }); 
                        onWsAction(linksWs.link_root+"/TAlarms/deleteAlarm.json",dataPost,function(responsePost){
                            //alert("calback response: "+JSON.stringify(responsePost));
                            $ionicLoading.hide();
                            if(!isBlank(responsePost.data)){
                                if(angular.isString(responsePost.data.tAlarm)){
                                    //console.log("143: "+responsePost.data.tRequest);
                                    $ionicPopup.alert({
                                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                        content: "Error: "+responsePost.data.tAlarm,
                                        type : 'button',
                                    }).then(function(res) {
                                    });                         
                                }else{
                                    $ionicPopup.alert({
                                        title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                                        content: "Alarma Eliminada con &eacute;xito",
                                        type : 'button',
                                    }).then(function(res) {
                                        //linksWs.alarm = "";
                                        //linksWs.alarms = "";
                                        $scope.closeProfile(ev);
                                        validAlarm(linksWs.alarm);
                                    });                      
                                }
                            }else{
                                $ionicPopup.alert({
                                    title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                    content: "Error: "+responsePost.data.tAlarm,
                                    type : 'button',
                                }).then(function(res) {
                                });                      
                                //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                            }
                        });
                    }
                });
                                
            } else if (res === 0) {
                //console.log('cancel clicked');
            }            

        });        
    }; 
    
    function validAlarm(index){
        
        checkRed(function(red){
            if(red){
                 if(!isBlank(linksWs.alarms)){
                    if(!angular.isUndefined(index)){
                        //linksWs.alarms.destroy(index);
                        linksWs.alarms.splice(index, 1);
                        //alert("Alarms: "+linksWs.alarms.length );
                        $scope.alarms = linksWs.alarms;
                        if(linksWs.alarms.length < 1){
                            $scope.alarms = null;
                            $ionicPopup.alert({
                                title: "No posee alarmas activas. Por favor crear nuevas alarmas",
                                type : 'button-dark',
                            });                            
                            //angular.element($scroll).css({"height":(window.innerHeight-33)+"px"});
                        }else{
                            $scope.alarms = linksWs.alarms;
                        }
                    }else{
                        $scope.alarms = null;
                        $ionicPopup.alert({
                            title: "No posee alarmas activas. Por favor crear nuevas alarmas",
                            type : 'button-dark',
                        });                        
                    }
                }else{
                    $scope.alarms = null;
                    $ionicPopup.alert({
                        title: "No posee alarmas activas. Por favor crear nuevas alarmas",
                        type : 'button-dark',
                    });                      
                }               
            } 
        });
    }
    
    function findAlarm(){
        checkRed(function(red){
            if(red){
                onWsAction(linksWs.link_root+"/TAlarms/find.json",{user:linksWs.user},function(responsePost){
                    //console.log("calback TRequest 3160: "+JSON.stringify(responsePost.data));
                    if(!isBlank(responsePost.data)){
                        //linksWs.request = responsePost.data.tAlarm;
                        linksWs.alarms = responsePost.data.tAlarm;
                        if(angular.isString(linksWs.alarms)){
                            linksWs.alarms = "";
                            $ionicLoading.hide();
                            var alertPopup = $ionicPopup.alert({
                                title: "No posee alarmas activas. Por favor crear nuevas alarmas",
                                type : 'button-dark',
                            });
                            $scope.alarms = null;
                            //alert(linksWs.couponInfo);
                        }else{
                            $scope.alarms = linksWs.alarms;
                            angular.element($scroll).css({"height":(window.innerHeight-33)+"px"});
                            //angular.element($section).css({"height":(window.innerHeight+10)+"px"});
                            //linksWs.requests = linksWs.requests;
                            $timeout(function() {
                                ionicMaterialMotion.fadeSlideInRight({
                                    selector: '.animate-fade-slide-in-right .item'
                                });
                                ionicMaterialInk.displayEffect();
                                $ionicLoading.hide();
                            }, 3700);                        
                        }
                    }else{
                        $ionicLoading.hide();
                        var alertPopup = $ionicPopup.alert({
                            title: "Error con el servidor, Reinicie la Aplicaci&oacute;n",
                            type : 'button-dark',
                        });                            
                        //alert("calback 623: "+JSON.stringify(responsePost));    
                    }
                });                

            }else{
                $ionicLoading.hide();
                var alertPopup = $ionicPopup.alert({
                    title: "No hay Red",
                    type : 'button-dark',
                });
            }
        });       
    }
    findAlarm();
    
    $scope.back = function(e){
        //$history.back();
        $state.go('app.home');
    }
    $scope.newAlarm = function() {
        $state.go('app.alarma');
    };    
})
.controller('AlarmaEditCtrl', function($scope, $rootScope, $state, $stateParams, $timeout, $filter, $ionicPopup, $ionicLoading, ionicMaterialInk, ionicMaterialMotion, $history,linksWs,ionicDatePicker) {
    $ionicLoading.show({});
    $scope.$parent.clearFabs();
    $timeout(function() {
        $scope.$parent.hideHeader();
    }, 0);      

    var counterBlock = 0;
    
    function validateLoadComplete() {
        counterBlock++;
        if (counterBlock === 7) {
            // for other stuff ...
            //$scope.formAlarm.tipoProducto = linksWs.alarms[linksWs.alarm].t_product.ID_CATEGORY_PROD;         
            counterBlock = 0;
            // Set Motion
            $timeout(function() {
                ionicMaterialMotion.fadeSlideIn({
                    selector: '.animate-fade-slide-in .item'
                });
                $scope.formAlarm = linksWs.alarms[linksWs.alarm];
            }, 200);
            
            // Activate ink for controller
            ionicMaterialInk.displayEffect();            
            $ionicLoading.hide();
        }else{
            $scope.formAlarm = linksWs.alarms[linksWs.alarm];
        }
    } 
    if(!isBlank(linksWs.tp)){
        $scope.tproductos = linksWs.tp;
        validateLoadComplete();      
    }else{ 
        onWsAction(linksWs.link_root+"/TCategoryProd.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tCategoryProd)){
                    console.log("3141: "+responsePost.data.tCategoryProd);
                }else{  
                    linksWs.tp = responsePost.data.tCategoryProd;
                    $scope.tproductos = responsePost.data.tCategoryProd;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 3149: "+JSON.stringify(responsePost));    
            }
        }); 
    }
    
    if(!isBlank(linksWs.pt)){
        $scope.toperaciones = linksWs.pt;
        validateLoadComplete();      
    }else{       
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'TYPE_PRICE_INFO'},function(responsePost){
           // alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("3161: "+responsePost.data.tTypes);
                }else{  
                    linksWs.pt = responsePost.data.tTypes;
                    $scope.toperaciones = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 3170: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.op)){
        $scope.operaciones = linksWs.op;
        validateLoadComplete();      
    }else{
        onWsAction(linksWs.link_root+"/TTypes/find.json",{type:'OPERATION'},function(responsePost){
           // alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypes)){
                    console.log("291: "+responsePost.data.tTypes);
                }else{  
                    linksWs.op = responsePost.data.tTypes;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        });
    }
    
    if(!isBlank(linksWs.po)){
        $scope.posicion = linksWs.po;
        validateLoadComplete();      
    }else{    
        onWsAction(linksWs.link_root+"/TPosition/index.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data.tTypes));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tPosition)){
                    console.log("471: "+responsePost.data.tPosition);
                }else{  
                    linksWs.po = responsePost.data.tPosition;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log(JSON.stringify(responsePost));    
            }
        }); 
    }
    
    if(!isBlank(linksWs.pp)){
        $scope.productos = linksWs.pp;
        validateLoadComplete();      
    }else{       
        // for other stuff ...
        onWsAction(linksWs.link_root+"/TProductsPrice/getall.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tProductsPrice)){
                    $ionicLoading.hide();
                    $scope.productos = [];
                    console.log("3186: "+responsePost.data.tProductsPrice);
                }else{  
                    linksWs.pp = responsePost.data.tProductsPrice;
                    $scope.productos = responsePost.data.tProductsPrice;
                    validateLoadComplete();      
                }
            }else{
                validateLoadComplete();      
                console.log("calback token no set 3194: "+JSON.stringify(responsePost));    
            }
        });            
    }
    
    if(!isBlank(linksWs.mo)){
        $scope.monedas = linksWs.mo;
        validateLoadComplete();      
    }else{     
        onWsAction(linksWs.link_root+"/TCurrency.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tCurrency)){
                    console.log("3207: "+responsePost.data.tCurrency);
                }else{  
                    linksWs.mo = responsePost.data.tCurrency;
                    $scope.monedas = responsePost.data.tCurrency;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 3215: "+JSON.stringify(responsePost));    
            }
        });
    }

    if(!isBlank(linksWs.lp)){
        $scope.lugares = linksWs.lp;
        validateLoadComplete();      
    }else{     
        onWsAction(linksWs.link_root+"/TTypePricePlaces/find.json",{},function(responsePost){
            //alert("calback response: "+JSON.stringify(responsePost.data));
            if(!isBlank(responsePost.data)){
                if(angular.isString(responsePost.data.tTypePricePlaces)){
                    console.log("3228: "+responsePost.data.tTypePricePlaces);
                }else{  
                    linksWs.lp = responsePost.data.tTypePricePlaces;
                    $scope.lugares = responsePost.data.tTypePricePlaces;
                    validateLoadComplete();
                }
            }else{
                validateLoadComplete();
                console.log("calback token no set 3236: "+JSON.stringify(responsePost));    
            }
        });
    }
    
    $scope.formAlarm = {};
    $scope.submitForm = function(valid) {
        
        if (valid) {
            $ionicLoading.show({});
            $scope.ID_USER = linksWs.user;
            //var dataPost = new Object();
            var dataPost = [];
            //console.log(this.formData);
            var formD = this.formAlarm;
            angular.forEach(this.formAlarm, function(data, nombre) { 
                if(nombre.indexOf("t_") == -1){
                    var obj = {};
                    obj[nombre] = data;
                    dataPost[nombre] = data;
                }
            }); 
  
            onWsAction(linksWs.link_root+"/TAlarms/editAlarm.json",dataPost,function(responsePost){
                //alert("calback response: "+JSON.stringify(responsePost));
                $ionicLoading.hide();
                if(!isBlank(responsePost.data)){
                    if(angular.isString(responsePost.data.tAlarm)){
                        //console.log("143: "+responsePost.data.tAlarm);
                        var alertPopup = $ionicPopup.alert({
                            title: "Mensaje <i class='icon ion-close-circled error'></i>",
                            content: "Error: "+responsePost.data.tAlarm,
                            type : 'button-dark',
                        }).then(function(res) {
                        });                         
                    }else{
                        var alertPopup = $ionicPopup.alert({
                            title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                            content: "Alarma actualizada con &eacute;xito",
                            type : 'button-dark',
                        }).then(function(res) {
                            linksWs.alarms[linksWs.alarm] = responsePost.data.tAlarm;
                            $history.back();
                        });                      
                    }
                }else{
                    var alertPopup = $ionicPopup.alert({
                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                        content: "Error: "+responsePost.data.tAlarm,
                        type : 'button-dark',
                    }).then(function(res) {
                    });                      
                    //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                }
            });            
        } else {
            $ionicPopup.alert({
                title: "Mensaje <i class='icon ion-close-circled error'></i>",
                content: "Error en el Formulario: ",
                type : 'button-dark',
            }).then(function(res) {
            });              
            //console.log("No valid"+JSON.stringify($scope.newRequest));
        }        
    };
    
    $scope.cancelar = function() {
        $history.back();
        //$state.go('app.home');
    };
    
})
.controller('NotifyListCtrl', function($scope, $http, $state, $stateParams, $timeout, $history, $ionicLoading, $ionicPopup, ionicMaterialInk, ionicMaterialMotion, linksWs) {
    // Set Header
    $ionicLoading.show({});
    
    $timeout(function() {
        $scope.$parent.hideHeader();
        //$scope.isExpanded = false;
        //$scope.$parent.setExpanded(false);        
        
    }, 0);      

    $scope.notifys = [];
    var $itemFloat, 
        $itemSelected, 
        $profile = document.querySelector('.profile'),
        $details = document.getElementsByClassName('details'),
        $scroll = document.getElementsByClassName('myScroll'),
        
        $divBack = document.getElementsByClassName('list-actions'),
        $divTitl = document.getElementsByClassName('list-title'),
        $section = $profile.parentNode,
        $list = $section.querySelector('ul'),
        pos,
        contentSpeed = 50;
    

    $scope.closeProfile = function(e) {
        e.preventDefault();
        
        var $profile = document.querySelector('.profile'),
            $section = $profile.parentNode;
         
        _animateInfo(false)
            .then(function(){
             
            setTimeout(function(){
                var $icons = document.getElementsByClassName('iconWinsm');

                angular.element($icons).css({"color":"#04204a"});                
                $profile.classList.remove('show');
                $itemFloat.style.top = pos + 'px';
                $itemFloat.classList.remove('centered');
            }, contentSpeed * 2);
 
            setTimeout(function() {
                $itemSelected.style.opacity = 1;
            }, 500);
 
            setTimeout(function() {
                $section.removeChild($itemFloat);
            }, 600); 
            //$scope.$parent.showHeader();
            //$divBack.style.display = 'block';
            angular.element($divBack).css({"display": "block"});
            angular.element($divTitl).css({"display": "block"});
            angular.element($section).attr("style","margin-top: 5% !important");
        });
    }
     
    $scope.showProfile = function(e, i) {
        e.preventDefault();
        //$divBack.style.display = 'none';
        angular.element($divBack).css({"display": "none"});
        angular.element($divTitl).css({"display": "none"});
        $scope.$parent.hideHeader();
        angular.element($section).attr("style","margin-top: 0% !important");
        var $selectedItem = e.target.closest('a'),
            $floatingItem = document.createElement('div');
         
        $scope.notify = $scope.notifys[i];
        linksWs.notify = i;
        
        pos = ($selectedItem.offsetTop - $list.scrollTop);
         
        $floatingItem.innerHTML = $selectedItem.innerHTML;
        $floatingItem.classList.add('floating-item');
        $floatingItem.style.height = $selectedItem.offsetHeight + 'px';
        $floatingItem.style.top = pos + 'px';
        $floatingItem.style['will-change'] = 'left, top';
         
        $section.appendChild($floatingItem);
        $itemFloat = $floatingItem;
        $itemSelected = $selectedItem;
        $selectedItem.style.opacity = 0;
         
        setTimeout(function() {
            var $imageWrapper = $floatingItem.querySelector('.imageWrapper');
            var $icon = document.getElementsByClassName('iconWinsm');
            
            angular.element($icon).css({"color":"#fff"});
            $profile.style.zIndex = 2;
            $profile.classList.add('show');
            $floatingItem.style.top = '16px';
            $floatingItem.classList.add('centered');
            //angular.element($details).css({"height":(window.innerHeight-145)+"px"});
            //angular.element($details).css({"overflow-x":"hidden"});
            //angular.element($details).css({"overflow-y":"scroll"});
            
        }, 50);
         
        setTimeout(function () {
            _animateInfo(true);
            readNotify();
        }, 600);
 
    }
     
    function _animateInfo(show) {
        return new Promise(function(resolve, reject) {
            var $contentItems = document.querySelectorAll('.profile li'),
            i = 0, length = $contentItems.length, arr = [];
         
            if (length === 0) return;
 
            for (i = 0; i < length; i++) {
                arr.push($contentItems[i]);
            }
 
            i = show ? 0 : length;
            arr.forEach(function(item) {
                var delay = (show ? i++ : i--) * contentSpeed;
 
                setTimeout(function(){
                    if (show)
                        item.classList.add('show');
                    else
                        item.classList.remove('show');
                     
                    hasFinished(delay);
                }, delay);
            });
             
            function hasFinished(d) {
                if (d === ((length - 1) * contentSpeed))
                    resolve();
            }
        });
    }
    
    $scope.deleteNotify = function(ev) {
        ev.preventDefault();
        
        $ionicPopup.show({
            cssClass: 'confirmDeletePopup',
            title: '&#191;Est&aacute; seguro de Eliminar la Notificacion &#63;',
            /*subTitle: 'Are you sure you want to create this case?',*/
            buttons: [{
                text: 'No',
                onTap: function(e) {
                    return 0;
                }
            }, {
                text: 'Si',
                type: 'button-positive',
                onTap: function(e) {
                    return 1;
                }
            }, ]
        }).then(function(res) {
            if (res === 1) {
                //console.log('ok clicked');
                checkRed(function(red){
                    if(red){   
                        $ionicLoading.show({});
                        var dataPost = new Object();
                        var formD = linksWs.notifys[linksWs.notify];
                        angular.forEach(formD, function(data, nombre) { 
                            if(nombre.indexOf("t_") == -1){
                                //var obj = {};
                                //obj[nombre] = data;
                                dataPost[nombre] = data;
                                //dataPost.push({nombre:data});                    
                            }
                        }); 
                        onWsAction(linksWs.link_root+"/TNotifications/deleteNotify.json",dataPost,function(responsePost){
                            //alert("calback response: "+JSON.stringify(responsePost));
                            $ionicLoading.hide();
                            if(!isBlank(responsePost.data)){
                                if(angular.isString(responsePost.data.tNotification)){
                                    //console.log("143: "+responsePost.data.tRequest);
                                    $ionicPopup.alert({
                                        title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                        content: "Error: "+responsePost.data.tNotification,
                                        type : 'button',
                                    }).then(function(res) {
                                    });                         
                                }else{
                                    $ionicPopup.alert({
                                        title: "Mensaje <i class='icon ion-checkmark-circled success'></i>",
                                        content: "Notificacion Eliminada con &eacute;xito",
                                        type : 'button',
                                    }).then(function(res) {
                                        //linksWs.alarm = "";
                                        //linksWs.alarms = "";
                                        $scope.closeProfile(ev);
                                        validNotify(linksWs.notify);
                                    });                      
                                }
                            }else{
                                $ionicPopup.alert({
                                    title: "Mensaje <i class='icon ion-close-circled error'></i>",
                                    content: "Error: "+responsePost.data.tNotification,
                                    type : 'button',
                                }).then(function(res) {
                                });                      
                                //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                            }
                        });
                    }
                });
                                
            } else if (res === 0) {
                //console.log('cancel clicked');
            }            

        });        
    }; 
    
    function validNotify(index){
        
        checkRed(function(red){
            if(red){
                 if(!isBlank(linksWs.notifys)){
                    if(!angular.isUndefined(index)){
                        //linksWs.alarms.destroy(index);
                        linksWs.notifys.splice(index, 1);
                        //alert("Alarms: "+linksWs.alarms.length );
                        $scope.notifys = linksWs.notifys;
                        if(linksWs.notifys.length < 1){
                            $scope.notifys = null;
                            $ionicPopup.alert({
                                title: "No hay notificaciones nuevas",
                                type : 'button-dark',
                            });                            
                            //angular.element($scroll).css({"height":(window.innerHeight-33)+"px"});
                        }else{
                            $scope.notifys = linksWs.notifys;
                        }
                    }else{
                        $scope.notifys = null;
                        $ionicPopup.alert({
                            title: "No hay notificaciones nuevas",
                            type : 'button-dark',
                        });                        
                    }
                }else{
                    $scope.notifys = null;
                    $ionicPopup.alert({
                        title: "No hay notificaciones nuevas",
                        type : 'button-dark',
                    });                      
                }               
            } 
        });
    }

    function readNotify() {

        checkRed(function(red){
            if(red){   
                if(linksWs.notifys[linksWs.notify].READ_NOTIF == 0){
                    var dataPost = new Object();
                    var formD = linksWs.notifys[linksWs.notify];
                    angular.forEach(formD, function(data, nombre) { 
                        if(nombre.indexOf("t_") == -1){
                            //var obj = {};
                            //obj[nombre] = data;
                            dataPost[nombre] = data;
                            //dataPost.push({nombre:data});                    
                        }
                    }); 
                    dataPost['READ_NOTIF'] = 1;
                    dataPost['ID_USER'] = linksWs.user;
                    onWsAction(linksWs.link_root+"/TNotifications/readNotify.json",dataPost,function(responsePost){
                        //alert("calback response: "+JSON.stringify(responsePost));
                        $ionicLoading.hide();

                        if(!isBlank(responsePost.data)){
                            if(angular.isString(responsePost.data.tNotification)){

                            }else{

                                linksWs.notifys[linksWs.notify] = responsePost.data.tNotification;
                                $scope.notifys = linksWs.notifys; 
                                //$scope.closeProfile(ev);

                            }
                        }else{
                            //console.log("calback token no set 151: "+JSON.stringify(responsePost));    
                        }
                    });                    
                }

            }
        });                
       
    }; 
   
    function findNotify(){
        checkRed(function(red){
            if(red){
                onWsAction(linksWs.link_root+"/TNotifications/find.json",{user:linksWs.user},function(responsePost){
                    //console.log("calback TRequest 3160: "+JSON.stringify(responsePost.data));
                    if(!isBlank(responsePost.data)){
                        //linksWs.request = responsePost.data.tNotification;
                        linksWs.notifys = responsePost.data.tNotification;
                        if(angular.isString(linksWs.notifys)){
                            linksWs.notifys = "";
                            $ionicLoading.hide();
                            var alertPopup = $ionicPopup.alert({
                                title: "No hay notificaciones nuevas",
                                type : 'button-dark',
                            });
                            $scope.notifys = null;
                            //alert(linksWs.couponInfo);
                        }else{
                            $scope.notifys = linksWs.notifys;
                            angular.element($scroll).css({"height":(window.innerHeight-33)+"px"});
                            //angular.element($section).css({"height":(window.innerHeight+10)+"px"});
                            //linksWs.requests = linksWs.requests;
                            $timeout(function() {
                                ionicMaterialMotion.fadeSlideInRight({
                                    selector: '.animate-fade-slide-in-right .item'
                                });
                                ionicMaterialInk.displayEffect();
                                $ionicLoading.hide();
                            }, 3700);                        
                        }
                    }else{
                        $ionicLoading.hide();
                        var alertPopup = $ionicPopup.alert({
                            title: "Error con el servidor, Reinicie la Aplicaci&oacute;n",
                            type : 'button-dark',
                        });                            
                        //alert("calback 623: "+JSON.stringify(responsePost));    
                    }
                });                

            }else{
                $ionicLoading.hide();
                var alertPopup = $ionicPopup.alert({
                    title: "No hay Red",
                    type : 'button-dark',
                });
            }
        });       
    }
    
    findNotify();
    
    $scope.back = function(e){
        //$history.back();
        $state.go('app.home');
    }    
})
.controller('PriceListCtrl', function($scope, $http, $state, $stateParams, $timeout, $history, $ionicLoading, $ionicPopup, ionicMaterialInk, ionicMaterialMotion, linksWs) {
    // Set Header
    $ionicLoading.show({});
    
    $timeout(function() {
        $scope.$parent.hideHeader();
        //$scope.isExpanded = false;
        //$scope.$parent.setExpanded(false);        
        
    }, 0);    
    
    $scope.back = function(e){
        //$history.back();
        $state.go('app.home');
    }  
    
    $scope.collapseAll = function(data) {
       for(var i in $scope.products) {
           if($scope.products[i] != data) {
               $scope.products[i].expanded = false;   
           }
       }
       data.expanded = !data.expanded;
    };
    
    $scope.cambioUp = function(val) { 
        if(parseInt(val) > 0){
            return true;
        }
        return false;;
    }
    
    $scope.cambioDown = function(val) { 
        if(parseInt(val) < 0){
            return true;
        }
        return false;
    }
    
    $scope.toDate=function(strDt){
     return new Date(strDt);
    }    
    $scope.dateCotiza = '00-00-0000';
    function findPlace(){
        checkRed(function(red){
            if(red){
                onWsAction(linksWs.link_root+"/TProductsPrice/findPlace.json",{user:linksWs.user},function(responsePost){
                    //console.log("calback TRequest 3160: "+JSON.stringify(responsePost.data));
                    if(!isBlank(responsePost.data)){
                        //linksWs.request = responsePost.data.tNotification;
                        linksWs.places = responsePost.data.tProductsPrice;
                        if(angular.isString(linksWs.places)){
                            linksWs.places = "";
                            
                            $scope.places = null;
                            //alert(linksWs.couponInfo);
                        }else{
                            $scope.places = linksWs.places;
                            angular.element($scroll).css({"height":(window.innerHeight-33)+"px"});
                            $scope.dateCotiza =  $scope.places[0].t_prices.DATE_PRICE;
                            $scope.dateUpdate =  $scope.places[0].t_prices.UPDATED;
                            //angular.element($section).css({"height":(window.innerHeight+10)+"px"});
                            //linksWs.requests = linksWs.requests;
                            $timeout(function() {
                                ionicMaterialMotion.fadeSlideInRight({
                                    selector: '.animate-fade-slide-in-right .items'
                                });
                                ionicMaterialInk.displayEffect();
                                $ionicLoading.hide();
                            }, 3700);                        
                        }
                    }else{
                        linksWs.places = "";
                        $scope.places = null;    
                    }
                });                

            }else{
                $ionicLoading.hide();
                var alertPopup = $ionicPopup.alert({
                    title: "No hay Red",
                    type : 'button-dark',
                });
            }
        });       
    }
    
    function findPosition(){
        checkRed(function(red){
            if(red){
                onWsAction(linksWs.link_root+"/TProductsPrice/findPosition.json",{user:linksWs.user},function(responsePost){
                    //console.log("calback TRequest 3160: "+JSON.stringify(responsePost.data));
                    if(!isBlank(responsePost.data)){
                        //linksWs.request = responsePost.data.tNotification;
                        linksWs.positions = responsePost.data.tProductsPrice;
                        if(angular.isString(linksWs.positions)){
                            linksWs.positions = "";
                            
                            $scope.positions = null;
                            //alert(linksWs.couponInfo);
                        }else{
                            $scope.positions = linksWs.positions;
                            angular.element($scroll).css({"height":(window.innerHeight-33)+"px"});
                            //angular.element($section).css({"height":(window.innerHeight+10)+"px"});
                            //linksWs.requests = linksWs.requests;
                            $timeout(function() {
                                ionicMaterialMotion.fadeSlideInRight({
                                    selector: '.animate-fade-slide-in-right .items'
                                });
                                ionicMaterialInk.displayEffect();
                                $ionicLoading.hide();
                            }, 3700);                        
                        }
                    }else{
                        linksWs.positions = "";
                        $scope.positions = null;    
                    }
                });                

            }else{

            }
        });       
    }
    
    function findPoductos(){
        checkRed(function(red){
            if(red){
                onWsAction(linksWs.link_root+"/TProductsPrice/find.json",{user:linksWs.user},function(responsePost){
                    //console.log("calback TRequest 3160: "+JSON.stringify(responsePost.data));
                    if(!isBlank(responsePost.data)){
                        //linksWs.request = responsePost.data.tNotification;
                        linksWs.products = responsePost.data.tProductsPrice;
                        if(angular.isString(linksWs.products)){
                            linksWs.products = "";
                            $ionicLoading.hide();
                            var alertPopup = $ionicPopup.alert({
                                title: "No hay precios nuevos",
                                type : 'button-dark',
                            });
                            $scope.products = null;
                            //alert(linksWs.couponInfo);
                        }else{
                            $scope.products = linksWs.products;
                            angular.element($scroll).css({"height":(window.innerHeight-33)+"px"});
                            //angular.element($section).css({"height":(window.innerHeight+10)+"px"});
                            //linksWs.requests = linksWs.requests;
                            $timeout(function() {
                                ionicMaterialMotion.fadeSlideInRight({
                                    selector: '.animate-fade-slide-in-right .items'
                                });
                                ionicMaterialInk.displayEffect();
                                $ionicLoading.hide();
                            }, 3700);                        
                        }
                    }else{
                        $ionicLoading.hide();
                        var alertPopup = $ionicPopup.alert({
                            title: "Error con el servidor, Reinicie la Aplicaci&oacute;n",
                            type : 'button-dark',
                        });                            
                        //alert("calback 623: "+JSON.stringify(responsePost));    
                    }
                });                

            }else{
                $ionicLoading.hide();
                var alertPopup = $ionicPopup.alert({
                    title: "No hay Red",
                    type : 'button-dark',
                });
            }
        });       
    }
    
    findPoductos();  
    findPlace();
    findPosition();
    
})
.controller('ChatCtrl', function($scope, $http, $state, $stateParams, $timeout, $history, $ionicLoading, $ionicPopup, ionicMaterialInk, ionicMaterialMotion, linksWs, $ionicScrollDelegate, $filter, $interval) {
    // Set Header
    $ionicLoading.show({});
    
    $timeout(function() {
        $scope.$parent.hideHeader();
        //$scope.isExpanded = false;
        //$scope.$parent.setExpanded(false);        
        
    }, 0);    
    
    $scope.hideTime = true;

    var alternate, isIOS = ionic.Platform.isWebView() && ionic.Platform.isIOS();

    var $scroll = document.getElementsByClassName('myScroll');
    function findChat(showAll){
        checkRed(function(red){
            if(red){
                onWsAction(linksWs.link_root+"/TChat/find.json",{user:linksWs.user,trade:linksWs.negocios[linksWs.negocio].ID_TRADE},function(responsePost){
                    
                    if(!isBlank(responsePost.data)){
                        linksWs.chats = responsePost.data.tChat;
                        if(angular.isString(linksWs.chats)){
                            linksWs.chats = "";
                            $ionicLoading.hide();
                            var alertPopup = $ionicPopup.alert({
                                title: "No hay menmsajes nuevos",
                                type : 'button-dark',
                            });
                            $scope.chats = null;
                            //alert(linksWs.couponInfo);
                        }else{
                            var userO = 0;
                            var userC = 0;
                            angular.forEach(linksWs.chats, function(data, index) { 
                                /*console.log(index+":"+data);*/
                                /*console.log(data["SMS"]+":"+data.SMS);*/
                                if(showAll){
                                    $scope.messages.push({
                                      userId: data.ID_USER_ORIGEN,
                                      text: data.SMS,
                                      time: $filter('date')(new Date(data.DT_CREATED), "dd-MM-yyyy HH:mm:ss")
                                    });                                   
                                }else{
                                    if(data.READ_CHAT == 0){
                                        $scope.messages.push({
                                          userId: data.ID_USER_ORIGEN,
                                          text: data.SMS,
                                          time: $filter('date')(new Date(data.DT_CREATED), "dd-MM-yyyy HH:mm:ss")
                                        });                                   
                                    }
                                }

                            }); 
                            
                            angular.element($scroll).css({"height":(window.innerHeight-43)+"px"});
                            
                            $timeout(function() {
                                $ionicScrollDelegate.scrollBottom(true);
                                $ionicLoading.hide();
                                onWsAction(linksWs.link_root+"/TChat/readSMS.json",{user:linksWs.user,trade:linksWs.negocios[linksWs.negocio].ID_TRADE},function(responsePost){
                                });                                  
                            }, 1700);                        
                        }
                    }else{
                        $ionicLoading.hide();
                        linksWs.chats = "";
                        $ionicLoading.hide();
                        var alertPopup = $ionicPopup.alert({
                            title: "No hay menmsajes nuevos",
                            type : 'button-dark',
                        });
                        $scope.chats = null;                           
                        //alert("calback 623: "+JSON.stringify(responsePost));    
                    }
                });                

            }else{
                $ionicLoading.hide();
                var alertPopup = $ionicPopup.alert({
                    title: "No hay Red",
                    type : 'button-dark',
                });
            }
        });       
    }
    
    function newSMS(){

        checkRed(function(red){
            if(red){   
                var dataPost = [];
                dataPost['READ_CHAT'] = 0;
                dataPost['ID_TRADE'] = linksWs.negocios[linksWs.negocio].ID_TRADE;
                /*console.log(linksWs.negocios[linksWs.negocio].ID_USER_OWNER+":"+linksWs.negocios[linksWs.negocio].ID_USER_CPART);*/
                if(linksWs.user == linksWs.negocios[linksWs.negocio].ID_USER_OWNER){
                    dataPost['ID_USER_ORIGEN'] = linksWs.user;
                    dataPost['ID_USER_DESTINY'] = linksWs.negocios[linksWs.negocio].ID_USER_CPART;
                }else{
                    dataPost['ID_USER_ORIGEN'] = linksWs.negocios[linksWs.negocio].ID_USER_CPART;
                    dataPost['ID_USER_DESTINY'] = linksWs.user;
                }
                    
                dataPost['SMS'] = $scope.data.message;
                dataPost['COD_REF'] = linksWs.negocios[linksWs.negocio].COD_REF;
                delete $scope.data.message;
                $ionicScrollDelegate.scrollBottom(true);
                onWsAction(linksWs.link_root+"/TChat/newSMS.json",dataPost,function(responsePost){
                    //alert("calback response: "+JSON.stringify(responsePost));
                    $ionicLoading.hide();

                    if(!isBlank(responsePost.data)){
                        console.log(responsePost.data.tChat);
                    }else{
                        console.log(responsePost.data);   
                    }
                });                    
            }
        });                
       
    }; 
    
    $scope.sendMessage = function(e) {
        e.preventDefault();
        /*console.log("sendMessage");*/
        var d = new Date();
        d = d.toLocaleTimeString().replace(/:\d+ /, '');

        $scope.messages.push({
          userId: linksWs.user,
          text: $scope.data.message,
          time: d
        });
        newSMS();

    };

    $scope.inputUp = function() {
        if (isIOS) $scope.data.keyboardHeight = 216;
        $timeout(function() {
          $ionicScrollDelegate.scrollBottom(true);
        }, 300);

    };

    $scope.inputDown = function() {
        if (isIOS) $scope.data.keyboardHeight = 0;
        $ionicScrollDelegate.resize();
    };

    $scope.closeKeyboard = function() {
        cordova.plugins.Keyboard.close();
    };


    $scope.data = {};
    $scope.myId = linksWs.user;
    $scope.messages = [];

    /* 180000 milseg = 3 min */
    var refreshIntervalId = setInterval(findChat(false), 180000);

    $scope.back = function(e){
        //$history.back();
        /* later */
        clearInterval(refreshIntervalId);
        $timeout(function() {
          $state.go('app.negocio');
        }, 70);        
        
    };   
    
    findChat(true);
    
    
})
.controller('ChatListCtrl', function($scope, $http, $state, $stateParams, $timeout, $history, $ionicLoading, $ionicPopup, ionicMaterialInk, ionicMaterialMotion, linksWs, $ionicScrollDelegate, $filter, $interval) {
    
    // Set Header
    $ionicLoading.show({});
    
    $timeout(function() {
        $scope.$parent.hideHeader();
        //$scope.isExpanded = false;
        //$scope.$parent.setExpanded(false);        
        
    }, 0); 
    
    $scope.chats = [];
    
    $scope.viewChat = function(e, i) {
        e.preventDefault();
        linksWs.chat = i;
        $timeout(function() {
          $state.go('app.chatTrade');
        }, 70);
        return;
    }; 
 
   function listChat() {
        checkRed(function(red){
            if(red){   
                var dataPost = [];
                dataPost['user'] = linksWs.user;
                onWsAction(linksWs.link_root+"/TChat/chatList.json",dataPost,function(responsePost){
                    //alert("calback response: "+JSON.stringify(responsePost));
                    if(!isBlank(responsePost.data)){
                        //linksWs.request = responsePost.data.tRequest;
                        linksWs.chats = responsePost.data.tChat;
                        if(angular.isString(linksWs.chats)){
                            $ionicLoading.hide();
                            var alertPopup = $ionicPopup.alert({
                                title: "No posee chats activos",
                                type : 'button-dark',
                            });
                            //alert(linksWs.couponInfo);
                        }else{
                            linksWs.chats = responsePost.data.tChat;
                            $scope.chats = linksWs.chats;
                            angular.element($scroll).css({"height":(window.innerHeight-33)+"px"});
                            $timeout(function() {
                                ionicMaterialMotion.fadeSlideInRight({
                                    selector: '.animate-fade-slide-in-right .item'
                                });
                                ionicMaterialInk.displayEffect();
                                $ionicLoading.hide();
                            }, 70);                        
                        }
                    }else{
                        $ionicLoading.hide();
                        var alertPopup = $ionicPopup.alert({
                            title: "Error con el servidor, Reinicie la Aplicaci&oacute;n",
                            type : 'button-dark',
                        });                            
                        //alert("calback 623: "+JSON.stringify(responsePost));    
                    }
                });                    
            }
        });                
       
    };
    
    $scope.back = function(e){
        $timeout(function() {
          $state.go('app.home');
        }, 7);        
        
    };   
    
    listChat();    
    
})
.controller('ChatTradeCtrl', function($scope, $http, $state, $stateParams, $timeout, $history, $ionicLoading, $ionicPopup, ionicMaterialInk, ionicMaterialMotion, linksWs, $ionicScrollDelegate, $filter, $interval) {
    // Set Header
    $ionicLoading.show({});
    
    $timeout(function() {
        $scope.$parent.hideHeader();
        //$scope.isExpanded = false;
        //$scope.$parent.setExpanded(false);        
        
    }, 0);    
    
    $scope.hideTime = true;

    var alternate, isIOS = ionic.Platform.isWebView() && ionic.Platform.isIOS();
    var $scroll = document.getElementsByClassName('myScroll');
   
    function findChatTrade(showAll){
        checkRed(function(red){
            if(red){
                onWsAction(linksWs.link_root+"/TChat/find.json",{user:linksWs.user,trade:linksWs.chats[linksWs.chat].ID_TRADE},function(responsePost){
                    
                    if(!isBlank(responsePost.data)){
                        var dataChat = responsePost.data.tChat;
                        if(angular.isString(dataChat)){
                            linksWs.chats = "";
                            $ionicLoading.hide();
                            var alertPopup = $ionicPopup.alert({
                                title: "No hay menmsajes nuevos",
                                type : 'button-dark',
                            });
                            $scope.chats = null;
                            //alert(linksWs.couponInfo);
                        }else{
                            var userO = 0;
                            var userC = 0;
                            angular.forEach(dataChat, function(data, index) { 
                                /*console.log(index+":"+data);*/
                                /*console.log(data["SMS"]+":"+data.SMS);*/
                                /*console.log(data["t_trade"]+":"+data.t_trade);*/
                                if(showAll){
                                    $scope.messages.push({
                                      userId: data.ID_USER_ORIGEN,
                                      text: data.SMS,
                                      time: $filter('date')(new Date(data.DT_CREATED), "dd-MM-yyyy HH:mm:ss")
                                    });                                   
                                    
                                }else{
                                    if(data.READ_CHAT == 0){
                                        $scope.messages.push({
                                          userId: data.ID_USER_ORIGEN,
                                          text: data.SMS,
                                          time: $filter('date')(new Date(data.DT_CREATED), "dd-MM-yyyy HH:mm:ss")
                                        });                                   
                                    }
                                    
                                }

                            }); 
                            angular.element($scroll).css({"height":(window.innerHeight-43)+"px"});
                            $timeout(function() {
                                $ionicScrollDelegate.scrollBottom(true);
                                $ionicLoading.hide();
                                
                                onWsAction(linksWs.link_root+"/TChat/readSMS.json",{user:linksWs.user,trade:linksWs.chats[linksWs.chat].ID_TRADE},function(responsePost){
                                    if(!isBlank(responsePost.data)){
                                        /*console.log(responsePost.data.tChat);*/
                                    }else{
                                        /*console.log(responsePost.data);   */
                                    }
                                });                                   
                            }, 1700);                        
                        }
                    }else{
                        $ionicLoading.hide();
                        linksWs.chats = "";
                        $ionicLoading.hide();
                        var alertPopup = $ionicPopup.alert({
                            title: "No hay menmsajes nuevos",
                            type : 'button-dark',
                        });
                        $scope.chats = null;                           
                        //alert("calback 623: "+JSON.stringify(responsePost));    
                    }
                });                

            }else{
                $ionicLoading.hide();
                var alertPopup = $ionicPopup.alert({
                    title: "No hay Red",
                    type : 'button-dark',
                });
            }
        });       
    }
    
    function newSMSTrade(){

        checkRed(function(red){
            if(red){   
                var dataPost = [];
                dataPost['READ_CHAT'] = 0;
                dataPost['ID_TRADE'] = linksWs.chats[linksWs.chat].ID_TRADE;
                console.log(linksWs.chats[linksWs.chat].t_trade.ID_USER_OWNER+":"+linksWs.chats[linksWs.chat].t_trade.ID_USER_CPART);
                if(linksWs.user == linksWs.chats[linksWs.chat].t_trade.ID_USER_OWNER){
                    dataPost['ID_USER_ORIGEN'] = linksWs.user;
                    dataPost['ID_USER_DESTINY'] = linksWs.chats[linksWs.chat].t_trade.ID_USER_CPART;
                }else{
                    dataPost['ID_USER_ORIGEN'] = linksWs.chats[linksWs.chat].t_trade.ID_USER_CPART;
                    dataPost['ID_USER_DESTINY'] = linksWs.user;
                }
                    
                dataPost['SMS'] = $scope.data.message;
                dataPost['COD_REF'] = linksWs.chats[linksWs.chat].t_trade.COD_REF;
                delete $scope.data.message;
                $ionicScrollDelegate.scrollBottom(true);
                onWsAction(linksWs.link_root+"/TChat/newSMS.json",dataPost,function(responsePost){
                    //alert("calback response: "+JSON.stringify(responsePost));
                    $ionicLoading.hide();

                    if(!isBlank(responsePost.data)){
                        /*console.log(responsePost.data.tChat);*/
                    }else{
                        /*console.log(responsePost.data);   */
                    }
                });                    
            }
        });                
       
    }; 
    
    $scope.sendMessageTrade = function(e) {
        e.preventDefault();
        /*console.log("sendMessage");*/
        var d = new Date();
        d = d.toLocaleTimeString().replace(/:\d+ /, '');

        $scope.messages.push({
          userId: linksWs.user,
          text: $scope.data.message,
          time: d
        });
        newSMS();

    };

    $scope.inputUp = function() {
        if (isIOS) $scope.data.keyboardHeight = 216;
        $timeout(function() {
          $ionicScrollDelegate.scrollBottom(true);
        }, 300);

    };

    $scope.inputDown = function() {
        if (isIOS) $scope.data.keyboardHeight = 0;
        $ionicScrollDelegate.resize();
    };

    $scope.closeKeyboard = function() {
        cordova.plugins.Keyboard.close();
    };


    $scope.data = {};
    $scope.myId = linksWs.user;
    $scope.messages = [];

    /* 180000 milseg = 3 min ;60000 = 1 min */
    var refreshIntervalIdTrade = setInterval(findChatTrade(false), 30000);

    $scope.back = function(e){
        //$history.back();
        /* later */
        clearInterval(refreshIntervalIdTrade);
        $timeout(function() {
          $state.go('app.chatList');
        }, 7);        
        
    };   
    
    findChatTrade(true);
    
    
})
;
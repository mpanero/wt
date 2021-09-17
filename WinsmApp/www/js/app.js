// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.controllers' is found in controllers.js
angular.module('ui.router.history', ['ui.router','ngMaterial', 'ngAnimate', 'ngSanitize', 'ui.bootstrap'])
	.service('$history', function($state, $rootScope, $window) {

  var history = [];

  angular.extend(this, {
    push: function(state, params) {
      history.push({ state: state, params: params });
    },
    all: function() {
      return history;
    },
    go: function(step) {
      // TODO:
      // (1) Determine # of states in stack with URLs, attempt to
      //    shell out to $window.history when possible
      // (2) Attempt to figure out some algorthim for reversing that,
      //     so you can also go forward
      var prev = this.previous(step || -1);
      return $state.go(prev.state, prev.params);
    },
    previous: function(step) {
      return history[history.length - Math.abs(step || 1)];
    },
    back: function() {
      return this.go();
    },
    clear:function(){
        angular.forEach($state.get(), function (state) {
          angular.copy({}, state.data);
        });
    }
  });

})
.config(function($stateProvider, $urlRouterProvider, $ionicConfigProvider,$httpProvider) {
    
    /*$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';*/

    var param = function(obj) {
        var query = '',
            name, value, fullSubName, subName, subValue, innerObj, i;

        for (name in obj) {
            value = obj[name];

            if (value instanceof Array) {
                for (i = 0; i < value.length; ++i) {
                    subValue = value[i];
                    fullSubName = name + '[' + i + ']';
                    innerObj = {};
                    innerObj[fullSubName] = subValue;
                    query += param(innerObj) + '&';
                }
            }
            else if (value instanceof Object) {
                for (subName in value) {
                    subValue = value[subName];
                    fullSubName = name + '[' + subName + ']';
                    innerObj = {};
                    innerObj[fullSubName] = subValue;
                    query += param(innerObj) + '&';
                }
            }
            else if (value !== undefined && value !== null) query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
        }

        return query.length ? query.substr(0, query.length - 1) : query;
    };

    $httpProvider.defaults.transformRequest = [function(data) {
        return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
    }];
    
    // Turn off caching for demo simplicity's sake
    $ionicConfigProvider.views.maxCache(0);
    
    $stateProvider.state('app', {
        url: '/app',
        abstract: true,
        templateUrl: 'templates/menu.html',
        controller: 'AppCtrl'
    }) 
    .state('app.init', {
        url: '/init',
        views: {
            'menuContent': {
                templateUrl: '',
                controller: 'InitCtrl'
            }
        }
    })     
    .state('app.login', {
        url: '/login',
        views: {
            'menuContent': {
                templateUrl: 'templates/login.html',
                controller: 'LoginCtrl'
            }
        }
    })
    .state('app.userAdd', {
        url: '/userAdd',
        views: {
            'menuContent': {
                templateUrl: 'templates/userAdd.html',
                controller: 'UserAddCtrl'
            }
        }
    })    
    .state('app.newPass', {
        url: '/newPass',
        views: {
            'menuContent': {
                templateUrl: 'templates/newPass.html',
                controller: 'NewPassCtrl'
            }
        }
    })    
    .state('app.home', {
        url: '/home',
        views: {
            'menuContent': {
                templateUrl: 'templates/home.html',
                controller: 'HomeCtrl'
            }
        }
    })
    .state('app.solicitud', {
        url: '/solicitud',
        views: {
            'menuContent': {
                templateUrl: 'templates/solicitud.html',
                controller: 'SolicitudCtrl'
            }
        }
    })
    .state('app.solicitudEdit', {
        url: '/solicitudEdit',
        views: {
            'menuContent': {
                templateUrl: 'templates/solicitudEdit.html',
                controller: 'SolicitudEditCtrl'
            }
        }
    })    
    .state('app.lista', {
        url: '/lista',
        views: {
            'menuContent': {
                templateUrl: 'templates/lista.html',
                controller: 'ListaCtrl'
            }
        }
    })
    .state('app.filtro', {
        url: '/filtro',
        views: {
            'menuContent': {
                templateUrl: 'templates/filtros.html',
                controller: 'FiltroCtrl'
            }
        }
    })    
    .state('app.mercado', {
        url: '/mercado',
        views: {
            'menuContent': {
                templateUrl: 'templates/mercado.html',
                controller: 'MercadoCtrl'
            }
        }
    }) 
    .state('app.negocio', {
        url: '/negocio',
        views: {
            'menuContent': {
                templateUrl: 'templates/negocio.html',
                controller: 'NegocioCtrl'
            }
        }
    }) 
    .state('app.alarma', {
        url: '/alarma',
        views: {
            'menuContent': {
                templateUrl: 'templates/alarma.html',
                controller: 'AlarmaCtrl'
            }
        }
    })
    .state('app.alarmaList', {
        url: '/alarmaList',
        views: {
            'menuContent': {
                templateUrl: 'templates/alarmaList.html',
                controller: 'AlarmaListCtrl'
            }
        }
    }) 
    .state('app.alarmaEdit', {
        url: '/alarmaEdit',
        views: {
            'menuContent': {
                templateUrl: 'templates/alarmaEdit.html',
                controller: 'AlarmaEditCtrl'
            }
        }
    })    
    .state('app.notifyList', {
        url: '/notifyList',
        views: {
            'menuContent': {
                templateUrl: 'templates/notifyList.html',
                controller: 'NotifyListCtrl'
            }
        }
    }) 
    .state('app.priceList', {
        url: '/priceList',
        views: {
            'menuContent': {
                templateUrl: 'templates/priceList.html',
                controller: 'PriceListCtrl'
            }
        }
    }) 
    .state('app.chat', {
        url: '/chat',
        views: {
            'menuContent': {
                templateUrl: 'templates/chat.html',
                controller: 'ChatCtrl'
            }
        }
    }) 
    .state('app.chatList', {
        url: '/chatList',
        views: {
            'menuContent': {
                templateUrl: 'templates/chatList.html',
                controller: 'ChatListCtrl'
            }
        }
    })
    .state('app.chatTrade', {
        url: '/chatTrade',
        views: {
            'menuContent': {
                templateUrl: 'templates/chatTrade.html',
                controller: 'ChatTradeCtrl'
            }
        }
    })
    .state('app.wizard', {
        url: '/wizard',
        views: {
            'menuContent': {
                templateUrl: 'templates/wizard.html',
                controller: 'wizardCtrl'
            }
        }
    })
     
    
    ;

    // if none of the above states are matched, use this as the fallback
    /*$urlRouterProvider.otherwise('app.init');*/
});

angular.module('starter', ['ionic', 'ionic-material', 'starter.controllers', 'ionMdInput','ui.router', 'ui.router.history'])
.filter('split', function() {
    return function(input, splitChar, splitIndex) {
        // do some bounds checking here to ensure it has that index
        if(!angular.isUndefined(input) && input !== null && typeof input !== typeof undefined){
            return input.split(splitChar)[splitIndex];   
        }
        
    };
})

.filter('chkEmptyAlpha',function(){
    return function(input){
        if(angular.isString(input) && !(angular.equals(input,null) || angular.equals(input,'')))
            return input;
        else
            return 0;
    };
})

.filter('chkEmptyNumber',function(){
    return function(input){
        if(angular.isString(input) && !(angular.equals(input,null) || angular.equals(input,'')))
            return input;
        else
            return 0;
    };
})

.directive('noVacio', function($ionicPopup) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        //angular.element(elm).scope
        scope.$watch(attrs.ngModel, function(value) {
            if (angular.isUndefined(value)) {
                //etiqueta.attr("style","border-bottom: solid 1px #ccc;");
                ngModel.$setValidity("noVacio",false);

            }else{
                //return false;                 
                if(value.toString().match(/^\s*$/)){
                    //etiqueta.attr("style","border-bottom: solid 1px #60bc3f;");  
                    ngModel.$setValidity("noVacio",false);
                    //return true;
                }else{
                    //etiqueta.attr("style","border-bottom: solid 1px #f00;"); 
                    ngModel.$setValidity("noVacio",true);
                    //return false;                   
                }             
            }

        });       
    }
  };
})

.directive('cuit', function($ionicPopup) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        //angular.element(elm).scope
        scope.$watch(attrs.ngModel, function(value) {
            if (angular.isUndefined(value)) {
                //etiqueta.attr("style","border-bottom: solid 1px #ccc;");
                ngModel.$setValidity("cuit",false);

            }else{
                //return false;                 
                if(esCUITValida(value)){
                    //etiqueta.attr("style","border-bottom: solid 1px #60bc3f;");  
                    ngModel.$setValidity("cuit",true);
                    //return true;
                }else{
                    //etiqueta.attr("style","border-bottom: solid 1px #f00;"); 
                    ngModel.$setValidity("cuit",false);
                    //return false;                   
                }             
            }

        });       
    }
  };
})

.directive('onlyEmail', function($ionicPopup) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        //angular.element(elm).scope
        scope.$watch(attrs.ngModel, function(value) {
            if (!angular.isUndefined(value)) {
                if(value.toString().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)){
                    //etiqueta.attr("style","border-bottom: solid 1px #60bc3f;");  
                    ngModel.$setValidity("onlyEmail",true);
                    //return true;
                }else{
                    //etiqueta.attr("style","border-bottom: solid 1px #f00;"); 
                    ngModel.$setValidity("onlyEmail",false);
                    //return false;                   
                }
            }else{
                //etiqueta.attr("style","border-bottom: solid 1px #ccc;");
                ngModel.$setValidity("onlyEmail",false);
                //return false;              
            }

        });       
    }
  };
})

.directive('uniqueEmail', function($ionicPopup) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        //angular.element(elm).scope
        scope.$watch(attrs.ngModel, function(value) {
            if (!angular.isUndefined(value)) {
                if(value.toString().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)){
                    //etiqueta.attr("style","border-bottom: solid 1px #60bc3f;"); 
                    if(isUniqueMail(value)){
                        ngModel.$setValidity("uniqueEmail",true);    
                    }else{
                        ngModel.$setValidity("uniqueEmail",false);
                    }
                    
                    //return true;
                }else{
                    //etiqueta.attr("style","border-bottom: solid 1px #f00;"); 
                    ngModel.$setValidity("uniqueEmail",false);
                    //return false;                   
                }
            }else{
                //etiqueta.attr("style","border-bottom: solid 1px #ccc;");
                ngModel.$setValidity("uniqueEmail",false);
                //return false;              
            }

        });       
    }
  };
})

.directive('onlyNumber', function($ionicPopup) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        //angular.element(elm).scope
        scope.$watch(attrs.ngModel, function(value) {
            if (!angular.isUndefined(value)) {
                if(value.toString().match(/^[0-9]+$/)){
                    elm.attr("style","border-bottom: solid 1px #072142;");  
                    ngModel.$setValidity("onlyNumber",true);
                    //return true;
                }else{
                    elm.attr("style","border-bottom: solid 1px #f00;"); 
                    ngModel.$setValidity("onlyNumber",false);
                    //return false;                   
                }
            }else{
                //etiqueta.attr("style","border-bottom: solid 1px #ccc;");
                ngModel.$setValidity("onlyNumber",false);
                //return false;              
            }

        });       
    }
  };
})

.directive('priceFrom', function($ionicPopup) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        var limit = 0;
        var limitModel = null;
        //angular.element(elm).scope
        scope.$watch(attrs.ngModel, function(value) {
            limit = angular.element($("[price-to]"));
            limitModel = angular.element($("[price-to]")).controller('ngModel');
            //alert("to: "+limit);
            if (!angular.isUndefined(value)) {
                if(value.toString().match(/^[0-9]+$/) && limit.val().toString().match(/^[0-9]+$/)){
                    if(parseInt(value) >= 0 && parseInt(value) <= parseInt(limit.val()) ){
                        elm.attr("style","border-bottom: solid 1px #072142;");  
                        limit.attr("style","border-bottom: solid 1px #072142;");  
                        ngModel.$setValidity("priceFrom",true);
                        limitModel.$setValidity("priceTo",true);
                    }else{
                        elm.attr("style","border-bottom: solid 1px #f00;"); 
                        limit.attr("style","border-bottom: solid 1px #f00;"); 
                        ngModel.$setValidity("priceFrom",false);     
                        limitModel.$setValidity("priceTo",false);
                    }
                    //return true;
                }else{
                    elm.attr("style","border-bottom: solid 1px #f00;"); 
                    ngModel.$setValidity("priceFrom",false);
                    //return false;                   
                }
            }else{
                //etiqueta.attr("style","border-bottom: solid 1px #ccc;");
                ngModel.$setValidity("priceFrom",false);
                //return false;              
            }

        });       
    }
  };
})

.directive('priceTo', function($ionicPopup) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        var from = 0;
        var fromCtrl = null;
        //angular.element(elm).scope
        scope.$watch(attrs.ngModel, function(value) {
            from = angular.element($("[price-from]"));
            fromModel = angular.element($("[price-from]")).controller('ngModel');
            if (!angular.isUndefined(value) && from.val().toString().match(/^[0-9]+$/)) {
                if(value.toString().match(/^[0-9]+$/)){
                    if(parseInt(from.val()) >= 0 && parseInt(from.val()) <= parseInt(value)){
                        elm.attr("style","border-bottom: solid 1px #072142;");
                        from.attr("style","border-bottom: solid 1px #072142;");
                        
                        ngModel.$setValidity("priceTo",true);
                        fromModel.$setValidity("priceFrom",true);
                    }else{
                        elm.attr("style","border-bottom: solid 1px #f00;");
                        from.attr("style","border-bottom: solid 1px #f00;");
                        
                        ngModel.$setValidity("priceTo",false);
                        fromModel.$setValidity("priceFrom",false);
                    }

                    //return true;
                }else{
                    elm.attr("style","border-bottom: solid 1px #f00;"); 
                    ngModel.$setValidity("priceTo",false);
                    //return false;                   
                }
            }else{
                //etiqueta.attr("style","border-bottom: solid 1px #ccc;");
                ngModel.$setValidity("priceTo",false);
                //return false;              
            }

        });       
    }
  };
})

.directive('number', function($ionicPopup) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        //angular.element(elm).scope
        scope.$watch(attrs.ngModel, function(value) {
            console.log("number "+value);
            if (!(value === null) && !angular.isUndefined(value) ) {
                if(value.toString().match(/^[0-9]+$/)){
                    elm.attr("style","border-bottom: solid 1px #072142;");  
                    ngModel.$setValidity("number",true);
                    //return true;
                }else{
                    
                    if(isBlank(value.toString())){
                        elm.attr("style","border-bottom: none;");
                        ngModel.$setValidity("number",true);                       
                    }else{
                        elm.attr("style","border-bottom: solid 1px #f00;"); 
                        ngModel.$setValidity("number",false);
                        //return false;                          
                    }
                 
                }
            }else{
                elm.attr("style","border-bottom: none;");
                ngModel.$setValidity("number",true);
                //return false;              
            }

        });       
    }
  };
})

.directive('selectReq', function($ionicPopup) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        scope.$watch(attrs.ngModel, function(value) {
            if(angular.isUndefined(value)){
                ngModel.$setValidity("selectReq",false);
                //return false;
            }else{
                ngModel.$setValidity("selectReq",true);
                //return true;
            }             

        });
    }
  };
})

.directive('comboReq', function($ionicPopup) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        scope.$watch(attrs.ngModel, function(value) {
            pri = angular.element(document.getElementsByName('ID_PLACE_PRICE'));
            pos = angular.element(document.getElementsByName('ID_POSITION'));
            if(angular.isUndefined(value)){
                ngModel.$setValidity("priceReq",false);    
                //return false;
            }else{
                ngModel.$setValidity("priceReq",true); 
                if(value == 300){
                    pri.controller('ngModel').$setValidity("priReq",true);
                    pri.val("");
                    if(pos.val() !== "" && !angular.isUndefined(pos.val())){
                        pos.controller('ngModel').$setValidity("posReq",true);        
                    }else{
                        pos.controller('ngModel').$setValidity("posReq",false);    
                    }
                    
                }else{
                    if(value == 301){
                        pos.controller('ngModel').$setValidity("posReq",true);
                        pos.val("");
                        if(pri.val() !== "" && !angular.isUndefined(pri.val())){
                            pri.controller('ngModel').$setValidity("priReq",true);        
                        }else{
                            pri.controller('ngModel').$setValidity("priReq",false);    
                        }   
                    }else{
                        //ngModel.$setValidity("priceReq",true);        
                    }
                    
                }
                
                //return true;
            }             

        });
    }
  };
})

.directive('posReq', function($ionicPopup) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        scope.$watch(attrs.ngModel, function(value) {
            tipo = angular.element(document.getElementsByName('ID_TYPE_PRICE'));
            if(angular.isUndefined(value)){
                if(tipo.val() == 300){
                    ngModel.$setValidity("posReq",false);  
                }else{
                    ngModel.$setValidity("posReq",true);
                }
                //ngModel.$setValidity("posReq",false);
                //return false;
            }else{
                ngModel.$setValidity("posReq",true);
                //return true;
            }             

        });
    }
  };
})

.directive('priReq', function($ionicPopup) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        scope.$watch(attrs.ngModel, function(value) {
            tipo = angular.element(document.getElementsByName('ID_TYPE_PRICE'));
            if(angular.isUndefined(value)){
                if(tipo.val() == 301){
                    ngModel.$setValidity("priReq",false);  
                }else{
                    ngModel.$setValidity("priReq",true);
                }
                //return false;
            }else{
                ngModel.$setValidity("priReq",true);
                //return true;
            }             

        });
    }
  };
})

.directive('selectDin', function($ionicPopup) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        scope.$watch(attrs.ngModel, function(value) {
            
            if(angular.isUndefined(value)){
                //etiqueta.attr("style","border-bottom: solid 1px #ccc;");
                //ngModel.$setValidity("selectDin",false);
                return false;
            }else{
                if (!angular.isUndefined(value)) {
                    //etiqueta.attr("style","border-bottom: solid 1px #60bc3f;"); 
                    ngModel.$setValidity("selectDin",true);
                    //return true;
                }else{
                    //etiqueta.attr("style","border-bottom: solid 1px #f00;");
                    elm[0].focus();
                    ngModel.$setValidity("selectDin",false);
                    //return false;                   
                }               
            }             

        });
    }    
  };
})

.directive('radioReq', function($ionicPopup) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        scope.$watch(attrs.ngModel, function(value) {
            if (!angular.isUndefined(value)) {
                //etiqueta.attr("style","border-bottom: solid 1px #60bc3f;");  
                ngModel.$setValidity("radioReq",true);
                //return true;
            }else{
                //etiqueta.attr("style","border-bottom: solid 1px #f00;");
                elm[0].focus();
                ngModel.$setValidity("radioReq",false);
                //return false;                   
            }               

        });
    }
  };
})

.directive('range', function () {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        scope.$watch(attrs.ngModel, function(value) {
            
            if (!angular.isUndefined(value)) {
                if(value.toString().match(/^[0-9]+$/)){
                    var min = ngModel.$isEmpty(attrs.ngMin) ? 0 : attrs.ngMin;
                    var max = ngModel.$isEmpty(attrs.ngMax) ? Infinity : attrs.ngMax;

                    if (ngModel.$isEmpty(value)) {
                        ngModel.$setValidity("range",false);
                       //return false;
                    }

                    if (!ngModel.$isEmpty(value) && value <= max && value >= min ) {
                        //console.log("si: "+JSON.stringify(viewValue));
                        //console.log("no number");
                        elm.attr("style","border-bottom: solid 1px #072142;"); 
                        ngModel.$setValidity("range",true);
                        //return true;
                    }else{
                        //console.log("no: "+JSON.stringify(viewValue));
                        elm[0].focus();
                        //console.log("no number");
                        elm.attr("style","border-bottom: solid 1px #f00;"); 
                        ngModel.$setValidity("range",false);
                        //return false;
                    }
                }else{
                    elm.attr("style","border-bottom: solid 1px #f00;"); 
                    ngModel.$setValidity("range",false);
                }
            }else{
                ngModel.$setValidity("range",false);
            }

        });
    }
  };
})

.directive('birhtDate', function($ionicPopup,ionicDatePicker, $filter) {
  return {
    restrict: 'A',
    require: 'ngModel',
    scope: {
        changeDate: '&' // bind to parent method
    },      
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        scope.$watch(attrs.ngModel, function(value) {
            ngModel.$setValidity("onlyDate",false);
            elm.off('click').on('click', function () {
                elm.val(" ");
                // using timeout instead of scope.$apply, notify angular of changes
                ipObj1 = {
                    callback: function (val) {  //Mandatory
                        scope.$parent.changeDate(ngModel.$name, $filter('date')(new Date(val), "dd-MM-yyyy")) ;
                        elm.removeClass("ng-pending");
                        elm.attr("style","border-bottom: solid 1px #072142;");
                        ngModel.$setValidity("onlyDate",true);
                        //return true;
                    },
                    templateType: 'popup',
                    from: new Date(1900, 1, 1),
                    to: new Date()
                };
                ionicDatePicker.openDatePicker(ipObj1);
                
            });            

        });
    }
  };
})
      
.directive('onlyDate', function($ionicPopup,ionicDatePicker, $filter) {
  return {
    restrict: 'A',
    require: 'ngModel',
    scope: {
        changeDate: '&' // bind to parent method
    },      
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        scope.$watch(attrs.ngModel, function(value) {
            ngModel.$setValidity("onlyDate",false);
            elm.off('click').on('click', function () {
                elm.val(" ");
                // using timeout instead of scope.$apply, notify angular of changes
                ipObj1 = {
                    callback: function (val) {  //Mandatory
                        scope.$parent.changeDate(ngModel.$name, $filter('date')(new Date(val), "dd-MM-yyyy")) ;
                        elm.removeClass("ng-pending");
                        elm.attr("style","border-bottom: solid 1px #072142;");
                        ngModel.$setValidity("onlyDate",true);
                        //return true;
                    },
                    templateType: 'popup'
                };
                ionicDatePicker.openDatePicker(ipObj1);
                
            });            

        });
    }
  };
})

.directive('date', function($ionicPopup,ionicDatePicker, $filter) {
  return {
    restrict: 'A',
    require: 'ngModel',
    scope: {
        changeDate: '&' // bind to parent method
    },
    link: function(scope, elm, attrs, ngModel) {
        var etiqueta = elm.parent();
        scope.$watch(attrs.ngModel, function(value) {
            elm.off('click').on('click', function () {
                elm.val(" ");
                // using timeout instead of scope.$apply, notify angular of changes
                ipObj1 = {
                    callback: function (val) {  //Mandatory
                        //elm.val($filter('date')(new Date(val), "dd-MM-yyyy"));
                        scope.$parent.changeDate(ngModel.$name, $filter('date')(new Date(val), "dd-MM-yyyy")) ;
                        elm.removeClass("ng-pending");
                        elm.attr("style","border-bottom: solid 1px #072142;");
                        return true;
                    },
                    templateType: 'popup'
                };
                ionicDatePicker.openDatePicker(ipObj1);
                

            });            

        });
    }
  };
})

.directive('passwordVerify', function($ionicPopup) {
  return {
    restrict: 'A', // only activate on element attribute
    require: '?ngModel',// con ? get a hold of NgModelController
    link: function(scope, elm, attrs, ngModel) {
        
        if (!ngModel) return; // do nothing if no ng-model
        
        // watch own value and re-validate on change
        scope.$watch(attrs.ngModel, function() {
          validate();
        });

        // observe the other value and re-validate on change
        attrs.$observe('passwordVerify', function(val) {
          validate();
        });

        var validate = function() {
          // values
          var val1 = ngModel.$viewValue;
          var val2 = attrs.passwordVerify;

          // set validity
          ngModel.$setValidity('passwordVerify', val1 === val2);
        };
        
    }
  };
})

// All this does is allow the message
// to be sent when you tap return
.directive('btnSend', function($timeout) {
  return {
    restrict: 'E',
    scope: {
      'returnClose': '=',
      'onReturn': '&',
      'onFocus': '&',
      'onBlur': '&'
    },
    link: function(scope, element, attr) {
      element.bind('focus', function(e) {
        if (scope.onFocus) {
          $timeout(function() {
            scope.onFocus();
          });
        }
      });
      element.bind('blur', function(e) {
        if (scope.onBlur) {
          $timeout(function() {
            scope.onBlur();
          });
        }
      });
      element.bind('keydown', function(e) {
        if (e.which == 13) {
          if (scope.returnClose) element[0].blur();
          if (scope.onReturn) {
            $timeout(function() {
              scope.onReturn();
            });
          }
        }
      });
    }
  };
})

.config(function ($ionicConfigProvider, ionicDatePickerProvider) {
    var toDate = new Date();
    var datePickerObj = {
        setLabel: 'Ok',
        todayLabel: 'Hoy',
        closeLabel: 'Cerrar',
        mondayFirst: false,
        inputDate: toDate,
        weeksList: ["D", "L", "M", "M", "J", "V", "S"],
        monthsList: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        templateType: 'popup',
        dateFormat: 'dd MMM yyyy',
        from: new Date(toDate.getFullYear(), 0, 1),
        to: new Date(toDate.getFullYear()+1, 11,31),
        closeOnSelect: false,
        disableWeekdays: []
    };

    ionicDatePickerProvider.configDatePicker(datePickerObj);

})

.value("linksWs",{
    link_root: "http://wintradeagro.com/core",
    /*link_root: "http://localhost/wtagro_wt",*/
    link_login: "/TUser/login",
    link_logout: "/TUser/logout",
    request: "",
    requests: "",
    negocio: "",
    negocios : "",
    alarm:"",
    alarms:"",
    localities:"",
    locality:"",    
    notify:"",
    notifys:"",
    products:"",
    provinces:"",
    provence:"",
    places:"",
    positions:"",
    deliveri:"",
    deliveries:"",
    chat: "",
    chats: "",
    usersId:"",
    deviceOs : "",
    checkRed : "",
    prodCateg: "",
    prodCategs: "",
    ge       : "",
    me       : "",
    pr       : "",
    tp       : "",
    mo       : "",
    um       : "",
    lu       : "",
    op       : "",
    ne       : "",
    ta       : "",
    user     : "",
    pc       : "",
    prd      : "",
    po       : "",
    co       : "",
    pa       : "",
    en       : "",
    or       : "",
    qt       : "",
    pp       : "",
    pt       : "",
    lp       : "",
    accessToken  : ""   
})

.run(function($history,$state, $ionicPlatform,$rootScope,$http,$location,$ionicPopup,$ionicLoading,$ionicHistory,linksWs) {
    $ionicPlatform.ready(function() {
        // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
        // for form inputs)
        if (window.cordova && window.cordova.plugins.Keyboard) {
          cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
          cordova.plugins.Keyboard.disableScroll(true);
        }
        if (window.StatusBar) {
          // Set the statusbar to use the default style, tweak this to
          // remove the status bar on iOS or change it to use white instead of dark colors.
          StatusBar.styleLightContent();
        }       
        Number.prototype.padLeft = function(base,chr){
           var  len = (String(base || 10).length - String(this).length)+1;
           return len > 0? new Array(len).join(chr || '0')+this : this;
        };        
        $rootScope.$on("$stateChangeSuccess", function(event, to, toParams, from, fromParams) {
            if (!from.abstract) {
                $history.push(from, fromParams);
            }
        });

        $history.push($state.current, $state.params);        
        // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
        // for form inputs)
        if (window.cordova && window.cordova.plugins && window.cordova.plugins.Keyboard) {
            cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
            cordova.plugins.Keyboard.disableScroll(true);
            //cordova.plugins.screen.orientation.lock('portrait');
            //window.cordova.plugins.screen.lockOrientation('portrait');
        }
        
        if(cordova.plugins.screen){
           cordova.plugins.screen.orientation.lock('portrait'); 
        }
    
        if(window.cordova.screen){
           window.cordova.screen.orientation.lock('portrait'); 
        }        
        
        if (window.StatusBar) {
            // org.apache.cordova.statusbar required
            StatusBar.styleDefault();
        }
        
        $ionicPlatform.registerBackButtonAction(function(e){
            e.preventDefault();
            return false;
        }, 101);
        
        window.localStorage.setItem('remember', false);
        window.localStorage.setItem('remember_u', '');
        window.localStorage.setItem('remember_p', '');
        
        /* ////////////////////////////////////////////////////// Funciones Globales ////////////////////////////////// */
        /* Funcion para evaluar si el campo está vacío o sólo contiene espacios */
        window.isBlank = function(str) {
            var regexp = /^\s*$/;
            return (!str || regexp.test(str));
        };

        /* Funcion para evaluar si el campo contiene sólo letras */
        window.isAlphabetic = function(str) {
            var regexp = /^[a-zA-Z]*$/;
            return (!str || regexp.test(str));
        };

        /* Funcion para evaluar acentos */
        window.tildes_unicode = function(str){
            str = str.replace('á','\u00e1');
            str = str.replace('é','\u00e9');
            str = str.replace('í','\u00ed');
            str = str.replace('ó','\u00f3');
            str = str.replace('ú','\u00fa');

            str = str.replace('Á','\u00c1');
            str = str.replace('É','\u00c9');
            str = str.replace('Í','\u00cd');
            str = str.replace('Ó','\u00d3');
            str = str.replace('Ú','\u00da');

            str = str.replace('ñ','\u00f1');
            str = str.replace('Ñ','\u00d1');
            return str;
        };
        
        window.checkRed = function(cbRed) {
            var networkState = navigator.connection.type;

            var states = {};
            states[Connection.UNKNOWN] = false;
            states[Connection.ETHERNET] = true;
            states[Connection.WIFI] = true;
            states[Connection.CELL_2G] = true;
            states[Connection.CELL_3G] = true;
            states[Connection.CELL_4G] = true;
            states[Connection.CELL] = true;
            states[Connection.NONE] = false;

            cbRed(states[networkState]);
        };
        
        window.esCUITValida = function(inputValor) {
            inputString = inputValor.toString();
            if (inputString.length == 11) {
                var Caracters_1_2 = inputString.charAt(0) + inputString.charAt(1);
                if (Caracters_1_2 == "20" || Caracters_1_2 == "23" || Caracters_1_2 == "24" || Caracters_1_2 == "27" || Caracters_1_2 == "30" || Caracters_1_2 == "33" || Caracters_1_2 == "34") {
                    var Count = inputString.charAt(0) * 5 + inputString.charAt(1) * 4 + inputString.charAt(2) * 3 + inputString.charAt(3) * 2 + inputString.charAt(4) * 7 + inputString.charAt(5) * 6 + inputString.charAt(6) * 5 + inputString.charAt(7) * 4 + inputString.charAt(8) * 3 + inputString.charAt(9) * 2 + inputString.charAt(10) * 1;
                    var Division = Count / 11;
                    if (Division == Math.floor(Division)) {
                        return true;
                    }
                }
            }
            return false;
        };
        
        window.isUniqueMail = function(inputValor) {
            var inputString = inputValor.toString();
            var unique = true;
            angular.forEach(linksWs.usersId, function(data, index) { 
                if(inputString == data.MAIL){
                    unique = false;
                }
            });
            return unique;
        };        
        
        //Network Call WS
        window.onWsAction = function(urlTo, parameters, successPostCallback) {
            checkRed(function(red){
                if(red){
                    if(linksWs.link_root !== null && linksWs.link_root !== "" ){
                        $http({
                            method: 'post',
                            url: urlTo,
                            params:parameters,
                            withCredentials: true,
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'Access-Control-Allow-Origin':'*',                                
                                'Authorization': "Bearer "+ linksWs.accessToken,
                                'token': linksWs.accessToken
                            },
                            cache:false
                        })
                        .then(function(response) {
                            successPostCallback(response);
                        },function(response) {
                            var msjError = "";
                            if(response.status == 401){
                                msjError = "401 Unauthorized: No Autorizado";   
                            }else{
                                if(response.status == 403){
                                    msjError = "403 Forbidden: Sin privilegios";    
                                }else{
                                    if(response.status == 404){
                                        msjError = "404 Not Found: Recurso no encontrado";       
                                    }else{
                                        if(response.status == 500){
                                            msjError = "500 Internal: Error en el Servidor";   
                                        }
                                    }
                                }
                            }                            
                            successPostCallback(msjError);
                        });

                    }else{
                        successPostCallback("");
                        //alert("no token set 136");
                    }                   
                }else{
                    var alertPopup = $ionicPopup.alert({
                        title: 'No Internet',
                        type : 'button-dark',
                    });
                    //alert("no internet"); 
                }
            });
        };  
        
        //Login WS
        window.wsLogin = function(parametros,requestLogin) {
            //alert(linksWs.link_root+linksWs.link_login+'.json');
            if(linksWs.accessToken == null || linksWs.accessToken == "" && linksWs.link_login != ""){
                $http({
                    method: 'post',
                    url: linksWs.link_root+linksWs.link_login+'.json', 
                    params:parametros,
                    cache:false
                })
                .then(function(response) {
                    /*alert(JSON.stringify(response));*/
                    var token = response.data;
                    if(typeof token.login !== null && typeof token.login !== typeof undefined){

                        //alert("Login: "+JSON.stringify(token));
                        if(angular.isString(token.login)){
                            if(token.login == "allreadyLogin"){
                                linksWs.accessToken = "";        
                                //wsLogout();
                                requestLogin(token.login);
                            }else{
                                //alert("string: "+token.login);
                                requestLogin(token.login);
                            }

                        }else{
                            linksWs.accessToken = token.login.token;
                            window.localStorage.setItem("winSMTokenAccess", token.login.token);
                            window.localStorage.setItem("winSMUserAccess", token.login.sub);
                            linksWs.user = token.login.sub;
                            requestLogin(1);
                        }

                    }else{
                        requestLogin(0);
                    }
                },function(response) {
                    // Handle error here
                    var msjError = "";
                    if(response.status == 401){
                        //window.localStorage.setItem('vbmAccessToken', null);
                        msjError = "401 Unauthorized: No Autorizado";   
                    }else{
                        if(response.status == 403){
                            msjError = "403 Forbidden: Sin privilegios";    
                        }else{
                            if(response.status == 404){
                                msjError = "404 Not Found: Recurso no encontrado";       
                            }else{
                                if(response.status == 500){
                                    msjError = "500 Internal: Error en el Servidor";   
                                }else{
                                    msjError = JSON.stringify(response);
                                }
                            }
                        }
                    }
                    requestLogin(msjError);
                    //console.error("Error: ", "Login 642", msjError);
                });

            }else{
                //console.error("Error: ", "Login Token Null", "646");
                if(linksWs.link_login == ""){
                    requestLogin(0);
                }else{
                    requestLogin(1);    
                }
            }

        }; 

        //Logout WS
        window.wsLogout = function(requestLogout) {
            $http({
                method: 'post',
                url: linksWs.link_root+linksWs.link_logout+'.json', 
                headers: {
                    'Authorization':"Bearer "+linksWs.accessToken
                },                
                cache:false
            })
            .then(function(response) {
                var tokend = response.data
                linksWs.accessToken = "";
                window.localStorage.setItem("winSMTokenAccess", "");
                window.localStorage.setItem("winSMUserAccess", "");
                if(typeof tokend.login !== null && typeof tokend.login !== typeof undefined){
                    requestLogout(1);
                }else{
                    requestLogout(1);
                }
            },function(response) {
                var msjError = "";
                linksWs.accessToken = ""; 
                if(response.status == 401){
                    //window.localStorage.setItem('vbmAccessToken', null);
                    msjError = "401 Unauthorized: No Autorizado";   
                }else{
                    if(response.status == 403){
                        msjError = "403 Forbidden: Sin privilegios";    
                    }else{
                        if(response.status == 404){
                            msjError = "404 Not Found: Recurso no encontrado";       
                        }else{
                            if(response.status == 500){
                                msjError = "500 Internal: Error en el Servidor";   
                            }
                        }
                    }
                }
                /*console.log(msjError);*/
                requestLogout(1);
                //alert("catch error: "+msjError);                
            });

        }; 
        
        if(/Android [4-6]/.test(navigator.appVersion)) {
           window.addEventListener("resize", function() {
              if(document.activeElement.tagName=="INPUT" || document.activeElement.tagName=="TEXTAREA") {
                 window.setTimeout(function() {
                    document.activeElement.scrollIntoViewIfNeeded();
                 },0);
              }
           })
        }
        
        if(window.cordova && window.cordova.plugins.Keyboard) {
            window.cordova.plugins.Keyboard.disableScroll(true);
            cordova.plugins.Keyboard.disableScroll(true);    
        }else{
            if(cordova.plugins && cordova.plugins.Keyboard) {
                cordova.plugins.Keyboard.disableScroll(true);    
            }            
        }     
        
        
        linksWs.deviceUi = device.uuid;
        linksWs.deviceOs = device.platform; 
        
        //alert("Device UI: "+navigator.appVersion);
        //alert("Device OS: "+linksWs.deviceOs);
        $state.go('app.init');
    });
  
});



/*
 * Please see the included README.md file for license terms and conditions.
 */


// This file is a suggested starting place for your code.
// It is completely optional and not required.
// Note the reference that includes it in the index.html file.


/*jslint browser:true, devel:true, white:true, vars:true */
/*global $:false, intel:false app:false, dev:false, cordova:false */



// This file contains your event handlers, the center of your application.
// NOTE: see app.initEvents() in init-app.js for event handler initialization code.

function myEventHandler() {
    "use strict" ;

    var ua = navigator.userAgent ;
    var str ;

    if( window.Cordova && dev.isDeviceReady.c_cordova_ready__ ) {
            str = "It worked! Cordova device ready detected at " + dev.isDeviceReady.c_cordova_ready__ + " milliseconds!" ;
    }
    else if( window.intel && intel.xdk && dev.isDeviceReady.d_xdk_ready______ ) {
            str = "It worked! Intel XDK device ready detected at " + dev.isDeviceReady.d_xdk_ready______ + " milliseconds!" ;
    }
    else {
        str = "Bad device ready, or none available because we're running in a browser." ;
    }

    alert(str) ;
}


// ...additional event handlers here...

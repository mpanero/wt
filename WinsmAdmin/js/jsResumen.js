var counterBlock = 0;
$(document).ready(function () {
    $("#pagActual").html("Tablero de control");
    blockUISystem();
    resumenRequest("",function(resumen){
        var tbody = "";
        var bg = "";
        if(resumen.length > 0){
            $.each(resumen, function(fila, columna){
                if(columna.typ.INFO.toLowerCase() == "compra"){
                    bg = "indigo";
                }else{
                    bg = "danger";
                }                
                tbody += ''+
                '<tr>'+
                    '<td>'+
                        '<div class="media-left media-middle">'+
                            '<a href="" class="btn bg-'+bg+'-700 btn-rounded btn-icon btn-xs">'+
                                '<span class="letter-icon">'+columna.typ.INFO+'</span>'+
                            '</a>'+
                        '</div>'+
                        '<div class="media-body">'+
                            '<a href="" class="display-inline-block text-default text-semibold letter-icon-title">'+columna.typ.INFO+'</a>'+
                        '</div>'+
                    '</td>'+
                    '<td>'+
                        ''+columna.prd.PRODUCT_NAME+''+
                    '</td>'+
                    '<td class="text-center">'+
                        ''+columna.cant+''+
                    '</td>'+
                    '<td class="text-center">'+
                        ''+columna.QT_AVG_TOT+''+
                    '</td>'+
                    '<td class="text-center">'+
                        '$'+columna.PRICE_AVG_TOT+''+
                    '</td>'+
                '</tr>';
            });
           
        }else{
            tbody += ''+
            '<tr>'+
                '<td colspan="5">'+
                    'Sin Información'+
                '</td>'+
            '</tr>';            
        }

        $("#tblResumenRequest tbody").append(tbody);
        // Grab first letter and insert to the icon
        $("#tblResumenRequest tr").each(function (i) {
            
            // Title
            var $title = $(this).find('.letter-icon-title'),
                letter = $title.eq(0).text().charAt(0).toUpperCase();

            // Icon
            var $icon = $(this).find('.letter-icon');
                $icon.eq(0).text(letter);
        });  
        validateLoadComplete();       
    });

    resumenTrade("",function(resumen){
        var tbody = "";
        var bg = "";
        if(resumen.length > 0){
            $.each(resumen, function(fila, columna){
                if(columna.OPERATION.toLowerCase() == "compra"){
                    bg = "indigo";
                }else{
                    bg = "danger";
                }
                tbody += ''+
                '<tr>'+
                    '<td>'+
                        '<div class="media-left media-middle">'+
                            '<a href="" class="btn bg-'+bg+'-700 btn-rounded btn-icon btn-xs">'+
                                '<span class="letter-icon">'+columna.OPERATION+'</span>'+
                            '</a>'+
                        '</div>'+
                        '<div class="media-body">'+
                            '<a href="" class="display-inline-block text-default text-semibold letter-icon-title">'+columna.OPERATION+'</a>'+
                        '</div>'+
                    '</td>'+
                    '<td>'+
                        '<div class="text-muted text-size-small"><span class="status-mark border-'+columna.COLOR.toLowerCase()+' position-left"></span> '+columna.INFO1+'</div>'+
                    '</td>'+
                    '<td>'+
                        ''+columna.t_product__PRODUCT_NAME+''+
                    '</td>'+
                    '<td class="text-center">'+
                        ''+columna.QTR+''+
                    '</td>'+
                    '<td class="text-center">'+
                        ''+columna.QT_TOTAL+''+
                    '</td>'+
                    '<td class="text-center">'+
                        '$'+columna.PRICE_AVG_TOT+''+
                    '</td>'+
                '</tr>';
            });
           
        }else{
            tbody += ''+
            '<tr>'+
                '<td colspan="5">'+
                    'Sin Información'+
                '</td>'+
            '</tr>';            
        }
        $("#tblResumenTrade tbody").append(tbody);
        // Grab first letter and insert to the icon
        $("#tblResumenTrade tr").each(function (i) {
            
            // Title
            var $title = $(this).find('.letter-icon-title'),
                letter = $title.eq(0).text().charAt(0).toUpperCase();

            // Icon
            var $icon = $(this).find('.letter-icon');
                $icon.eq(0).text(letter);
        });         
        validateLoadComplete();
    });

    resumenPrice("",function(resumen){
        var tbody = "";
        if(resumen.length > 0){
            $.each(resumen, function(fila, columna){
                tbody += ''+
                '<tr>'+
                    '<td>'+
                        '<div class="media-left media-middle">'+
                            '<a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">'+
                                '<span class="letter-icon"></span>'+
                            '</a>'+
                        '</div>'+
                        '<div class="media-body">'+
                            '<div class="media-heading">'+
                                '<a href="#" class="letter-icon-title">'+columna.TProductsPrice__PRODUCT_NAME+'</a>'+
                            '</div>'+
                            '<div class="text-muted text-size-small"><i class="icon-checkmark3 text-size-mini position-left"></i>&nbsp</div>'+
                        '</div>'+
                    '</td>'+
                    '<td>'+
                        '<span class="text-muted text-size-small">'+columna.t_prices__UPDATED+'</span>'+
                    '</td>'+
                    '<td>'+
                        '<h6 class="text-semibold no-margin">$'+columna.t_prices__PRICE_VALUE+'</h6>'+
                    '</td>'+
                '</tr>';
            });
           
        }else{
            tbody += ''+
            '<tr>'+
                '<td colspan="5">'+
                    'Sin Información'+
                '</td>'+
            '</tr>';            
        }
        $("#tblResumenPrice tbody").append(tbody);
        // Grab first letter and insert to the icon
        $("#tblResumenPrice tr").each(function (i) {
            
            // Title
            var $title = $(this).find('.letter-icon-title'),
                letter = $title.eq(0).text().charAt(0).toUpperCase();

            // Icon
            var $icon = $(this).find('.letter-icon');
                $icon.eq(0).text(letter);
        });
        validateLoadComplete();
    });

});


function validateLoadComplete() {
    counterBlock++;
    if (counterBlock === 3) {
        counterBlock = 0;
        setTimeout(function () {
            unblockUISystem();
        }, 1700);
        
    }

}
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

(function($) {
    $.get = function(key)   {
        key = key.replace(/[\[]/, '\\[');
        key = key.replace(/[\]]/, '\\]');
        var pattern = "[\\?&]" + key + "=([^&#]*)";
        var regex = new RegExp(pattern);
        var url = unescape(window.location.href);
        var results = regex.exec(url);
        if (results === null) {
            return null;
        } else {
            return results[1];
        }
    }
})(jQuery);
//var prog_id = $('#prog_id').val();
//var dep = $.get("d");
var dep = $('#dep_id').val();
//var mes = $.get("m");
var mes = $('#prog_mes').val();
//var año = $.get("a");
var año = $('#prog_anio').val();
                        
function setFecha(){  
    $('#calendar').fullCalendar('gotoDate',año,mes-1);
}
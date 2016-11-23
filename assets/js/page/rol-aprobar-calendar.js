/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

(function($) {
    $.get = function(key)	{
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

var dep = $.get("d");
var mes = '6';
var año = $.get("a");
                        
function setFecha(){  
    $('#calendar2').fullCalendar('gotoDate',año,mes);
}
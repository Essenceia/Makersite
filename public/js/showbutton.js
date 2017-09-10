/**
 * Created by pookie on 6/28/17.
 */
$(document).ready( function() {
    $('[id^=machinetype]').click(function () {
        $thisid = this.id.charAt(this.id.length-1);
        $('#typeid'+$thisid).show(1500);
    });
});

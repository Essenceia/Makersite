/**
 * Created by pookie on 8/30/17.
 */
$(document).ready(function(){
    $(".question").click(function(){
        $(this).next().show(1000);
    });
});
// Validating Empty Field
//var path = document.location.pathname
//alert(path);
//location /index.php/events/
function check_empty() {
        alert("Fill All Fields !");
        $.ajax({
            data: 'nom='+$('#nom').val(),
            type: "POST",
            url: "/../data/forms/event.php",
            success: function(msg){
                alert("Data Save: " + msg);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });



}
//Function To Display Popup
function form_show() {
    document.getElementById('popup').style.display = "block";
}
//Function to Hide Popup
function form_hide(){
    document.getElementById('popup').style.display = "none";
}/**
 * Created by pookie on 6/25/17.
 */

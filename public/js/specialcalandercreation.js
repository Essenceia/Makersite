/**
 * Created by pookie on 9/19/17.
 */
$(document).ready(function(){
    function getlastid() {
        //sort all form and get last id
        var lastid=$("#datelist.days >th> label:nth-last-child").valueOf('id');
        if(lastid==null){
            lastid=0;
        }else{
            lastid+=1;
        }
        window.alert(lastid);
        return lastid;
    }
    $("#adddate").click(function(){
        var inputdate = $("#newadddate").val();
        var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

        if(!regex_date.test(inputdate))
        {
            alert("'"+__('calander.dateformaterr')+"'");
        }else{
            //add to table
            var id=getlastid();//todo find latest id
            var toappend = "<th><label for='date["+id+"].selected' class='control-label'>"+inputdate+"</label></th><td><input checked='checked' name=date["+id+"].selected' value='0' id=date["+id+"].selected' type='checkbox'></td>";

        }
    });
});
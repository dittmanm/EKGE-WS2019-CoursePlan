$(document).ready(function(){
    var defaultText = '';
    $("#fn").blur(function(){
        if($(this).val()==""){
            $(this).val(defaultText);
        }
    });
    $("#gn").blur(function(){
        if($(this).val()==""){
            $(this).val(defaultText);
        }
    });
    $("#id").focus(function(){
        var gn = $("#gn").val().substr(0, 1);
        var fn = $("#fn").val().substr(0, 1);
        $(this).val(gn + fn);
    });

    $("#id").blur(function() {
        var iPid = $(this).val() ;
        $.ajax({
            type: "GET",
            url: 'Controller/apiController.php?iPid='+iPid,
            success: function(data) {
                if (data == 0) {
                    $("#id").css("border", "2px solid green");
                    //$("idhint").removeClass('activ');
                    document.getElementById('idhint').style.display='none';
                    //$("#idhint").hide();
                } else if (data == 1) { 
                    $("#id").css("border", "2px solid red");
                    //$("#idhint").addClass("activ");
                    document.getElementById('idhint').style.display='block';
                    //$("#idhint").show();
                } else if (data == 2) { console.log("zwei") }
            }
        });
    });

    

});
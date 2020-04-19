$(document).ready(function(){
  $(".switchYear select").blur(function() {
      var sYear = $(this).val() ;
      $.ajax({
          type: "GET",
          url: 'Controller/apiController.php?switchYear='+sYear,
          success: function(data) {
            $("#id").css("border", "2px solid green");
          }
      });
  });

  

});
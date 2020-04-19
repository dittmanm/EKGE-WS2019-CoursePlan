$(document).ready(function(){
  $("#s_year").change(function() {
      var sYear = $(this).val() ;
      $.ajax({
          type: "GET",
          url: 'Controller/apiController.php?s_year='+sYear,
          success: function(data) {
            $("#s_year").css("border", "2px solid green");
          }
      });
  });

});
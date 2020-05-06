$(document).ready(function(){
  $("#s_year").change(function() {
      var sYear = $(this).val() ;
      $.ajax({
          type: "GET",
          url: 'Controller/apiController.php?s_year='+sYear,
          success: function(data) {
            console.log(data);
            //window.location.reload(false);
            //window.location.href = "index.php"+data;
            $("#s_year").css("border", "2px solid green");
          }
      });
  });

  $("#sp").change(function() {
    var sp = $(this).val() ;
    window.location.href = "index.php?model=mp&controller=mp&sp="+sp;
    $("#sp").css("border", "2px solid green");
  });

});
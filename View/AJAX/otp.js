$(document).ready(function() {
  $("#getotp").click(function() {
    $.ajax({
      type: "POST",
      url: "./Controller/otp_process.php",
      data: {email: $('#email').val()},
      success: function(response) {
          $("#getotpfield").html(response);
          $("#email").attr("readonly", true);
          console.log(response);
      },
    });
  });
});
$(document).ready(function() {
  $("#getotp").click(function() {
    var email = $('#email').val();
    var password = $('#password').val();
    var userName = $('#userName').val();
    if (!email || !password || !userName) {
      alert("Fill All the Fields");
    }
    else {
      $.ajax({
        type: "POST",
        url: "./Controller/otpProcess.php",
        data: {email: $('#email').val()},
        success: function(response) {
          $("#getotpfield").html(response);
          $("#email").attr("readonly", true);
          console.log(response);
        },
      });
    }
  });
});

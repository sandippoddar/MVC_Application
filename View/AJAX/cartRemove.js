$(document).ready(function () {
  $(document).on("click", ".delete", function() {
    var productId = $(this).data('product-id');
      $.ajax({
        type: 'POST',
        url: '../Controller/removeCartProcess.php', 
        data: { product_id: productId },
        success: function(response) {
          $('.cart').html(response);
        }
      });
  });
  $(document).on("click", ".buy", function() {
    var productId = $(this).data('product-id');
      $.ajax({
        type: 'POST',
        url: '../Controller/buyPdf.php', 
        data: { product_id: productId },
        success: function(response) {
          console.log(response);
        }
      });
  });

  
})
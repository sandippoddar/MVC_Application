$(document).ready(function () {
  $(document).on("click", ".cart", function(){
    var productId = $(this).data('product-id');
      $.ajax({
        type: 'POST',
        url: '../Controller/cart_process.php', 
        data: { product_id: productId },
        success: function(response) {
          console.log(response);
        }
      });
  });
})

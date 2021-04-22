 

$('.single_add_to_cart_button').click(function(e) {
          e.preventDefault();
          var p_id = $("#id_produto").val();
          var quantity = $("#diarias_int").val();
          addToCart(p_id, quantity);
          return false;
       });    

       function addToCart(p_id, quantity) {
          $.get('/?post_type=product&add-to-cart=' + p_id +'&quantity=' + quantity, function(response) {
            	window.location.href = '/finalizar-compra';
          });
       }
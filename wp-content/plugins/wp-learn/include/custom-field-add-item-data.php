<?php
function cfwc_add_custom_field_item_data($cart_item_data, $product_id, $variation_id, $quantity){
    if(!empty($_POST['cfwc-title-field'])){
        $cart_item_data['title_feild'] = $_POST['cfwc-title-field'];
        $product = wc_get_product($product_id);
        $price = $product->get_price(); // Expanded function
        $cart_item_data['total_price'] = $price + 100; // Expanded function
    }
    return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'cfwc_add_custom_field_item_data', 10, 4 );
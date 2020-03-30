<?php
/**
 * Validate the text field
 * @since 1.0.0
 * @param Array $passed Validation status.
 * @param Integer $product_id Product ID.
 * @param Boolean $quantity Quantity
 */
function cfwc_validate_custom_field($passed, $post_id, $quantity ){
    if(empty($_POST['cfwc-title-field'])){
        $passed = false;
        wc_add_notice(__(' Please enter a value into the next field. ', 'cfwc'), 'error');

    }
    return $passed;
}
add_filter('woocommerce_add_to_cart_validation', 'cfwc_validate_custom_field', 10, 3);
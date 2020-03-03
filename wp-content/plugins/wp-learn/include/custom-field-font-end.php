<?php
/**
 * Display the custom text field
 * @since 1.0.0
 */

function cfwc_display_custom_field(){
  global $post;
  $product = wc_get_product($post->ID);
  $title = $product->get_meta('custom_text_field_title');
  if($title){
    printf(
      '<div class="cfwc-custom-field-wrapper">
        <label for="cfwc-title-field">%s</label>:<br>
        <input type="text" id="cfwc-title-field" name="cfwc-title-field" value="" placeholder="Title text">
      </div> <br>',
      esc_html($title)
    );
  }
}
add_action('woocommerce_before_add_to_cart_button', 'cfwc_display_custom_field');
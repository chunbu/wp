<?php
/**
 * Display the custom text field
 * @since 1.0.0
 */
function cfwc_create_custom_field() {
  $args = array(
  'id' => 'custom_text_field_title',
  'label' => __( 'Custom Text Field Title', 'cfwc' ),
  'class' => 'cfwc-custom-field',
  'desc_tip' => true,
  'description' => __( 'Enter the title of your custom text field.', 'ctwc' ),
  );
  woocommerce_wp_text_input( $args );
 }
 add_action( 'woocommerce_product_options_general_product_data', 'cfwc_create_custom_field' );

 function cfwc_save_custom_field( $post_id ) {
  $product = wc_get_product( $post_id );
  $title = isset( $_POST['custom_text_field_title'] ) ? $_POST['custom_text_field_title'] : '';
  $product->update_meta_data( 'custom_text_field_title', sanitize_text_field( $title ) );
  $product->save();
 }
 add_action( 'woocommerce_process_product_meta', 'cfwc_save_custom_field' );


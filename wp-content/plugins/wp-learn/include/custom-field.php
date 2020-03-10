<?php

class MyCustom{
    function __construct(){
        // $this->load();
    }
    function load(){

        add_action( 'woocommerce_product_options_general_product_data', array( $this,'add_feild_font_end' ));
        //save field type text admin
        add_action( 'woocommerce_process_product_meta', array( $this,'cfwc_save_custom_field' ));
        //font funtion 
        add_action('woocommerce_before_add_to_cart_button', array( $this,'cfwc_display_custom_field' ));
        //validate 
        add_filter('woocommerce_add_to_cart_validation', array( $this,'cfwc_validate_custom_field'), 10, 3);
        // //
        add_action( 'woocommerce_add_cart_item_data', array( $this,'pin_data_cart'), 10, 3 );
        //
        add_action( 'woocommerce_get_item_data', array( $this,'printf_data_add'), 10, 3 );

    }

    function add_feild_font_end(){
        $args = array(
            'id' => 'custom_text_field_title',
            'label' => __( 'Custom Text Field Title', 'cfwc' ),
            'class' => 'cfwc-custom-field',
            'desc_tip' => true,
            'description' => __( 'Enter the title of your custom text field.', 'ctwc' ),
            );
            woocommerce_wp_text_input( $args );
    }
    //save 
    
    function cfwc_save_custom_field( $post_id ) {
        $product = wc_get_product( $post_id );
        $title = isset( $_POST['custom_text_field_title'] ) ? $_POST['custom_text_field_title'] : '';
        $product->update_meta_data( 'custom_text_field_title', sanitize_text_field( $title ) );
        $product->save();
    }
    //fontend - tetile-text
    
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
    //validate text_field,
    function cfwc_validate_custom_field($passed, $post_id, $quantity ){
        if(empty($_POST['cfwc-title-field'])){
            $passed = false;
            wc_add_notice(__(' Please enter a value into the next field. ', 'cfwc'), 'error');
    
        }
        return $passed;
    }
    //
    function pin_data_cart( $cart_item_data, $product_id, $engraving_text ) {
        $engraving_text = $_POST['cfwc-title-field'];
         //var_dump($engraving_text); die;
        if ( empty( $engraving_text ) ) {
        return $cart_item_data;
        }
         
        $cart_item_data['cfwc-title-field'] = $engraving_text;
         
        return $cart_item_data;
    }
         
        
    function printf_data_add( $item_data, $cart_item ) {
        if ( empty( $cart_item['cfwc-title-field'] ) ) {
            return $item_data;
        }
             
        $item_data[0] = array(
            'key' => __( 'Text title', 'iconic' ),
            'value' => wc_clean( $cart_item['cfwc-title-field'] ),
            'display' => '',
        );
    
        return $item_data;
        
    }         
    
}
$mycustom = new MyCustom;

$mycustom->load();
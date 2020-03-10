<?php
define('MB_PERSONALIZED_URL', plugin_dir_url(__FILE__));
class MB_Personalized{
    function __construct(){
        //$this->load();
    }
    function load(){

        add_action('woocommerce_before_add_to_cart_button', array( $this,'get_data_json'));

        add_action('woocommerce_product_options_general_product_data', array( $this,'add_display_custom_field_back_end'));

        add_action('woocommerce_process_product_meta', array( $this,'save_custom_field'));

        add_filter( 'woocommerce_add_cart_item_data', array( $this,'pin_data_add_to_cart'), 10, 6 );

        add_action( 'woocommerce_get_item_data', array( $this,'print_data_add_to_cart'), 10, 4);
        
        add_action( 'woocommerce_checkout_create_order_line_item', array( $this,'print_data_add_to_bill'), 10, 4);


        add_action( 'init', function(){
            if ( isset( $_GET['dev'] ) ) {
                $option = get_option( 'order-value' );
                echo '<pre>';
                print_r( $option );
                echo '</pre>';
            }
        });
    }
    function get_data_json() {

        $string1 = file_get_contents("https://gist.githubusercontent.com/TruongTuyen/d8c066d61c71da1f992713bc2e02fe2c/raw/4bc27e6e6e6df2bf51955c26b0fc10d038bbaad7/persionalized-configs.json");
        $json = json_decode($string1, true);
        foreach ($json as $key => $value) {
            ?>
            <div style="width:300px">
             <?php if ($value['field_type']==='text'||$value['field_type']==='number') { ?>
                    <div class="<?php echo esc_attr($value['title'])?>">
                        <label for=""><?php echo esc_html($value['title'])?></label>:<br>
                        <input type="<?php echo esc_attr($value['field_type'])?>"class="<?php echo esc_attr($value['field_name'])?>" id="<?php echo esc_attr($value['field_name'])?>" name="pm_personalized[<?php echo esc_attr($value['field_name'])?>]" placeholder="<?php echo esc_attr($value['title'])?>" style="width:300px" <?php if(!empty($value['configs']['settings']['min'])||!empty($value['configs']['settings']['max'])){ $a = $value['configs']['settings']['min']; $b=$value['configs']['settings']['max'];echo "min='$a'max='$b'";}?>>
                    </div>
            <?php } elseif($value['field_type']==='textarea'){ ?>
                <div class="<?php echo esc_attr($value['title'])?>">
                    <label for=""><?php echo esc_html($value['title'])?></label>:<br>
                    <textarea class="<?php echo esc_attr($value['field_name'])?>" id="<?php echo esc_attr($value['field_name'])?>" name="pm_personalized[<?php echo esc_attr($value['field_name'])?>]"></textarea>
                </div>
            <?php } elseif($value['field_type']==='checkbox'){ ?>
                <div class="<?php echo esc_attr($value['title'])?>" style="text-align:justify">
                <label for=""><?php echo esc_html($value['title'])?></label>:<br>
                <?php foreach($value['configs']['settings']['options'] as $key => $val){
                    ?>
                        <input type="<?php echo esc_attr($value['field_type'])?>"class="<?php echo esc_attr($value['field_name'])?>" id="<?php echo esc_attr($value['field_name'])?>" name="pm_personalized[<?php echo esc_attr($value['field_name'])?>][]" placeholder="<?php echo esc_attr($value['title'])?>" <?php if($val==='Orange'){ echo 'checked';}?> value="<?php echo esc_attr($val)?>">
                        <span ><?php echo esc_html($val)?></span>
                    <?php
                    }
                ?>
                </div>
            <?php } elseif($value['field_type']==='radio'){ ?>
                <div class="<?php echo esc_attr($value['title'])?>" style="text-align:justify">
                    <label for=""><?php echo esc_html($value['title'])?></label>:<br>
                    <div>
                        <?php foreach($value['configs']['settings']['options'] as $key => $val){
                            ?>
                            <input type="<?php echo esc_attr($value['field_type'])?>"class="<?php echo esc_attr($value['field_name'])?>" id="<?php echo esc_attr($value['field_name'])?>" name="pm_personalized[<?php echo esc_attr($value['field_name'])?>]" placeholder="<?php echo esc_attr($value['title'])?>" <?php if($val==='Orange'){ echo 'checked = checked';}?> value="<?php echo esc_attr($val)?>">
                            <span><?php echo esc_html($val)?></span>
                        <?php
                        }
                       ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="<?php echo esc_attr($value['title'])?>">
                    <label for=""><?php echo esc_html($value['title'])?></label>:<br>
                    <select name="pm_personalized[<?php echo esc_attr($value['field_name'])?>]" style="width:300px">
                        <?php foreach($value['configs']['settings']['options'] as $key => $val){
                            ?>
                              <br>
                                <option value="<?php echo esc_attr($val['value'])?>"><?php echo esc_html( $val['label'])?></option>
                            <?php
                        }
                       ?>
                    </select>
                </div>
            <?php } ?> 
        </div>
        <br>
        <?php
        }
        global $post;
        $product = wc_get_product($post->ID);
        $title = $product->get_meta('custom-field-title');
        // if($title){
            printf(
                '<div class="custom-field-title">
                    <label for="field-title">%s :</label><br>
                    <input type="text" name="pm_personalized[custom-field-title]" id="custom-field-title" placeholder="You Title" style="width:300px">
                </div><br>',
                esc_html($title)
            );
        //}
    }

    function add_display_custom_field_back_end(){
        $arg = array(
            'id' => 'custom-field-title',
            'label' => __( 'Custom Text Field Title', 'cfwc' ),
            'class' => 'custom-field-title',
            'desc_tip' => true,
            'description' => __( 'Enter the title of your custom text field.', 'ctwc' ),
        );
        woocommerce_wp_text_input( $arg );
    }

    function save_custom_field($post_id){
        $product = wc_get_product($post_id);
        $title = isset($_POST['custom-field-title']) ? $_POST['custom-field-title'] : '';
        $product->update_meta_data( 'custom-field-title', sanitize_text_field( $title ) );
        $product->save();
    }

    function validate_custom_field($passed, $post_id, $quantity){
        if( empty( $_POST['cfwc-title-field'] ) ) {
            // Fails validation
            $passed = false;
            wc_add_notice( __( 'Please enter a value into the text field', 'cfwc' ), 'error' );
        }
        return $passed;
        
        // if(empty($_POST['your-name'])){
        //     $passed = false;
        //     wc_add_notice(__(' Please enter a value into the your-name. ', 'cfwc'), 'error');
    
        // }
        // if(empty($_POST['your-quotes'])){
        //     $passed = false;
        //     wc_add_notice(__(' Please enter a value into the your-quotes. ', 'cfwc'), 'error');
    
        // }
        // if(empty($_POST['your-number'])){
        //     $passed = false;
        //     wc_add_notice(__(' Please enter a value into the your-number. ', 'cfwc'), 'error');
    
        // }
        // if(empty($_POST['your-checkbox'])){
        //     $passed = false;
        //     wc_add_notice(__(' Please enter a value into the your-checkbox. ', 'cfwc'), 'error');
    
        // }if(empty($_POST['your-radio'])){
        //     $passed = false;
        //     wc_add_notice(__(' Please enter a value into the your-radio. ', 'cfwc'), 'error');
    
        // }
        // // if(empty($_POST['your-dropdown'])){
        // //     $passed = false;
        // //     wc_add_notice(__(' Please enter a value into the your-dropdown. ', 'cfwc'), 'error');
    
        // // }
        // // if(empty($_POST['title'])){
        // //     $passed = false;
        // //     wc_add_notice(__(' Please enter a value into the title. ', 'cfwc'), 'error');
    
        // // }
        // return $passed;
    }

    function pin_data_add_to_cart($cart_item_data, $product_id, $variation_id, $quantity){
        
        if( ! empty( $_POST) ) {
            // Add the item data
            $ignore_keys = array( 'quantity', 'add-to-cart' );
            $personalized_data = array();
            foreach($_POST as $key => $value){
                if ( ! in_array( $key, $ignore_keys ) ) {
                    $personalized_data[ $key ] = $value;
                }
            }
            
            if ( ! empty( $personalized_data ) ) {
                $cart_item_data['personalized_data'] = $personalized_data;
            }
            
        }
        echo '<pre>';
                print_r( $_POST );
                echo '</pre>';
        return $cart_item_data;
    }
    function print_data_add_to_cart($item_data, $cart_item_data ){

        $data = $cart_item_data['personalized_data'];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
               foreach($value as $k => $val){
                    if (is_array($val)) {
                        foreach ($val as $m => $v) {
                            $item_data[$m] = array(
                                'key' => __($k),
                                'value' => wc_clean($v ),
                                'display' => '',
                            );
                        }
                    }else{
                        $item_data[$k] = array(
                            'key' => __( $k),
                            'value' => wc_clean( $val ),
                            'display' => '',
                        );
                    }
               }
            }
            else{
                $item_data[$key] = array(
                                    'key' => __( $key),
                                    'value' => wc_clean( $value ),
                                    'display' => '',
                                );
            }
            
        }

        return $item_data;
    }
    function print_data_add_to_bill(  $item, $item_data, $values, $order ){
       
        

        update_option('order-item', $item);
       
        update_option('order12e',$item_data);

        update_option('order-value',$values);
     
        //$item->add_meta_data( __( 'Custom Field', 'cfwc' ), 'híhihd', true );
    }
    
}
$mycustom = new MB_Personalized;

$mycustom->load();
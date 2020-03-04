<?php
define('MB_PERSONALIZED_URL', plugin_dir_url(__FILE__));
class MB_Personalized{
    function __construct(){
        //$this->load();
    }
    function load(){

        add_action( 'woocommerce_before_single_product', array($this, 'get_data_json_no1'), 10);
        do_action( 'woocommerce_before_single_product', array($this, 'get_data_json_no1'), 10);

    }
    function get_data_json_no1($string1) {

        $string1 = file_get_contents("https://gist.githubusercontent.com/TruongTuyen/d8c066d61c71da1f992713bc2e02fe2c/raw/4bc27e6e6e6df2bf51955c26b0fc10d038bbaad7/persionalized-configs.json");
        $json = json_decode($string1, true);

        $meta = array(
            'id' => '1',
            'label' => $json[0]['title'],
            'for' => $json[0]['title'],
            'name' => $json[0]['field_name'],
            'type' => $json[0]['field_type'],
            'class' => $json[0]['field_name'],
            'desc_tip' => true,
            'description' => __( '', 'ctwc' ),
        );
       woocommerce_wp_text_input($meta);
        
    }
    
}
$mycustom = new MB_Personalized;

$mycustom->load();
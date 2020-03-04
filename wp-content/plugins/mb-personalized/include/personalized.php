<?php
define('MB_PERSONALIZED_URL', plugin_dir_url(__FILE__));
class MB_Personalized{
    function __construct(){
        //$this->load();
    }
    function load(){

        add_action( 'admin_init', array($this, 'get_data_json_no1'), 10, 2);

    }
    function get_data_json_no1() {

        $string1 = file_get_contents("https://gist.githubusercontent.com/TruongTuyen/d8c066d61c71da1f992713bc2e02fe2c/raw/4bc27e6e6e6df2bf51955c26b0fc10d038bbaad7/persionalized-configs.json");
        $json = json_decode($string1, true);
        foreach($json as $key => $value){
            echo $key.'<br>';
            if (is_array($value)) {
                # code...
                foreach($value as $key => $val){
                    echo $key.'<br>';
            //         if (is_array($val)) {
            //             # code...
            //             foreach($val as $key => $data){
            //                 echo $key.'<br>';
            //                 if (is_array($data)) {
            //                     # code...
            //                     foreach($data as $key => $ahihi){
            //                         echo $key.'<br>';
            //                         if (is_array($ahihi)) {
            //                             # code...
            //                             foreach($ahihi as $key => $hi){
            //                                 echo $key.'<br>';
            //                                 if (is_array($hi)) {
            //                                     # code...
            //                                     foreach($hi as $key => $ho){
            //                                         echo $key.'<br>';
            //                                         if (is_array($ho)) {
            //                                             # code...
            //                                             foreach($ho as $key => $final){
            //                                                 echo $key.'<br>';
            //                                                 if (is_array($final)) {
            //                                                     # code...
            //                                                     foreach($final as $key => $final){
            //                                                         echo $key.'<br>';
            //                                                     }
            //                                                 }
            //                                                 else{
            //                                                     echo $key.' no_a '.$final.'<br>';
            //                                                 }
            //                                             }
            //                                         }
            //                                         else{
            //                                             echo $key.' no_a '.$ho.'<br>';
            //                                         }
            //                                     }
            //                                 }
            //                                 else{
            //                                     echo $key.' no_a '.$hi.'<br>';
            //                                 }
            //                             }
            //                         }
            //                         else{
            //                             echo $key.' no_a '.$ahihi.'<br>';
            //                         }
            //                     }
            //                 }
            //                 else{
            //                     echo $key.' no_a '.$data.'<br>';
            //                 }
            //             }
            //         }
            //         else{
            //             echo $key.' no_a '.$val.'<br>';
            //         }
                }
            }
            else{
                echo $key.' no_a '.$value.'<br>';
            }
        }
        
    die;
    }
    
}
$mycustom = new MB_Personalized;

$mycustom->load();
//http://localhost/wordpress/wp-content/plugins/mb-personalized/include/persionalized-configs.json
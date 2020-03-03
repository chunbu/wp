<?php
/*
Plugin name: MB Personalized
Plugin URI: merchbridge.com
Description: MB Personalized
Version: 0.1.0
Author: MB
Author URI: merchbridge.com/about
*/

// class MB_Personalized{
//     function __construct(){
//         // $this->load();
//     }
//     function load(){
        
//     }
// }
// $person = new MB_Personalized;
// $person->load();

$request = wp_remote_get( 'config/persionalized-configs.php' );

        if( is_wp_error( $request ) ) {
            return false; // Bail early
        }
        
        $body = wp_remote_retrieve_body( $request );
        
        $data = json_decode( $body );
        var_dump($data); die;
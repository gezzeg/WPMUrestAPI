<?php
/*
* Plugin Name: Wordpress REST API Multisite
* Plugin URI: 
* Description: 
* Version: 1.0
* Author: Ghazali Tajuddin
* Author URI: http://www.ghazalitajuddin.com
* License: MIT
* */


class WPMUrestAPI{

    function __construct() {
        add_action( 'rest_api_init', array( $this, 'call2' ));
    }
    

    public function call2() {
    // Here we are registering our route for a collection of products and creation of products.
    
        register_rest_route( 'all/sites', '/list', 
            array(
                
                // By using this constant we ensure that when the WP_REST_Server changes, our readable endpoints will work as intended.
                
                'methods'  => WP_REST_Server::READABLE,
                
                // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
                
                'callback' => array($this,'get_sites123'),
            )
         );
    }


    public function get_sites123() {
            
            if ( function_exists( 'get_sites' )  ) {
            $sites = get_sites( 
                [
                    'public'  => 1,
                    //'number'  => 500,
                    'orderby' => 'registered',
                    'order'   => 'DESC',
                ]
            );

            $sites_details = array();

            foreach ($sites as $site) {
                $sites_details[] = $site->blog_id;
            }

            return $sites_details;
 
    }
}

  

}


 $power = new WPMUrestAPI();

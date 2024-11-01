<?php
/**
 * @package com.ubideo.plugin
 * @version 1.0
 */
/*
Plugin Name: Ubideo
Plugin URI: http://wordpress.org/plugins/ubideo/
Description: Provides tools to work with the Ubideo platform. Create True Live. Easy embedding of your live tv channel or event.
Author: Ubideo
Version: 1.0
Author URI: https://ubideo.com
*/

class Ubideo {
  public static function embed($params, $content) {
     $event_id = @$params['event'];
     $profile = @$params['profile'];
 
     $domain = 'embed.ubideo.com';
     $route = 'event';
     $id = '';	

     if(!empty($event_id)) {
       $id = $event_id;
     }
     else if(!empty($profile)) {
       $id = $profile . '/live';
       $route = 'profile';
     } 
         
     if(!empty($id)) {
       ob_start();
?>   
<iframe style="border:none; width:640px; height:480px" src="https://<?php echo $domain; ?>/<?php echo $route; ?>/<?php echo $id; ?>" allowfullscreen></iframe>   
<?php
       $response = ob_get_contents();
       ob_end_clean();
     }
     else {
        $response = __('Please add a param "event=your event id" to embed your event player or "profile=your profile id" to embed your profile player to your ubideo shortcode tag. Example: [ubideo event="55b67cacad45774c9c8c3688"]','ubideo');
     }  

     return $response;
  }
}

add_shortcode('ubideo', array( 'Ubideo', 'embed'));

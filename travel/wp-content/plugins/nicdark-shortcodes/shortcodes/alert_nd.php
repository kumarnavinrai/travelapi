<?php

/////////////////////////////////////////////////////////ALERT/////////////////////////////////////////
add_shortcode('alert_nd', 'nicdark_shortcode_alert');
function nicdark_shortcode_alert($atts, $content = null)
{	

	$atts = shortcode_atts(
		array(
			'title' => '',
			'description' => '',
			'bgcolor' => '',
         'icon' => '',
			'class' => ''
		), $atts);

   $str = '';
		
   $str .= '<div class="'.$atts['class'].' nicdark_alerts nicdark_bg_'.$atts['bgcolor'].' '.$atts['class'].'  "><p class="white nicdark_size_medium"><i class="icon-cancel-circled-outline iconclose"></i>&nbsp;&nbsp;&nbsp;<strong>'.$atts['title'].':</strong>&nbsp;&nbsp;&nbsp;'.$atts['description'].'</p><i class="'.$atts['icon'].' nicdark_iconbg right medium '.$atts['bgcolor'].'"></i></div>';

	return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action( 'vc_before_init', 'nicdark_alert' );
function nicdark_alert() {
   vc_map( array(
      "name" => __( "Alert", "nicdark-shortcodes" ),
      "base" => "alert_nd",
      'description' => __( 'Add alert info message', 'nicdark-shortcodes' ),
      'show_settings_on_create' => true,
      "icon" => get_template_directory_uri() . "/vc_extend/alert.png",
      "class" => "",
      "category" => __( "Nicdark Shortcodes", "nicdark-shortcodes"),
      "params" => array(

         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Title", "nicdark-shortcodes" ),
            "param_name" => "title",
            'admin_label' => true,
            "description" => __( "Insert your title", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Description", "nicdark-shortcodes" ),
            "param_name" => "description",
            "description" => __( "Insert your description", "nicdark-shortcodes" )
         ),
         array(
         'type' => 'dropdown',
		    'heading' => "Bg Color",
		    'param_name' => 'bgcolor',
		    'value' => array( "select", "yellow", "orange", "red", "violet", "blue", "green", "greydark" ),
		    'description' => __( "Select your color", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Icon Code", "nicdark-shortcodes" ),
            "param_name" => "icon",
            'description' => __( "Insert icon code e.g. icon-diamond <a target='_blank' href='http://www.nicdarkthemes.com/themes/love-travel/wp/demo-travel/icons.php'>see all icons</a>", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Class", "nicdark-shortcodes" ),
            "param_name" => "class",
            "description" => __( "Custom class", "nicdark-shortcodes" )
         )
      )
   ) );
}
//end shortcode divider
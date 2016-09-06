<?php

/////////////////////////////////////////////////////////DIVIDER/////////////////////////////////////////
add_shortcode('divider_nd', 'shortcode_divider');
function shortcode_divider($atts, $content = null)
{	

	$atts = shortcode_atts(
		array(
			'align' => '',
			'size' => '',
			'color' => '',
			'class' => ''

		), $atts);

   $str = '';
		
	$str .= '<div class="nicdark_divider '.$atts['class'].' '.$atts['align'].' '.$atts['size'].' "><span style="background-color:'.$atts['color'].';" ></span></div>';

	return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action( 'vc_before_init', 'nicdark_divider' );
function nicdark_divider() {
   vc_map( array(
      "name" => __( "Divider", "nicdark-shortcodes" ),
      "base" => "divider_nd",
      'description' => __( 'Add divider', 'nicdark-shortcodes' ),
      'show_settings_on_create' => true,
      "icon" => get_template_directory_uri() . "/vc_extend/divider.png",
      "class" => "",
      "category" => __( "Nicdark Shortcodes", "nicdark-shortcodes"),
      "params" => array(
         array(
         'type' => 'dropdown',
		    'heading' => "Size",
		    'param_name' => 'size',
		    'value' => array( "select", "small", "big" ),
		    'description' => __( "Select the size", "nicdark-shortcodes" )
         ),
         array(
          'type' => 'dropdown',
		    'heading' => "Alignment",
		    'param_name' => 'align',
		    'value' => array( "select" ,"left", "right", "center" ),
		    'description' => __( "Select the alignment", "nicdark-shortcodes" )
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            'admin_label' => true,
            "heading" => __( "Divider color", "nicdark-shortcodes" ),
            "param_name" => "color",
            "value" => '#FF0000', //Default Red color
            "description" => __( "Choose color", "nicdark-shortcodes" )
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
<?php

/////////////////////////////////////////////////////////title/////////////////////////////////////////
add_shortcode('title_nd', 'nicdark_shortcode_title');
function nicdark_shortcode_title($atts, $content = null)
{  

   $atts = shortcode_atts(
      array(
         'title' => '',
         'tag' => '',
         'style' => '',
         'color' => '',
         'align' => '',
         'class' => ''
      ), $atts);
      
   $str = '';

   $str .= '<'.$atts['tag'].' style="color:'.$atts['color'].';" class="'.$atts['class'].' '.$atts['style'].' '.$atts['align'].'">'.$atts['title'].'</'.$atts['tag'].'>';

   return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action( 'vc_before_init', 'nicdark_title' );
function nicdark_title() {
   vc_map( array(
      "name" => __( "Title", "nicdark-shortcodes" ),
      "base" => "title_nd",
      'description' => __( 'Add title', 'nicdark-shortcodes' ),
      'show_settings_on_create' => true,
      "icon" => get_template_directory_uri() . "/vc_extend/title.png",
      "class" => "",
      "category" => __( "Nicdark Shortcodes", "nicdark-shortcodes"),
      "params" => array(

         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Title", "nicdark-shortcodes" ),
            "param_name" => "title",
            'admin_label' => true,
            "description" => __( "Insert the title", "nicdark-shortcodes" )
         ),
         array(
         'type' => 'dropdown',
          'heading' => "Tag",
          'param_name' => 'tag',
          'value' => array( "select", "h1", "h2", "h3", "h4", "h5", "h6" ),
          'description' => __( "Select your tag", "nicdark-shortcodes" )
         ),
         array(
         'type' => 'dropdown',
          'heading' => "Style",
          'param_name' => 'style',
          'value' => array( __( 'Select', 'nicdark-shortcodes' ) => 'title', __( 'Primary Font', 'nicdark-shortcodes' ) => 'title', __( 'Secondary Font', 'nicdark-shortcodes' ) => 'subtitle'),
          'description' => __( "Select your style", "nicdark-shortcodes" )
         ),
         array(
         'type' => 'dropdown',
          'heading' => "Align",
          'param_name' => 'align',
          'value' => array( "select", "left", "center", "right" ),
          'description' => __( "Choose the alignment", "nicdark-shortcodes" )
         ),
         array(
          'type' => 'colorpicker',
          'heading' => __( 'Custom Color', 'js_composer' ),
          'param_name' => 'color',
          'description' => __( 'Select the title color. E.g. #868585', 'nicdark-shortcodes' )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Custom class", "nicdark-shortcodes" ),
            "param_name" => "class",
            "description" => __( "Insert custom class E.g. signature", "nicdark-shortcodes" )
         )

      )
   ) );
}
//end shortcode
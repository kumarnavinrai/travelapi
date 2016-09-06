<?php

/////////////////////////////////////////////////////////focus number/////////////////////////////////////////
add_shortcode('focus_number_nd', 'nicdark_shortcode_focus_number');
function nicdark_shortcode_focus_number($atts, $content = null)
{  

   $atts = shortcode_atts(
      array(
         'title' => '',
         'description' => '',
         'number' => '',
         'link' => '',
         'color' => '',
         'class' => ''
      ), $atts);

   $str = '';

      //extract link
      $atts['link'] = vc_build_link( $atts['link'] );
      $a_href = $atts['link']['url'];
      $a_title = $atts['link']['title'];
      $a_target = $atts['link']['target'];
      
   $str .= '

    <div class="'.$atts['class'].' nicdark_archive1 nicdark_bg_'.$atts['color'].' nicdark_bg_'.$atts['color'].'dark_hover nicdark_transition  ">
        <div class="nicdark_margin20 nicdark_relative">  
            <a target="'.$a_target.'" href="'.$a_href.'" class="nicdark_displaynone_ipadpotr nicdark_btn_icon nicdark_bg_'.$atts['color'].'dark medium white nicdark_absolute "><i>'.$atts['number'].'</i></a>

            <div class="nicdark_activity nicdark_marginleft70 nicdark_disable_marginleft_ipadpotr">
                <h4 class="white">'.$atts['title'].'</h4>                        
                <div class="nicdark_space20"></div>
                <p class="white">'.$atts['description'].'</p>
            </div>
        </div>
    </div>
      
   ';

   return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action( 'vc_before_init', 'nicdark_focus_number' );
function nicdark_focus_number() {
   vc_map( array(
      "name" => __( "Focus number", "nicdark-shortcodes" ),
      "base" => "focus_number_nd",
      'description' => __( 'Add focus number', 'nicdark-shortcodes' ),
      'show_settings_on_create' => true,
      "icon" => get_template_directory_uri() . "/vc_extend/focus_number.png",
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
            "type" => "textarea",
            "class" => "",
            "heading" => __( "Description", "nicdark-shortcodes" ),
            "param_name" => "description",
            "description" => __( "Insert the description", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Number", "nicdark-shortcodes" ),
            "param_name" => "number",
            "description" => __( "Insert a number, Example: 1", "nicdark-shortcodes" )
         ),
         array(
         'type' => 'vc_link',
          'heading' => "Link",
          'param_name' => 'link',
          'description' => __( "Insert link", "nicdark-shortcodes" )
         ),
         array(
         'type' => 'dropdown',
          'heading' => "Bg Color",
          'param_name' => 'color',
          'value' => array( "select", "yellow", "orange", "red", "violet", "blue", "green", "greydark" ),
          'description' => __( "Select your color", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Custom class", "nicdark-shortcodes" ),
            "param_name" => "class",
            "description" => __( "Insert custom class", "nicdark-shortcodes" )
         )

      )
   ) );
}
//end shortcode
<?php

/////////////////////////////////////////////////////////focus text/////////////////////////////////////////
add_shortcode('focus_text_nd', 'nicdark_shortcode_focus_text');
function nicdark_shortcode_focus_text($atts, $content = null)
{  

   $atts = shortcode_atts(
      array(
         'title' => '',
         'description' => '',
         'link' => '',
         'icon' => '',
         'color' => '',
         'class' => ''
      ), $atts);

   $str = '';

      //extract link
      $atts['link'] = vc_build_link( $atts['link'] );
      $a_href = $atts['link']['url'];
      $a_title = $atts['link']['title'];
      $a_target = $atts['link']['target'];
      //if link
      $linkoutput = ( $a_href != '' ) ? ' <a target="'.$a_target.'" href="'.$a_href.'" class="nicdark_btn nicdark_press nicdark_bg_'.$atts['color'].'dark white medium  ">'.$a_title.'</a> ' : '';
      
   $str .= '

      <div class="'.$atts['class'].' nicdark_textevidence nicdark_bg_'.$atts['color'].'  ">
          <div class="nicdark_margin20">
              <h4 class="white">'.$atts['title'].'</h4>
              <div class="nicdark_space20"></div>
              <p class="white">'.$atts['description'].'</p>
              <div class="nicdark_space20"></div>
              '.$linkoutput.'
         </div>
         <i class="'.$atts['icon'].' nicdark_iconbg right big '.$atts['color'].'"></i>
      </div>
      
   ';

   return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action( 'vc_before_init', 'nicdark_focus_text' );
function nicdark_focus_text() {
   vc_map( array(
      "name" => __( "Focus text", "nicdark-shortcodes" ),
      "base" => "focus_text_nd",
      'description' => __( 'Add focus text', 'nicdark-shortcodes' ),
      'show_settings_on_create' => true,
      "icon" => get_template_directory_uri() . "/vc_extend/focus_text.png",
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
         'type' => 'dropdown',
          'heading' => "Bg Color",
          'param_name' => 'color',
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
         'type' => 'vc_link',
          'heading' => "Link",
          'param_name' => 'link',
          'description' => __( "Insert link", "nicdark-shortcodes" )
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
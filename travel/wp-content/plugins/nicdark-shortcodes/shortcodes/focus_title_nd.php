<?php

/////////////////////////////////////////////////////////focus title/////////////////////////////////////////
add_shortcode('focus_title_nd', 'nicdark_shortcode_focus_title');
function nicdark_shortcode_focus_title($atts, $content = null)
{  

   $atts = shortcode_atts(
      array(
         'title' => '',
         'link' => '',
         'icon' => '',
         'color' => '',
         'class' => ''
      ), $atts);

   $str = '';


   //target if
  $atts['link'] = vc_build_link( $atts['link'] );
  $a_href = $atts['link']['url'];
  $a_title = $atts['link']['title'];
  $a_target = $atts['link']['target'];

            
   $str .= '

    <div class="'.$atts['class'].' nicdark_textevidence nicdark_bg_'.$atts['color'].' nicdark_shadow center">
        <div class="nicdark_margin30">
            <h2 class="white subtitle"><a target="'.$a_target.'" href="'.$a_href.'" class="white">'.$atts['title'].'</a></h2>
       </div>
        <i class="nicdark_zoom '.$atts['icon'].' nicdark_iconbg left extrabig '.$atts['color'].' nicdark_displaynone_ipadland nicdark_displaynone_ipadpotr"></i>
    </div>
      
   ';

   return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action( 'vc_before_init', 'nicdark_focus_title' );
function nicdark_focus_title() {
   vc_map( array(
      "name" => __( "Focus title", "nicdark-shortcodes" ),
      "base" => "focus_title_nd",
      'description' => __( 'Add single focus title', 'nicdark-shortcodes' ),
      'show_settings_on_create' => true,
      "icon" => get_template_directory_uri() . "/vc_extend/focus_title.png",
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
         'type' => 'vc_link',
          'heading' => "Link",
          'param_name' => 'link',
          'description' => __( "Insert link", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Icon Code", "nicdark-shortcodes" ),
            "param_name" => "icon",
            'description' => __( "Insert icon code e.g. icon-diamond <a target='_blank' href='http://www.nicdarkthemes.com/themes/love-travel/wp/demo-travel/icons.php'>see all icons</a>", "nicdark-shortcodes" )
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
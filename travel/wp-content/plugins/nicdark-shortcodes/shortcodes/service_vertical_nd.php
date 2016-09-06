<?php

/////////////////////////////////////////////////////////service vertical/////////////////////////////////////////
add_shortcode('service_vertical_nd', 'nicdark_shortcode_service_vertical');
function nicdark_shortcode_service_vertical($atts, $content = null)
{  

   $atts = shortcode_atts(
      array(
         'title' => '',
         'description' => '',
         'link' => '',
         'icon' => '',
         'color' => '',
         'class' => '',
         'asettings' => '',
         'shape' => '',
         'cuticon' => ''
      ), $atts);

   $str = '';

      //extract link
      $atts['link'] = vc_build_link( $atts['link'] );
      $a_href = $atts['link']['url'];
      $a_title = $atts['link']['title'];
      $a_target = $atts['link']['target'];
      //if link
      $linkoutput = ( $a_href != '' ) ? ' <a target="'.$a_target.'" href="'.$a_href.'" class="nicdark_press nicdark_btn nicdark_border_grey medium  grey">'.$a_title.'</a><div class="nicdark_space5"></div> ' : '';
      
      //icon style
      if ( $atts['cuticon'] == 1 ) { $iconoutput = '<a target="'.$a_target.'" href="'.$a_href.'" class="nicdark_btn_icon nicdark_bg_'.$atts['color'].' extrabig '.$atts['shape'].' white "><i class="'.$atts['icon'].'"></i></a>'; }else{ $iconoutput = '<div class="nicdark_btn_iconbg nicdark_bg_'.$atts['color'].' extrabig  '.$atts['shape'].'"><div><i class="'.$atts['icon'].' nicdark_iconbg left big white"></i></div></div>'; }


   $str .= '

    <div class="nicdark_archive1 center">
                    
          '.$iconoutput.'

          <div class="nicdark_space20"></div>
          
          <h4>'.$atts['title'].'</h4>                        
          <div class="nicdark_space20"></div>
          <p>'.$atts['description'].'</p>
          <div class="nicdark_space20"></div>
          '.$linkoutput.'
          
      </div>
      
   ';

   return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action( 'vc_before_init', 'nicdark_service_vertical' );
function nicdark_service_vertical() {
   vc_map( array(
      "name" => __( "Service vertical", "nicdark-shortcodes" ),
      "base" => "service_vertical_nd",
      'description' => __( 'Add single service', 'nicdark-shortcodes' ),
      'show_settings_on_create' => true,
      "icon" => get_template_directory_uri() . "/vc_extend/service_vertical.png",
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
          'heading' => "Bg Icon Color",
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
         ),
         array(
            'type' => 'dropdown',
            'heading' => __( 'Enable advanced settings', 'nicdark-shortcodes' ),
            'param_name' => 'asettings',
            'value' => array(
              __( 'No', 'nicdark-shortcodes' ) => 'no',
              __( 'Yes', 'nicdark-shortcodes' ) => 'yes'
            ),
            'description' => __( 'Set to yes to enable advanced settings', 'nicdark-shortcodes' )
         ),
         array(
             'type' => 'dropdown',
              'heading' => "Shape",
              'param_name' => 'shape',
              'value' => array( __( 'Select', 'js_composer' ) => 'nicdark_square', __( 'Square', 'js_composer' ) => 'nicdark_square', __( 'Radius', 'js_composer' ) => 'nicdark_radius', __( 'Circle', 'js_composer' ) => 'nicdark_radius_circle' ),
              'description' => __( "Choose the shape for the icon", "nicdark-shortcodes" ),
              'dependency' => array( 'element' => 'asettings', 'value' => array( 'yes' ) )
         ),
         array(
             'type' => 'checkbox',
              'heading' => "Remove cut icon style",
              'param_name' => 'cuticon',
              'value' => array( __( '', 'js_composer' ) => '1' ),
              'description' => __( "Remove cut icon style", "nicdark-shortcodes" ),
              'dependency' => array( 'element' => 'asettings', 'value' => array( 'yes' ) )
         )

      )
   ) );
}
//end shortcode
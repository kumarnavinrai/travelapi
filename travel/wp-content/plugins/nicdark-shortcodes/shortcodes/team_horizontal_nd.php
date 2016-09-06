<?php

/////////////////////////////////////////////////////////team horizontal/////////////////////////////////////////
add_shortcode('team_horizontal_nd', 'nicdark_shortcode_team_horizontal');
function nicdark_shortcode_team_horizontal($atts, $content = null)
{  

   $atts = shortcode_atts(
      array(
         'title' => '',
         'description' => '',
         'image' => '',
         'link' => '',
         'color' => '',
         'class' => '',
         'icons' => '',
         'icon1' => '',
         'iconlink1' => '',
         'icon2' => '',
         'iconlink2' => '',
         'icon3' => '',
         'iconlink3' => ''
      ), $atts);

   $str = '';

  //main link
  $atts['link'] = vc_build_link( $atts['link'] );
  $a_href = $atts['link']['url'];
  $a_title = $atts['link']['title'];
  $a_target = $atts['link']['target'];


  //link icon1
  $atts['iconlink1'] = vc_build_link( $atts['iconlink1'] );
  $a_href_iconlink1 = $atts['iconlink1']['url'];
  $a_title_iconlink1 = $atts['iconlink1']['title'];
  $a_target_iconlink1 = $atts['iconlink1']['target'];

  //link icon2
  $atts['iconlink2'] = vc_build_link( $atts['iconlink2'] );
  $a_href_iconlink2 = $atts['iconlink2']['url'];
  $a_title_iconlink2 = $atts['iconlink2']['title'];
  $a_target_iconlink2 = $atts['iconlink2']['target'];

  //link icon1
  $atts['iconlink3'] = vc_build_link( $atts['iconlink3'] );
  $a_href_iconlink3 = $atts['iconlink3']['url'];
  $a_title_iconlink3 = $atts['iconlink3']['title'];
  $a_target_iconlink3 = $atts['iconlink3']['target'];

  //image
  $imgsrc = wp_get_attachment_image_src($atts['image'],'large');

  //if link
  $linkoutput = ( $a_href != '' ) ? ' <a target="'.$a_target.'" href="'.$a_href.'" class="white nicdark_btn small nicdark_border_white">'.$a_title.'</a> ' : '';
      
  //if icon1 icon2 icon3
  $icon1output = ( $atts['icon1'] != '' ) ? ' <a target="'.$a_target_iconlink1.'" title="'.$a_title_iconlink1.'" href="'.$a_href_iconlink1.'" class="nicdark_rotate nicdark_tooltip nicdark_btn_icon small nicdark_bg_'.$atts['color'].'dark  white"><i class="'.$atts['icon1'].'"></i></a><div class="nicdark_space20"></div> ' : '';
  $icon2output = ( $atts['icon2'] != '' ) ? ' <a target="'.$a_target_iconlink2.'" title="'.$a_title_iconlink2.'" href="'.$a_href_iconlink2.'" class="nicdark_rotate nicdark_tooltip nicdark_btn_icon small nicdark_bg_'.$atts['color'].'dark  white"><i class="'.$atts['icon2'].'"></i></a><div class="nicdark_space20"></div> ' : '';
  $icon3output = ( $atts['icon3'] != '' ) ? ' <a target="'.$a_target_iconlink3.'" title="'.$a_title_iconlink3.'" href="'.$a_href_iconlink3.'" class="nicdark_rotate nicdark_tooltip nicdark_btn_icon small nicdark_bg_'.$atts['color'].'dark  white"><i class="'.$atts['icon3'].'"></i></a><div class="nicdark_space20"></div> ' : '';

  //if icons
  $iconsoutput = ( $atts['icons'] == 'yes' ) ? ' <div class="nicdark_textevidence nicdark_width_percentage10 nicdark_displaynone_responsive"><div class="nicdark_space20"></div><div class="nicdark_space5"></div>'.$icon1output.' '.$icon2output.' '.$icon3output.'</div> ' : '';

  //if width
  if ( $atts['icons'] == 'yes' ) { $widthoutput = 'nicdark_width_percentage50'; }else{ $widthoutput = 'nicdark_width_percentage60'; }

  $str .= '


   <div class="'.$atts['class'].' nicdark_archive1 nicdark_bg_'.$atts['color'].'  ">

        <div class="nicdark_textevidence nicdark_width_percentage40 nicdark_width100_responsive">
            <img alt="" class=" nicdark_opacity" src="'.$imgsrc[0].'">
        </div>
        
        <div class="nicdark_textevidence '.$widthoutput.' nicdark_width100_responsive">
            <div class="nicdark_margin20">
            
                <h4 class="white">'.$atts['title'].'</h4>                        
                <div class="nicdark_space20"></div>
                <div class="nicdark_divider left small"><span class="nicdark_bg_white "></span></div>
                <div class="nicdark_space20"></div>
                <p class="white">'.$atts['description'].'</p>
                <div class="nicdark_space20"></div>
                '.$linkoutput.'

            </div>
        </div>

        '.$iconsoutput.'

    </div>

   ';

   return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action( 'vc_before_init', 'nicdark_team_horizontal' );
function nicdark_team_horizontal() {
   vc_map( array(
      "name" => __( "Team horizontal", "nicdark-shortcodes" ),
      "base" => "team_horizontal_nd",
      'description' => __( 'Add single team', 'nicdark-shortcodes' ),
      'show_settings_on_create' => true,
      "icon" => get_template_directory_uri() . "/vc_extend/team_horizontal.png",
      "class" => "",
      "category" => __( "Nicdark Shortcodes", "nicdark-shortcodes"),
      "params" => array(

         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Member name", "nicdark-shortcodes" ),
            "param_name" => "title",
            'admin_label' => true,
            "description" => __( "Insert the name", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textarea",
            "class" => "",
            "heading" => __( "Description", "nicdark-shortcodes" ),
            "param_name" => "description",
            "description" => __( "Insert the description", "nicdark-shortcodes" )
         ),
         array(
            'type' => 'attach_image',
            'heading' => __( 'Image Member', 'nicdark-shortcodes' ),
            'param_name' => 'image',
            'description' => __( 'Select image from media library.', 'nicdark-shortcodes' )
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
         ),
         array(
          'type' => 'dropdown',
          'heading' => __( 'Right Icons', 'nicdark-shortcodes' ),
          'param_name' => 'icons',
          'value' => array(
          __( 'No', 'nicdark-shortcodes' ) => 'no',
          __( 'Yes', 'nicdark-shortcodes' ) => 'yes'
          ),
          'description' => __( 'Choose "yes" for set the icons on the right', 'nicdark-shortcodes' )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Icon Code 1", "nicdark-shortcodes" ),
            "param_name" => "icon1",
            'description' => __( "Insert icon code e.g. icon-diamond <a target='_blank' href='http://www.nicdarkthemes.com/themes/love-travel/wp/demo-travel/icons.php'>see all icons</a>", "nicdark-shortcodes" ),
            'dependency' => array( 'element' => 'icons', 'value' => array( 'yes' ) )
         ),
         array(
         'type' => 'vc_link',
          'heading' => "Icon Link 1",
          'param_name' => 'iconlink1',
          'description' => __( "Insert link for first icon", "nicdark-shortcodes" ),
          'dependency' => array( 'element' => 'icons', 'value' => array( 'yes' ) )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Icon Code 2", "nicdark-shortcodes" ),
            "param_name" => "icon2",
            'description' => __( "Insert icon code e.g. icon-diamond <a target='_blank' href='http://www.nicdarkthemes.com/themes/love-travel/wp/demo-travel/icons.php'>see all icons</a>", "nicdark-shortcodes" ),
            'dependency' => array( 'element' => 'icons', 'value' => array( 'yes' ) )
         ),
         array(
         'type' => 'vc_link',
          'heading' => "Icon Link 2",
          'param_name' => 'iconlink2',
          'description' => __( "Insert link for second icon", "nicdark-shortcodes" ),
          'dependency' => array( 'element' => 'icons', 'value' => array( 'yes' ) )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Icon Code 3", "nicdark-shortcodes" ),
            "param_name" => "icon3",
            'description' => __( "Insert icon code e.g. icon-diamond <a target='_blank' href='http://www.nicdarkthemes.com/themes/love-travel/wp/demo-travel/icons.php'>see all icons</a>", "nicdark-shortcodes" ),
            'dependency' => array( 'element' => 'icons', 'value' => array( 'yes' ) )
         ),
         array(
         'type' => 'vc_link',
          'heading' => "Icon Link 3",
          'param_name' => 'iconlink3',
          'description' => __( "Insert link for third icon", "nicdark-shortcodes" ),
          'dependency' => array( 'element' => 'icons', 'value' => array( 'yes' ) )
         )

      )
   ) );
}
//end shortcode
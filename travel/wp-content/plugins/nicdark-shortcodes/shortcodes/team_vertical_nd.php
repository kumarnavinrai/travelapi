<?php

/////////////////////////////////////////////////////////team vertical/////////////////////////////////////////
add_shortcode('team_vertical_nd', 'nicdark_shortcode_team_vertical');
function nicdark_shortcode_team_vertical($atts, $content = null)
{  

   $atts = shortcode_atts(
      array(
         'title' => '',
         'description' => '',
         'role' => '',
         'icon' => '',
         'image' => '',
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
      
  //if icon1 icon2 icon3
  $icon1output = ( $atts['icon1'] != '' ) ? ' <a target="'.$a_target_iconlink1.'" title="'.$a_title_iconlink1.'" href="'.$a_href_iconlink1.'" class="nicdark_displaynone_ipadpotr nicdark_btn_icon nicdark_tooltip nicdark_bg_'.$atts['color'].' medium   white nicdark_margin010"><i class="'.$atts['icon1'].' nicdark_rotate"></i></a> ' : '';
  $icon2output = ( $atts['icon2'] != '' ) ? ' <a target="'.$a_target_iconlink2.'" title="'.$a_title_iconlink2.'" href="'.$a_href_iconlink2.'" class="nicdark_displaynone_ipadpotr nicdark_btn_icon nicdark_tooltip nicdark_bg_'.$atts['color'].' medium   white nicdark_margin010"><i class="'.$atts['icon2'].' nicdark_rotate"></i></a> ' : '';
  $icon3output = ( $atts['icon3'] != '' ) ? ' <a target="'.$a_target_iconlink3.'" title="'.$a_title_iconlink3.'" href="'.$a_href_iconlink3.'" class="nicdark_displaynone_ipadpotr nicdark_btn_icon nicdark_tooltip nicdark_bg_'.$atts['color'].' medium   white nicdark_margin010"><i class="'.$atts['icon3'].' nicdark_rotate"></i></a> ' : '';

  //if icons
  $iconsoutput = ( $atts['icons'] == 'yes' ) ? ' <div class="nicdark_space20 nicdark_displaynone_ipadpotr"></div>'.$icon1output.' '.$icon2output.' '.$icon3output.'' : '';

  $str .= '


  <div class="nicdark_archive1 nicdark_border_grey  center">

      <div class="nicdark_textevidence nicdark_bg_greydark ">
          <h4 class="white nicdark_margin20">'.$atts['title'].'</h4>
      </div>

      <img class="nicdark_opacity" alt="" src="'.$imgsrc[0].'">

       <div class="nicdark_textevidence nicdark_bg_'.$atts['color'].'">
          <h5 class="white nicdark_margin20">'.$atts['role'].'</h5>
          <i class="'.$atts['icon'].' nicdark_iconbg right medium '.$atts['color'].'"></i>
      </div>
      
      <div class="nicdark_textevidence">
          <div class="nicdark_margin20">
              <p>'.$atts['description'].'</p>

              '.$iconsoutput.'

          </div>
      </div>

  </div>

   ';

   return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action( 'vc_before_init', 'nicdark_team_vertical' );
function nicdark_team_vertical() {
   vc_map( array(
      "name" => __( "Team vertical", "nicdark-shortcodes" ),
      "base" => "team_vertical_nd",
      'description' => __( 'Add single team', 'nicdark-shortcodes' ),
      'show_settings_on_create' => true,
      "icon" => get_template_directory_uri() . "/vc_extend/team_vertical.png",
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
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Role", "nicdark-shortcodes" ),
            "param_name" => "role",
            'admin_label' => true,
            "description" => __( "Insert the role", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Bg icon", "nicdark-shortcodes" ),
            "param_name" => "icon",
            'description' => __( "Insert icon code e.g. icon-diamond <a target='_blank' href='http://www.nicdarkthemes.com/themes/love-travel/wp/demo-travel/icons.php'>see all icons</a>", "nicdark-shortcodes" )
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
          'heading' => __( 'Bottom Icons', 'nicdark-shortcodes' ),
          'param_name' => 'icons',
          'value' => array(
          __( 'No', 'nicdark-shortcodes' ) => 'no',
          __( 'Yes', 'nicdark-shortcodes' ) => 'yes'
          ),
          'description' => __( 'Choose "yes" for set the icons on the bottom', 'nicdark-shortcodes' )
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
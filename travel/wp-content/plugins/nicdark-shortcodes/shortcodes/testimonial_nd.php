<?php

/////////////////////////////////////////////////////////TESTIMONIAL/////////////////////////////////////////
add_shortcode('testimonial_nd', 'nicdark_shortcode_testimonial');
function nicdark_shortcode_testimonial($atts, $content = null)
{  

   $atts = shortcode_atts(
      array(
         'author' => '',
         'descriptionauthor' => '',
         'imgauthor' => '',
         'text' => '',
         'bgcolor' => '',
         'icon' => '',
         'class' => ''
      ), $atts);

   $str = '';

   $imgsrc = wp_get_attachment_image_src($atts['imgauthor']);
      
   $str .= '
      <div style="width:100%; display:inline-block;">
        <div class="nicdark_textevidence nicdark_bg_'.$atts['bgcolor'].'  ">
            <div class="nicdark_margin20">
                <p class="white">'.$atts['text'].'</p>
            </div>
            <i class="'.$atts['icon'].' nicdark_iconbg right medium '.$atts['bgcolor'].'"></i>
        </div>

        <div class="nicdark_focus">
            <div class="nicdark_triangle '.$atts['bgcolor'].' nicdark_marginleft20"></div>
        </div>
        <div class="nicdark_space30"></div>

        <div class="nicdark_focus nicdark_relative">
            <img alt="" class="nicdark_radius_circle nicdark_absolute" width="65" src="'.$imgsrc[0].'">

            <div class="nicdark_activity nicdark_marginleft85">
                <h5>'.$atts['author'].'</h5>                       
                <div class="nicdark_space10"></div>
                <p>'.$atts['descriptionauthor'].'</p>
            </div>
        </div>
      </div>
   ';

   return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action( 'vc_before_init', 'nicdark_testimonial' );
function nicdark_testimonial() {
   vc_map( array(
      "name" => __( "Testimonial", "nicdark-shortcodes" ),
      "base" => "testimonial_nd",
      'description' => __( 'Add single testimonial', 'nicdark-shortcodes' ),
      'show_settings_on_create' => true,
      "icon" => get_template_directory_uri() . "/vc_extend/testimonial.png",
      "class" => "",
      "category" => __( "Nicdark Shortcodes", "nicdark-shortcodes"),
      "params" => array(

         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Author", "nicdark-shortcodes" ),
            "param_name" => "author",
            'admin_label' => true,
            "description" => __( "Insert author name", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Description Author", "nicdark-shortcodes" ),
            "param_name" => "descriptionauthor",
            "description" => __( "Insert author description", "nicdark-shortcodes" )
         ),
         array(
            'type' => 'attach_image',
            'heading' => __( 'Image Author', 'js_composer' ),
            'param_name' => 'imgauthor',
            'description' => __( 'Select images from media library.', 'js_composer' )
         ),
         array(
            "type" => "textarea",
            "class" => "",
            "heading" => __( "Testimonial", "nicdark-shortcodes" ),
            "param_name" => "text",
            "description" => __( "Insert your testimonial", "nicdark-shortcodes" )
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
//end shortcode testimonial
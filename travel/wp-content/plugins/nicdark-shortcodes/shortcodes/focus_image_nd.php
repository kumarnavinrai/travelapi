<?php

/////////////////////////////////////////////////////////FOCUS IMAGE/////////////////////////////////////////
add_shortcode('focus_image_nd', 'nicdark_shortcode_focus_image');
function nicdark_shortcode_focus_image($atts, $content = null)
{  

   $atts = shortcode_atts(
      array(
         'title' => '',
         'image' => '',
         'text' => '',
         'link' => '',
         'class' => ''
      ), $atts);

   $str = '';


  //target if
  $atts['link'] = vc_build_link( $atts['link'] );
  $a_href = $atts['link']['url'];
  $a_title = $atts['link']['title'];
  $a_target = $atts['link']['target'];

  $imgsrc = wp_get_attachment_image_src($atts['image'],'large');
      
   $str .= '


      <!--start image-->
        <div class="nicdark_focus nicdark_border_grey nicdark_sizing nicdark_relative nicdark_fadeinout nicdark_overflow">    

            <img alt="" class="nicdark_focus nicdark_zoom_image" src="'.$imgsrc[0].'">
            
            <!--start content-->
            <div class="nicdark_fadeout nicdark_filter nicdark_absolute nicdark_height100percentage nicdark_width_percentage100">
                <div class="nicdark_absolute nicdark_display_table nicdark_width_percentage100">
                    <div class="nicdark_cell nicdark_vertical_middle">
                        <a class="nicdark_btn nicdark_bg_white grey medium">'.$atts['title'].'</a>
                    </div>   
                </div>   
            </div>
            <!--end content-->


            <!--start content-->
            <div class="nicdark_fadein nicdark_filter greydark nicdark_absolute nicdark_height100percentage nicdark_width_percentage100">
                <div class="nicdark_absolute nicdark_display_table nicdark_height100percentage nicdark_width_percentage100">
                    <div class="nicdark_cell nicdark_vertical_middle">
                        <p class="white">'.$atts['text'].'</p>
                        <div class="nicdark_space20"></div>
                        <a target="'.$a_target.'" href="'.$a_href.'" class="white nicdark_btn nicdark_border_white medium">'.$a_title.'</a>
                    </div>   
                </div>   
            </div>
            <!--end content-->

        </div>
        <!--end image-->


   ';

   return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action( 'vc_before_init', 'nicdark_focus_image' );
function nicdark_focus_image() {
   vc_map( array(
      "name" => __( "Focus Image", "nicdark-shortcodes" ),
      "base" => "focus_image_nd",
      'description' => __( 'Add single focus image', 'nicdark-shortcodes' ),
      'show_settings_on_create' => true,
      "icon" => get_template_directory_uri() . "/vc_extend/focus_image.png",
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
            'type' => 'attach_image',
            'heading' => __( 'Image', 'nicdark-shortcodes' ),
            'param_name' => 'image',
            'description' => __( 'Select image from media library.', 'nicdark-shortcodes' )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Text Hover", "nicdark-shortcodes" ),
            "param_name" => "text",
            "description" => __( "Insert the text on hover image", "nicdark-shortcodes" )
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
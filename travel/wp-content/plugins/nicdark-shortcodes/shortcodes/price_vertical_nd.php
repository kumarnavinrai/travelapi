<?php

/////////////////////////////////////////////////////////PRICE vertical/////////////////////////////////////////
add_shortcode('price_vertical_nd', 'nicdark_shortcode_price_vertical');
function nicdark_shortcode_price_vertical($atts, $content = null)
{  

   $atts = shortcode_atts(
      array(
         'title' => '',
         'price' => '',
         'description' => '',
         'image' => '',
         'text' => '',
         'link' => '',
         'color' => '',
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
      
    <div class="nicdark_archive1 center nicdark_bg_'.$atts['color'].'  ">
                
                
                <div class="nicdark_textevidence nicdark_bg_greydark ">
                    <h4 class="white nicdark_margin20">'.$atts['title'].'</h4>
                </div>


                <div style="background:url('.$imgsrc[0].'); background-size:cover;" class="nicdark_archive1">
                    <div class="nicdark_filter greydark">

                        <div class="nicdark_space40"></div>
                        
                        <h3 class="white subtitle">'.$atts['price'].'</h3>
                        <div class="nicdark_space20"></div>
                        <div class="nicdark_divider small"><span class="nicdark_bg_white "></span></div>
                        <div class="nicdark_space20"></div>
                        <h4 class="white subtitle">'.$atts['description'].'</h4>

                        <div class="nicdark_space40"></div>

                    </div>
                </div>

                <div class="nicdark_textevidence nicdark_bg_grey nicdark_border_grey nicdark_sizing">
                    <div style="display:block;" class="nicdark_margin20 nicdark_archive1_content">'.$atts['text'].'</div>
                </div>

                <a target="'.$a_target.'" href="'.$a_href.'" class="white nicdark_btn nicdark_bg_'.$atts['color'].' medium nicdark_radius_bottom">'.$a_title.'</a>

            </div>

   ';

   return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action( 'vc_before_init', 'nicdark_price_vertical' );
function nicdark_price_vertical() {
   vc_map( array(
      "name" => __( "Price Vertical", "nicdark-shortcodes" ),
      "base" => "price_vertical_nd",
      'description' => __( 'Add single price', 'nicdark-shortcodes' ),
      'show_settings_on_create' => true,
      "icon" => get_template_directory_uri() . "/vc_extend/price_vertical.png",
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
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Price", "nicdark-shortcodes" ),
            "param_name" => "price",
            "description" => __( "Insert the price", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Description", "nicdark-shortcodes" ),
            "param_name" => "description",
            "description" => __( "Description under the price", "nicdark-shortcodes" )
         ),
         array(
            'type' => 'attach_image',
            'heading' => __( 'Bg Image', 'nicdark-shortcodes' ),
            'param_name' => 'image',
            'description' => __( 'Select image from media library.', 'nicdark-shortcodes' )
         ),
         array(
            "type" => "textarea_html",
            "class" => "",
            "heading" => __( "Content", "nicdark-shortcodes" ),
            "param_name" => "text",
            "description" => __( "Insert your content in TEXT mode ( NOT VISUAL ), Example: &lt;p&gt;Lorem Ipsum Dolor&lt;/p&gt;&lt;hr /&gt;&lt;p&gt;Lorem Ipsum Dolor&lt;/p&gt;&lt;hr /&gt;&lt;p&gt;Lorem Ipsum Dolor&lt;/p&gt;", "nicdark-shortcodes" )
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
<?php


//generate taxonomy terms
function buildSelect($tax,$bginput,$columns,$i){ 
  $terms = get_terms($tax);
  $the_tax = get_taxonomy($tax);
  $tax_name = $the_tax->labels->name;
  $x = '<div id="nicdark_advanced_search_tax-'.$i.'" style="box-sizing:border-box; padding: 0px 10px;" class=" nicdark_width100_responsive grid '.$columns.' percentage"><input type="hidden" value="'.$tax.'" name="tax-'.$i.'"><select name="'. $tax .'" class="nicdark_bg_'.$bginput.' nicdark_radius_none grey medium subtitle">';
  $x .= '<option value="">'.__('ALL','nicdark-shortcodes').' '. $tax_name .'</option>';
  foreach ($terms as $term) {
     $x .= '<option value="' . $term->slug . '">' . $term->name . '</option>';  
  }
  $x .= '</select></div>';

  return $x;
}


/////////////////////////////////////////////////////////advanced_search/////////////////////////////////////////
add_shortcode('advanced_search_nd', 'nicdark_shortcode_advanced_search');
function nicdark_shortcode_advanced_search($atts, $content = null)
{  

   $atts = shortcode_atts(
      array(
         'post_type' => '',
         'columns' => '',
         'btncolor' => '',
         'bginput' => '',
         'css_field' => '',
         'id' => '',
         'autocomplete' => ''
      ), $atts);

  $str = '';

  $idavailablepackages = rand(1, 10000);

  $posttype = $atts['post_type'];
  $columns = $atts['columns'];
  $btncolor = $atts['btncolor'];
  $bginput = $atts['bginput'];
  $id = $atts['id'];
  $css_field = $atts['css_field'];
  $autocomplete = $atts['autocomplete'];

  //start translate
  $nicdark_text_search_date_from = __('From','nicdark-shortcodes');
  $nicdark_text_search_date_to = __('To','nicdark-shortcodes');
  $nicdark_text_search_keyword = __('Type Your Destination','nicdark-shortcodes');
  $nicdark_text_search_submit = __('SEARCH','nicdark-shortcodes');
  //end translate


  //find action link
  $action = get_post_type_archive_link( ''.$posttype.'' );

  $outputdateparam = ( $posttype != 'courses' ) ? ' 
    <div id="nicdark_advanced_search_dates" style="box-sizing:border-box; padding: 0px 10px;" class=" nicdark_width100_responsive grid '.$columns.' percentage">
      <input class="nicdark_activity nicdark_width_percentage49 nicdark_bg_'.$bginput.'  grey medium subtitle nicdark_calendar_range nicdark_calendar_from" placeholder="'.$nicdark_text_search_date_from.'" name="date_from" type="text" value="">
      <input style="float:right;" class="nicdark_width_percentage49 nicdark_bg_'.$bginput.'  grey medium subtitle nicdark_calendar_range nicdark_calendar_to" placeholder="'.$nicdark_text_search_date_to.'" name="date_to" type="text" value="">
    </div>
  ' : '';

    $str .= '<style type="text/css">'.$css_field.'</style>';

   $str .= '
   
   <script type="text/javascript">
      /* <![CDATA[ */

    var availablePackages = [';

    //all packages title
    $args = array( 'post_type' => ''.$posttype.'', 'posts_per_page'=> -1 );
    $the_query = new WP_Query( $args );
    while ( $the_query->have_posts() ) : $the_query->the_post();
    $title_package = get_the_title();
    $str .= '"'.$title_package.'",';
    endwhile;
    wp_reset_postdata();
    //end all packages title


  $str .= '
      " "
    ];

  /* ]]> */
  </script>


   <form id="'.$id.'" class="nicdark_advanced_search" action="'.$action.'" method="GET">
    <div id="nicdark_advanced_search_keyword" style="box-sizing:border-box; padding: 0px 10px;" class=" nicdark_width100_responsive grid '.$columns.' percentage">
      <input type="hidden" value="true" name="advsearch">
      <input type="hidden" value="'.$posttype.'" name="posttype">
      <input id="nicdark_autocomplete" class="nicdark_bg_'.$bginput.'   grey medium subtitle" type="text" placeholder="'.$nicdark_text_search_keyword.'" name="keyword" value="">
    </div>';


    $taxonomies = get_object_taxonomies($posttype);
    $i = 0;
    foreach($taxonomies as $tax){
      $str .= ''.buildSelect($tax,$bginput,$columns,$i).'';
      $i = $i + 1;
    }

     $str .= ''.$outputdateparam.'



    <div id="nicdark_advanced_search_prices" style="box-sizing:border-box; padding: 0px 10px;" class=" nicdark_width100_responsive grid '.$columns.' percentage">
        <div class="nicdark_margintop30 nicdark_bg_'.$bginput.'2 nicdark_slider_range nicdark_slider_range_'.$btncolor.' nicdark_activity nicdark_width_percentage49 nicdark_width100_iphonepotr"></div>
        <div class="nicdark_displayblock_iphonepotr nicdark_displaynone_desktop" style="height: 20px; float:left; width:100%"></div>
        <input name="price_from_to" style="float:right;" class="nicdark_bg_'.$bginput.' grey subtitle medium  nicdark_slider_amount nicdark_width_percentage49 nicdark_width100_iphonepotr" type="text">
    </div>


    <div id="nicdark_advanced_search_button" style="box-sizing:border-box; padding: 0px 10px;" class=" nicdark_width100_responsive grid '.$columns.' percentage">
      <input type="submit" value="'.$nicdark_text_search_submit.'" class="nicdark_btn nicdark_btn_filter fullwidth nicdark_bg_'.$btncolor.' ">
    </div>

    <input type="hidden" value="'.$i.'" name="qnt-taxonomies">

   </form>';


    
    
    //start if 
    if ($autocomplete == 1){

      function nicdark_add_autocomplete_js() {
        echo '
        <script type="text/javascript">
          /* <![CDATA[ */

          jQuery(document).ready(function(){
              jQuery("#nicdark_autocomplete").autocomplete({ source: availablePackages });
          });

          /* ]]> */
        </script>
        ';
        
      }

      add_action('wp_footer', 'nicdark_add_autocomplete_js', 100);

    }
    //end if


    


   return apply_filters('uds_shortcode_out_filter', $str);
}


//vc
add_action( 'vc_before_init', 'nicdark_advanced_search' );
function nicdark_advanced_search() {
   vc_map( array(
      "name" => __( "Advanced Search", "nicdark-shortcodes" ),
      "base" => "advanced_search_nd",
      'description' => __( 'Insert Advanced Search', 'nicdark-shortcodes' ),
      'show_settings_on_create' => true,
      "icon" => get_template_directory_uri() . "/vc_extend/advanced_search.png",
      "class" => "",
      "category" => __( "Nicdark Shortcodes", "nicdark-shortcodes"),
      "params" => array(


         array(
         'type' => 'dropdown',
          'heading' => "Post Type",
          'param_name' => 'post_type',
          'admin_label' => true,
          'value' => array( "select", "packages" ),
          'description' => __( "Choose the post type to filter, REMEBER TO SET PACKAGES", "nicdark-shortcodes" )
         ),
         array(
         'type' => 'dropdown',
          'heading' => "Columns",
          'param_name' => 'columns',
          'value' => array( __( 'Select', 'nicdark-shortcodes' ) => 'select', __( '4 Columns', 'nicdark-shortcodes' ) => 'grid_3', __( '3 Columns', 'nicdark-shortcodes' ) => 'grid_4', __( '2 Columns', 'nicdark-shortcodes' ) => 'grid_6', __( '1 Column', 'nicdark-shortcodes' ) => 'grid_12' ),
          'description' => __( "Choose columns style", "nicdark-shortcodes" )
         ),
         array(
         'type' => 'dropdown',
          'heading' => "Button Color",
          'param_name' => 'btncolor',
          'value' => array( "select", "yellow", "orange", "red", "violet", "blue", "green" ),
          'description' => __( "Select your button color", "nicdark-shortcodes" )
         ),
         array(
         'type' => 'dropdown',
          'heading' => "Color Field",
          'param_name' => 'bginput',
          'value' => array( __( 'Select', 'nicdark-shortcodes' ) => 'select', __( 'Light Version', 'nicdark-shortcodes' ) => 'grey nicdark_border_grey', __( 'Dark Version', 'nicdark-shortcodes' ) => 'greydark2 nicdark_border_none' ),
          'description' => __( "Select your color, set also the class nicdark_tab_dark (in tab custom class) if you want to insert search in tab components", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "ID", "nicdark-shortcodes" ),
            "param_name" => "id",
            "description" => __( "Insert the id if you want to use your custom css for form customization and hide the fields below.", "nicdark-shortcodes" )
         ),
         array(
            'type' => 'textarea',
            'heading' => __( 'Hide Fields With CSS, Example: #your-id-field { display:none; }', 'nicdark-shortcodes' ),
            'param_name' => 'css_field',
            'description' => __( "This is the ID of the fields:<br/> #nicdark_advanced_search_keyword <br/> #nicdark_advanced_search_tax-0<br/> #nicdark_advanced_search_tax-1<br/> #nicdark_advanced_search_tax-2<br/> #nicdark_advanced_search_tax-3<br/> #nicdark_advanced_search_dates<br/> #nicdark_advanced_search_prices<br/> #nicdark_advanced_search_button", "nicdark-shortcodes" )
         ),
         array(
            'type' => 'checkbox',
            'heading' => "Enable Autocomplete",
            'param_name' => 'autocomplete',
            'value' => array( __( 'ON', 'nicdark-shortcodes' ) => '1' ),
            'description' => __( "Enable autocomplete JS for keywork field. IMPORTANT: It can not be used 2 times in the same page", "nicdark-shortcodes" )  
          )

      )
   ) );
}
//end shortcode
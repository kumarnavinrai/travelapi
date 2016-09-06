<?php


/////////////////////////////////////////////////////////posts grid/////////////////////////////////////////
add_shortcode('posts_grid_nd', 'nicdark_shortcode_posts_grid');
function nicdark_shortcode_posts_grid($atts, $content = null)
{  

   $atts = shortcode_atts(
      array(
         'post_grid_type' => '',
         'post_grid_number' => '',
         'post_grid_columns' => '',
         'post_grid_order' => '',
         'post_grid_orderby' => '',
         'post_grid_postid' => '',

          //for post
         'post_grid_posts_layout' => '',
         'post_grid_categories' => '',
         'show_filter' => '',

          //for packages
         'post_grid_packages_layout' => '',
         'post_grid_tax' => '',
         'post_grid_terms' => '',
         'post_grid_packageprice' => ''
         
      ), $atts);


    $atts['post_grid_packageprice'] = 0;


    //need for event/excursion custom order
    if ( $atts['post_grid_type'] == 'packages' ) {
      
      if ( $atts['post_grid_packageprice'] == 1 ) { 
        $customorderby = 'meta_value'; 
        $customokey = 'metabox_package_price'; 
        $pgtaxonomyname = $atts['post_grid_tax'];
      } else{ 
        $customorderby = $atts['post_grid_orderby'];
        $pgtaxonomyname = $atts['post_grid_tax'];
      } 

    }else{
      $customorderby = $atts['post_grid_orderby']; 
    }



    $args = array(
      'post_type' => ''.$atts['post_grid_type'].'',
      'posts_per_page' => $atts['post_grid_number'],
      'orderby' => ''.$customorderby.'',
      'order' => ''.$atts['post_grid_order'].'',
      'meta_key' => ''.$customokey.'',
      'p' => $atts['post_grid_postid'],
      'category_name' => ''.$atts['post_grid_categories'].'',
      ''.$pgtaxonomyname.'' => ''.$atts['post_grid_terms'].''
    );

    $the_query = new WP_Query( $args );

    if ( $atts['post_grid_type'] == 'post' ) { include 'query/post_query.php';  }
    if ( $atts['post_grid_type'] == 'packages' ) { include 'query/packages_query.php';  } 

    wp_reset_postdata();


   return apply_filters('uds_shortcode_out_filter', $str);
}


//vc
add_action( 'vc_before_init', 'nicdark_posts_grid' );
function nicdark_posts_grid() {
   vc_map( array(
      "name" => __( "Posts Grid", "nicdark-shortcodes" ),
      "base" => "posts_grid_nd",
      'description' => __( 'Insert Posts Grid', 'nicdark-shortcodes' ),
      'show_settings_on_create' => true,
      "icon" => get_template_directory_uri() . "/vc_extend/posts_grid.png",
      "class" => "",
      "category" => __( "Nicdark Shortcodes", "nicdark-shortcodes"),
      "params" => array(

         array(
         'type' => 'dropdown',
          'heading' => "Post Type",
          'param_name' => 'post_grid_type',
          'admin_label' => true,
          'value' => array( "select", "post", "packages" ),
          'description' => __( "Choose the post type", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Posts per page ", "nicdark-shortcodes" ),
            "param_name" => "post_grid_number",
            "description" => __( "Insert the number of posts that you want to show. E.g. 4. Leave empty for show the default settings of WP (Settings -> Reading), -1 for view all posts", "nicdark-shortcodes" )
         ),
         array(
         'type' => 'dropdown',
          'heading' => "Order By",
          'param_name' => 'post_grid_orderby',
          'value' => array( "select", "date", "title", "rand", "modified" ),
          'description' => __( "Choose the order of the visualization", "nicdark-shortcodes" )
         ),
         array(
         'type' => 'dropdown',
          'heading' => "Order",
          'param_name' => 'post_grid_order',
          'value' => array( "select", "DESC", "ASC" ),
          'description' => __( "Choose the type order", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Specific Post ID ", "nicdark-shortcodes" ),
            "param_name" => "post_grid_postid",
            "description" => __( "If you want, insert the ID of your post, need for ONLY one post. E.g. 38", "nicdark-shortcodes" )
         ),
         array(
         'type' => 'dropdown',
          'heading' => "Columns",
          'param_name' => 'post_grid_columns',
          'admin_label' => true,
          'value' => array( __( 'Select', 'nicdark-shortcodes' ) => 'select', __( '4 Columns', 'nicdark-shortcodes' ) => 'grid_3', __( '3 Columns', 'nicdark-shortcodes' ) => 'grid_4', __( '2 Columns', 'nicdark-shortcodes' ) => 'grid_6', __( '1 Column', 'nicdark-shortcodes' ) => 'grid_12' ),
          'description' => __( "Choose columns style", "nicdark-shortcodes" )
         ),



         //post
         array(
         'type' => 'dropdown',
          'heading' => "Preview Layout",
          'param_name' => 'post_grid_posts_layout',
          'value' => array( __( 'Select', 'nicdark-shortcodes' ) => 'select', __( 'Layout 1', 'nicdark-shortcodes' ) => 'post_layout_1', __( 'Layout 2', 'nicdark-shortcodes' ) => 'post_layout_2' ),
          'dependency' => array( 'element' => 'post_grid_type', 'value' => array( 'post' ) ),
          'description' => __( "Choose your preview layout for posts", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Categories ", "nicdark-shortcodes" ),
            "param_name" => "post_grid_categories",
            'dependency' => array( 'element' => 'post_grid_type', 'value' => array( 'post' ) ),
            "description" => __( "Insert the category slug (NOT NAME) separated by comma without space. E.g. category1,category2,category3", "nicdark-shortcodes" )
         ),

         array(
            'type' => 'checkbox',
            'heading' => "Show Filter",
            'param_name' => 'show_filter',
            'value' => array( __( '', 'nicdark-shortcodes' ) => '1' ),
            'dependency' => array( 'element' => 'post_grid_type', 'value' => array( 'post' ) ),
            'description' => __( "Show all categories for filter.", "nicdark-shortcodes" )  
          ),


         //packages
         array(
         'type' => 'dropdown',
          'heading' => "Preview Layout",
          'param_name' => 'post_grid_packages_layout',
          'value' => array( __( 'Select', 'nicdark-shortcodes' ) => 'select', __( 'Layout 1', 'nicdark-shortcodes' ) => 'packages_layout_1', __( 'Layout 2', 'nicdark-shortcodes' ) => 'packages_layout_2', __( 'Layout 3', 'nicdark-shortcodes' ) => 'packages_layout_3', __( 'Layout 4', 'nicdark-shortcodes' ) => 'packages_layout_4', __( 'Layout 5', 'nicdark-shortcodes' ) => 'packages_layout_5' ),
          'dependency' => array( 'element' => 'post_grid_type', 'value' => array( 'packages' ) ),
          'description' => __( "Choose your preview layout for packages", "nicdark-shortcodes" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Taxonomy Name ", "nicdark-shortcodes" ),
            "param_name" => "post_grid_tax",
            'dependency' => array( 'element' => 'post_grid_type', 'value' => array( 'packages' ) ),
            "description" => __( "Insert the taxonomy name E.g. destination-package", "nicdark-shortcodes" )
         ),
          array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Taxonomy Terms ", "nicdark-shortcodes" ),
            "param_name" => "post_grid_terms",
            'dependency' => array( 'element' => 'post_grid_type', 'value' => array( 'packages' ) ),
            "description" => __( "Insert the taxonomy terms slug (NOT NAME) separated by comma without space. E.g. taxonomy-term-1,taxonomy-term-2,taxonomy-term-3", "nicdark-shortcodes" )
         )

          /*,array(
              'type' => 'checkbox',
              'heading' => "Order by Packages Price",
              'param_name' => 'post_grid_packageprice',
              'value' => array( __( '', 'nicdark-shortcodes' ) => '1' ),
              'dependency' => array( 'element' => 'post_grid_type', 'value' => array( 'packages' ) ),
              'description' => __( "Check for order the post by packages price", "nicdark-shortcodes" )  
            )*/

      )
   ) );
}
//end shortcode
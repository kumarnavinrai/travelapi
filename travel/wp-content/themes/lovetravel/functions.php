<?php


$themename = "lovetravel";



//translation
load_theme_textdomain( 'lovetravel', get_template_directory().'/languages' );


//call framework
if ( !class_exists( 'framework' ) && file_exists( dirname( __FILE__ ) . '/framework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/framework/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/framework/sample/config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/framework/sample/config.php' );
}



/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'nicdark_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function nicdark_register_required_plugins() {
 
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
 
        // RevSlider
        array(
            'name'               => 'Revolution Slider', // The plugin name.
            'slug'               => 'revslider', // The plugin slug (typically the folder name).
            'source'             => 'http://www.nicdarkthemes.com/themes/love-travel/wp/plugins/revslider_wp.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

        // Contact Form 7
        array(
            'name'               => 'Contact Form 7', // The plugin name.
            'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
            'source'             => 'http://www.nicdarkthemes.com//themes/love-travel/wp/plugins/contact-form-7_wp.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

        // WordPress Importer
        array(
            'name'               => 'WordPress Importer', // The plugin name.
            'slug'               => 'wordpress-importer', // The plugin slug (typically the folder name).
            'source'             => 'http://www.nicdarkthemes.com/themes/love-travel/wp/plugins/wordpress-importer_wp.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

        // WPBakery Visual Composer
        array(
            'name'               => 'WPBakery Visual Composer', // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => 'http://www.nicdarkthemes.com/themes/love-travel/wp/plugins/js_composer_wp.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

        // Nicdark Shortcodes
        array(
            'name'               => 'Nicdark Shortcodes', // The plugin name.
            'slug'               => 'nicdark-shortcodes', // The plugin slug (typically the folder name).
            'source'             => 'http://www.nicdarkthemes.com/themes/love-travel/wp/plugins/nicdark-shortcodes_wp.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

        // Woo Commerce
        array(
            'name'               => 'Woo Commerce', // The plugin name.
            'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
            'source'             => 'http://www.nicdarkthemes.com/themes/love-travel/wp/plugins/woocommerce_wp.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
 
    );
 
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
    tgmpa( $plugins, $config );
 
}
// END TGM_Plugin_Activation



//register my menus
function nicdark_register_my_menus() {
  register_nav_menu( 'main-menu', __( 'Main Menu', 'lovetravel' ) );  
}
add_action( 'init', 'nicdark_register_my_menus' );

//Thumbnails
if(function_exists('add_theme_support')){
	add_theme_support('post-thumbnails');
	add_image_size( 'archive-image', 1180, 0);
}

//Content_width
if (!isset($content_width)) $content_width = 1180;

//automatic-feed-links
add_theme_support( 'automatic-feed-links' );


//edit excerpt_more
function nicdark_new_excerpt_more( $more ) {
	return ' ...';
}
add_filter('excerpt_more', 'nicdark_new_excerpt_more');


//edit wp title
function nicdark_wp_title( $title, $sep ) {

    // Add the site name.
    $title .= get_bloginfo( 'name', 'display' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title = "$title $sep $site_description";
    }

    return $title;
}
add_filter( 'wp_title', 'nicdark_wp_title', 10, 2 );


//enable shortcode in the field excerpt and widget text
add_filter('the_excerpt', 'do_shortcode');
add_filter('widget_text', 'do_shortcode');

// Sidebar
function add_nicdark_sidebars() {

    // Sidebar Main
    register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    // Sidebar Second
    register_sidebar(array(
        'name' => 'Sidebar Second',
        'id' => 'sidebar-second',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    // Woo Commerce
    register_sidebar(array(
        'name' => 'Woo Commerce',
        'id' => 'woo-commerce',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    // Sidebar Open Left
    register_sidebar(array(
        'name' => 'Sidebar Open Left',
        'id' => 'sidebar-open-left',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

    // Sidebar Open Right
    register_sidebar(array(
        'name' => 'Sidebar Open Right',
        'id' => 'sidebar-open-right',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));


    // Footer 1
    register_sidebar(array(
        'name' => 'Footer 1',
        'id' => 'footer-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
    // Footer 2
    register_sidebar(array(
        'name' => 'Footer 2',
        'id' => 'footer-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
    // Footer 3
    register_sidebar(array(
        'name' => 'Footer 3',
        'id' => 'footer-3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
    // Footer 4
    register_sidebar(array(
        'name' => 'Footer 4',
        'id' => 'footer-4',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

}
add_action( 'widgets_init', 'add_nicdark_sidebars' );


//edit next_posts_link() and previous_posts_link
function nicdark_posts_link_attributes_next() {
    return 'class="nicdark_btn nicdark_bg_green medium white nicdark_press" title="Next"';
}
function nicdark_posts_link_attributes_previous() {
    return 'class="nicdark_disable_floatright_iphoneland nicdark_disable_floatright_iphonepotr nicdark_btn nicdark_bg_green medium right   white nicdark_press" title="Previous"';
}
add_filter('next_posts_link_attributes', 'nicdark_posts_link_attributes_next');
add_filter('previous_posts_link_attributes', 'nicdark_posts_link_attributes_previous');


//Tag Cloud Settings
function nicdark_cloud_args($in){  
  return "smallest=15&largest=15&orderby=name&unit=px";  
}
add_filter( "widget_tag_cloud_args", "nicdark_cloud_args" );


//add css and js
function nicdark_enqueue_scripts()
{
	
	//main
	//wp_enqueue_script('jquery');
    wp_enqueue_script("jquery", get_template_directory_uri() . "/js/main/jquery-1.11.2.min.js", array(), false, true);
    wp_enqueue_script("jquery-ui", get_template_directory_uri() . "/js/main/jquery-ui.js", array(), false, true);
	wp_enqueue_script("excanvas", get_template_directory_uri() . "/js/main/excanvas.js", array(), false, true);

	//menu
	wp_enqueue_script("superfish", get_template_directory_uri() . "/js/plugins/menu/superfish.min.js", array(), false, true);
	wp_enqueue_script("tinynav", get_template_directory_uri() . "/js/plugins/menu/tinynav.min.js", array(), false, true);

	//other
	wp_enqueue_script("isotope", get_template_directory_uri() . "/js/plugins/isotope/isotope.pkgd.min.js", array(), false, true);
    wp_enqueue_script("imagesloaded", get_template_directory_uri() . "/js/plugins/isotope/imagesloaded.pkgd.min.js", array(), false, true);
	wp_enqueue_script("mpopup", get_template_directory_uri() . "/js/plugins/mpopup/jquery.magnific-popup.min.js", array(), false, true);
	wp_enqueue_script("scroolto", get_template_directory_uri() . "/js/plugins/scroolto/scroolto.js", array(), false, true);
	wp_enqueue_script("nicescroll", get_template_directory_uri() . "/js/plugins/nicescrool/jquery.nicescroll.min.js", array(), false, true);
	wp_enqueue_script("inview", get_template_directory_uri() . "/js/plugins/inview/jquery.inview.min.js", array(), false, true);
	wp_enqueue_script("parallax", get_template_directory_uri() . "/js/plugins/parallax/jquery.parallax-1.1.3.js", array(), false, false);
	wp_enqueue_script("countto", get_template_directory_uri() . "/js/plugins/countto/jquery.countTo.js", array(), false, true);
	wp_enqueue_script("countdown", get_template_directory_uri() . "/js/plugins/countdown/jquery.countdown.js", array(), false, false);

	//settings
    wp_enqueue_script("sort", get_template_directory_uri() . "/js/sort.js", array(), false, true);
    wp_enqueue_script("settings", get_template_directory_uri() . "/js/settings.js", array(), false, true);
   
	//comment-reply
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	
	//css
    wp_enqueue_style("style", get_stylesheet_directory_uri() . "/style.css");
    wp_enqueue_style("responsive", get_stylesheet_directory_uri() . "/css/nicdark_responsive.css");
    wp_enqueue_style("nicdark_elusive_icons", get_stylesheet_directory_uri() . "/framework/ReduxCore/assets/css/vendor/elusive-icons/elusive-icons.css");

}
add_action("wp_enqueue_scripts", "nicdark_enqueue_scripts");
//end js


//css inline
function nicdark_add_theme_options_style() { 

    global $redux_demo;

?>

    <style type="text/css">

        /*start header*/
        .slowup{ margin-top: <?php echo $redux_demo['header_position']; ?>px; }
        .nicdark_logo img{ width: <?php echo $redux_demo['logo_settings']['width']; ?>; margin-top: <?php echo $redux_demo['logo_settings']['height']; ?>; }
        /*end header*/

        
        /*widget title color*/
        .widget_archive > h2 { background-color: <?php echo $redux_demo['widget_archives']; ?>; }
        #wp-calendar caption, .widget_calendar > h2 { background-color: <?php echo $redux_demo['widget_calendar']; ?>; }
        .widget_categories > h2 { background-color: <?php echo $redux_demo['widget_categories']; ?>; }
        .widget_nav_menu > h2 { background-color: <?php echo $redux_demo['widget_menus']; ?>; }
        .widget_meta > h2 { background-color: <?php echo $redux_demo['widget_meta']; ?>; }
        .widget_pages > h2 { background-color: <?php echo $redux_demo['widget_pages']; ?>; }
        .widget_recent_comments > h2 { background-color: <?php echo $redux_demo['widget_comments']; ?>; }
        .widget_recent_entries > h2 { background-color: <?php echo $redux_demo['widget_posts']; ?>; }
        .widget_slider > h2 { background-color: <?php echo $redux_demo['widget_slider']; ?>; }
        .widget_rss > h2 { background-color: <?php echo $redux_demo['widget_rss']; ?>; }
        .widget_search > h2 { background-color: <?php echo $redux_demo['widget_search']; ?>; }
        .widget_text > h2 { background-color: <?php echo $redux_demo['widget_text']; ?>; }
        .widget_tag_cloud > h2 { background-color: <?php echo $redux_demo['widget_tags']; ?>; }
        .tt_upcoming_events_widget > h2 { background-color: <?php echo $redux_demo['widget_events']; ?>; }
        .widget.woocommerce > h2 { background-color: <?php echo $redux_demo['widget_woo']; ?>; }
        /*end widget title color*/

        
        /*start color and font settings*/
        <?php include "include/custom-css/colors.php"; ?>
        <?php include "include//custom-css/fonts.php"; ?>
        /*end color and font settings*/

        
        /*start boxed version*/
        <?php if ($redux_demo['general_boxed'] == 1) { ?>

        body{
            <?php echo 'background-color: '.$redux_demo['general_background']['background-color'].' !important;'; ?>
            <?php echo 'background-image: '.$redux_demo['general_background']['background-image'].' !important;'; ?>
            <?php echo 'background-repeat: '. $redux_demo['general_background']['background-repeat'].' !important;'; ?>
            <?php echo 'background-position: '. $redux_demo['general_background']['background-position'].' !important;'; ?>
            <?php echo 'background-size: '. $redux_demo['general_background']['background-size'].' !important;'; ?>
            <?php echo 'background-attachment: '.$redux_demo['general_background']['background-attachment'].' !important;'; ?>
        } 

        <?php } ?>
        /*end boxed version*/

        /*start custom css*/
        <?php echo esc_attr( $redux_demo['general_css'] ); ?>
        /*end custom css*/


    </style>
    
<?php add_filter( 'auto_update_plugin', '__return_false' ); ?>
<?php add_filter( 'auto_update_theme', '__return_false' ); ?>
<?php
}
add_action('wp_head', 'nicdark_add_theme_options_style');
//end css inline


// Shortcodes vc
if (function_exists('vc_remove_element')){ require_once('include/shortcodes.php'); }


//add admin css
function nicdark_hide_taxonomy_inpost() {
  echo '<style> .post-type-post #destination-packagediv, .post-type-post #typology-packagediv, .post-type-post #duration-packagediv, .post-type-post #person-packagediv, #menu-posts-vc_grid_item { display:none; }</style>';
}
add_action('admin_head', 'nicdark_hide_taxonomy_inpost');


//woocommerce
add_theme_support( 'woocommerce' );
// Disable WooCommerce CSS
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
//edit nubmer pagination item
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 8;' ), 20 );
//edit related procducts number
function woocommerce_output_related_products() { woocommerce_related_products(4,1); }


?>

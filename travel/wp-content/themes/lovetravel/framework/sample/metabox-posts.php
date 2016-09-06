<?php

$boxSections_posts = array();

//START NICDARK SETTINGS
$boxSections_posts[] = array(
    'title' => __('Header Settings', 'redux-framework-demo'),
    //'desc' => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'redux-framework-demo'),
    'icon' => 'el el-home',
    'fields' => array(  

        //start array
        array(
            'id'       => 'metabox_posts_header_img_display',
            'type'     => 'switch',
            'title'    => __( 'Enable Header Image Display', 'redux-framework-demo' ),
            'subtitle' => __( 'Enable Header Parallax Image Display!', 'redux-framework-demo' ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'metabox_posts_header_img',
            'type'     => 'media',
            'required' => array( 'metabox_posts_header_img_display', '=', '1' ),
            'title'    => __( 'Image Parallax', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'subtitle' => __( 'Upload your parallax image', 'redux-framework-demo' ),
        ),
        array(
            'id'       => 'metabox_posts_header_filter',
            'type'     => 'select',
            'required' => array( 'metabox_posts_header_img_display', '=', '1' ),
            'title'    => __( 'Filter', 'redux-framework-demo' ),
            'subtitle' => __( 'Select Color Filter Over Image', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            //Must provide key => value pairs for select options
            'options'  => array(
                'greydark' => 'greydark',
                '' => 'none'
            ),
            'default'  => 'greydark'
        ),
        array(
            'id'       => 'metabox_posts_header_title',
            'type'     => 'text',
            'required' => array( 'metabox_posts_header_img_display', '=', '1' ),
            'title'    => __( 'Title', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert your title', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'validate' => 'no_special_chars',
            'default'  => 'TITLE'
        ),
        array(
            'id'       => 'metabox_posts_header_description',
            'type'     => 'text',
            'required' => array( 'metabox_posts_header_img_display', '=', '1' ),
            'title'    => __( 'Description', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert your description', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'validate' => 'no_special_chars',
            'default'  => 'DESCRIPTION'
        ),
        array(
            'id'       => 'metabox_posts_header_divider',
            'type'     => 'switch',
            'required' => array( 'metabox_posts_header_img_display', '=', '1' ),
            'title'    => __( 'Disable Divider', 'redux-framework-demo' ),
            'subtitle' => __( 'Disable Divider above title', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'metabox_posts_header_margintop',
            'type'     => 'select',
            'required' => array( 'metabox_posts_header_img_display', '=', '1' ),
            'title'    => __( 'Margin Top', 'redux-framework-demo' ),
            'subtitle' => __( 'Select Title Margin Top', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            //Must provide key => value pairs for select options
            'options'  => array(
                '50' => '50',
                '60' => '60',
                '70' => '70',
                '80' => '80',
                '90' => '90',
                '100' => '100',
                '110' => '110',
                '120' => '120',
                '130' => '130',
                '140' => '140',
                '150' => '150',
                '160' => '160',
                '170' => '170',
                '180' => '180',
                '190' => '190',
                '200' => '200'
            ),
            'default'  => '90'
        ),
        array(
            'id'       => 'metabox_posts_header_marginbottom',
            'type'     => 'select',
            'required' => array( 'metabox_posts_header_img_display', '=', '1' ),
            'title'    => __( 'Margin Bottom', 'redux-framework-demo' ),
            'subtitle' => __( 'Select Title Margin Bottom', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            //Must provide key => value pairs for select options
            'options'  => array(
                '50' => '50',
                '60' => '60',
                '70' => '70',
                '80' => '80',
                '90' => '90',
                '100' => '100',
                '110' => '110',
                '120' => '120',
                '130' => '130',
                '140' => '140',
                '150' => '150',
                '160' => '160',
                '170' => '170',
                '180' => '180',
                '190' => '190',
                '200' => '200'
            ),
            'default'  => '90'
        ),
        //end array


        
    )
); 



$boxSections_posts[] = array(
    'title' => __('Color Settings', 'redux-framework-demo'),
    'desc' => __('', 'redux-framework-demo'),
    'icon' => 'el el-pencil',
    'fields' => array(  
        
        array(
            'id'       => 'metabox_posts_color',
            'type'     => 'select',
            'title'    => __( 'Color', 'redux-framework-demo' ),
            'subtitle' => __( 'Select Your Main Color', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            //Must provide key => value pairs for select options
            'options'  => array(
                'greydark' => 'greydark',
                'red' => 'red',
                'orange' => 'orange',
                'yellow' => 'yellow',
                'blue' => 'blue',
                'green' => 'green',
                'violet' => 'violet'
            ),
            'default'  => 'orange'
        ),               
                                                           
    ),
);


$boxSections_posts[] = array(
    'title' => __('General Settings', 'redux-framework-demo'),
    //'desc' => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'redux-framework-demo'),
    'icon' => 'el el-cogs',
    'fields' => array(  

        //start array
        array(
            'id'       => 'metabox_posts_featured_image',
            'type'     => 'switch',
            'title'    => __( 'Featured Image', 'redux-framework-demo' ),
            'subtitle' => __( 'Disable Featured Image!', 'redux-framework-demo' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'metabox_posts_information_bar',
            'type'     => 'switch',
            'title'    => __( 'Information Bar', 'redux-framework-demo' ),
            'subtitle' => __( 'Disable Information Bar!', 'redux-framework-demo' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'metabox_posts_title',
            'type'     => 'switch',
            'title'    => __( 'Title Post', 'redux-framework-demo' ),
            'subtitle' => __( 'Disable Title Post!', 'redux-framework-demo' ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'metabox_posts_tags',
            'type'     => 'switch',
            'title'    => __( 'Tags', 'redux-framework-demo' ),
            'subtitle' => __( 'Disable Tags Section!', 'redux-framework-demo' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'metabox_posts_categories',
            'type'     => 'switch',
            'title'    => __( 'Categories', 'redux-framework-demo' ),
            'subtitle' => __( 'Disable categories section!', 'redux-framework-demo' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'metabox_posts_author',
            'type'     => 'switch',
            'title'    => __( 'Author', 'redux-framework-demo' ),
            'subtitle' => __( 'Disable Author Bar!', 'redux-framework-demo' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'metabox_posts_comments',
            'type'     => 'switch',
            'title'    => __( 'Comments', 'redux-framework-demo' ),
            'subtitle' => __( 'Disable Comments!', 'redux-framework-demo' ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        //end array


        
    )
);


$boxSections_posts[] = array(
    'title' => __('Sidebar Settings', 'redux-framework-demo'),
    'desc' => __('', 'redux-framework-demo'),
    'icon' => 'el el-list',
    'fields' => array(  
        
        array(
            'id' => 'metabox_posts_sidebar',
            'title' => __( 'Sidebar', 'fusion-framework' ),
            'desc' => 'Please select the sidebar you would like to display on this page.',
            'type' => 'select',
            'data' => 'sidebars',
            'default' => 'Sidebar'
        ),            
                                                           
    ),
);

//END NICDARK SETTINGS


$metaboxes[] = array(
    'id' => 'demo_layout_posts',
    'title' => __('Options Post', 'redux-framework-demo'),
    'post_types' => array('post'),
    //'page_template' => array('page-test.php'),
    //'post_format' => array('image'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'default', // high, core, default, low
    //'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
    'sections' => $boxSections_posts
);



////////////////////////////////START SIDEBAR LAYOUT SETTINGS
$boxSections_sidebar_posts = array();
$boxSections_sidebar_posts[] = array(
    'icon_class' => 'icon-large',
    'icon' => 'el el-home',
    'fields' => array(
        array(
            'title'     => __( 'Layout Posts', 'redux-framework-demo' ),
            'desc'      => __( 'Select main content and sidebar position.', 'redux-framework-demo' ),
            'id'        => 'layout_posts',
            'default'   => 1,
            'type'      => 'image_select',
            'customizer'=> array(),
            'options'   => array( 
            0           => ReduxFramework::$_url . 'assets/img/1c.png',
            1           => ReduxFramework::$_url . 'assets/img/2cr.png',
            2           => ReduxFramework::$_url . 'assets/img/2cl.png',
            )
        ),
    )
);


$metaboxes[] = array(
    'id' => 'layout_posts2',
    //'title' => __('Cool Options', 'redux-framework-demo'),
    'post_types' => array('post'),
    //'page_template' => array('page-test.php'),
    //'post_format' => array('image'),
    'position' => 'side', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $boxSections_sidebar_posts
);
    ////////////////////////////////END  SIDEBAR LAYOUT SETTINGS
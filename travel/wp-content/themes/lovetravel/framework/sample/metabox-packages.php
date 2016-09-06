<?php

$boxSections_packages = array();



//START NICDARK SETTINGS
$boxSections_packages[] = array(
    'title' => __('Package Settings', 'redux-framework-demo'),
    //'desc' => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'redux-framework-demo'),
    'icon' => 'el el-briefcase',
    'fields' => array(  

        //start array
        array(
            'id'       => 'metabox_package_date_from',
            'type'     => 'date',
            'title'    => __( 'Date From', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert the start date package (REQUIRED FIELD FOR ADVANCED SEARCH) Data format can not be changed for properly filtering on the search form', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' )
        ),

        array(
            'id'       => 'metabox_package_date_to',
            'type'     => 'date',
            'title'    => __( 'Date To', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert the end date package.', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' )
        ),

        array(
            'id'       => 'metabox_package_price',
            'type'     => 'text',
            'title'    => __( 'Price', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert the price E.g. 32', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'validate' => 'no_special_chars'
        ),
        array(
            'id'       => 'metabox_package_currency',
            'type'     => 'text',
            'title'    => __( 'Currency', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert the currency E.g. USD', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'validate' => 'no_special_chars'
        ),
        array(
            'id'       => 'metabox_package_promotion',
            'type'     => 'switch',
            'title'    => __( 'Enable Promotion', 'redux-framework-demo' ),
            'subtitle' => __( 'Enable promotion ribbon on the preview!', 'redux-framework-demo' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'metabox_package_coordinates',
            'type'     => 'text',
            'title'    => __( 'Coordinates', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert the coordinates', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'default'  => '',
            'validate' => 'no_special_chars'
        ),
        //end array
        
    )
); 


$boxSections_packages[] = array(
    'title' => __('Preview Settings', 'redux-framework-demo'),
    //'desc' => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'redux-framework-demo'),
    'icon' => 'el el-adjust-alt',
    'fields' => array(  

        //start array
        array(
            'id'       => 'metabox_package_excerpt',
            'type'     => 'textarea',
            'title'    => __( 'Text Preview', 'redux-framework-demo' ),
            'rows'     => 6,
            'subtitle' => __( 'Insert Your Content, HTML / TEXT is allowed', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
            'default'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut efficitur ante. Donec dapibus dictum scelerisque. Maecenas semper erat et justo porta auctor nec lobortis elit.'
        ),
        array(
            'id'       => 'metabox_package_linktitle',
            'type'     => 'text',
            'title'    => __( 'Text button', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert custom text', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'validate' => 'no_special_chars',
            'default'  => 'MORE INFO'
        ),
        array(
            'id'       => 'metabox_package_linkurl',
            'type'     => 'text',
            'title'    => __( 'Link button', 'redux-framework-demo' ),
            'subtitle' => __( 'This must be a URL. E.g. http://www.cleanthemes.net', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'default'  => ''
        ),
        array(
            'id'       => 'metabox_package_iframe',
            'type'     => 'textarea',
            'title'    => __( 'Iframe code', 'redux-framework-demo' ),
            'rows'     => 6,
            'subtitle' => __( 'Insert your iframe code that will be displayed as a preview of the package to replacing the featured image', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
            'default'  => ''
        ),
        array(
            'id'       => 'metabox_package_popup_btn',
            'type'     => 'switch',
            'title'    => __( 'Window Pop up', 'redux-framework-demo' ),
            'subtitle' => __( 'Enable Window Pop up!', 'redux-framework-demo' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'metabox_package_popup_btn_icon',
            'type'     => 'select',
            'required' => array( 'metabox_package_popup_btn', '=', '1' ),
            'data'     => 'elusive-icons',
            'title'    => __( 'Icon for button', 'redux-framework-demo' ),
            'subtitle' => __( 'Select your retina icon', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'default'  => 'icon-mail'
        ),
        array(
            'id'       => 'metabox_package_popup_style',
            'type'     => 'select',
            'required' => array( 'metabox_package_popup_btn', '=', '1' ),
            'title'    => __( 'Style', 'redux-framework-demo' ),
            'subtitle' => __( 'Select light or dark style', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            //Must provide key => value pairs for select options
            'options'  => array(
                'greydark' => 'greydark',
                'white' => 'white'
            ),
            'default'  => 'white'
        ),
        array(
            'id'       => 'metabox_package_popup_title',
            'type'     => 'text',
            'required' => array( 'metabox_package_popup_btn', '=', '1' ),
            'title'    => __( 'Title Window', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert your Title', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'default'  => ''
        ),
        array(
            'id'       => 'metabox_package_popup_content',
            'type'     => 'textarea',
            'required' => array( 'metabox_package_popup_btn', '=', '1' ),
            'title'    => __( 'Content Window', 'redux-framework-demo' ),
            'rows'     => 6,
            'subtitle' => __( 'Insert your content for the pop up window', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
            'default'  => '<p>Lorem Ipsum Dolor Sit Amet</p>'
        ),
        //end array


        
    )
); 


$boxSections_packages[] = array(
    'title' => __('Header Settings', 'redux-framework-demo'),
    //'desc' => __('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'redux-framework-demo'),
    'icon' => 'el el-home',
    'fields' => array(  

        //start array
        array(
            'id'       => 'metabox_package_header_img_display',
            'type'     => 'switch',
            'title'    => __( 'Enable Header Image Display', 'redux-framework-demo' ),
            'subtitle' => __( 'Enable Header Parallax Image Display!', 'redux-framework-demo' ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'metabox_package_header_img',
            'type'     => 'media',
            'required' => array( 'metabox_package_header_img_display', '=', '1' ),
            'title'    => __( 'Image Parallax', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'subtitle' => __( 'Upload your parallax image', 'redux-framework-demo' ),
        ),
        array(
            'id'       => 'metabox_package_header_filter',
            'type'     => 'select',
            'required' => array( 'metabox_package_header_img_display', '=', '1' ),
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
            'id'       => 'metabox_package_header_title',
            'type'     => 'text',
            'required' => array( 'metabox_package_header_img_display', '=', '1' ),
            'title'    => __( 'Title', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert your title', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'validate' => 'no_special_chars',
            'default'  => 'TITLE'
        ),
        array(
            'id'       => 'metabox_package_header_description',
            'type'     => 'text',
            'required' => array( 'metabox_package_header_img_display', '=', '1' ),
            'title'    => __( 'Description', 'redux-framework-demo' ),
            'subtitle' => __( 'Insert your description', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'validate' => 'no_special_chars',
            'default'  => 'DESCRIPTION'
        ),
        array(
            'id'       => 'metabox_package_header_divider',
            'type'     => 'switch',
            'required' => array( 'metabox_package_header_img_display', '=', '1' ),
            'title'    => __( 'Disable Divider', 'redux-framework-demo' ),
            'subtitle' => __( 'Disable Divider above title', 'redux-framework-demo' ),
            'desc'     => __( '', 'redux-framework-demo' ),
            'default'  => 1,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'metabox_package_header_margintop',
            'type'     => 'select',
            'required' => array( 'metabox_package_header_img_display', '=', '1' ),
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
            'id'       => 'metabox_package_header_marginbottom',
            'type'     => 'select',
            'required' => array( 'metabox_package_header_img_display', '=', '1' ),
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



$boxSections_packages[] = array(
    'title' => __('Color Settings', 'redux-framework-demo'),
    'desc' => __('', 'redux-framework-demo'),
    'icon' => 'el el-pencil',
    'fields' => array(  
        
        array(
            'id'       => 'metabox_package_color',
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
            'default'  => 'yellow'
        ),               
                                                           
    ),
);


$boxSections_packages[] = array(
    'title' => __('Sidebar Settings', 'redux-framework-demo'),
    'desc' => __('', 'redux-framework-demo'),
    'icon' => 'el el-list',
    'fields' => array(  
        
        array(
            'id' => 'metabox_package_sidebar',
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
    'id' => 'packages-layout',
    'title' => __('Package Options', 'redux-framework-demo'),
    'post_types' => array('packages'),
    //'page_template' => array('page-test.php'),
    //'post_format' => array('image'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    //'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
    'sections' => $boxSections_packages
);



////////////////////////////////START SIDEBAR LAYOUT SETTINGS
$boxSections_sidebar_packages = array();
$boxSections_sidebar_packages[] = array(
    'icon_class' => 'icon-large',
    'icon' => 'el-icon-home',
    'fields' => array(
        array(
            'title'     => __( 'Layout packages', 'redux-framework-demo' ),
            'desc'      => __( 'Select main content and sidebar position.', 'redux-framework-demo' ),
            'id'        => 'layout_packages',
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
    'id' => 'layout_packages2',
    //'title' => __('Cool Options', 'redux-framework-demo'),
    'post_types' => array('packages'),
    //'page_template' => array('page-test.php'),
    //'post_format' => array('image'),
    'position' => 'side', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $boxSections_sidebar_packages
);
////////////////////////////////END  SIDEBAR LAYOUT SETTINGS


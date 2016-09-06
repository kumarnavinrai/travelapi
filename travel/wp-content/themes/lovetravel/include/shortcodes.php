<?php


vc_set_as_theme( $disable_updater = true );

//remove elem vc
vc_remove_element( "vc_raw_html" );
vc_remove_element( "vc_raw_js" );
vc_remove_element( "vc_separator" );
vc_remove_element( "vc_text_separator" );
vc_remove_element( "vc_message" );
vc_remove_element( "vc_custom_heading" );
vc_remove_element( "vc_basic_grid" );
vc_remove_element( "vc_masonry_grid");
vc_remove_element( "vc_pie");
vc_remove_element( "vc_media_grid");
vc_remove_element( "vc_masonry_media_grid");
vc_remove_element( "vc_cta" );
vc_remove_element( "vc_tta_pageable");
vc_remove_element( "vc_round_chart");
vc_remove_element( "vc_line_chart");
vc_remove_element( "vc_images_carousel");
vc_remove_element( "vc_posts_slider");


//deprecated
vc_remove_element( "vc_tabs");
vc_remove_element( "vc_tour");
vc_remove_element( "vc_accordion");
vc_remove_element( "vc_button");
vc_remove_element( "vc_button2");
vc_remove_element( "vc_cta_button");
vc_remove_element( "vc_cta_button2");




////////////////////////////////////EDIT ROW////////////////////////////////////

//remove param
vc_remove_param( "vc_row", "full_width" );
vc_remove_param( "vc_row", "parallax" );
vc_remove_param( "vc_row", "el_id" );
vc_remove_param( "vc_row", "parallax_image" );
vc_remove_param( "vc_row", "full_height" );
vc_remove_param( "vc_row", "video_bg" );
vc_remove_param( "vc_row", "content_placement" );
vc_remove_param( "vc_row", "video_bg_url" );
vc_remove_param( "vc_row", "video_bg_parallax" );

//add row param
vc_add_param("vc_row", array(
  'type' => 'textfield',
  'heading' => __( 'Section ID', 'lovetravel' ),
  'param_name' => 'idsection',
  'description' => __( 'Insert section ID for anchor link. E.g. my_section_id_1', 'lovetravel' )
));
vc_add_param("vc_row", array(
   'type' => 'dropdown',
    'heading' => "Style",
    'param_name' => 'row_style',
    'value' => array( "container", "full_width" ),
    'description' => __( "Choose the style for the row", "lovetravel" )
));
//add row param
vc_add_param("vc_row", array(
  'type' => 'dropdown',
  'heading' => __( 'Parallax', 'lovetravel' ),
  'param_name' => 'imgparallax',
  'value' => array(
    __( 'No', 'lovetravel' ) => 'no',
    __( 'Yes', 'lovetravel' ) => 'yes'
  ),
  'description' => __( 'Set the image in Design Options Tab', 'lovetravel' )
));
vc_add_param("vc_row", array(
  'type' => 'textfield',
  'heading' => __( 'ID for parallax', 'lovetravel' ),
  'param_name' => 'idparallax',
  'description' => __( 'Insert parallax ID name. E.g. my_first_parallax_1', 'lovetravel' ),
  'dependency' => array( 'element' => 'imgparallax', 'value' => array( 'yes' ) )
));
vc_add_param("vc_row", array(
  'type' => 'attach_image',
  'heading' => __( 'Image Parallax', 'js_composer' ),
  'param_name' => 'srcparallax',
  'value' => '',
  'description' => __( 'Select image from media library.', 'js_composer' ),
  'dependency' => array( 'element' => 'imgparallax', 'value' => array( 'yes' ) )
));
vc_add_param("vc_row", array(
  'type' => 'dropdown',
  'heading' => __( 'Color Filter', 'lovetravel' ),
  'param_name' => 'filter',
  'description' => __( 'Choose color filter', 'lovetravel' ),
  'value' => array( "none", "greydark", "greydark2" ),
  'dependency' => array( 'element' => 'imgparallax', 'value' => array( 'yes' ) )
));



vc_add_param("vc_row_inner", array(
  'type' => 'textfield',
  'heading' => __( 'Section ID', 'lovetravel' ),
  'param_name' => 'idsection',
  'description' => __( 'Insert section ID for anchor link. E.g. my_section_id_1', 'lovetravel' )
));
vc_add_param("vc_row_inner", array(
   'type' => 'dropdown',
    'heading' => "Style",
    'param_name' => 'row_style',
    'value' => array( "full_width", "container" ),
    'description' => __( "Choose the style for the row", "lovetravel" )
));
vc_add_param("vc_row_inner", array(
  'type' => 'dropdown',
  'heading' => __( 'Parallax', 'lovetravel' ),
  'param_name' => 'imgparallax',
  'value' => array(
    __( 'No', 'lovetravel' ) => 'no',
    __( 'Yes', 'lovetravel' ) => 'yes'
  ),
  'description' => __( 'Set the image in Design Options Tab', 'lovetravel' )
));
vc_add_param("vc_row_inner", array(
  'type' => 'textfield',
  'heading' => __( 'ID for parallax', 'lovetravel' ),
  'param_name' => 'idparallax',
  'description' => __( 'Insert parallax ID name. E.g. my_first_parallax_1', 'lovetravel' ),
  'dependency' => array( 'element' => 'imgparallax', 'value' => array( 'yes' ) )
));
vc_add_param("vc_row_inner", array(
  'type' => 'attach_image',
  'heading' => __( 'Image Parallax', 'js_composer' ),
  'param_name' => 'srcparallax',
  'value' => '',
  'description' => __( 'Select image from media library.', 'js_composer' ),
  'dependency' => array( 'element' => 'imgparallax', 'value' => array( 'yes' ) )
));
vc_add_param("vc_row_inner", array(
  'type' => 'dropdown',
  'heading' => __( 'Color Filter', 'lovetravel' ),
  'param_name' => 'filter',
  'description' => __( 'Choose color filter', 'lovetravel' ),
  'value' => array( "none", "greydark", "greydark2" ),
  'dependency' => array( 'element' => 'imgparallax', 'value' => array( 'yes' ) )
));
//remove param
vc_remove_param( "vc_row", "font_color" );
vc_remove_param( "vc_row_inner", "el_id" );












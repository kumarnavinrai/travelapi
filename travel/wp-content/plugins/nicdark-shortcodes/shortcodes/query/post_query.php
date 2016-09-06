<?php

$outputfilter = 0;

//start translate
$nicdark_text_postquery_all = __('ALL','nicdark-shortcodes');
$nicdark_text_postquery_more = __('READ MORE','nicdark-shortcodes');
//end translate

//start filter
if ($atts['show_filter'] == 1) {

  $outputfilter = 'nicdark_filter'; 

  //build categories array
  $allcategories = array();
  while ( $the_query->have_posts() ) : $the_query->the_post();
    
    $category = get_the_category(); 
    $categoryname = $category[0]->cat_name;
    $categoryslug = $category[0]->category_nicename;

    $allcategories[] = $categoryslug ;

  endwhile;
  $uniquecategories = array_unique($allcategories);

  //all filter button and starter div
  $str .= '<div class="nicdark_masonry_btns"><div class="nicdark_margin10"><a data-filter="*" class="nicdark_bg_grey_hover nicdark_transition nicdark_btn nicdark_border_grey small   grey">'.$nicdark_text_postquery_all.'</a></div>';

  //output all categories buttons
  foreach($uniquecategories as $value){ 
      $categoryuniquename = get_category_by_slug($value);
      $str .= '<div class="nicdark_margin10"><a data-filter=".'.$value.'" class="nicdark_bg_grey_hover nicdark_transition nicdark_btn nicdark_border_grey small   grey">'.$categoryuniquename->cat_name.'</a></div>';
  }

  //closer div and spacer
  $str .= '<div class="nicdark_space10"></div></div>';

}
//end filter



$str .= '<div class="nicdark_masonry_container '.$outputfilter.'">';

while ( $the_query->have_posts() ) : $the_query->the_post();

	  
    $alldatas = redux_post_meta( 'redux_demo', $post_id );
	  $postcolor = $alldatas['metabox_posts_color'];
      
    //info post
    $titlepost = get_the_title();
    $excerptpost = get_the_excerpt();
    $permalink = get_permalink( $post_id );
    $categories = get_the_category(); 
    $categoryslug = $categories[0]->category_nicename;

    //comment
    $qntcomments = get_comments_number();
    $commentword = __("Comments","nicdark-shortcodes");
    if ( $qntcomments == 0 ){
      $outputcomments = __('No Comments','nicdark-shortcodes');
    }elseif ( $qntcomments == 1 ){
      $outputcomments = __('One Comment','nicdark-shortcodes');
    }else{
      $outputcomments = $qntcomments.' '.$commentword;
    }
    
      
    //image src
    $attachment_id = get_post_thumbnail_id( $post_id );
    $image_attributes = wp_get_attachment_image_src( $attachment_id, 'large' );
    if ( $image_attributes[0] == '' ) { $outputimagesrc = ''; }else{
      $outputimagesrc = '<div class="nicdark_featured_image"><img alt="" src="'.$image_attributes[0].'"></div>';
    }
    

    
    if ( $atts['post_grid_posts_layout'] == 'post_layout_1' ) {
      include 'layout_posts/layout_1.php';
    }elseif ( $atts['post_grid_posts_layout'] == 'post_layout_2' ) {
      include 'layout_posts/layout_2.php'; 
    }


endwhile;


$str .= '</div>';
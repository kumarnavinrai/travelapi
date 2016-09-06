<?php


$nicdark_text_search_date_from = __('From','lovetravel');
$nicdark_text_search_date_to = __('To','lovetravel');
$nicdark_text_search_keyword = __('Type Your Destination','lovetravel');
$nicdark_text_search_submit = __('SEARCH','lovetravel');

//find action link
$action = get_post_type_archive_link( ''.$posttype.'' );

$btncolor = 'green';


//generate taxonomy terms
function build_Select($tax,$bginput,$columns,$i,$getvalue){ 
  $terms = get_terms($tax);
  $the_tax = get_taxonomy($tax);
  $tax_name = $the_tax->labels->name;
  $x = '<input type="hidden" value="'.$tax.'" name="tax-'.$i.'"><select id="nicdark_select_'.$tax.'" name="'. $tax .'" class="nicdark_bg_'.$bginput.' nicdark_border_grey nicdark_radius_none grey medium subtitle">';
  $x .= '<option value="">'.__('ALL','lovetravel').' '. $tax_name .'</option>';
  foreach ($terms as $term) {

  	if ( $term->slug == $getvalue ){ $term_selected = 'selected'; }else{ $term_selected = ''; }

    $x .= '<option '.$term_selected.' value="' . $term->slug . '">' . $term->name . '</option>';  
  
  }
  $x .= '</select>';

  return $x;
}

?>







<div class="nicdark_space10"></div>
<form class="nicdark_advanced_search" action="<?php echo $action; ?>" method="GET">
	
	<input type="hidden" value="true" name="advsearch">
	<input type="hidden" value="<?php echo $posttype; ?>" name="posttype">
	<input id="nicdark_autocompletee" class="nicdark_bg_<?php echo $bginput; ?> grey medium subtitle" type="text" placeholder="<?php echo $nicdark_text_search_keyword; ?>" name="keyword" value="<?php echo $keyword; ?>">



	<?php

		$taxonomies = get_object_taxonomies($posttype);
	    $i = 0;
	    foreach($taxonomies as $tax){
	      $getvalue = $_GET[$tax];
	      echo build_Select($tax,$bginput,'_12',$i,$getvalue);
	      $i = $i + 1;
	    }

	?>



	<div class="nicdark_focus">
      <input class="nicdark_activity nicdark_width_percentage49 nicdark_bg_<?php echo $bginput; ?>  grey medium subtitle nicdark_calendar_range nicdark_calendar_from" placeholder="<?php echo $nicdark_text_search_date_from; ?>" name="date_from" type="text" value="<?php echo $_GET['date_from']; ?>">
      <input style="float:right;" class="nicdark_width_percentage49 nicdark_bg_<?php echo $bginput; ?>  grey medium subtitle nicdark_calendar_range nicdark_calendar_to" placeholder="<?php echo $nicdark_text_search_date_to; ?>" name="date_to" type="text" value="<?php echo $_GET['date_to']; ?>">
    </div>
	
	<div class="nicdark_margintop20 nicdark_bg_grey2 nicdark_slider_range nicdark_slider_range_<?php echo $btncolor; ?> nicdark_focus"></div>
	<div class="nicdark_space20"></div>
	<input name="price_from_to" class="nicdark_focus nicdark_bg_greydark grey subtitle medium  nicdark_slider_amount" type="text" value="">
	


	<input type="hidden" value="<?php echo $i; ?>" name="qnt-taxonomies">
	<input type="hidden" value="<?php echo $price_from; ?>" name="nicdark_price_from">
	<input type="hidden" value="<?php echo $price_to; ?>" name="nicdark_price_to">
	<input type="hidden" value="<?php echo $date_from; ?>" name="nicdark_date_from">
	<input type="hidden" value="<?php echo $date_to; ?>" name="nicdark_date_to">
	<input type="submit" value="<?php echo $nicdark_text_search_submit; ?>" class="nicdark_btn fullwidth nicdark_bg_<?php echo $btncolor; ?> ">


</form>
<div class="nicdark_space10"></div>




<?php
function nicdark_add_autocomplete() {

	$posttype = 'packages';

	//all packages title
	$allargs = array( 'post_type' => ''.$posttype.'', 'posts_per_page'=> -1 );
	$the_query = new WP_Query( $allargs );

	while ( $the_query->have_posts() ) : $the_query->the_post();
		$title_package = get_the_title();
		$string .= '"'.$title_package.'",';
	endwhile;

	wp_reset_postdata();
	//end all packages title


  echo '
  <script type="text/javascript">
    /* <![CDATA[ */

    jQuery(document).ready(function(){

    	var availablePackagess = ['.$string.' ""];

        jQuery("#nicdark_autocompletee").autocomplete({ source: availablePackagess });
    
    });

    /* ]]> */
  </script>
  ';
}
add_action('wp_footer', 'nicdark_add_autocomplete', 100);

?>








<?php 


define('WP_USE_THEMES', false);
require_once('../../../../../wp-load.php');


$nicdark_order = $_POST['order_choice']; //name, date, meta_value_num(price)
$nicdark_order_asc_desc = $_POST['nicdark_asc_desc'];
$nicdark_layout = $_POST['nicdark_layout']; 
$nicdark_paged = $_POST['nicdark_paged']; 

//recover datas
$posttype = $_POST['nicdark_posttype'];
$keyword = $_POST['nicdark_keyword'];
$date_from = $_POST['nicdark_date_from'];
$date_to = $_POST['nicdark_date_to'];
$price_from = $_POST['nicdark_price_from'];
$price_to = $_POST['nicdark_price_to'];

$taxonomy_1 = 'destination-package';
$taxonomy_2 = 'typology-package';
$taxonomy_3 = 'duration-package';
$taxonomy_4 = 'person-package';

$term_taxonomy_1 = $_POST['nicdark_destination_package'];
$term_taxonomy_2 = $_POST['nicdark_typology_package'];
$term_taxonomy_3 = $_POST['nicdark_duration_package'];
$term_taxonomy_4 = $_POST['nicdark_person_package'];
//end



if (empty ($posttype)) {   

    $nicdark_message = 'Error !';
    echo $nicdark_message;

}else{




	if ( $nicdark_order == 'price' ){ 

		//prepare the args
		$args = array(
		 'post_type' => ''.$posttype.'',
		 's' => ''.$keyword.'',
		 'orderby' => 'meta_value_num',
		 'meta_key' => 'metabox_package_price',
		 'order' => ''.$nicdark_order_asc_desc.'',

		 //pagination
		  'posts_per_page' => 9,
		  'paged' => $nicdark_paged,
		 
		 'meta_query' => array( 

			array( 
			'key' => 'metabox_package_date_from', 
			'value' => array($date_from,$date_to), /**must works with this format YYYYMMDD*/
			'type' => 'DATE',
			'compare' => 'BETWEEN'
			),

			array( 
			'key' => 'metabox_package_price', 
			'value' => array($price_from,$price_to), /**must works with this format YYYYMMDD*/
			'type' => 'NUMERIC',
			'compare' => 'BETWEEN'
			)
		 ),

		 ''.$taxonomy_1.'' => ''.$term_taxonomy_1.'',
		 ''.$taxonomy_2.'' => ''.$term_taxonomy_2.'',
		 ''.$taxonomy_3.'' => ''.$term_taxonomy_3.'',
		 ''.$taxonomy_4.'' => ''.$term_taxonomy_4.''
		);
		//end args


	}else{


		//prepare the args
		$args = array(
		 'post_type' => ''.$posttype.'',
		 's' => ''.$keyword.'',
		 'orderby' => ''.$nicdark_order.'',
		 'order' => ''.$nicdark_order_asc_desc.'',


		 //pagination
		  'posts_per_page' => 9,
		  'paged' => $nicdark_paged,
		  
		 
		 'meta_query' => array( 

			array( 
			'key' => 'metabox_package_date_from', 
			'value' => array($date_from,$date_to), /**must works with this format YYYYMMDD*/
			'type' => 'DATE',
			'compare' => 'BETWEEN'
			),

			array( 
			'key' => 'metabox_package_price', 
			'value' => array($price_from,$price_to), /**must works with this format YYYYMMDD*/
			'type' => 'NUMERIC',
			'compare' => 'BETWEEN'
			)
		 ),

		 ''.$taxonomy_1.'' => ''.$term_taxonomy_1.'',
		 ''.$taxonomy_2.'' => ''.$term_taxonomy_2.'',
		 ''.$taxonomy_3.'' => ''.$term_taxonomy_3.'',
		 ''.$taxonomy_4.'' => ''.$term_taxonomy_4.''
		);
		//end args
	

	}

	$the_query = new WP_Query( $args );


	
	$nicdark_message .= '<div class="nicdark_masonry_container">';



	//loop
	while ( $the_query->have_posts() ) : $the_query->the_post();

		//GET ALL DATAS
		$post_id = get_the_ID();

		//image src
		$attachment_id = get_post_thumbnail_id( $post_id );
		$image_attributes = wp_get_attachment_image_src( $attachment_id, 'large' );
		$outputimagesrc = 'background-image:url('.$image_attributes[0].');';

		//if price and currency are set
		if ($redux_demo['metabox_package_price'] == ''){ $outputpricecurrency = ''; 
		}else{ $outputpricecurrency = '<a href="'.$permalink.'" class="nicdark_btn nicdark_bg_'.$redux_demo['metabox_package_color'].' left white medium">'.$redux_demo['metabox_package_price'].' '.$redux_demo['metabox_package_currency'].'</a>';}

		//link
		if ($redux_demo['metabox_package_linkurl'] == '') { $permalink = get_permalink( $post_id );
		}else{ $permalink = $redux_demo['metabox_package_linkurl'];}

		//if button for grid
		if ($redux_demo['metabox_package_linktitle'] == '') { $outputbutton = '';
		}else{ $outputbutton = '<div class="nicdark_space20"></div><a href="'.$permalink.'" class="grey nicdark_btn nicdark_border_grey medium nicdark_press">'.$redux_demo['metabox_package_linktitle'].'</a>';}

		//if button for list
		if ($redux_demo['metabox_package_linktitle'] == '') { $outputbutton_list = '';
		}else{ $outputbutton_list = '<div class="nicdark_space20"></div><a href="'.$permalink.'" class="white nicdark_btn nicdark_border_white medium nicdark_press">'.$redux_demo['metabox_package_linktitle'].'</a>';}

		//if promotion
		$nicdark_translate_promotionribbon = __('SALE','lovetravel');
		if ($redux_demo['metabox_package_promotion'] == 0) { $outputpromotion = '';
		}else{ $outputpromotion = '<div class="nicdark_displaynone_ipadpotr nicdark_oblique45 nicdark_margintop20 nicdark_marginleft100_negative nicdark_focus nicdark_bg_greydark"><p class="center white">'.$nicdark_translate_promotionribbon.'</p></div>'; }

		//taxonomy terms
		$terms_destination_package = wp_get_post_terms( $post_id, 'destination-package', $args );
		$terms_typology_package = wp_get_post_terms( $post_id, 'typology-package', $args );
		$terms_person_package = wp_get_post_terms( $post_id, 'person-package', $args );
		$terms_duration_package = wp_get_post_terms( $post_id, 'duration-package', $args );
		// END GET ALL DATAS


		if ( $nicdark_layout == 'list' ){


			//START PREVIEW
			$nicdark_message .= '
			<div class="grid grid_12 percentage nicdark_masonry_item nicdark_padding10 nicdark_sizing">
			   

				<div class="nicdark_focus nicdark_bg_'.$redux_demo['metabox_package_color'].' nicdark_relative">
				
					<div class="nicdark_width_percentage30 nicdark_focus nicdark_displaynone_iphonepotr nicdark_displaynone_iphoneland">
						<div class="nicdark_space1"></div>
					</div>

					<div style="'.$outputimagesrc.' background-size:cover; background-position:center center;" class="nicdark_displaynone_iphonepotr nicdark_displaynone_iphoneland nicdark_overflow nicdark_bg_greydark nicdark_width_percentage30 nicdark_absolute_floatnone nicdark_height100percentage nicdark_focus">
						'.$outputpromotion.'
					</div>

					<div class="nicdark_width100_iphonepotr nicdark_width100_iphoneland nicdark_width_percentage50 nicdark_focus nicdark_bg_white nicdark_border_grey nicdark_sizing">
						<div class="nicdark_textevidence nicdark_bg_grey nicdark_borderbottom_grey">
							<h4 class="grey nicdark_margin20"><a href="'.$permalink.'" class="grey">'.get_the_title().'</a></h4>
						</div>
						<div class="nicdark_margin20">
							<p>'.$redux_demo['metabox_package_excerpt'].'</p>
							<div class="nicdark_space20"></div>
							<a title="';

							foreach ($terms_destination_package as $term_destination_package) { 
				            	$nicdark_message .= ''.$term_destination_package->name.' '; 
				             } 


							$nicdark_message .= '" class="nicdark_bg_grey_hover nicdark_tooltip nicdark_transition nicdark_btn_icon nicdark_border_grey small grey nicdark_margin05 nicdark_marginleft0"><i class="icon-direction"></i></a>
							<a title="';


							foreach ($terms_typology_package as $term_typology_package) { 
				            	$nicdark_message .= ''.$term_typology_package->name.' '; 
				             } 

							$nicdark_message .= '" class="nicdark_bg_grey_hover nicdark_tooltip nicdark_transition nicdark_btn_icon nicdark_border_grey small grey nicdark_margin05"><i class="icon-tree-1"></i></a>
							<a title="';


							foreach ($terms_duration_package as $term_duration_package) { 
				            	$nicdark_message .= ''.$term_duration_package->name.' '; 
				             } 

							$nicdark_message .= '" class="nicdark_bg_grey_hover nicdark_tooltip nicdark_transition nicdark_btn_icon nicdark_border_grey small grey nicdark_margin05"><i class="icon-calendar-2"></i></a>
							<a title="';

							foreach ($terms_person_package as $term_person_package) { 
				            	$nicdark_message .= ''.$term_person_package->name.' '; 
				             } 


							$nicdark_message .= '" class="nicdark_bg_grey_hover nicdark_tooltip nicdark_transition nicdark_btn_icon nicdark_border_grey small grey nicdark_margin05"><i class="icon-users-1"></i></a>
						</div>
					</div>

					<div class="nicdark_displaynone_iphonepotr nicdark_displaynone_iphoneland nicdark_width_percentage20 nicdark_height100percentage nicdark_absolute_floatnone right">
	                    <div class="nicdark_filter nicdark_display_table nicdark_height100percentage center">

	                        <div class="nicdark_cell nicdark_vertical_middle">
	                            <h1 class="white">'.$redux_demo['metabox_package_price'].'</h1>
	                            <div class="nicdark_space10"></div>
	                            <h4 class="white">'.$redux_demo['metabox_package_currency'].'</h4>
	                            '.$outputbutton_list.'
	                        </div>
	                        
	                    </div>
	                </div>

				</div>
			</div>
			';
			//END PREVIEW


		}else{



				//START PREVIEW
				$nicdark_message .= '

				<div class="grid grid_4 percentage nicdark_masonry_item nicdark_padding10 nicdark_sizing">
				   <div id="nicdark_package_'.$post_id.'" class="nicdark_archive1 nicdark_bg_white nicdark_border_grey nicdark_sizing ">


				       <!--start image-->
				       <div class="nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow">    

				           <img alt="" class="nicdark_focus nicdark_zoom_image" src="'.$image_attributes[0].'">

				           <!--price-->
				           <div class="nicdark_fadeout nicdark_absolute nicdark_height100percentage nicdark_width_percentage100">'.$outputpricecurrency.'</div>
				           <!--end price-->


				           <!--start content-->
				           <div class="nicdark_fadein nicdark_filter greydark nicdark_absolute nicdark_height100percentage nicdark_width_percentage100">
				               <div class="nicdark_absolute nicdark_display_table nicdark_height100percentage nicdark_width_percentage100">
				                   <div class="nicdark_cell nicdark_vertical_middle">
				                       <a href="'.$permalink.'" class="nicdark_btn nicdark_border_white white medium">'.$redux_demo['metabox_package_linktitle'].'</a>
				                   </div>   
				               </div>   
				           </div>
				           <!--end content-->

				       </div>
				       <!--end image-->


				       <div class="nicdark_textevidence nicdark_bg_'.$redux_demo['metabox_package_color'].'">
				           <h4 class="white nicdark_margin20">'.get_the_title().'</h4>
				       </div>

				       <div class="nicdark_focus nicdark_bg_greydark2">
				           <div class="nicdark_bg_greydark nicdark_focus nicdark_padding1020 nicdark_sizing nicdark_width_percentage50">
				               <p class="white"><i class="icon-direction"></i>';

				               foreach ($terms_destination_package as $term_destination_package) { 
				               	$nicdark_message .= ''.$term_destination_package->name.' '; 
				               } 


				               $nicdark_message .= '</p>
				           </div>
				           <div class="nicdark_focus nicdark_padding1020 nicdark_sizing nicdark_width_percentage50">
				               <p class="white"><i class="icon-info"></i>';

				               foreach ($terms_typology_package as $term_typology_package) { 
				               	$nicdark_message .= ''.$term_typology_package->name.' '; 
				               }

				               $nicdark_message .= '</p>
				           </div>
				       </div>
				       
				       <div class="nicdark_margin20"><p>'.$redux_demo['metabox_package_excerpt'].'</p>'.$outputbutton.'</div>

				   </div>

				</div>
				';
				//END PREVIEW



		}


		


	endwhile;
	//end loop


	wp_reset_postdata();

	$nicdark_message .= '</div>';

    echo $nicdark_message;
}



?>
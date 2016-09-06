<?php get_header(); ?>


<!--start header parallax image-->
<?php if ($redux_demo['archive_package_header_img_display'] == 1){ ?>

	<div class="nicdark_space100"></div>

	<section id="nicdark_archive_parallax" class="nicdark_section nicdark_imgparallax" style="background:url(<?php echo esc_url( $redux_demo['archive_package_header_img']['url'] ); ?>) 50% 0 fixed; background-size:cover;">

	    <div class="nicdark_filter <?php echo $redux_demo['archive_package_header_filter']; ?>">

	        <!--start nicdark_container-->
	        <div class="nicdark_container nicdark_clearfix">

	            <div class="grid grid_12">
	                <div class="nicdark_space<?php echo $redux_demo['archive_package_header_margintop']; ?>"></div>
	                <h1 class="white center subtitle"><?php echo $redux_demo['archive_package_header_title']; ?></h1>
	                <div class="nicdark_space20"></div>
	                <div class="nicdark_divider center big"><span class="nicdark_bg_white "></span></div>
	                <div class="nicdark_space<?php echo $redux_demo['archive_package_header_marginbottom']; ?>"></div>
	            </div>

	        </div>
	        <!--end nicdark_container-->

	    </div>
	     
	</section>

	<div class="nicdark_space50"></div>

	<script type="text/javascript">(function($) { "use strict"; $("#nicdark_archive_parallax").parallax("50%", 0.3); })(jQuery);</script>

<?php }else{ ?>

	<div class="nicdark_space160"></div>

<?php } ?>
<!--end header parallax image-->


<?php

if(isset($_GET['advsearch'])) { $advsearch = $_GET['advsearch']; } else { $advsearch = ''; }


//prepare the args query if came from search filter action
if ( $advsearch == 'true' ) { 

	//static
	$qnt_posts_per_page = 9;

	//START PASS ALL PARAMETER
	if(isset($_GET['posttype'])) { $posttype = $_GET['posttype']; } else { $posttype = ''; }
	if(isset($_GET['keyword'])) { $keyword = $_GET['keyword']; } else { $keyword = ''; }

	//all taxonomies
	$taxonomy_1 = 'destination-package';
	$taxonomy_2 = 'typology-package';
	$taxonomy_3 = 'duration-package';
	$taxonomy_4 = 'person-package';

	//all terms taxonomies
	$term_taxonomy_1 = $_GET['destination-package'];
	$term_taxonomy_2 = $_GET['typology-package'];
	$term_taxonomy_3 = $_GET['duration-package'];
	$term_taxonomy_4 = $_GET['person-package'];


	//date from
	if( $_GET['date_from'] == '' ) { 
		$date_from = '19850324';
	} else { 
		$date_from = date("Ymd", strtotime($_GET['date_from'])); 
	}

	//date to
	if( $_GET['date_to'] == '' ) { 
		$date_to = '20701221';
	} else { 
		$date_to = date("Ymd", strtotime($_GET['date_to'])); 
	}
	

	//price_from_to and split values
	if(isset($_GET['price_from_to'])) { $price_from_to = $_GET['price_from_to']; } else { $price_from_to = 0; }
	$price_from_to_1 = str_replace("$","",$_GET['price_from_to']);
	$prices = explode("-",$price_from_to_1);
	$price_from = $prices[0];
	$price_to = $prices[1];

	
	//check qnt taxonimies used in the search
	if(isset($_GET['qnt-taxonomies'])) { $qnt_taxonomies = $_GET['qnt-taxonomies']; } else { $qnt_taxonomies = 0; }
	//END PASS ALL PARAMETERS


	//PREPARE THE ARGS FOR THE WP QUERY
	$args = array(
	  'post_type' => ''.$posttype.'',
	  's' => ''.$keyword.'',
	  'orderby' => 'name',
	  'order' => 'ASC',
	  

	  //pagination
	  'posts_per_page' => $qnt_posts_per_page,
	  'paged' => $paged,
	  
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
	//END ARGS FOR WP QUERY
	
	$the_query = new WP_Query( $args ); 

	
	//pagination
	$qnt_results_posts = $the_query->found_posts;
	$qnt_pagination = ceil($qnt_results_posts / $qnt_posts_per_page);

	//translate
	$nicdark_translate_results = __('RESULTS FOUNDED','lovetravel');
	$nicdark_translate_sortby = __('SORT BY','lovetravel');
	$nicdark_translate_sortbyname = __('NAME','lovetravel');
	$nicdark_translate_sortbyprice = __('PRICE','lovetravel');
	$nicdark_translate_order = __('ORDER','lovetravel');
	$nicdark_translate_orderaz = __('A/Z - 1/3','lovetravel');
	$nicdark_translate_orderza = __('Z/A - 3/1','lovetravel');
	$nicdark_translate_viewas = __('VIEW AS','lovetravel');
	$nicdark_translate_viewasgrid = __('GRID','lovetravel');
	$nicdark_translate_viewaslist = __('LIST','lovetravel');


	?>


	<!--start section-->
	<section class="nicdark_section">

	    <!--start nicdark_container-->
	    <div class="nicdark_container nicdark_clearfix">

			<!--start right sidebar-->
			<div class="grid grid_3 percentage nicdark_width100_responsive">
				
				<!--start search-->
				<div class="nicdark_focus nicdark_padding10 nicdark_sizing">
					<div class="nicdark_archive1 nicdark_bg_white nicdark_border_grey nicdark_sizing ">

						<div class="nicdark_textevidence nicdark_bg_green">
							<h4 class="white nicdark_margin20"><?php echo $qnt_results_posts.' - '.$nicdark_translate_results; ?></h4>
						</div>

						<div class="nicdark_margin020">
							<?php include 'include/sidebars/search-packages.php'; ?>
						</div>

					</div>
				</div>
				<!--end search-->

			</div>
			<!--end right sidebar-->

			<!--start content-->
	        <div class="grid grid_9 percentage nicdark_width100_responsive">

	        	<div class="nicdark_focus nicdark_padding10 nicdark_sizing">

	        		<div class="nicdark_focus nicdark_padding10 nicdark_sizing nicdark_bg_greydark">
		        		
		        		<!--sort-->
		        		<div class="nicdark_activity nicdark_width100_iphonepotr nicdark_width100_iphoneland">
			        		<a class="white left nicdark_btn  small nicdark_padding1020"><?php echo $nicdark_translate_sortby; ?></a>
				        	<select id="nicdark_sort_feature" onchange="nicdark_sort()" name="nicdark_sort_feature" class="nicdark_padding0_left nicdark_width_initial nicdark_padding10 nicdark_bg_greydark  nicdark_radius_none grey small subtitle">
				        		<option value="name"><?php echo $nicdark_translate_sortbyname; ?></option>
				        		<option value="price"><?php echo $nicdark_translate_sortbyprice; ?></option>
				        	</select>
				        	<a class="grey left nicdark_btn  small nicdark_padding100 nicdark_marginright30 nicdark_cursor_initial"><i class="icon-angle-down"></i></a>
			        	</div>
			        	<!--end sort-->

			        	<a class="nicdark_displaynone_iphoneland nicdark_displaynone_iphonepotr greydark2 left nicdark_btn  small nicdark_padding100 nicdark_marginright10">|</a>

			        	
			        	<!--order-->
			        	<div class="nicdark_activity nicdark_width100_iphonepotr nicdark_width100_iphoneland">
			        		<a class="white left nicdark_btn  small nicdark_padding1020"><?php echo $nicdark_translate_order; ?></a>
			        		<select id="nicdark_asc_desc" onchange="nicdark_sort()" name="nicdark_asc_desc" class="nicdark_padding0_left nicdark_width_initial nicdark_padding10 nicdark_bg_greydark nicdark_radius_none grey small subtitle">
			        			<option value="ASC"><?php echo $nicdark_translate_orderaz; ?></option>
			        			<option value="DESC"><?php echo $nicdark_translate_orderza; ?></option>
			        		</select>
			        		<a class="grey left nicdark_btn  small nicdark_padding100 nicdark_marginright40 nicdark_cursor_initial"><i class="icon-angle-down"></i></a>
			        	</div>
			        	<!--end order-->
			        	
			        	
			        	<!--view-->
			        	<div class="nicdark_float_right nicdark_displaynone_iphonepotr nicdark_displaynone_iphoneland">
			        		<a class="grey right nicdark_btn  small nicdark_padding10 nicdark_cursor_initial"><i class="icon-th-large"></i></a>
			        		<select id="nicdark_layout" onchange="nicdark_sort()" name="nicdark_layout" class="nicdark_float_right nicdark_padding0_left nicdark_padding0_right nicdark_width_initial nicdark_padding10 nicdark_bg_greydark nicdark_radius_none grey small subtitle">
			        			<option value="grid"><?php echo $nicdark_translate_viewasgrid; ?></option>
			        			<option value="list"><?php echo $nicdark_translate_viewaslist; ?></option>
			        		</select>
			        		<a class="white right nicdark_btn  small nicdark_padding1020"><?php echo $nicdark_translate_viewas; ?></a>
			        	</div>
			        	<!--end view-->
			        	


		        	</div>

	        	</div>



	        	<!--start no results-->
	        	<?php $noresultstext = __('We colud not find any results for your search! Please try again :)','lovetravel'); ?>
				
				<?php echo ($the_query->found_posts > 0) ? '' : '
					<div class="nicdark_focus nicdark_padding10 nicdark_sizing">
						<div class="nicdark_alerts nicdark_bg_blue ">
						    <p class="white nicdark_size_medium"><i class="icon-cancel-circled-outline iconclose"></i>&nbsp;&nbsp;&nbsp;<strong>'.__('INFO','lovetravel').':</strong>&nbsp;&nbsp;&nbsp;'.$noresultstext.'</p>
						</div>
					</div>
				';?>
				<!--end no results-->

	        	<!--start nicdark_masonry_container-->
	        	<div class="nicdark_ajax_results">
			        <div class="nicdark_masonry_container">

						<?php
							while ( $the_query->have_posts() ) : $the_query->the_post();

								include 'include/package/archive-preview-package.php';
						
							endwhile;

							wp_reset_postdata();
						
						?>

					</div>
				</div>
		        <!--end nicdark_masonry_container-->


		        <!--start pagination-->
		        <div class="nicdark_focus nicdark_pagination center">
		        	<div class="nicdark_space30"></div>
			        <?php 
				        for ($i_pagination = 1; $i_pagination <= $qnt_pagination; $i_pagination++) {

				        	if ( $i_pagination == 1 ){ $nicdark_class_pagination_active = 'active'; } else { $nicdark_class_pagination_active = ''; }

				    		echo '<div onclick="nicdark_sort('.$i_pagination.')" class=" '.$nicdark_class_pagination_active.' nicdark_btn nicdark_margin10 medium nicdark_border_grey center">'.$i_pagination.'</div>';
						}
					?>
				</div>
		        <!--end pagination-->



	        </div>
	        <!--end content-->

	        <div class="nicdark_space50"></div>

		</div>
		<!--end container-->

	</section>
	<!--end section-->	


<?php } else { ?>



<!--start section-->
<section class="nicdark_section">

    <!--start nicdark_container-->
    <div class="nicdark_container nicdark_clearfix">

    	<!--start nicdark_masonry_container-->
        <div class="nicdark_masonry_container">
    	
    		<?php if(have_posts()) : ?>
						
				<?php while(have_posts()) : the_post(); ?>

					<?php include 'include/package/archive-preview-package.php'; ?>
						
				<?php endwhile; ?>
						
			
			<?php endif; ?>

		</div>
        <!--end nicdark_masonry_container-->

	</div>
	<!--end container-->

</section>
<!--end section-->


<!--start pagination-->
<div class="nicdark_section">

    <!--start nicdark_container-->
    <div class="nicdark_container nicdark_clearfix">

        <div class="nicdark_space40"></div>

        <div class="grid grid_6 nicdark_aligncenter_iphoneland nicdark_aligncenter_iphonepotr">
        	<?php previous_posts_link('PREV') ?>
        </div>
        <div class="grid grid_6 nicdark_aligncenter_iphoneland nicdark_aligncenter_iphonepotr">
        	<?php next_posts_link('NEXT') ?>
        </div>

        <div class="nicdark_space50"></div>

    </div>
    <!--end nicdark_container-->
            
</div>
<!--end pagination-->


<?php } ?>


<?php get_footer(); ?>
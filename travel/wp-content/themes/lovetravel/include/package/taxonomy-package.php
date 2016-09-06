<!--start header parallax image-->
<?php if ($redux_demo['archive_package_header_img_display'] == 1){ ?>

	<div class="nicdark_space100"></div>

	<section id="nicdark_archive_parallax" class="nicdark_section nicdark_imgparallax" style="background:url(<?php echo $redux_demo['archive_package_header_img']['url']; ?>) 50% 0 fixed; background-size:cover;">

	    <div class="nicdark_filter <?php echo $redux_demo['archive_package_header_filter']; ?>">

	        <!--start nicdark_container-->
	        <div class="nicdark_container nicdark_clearfix">

	            <div class="grid grid_12">
	                <div class="nicdark_space<?php echo $redux_demo['archive_package_header_margintop']; ?>"></div>
	                
	                <?php 
						$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
						$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
						$term_name = $term->name;
						$tax_name = $the_tax->labels->name;
					?>

	                <h1 class="white center subtitle"><?php echo $tax_name;  ?></h1><div class="nicdark_space10"></div><h3 class="subtitle center white"><?php echo $term_name;  ?></h3>

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


<!--start section-->
<section class="nicdark_section">

    <!--start nicdark_container-->
    <div class="nicdark_container nicdark_clearfix">

    	<!--start nicdark_masonry_container-->
        <div class="nicdark_masonry_container">

        	<?php 

			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$termname = $term->name;
			$taxmname = $term->taxonomy;

			$args = array(
				'post_type' => 'packages',
				
				//pagination
			  	'posts_per_page' => -1,

				''.$taxmname.'' => $termname
			);

			$the_query = new WP_Query( $args );

			while ( $the_query->have_posts() ) : $the_query->the_post();?>
 
				<?php include 'archive-preview-package.php'; ?>

			<?php endwhile; ?>

		</div>
        <!--end nicdark_masonry_container-->

        <div class="nicdark_space50"></div>

	</div>
	<!--end container-->

</section>
<!--end section-->

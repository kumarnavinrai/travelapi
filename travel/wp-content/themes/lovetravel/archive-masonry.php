<!--start nicdark_masonry_container-->
<div class="nicdark_masonry_container">

	<?php if(have_posts()) : ?>
				
		<?php while(have_posts()) : the_post(); ?>
			
			<!--prevew-->
			<div class="grid grid_4 nicdark_masonry_item">
			
				<!--#post-->
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="nicdark_textevidence nicdark_bg_<?php echo $redux_demo['metabox_posts_color']; ?>">
				            <h4 class="white nicdark_margin20"><?php the_title(); ?></h4>
				        </div>

						<!--START PREVIEW-->
						<?php if (has_post_thumbnail()): ?>
							<div class="nicdark_featured_image">
								<?php the_post_thumbnail('archive-image'); ?>
							</div>
						<?php endif ?>

			            <div class="nicdark_focus nicdark_bg_greydark2">
				            <div class="nicdark_bg_greydark nicdark_focus nicdark_padding1020 nicdark_sizing nicdark_width_percentage50">
				                <p class="white"><i class="icon-user"></i> <?php the_author(); ?> </p>
				            </div>
				            <div class="nicdark_focus nicdark_padding1020 nicdark_sizing nicdark_width_percentage50">
				                <p class="white"><i class="icon-chat"></i> <?php comments_number(__('No Comments','lovetravel'),__('One Comment','lovetravel'),__( '% Comments','lovetravel') );?> </p>
				            </div>
				        </div>
			            
			            <div class="nicdark_focus nicdark_border_grey nicdark_sizing nicdark_padding20">
			            	<p><?php the_excerpt(); ?></p>
			            	<div class="nicdark_space20"></div>
			            	<a class="nicdark_btn nicdark_press nicdark_bg_<?php echo $redux_demo['metabox_posts_color']; ?> white medium  " href="<?php the_permalink(); ?>"><?php _e('READ MORE','lovetravel'); ?></a>
						</div>
						<!--END PREVIEW-->

				</div>
				<!--#post-->

			</div>
			<!--preview-->


			<div class="nicdark_space50"></div>
				
				
		<?php endwhile; ?>
				
	<?php else: ?>
	
		<?php $nicdark_search_message = __('NOTHING FOUND: Search again','lovetravel'); ?>
	    <div class="nicdark_alerts nicdark_bg_orange  ">
	        <p class="white nicdark_size_big"><i class="icon-cancel-circled-outline iconclose"></i>&nbsp;&nbsp;&nbsp;<?php echo $nicdark_search_message; ?></p>
	        <i class="icon-warning-empty nicdark_iconbg right big orange"></i>
	    </div>

	<?php endif; ?>

</div>
<!--end nicdark_masonry_container-->
<?php if(have_posts()) :
	while(have_posts()) : the_post(); ?>
 
		
		<!--#post-->
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!--start content-->
            <p><?php the_content(); ?></p>
            <!--end content-->
				
		</div>
		<!--#post-->
	
	
	<?php endwhile; ?>
<?php endif; ?>
<!--link pagination-->
<div class="nicdark_focus">
    <?php $args = array(
		'before'           => '<p>' . __('Pages:', 'lovetravel'),
		'after'            => '</p>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'nextpagelink'     => __('Next page', 'lovetravel'),
		'previouspagelink' => __('Previous page', 'lovetravel'),
		'pagelink'         => '%',
		'echo'             => 1
	); ?>
    <div class="singlelinkpages">
		<?php wp_link_pages( $args ); ?>
    </div>
</div>
<!--end link pagination-->





<!--start author-->
<?php if ($redux_demo['metabox_pages_author'] == 1) { ?> 

	<div class="nicdark_space50"></div>
	<div class="nicdark_archive1 nicdark_bg_<?php echo $redux_demo['metabox_pages_color']; ?> nicdark_radius nicdark_shadow">
        <div class="nicdark_margin20 nicdark_relative">
            
            <div class="nicdark_img_avatar nicdark_displaynone_ipadpotr nicdark_displaynone_iphonepotr">   
            	<?php echo get_avatar( get_the_author_meta( 'ID' ), 240 ); ?>
        	</div>

            <div class="nicdark_activity nicdark_marginleft120 nicdark_disable_marginleft_ipadpotr nicdark_disable_marginleft_iphonepotr">
                <h4 class="white"><?php the_author(); ?></h4>                        
                <div class="nicdark_space20"></div>
                    <div class="nicdark_divider left small"><span class="nicdark_bg_white nicdark_radius"></span></div>
                <div class="nicdark_space20"></div>
                <p class="white"><?php the_author_meta('description'); ?></p>
            </div>

        </div>
    </div>
    <div class="nicdark_space50"></div>

<?php } ?>
<!--end author-->






<!--start comments-->
<?php if ($redux_demo['metabox_pages_comments'] == 1) { ?> 
	<?php comments_template(); ?>
<?php } ?>
<!--end comments-->	
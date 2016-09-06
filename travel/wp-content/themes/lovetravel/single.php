<?php get_header(); ?>

<?php $post_id = get_the_ID(); ?> 

<!--get all datas-->
<?php $all_post_datas = redux_post_meta( 'redux_demo', $post_id ); ?>


<!--start header parallax image-->
<?php if ($all_post_datas['metabox_posts_header_img_display'] == 1){ ?>

    <div class="nicdark_space100"></div>

    <section id="nicdark_singlepost_parallax" class="nicdark_section nicdark_imgparallax" style="background:url(<?php echo $all_post_datas['metabox_posts_header_img']['url']; ?>) 50% 0 fixed; background-size:cover;">

        <div class="nicdark_filter <?php echo $all_post_datas['metabox_posts_header_filter']; ?>">

            <!--start nicdark_container-->
            <div class="nicdark_container nicdark_clearfix">

                <div class="grid grid_12">
                    <div class="nicdark_space<?php echo $all_post_datas['metabox_posts_header_margintop']; ?>"></div>
                    <h1 class="white center subtitle"><?php echo $all_post_datas['metabox_posts_header_title']; ?></h1>
                    <div class="nicdark_space10"></div>
                    <h3 class="subtitle center white"><?php echo $all_post_datas['metabox_posts_header_description']; ?></h3>
                    <div class="nicdark_space20"></div>
                    <?php if ( $all_post_datas['metabox_posts_header_divider'] == 1 ){ ?> <div class="nicdark_divider center big"><span class="nicdark_bg_white nicdark_radius"></span></div> <?php } ?>
                    <div class="nicdark_space<?php echo $all_post_datas['metabox_posts_header_marginbottom']; ?>"></div>
                </div>

            </div>
            <!--end nicdark_container-->

        </div>
         
    </section>

    <script type="text/javascript">(function($) { "use strict"; $("#nicdark_singlepost_parallax").parallax("50%", 0.3); })(jQuery);</script>

<?php }else{ ?>

    <div class="nicdark_space160"></div>

<?php } ?>
<!--end header parallax image-->




<?php $nicdark_postlayout = $all_post_datas['layout_posts']; ?>

<!--FULL WIDTH PAGE-->
<?php if ($nicdark_postlayout == 0) { ?>

    <?php if(have_posts()) :
        while(have_posts()) : the_post(); ?>
            
            <!--#post-->
            <div style="float:left; width:100%;" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <!--first section-->
                <section class="nicdark_section"><div class="nicdark_container nicdark_clearfix"><div class="grid grid_12 percentage">
                    <div class="nicdark_archive1 nicdark_padding010" style="box-sizing:border-box;"><?php include 'include/post/post-info-1.php'; ?></div>
                </div></div></section>
                <!--end first section-->

                <!--start content-->
                <?php the_content(); ?>
                <!--end content-->

                <!--second section-->
                <section class="nicdark_section"><div class="nicdark_container nicdark_clearfix"><div class="grid grid_12 percentage">
                    <div class="nicdark_archive1 nicdark_padding010" style="box-sizing:border-box;"><?php include 'include/post/post-info-2.php'; ?></div>
                </div></div></section>
                <!--end second section-->
                
            </div>
            <!--#post-->
        
        <?php endwhile; ?>
    <?php endif; ?>

<?php } ?>


<!--RIGHT SIDEBAR PAGE PAGE-->
<?php if ($nicdark_postlayout == 1) { ?>

    <?php if(have_posts()) :
        while(have_posts()) : the_post(); ?>

            <div class="nicdark_space60"></div>
            <section class="nicdark_section">
                <div class="nicdark_container nicdark_clearfix">
                    <div class="grid grid_8 percentage nicdark_page_sidebar">
                        
                        <div class="nicdark_archive1 nicdark_padding010" style="box-sizing:border-box;"><?php include 'include/post/post-info-1.php'; ?></div>
                        
                        <!--start content-->
                        <?php the_content(); ?>
                        <!--end content-->

                        <div class="nicdark_archive1 nicdark_padding010" style="box-sizing:border-box;"><?php include 'include/post/post-info-2.php'; ?></div>
                    </div>
                    <div class="grid grid_4 percentage  nicdark_sidebar"><?php if ( ! dynamic_sidebar( ''.$redux_demo['metabox_posts_sidebar'].'' ) ) : ?><?php endif ?></div>
                </div>
            </section>
            <div class="nicdark_space50"></div>

        <?php endwhile; ?>
    <?php endif; ?>

<?php } ?>


<!--LEFT SIDEBAR PAGE PAGE-->
<?php if ($nicdark_postlayout == 2) { ?>

    <?php if(have_posts()) :
        while(have_posts()) : the_post(); ?>

            <div class="nicdark_space60"></div>
            <section class="nicdark_section">
                <div class="nicdark_container nicdark_clearfix">
                    <div class="grid grid_4 percentage  nicdark_sidebar"><?php if ( ! dynamic_sidebar( ''.$redux_demo['metabox_posts_sidebar'].'' ) ) : ?><?php endif ?></div>
                    <div class="grid grid_8 percentage nicdark_page_sidebar">
                        <div class="nicdark_archive1 nicdark_padding010" style="box-sizing:border-box;"><?php include 'include/post/post-info-1.php'; ?></div>
                        
                        <!--start content-->
                        <?php the_content(); ?>
                        <!--end content-->
                        
                        <div class="nicdark_archive1 nicdark_padding010" style="box-sizing:border-box;"><?php include 'include/post/post-info-2.php'; ?></div>
                    </div>
                </div>
            </section>
            <div class="nicdark_space50"></div>

        <?php endwhile; ?>
    <?php endif; ?>

<?php } ?>
        


<?php get_footer(); ?>
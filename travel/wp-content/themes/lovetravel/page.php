<?php get_header(); ?>


<!--start header parallax image-->
<?php if ($redux_demo['metabox_pages_header_img_display'] == 1){ ?>

    <div class="nicdark_space100"></div>

    <section id="nicdark_singlepage_parallax" class="nicdark_section nicdark_imgparallax" style="background:url(<?php echo esc_url( $redux_demo['metabox_pages_header_img']['url'] ); ?>) 50% 0 fixed; background-size:cover;">

        <div class="nicdark_filter <?php echo $redux_demo['metabox_pages_header_filter']; ?>">

            <!--start nicdark_container-->
            <div class="nicdark_container nicdark_clearfix">

                <div class="grid grid_12">
                    <div class="nicdark_space<?php echo $redux_demo['metabox_pages_header_margintop']; ?>"></div>
                    <h1 class="center white subtitle"><?php echo $redux_demo['metabox_pages_header_title']; ?></h1>
                    <div class="nicdark_space10"></div>
                    <h3 class="center subtitle white"><?php echo $redux_demo['metabox_pages_header_description']; ?></h3>
                    <div class="nicdark_space20"></div>
                    <?php if ( $redux_demo['metabox_pages_header_divider'] == 1 ){ ?> <div class="nicdark_divider center big"><span class="nicdark_bg_white "></span></div> <?php } ?>
                    <div class="nicdark_space<?php echo $redux_demo['metabox_pages_header_marginbottom']; ?>"></div>
                </div>

            </div>
            <!--end nicdark_container-->

        </div>
         
    </section>

    <script type="text/javascript">(function($) { "use strict"; $("#nicdark_singlepage_parallax").parallax("50%", 0.3); })(jQuery);</script>

<?php }else{ ?>

    <div class="nicdark_space160"></div>

<?php } ?>
<!--end header parallax image-->


<?php $nicdark_pagelayout = $redux_demo['layout_pages']; ?>


<!--FULL WIDTH PAGE-->
<?php if ($nicdark_pagelayout == 0) { ?>

    <?php if(have_posts()) :
        while(have_posts()) : the_post(); ?>
            
            <!--#post-->
            <div style="float:left; width:100%;" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <!--first section-->
                <section class="nicdark_section"><div class="nicdark_container nicdark_clearfix"><div class="grid grid_12 percentage">
                    <div class="nicdark_archive1 nicdark_padding010" style="box-sizing:border-box;"><?php include 'include/page/page-info-1.php'; ?></div>
                </div></div></section>
                <!--end first section-->

                <!--start content-->
                <?php the_content(); ?>
                <!--end content-->

                <!--second section-->
                <section class="nicdark_section"><div class="nicdark_container nicdark_clearfix"><div class="grid grid_12 percentage">
                    <div class="nicdark_archive1 nicdark_padding010" style="box-sizing:border-box;"><?php include 'include/page/page-info-2.php'; ?></div>
                </div></div></section>
                <!--end second section-->
                
            </div>
            <!--#post-->
        
        <?php endwhile; ?>
    <?php endif; ?>

<?php } ?>


<!--RIGHT SIDEBAR PAGE PAGE-->
<?php if ($nicdark_pagelayout == 1) { ?>

    <?php if(have_posts()) :
        while(have_posts()) : the_post(); ?>

            <div class="nicdark_space60"></div>
            <section class="nicdark_section">
                <div class="nicdark_container nicdark_clearfix">
                    <div class="grid grid_8 percentage nicdark_page_sidebar">
                        
                        <div class="nicdark_archive1 nicdark_padding010" style="box-sizing:border-box;"><?php include 'include/page/page-info-1.php'; ?></div>
                        
                        <!--start content-->
                        <?php the_content(); ?>
                        <!--end content-->

                        <div class="nicdark_archive1 nicdark_padding010" style="box-sizing:border-box;"><?php include 'include/page/page-info-2.php'; ?></div>
                    </div>
                    <div class="grid grid_4 percentage  nicdark_sidebar"><?php if ( ! dynamic_sidebar( ''.$redux_demo['metabox_pages_sidebar'].'' ) ) : ?><?php endif ?></div>
                </div>
            </section>
            <div class="nicdark_space50"></div>

        <?php endwhile; ?>
    <?php endif; ?>

<?php } ?>


<!--LEFT SIDEBAR PAGE PAGE-->
<?php if ($nicdark_pagelayout == 2) { ?>

    <?php if(have_posts()) :
        while(have_posts()) : the_post(); ?>

            <div class="nicdark_space60"></div>
            <section class="nicdark_section">
                <div class="nicdark_container nicdark_clearfix">
                    <div class="grid grid_4 percentage  nicdark_sidebar"><?php if ( ! dynamic_sidebar( ''.$redux_demo['metabox_pages_sidebar'].'' ) ) : ?><?php endif ?></div>
                    <div class="grid grid_8 percentage nicdark_page_sidebar">
                        <div class="nicdark_archive1 nicdark_padding010" style="box-sizing:border-box;"><?php include 'include/page/page-info-1.php'; ?></div>
                        
                        <!--start content-->
                        <?php the_content(); ?>
                        <!--end content-->
                        
                        <div class="nicdark_archive1 nicdark_padding010" style="box-sizing:border-box;"><?php include 'include/page/page-info-2.php'; ?></div>
                    </div>
                </div>
            </section>
            <div class="nicdark_space50"></div>

        <?php endwhile; ?>
    <?php endif; ?>

<?php } ?>
        


<?php get_footer(); ?>
<?php 

if (is_product()){

    include "single-product.php";

}else{


get_header(); ?>

<!--start header parallax image-->
<?php if ($redux_demo['archive_woocommerce_header_img_display'] == 1){ ?>

    <section id="nicdark_archive_parallax" class="nicdark_section nicdark_imgparallax" style="background:url(<?php echo $redux_demo['archive_woocommerce_header_img']['url']; ?>) 50% 0 fixed; background-size:cover;">

        <div class="nicdark_filter <?php echo $redux_demo['archive_woocommerce_header_filter']; ?>">

            <!--start nicdark_container-->
            <div class="nicdark_container nicdark_clearfix">

                <div class="grid grid_12">
                    <div class="nicdark_space<?php echo $redux_demo['archive_woocommerce_header_margintop']; ?>"></div>
                    
                    <h1 class="white center subtitle"><?php _e('TRAVEL WITH US','lovetravel'); ?></h1>

                    <div class="nicdark_space20"></div>
                    <div class="nicdark_divider center big"><span class="nicdark_bg_white"></span></div>
                    <div class="nicdark_space<?php echo $redux_demo['archive_woocommerce_header_marginbottom']; ?>"></div>
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


<!--first section-->
<section class="nicdark_section">
    <div class="nicdark_container nicdark_clearfix">
        <div class="grid grid_12">
    
            <!--start content-->
            <?php woocommerce_content(); ?>
            <!--end content-->

        </div>
    </div>
</section>
<!--end second section-->

<div class="nicdark_space50"></div>

                
<?php get_footer(); 

}

?>


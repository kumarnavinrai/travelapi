<!--start header parallax image-->
<?php if ($all_package_datas['metabox_package_header_img_display'] == 1){ ?>

    <div class="nicdark_space100"></div>

    <section id="nicdark_singlepackage_parallax" class="nicdark_section nicdark_imgparallax" style="background:url(<?php echo esc_url( $all_package_datas['metabox_package_header_img']['url'] ); ?>) 50% 0 fixed; background-size:cover;">

        <div class="nicdark_filter <?php echo $all_package_datas['metabox_package_header_filter']; ?>">

            <!--start nicdark_container-->
            <div class="nicdark_container nicdark_clearfix">

                <div class="grid grid_12">
                    <div class="nicdark_space<?php echo $all_package_datas['metabox_package_header_margintop']; ?>"></div>
                    <h1 class="white center subtitle"><?php echo $all_package_datas['metabox_package_header_title']; ?></h1>
                    <div class="nicdark_space10"></div>
                    <h3 class="subtitle center white"><?php echo $all_package_datas['metabox_package_header_description']; ?></h3>
                    <div class="nicdark_space20"></div>
                    <?php if ( $all_package_datas['metabox_package_header_divider'] == 1 ){ ?> <div class="nicdark_divider center big"><span class="nicdark_bg_white"></span></div> <?php } ?>
                    <div class="nicdark_space<?php echo $all_package_datas['metabox_package_header_marginbottom']; ?>"></div>
                </div>

            </div>
            <!--end nicdark_container-->

        </div>
         
    </section>

    <script type="text/javascript">(function($) { "use strict"; $("#nicdark_singlepackage_parallax").parallax("50%", 0.3); })(jQuery);</script>

<?php }else{ ?>

    <div class="nicdark_space160"></div>

<?php } ?>
<!--end header parallax image-->
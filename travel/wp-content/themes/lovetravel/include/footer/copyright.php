<!--start section-->
<div class="nicdark_section nicdark_bg_greydark2 ">

    <!--start nicdark_container-->
    <div class="nicdark_container nicdark_clearfix">

        <div class="grid grid_6 nicdark_aligncenter_iphoneland nicdark_aligncenter_iphonepotr">
            <div class="nicdark_space20"></div>

            <?php $copyright_left_content = __($redux_demo['copyright_left_content'],'lovetravel'); ?>
            <?php echo $copyright_left_content; ?>

        </div>


        <div class="grid grid_6">
            <div class="nicdark_focus right nicdark_aligncenter_iphoneland nicdark_aligncenter_iphonepotr">
                
                <?php $copyright_right_content = __($redux_demo['copyright_right_content'],'lovetravel'); ?>
                <?php echo $copyright_right_content; ?>

                <!--back to top-->
                <?php if ($redux_demo['copyright_backtotop'] == 1) { ?>

                    <div class="nicdark_margin10">
                        <a href="#start_nicdark_framework" class="nicdark_zoom nicdark_internal_link right nicdark_btn_icon nicdark_bg_greydark2 small nicdark_radius white"><i class="icon-up-open"></i></a>
                    </div>

                <?php } ?>
                <!--back to top-->

            </div>
        </div>

    </div>
    <!--end nicdark_container-->
            
</div>
<!--end section-->
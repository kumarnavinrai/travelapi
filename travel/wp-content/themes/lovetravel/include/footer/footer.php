<?php

$nicdark_footer_columns = $redux_demo['footer_columns'];

?>



<!--start section-->
<section class="nicdark_section nicdark_bg_greydark nicdark_dark_widgets">

    <!--start nicdark_container-->
    <div class="nicdark_container nicdark_clearfix">

        <div class="nicdark_space30"></div>

        <div class="grid grid_<?php echo $nicdark_footer_columns; ?> nomargin percentage">

            <div class="nicdark_space20"></div>

            <div class="nicdark_margin10">
                <?php dynamic_sidebar("footer-1"); ?>
            </div>
        </div>

        <div class="grid grid_<?php echo $nicdark_footer_columns; ?> nomargin percentage">

            <div class="nicdark_space20"></div>

            <div class="nicdark_margin10">
                <?php dynamic_sidebar("footer-2"); ?>
            </div>
        </div>

        <div class="grid grid_<?php echo $nicdark_footer_columns; ?> nomargin percentage">

            <div class="nicdark_space20"></div>

            <div class="nicdark_margin10">
                <?php dynamic_sidebar("footer-3"); ?>
            </div>
        </div>

        <div class="grid grid_<?php echo $nicdark_footer_columns; ?> nomargin percentage">

            <div class="nicdark_space20"></div>

            <div class="nicdark_margin10">
                <?php dynamic_sidebar("footer-4"); ?>
            </div>
        </div> 

        <div class="nicdark_space10"></div> 

    </div>
    <!--end nicdark_container-->
            
</section>
<!--end section-->
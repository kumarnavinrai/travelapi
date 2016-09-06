<?php

$str .= '

<!--start preview-->
<div id="'.$post_id.'" class="grid '.$atts['post_grid_columns'].' percentage nicdark_masonry_item nicdark_padding10 nicdark_sizing">
    <div class="nicdark_archive1 nicdark_bg_white nicdark_border_grey nicdark_sizing ">


        <!--start image-->
        <div class="nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow">    

            <img alt="" class="nicdark_focus nicdark_zoom_image" src="'.$image_attributes[0].'">

            
            <!--price-->
            <div class="nicdark_fadeout nicdark_absolute nicdark_height100percentage nicdark_width_percentage100">  
                '.$outputpricecurrency.'
            </div>
            <!--end price-->


            <!--start content-->
            <div class="nicdark_fadein nicdark_filter greydark nicdark_absolute nicdark_height100percentage nicdark_width_percentage100">
                <div class="nicdark_absolute nicdark_display_table nicdark_height100percentage nicdark_width_percentage100">
                    <div class="nicdark_cell nicdark_vertical_middle">
                        <a href="'.$permalink.'" class="nicdark_btn nicdark_border_white white medium">'.$alldatas['metabox_package_linktitle'].'</a>
                    </div>   
                </div>   
            </div>
            <!--end content-->

        </div>
        <!--end image-->


        <div class="nicdark_textevidence nicdark_bg_greydark">
            <h4 class="white nicdark_margin20">'.get_the_title().'</h4>
        </div>


    </div>
</div>
<!--end prev-->

';
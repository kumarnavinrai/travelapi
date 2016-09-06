<?php

$str .= '

<!--start preview-->
<div id="'.$post_id.'" class="grid '.$atts['post_grid_columns'].' percentage nicdark_masonry_item nicdark_padding10 nicdark_sizing">
    <div class="nicdark_archive1 nicdark_bg_white nicdark_border_grey nicdark_sizing ">


        '.$outputallimage.'


        <div class="nicdark_textevidence nicdark_bg_greydark">
            <h4 class="white nicdark_margin20">'.get_the_title().'</h4>
        </div>


        <div class="nicdark_focus nicdark_bg_'.$alldatas['metabox_package_color'].'">
            <div class="nicdark_bg_'.$alldatas['metabox_package_color'].'dark nicdark_focus nicdark_padding1020 nicdark_sizing nicdark_width_percentage50">
                <p class="white"><i class="icon-direction"></i>';

                foreach ($terms_destination_package as $term_destination_package) { $str .= ' '.$term_destination_package.' ';  }

                $str .= '</p>
            </div>
            <div class="nicdark_focus nicdark_padding1020 nicdark_sizing nicdark_width_percentage50">
                <p class="white"><i class="icon-info"></i>';

                foreach ($terms_typology_package as $term_typology_package) { $str .= ' '.$term_typology_package.' ';  }

                $str .= '</p>
            </div>
        </div>
        
        <div class="nicdark_margin20">
            <p>'.$alldatas['metabox_package_excerpt'].'</p>
            '.$outputbutton.'
        </div>

    </div>
</div>
<!--end prev-->

';
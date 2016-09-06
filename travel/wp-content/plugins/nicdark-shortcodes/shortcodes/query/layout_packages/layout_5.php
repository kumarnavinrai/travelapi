<?php


$str .= '


<div id="'.$post_id.'" class="grid '.$atts['post_grid_columns'].' percentage nicdark_masonry_item nicdark_padding10 nicdark_sizing">
               

    <div class="nicdark_focus nicdark_bg_'.$alldatas['metabox_package_color'].' nicdark_relative">

        <div class="nicdark_focus nicdark_displaynone_desktop nicdark_displayblock_iphonepotr nicdark_displayblock_iphoneland nicdark_displayblock_ipadpotr nicdark_displayblock_ipadland">
            '.$outputallimage.'
        </div>

        <div class="nicdark_displaynone_responsive nicdark_width_percentage40 nicdark_focus">
            <div class="nicdark_space1"></div>
        </div>

        <div style="background-image:url('.$image_attributes[0].'); background-size:cover; background-position:center center;" class="nicdark_displaynone_responsive nicdark_overflow nicdark_bg_greydark nicdark_width_percentage40 nicdark_absolute_floatnone nicdark_height100percentage nicdark_focus">
            '.$outputpromotion.'
        </div>

        <div class="nicdark_width100_responsive nicdark_width_percentage60 nicdark_focus nicdark_bg_white nicdark_border_grey nicdark_sizing">
            <div class="nicdark_textevidence nicdark_bg_grey nicdark_borderbottom_grey">
                <h4 class="grey nicdark_margin20"><a href="'.$permalink.'" class="grey">'.get_the_title().'</a></h4>
            </div>
            <div class="nicdark_margin20 nicdark_displaynone_responsive">
                <p>'.$alldatas['metabox_package_price'].' '.$alldatas['metabox_package_currency'].'</p>
            </div>
        </div>

    </div>
</div>








';
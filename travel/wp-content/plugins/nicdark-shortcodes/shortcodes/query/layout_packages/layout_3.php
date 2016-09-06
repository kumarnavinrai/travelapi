<?php


$str .= '


<div id="'.$post_id.'" class="grid '.$atts['post_grid_columns'].' percentage nicdark_masonry_item nicdark_padding10 nicdark_sizing">
               

    <div class="nicdark_focus nicdark_bg_'.$alldatas['metabox_package_color'].' nicdark_relative">

        <div class="nicdark_focus nicdark_displaynone_desktop nicdark_displayblock_iphonepotr nicdark_displayblock_iphoneland nicdark_displayblock_ipadpotr nicdark_displayblock_ipadland">
            '.$outputallimage.'
        </div>

        <div class="nicdark_displaynone_responsive nicdark_width_percentage30 nicdark_focus">
            <div class="nicdark_space1"></div>
        </div>

        <div style="background-image:url('.$image_attributes[0].'); background-size:cover; background-position:center center;" class="nicdark_displaynone_responsive nicdark_overflow nicdark_bg_greydark nicdark_width_percentage30 nicdark_absolute_floatnone nicdark_height100percentage nicdark_focus">
            '.$outputpromotion.'
        </div>

        <div class="nicdark_width100_responsive nicdark_width_percentage50 nicdark_focus nicdark_bg_white nicdark_border_grey nicdark_sizing">
            <div class="nicdark_textevidence nicdark_bg_grey nicdark_borderbottom_grey">
                <h4 class="grey nicdark_margin20">'.get_the_title().'</h4>
            </div>
            <div class="nicdark_margin20">
                <p>'.$alldatas['metabox_package_excerpt'].'</p>
                <div class="nicdark_space20"></div>
                <a title="';

                    foreach ($terms_destination_package as $term_destination_package) { $str .= ' '.$term_destination_package.' ';  }

                $str .= '" class="nicdark_bg_grey_hover nicdark_tooltip nicdark_transition nicdark_btn_icon nicdark_border_grey small grey nicdark_margin05 nicdark_marginleft0"><i class="icon-direction"></i></a>
                <a title="';

                    foreach ($terms_typology_package as $term_typology_package) { $str .= ' '.$term_typology_package.' ';  }

                $str .= '" class="nicdark_bg_grey_hover nicdark_tooltip nicdark_transition nicdark_btn_icon nicdark_border_grey small grey nicdark_margin05"><i class="icon-tree-1"></i></a>
                <a title="';

                    foreach ($terms_person_package as $term_person_package) { $str .= ' '.$term_person_package.' ';  }

                $str .= '" class="nicdark_bg_grey_hover nicdark_tooltip nicdark_transition nicdark_btn_icon nicdark_border_grey small grey nicdark_margin05"><i class="icon-users-1"></i></a>
                <a title="';

                    foreach ($terms_duration_package as $term_duration_package) { $str .= ' '.$term_duration_package.' ';  }

                $str .= '" class="nicdark_bg_grey_hover nicdark_tooltip nicdark_transition nicdark_btn_icon nicdark_border_grey small grey nicdark_margin05"><i class="icon-calendar-2"></i></a>
            </div>
        </div>

        <div class="nicdark_displaynone_responsive nicdark_width_percentage20 nicdark_height100percentage nicdark_absolute_floatnone right">
            <div class="nicdark_filter nicdark_display_table nicdark_height100percentage center">

                <div class="nicdark_cell nicdark_vertical_middle">
                    <h1 class="white">'.$alldatas['metabox_package_price'].'</h1>
                    <div class="nicdark_space10"></div>
                    <h4 class="white">'.$alldatas['metabox_package_currency'].'</h4>
                    '.$outputbutton.'
                </div>
                
            </div>
        </div>

    </div>
</div>








';
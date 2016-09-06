<?php

$str .= '

    <div style="box-sizing:border-box;" class="grid '.$atts['post_grid_columns'].' percentage nicdark_padding10 nicdark_masonry_item '; 

    foreach($categories as $category) {
      $str .= ' '.$category->category_nicename.' ';
    }

    $str .= '">
      

        <div class="nicdark_textevidence nicdark_bg_'.$postcolor.'">
            <h4 class="white nicdark_margin20">'.$titlepost.'</h4>
        </div>
        '.$outputimagesrc.'
        <div class="nicdark_focus nicdark_border_grey nicdark_sizing nicdark_padding20">
            <p>'.do_shortcode($excerptpost).'</p>
            <div class="nicdark_space20"></div>
            <a class="nicdark_btn nicdark_press nicdark_bg_'.$postcolor.' white medium  " href="'.$permalink.'">'.$nicdark_text_postquery_more.'</a>
        </div>

      
    </div>

';












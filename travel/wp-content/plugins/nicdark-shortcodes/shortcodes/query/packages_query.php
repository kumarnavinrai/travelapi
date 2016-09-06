<?php



$str .= '<div class="nicdark_masonry_container">';

while ( $the_query->have_posts() ) : $the_query->the_post();

    
      $post_id = get_the_ID();

      $alldatas = redux_post_meta( 'redux_demo', $post_id );
      
      //info post
      $titlepost = get_the_title();
      $excerptpost = get_the_excerpt();

      //image src
      $attachment_id = get_post_thumbnail_id( $post_id );
      $image_attributes = wp_get_attachment_image_src( $attachment_id, 'large' );
      $outputimagesrc = 'background:url('.$image_attributes[0].');';


      //if promotion
      $nicdark_translate_promotionribbon = __('SALE','nicdark-shortcodes');
      if ($alldatas['metabox_package_promotion'] == 0) { $outputpromotion = '';
      }else{ $outputpromotion = '<div class="nicdark_oblique45 nicdark_margintop20 nicdark_marginleft100_negative nicdark_focus nicdark_bg_greydark"><p class="center white">'.$nicdark_translate_promotionribbon.'</p></div>'; }

      //if price and currency are set
      if ($alldatas['metabox_package_price'] == ''){ 
          $outputpricecurrency = ''; 
      }elseif ( $atts['post_grid_packages_layout'] == 'packages_layout_4' ){
          $outputpricecurrency = '<a href="'.$permalink.'" class="nicdark_btn nicdark_bg_white left grey medium">'.$alldatas['metabox_package_price'].' '.$alldatas['metabox_package_currency'].'</a>';   
      }else{  
          $outputpricecurrency = '<a href="'.$permalink.'" class="nicdark_btn nicdark_bg_'.$alldatas['metabox_package_color'].' left white medium">'.$alldatas['metabox_package_price'].' '.$alldatas['metabox_package_currency'].'</a>';
      }


      //link
      if ($alldatas['metabox_package_linkurl'] == '') {

          $permalink = get_permalink( $post_id );

      }else{

          $permalink = $alldatas['metabox_package_linkurl'];

      }


      //pop up
      if ($alldatas['metabox_package_popup_btn'] == 0)  {

          $nicdark_popup_btn = '';

      }else{

        $nicdark_popup_btn = '<a href="#nicdark_window_popup_'.$post_id.'" class="nicdark_mpopup_window nicdark_marginleft10 grey nicdark_btn nicdark_border_grey medium nicdark_outline "><i class="'.$alldatas['metabox_package_popup_btn_icon'].'"></i></a>

          <!--start pop up window-->
          <div id="nicdark_window_popup_'.$post_id.'" class="nicdark_bg_'.$alldatas['metabox_package_popup_style'].' nicdark_window_popup zoom-anim-dialog mfp-hide">
               <div class="nicdark_textevidence nicdark_bg_'.$alldatas['metabox_package_color'].'">
                    <div class="nicdark_margin20">
                        <h4 class="white">'.$alldatas['metabox_package_popup_title'].'</h4>
                    </div>
                </div>

                '.do_shortcode($alldatas["metabox_package_popup_content"]).'  
          </div>
          <!--end pop up window-->

        ';

      }



      //if button
      if ($alldatas['metabox_package_linktitle'] == '') {

          $outputbutton = '';

      }elseif ( $atts['post_grid_packages_layout'] == 'packages_layout_1' || $atts['post_grid_packages_layout'] == 'packages_layout_4' ){

              $outputbutton = '<div class="nicdark_space20"></div><a href="'.$permalink.'" class="nicdark_border_grey grey nicdark_btn nicdark_outline medium ">'.$alldatas['metabox_package_linktitle'].'</a> '.$nicdark_popup_btn.' ';
          
          }elseif ( $atts['post_grid_packages_layout'] == 'packages_layout_3' ) {

            $outputbutton = '<div class="nicdark_space20"></div><a href="'.$permalink.'" class="nicdark_border_white white nicdark_btn nicdark_outline medium ">'.$alldatas['metabox_package_linktitle'].'</a>';

          }



      //taxonomy terms
      $terms_destination_package = wp_get_post_terms( $post_id, 'destination-package', array("fields" => "names") );
      $terms_typology_package = wp_get_post_terms( $post_id, 'typology-package', array("fields" => "names") );
      $terms_person_package = wp_get_post_terms( $post_id, 'person-package', array("fields" => "names") );
      $terms_duration_package = wp_get_post_terms( $post_id, 'duration-package', array("fields" => "names") );

      //if iframe is set
      if ( $alldatas['metabox_package_iframe'] != '' ){

        $outputallimage = '
          <div class="nicdark_focus nicdark_relative nicdark_overflow"> 
           
            <!--price-->
            <div class="nicdark_absolute">  
                '.$outputpricecurrency.'
            </div>
            <!--end price-->

            '.$alldatas['metabox_package_iframe'].'

          </div>';

      }else{

        $outputallimage = '<!--start image-->
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
        <!--end image-->';

      }

      
      if ( $atts['post_grid_packages_layout'] == 'packages_layout_1' ) {
        include 'layout_packages/layout_1.php';
      }elseif ( $atts['post_grid_packages_layout'] == 'packages_layout_2' ) {
        include 'layout_packages/layout_2.php'; 
      }elseif ( $atts['post_grid_packages_layout'] == 'packages_layout_3' ) {
        include 'layout_packages/layout_3.php'; 
      }elseif ( $atts['post_grid_packages_layout'] == 'packages_layout_4' ) {
        include 'layout_packages/layout_4.php'; 
      }elseif ( $atts['post_grid_packages_layout'] == 'packages_layout_5' ) {
        include 'layout_packages/layout_5.php'; 
      }


endwhile;


$str .= '</div>';
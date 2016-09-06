<?php 

$post_id = get_the_ID();

//image src
$attachment_id = get_post_thumbnail_id( $post_id );
$image_attributes = wp_get_attachment_image_src( $attachment_id, 'large' );
$outputimagesrc = 'background:url('.$image_attributes[0].');';

//if price and currency are set
if ($redux_demo['metabox_package_price'] == ''){ 
    $outputpricecurrency = ''; 
}else{  
    $outputpricecurrency = '<a href="'.$permalink.'" class="nicdark_btn nicdark_bg_'.$redux_demo['metabox_package_color'].' left white medium">'.$redux_demo['metabox_package_price'].' '.$redux_demo['metabox_package_currency'].'</a>';
}

//link
if ($redux_demo['metabox_package_linkurl'] == '') {

    $permalink = get_permalink( $post_id );

}else{

    $permalink = $redux_demo['metabox_package_linkurl'];

}

//if button
if ($redux_demo['metabox_package_linktitle'] == '') {

    $outputbutton = '';

}else{

    $outputbutton = '<div class="nicdark_space20"></div><a href="'.$permalink.'" class="grey nicdark_btn nicdark_border_grey medium nicdark_press">'.$redux_demo['metabox_package_linktitle'].'</a>';

}

//taxonomy terms
$terms_destination_package = wp_get_post_terms( $post_id, 'destination-package', $args );
$terms_typology_package = wp_get_post_terms( $post_id, 'typology-package', $args );


?>




<!--start preview-->
<div class="grid grid_4 percentage nicdark_masonry_item nicdark_padding10 nicdark_sizing">
    <div class="nicdark_archive1 nicdark_bg_white nicdark_border_grey nicdark_sizing ">


        <!--start image-->
        <div class="nicdark_focus nicdark_relative nicdark_fadeinout nicdark_overflow">    

            <img alt="" class="nicdark_focus nicdark_zoom_image" src="<?php echo $image_attributes[0]; ?>">

            
            <!--price-->
            <div class="nicdark_fadeout nicdark_absolute nicdark_height100percentage nicdark_width_percentage100">  
                <?php echo $outputpricecurrency; ?>
            </div>
            <!--end price-->


            <!--start content-->
            <div class="nicdark_fadein nicdark_filter greydark nicdark_absolute nicdark_height100percentage nicdark_width_percentage100">
                <div class="nicdark_absolute nicdark_display_table nicdark_height100percentage nicdark_width_percentage100">
                    <div class="nicdark_cell nicdark_vertical_middle">
                        <a href="<?php echo $permalink; ?>" class="nicdark_btn nicdark_border_white white medium"><?php echo $redux_demo['metabox_package_linktitle']; ?></a>
                    </div>   
                </div>   
            </div>
            <!--end content-->

        </div>
        <!--end image-->

        <div class="nicdark_textevidence nicdark_bg_<?php echo $redux_demo['metabox_package_color']; ?>">
            <h4 class="white nicdark_margin20"><?php the_title(); ?></h4>
        </div>

        <div class="nicdark_focus nicdark_bg_greydark2">
            <div class="nicdark_bg_greydark nicdark_focus nicdark_padding1020 nicdark_sizing nicdark_width_percentage50">
                <p class="white"><i class="icon-direction"></i> <?php foreach ($terms_destination_package as $term_destination_package) { echo $term_destination_package->name.' '; } ?></p>
            </div>
            <div class="nicdark_focus nicdark_padding1020 nicdark_sizing nicdark_width_percentage50">
                <p class="white"><i class="icon-info"></i> <?php foreach ($terms_typology_package as $term_typology_package) { echo $term_typology_package->name.' '; } ?></p>
            </div>
        </div>
        
        <div class="nicdark_margin20">
            <p><?php echo $redux_demo['metabox_package_excerpt']; ?></p>
            <?php echo $outputbutton; ?>
        </div>

    </div>
</div>
<!--end prev-->









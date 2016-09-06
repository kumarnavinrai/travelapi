<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $idsection = $filter = $imgparallax = $srcparallax = $idparallax = $font_color = $padding = $margin_bottom = $css = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'imgparallax'     => '',
    'idsection'       => '',
    'idparallax'      => '',
    'srcparallax'     => '',
    'filter'          => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'row_style'   => 'container',
    'css' => ''
), $atts));

// wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

//if parallax
$outputimgparallax = ( $imgparallax == 'yes' ) ? ' nicdark_imgparallax ' : '';
$imgsrc = wp_get_attachment_image_src($srcparallax,'full');
$outputidparallax = ( $idparallax != '' ) ? 'style="background:url('.$imgsrc[0].') 50% 0 fixed; background-size:cover;" id="'.$idparallax.'" ' : '';
$outputidsection = ( $idparallax == '' ) ? ' id="'.$idsection.'" ' : '';
$script = ( $imgparallax == 'yes' ) ? ' <script type="text/javascript">(function($) { "use strict"; jQuery(window).load(function() { $("#'.$idparallax.'").parallax("50%", 0.3); }) })(jQuery);</script> ' : '';
$startfilter = ( $imgparallax == 'yes' ) ? '<div class="nicdark_filter '.$filter.'">' : '';
$endfilter = ( $imgparallax == 'yes' ) ? '</div>' : '';


$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);


if ( $row_style == 'container' ) {

	$output .= '<section '.$outputidsection.' '.$outputidparallax.' class="nicdark_section '.$outputimgparallax.' '.$css_class.'"'.$style.'>'.$startfilter.'<div class="nicdark_container nicdark_vc nicdark_clearfix">';
    $output .= wpb_js_remove_wpautop($content);
    $output .= '</div>'.$endfilter.'</section> '.$script.' '.$this->endBlockComment('row');

}else{

	$output .= '<section '.$outputidsection.' '.$outputidparallax.' class="nicdark_section '.$outputimgparallax.' '.$css_class.'"'.$style.'>'.$startfilter.'';
	$output .= wpb_js_remove_wpautop($content);
	$output .= ''.$endfilter.'</section> '.$script.' '.$this->endBlockComment('row');

}




echo $output;
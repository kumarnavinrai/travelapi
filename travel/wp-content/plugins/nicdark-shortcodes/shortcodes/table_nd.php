<?php

/////////////////////////////////////////////////////////TABLE/////////////////////////////////////////
add_shortcode('table_nd', 'nicdark_shortcode_table');
function nicdark_shortcode_table($atts, $content = null)
{	

	$atts = shortcode_atts(
		array(
			'content' => ''
		), $atts);

  $str = '';
		
   $str .= wpb_js_remove_wpautop($content, true);

	return apply_filters('uds_shortcode_out_filter', $str);
}

//vc
add_action( 'vc_before_init', 'nicdark_table' );
function nicdark_table() {
   vc_map( array(
      "name" => __( "Table", "nicdark-shortcodes" ),
      "base" => "table_nd",
      'holder' => 'div',
      'description' => __( 'Add Custom Table', 'nicdark-shortcodes' ),
      "icon" => get_template_directory_uri() . "/vc_extend/table.png",
      "class" => "",
      "category" => __( "Nicdark Shortcodes", "nicdark-shortcodes"),
      "params" => array(
         array(
            "type" => "textarea_html",
            "class" => "",
            "heading" => __( "Table", "nicdark-shortcodes" ),
            "param_name" => "content",
            "value" => __( "<div class='nicdark_archive1 nicdark_bg_grey  left overflow_scroll'>   
    <table class='nicdark_table extrabig nicdark_bg_yellow'>
        <thead class='nicdark_border_yellow'>
            <tr>
                <td class='nicdark_width_percentage1'><h4 class='white'>#</h4></td>
                <td><h4 class='white'>FIRST</h4></td>
                <td><h4 class='white'>SECOND</h4></td>
                <td><h4 class='white'>THIRD</h4></td>
            </tr>
        </thead>
        <tbody class='nicdark_bg_grey nicdark_border_grey'>
            <tr>
                <td><h5 class='grey subtitle'>1</h5></td>
                <td><h5 class='grey subtitle'>Mark</h5></td>
                <td><h5 class='grey subtitle'>Otto</h5></td>
                <td><h5 class='grey subtitle'>@mdo</h5></td>
            </tr>
            <tr>
                <td><h5 class='grey subtitle'>2</h5></td>
                <td><h5 class='grey subtitle'>Jacob</h5></td>
                <td><h5 class='grey subtitle'>Thornton</h5></td>
                <td><h5 class='grey subtitle'>@fat</h5></td>
            </tr>
            <tr>
                <td><h5 class='grey subtitle'>3</h5></td>
                <td><h5 class='grey subtitle'>Larry</h5></td>
                <td><h5 class='grey subtitle'>the Bird</h5></td>
                <td><h5 class='grey subtitle'>@twitter</h5></td>
            </tr>
        </tbody>
    </table>
</div>", "nicdark-shortcodes" ),
            "description" => __( "Change source code for edit the style", "nicdark-shortcodes" )
         )
      )
   ) );
}
//end shortcode table
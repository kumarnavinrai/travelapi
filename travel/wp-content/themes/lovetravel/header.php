<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
 
    <meta charset="<?php bloginfo('charset'); ?>"> 
	    
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta name="author" content="Love Travel">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--meta responsive-->
    
    <!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/main/html5.js"></script>
	<![endif]-->

    <?php global $redux_demo; ?>
    
    <?php include "include/header/favicons.php"; ?>
	
<?php wp_head(); ?>	  
</head>  
<body style="" id="start_nicdark_framework" <?php body_class(); ?>>

<!--start preloader-->

<!--end preloader-->

<div style="" class="nicdark_site">

	<?php if ($redux_demo['general_boxed'] == 0) { ?> <div class="nicdark_site_fullwidth_boxed nicdark_site_fullwidth nicdark_clearfix"> <?php } else { ?> <div class="nicdark_site_fullwidth_boxed nicdark_site_boxed nicdark_clearfix"> <?php }; ?>
    
    	<div class="nicdark_overlay"></div>

    	<!--start left right sidebar open-->
		<?php if ($redux_demo['header_left_sidebar'] == 1) { include "include/sidebars/left-sidebar-open.php"; } else {}; ?>
		<?php if ($redux_demo['header_right_sidebar'] == 1) { include "include//sidebars/right-sidebar-open.php"; } else {}; ?>
		<!--end left right sidebar open-->    	

		<div class="nicdark_section nicdark_navigation nicdark_upper_level2">
		    
		    <!--decide fullwidth or boxed header-->
			<?php if ($redux_demo['header_boxed'] == 1) { ?> <div class='nicdark_menu_fullwidth_boxed nicdark_menu_boxed'> <?php }else{ ?> <div class='nicdark_menu_fullwidth_boxed nicdark_menu_fullwidth'> <?php } ?>
		        
				<!--start top header-->
				<?php if ($redux_demo['topheader_display'] == 1) { include "include/header/top-header.php"; } else {}; ?>
				<!--end top header-->

		    <!--decide gradient or not-->
		    <?php if ($redux_demo['header_gradient'] == 1) { ?> <div class="nicdark_space3 nicdark_bg_gradient"></div> <?php }else{} ?>
   
		        <?php include "include/header/navigation.php"; ?>

		    </div>

		</div>
						



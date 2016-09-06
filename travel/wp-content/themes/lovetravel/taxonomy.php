<?php get_header(); ?>

<?php 

//package
if (is_tax( 'destination-package' )){ include 'include/package/taxonomy-package.php'; } 
if (is_tax( 'typology-package' )){ include 'include/package/taxonomy-package.php'; } 
if (is_tax( 'duration-package' )){ include 'include/package/taxonomy-package.php'; } 
if (is_tax( 'person-package' )){ include 'include/package/taxonomy-package.php'; } 

?>

<?php get_footer(); ?>
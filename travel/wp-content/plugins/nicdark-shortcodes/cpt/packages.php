<?php


///////////////////////////////////////////////////PACKAGES///////////////////////////////////////////////////////////////
function nicdark_create_post_type_packages() {
    register_post_type('packages',
        array(
            'labels' => array(
                'name' => __('Packages', 'nicdark-shortcodes'),
                'singular_name' => __('Packages', 'nicdark-shortcodes')
            ),
            'public' => true,
            'has_archive' => true,
            'exclude_from_search' => true,
            'rewrite' => array('slug' => 'packages'),
            'supports' => array('title', 'editor', 'thumbnail')
        )
    );
}
add_action('init', 'nicdark_create_post_type_packages');

///////////////////////////////////////////////////TAXONOMIES///////////////////////////////////////////////////////////////

//destinations
function nicdark_create_taxonomy_packages_destinations() {
    register_taxonomy(
        'destination-package',
        'post',
        array(
            'label'=>__('Destinations', 'nicdark-shortcodes'),
            'rewrite'=>array('slug'=>'destinations-packages'),
            'hierarchical'=>true
        )
    );
}
add_action('init','nicdark_create_taxonomy_packages_destinations');

//typologies
function nicdark_create_taxonomy_packages_typologies() {
    register_taxonomy(
        'typology-package',
        'post',
        array(
            'label'=>__('Typologies', 'nicdark-shortcodes'),
            'rewrite'=>array('slug'=>'typologies-packages'),
            'hierarchical'=>true
        )
    );
}
add_action('init','nicdark_create_taxonomy_packages_typologies');

//Durations
function nicdark_create_taxonomy_packages_durations() {
    register_taxonomy(
        'duration-package',
        'post',
        array(
            'label'=>__('Durations', 'nicdark-shortcodes'),
            'rewrite'=>array('slug'=>'durations-packages'),
            'hierarchical'=>true
        )
    );
}
add_action('init','nicdark_create_taxonomy_packages_durations');

//people
function nicdark_create_taxonomy_packages_people() {
    register_taxonomy(
        'person-package',
        'post',
        array(
            'label'=>__('People', 'nicdark-shortcodes'),
            'rewrite'=>array('slug'=>'people-packages'),
            'hierarchical'=>true
        )
    );
}
add_action('init','nicdark_create_taxonomy_packages_people');


///////////////////////////////////////////////////ADD TAXONOMIES TO CPT///////////////////////////////////////////////////////////////
function nicdark_add_taxonomy_packages(){ 

    register_taxonomy_for_object_type('destination-package', 'packages'); 
    register_taxonomy_for_object_type('typology-package', 'packages'); 
    register_taxonomy_for_object_type('duration-package', 'packages'); 
    register_taxonomy_for_object_type('person-package', 'packages'); 

}
add_action('init', 'nicdark_add_taxonomy_packages');

///////////////////////////////////////////////////REMOVE TAXONOMIES FROM MENU///////////////////////////////////////////////////////////////
function nicdark_remove_taxonomy_packages(){ 

    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=destination-package');
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=typology-package');
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=duration-package');
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=person-package'); 

}
add_action('admin_menu','nicdark_remove_taxonomy_packages');

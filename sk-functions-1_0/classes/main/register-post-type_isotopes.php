<?php
 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
 
class gallery_isotopes {
 
    public static function init() {
        add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );
    }

    public static function register_post_types() {

        // ___________ =Gallery =Istopes
        register_post_type( 'gallery_istps',
            array(
                'labels' => array(
                    'name'                  => 'Gallery Isotopes',
                    'singular_name'         => 'Gallery Isotope',
                    'menu_name'             => 'Gallery Isotopes',
                    'add_new'               => 'Add New',
                    'add_new_item'          => 'Add New Gallery Isotope',
                    'edit'                  => 'Edit',
                    'new_item'              => 'New Gallery Isotope',
                    'view'                  => 'View Gallery Isotope',
                    'search_item'           => 'Search Gallery Isotope',
                    'not_found'             => 'No Teams found',
                    'not_found_in_trash'    => 'No Teams found in trash',
                    'parent'                => 'Parent Gallery Isotope'
                ),
                'description'           => 'This is where you can add new Gallery Isotopes.',
                'public'                => true,
                'show_ui'               => true,
                'capability_type'       => 'page',
                'publicly_queryable'    => true,
                'hierarchical'          => false,
                'rewrite'               => array( 'slug' => 'gallery-isotopes' ),
                'query_var'             => true,
                'supports'              => array( 'title', 'thumbnail', 'editor' ),
                'has_archive'           => true,
                'show_in_nav_menus'     => true
            )
        );


    }
}
 
gallery_isotopes::init();

?>
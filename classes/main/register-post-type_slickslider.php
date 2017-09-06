<?php
 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
 
class slick_sliders {
 
    public static function init() {
        add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );
    }

    public static function register_post_types() {

        // ___________ =SLICK =SLIDER
        register_post_type( 'slick_slider',
            array(
                'labels' => array(
                    'name'                  => 'Slick Sliders',
                    'singular_name'         => 'Slick Slider',
                    'menu_name'             => 'Slick Sliders',
                    'add_new'               => 'Add New',
                    'add_new_item'          => 'Add New Slick Slider',
                    'edit'                  => 'Edit',
                    'new_item'              => 'New Slick Slider',
                    'view'                  => 'View Slick Slider',
                    'search_item'           => 'Search Slick Slider',
                    'not_found'             => 'No Teams found',
                    'not_found_in_trash'    => 'No Teams found in trash',
                    'parent'                => 'Parent Slick Slider'
                ),
                'description'           => 'This is where you can add new Slick Sliders.',
                'public'                => true,
                'show_ui'               => true,
                'capability_type'       => 'page',
                'publicly_queryable'    => true,
                'hierarchical'          => false,
                'rewrite'               => array( 'slug' => 'slick-slider' ),
                'query_var'             => true,
                'supports'              => array( 'title', 'thumbnail', 'editor' ),
                'has_archive'           => true,
                'show_in_nav_menus'     => true
            )
        );

    }
}
 
slick_sliders::init();

?>
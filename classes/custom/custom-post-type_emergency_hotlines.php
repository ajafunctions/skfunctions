<?php
 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
 
class EmergencyHotlines {
 
    protected static $post_type = 'emergency_hl';

    public static function init() {
        add_action( 'init', array( __CLASS__, 'register_post_type' ), 5 );
    }

    public static function register_post_type() {

        $singular = "Emergency Hotline";
        $plural = "Emergency Hotlines";

        register_post_type( self::$post_type,
            array(
                'labels' => array(
                    'name'                  => $plural,
                    'singular_name'         => $singular,
                    'menu_name'             => $plural,
                    'add_new'               => 'Add New',
                    'add_new_item'          => 'Add New '.$singular,
                    'edit'                  => 'Edit',
                    'new_item'              => 'New '.$singular,
                    'view'                  => 'View '.$singular,
                    'search_item'           => 'Search '.$singular,
                    'not_found'             => 'No '.$plural.' found',
                    'not_found_in_trash'    => 'No '.$plural.' found in trash',
                    'parent'                => 'Parent '.$singular
                ),

                register_taxonomy( 'emergency_cat', self::$post_type,
                    array(
                        'hierarchical'      => true,
                        'label'             => $singular . ' Categories',
                        'rewrite'           => array( 'slug' => 'emergency_cat' ),
                        'show_admin_column' => true,
                        'query_var'         => true
                    )
                ),

                'description'           => 'This is where you can add new '.$singular.'.',
                'public'                => true,
                'show_ui'               => true,
                'capability_type'       => 'page',
                'publicly_queryable'    => true,
                'hierarchical'          => false,
                'rewrite'               => array( 'slug' => self::$post_type ),
                'query_var'             => true,
                'supports'              => array( 'title', 'thumbnail', 'editor' ),
                'has_archive'           => true,
                'show_in_nav_menus'     => true
            )
        );
    }

    
}
 
EmergencyHotlines::init();

?>
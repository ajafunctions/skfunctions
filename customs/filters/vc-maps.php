<?php
   defined( 'ABSPATH' )
         or die( 'No direct load ! ' );

   new VC_Mods();
   class VC_Mods {

      public function __construct() {
         add_action( 'vc_before_init', array( $this, 'small_blocks' ) );
      }

      public function small_blocks() {
         vc_map( array(
            "name" => __( "Home Special Blocks", "my-text-domain" ),
            "base" => "home-small-blocks",
            "class" => "",
            "category" => __( "Content", "my-text-domain"),
            "params" => array(
               array(
                  "type" => "attach_image",
                  "heading" => __( "Box Image", "my-text-domain" ),
                  "param_name" => "box_image",
                  "value" => __( "", "my-text-domain" ),
                  "description" => __( "Box display image", "my-text-domain" )
               ),
               array(
                  "type" => "colorpicker",
                  "heading" => __( "Background Color", "my-text-domain" ),
                  "param_name" => "background_color",
                  "value" => '#FF0000', 
                  "description" => __( "Choose background color", "my-text-domain" )
               ),
               array(
                  "type" => "textfield",
                  "heading" => __( "Title", "my-text-domain" ),
                  "param_name" => "title",
                  "value" => 'Title', 
                  "description" => __( "Box Title", "my-text-domain" )
               ),
               array(
                  "type" => "textarea",
                  "heading" => __( "Excerpt", "my-text-domain" ),
                  "param_name" => "excerpt",
                  "value" => 'Description', 
                  "description" => __( "Box Description", "my-text-domain" )
               ),
               array(
                  "type" => "textfield",
                  "heading" => __( "Link", "my-text-domain" ),
                  "param_name" => "link",
                  "value" => 'Link', 
                  "description" => __( "Box link", "my-text-domain" )
               )
            )
         ) );
      }

   }
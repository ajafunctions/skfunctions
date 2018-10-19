<?php
defined( 'ABSPATH' )
or die( 'No direct load ! ' );

// new VC_Mods();
class VC_Mods {
    public function __construct() {
        add_action( 'vc_before_init', array( $this, 'simple_box' ) );
    }

    // ---------------- SIMPLE BOX ---------------- 
    public function simple_box() {
        vc_map( 
            array(
                "name"     => __( "Simple Box", "my-text-domain" ),
                "base"     => "bi-simple-box",
                "class"    => "",
                "category" => __( "Special Boxes", "my-text-domain"),
                "params"   => array(
                    array(
                      "type"        => "textfield",
                      "admin_label" => true,
                      "heading"     => __( "Title", "my-text-domain" ),
                      "param_name"  => "title",
                      "value"       => '', 
                      "description" => __( "", "my-text-domain" )
                    ),
                    array(
                      "type"        => "textfield",
                      "heading"     => __( "Sub Label", "my-text-domain" ),
                      "param_name"  => "sub_label",
                      "value"       => '', 
                      "description" => __( "", "my-text-domain" )
                    ),
                    array(
                      "type"        => "textarea_html",
                      "heading"     => __( "Box Description", "my-text-domain" ),
                      "param_name"  => "box_description",
                      "value"       => '', 
                      "description" => __( "", "my-text-domain" )
                    ),
                    array(
                      "type"        => "colorpicker",
                      "heading"     => __( "Text Content Background Color", "my-text-domain" ),
                      "param_name"  => "text_content_bg_color",
                      "value"       => __( "", "my-text-domain" ),
                      "description" => __( "Box thumbnail image", "my-text-domain" )
                    ),
                    array(
                      "type"        => "colorpicker",
                      "heading"     => __( "Text Color", "my-text-domain" ),
                      "param_name"  => "text_color",
                      "value"       => __( "", "my-text-domain" ),
                      "description" => __( "Box text color", "my-text-domain" )
                    ),
                    array(
                      "type"        => "vc_link",
                      "heading"     => __( "Page / Post Link", "my-text-domain" ),
                      "param_name"  => "post_link",
                      "value"       => __( "", "my-text-domain" ),
                      "description" => __( "Box link to another page or post", "my-text-domain" )
                    ),
                    array(
                      "type"        => "textfield",
                      "heading"     => __( "External Link", "my-text-domain" ),
                      "param_name"  => "external_link",
                      "value"       => __( "", "my-text-domain" ),
                      "description" => __( "NOTE: If this field has a value, the field Page / Post Link above field will be disregarded.", "my-text-domain" )
                    ),
                    array(
                      "type"        => "attach_image",
                      "heading"     => __( "Thumbnail Image", "my-text-domain" ),
                      "param_name"  => "thumbnail_image",
                      "value"       => __( "", "my-text-domain" ),
                      "description" => __( "Box thumbnail image", "my-text-domain" )
                    ),
                    array(
                      "type"        => "attach_images",
                      "heading"     => __( "Gallery", "my-text-domain" ),
                      "param_name"  => "gallery_images",
                      "value"       => __( "", "my-text-domain" ),
                      "description" => __( "On click gallery", "my-text-domain" )
                    )
                )
            )
        );
    }
}
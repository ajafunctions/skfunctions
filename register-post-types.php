<?php
 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*************** 1. Main Post Types ***************/
	// include( plugin_dir_path( __FILE__ ) . 'classes/main/register-post-type_isotopes.php');
	include( plugin_dir_path( __FILE__ ) . 'classes/main/register-post-type_slickslider.php');

	
/*************** 2. Custom Post Types ***************/
	// include( plugin_dir_path( __FILE__ ) . 'classes/custom/custom-post-type_emergency_hotlines.php');

?>
<?php

/*************** 1. EXTERNAL LINKS ***************/
	// require_once( SK_CF_DIR . 'admin/ #files# );

/*************** 2. SCRIPTS AND STYLES ***************/
/*****---------- 2.1 Scripts ----------*****/
/**------------- 2.1.1 Javascripts -------------**/
	function load_custom_wp_admin_scripts() {
	    wp_register_script( 'sk_admin_js', SK_CF_URL. 'admin/js/sk_admin.js', false, '1.0.0', true );
		wp_enqueue_script( 'sk_admin_js' );

	}
	add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_scripts', 10, PHP_INT_MAX );
/**------------- 2.1.2 Localized Objects -------------**/

	function get_localized_object(){
		$sk_local = array();

		$sk_local['home_url'] = home_url();
		$sk_local['ajax_url'] = admin_url( 'admin-ajax.php' );

		return $sk_local;
	}

	function set_localized_script(){
		$sk_data = get_localized_object();
		wp_localize_script( 'sk_woocommerce_js', 'SK_DATA', $sk_data );
	}
	add_action('in_admin_footer', 'set_localized_script', 50);

/*****---------- 2.2 Styles ----------*****/
	function load_custom_wp_admin_styles() {
		wp_enqueue_style( 'sk_admin_css', SK_CF_URL. 'admin/css/skfunction-admin.css' );
	}
	add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_styles' );

/*************** 3. Includes ***************/

	function skadmin_add_priorities(){

	}
	add_action('admin_init', 'skadmin_add_priorities', 4);

	function skadmin_includeClasses(){

	}
	add_action('admin_init', 'skadmin_includeClasses', 5);

	function skadmin_add_other_files(){

		date_default_timezone_set('Asia/Singapore');
	}
	add_action('admin_init', 'skadmin_add_other_files', 6);
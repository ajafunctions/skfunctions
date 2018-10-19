<?php
/*
Plugin Name: SK Functions
Plugin URI:
Description: Adds some shortcodes and functions for custom functionality
Author: Skubbs
Version: 1.1
Author URI:
Network: true
*/

defined( 'ABSPATH' )
	or die( 'No direct load ! ' );

define( 'SK_CF_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'SK_CF_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'SK_CF_PLUGIN_BASENAME', trailingslashit( plugin_basename( __FILE__ ) ) );

/*************** 1. External Links ***************/
	function add_priorities(){
		include(  SK_CF_DIR  . 'helpers/main_helper.php'); 
	}
	add_action('init', 'add_priorities', 1);

	function includeClasses(){
		include(  SK_CF_DIR  . 'classes/main/MainObject.php'); 

	}
	add_action('init', 'includeClasses', 2);

	function add_other_files(){
		include(  SK_CF_DIR  . 'custom-shortcodes.php' ); 
		include(  SK_CF_DIR  . 'register-post-types.php' );
		include(  SK_CF_DIR  . 'admin/admin-functions.php' );

		$functions = getDirContents(  SK_CF_DIR  .'customs/functions');		
		foreach($functions as $function ){
			include( $function );
		}

		$filters = getDirContents(  SK_CF_DIR  .'customs/filters');		
		foreach($filters as $filter ){
			include( $filter );
		}

		date_default_timezone_set('Asia/Singapore');
	}
	add_action('init', 'add_other_files', 3);


/*************** 2. ACTIONS ***************/
/*****---------- 2.1 Scripts ----------*****/
	function custom_plugin_scripts() {
		wp_enqueue_style( 'slick-css', SK_CF_URL . 'js/slick/slick.css');
		wp_enqueue_style( 'slick-theme', SK_CF_URL . 'js/slick/slick-theme.css');
		wp_enqueue_script( 'slick-js', SK_CF_URL . 'js/slick/slick.min.js', array(), '1.6.0', true );
		// wp_enqueue_script( 'fix_input_number', SK_CF_URL . 'js/vendors/fix_for_number_inputs.js', array() );
		// wp_enqueue_script( 'numeric', SK_CF_URL . 'js/vendors/numeric.js', array() );
		// wp_enqueue_style( 'hover', SK_CF_URL . 'css/hover-min.css' );
		// wp_enqueue_style( 'featherlight-css', SK_CF_URL . 'js/featherlight/featherlight.css' );
		// wp_enqueue_script( 'isotopes', SK_CF_URL . 'js/vendors/isotope.pkgd.min.js', array() );
		// wp_enqueue_script( 'actual', SK_CF_URL . 'js/vendors/jquery.actual.min.js', array() );
	}
	add_action( 'wp_enqueue_scripts', 'custom_plugin_scripts' );
/*****---------- 2.2 Scripts ----------*****/
	function custom_plugin_styles() {
	 	// wp_enqueue_style( 'jquery-ui-cdn-css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
		wp_enqueue_style( 'btsp-bootstrap-gridonly', plugin_dir_url( __FILE__ ) . 'css/btsp-bootstrap-gridonly.css');
		// wp_enqueue_style( 'bootstrap-grid', plugin_dir_url( __FILE__ ) . 'css/bootstrap-grid.css');
		wp_enqueue_style( 'cf-css', plugin_dir_url( __FILE__ ) . 'css/cf-css.css');
	}
	add_action( 'wp_enqueue_scripts', 'custom_plugin_styles' );
/*****---------- 2.3 Enqueue Last ----------*****/
	function bottom_scripts(){
		// wp_enqueue_script('date', SK_CF_URL . 'js/vendors/date.js', array());
		// wp_enqueue_script( 'featherlight-js', SK_CF_URL . 'js/featherlight/featherlight.js' );
		wp_enqueue_script( 'cf-scripts', SK_CF_URL . 'js/main.js', array() );
	}
	add_action( 'wp_enqueue_scripts', 'bottom_scripts', PHP_INT_MAX);
/*****---------- 2.4 Main Variables for JS ----------*****/
	function main_variables(){
		echo "<script type=\"text/javascript\">".
	        "home_url = '".home_url()."';".
	        // "ajax_url ='".admin_url( 'admin-ajax.php' )."';".
	      "</script>";
	}
	add_action ( 'wp_footer', 'main_variables' );
/*****---------- 2.5 Certain Page Styles ----------*****/
	function certainStyles(){
		global $post;
		if( $post == null ){
			return;
		}

	    $post_slug=$post->post_name;
	    $styleName = $post_slug. '.css';
	    $certainStyles = getDirFiles(SK_CF_DIR . '/css/certainpage');
	    if(in_array($styleName, $certainStyles)){
			wp_enqueue_style( $post_slug , SK_CF_URL . 'css/certainpage/' . $styleName );    	
	    }
	}
	add_action('wp_enqueue_scripts', 'certainStyles');
/*****---------- 2.6 Sessions ----------*****/
	function sk_start_session() {
	    if(!session_id() || session_status() == PHP_SESSION_NONE) {
	        session_start();
	    }
	}

	function sk_end_session() {
	    session_destroy ();
	}

	add_action('init', 'sk_start_session', 1);
	add_action('wp_logout', 'sk_end_session');

/*************** 3. FILTERS ***************/
	// function add_content_on_registration(){
	// 	echo '<span class="login_link_for_registration">Already have an Account? <a href="#">Log In</a></span>';
	// }
	// add_filter('upme_register_after_fields', 'add_content_on_registration');


	// function change_dollar_to_sgd( $currency_symbol, $currency ) {
	//      switch( $currency ) {
	//           case 'SGD': $currency_symbol = 'SGD$'; break;
	//      }
	//      return $currency_symbol;
	// }
	// add_filter('woocommerce_currency_symbol', 'change_dollar_to_sgd', 10, 2);

/*************** 4. TESTER ***************/

	function test_code_here(){
	}
	add_action('wp', 'test_code_here');

/*************** 5. REUSBALE FUNCTIONS ***************/
/*****---------- 5.1 Word Limiter ----------*****/
	// https://developer.wordpress.org/reference/functions/wp_trim_words/
	// use wp_trim_words(content, limit, ending_string)
/*****---------- 5.2 Pagination ----------*****/
	function custom_pagination($numpages = '', $pagerange = '', $paged='') {

		if (empty($pagerange)) {
		    $pagerange = 2;
		}

		/**
		* This first part of our function is a fallback
		* for custom pagination inside a regular loop that
		* uses the global $paged and global $wp_query variables.
		* 
		* It's good because we can now override default pagination
		* in our theme, and use this function in default quries
		* and custom queries.
		*/

		global $paged;

		if (empty($paged)) {
		    $paged = 1;
		}
		
		if ($numpages == '') {
		    global $wp_query;
		    $numpages = $wp_query->max_num_pages;
		    if(!$numpages) {
		        $numpages = 1;
		    }
		}

		/** 
		* We construct the pagination arguments to enter into our paginate_links
		* function. 
		*/
	  	$pagination_args = array(
		    'base'            => get_pagenum_link(1) . '%_%',
		    'format'          => 'page/%#%',
		    'total'           => $numpages,
		    'current'         => $paged,
		    'show_all'        => False,
		    'end_size'        => 1,
		    'mid_size'        => $pagerange,
		    'prev_next'       => True,
		    'prev_text'       => __('&laquo;'),
		    'next_text'       => __('&raquo;'),
		    'type'            => 'plain',
		    'add_args'        => false,
		    'add_fragment'    => ''
	  	);

	  	$paginate_links = paginate_links($pagination_args);

	  	if ($paginate_links) {
		    echo "<nav class='custom-pagination'>";
		      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
		      echo $paginate_links;
		    echo "</nav>";
		}
	}
/*****---------- 5.3 Directory Lister ----------*****/
/**------------- 5.3.1 Real Path -------------**/
	function getDirContents($dir, &$results = array()){
	    $files = scandir($dir);

	    foreach($files as $key => $value){
	        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
	        if(!is_dir($path)) {
	           $results[] = $path;
	        } else if($value != "." && $value != "..") {
	            getDirContents($path, $results);
	            // $results[] = $path;
	        }
	    }

	    return $results;
	}
/**------------- 5.3.2 File Name -------------**/
	function getDirFiles($dir){
	    $files = scandir($dir);

	    $results = array();
	    foreach($files as $key => $value){
			if($value != "." && $value != "..") {
	            $results[] = $value;
	        }
	    }

	    return $results;
	}
/**------------- 5.3.3 site_URL Menu Filter -------------**/
	// e.g. http://[site_URL]/#asiudyasjkd
	function change_menu($items){
		foreach($items as $item){
			$item->url = preg_replace("/http:\/\/\[site_URL\]/", home_url(), $item->url);
		}
		return $items;
	}
	add_filter('wp_nav_menu_objects', 'change_menu');
/**------------- 5.3.4 Strip Dashes -------------**/
	function strip_dash_noalpha($string) {
		$strip_nonalphanumeric = preg_replace("/[^A-Za-z0-9 ]/", '', $string );
		$strip_dashes =  str_replace(' ' ,'-',$strip_nonalphanumeric);

		return $strip_dashes;
	}
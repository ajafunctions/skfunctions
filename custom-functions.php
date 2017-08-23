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

/*************** 1. External Links ***************/
	function add_includes(){
		include( plugin_dir_path( __FILE__ ) . '/custom-shortcodes.php'); 
		include( plugin_dir_path( __FILE__ ) . '/register-post-types.php');

		$files = getDirContents(plugin_dir_path( __FILE__ ) .'/customs/functions');
		foreach($files as $file ){
			include( $file );
		}

		date_default_timezone_set('Asia/Singapore');
	}

	add_action('init', 'add_includes', 2);

	function includeClasses(){
		include( plugin_dir_path( __FILE__ ) . '/classes/main/MainObject.php'); 

	}
	add_action('init', 'includeClasses', 1);

/*************** 2. ACTIONS ***************/

/*****---------- 2.1 Scripts ----------*****/
	function custom_plugin_scripts() {
		wp_enqueue_style( 'slick-css', plugin_dir_url( __FILE__ ) . 'js/slick/slick.css');
		wp_enqueue_style( 'slick-theme', plugin_dir_url( __FILE__ ) . 'js/slick/slick-theme.css');
		wp_enqueue_script( 'slick-js', plugin_dir_url( __FILE__ ) . 'js/slick/slick.min.js', array(), '1.6.0', true );
		// wp_enqueue_script( 'fix_input_number', plugin_dir_url( __FILE__ ) . 'js/vendors/fix_for_number_inputs.js', array() );
		wp_enqueue_script( 'numeric', plugin_dir_url( __FILE__ ) . 'js/vendors/numeric.js', array() );
		// wp_enqueue_style( 'hover', plugin_dir_url( __FILE__ ) . 'css/hover-min.css' );
		wp_enqueue_style( 'featherlight-css', plugin_dir_url( __FILE__ ) . 'js/featherlight/featherlight.css' );
		wp_enqueue_script( 'isotopes', plugin_dir_url( __FILE__ ) . 'js/vendors/isotope.pkgd.min.js', array() );
		wp_enqueue_script( 'actual', plugin_dir_url( __FILE__ ) . 'js/vendors/jquery.actual.min.js', array() );
	}
	add_action( 'wp_enqueue_scripts', 'custom_plugin_scripts' );

/*****---------- 2.2 Scripts ----------*****/
	function custom_plugin_styles() {
	 	// wp_enqueue_style( 'jquery-ui-cdn-css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
		wp_enqueue_style( 'btsp-bootstrap-gridonly', plugin_dir_url( __FILE__ ) . 'css/btsp-bootstrap-gridonly.css');
		wp_enqueue_style( 'cf-css', plugin_dir_url( __FILE__ ) . 'css/cf-css.css');
	}
	add_action( 'wp_enqueue_scripts', 'custom_plugin_styles' );

/*****---------- 2.3 Enqueue Last ----------*****/
	function bottom_scripts(){
		// wp_enqueue_script('date', plugin_dir_url( __FILE__ ) . 'js/vendors/date.js', array());
		wp_enqueue_script( 'featherlight-js', plugin_dir_url( __FILE__ ) . 'js/featherlight/featherlight.js' );
		wp_enqueue_script( 'cf-scripts', plugin_dir_url( __FILE__ ) . 'js/main.js', array() );
	}
	add_action( 'wp_enqueue_scripts', 'bottom_scripts', PHP_INT_MAX);

/*****---------- 2.4 Main Variables for JS ----------*****/
	function main_variables(){
		echo "<script type=\"text/javascript\">".
	        "home_url = '".home_url()."';".
	      "</script>";
	}
	add_action ( 'wp_head', 'main_variables' );

/*****---------- 2.5 Certain Page Styles ----------*****/
	function certainStyles(){
		global $post;
	    $post_slug=$post->post_name;
	    $styleName = $post_slug. '.css';
	    $certainStyles = getDirFiles(plugin_dir_path( __FILE__ ) . '/css/certainpage');
	    if(in_array($styleName, $certainStyles)){
			wp_enqueue_style( $post_slug , plugin_dir_url( __FILE__ ) . 'css/certainpage/' . $styleName );    	
	    }
	}
	add_action('wp_enqueue_scripts', 'certainStyles');

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
	add_action('init', 'test_code_here');


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




// ************************************
// =AJAX
// ************************************
	// function changeProjects($category){
	// 	$response = [];
	// 	$response['status'] = false;
	// 	if(isset($_POST['category'])){
	// 		$html = showProjects($category);
	// 			//showProjects - /portal/wp-content/plugins/custom-functions-v2-1/shortcodes/home_slider.php
	// 		$response['html'] = $html;
	// 		$response['status'] = true;
	// 	}
	// 	echo json_encode($response);
	// 	wp_die();
	// }
	// add_action('wp_ajax_changeProjects', 'changeProjects');
	// add_action('wp_ajax_nopriv_changeProjects', 'changeProjects');



// ************************************
// =STRIP DASHES
// ************************************
	function strip_dash_noalpha($string) {
		$strip_nonalphanumeric = preg_replace("/[^A-Za-z0-9 ]/", '', $string );
		$strip_dashes =  str_replace(' ' ,'-',$strip_nonalphanumeric);

		return $strip_dashes;
	}
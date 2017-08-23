<?php 

	function sampleShortcode() {
		ob_start();
	    ?>

		
	    <?php
		return ob_get_clean();
	}
	add_shortcode( 'sample-shortcode' , 'sampleShortcode' );


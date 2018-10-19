<?php 

	function productSlider() {
		ob_start();

		$args = array(
            'post_type' => 'pincha_product',
            'orderby'   => 'date',
            'order'     => 'ASC'
        );
		
		$query = new WP_Query( $args );
	    ?>

			<?php if( $query->have_posts() ) : ?>
			    <?php while( $query->have_posts() ) : $query->the_post(); ?>
			        <?php
			            if (has_post_thumbnail( $post->ID ) ) {
			                $bg_url   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
			                $bg_image = 'style="background-image: url('. $bg_url[0] .')"';
			            } else {
			                $bg_image = 'style="background-image: url('. wp_get_attachment_url(576) .')"';
			            }
			        ?>
			    <?php endwhile; wp_reset_postdata(); ?>
			<?php endif; ?>
		
	    <?php
		return ob_get_clean();
	}
	add_shortcode( 'product-slider' , 'productSlider' );

	// ______________________________ =Home Special Blocks ______________________________
	function bi_SimpleBox( $atts ) {
		$sc_atts = shortcode_atts(
	                array(
	                    'title' => '',
	                    'sub_label' => '',
	                    'box_description' => '',
	                    'text_content_bg_color' => '',
	                    'text_color' => '#000',
	                    'active_meta_info' => '',
	                    'post_link' => '',
	                    'external_link' => '',
			    		'thumbnail_image' => '',
			    		'gallery_images' => '',
	                ), $atts, 'bi-simple-box' );

		$box_link = '' ;
		// $active_meta_info 	= vc_build_link( $sc_atts['active_meta_info'] );
		// $ex_link 			= vc_build_link( $sc_atts['external_link'] );
		$post_link 			= vc_build_link( $sc_atts['post_link'] );

		if($sc_atts['external_link'] != '') {
			$box_link = $sc_atts['external_link'];
		} else {
			$box_link = $post_link['url'];
		}

		ob_start();
	    ?>

		<?php if ( $sc_atts['thumbnail_image'] ): ?>
			<div class="boxtype-_simple" style="background-image: url('<?php echo wp_get_attachment_url( $sc_atts['thumbnail_image'] ) ?> ')">
		<?php else : ?>
			<div class="boxtype-_simple img-placeholder" style="background-color: #5cd0e0;">
		<?php endif; ?>

		<?php if(!empty($sc_atts['gallery_images'])) : ?>
			<div><a class="lg-lit-igniter btsc--permalink" href="#"></a></div>
			<div class="lg-is-lit" style="display: none;">
			<?php foreach(explode(',',$sc_atts['gallery_images']) as $gi) : ?>
				<div data-src="<?php echo wp_get_attachment_url($gi); ?>"><img src="<?php echo wp_get_attachment_url($gi); ?>" alt="" /></div>	
			<?php endforeach; ?>
			</div>
		<?php else : ?>
			<?php if($box_link != '#' || $box_link != '') : ?>
				<a href="<?php echo $box_link; ?>" class="btsc--permalink"></a>
			<?php endif; ?>
		<?php endif; ?>

			<?php if( $sc_atts['title'] != '' || $sc_atts['sub_label'] != '') : ?>
				<div class="bt-simple-contents">
					<div class="bt-simple-label"><span<?= ( $sc_atts['text_color'] == '') ? '' : ' style="color: '. $sc_atts['text_color'].';"' ; ?>><?php echo $sc_atts['sub_label']; ?></span></div>
					<?php if($box_link != '#') : ?>
						<h3><a href="<?php echo $box_link; ?>" <?= ( $sc_atts['text_color'] == '') ? '' : ' style="color: '. $sc_atts['text_color'].';"' ; ?>><?php echo $sc_atts['title']; ?></a></h3>
					<?php else : ?>
						<h3><a href="#" <?= ( $sc_atts['text_color'] == '') ? '' : ' style="color: '. $sc_atts['text_color'].';"' ; ?> class="lit-enabled"><?php echo $sc_atts['title']; ?></a></h3>
					<?php endif; ?>
					<div class="box_description"><?php echo $sc_atts['box_description'] ?></div>
					<div class="btsc--bg"<?= ($sc_atts['text_content_bg_color'] == '') ? '' : ' style="background-color: '.$sc_atts['text_content_bg_color'].';"'; ?>></div>
				</div>
			<?php endif; ?>
			</div>
	<?php
		return ob_get_clean();
	}
	add_shortcode( 'bi-simple-box' , 'bi_SimpleBox' );
	// [bi-simple-box]

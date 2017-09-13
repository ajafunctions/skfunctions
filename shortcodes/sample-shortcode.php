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


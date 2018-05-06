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
	function homeSmallBlocks( $atts ) {
		$sc_atts = shortcode_atts(
	                array(
	                    'box_image' => '',
	                    'background_color' => '',
	                    'title' => '',
	                    'excerpt' => '',
	                    'link' => ''
	                ), $atts, 'home-small-blocks' );

		ob_start();
	    ?>
	    	<div class="hsb-one-thirds__single__container">
				<div class="hsb-one-thirds__single" style="background-color: <?php echo $sc_atts['background_color'] ?>">
					<div class="hsb-one-thirds__image" style="background-image: url(<?php echo wp_get_attachment_url($sc_atts['box_image']) ?>);"></div>
					<h4 class="hsb-one-thirds__single__title"><span><em><?php echo $sc_atts['title'] ?></em></span></h4>
					<div class="hsb-slide-down-details">
						<div class="hsb-one-thirds__single__excerpt"><?php echo $sc_atts['excerpt'] ?></div>
						<a href="<?php echo $sc_atts['link'] ?>" class="hsb-one-thirds__single__premalink">Read More<span> >></span></a>
					</div>
				</div>
			</div>
		<?php
		return ob_get_clean();
	}
	add_shortcode( 'home-small-blocks' , 'homeSmallBlocks' );
	// [home-small-blocks box_image="" background_color="" title="" excerpt="" link="" ]
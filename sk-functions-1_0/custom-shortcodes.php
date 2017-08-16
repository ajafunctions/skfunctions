<?php

/*************** 1. CUSTOM SHORTCODE ***************/
/*****---------- 1.1 SLIDER ----------*****/
	// include( plugin_dir_path( __FILE__ ) . '/shortcodes/sample-shortcode.php'); 
	//// [sample_shortcode]


/*************** 2. MAIN SHORTCODES ***************/
/*****---------- 2.1 GALLERY =ISOTOPES ----------*****/
	function gallery_isotopes($atts) {
		$sc_atts = shortcode_atts(
				array(
					'id' => ''
				), $atts, '' );

		ob_start();
	    ?>

	    <?php if ($sc_atts['id'] && 'publish' == get_post_status ( $sc_atts['id'] )) : ?>
	    	<?php
		    	$args = array(
			        'post_type'  => 'gallery_istps',
			        'p'			 => $sc_atts['id']
				);

				$pids;
				$gallery_filters = [];
				
				$filter_args = new WP_Query( $args );

				if( $filter_args->have_posts() ) {
					while( $filter_args->have_posts() ) {
						$filter_args->the_post();

						if( have_rows('gallery_set') ) {
							while( have_rows('gallery_set') ) {
								the_row();

								$pids = get_the_ID();
								$gallery_filters[] = get_sub_field('gallery_label');
							}
						}

						wp_reset_postdata();
					}
				}

				$gallery_filters_unique = array_unique($gallery_filters);

				$gallery_query = new WP_Query( $args );
	    	?>

	    	<?php if( $gallery_query->have_posts() ) : ?>

	    		<div class="gallery-isotopes-master galler-isotopes-classid-<?= $sc_atts['id'] ?>">

					<div class="gallery-isotopes__filters">
							<button class="filter-button is-checked" data-filter="*">ALL</button>
						<?php foreach($gallery_filters_unique as $filter_text) : ?>
							<button class="filter-button" data-filter=".<?= strip_dash_noalpha($filter_text) ?>"><?= $filter_text ?></button>
						<?php endforeach; ?>
					</div>

					<select class="gallery-isotopes__filters--select">
							<option value="*">ALL</option>
						<?php foreach($gallery_filters_unique as $filter_text_select) : ?>
							<option value=".<?= strip_dash_noalpha($filter_text_select) ?>"><?= $filter_text_select ?></option>
						<?php endforeach; ?>
					</select>

					<div class="gallery-isotopes__images" data-img-space="<?= get_field('enable_space_between_images', $pids) ?>" data-img-count="<?= get_field('count_per_row', $pids) ?>" data-img-height="<?= get_field('gallery_height', $pids) ?>">
						<?php while( $gallery_query->have_posts() ) : $gallery_query->the_post(); ?>

							<?php if( have_rows('gallery_set') ): ?>
								<?php while( have_rows('gallery_set') ) : the_row(); ?>

									<?php 
									$images = get_sub_field('gallery_images');

									if( $images ): ?>
								        <?php foreach( $images as $image ): ?>
											<a href="#" data-featherlight="<?php echo $image['url']; ?>" style="background-image: url('<?php echo $image['sizes']['large']; ?>');" class="gallery-isotope-pic <?= strip_dash_noalpha( get_sub_field('gallery_label') ) ?>"></a>
								        <?php endforeach; ?>
									<?php endif; ?>

								<?php endwhile; ?>
							<?php endif; ?>

						<?php endwhile; wp_reset_postdata(); ?>
					</div>
			    </div>

			<?php endif; ?>
		<?php endif; ?>

	    <?php
		return ob_get_clean();
	}
	add_shortcode( 'gallery-isotopes' , 'gallery_isotopes' );
	// [gallery-isotopes id="141"]


/*****---------- 2.2 SLICK SLIDER DYNAMIC ----------*****/
	function slick_dynamic_func($atts) {
		$sd_atts = shortcode_atts(
				array(
					'id' => ''
				), $atts, '' );

		ob_start();
	    ?>

	    <?php if ($sd_atts['id'] && 'publish' == get_post_status ( $sd_atts['id'] )) : ?>
	    	<?php
		    	$sd_args = array(
			        'post_type'  => 'slick_slider',
			        'p'			 => $sd_atts['id']
				);

				$sd_query = new WP_Query( $sd_args );
	    	?>

	    		<?php if( $sd_query->have_posts() ) : ?>
					<?php while( $sd_query->have_posts() ) : $sd_query->the_post(); ?>

						<?php // MULTIPLE VIEW
							if(get_field('slider_type') == 'Multiple View') : ?>
							<div class="slick-master slick-master-multiple-view slick-slider-classid-<?= $sd_atts['id'] ?>">
								<div class="ss__images" data-autoplay="<?= get_field('autoplay') ?>" data-show="<?= get_field('initial_images_to_show') ?>" data-img-height="<?= get_field('image_height') ?>">
									<?php 
									$images = get_field('slick_images');

									if( $images ): ?>
								        <?php foreach( $images as $image ): ?>
											<a href="#" data-featherlight="<?php echo $image['url']; ?>" style="background-image: url('<?php echo $image['sizes']['large']; ?>');" class=""></a>
								        <?php endforeach; ?>
									<?php endif; ?>
								</div>

								<?php if( get_field('enable_arrows') == 'Yes') : ?>
									<div class="slick-master__arrows">
										<i class="fa fa-angle-left" aria-hidden="true"></i> <i class="fa fa-angle-right" aria-hidden="true"></i></i>
									</div>
								<?php endif; ?>
						    </div>

						<?php // SINGLE VIEW
							elseif(get_field('slider_type') == 'Single View') : ?>
							<div class="slick-master slick-master-single-view slick-absolute-arrows slick-slider-classid-<?= $sd_atts['id'] ?>">
								
								<div class="ss__images" data-autoplay="<?= get_field('autoplay') ?>" data-img-height="<?= get_field('image_height') ?>">
									<?php 
									$images = get_field('slick_images');

									if( $images ): ?>
								        <?php foreach( $images as $image ): ?>
											<a href="#" data-featherlight="<?php echo $image['url']; ?>" style="background-image: url('<?php echo $image['sizes']['large']; ?>');" class=""></a>
								        <?php endforeach; ?>
									<?php endif; ?>
								</div>

								<div class="slick-master__arrows">
									<i class="fa fa-angle-left" aria-hidden="true"></i> <i class="fa fa-angle-right" aria-hidden="true"></i></i>
								</div>
						    </div>

						<?php // SINGLE VIEW with THUMBNAILS
							elseif(get_field('slider_type') == 'Single View with Thumbnails') : ?>
							<div class="slick-master slick-master-single-thumbnails-view slick-absolute-arrows slick-slider-classid-<?= $sd_atts['id'] ?>">
								
								<div class="ss__images" data-autoplay="<?= get_field('autoplay') ?>" data-img-height="<?= get_field('image_height') ?>">
									<?php 
									$images = get_field('slick_images');

									if( $images ): ?>
								        <?php foreach( $images as $image ): ?>
											<a href="#" data-featherlight="<?php echo $image['url']; ?>" style="background-image: url('<?php echo $image['sizes']['large']; ?>');" class=""></a>
								        <?php endforeach; ?>
									<?php endif; ?>
								</div>

								<div class="slick-master__arrows">
									<i class="fa fa-angle-left" aria-hidden="true"></i> <i class="fa fa-angle-right" aria-hidden="true"></i></i>
								</div>

								<div class="ss__nav" data-show="<?= get_field('initial_images_to_show') ?>">
									<?php 
									$images_nav = get_field('slick_images');

									if( $images_nav ): ?>
								        <?php foreach( $images_nav as $image_nav ): ?>
											<a href="#" style="background-image: url('<?php echo $image_nav['sizes']['large']; ?>');" class=""></a>
								        <?php endforeach; ?>
									<?php endif; ?>
								</div>

						    </div>
						    
						<?php endif; ?>


					<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>
			
		<?php else : ?>
			<p class="text-center">Please include an ID in the shotcode <i>e.g. [slickslider id="1"]</i></p>
		<?php endif; ?>

		<?php
		return ob_get_clean();
	}
	add_shortcode( 'slickslider' , 'slick_dynamic_func' );
	// [slickslider id="141"]


/*****---------- 2.3 RETURN HOME URL ----------*****/
	function returnHomeURL() {
		return home_url();
	}
	add_shortcode( 'sitehomeurl' , 'returnHomeURL' );
	// [sitehomeurl]

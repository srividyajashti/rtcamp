<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/kajalsharma2101
 * @since      1.0.0
 *
 * @package    Rt_Slideshow
 * @subpackage Rt_Slideshow/public/partials
 */
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rt_Slideshow
 * @subpackage Rt_Slideshow/public
 * @author     Kajal Sharma <sharmakajal2101@gmail.com>
 */

?>
<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/kajalsharma2101
 * @since      1.0.0
 *
 * @package    Rt_Slideshow
 * @subpackage Rt_Slideshow/public/partials
 */

?>

<?php $images = get_option( 'rtsa_images' ); ?>

<div id="rtsa-slider-container" style="max-width:600px;">
	<ul id="lightSlider">
		<?php
		if ( $images ) {

			foreach ( $images as $image ) {

				$thumb_url = wp_get_attachment_thumb_url( $image );
				$url = wp_get_attachment_url( $image );

		?>

				<li data-thumb='<?php echo wp_kses_post( $thumb_url ); ?>'>
					<img class='slider-items' src='<?php echo wp_kses_post( $url ); ?>' width='100%' style='max-width:600px' />
				</li>

		<?php
			}
		}
		?>
	</ul>
</div>

<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link        https://github.com/kajalsharma2101
 * @since      1.0.0
 *
 * @package    Rt_Slideshow
 * @subpackage Rt_Slideshow/admin/partials
 */
?>


<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<?php do_settings_sections( $this->plugin_name ); ?>
	<div>
		<p align="center"><input type="button" style="background-color:#4CAF50" name="save-btn" id="save-btn" class="button-primary" value="Save">
		    &nbsp;&nbsp;<input type="button"  name="upload-btn" id="upload-btn" class="button-secondary" value="Add New Images"></p>
	</div>
</div>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

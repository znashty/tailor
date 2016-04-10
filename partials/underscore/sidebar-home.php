<?php

/**
 * Underscore JS template for the Sidebar Home panel.
 *
 * @package Tailor
 * @subpackage Underscore Templates
 * @since 1.0.0
 */

defined( 'ABSPATH' ) or die(); ?>

<script id="tmpl-tailor-home" type="text/html">
    <div class="header">
        <div class="title-block">
	        <h3 class="title">
		        <span class="notice"><?php _e( 'You are Tailoring', tailor()->textdomain() ); ?></span>
		        <?php the_title(); ?>
	        </h3>
            <button class="help-button dashicons dashicons-editor-help">
                <span class="screen-reader-text"><?php _e( 'Help', tailor()->textdomain() ); ?></span>
            </button>
        </div>
        <div class="help-description">
	        <?php _e( 'Tailor allows you to layout your content in new and exciting ways through the use of elements and templates.', tailor()->textdomain() ); ?>
        </div>
    </div>
    <div class="preview">
	    <h3 class="preview__title"><?php _e( 'Preview size', tailor()->textdomain() ); ?></h3>
	    <select class="preview__control">

		    <?php
		    $preview_sizes = tailor_get_preview_sizes();

		    if ( is_array( $preview_sizes ) ) {
			    foreach ( $preview_sizes as $key => $preview_size ) {
				    echo '<option value="' . esc_attr( $key ) . '">' . esc_attr( $preview_size ) . '</option>';
			    }
		    } ?>

	    </select>
    </div>
    <ul class="list list--primary" id="items"></ul>
</script>
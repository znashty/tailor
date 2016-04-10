<?php

/**
 * Post excerpt template.
 *
 * @package Tailor
 * @subpackage Templates
 * @since 1.0.0
 */

defined( 'ABSPATH' ) or die(); ?>

<div class="entry__excerpt">

	<?php
	$post = get_post();
	$excerpt = has_excerpt() ? $post->post_excerpt : $post->post_content;
	$excerpt_length = 30;
	$excerpt_ellipses = '...';
	$excerpt_more = sprintf( '...<br><a class="entry__more" href="%s">%s</a>', get_permalink(), __(  'Continue reading &rsaquo;', tailor()->textdomain() ) );
	$trimmed_excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );

	/**
	 * Filters the entry excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $trimmed_excerpt
	 * @param string $excerpt
	 * @param int $excerpt_length
	 * @param string $excerpt_more
	 */
	$trimmed_excerpt = apply_filters( 'tailor_excerpt', $trimmed_excerpt, $excerpt, $excerpt_length, $excerpt_more );

	echo $trimmed_excerpt; ?>

</div>
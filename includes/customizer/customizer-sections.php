<?php

/**
 * Tailor Customizer section definitions.
 *
 * @package Tailor
 * @subpackage Customizer
 * @since 1.0.0
 */

if ( ! function_exists( 'tailor_get_customizer_sections' ) ) {

    /**
     * Returns the Customizer sections to be registered.
     *
     * @since 1.0.0
     *
     * @return mixed|void
     */
    function tailor_get_customizer_sections() {

        $sections = array(
            'layout'                    =>  array(
                'title'                     =>  __( 'Layout', tailor()->textdomain() ),
                'priority'                  =>  10,
                'panel'                     =>  'tailor',
            ),
        );

        return apply_filters( 'tailor_customizer_sections', $sections );
    }
}
<?php

/**
 * Tailor Section element class.
 *
 * @package Tailor
 * @subpackage Elements
 * @since 1.0.0
 */

defined( 'ABSPATH' ) or die();

if ( class_exists( 'Tailor_Element' ) && ! class_exists( 'Tailor_Section_Element' ) ) {

    /**
     * Tailor Section element class.
     *
     * @since 1.0.0
     */
    class Tailor_Section_Element extends Tailor_Element {

        /**
         * Registers element settings, sections and controls.
         *
         * @since 1.0.0
         * @access protected
         */
        protected function register_controls() {

	        $this->add_section( 'general', array(
		        'title'                 =>  __( 'General', tailor()->textdomain() ),
		        'priority'              =>  10,
	        ) );

	        $this->add_section( 'colors', array(
		        'title'                 =>  __( 'Colors', tailor()->textdomain() ),
		        'priority'              =>  20,
	        ) );

	        $this->add_section( 'attributes', array(
		        'title'                 =>  __( 'Attributes', tailor()->textdomain() ),
		        'priority'              =>  30,
	        ) );

	        $priority = 0;

	        $general_control_types = array(
		        'max_width',
		        'min_height',
		        'horizontal_alignment',
                'vertical_alignment',
	        );
	        $general_control_arguments = array(
		        'vertical_alignment'    =>  array(
			        'control'               =>  array(
				        'dependencies'          =>  array(
					        'min_height'            =>  array(
						        'condition'             =>  'not',
						        'value'                 =>  '',
					        ),
				        ),
			        ),
		        ),
	        );
	        tailor_control_presets( $this, $general_control_types, $general_control_arguments, $priority );

	        $priority = 0;
	        $color_control_types = array(
		        'color',
		        'link_color',
		        'heading_color',
		        'background_color',
		        'border_color',
	        );
	        $color_control_arguments = array();
	        tailor_control_presets( $this, $color_control_types, $color_control_arguments, $priority );

	        $priority = 0;
	        $attribute_control_types = array(
		        'class',
		        'padding',
		        'margin',
		        'border_style',
		        'border_width',
		        'border_radius',
		        'shadow',
		        'background_image',
		        'background_repeat',
		        'background_position',
		        'background_size',
		        'hidden',
	        );
	        $attribute_control_arguments = array(
		        'margin'                =>  array(
                    'control'               =>  array(
                        'choices'               =>  array(
                            'top'                   =>  __( 'Top', tailor()->textdomain() ),
                            'bottom'                =>  __( 'Bottom', tailor()->textdomain() ),
                        ),
                    ),
		        ),
	        );
	        tailor_control_presets( $this, $attribute_control_types, $attribute_control_arguments, $priority );
        }

	    /**
	     * Returns custom CSS rules for the element.
	     *
	     * @since 1.0.0
	     *
	     * @param $atts
	     * @return array
	     */
	    public function generate_css( $atts = array() ) {
		    $css_rules = array();
		    $excluded_control_types = array();

		    $css_rules = tailor_css_presets( $css_rules, $atts, $excluded_control_types );

		    if ( ! empty( $atts['max_width'] ) ) {
			    $css_rules[] = array(
				    'selectors'         =>  array( '.tailor-section__content' ),
				    'declarations'      =>  array(
					    'max-width'         =>  esc_attr( $atts['max_width'] ),
				    ),
			    );
		    }

		    if ( ! empty( $atts['min_height'] ) ) {
			    $css_rules[] = array(
				    'selectors'         =>  array(),
				    'declarations'      =>  array(
					    'min-height'        =>  esc_attr( $atts['min_height'] ),
				    ),
			    );
		    }

		    return $css_rules;
	    }
    }
}
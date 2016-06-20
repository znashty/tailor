<?php

/**
 * Tailor List Item element class.
 *
 * @package Tailor
 * @subpackage Elements
 * @since 1.0.0
 */

defined( 'ABSPATH' ) or die();

if ( class_exists( 'Tailor_Element' ) && ! class_exists( 'Tailor_List_Item_Element' ) ) {

    /**
     * Tailor List Item element class.
     *
     * @since 1.0.0
     */
    class Tailor_List_Item_Element extends Tailor_Element {

        /**
         * Registers element settings, sections and controls.
         *
         * @since 1.0.0
         * @access protected
         */
        protected function register_controls() {

	        $this->add_section( 'general', array(
		        'title'                 =>  __( 'General', 'tailor' ),
		        'priority'              =>  10,
	        ) );

	        $this->add_section( 'colors', array(
		        'title'                 =>  __( 'Colors', 'tailor' ),
		        'priority'              =>  20,
	        ) );

	        $this->add_section( 'attributes', array(
		        'title'                 =>  __( 'Attributes', 'tailor' ),
		        'priority'              =>  30,
	        ) );

	        $priority = 0;
	        $general_control_types = array(
		        'title',
		        'alignment',
		        'graphic_type',
		        'icon',
		        'image',
		        'graphic_size',
	        );
	        $general_control_arguments = array(
		        'title'                 =>  array(
			        'setting'               =>  array(
				        'default'               =>  $this->label,
			        ),
		        ),
		        'alignment'             =>  array(
			        'control'               =>  array(
				        'choices'               =>  array(
					        'left'                  =>  __( 'Left', 'tailor' ),
					        'right'                 =>  __( 'Right', 'tailor' ),
				        ),
			        ),
		        ),
		        'graphic_type'          =>  array(
			        'control'               =>  array(
				        'choices'               =>  array(
					        'icon'                  =>  __( 'Icon', 'tailor' ),
					        'image'                 =>  __( 'Image', 'tailor' ),
					        'number'                =>  __( 'Number', 'tailor' ),
				        ),
			        ),
		        ),
		        'icon'                  =>  array(
			        'control'               =>  array(
				        'dependencies'          =>  array(
					        'graphic_type'          =>  array(
						        'condition'             =>  'not',
						        'value'                 =>  array( 'image', 'number' ),
					        ),
				        ),
			        ),
		        ),
		        'image'                 =>  array(
			        'control'               =>  array(
				        'dependencies'          =>  array(
					        'graphic_type'          =>  array(
						        'condition'             =>  'equals',
						        'value'                 =>  'image',
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
		        'graphic_color',
		        'graphic_color_hover',
		        'graphic_background_color',
		        'graphic_background_color_hover',
	        );
	        $color_control_arguments = array(
                'graphic_color'         =>  array(
                    'control'               =>  array(
                        'dependencies'          =>  array(
                            'graphic_type'          =>  array(
                                'condition'             =>  'not',
                                'value'                 =>  'image',
                            ),
                        ),
                    ),
                ),
                'graphic_color_hover'   =>  array(
                    'control'               =>  array(
                        'dependencies'          =>  array(
                            'graphic_type'          =>  array(
                                'condition'             =>  'not',
                                'value'                 =>  'image',
                            ),
                        ),
                    ),
                ),
                'graphic_background_color'  =>  array(
                    'control'               =>  array(
                        'dependencies'          =>  array(
                            'graphic_type'          =>  array(
                                'condition'             =>  'not',
                                'value'                 =>  'image',
                            ),
                        ),
                    ),
                ),
                'graphic_background_color_hover'    =>  array(
                    'control'               =>  array(
                        'dependencies'          =>  array(
                            'graphic_type'          =>  array(
                                'condition'             =>  'not',
                                'value'                 =>  'image',
                            ),
                        ),
                    ),
                ),
	        );
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
	        );
	        $attribute_control_arguments = array(
		        'margin'                =>  array(
                    'control'               =>  array(
                        'choices'               =>  array(
                            'top'                   =>  __( 'Top', 'tailor' ),
                            'bottom'                =>  __( 'Bottom', 'tailor' ),
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

		    if ( empty( $atts['graphic_type'] ) || 'image' != $atts['graphic_type'] ) {
			    if ( ! empty( $atts['graphic_color'] ) ) {
				    $css_rules[] = array(
					    'selectors'         =>  array( '.tailor-list__graphic' ),
					    'declarations'      =>  array(
						    'color'             =>  esc_attr( $atts['graphic_color'] ),
					    ),
				    );
			    }

			    if ( ! empty( $atts['graphic_color_hover'] ) ) {
				    $css_rules[] = array(
					    'selectors'         =>  array( ':hover .tailor-list__graphic' ),
					    'declarations'      =>  array(
						    'color'             =>  esc_attr( $atts['graphic_color_hover'] ),
					    ),
				    );
			    }

			    if ( ! empty( $atts['graphic_background_color'] ) ) {
				    $css_rules[] = array(
					    'selectors'         =>  array( '.tailor-list__graphic' ),
					    'declarations'      =>  array(
						    'background-color'  =>  esc_attr( $atts['graphic_background_color'] ),
					    ),
				    );
			    }

			    if ( ! empty( $atts['graphic_background_color_hover'] ) ) {
				    $css_rules[] = array(
					    'selectors'         =>  array( ':hover .tailor-list__graphic' ),
					    'declarations'      =>  array(
						    'background-color'  =>  esc_attr( $atts['graphic_background_color_hover'] ),
					    ),
				    );
			    }

                if ( ! empty( $atts['graphic_background_color'] ) || ! empty( $atts['graphic_background_color_hover'] ) ) {

                    $alignment = empty( $atts['alignment'] ) ? 'left' : $atts['alignment'];

                    $css_rules[] = array(
                        'selectors'                 =>  array( '.tailor-list__body' ),
                        'declarations'              =>  array(
                            "padding-{$alignment}"      =>  '1em',
                        ),
                    );
                }

			    if ( ! empty( $atts['graphic_size'] ) ) {

				    $value = tailor_strip_unit( $atts['graphic_size'] );

				    $css_rules[] = array(
					    'selectors'         =>  array( '.tailor-list__title' ),
					    'declarations'      =>  array(
						    'margin'            =>  esc_attr( "calc( {$value[0]}{$value[1]} - 1em ) 0 0.5em" ),
					    ),
				    );

				    $css_rules[] = array(
					    'selectors'         =>  array( '.tailor-list__graphic' ),
					    'declarations'      =>  array(
						    'width'             =>  esc_attr( ( $value[0] * 2 ) . $value[1] ),
						    'height'            =>  esc_attr( ( $value[0] * 2 ) . $value[1] ),
					    ),
				    );

				    $css_rules[] = array(
					    'selectors'         =>  array( '.tailor-list__graphic span' ),
					    'declarations'      =>  array(
						    'font-size'         =>  esc_attr( $atts['graphic_size'] ),
					    ),
				    );
			    }
		    }
		    else {

			    if ( ! empty( $atts['graphic_size'] ) ) {

				    $value = tailor_strip_unit( $atts['graphic_size'] );

				    $css_rules[] = array(
					    'selectors'         =>  array( '.tailor-list__graphic' ),
					    'declarations'      =>  array(
						    'width'             =>  esc_attr( $value[0] . $value[1] ),
						    'max-width'         =>  '100%',
					    ),
				    );
			    }
		    }

		    return $css_rules;
	    }
    }
}
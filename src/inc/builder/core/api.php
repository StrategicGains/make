<?php
/**
 * @package ttf-one
 */

if ( ! class_exists( 'TTF_One_Sections' ) ) :
/**
 * Collector for builder sections.
 *
 * @since 1.0.0.
 *
 * Class TTF_One_Sections
 */
class TTF_One_Sections {
	/**
	 * The sections for the builder.
	 *
	 * @since 1.0.0.
	 *
	 * @var   array    The sections for the builder.
	 */
	private $_sections = array();

	/**
	 * The one instance of TTF_One_Sections.
	 *
	 * @since 1.0.0.
	 *
	 * @var   TTF_One_Sections
	 */
	private static $instance;

	/**
	 * Instantiate or return the one TTF_One_Sections instance.
	 *
	 * @since  1.0.0.
	 *
	 * @return TTF_One_Sections
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Create a new section.
	 *
	 * @since  1.0.0.
	 *
	 * @return TTF_One_Sections
	 */
	public function __constructor() {}

	/**
	 * Return the sections.
	 *
	 * @since  1.0.0.
	 *
	 * @return array    The array of sections.
	 */
	public function get_sections() {
		return $this->_sections;
	}

	/**
	 * Return the sections.
	 *
	 * @since  1.0.0.
	 *
	 * @param  string    $id                  Unique ID for the section.
	 * @param  string    $label               Name to display for the section.
	 * @param  string    $description         Section description.
	 * @param  string    $icon                URL to the icon for the display.
	 * @param  string    $save_callback       Function to save the content.
	 * @param  string    $builder_template    Path to the template used in the builder.
	 * @param  string    $display_template    Path to the template used for the frontend.
	 * @param  int       $order               The order in which to display the item.
	 * @return void
	 */
	public function add_section( $id, $label, $icon, $description, $save_callback, $builder_template, $display_template, $order ) {
		$this->_sections[ $id ] = array(
			'id'               => $id,
			'label'            => $label,
			'icon'             => $icon,
			'description'      => $description,
			'save_callback'    => $save_callback,
			'builder_template' => $builder_template,
			'display_template' => $display_template,
			'order'            => $order,
		);
	}
}
endif;

if ( ! function_exists( 'ttfmake_get_sections_class' ) ) :
/**
 * Instantiate or return the one TTF_One_Sections instance.
 *
 * @since  1.0.0.
 *
 * @return TTF_One_Sections
 */
function ttfmake_get_sections_class() {
	return TTF_One_Sections::instance();
}
endif;

if ( ! function_exists( 'ttfmake_get_sections' ) ) :
/**
 * Get the registered sections.
 *
 * @since  1.0.0.
 *
 * @return array    The list of registered sections.
 */
function ttfmake_get_sections() {
	return ttfmake_get_sections_class()->get_sections();
}
endif;

if ( ! function_exists( 'ttfmake_get_sections_by_order' ) ) :
/**
 * Get the registered sections by the order parameter.
 *
 * @since  1.0.0.
 *
 * @return array    The list of registered sections in the parameter order.
 */
function ttfmake_get_sections_by_order() {
	$sections = ttfmake_get_sections_class()->get_sections();
	usort( $sections, 'ttfmake_sorter' );
	return $sections;
}
endif;

if ( ! function_exists( 'ttfmake_sorter' ) ) :
/**
 * Callback for `usort()` that sorts sections by order.
 *
 * @since  1.0.0.
 *
 * @param  mixed    $a    The first element.
 * @param  mixed    $b    The second element.
 * @return mixed          The result.
 */
function ttfmake_sorter( $a, $b ) {
	return $a['order'] - $b['order'];
}
endif;

if ( ! function_exists( 'ttfmake_add_section' ) ) :
/**
 * Return the sections.
 *
 * @since  1.0.0.
 *
 * @param  string    $id                  Unique ID for the section.
 * @param  string    $label               Name to display for the section.
 * @param  string    $description         Section description.
 * @param  string    $icon                URL to the icon for the display.
 * @param  string    $save_callback       Function to save the content.
 * @param  string    $builder_template    Path to the template used in the builder.
 * @param  string    $display_template    Path to the template used for the frontend.
 * @param  int       $order               The order in which to display the item.
 * @return void
 */
function ttfmake_add_section( $id, $label, $icon, $description, $save_callback, $builder_template, $display_template, $order ) {
	ttfmake_get_sections_class()->add_section( $id, $label, $icon, $description, $save_callback, $builder_template, $display_template, $order );
}
endif;
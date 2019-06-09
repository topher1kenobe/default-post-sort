<?php
/**
 * Creates the class which provides the UI for setting a default post order
 *
 * @since Default_Post_Orderby 1.0
 * @author Topher
 */


/**
 * Instantiate the Default_Post_Orderby instance
 * @since Default_Post_Orderby 1.0
 */
add_action( 'admin_init', [ 'Default_Post_Orderby', 'instance' ] );

class Default_Post_Orderby {

	/**
    * Instance handle
    *
    * @static
    * @since 1.2
    * @var string
    */
	private static $__instance = null;

	/**
    * Types of sort that we allow
    *
	* @access private
    * @since 1.0
    * @var array
    */
	private $sort_types = [
		'none'          => 'None',
		'ID'            => 'ID',
		'author'        => 'Author',
		'title'         => 'Title',
		'name'          => 'Name',
		'date'          => 'Date',
		'modified'      => 'Date Last Modified',
		'rand'          => 'Random',
		'comment_count' => 'Comment Count',
		'menu_order'    => 'Menu Order',
	];

	/**
    * Order of sorts that we allow
    *
	* @access private
    * @since 1.0
    * @var array
    */
	private $sort_orders = [
		'ASC'  => 'Ascending',
		'DESC' => 'Descending',
	];

    /**
     * Constructor, actually contains nothing
     *
     * @access public
     * @return void
     */
	public function __construct() {
	}

    /**
     * Instance initiator, runs setup etc.
     *
	 * @static
     * @access public
     * @return self
     */
	public static function instance() {
		if ( ! is_a( self::$__instance, __CLASS__ ) ) {
			self::$__instance = new self;
			self::$__instance->dpo_settings_api_init();
		}

		return self::$__instance;
	}
	 
    /**
     * Instance initiator, runs setup etc.
     *
     * @access public
     * @return NULL
     */
	public function dpo_settings_api_init() {

		add_settings_section(
			'dpo_setting_section',
			'',
			[ $this, 'dpo_setting_section_callback_function' ],
			'reading'
		);
		
		add_settings_field(
			'default_post_sort',
			'Sort Posts by:',
			[ $this, 'orderby_callback' ],
			'reading',
			'dpo_setting_section'
		);
		register_setting( 'reading', 'default_post_sort' );

		add_settings_field(
			'default_post_order',
			'Sort order directions:',
			[ $this, 'order_callback' ],
			'reading',
			'dpo_setting_section'
		);
		register_setting( 'reading', 'default_post_order' );

	}

    /**
     * Settings header callback function.  Prints text above the option set
     *
     * @access public
     * @return NULL
     */
	public function dpo_setting_section_callback_function() {
		echo '<p><a href="https://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank" rel="noopener noreferrer">Read more about Orderby options.</a></p>';
	}

    /**
     * Settings section callback function. Contains the form for the options
     *
     * @access public
     * @return NULL
     */
	public function orderby_callback() {

		$preset_sort = get_option( 'default_post_sort' );

		if ( empty( $preset_sort ) || ! array_key_exists( $preset_sort, $this->sort_types ) ) {
			$preset_sort = '';
		}

		if ( ! empty( $this->sort_types ) ) {
			echo '<ul>' . "\n";
			foreach( $this->sort_types as $type => $type_name ) {
				echo '<li><input name="default_post_sort" id="default_post_sort_' . esc_attr( $type ) . '" type="radio" value="' . esc_attr( $type ) . '" class="default_post_sort" ' . checked( esc_attr( $type ), esc_attr( $preset_sort ), false ) . ' /><label for="default_post_sort_' . esc_attr( $type ) . '">' . esc_html( $type_name ) . '</label></li>' . "\n";
			}
			echo '</ul>' . "\n";
		}

	}

    /**
     * Settings section callback function. Contains the form for the options
     *
     * @access public
     * @return NULL
     */
	public function order_callback() {

		$preset_order = get_option( 'default_post_order' );

		if ( empty( $preset_order ) || ! array_key_exists( $preset_order, $this->sort_orders ) ) {
			$preset_order = '';
		}

		if ( ! empty( $this->sort_orders ) ) {
			echo '<ul>' . "\n";
			foreach( $this->sort_orders as $order => $order_name ) {
				echo '<li><input name="default_post_order" id="default_post_order_' . esc_attr( $order ) . '" type="radio" value="' . esc_attr( $order ) . '" class="default_post_order" ' . checked( esc_attr( $order ), esc_attr( $preset_order ), false ) . ' /><label for="default_post_order_' . esc_attr( $order ) . '">' . esc_html( $order_name ) . '</label></li>' . "\n";
			}
			echo '</ul>' . "\n";
		}

	}

}

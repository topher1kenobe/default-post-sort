<?php

/**
 * Change the direction order of blog post sorting
 *
 * @access public
 * @param mixed $query
 * @return void
 */

/**
 * Instantiate the Default_Post_Order instance
 * @since Default_Post_Order 1.0
 */
add_action( 'init', [ 'Default_Post_Order', 'instance' ] );

class Default_Post_Order {

    /**
    * Instance handle
    *
    * @static
    * @since 1.2
    * @var string
    */
    private static $__instance = null;

    /**
     * Constructor, actually contains nothing
     *
     * @access public
     * @return void
     */
    public function __construct() {
    }

    /*
     * Instance initiator, runs setup etc.
     *
     * @static
     * @access public
     * @return self
     */
    public static function instance() {
        if ( ! is_a( self::$__instance, __CLASS__ ) ) {
            self::$__instance = new self;
            self::$__instance->hooks();
        }

        return self::$__instance;
    }

    /*
     * Run hooks
     *
     * @access public
     * @return NULL
     */
    public function hooks() {
		add_action( 'pre_get_posts', [ $this, 'dpo_set_post_order' ] );
    }

    /**
     * Settings header callback function.  Prints text above the option set
     *
     * @access public
     * @return NULL
     */
	public function dpo_set_post_order( $query ) {
		// make sure we're looking in the right place
		if ( is_home() && $query->is_main_query() && ! is_admin() ) {
				$query->set('orderby', esc_attr( get_option( 'default_post_sort' ) ) );
				$query->set('order',   esc_attr( get_option( 'default_post_order' ) ) );
		}
	}
}

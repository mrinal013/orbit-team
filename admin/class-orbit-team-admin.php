<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mrinalbd.com/
 * @since      1.0.0
 *
 * @package    Orbit_Team
 * @subpackage Orbit_Team/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Orbit_Team
 * @subpackage Orbit_Team/admin
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Orbit_Team_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    public function orbit_team_post_type() {
        $labels = array(
            'name'                  => _x( 'Orbit Team', 'orbit team members', 'orbit-team' ),
            'singular_name'         => _x( 'Orbit Team', 'Post type singular name', 'orbit-team' ),
            'menu_name'             => _x( 'Orbit Team', 'Admin Menu text', 'orbit-team' ),
            'name_admin_bar'        => _x( 'Orbit Team', 'Add New on Toolbar', 'orbit-team' ),
            'add_new'               => __( 'Add New', 'orbit-team' ),
            'add_new_item'          => __( 'Add New recipe', 'orbit-team' ),
            'new_item'              => __( 'New recipe', 'orbit-team' ),
            'edit_item'             => __( 'Edit recipe', 'orbit-team' ),
            'view_item'             => __( 'View recipe', 'orbit-team' ),
            'all_items'             => __( 'All team members', 'orbit-team' ),
            'search_items'          => __( 'Search team member', 'orbit-team' ),
            'not_found'             => __( 'No team member found.', 'orbit-team' ),
            'not_found_in_trash'    => __( 'No team member found in Trash.', 'orbit-team' ),
            'featured_image'        => _x( "Team Member's Cover Image", 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'recipe' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'recipe' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'recipe' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'recipe' ),
            'archives'              => _x( 'Team member archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'recipe' ),
            'insert_into_item'      => _x( 'Insert into team member', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'recipe' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this team member', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'recipe' ),
            'filter_items_list'     => _x( 'Filter recipes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'recipe' ),
            'items_list_navigation' => _x( 'Recipes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'recipe' ),
            'items_list'            => _x( 'Recipes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'recipe' ),
        );
        $args = array(
            'labels'             => $labels,
            'description'        => _x('Orbit Team', 'orbit-team'),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'team' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 20,
            'supports'           => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies'         => array( 'position' ),
            'show_in_rest'       => true
        );

        register_post_type( 'team', $args );
    }

    public function member_type_category() {
        $labels = array(
            'name'              => _x( 'Member Types', 'member types', 'orbit-team' ),
            'singular_name'     => _x( 'Member Type', 'member type', 'orbit-team' ),
            'search_items'      => __( 'Search Member Types', 'orbit-team' ),
            'all_items'         => __( 'All Member Types', 'orbit-team' ),
            'parent_item'       => __( 'Parent Member Type', 'orbit-team' ),
            'parent_item_colon' => __( 'Parent Member Type:', 'orbit-team' ),
            'edit_item'         => __( 'Edit Member Type', 'orbit-team' ),
            'update_item'       => __( 'Update Member Type', 'orbit-team' ),
            'add_new_item'      => __( 'Add New Member Type', 'orbit-team' ),
            'new_item_name'     => __( 'New Genre Member Type', 'orbit-team' ),
            'menu_name'         => __( 'Member Type', 'orbit-team' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'member-type' ),
        );

        register_taxonomy( 'member-type', array( 'team' ), $args );
    }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Orbit_Team_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Orbit_Team_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/orbit-team-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Orbit_Team_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Orbit_Team_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/orbit-team-admin.js', array( 'jquery' ), $this->version, false );

	}

}

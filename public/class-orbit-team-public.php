<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://mrinalbd.com/
 * @since      1.0.0
 *
 * @package    Orbit_Team
 * @subpackage Orbit_Team/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Orbit_Team
 * @subpackage Orbit_Team/public
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Orbit_Team_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

        add_shortcode('team_members', array( $this, 'team_members_shortcode_callback' ) );

	}

    public function team_members_shortcode_callback($atts) {
        $attributes = shortcode_atts( array(
            'number'    => 4,
            'position'  => 'top',
            'button'    => true
        ), $atts );
        $number = $attributes['number'];
        $team_args = array(
            'post_type'         => 'team',
            'posts_per_page'    =>  $number,
        );

        $team_query = new WP_Query($team_args);

//        echo '<pre>';
//        print_r($team_query->posts);
//        echo '</pre>';

        ob_start();

        if ( $team_query->have_posts() ) :
        ?>
        <div class="team-wrapper">
            <?php
            while ( $team_query->have_posts() ) :
                $team_query->the_post();
                $image = get_the_post_thumbnail_url();
                $position = 'Developer';
            ?>
            <div class="team-member">
                <a href="<?php echo get_permalink(); ?>">
                    <img src="<?php echo $image; ?>" alt="">
                </a>
                <a href="<?php echo get_permalink(); ?>">
                    <h2><?php the_title(); ?></h2>
                </a>
                <p><?php echo $position; ?></p>
            </div>
            <?php
            endwhile;
            ?>
        </div>
            <a href="<?php echo get_post_type_archive_link('team'); ?>"  class="all-members"><button>All Members</button></a>
        <?php
        endif;
        return ob_get_clean();
    }

    public function team_members_template($template) {
        if ( is_post_type_archive('team') ) {
            $template = plugin_dir_path(__FILE__) . 'team-members.php';
        }
        return $template;
    }

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/orbit-team-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/orbit-team-public.js', array( 'jquery' ), $this->version, false );

	}

}

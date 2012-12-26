<?php

	if (!function_exists('m413_options')) {
		// Admin functions
		require_once(get_template_directory() . '/admin/admin-functions.php');
		require_once(get_template_directory() . '/admin/admin-interface.php');
		require_once(get_template_directory() . '/admin/theme-settings.php');
		require_once(get_template_directory() . '/admin/admin-custom-functions.php');
	}

	if ( ! class_exists( 'cmb_Meta_Box' ) ) {
		// register metaboxes
		require_once(get_template_directory() . '/functions/post-metabox.php');
		require_once(get_template_directory() . '/functions/page-metabox.php');
	}

	//add shortcodes functions
	require_once(get_template_directory() . '/functions/shortcodes.php');

	if(!class_exists('AQ_Page_Builder')) {
		//Register Aqua Page Builder 
		require_once(get_template_directory() . '/functions/aqua-page-builder/aq-page-builder.php');
	}

	if ( class_exists( 'MarketPress' ) ) {
		//Register MarketPress related functions
		require_once(get_template_directory() . '/functions/mp-functions.php');
		require_once(get_template_directory() . '/functions/mp-metabox.php');
		require_once(get_template_directory() . '/functions/mp-widgets.php');
	}

	// Register Custom Navigation Walker
	require_once(get_template_directory() . '/functions/twitter_bootstrap_nav_walker.php');

	// register CSS 
	function mpt_register_style() {
		wp_enqueue_style('prettyphoto-style', get_template_directory_uri() . '/css/prettyPhoto.css', null, null);
	}
	add_action('wp_enqueue_scripts', 'mpt_register_style');

	// register JS
	function mpt_register_js(){
		wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));
		wp_enqueue_script('filterablejs', get_template_directory_uri() . '/js/filterable.js', array('jquery'));
		wp_enqueue_script('prettyphotojs', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'));
	}
	add_action('wp_enqueue_scripts', 'mpt_register_js');


	if ( class_exists( 'MarketPress' ) ) {
		// register marketpress css
		function mpt_enqueue_mp_css() {
			wp_deregister_style('mp-store-theme');
			wp_enqueue_style('mp-flexmarket-css', get_template_directory_uri() . '/css/mp.css', null, null);
		}

		add_action('wp_enqueue_scripts', 'mpt_enqueue_mp_css');
	}

	// register menu
	if(function_exists('register_nav_menus')){
		register_nav_menus(array(
		'mainmenu' => 'Main Menu'
				)
			);
	}

	// add sidebar
	if(function_exists('register_sidebar')){
			register_sidebar(array(
				'name' => 'Sidebar',
				'id' => 'sidebar',
				'description' => 'Widgets in this area will be shown on the right-hand side.',
				'before_widget' => '<div class="well well-small">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="page-header">',
				'after_title' => '</h4>'
			)
		);

			register_sidebar(array(
				'name' => 'Footer One',
				'id' => 'footer-one',
				'description' => 'First Footer Widget',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h4 class="page-header"><span>',
				'after_title' => '</span></h4>'
			)
		);
			register_sidebar(array(
				'name' => 'Footer Two',
				'id' => 'footer-two',
				'description' => 'Second Footer Widget',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h4 class="page-header"><span>',
				'after_title' => '</span></h4>'
			)
		);
			register_sidebar(array(
				'name' => 'Footer Three',
				'id' => 'footer-three',
				'description' => 'Three Footer Widget',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h4 class="page-header"><span>',
				'after_title' => '</span></h4>'
			)
		);				
	}
	
	// add post type support to page and post
	add_action( 'init', 'add_extra_metabox' );
	function add_extra_metabox() {
		 add_post_type_support( 'page', 'excerpt' );
		 add_post_type_support( 'page', 'thumbnail' );
		 add_post_type_support( 'post', 'excerpt');
		 add_post_type_support( 'post', 'custom-fields');
		 add_post_type_support( 'post', 'comments');
	}

	// add comment function to Product Page
	if ( class_exists( 'MarketPress' ) ) {
		add_action( 'init', 'allow_comments_marketpress' );
		
		function allow_comments_marketpress() {
			add_post_type_support( 'product', 'comments' );
		}
	}
	
	// add thumbnail support to theme
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
	}

	// add additional image size
	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'tb-360', 360, 270, true );
		add_image_size( 'tb-860', 860, 300, true );
	}

	// set excerpt lenght to custom character length
	function the_excerpt_max_charlength($charlength) {
		$excerpt = get_the_excerpt();
		$charlength++;

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				echo mb_substr( $subex, 0, $excut );
			} else {
				echo $subex;
			}
			echo '[...]';
		} else {
			echo $excerpt;
		}
	}
		
/**
 * Initialize the metabox class.
 */

	add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
	 
	function cmb_initialize_cmb_meta_boxes() {

		if ( ! class_exists( 'cmb_Meta_Box' ) )
			require_once(get_template_directory() . '/functions/metabox/init.php');

	}

/**
 * Breadcrumb for wordpress.
 */

	function mpt_get_the_breadcrumbs() {

		$output = '';

		$output .= '<ul class="breadcrumb">';

		if (!is_home()) {
			
			$output .= '<li><a href="'.home_url().'">Home</a> <span class="divider">/</span></li>';

			if (is_category() || is_single()) {
				$output .= '<li>'.the_category(' <span class="divider">/</span></li><li>').' <span class="divider">/</span></li>';
				$output .= is_single() ? '<li class="active">'.the_title().'</li>' : '';
			} elseif (is_page()) {
				$output .= '<li class="active">'.the_title().'</li>';
			}
		} 

		elseif (is_tag()) { 
			$output .= '<li><a href="'.home_url().'">Home</a> <span class="divider">/</span></li>'; 
			$output .= '<li class="active">'.single_tag_title().'</li>';
		}
		
		elseif (is_day()) {
			$output .= '<li><a href="'.home_url().'">Home</a> <span class="divider">/</span></li>'; 
			$output .= '<li class="active">Archive for '.the_time('F jS, Y').'</li>';
		}

		elseif (is_month()) {
			$output .= '<li><a href="'.home_url().'">Home</a> <span class="divider">/</span></li>'; 
			$output .= '<li class="active">Archive for '.the_time('F, Y').'</li>';
		}

		elseif (is_year()) {
			$output .= '<li><a href="'.home_url().'">Home</a> <span class="divider">/</span></li>'; 
			$output .= '<li class="active">Archive for '.the_time('Y').'</li>';			
		}

		elseif (is_author()) {
			$output .= '<li><a href="'.home_url().'">Home</a> <span class="divider">/</span></li>'; 
			$output .= '<li class="active">Author Archive</li>';				
		}

		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
			$output .= '<li><a href="'.home_url().'">Home</a> <span class="divider">/</span></li>'; 
			$output .= '<li class="active">Blog Archives</li>';					
		}

		elseif (is_search()) {
			$output .= '<li><a href="'.home_url().'">Home</a> <span class="divider">/</span></li>'; 
			$output .= '<li class="active">Search Results</li>';				
		}

		$output .= '</ul>';

		echo $output;
	}

?>
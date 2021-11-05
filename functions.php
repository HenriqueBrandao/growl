<?php
/**
 * Growl Exercise functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Growl_Exercise
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'growl_exercise_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function growl_exercise_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Growl Exercise, use a find and replace
		 * to change 'growl-exercise' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'growl-exercise', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'growl-exercise' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'growl_exercise_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'growl_exercise_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function growl_exercise_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'growl_exercise_content_width', 640 );
}
add_action( 'after_setup_theme', 'growl_exercise_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function growl_exercise_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'growl-exercise' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'growl-exercise' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'growl_exercise_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function growl_exercise_scripts() {
	wp_enqueue_style( 'growl-exercise-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'growl-exercise-style', 'rtl', 'replace' );
	wp_enqueue_script( 'growl-jquery', get_template_directory_uri() . '/js/jquery-3.6.0.min.js', array(), true );
	wp_enqueue_script( 'growl-main', get_template_directory_uri() . '/js/main.js', array(), true );
}
add_action( 'wp_enqueue_scripts', 'growl_exercise_scripts' );






/* CUSTOM POST TYPES */

function cptui_register_my_cpts() {

	/**
	 * Post Type: Books.
	 */

	$labels = [
		"name" => __( "Books", "growl-exercise" ),
		"singular_name" => __( "Book", "growl-exercise" ),
		"menu_name" => __( "Books", "growl-exercise" ),
		"all_items" => __( "All Books", "growl-exercise" ),
		"add_new" => __( "Add new", "growl-exercise" ),
		"add_new_item" => __( "Add new Book", "growl-exercise" ),
		"edit_item" => __( "Edit Book", "growl-exercise" ),
		"new_item" => __( "New Book", "growl-exercise" ),
		"view_item" => __( "View Book", "growl-exercise" ),
		"view_items" => __( "View Books", "growl-exercise" ),
		"search_items" => __( "Search Books", "growl-exercise" ),
		"not_found" => __( "No Books found", "growl-exercise" ),
		"not_found_in_trash" => __( "No Books found in trash", "growl-exercise" ),
		"parent" => __( "Parent Book:", "growl-exercise" ),
		"featured_image" => __( "Featured image for this Book", "growl-exercise" ),
		"set_featured_image" => __( "Set featured image for this Book", "growl-exercise" ),
		"remove_featured_image" => __( "Remove featured image for this Book", "growl-exercise" ),
		"use_featured_image" => __( "Use as featured image for this Book", "growl-exercise" ),
		"archives" => __( "Book archives", "growl-exercise" ),
		"insert_into_item" => __( "Insert into Book", "growl-exercise" ),
		"uploaded_to_this_item" => __( "Upload to this Book", "growl-exercise" ),
		"filter_items_list" => __( "Filter Books list", "growl-exercise" ),
		"items_list_navigation" => __( "Books list navigation", "growl-exercise" ),
		"items_list" => __( "Books list", "growl-exercise" ),
		"attributes" => __( "Books attributes", "growl-exercise" ),
		"name_admin_bar" => __( "Book", "growl-exercise" ),
		"item_published" => __( "Book published", "growl-exercise" ),
		"item_published_privately" => __( "Book published privately.", "growl-exercise" ),
		"item_reverted_to_draft" => __( "Book reverted to draft.", "growl-exercise" ),
		"item_scheduled" => __( "Book scheduled", "growl-exercise" ),
		"item_updated" => __( "Book updated.", "growl-exercise" ),
		"parent_item_colon" => __( "Parent Book:", "growl-exercise" ),
	];

	$args = [
		"label" => __( "Books", "growl-exercise" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "books", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "books", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );





/* TAXONOMIES */


function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Book Categories.
	 */

	$labels = [
		"name" => __( "Book Categories", "growl-exercise" ),
		"singular_name" => __( "Book Category", "growl-exercise" ),
		"menu_name" => __( "Book Categories", "growl-exercise" ),
		"all_items" => __( "All book categories", "growl-exercise" ),
		"edit_item" => __( "Edit book categories", "growl-exercise" ),
		"view_item" => __( "View book categories", "growl-exercise" ),
		"update_item" => __( "Update book_categories name", "growl-exercise" ),
		"add_new_item" => __( "Add new book categories", "growl-exercise" ),
		"new_item_name" => __( "New book categories name", "growl-exercise" ),
		"parent_item" => __( "Parent book categories", "growl-exercise" ),
		"parent_item_colon" => __( "Parent book categories:", "growl-exercise" ),
		"search_items" => __( "Search book categories", "growl-exercise" ),
		"popular_items" => __( "Popular book categories", "growl-exercise" ),
		"separate_items_with_commas" => __( "Separate book categories with commas", "growl-exercise" ),
		"add_or_remove_items" => __( "Add or remove book categories", "growl-exercise" ),
		"choose_from_most_used" => __( "Choose from the most used book categories", "growl-exercise" ),
		"not_found" => __( "No book categories found", "growl-exercise" ),
		"no_terms" => __( "No book categories", "growl-exercise" ),
		"items_list_navigation" => __( "book categories list navigation", "growl-exercise" ),
		"items_list" => __( "book categories list", "growl-exercise" ),
		"back_to_items" => __( "Back to book categories", "growl-exercise" ),
	];

	
	$args = [
		"label" => __( "Book Categories", "growl-exercise" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'book_categories', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "book_categories",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "book_categories", [ "books" ], $args );

	/**
	 * Taxonomy: Colors.
	 */

	$labels = [
		"name" => __( "Colors", "growl-exercise" ),
		"singular_name" => __( "Color", "growl-exercise" ),
		"menu_name" => __( "Colors", "growl-exercise" ),
		"all_items" => __( "All Colors", "growl-exercise" ),
		"edit_item" => __( "Edit Color", "growl-exercise" ),
		"view_item" => __( "View Color", "growl-exercise" ),
		"update_item" => __( "Update Color name", "growl-exercise" ),
		"add_new_item" => __( "Add new Color", "growl-exercise" ),
		"new_item_name" => __( "New Color name", "growl-exercise" ),
		"parent_item" => __( "Parent Color", "growl-exercise" ),
		"parent_item_colon" => __( "Parent Color:", "growl-exercise" ),
		"search_items" => __( "Search Colors", "growl-exercise" ),
		"popular_items" => __( "Popular Colors", "growl-exercise" ),
		"separate_items_with_commas" => __( "Separate Colors with commas", "growl-exercise" ),
		"add_or_remove_items" => __( "Add or remove Colors", "growl-exercise" ),
		"choose_from_most_used" => __( "Choose from the most used Colors", "growl-exercise" ),
		"not_found" => __( "No Colors found", "growl-exercise" ),
		"no_terms" => __( "No Colors", "growl-exercise" ),
		"items_list_navigation" => __( "Colors list navigation", "growl-exercise" ),
		"items_list" => __( "Colors list", "growl-exercise" ),
		"back_to_items" => __( "Back to Colors", "growl-exercise" ),
	];

	
	$args = [
		"label" => __( "Colors", "growl-exercise" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'colors', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "colors",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "colors", [ "books" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );










// Ajax Filter Books

add_action('wp_ajax_myfilter', 'books_filter_function');
add_action('wp_ajax_nopriv_myfilter', 'books_filter_function');

function books_filter_function(){

	$order = 'DESC';



	// SORTING 
	if( isset( $_POST['sortBooks'] ) ) {
		$valueSort = $_POST['sortBooks']; 

		if($valueSort == 'lastAdded'){
			$orderBy = 'date';
			$order = 'DESC';

		} elseif ($valueSort == 'AuthorFamilyName'){
			$meta_query = array('relation' => 'AND',);
			array_push(
				$meta_query,
				array('relation' => 'OR',
					array(
						'key' => 'author_family_name',
						'compare' => 'EXISTS'
					),
					array(
						'key' => 'author_family_name',
						'compare' => 'NOT EXISTS'
					)
				) 
			);
			$orderBy = 'meta_value_num meta_value ';
			$order = 'ASC'; 

		} elseif ($valueSort == 'BookTitle') {
			$orderBy = 'title';
			$order = 'ASC';
		}
	}
	// END SORTING

	
	$currentPage = 1;
	if ( isset( $_POST['paginationRadio'] ) ) {
		$currentPage = $_POST['paginationRadio'];
	}

	if(isset( $_POST['resetPagination'] )){
		$currentPage = $_POST['resetPagination'];
	}


	$args = array(
        'post_type' => 'books',
        'post_status' => 'publish',
        'posts_per_page' => 9, 
		'paged' => $currentPage,
		'orderby'=> $orderBy,
		'order' => $order,
		'meta_query' => $meta_query,
	);

	if( $bookCategories = get_terms( array( 'taxonomy' => 'book_categories' ) ) ) :
		$all_categories = array();
		foreach( $bookCategories as $bookCategory ) {
			 if( isset( $_POST['book_category_' .$bookCategory->term_id ] ) ) :
				$all_categories[] = $bookCategory->term_id;
			 endif;
		}
	endif;

	if( $bookColors = get_terms( array( 'taxonomy' => 'colors' ) ) ) :
		$all_colors = array();
		foreach( $bookColors as $bookColor ) {
			 if( isset( $_POST['color_' .$bookColor->term_id ] ) ) :
				$all_colors[] = $bookColor->term_id;
			 endif;
		}
	endif;


	if(!empty($all_colors) && !empty($all_categories)){
		$args['tax_query'] = array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'colors',
				'field' => 'id',
				'terms'=> $all_colors
			),
			array(
				'taxonomy' => 'book_categories',
				'field' => 'id',
				'terms'=> $all_categories
			)
		);
	} elseif (empty($all_colors) && !empty($all_categories)) {
			$args['tax_query'] = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'book_categories',
					'field' => 'id',
					'terms'=> $all_categories
				)
			);
	} elseif (empty($all_categories ) && !empty($all_colors)) {
		$args['tax_query'] = array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'colors',
				'field' => 'id',
				'terms'=> $all_colors
			)
		);
	}
	$pagination = 1;
	$query = new WP_Query( $args );
	$paginationTotal = $query->max_num_pages;

	/* 
	if ( isset( $_POST['paginationRadio'] ) && $_POST['paginationRadio'] > $paginationTotal ) {
		$currentPage = 1;
	}
	*/


	if( $query->have_posts() ) :
		
		while( $query->have_posts() ): $query->the_post();
			get_template_part( 'template-parts/book', 'loop' );
		endwhile;
		wp_reset_postdata();

		// Pagination 
		echo '<div id="paginacao">';
		while($pagination <= $paginationTotal ){
				if(($currentPage + 2) >= $paginationTotal){
					// If Pagination is Ending
					if($pagination >= ($paginationTotal - 2) ){
						if($pagination == $currentPage) {
							echo '<div><input checked class="paginationRadio" style="appearance: auto;"  type="radio" id="'.$pagination.'" name="paginationRadio" value="'.$pagination.'" />';
							echo '<label for="'.$pagination.'">'.$pagination.'</label></div>';
						} else{
							echo '<div><input class="paginationRadio" style="appearance: auto;"  type="radio" id="'.$pagination.'" name="paginationRadio" value="'.$pagination.'" />';
							echo '<label for="'.$pagination.'">'.$pagination.'</label></div>';
						}
					} elseif ( $pagination == 1) {
						echo '<div><input class="paginationRadio" style="appearance: auto;"  type="radio" id="'.$pagination.'" name="paginationRadio" value="'.$pagination.'" />';
						echo '<label for="'.$pagination.'">'.$pagination.'</label></div>';
						echo '<span>...</span>';
					}
				} else{
					if($pagination >= $currentPage && $pagination <= ($currentPage +2)  ){
						if($pagination == $currentPage) {
							echo '<div><input checked class="paginationRadio" style="appearance: auto;"  type="radio" id="'.$pagination.'" name="paginationRadio" value="'.$pagination.'" />';
							echo '<label for="'.$pagination.'">'.$pagination.'</label></div>';
						} else{
							echo '<div><input class="paginationRadio" style="appearance: auto;"  type="radio" id="'.$pagination.'" name="paginationRadio" value="'.$pagination.'" />';
							echo '<label for="'.$pagination.'">'.$pagination.'</label></div>';
						}
					} elseif ( $pagination == $paginationTotal) {
						echo '<span>...</span>';
						echo '<div><input class="paginationRadio" style="appearance: auto;"  type="radio" id="'.$pagination.'" name="paginationRadio" value="'.$pagination.'" />';
						echo '<label for="'.$pagination.'">'.$pagination.'</label></div>';
					} elseif ($pagination == 1){
						echo '<div><input class="paginationRadio" style="appearance: auto;"  type="radio" id="'.$pagination.'" name="paginationRadio" value="'.$pagination.'" />';
						echo '<label for="'.$pagination.'">'.$pagination.'</label></div>';
						if($currentPage - 2 > 0){
							echo '<span>...</span>';
						}
					}
				} 
			$pagination++;
		}
		echo '</div>';

		// End Pagination


	else :
		echo '<div class="noBooks">No Books found</div>';
	endif;
	
	?>
	<script>
		(function($) {
			$('.paginationRadio').change(function(){
				var filter = $('#filter');
				$.ajax({
					url: filter.attr('action'),
					data: filter.serialize(), 
					type:filter.attr('method'), 

					success:function(data){
						window.scrollTo({ top: 0 });
						$('#gridPaginated').html(data); 
					}
				});
				return false;
			});
		})( jQuery );
	</script>
	<?php

	die();
}
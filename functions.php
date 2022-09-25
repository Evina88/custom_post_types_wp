<?php

function loading_files() {
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('custom_post_type_css', get_theme_file_uri('/style.css'));
}

add_action('wp_enqueue_scripts', 'loading_files');

function general_features() {
  add_theme_support('title-tag');
}

add_action('after_setup_theme', 'general_features');

	function custom_post_type() {
	register_post_type('casinos', array(
		'public' => true,
		'has_archive' => true,
		//'show_in_rest' => true, // toggle to be able to use editor with the custom post type
		'labels' => array(
			'name' => 'Casinos',
			'add_new_item' => 'Add New Casino',
			'edit_item' => 'Edit Casino',
			'all_items' => 'All Casinos',
			'singular_name' => 'Casino',
		),
		'args' => array(
			'rewrite' => array(
				'slug' => 'casino'
			),
		)

	));
}

add_action('init', 'custom_post_type');

function display_casino_function() {

	$showC = new WP_Query(array(
	'posts_per_page' => 10,
	'post_type' => 'casinos',
	));?>

	<div class="main-container">
		<h1 class="casinos-title">Casinos</h1>

		<div class="choose-box">Choose a casino </div>

		<div class="casino-box-container">
	
			<?php while ($showC->have_posts()) {
				$showC->the_post(); ?>

					<div class="casino-box">
						<a href="<?php the_permalink();?>">
							<?php the_title(); ?>
						</a>

					</div>

			<?php } ?>
		
		</div>
	</div>

	<?php


}

add_shortcode('display_casino', 'display_casino_function');
 
?>

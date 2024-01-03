<?php
get_header();

$term = get_queried_object();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
	'post_type' => 'books',
	'posts_per_page' => 5,
	'paged' => $paged,
	'tax_query' => array(
		array(
			'taxonomy' => 'book-genre',
			'field' => 'slug',
			'terms' => $term->slug,
		),
	),
);

$query = new WP_Query($args);

if ($query->have_posts()) :
	while ($query->have_posts()) : $query->the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</header>

			<div class="entry-content">
				<?php
				if (has_post_thumbnail()) {
					the_post_thumbnail('thumbnail');
				}
				?>
				<?php the_excerpt(); ?>
			</div>
		</article>

	<?php endwhile;

	the_posts_pagination(array(
		'prev_text' => __('Previous', 'textdomain'),
		'next_text' => __('Next', 'textdomain'),
	));

	wp_reset_postdata();

else :
	echo '<p>No books found for this genre.</p>';

endif;

get_footer();
?>

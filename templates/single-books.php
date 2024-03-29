<?php
get_header();

while (have_posts()) : the_post(); ?>
	<article>
		<header>
			<h1><?php the_title(); ?></h1>
		</header>

		<div>
			<?php
			if (has_post_thumbnail()) {
				the_post_thumbnail('medium');
			}
			?>

			<p><strong>Genre:</strong> <?php echo get_the_term_list($post->ID, 'book-genre', '', ', ', ''); ?></p>
			<p><strong>Date:</strong> <?php the_date(); ?></p>

			<?php the_content(); ?>
		</div>
	</article>

<?php endwhile;

get_footer();
?>

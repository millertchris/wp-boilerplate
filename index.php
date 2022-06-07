<?php get_header(); ?>

<?php the_content(); ?>

<?php if (acf_activated() && have_rows('blocks')) : ?>

	<?php while (acf_activated() && have_rows('blocks')) : the_row(); ?>
		<?php $block_type = get_row_layout(); ?>

		<?php include(locate_template('blocks/' . $block_type . '.php')); ?>
	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>
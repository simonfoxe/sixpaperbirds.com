<?php get_header(); ?>

<?php if(is_post_type_archive() && ($region = get_page_by_path(get_post_type())) !== null): ?>
	<?php $temp = $post;
	$post = $region; ?>
	<?php get_template_part('tpl-header', 'type'); ?>
	<?php $post = $temp; ?>
<?php elseif(is_tax() && ($region = get_page_by_path(get_query_var('taxonomy'))) !== null): ?>
	<?php $term = get_queried_object();
	$temp = $post;
	$post = $region; ?>
	<?php get_template_part('tpl-header', 'term'); ?>
	<?php $post = $temp; ?>
<?php endif; ?>

<?php while(have_posts()): the_post(); ?>
	<?php get_template_part('tpl', get_post_type()); ?>
<?php endwhile; ?>

<?php get_footer(); ?>

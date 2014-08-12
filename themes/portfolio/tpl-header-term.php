<?php global $term; ?>
<section id="post_<?php the_ID(); ?>" <?php post_class('region article'); ?>>
	<header class="entry-header post-header <?php if(!has_post_thumbnail())
		echo 'bare'; ?>">
		<h1 class="entry-title">
			<a href="<?php get_term_link($term) ?>" title="<?php echo ucwords($term->name); ?> Archive" rel="bookmark"><?php echo ucwords($term->name); ?> Archive</a>
		</h1>
	</header>

	<?php if(has_post_thumbnail()) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</section>

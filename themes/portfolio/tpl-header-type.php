<section id="post_<?php the_ID(); ?>" <?php post_class('region article'); ?>>
	<header class="entry-header post-header <?php if(!has_post_thumbnail())
		echo 'bare'; ?>">
		<h1 class="entry-title">
			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
	</header>

	<?php if(has_post_thumbnail()) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php msc_content($post); ?>
	</div>
</section>

<?php $class = 'article';
if(!is_singular() || !is_main_query())
	$class .= ' chunk'; ?>
<article id="post_<?php the_ID(); ?>" <?php post_class($class); ?>>
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
		<?php the_content(); ?>

		<?php if(!is_singular()): ?>
			<ul class="big_links">
				<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Sample
						Work</a></li>
			</ul>
		<?php elseif(get_field('url')): ?>
			<ul class="big_links">
				<li>
					<a href="<?php the_field('url'); ?>" title="<?php the_title(); ?>">Visit <?php the_title(); ?></a>
				</li>
			</ul>
		<?php endif; ?>
	</div>
</article>

<?php if(is_singular()): ?>
	<?php wp_reset_query();
	query_posts(array(
		'post_type' => 'portfolio',
		'posts_per_page' => -1,
		'nopaging' => true,
	)); ?>
<?php endif; ?>

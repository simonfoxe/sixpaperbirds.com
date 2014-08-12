<article id="post_<?php the_ID(); ?>" <?php post_class('article chunk'); ?>>
	<header class="entry-header post-header <?php if(!has_post_thumbnail())
		echo 'bare'; ?>">
		<h1 class="entry-title">
			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
	</header>

	<footer class="entry-footer">
		<a class="meta work date" href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>" rel="bookmark">
			<time class="published" datetime="<?php echo the_date('c'); ?>" pubdate><?php the_time(get_option('date_format'));; ?></time>
		</a>

		<?php if(($client = get_field('client')) != false): ?>
			<a class="meta work client" href="<?php echo get_permalink($client); ?>" title="<?php echo esc_attr(get_the_title($client)); ?>"><?php echo get_the_title($client); ?></a>
		<?php endif; ?>

		<?php
		$sorts = wp_get_post_terms($post->ID, 'sort');

		if($sorts) {
			foreach($sorts as $sort) {
				echo '<a class="meta tag sort" rel="tag" href="' . get_term_link($sort) . '" title="' . esc_attr('View ' . ucwords($sort->name)) . ' archive"><span class="icon-white icon-' . $sort->slug . '"></span>' . ucwords($sort->name) . '</a> ';
			}
		}
		?>

		<?php
		$attrs = wp_get_post_terms($post->ID, 'attribute');

		if($attrs) {
			foreach($attrs as $attr) {
				echo '<a class="meta tag attr" rel="tag" href="' . get_term_link($attr) . '" title="' . esc_attr('View ' . ucwords($attr->name)) . ' archive"><span class="icon-white icon-' . $attr->slug . '"></span>' . ucwords($attr->name) . '</a> ';
			}
		}
		?>
	</footer>

	<?php if(has_post_thumbnail()) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>

		<?php if(get_field('links')): ?>
			<ul class="big_links">
				<?php while(has_sub_field('links')): ?>
					<li><a href="<?php the_sub_field('url'); ?>" title="<?php the_sub_field('title'); ?>" target="_blank"><?php the_sub_field('title'); ?></a></li>
				<?php endwhile; ?>
			</ul>
		<?php endif; ?>
	</div>
</article>

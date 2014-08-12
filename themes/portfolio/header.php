<?php get_header('html5'); ?>

<div id="page" class="wrapper">
	<div class="row">
		<div id="side" class="col_side">
			<header id="header">
				<div class="description">
					<?php bloginfo('description'); ?>
				</div>

				<h1><a href="<?php echo MSC_SITE_ROOT; ?>" title="<?php echo MSC_SITE_NAME; ?>"><?php echo MSC_SITE_NAME; ?></a></h1>

			</header>

			<aside id="sidebar">
				<?php dynamic_sidebar('sidebar'); ?>
			</aside>
		</div>

		<div id="content" class="col_main">
			<main id="main">

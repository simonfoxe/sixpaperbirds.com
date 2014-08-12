<?php if(!defined('ABSPATH')) exit; ?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en">  <!--<![endif]-->
<head>
	<!-- basic -->
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<!-- title -->
	<title><?php wp_title('||'); ?></title>

	<!-- optimize -->
	<meta http-equiv="imagetoolbar" content="false">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width; initial-scale=1.0;">

	<!-- network -->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="sitemap" type="application/xml" title="sitemap" href="<?php echo MSC_SITE_ROOT; ?>/sitemap.xml">

	<!-- ico -->
	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/ico/favicon.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('stylesheet_directory'); ?>/ico/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('stylesheet_directory'); ?>/ico/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('stylesheet_directory'); ?>/ico/apple-touch-icon.png">

	<!-- wordpress -->
	<?php wp_head(); ?>

	<!-- html5 -->
	<!--[iflt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body <?php body_class(); ?>>

<?php wp_header(); ?>
<!-- header -->

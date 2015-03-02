<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	<title><?php mpt_load_site_title(); ?></title>
	<meta name="description" content="<?php mpt_load_meta_desc(); ?>" />
	<meta name="keywords" content="<?php mpt_load_meta_keywords(); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php mpt_load_google_web_font_header(); ?>
	<?php mpt_load_google_web_font_body(); ?>
	<?php mpt_load_custom_google_font_header(); ?>
	<?php mpt_load_custom_google_font_body(); ?>
	<link rel="shortcut icon" href="<?php mpt_load_favicon(); ?>" />

	<?php wp_head(); ?>

	<?php mpt_load_base_style(); ?>

	<?php include(get_template_directory() . '/admin/custom-styles.php'); ?>

	<!--[if gte IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<style type="text/css">.gradient {filter: none;}</style>
	<![endif]-->

	<?php mpt_load_header_code(); ?>

</head>

<body id="body-wrapper" <?php body_class(); ?>>

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <?php bloginfo('name'); ?>
            </a>
    </div>

        <?php
            wp_nav_menu( array(
                'menu'              => 'mainmenu',
                'theme_location'    => 'mainmenu',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
        'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
    </div>
</nav>
<div class="row">
<!-- Logo -->
				<div class="col-md-2">
					<?php mpt_load_site_logo(); ?>
				</div>
</div>


	<div class="clear"></div>

<!-- End header -->

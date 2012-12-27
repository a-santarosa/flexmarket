<?php get_header(); ?>

<?php 
	$btnclass = mpt_load_mp_btn_color();
	$iconclass = mpt_load_whiteicon_in_btn();
	$tagcolor = mpt_load_icontag_color();
	$span = mpt_load_product_listing_layout();
	$counter = mpt_load_product_listing_counter();
	$entries = get_option('mpt_mp_listing_entries');
?>

	<!-- Page -->
	<div id="page-wrapper">

		<div class="header-section">
			<div class="outercontainer">
				<div class="container">

					<div class="clear padding30"></div>
							
						<h1 class="page-header"><span><?php _e('Our Products'); ?></span></h1>

					<div class="clear padding15"></div>

				</div><!-- / container -->
			</div><!-- / outercontainer -->	
		</div><!-- / header-section -->	

		<div class="content-section">
			<div class="outercontainer">
				<div class="clear padding30"></div>	
				<div class="container" style="min-height: 450px;">			

					<?php if ( class_exists( 'MarketPress' ) ) { ?>

						<div id="mpt-product-grid">

							<?php flexmarket_list_product_in_grid( $echo = true , true , '' , $entries, '', '', '', '' , $counter, $span, $btnclass, $iconclass, $tagcolor); ?>

						</div>

					<?php } ?>

				</div><!-- / container -->
			</div><!-- / outercontainer -->	
		</div><!-- / content-section -->	

	</div><!-- / page-wrapper -->

<?php get_template_part('footer', 'widget'); ?>

<?php get_footer(); ?>
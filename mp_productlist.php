<?php get_header(); ?>

<?php 
	$btnclass = mpt_load_mp_btn_color();
	$iconclass = mpt_load_whiteicon_in_btn();
	$tagcolor = mpt_load_icontag_color();
	$span = mpt_load_product_listing_layout();
	$counter = mpt_load_product_listing_counter();
	$entries = get_option('mpt_mp_listing_entries');
	$advancedsoft = mpt_enable_advanced_sort();
	$advancedsoftbtnposition = mpt_advanced_sort_btn_position();
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

						<?php flexmarket_advance_product_sort( 'productlistingpage' , $advancedsoft , $advancedsoftbtnposition , 'list' , true , true , '' , $entries, '', '', '' , '' , $counter, $span, $btnclass, $iconclass, $tagcolor); ?>

					<?php } ?>

				</div><!-- / container -->
			</div><!-- / outercontainer -->	
		</div><!-- / content-section -->	

	</div><!-- / page-wrapper -->

<?php get_template_part('footer', 'widget'); ?>

<?php get_footer(); ?>
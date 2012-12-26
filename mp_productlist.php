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

								<?php $count = 1; ?>

								<div class="row-fluid">

										<?php
											$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
											query_posts( 'post_type=product&showposts='.$entries.'&orderby=date&order=DESC&paged='.$paged);
											$count = 1;
										?>
										<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	

										<?php flexmarket_load_single_product_in_box( $span , $post->ID , 'tb-360' , $btnclass , $iconclass , $tagcolor); ?>

										<?php 
											if ($count == $counter) {
												$count = 0;
												echo '</div>';
												echo '<div class="clear padding20"></div>';
												echo '<div class="row-fluid">';
											}

										?>

										<?php $count++ ?>

									<?php endwhile; endif; ?>

								</div><!-- / row-fluid -->

							</div>

							<?php } ?>

						<div class="clear"></div>

						<div class="pull-right">
						
							<?php 

							    $total_pages = $wp_query->max_num_pages;  
							    if ($total_pages > 1){  
							      $current_page = max(1, get_query_var('paged'));  
							      echo '<div class="pagination">';
							      echo paginate_links(array(  
							          'base' => get_pagenum_link(1) . '%_%',  
							          'format' => 'page/%#%',  
							          'current' => $current_page,  
							          'total' => $total_pages,  
							          'type'  => 'list'
							        ));  
							      echo '</div>';
							    }  
							
							 ?>

						</div>

						<?php wp_reset_query(); ?>
					
					<div class="padding20"></div>

				</div><!-- / container -->
			</div><!-- / outercontainer -->	
		</div><!-- / content-section -->	

	</div><!-- / page-wrapper -->

<?php get_template_part('footer', 'widget'); ?>

<?php get_footer(); ?>
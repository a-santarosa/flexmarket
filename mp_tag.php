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

					<?php
						global $wp_query;
						$termname = $wp_query->queried_object->name;
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

						$moreargs = array(
							'showposts' => $entries,
							'orderby' => 'date',
							'order' => 'DESC',
							'paged' => $paged
						);

						$args = array_merge( $wp_query->query_vars, $moreargs );

						query_posts($args);
					?>		
							
					<?php if (have_posts()) : ?>		

					<?php $post = $posts[0]; ?>
							
						<h1 class="page-header"><span><?php _e('Items tagged with '); ?>&#8216;<?php echo $termname; ?>&#8217;</span></h1>

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

									<?php while (have_posts()) : the_post(); ?>	

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

									<?php endwhile; ?>

								</div><!-- / row-fluid -->

							</div>

							<?php } ?>

						<?php else : ?>

						<!-- nothing found -->

					<?php $post = $posts[0]; ?>
							
						<h1 class="page-header"><span><?php _e('Items tagged with '); ?>&#8216;<?php echo $termname; ?>&#8217;</span></h1>

					<div class="clear padding15"></div>

				</div><!-- / container -->
			</div><!-- / outercontainer -->	
		</div><!-- / header-section -->	

		<div class="content-section">
			<div class="outercontainer">
				<div class="clear padding30"></div>	
				<div class="container" style="min-height: 450px;">

							<h2><?php _e('Nothing Found.'); ?></h2>

							<p><?php _e('Perhaps try one of the links below:'); ?></p>
							<div class="padding10"></div>
							<h4><?php _e('Most Used Categories'); ?></h4>
							<ul>
								<?php wp_list_categories( array( 'taxonomy' => 'product_category' , 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
							</ul>				
							<div class="padding20"></div>
							<p><?php _e('Or, use the search box below:'); ?></p>
							<?php get_search_form(); ?>
							<div class="padding20"></div>

						<!-- / nothing found -->

						<?php endif; ?>

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
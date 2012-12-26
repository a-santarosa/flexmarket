/**** MarketPress Ajax JS For FlexMarket *********/

jQuery(document).ready(function($) {

	// Ajax for products view.
	function flexmarket_ajax_products_list(){
		
		$('.mp_product_list_refine').show(); // hide for non JS users

		// if hash tag contains a state, update view
		// hash tags are used to store the current state in these situations:
		//	a) when the user views a product and then clicks back
		//	b) viewing the URL from a bookmark
		if( /filter-term|order|paged/.test(location.hash) ){
				var query_string = location.hash.replace('#', '');
				flexmarket_get_and_insert_products(query_string);
				flexmarket_update_dropdown_state(query_string);
		}

		$(".mp_list_filter select").change(function(){
				flexmarket_get_and_insert_products( $('.mp_product_list_refine').serialize() );
		});

		// on next/prev link click, get page number and update products
		$(document).on('click', '#mp_product_nav a', function(){
				var m = $(this).attr('href').match(/(paged=|page\/)(\d+)/);
				var nw_page = m != null ? m[2] : 1;
				flexmarket_get_and_insert_products( $('.mp_product_list_refine').serialize() + '&page=' + nw_page );

				// scroll to top of list
				var pos = $('.mp_list_filter').offset();
				$('body').animate({ scrollTop: pos.top-10 });
				return false;
		});

		// get products via ajax, insert into DOM with new pagination links
		function flexmarket_get_and_insert_products(query_string){
				flexmarket_ajax_loading(true);
				$.post(
					MP_Ajax.ajaxUrl, 
					'action=get_products_list&'+query_string,
					function(data) {
						flexmarket_ajax_loading(false);
						$('#mpt-product-grid').first().replaceWith(data.products);
						$('#mp_product_nav').remove();
						if(data.pagination!==false){
							$('#mpt-product-grid').after(data.pagination);
						}
						location.hash = query_string;
					}
				);
		}

		// if the page has been loaded from a bookmark set the current state for select elements
		function flexmarket_update_dropdown_state(query_string){
			var query = JSON.parse('{"' + decodeURI(query_string.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');
			for(name in query){
				$('select[name="'+name+'"]').val(query[name]);
			}
		}

		// show loading ui when waiting for ajax response
		function flexmarket_ajax_loading(loading){
			$('#mpt-product-grid .mp_ajax_loading').remove();
			if(loading){
				$('#mpt-product-grid').prepend('<div class="mp_ajax_loading">Loading...</div>');
			}
		}
	}

	
	flexmarket_ajax_products_list();

});


/*
Author: nicdark
Author URI: http://www.nicdarkthemes.com/
*/



function nicdark_sort(paged){

	jQuery( ".nicdark_site" ).prepend('<div class="nicdark_preloader_ajax"></div>');

	//choice
	var order_choice = jQuery( "select#nicdark_sort_feature option:selected").val();	
	var nicdark_asc_desc = jQuery( "select#nicdark_asc_desc option:selected").val();
	var nicdark_layout = jQuery( "select#nicdark_layout option:selected" ).val();
	

	//pagination
	var nicdark_paged = paged;
	if(typeof nicdark_paged === 'undefined'){
		nicdark_paged = jQuery( ".nicdark_btn.active" ).text();
	}

	var nicdark_posttype = jQuery( "input[name=posttype]" ).val();
	var nicdark_keyword = jQuery( "input[name=keyword]" ).val();
	
	
	//tax
	var nicdark_tax_1 = '';
	var nicdark_tax_2 = '';
	var nicdark_tax_3 = '';
	var nicdark_tax_4 = '';

	//tax term
	var nicdark_destination_package = jQuery( "select#nicdark_select_destination-package option:selected").val();
	var nicdark_typology_package = jQuery("select#nicdark_select_typology-package option:selected").val();
	var nicdark_duration_package = jQuery("select#nicdark_select_duration-package option:selected").val();
	var nicdark_person_package = jQuery("select#nicdark_select_person-package option:selected").val();

	//date
	var nicdark_date_from = jQuery( "input[name=nicdark_date_from]" ).val();
	var nicdark_date_to = jQuery( "input[name=nicdark_date_to]" ).val();

	//price
	var nicdark_price_from = jQuery( "input[name=nicdark_price_from]" ).val();
	var nicdark_price_to = jQuery( "input[name=nicdark_price_to]" ).val();


	jQuery.ajax({


		 method: "POST",
		 url: "../wp-content/themes/lovetravel/include/ajax/sort.php",
		 data: { 
		     order_choice: order_choice,
		     nicdark_paged: nicdark_paged,
		     nicdark_layout: nicdark_layout,
		     nicdark_asc_desc: nicdark_asc_desc,
		     nicdark_posttype: nicdark_posttype,
		     nicdark_keyword: nicdark_keyword,
		     nicdark_date_from: nicdark_date_from,
		     nicdark_date_to: nicdark_date_to,
		     nicdark_price_from: nicdark_price_from,
		     nicdark_price_to: nicdark_price_to,
		     nicdark_destination_package: nicdark_destination_package,
		     nicdark_typology_package: nicdark_typology_package,
		     nicdark_duration_package: nicdark_duration_package,
		     nicdark_person_package: nicdark_person_package
		 }

	})

	.success(function( nicdark_message ) {
		 
		jQuery( ".nicdark_masonry_container" ).remove(); //empty the content
  		jQuery( ".nicdark_ajax_results" ).append( nicdark_message ); // insert new content base on the new query

  		//define new isotope container
  		var container_masonry = jQuery(".nicdark_masonry_container").isotope({ itemSelector: ".nicdark_masonry_item" });
  		
  		
  		//nicdark_tooltip
  		jQuery( '.nicdark_tooltip' ).tooltip({ 
    	position: {
    		my: "center top",
    		at: "center+0 top-50"
  		}
    	});


    	//nicdark_mpopup_window
		jQuery('.nicdark_mpopup_window').magnificPopup({
			type: 'inline',

			fixedContentPos: false,
			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,
			preloader: false,
			
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
  		

  		jQuery( ".nicdark_preloader_ajax" ).remove(); //remove the loader

	})
	.error(function(){
	         
	 	alert('error'); 

	});

}


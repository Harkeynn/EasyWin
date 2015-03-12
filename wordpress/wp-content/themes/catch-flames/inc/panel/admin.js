jQuery( document ).ready( function() {
	var active = 0;
	if( jQuery.cookie( 'catchflames_ad_tab' ) ) {
		active = jQuery.cookie( 'catchflames_ad_tab' );
		jQuery.cookie( 'catchflames_ad_tab', null );
	}
	
	var tabs = jQuery( '#catchflames_ad_tabs' ).tabs( { active: active } );
	
	jQuery( '#wpbody-content form' ).submit( function() {
		var active = tabs.tabs( 'option', 'active' );
		jQuery.cookie( 'catchflames_ad_tab', active );
	} );
	
	jQuery( '.sortable' ).sortable( {
		handle: 'label',
		update: function( event, ui ) {
			var index = 1;
			var attrname = jQuery( this ).find( 'input:first' ).attr( 'name' );
			var attrbase = attrname.substring( 0, attrname.indexOf( '][' ) + 1 );
			
			jQuery( this ).find( 'tr' ).each( function() {
				jQuery( this ).find( '.count' ).html( index );
				jQuery( this ).find( 'input' ).attr( 'name', attrbase + '[' + index + ']' );
				index++;
			} );
		}
	} );
} );

// Show Hide Toggle Box
jQuery(document).ready(function($){
	
	jQuery(".option-content").hide();
	jQuery(".option-content.show").show();

	jQuery("h3.option-toggle").click(function(){
	jQuery(this).toggleClass("option-active").next().slideToggle("fast");
		return false; 
	});
	
	jQuery(".image-slider").hide();	
	jQuery(".post-slider").hide();	
	jQuery(".page-slider").hide();	
	jQuery(".category-slider").hide();	
	

	// Show Hide Image or Featured Slider Option with onclick fucntion
	jQuery("#demo-slider").click(function(){
		jQuery(".image-slider").hide();	
		jQuery(".post-slider").hide();	
		jQuery(".page-slider").hide();
		jQuery(".category-slider").hide();	
	});	
	jQuery("#image-slider").click(function(){
		jQuery(".image-slider").show();	
		jQuery(".post-slider").hide();	
		jQuery(".page-slider").hide();
		jQuery(".category-slider").hide();	
	});	
	jQuery("#post-slider").click(function(){
		jQuery(".post-slider").show();	
		jQuery(".page-slider").hide();
		jQuery(".image-slider").hide();	
		jQuery(".category-slider").hide();	
	});
	jQuery("#page-slider").click(function(){
		jQuery(".page-slider").show();	
		jQuery(".post-slider").hide();	
		jQuery(".image-slider").hide();	
		jQuery(".category-slider").hide();	
	});	
	jQuery("#category-slider").click(function(){
		jQuery(".category-slider").show();	
		jQuery(".page-slider").hide();	
		jQuery(".post-slider").hide();	
		jQuery(".image-slider").hide();	
		
	});	
	
	// Show Hide Image or Featured Slider Option with checked condition
	if (jQuery("#demo-slider").is(":checked")){										 
		jQuery(".post-slider").hide();
		jQuery(".page-slider").hide();
		jQuery(".image-slider").hide();
		jQuery(".slider-preview").hide();
	} else if (jQuery("#disable-slider").is(":checked")){										 
		jQuery(".post-slider").hide();
		jQuery(".page-slider").hide();
		jQuery(".image-slider").hide();
		jQuery(".slider-preview").hide();
	} else if (jQuery("#image-slider").is(":checked")){
		jQuery(".image-slider").show();	
		jQuery(".post-slider").hide();	
		jQuery(".page-slider").hide();
	} else if (jQuery("#page-slider").is(":checked")){
		jQuery(".page-slider").show();	
		jQuery(".post-slider").hide();	
		jQuery(".image-slider").hide();	
	} else if (jQuery("#category-slider").is(":checked")){
		jQuery(".category-slider").show();	
		jQuery(".page-slider").hide();	
		jQuery(".post-slider").hide();	
		jQuery(".image-slider").hide();			
	} else {
		jQuery(".post-slider").show();	
		jQuery(".image-slider").hide();		
	}
	

});

jQuery(document).ready(function ($) {
    setTimeout(function () {
        jQuery(".fade").fadeOut("slow", function () {
            jQuery(".fade").remove();
        });

    }, 2000);
});
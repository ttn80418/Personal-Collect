		// 支援滑動panel

		$( document ).on( "pagecreate", "#home", function() {
    	$( document ).on( "swipeleft swiperight", "#home", function( e ) {
        // We check if there is no open panel on the page because otherwise
        // a swipe to close the left panel would also open the right panel (and v.v.).
        // We do this by checking the data that the framework stores on the page element (panel: open).
        	if ( $( ".ui-page-active" ).jqmData( "panel" ) !== "open" ) {
            	if ( e.type === "swipeleft" ) {
                $( "#rightpanel" ).panel( "open" );
            	} else if ( e.type === "swiperight" ) {
                $( "#leftpanel" ).panel( "open" );
            	}
        	}
    	});
	});
// -------product的Panel--------
		$( document ).on( "pagecreate", "#product", function() {
    	$( document ).on( "swipeleft swiperight", "#product", function( e ) {
        // We check if there is no open panel on the page because otherwise
        // a swipe to close the left panel would also open the right panel (and v.v.).
        // We do this by checking the data that the framework stores on the page element (panel: open).
        	if ( $( ".ui-page-active" ).jqmData( "panel" ) !== "open" ) {
            	if ( e.type === "swipeleft" ) {
                $( "#product-rightpanel" ).panel( "open" );
            	} else if ( e.type === "swiperight" ) {
                $( "#product-leftpanel" ).panel( "open" );
            	}
        	}
    	});
	});	
	
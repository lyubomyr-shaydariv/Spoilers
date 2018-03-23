$( '.spoilers-button' ).toggle( function() {
	$( this ).parents( '.spoilers' ).find( '.spoilers-body' ).show();
	$( this ).children( '.spoilers-show' ).hide();
	$( this ).children( '.spoilers-hide' ).show();
	var $comments = $( this ).parents( '.spoilers' ).find( '> p' ).contents().filter( function( e ) { return this.nodeType == 8; } );
	if ( $comments.length ) {
		$( this ).parents( '.spoilers' ).find( '.spoilers-body' ).html( $comments[0].nodeValue );
		$comments.remove();
	}
}, function() {
	$( this ).parents( '.spoilers' ).find( '.spoilers-body' ).hide();
	$( this ).children( '.spoilers-show' ).show();
	$( this ).children( '.spoilers-hide' ).hide();
});
( function ( mw, $ ) {
	'use strict';

	mw.Spoilers = function () {
		var $spoilerButton = $( '.spoilers-button' );
		$spoilerButton.each( function () {
			var $parent = $( this ).parent();
			$parent.children( '.spoilers-button' ).text( $parent.data( 'showtext' ) || mw.msg( 'spoilers_show_default' ) );
			$parent.data( 'shown', false );
		} );
		$spoilerButton.click( function () {
			var $parent = $( this ).parent(),
				shown = $parent.data( 'shown' ),
				showMsg = $parent.data( 'showtext' ) || mw.msg( 'spoilers_show_default' ),
				hideMsg = $parent.data( 'hidetext' ) || mw.msg( 'spoilers_hide_default' );
			$parent.data( 'shown', !shown );
			$parent.children( '.spoilers-button' ).text( !shown ? hideMsg : showMsg );
			var $body = $parent.children( '.spoilers-body' ).slideToggle();
			var $comments = $body.contents().filter( function( e ) { return this.nodeType === 8; } );
			if ( $comments.length ) {
				var bodyHtml = $comments[0].nodeValue;
				$body.html( bodyHtml );
				$comment.remove();
			}
		} );
	};

	$( function () {
		mw.Spoilers();
	} );
}( mediaWiki, jQuery ) );

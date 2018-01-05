( function( $ ) {

/*************** 1. MAIN FUNCTION ***************/
	$( document ).ready( function() {
		init();
		onChanges();
		onClicks();
		onMouseUps();
		onSubmits();
	} );
/*****---------- 1.1 INIT ----------*****/
	function init() {

	}
/*****---------- 1.2 onChanges ----------*****/
	function onChanges() {

	}
/*****---------- 1.3 onClicks ----------*****/
	function onClicks() {

	}
/*****---------- 1.4 OnMouseUp ----------*****/
	function onMouseUps() {
	}

/*****---------- 1.5 OnSubmits	 ----------*****/

	function onSubmits() {
		
	}

/*************** 2. FUNCTIONS ***************/
/*****---------- 2.1 REUSABLE FUNCTIONS ----------*****/
	var isEmpty = function(){
		if(this == '')
			return true;
		if(this == null)
			return true;
		if(typeof this === "undefined")
			return true;
		return false;
	};
/*****---------- 2.2 ADDITIONAL FUNCTIONS   ----------*****/

/*****---------- 2.3 EXTENSTIONS ----------*****/


} )( jQuery );
(function($) { 

	$(document).on("wheel", "input[type=number]", function (e) {
	    $(this).blur();
	});

	$('form').on('focus', 'input[type=number]', function (e) {
	  $(this).on('mousewheel.disableScroll', function (e) {
	    e.preventDefault()
	  })
	});

	$('form').on('blur', 'input[type=number]', function (e) {
	  $(this).off('mousewheel.disableScroll')
	});
	
})(jQuery);
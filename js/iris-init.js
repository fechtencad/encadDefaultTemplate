jQuery(document).ready(function($){
	$('.color-picker').iris({
		width: 400,
		hide: true,
		palettes: true,
		change: function(event, ui) {
			// event = standard jQuery event, produced by whichever control was changed.
			// ui = standard jQuery UI object, with a color member containing a Color.js object
			// change the headline color
			 $(".color-picker").css( 'background', ui.color.toString());
		}
	 });   
	 
    $(document).click(function (e) {
        if (!$(e.target).is(".color-picker, .iris-picker, .iris-picker-inner")) {
            $('.color-picker').iris('hide');
        }
    });
	
    $('.color-picker').click(function (event) {
        $('.color-picker').iris('hide');
        $(this).iris('show');
    });
});
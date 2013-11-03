
// Passing jQuery into the
// Immediately Invode Function Expression (IIFE)
// and, taking that jQuery as $ while accepting it into the function
// to avoid conflicts with other libraries/
(function($) {
	$.fn.greenify = function(){
		this.css("color", "green");
		return this;
	}
	
})( jQuery );


/* -------------------------------------------------- *
 * OnReturn 1.0
 * Updated: 9/15/08
 * -------------------------------------------------- *
 * Author: Aaron Kuzemchak
 * URL: http://aaronkuzemchak.com/
 * Copyright: 2008 Aaron Kuzemchak
 * License: MIT License
** -------------------------------------------------- */

(function($) {
	$.fn.onReturn = function(callback) {
		return this.each(function() {
			$(this).keypress(function(e) {
				if(e.which == 13) {
					e.preventDefault();
					callback.apply(this);
				}
			});
		});
	};
})(jQuery);
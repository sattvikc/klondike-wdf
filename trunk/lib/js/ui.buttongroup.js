/*
 * jQuery UI Contrib Button Group 0.1pre
 *
 * Copyright (c) 2009 AUTHORS.txt
 * (http://code.google.com/p/jqueryui-contrib/wiki/About)
 * Licensed under the MIT (MIT-LICENSE.txt)
 *
 * http://code.google.com/p/jqueryui-contrib/wiki/docbuttongroup
 *
 * Depends:
 *	ui.core.js
 *	ui.button.js
 */

(function($) {

$.widget("ui.buttongroup", {

	_init: function() {
		var self = this,
			options = this.options;

		this.element.addClass("ui-buttongroup ui-helper-clearfix ui-widget-content")

		this._createButtons(options.buttons);
	},

	destroy: function() {
		this.element.removeClass("ui-buttongroup ui-helper-clearfix ui-widget-content")
			.find(".ui-button")
			.remove();
	},

	add: function(name, fn) {
		var btn = $("<div></div").appendTo(this.element),
			scope = this.options.scope || btn.get(0);

		btn.button({
			text: name,
			click: function() {
				fn.apply(scope, arguments)
			}
		});
	},

	remove: function(name) {
		this.element.find(".ui-button").each(function() {
			if($(this).button("option", "text") == name)
				$(this).button("destroy");
		})
	},

	_setData: function(key, value) {
		switch(key) {
			case 'buttons':
				tihs.createButtons(value);
				break;
		}
		$.widget.prototype._setData.apply(this, arguments);
	},

	_createButtons: function(buttons) {
		var self = this,
			hasButtons = false,
			buttonPane = this.element,
			scope = this.options.scope || this;

		this.element.find(".ui-button").remove();
		
		(typeof buttons == 'object' && buttons !== null &&
			$.each(buttons, function() { return !(hasButtons = true); }));

		if(hasButtons) {
			$.each(buttons, function(name, fn) {
				self.add(name, fn);
			});
		}
	}
});

$.extend($.ui.buttongroup, {
	version: "0.1pre",
	defaults: {
		buttons: {}
	}
});

})(jQuery);

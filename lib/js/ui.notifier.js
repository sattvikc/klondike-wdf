/*
 * jQuery UI Contrib Notifier 0.1pre
 *
 * Copyright (c) 2009 AUTHORS.txt
 * (http://code.google.com/p/jqueryui-contrib/wiki/About)
 * Licensed under the MIT (MIT-LICENSE.txt)
 *
 * http://code.google.com/p/jqueryui-contrib/wiki/docnotifier
 *
 * Depends:
 *	ui.core.js
 */

(function($) {

$.widget("ui.notifier", {

	_init: function() {
		var self = this,
			options = this.options;
		
		this.element.addClass("ui-corner-all ui-widget ui-notifier");

		this.container = $('<p></p>')
			.addClass("ui-widget-container")
			.appendTo(this.element);
		this.iconSpan = $('<span class="icon"></span>').appendTo(this.container);
		this.messageSpan = $('<span class="message"></span>').appendTo(this.container);

		this.messageSpan.text(options.text);
		this.iconSpan.addClass("ui-icon");

		this._updateStyle(options.style);
		this._updateVisible(options.visible);
		this._updateWidth(options.width);
	},

	destroy: function() {
		this.element.removeClass("ui-state-highlight ui-state-error")
			.removeClass("ui-corner-all ui-widget ui-notifier");
		this.container.remove();
	},

	_setData: function(key, value) {
		switch(key) {
			case 'text':
				this.messageSpan.text(value);
				this._updateWidth(this.options.width);
				break;
			case 'style':
				this._updateStyle(value);
				break;
			case 'width':
				this._updateWidth(value);
				break;
			case 'visible':
				this._updateVisible(value);
				break;
		}

		$.widget.prototype._setData.apply(this, arguments);
	},

	_updateWidth: function(value) {
		var hid = false;
		if(value === "auto") {
			if(this.element.is(":hidden")) {
				hid = true;
				this.element.show();
			}
			this.element.width("100%");
			this.element.width(this.iconSpan.width() + this.messageSpan.width());
			if($.browser.msie)
				// TODO: Bad hack but IE wont play nice
				this.element.width(this.element.width() + 46);
			if(hid)
				this.element.hide();
		}
		else
			this.element.width(value);
	},

	_updateVisible: function(value) {
		if(value)
			this.element.show();
		else
			this.element.hide();
	},

	_updateStyle: function(value) {
		this.element.toggleClass("ui-state-highlight", value == $.ui.notifier.WARNING);
		this.element.toggleClass("ui-state-error", value == $.ui.notifier.ERROR);
		this.iconSpan.toggleClass("ui-icon-info", value == $.ui.notifier.WARNING);
		this.iconSpan.toggleClass("ui-icon-alert", value == $.ui.notifier.ERROR);
	}
});

$.extend($.ui.notifier, {
	version: "0.1pre",
	WARNING: 1,
	ERROR: 2,
	defaults: {
		style: 1,
		visible: false,
		text: "&nbsp;",
		width: "auto"
	}
});

})(jQuery);

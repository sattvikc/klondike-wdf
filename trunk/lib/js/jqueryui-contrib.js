/*
 * jQuery UI Contrib 0.1pre
 *
 * Copyright (c) 2009 AUTHORS.txt
 * (http://code.google.com/p/jqueryui-contrib/wiki/About)
 * Licensed under the MIT (MIT-LICENSE.txt)
 *
 * http://code.google.com/p/jqueryui-contrib/wiki/docbutton
 */
/*
 * jQuery UI Contrib Button 0.1pre
 *
 * Copyright (c) 2009 AUTHORS.txt
 * (http://code.google.com/p/jqueryui-contrib/wiki/About)
 * Licensed under the MIT (MIT-LICENSE.txt)
 *
 * http://code.google.com/p/jqueryui-contrib/wiki/docbutton
 *
 * Depends:
 *	ui.core.js
 */

(function($) {
	
$.widget("ui.button", {

	_init: function() {
		var self = this,
			options = this.options;

		this.element.addClass("ui-widget ui-widget-container ui-button ui-helper-clearfix");
		if(options.tooltip != "") {
			this.oldTitle = this.element.attr("title");
			this.element.attr("title", options.tooltip);
		}
		
		this.button = $("<a></a>")
			.addClass("ui-state-default ui-corner-all")
			.click(function() { self.click() })
			.hover(
				function() { $(this).addClass("ui-state-hover"); },
				function() { $(this).removeClass("ui-state-hover"); }
			)
			.mousedown(function() { $(this).addClass("ui-state-active") })
			.mouseup(function() { $(this).removeClass("ui-state-active") })
			.html(options.text)
			.appendTo(this.element);

		this.icon = $("<span></span>")
			.addClass("ui-icon")
			.prependTo(this.button);

		this._setIcon(options.icon)
	},

	destroy: function() {
		this.element.removeClass("ui-widget ui-widget-container ui-button ui-helper-clearfix")
			.attr("title", this.oldTitle);
		this.button.remove();
	},

	click: function() {
		var self = this,
			options = this.options;
		options.click.apply(self.element[0], arguments);
	},

	_setIcon: function(icon) {
		if(icon != "")
			this.icon.addClass(icon);
		else
			this.icon.hide();
	},

	_setData: function(key, value) {
		switch(key) {
			case 'icon':
				this.icon.removeClass(this.options.icon);
				this._setIcon(value);
				break;
			case 'text':
				this.button.html(value);
				this.icon.prependTo(this.button);
				break;
			case 'tooltip':
				this.element.attr("title", value);
				break;
		}
		$.widget.prototype._setData.apply(this, arguments);
	}
});

$.extend($.ui.button, {
	version: "0.1pre",
	defaults: {
		icon: "",
		text: "",
		tooltip: "",
		click: function() {}
	}
});

})(jQuery);
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
/*
 * jQuery UI Contrib Form 0.1pre
 *
 * Copyright (c) 2009 AUTHORS.txt
 * (http://code.google.com/p/jqueryui-contrib/wiki/About)
 * Licensed under the MIT (MIT-LICENSE.txt)
 *
 * http://code.google.com/p/jqueryui-contrib/wiki/docform
 *
 * Depends:
 *	ui.core.js
 *	ui.button.js
 *	ui.buttongroup.js
 *	ui.notifier.js
 */

(function($) {

$.widget("ui.form", {

	_init: function() {
		var self = this,
			options = this.options;

		this.element.addClass("ui-widget");
		if($.ui.notifier)
			this.notifier = $("<div></div>")
				.prependTo(this.element)
				.notifier();

		this.method = this.element.attr("method").toUpperCase() || "GET";
		this.action = this.element.attr("action") || "#";
		this.inputs = this.element.find("input");

		$.extend(options.validators, $.ui.form.validators)

		this._createButtons(this.options.buttons);
		this.textInputs = this.element.find("input[type=text], input[type=password]");
	},

	destroy: function() {
		if(this.notifier)
			this.notifier.remove();
	},

	submit: function() {
		var self = this,
			data = {};
		if(!this._validate())
			return;
		
		self.inputs.each(function() {
			data[$(this).attr("name")] = $(this).val();
		});

		$.ajax({
			cache: false,
			type: self.method,
			url: self.action,
			data: data,
			error: function(request, textStatus, errorThrown) {
				var msg = "An unknown error has occurred";

				if(request.responseText)
					msg = request.responseText;
				else if(textStatus)
					msg = textStatus;
				else if(errorThrown)
					msg = errorThrown;

				self.notifier.notifier("option", "text", msg)
					.notifier("option", "style", $.ui.notifier.ERROR)
					.show("bounce");
			},
			beforeSend: function(request)
			{
				self.notifier.hide();
				self.inputs.removeClass("ui-state-error");
			},
			success: self.options.success
		});
	},

	reset: function()
	{
		this.element.each(function() {
			this.reset();
		});
		this.notifier.hide();
		this.inputs.removeClass("ui-state-error");
	},

	_setData: function(key, value) {
		switch(key) {
			case 'buttons':
				this._createButtons(value);
				break;
			case 'validators':
				$.extend(value, $.ui.form.validators);
				break;
		}
		$.widget.prototype._setData.apply(this, arguments);
	},

	_keyPress: function(self, event) {
		if(event.which == 13)
		{
			event.preventDefault();
			event.data.submit();
		}
	},

	_validate: function()
	{
		var self = this,
			options = this.options,
			msg = "";

		this.inputs.removeClass("ui-state-error");
		this.inputs.each(function() {
			var input = this;
			$.each(self.options.validators, function(name) {
				if($(input).hasClass(name)) {
					ret = this.apply(input, arguments);
					if(typeof(ret) != "undefined") {
						msg += ret;
						$(input).addClass("ui-state-error");
					}
				}
			});
		});
		if(msg != "") {
			this.notifier.notifier("option", "text", msg)
				.notifier("option", "style", $.ui.notifier.ERROR)
				.show("bounce");
			return false;
		}
		return true;
	},

	_createButtons: function(buttons)
	{
		this.element.find(".ui-buttongroup").remove();
		$("<div></div>").appendTo(this.element)
		.buttongroup({
			buttons: buttons,
			scope: this.element[0]
		})
	}
});

$.extend($.ui.form, {
	version: "0.1pre",
	validators: {
		required: function() {
			if($(this).val() == "") {
				return $(this).attr("name").toUpperCase() + " is required";
			}
		}
	},
	defaults: {
		buttons: {},
		success: function() {},
		validators: {}
	}
});

})(jQuery);
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

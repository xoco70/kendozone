if (typeof jQuery === 'undefined') { throw new Error('MultiEmail\'s JavaScript requires jQuery') }

(function($) {
	'use strict';

	if ($.validator) {
		$.validator.addMethod("multiEmail", function (value, element, params) {
	        if ($(element).val() == "") {
	        	return true;
	        }

	        else {
	        	return $(element).data('multiEmail').isValid()
	        }
	    }, "One or more email address(es) are not valid.");
	}
	

	function MultiEmail(element, options) {
		var self = this;

		this.$element = $(element);

		this.$element.tagsinput({
			confirmKeys: [13, 32, 186, 188],
			tagClass: function(item) {
				if (self.validEmail(item)) {
					return "valid";
				}
				else {
					return "invalid";
				}
			}
		});

		this.container().addClass('bootstrap-multiemail');

		this.build();
	}

	MultiEmail.prototype = {
		constructor: MultiEmail,

		invalidItems : [],

		build : function() {
			var self = this;
			this.$element.on('itemAdded', function(event) {
				if (!self.validEmail(event.item)) {
					self.invalidItems.push(event.item);
					self.$element.blur();
				}
			});

			this.$element.on('itemRemoved', function(event) {
				if (self.invalidItems.indexOf(event.item) > -1) {
					self.invalidItems.splice(self.invalidItems.indexOf(event.item), 1);
					self.$element.blur();
				}
			});

			this.container().on('keydown', 'input', function(event) {
				if (event.which == 9) {
					self.addPending();
				}
				self.input().attr('size', self.input().val().length + 1);
			})

			this.container().on('blur', 'input', function() {
				self.$element.blur();
			});
		},

		input : function() {
			return this.$element.tagsinput('input');
		},

		container : function() {
			return this.$element.tagsinput('input').parents('.bootstrap-tagsinput');
		},

		validEmail : function(item) {
			return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(item);
		},

		isValid : function() {
			return !(this.invalidItems.length > 0);
		},
		add: function(item) {
			return this.$element.tagsinput('add', item);
		},
		removeAll: function() {
			return this.$element.tagsinput('removeAll');
		},

		addPending : function() {
			this.add(this.input().val());
			this.input().val('');
		}
	}

	/**
	* Register JQuery plugin
	*/
	$.fn.multiEmail = function(arg1, arg2) {
		var results = [];

		this.each(function() {
			var multiEmail = $(this).data('multiEmail');

			// Initialize a new multi email
			if (!multiEmail) {
				multiEmail = new MultiEmail(this, arg1);
				$(this).data('multiEmail', multiEmail);
				results.push(multiEmail);

			} else {
				// Invoke function on existing tags input
				var retVal = multiEmail[arg1](arg2);
				if (retVal !== undefined)
					results.push(retVal);
			}
		});

		if ( typeof arg1 == 'string') {
			// Return the results from the invoked function calls
			return results.length > 1 ? results : results[0];
		} else {
			return results;
		}
	};



	/**
   * Initialize tagsinput behaviour on inputs and selects which have
   * data-role=tagsinput
   */
  $(function() {
    $("input[data-role=multiemail], select[multiple][data-role=multiemail], textarea[data-role=multiemail]").multiEmail();
  });

	
})(window.jQuery);
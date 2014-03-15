;
if (typeof AC ==="undefined") {AC = function() {};}
if (typeof AC.Form ==="undefined") {AC.Form = function() {};}

AC.Form.Ajax = function() {

    var ready = false;
    var callbacks = [];

	return {
		
		init: function() {
			$('form.ACAjaxForm.getHandler').submit(AC.Form.Ajax.getHandler);
			$('form.ACAjaxForm:not(.getHandler)').submit(AC.Form.Ajax.postHandler);
            ready = true;
            for (var i in callbacks) {
                (function(cb) {
                    setTimeout(cb, 100);
                })(callbacks[i]);
            }
		},

        registerCallback: function(callback) {
            if (ready) {
                setTimeout(callback, 100);
            } else {
                callbacks.push(callback);
            }
        },
		
		postHandler: function() {
			var self = this;
			return AC.Form.Ajax.submitHandler.call(self, 'POST');
		},
		
		getHandler: function() {
			var self = this;
			return AC.Form.Ajax.submitHandler.call(self, 'GET');
		},
		
		submitHandler: function(postOrGet) {
			// valid?
			if ($(this).jqBootstrapValidation && $(this).find('input, select, textarea').jqBootstrapValidation('hasErrors')) {
				return false;
			}
			var type = postOrGet.toUpperCase() || 'POST';
			var url = $(this).attr('action');
			var data = $(this).serialize();
			var form = this;
			var before = function(jqXHR, settings) {
                // we call triggerHandler down below, this is redundant
//				$(form).trigger('before', [jqXHR, settings]);
			};
			var success = function(data) {
				$('body').removeClass('loading');
				$(form).trigger('result', [data]);
			};
			var errorHandler = function(jqXHR, message, exception) {
				$('body').removeClass('loading');
				$(form).trigger('error', [jqXHR, message, exception]);
			};
			var dataType = 'html';
			if ($(form).attr('data-format') == 'json') {
				dataType = 'json';
			}
			$('body').addClass('loading');
			if ($(form).triggerHandler('before') !== false) {
				$.ajax({
					type: type,
					url: url,
					data: data,
					beforeSend: before,
					success: success,
					dataType: dataType
				}).error(errorHandler);
			}
			return false;	
		},
		
		linkHandler: function() {
			var href = $(this).attr('href');
			var link = this;
			var success = function(data) {
				$('body').removeClass('loading');
				$(link).trigger('result', [data]);
			};
			var dataType = 'json';
			$('body').addClass('loading');
			$.post(href, {}, success, dataType);
			return false;	
		}
	};
}();

$(document).ready(function() {
	AC.Form.Ajax.init();
});
/**
 *  @name plugin
 *  @description description
 *  @version 1.0
 *  @options
 *    option
 *  @events
 *    event
 *  @methods
 *    init
 *    publicMethod
 *    destroy
 */
(function($, window, undefined) {
    'use strict';
    var pluginName = 'login-form';

    function Plugin(element, options) {
        this.element = $(element);
        this.options = $.extend({}, $.fn[pluginName].defaults, this.element.data(), options);
        this.init();
    }
    Plugin.prototype = {
        init: function() {
            var that = this,
                elm = that.element,
                $span_error_login = elm.find('[data-error-login]');
            elm.find("[name=login_submit]").click(function(event) {
                event.preventDefault();
                var method = elm.attr('method'),
                    data = $('form').serialize(),
                    ajaxurl = my_ajax_object.ajax_url;
                jQuery.ajax({
                    url : ajaxurl,
                    type : method,
                    data : data,
                    success : function( response ) {
                        if(response['status'] === 200) {
                            window.location.href = response['url'];
                        }else {
                            $span_error_login.css('display','');
                        }
                    }
                });
            });
        },
        destroy: function() {
            $.removeData(this.element[0], pluginName);
        }
    };

    $.fn[pluginName] = function(options, params) {
        return this.each(function() {
            var instance = $.data(this, pluginName);
            if (!instance) {
                $.data(this, pluginName, new Plugin(this, options));
            } else if (instance[options]) {
                instance[options](params);
            }
        });
    };

    $.fn[pluginName].defaults = {
        breakPoint: 768
    };

    $(function() {
        $('[data-' + pluginName + ']')[pluginName]();
    });


}(jQuery, window));
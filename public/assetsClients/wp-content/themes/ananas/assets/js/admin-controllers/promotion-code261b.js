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
;(function ($, window, undefined) {
    'use strict';
    var pluginName = 'create-promotion-code';

    // isAddMaxFile = window.isAddMaxFile;
    function Plugin(element, options) {
        this.element = $(element);
        this.options = $.extend({}, $.fn[pluginName].defaults, this.element.data(), options);
        this.init();
    }
    Plugin.prototype = {
        init: function () {
            var el = this.element;
            el.parsley();
            $('#loader').fadeOut(500);
            this.element.submit(function (e) {
                e.preventDefault();
                $('#loader').fadeIn();
                $('#overlay').css('display','block');
                if ($(this).parsley().isValid()) {
                    jQuery.ajax({
                        type: "post",
                        dataType: "json",
                        url: $(this).attr('data-url'),
                        data: $(this).serialize(),
                        success: function (response) {
                            $('#overlay').css('display','none');
                            $('#loader').fadeOut(500);
                            if(response.code === 200 && response.url){
                                window.location = response.url;
                            }
                            if(response.code === 500 && response.message){
                                $(':input').val('');
                                toastr.error(response.message, 'Thông báo!!',{timeOut: 5000})
                            }
                            $('#loader').fadeOut(500);
                        }
                    });
                }
            });
        },

        destroy: function () {
            $.removeData(this.element[0], pluginName);
        }
    };

    $.fn[pluginName] = function (options, params) {
        return this.each(function () {
            var instance = $.data(this, pluginName);
            if (!instance) {
                $.data(this, pluginName, new Plugin(this, options));
            } else if (instance[options]) {
                instance[options](params);
            }
        });
    };

    $.fn[pluginName].defaults = {
        fileExtension: false,
        holdMessageError: ''
    };

    $(function () {
        $('[data-' + pluginName + ']')[pluginName]();
    });

}(jQuery, window));
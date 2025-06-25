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
    var pluginName = 'push-order-to-erp';

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
            this.element.click(function () {
                $('#loader').fadeIn();
                $('#overlay').css('display', 'block');
                var url = $(this).attr('data-url');
                var data = {
                    'action': $(this).attr('data-action'),
                    'orderCode': $(this).attr('data-ordercode'),
                    'ananas_nounce' : $('#ananas_nounce').val()
                };
                jQuery.ajax({
                    type: "post",
                    dataType: "json",
                    url: url,
                    data: data,
                    success: function (response) {
                        if (response.status === 200) {
                            toastr.success(response.message, 'Thông báo!!', {timeOut: 5000});
                        }
                        if (response.status === 403) {
                            toastr.error(response.message, 'Thông báo!!', {timeOut: 5000});
                        }
                        if (response.status === 500) {
                            toastr.error(response.message, 'Thông báo!!', {timeOut: 5000});
                        }
                    }
                })
                $('#overlay').css('display', 'none');
                $('#loader').fadeOut(500);
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
    var pluginName = 'update-status-all-order';

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
            this.element.click(function () {
                $('#loader').fadeIn();
                $('#overlay').css('display', 'block');
                var url = $(this).attr('data-url');
                var data = {
                    'action': $(this).attr('data-action'),
                    'current_slug': $(this).attr('data-current-status'),
                    'slug': $(this).attr('data-next-status'),
                    'is_change_all': true,
                    // 'ananas_nounce' : $('#ananas_nounce').val()
                };
                jQuery.ajax({
                    type: "post",
                    dataType: "json",
                    url: url,
                    data: data,
                    success: function (response) {
                        if (response.success) {
                            toastr.success('Cập nhật thành công', 'Thông báo!!', {timeOut: 5000});
                        }else {
                            toastr.error('Có đơn chưa có sản phẩm hoặc quá trình cập nhật có lỗi', 'Thông báo!!', {timeOut: 5000});
                        }
                        location.reload();
                    },
                    error: function (response) {
                        toastr.error('Có đơn chưa có sản phẩm hoặc quá trình cập nhật có lỗi', 'Thông báo!!', {timeOut: 5000});
                    }
                });
                $('#overlay').css('display', 'none');
                $('#loader').fadeOut(500);
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
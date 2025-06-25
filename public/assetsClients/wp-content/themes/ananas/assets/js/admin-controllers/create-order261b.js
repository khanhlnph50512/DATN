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
    var pluginName = 'create-order';

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
                            if(response.status === 200 && response.url){
                                window.location = response.url;
                            }
                            if(response.status === 500 && response.message){
                                $(':input').val('');
                                toastr.error(response.message, 'Thông báo!!',{timeOut: 5000})
                            }
                            $('#loader').fadeOut(500);
                        }
                    })
                }
            });
            $('a[data-reset-input] ').click(function (e) {
                $(':input').val('');
            })
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
    var pluginName = 'change-provine';

    // isAddMaxFile = window.isAddMaxFile;
    function Plugin(element, options) {
        this.element = $(element);
        this.options = $.extend({}, $.fn[pluginName].defaults, this.element.data(), options);
        this.init();
    }

    Plugin.prototype = {
        init: function () {
            var  el = $('select[name="customerDistrict"]');
            var  elWard = $('select[name="customerWard"]');
            this.element.change(function (e) {
                $('#loader').fadeIn();
                $('#overlay').css('display','block');
                jQuery.ajax({
                    type: "post",
                    dataType: "json",
                    url: $(this).attr('data-url-provine'),
                    data : {
                        action: 'listDistrict',
                        termParent: $(this).val(),
                    },
                    success: function (response) {
                        $(el).empty();
                        $(elWard).empty();
                        $.each(response, function (idx, obj) {
                            $(el).append('<option value="' + obj.term_id + '">' + obj.name + '</option>');
                        });
                        $(elWard).append('<option value="">Vui lòng chọn Phường/xã</option>');

                        $(el).trigger("chosen:updated");
                        $(elWard).trigger("chosen:updated");
                    }
                })
                $('#overlay').css('display','none');
                $('#loader').fadeOut(500);
            })
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
    var pluginName = 'update-ward';

    // isAddMaxFile = window.isAddMaxFile;
    function Plugin(element, options) {
        this.element = $(element);
        this.options = $.extend({}, $.fn[pluginName].defaults, this.element.data(), options);
        this.init();
    }

    Plugin.prototype = {
        init: function () {
            console.log(this);
            var  el = $('select[name="customerWard"]');
            this.element.submit(function (e) {
                e.preventDefault();
                $('#loader').fadeIn();
                $('#overlay').css('display','block');
                console.log('tets');
                jQuery.ajax({
                    type: "post",
                    dataType: "json",
                    url: $(this).attr('data-url'),
                    data : $(this).serialize(),
                    success: function (response) {
                        if(response.status === 200){
                            $('#modal-update-delivery').modal('toggle');
                            $('.wardNameDelivery').html(response.wardName);
                            toastr.success(response.message, 'Thông báo!!',{timeOut: 5000})
                        }
                        if(response.status === 500 && response.message){
                            toastr.error(response.message, 'Thông báo!!',{timeOut: 5000})
                        }
                    }
                })
                $('#overlay').css('display','none');
                $('#loader').fadeOut(500);
            })
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


// if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
jQuery(function($) {
    $(document).on('click', '.toolbar a[data-target]', function(e) {
        e.preventDefault();
        var target = $(this).data('target');
        $('.widget-box.visible').removeClass('visible');//hide others
        $(target).addClass('visible');//show target
    });
});



//you don't need this, just used for changing background
jQuery(function($) {
    $('#btn-login-dark').on('click', function(e) {
        $('body').attr('class', 'login-layout');
        $('#id-text2').attr('class', 'white');
        $('#id-company-text').attr('class', 'blue');

        e.preventDefault();
    });
    $('#btn-login-light').on('click', function(e) {
        $('body').attr('class', 'login-layout light-login');
        $('#id-text2').attr('class', 'grey');
        $('#id-company-text').attr('class', 'blue');

        e.preventDefault();
    });
    $('#btn-login-blur').on('click', function(e) {
        $('body').attr('class', 'login-layout blur-login');
        $('#id-text2').attr('class', 'white');
        $('#id-company-text').attr('class', 'light-blue');

        e.preventDefault();
    });

});

jQuery(function($) {
    $(document).on('change', '#customerDistrict', function(e) {
        e.preventDefault();
        var  el = $('select[name="customerWard"]');
        $('#loader').fadeIn();
        $('#overlay').css('display','block');
        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: ajaxUrl,
            data : {
                action: 'listDistrict',
                termParent: $(this).val(),
            },
            success: function (response) {
                $(el).empty();
                $.each(response, function (idx, obj) {
                    $(el).append('<option value="' + obj.term_id + '">' + obj.name + '</option>');
                });
                $(el).trigger("chosen:updated");
            }
        })
        $('#overlay').css('display','none');
        $('#loader').fadeOut(500);

    });
});

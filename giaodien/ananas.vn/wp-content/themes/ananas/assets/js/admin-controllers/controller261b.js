let callAjax;
let loadData;
let clearDataOnSelectBoxes;
let setValueForElement;
let updateStatus;
(function ($, window) {
    callAjax = async function callAjax(method, data, url = null) {
        const result = await $.ajax({
            url: url ? url : ajaxUrl,
            type: method,
            data
        })
        return result;
    }

    // Function to fill data base on td class
    loadData = function loadData(result, key, value, isProduct = false) {
        // console.log(result);
        let td = $(`#${result.id}`).find(`td.${key}`);
        if (isProduct) {
            td = $(`#${result.id}-${result.size}`).find(`td.${key}`);
        }
        if (td) {
            td.html(value);
        }
    }
    $( "#datepicker1" ).datepicker();
    $( "#datepicker2" ).datepicker();
    // Function to clear data on select box
    clearDataOnSelectBoxes = function clearDataOnSelectBoxes(justClearSize = false) {
        if (!justClearSize) {
            // Clear data on loadProduct
            $('.loadProduct').empty().append('<option value=""></option>');
            $('.loadProduct').trigger('chosen:updated');
        }
        // Clear data on loadProductSize
        $('.loadProductSize').empty().append('<option value=""></option>');
        $('.loadProductSize').trigger('chosen:updated');
        // Clear value on input quantity
        $('#quantity').val('');
    }

    // Function to set value for element by class or ID
    setValueForElement = function setValueForElement(type = ".", name, value) {
        let element;
        if (type === ".") {
            element = $(`.${name}`);
        } else {
            element = $(`#${name}`);
        }

        element.html(value);
    };

    var $selectReasonCancel = $('#cancel-order');
    var $textarePopup = $('#message-cancel-order');

    $selectReasonCancel.on('change', function(e) {
        var $target = $(e.currentTarget);

        if ($target.val() === 'other-reason') {
            $('#div-message-cancel-order').css('display','block');
        } else {
            $('#div-message-cancel-order').css('display','none');
        }
    });

    // Update status base on orderId and slug
    // Call from BackEnd
    updateStatus = async function updateStatus(slug, orderId, tab) {
        disableButtonBySlug(slug);
        var $tabForm = $('form.ghn-information');
        var type = 'giao-hang-nhanh';
        if (tab === 'ninja-van') {
            $tabForm = $('form.ninja-van-information');
            type = 'ninja-van';
        }
        addLoadingForAdmin();
        var message = '';
        if ($selectReasonCancel.val() === 'other-reason') {
            message = $textarePopup.val();
        } else {
            message = $selectReasonCancel.val();
        }
        if(!message && slug === 'huy-don-hang'){
            toastr.error('Vui lòng nhập lý do huỷ đơn hàng', 'Thông báo!!',{timeOut: 5000});
            hideLoadingForAdmin();
            disableButtonBySlug(slug, false);

            return;
        }
        const formData = $tabForm.serializeArray().reduce(function (obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});
        let data = {
            orderIds: [orderId],
            slug,
            type : type,
            action: 'change_order_status',
            message : message
        };
        data = {...data, ...formData};
        const result = await callAjax('POST', data);
        hideLoadingForAdmin();
        if (!result.success) {
            disableButtonBySlug(slug,false);

            toastr.error('Xảy ra lỗi trong quá trình thực hiện!! Chi Tiết lỗi : ' + result.msg, 'Thông báo!!', {timeOut: 5000})
        } else {
            location.reload();
        }
    };
    $(".modal").on("hidden.bs.modal", function(){
        $("#message-cancel-order").val("");
    });
})(jQuery);

function pushItem(array, item) {
    const index = array.indexOf(item);
    if (index === -1) array.push(item);
}

function pushItemToOrderNote(array, item) {
    const index = array.findIndex(a => a.orderId === item.orderId);
    if (index === -1) array.push(item);
}

function removeItem(array, item) {
    const index = array.indexOf(item);
    if (index !== -1) array.splice(index, 1);
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

function actionWithOrder(result) {
    if (!result.success) {
        toastr.error('Xảy ra lỗi trong quá trình thực hiện!! Chi Tiết lỗi : ' + result.msg, 'Thông báo!!', {timeOut: 5000})
    } else {
        location.reload();
    }
}

function actionLoadingAdmin() {
    $('#loader').fadeIn();
    $('#overlay').css('display', 'block');
    setTimeout(function () {
        $('#loader').fadeOut();
        $('#overlay').css('display', 'none');
    }, 1000);
}

function addLoadingForAdmin() {
    $('#loader').fadeIn();
    $('#overlay').css('display', 'block');
}

function hideLoadingForAdmin() {
    $('#overlay').css('display', 'block');
    setTimeout(function () {
        $('#loader').fadeOut();
        $('#overlay').css('display', 'none');
    }, 1000);
}

function disableByElement(element, isDisable = true) {
    if (isDisable) {
        element.attr('disabled', '');
    } else {
        element.removeAttr('disabled');
    }
}

function disableButtonBySlug(slug, isDisable = true) {
    let element = $('.updateStatusMultiOrder');

    switch (slug) {
        case 'huy-don-hang': {
            element = $('.cancelMultiOrder');
            break;
        }
        case 'xoa-don-hang': {
            element = $('.removeOrder');
            break;
        }
        default: {
            break;
        }
    }

    disableByElement(element, isDisable);

}

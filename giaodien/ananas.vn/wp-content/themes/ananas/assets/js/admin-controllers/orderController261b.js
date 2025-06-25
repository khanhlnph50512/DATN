let pushOrdersToERP;
let updateStatusMultiOrder;
let removeOrder, removeOrders;
(function ($, window) {
    const ghnInformation = $('.ghn-information');
    let hub = ghnInformation.find('#hub');
    let paymentType = ghnInformation.find('.payment_type');
    let isCOD = ghnInformation.find('#isCOD');
    let serviceType = ghnInformation.find('#service_type');
    let couponCode = ghnInformation.find('#coupon_code');
    let service_type = ghnInformation.find('#service_type');
    let weight = ghnInformation.find('#weight');
    let length = ghnInformation.find('#length');
    let width = ghnInformation.find('#width');
    let height = ghnInformation.find('#height');

    const triggerChosen = (element, isDisabled = true) => {
        if (isDisabled) {
            element.attr('disabled', '');
            element.trigger('chosen:updated');
        }
        else {
            element.removeAttr('disabled');
            element.trigger('chosen:updated');
        }
    }

    function hideFormGHN(noteOrderIds) {
        if (noteOrderIds.length) {
            triggerChosen(hub, false);
            triggerChosen(paymentType, false);
            triggerChosen(isCOD, false);
            triggerChosen(serviceType, false);
            couponCode.removeAttr('disabled');
        }
        else {
            triggerChosen(hub, true);
            triggerChosen(paymentType, true);
            triggerChosen(isCOD, true);
            triggerChosen(serviceType, true);
            couponCode.attr('disabled', '');
        }
    }
    function checkToOrder(textAreaNote, noteOrderIds, orderId) {
        if (textAreaNote.length) {
            const objectOrder = {
                orderId,
                note: textAreaNote.val()
            };
            // Disabled text, can't edit
            textAreaNote.attr('disabled', '');
            pushItemToOrderNote(noteOrderIds, objectOrder);

            hideFormGHN(noteOrderIds);
        }
    }
    function unCheckToOrder(textAreaNote, noteOrderIds, orderId = null) {
        // console.log(noteOrderIds);
        // return;
        if (textAreaNote.length) {
            if (!orderId) {
                noteOrderIds = [];
            }
            else {
                // Filter all order diff current order id
                noteOrderIds = noteOrderIds.filter(function (el) {
                    return el.orderId !== orderId;
                });
            }

            // Remove disabled, can edit
            textAreaNote.removeAttr('disabled');

            hideFormGHN(noteOrderIds);

            return noteOrderIds;
        }
    }
    // Order id will be selected
    let orderIds = [];
    let noteOrderIds = [];
    let ghnOrderCodes = [];

    // And for the first simple table, which doesn't have TableTools or dataTables
    // select/deselect all rows according to table header checkbox
    const active_class = 'active';
    $('#order-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function () {
        const th_checked = this.checked;// checkbox inside "TH" table header

        $(this).closest('table').find('tbody > tr').each(function () {
            const row = this;
            const orderId = $(row).attr('id');
            const textAreaNote = $(`#note-${orderId}`);
            const ghnOrderCode = $(row).find('td.ghnOrderCode').text();

            if (th_checked) {
                // Push orderId to array orderIds
                pushItem(orderIds, orderId);

                // With status is dang-giao-nhan and exist text area
                checkToOrder(textAreaNote, noteOrderIds, orderId);

                // With status is dang-giao-nhan and exist ghnOrderCode
                pushItem(ghnOrderCodes, ghnOrderCode);

                // Select all
                $(row).addClass(active_class).find('input[type=checkbox]').eq(0)
                    .prop('checked', true);
            } else {
                // Clear all data on array orderIds
                orderIds = [];

                noteOrderIds = unCheckToOrder(textAreaNote, noteOrderIds);

                ghnOrderCodes = [];

                // Deselect all
                $(row).removeClass(active_class).find('input[type=checkbox]').eq(0)
                    .prop('checked', false);
            }
        });
    });

    // select/deselect a row when the checkbox is checked/unchecked
    $('#order-table').on('click', 'td input[type=checkbox]', function () {
        const $row = $(this).closest('tr');
        const orderId = $row.attr('id');
        const textAreaNote = $(`#note-${orderId}`);
        const ghnOrderCode = $row.find('td.ghnOrderCode').text();
        if ($row.is('.detail-row ')) return;
        if (this.checked) {
            // Push orderId to array orderIds
            pushItem(orderIds, orderId);

            // With status is dang-giao-nhan and exist text area
            checkToOrder(textAreaNote, noteOrderIds, orderId);

            // With status is dang-giao-nhan and exist ghnOrderCode
            pushItem(ghnOrderCodes, ghnOrderCode);

            // Select one row
            $row.addClass(active_class);
        }
        else {
            // Remove orderId from array orderIds
            removeItem(orderIds, orderId);
            noteOrderIds = unCheckToOrder(textAreaNote, noteOrderIds, orderId);
            removeItem(ghnOrderCodes, ghnOrderCode);
            // removeItem(noteOrderIds, noteValue);
            // Deselect on row
            $row.removeClass(active_class);
        }
    });

    // select/deselect a row when the checkbox is checked/unchecked
    $('#order-table').on('click', 'td input[type=checkbox]', function () {
        const $row = $(this).closest('tr');
        const orderId = $row.attr('id');
        if ($row.is('.detail-row ')) return;
        if (this.checked) {
            // Push orderId to array orderIds
            pushItem(orderIds, orderId);
            // Select one row
            $row.addClass(active_class);
        }
        else {
            // Remove orderId from array orderIds
            removeItem(orderIds, orderId);
            // Deselect on row
            $row.removeClass(active_class);
        }
    });

    // Show modal and call ajax to show data on modal
    $('.seeOrderDetail').click(async (event) => {
        const that = event.currentTarget;
        const orderId = $(that).attr('id');

        const loadCity = $('.loadCity');
        const loadDistrict = $('.loadDistrict');
        const loadWardCode = $('.loadWardCode');

        // Ajax for get customer information
        const data = {
            action: 'order_detail',
            orderId
        };
        // Run ajax
        const result = await callAjax('GET', data);

        $('[name="orderId"]').val(result.ID);
        // $('#shippingType').val(result.shippingType ? result.shippingType : '');
        $('#customerName').val(result.name);
        $('#customerPhone').val(result.phone);
        $('#customerEmail').val(result.email);
        $('#customerAddress').val(result.address);
        clearLocationOnSelectBoxes();
        // Get city and district
        const dataProvinces = {
            action: 'listDistrict',
        }

        const resultsProvinces = await callAjax('GET', dataProvinces);
        resultsProvinces.forEach((result) => {
            loadCity.append($('<option>', {
                value: result.term_id,
                text: result.name,
            }));
        });
        // console.log(resultLocations);
        loadCity.trigger('chosen:updated');

        // Function to clear data on select box
        function clearLocationOnSelectBoxes(justClearDistrict = false) {
            if (!justClearDistrict) {
                // Clear data on loadCity
                loadCity.empty().append('<option value=""></option>');
                loadCity.trigger('chosen:updated');
            }
            // Clear data on loadDistrict
            loadDistrict.empty().append('<option value=""></option>');
            loadDistrict.trigger('chosen:updated');
            loadWardCode.empty().append('<option value=""></option>');
            loadWardCode.trigger('chosen:updated');

        }

        function loadDistrictByCity(parentId, district = null) {
            if (parentId) {
                const dataRequest = {
                    action: 'listDistrict',
                    termParent : parentId
                }
                var resultDistricts = '';
                // Call ajax to get all data of location
                jQuery.ajax({
                    type: "POST",
                    dataType: "json",
                    url: ajaxUrl,
                    data: dataRequest,
                    success: function (response) {
                        resultDistricts = response;
                        resultDistricts.forEach((result) => {
                            loadDistrict.append($('<option>', {
                                value: result.term_id,
                                text: result.name,
                            }));
                        });
                        loadDistrict.trigger('chosen:updated');
                        loadDistrict.val(district).trigger("chosen:updated");
                    }
                });
            }
            // Else clear all data on select box
            else {
                clearLocationOnSelectBoxes(true);
            }
        }

        function loadWardByDistrict(districtId, wardCode = null) {
            if (districtId) {
                const dataRequest = {
                    action: 'listDistrict',
                    termParent : districtId
                }
                var resultWards = '';
                // Call ajax to get all data of location
                jQuery.ajax({
                    type: "POST",
                    dataType: "json",
                    url: ajaxUrl,
                    data: dataRequest,
                    success: function (response) {
                        resultWards = response;
                        resultWards.forEach((result) => {
                            loadWardCode.append($('<option>', {
                                value: result.term_id,
                                text: result.name,
                            }));
                        });
                        loadWardCode.trigger('chosen:updated');
                        loadWardCode.val(wardCode).trigger("chosen:updated");
                    }
                });
            }
            // Else clear all data on select box
            else {
                clearLocationOnSelectBoxes(true);
            }
        }

        // Select districts
        loadCity.change(async (event) => {
            clearLocationOnSelectBoxes(true);

            const that = event.currentTarget;
            const parentId = parseInt($(that).chosen().val());

            loadDistrictByCity(parentId);
        });

        loadDistrict.change(async (event) => {
            loadWardCode.empty().append('<option value=""></option>');
            loadWardCode.trigger('chosen:updated');
            const that = event.currentTarget;
            const parentId = parseInt($(that).chosen().val());

            loadWardByDistrict(parentId);
        });

        const city = parseInt(result.city);
        const district = parseInt(result.district);
        const ward = parseInt(result.wardCode);
        loadCity.val(city).trigger("chosen:updated");
        loadDistrictByCity(city,district );
        loadWardByDistrict(district,ward);
    });

    // Update modal and load data on modal
    $('.saveOrder').click(async (event) => {
        const formData = $('form.orderDetail').serializeArray().reduce(function (obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});
        formData.action = 'update_order_detail';
        const result = await $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: formData,
        });

        $('#modal-update-order').modal('toggle');

        for (const key in result) {
            const value = result[key];
            loadData(result, key, value);
        }

    });
    pushOrdersToERP = async function pushOrderToERP(status = null, postsPerPage = null, page = null, search = null) {
        try {
            const data = {
                action: "push_order_to_erp"
            };

            if (status && postsPerPage && page) {
                data.status = status;
                data.posts_per_page = postsPerPage;
                data.page = page;
            }

            if(search){
                data.search = search;
            }

            await callAjax('POST', data);
        }
        catch (err) {
            throw err;
        }
    }

    $("#searchForm").submit((event) => {
        const that = event.currentTarget;
        const _location = $(location);
        // Get value search from input form
        const searchValue = $(that).find('.searchValue').val();
        // Get origin url
        const origin = _location.attr('origin');
        // Get path url and split to get pathName
        const path = _location.attr('pathname').split('/');
        // Get path name
        const pathName = path[1];
        // full Url from origin and pathname
        const fullUrl = `${origin}/${pathName}?search=${searchValue}`;
        //Redirect to fullUrl
        location.replace(fullUrl);
        return false;
    });

    $("#searchFormByStatus").submit((event) => {
        const that = event.currentTarget;
        const _location = $(location);
        // Get value search from input form
        const searchValue = $(that).find('.searchValue').val();
        // Get origin url
        const origin = _location.attr('origin');
        // Get path url and split to get pathName
        const path = _location.attr('pathname').split('/');
        // Get path name
        const pathName = path[1];

        let query = "";
        // const urlParams = new URLSearchParams(window.location.search);
        // const status = urlParams.get('status');
        const status = getParameterByName('status');
        if (status) {
            query = `?status=${status}&search=${searchValue}`;
        }
        else {
            query = `?search=${searchValue}`;
        }
        // full Url from origin and pathname
        const fullUrl = `${origin}/${pathName}${query}`;
        //Redirect to fullUrl
        location.replace(fullUrl);
        return false;
    });

    // Set time for push data to Erp
    setTimeout(async () => {
        const _location = $(location);
        const searchString = _location.attr('search');
        const checkExistStatus = searchString.search('status');
        if (checkExistStatus) {
            // const status = searchString.split('=').pop();
            const status = $('#pageInformation').data('status');
            const postsPerPage = $('#pageInformation').data('number');
            const page = $('#pageInformation').data('page');
            const search = $('#pageInformation').data('search');
            try {
                // await pushOrdersToERP(status, postsPerPage, page, search);
            }
            catch (err) {
                throw err;
            }
        }
    }, 1000);

    $('.btnPushErp').click(async (e) => {
        try {
            const that = e.currentTarget;
            addLoadingForAdmin();
            disableByElement($(that), true);
            await pushOrdersToERP();
            hideLoadingForAdmin();

            swal('Đã hoàn tất đưa dữ liệu lên ERP', {
                icon: 'success',
            });

            disableByElement($(that), false);

        }
        catch (err) {
            swal(err, {
                icon: 'error',
            });
            throw err;
        }
    });

    $('.btnPullProductFromErp').click(async (e) => {
        try{
            const that = e.currentTarget;
            addLoadingForAdmin();
            disableByElement($(that), true);

            const data = {
              action: 'pull_product_from_erp',
            };

            const result = await callAjax('POST', data);
            hideLoadingForAdmin();
            if(result){
                swal('Đã hoàn tất cập nhật dữ liệu từ ERP', {
                    icon: 'success',
                });
            }
            disableByElement($(that), true);
        }
        catch (err) {
            swal(err, {
                icon: 'error',
            });
            throw err;
        }
    });

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

    updateStatusMultiOrder = async function updateStatusMultiOrder(slug, tab) {
        disableButtonBySlug(slug);
        addLoadingForAdmin();
        var message = '';
        if ($selectReasonCancel.val() === 'other-reason') {
            message = $textarePopup.val();
        } else {
            message = $selectReasonCancel.val();
        }
        if(orderIds.length === 0){
            toastr.error('Vui lòng chọn đơn hàng', 'Thông báo!!',{timeOut: 5000});
            hideLoadingForAdmin();
            disableButtonBySlug(slug, false);

            return;
        }
        if(!message && slug == 'huy-don-hang'){
            toastr.error('Vui lòng nhập lý do huỷ đơn hàng', 'Thông báo!!',{timeOut: 5000});
            hideLoadingForAdmin();
            disableButtonBySlug(slug, false);

            return;
        }
        var type = 'giao-hang-nhanh';

        let data = {
            orderIds,
            slug,
            noteOrderIds,
            weight: weight.val(),
            length: length.val(),
            width: width.val(),
            height: height.val(),
            hub: hub.val(),
            payment_type: paymentType.val(),
            service_type : service_type.val(),
            couponCode: couponCode.val(),
            isCOD: isCOD.val(),
            action: 'change_order_status',
            message : message
        }

        if (tab === 'ninja-van') {
            type = 'ninja-van';
            const $tabForm = $('.ninja-van-information');
            let paymentType = $tabForm.find('.payment_type').val();
            let warehouseID = $tabForm.find('#warehouseID').val();
            let service_level = $tabForm.find('#service_level').val();
            let delivery_instructions = $tabForm.find('#delivery_instructions').val();

            let weightData =  $tabForm.find('#weight').val();
            let lengthData =  $tabForm.find('#length').val();
            let widthData =  $tabForm.find('#width').val();
            let heightData =  $tabForm.find('#height').val();
            data.warehouseID = warehouseID;
            data.service_level = service_level;
            data.delivery_instructions = delivery_instructions;
            data.payment_type = paymentType;
            data.weight = weightData;
            data.length = lengthData;
            data.width = widthData;
            data.height = heightData;
        }
        data.type = type;

        console.log(data);
        const result = await
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data,
            });
        hideLoadingForAdmin();
        if(!result.success){
            disableButtonBySlug(slug, false);
            toastr.error('Xảy ra lỗi trong quá trình thực hiện!! Chi Tiết lỗi : ' + result.msg, 'Thông báo!!',{timeOut: 5000})
        }
        else {
            location.reload();
        }
    }
    $(".modal").on("hidden.bs.modal", function(){
        $("#message-cancel-order").val("");
    });

    ghnCancelOrders = async () => {
        disableButtonBySlug('huy-don-hang');
        addLoadingForAdmin();
        var message = '';
        if ($selectReasonCancel.val() === 'other-reason') {
            message = $textarePopup.val();
        } else {
            message = $selectReasonCancel.val();
        }
        if(!message){
            toastr.error('Vui lòng nhập lý do huỷ đơn hàng', 'Thông báo!!',{timeOut: 5000});
            hideLoadingForAdmin();
            disableButtonBySlug('huy-don-hang', false);

            return;
        }
        const hiddenGHNOrderCode = $('.hiddenGHNOrderCode').val();
        if(hiddenGHNOrderCode){
            ghnOrderCodes = [hiddenGHNOrderCode];
        }
        const data = {
            action: 'ghn_cancel_orders',
            ghnOrderCodes,
            message
        };
        const result = await callAjax('POST', data, ajaxUrl);
        hideLoadingForAdmin();
        disableButtonBySlug('huy-don-hang', false);
        actionWithOrder(result);
    }

    removeOrders = async function removeOrders() {
        disableButtonBySlug('xoa-don-hang');
        addLoadingForAdmin();
        const data = {
            orderIds,
            action: 'removeOrders'
        }
        const result = await
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data,
            });
        hideLoadingForAdmin();
        if(!result.success){
            disableButtonBySlug('xoa-don-hang', false);
            toastr.error('Xảy ra lỗi trong quá trình thực hiện!! Chi Tiết lỗi : ' + result.msg, 'Thông báo!!',{timeOut: 5000})
        }
        else {
            location.reload();
        }
    }

    removeOrder = async function removeOrder(orderId) {
        $('#loader').fadeIn();
        $('#overlay').css('display','block');
        let data = {
            orderIds: [orderId],
            action: 'removeOrders'
        };

        const result = await callAjax('POST', data);
        $('#overlay').css('display','none');
        $('#loader').fadeOut(500);
        if(!result.success){
            toastr.error('Xảy ra lỗi trong quá trình thực hiện!! Chi Tiết lỗi : ' + result.msg, 'Thông báo!!',{timeOut: 5000})
        }
        else {
            location.href = "/quan-ly-don-hang";
        }
    }
})(jQuery);

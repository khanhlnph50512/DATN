(function ($, window) {

    /** Default Template and DataTable **/
    // Data Table
    const table = $('.productInformation').DataTable({
        bAutoWidth: false,
        aaSorting: [],

        select: {
            style: 'os',
        },
    });

    // Select checkbox
    table.on('select', (e, dt, type, index) => {
        if (type === 'row') {
            $(table.row(index).node()).find('input:checkbox').prop('checked', true);
        }
    });

    // Deselect check box
    table.on('deselect', (e, dt, type, index) => {
        if (type === 'row') {
            $(table.row(index).node()).find('input:checkbox').prop('checked', false);
        }
    });

    $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

    // select/deselect all rows according to table header checkbox
    $('#product-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function () {
        const th_checked = this.checked;// checkbox inside "TH" table header

        $('#product-table').find('tbody > tr').each(function () {
            const row = this;
            if (th_checked) {
                table.row(row).select();
            }
            else {
                table.row(row).deselect();
            }
        });
    });

    // select/deselect a row when the checkbox is checked/unchecked
    $('#product-table').on('click', 'td input[type=checkbox]', function () {
        const row = $(this).closest('tr').get(0);
        if (this.checked) table.row(row).deselect();
        else table.row(row).select();
    });

    // Select box with chosen js
    if (!ace.vars.touch) {
        // Default of template
        $('.chosen-select').chosen({allow_single_deselect: true});
        // resize the chosen on window resize

        // Default of template
        $(window)
            .off('resize.chosen')
            .on('resize.chosen', () => {
                $('.chosen-select').each(function () {
                    const $this = $(this);
                    $this.next().css({width: $this.parent().width()});
                });
            }).trigger('resize.chosen');
        // resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', (e, event_name, event_val) => {
            if (event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function () {
                const $this = $(this);
                $this.next().css({width: $this.parent().width()});
            });
        });
    }

    // Default of template
    $('#modal-add-product, #modal-update-order, #modal-update-delivery').on('shown.bs.modal', function () {
        if (!ace.vars.touch) {
            $(this).find('.chosen-container').css('width', '100%');
        }
    });

    /** Default Template and DataTable **/

    // Function to get product information base on tr tag and class
    function getProductInformation(trTag) {
        const tr = trTag;
        const result = {
            hiddenProductId: tr.find('td.hiddenProductId').text(),
            productImage: tr.find('td.productImage').text(),
            skuAndSize: tr.find('td.skuAndSize').text(),
            productName: tr.find('td.productName').text(),
            productPrice: tr.find('td.productPrice').text(),
            productDiscount: tr.find('td.productDiscount').text(),
            productCoupon: tr.find('td.productCoupon').text(),
            quantity: tr.find('td.quantity').text(),
            totalPrice: tr.find('td.totalPrice').text(),
        };
        return result;
    }

    // Function to get size of product
    function getSize(data) {
        const splitGetSize = data.split('-');

        const size = splitGetSize[splitGetSize.length - 1];

        return size.trim();
    }

    function getSku(data){
        const splitGetSku = data.split('-');

        const sku = splitGetSku[0];

        return sku;
    }

    // Insert data when add product
    function insertProductData(result = null, totalPayment = 0, discountPrice = 0,generalPrice = 0,insuranceValue = 0) {
        const checkbox = '<label class="pos-rel">\n' +
            ' <input type="checkbox" class="ace"/>\n' +
            ' <span class="lbl"></span>\n' +
            ' </label>';
        const action = '<div class="hidden-sm hidden-xs action-buttons">\n' +
            ' <a class="green updateProduct" href="#modal-update-product" role="button" data-toggle="modal">\n' +
            ' <i class="ace-icon fa fa-pencil bigger-130"></i>\n' +
            ' </a>\n' +
            ' \n' +
            ' <a class="red removeProduct" href="javascript:void(0)">\n' +
            ' <i class="ace-icon fa fa-trash-o bigger-130"></i>\n' +
            ' </a>\n' +
            ' </div>';

        let rows = [checkbox];
        if (result) {
            const productImage = '<img src="'+ result.image +'" alt="" width="100px%">';
            // const productImage = '<img src="http://blog.uhm.vn/emo/ongto/2.jpg" alt="">';
            const productId = result.id;
            const productCodeAndSize = `${result.sku} - ${result.size}`;
            const productName = result.name;
            const productPrice = `${result.price} VNĐ`;
            const productDiscount = `${result.discount} VNĐ`;
            const productPriceWithPromotion = `${result.priceWithPromotion} VNĐ`;
            const productIsCoupon = result.isCoupon ? '<span class="label label-sm label-success">Có</span>' : '<span class="label label-sm label-warning">Không</span>';
            const productQuantity = result.quantity;
            const productTotalPrice = `${result.totalPrice} VNĐ`;
            const newRow = [
                productId,
                productImage,
                productCodeAndSize,
                productName,
                productPrice,
                productPriceWithPromotion,
                productIsCoupon,
                productQuantity,
                productTotalPrice,
            ];
            rows = rows.concat(Object.values(newRow));
            rows.push(action);
        }

        const rowNode = table.row.add(rows).draw(false).node();
        rowNode.id = result ? result.id : 0; // Save product Id to tr tag

        // Add class for all column
        $(rowNode).find('td:eq(0)').attr('hidden', '');
        $(rowNode).find('td:eq(1)').attr('hidden', '').addClass('hiddenProductId');
        $(rowNode).find('td:eq(2)').addClass('productImage');
        $(rowNode).find('td:eq(3)').addClass('skuAndSize');
        $(rowNode).find('td:eq(4)').addClass('productName');
        $(rowNode).find('td:eq(5)').addClass('productPrice');
        $(rowNode).find('td:eq(6)').addClass('productDiscount');
        $(rowNode).find('td:eq(7)').addClass('productCoupon');
        $(rowNode).find('td:eq(8)').addClass('quantity');
        $(rowNode).find('td:eq(9)').addClass('totalPrice');


        // Re-calculator totalPrice
        setValueForElement('.', 'totalPriceAllProducts', totalPayment);
        setValueForElement('.', 'priceGeneral', generalPrice);
        setValueForElement('.', 'totalDiscountPriceAllProducts', discountPrice);
        setValueForElement('.', 'totalPriceOfProduct', totalPayment);
        setValueForElement('.', 'insuranceValue', insuranceValue);
    }

    // Add product to order
    $('.addProduct').click(async (event) => {
        // Delete old data
        clearDataOnSelectBoxes();
        // Use to load product to select box
        // Get all productIds
        const productIds = [];
        table.rows().every(function (rowIdx, tableLoop, rowLoop) {
            const data = this.data();
            productIds.push(data[1]);
        });

        const results = await
            $.ajax({
                url: ajaxUrl,
                type: 'GET',
                data: {
                    action: 'select_product',
                    productIds,
                },
            });
        results.forEach((result) => {
            $('.loadProduct').append($('<option>', {
                value: result.id,
                text: result.sku,
            }));
        });
        $('.loadProduct').trigger('chosen:updated');
    });

    // Save product
    $('.saveProduct').click(async (event) => {
        swal({
            title: 'Chú ý',
            text: 'Bạn có chắc chắn muốn cập nhật?',
            icon: 'warning',
            buttons: true,
            dangerMode: false,
        })
            .then(async (willDelete) => {
                if (willDelete) {
                    const formData = $('form.orderDetail').serializeArray().reduce((obj, item) => {
                        obj[item.name] = item.value;
                        return obj;
                    }, {});
                    formData.action = 'add_product';
                    const result = await
                        $.ajax({
                            url: ajaxUrl,
                            type: 'POST',
                            data: formData,
                        });
                    if(result.success){
                        toastr.error(result.msg, 'Thông báo',{timeOut: 5000})
                    }
                    else {
                        // Insert row use dataTable
                        await insertProductData(result.product, result.totalPayment, result.discountPrice, result.generalPrice,result.insuranceValue);

                        // Clear data from select boxes
                        // Clear on select box of product
                        clearDataOnSelectBoxes();
                        $('#modal-add-product').modal('toggle');
                        actionLoadingAdmin();
                    }
                }
            });
    });

    // Change product will get size of product
    $('.loadProduct').change(async (event) => {
        // Delete old data
        clearDataOnSelectBoxes(true);
        const that = event.currentTarget;
        const productId = $(that).chosen().val();

        // Get products and sizes in table
        // Temporarily, there is no way to find the instead class of the array
        const exceptData = [];
        table.rows().every(function (rowIdx, tableLoop, rowLoop) {
            const data = this.data();
            const size = getSize(data[3]);
            exceptData.push({
                productId: parseInt(data[1]), // parse to integer
                size
            });
        });

        // Group size by productId
        let groupData = [];
        exceptData.forEach(data => {
            const key = data.productId;
            let item = groupData.find(d => d.productId === key);
            if (!item) {
                item = {
                    sizes: [],
                    productId: key,
                };
                groupData.push(item);
            }
            item.sizes.push(data.size);
            // Remove duplicate data
            item.sizes = [...new Set(item.sizes)];
        });

        // filter by productId
        const exceptProductWithSizes = groupData.filter(d => d.productId === parseInt(productId));

        if (!productId) {
            clearDataOnSelectBoxes(true);
        }
        else {
            // If exist productId
            const data = {
                action: 'get_sizes',
                productId,
                exceptData: exceptProductWithSizes,
            }

            const results = await callAjax('GET', data);
            results.forEach((result) => {
                let option = $('<option>', {
                    value: result.size,
                    text: result.size,
                });
                if (result.quantity < 0) {
                    option = option.attr('disabled', '');
                }
                $('.loadProductSize').append(option);
            })
            $('.loadProductSize').trigger('chosen:updated');
        }
    });

    // Delete Product
    $('.productInformation tbody').on('click', '.removeProduct', async (event) => {
        swal({
            title: 'Bạn có chắc là muốn xóa?',
            text: 'Bạn sẽ xóa sản một sản phẩm của khách hàng, có muốn cân nhắc kỹ lại trước khi xóa không?',
            icon: 'error',
            buttons: true,
            dangerMode: true,
        })
            .then(async (willDelete) => {
                if (willDelete) {
                    const that = event.currentTarget;
                    // Get tag tr of this button
                    const parentTR = $(that).parents('tr');

                    // Get that row to delete row for dataTable
                    const thatRow = table.row(parentTR);
                    // Hidden
                    const data = thatRow.data();
                    // Hidden

                    // Get product information
                    const productInformation = getProductInformation(parentTR);
                    const formData = {
                        action: 'delete_product',
                        orderId: $('.hiddenOrderId').val(),
                        selectProduct: {
                            productId: productInformation.hiddenProductId,
                            size: getSize(productInformation.skuAndSize),
                            quantity: productInformation.quantity,
                        },
                    };


                    // Call ajax to delete product at BE
                    const result = await callAjax('POST', formData); // Include price when remove product
                    if(result.success){
                        toastr.error(result.msg, 'Thông báo',{timeOut: 5000})
                    }else {
                        setValueForElement('.', 'totalPriceAllProducts', result.totalPayment);
                        setValueForElement('.', 'priceGeneral', result.general_price);
                        setValueForElement('.', 'totalDiscountPriceAllProducts', result.discountPrice);
                        setValueForElement('.', 'totalPriceOfProduct', result.totalPayment);
                        setValueForElement('.', 'insuranceValue', result.insuranceValue);

                        // Remove row
                        thatRow.remove().draw();
                        // actionLoadingAdmin();
                    }
                }
            });
    });

    // Update product quantity
    $('.productInformation tbody').on('click', '.updateProduct', async (event) => {
        const that = event.currentTarget;
        const parentTR = $(that).parents('tr');

        // Get all information of product base on tr tag
        const productInformation = getProductInformation(parentTR);
        const size = getSize(productInformation.skuAndSize);
        const sku = getSku(productInformation.skuAndSize);

        // Implement data on modal
        $('#productId_update').val(productInformation.hiddenProductId);
        var productId = productInformation.hiddenProductId;
        $('#product_update').val(sku);
        $('#size_update').val(size === 'Size' ? 0 : size);
        $('#quantity_update').val(productInformation.quantity);
    });

    // Save data when update quantity
    $('.saveProductForUpdate').click(async (event) => {
        swal({
            title: 'Chú ý',
            text: 'Bạn có chắc chắn muốn cập nhật?',
            icon: 'warning',
            buttons: true,
            dangerMode: false,
        })
            .then(async (willDelete) => {
                if (willDelete) {
                    // Form data base on data on modal update product
                    const formData = {
                        selectProduct: {
                            productId: $('#productId_update').val(),
                            size: $('#size_update').val(),
                            quantity: $('#quantity_update').val(),
                        },
                        orderId: $('#orderId').val(),
                    };
                    console.log(formData);
                    // Push item action on formData
                    formData.action = 'update_quantity';

                    // Call ajax
                    const resultProduct = await callAjax('POST', formData);
                    if(resultProduct.success){
                        toastr.error(resultProduct.msg, 'Thông báo',{timeOut: 5000})
                    }
                    else {
                        const {product} = resultProduct;
                        const {totalPayment, discountPrice, generalPrice,insuranceValue} = resultProduct;
                        // Result will loop
                        const result = {
                            id: product.id,
                            quantity: product.quantity,
                            totalPrice: product.totalPrice,
                            size: product.size,
                        };

                        // Set totalPrice is format xxx VNĐ
                        const totalPrice = `${result.totalPrice} VNĐ`;
                        result.totalPrice = totalPrice; // total Price of product with quantity
                        // Loop key in result to load data
                        for (const key in result) {
                            const value = result[key];
                            await loadData(result, key, value, true);
                        }
                        setValueForElement('.', 'totalPriceAllProducts', totalPayment);
                        setValueForElement('.', 'priceGeneral', generalPrice);
                        setValueForElement('.', 'totalDiscountPriceAllProducts', discountPrice);
                        setValueForElement('.', 'totalPriceOfProduct', totalPayment);
                        setValueForElement('.', 'insuranceValue', insuranceValue);
                        // Close modal
                        $('#modal-update-product').modal('toggle');
                        actionLoadingAdmin();
                    }
                }
            });
    });
})(jQuery);
$('#loader').fadeOut(500);

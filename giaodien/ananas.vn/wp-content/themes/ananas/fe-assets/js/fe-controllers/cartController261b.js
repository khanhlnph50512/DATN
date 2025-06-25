(function ($, window) {
    var window = window;

    async function clearProduct(productId = null, size = null, productNo = null) {
        if (!productId) {

            const undoAllElement = $('.undo-all');
            const allCartElement = $('.allCart');
            const totalPriceOfCartElement = $('.totalPriceOfCart');
            const allProducts = () => {
                const x = allCartElement.find('div.button').map(function () {
                    const element = $(this);
                    return {
                        productId: element.data('id'),
                        size: element.data('size'),
                        quantity: element.data('quantity'),
                        no: element.data('no'),
                    };
                });
                const products = [];
                const divButtonElement = allCartElement.find('div.button');
                for (let i = 0; i < divButtonElement.length; i++) {
                    const childDivButtonElement = $(divButtonElement[i]);
                    const productInformation = {
                        id: childDivButtonElement.data('id'),
                        size: childDivButtonElement.data('size'),
                        quantity: childDivButtonElement.data('quantity'),
                        no: childDivButtonElement.data('no'),
                    };
                    products.push(productInformation)
                }
                return products;
            };

            // Clear all on content-cart
            allCartElement.css('display', 'none');
            totalPriceOfCartElement.text('0 VNĐ')

            // Clear all on mini cart
            $('.items').empty();
            $('.tright').text('0 VNĐ');

            // Display button undo all
            undoAllElement.css('display', 'block');

            const cartId = allCartElement.data('cart');
            /** Call ajax to remove product */
            const data = {
                'action': 'deleteCart',
                'deleteAll': true,
                'idCart': cartId,
            };
            await callAjax('POST', data);
            reCalculateTotalPriceOfCart(0, 0, 0);

            undoAllElement.click(async (event) => {
                const that = event.currentTarget;

                // Display all products
                allCartElement.css('display', 'block');

                // Hide button undo all
                $(that).css('display', 'none');

                // Call api to undo all Product

                const data = {
                    action: 'undoMultiProduct',
                    products: allProducts()
                };

                const result = await callAjax('POST', data);

                const tempResult = {
                    data: result.html
                }
                renderForCartList(tempResult);

                updateMiniCart(result);

                // reCalculateTotalPriceOfCart(result.totalPrice);
            });
        } else {
            // Js resolve front end
            const divProduct = getDivProduct(productId, size);
            const productInfoElement = divProduct.find('.product-info');
            const undoProductElement = divProduct.find('.undo-product');

            const isMiniCartElement = divProduct.find('.is-mini-cart');

            /** Call ajax to remove product */
            const data = {
                action: 'deleteCart',
                no: productNo,
                idProduct: productId,
                size: size,
            }

            const result = await callAjax('POST', data);

            const totalPrice = result.totalPayment;
            const totalDiscount = result.totalDiscount;
            const generalPrice = result.priceNotApllyPromotion;
            reCalculateTotalPriceOfCart(totalPrice, generalPrice, totalDiscount);

            /** Hidden current div product by id */

            if (isMiniCartElement.length) {
                let productElement = isMiniCartElement.parent();
                productElement.css('display', 'none').next().css('display', 'none');
            }
            productInfoElement.css('display', 'none');
            undoProductElement.css('display', 'block');

            /** Disable duplicate event click */
            undoProductElement.unbind('click');
            undoProductElement.click(async () => {
                const productInfo = {
                    productId,
                    size: divProduct.find('.selectSize option:selected').val(),
                    quantity: divProduct.find('.selectQuantity option:selected').val(),
                };
                await undoProduct(productInfo);
                // updateValueForCountProduct('add', productInfo.quantity);
                productInfoElement.css('display', 'block');
                undoProductElement.css('display', 'none');
            });

            /** Get information and save to new div */
            /** New div use to when click undo will undo this */
            // const selectSize = divProduct.find('.selectSize option:selected').val();
            // const selectQuantity = divProduct.find('.selectQuantity option:selected').val();
            //
            // const tempDiv = $('<div/>', {
            //     "class": "lastProduct",
            //     "data-id": productId,
            //     "data-size": selectSize,
            //     "data-quantity": selectQuantity
            // });
            //
            // if ($('.lastProduct').length) {
            //     $('.lastProduct').replaceWith(tempDiv)
            // }
            // else {
            //     tempDiv.appendTo('.allCart');
            // }

            // const totalPrice = result.totalPrice;
            // const totalPrice = 1;
            // reCalculateTotalPriceOfCart(totalPrice);
        }
    }

    async function addProductToCart(idProduct, quantity = null, size = null, isUndo = false, addProductRelated = false, isButtonPaid = false) {
        const token = $('#_wpnonce').val();
        const productInfo = await callAjax('GET', {
            action: 'ajaxGetProductDetail',
            idProduct,
            size,
            quantity
        });

        if(!isUndo){
            const product = {
                name: productInfo.name,
                price: productInfo.price,
                sku: productInfo.sku,
                color: productInfo.colorName,
                quantity,
                size,
                category: productInfo.category,
            };
            const productObject = toProductObject(product);
            fbTrackingAddToCart(productObject);
            ggTrackingAddToCart(productObject);
            ggTrackingAddToCartGA4();
        }


        const data = {
            action: 'addProductToCart',
            idProduct,
            quantity,
            size,
            addProductRelated,
            isButtonPaid,
            token
        };
        return await callAjax('POST', data);
    }

    /** Undo last product has been deleted */
    async function undoProduct(productInfo = null) {
        // const lastProduct = $('.lastProduct');
        // const productId = lastProduct.data('id');
        // const size = lastProduct.data('size');
        // const quantity = lastProduct.data('quantity');

        if (productInfo) {
            const {productId, size, quantity} = productInfo;
            const result = await addProductToCart(productId, quantity, size, true);

            const totalPrice = result.totalPayment;
            const totalDiscount = result.totalDiscount;
            const generalPrice = result.priceNotApllyPromotion;

            reCalculateTotalPriceOfCart(totalPrice, generalPrice, totalDiscount);

            updateMiniCart(result);
        } else {

        }
    }

    // Function to move product to wish list
    async function moveProductToWishList(listProduct, isPageWishList = 0) {

        // await function move product to wish list
        const shareCartElement = $('.shareCart');
        const shareCart = shareCartElement.length ? shareCartElement.val() : false;
        const data = {
            action: 'transferCartToWishList',
            isCartToWishList: true,
            listProduct,
            isPageWishList
        };
        if (isPageWishList && shareCart) {
            data.shareCart = shareCart;
        }
        const result = await callAjax('POST', data);
        return result;

        // listProduct.forEach((product) => {
        //     const divProduct = getDivProduct(product.idProduct, product.size);
        //     divProduct.each((index, object) => {
        //         $(object).remove();
        //     })
        // })
        //
        // const tempPriceStr = $('.tempPrice').text();
        // const tempPriceStrArray = tempPriceStr.split(" ");
        // const tempPrice = tempPriceStrArray[0].replace(',', '').replace('.', '');
        // const lastPriceAfterAddWishList = number_format(parseInt(result.totalPrice) - parseInt(tempPrice));
        //
        // reCalculateTotalPriceOfCart(lastPriceAfterAddWishList);
    }

    // Click to add product to cart
    $('#addProductToCart').click(async () => {
        const idProduct = $('#productId').val();
        const quantity = $('.quantity option:selected').val();
        const size = $('#pickSize').val();
        if (size && quantity && idProduct) {
            await handleAddProductToCart(idProduct, quantity, size);
        }
    });

    $('#pickOrder').on('click', async function (e) {
        const that = e.currentTarget;
        const idProduct = $('#productId').val();
        const quantity = $('.quantity option:selected').val();
        const size = $('#pickSize').val();
        const urlCart = $(that).data('url-cart');
        var token = $('#_wpnonce').val();
        if (size && quantity && idProduct && urlCart) {
            const result = await addProductToCart(idProduct, quantity, size, false, false, true);
            if (result) {
                ggTrackingCheckOutStep(STEP_YOUR_CART);
                document.location = urlCart;
            } else {
                console.error();
            }

            // jQuery.ajax({
            //     type: "post",
            //     dataType: "json",
            //     url: ajaxUrl,
            //     data: {
            //         action: "addProductToCart",
            //         quantity: quantity,
            //         size : size,
            //         idProduct : idProduct,
            //         token: token,
            //     },
            //     success: function (result) {
            //         if (result) {
            //             document.location = urlCart;
            //         }
            //         else {
            //             console.error();
            //         }
            //     }
            // })
        }
    });

    // Click to clear all product on cart
    async function handleClearAll() {
        await ggTrackingRemove(true);
        await clearProduct();
        updateValueForCountProduct('clearAll');
    }

    // Click to clear product be chosen
    async function handleRemoveProductInCart(event) {
        const that = event.currentTarget;
        const productId = $(that).parent().data('id');
        const size = $(that).parent().data('size');
        const productNo = $(that).parent().data('no');
        const quantity = $(that).parent().data('quantity');
        await ggTrackingRemove(false, [productId], [quantity]);
        await clearProduct(productId, size, productNo);
        updateValueForCountProduct('remove', quantity);
    }

    // Click to undo last product
    $('.btn-undo').click(async () => {
        await undoProduct();
    });

    // Click to move product to wish list
    async function handleMoveProductToWishList(event) {
        const that = event.currentTarget;

        const idProduct = $(that).parent().data('id');
        const quantity = $(that).parent().data('quantity');
        const size = $(that).parent().data('size');
        if (idProduct && size && quantity) {
            const listProduct = [
                {
                    idProduct,
                    size,
                    quantity
                }
            ];
            await moveProductToWishList(listProduct);
            // updateValueForCountProduct('remove');
            $('#image-heart').src = '/wp-content/themes/ananas/fe-assets/images/svg/Heart_2.svg';
        }
    }

    $('.multipleAddLike').click(async () => {
        const items = $('.items');
        const classListProduct = items.find('.media');
        const totalProducts = classListProduct.length;
        const listProduct = [];
        const isPageWishList = $('.isPageWishList').length ? 1 : 0;
        for (let i = 0; i < totalProducts; i++) {
            const productElement = $(classListProduct[i]);
            const productInformation = {
                idProduct: parseInt(productElement.find('.productId').next().text()),
                size: parseInt(productElement.find('.size').next().text()),
                quantity: parseInt(productElement.find('.quantity').next().text()),
            };
            listProduct.push(productInformation)
        }

        // await call ajax
        const response = await moveProductToWishList(listProduct, isPageWishList);
        if (isPageWishList) {
            renderForWishList(response);
        }
        // items.empty();
        // updateValueForCountProduct('clearAll');
    });

    async function updateProductInCart(element, attribute, value) {
        const ajaxForUpdateProduct = async (input) => {
            const data = {
                action: 'updateCart',
                quantity: input.quantity,
                idProduct: input.productId,
                size: input.size,
                no: input.productNo,
                newSize: input.newSize,
                currentSize: input.currentSize,
            };
            return await callAjax('POST', data);
        };

        const divButtonElement = $(element).parents('.product-info').find('div.button');
        divButtonElement.attr(attribute, value);

        const productId = divButtonElement.data('id');
        const productNo = divButtonElement.data('no'); // Variable is position of product in cart
        const productCurrentSize = divButtonElement.data('current-size');

        // Variable will get value of size or quantity base on attribute
        let anotherValue = 0;
        let input = {
            productId,
            productNo
        };

        switch (attribute) {
            case 'data-size': {
                anotherValue = divButtonElement.data('quantity'); // Get value of quantity
                input = {
                    ...input,
                    size: value,
                    quantity: anotherValue,
                    newSize: value,
                    currentSize: productCurrentSize
                };
                break;
            }
            case 'data-quantity': {
                anotherValue = divButtonElement.data('size'); // Get value of size
                input = {
                    ...input,
                    quantity: value,
                    size: anotherValue,
                    newSize: anotherValue,
                    currentSize: productCurrentSize
                };
                break;
            }
            default:
                break;
        }
        const result = await ajaxForUpdateProduct(input);
        renderForCartList(result);
        // var filterResult = $('[ data-cart-list]');
        // filterResult.html( result.data );
        // filterResult.find("script").each(function(i) {
        //     eval($(this).text());
        // });
        // $('.selectpicker').selectpicker('refresh');
        // $('.selectpicker').selectpicker('refresh');

        updateMiniCart(result);
    }

    async function updateProductInWishList(element, attribute, value) {
        const ajaxForUpdateProductInWishList = async (input) => {
            const data = {
                action: 'updateWishlist',
                quantityNew: input.quantityNew,
                idProduct: input.productId,
                sizeNew: input.sizeNew,
                sizeCurrent: input.sizeCurrent,
                quantityCurrent: input.quantityCurrent,
                shareCart: input.shareCart
            };
            return await callAjax('POST', data);
        };

        const divButtonElement = $(element).parents('.block-wish-list').find('div.button');
        divButtonElement.attr(attribute, value);

        const productId = divButtonElement.data('id');
        const sizeCurrent = $(element).attr('data-size-current');
        const quantityCurrent = $(element).attr('data-quantity-current');


        // Variable will get value of size or quantity base on attribute
        let anotherValue = 0;
        let input = {
            productId,
            sizeCurrent,
            quantityCurrent,
        };

        const shareCartElement = $('.shareCart');
        const shareCart = shareCartElement.length ? shareCartElement.val() : false;
        if (shareCart) {
            input.shareCart = shareCart;
        }
        switch (attribute) {
            case 'data-size': {
                anotherValue = divButtonElement.data('quantity'); // Get value of quantity
                input = {
                    ...input,
                    sizeNew: value,
                    quantityNew: anotherValue
                };
                break;
            }
            case 'data-quantity': {
                anotherValue = divButtonElement.data('size'); // Get value of size
                input = {
                    ...input,
                    quantityNew: value,
                    sizeNew: anotherValue
                };
                break;
            }
            default:
                break;
        }
        const result = await ajaxForUpdateProductInWishList(input);
        renderForWishList(result);
    }

    function setQuantityErrorToProductBlock(productId, productSize,type = null,message = null) {
        const divProduct = getDivProduct(productId, productSize);
        const classNotice = divProduct.find('.item-notice');
        if(type == 'LIMITED_PRODUCTS'){
            if (classNotice) {
                console.log(message);
                classNotice.text(message);
                classNotice.parent().css('display', 'block');
            }
        }else{
            const classPrice = divProduct.find('div.price');
            if (classPrice) {
                classPrice.removeClass('price').addClass('price-1');
            }

            const classStatus = divProduct.find('.status');
            if (classStatus) {
                classStatus.html("Hết hàng");
                classStatus.removeClass('status').addClass('status-1');
            }
            if (classNotice) {
                classNotice.parent().css('display', 'block');
            }
        }
    }

    async function handleClickToCheckOutPage(event) {
        const that = event.currentTarget;
        const data = {
            action: 'ajaxCheckQuantityOfProduct'
        };
        const result = await callAjax('GET', data);

        if (result.success) {
            ggTrackingCheckOutStep(STEP_SHIPPING_INFORMATION);

            location.href = $(that).attr('data-href');
        } else {
            const {errors, errorData} = result;

            if (errors && errorData) {
                errorData.forEach(function (error) {
                    const {productId, productSize,message,typeProduct} = error;
                    setQuantityErrorToProductBlock(productId, productSize,typeProduct,message);
                });
            }
        }
    }

    $('body').on('change', 'select.selectSize', async function (event) {
        await handleChangeSize(event);
    }).on('change', 'select.selectQuantity', async function (event) {
        await handleChangeQuantity(event);
    }).on('click', '.remove-product-in-cart', async function (event) {
        await handleRemoveProductInCart(event);
    }).on('click', '.moveProductToWishList', async function (event) {
        await handleMoveProductToWishList(event);
    }).on('click', '.btn-clearAll', async function () {
        await handleClearAll();
    }).on('click', '.to-checkout', async function (event) {
        await handleClickToCheckOutPage(event);
    }).on('click', '.btn-add-product-related', async function (event) {
        await handleAddProductRelatedToCart(event);
    }).on('click', '.btn-apply', async function (event) {
        await handlePromotionCode(event);
    });

    async function handleAddProductToCart(idProduct, quantity = null, size = null, addProductRelated = false) {
        const classInfoValidate = '.info-validate';
        const divInfoValidate = $(classInfoValidate);
        const result = await addProductToCart(idProduct, quantity, size, false, addProductRelated);

        if (result) {
            if (result.isSuccess) {
                updateMiniCart(result, true);
            } else {
                if (!addProductRelated) {
                    const classInfoValidate = '.info-validate';
                    const divInfoValidate = $(classInfoValidate);
                    const divError = $(".quantity-error");
                    if (!divError.length && divError.text() !== result.messages) {
                        $('<div/>', {
                            class: "row info-validate quantity-error",
                            text: result.messages,
                        }).insertAfter(divInfoValidate);
                        // divInfoValidate.after(
                        // );
                    }
                }
            }
        } else {
            console.error();
        }
        return result;
    }

    async function handleAddProductRelatedToCart(event) {
        const that = event.currentTarget;
        const productId = $(that).data('id');
        const result = await handleAddProductToCart(productId, null, null, true);
        result.data = result.html;
        renderForCartList(result);
    }

    async function handleChangeSize(event) {
        const that = event.currentTarget;
        const size = $(that).val();
        $('.loading-filter').show();

        const getPage = $(that).attr('data-page');

        switch (getPage) {
            case "cart": {
                await updateProductInCart(that, 'data-size', size);
                break;
            }
            case "wish-list": {
                await updateProductInWishList(that, 'data-size', size);
                break;
            }
            default: {
                console.log("None-Size");
                break;
            }
        }


        setTimeout(function () {
            $('.loading-filter').hide();
        }, 3000);
    }

    async function handleChangeQuantity(event) {
        const that = event.currentTarget;
        const quantity = $(that).val();
        $('.loading-filter').show();

        const getPage = $(that).attr('data-page');

        switch (getPage) {
            case "cart": {
                await updateProductInCart(that, 'data-quantity', quantity);
                break;
            }
            case "wish-list": {
                await updateProductInWishList(that, 'data-quantity', quantity);
                break;
            }
            default: {
                console.log("None-Quantity");
                break;
            }
        }

        setTimeout(function () {
            $('.loading-filter').hide();
        }, 3000);
    }

    async function handlePromotionCode(event) {
        $('.loading-filter').show();
        const that = event.currentTarget;
        const promotionInputElement = $(that).parent().prev();
        const promotionValue = promotionInputElement.val();
        const promotionErrorElement = $('.promotion-error');

        const data = {
            action: "checkPromotionCode",
            promotionCode: promotionValue,
        };

        const result = await callAjax('POST', data);
        result.data = result.html;
        renderForCartList(result);
    }

    $('#pickSize').on('change', function () {
        var that = $(this);
        var selectboxQuantity = $('#pickQuantity');
        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: $(this).attr('data-action'),
            data: {
                action: 'checkquanlity',
                productID: $(this).attr('data-productID'),
                size: $(this).val(),
            },
            success: function (response) {
                if (response.code) {
                    if (response.quantity > 0) {
                        selectboxQuantity.prop('disabled', false);
                        var number = 12;
                        var quantity = response.quantity;
                        if (quantity < number) {
                            number = quantity;
                        }
                        selectboxQuantity.empty();
                        selectboxQuantity.append('<option selected>&nbsp;</option>');
                        for (var i = 1; i <= number; i++) {
                            selectboxQuantity.append('<option value="' + i + '">' + i + '</option>');
                        }
                        selectboxQuantity.selectpicker('refresh');
                        if (response.isLike === false) {
                            that.addClass('moveProductToWishList');
                        } else {
                            that.removeClass('moveProductToWishList');
                        }

                    } else {
                        resetSelectpicker(selectboxQuantity);
                        selectboxQuantity.prop('disabled', true);
                    }
                } else {
                    resetSelectpicker(selectboxQuantity);
                    selectboxQuantity.prop('disabled', true);
                }

            }
        })
    })

    function resetSelectpicker(e) {
        e.empty();
        e.append('<option selected>&nbsp;</option>');
        e.selectpicker('refresh');
    }

})(jQuery);

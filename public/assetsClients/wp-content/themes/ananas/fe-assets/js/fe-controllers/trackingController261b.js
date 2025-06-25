let fbTrackingViewDetail,
    fbTrackingAddToCart,
    fbTrackingInitiateCheckoutOrPurchase;

let ggTrackingImpressions,
    ggTrackingAddToCart,
    ggTrackingViewCart,
    ggTrackingPurchase,
    ggTrackingViewDetail,
    ggTrackingRemove,
    ggTrackingCheckOutStep;

const STEP_YOUR_CART = 1;
const STEP_SHIPPING_INFORMATION = 2;
const STEP_ORDER_COMPLETED = 3;

(function ($, window, undefined) {
    function getProductDetailByInputTag() {
        const name = getValueByElement($('input.productName'));
        const color = getValueByElement($('input.productColor'));
        const sku = getValueByElement($('input.productSku'));
        const price = getValueByElement($('input.productPrice'));
        const category = getValueByElement($('input.productCategory'));
        return {
            name, color, sku, price, category
        };
    }

    function getProductDetailByInputTagGA4() {
        const item_id = getValueByElement($('input.productSku'));
        const item_name = getValueByElement($('input.productName'));
        const currency = getValueByElement($('input.currency'));
        const discount = parseInt(getValueByElement($('input.discount')));
        const item_brand = getValueByElement($('input.brand'));
        const item_category = getValueByElement($('input.productCategory'));
        const item_category2 = getValueByElement($('input.productLine'));
        const item_category3 = getValueByElement($('input.designs'));
        const item_category4 = getValueByElement($('input.collection'));
        const item_variant = getValueByElement($('input.productColor'));
        const price = parseInt(getValueByElement($('input.productPrice')).replace(/\./gi, ''));
        const quantity = 1;

        return {
            item_id,
            item_name,
            currency,
            discount,
            item_brand,
            item_category,
            item_category2,
            item_category3,
            item_category4,
            item_variant,
            price,
            quantity
        };
    }

    function geAllProductsCartGA4(isBeforeCheckout = true) {
        var $allProducts = $('.allCart');
        var $listProduct = $allProducts.find('>div');
        var products = [];
        $listProduct.map(function(index, product) {
            const item_id = getValueByElement($(product).find('input.productSku'));
            const item_name = getValueByElement($(product).find('input.productName'));
            const currency = getValueByElement($(product).find('input.currency'));
            const discount = parseInt(getValueByElement($(product).find('input.discount')));
            const item_brand = getValueByElement($(product).find('input.brand'));
            const item_category = getValueByElement($(product).find('input.productCategory'));
            const item_category2 = getValueByElement($(product).find('input.productLine'));
            const item_category3 = getValueByElement($(product).find('input.designs'));
            const item_category4 = getValueByElement($(product).find('input.collection'));
            const item_variant = getValueByElement($(product).find('input.productColor'));
            const price = parseInt(getValueByElement($(product).find('input.productPrice')).replace(/\./gi, ''));
            let quantity = 1;

            if (!isBeforeCheckout) {
                quantity = parseInt($(product).find('select.selectQuantity').val());
            }

            products.push({
                item_id,
                item_name,
                currency,
                discount,
                item_brand,
                item_category,
                item_category2,
                item_category3,
                item_category4,
                item_variant,
                price,
                quantity
            });
        });

        return products;
    }

    function getProductsAndTotalPrice(products) {
        let totalPrice = 0;
        const repsonses = products.map(function (product, index) {
            const quantity = reParseQuantity(product.quantity);
            const price = replacePrice(product.price);
            totalPrice += quantity * price;
            return toProductObject(product);
        });

        return {
            price: totalPrice,
            products: repsonses,
        };
    }

    // Tracking with Facebook
    function fbTracking(action = 'ViewContent', values) {

        let {
            name, color, sku, price, category, type, currency, size, quantity, contents
        } = values;

        if (!category) {
            category = 'Shoes > Basas';
        }

        if (!type) {
            type = 'product';
        }

        if (!currency) {
            currency = 'VND';
        }

        price = replacePrice(price);
        quantity = reParseQuantity(quantity);

        let params = {};
        switch (action) {
            case 'ViewContent': {
                params = {
                    content_name: name,
                    product_color: color,
                    content_category: category,
                    content_ids: [sku],
                    content_type: type,
                    value: price,
                    currency
                };
                break;
            }
            case 'AddToCart': {
                params = {
                    content_name: name,
                    product_color: color,
                    content_category: category,
                    content_ids: [sku],
                    size,
                    number_items: quantity,
                    content_type: type,
                    value: price,
                    currency
                };
                break;
            }
            case 'Purchase':
            case 'InitiateCheckout': {
                params = {
                    value: price,
                    currency,
                    contents,
                    content_type: type,
                };
                break;
            }
            default:
                break;
        }
        fbq('track', action, params);

    }

    // Tracking View Detail
    fbTrackingViewDetail = function fbTrackingViewDetail() {
        const isProductDetailPage = returnBooleanByExistElement($('.isProductDetailPage'));
        if (isProductDetailPage) {
            const {name, color, sku, price, category} = getProductDetailByInputTag();
            const type = 'product';
            const currency = 'VND';

            const values = {
                name, color, sku, price, category, type, currency
            };
            fbTracking('ViewContent', values);
        }
    }

    // Tracking when addCart
    fbTrackingAddToCart = function fbTrackingAddToCart(values) {
        fbTracking('AddToCart', values);
    }

    // Tracking when load page your cart
    fbTrackingInitiateCheckoutOrPurchase = async function fbTrackingInitiateCheckoutOrPurchase() {
        const isYourCart = returnBooleanByExistElement($('.isYourCart'));
        const isCompletePage = returnBooleanByExistElement($('.isCompletePage'));
        if (isYourCart || isCompletePage) {
            let products = {};
            let action = '';
            if (isYourCart) {
                action = 'InitiateCheckout';
                products = await ajaxGetProductFromCart();
            } else {
                const orderCode = $('.order-id').text();
                action = 'Purchase';
                const order = await ajaxGetOrderByCode(orderCode);
                products = order.products;

                const event = 'purchased';
                const result = getProductsAndTotalPrice(order.products);
                const actionFieldObject = {
                    purchase: {
                        actionField: {
                            id: order.ID,
                            revenue: replacePrice(order.totalPayment),
                            shipping: replacePrice(order.shippingFee),
                            coupon: '',
                        },
                        products: result.products,
                    }
                };

                var newProductsGA4 = order.products.map(function(productItem) {
                    return {
                        item_id: productItem.sku,
                        item_name: productItem.name,
                        currency: 'VND',
                        discount: productItem.promotion,
                        item_brand: 'Ananas',
                        item_category: productItem.category,
                        item_category2: productItem.productLine,
                        item_category3: productItem.productDesigns,
                        item_category4: productItem.productCollection,
                        item_variant: productItem.color,
                        price: productItem.price,
                        quantity: productItem.quantity
                    };
                });

                productGA4 = {
                    transaction_id: order.orderCode,
                    value: order.totalPrice,
                    shipping: parseInt(order.shippingFee.replace(/\./gi, '')),
                    currency: 'VND',
                    items: newProductsGA4
                };

                ggTrackingGA4(productGA4, 'purchase');
                ggTracking(actionFieldObject, event);
            }

            const result = getProductsAndTotalPrice(products);
            const contents = result.products.map(function (product) {
                return toProductObject(product);
            });
            const values = {
                price: result.price,
                contents
            };

            fbTracking(action, values);
        }
    }

    // Tracking with Gogole
    function ggTracking(actionFieldObject = null, event = null) {
        let ecommerce = {
            currencyCode: 'VND',
        };

        ecommerce = {...ecommerce, ...actionFieldObject};

        dataLayer.push({
            event,
            ecommerce
        });
    }

    function ggTrackingGA4(ecommerce = null, event = null) {
        dataLayer.push({ ecommerce: null });
        dataLayer.push({
            event,
            ecommerce
        });
    }

    ggTrackingImpressions = async function ggTrackingImpressions(productList = null, loadProduct = false) {
        let result = [];
        const isProductDetailPage = returnBooleanByExistElement($('.isProductDetailPage'));
        if (isProductDetailPage) {

            const productIds = [];
            // Related Product Ids
            $('input.referenceId').each(function (index, item) {
                productIds.push($(item).val());
            });

            // Seen Product Ids
            $('input.seenId').each(function (index, item) {
                productIds.push($(item).val());
            });

            productIds.push($('.productDetailId').val());

            const productIdsString = productIds.join(',');

            const data = {
                action: 'ajaxGetProductsDetail',
                ids: productIdsString,
            };

            // Run ajax
            const products = await callAjax('POST', data, false);

            result = products.map(function (product, index) {
                const temp = toProductObject(product);
                return {
                    name: temp.name,
                    price: temp.price,
                    brand: 'Ananas',
                    category: temp.category,
                    variant: temp.color,
                    id: temp.sku,
                };
            });
        }

        if(productList && loadProduct){
            result = productList.map(function (product) {
                return {
                    name: product.productName,
                    price: replacePrice(product.productPrice),
                    brand: 'Ananas',
                    category: product.category,
                    variant: product.productColor,
                    id: product.productSKU
                };
            });
        }
        if (result && result.length) {
            const event = 'impressions';

            const actionFieldObject = {
                impressions: result
            };

            ggTracking(actionFieldObject)
        }
    }

    ggTrackingAddToCart = function ggTrackingAddToCart(values) {
        const event = 'addToCart';
        const products = [values];
        const actionFieldObject = {
            add: {
                products
            }
        };
        ggTracking(actionFieldObject, event);
    }

    ggTrackingAddToCartGA4 = function ggTrackingAddToCartGA4() {
        const event = 'add_to_cart';
        const product = getProductDetailByInputTagGA4();
        product.quantity = parseInt($('[data-id="pickQuantity"]').attr('title'));

        var ecommerce = {
            items: [product]
        }

        ggTrackingGA4(ecommerce, event);
    }

    // When click to checkout
    ggTrackingViewCart = async function ggTrackingViewCart() {
        const isYourCart = returnBooleanByExistElement($('.isYourCart'));
        if(isYourCart){
            const event = 'checkout';

            let products = await ajaxGetProductFromCart();
            if(products && products.length){
                const result = getProductsAndTotalPrice(products);

                const actionFieldObject = {
                    checkout: {
                        viewCart: {
                            step: 1,
                        },
                        products: result.products,
                    }
                };

                var newProductsGA4 = products.map(function(productItem) {
                    return {
                        item_id: productItem.sku,
                        item_name: productItem.name,
                        currency: 'VND',
                        discount: productItem.intDiscount,
                        item_brand: 'Ananas',
                        item_category: productItem.category,
                        item_category2: productItem.productLine,
                        item_category3: productItem.productDesigns,
                        item_category4: productItem.productCollection,
                        item_variant: productItem.color,
                        price: replacePrice(productItem.price),
                        quantity: replacePrice(productItem.quantity),
                    };
                });

                var ecommerce = {
                    items: newProductsGA4
                }
                var eventGA4 = $('#orderForm').length ? 'add_shipping_info' : 'begin_checkout';

                ggTracking(actionFieldObject, event);
                ggTrackingGA4(ecommerce, eventGA4);
            }
        }
    }

    // ggTrackingPurchase = async function ggTrackingPurchase() {
    //     const isCompletePage = returnBooleanByExistElement($('.isCompletePage'));
    //     if (isCompletePage) {
    //         const orderCode = $('.order-id').text();
    //         const order = await ajaxGetOrderByCode(orderCode);

    //         const event = 'purchased';

    //         const result = getProductsAndTotalPrice(order.products);
    //         const actionFieldObject = {
    //             purchase: {
    //                 actionField: {
    //                     id: order.ID,
    //                     revenue: replacePrice(order.totalPayment),
    //                     shipping: replacePrice(order.shippingFee),
    //                     coupon: '',
    //                 },
    //                 products: result.products,
    //             }
    //         };

    //         ggTracking(actionFieldObject, event);
    //     }
    // }

    ggTrackingViewDetail = function ggTrackingViewDetail() {
        const isProductDetailPage = returnBooleanByExistElement($('.isProductDetailPage'));
        if (isProductDetailPage) {
            const {name, color, sku, price, category} = getProductDetailByInputTag();
            const brand = 'Ananas';

            const products = {
                name,
                id: sku,
                price,
                brand,
                category,
                variant: color
            };

            const values = {
                'detail': {
                    actionField: {
                        list: category,
                    },
                    products,
                }
            };
            ggTracking(values);
        }
    }

    ggTrackingViewDetailGA4 = function ggTrackingViewDetailGA4(){
        const isProductDetailPage = returnBooleanByExistElement($('.isProductDetailPage'));
        if (isProductDetailPage) {
            const products = getProductDetailByInputTagGA4();

            ecommerce = {
                items: [products],
            };

            ggTrackingGA4(ecommerce, 'view_item');
        }
    }

    ggTrackingRemove = async function ggTrackingRemove(all = false, ids = [], quantities = []){
        let products = [];
        if(all){
            products = await ajaxGetProductFromCart();
        }
        else {
            const idsToString = ids.join(',');
            const quantitiesToString = quantities.join(',');
            const data = {
                action: 'ajaxGetProductsDetail',
                ids: idsToString,
                quantities: quantitiesToString
            };

            products = await callAjax('POST', data, false);
        }

        if(products && products.length){
            const event = 'removeFromCart';
            const result = products.map(function(product){
               const temp = toProductObject(product);
                return {
                    name: temp.name,
                    price: temp.price,
                    brand: 'Ananas',
                    category: temp.category,
                    variant: temp.color,
                    id: temp.sku,
                    quantity: temp.quantity
                };
            });
            const values = {
                remove: {
                    products: result,
                }
            };

            ggTracking(values, event);
        }
    }

    ggTrackingCheckOutStep = function ggTrackingCheckOutStep(step = STEP_YOUR_CART){
        let option = 'your-cart';
        let eventGA4 = 'begin_checkout';
        let products = [];

        var ecommerce = {
            items: products
        };

        if (step !== STEP_ORDER_COMPLETED) {
            products = geAllProductsCartGA4();
            ecommerce.items = products;
        }

        switch (step) {
            case STEP_YOUR_CART: {
                ecommerce.items = getProductDetailByInputTagGA4();
                eventGA4 = 'begin_checkout';
                break;
            }
            case STEP_SHIPPING_INFORMATION: {
                option = 'shipping-information';
                eventGA4 = 'add_shipping_info';
                products = geAllProductsCartGA4(false);
                ecommerce.currency = 'VND';
                ecommerce.value = parseInt($('.tempPrice').text().replace(/\./gi, ''));
                ecommerce.shipping_tier = 'GHN';
                ecommerce.items = products;
                break;
            }
            case STEP_ORDER_COMPLETED: {
                option = 'order-completed';
                eventGA4 = 'purchase';
                break;
            }
            default: {
                break;
            }
        }
        const event = 'checkoutOption';

        const values = {
            checkout_option: {
                actionField: {
                    step,
                    option
                }
            }
        };
        console.log(values);

        ggTracking(values, event);
        ggTrackingGA4(ecommerce, eventGA4);
    }

    $('.mini-cart-checkout').click(function(){
        ggTrackingCheckOutStep(STEP_YOUR_CART);
    });

    $(window).load(function() {
        // Facebook Tracking
        fbTrackingViewDetail();
        fbTrackingInitiateCheckoutOrPurchase();

        // Google Tracking
        ggTrackingImpressions();
        // ggTrackingPurchase();
        ggTrackingViewDetail();
        ggTrackingViewDetailGA4();
        ggTrackingViewCart();
    });

})(jQuery, window);

/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

define([
    'jquery',
    'mage/translate',
    'underscore',
    'Magento_Catalog/js/product/view/product-ids-resolver',
    'Magento_Catalog/js/product/view/product-info-resolver',
    'mage/url',
    'jquery-ui-modules/widget'
], function ($, $t, _, idsResolver, productInfoResolver, urlBuilder) {
    'use strict';
    return function (widget) {
        $.widget('mage.catalogAddToCart', widget, {
            options: {
                processStart: null,
                processStop: null,
                bindSubmit: true,
                minicartSelector: '[data-block="minicart"]',
                messagesSelector: '[data-placeholder="messages"]',
                productStatusSelector: '.stock.available',
                addToCartButtonSelector: '.action.tocart',
                addToCartButtonDisabledClass: 'disabled',
                addToCartButtonTextWhileAdding: '',
                addToCartButtonTextAdded: '',
                addToCartButtonTextDefault: '',
                productInfoResolver: productInfoResolver
            },
            ajaxSubmit: function (form) {
                var self = this,
                    productIds = idsResolver(form),
                    productInfo = self.options.productInfoResolver(form),
                    formData;
                $(self.options.minicartSelector).trigger('contentLoading');
                self.disableAddToCartButton(form);
                formData = new FormData(form[0]);
                $.ajax({
                    url: form.attr('action'),
                    data: formData,
                    type: 'post',
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    /** @inheritdoc */
                    beforeSend: function () {
                        $.ajax({
                            url: urlBuilder.build('checkout/checkout/advancedcheckout'),
                            data: formData,
                            type: 'post',
                            dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                let result;
                                result = response.result;
                                if (result === true) {
                                    let productSku;
                                    productSku = response.data.product_in_cart;

                                    var popup = $('<div class="add-to-cart-modal-popup"/>').html(productSku + '<span> has been added to cart.</span>').modal({
                                        modalClass: 'add-to-cart-popup',
                                        title: $.mage.__("ADD PRODUCT TO CART"),
                                        buttons: [
                                            {
                                                text: 'Clear Cart',
                                                click: function () {
                                                    $.ajax({
                                                        url: urlBuilder.build('checkout/checkout/clearcart'),
                                                        type: 'post',
                                                        dataType: 'json',
                                                        cache: false,
                                                        contentType: false,
                                                        processData: false,
                                                        success: function (response) {
                                                            let result;
                                                            result = response.result;
                                                            if (result === true) {
                                                                popup.modal('closeModal');
                                                                window.location.href = response.redirect;
                                                            }
                                                        },
                                                        error: function (xhr, status, errorThrown) {
                                                            console.log('Error happens. Try again.');
                                                        },
                                                    })
                                                }
                                            },
                                            {
                                                text: 'Checkout',
                                                click: function () {
                                                    window.location = window.checkout.checkoutUrl
                                                }
                                            }
                                        ]
                                    });
                                    popup.modal('openModal');
                                }
                            },
                        });
                    },

                    /** @inheritdoc */
                    success: function (res) {
                        var eventData, parameters;
                        $(document).trigger('ajax:addToCart', {
                            'sku': form.data().productSku,
                            'productIds': productIds,
                            'productInfo': productInfo,
                            'form': form,
                            'response': res
                        });
                        if (self.isLoaderEnabled()) {
                            $('body').trigger(self.options.processStop);
                        }
                        if (res.backUrl) {
                            eventData = {
                                'form': form,
                                'redirectParameters': []
                            };
                            $('body').trigger('catalogCategoryAddToCartRedirect', eventData);
                            if (eventData.redirectParameters.length > 0 &&
                                window.location.href.split(/[?#]/)[0] === res.backUrl
                            ) {
                                parameters = res.backUrl.split('#');
                                parameters.push(eventData.redirectParameters.join('&'));
                                res.backUrl = parameters.join('#');
                            }
                            self._redirect(res.backUrl);
                            return;
                        }
                        if (res.messages) {
                            $(self.options.messagesSelector).html(res.messages);
                        }
                        if (res.minicart) {
                            $(self.options.minicartSelector).replaceWith(res.minicart);
                            $(self.options.minicartSelector).trigger('contentUpdated');
                        }
                        if (res.product && res.product.statusText) {
                            $(self.options.productStatusSelector)
                                .removeClass('available')
                                .addClass('unavailable')
                                .find('span')
                                .html(res.product.statusText);
                        }
                        self.enableAddToCartButton(form);

                    },

                    /** @inheritdoc */
                    error: function (res) {
                        $(document).trigger('ajax:addToCart:error', {
                            'sku': form.data().productSku,
                            'productIds': productIds,
                            'productInfo': productInfo,
                            'form': form,
                            'response': res
                        });
                    },

                    /** @inheritdoc */
                    complete: function (res) {
                        if (res.state() === 'rejected') {
                            location.reload();
                        }
                    }
                });
            },
        });
        return $.mage.catalogAddToCart;
    }
});

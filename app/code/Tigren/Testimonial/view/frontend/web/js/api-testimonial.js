/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */
define([
    'jquery',
    'mage/url',
    'mage/storage',
], function (
    $,
    urlBuilder,
    storage,
) {
    'use strict';
    $(document).ready(function () {
        $('#submit').on('click', function () {
            var formData = new FormData($("#question-form")[0]);
            formData = JSON.stringify(Object.fromEntries(formData));
            storage.post(
                urlBuilder.build("rest/V1/testimonial/save"),
                JSON.stringify({data: formData})
            ).done(function (r) {
                window.location.replace(r);
            }).fail(function (r) {
                alert("Error");
            });
        });

        $('.delete').on('click', function () {
            var id = $('.id').text();
            $.ajax({
                type: "POST",
                url: urlBuilder.build("rest/V1/custom/delete/" + id),
                data: {
                    id: id,
                },
                dataType: 'json',
                contentType: 'application/json',
                success: function () {
                    alert("Success");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert("Error");
                },
            });
        });
    })

})


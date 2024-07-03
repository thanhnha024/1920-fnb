"use strict";
$ = jQuery;

$(document).ready(function () {
  initCalendar();
  toggleMoreDate();
  chooseDate();
  trigerMainButton();
  validationEvent();
});
//display_popup_pickup
document.getElementById('pickupButton').addEventListener('click', function() {
    jQuery.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: {
            action: 'display_popup_pickup',
            pickupstatus: 1,
        },
        success: function(response) {
            var acheckLink = document.getElementById('acheck');
            acheckLink.click();
        },
        error: function(error) {
            console.log('Failed to process items.');
        }
    });
});
//save_store_to_session
jQuery(document).ready(function($) {
    $('.button-selected-store').click(function(e) {
        e.preventDefault();
        var storeId = $(this).closest('.infor-pickup').find('.items-infor-pickup-content.active').data('store-id');

        if (storeId) {
            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                data: {
                    action: 'save_store_to_session',
                    store_id: storeId,
                },
                success: function(response) {
                    console.log(response);
                    var calendarPickupLink = document.getElementById('calendar-pickup');
                    calendarPickupLink.click();
                },
                error: function(error) {
                    console.log('Failed to save store.');
                }
            });
        } else {
            console.error('No active store selected.');
        }
    });

     //Quantity mini cart
     $('body').on('change', '.quantity.buttons_added .qty', function() {
        var $input = $(this);
        var cart_item_key = $input.attr('data-cart-item-key');
        $.ajax({
            type: 'POST',
            url: mini_cart_params.ajax_url,
            data: {
                action: 'woocommerce_update_cart_item_quantity',
                cart_item_key: cart_item_key,
                quantity: $(this).val(),
                _wpnonce: mini_cart_params.update_cart_nonce
            },
            success: function(response) {
               $('#cart-items-count').text('You have added ' + response.data['cart_count'] + ' items');
                // Reload the mini cart
                $(document.body).trigger('wc_fragment_refresh');
                
            },
            error: function(response) {
                console.log('Error:', response);
               
            }
        });
    
        
    });
});

//Event click view map on pop up
document.addEventListener('DOMContentLoaded', function() {
    var items = document.querySelectorAll('.items-infor-pickup-content');

    items.forEach(function(item) {
        item.addEventListener('click', function() {
            
            
            items.forEach(function(el) {
                el.classList.remove('active');
            });

            item.classList.add('active');

            var linkmapElement = item.querySelector('.linkmap');
            if (linkmapElement) {
                var linkmapText = linkmapElement.textContent || linkmapElement.innerText;

                var viewmapElement = document.getElementById('viewmap');
                if (viewmapElement) {
                    viewmapElement.setAttribute('href', linkmapText);
                }
            }
        });
    });
});





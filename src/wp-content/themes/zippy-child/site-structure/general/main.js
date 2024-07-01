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
                    console.log('Store info saved to session.');
                    window.location.href = '/shop/';
                },
                error: function(error) {
                    console.error('Error saving store info to session.');
                }
            });
        } else {
            console.error('No active store selected.');
        }
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





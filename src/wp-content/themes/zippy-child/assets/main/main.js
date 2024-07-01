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

            var idtoreElement = item.querySelector('.idstore');
            var idtoreText = idtoreElement ? (idtoreElement.textContent || idtoreElement.innerText) : '';

            jQuery.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {
                    action: 'get_store_pickup',
                    storepickup: idtoreText,
                },
                success: function(response) {
                    console.log('success pick store');
                },
                error: function(error) {
                    console.log('Failed to process items.');
                }
            });
        });
    });
});


document.getElementById('place_order').addEventListener('click', function() {
    jQuery.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: {
            action: 'display_popup_pickup',
            pickupstatus: 0,
        },
        success: function(response) {
            console.log('Success to process items.');
        },
        error: function(error) {
            console.log('Failed to process items.');
        }
    });
});

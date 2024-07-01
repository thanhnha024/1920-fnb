<?php
add_action('woocommerce_checkout_order_review', 'display_store_pickup');
function display_store_pickup() {
    $name_store = isset($_COOKIE['name_store']) ? $_COOKIE['name_store'] : '';
    $location_store = isset($_COOKIE['location_store']) ? $_COOKIE['location_store'] : '';
    ?>
    <div class="pickup_location_field">
        <h4>Store Pick Up</h4>
        <p>Store: <?php echo $name_store ?> </p>
        <p>Address:  <?php echo  $location_store ?> </p>
    </div>
    <?php
}

//Save input pickup field in Checkout Page
add_action('woocommerce_checkout_update_order_meta', 'save_pickup_location_field');

function save_pickup_location_field($order_id) {
    $name_store = isset($_COOKIE['name_store']) ? $_COOKIE['name_store'] : '';
    $location_store = isset($_COOKIE['location_store']) ? $_COOKIE['location_store'] : '';
    $detailsPickup = $name_store . ' - ' . $location_store;
    update_post_meta($order_id, '_pickup_location', $detailsPickup);
}

//Display input pickup on Order Details (Admin)
add_action('woocommerce_admin_order_data_after_billing_address', 'display_pickup_location_in_admin_order', 10, 1);

function display_pickup_location_in_admin_order($order) {
    $pickup_location = get_post_meta($order->get_id(), '_pickup_location', true);
    if ($pickup_location) {
        echo '<p><strong>' . __('Pickup Location') . ':</strong> ' . $pickup_location . '</p>';
    }
}

add_filter('woocommerce_checkout_fields', 'custom_remove_woo_checkout_fields');
function custom_remove_woo_checkout_fields($fields)
{

  unset($fields['billing']['billing_company']);
  unset($fields['billing']['billing_address_2']);
  unset($fields['billing']['billing_address_1']);
  unset($fields['billing']['billing_city']);
  unset($fields['billing']['billing_postcode']);
  unset($fields['billing']['billing_country']);
  unset($fields['billing']['billing_state']);

  unset($fields['shipping']['shipping_last_name']);
  unset($fields['shipping']['shipping_company']);
  unset($fields['shipping']['shipping_address_1']);
  unset($fields['shipping']['shipping_address_2']);
  unset($fields['shipping']['shipping_city']);
  unset($fields['shipping']['shipping_postcode']);
  unset($fields['shipping']['shipping_country']);
  unset($fields['shipping']['shipping_state']);


  return $fields;
}
<?php
add_action('woocommerce_checkout_order_review', 'display_store_pickup');
function display_store_pickup() {
    $store_id = WC()->session->get('selected_store_id');
    $store = select_store($store_id);
    ?>
    <div class="pickup_location_field">
        <h4>Store Pick Up</h4>
        <p>Store: <?php echo esc_html($store->name_store); ?> </p>
        <p>Address:  <?php echo esc_html($store->location_store); ?> </p>
    </div>
    <?php
}

// Save input pickup field in Checkout Page
add_action('woocommerce_checkout_update_order_meta', 'save_pickup_location_field');
function save_pickup_location_field($order_id) {
    $store_id = WC()->session->get('selected_store_id');
    if ($store_id) {
        update_post_meta($order_id, '_pickup_store_id', sanitize_text_field($store_id));
    }
}

// Display input pickup on Order Details (Admin)
add_action('woocommerce_admin_order_data_after_billing_address', 'display_pickup_location_in_admin_order', 10, 1);
function display_pickup_location_in_admin_order($order) {
    $store_id = get_post_meta($order->get_id(), '_pickup_store_id', true);
    if ($store_id) {
        $store = select_store($store_id);
        if ($store) {
            echo '<p><strong>' . __('Pickup Location') . ':</strong></p>';
            echo '<p>Store: ' . esc_html($store->name_store) . '</p>';
            echo '<p>Address: ' . esc_html($store->location_store) . '</p>';
        } else {
            echo '<p><strong>' . __('Pickup Location') . ':</strong> ' . __('Store information not found.') . '</p>';
        }
    } else {
        echo '<p><strong>' . __('Pickup Location') . ':</strong> ' . __('No store selected.') . '</p>';
    }
}

add_filter('woocommerce_checkout_fields', 'custom_remove_woo_checkout_fields');
function custom_remove_woo_checkout_fields($fields) {
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

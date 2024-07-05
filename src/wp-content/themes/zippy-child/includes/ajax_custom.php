<?php

add_action('wp_ajax_display_popup_pickup', 'display_popup_pickup');
add_action('wp_ajax_nopriv_display_popup_pickup', 'display_popup_pickup');


function display_popup_pickup()
{
    if (!isset($_POST['pickupstatus'])) wp_send_json_error('No products to process.');
    $status = $_POST['pickupstatus'];

    WC()->session->set('pickupstatus', $status);
    wp_send_json_success($status);
}


add_action('wp_ajax_save_store_to_session', 'save_store_to_session');
add_action('wp_ajax_nopriv_save_store_to_session', 'save_store_to_session');

function save_store_to_session()
{
    if (isset($_POST['store_id'])) {
        $store_id = sanitize_text_field($_POST['store_id']);

        WC()->session->set('selected_store_id', $store_id);

        $selected_store_id = WC()->session->get('selected_store_id');
        $store = select_store($selected_store_id);
        $start_time= $store->start_time;
        $end_time = $store->end_time;


        $html_segment = '
               <div class="pickup edit-store-info">
                  <h4 class="fs-14px fw-600 text-secondary">Pickup Store</h4>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="store-info fs-14px">
                      <span>' . esc_html($store->name_store) . '</span>
                      <span>' . esc_html($store->location_store) . '</span>
                    </div>
                    <button class="edit-store-btn "><img width="20" height="20" src="/wp-content/uploads/2024/07/pen-1.png"></button>
                    
                </div>
            </div>
        ';
        $html_select_time = '
                <select id="time-select-option" class="time-select">
                    <option value="0">Please select a timeslot</option>';

        $step = 0;
        $time_diff = get_diff_time($start_time, $end_time);

        while ($step < $time_diff) {
            $time_available = get_the_timetemp($step, $start_time);
            $html_select_time .= '
                    <option value="' . $time_available[0] . ' to ' . $time_available[1] . '">
                        ' . $time_available[0] . ' to ' . $time_available[1] . '
                    </option>';
            $step++;
        }

        $html_select_time .= '
                </select>';



        wp_send_json_success(['store_id' => $selected_store_id, 'html_segment' => $html_segment, "html_select_time" => $html_select_time]);
    }

    wp_die('Error: Store ID not provided.');
}

//Reset session on order complete
add_action('woocommerce_thankyou', 'custom_reset_sessions_on_order_complete');
function custom_reset_sessions_on_order_complete($order_id)
{
    WC()->session->set('pickupstatus', null);
    WC()->session->set('selected_store_id', null);
    WC()->session->set('_pickup_time', null);
    WC()->session->set('_pickup_date', null);
}

add_action('wp_ajax_reset_pickup_session', 'reset_pickup_session');
add_action('wp_ajax_nopriv_reset_pickup_session', 'reset_pickup_session');

function reset_pickup_session()
{
    WC()->session->set('pickupstatus', null);
    WC()->session->set('selected_store_id', null);
    WC()->session->set('_pickup_time', null);
    WC()->session->set('_pickup_date', null);
    wp_send_json_success();
}

add_action('template_redirect', 'clear_cart_action');
function clear_cart_action()
{
    if (isset($_POST['clear_cart'])) {
        WC()->cart->empty_cart();
        WC()->session->set('pickupstatus', null);
        WC()->session->set('selected_store_id', null);
        WC()->session->set('_pickup_time', null);
        WC()->session->set('_pickup_date', null);
    }
}



//short code order menu items
function order_nav_button()
{
    $checkStatus = WC()->session->get('pickupstatus');
    $store_id = WC()->session->get('selected_store_id');
    $time = WC()->session->get('_pickup_time');
    $date = WC()->session->get('_pickup_date');
    if ($time && $date && $store_id && $checkStatus == 1) {
        $nav_link = '/order';
    } else {
        $nav_link = '#order-popup-nav';
    }
    echo '<button id="nav-order"><a href="' . $nav_link . '">Order</a></button>';
}
add_shortcode('order_menu', 'order_nav_button');

function order_online_button()
{
    $checkStatus = WC()->session->get('pickupstatus');
    $store_id = WC()->session->get('selected_store_id');
    $time = WC()->session->get('_pickup_time');
    $date = WC()->session->get('_pickup_date');
    if ($time && $date && $store_id && $checkStatus == 1) {
        $nav_link = '/order';
    } else {
        $nav_link = '#order-popup-nav';
    }
    echo '<a class="button primary button-custom-1" href="' . $nav_link . '"><span>ORDER ONLINE</span></a>';
}
add_shortcode('order_button', 'order_online_button');
function enqueue_woocommerce_scripts()
{
    if (class_exists('WooCommerce')) {
        wp_enqueue_script('wc-cart-fragments');
        wp_enqueue_script('woocommerce');
        wp_enqueue_script('wc-add-to-cart');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_woocommerce_scripts');

function my_enqueue_scripts()
{

    wp_enqueue_script('mini-cart-js', get_template_directory_uri() . '/js/mini-cart.js', array('jquery'), '1.0', true);

    wp_localize_script('mini-cart-js', 'mini_cart_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'update_cart_nonce' => wp_create_nonce('woocommerce-cart'),
    ));
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');


function woocommerce_update_cart_item_quantity()
{
    if (!isset($_POST['cart_item_key'], $_POST['quantity'])) {
        return;
    }

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);

    WC()->cart->set_quantity($cart_item_key, $quantity, true);
    WC()->cart->calculate_totals();
    $cart_count = WC()->cart->get_cart_contents_count();

    wp_send_json_success(array(
        'cart_count' => $cart_count
    ));
}
add_action('wp_ajax_woocommerce_update_cart_item_quantity', 'woocommerce_update_cart_item_quantity');
add_action('wp_ajax_nopriv_woocommerce_update_cart_item_quantity', 'woocommerce_update_cart_item_quantity');

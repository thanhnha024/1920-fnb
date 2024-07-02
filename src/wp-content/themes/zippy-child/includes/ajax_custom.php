<?php

// Ensure session is started
add_action('init', 'start_session', 1);
function start_session()
{
    if (!isset(WC()->session)) {
        if (!is_admin() && !WC()->session->has_session()) {
            WC()->session->set_customer_session_cookie(true);
        }
    }
}

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

        wp_die();
    }

    wp_die('Error: Store ID not provided.');
}

//Reset session on order complete
add_action('woocommerce_thankyou', 'custom_reset_sessions_on_order_complete');
function custom_reset_sessions_on_order_complete($order_id)
{
    WC()->session->set('pickupstatus', null);
    WC()->session->set('selected_store_id', null);
}

add_action('wp_ajax_woocommerce_remove_cart_item', 'check_empty_cart_and_reset_session');
add_action('wp_ajax_nopriv_woocommerce_remove_cart_item', 'check_empty_cart_and_reset_session');

function check_empty_cart_and_reset_session() {
    if (WC()->cart->is_empty()) {
        WC()->session->set('pickupstatus', null);
        WC()->session->set('selected_store_id', null);
    }
}

add_action('template_redirect', 'clear_cart_action');
function clear_cart_action() {
    if (isset($_POST['clear_cart'])) {
        WC()->cart->empty_cart();
        WC()->session->set('pickupstatus', null);
        WC()->session->set('selected_store_id', null);
    }
}



//short code order menu items
function order_nav_button()
{
    $checkStatus = WC()->session->get('pickupstatus');
    if ($checkStatus == 1) {
        $nav_link = '/order';
    } else {
        $nav_link = '#order-popup-nav';
    }
    echo '<button id="nav-order"><a href="' . $nav_link . '">Order</a></button>';
}
add_shortcode('order_menu', 'order_nav_button');


function enqueue_woocommerce_scripts() {
    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_script( 'wc-cart-fragments' );
        wp_enqueue_script( 'woocommerce' );
        wp_enqueue_script( 'wc-add-to-cart' ); // Ensure add-to-cart script is loaded
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_woocommerce_scripts' );

function my_enqueue_scripts() {
    // Enqueue the custom mini-cart script
    wp_enqueue_script( 'mini-cart-js', get_template_directory_uri() . '/js/mini-cart.js', array( 'jquery' ), '1.0', true );

    // Pass AJAX URL and nonce to the script
    wp_localize_script( 'mini-cart-js', 'mini_cart_params', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'update_cart_nonce' => wp_create_nonce( 'woocommerce-cart' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts' );


function woocommerce_update_cart_item_quantity() {
    if ( ! isset( $_POST['cart_item_key'], $_POST['quantity'] ) ) {
        return;
    }

    $cart_item_key = sanitize_text_field( $_POST['cart_item_key'] );
    $quantity = intval( $_POST['quantity'] );

    WC()->cart->set_quantity( $cart_item_key, $quantity, true );
    WC()->cart->calculate_totals();
    $cart_count = WC()->cart->get_cart_contents_count();

    wp_send_json_success(array(
        'cart_count' => $cart_count
    ));

}
add_action( 'wp_ajax_woocommerce_update_cart_item_quantity', 'woocommerce_update_cart_item_quantity' );
add_action( 'wp_ajax_nopriv_woocommerce_update_cart_item_quantity', 'woocommerce_update_cart_item_quantity' );
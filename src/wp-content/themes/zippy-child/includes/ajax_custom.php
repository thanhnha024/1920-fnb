<?php

// Ensure session is started
add_action('init', 'start_session', 1);
function start_session()
{
    if (isset(WC()->session)) {
        if (!is_admin() && !WC()->session->has_session()) {
            WC()->session->set_customer_session_cookie(true);
        }
    }
}

add_action('wp_ajax_display_popup_pickup', 'display_popup_pickup');
add_action('wp_ajax_nopriv_display_popup_pickup', 'display_popup_pickup');

add_action('wp_ajax_get_store_pickup', 'get_store_pickup');
add_action('wp_ajax_nopriv_get_store_pickup', 'get_store_pickup');

function display_popup_pickup()
{
    if (!isset($_POST['pickupstatus'])) wp_send_json_error('No products to process.');
    $status = $_POST['pickupstatus'];

    WC()->session->set('pickupstatus', $status);
    wp_send_json_success($status);
    

}

function get_store_pickup(){
    if (!isset($_POST['storepickup'])) wp_send_json_error('No products to process.');
    
    $check_store_id = $_POST['storepickup'];
    
    

    if ($store) {
        $global_name_store = $store->name_store;
        $global_location_store = $store->location_store;
        
    }
    wp_send_json_success($check_store_id);
}

//short code order menu items
function order_nav_button(){
    $checkStatus = WC()->session->get('pickupstatus');
    if($checkStatus == 1){
        $nav_link = '/order';
    }else{
        $nav_link = '#order-popup-nav';
    }
    echo '<button id="nav-order"><a href="' . $nav_link .'">Order</a></button>';
}
add_shortcode('order_menu','order_nav_button');
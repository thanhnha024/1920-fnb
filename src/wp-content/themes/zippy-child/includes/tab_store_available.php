<?php

//Register tab store available in admin dashboard
add_action('admin_menu', 'tab_store_available');
function tab_store_available()
{
    add_menu_page(
        'Store Available',
        'Store Available',
        'manage_options',
        'store-available',
        'process_store_available',
        'dashicons-store',
        6
    );
}

function process_store_available()
{
    echo "<h1>Store Available Details</h1>";
    global $wpdb;

    if (isset($_POST['submit'])) {
        $stores = $_POST['stores'];

        foreach ($stores as $store) {
            $id = intval($store['id']);
            $name_store = sanitize_text_field($store['name_store']);
            $location_store = sanitize_text_field($store['location_store']);
            $link_store = esc_url($store['link_store']);
            $start_time = sanitize_text_field($store['start_time']); 
            $end_time = sanitize_text_field($store['end_time']); 

            if ($id > 0) {
                $data_to_update = array(
                    'name_store' => $name_store,
                    'location_store' => $location_store,
                    'link_store' => $link_store,
                    'start_time' => $start_time,
                    'end_time' => $end_time, 
                );

                $where = array('id' => $id);

                $wpdb->update('fcs_data_store_available', $data_to_update, $where);
            } else {
                $max_id = $wpdb->get_var("SELECT MAX(id) FROM fcs_data_store_available");
                $next_id = intval($max_id) + 1;

                $data_to_insert = array(
                    'id' => $next_id,
                    'name_store' => $name_store,
                    'location_store' => $location_store,
                    'link_store' => $link_store,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                );

                $wpdb->insert('fcs_data_store_available', $data_to_insert);
            }
        }

        echo 'Save Success';
    }

    if (isset($_POST['add_store'])) {
        $new_name_store = sanitize_text_field($_POST['new_name_store']);
        $new_location_store = sanitize_text_field($_POST['new_location_store']);
        $new_link_store = esc_url($_POST['new_link_store']);
        $new_start_time = sanitize_text_field($_POST['new_start_time']);
        $new_end_time = sanitize_text_field($_POST['new_end_time']);

        $max_id = $wpdb->get_var("SELECT MAX(id) FROM fcs_data_store_available");
        $next_id = intval($max_id) + 1;

        $data_to_insert = array(
            'id' => $next_id,
            'name_store' => $new_name_store,
            'location_store' => $new_location_store,
            'link_store' => $new_link_store,
            'start_time' => $new_start_time, 
            'end_time' => $new_end_time, 
        );

        $wpdb->insert('fcs_data_store_available', $data_to_insert);
        echo 'Add store success';
    }

    if (isset($_POST['delete_store'])) {
        $delete_id = intval($_POST['delete_id']);

        $where = array('id' => $delete_id);

        $wpdb->delete('fcs_data_store_available', $where);

        echo 'Delete Success';
    }

    $results = $wpdb->get_results("SELECT * FROM fcs_data_store_available ORDER BY id DESC");
?>

    <!-- Displays a list of existing stores -->
    <form method="post">
        <?php if ($results) : ?>
            <h2>List of existing stores</h2>
            <?php foreach ($results as $store) : ?>
                <div class="form-infor-store">
                    <input type="hidden" name="stores[<?php echo esc_attr($store->id); ?>][id]" value="<?php echo esc_attr($store->id); ?>">
                    <label for="name_store_<?php echo esc_attr($store->id); ?>">Name Store:</label>
                    <input type="text" id="name_store_<?php echo esc_attr($store->id); ?>" name="stores[<?php echo esc_attr($store->id); ?>][name_store]" value="<?php echo esc_attr($store->name_store); ?>" required>

                    <label for="location_store_<?php echo esc_attr($store->id); ?>">Address:</label>
                    <input type="text" id="location_store_<?php echo esc_attr($store->id); ?>" name="stores[<?php echo esc_attr($store->id); ?>][location_store]" value="<?php echo esc_attr($store->location_store); ?>" required>

                    <label for="link_store_<?php echo esc_attr($store->id); ?>">Link Map:</label>
                    <input type="url" id="link_store_<?php echo esc_attr($store->id); ?>" name="stores[<?php echo esc_attr($store->id); ?>][link_store]" value="<?php echo esc_attr($store->link_store); ?>" required>

                    <!-- New Fields -->
                    <label for="start_time_<?php echo esc_attr($store->id); ?>">Start Time:</label>
                    <input type="time" id="start_time_<?php echo esc_attr($store->id); ?>" name="stores[<?php echo esc_attr($store->id); ?>][start_time]" value="<?php echo esc_attr($store->start_time); ?>" required>

                    <label for="end_time_<?php echo esc_attr($store->id); ?>">End Time:</label>
                    <input type="time" id="end_time_<?php echo esc_attr($store->id); ?>" name="stores[<?php echo esc_attr($store->id); ?>][end_time]" value="<?php echo esc_attr($store->end_time); ?>" required>

                    <!-- Delete Button -->
                    <input type="hidden" name="delete_id" value="<?php echo esc_attr($store->id); ?>">
                    <input type="submit" name="delete_store" value="Delete Store">
                </div>
                <br>
            <?php endforeach; ?>
            <input type="submit" name="submit" value="Update All">
        <?php else : ?>
            <p>There are no existing stores</p>
        <?php endif; ?>
    </form>

    <!-- Add new store -->
    <form method="post">
        <h2>Add New Store</h2>
        <div>
            <label for="new_name_store">Name Store:</label>
            <input type="text" id="new_name_store" name="new_name_store" required>

            <label for="new_location_store">Address:</label>
            <input type="text" id="new_location_store" name="new_location_store" required>

            <label for="new_link_store">Link Map:</label>
            <input type="url" id="new_link_store" name="new_link_store" required>

            <!-- New Fields -->
            <label for="new_start_time">Start Time:</label>
            <input type="time" id="new_start_time" name="new_start_time" required>

            <label for="new_end_time">End Time:</label>
            <input type="time" id="new_end_time" name="new_end_time" required>
        </div>
        <br>
        <input type="submit" name="add_store" value="Add New Store">
    </form>
<?php
}



// shortcode pickup
function pickup_information_shortcode()
{
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM fcs_data_store_available ORDER BY id DESC");
    $store_count = count($results);
    ob_start();

?>
    <div class="infor-pickup">
        <div class="infor-pickup-title d-flex align-items-center justify-content-between">
            <button class="btn-back-pickup-order"><img width="20" height="20" src="/wp-content/uploads/2024/07/back.png"></button>
            <a id="back-pickup-order" class="d-none" href="#order-popup-nav"></a>
            <p>Pickup</p>
            <button title="Close (Esc)" type="button" class="mfp-close btn-close close-custom w-auto"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg></button>
        </div>
        <div class="infor-pickup-content">
            <h3>Select a Pickup Store</h3>
            <div class="row-infor-pickup">
                <?php if (!$results) { ?>
                    <p>No stores available.</p>
                <?php } else { ?>
                    <p><?php echo esc_html($store_count) ?> Store Available</p>
                <?php } ?>
                <p><a href="#" id="viewmap" target="_blank">View on Map</a></p>
            </div>
            <div class="col-infor-store">
                <?php foreach ($results as $store) { ?>
                    <div class="items-infor-pickup-content" data-store-id="<?php echo esc_attr($store->id) ?>">
                        <div class="row-items-infor">
                            <svg width="18px" height="18px" viewBox="0 0 24 24" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path fill="#5f3327" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path>
                            </svg>
                            <p class="namestore"><?php echo esc_html($store->name_store) ?></p>
                            <p class="linkmap"><?php echo esc_url($store->link_store) ?></p>
                        </div>
                        <div class="row-items-infor">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 17 15" width="18px" height="18px">
                                <path fill="#5f3327" d="M15.3 0H0.9V1.8H15.3V0ZM16.2 9V7.2L15.3 2.7H0.9L0 7.2V9H0.9V14.4H9.9V9H13.5V14.4H15.3V9H16.2ZM8.1 12.6H2.7V9H8.1V12.6Z"></path>
                            </svg>
                            <p class="locationstore"><? echo esc_html($store->location_store) ?></p>
                        </div>
                        <p class="idstore"><? echo esc_html($store->id) ?></p>
                        <?php
                        $storeCurrentDateTime = new DateTime();
                        $storeCurrentDateTime->modify('+1 day');
                        $storeCurrentDateTime = $storeCurrentDateTime->format('j M Y');
                        ?>
                        <div class="time-infor-items">
                            <h4>Earliest Collection Time</h4>
                            <p>Tomorrow, <? echo esc_html($storeCurrentDateTime) ?> (11:30 AM - 12:30 PM)</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="action-pickup">
            <div id="notification" style="display:none; color:red; text-align:center;padding:5px;"></div>
            <button class="button-selected-store">Continue with Selection</button>
            <a class="d-none" id="calendar-pickup" href="#calendar-pickup"></a>
        </div>
    </div>
<?php

    return ob_get_clean();
}
add_shortcode('pickup_information', 'pickup_information_shortcode');

function custom_pickup_calendar_shortcode()
{

    ob_start();
?>

    <div class="infor-pickup">
        <div class="infor-pickup-title d-flex align-items-center justify-content-between">
            <button class="btn-back-pickup-store"><img width="20" height="20" src="/wp-content/uploads/2024/07/back.png"></button>
            <a id="back-store" class="d-none" href="#confirmorder"></a>
            <p>Pickup</p>
            <button title="Close (Esc)" type="button" class="mfp-close  btn-close close-custom w-auto"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg></button>
        </div>
        <div class="infor-pickup-content">
            <div id="pickup-info-container"></div>
            <a id="edit-store" class="d-none" href="#confirmorder"></a>
            <?php echo do_shortcode('[pickup_date_calander]'); ?>
            <?php echo do_shortcode('[pickup_time_calander]'); ?>
            <div id="pickup-date_time" class="action-pickup">
                <button>Next</button>
            </div>
        </div>
    <?php
    return ob_get_clean();
}
add_shortcode('calendar_pickup', 'custom_pickup_calendar_shortcode');

<?php

add_action('wp_enqueue_scripts', 'shin_scripts');
function shin_scripts()
{
  $version = time();
  wp_enqueue_style('main-style-css', THEME_URL .  '/assets/css/vanilla-calendar.min.css', array(), $version, 'all');

  // Load JS
  wp_enqueue_script('main-scripts-js', THEME_URL . '/assets/js/vanilla-calendar.min.js', array('jquery'), $version, true);
}

function slugify($string)
{
  // Convert the string to lowercase
  $string = strtolower($string);

  // Replace spaces and special characters with dashes
  $string = preg_replace('/[^a-z0-9]+/', '_', $string);

  // Remove leading and trailing dashes
  $string = trim($string, '_');

  return $string;
}

function pr($data)
{
  echo '<style>
  #debug_wrapper {
    position: fixed;
    top: 0px;
    left: 0px;
    z-index: 999;
    background: #fff;
    color: #000;
    overflow: auto;
    width: 100%;
    height: 100%;
  }</style>';
  echo '<div id="debug_wrapper"><pre>';

  print_r($data); // or var_dump($data);
  echo "</pre></div>";
  die;
}


function get_item_cart()
{
  global $woocommerce;
  $service_total_price = 0;
  foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
      $product_id = $_product->get_ID();
      if (!$_product->is_type('variation')) return;

      $_product_variation = new WC_Product_Variation($product_id);
      $variation_data = $_product_variation->get_variation_attributes();
      foreach ($variation_data as $key => $data) {
        $variation_number = $data;
        break;
      }
      $string = $variation_number;
      $parts = explode('-', $string);
      $number = $parts[0];
      return $number;
    }
  }
}
add_filter('woocommerce_add_to_cart_validation', 'only_one_in_cart', 9999);

function only_one_in_cart($passed)
{
  wc_empty_cart();
  return $passed;
}

add_action('foodbook_delivery_types', 'shin_action');

function  shin_action()
{ ?>
  <p
    class="form-row form-row-last validate-required"
    id="billing_last_delivery_field"
    data-priority="">
    <label for="billing_last_delivery" class="">Last Delivery&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper">
      <input
        disabled
        type="text"
        class="input-text"
        name="billing_last_delivery"
        id="billing_last_delivery"
        placeholder="" />
    </span>
  </p>
  <p
    class="form-row form-row-first validate-required"
    id="billing_first_delivery_field"
    data-priority="">
    <!-- <div id="calendar"></div> -->
    <label for="billing_first_delivery" class="">First Delivery&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper">

      <input
        type="date"
        class="input-text"
        name="billing_first_delivery"
        id="billing_first_delivery"
        placeholder="" />
    </span>
  </p>
  <?php
}
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process()
{
  if (! $_POST['billing_first_delivery'] || ! $_POST['billing_last_delivery'])
    wc_add_notice(__('Please enter first delivery date.'), 'error');
}


add_action('woocommerce_checkout_update_order_meta', 'shin_checkout_field_update_order_meta');

function shin_checkout_field_update_order_meta($order_id)
{
  if (! empty($_POST['billing_first_delivery'])) {
    update_post_meta($order_id, '_billing_first_delivery', sanitize_text_field($_POST['billing_first_delivery']));
  }
  if (! empty($_POST['billing_last_delivery'])) {
    update_post_meta($order_id, '_billing_last_delivery', sanitize_text_field($_POST['billing_last_delivery']));
  }
}

add_action('woocommerce_admin_order_data_after_billing_address', 'shin_show_new_checkout_field_order', 10, 1);

function shin_show_new_checkout_field_order($order)
{
  $order_id = $order->get_id();
  if (get_post_meta($order_id, '_billing_first_delivery', true)) echo '<p><strong>First Delivery:</strong> ' . get_post_meta($order_id, '_billing_first_delivery', true) . '</p>';
  if (get_post_meta($order_id, '_billing_last_delivery', true)) echo '<p><strong>Last Delivery:</strong> ' . get_post_meta($order_id, '_billing_last_delivery', true) . '</p>';
}



add_action('wp_footer', 'enqueue_custom_checkout_script');

function enqueue_custom_checkout_script()
{

  if (is_checkout()) : ?>
    <?php

    $date_last = get_item_cart();
    ?>

    <style>
      @media (max-width: 592px) {

        .form-row-first,
        .form-row-last {
          display: block !important;
          width: 100% !important;
          margin-bottom: 20px !important;
        }
      }

      @media (min-width: 550px) {

        p.form-row-last {
          width: 48%;
          float: left;
        }

        .form-row-last {
          float: right;
        }
      }
    </style>

    <script type="text/javascript">
      jQuery(document).ready(function($) {
        function formatDate(date) {
          const year = date.getFullYear();
          const month = String(date.getMonth() + 1).padStart(2, '0');
          const day = String(date.getDate()).padStart(2, '0');
          return `${month}-${date}-${year}`;
        }

        function addDaysToDate(dateStr, daysToAdd) {
          // Parse the date string in the format YYYY-MM-DD
          const [year, month, day] = dateStr.split('-').map(Number);
          const date = new Date(year, month - 1, day); // Month is 0-indexed

          // Add the specified number of days
          date.setDate(date.getDate() + parseInt(daysToAdd));

          // Format the new date as YYYY-MM-DD
          const newYear = date.getFullYear();
          const newMonth = String(date.getMonth() + 1).padStart(2, '0');
          const newDay = String(date.getDate()).padStart(2, '0');

          return `${newMonth}-${newDay}-${newYear}`;
        }

        handleFirstDeliveryChange();

        function handleFirstDeliveryChange() {

          const currentDate = new Date();
          var first_delivery = formatDate(currentDate);
          $("input[name='billing_first_delivery']").val(first_delivery);
          $("input[name='billing_first_delivery']").on('change', function() {
            // this.setAttribute(
            //   "data-date",
            //   moment(this.value, "YYYY-MM-DD")
            //   .format(this.getAttribute("data-date-format"))
            // )
            // console.log(this.value);
            var extra_date = <?php echo $date_last; ?>;
            var firstDate = $(this).val();
            const last_delivery = addDaysToDate(firstDate, extra_date);
            $("input[name='billing_last_delivery']").val(last_delivery);

          })
        }
      });
    </script>
  <?php endif; ?>

<?php
}

function shin_currency_symbol($currency_symbol, $currency)
{

  switch ($currency) {

    case 'AED':
      $currency_symbol = ' AED ';
      break;
  }

  return $currency_symbol;
}

add_filter('woocommerce_currency_symbol', 'shin_currency_symbol', 10, 2);

<?php

add_action('wp_ajax_add_session_date', 'add_session_date');
add_action('wp_ajax_nopriv_add_session_date', 'add_session_date');

add_action('woocommerce_init', 'wc_start_session');
function wc_start_session()
{
  if (isset(WC()->session)) {
    if (!is_admin() && !WC()->session->has_session()) {
      WC()->session->set_customer_session_cookie(true);
    }
  }
}
function add_session_date()
{
  if (!isset($_POST['selected_date']) || empty($_POST['selected_date'])) wp_send_json_error('Back with me later');
  if (!isset($_POST['selected_time']) || empty($_POST['selected_time'])) wp_send_json_error('Back with me later');

  $pickup_date = $_POST['selected_date'];
  $pickup_time = $_POST['selected_time'];

  if (isset(WC()->session)) {
    WC()->session->set('_pickup_date', $pickup_date);
    WC()->session->set('_pickup_time', $pickup_time);
  }

  $selected_date =  WC()->session->get('_pickup_date');

  wp_send_json_success($selected_date);
}


add_action('wp_ajax_render_date', 'render_date');
add_action('wp_ajax_nopriv_render_date', 'render_date');
function render_date()
{
  if (!isset($_POST['selected_date_render']) || empty($_POST['selected_date_render'])) wp_send_json_error('Back with me later');
  $selected_date_render = $_POST['selected_date_render'];

?>

  <?php
  $date_time_selected = new DateTime($selected_date_render);
  $date_time_selected = $date_time_selected->format('Y-m-d');
  $date  = isset($date_time_selected) ? $date_time_selected : 0;

  $i = 0; ?>

  <?php while ($i < 5) : ?>
    <?php $date_time = get_the_next_day($i, $date); ?>

    <button class="date-box" data-date-short="<?php echo ($date_time['short_date']); ?>" data-date="<?php echo ($date_time['fomated_date']); ?>">
      <span class="day"><?php echo ($date_time['day']); ?></span>
      <div class="wrapper-date">
        <span class="date"><?php echo ($date_time['date']); ?></span>
        <span class="month"><?php echo ($date_time['month']); ?></span>
      </div>
    </button>
    <?php $i++; ?>

  <?php endwhile; ?>

<?php
  wp_die();
}

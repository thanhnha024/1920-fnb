<?php

/**
 * Cart element.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

if (is_woocommerce_activated() && flatsome_is_wc_cart_available()) {
  // Get Cart replacement for catalog_mode
  if (get_theme_mod('catalog_mode')) {
    get_template_part('template-parts/header/partials/element', 'cart-replace');
    return;
  }
  $cart_style = get_theme_mod('header_cart_style', 'dropdown');
  $custom_cart_content = get_theme_mod('html_cart_header');
  $icon_style = get_theme_mod('cart_icon_style');
  $icon = get_theme_mod('cart_icon', 'basket');
  $cart_title = get_theme_mod('header_cart_title', 1);
  $cart_total = get_theme_mod('header_cart_total', 1);
  $disable_mini_cart = apply_filters('flatsome_disable_mini_cart', is_cart() || is_checkout());
  if ($disable_mini_cart) {
    $cart_style = 'link';
  }
?>
  <li class="cart-item has-icon<?php if ($cart_style == 'dropdown') { ?> has-dropdown<?php } ?>">
    <?php if ($icon_style && $icon_style !== 'plain') { ?><div class="header-button"><?php } ?>

      <?php if ($cart_style !== 'off-canvas') { ?>
        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('Cart', 'woocommerce'); ?>" class="header-cart-link <?php echo get_flatsome_icon_class($icon_style, 'small'); ?>">

        <?php } else if ($cart_style == 'off-canvas') { ?>
          <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="header-cart-link off-canvas-toggle nav-top-link <?php echo get_flatsome_icon_class($icon_style, 'small'); ?>" data-open="#cart-popup" data-class="off-canvas-cart" title="<?php _e('Cart', 'woocommerce'); ?>" data-pos="right">
          <?php } ?>

          <?php if ($cart_total || $cart_title) { ?>
            <span class="header-cart-title">
              <?php if ($cart_title) { ?> <?php _e('Cart', 'woocommerce'); ?> <?php } ?>
              <?php /* divider */ if ($cart_total && $cart_title) { ?>/<?php } ?>
              <?php if ($cart_total) { ?>
                <span class="cart-price"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
              <?php } ?>
            </span>
          <?php } ?>

          <?php
          if (get_theme_mod('custom_cart_icon')) { ?>
            <span class="image-icon header-cart-icon" data-icon-label="<?php echo WC()->cart->cart_contents_count; ?>">
              <img class="cart-img-icon" alt="<?php _e('Cart', 'woocommerce'); ?>" src="<?php echo do_shortcode(get_theme_mod('custom_cart_icon')); ?>" />
            </span>
          <?php } else { ?>
            <?php if (!$icon_style) { ?>
              <span class="cart-icon image-icon">
                <strong><?php echo WC()->cart->cart_contents_count; ?></strong>
              </span>
            <?php } else { ?>
              <i class="icon-shopping-<?php echo $icon; ?>" data-icon-label="<?php echo WC()->cart->cart_contents_count; ?>">
              </i>
            <?php } ?>
          <?php }  ?>
          </a>
          <?php if ($icon_style && $icon_style !== 'plain') { ?>
      </div><?php } ?>

    <?php if ($cart_style == 'dropdown') { ?>
      <ul class="nav-dropdown <?php flatsome_dropdown_classes(); ?>">
        <li class="html widget_shopping_cart">
          <div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
          </div>
        </li>
        <?php if ($custom_cart_content) {
          echo '<li class="html">' . do_shortcode($custom_cart_content) . '</li>';
        }
        ?>
      </ul>
    <?php }  ?>

    <?php if ($cart_style == 'off-canvas') { ?>

      <!-- Cart Sidebar Popup -->
      <div id="cart-popup" class="mfp-hide widget_shopping_cart">
        <div class="cart-popup-inner ">
          <div class="cart-popup-title text-center">
            <h4 class="fs-16px fw-600 text-secondary mb-0"><?php _e('Your Cart', 'woocommerce'); ?></h4>
            <span id="cart-items-count" class="fs-14px text-secondary"> <?php echo sprintf(__('You have added %d items', 'woocommerce'), WC()->cart->get_cart_contents_count()); ?></span>
          </div>
          <div class="edit-info-store-and-date-time d-flex align-items-center">
            <?php
            $store_id = WC()->session->get('selected_store_id');
            $store = select_store($store_id);
            $time = WC()->session->get('_pickup_time');
            $date = WC()->session->get('_pickup_date');
            ?>
            <div class="content-edit-info">
              <?php if ($store) { ?>
                <div class="store">
                  <h4 class="fs-14px fw-600 text-secondary">Pickup Store</h4>
                  <div class="store-info fs-14px">
                    <p class="mb-0"><?php echo esc_html($store->name_store); ?></p>
                    <p class="mb-0"><?php echo esc_html($store->location_store); ?></p>
                  </div>
                </div>
              <?php } ?>
              <?php if ($time && $date) { ?>
                <div class="date-time">
                  <h4 class="fs-14px fw-600 text-secondary">Pickup Time</h4>
                  <div class="date-info fs-14px">
                    <p class="mb-0"><?php echo esc_html($date); ?></p>
                    <p class="mb-0"><?php echo esc_html($time); ?></p>
                  </div>
                </div>
              <?php } ?>
            </div>
            <div class="btn-edit-info-mini-cart">
              <a href="#confirmorder"><svg width="21px" height="21px" viewBox="0 0 34 34"><title>Edit</title><g transform="translate(-3 -3)" fill="none" fill-rule="evenodd"><rect width="39" height="39" rx="5"></rect><path d="M33 12.289l-2.115 2.115-5.29-5.296 2.115-2.116a1.168 1.168 0 0 1 1.614 0L33 10.675c.444.444.444 1.17 0 1.614zM15.322 29.988l-5.29-5.297 13.676-13.696 5.29 5.297-13.676 13.696zM8.81 27.245l3.958 3.964-5.512 1.554 1.554-5.518zM34.888 8.788l-3.677-3.684c-.718-.718-3.311-2.077-5.381 0L7.197 23.75c-.163.164-.281.36-.34.582L4.05 34.33c-.13.463.006.96.34 1.306.339.346 1.018.405 1.306.34l9.992-2.815c.222-.059.418-.177.581-.34l18.62-18.646a3.82 3.82 0 0 0 0-5.388z" fill="#5f3327" stroke="#5f3327" stroke-width="0.5"></path></g></svg></a>
            </div>
          </div>

          <div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
          </div>
          <div class="mini-cart-buttons">
            <?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>
            <p class="woocommerce-mini-cart__buttons buttons"><?php do_action('woocommerce_widget_shopping_cart_buttons'); ?></p>
            <a id="select-dinning-preferences" class="d-none" href="#order-popup-nav"></a>
            <?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>
          </div>
          <?php if ($custom_cart_content) {
            echo '<div class="header-cart-content">' . do_shortcode($custom_cart_content) . '</div>';
          }
          ?>
          <?php do_action('flatsome_cart_sidebar'); ?>
        </div>
      </div>

    <?php } ?>
  </li>
<?php } else {
  fl_header_element_error('woocommerce');
}
?>
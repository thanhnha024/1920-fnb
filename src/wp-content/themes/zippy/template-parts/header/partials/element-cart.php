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
          <div class="edit-store-info">
            <?php
            $store_id = WC()->session->get('selected_store_id');
            $store = select_store($store_id);
            ?>
            <?php if ($store) { ?>
              <h4 class="fs-14px fw-600 text-secondary">Pickup Store</h4>
              <div class="d-flex align-items-center justify-content-between">
                <div class="store-info fs-14px">
                  <p class="mb-0"><?php echo esc_html($store->name_store); ?></p>
                  <p class="mb-0"><?php echo esc_html($store->location_store); ?></p>
                </div>
                <a href="#confirmorder"><img width="20" height="20" src="/wp-content/uploads/2024/07/pen-1.png"></a>
              </div>
            <?php } ?>
          </div>
          <?php
          $time = WC()->session->get('_pickup_time');
          $date = WC()->session->get('_pickup_date');
          ?>
          <?php if ($time && $date) { ?>
            <div class="edit-date-time">
              <h4 class="fs-14px fw-600 text-secondary">Pickup Time</h4>
              <div class="d-flex align-items-center justify-content-between">
                <div class="date-info fs-14px">
                  <p class="mb-0"><?php echo esc_html($date); ?></p>
                  <p class="mb-0"><?php echo esc_html($time); ?></p>
                </div>
                <a href="#calendar-pickup"><img width="20" height="20" src="/wp-content/uploads/2024/07/pen-1.png"></a>
              </div>
            </div>
          <?php } ?>
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
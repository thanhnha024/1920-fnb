<?php

/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>

<?php if (!WC()->cart->is_empty()) : ?>

	<div class="section-clear-all">
		<span class="text-secondary fs-14px fw-600">Item(s) Added</span>
		<form action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
			<button type="submit" name="clear_cart" class="button btn-clear-all" value="1"><span><?php _e('Clear Items', 'your-text-domain'); ?></span></button>
		</form>

	</div>


	<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
		<?php
		do_action('woocommerce_before_mini_cart_contents');

		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
			$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

			if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
				/**
				 * This filter is documented in woocommerce/templates/cart/cart.php.
				 *
				 * @since 2.1.0
				 */
				$product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
				$thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
				$product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
				$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
		?>
				<li class="woocommerce-mini-cart-item <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
					<?php
					echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'woocommerce_cart_item_remove_link',
						sprintf(
							'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><img class="icon-trash" width="16" height="16" src="/wp-content/uploads/2024/07/bin.png"></a>',
							esc_url(wc_get_cart_remove_url($cart_item_key)),
							/* translators: %s is the product name */
							esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
							esc_attr($product_id),
							esc_attr($cart_item_key),
							esc_attr($_product->get_sku())
						),
						$cart_item_key
					);
					?>
					<div class="product-thumbnail">
						<?php echo wp_kses_post($thumbnail); ?>
					</div>
					<div class="product-info">
						<div class="product-details">
							<?php if (empty($product_permalink)) : ?>
								<?php echo wp_kses_post($product_name); ?>
							<?php else : ?>
								<a href="<?php echo esc_url($product_permalink); ?>">
									<?php echo wp_kses_post($product_name); ?>
								</a>
							<?php endif; ?>
							<?php echo wp_kses_post(wc_get_formatted_cart_item_data($cart_item)); ?>
						</div>
						<div class="d-flex align-items-center w-100 justify-content-between mt-30px">
							<div class="quantity mini-cart buttons_added">
								<input type="button" value="-" class="minus button is-form">
								<label class="screen-reader-text" for="quantity_<?php echo esc_attr($cart_item_key); ?>"><?php echo esc_html($product_name); ?> Quantity</label>
								<input type="number" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>" id="quantity_<?php echo esc_attr($cart_item_key); ?>" class="input-text qty text" name="quantity" value="<?php echo esc_attr($cart_item['quantity']); ?>" title="<?php esc_attr_e('Qty', 'woocommerce'); ?>" size="4" min="1" step="1" inputmode="numeric" autocomplete="off">
								<input type="button" value="+" class="plus button is-form">
							</div>

							<div class="product-price">
								<span class="text-secondary fs-16px"><?php echo wp_kses_post($product_price); ?></span>
							</div>
						</div>
					</div>
				</li>
		<?php
			}
		}

		do_action('woocommerce_mini_cart_contents');
		?>
	</ul>

	<p class="woocommerce-mini-cart__total total">
		<?php
		/**
		 * Hook: woocommerce_widget_shopping_cart_total.
		 *
		 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
		 */
		do_action('woocommerce_widget_shopping_cart_total');
		?>
	</p>
<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e('No products in the cart.', 'woocommerce'); ?></p>

<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>
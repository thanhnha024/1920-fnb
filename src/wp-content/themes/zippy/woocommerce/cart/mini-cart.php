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
							'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><svg width="21px" height="21px" viewBox="0 0 32 34"><title>Delete</title><g transform="translate(-4 -2)" fill="none" fill-rule="evenodd"><rect width="39" height="39" rx="5"></rect><path d="M34.968 7.865a.689.689 0 0 0-.508-.199h-6.842l-1.55-3.696c-.22-.546-.618-1.01-1.193-1.394-.576-.383-1.16-.576-1.75-.576h-7.083c-.59 0-1.173.193-1.749.576-.576.383-.974.848-1.195 1.394l-1.55 3.696h-6.84a.69.69 0 0 0-.509.2.693.693 0 0 0-.199.509V9.79a.69.69 0 0 0 .199.51.691.691 0 0 0 .51.199h2.125v21.073c0 1.225.346 2.269 1.04 3.132C8.567 35.57 9.4 36 10.374 36h18.418c.974 0 1.808-.447 2.502-1.338.692-.895 1.04-1.953 1.04-3.178V10.5h2.126a.69.69 0 0 0 .508-.2.691.691 0 0 0 .199-.509V8.375a.694.694 0 0 0-.2-.51zM15.71 5.077a.627.627 0 0 1 .376-.245h7.017c.148.031.274.112.376.245l1.062 2.59h-9.916l1.085-2.59zM29.5 31.484c0 .325-.051.624-.155.897-.103.273-.21.472-.32.597-.111.126-.188.189-.233.189H10.375c-.044 0-.121-.063-.233-.189-.11-.125-.217-.324-.32-.597a2.507 2.507 0 0 1-.154-.897V10.5H29.5v20.984zm-16.292-2.567h1.417a.689.689 0 0 0 .51-.199.691.691 0 0 0 .198-.51v-12.75a.69.69 0 0 0-.199-.509.689.689 0 0 0-.51-.199h-1.416a.692.692 0 0 0-.51.2.696.696 0 0 0-.198.509v12.75c0 .207.066.375.199.51a.692.692 0 0 0 .509.198zm5.668 0h1.416a.689.689 0 0 0 .508-.199.687.687 0 0 0 .2-.51v-12.75a.686.686 0 0 0-.2-.509.689.689 0 0 0-.508-.199h-1.416a.689.689 0 0 0-.51.2.69.69 0 0 0-.199.509v12.75c0 .207.066.375.2.51a.689.689 0 0 0 .509.198zm5.665 0h1.417a.689.689 0 0 0 .51-.199.691.691 0 0 0 .199-.51v-12.75a.69.69 0 0 0-.2-.509.689.689 0 0 0-.509-.199h-1.417a.687.687 0 0 0-.508.2.687.687 0 0 0-.2.509v12.75c0 .207.066.375.2.51a.687.687 0 0 0 .508.198z" fill="#5f3327"></path></g></svg></a>',
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
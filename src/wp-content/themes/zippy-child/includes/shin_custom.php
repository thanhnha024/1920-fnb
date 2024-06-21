<?php
add_action('wp_enqueue_scripts', 'shin_scripts');
function shin_scripts()
{
    $version = '2.2.0';

    // Load CSS
    wp_enqueue_style('main-style-css', THEME_URL . '-child' . '/assets/main/main.css', array(), $version, 'all');
    // Load JS
    wp_enqueue_script('main-scripts-js', THEME_URL . '-child' . '/assets/main/main.js', array('jquery'), $version, true);
}


add_action( 'woocommerce_after_shop_loop_item', 'order_now_button', 15 );
function order_now_button() {
	global $product;
	$product_id = $product->get_id();
    echo '<div class="element-action"><a class="action-popup-btn" href="#order-popup-' . $product_id .'">Order Now</a></div>';
    echo do_shortcode('[lightbox id="order-popup-'. $product_id .'" width="800px" padding="15px" ][product_details id="' . $product_id .'"][/lightbox]');
}


function show_product_details($atts) {

    $atts = shortcode_atts(array(
        'id' => null,
    ), $atts, 'product_details');


    if (!$atts['id']) {
        return 'Product ID is required';
    }


    $product = wc_get_product($atts['id']);


    if (!$product) {
        return 'Product not found';
    }


    $title = $product->get_title();
    $price = $product->get_price_html();
    $image_id = $product->get_image_id();
    $image_url = wp_get_attachment_image_url($image_id, 'full');
    $gallery_image_ids = $product->get_gallery_image_ids();
    $description = $product->get_description();
    ob_start();
    ?>
    <div class="popup-order">
	    <div class="left-popup-order">
	      <div class="product-image">
	            <img src="<?php echo $image_url; ?>" alt="<?php echo $title; ?>" />
	        </div>
	        <div class="product-gallery">
	            <?php foreach ($gallery_image_ids as $gallery_image_id) : 
	                $gallery_image_url = wp_get_attachment_image_url($gallery_image_id, 'thumbnail'); ?>
	                <img src="<?php echo $gallery_image_url; ?>" alt="<?php echo $title; ?>" />
	            <?php endforeach; ?>
	        </div>
	    </div>
	    <div class="right-popup-order">
	      <h2><?php echo $title; ?></h2>
	      <div class="available-infor" color="#0C62CA">
	        <div class="available-infor-details">
	          <div class="left-available-infor-details">
	            <svg width="18px" height="18px" viewBox="0 0 35 35"><title>Information</title><g transform="translate(-2 -2)" fill="none" fill-rule="evenodd"><rect width="39" height="39" rx="5"></rect><path d="M19.5 34.5c-8.271 0-15-6.729-15-15s6.729-15 15-15 15 6.729 15 15-6.729 15-15 15m0-32.5C9.85 2 2 9.85 2 19.5S9.85 37 19.5 37 37 29.15 37 19.5 29.15 2 19.5 2m0 7.5a1.877 1.877 0 0 0-1.875 1.875c0 1.034.841 1.875 1.875 1.875a1.877 1.877 0 0 0 1.875-1.875A1.877 1.877 0 0 0 19.5 9.5m0 6.875c-1.035 0-1.875.84-1.875 1.875v7.5a1.876 1.876 0 0 0 3.75 0v-7.5c0-1.035-.84-1.875-1.875-1.875" fill="#0C62CA"></path></g></svg>
	          </div>
	          <div class="right-available-infor-details">
	            <p color="#0C62CA" class="">Only available on Tue - Sun</p>
	          </div>
	        </div>
	      </div>
	      <div class="product-description">
	        <p><?php echo $description; ?></p>
	      </div>
	      <p class="price-description"><?php echo $price; ?></p>
	    </div>
	    <div class="action-popup-order">
	      <form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
	            <?php do_action('woocommerce_before_add_to_cart_button'); ?>
	            <?php
	            woocommerce_quantity_input(array(
	                'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
	                'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
	                'input_value' => isset($_POST['quantity']) ? wc_stock_amount($_POST['quantity']) : $product->get_min_purchase_quantity(),
	            ));
	            ?>
	            <button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>
	            <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" />
	            <?php do_action('woocommerce_after_add_to_cart_button'); ?>
	        </form>
	    </div>
	  </div>
    <?php
    return ob_get_clean();
}


add_shortcode('product_details', 'show_product_details');

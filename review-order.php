<?php
/**
 * @version 7.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<table class="">
		<tbody>
		<tr>
			<td colspan="100%" style="
				border: none;
				padding: 0;
				margin: 0;
				">
			<table class="" style="
					border: 0;
					margin: 0;
					padding: 0;
					">
				<thead>
				<tr>
					<th class="nias-first">&nbsp;</th>
					<th class=""><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
					<th class="nias-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
					<th class=""><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
					<th class=""><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
					<th class="">&nbsp;</th>
				</tr>
				</thead>
				<tbody>
				<?php
					// do_action('woocommerce_review_order_before_cart_contents');

				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						?>
					<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						<td class="product-thumbnail">
								<?php
								$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $product_permalink ) {
									echo $thumbnail; // PHPCS: XSS ok.
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
								}
								?>
						</td>
						<td class="product-name" data-title="<?php esc_html_e( 'Product', 'woocommerce' ); ?>">
								<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
								<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
								<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
						</td>
						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
								<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
						</td>
						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
								<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {
									$product_quantity = woocommerce_quantity_input(
										array(
											'input_name'   => "cart[{$cart_item_key}][qty]",
											'input_value'  => $cart_item['quantity'],
											'max_value'    => $_product->get_max_purchase_quantity(),
											'min_value'    => '0',
											'product_name' => $_product->get_name(),
										),
										$_product,
										false
									);
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
								?>
						</td>
						<td class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
							<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
						</td>
						<td class="product-remove">
								<?php echo sprintf( '<a href="%s" class="niasremove" aria-label="%s" data-product_id="%s" data-product_sku="%s" data-cart_item_key="%s"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M20.2813 6.35538H3.83151" stroke="#0496C9" stroke-width="1.74174" stroke-linecap="round"/>
<path d="M18.6686 8.77448L18.2235 15.4503C18.0523 18.0192 17.9666 19.3037 17.1296 20.0868C16.2926 20.8699 15.0053 20.8699 12.4306 20.8699H11.6823C9.10761 20.8699 7.82027 20.8699 6.98326 20.0868C6.14626 19.3037 6.06062 18.0192 5.88936 15.4503L5.44431 8.77448" stroke="#302E2F" stroke-width="1.74174" stroke-linecap="round"/>
<path d="M9.3187 4.42009C9.7172 3.29262 10.7925 2.48483 12.0564 2.48483C13.3203 2.48483 14.3956 3.29262 14.7941 4.42009" stroke="#0496C9" stroke-width="1.74174" stroke-linecap="round"/>
</svg>
</a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'woocommerce' ), esc_attr( $_product->get_id() ), esc_attr( $_product->get_sku() ), $cart_item_key ); ?>
						</td>
					</tr>
							<?php
					}
				}

					// do_action('woocommerce_review_order_after_cart_contents');
				?>
				</tbody>
			</table>
			</td>
		</tr>
		</tbody>

	</table>

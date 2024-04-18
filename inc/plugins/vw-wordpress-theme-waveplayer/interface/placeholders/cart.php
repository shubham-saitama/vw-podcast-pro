<?php
/**
 * You can customize the output of this placeholder copying this file
 * in your current theme folder, in the following location:
 * /wp-content/themes/<your-theme>/vwwaveplayer/placeholders/cart.php
 *
 * This way, you can safely upgrade VwWavePlayer to a newer version,
 * without losing any customization you made to the structure of the player.
 *
 * @package VwWavePlayer/Placeholders
 * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */

defined( 'ABSPATH' ) || exit;

$in_cart     = __( 'Already in cart: go to cart', 'vwwaveplayer' );
$add_to_cart = __( 'Add to cart', 'vwwaveplayer' );

?>
<% if ( ( attributes.guests || loggedUser ) ) { %>
	<% if ( track.product_id ) {
		var cart = track.in_cart > 0 ? 'vwwvpl-in_cart' : 'vwwvpl-add_to_cart';
		var callback = track.in_cart > 0 ? 'goToCart' : 'addToCart';
		var title = track.in_cart > 0 ? '<?php echo $in_cart; ?>' : '<?php echo $add_to_cart; ?>'; %>

		<span class="vwwvpl-stats vwwvpl-icon vwwvpl-button vwwvpl-cart <%= cart %> <%= attributes.class %>"
			title="<%= title %>"
			data-product_id="<%= track.product_id %>"
			data-event="<%= callback %>"
			data-callback="<%= callback %>">
		</span>
	<% } %>
<% } %>

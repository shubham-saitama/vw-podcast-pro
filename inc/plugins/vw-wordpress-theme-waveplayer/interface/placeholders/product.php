<?php
/**
 * You can customize the output of this placeholder copying this file
 * in your current theme folder, in the following location:
 * /wp-content/themes/<your-theme>/vwwaveplayer/placeholders/product.php
 *
 * This way, you can safely upgrade VwWavePlayer to a newer version,
 * without losing any customization you made to the structure of the player.
 *
 * @package VwWavePlayer/Placeholders
 * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */

defined( 'ABSPATH' ) || exit;

?>
<% if ( ( attributes.guests || loggedUser ) ) { %>
	<span
		class="vwwvpl-stats vwwvpl-icon vwwvpl-button vwwvpl-product <%= attributes.class %>"
		title="<%= __( 'Go to the product page', 'vwwaveplayer' ) %>"
		data-id="<%= track.id %>"
		data-index="<%= track.index %>"
		data-product-id="<%= track.product_id %>">
		<% if ( track.product_url ) { %>
			<a href="<%= track.product_url %>" class="vwwvpl-link <%= attributes.class %>"></a>
		<% } else { %>
			<%= track.product_title %>
		<% } %>
	</span>
<% } %>

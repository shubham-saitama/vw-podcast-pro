<?php //phpcs:ignore WordPress.Files.Filename.NoHyphenatedLowercase
/**
 * You can customize the output of this placeholder copying this file
 * in your current theme folder, in the following location:
 * /wp-content/themes/<your-theme>/vwwaveplayer/placeholders/product_url.php
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
	<% if ( track.product_url ) { %>
		<% const title = attributes.title || __( 'Go to the product page', 'vwwaveplayer' ) %>
		<% if ( attributes.raw ) { %>
			<%= track.product_url %>
		<% } else { %>
			<span
				class="vwwvpl-stats vwwvpl-icon vwwvpl-button vwwvpl-product_url <%= attributes.class %>"
				title="<%= track.title %>"
				data-id="<%= track.id %>"
				data-index="<%= track.index %>"
				data-product-id="<%= track.product_id %>">
				<a href="<%= track.product_url %>" class="vwwvpl-link <%= attributes.class %>"><%= track.product_url %></a>
			</span>
		<% } %>
	<% } %>
<% } %>

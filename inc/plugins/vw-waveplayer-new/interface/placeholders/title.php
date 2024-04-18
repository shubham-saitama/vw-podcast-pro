<?php
/**
 * You can customize the output of this placeholder copying this file
 * in your current theme folder, in the following location:
 * /wp-content/themes/<your-theme>/vwwaveplayer/placeholders/title.php
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
	<span class="vwwvpl-title <%= attributes.class %>" title="<%= track.title %>">
		<% if ( attributes.url ) { %>
			<a href="<%= attributes.url %>" <% if ( attributes.target ) { %>target="<%= attributes.target %>"<% } %>>
		<% } %>
			<%= track.title %>
		<% if ( attributes.url ) { %>
			</a>
		<% } %>
	</span>
<% } %>

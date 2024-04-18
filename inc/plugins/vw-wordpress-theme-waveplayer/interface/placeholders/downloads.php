<?php
/**
 * You can customize the output of this placeholder copying this file
 * in your current theme folder, in the following location:
 * /wp-content/themes/<your-theme>/vwwaveplayer/placeholders/downloads.php
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
	<% if ( track.stats ) {
		var count = track.stats.downloads ? track.stats.downloads : 0;
		var title = !!attributes.showValue ? _n( 'Downloaded by %s user', 'Downloaded by %s users', count, 'vwwaveplayer' ).replace('%s', count) : __( 'Download %s', 'vwwaveplayer' ).replace('%s', track.title) %>
			<span
				class="vwwvpl-stats vwwvpl-icon vwwvpl-button vwwvpl-downloads <%= attributes.class %>"
				title="<%= title %>"
				data-id="<%= track.id %>"
				data-index="<%= track.index %>"
				data-event="download"
				data-callback="updateDownloads">
				<a href="<%= track.file || '' %>" download class="vwwvpl-link <%= attributes.class %>"></a>
				<% if ( attributes.showValue ) { %>
					<span class="vwwvpl-value"><%= count %></span>
				<% } %>
			</span>
	<% } %>
<% } %>

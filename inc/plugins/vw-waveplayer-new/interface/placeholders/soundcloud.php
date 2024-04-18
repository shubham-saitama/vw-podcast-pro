<?php
/**
 * You can customize the output of this placeholder copying this file
 * in your current theme folder, in the following location:
 * /wp-content/themes/<your-theme>/vwwaveplayer/placeholders/soundcloud.php
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
	<a href="<%= track.soundcloud_url || '' %>" class="vwwvpl-link <%= attributes.class %>" target="<%= attributes.target || '_blank' %>">
		<span
			class="vwwvpl-stats vwwvpl-icon vwwvpl-button vwwvpl-soundcloud <%= attributes.class %>"
			title="<%= __( 'Play this track on Soundcloud', 'vwwaveplayer' ) %>"
			data-id="<%= track.id %>"
			data-index="<%= track.index %>"
			data-event="goToSoundcloud">
	</a>
<% } %>

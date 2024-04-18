<?php
/**
 * You can customize the output of this placeholder copying this file
 * in your current theme folder, in the following location:
 * /wp-content/themes/<your-theme>/vwwaveplayer/placeholders/share.php
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
	<% url = track.post_url %>
	<% if ( track.type === 'soundcloud' ) { url = track.soundcloud_url } %>
	<span class="vwwvpl-stats vwwvpl-icon vwwvpl-button vwwvpl-share <%= attributes.class %>" title="<%= __( 'Share', 'vwwaveplayer' ) %>" data-title="<%= track.title %>" data-url="<%= url %>">
		<span class="vwwvpl-share-popup">
			<ul>
				<li class="vwwvpl-icon vwwvpl-button vwwvpl-share_fb" data-social="fb"></li>
				<li class="vwwvpl-icon vwwvpl-button vwwvpl-share_tw" data-social="tw"></li>
				<li class="vwwvpl-icon vwwvpl-button vwwvpl-share_ln" data-social="ln"></li>
			</ul>
		</span>
	</span>
<% } %>

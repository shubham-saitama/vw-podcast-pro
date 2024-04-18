<?php //phpcs:ignore WordPress.Files.Filename.NoHyphenatedLowercase
/**
 * You can customize the output of this placeholder copying this file
 * in your current theme folder, in the following location:
 * /wp-content/themes/<your-theme>/vwwaveplayer/placeholders/share_fb.php
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
	<% var social = key.replace('share_', ''); %>
	<span class="vwwvpl-stats <%= attributes.class %>" title="<%= __( 'Share', 'vwwaveplayer' ) %>">
		<span class="fa fa-<%= social %> vwwvpl-<%= social %> vwwvpl-share <%= attributes.icon %>" data-title="<%= track.title %>" data-social="<%= social %>" data-url="<%= location.protocol + track.post_url %>"></span>
	</span>
<% } %>

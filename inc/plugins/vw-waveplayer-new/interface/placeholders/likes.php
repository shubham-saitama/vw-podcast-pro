<?php
/**
 * You can customize the output of this placeholder copying this file
 * in your current theme folder, in the following location:
 * /wp-content/themes/<your-theme>/vwwaveplayer/placeholders/likes.php
 *
 * This way, you can safely upgrade VwWavePlayer to a newer version,
 * without losing any customization you made to the structure of the player.
 *
 * @package VwWavePlayer/Placeholders
 * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */

defined( 'ABSPATH' ) || exit;

$loggedin_only = __( 'Only logged in users can like tracks', 'vwwaveplayer' );
$liked_by      = __( 'Liked by %s users', 'vwwaveplayer' );

?>
<% if ( ( attributes.guests || loggedUser ) ) { %>
	<% if ( track.stats ) { %>
		<% var l = track.stats.likes; %>
		<% var msg = !loggedUser ? '<?php echo $loggedin_only; ?>' : ''; %>
		<% var liked = likes?.indexOf( track.id ) > -1 ? 'liked' : ''; %>
		<span
			class="vwwvpl-stats vwwvpl-icon vwwvpl-button vwwvpl-<%=key %> <%= liked %> <%= attributes.class%>"
			title="<%= attributes.showValue ? '<?php echo $liked_by; ?>'.replace('%s', l) : '' %> <%= msg %>"
			data-id="<%= track.id %>"
			data-index="<%= track.index %>"
			data-event="<%= track.liked ? 'unlike' : 'like' %>"
			data-callback="updateLikes">
			<% if ( attributes.showValue ) { %>
				<span class="vwwvpl-value"><%= l %></span>
			<% } %>
		</span>
	<% } %>
<% } %>

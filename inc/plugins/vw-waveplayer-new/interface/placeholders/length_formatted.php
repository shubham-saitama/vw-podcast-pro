<?php //phpcs:ignore WordPress.Files.Filename.NoHyphenatedLowercase
/**
 * You can customize the output of this placeholder copying this file
 * in your current theme folder, in the following location:
 * /wp-content/themes/<your-theme>/vwwaveplayer/placeholders/length_formatted.php
 *
 * This way, you can safely upgrade VwWavePlayer to a newer version,
 * without losing any customization you made to the structure of the player.
 *
 * @package VwWavePlayer/Placeholders
 * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPOpenTagFound
 * @phpcs:disable Generic.PHP.DisallowAlternativePHPTags.MaybeASPShortOpenTagFound
 */

defined( 'ABSPATH' ) || exit;

$track_length = __( 'Track length: %s', 'vwwaveplayer' );

?>
<% if ( ( attributes.guests || loggedUser ) ) { %>
	<span class="vwwvpl-stats <%= attributes.class %> vwwvpl-length_formatted" title="'<?php echo $track_length; ?>'.replace('%s', track.length_formatted) %>">
		<% if ( attributes.showValue ) { %>
			<span class="vwwvpl-value"><%= track.length_formatted %></span>
		<% } %>
	</span>
<% } %>

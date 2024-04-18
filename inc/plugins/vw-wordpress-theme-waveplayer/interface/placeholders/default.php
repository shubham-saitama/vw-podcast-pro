<?php
/**
 * You can customize the output of this placeholder copying this file
 * in your current theme folder, in the following location:
 * /wp-content/themes/<your-theme>/vwwaveplayer/placeholders/default.php
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
	<% if ( attributes.raw ) { %>
		<%= track[ key ] %>
	<% } else { %>
		<% const iconClass = attributes.icon ? 'vwwvpl-icon ' + attributes.icon : '' %>
		<% const buttonClass = attributes.event ? 'vwwvpl-stats vwwvpl-button' : '' %>
		<% const statClass = iconClass || buttonClass ? 'vwwvpl-stats' : '' %>
		<span class="<%= statClass %> <%= iconClass %> <%= buttonClass %> vwwvpl-<%= key %> <%= attributes.class %>" title="<%= track[ key ] %>"
			title="<%= attributes.title %>"
			data-id="<%= track.id %>"
			data-index="<%= track.index %>"
			data-event="<%= attributes.event %>">
			<% if ( attributes.url ) { %>
				<% const download = attributes.download ? 'download="' + attributes.download + '"' : '' %>
				<a href="<%= attributes.url %>" class="vwwvpl-link" target="<%= attributes.target %>" <%= download %> >
			<% } %>
			<% if ( attributes.label ) { %>
				<%= attributes.label %>
			<% } %>
			<%= track[ key ] %>
			<% if ( attributes.url ) { %>
				</a>
			<% } %>
		</span>
	<% } %>
<% } %>

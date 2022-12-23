import domReady from '@wordpress/dom-ready';
import { registerBlockVariation } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { Path, SVG } from '@wordpress/components';

const acastIcon = (
	<SVG viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
		<Path d="M22.2 18.9h-.6c-.6 0-.6 0-.9-.2-.7-.3-1.1-1-1.7-2.6-.1-.3-.3-.8-.4-1.2-.5-1.2-.9-2.4-1.1-3-.1-.3-.3-.8-.3-.9-.1-.2-.2-.5-.2-.7-.1-.2-.3-.8-.5-1.4-.2-.6-.4-1.1-.4-1.2 0-.1-.2-.5-.4-1-.2-.6-.4-1.1-.6-1.7C14 2.6 14 2.6 13.9 2.6h-.5c-2.2.1-3.1.7-3.9 2.2-.3.5-.4.7-1 2.3-.2.5-.4 1.2-.5 1.5l-.4.8c-.2.5-.5 1.5-.9 2.4-.1.3-.3.8-.4 1.1-.1.2-.3.8-.4 1.2-.2.4-.4 1.1-.6 1.5-.5 1.3-.5 1.4-.8 2-.6 1.3-1.2 1.8-2.2 2.1-.2.1-.4.1-.4.1-.1.1-.1 1.5 0 1.6.1.1 7 .1 7.1 0 .1-.1.1-1.5 0-1.6l-.6-.2c-1.6-.3-1.7-.6-1.1-2.4.2-.4.3-.9.4-1V16h2.2c2.2 0 2.2 0 2.5-.1.3-.1.6-.4.8-.7l.2-.2.2.4c.7 2 1 2.8 1.3 3.3 1.1 1.9 2.4 2.7 4.3 2.7 1.6 0 2.7-.7 3-1.9 0-.2.1-.4 0-.4v-.2zm-11.5-5.7h-2s0-.1.1-.2c0-.1.2-.5.4-1s.5-1.3.7-1.9c.2-.5.5-1.2.6-1.6.1-.3.2-.7.3-.7.1-.1.1-.1.2.1 0 .1.2.5.3.8l.4 1.2c.4 1.3 1 2.6 1 2.9 0 .1.1.3.1.4v.1h-2.1z" />
	</SVG>
);

domReady( () => {
	registerBlockVariation( 'core/embed', {
		name: 'acast',
		title: 'Acast',
		icon: acastIcon,
		keywords: [ __( 'podcast' ), __( 'audio' ) ],
		description: __( 'Embed an Acast podcast.', 'wp-acast-oembed' ),
		patterns: [ /^https?:\/\/(.+\.)?acast\.com\/.+/i ],
		attributes: {
			providerNameSlug: 'acast',
			responsive: true,
		},
		isActive: ( blockAttributes, variationAttributes ) =>
			blockAttributes.providerNameSlug ===
			variationAttributes.providerNameSlug,
	} );
} );

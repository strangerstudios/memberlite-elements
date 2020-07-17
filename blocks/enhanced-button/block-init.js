const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const {
	InnerBlocks
} = wp.blockEditor;

// Import Block logic
import block from "./block";

const validAlignments = [ 'wide' ];

registerBlockType("memberlite/enhanced-button", {
	title: __("Enhanced Button", "memberlite-elements"),
	icon: "admin-links",
	category: "memberlite",
	description: __("Display a button-style link with optional Font Awesome icon.", "memberlite-elements"),
	keywords: [
		__("member", "memberlite-elements"),
		__("memberlite", "memberlite-elements"),
		__("enhanced", "memberlite-elements"),
		__("button", "memberlite-elements"),
	],
	getEditWrapperProps( attributes ) {
		const { align } = attributes;
		if ( -1 !== validAlignments.indexOf( align ) ) {
			return { 'data-align': align };
		}
	},
	example: {
		attributes: {
			preview: true,
		},
	},
	edit: block,
	// Render via PHP
	save() {
		return null;
	},
});

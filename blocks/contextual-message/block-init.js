const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const {
	InnerBlocks
} = wp.blockEditor;

// Import Block logic
import block from "./block";

const validAlignments = [ 'wide' ];

registerBlockType("memberlite/contextual-message", {
	title: __("Contextual Message", "memberlite-elements"),
	icon: "flag",
	category: "memberlite",
	description: __("Display a highlighted message block with your chosen context styling.", "memberlite-elements"),
	keywords: [
		__("member", "memberlite-elements"),
		__("memberlite", "memberlite-elements"),
		__("contextual", "memberlite-elements"),
		__("message", "memberlite-elements"),
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

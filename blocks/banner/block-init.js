const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const {
	InnerBlocks
} = wp.blockEditor;

// Import Block logic
import block from "./block";

const validAlignments = [ 'wide' ];

registerBlockType("memberlite/banner", {
	title: __("Banner", "memberlite-elements"),
	icon: "flag",
	category: "memberlite",
	description: __("Display a Memberlite banner.", "memberlite-elements"),
	keywords: [
		__("member", "memberlite-elements"),
		__("memberlite", "memberlite-elements"),
		__("banner", "memberlite-elements"),
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
	save: function() {
		return (
			<InnerBlocks.Content />
		);
	},
});

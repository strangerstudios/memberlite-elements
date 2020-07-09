const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
// Import Block logic
import block from "./block";

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
	supports: {
		align: ["wide", "full", "center"],
		anchor: true,
		html: false,
	},
	example: {
		attributes: {
			preview: true,
		},
	},
	edit: block,
	save() {
		return null;
	},
});

import classnames from "classnames";

const { Component, Fragment } = wp.element;

const { __, _n } = wp.i18n;

const { PanelBody, SelectControl } = wp.components;

const {
	InnerBlocks,
	InspectorControls,
	PanelColorSettings,
	AlignmentToolbar,
	BlockControls,
	RichText,
} = wp.blockEditor;

class MemberliteElementsContextualMessage extends Component {
	constructor() {
		super(...arguments);
	}

	render = () => {
		const { attributes, setAttributes } = this.props;

		const { messageStyle, message } = attributes;

		// Background Parameters
		const messageStyleOptions = [
			{ value: "default", label: __("Default", "memberlite-elements") },
			{ value: "info", label: __("Info", "memberlite-elements") },
			{ value: "success", label: __("Success", "memberlite-elements") },
			{ value: "alert", label: __("Alert", "memberlite-elements") },
			{ value: "error", label: __("Error", "memberlite-elements") },
		];

		const inspectorControls = (
			<InspectorControls>
				<PanelBody title={__("Settings", "memberlite-elements")}>
					<SelectControl
						label={__("Message Style", "memberlite-elements")}
						options={messageStyleOptions}
						value={messageStyle}
						onChange={(value) => {
							this.props.setAttributes({
								messageStyle: value,
							});
						}}
					/>
				</PanelBody>
			</InspectorControls>
		);

		return (
			<Fragment>
				{inspectorControls}
				<div
					className={classnames(
						"memberlite-block-admin-contextual-message",
						messageStyle
					)}
				>
					<RichText
						placeholder={__("Enter your message", "memberlite-elements")}
						value={message}
						onChange={(content) => setAttributes({ message: content })}
					/>
				</div>
			</Fragment>
		);
	};
}

export default MemberliteElementsContextualMessage;

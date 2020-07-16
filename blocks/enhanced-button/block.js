import classnames from "classnames";

const { Component, Fragment } = wp.element;

const { __, _n } = wp.i18n;

const {
	PanelBody,
	SelectControl,
	IconButton,
	Dashicon,
	ToggleControl,
} = wp.components;

const { URLInput } = wp.editor;

const { InspectorControls, RichText } = wp.blockEditor;

class MemberliteElementsEnhancedButton extends Component {
	constructor() {
		super(...arguments);
	}

	render = () => {
		const { attributes, setAttributes, isSelected } = this.props;

		const { buttonStyle, content, id, rel, buttonURL } = attributes;

		const buttonStyleOptions = [
			{ value: "default", label: __("Default Button", "memberlite-elements") },
			{ value: "primary", label: __("Primary Color", "memberlite-elements") },
			{
				value: "secondary",
				label: __("Secondary Color", "memberlite-elements"),
			},
			{ value: "action", label: __("Action Color", "memberlite-elements") },
			{ value: "success", label: __("Success", "memberlite-elements") },
			{ value: "alert", label: __("Alert", "memberlite-elements") },
			{ value: "error", label: __("Error", "memberlite-elements") },
			{ value: "info", label: __("Info", "memberlite-elements") },
			{ value: "link", label: __("Link Only", "memberlite-elements") },
		];

		const inspectorControls = (
			<InspectorControls>
				<PanelBody title={__("Button Settings", "memberlite-elements")}>
					<SelectControl
						label={__("Button Style", "memberlite-elements")}
						options={buttonStyleOptions}
						value={buttonStyle}
						onChange={(value) => {
							this.props.setAttributes({
								buttonStyle: value,
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
						"memberlite-block-admin-enhanced-button",
						buttonStyle
					)}
				>
					<RichText
						tagName="span"
						value={content}
						onChange={(content) => setAttributes({ content })}
						placeholder={__("Button text...", "memberlite-elements")}
						keepPlaceholderOnFocus
						formattingControls={[]}
						className={classnames("memberlite-elements-enhanced-button")}
					/>
					{isSelected && (
						<Fragment>
							<form
								key="form-link"
								className={`blocks-button__inline-link memberlite-button-link`}
								onSubmit={(event) => event.preventDefault()}
							>
								<Dashicon icon={"admin-links"} />
								<URLInput
									className="button-url"
									value={buttonURL}
									onChange={(value) => setAttributes({ buttonURL: value })}
								/>
								<IconButton
									icon="editor-break"
									label={__("Apply", "memberlite-elements")}
									type="submit"
								/>
							</form>
						</Fragment>
					)}
				</div>
			</Fragment>
		);
	};
}

export default MemberliteElementsEnhancedButton;

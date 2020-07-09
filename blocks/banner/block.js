const { Component, Fragment } = wp.element;

const { __, _n } = wp.i18n;

const {
	PanelBody,
	Placeholder,
	RangeControl,
	SelectControl,
	TextControl,
	ToggleControl,
	Button,
} = wp.components;

const {
	InspectorControls,
	PanelColorSettings,
} = wp.blockEditor;

class MemberliteElementsBanner extends Component {
	constructor() {
		super(...arguments);

		// Set initial state here if needed.
	}

	render = () => {
		const { attributes, setAttributes } = this.props;

		const { backgroundColor } = attributes;

		const inspectorControls = (
			<InspectorControls>
				<PanelBody
					initialOpen={true}
					title={__("Background Color", "memberlite-elements")}
				>
						<PanelColorSettings
							title={__("Background Color", "memberlite-elements")}
							initialOpen={true}
							colorSettings={[
								{
									value: backgroundColor,
									onChange: (value) => {
										setAttributes({ backgroundColor: value });
									},
									label: __("Background Color", "memberlite-elements"),
								},
							]}
						></PanelColorSettings>
					</PanelBody>
			</InspectorControls>
		);

		return (
			<Fragment>
				{inspectorControls}
				<Placeholder>
					<div className="memberlite-block-admin-banner">
						<h1>
							Hello World
						</h1>
					</div>
				</Placeholder>
			</Fragment>
		);
	}
}

export default MemberliteElementsBanner;
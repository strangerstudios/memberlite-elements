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
	InnerBlocks,
	InspectorControls,
	PanelColorSettings,
	RichText,
	AlignmentToolbar,
	BlockControls,
} = wp.blockEditor;

class MemberliteElementsBanner extends Component {
	constructor() {
		super(...arguments);

		// Set initial state here if needed.
	}

	render = () => {
		const { attributes, setAttributes } = this.props;

		const { background, backgroundCustom, title, alignment } = attributes;

		// Background Parameters
		const backgroundOptions = [
			{ value: "primary", label: __("Primary", "memberlite-elements") },
			{ value: "secondary", label: __("Secondary", "memberlite-elements") },
			{ value: "action", label: __("Action", "memberlite-elements") },
			{ value: "body", label: __("Body", "memberlite-elements") },
			{ value: "custom", label: __("Custom", "memberlite-elements") }
		];

		const inspectorControls = (
			<InspectorControls>
				<PanelBody
					initialOpen={true}
					title={__("Background Settings", "memberlite-elements")}
				>
					<SelectControl
						label={__("Choose a Background", "post-type-archive-mapping")}
						options={backgroundOptions}
						value={background}
						onChange={(value) => {
							this.props.setAttributes({
								background: value,
							});
						}}
					/>
					{ 'custom' === background &&
						<PanelColorSettings
							title={__("Choose a Color", "memberlite-elements")}
							initialOpen={true}
							colorSettings={[
								{
									value: backgroundCustom,
									onChange: (value) => {
										setAttributes({ backgroundCustom: value });
									},
									label: __("Background Color", "memberlite-elements"),
								},
							]}
						>
						</PanelColorSettings>
					}
				</PanelBody>
			</InspectorControls>
		);

		return (
			<Fragment>
				<BlockControls key="controls">
					<AlignmentToolbar
						value={ alignment }
						onChange={ ( value ) => {
							setAttributes( { alignment: value } );
						} }
					/>
				</BlockControls>
				{inspectorControls}
						<div className="memberlite-block-admin-banner">
							<RichText
								placeholder={__('Enter a title here...', 'memberlite-elements')}
								value={ title }
								onChange={ ( content ) => setAttributes( { title: content } ) }
							/>
							<InnerBlocks
								renderAppender={ () => (
									<InnerBlocks.ButtonBlockAppender />
								) }
								templateLock={ false }
							/>
						</div>
			</Fragment>
		);
	}
}

export default MemberliteElementsBanner;
/**
 * JavaScript code for the "Default Style Customizer Screen" component.
 *
 * @package TablePress
 * @subpackage Default Style Customizer Screen
 * @author Tobias Bäthge
 * @since 2.2.0
 */

/**
 * WordPress dependencies.
 */
import { useState } from 'react';
import {
	Button,
	Card,
	CardBody,
	Icon,
	Panel,
	PanelBody,
	PanelRow,
	TabPanel,
} from '@wordpress/components';
import { info } from '@wordpress/icons';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies.
 */
import DefaultStyleCustomizerColorControl from './colorcontrol';
import DefaultStyleCustomizerLengthControl from './lengthcontrol';
import DefaultStyleCustomizerStyleVariation from './stylevariation';
import { importFromCustomCss, exportToCustomCss, saveCustomCss } from './css';
import cssProperties from './options';
import styleVariations from './variations';
import DefaultStyleCustomizerSandBox from './sandbox';

const colorProperties = Object.entries( cssProperties ).filter( ( [ , propertyData ] ) => ( 'color' === propertyData.type ) );

/**
 * Returns the "Default Style Customizer Screen" component's JSX markup.
 *
 * @return {Object} Default Style Customizer Screen component.
 */
const DefaultStyleCustomizerScreen = () => {
	const [ currentValues, setCurrentValues ] = useState( importFromCustomCss() );
	const [ styleVariationsPanelOpen, setStyleVariationsPanelOpen ] = useState( 'custom' !== currentValues['--style-variation'] );

	/**
	 * Handles CSS property state changes.
	 *
	 * @param {string}      cssProperty Custom CSS property name.
	 * @param {string|null} value       Value for the CSS property.
	 */
	const handleCssPropertyChange = ( cssProperty, value ) => {
		if ( null === value ) {
			// Reset to default value.
			value = styleVariations.default.css[ cssProperty ];
		} else if ( value.startsWith( '--' ) ) {
			// Properly store CSS variable values.
			value = `var(${ value })`;
		}

		const newValues = {
			...currentValues,
			[ cssProperty ]: value,
			'--style-variation': 'custom',
		};
		setCurrentValues( newValues );
	};

	const tabs = [
		{
			name: 'background',
			title: __( 'Background colors', 'tablepress' ),
		},
		{
			name: 'text',
			title: __( 'Text colors', 'tablepress' ),
		},
		{
			name: 'border',
			title: __( 'Border', 'tablepress' ),
		},
		{
			name: 'spacing',
			title: __( 'Spacing', 'tablepress' ),
		},
	];

	return (
		<div>
			<p>
				{ __( 'To change the default styling of your tables, choose an existing style variation or customize individual colors or properties.', 'tablepress' ) }
				<br />
				{ __( 'Click the “Save to ‘Custom CSS’” button below to add the automatically generated code for your styling to the site’s “Custom CSS”.', 'tablepress' ) }
			</p>
			<Panel>
				<PanelBody
					title={ __( 'Style Variations', 'tablepress' ) }
					initialOpen={ styleVariationsPanelOpen }
				>
					<PanelRow>
						<div className="style-variation-wrapper">
							{
								Object.entries( styleVariations ).map( ( [ variation, variationData ] ) => (
									<DefaultStyleCustomizerStyleVariation
										key={ variation }
										variation={ variation }
										variationName={ variationData.name }
										variationCss={ variationData.css }
										activeVariation={ currentValues['--style-variation'] }
										onChange={ () => {
											setCurrentValues( { ...variationData.css } );
										} }
									/>
								) )
							}
							<DefaultStyleCustomizerStyleVariation
								variation="custom"
								variationName={ __( 'Custom', 'tablepress' ) }
								variationCss={ currentValues }
								activeVariation={ currentValues['--style-variation'] }
								onChange={ () => {
									handleCssPropertyChange( '--style-variation', 'custom' );
									setStyleVariationsPanelOpen( true ); // Keep "Style Variations" panel open.
								} }
							/>
						</div>
					</PanelRow>
				</PanelBody>
			</Panel>
			<div style={ {
				'display': 'flex',
			} }>
				<div style={ {
					width: '390px',
					borderLeft: '1px solid #e0e0e0',
					borderRight: '1px solid #e0e0e0',
					borderBottom: '1px solid #e0e0e0',
				} }>
					<Card>
						<CardBody style={ {
							boxShadow: 'none',
						} }>
							<h2 className="card-title">
								{ __( 'Custom style values', 'tablepress' ) }
							</h2>
							<TabPanel tabs={ tabs }>
								{ ( tab ) => (
									<div
										style={ {
											paddingTop: '24px',
										} }
									>
										{
											Object.entries( cssProperties )
												.filter( ( [ , propertyData ] ) => ( tab.name === propertyData.category ) )
												.map( ( [ cssProperty, propertyData ] ) => {
													if ( 'color' === propertyData.type ) {
														return (
															<DefaultStyleCustomizerColorControl
																key={ cssProperty }
																cssProperty={ cssProperty }
																color={ currentValues[ cssProperty ] }
																name={ propertyData.name }
																colorProperties={ colorProperties }
																currentValues={ currentValues }
																onChange={ handleCssPropertyChange }
															/>
														);
													} else if ( 'length' === propertyData.type ) {
														return (
															<DefaultStyleCustomizerLengthControl
																key={ cssProperty }
																cssProperty={ cssProperty }
																lengthValue={ currentValues[ cssProperty ] }
																name={ propertyData.name }
																onChange={ handleCssPropertyChange }
															/>
														);
													}
													return <></>;
												} )
										}
									</div>
								) }
							</TabPanel>
						</CardBody>
					</Card>
				</div>
				<div style={ {
					width: 'calc(100% - 390px)',
					borderRight: '1px solid #e0e0e0',
					borderBottom: '1px solid #e0e0e0',
				} }>
					<Card>
						<CardBody>
							<h2 className="card-title">
								{ __( 'Preview', 'tablepress' ) }
							</h2>
							<DefaultStyleCustomizerSandBox
								cssProperties={ currentValues }
							/>
							<p className="info-text">
								<Icon icon={info} />
								<span>
									{ __( 'Please note your site’s theme and plugins may also influence the table styling.', 'tablepress' ) }
									{ ' ' }
									{ __( 'Tables on your site might look different!', 'tablepress' ) }
									<br />
									{ __( 'To change the styling of individual tables, use “Custom CSS” code below.', 'tablepress' ) }
								</span>
							</p>
						</CardBody>
					</Card>
				</div>
			</div>
			<Card>
				<CardBody>
					<Button
						variant="primary"
						onClick={ () => {
							exportToCustomCss( currentValues );
							saveCustomCss();
						} }
					>
						{ __( 'Save to “Custom CSS”', 'tablepress' ) }
					</Button>
				</CardBody>
			</Card>
		</div>
	);
};

export default DefaultStyleCustomizerScreen;

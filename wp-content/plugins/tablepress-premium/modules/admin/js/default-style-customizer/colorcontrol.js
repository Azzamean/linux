/**
 * JavaScript code for the "Default Style ColorControl" component.
 *
 * @package TablePress
 * @subpackage Default Style Customizer Screen
 * @author Tobias Bäthge
 * @since 2.2.0
 */

/**
 * WordPress dependencies.
 */
import {
	Button,
	ColorIndicator,
} from '@wordpress/components';
import { useState } from 'react';

/**
 * Internal dependencies.
 */
import DefaultStyleCustomizerColorPicker from './colorpicker';

/**
 * Returns the "Default Style Customizer ColorControl" component's JSX markup.
 *
 * @param {Object}   props                 Function parameters.
 * @param {string}   props.cssProperty     Custom CSS property for this DefaultStyleCustomizerColorControl.
 * @param {string}   props.color           Current color value of the custom CSS property.
 * @param {string}   props.name            Readable name for the custom CSS property.
 * @param {Array}    props.colorProperties All available custom CSS properties for colors.
 * @param {Object}   props.currentValues   Current values of all custom CSS properties.
 * @param {Function} props.onChange        Callback for color value changes.
 * @return {Object} Default Style Customizer ColorControl component.
 */
const DefaultStyleCustomizerColorControl = ( { cssProperty, color, name, colorProperties, currentValues, onChange } ) => {
	const [ isVisible, setIsVisible ] = useState( false );

	// Get HEX color value from CSS property.
	let colorHex = color;
	while ( colorHex.startsWith( 'var(' ) ) {
		const colorName = ( ( colorHex.match( /var\(([-a-z]+)\)/ ) )?.[1] ).trim();
		colorHex = currentValues[ colorName ];
	}

	return (
		<div style={ {
			display: 'flex',
			height: '36px',
		} }>
			<div style={ {
				width: '50%',
				fontWeight: 'bold',
			} }>
				{ `${ name }:` }
			</div>
			<div>
				<ColorIndicator
					colorValue={ colorHex }
					onClick={ setIsVisible }
				/>
				<Button
					variant="link"
					onClick={ setIsVisible }
					style={ {
						verticalAlign: 'top',
						paddingLeft: '8px',
						paddingTop: '2px',
						color: '#000000',
						textDecoration: 'none',
					} }
				>
					{ colorHex.toUpperCase() }
				</Button>
				{ isVisible &&
					<DefaultStyleCustomizerColorPicker
						cssProperty={ cssProperty }
						color={ color }
						colorProperties={ colorProperties }
						currentValues={ currentValues }
						onChange={ onChange }
						onClose={ setIsVisible }
					/>
				}
			</div>
		</div>
	);
};

export default DefaultStyleCustomizerColorControl;

/**
 * JavaScript code for the "Default Style Customizer LengthControl" component.
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
	__experimentalUnitControl as UnitControl, // eslint-disable-line @wordpress/no-unsafe-wp-apis
} from '@wordpress/components';

/**
 * Returns the "Default Style Customizer LengthControl" component's JSX markup.
 *
 * @param {Object}   props             Function parameters.
 * @param {string}   props.cssProperty Custom CSS property for this DefaultStyleCustomizerLengthControl.
 * @param {string}   props.lengthValue Current length value of the custom CSS property.
 * @param {string}   props.name        Readable name for the custom CSS property.
 * @param {Function} props.onChange    Callback for color value changes.
 * @return {Object} Default Style Customizer LengthControl component.
 */
const DefaultStyleCustomizerLengthControl = ( { cssProperty, lengthValue, name, onChange } ) => {
	return (
		<UnitControl
			label={ name }
			value={ lengthValue }
			onChange={ ( newLength ) => onChange( cssProperty, newLength ) }
			style={ {
				width: '120px',
			} }
		/>
	);
};

export default DefaultStyleCustomizerLengthControl;

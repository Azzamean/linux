import { _x } from '@wordpress/i18n';
import { PanelRow, TextControl } from '@wordpress/components';
import { useMemo } from "react";

/**
 * Function to handle the change event of the grid gap control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {string}   newValue      The new value of the grid gap control.
 */
export function onChangeGridGap( setAttributes, newValue ) {
	setAttributes( { gap: parseInt( newValue, 10 ) } );
}

/**
 * GridGapControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props                 The component props.
 * @param {Object} props.attributes      The block attributes.
 * @param {Object} props.setAttributes   Function to set the block attributes.
 */
export function GridGapControl( { attributes, setAttributes } ) {
	const { gap } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<TextControl
					label={ _x(
						'Grid Gap',
						'Label for the grid gap control',
						'event-schedule-manager'
					) }
					type='number'
					value={ gap }
					onChange={ newValue => onChangeGridGap( setAttributes, newValue ) }
					key='gap-toggle'
				/>
			</fieldset>
		</PanelRow>
	), [ gap ] );
}

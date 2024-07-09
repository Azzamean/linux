import { _x } from '@wordpress/i18n';
import { PanelRow, SelectControl } from '@wordpress/components';
import { useMemo } from "react";

/**
 * Function to handle the change event of the text alignment control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {string}   newValue      The new value of the text alignment control.
 */
export function onChangeTextAlignment( setAttributes, newValue ) {
	setAttributes( { align: newValue } );
}

/**
 * TextAlignmentControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props                 The component props.
 * @param {Object} props.attributes      The block attributes.
 * @param {Object} props.setAttributes   Function to set the block attributes.
 */
export function TextAlignmentControl( { attributes, setAttributes } ) {
	const { align } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<SelectControl
					label={ _x(
						'Alignment',
						'Label for the text alignment control',
						'event-schedule-manager'
					) }
					help={ _x(
						'Set text Alignment in the grid.',
						'Help text when content is hidden',
						'event-schedule-manager'
					) }
					value={ align }
					options={ [
						{
							value: 'left',
							label: _x(
								'Left',
								'Option for left text alignment',
								'event-schedule-manager'
							)
						},
						{
							value: 'center',
							label: _x(
								'Center',
								'Option for center text alignment',
								'event-schedule-manager'
							)
						},
						{
							value: 'right',
							label: _x(
								'Right',
								'Option for right text alignment',
								'event-schedule-manager'
							)
						},
					] }
					onChange={ newValue => onChangeTextAlignment( setAttributes, newValue ) }
					key='text-align-select'
				/>
			</fieldset>
		</PanelRow>
	), [ align ] );
}

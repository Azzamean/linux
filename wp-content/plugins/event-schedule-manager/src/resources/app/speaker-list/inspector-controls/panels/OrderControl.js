import { _x } from '@wordpress/i18n';
import { PanelRow, SelectControl } from '@wordpress/components';
import { useMemo } from "react";

/**
 * Function to handle the change event of the order control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {string}   newValue      The new value of the order control.
 */
export function onChangeOrder( setAttributes, newValue ) {
	setAttributes( { order: newValue } );
}

/**
 * OrderControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props                 The component props.
 * @param {Object} props.attributes      The block attributes.
 * @param {Object} props.setAttributes   Function to set the block attributes.
 */
export function OrderControl( { attributes, setAttributes } ) {
	const { order } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<SelectControl
					label={ _x(
						'Order',
						'Label for the order control',
						'event-schedule-manager'
					) }
					value={ order }
					options={ [
						{
							value: 'desc',
							label: _x(
								'DESC',
								'Option for ordering speakers in descending order',
								'event-schedule-manager'
							)
						},
						{
							value: 'asc',
							label: _x(
								'ASC',
								'Option for ordering speakers in ascending order',
								'event-schedule-manager'
							)
						}
					] }
					onChange={ newValue => onChangeOrder( setAttributes, newValue ) }
					key='speaker-order-select'
				/>
			</fieldset>
		</PanelRow>
	), [ order ] );
}

import { _x } from '@wordpress/i18n';
import { PanelRow, SelectControl } from '@wordpress/components';
import { useMemo } from "react";

/**
 * Function to handle the change event of the order by control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {string}   newValue      The new value of the order by control.
 */
export function onChangeOrderBy( setAttributes, newValue ) {
	setAttributes( { orderby: newValue } );
}

/**
 * OrderByControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props                 The component props.
 * @param {Object} props.attributes      The block attributes.
 * @param {Object} props.setAttributes   Function to set the block attributes.
 */
export function OrderByControl( { attributes, setAttributes } ) {
	const { orderby } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<SelectControl
					label={ _x(
						'OrderBy',
						'Label for the order by control',
						'event-schedule-manager'
					) }
					value={ orderby }
					options={ [
						{
							value: 'date',
							label: _x(
								'Date',
								'Option for ordering speakers by date',
								'event-schedule-manager'
							)
						},
						{
							value: 'title',
							label: _x(
								'Title',
								'Option for ordering speakers by title',
								'event-schedule-manager'
							)
						},
						{
							value: 'rand',
							label: _x(
								'Random',
								'Option for ordering speakers randomly',
								'event-schedule-manager'
							)
						}
					] }
					onChange={ newValue => onChangeOrderBy( setAttributes, newValue ) }
					key='speaker-orderby-select'
				/>
			</fieldset>
		</PanelRow>
	), [ orderby ] );
}

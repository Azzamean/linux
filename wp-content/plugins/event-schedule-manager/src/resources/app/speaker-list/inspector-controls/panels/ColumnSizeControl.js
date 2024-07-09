import { _x } from "@wordpress/i18n";
import { PanelRow, TextControl } from "@wordpress/components";
import { useMemo } from "react";

/**
 * Function to handle the change event of the column size control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {string}   newValue      The new value of the column size control.
 */
export function onChangeColumnSize( setAttributes, newValue ) {
	setAttributes( { columns: parseInt( newValue, 10 ) } );
}

/**
 * ColumnSizeControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props                 The component props.
 * @param {Object} props.attributes      The block attributes.
 * @param {Object} props.setAttributes   Function to set the block attributes.
 */
export function ColumnSizeControl( { attributes, setAttributes } ) {
	const { columns } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<TextControl
					label={ _x(
						'Column Size',
						'Label for the column size control',
						'event-schedule-manager'
					) }
					type='number'
					value={ columns }
					onChange={ newValue => onChangeColumnSize( setAttributes, newValue ) }
					key='columns-toggle'
				/>
			</fieldset>
		</PanelRow>
	), [ columns ] );
}

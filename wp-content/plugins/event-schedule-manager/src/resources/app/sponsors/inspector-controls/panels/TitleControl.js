import { _x } from '@wordpress/i18n';
import { PanelRow, SelectControl } from '@wordpress/components';
import { useMemo } from "react";

/**
 * Function to handle the change event of the sponsors link control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {string}   newValue      The new value of the sponsors link control.
 */
export function onChangeTitle( setAttributes, newValue ) {
	setAttributes( { title: newValue } );
}

/**
 * TitleControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props                 The component props.
 * @param {Object} props.attributes      The block attributes.
 * @param {Object} props.setAttributes   Function to set the block attributes.
 */
export function TitleControl( { attributes, setAttributes } ) {
	const { title } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<SelectControl
					label={ _x(
						'Title',
						'Label for the sponsors link control',
						'event-schedule-manager'
					) }
					value={ title }
					options={ [
						{
							value: 'visible',
							label: _x(
								'Visible',
								'The sponsor title is displayed',
								'event-schedule-manager'
							)
						},
						{
							value: 'hidden',
							label: _x(
								"Hidden",
								'The sponsor title is hidden',
								'event-schedule-manager'
							)
						}
					] }
					onChange={ newValue => onChangeTitle( setAttributes, newValue ) }
					key='title-select'
				/>
			</fieldset>
		</PanelRow>
	), [ title ] );
}

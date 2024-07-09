import { _x } from '@wordpress/i18n';
import { PanelRow, SelectControl } from '@wordpress/components';
import { useMemo } from "react";

/**
 * Function to handle the change event of the display count control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {string}   newValue      The new value of the display count control.
 */
export function onChangeDisplayCount( setAttributes, newValue ) {
	setAttributes( { posts_per_page: newValue } );
}

/**
 * DisplayCountControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props                 The component props.
 * @param {Object} props.attributes      The block attributes.
 * @param {Object} props.setAttributes   Function to set the block attributes.
 */
export function DisplayCountControl( { attributes, setAttributes } ) {
	const { posts_per_page } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<SelectControl
					label={ _x(
						'Count',
						'Label for the display count control',
						'event-schedule-manager'
					) }
					className='tec-schedule-settings-panel__select-small'
					value={ posts_per_page }
					options={ [
						{
							value: '100',
							label: _x(
								'100',
								'Option for displaying all speakers',
								'event-schedule-manager'
							)
						},
						{
							value: '5',
							label: _x(
								'5',
								'Option for displaying 5 speakers',
								'event-schedule-manager'
							)
						},
						{
							value: '10',
							label: _x(
								'10',
								'Option for displaying 10 speakers',
								'event-schedule-manager'
							)
						},
						{
							value: '15',
							label: _x(
								'15',
								'Option for displaying 15 speakers',
								'event-schedule-manager'
							)
						},
						{
							value: '20',
							label: _x(
								'20',
								'Option for displaying 20 speakers',
								'event-schedule-manager'
							)
						},
						{
							value: '25',
							label: _x(
								'25',
								'Option for displaying 25 speakers',
								'event-schedule-manager'
							)
						},
						{
							value: '30',
							label: _x(
								'30',
								'Option for displaying 30 speakers',
								'event-schedule-manager'
							)
						},
						{
							value: '35',
							label: _x(
								'35',
								'Option for displaying 35 speakers',
								'event-schedule-manager'
							)
						},
						{
							value: '40',
							label: _x(
								'40',
								'Option for displaying 40 speakers',
								'event-schedule-manager'
							)
						},
						{
							value: '45',
							label: _x(
								'45',
								'Option for displaying 45 speakers',
								'event-schedule-manager'
							)
						},
						{
							value: '50',
							label: _x(
								'50',
								'Option for displaying 50 speakers',
								'event-schedule-manager'
							)
						},
						{
							value: '-1',
							label: _x(
								'All',
								'Option for displaying all speakers',
								'event-schedule-manager'
							)
						}
					] }
					onChange={ newValue => onChangeDisplayCount( setAttributes, newValue ) }
					key='display-count-select'
				/>
			</fieldset>
		</PanelRow>
	), [ posts_per_page ] );
}

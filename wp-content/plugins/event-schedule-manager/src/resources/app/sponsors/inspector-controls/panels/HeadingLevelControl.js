import { _x } from '@wordpress/i18n';
import { PanelRow, SelectControl } from '@wordpress/components';
import { useMemo } from "react";

/**
 * Function to handle the change event of the heading level control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {string}   newValue      The new value of the heading level control.
 */
export function onChangeHeadingLevel( setAttributes, newValue ) {
	setAttributes( { heading_level: newValue } );
}

/**
 * HeadingLevelControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props                 The component props.
 * @param {Object} props.attributes      The block attributes.
 * @param {Object} props.setAttributes   Function to set the block attributes.
 */
export function HeadingLevelControl( { attributes, setAttributes } ) {
	const { heading_level } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<SelectControl
					label={ _x(
						'Heading Level',
						'Label for the heading level control in the block settings',
						'event-schedule-manager'
					) }
					value={ heading_level }
					options={ [
						{
							value: 'h1',
							label: _x(
								'Heading 1 (H1)',
								'Option label for selecting heading level 1',
								'event-schedule-manager'
							)
						},
						{
							value: 'h2',
							label: _x(
								'Heading 2 (H2)',
								'Option label for selecting heading level 2',
								'event-schedule-manager'
							)
						},
						{
							value: 'h3',
							label: _x(
								'Heading 3 (H3)',
								'Option label for selecting heading level 3',
								'event-schedule-manager'
							)
						},
						{
							value: 'h4',
							label: _x(
								'Heading 4 (H4)',
								'Option label for selecting heading level 4',
								'event-schedule-manager'
							)
						},
						{
							value: 'h5',
							label: _x(
								'Heading 5 (H5)',
								'Option label for selecting heading level 5',
								'event-schedule-manager'
							)
						},
						{
							value: 'h6',
							label: _x(
								'Heading 6 (H6)',
								'Option label for selecting heading level 6',
								'event-schedule-manager'
							)
						}
					] }
					onChange={ newValue => onChangeHeadingLevel( setAttributes, newValue ) }
					key='heading-level-select'
				/>
			</fieldset>
		</PanelRow>
	), [ heading_level ] );
}

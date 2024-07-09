import { _x } from '@wordpress/i18n';
import { PanelRow, SelectControl } from '@wordpress/components';
import { useMemo } from "react";

/**
 * Function to handle the change event of the content control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {string}   newValue      The new value of the content control.
 */
export function onChangeContent( setAttributes, newValue ) {
	setAttributes( { content: newValue } );
}

/**
 * ContentControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props                 The component props.
 * @param {Object} props.attributes      The block attributes.
 * @param {Object} props.setAttributes   Function to set the block attributes.
 */
export function ContentControl( { attributes, setAttributes } ) {
	const { content } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<SelectControl
					label={ _x(
						'Content',
						'Label for the content control in the block settings',
						'event-schedule-manager'
					) }
					value={ content }
					options={ [
						{
							value: 'full',
							label: _x(
								"Displays the full content of the sponsor's post.",
								'Option label for displaying full content',
								'event-schedule-manager'
							)
						},
						{
							value: 'excerpt',
							label: _x(
								"Displays an excerpt of the content, limited to a number of words defined by the excerpt length attribute.",
								'Option label for displaying content excerpt',
								'event-schedule-manager'
							)
						},
						{
							value: 'hidden',
							label: _x(
								'The content is hidden',
								'Option label for hiding the content',
								'event-schedule-manager'
							)
						}
					] }
					onChange={ newValue => onChangeContent( setAttributes, newValue ) }
					key='content-select'
				/>
			</fieldset>
		</PanelRow>
	), [ content ] );
}

import { _x } from '@wordpress/i18n';
import { PanelRow, ToggleControl } from '@wordpress/components';
import { useMemo } from "react";

/**
 * Function to handle the change event of the show content control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {boolean}  newValue      The new value of the show content control.
 */
export function onChangeShowContent( setAttributes, newValue ) {
	setAttributes( { show_content: newValue } );
}

/**
 * ShowContentControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props                 The component props.
 * @param {Object} props.attributes      The block attributes.
 * @param {Object} props.setAttributes   Function to set the block attributes.
 */
export function ShowContentControl( { attributes, setAttributes } ) {
	const { show_content } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<legend className='blocks-base-control__label'>
					{ _x( 'Content Display', 'Label for the show content control', 'event-schedule-manager' ) }
				</legend>
				<ToggleControl
					label={ _x( 'Enable to Show Content', 'Label for the show content toggle', 'event-schedule-manager' ) }
					help={
						show_content
							? _x( 'Content is showing.', 'Help text when content is displayed', 'event-schedule-manager' )
							: _x( 'Content is hidden.', 'Help text when content is hidden', 'event-schedule-manager' )
					}
					checked={ show_content }
					onChange={ newValue => onChangeShowContent( setAttributes, newValue ) }
					key='show-content-toggle'
				/>
			</fieldset>
		</PanelRow>
	), [ show_content ] );
}

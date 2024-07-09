import { _x } from '@wordpress/i18n';
import { PanelRow, ToggleControl } from '@wordpress/components';
import { useMemo } from 'react';

/**
 * Function to handle the change event of the show image control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {boolean}  newValue      The new value of the show image control.
 */
export function onChangeShowImage( setAttributes, newValue ) {
	setAttributes( { show_image: newValue } );
}

/**
 * ShowImageControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props               The component props.
 * @param {Object} props.attributes    The block attributes.
 * @param {Object} props.setAttributes Function to set the block attributes.
 */
export function ShowImageControl( { attributes, setAttributes } ) {
	const { show_image } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<legend className='blocks-base-control__label'>
					{ _x( 'Featured Images', 'Label for the show image control', 'event-schedule-manager' ) }
				</legend>
				<ToggleControl
					label={ _x( 'Enable to Show Speaker Images', 'Label for the show image toggle', 'event-schedule-manager' ) }
					help={
						show_image
							? _x( 'Profile images are showing.', 'Help text when images are displayed', 'event-schedule-manager' )
							: _x( 'Profile images are hidden.', 'Help text when images are hidden', 'event-schedule-manager' )
					}
					checked={ show_image }
					onChange={ ( newValue ) => onChangeShowImage( setAttributes, newValue ) }
				/>
			</fieldset>
		</PanelRow>
	), [ show_image ] );
}

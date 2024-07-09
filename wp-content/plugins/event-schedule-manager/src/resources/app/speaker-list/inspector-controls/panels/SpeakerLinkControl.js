import { _x } from '@wordpress/i18n';
import { PanelRow, SelectControl } from '@wordpress/components';
import { useMemo } from "react";

/**
 * Function to handle the change event of the speaker link control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {string}   newValue      The new value of the speaker link control.
 */
export function onChangeSpeakerLink( setAttributes, newValue ) {
	setAttributes( { speaker_link: newValue } );
}

/**
 * SpeakerLinkControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props                 The component props.
 * @param {Object} props.attributes      The block attributes.
 * @param {Object} props.setAttributes   Function to set the block attributes.
 */
export function SpeakerLinkControl( { attributes, setAttributes } ) {
	const { speaker_link } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<SelectControl
					label={ _x(
						'Speaker Link',
						'Label for the speaker link control',
						'event-schedule-manager'
					) }
					value={ speaker_link }
					options={ [
						{
							value: '',
							label: _x(
								'No Link',
								'Option for no speaker link',
								'event-schedule-manager'
							)
						},
						{
							value: 'permalink',
							label: _x(
								'Link to Single Speakers',
								'Option for linking to single speaker pages',
								'event-schedule-manager'
							)
						}
					] }
					onChange={ newValue => onChangeSpeakerLink( setAttributes, newValue ) }
					key='speaker-link-select'
				/>
			</fieldset>
		</PanelRow>
	), [ speaker_link ] );
}

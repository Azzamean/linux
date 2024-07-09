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
export function onChangeSponsorsLink( setAttributes, newValue ) {
	setAttributes( { link: newValue } );
}

/**
 * SponsorsLinkControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props                 The component props.
 * @param {Object} props.attributes      The block attributes.
 * @param {Object} props.setAttributes   Function to set the block attributes.
 */
export function SponsorsLinkControl( { attributes, setAttributes } ) {
	const { link } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<SelectControl
					label={ _x(
						'Sponsors Link',
						'Label for the sponsors link control',
						'event-schedule-manager'
					) }
					value={ link }
					options={ [
						{
							value: 'none',
							label: _x(
								'No Link',
								'Option for no sponsors link',
								'event-schedule-manager'
							)
						},
						{
							value: 'website',
							label: _x(
								"Link to Sponsor's Website",
								"The sponsor images and titles link to the sponsor's website URL",
								'event-schedule-manager'
							)
						},
						{
							value: 'post',
							label: _x(
								'Link to Sponsor Post',
								"The sponsor images and titles link to the individual sponsor's post",
								'event-schedule-manager'
							)
						}
					] }
					onChange={ newValue => onChangeSponsorsLink( setAttributes, newValue ) }
					key='sponsors-link-select'
				/>
			</fieldset>
		</PanelRow>
	), [ link ] );
}

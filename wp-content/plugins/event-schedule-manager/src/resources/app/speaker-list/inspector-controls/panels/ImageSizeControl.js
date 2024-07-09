import { _x } from '@wordpress/i18n';
import { PanelRow, TextControl } from '@wordpress/components';
import { useMemo } from "react";

/**
 * Function to handle the change event of the image size control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {string}   newImageSize  The new value of the image size control.
 */
export function onChangeImageSize( setAttributes, newImageSize ) {
	const parsedImageSize = parseInt( newImageSize, 10 );
	setAttributes( { image_size: parsedImageSize } );
}

/**
 * ImageSizeControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props               The component props.
 * @param {Object} props.attributes    The block attributes.
 * @param {Object} props.setAttributes Function to set the block attributes.
 */
export function ImageSizeControl( { attributes, setAttributes } ) {
	const { image_size } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<TextControl
					label={ _x(
						'Image Size',
						'Label for the image size control',
						'event-schedule-manager'
					) }
					type='number'
					value={ image_size }
					onChange={ newImageSize =>
						onChangeImageSize( setAttributes, newImageSize )
					}
					key='image-size-toggle'
				/>
			</fieldset>
		</PanelRow>
	), [ image_size ] );
}

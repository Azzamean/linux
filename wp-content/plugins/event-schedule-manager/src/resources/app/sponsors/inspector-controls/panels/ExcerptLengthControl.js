import { _x } from '@wordpress/i18n';
import { PanelRow, TextControl } from '@wordpress/components';
import { useMemo } from "react";

/**
 * Function to handle the change event of the excerpt length control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {string}   newExcerptLength  The new value of the excerpt length control.
 */
export function onChangeExcerptLength( setAttributes, newExcerptLength ) {
	const parsedExcerptLength = parseInt( newExcerptLength, 10 );
	setAttributes( { excerpt_length: parsedExcerptLength } );
}

/**
 * ExcerptLengthControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props               The component props.
 * @param {Object} props.attributes    The block attributes.
 * @param {Object} props.setAttributes Function to set the block attributes.
 */
export function ExcerptLengthControl( { attributes, setAttributes } ) {
	const { excerpt_length } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<TextControl
					label={ _x(
						'Excerpt Length',
						'Label for the excerpt length control',
						'event-schedule-manager'
					) }
					type='number'
					value={ excerpt_length }
					onChange={ newExcerptLength =>
						onChangeExcerptLength( setAttributes, newExcerptLength )
					}
					key='excerpt-length-toggle'
				/>
			</fieldset>
		</PanelRow>
	), [ excerpt_length ] );
}

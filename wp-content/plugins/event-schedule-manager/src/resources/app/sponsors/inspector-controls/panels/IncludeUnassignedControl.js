import { _x } from '@wordpress/i18n';
import { PanelRow, ToggleControl } from '@wordpress/components';
import { useMemo } from "react";

/**
 * Function to handle the change event of the include unassigned control.
 *
 * @since 1.2.0
 *
 * @param {Function} setAttributes Function to set the block attributes.
 * @param {boolean}  newValue      The new value of the include unassigned control.
 */
export function onChangeIncludeUnAssigned( setAttributes, newValue ) {
	setAttributes( { include_unassigned: newValue } );
}

/**
 * IncludeUnAssignedControl component.
 *
 * @since 1.2.0
 *
 * @param {Object} props                 The component props.
 * @param {Object} props.attributes      The block attributes.
 * @param {Object} props.setAttributes   Function to set the block attributes.
 */
export function IncludeUnAssignedControl( { attributes, setAttributes } ) {
	const { include_unassigned } = attributes;

	return useMemo( () => (
		<PanelRow>
			<fieldset>
				<legend className='blocks-base-control__label'>
					{ _x( 'Include Unassigned', 'Label for the include unassigned control', 'event-schedule-manager' ) }
				</legend>
				<ToggleControl
					label={ _x( 'Enable to show unassigned sponsors. (unassigned sponsors have no sponsor level)', 'Label for the include unassigned toggle', 'event-schedule-manager' ) }
					help={
						include_unassigned
							? _x( 'Unassigned Sponsors are showing.', 'Help text when unassigned sponsors are displayed', 'event-schedule-manager' )
							: _x( 'Unassigned Sponsors are hidden.', 'Help text when unassigned sponsors are hidden', 'event-schedule-manager' )
					}
					checked={ include_unassigned }
					onChange={ newValue => onChangeIncludeUnAssigned( setAttributes, newValue ) }
					key='include-unassigned-toggle'
				/>
			</fieldset>
		</PanelRow>
	), [ include_unassigned ] );
}

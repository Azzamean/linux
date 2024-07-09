import { _x } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';
import './panels/addDisplayFilters';
import { useProcessedDisplayPanelRows } from './inspectorFilters';

/**
 * SponsorsListInspector component.
 *
 * @since 1.2.0
 *
 * @param {Object} props           The component props.
 * @param {Object} props.attributes The block attributes.
 * @param {Object} props.setAttributes The function to update block attributes.
 *
 * @return {WPElement} The SponsorsListInspector component.
 */
export function SponsorsListInspector( { attributes, setAttributes } ) {
	const processedDisplayPanelRows = useProcessedDisplayPanelRows( attributes, setAttributes );

	return (
		<InspectorControls key="setting">
			<PanelBody title={_x( 'Display Options', 'Panel title for display options in sponsors block.', 'event-schedule-manager' )}>
				{processedDisplayPanelRows}
			</PanelBody>
		</InspectorControls>
	);
}

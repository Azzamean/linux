import { _x } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';
import './panels/addDisplayFilters';
import './panels/addQueryFilters';
import { useProcessedDisplayPanelRows, useProcessedQueryPanelRows } from './inspectorFilters';

/**
 * SpeakerListInspector component.
 *
 * @since 1.2.0
 *
 * @param {Object} props           The component props.
 * @param {Object} props.attributes The block attributes.
 * @param {Object} props.setAttributes The function to update block attributes.
 *
 * @return {WPElement} The SpeakerListInspector component.
 */
export function SpeakerListInspector( { attributes, setAttributes } ) {
	const processedDisplayPanelRows = useProcessedDisplayPanelRows( attributes, setAttributes );
	const processedQueryPanelRows = useProcessedQueryPanelRows( attributes, setAttributes );

	return (
		<InspectorControls key="setting">
			<PanelBody title={_x( 'Display Options', 'Panel title for display options', 'event-schedule-manager' )}>
				{processedDisplayPanelRows}
			</PanelBody>

			<PanelBody title={_x( 'Query and Filtering', 'Panel title for query and filtering options', 'event-schedule-manager' )}>
				{processedQueryPanelRows}
			</PanelBody>`
		</InspectorControls>
	);
}

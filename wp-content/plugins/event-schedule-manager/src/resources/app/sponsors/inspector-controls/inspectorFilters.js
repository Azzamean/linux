import { applyFilters } from '@wordpress/hooks';

/**
 * Utility function for sorting and mapping panel rows.
 *
 * @since 1.2.0
 *
 * @param {Array}  rows         The array of panel rows.
 * @param {Object} attributes   The block attributes.
 * @param {Object} setAttributes The function to update block attributes.
 *
 * @return {Array} The sorted and mapped array of panel rows.
 */
const processPanelRows = ( rows, attributes, setAttributes ) => {
	return rows.sort( ( a, b ) => a.priority - b.priority ).map( ( control, index ) => (
		<control.component
			key={ index }
			attributes={ attributes }
			setAttributes={ setAttributes }
			{ ...control.props }
		/>
	) );
};

/**
 * Exported hook to get processed display panel rows.
 *
 * @since 1.2.0
 *
 * @param {Object} attributes   The block attributes.
 * @param {Object} setAttributes The function to update block attributes.
 *
 * @return {Array} The array of processed display panel rows.
 */
export const useProcessedDisplayPanelRows = ( attributes, setAttributes ) => {
	/**
	 * Filter the panel rows for display options in the sponsors block inspector.
	 *
	 * @since 1.2.0
	 *
	 * @param {Array}  rows        The array of panel rows.
	 * @param {Object} attributes  The block attributes.
	 * @param {Object} setAttributes The function to update block attributes.
	 *
	 * @return {Array} The modified array of panel rows for display options.
	 */
	const inspectorControlsDisplay = applyFilters(
		'tec-event-schedule-manager.sponsors.block-inspector-panel-rows.display',
		[],
		attributes,
		setAttributes
	);

	return processPanelRows( inspectorControlsDisplay, attributes, setAttributes );
};

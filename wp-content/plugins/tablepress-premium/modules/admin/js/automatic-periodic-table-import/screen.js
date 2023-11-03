/**
 * JavaScript code for the "Automatic Periodic Table Import Screen" component.
 *
 * @package TablePress
 * @subpackage Automatic Periodic Table Import Screen
 * @author Tobias Bäthge
 * @since 2.2.0
 */

/* globals tp */

/**
 * WordPress dependencies.
 */
import { useState } from 'react';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies.
 */
import { $ } from '../../../../admin/js/common/functions';
import { save_changes as saveChanges } from '../common/save-changes';
import naturalSort from '../../../../admin/js/edit/naturalsort';

/**
 * Saves the Automatic Periodic Table Import configuration to the server.
 *
 * @param {HTMLElement} domNode    DOM node into which to insert the spinner and notice.
 * @param {Object}      screenData Automatic Periodic Table Import configuration.
 */
const saveAutomaticPeriodicTableImportConfig = ( domNode, screenData ) => {
	const tables = Object.fromEntries( Object.entries( screenData.tables )
		// Only save the config for tables that have changes and not just the default settings.
		.filter( ( [ , table ] ) => ( table.active || 'url' !== table.source || 'https://' !== table.location ) )
		// Don't save the "last_import" property.
		.map( ( [ tableId, table ] ) => {
			delete table.last_import;
			return [ tableId, table ];
		} )
	);

	// Gather the Automatic Periodic Table Import configuration.
	const automaticPeriodicTableImportConfig = {
		schedule: screenData.schedule,
		tables,
	};

	// Prepare the data for the AJAX request.
	const requestData = {
		action: 'tablepress_import',
		_ajax_nonce: $( '#_wpnonce' ).value,
		tablepress: JSON.stringify( automaticPeriodicTableImportConfig ),
	};

	saveChanges( domNode, requestData );
};

// Ensure that all tables have a configuration.
tp.automatic_periodic_table_import.tables = Object.fromEntries( Object.keys( tp.import.tables ).map( ( tableId ) => {
	const tableImportConfig = {
		active: false,
		source: 'url',
		location: 'https://',
		last_import: '-',
		...tp.automatic_periodic_table_import.tables[ tableId ],
	};
	return [ tableId, tableImportConfig ];
} ) );

/**
 * Returns the "Automatic Periodic Table Import Screen" component's JSX markup.
 *
 * @return {Object} Automatic Periodic Table Import Screen component.
 */
const AutomaticPeriodicTableImportScreen = () => {
	const [ screenData, setScreenData ] = useState( {
		schedule: tp.automatic_periodic_table_import.schedule,
		tables: tp.automatic_periodic_table_import.tables,
		lastCheckboxTableId: null,
		searchTerm: '',
		sort: {
			column: -1, // -1 means no sorting, 0 for table ID, 1 for table name.
			direction: 1, // 1 for descending, -1 for ascending.
		},
	} );

	let tablesToRender = Object.entries( screenData.tables );
	if ( '' !== screenData.searchTerm ) {
		tablesToRender = tablesToRender.filter( ( [ tableId, ] ) => (
			tp.import.tables[ tableId ].toLowerCase().includes( screenData.searchTerm.toLowerCase() )
		) );
	}
	if ( -1 !== screenData.sort.column ) {
		tablesToRender.sort( ( [ tableIdA, ], [ tableIdB, ] ) => {
			let sortDataA = tableIdA;
			let sortDataB = tableIdB;
			if ( 1 === screenData.sort.column ) {
				sortDataA = tp.import.tables[ tableIdA ];
				sortDataB = tp.import.tables[ tableIdB ];
			}
			return screenData.sort.direction * naturalSort( sortDataA, sortDataB );
		} );
	}

	/**
	 * Handles screen data state changes.
	 *
	 * @param {string}      item  Configuration item name.
	 * @param {string|null} value Value for configuration item.
	 */
	const updateScreenData = ( item, value ) => {
		const newScreenData = {
			...screenData,
			[ item ]: value,
		};
		setScreenData( newScreenData );
	};

	// Create the "Save Automatic Import configuration" button once, so that it can be used in multiple places.
	const submitButton = (
		<p className="submit">
			<input
				type="button"
				className="button button-secondary button-large button-save-changes"
				value={ __( 'Save Automatic Import configuration', 'tablepress' ) }
				onClick={ ( event ) => saveAutomaticPeriodicTableImportConfig( event.target.parentNode, screenData ) }
			/>
		</p>
	);

	return (
		<>
			<p>
				{ __( 'To periodically import tables from files that were uploaded to a server, configure the desired interval and table source information below.', 'tablepress' ) }
			</p>
			<p>
				<label htmlFor="auto-import-schedule">
					{ __( 'Perform Automatic Periodic Table Import:', 'tablepress' ) + ' ' }
				</label>
				<select
					id="auto-import-schedule"
					value={ screenData.schedule }
					onChange={ ( event ) => updateScreenData( 'schedule', event.target.value ) }
				>
					{
						Object.entries( tp.automatic_periodic_table_import.cronSchedules ).map( ( [ name, cronSchedule ] ) =>
							<option key={ name } value={ name }>{ cronSchedule.display }</option>
						)
					}
				</select>
			</p>
			<p className="description">
				{ __( 'Please note: In general, it is recommended to use a reasonably long interval, to reduce traffic on the import source server.', 'tablepress' ) + ' ' + __( 'In addition, it is recommended to set up a suitable server cron job that replaces the WP Cron system, for improved reliability.', 'tablepress' ) }
			</p>
			{ submitButton }
			<p
				className="search-box"
				style={ {
					paddingBottom: '0.5em',
				} }
			>
				<label htmlFor="tables_search-search-input">{ __( 'Filter list:', 'tablepress' ) }</label>
				<input
					id="tables_search-search-input"
					type="search"
					value={ screenData.searchTerm }
					onChange={ ( event ) => updateScreenData( 'searchTerm', event.target.value ) }
					style={ {
						marginLeft: '0.5em',
					} }
				/>
			</p>
			<table id="tablepress-automatic-periodic-import-tables" className="widefat striped">
				<thead>
					<tr>
						<th
							className={ 0 === screenData.sort.column ? `sorted ${ 1 === screenData.sort.direction ? 'desc' : 'asc' }` : 'sortable desc' }
							style={ {
								minWidth: '50px',
							} }
						>
							{ /* eslint-disable-next-line jsx-a11y/anchor-is-valid */ }
							<a
								href=""
								role="button"
								onClick={ ( event ) => {
									event.preventDefault();
									updateScreenData( 'sort', {
										column: 0,
										direction: event.target.closest( 'th' ).classList.contains( 'desc' ) ? -1 : 1,
									} );
								} }
							>
								<span>{ __( 'ID', 'tablepress' ) }</span>
								<span className="sorting-indicators">
									<span className="sorting-indicator asc" aria-hidden="true"></span>
									<span className="sorting-indicator desc" aria-hidden="true"></span>
								</span>
							</a>
						</th>
						<th
							className={ 1 === screenData.sort.column ? `sorted ${ 1 === screenData.sort.direction ? 'desc' : 'asc' }` : 'sortable desc' }
							style={ {
								minWidth: '120px',
							} }
						>
							{ /* eslint-disable-next-line jsx-a11y/anchor-is-valid */ }
							<a
								href=""
								role="button"
								onClick={ ( event ) => {
									event.preventDefault();
									updateScreenData( 'sort', {
										column: 1,
										direction: event.target.closest( 'th' ).classList.contains( 'desc' ) ? -1 : 1,
									} );
								} }
							>
								<span>{ __( 'Table Name', 'tablepress' ) }</span>
								<span className="sorting-indicators">
									<span className="sorting-indicator asc" aria-hidden="true"></span>
									<span className="sorting-indicator desc" aria-hidden="true"></span>
								</span>
							</a>
						</th>
						<th>
							{ __( 'Periodic Import', 'tablepress' ) }
							<br />
							<label htmlFor="auto-import-select-all-thead">
								<input
									type="checkbox"
									id="auto-import-select-all-thead"
									checked={ 0 < tablesToRender.length && tablesToRender.every( ( [ , table ] ) => table.active ) }
									disabled={ 0 === tablesToRender.length }
									onChange={ ( event ) => {
										const changedTables = Object.fromEntries( tablesToRender.map( ( [ tableId, table ] ) => (
											[ tableId, { ...table, active: event.target.checked } ]
										) ) );
										const tables = { ...screenData.tables, ...changedTables };
										updateScreenData( 'tables', tables );
									} }
								/> { __( 'Select All' ) }
							</label>
						</th>
						<th>{ __( 'Import Source', 'tablepress' ) }</th>
						<th className="auto-import-location">{ __( 'Import File Location', 'tablepress' ) }</th>
						<th>{ __( 'Last Automatic Import', 'tablepress' ) }</th>
					</tr>
				</thead>
				<tbody>
					{
						0 === tablesToRender.length
						? (
							<tr>
								<td colSpan="6">
									{ __( 'No tables found.', 'tablepress' ) }
								</td>
							</tr>
						)
						: tablesToRender.map( ( [ tableId, tableConfig ] ) => (
							<tr key={ tableId }>
								<td>{ tableId }</td>
								<td>
									<strong>
										{ '' === tp.import.tables[ tableId ].trim() ? __( '(no name)', 'tablepress' ) : tp.import.tables[ tableId ]	}
									</strong>
								</td>
								<td>
									<input
										type="checkbox"
										checked={ tableConfig.active }
										onChange={ ( event ) => {
											const tableIds = tablesToRender.map( ( [ renderTableId, ] ) => renderTableId );

											// Find index of the current table ID, as these are not in consecutive order.
											const currentCheckboxIdx = tableIds.indexOf( tableId );

											// Retrieve the last pressed checkbox table ID from screen data state and find the checkbox position.
											let lastCheckboxIdx = tableIds.indexOf( screenData.lastCheckboxTableId );

											// If no checkbox had been pressed before, or if the Shift key was not held, only change the current checkbox.
											if ( null === screenData.lastCheckboxTableId || ! event.nativeEvent.shiftKey ) {
												lastCheckboxIdx = currentCheckboxIdx;
											}

											// Determine first and last table ID indices, as these determine the range of checkboxes.
											const firstIdx = ( lastCheckboxIdx < currentCheckboxIdx ) ? lastCheckboxIdx : currentCheckboxIdx;
											const lastIdx = ( currentCheckboxIdx > lastCheckboxIdx ) ? currentCheckboxIdx : lastCheckboxIdx;

											// Loop over the range and activate/deactivate all in that range, to also toggle their checkbox.
											const changedTables = Object.fromEntries( tablesToRender );
											for ( let tableIdIdx = firstIdx; tableIdIdx <= lastIdx; tableIdIdx++ ) {
												const checkboxTableId = tableIds[ tableIdIdx ];
												changedTables[ checkboxTableId ].active = event.target.checked;
											}
											const tables = { ...screenData.tables, ...changedTables };
											updateScreenData( 'tables', tables );

											// After processing the clicks, the current checkbox is the last clicked checkbox.
											updateScreenData( 'lastCheckboxTableId', tableId );
										} }
									/>
								</td>
								<td>
									<select
										disabled={ ! tableConfig.active }
										value={ tableConfig.source }
										onChange={ ( event ) => {
											const tables = { ...screenData.tables };
											tables[ tableId ].source = event.target.value;
											// Switch default values if they haven't been changed.
											if ( 'url' === tables[ tableId ].source && tp.automatic_periodic_table_import.ABSPATH === tables[ tableId ].location ) {
												tables[ tableId ].location = 'https://';
											} else if ( 'server' === tables[ tableId ].source && 'https://' === tables[ tableId ].location ) {
												tables[ tableId ].location = tp.automatic_periodic_table_import.ABSPATH;
											}
											updateScreenData( 'tables', tables );
										} }
									>
										<option value="url">{ __( 'URL', 'tablepress' ) }</option>
										<option value="server">{ __( 'File', 'tablepress' ) }</option>
									</select>
								</td>
								<td className="auto-import-location">
									<input
										type="text"
										className="large-text code"
										disabled={ ! tableConfig.active }
										value={ tableConfig.location }
										onChange={ ( event ) => {
											const tables = { ...screenData.tables };
											tables[ tableId ].location = event.target.value;
											updateScreenData( 'tables', tables );
										} }
									/>
								</td>
								<td dangerouslySetInnerHTML={ {
									__html: tableConfig.last_import
								} } />
							</tr>
						) )
					}
				</tbody>
				<tfoot>
					<tr>
						<th>{ __( 'ID', 'tablepress' ) }</th>
						<th>{ __( 'Table Name', 'tablepress' ) }</th>
						<th>
							{ __( 'Periodic Import', 'tablepress' ) }
							<br />
							<label htmlFor="auto-import-select-all-tfoot">
								<input
									type="checkbox"
									id="auto-import-select-all-tfoot"
									checked={ 0 < tablesToRender.length && tablesToRender.every( ( [ , table ] ) => table.active ) }
									disabled={ 0 === tablesToRender.length }
									onChange={ ( event ) => {
										const changedTables = Object.fromEntries( tablesToRender.map( ( [ tableId, table ] ) => (
											[ tableId, { ...table, active: event.target.checked } ]
										) ) );
										const tables = { ...screenData.tables, ...changedTables };
										updateScreenData( 'tables', tables );
									} }
								/> { __( 'Select All' ) }
							</label>
						</th>
						<th>{ __( 'Import Source', 'tablepress' ) }</th>
						<th>{ __( 'Import File Location', 'tablepress' ) }</th>
						<th>{ __( 'Last Automatic Import', 'tablepress' ) }</th>
					</tr>
				</tfoot>
			</table>
			{ submitButton }
		</>
	);
};

export default AutomaticPeriodicTableImportScreen;

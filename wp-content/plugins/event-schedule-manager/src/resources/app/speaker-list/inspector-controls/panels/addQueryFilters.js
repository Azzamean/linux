import { addFilter } from '@wordpress/hooks';
import { DisplayCountControl, onChangeDisplayCount } from './DisplayCountControl';
import { OrderByControl, onChangeOrderBy } from './OrderByControl';
import { OrderControl, onChangeOrder } from './OrderControl';
import { TrackTaxonomyTokenField } from './TrackTaxonomyTokenField';
import { GroupTaxonomyTokenField } from './GroupTaxonomyTokenField';

/**
 * Filter function to add the DisplayCountControl to the query panel rows.
 *
 * @since 1.2.0
 *
 * @param {Array}  panels       The array of panel rows.
 * @param {Object} attributes   The block attributes.
 * @param {Object} setAttributes Function to set the block attributes.
 *
 * @return {Array} The modified array of panel rows.
 */
addFilter(
	'tec-event-schedule-manager.speaker-list.block-inspector-panel-rows.query',
	'event-schedule-manager/speaker-list/display-count-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: DisplayCountControl,
				priority: 30,
				props: {
					attributes,
					setAttributes,
					onChangeDisplayCount: ( newValue ) => onChangeDisplayCount( setAttributes, newValue ),
				},
			},
		];
	}
);

/**
 * Filter function to add the OrderByControl to the query panel rows.
 *
 * @since 1.2.0
 *
 * @param {Array}  panels       The array of panel rows.
 * @param {Object} attributes   The block attributes.
 * @param {Object} setAttributes Function to set the block attributes.
 *
 * @return {Array} The modified array of panel rows.
 */
addFilter(
	'tec-event-schedule-manager.speaker-list.block-inspector-panel-rows.query',
	'event-schedule-manager/speaker-list/order-by-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: OrderByControl,
				priority: 40,
				props: {
					attributes,
					setAttributes,
					onChangeOrderBy: ( newValue ) => onChangeOrderBy( setAttributes, newValue ),
				},
			},
		];
	}
);

/**
 * Filter function to add the OrderControl to the query panel rows.
 *
 * @since 1.2.0
 *
 * @param {Array}  panels       The array of panel rows.
 * @param {Object} attributes   The block attributes.
 * @param {Object} setAttributes Function to set the block attributes.
 *
 * @return {Array} The modified array of panel rows.
 */
addFilter(
	'tec-event-schedule-manager.speaker-list.block-inspector-panel-rows.query',
	'event-schedule-manager/speaker-list/order-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: OrderControl,
				priority: 50,
				props: {
					attributes,
					setAttributes,
					onChangeOrder: ( newValue ) => onChangeOrder( setAttributes, newValue ),
				},
			},
		];
	}
);

/**
 * Filter function to add the track taxonomy token field to the query panel rows.
 *
 * @since 1.2.0
 *
 * @param {Array}  panels       The array of panel rows.
 * @param {Object} attributes   The block attributes.
 * @param {Object} setAttributes Function to set the block attributes.
 *
 * @return {Array} The modified array of panel rows.
 */
addFilter(
	'tec-event-schedule-manager.speaker-list.block-inspector-panel-rows.query',
	'event-schedule-manager/speaker-list/track-taxonomy-token-field',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: TrackTaxonomyTokenField,
				priority: 60,
				props: {
					attributes,
					setAttributes,
				},
			},
		];
	}
);

/**
 * Filter function to add the group taxonomy token field to the query panel rows.
 *
 * @since 1.2.0
 *
 * @param {Array}  panels       The array of panel rows.
 * @param {Object} attributes   The block attributes.
 * @param {Object} setAttributes Function to set the block attributes.
 *
 * @return {Array} The modified array of panel rows.
 */
addFilter(
	'tec-event-schedule-manager.speaker-list.block-inspector-panel-rows.query',
	'event-schedule-manager/speaker-list/group-taxonomy-token-field',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: GroupTaxonomyTokenField,
				priority: 70,
				props: {
					attributes,
					setAttributes,
				},
			},
		];
	}
);

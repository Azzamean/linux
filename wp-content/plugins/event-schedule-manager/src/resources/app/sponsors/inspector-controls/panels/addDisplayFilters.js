import { addFilter } from '@wordpress/hooks';
import { SponsorsLinkControl, onChangeSponsorsLink } from './SponsorsLinkControl';
import { ContentControl, onChangeContent } from './ContentControl';
import { ExcerptLengthControl, onChangeExcerptLength } from './ExcerptLengthControl';
import { HeadingLevelControl, onChangeHeadingLevel } from './HeadingLevelControl';
import { IncludeUnAssignedControl, onChangeIncludeUnAssigned } from './IncludeUnassignedControl';
import { TitleControl, onChangeTitle } from './TitleControl';

/**
 * Filter function to add the SponsorsLinkControl to the display panel rows.
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
	'tec-event-schedule-manager.sponsors.block-inspector-panel-rows.display',
	'event-schedule-manager/sponsors/sponsors-link-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: SponsorsLinkControl,
				priority: 30,
				props: {
					attributes,
					setAttributes,
					onChangeSponsorsLink: ( newValue ) => onChangeSponsorsLink( setAttributes, newValue ),
				},
			},
		];
	}
);

/**
 * Filter function to add the TitleControl to the display panel rows.
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
	'tec-event-schedule-manager.sponsors.block-inspector-panel-rows.display',
	'event-schedule-manager/sponsors/title-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: TitleControl,
				priority: 40,
				props: {
					attributes,
					setAttributes,
					onChangeTitle: ( newValue ) => onChangeTitle( setAttributes, newValue ),
				},
			},
		];
	}
);

/**
 * Filter function to add the ContentControl to the display panel rows.
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
	'tec-event-schedule-manager.sponsors.block-inspector-panel-rows.display',
	'event-schedule-manager/sponsors/content-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: ContentControl,
				priority: 50,
				props: {
					attributes,
					setAttributes,
					onChangeContent: ( newValue ) => onChangeContent( setAttributes, newValue ),
				},
			},
		];
	}
);

/**
 * Filter function to add the ExcerptLengthControl to the display panel rows.
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
	'tec-event-schedule-manager.sponsors.block-inspector-panel-rows.display',
	'event-schedule-manager/sponsors/excerpt-length-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: ExcerptLengthControl,
				priority: 60,
				props: {
					attributes,
					setAttributes,
					onChangeExcerptLength: ( newValue ) => onChangeExcerptLength( setAttributes, newValue ),
				},
			},
		];
	}
);

/**
 * Filter function to add the HeadingLevelControl to the display panel rows.
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
	'tec-event-schedule-manager.sponsors.block-inspector-panel-rows.display',
	'event-schedule-manager/sponsors/heading-level-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: HeadingLevelControl,
				priority: 70,
				props: {
					attributes,
					setAttributes,
					onChangeHeadingLevel: ( newValue ) => onChangeHeadingLevel( setAttributes, newValue ),
				},
			},
		];
	}
);

/**
 * Filter function to add the IncludeUnAssignedControl to the display panel rows.
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
	'tec-event-schedule-manager.sponsors.block-inspector-panel-rows.display',
	'event-schedule-manager/sponsors/include-unassigned-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: IncludeUnAssignedControl,
				priority: 80,
				props: {
					attributes,
					setAttributes,
					onChangeIncludeUnAssigned: ( newValue ) => onChangeIncludeUnAssigned( setAttributes, newValue ),
				},
			},
		];
	}
);

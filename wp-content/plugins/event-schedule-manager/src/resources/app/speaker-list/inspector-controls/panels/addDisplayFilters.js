import { addFilter } from '@wordpress/hooks';
import { ImageSizeControl, onChangeImageSize } from './ImageSizeControl';
import { ShowImageControl, onChangeShowImage } from './ShowImageControl';
import { ShowContentControl, onChangeShowContent } from './ShowContentControl';
import { SpeakerLinkControl, onChangeSpeakerLink } from './SpeakerLinkControl';
import { ColumnSizeControl, onChangeColumnSize } from './ColumnSizeControl';
import { GridGapControl, onChangeGridGap } from './GridGapControl';
import { TextAlignmentControl, onChangeTextAlignment } from './TextAlignmentControl';

/**
 * Filter function to add the ImageSizeControl to the display panel rows.
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
	'tec-event-schedule-manager.speaker-list.block-inspector-panel-rows.display',
	'event-schedule-manager/speaker-list/image-size-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: ImageSizeControl,
				priority: 20,
				props: {
					attributes,
					setAttributes,
					onChangeImageSize: ( newImageSize ) => onChangeImageSize( setAttributes, newImageSize ),
				},
			},
		];
	}
);

/**
 * Filter function to add the ShowImageControl to the display panel rows.
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
	'tec-event-schedule-manager.speaker-list.block-inspector-panel-rows.display',
	'event-schedule-manager/speaker-list/show-image-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: ShowImageControl,
				priority: 10,
				props: {
					attributes,
					setAttributes,
					onChangeShowImage: ( newValue ) => onChangeShowImage( setAttributes, newValue ),
				},
			},
		];
	}
);

/**
 * Filter function to add the ShowContentControl to the display panel rows.
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
	'tec-event-schedule-manager.speaker-list.block-inspector-panel-rows.display',
	'event-schedule-manager/speaker-list/show-content-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: ShowContentControl,
				priority: 30,
				props: {
					attributes,
					setAttributes,
					onChangeShowContent: ( newValue ) => onChangeShowContent( setAttributes, newValue ),
				},
			},
		];
	}
);

/**
 * Filter function to add the SpeakerLinkControl to the display panel rows.
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
	'tec-event-schedule-manager.speaker-list.block-inspector-panel-rows.display',
	'event-schedule-manager/speaker-list/speaker-link-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: SpeakerLinkControl,
				priority: 40,
				props: {
					attributes,
					setAttributes,
					onChangeSpeakerLink: ( newValue ) => onChangeSpeakerLink( setAttributes, newValue ),
				},
			},
		];
	}
);

/**
 * Filter function to add the ColumnSizeControl to the display panel rows.
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
	'tec-event-schedule-manager.speaker-list.block-inspector-panel-rows.display',
	'event-schedule-manager/speaker-list/column-size-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: ColumnSizeControl,
				priority: 50,
				props: {
					attributes,
					setAttributes,
					onChangeColumnSize: ( newValue ) => onChangeColumnSize( setAttributes, newValue ),
				},
			},
		];
	}
);

/**
 * Filter function to add the GridGapControl to the display panel rows.
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
	'tec-event-schedule-manager.speaker-list.block-inspector-panel-rows.display',
	'event-schedule-manager/speaker-list/grid-gap-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: GridGapControl,
				priority: 60,
				props: {
					attributes,
					setAttributes,
					onChangeGridGap: ( newValue ) => onChangeGridGap( setAttributes, newValue ),
				},
			},
		];
	}
);

/**
 * Filter function to add the TextAlignmentControl to the display panel rows.
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
	'tec-event-schedule-manager.speaker-list.block-inspector-panel-rows.display',
	'event-schedule-manager/speaker-list/text-alignment-control',
	( panels, attributes, setAttributes ) => {
		return [
			...panels,
			{
				component: TextAlignmentControl,
				priority: 70,
				props: {
					attributes,
					setAttributes,
					onChangeTextAlignment: ( newValue ) => onChangeTextAlignment( setAttributes, newValue ),
				},
			},
		];
	}
);

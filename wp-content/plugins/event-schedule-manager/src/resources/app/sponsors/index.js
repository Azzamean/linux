import { registerBlockType } from '@wordpress/blocks';
import { _x } from "@wordpress/i18n";
import Edit from './edit';
import metadata from './block.json';
import {} from '../utilities/category-icon';
import { SponsorsIcon } from "./assets/icon";

registerBlockType( metadata.name, {
	...metadata,
	description: _x( 'Displays the sponsors.', 'The sponsors block description.', 'event-schedule-manager' ),
	icon: SponsorsIcon,
	edit: Edit,
	save() {
		return null;
	},
} );
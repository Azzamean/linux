import { registerBlockType } from '@wordpress/blocks';
import { _x } from "@wordpress/i18n";
import Edit from './edit';
import metadata from './block.json';
import { SpeakerListIcon } from "./assets/icon";

registerBlockType( metadata.name, {
	...metadata,
	description: _x( "Displays the speaker's list.", 'The speaker list block description.', 'event-schedule-manager' ),
	icon: SpeakerListIcon,
	edit: Edit,
	save() {
		return null;
	},
} );
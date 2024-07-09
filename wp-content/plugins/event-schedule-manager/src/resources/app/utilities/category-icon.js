import { updateCategory } from '@wordpress/blocks';
import { EventScheduleManagerIcon } from "./assets/icon";

( function() {
	updateCategory( 'event-schedule-manager', {
		icon: EventScheduleManagerIcon
	} );
} )();
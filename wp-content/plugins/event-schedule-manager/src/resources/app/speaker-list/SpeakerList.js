import { useQuery, QueryClient, QueryClientProvider } from '@tanstack/react-query';
import PlaceholderLoading from 'react-placeholder-loading';
import { applyFilters } from '@wordpress/hooks';
import { _x } from '@wordpress/i18n';
import { SpeakerListIcon } from "./assets/icon";

// Create a QueryClient instance
const queryClient = new QueryClient();

/**
 * Builds the URL for fetching speaker data from the REST API.
 *
 * @since 1.2.0
 *
 * @param {Object} params    The query parameters for the API request.
 *
 * @return {string}         The URL for fetching speaker data.
 */
function buildSpeakerListUrl( params ) {
	let sponsorsUrl = window.location.origin + '/wp-json/tec/esm/v1/speaker-list';

	if (
		typeof tec_event_schedule_manager_speaker_list_data !== 'undefined' &&
		tec_event_schedule_manager_speaker_list_data.sponsors_url
	) {
		sponsorsUrl = tec_event_schedule_manager_speaker_list_data.speaker_list_url;
	}

	const url = new URL( sponsorsUrl );
	url.search = new URLSearchParams( params ).toString();
	return url;
}

/**
 * SpeakerList component.
 *
 * @since 1.2.0
 *
 * @param {Object}  props                           The component props.
 * @param {Object}  props.attributes                The block attributes.
 * @param {boolean} props.attributes.show_image     Whether to show the speaker image.
 * @param {number}  props.attributes.image_size     The size of the speaker image.
 * @param {number}  props.attributes.posts_per_page The number of speakers to display per page.
 * @param {string}  props.attributes.orderby        The field to order the speakers by.
 * @param {string}  props.attributes.order          The order direction (asc or desc).
 * @param {string}  props.attributes.speaker_link   The type of link to display for each speaker.
 * @param {Array}   props.attributes.track          The selected tracks for filtering speakers.
 * @param {Array}   props.attributes.groups         The selected groups for filtering speakers.
 * @param {number}  props.attributes.columns        The number of columns in the speaker grid.
 * @param {number}  props.attributes.gap            The gap between speakers in the grid.
 * @param {string}  props.attributes.align          The text alignment of the speaker content.
 * @param {boolean} props.attributes.show_content   Whether to show the speaker description.
 *
 * @return {JSX.Element} The rendered SpeakerList component.
 */
export default function SpeakerList( { attributes } ) {
	const {
		show_image,
		image_size,
		posts_per_page,
		orderby,
		order,
		speaker_link,
		track,
		groups,
		columns,
		gap,
		align,
		show_content
	 } = attributes;

	/**
	 * Filters the query arguments used for fetching speakers.
	 *
	 * @since 1.2.0
	 *
	 * @param {Object} queryArgs    The default query arguments.
	 * @param {Object} attributes   The block attributes.
	 *
	 * @return {Object} The filtered query arguments.
	 */
	const queryArgs = applyFilters(
		'tec-event-schedule-manager.speaker-list.query-arguments',
		{
			posts_per_page,
			order,
			orderby,
			image_size,
			track,
			groups,
		},
		attributes
	);

	/**
	 * Fetches the speaker data from the REST API.
	 *
	 * @since 1.2.0
	 *
	 * @return {Promise<Array>} A promise that resolves to an array of speakers.
	 */
	const fetchSpeakers = async () => {
		const response = await fetch( buildSpeakerListUrl( queryArgs ) );
		if ( !response.ok ) {
			throw new Error( _x( 'Failed to fetch speaker data. Please try again.', 'Failed speaker list fetch message.', 'event-schedule-manager' ) );
		}
		return response.json();
	};

	/**
	 * SpeakerListContent component.
	 *
	 * @since 1.2.0
	 *
	 * @return {JSX.Element} The rendered SpeakerListContent component.
	 */
	const SpeakerListContent = () => {
		const { isLoading, error, data: speakers } = useQuery( {
			queryKey: [ 'speakers', posts_per_page, order, orderby, track, groups ],
			queryFn: fetchSpeakers,
		} );

		if ( isLoading ) {
			return (
				<div className="tec-speakers-loading" style={ { display: 'grid', gridTemplateColumns: 'repeat(2, 1fr)', gridGap: `${ gap }px` } }>
					{ Array.from( { length: 4 } ).map( ( _, index ) => (
						<div key={ index }>
							<PlaceholderLoading shape="rect" width={ image_size } height={ image_size }/>
							<PlaceholderLoading shape="rect" width={ 200 } height={ 20 }/>
							<PlaceholderLoading shape="rect" width={ 150 } height={ 15 }/>
						</div>
					) ) }
				</div>
			);
		}

		if ( error ) {
			return `An error has occurred: ${ error.message }`;
		}

		if ( speakers.length === 0 ) {
			return (
				<div className="tec-event-schedule-manager__schedule-block--message-wrap">
					<div className="tec-event-schedule-manager__schedule-block-message-title-wrap">
						<SpeakerListIcon width={32} height={32} />
						<h2>
							{ _x( 'Speakers', 'No speakers found title admin speaker list block.', 'event-schedule-manager' ) }
						</h2>
					</div>
					{ _x( 'No Speakers Found, please create at least one speaker or change the settings in the Query and Filtering panel. ', 'No speakers found message in the admin speaker list block.', 'event-schedule-manager' ) }
					<a href="https://evnt.is/1bdo" className="tec-event-schedule-manager__schedule-block-message--link" target="_blank">
						{ _x( 'Learn more', 'Link text for no speakers found message.', 'event-schedule-manager' ) }
					</a>
				</div>
			);
		}

		return (
			<div className="tec-speakers" style={ { textAlign: align, display: 'grid', gridTemplateColumns: `repeat(${ columns }, 1fr)`, gridGap: `${ gap }px` } }>
				{ speakers.map( ( speaker ) => {
					const {
						id,
						link,
						full_name,
						image_url,
						title_organization,
						speaker_classes,
						content
					} = speaker;

					return (
						<div key={ id } className={ speaker_classes.join( ' ' ) }>
							{ show_image && image_url && (
								<img src={ image_url } alt={ full_name } className="tec-speaker-image" width={ image_size } height={ image_size }/>
							) }
							<h2 className="tec-speaker-name">
								{ speaker_link === 'permalink' ? (
									<a href={ link }>{ full_name }</a>
								) : (
									full_name
								) }
							</h2>
							{ title_organization.length > 0 && (
								<p className="tec-speaker-title-organization">{ title_organization.join( ', ' ) }</p>
							) }
							{ show_content && (
								<div className="tec-speaker-description" dangerouslySetInnerHTML={ { __html: content } }/>
							) }
						</div>
					);
				} ) }
			</div>
		);
	};

	return (
		<QueryClientProvider client={ queryClient }>
			<SpeakerListContent/>
		</QueryClientProvider>
	);
}

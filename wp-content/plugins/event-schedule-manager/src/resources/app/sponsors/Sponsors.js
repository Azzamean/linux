import { useQuery, QueryClient, QueryClientProvider } from '@tanstack/react-query';
import PlaceholderLoading from 'react-placeholder-loading';
import { applyFilters } from '@wordpress/hooks';
import { _x } from '@wordpress/i18n';

// Create a QueryClient instance
const queryClient = new QueryClient();

/**
 * Builds the URL for fetching sponsors data from the REST API.
 *
 * @since 1.2.0
 *
 * @param {Object} params    The query parameters for the API request.
 *
 * @return {string}         The URL for fetching sponsors data.
 */
function buildSponsorsUrl( params ) {
	let sponsorsUrl = window.location.origin + '/wp-json/tec/esm/v1/sponsors';

	if (
		typeof tec_event_schedule_manager_sponsors_data !== 'undefined' &&
		tec_event_schedule_manager_sponsors_data.sponsors_url
	) {
		sponsorsUrl = tec_event_schedule_manager_sponsors_data.sponsors_url;
	}

	const url = new URL( sponsorsUrl );
	url.search = new URLSearchParams( params ).toString();
	return url;
}

/**
 * Sponsors component.
 *
 * @since 1.2.0
 *
 * @param {Object}  props                           The component props.
 * @param {Object}  props.attributes                The block attributes.
 * @param {boolean} props.attributes.link
 *
 * @return {JSX.Element} The rendered Sponsors component.
 */
export default function Sponsors( { attributes } ) {
	const {
		link,
		title,
		content,
		excerpt_length,
		heading_level,
		include_unassigned
	} = attributes;

	/**
	 * Filters the query arguments used for fetching sponsors.
	 *
	 * @since 1.2.0
	 *
	 * @param {Object} queryArgs    The default query arguments.
	 * @param {Object} attributes   The block attributes.
	 *
	 * @return {Object} The filtered query arguments.
	 */
	const queryArgs = applyFilters(
		'tec-event-schedule-manager.sponsors.query-arguments',
		{
			excerpt_length,
			include_unassigned,
		},
		attributes
	);

	/**
	 * Fetches the sponsors data from the REST API.
	 *
	 * @since 1.2.0
	 *
	 * @return {Promise<Array>} A promise that resolves to an array of sponsors.
	 */
	const fetchSponsors = async () => {
		const response = await fetch( buildSponsorsUrl( queryArgs ) );
		if ( !response.ok ) {
			throw new Error( _x( 'Failed to fetch sponsors data. Please try again.', 'Failed sponsors fetch message.', 'event-schedule-manager' ) );
		}
		return response.json();
	};

	/**
	 * SponsorsContent component.
	 *
	 * @since 1.2.0
	 *
	 * @return {JSX.Element} The rendered SponsorsContent component.
	 */
	const SponsorsContent = () => {
		const { isLoading, error, data: sponsors } = useQuery( {
			queryKey: [ 'sponsors', excerpt_length, include_unassigned ],
			queryFn: fetchSponsors,
		} );

		if ( isLoading ) {
			return (
				<div className="tec-sponsors-loading tec-sponsors">
					{ Array.from( { length: 2 } ).map( ( _, index ) => (
						<div key={ `sponsor-level-${ index }` } className="tec-sponsor-level">
							<h2 className="tec-sponsor-level-heading">
								<PlaceholderLoading shape="rect" width={ 140 } height={ 30 }/>
							</h2>
							<ul className="tec-sponsor-list">
								{ Array.from( { length: 3 } ).map( ( _, index ) => (
									<li key={ `sponsor-${ index }` } className="tec-sponsor">
										<PlaceholderLoading shape="rect" width={ 180 } height={ 75 }/>
									</li>
								) ) }
							</ul>
						</div>
					) ) }
				</div>
			);
		}

		if ( error ) {
			return `An error has occurred: ${ error.message }`;
		}

		if ( sponsors.length === 0 ) {
			return (
				<div className="tec-event-schedule-manager__schedule-block--message-wrap">
					<div className="tec-event-schedule-manager__schedule-block-message-title-wrap">
						<h2>
							{ _x( 'No Sponsors Found, please add sponsors or turn on unassigned sponsors.', 'No sponsors found message in the admin sponsors block.', 'event-schedule-manager' ) }
						</h2>
					</div>
				</div>
			);
		}

		return (
			<div className="tec-sponsors">
				{ Object.values( sponsors ).map( ( sponsorsByTerm ) => {
					// Skip displaying unassigned sponsors if include_unassigned is false
					if ( !include_unassigned && sponsorsByTerm.term.slug === 'unassigned' ) {
						return null;
					}

					const HeadingTag = `${ heading_level || 'h2' }`;

					return (
						<div key={ sponsorsByTerm.term.term_id } className={ `tec-sponsor-level tec-sponsor-level-${ sponsorsByTerm.term.slug }` }>
							{ sponsorsByTerm.term.slug === 'unassigned' && Object.values( sponsors ).length >= 2 && include_unassigned ? (
								<hr/>
							) : sponsorsByTerm.term.slug !== 'unassigned' && (
								<>
									<HeadingTag className="tec-sponsor-level-heading">
										<span>{ sponsorsByTerm.term.name }</span>
									</HeadingTag>
								</>
							) }

							<ul className="tec-sponsor-list">
								{ sponsorsByTerm.sponsors.map( ( sponsor ) => (
									<li key={ sponsor.id } id={ `tec-sponsor-${ sponsor.id }` } className={ sponsor.sponsor_classes.join( ' ' ) }>
										{ title === 'visible' && (
											<>
												{ link === 'website' && sponsor.website ? (
													<h3>
														<a href={ sponsor.website }>
															{ sponsor.title }
														</a>
													</h3>
												) : link === 'post' ? (
													<h3>
														<a href={ sponsor.link }>
															{ sponsor.title }
														</a>
													</h3>
												) : (
													<h3>{ sponsor.title }</h3>
												) }
											</>
										) }
										<div className="tec-sponsor-description">
											{ link === 'website' && sponsor.website ? (
												<a href={ sponsor.website }>
													<img
														className="tec-sponsor-image"
														src={ sponsor.image }
														alt={ sponsor.title }
														style={ { width: 'auto', maxHeight: sponsor.logo_height } }
													/>
												</a>
											) : link === 'post' ? (
												<a href={ sponsor.link }>
													<img
														className="tec-sponsor-image"
														src={ sponsor.image }
														alt={ sponsor.title }
														style={ { width: 'auto', maxHeight: sponsor.logo_height } }
													/>
												</a>
											) : (
												<img
													className="tec-sponsor-image"
													src={ sponsor.image }
													alt={ sponsor.title }
													style={ { width: 'auto', maxHeight: sponsor.logo_height } }
												/>
											) }

											{ content === 'full' ? (
												<div dangerouslySetInnerHTML={ { __html: sponsor.content } }/>
											) : content === 'excerpt' && (
												<div dangerouslySetInnerHTML={ { __html: sponsor.excerpt } }/>
											) }
										</div>
									</li>
								) ) }
							</ul>
						</div>
					);
				} ) }
			</div>
		);
	};

	return (
		<QueryClientProvider client={ queryClient }>
			<SponsorsContent/>
		</QueryClientProvider>
	);
}

import { useState, useMemo } from 'react';
import { useQuery } from '@tanstack/react-query';
import { FormTokenField } from '@wordpress/components';
import { _x } from '@wordpress/i18n';
import PlaceholderLoading from 'react-placeholder-loading';

/**
 * Renders a taxonomy token field component.
 *
 * @since 1.2.0
 *
 * @param {Object} props - Component props.
 * @param {string} props.label - Block panel label.
 * @param {Object} props.attributes - Block attributes.
 * @param {Function} props.setAttributes - Function to set block attributes.
 * @param {string} props.taxonomyType - The taxonomy type.
 * @param {string} props.attributeName - The attribute name to store the selected terms.
 *
 * @return {JSX.Element} The taxonomy token field component.
 */
export function TaxonomyTokenField( { label, attributes, setAttributes, taxonomyType, attributeName } ) {
	const [ selectedTerms, setSelectedTerms ] = useState( attributes[ attributeName ]?.split( ',' ).filter( Boolean ) || [] );

	/**
	 * Fetches the taxonomy terms from the REST API.
	 *
	 * @since 1.2.0
	 *
	 * @return {Promise<Array>} A promise that resolves to an array of taxonomy terms.
	 */
	const fetchTerms = async () => {
		const response = await fetch( `/wp-json/wp/v2/${ taxonomyType }` );
		if ( !response.ok ) {
			const errorMessage = _x( 'Network response error', 'The taxonomy component error message.', 'event-schedule-manager' );
			throw new Error( errorMessage );
		}
		return response.json();
	};

	const { isLoading, error, data: terms } = useQuery( {
		queryKey: [ 'taxonomyTerms', taxonomyType ],
		queryFn: fetchTerms,
	} );

	/**
	 * Memoized array of term suggestions.
	 *
	 * The `useMemo` hook is used to memoize the `termSuggestions` array, which is derived from
	 * the `terms` array. The memoized value is only recomputed when the `terms` array changes.
	 *
	 * This optimization helps avoid unnecessary re-computations of `termSuggestions` on every render,
	 * especially if the `terms` array is large or if the component re-renders frequently due to other
	 * state or prop changes.
	 *
	 * @type {Array}
	 */
	const termSuggestions = useMemo( () => {
		return terms?.map( term => term.name ) || [];
	}, [ terms ] );

	const handleTokensChange = ( tokens ) => {
		setSelectedTerms( tokens );
		setAttributes( { [ attributeName ]: tokens.join( ',' ) } );
	};

	if ( isLoading ) {
		return <PlaceholderLoading shape="rect" width={ 250 } height={ 10 }/>;
	}

	if ( error ) {
		const errorPrefix = _x( 'An error has occurred', 'The taxonomy component error prefix message.', 'event-schedule-manager' );
		return `${ errorPrefix }: ${ error.message }`;
	}

	return (
		<FormTokenField
			value={ selectedTerms }
			suggestions={ termSuggestions }
			onChange={ handleTokensChange }
			label={ label }
			__experimentalExpandOnFocus={ true }
			isBorderless={ false }
			tokenizeOnSpace={ true }
			placeholder={ _x( 'Select Terms', 'The taxonomy component field placeholder.', 'event-schedule-manager' ) }
		/>
	);
}

import { PanelRow } from '@wordpress/components';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { TaxonomyTokenField } from '../fields/taxonomyFormTokenField';
import { _x } from '@wordpress/i18n';

// Create a QueryClient instance
const queryClient = new QueryClient();

/**
 * GroupTaxonomyTokenField component.
 *
 * @since 1.2.0
 *
 * @param {Object} props                 The component props.
 * @param {Object} props.attributes      The block attributes.
 * @param {Object} props.setAttributes   Function to set the block attributes.
 */
export function GroupTaxonomyTokenField( { attributes, setAttributes } ) {
	return (
		<PanelRow>
			<fieldset>
				<QueryClientProvider client={ queryClient }>
					<TaxonomyTokenField
						label={ _x(
							'Select Groups',
							'Label for the group taxonomy token field',
							'event-schedule-manager'
						) }
						attributes={ attributes }
						setAttributes={ setAttributes }
						taxonomyType='session_group'
						attributeName='groups'
					/>
				</QueryClientProvider>
			</fieldset>
		</PanelRow>
	);
}

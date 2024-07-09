import { useBlockProps } from '@wordpress/block-editor';
import { SpeakerListInspector } from './inspector-controls/index';
import SpeakerList from './SpeakerList';

/**
 * Edit component for the Speaker List block.
 *
 * @since 1.2.0
 *
 * @param {Object} props          The component props.
 * @param {Object} props.attributes The block attributes.
 * @param {Function} props.setAttributes The function to update the block attributes.
 *
 * @return {JSX.Element} The rendered Edit component.
 */
export default function Edit( { attributes, setAttributes } ) {

	return (
		<div { ...useBlockProps() }>
			<SpeakerListInspector
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>
			<SpeakerList attributes={ attributes }/>
		</div>
	);
}

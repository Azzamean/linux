import { useBlockProps } from '@wordpress/block-editor';
import { SponsorsListInspector } from "./inspector-controls";
import Sponsors from './Sponsors';

export default function Edit( { attributes, setAttributes } ) {

	return (
		<div { ...useBlockProps() }>
			<SponsorsListInspector
				attributes={ attributes }
				setAttributes={ setAttributes }
			/>
			<Sponsors attributes={ attributes }/>
		</div>
	);
}
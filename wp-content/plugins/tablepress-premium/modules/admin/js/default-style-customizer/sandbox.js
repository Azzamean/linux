/**
 * JavaScript code for the "Default Style Customizer SandBox" component.
 *
 * @package TablePress
 * @subpackage Default Style Customizer Screen
 * @author Tobias Bäthge
 * @since 2.2.0
 */

/**
 * WordPress dependencies.
 */
import {
	SandBox as WpSandBox,
} from '@wordpress/components';

/**
 * Internal dependencies.
 */
import { sandboxCss, tableHtml } from './sandbox-data';
import { generateCssCode } from './css';

/**
 * Returns the "Default Style Customizer SandBox" component's JSX markup.
 *
 * @param {Object} props               Function parameters.
 * @param {Object} props.cssProperties Custom CSS properties and values.
 * @return {Object} Default Style Customizer SandBox component.
 */
const DefaultStyleCustomizerSandBox = ( { cssProperties } ) => {
	const defaultStyleCss = generateCssCode( cssProperties );
	const styles = [ sandboxCss, defaultStyleCss ];

	// Append the default CSS code to a hidden container, so that the SandBox content is different and triggers a re-render.
	const sandboxHtml = `
${ tableHtml }
<pre style="display:none">${ defaultStyleCss }</pre>
`;

	return (
		<WpSandBox
			title="TablePress"
			html={ sandboxHtml }
			styles={ styles }
		/>
	);
};

export default DefaultStyleCustomizerSandBox;

/**
 * JavaScript code for the "Default Style Customizer" feature on the "Plugin Options" screen.
 *
 * @package TablePress
 * @subpackage Views JavaScript
 * @author Tobias Bäthge
 * @since 2.2.0
 */

/**
 * Internal dependencies.
 */
import { initializeReactComponent } from '../../../admin/js/common/react-loader';
import DefaultStyleCustomizerScreen from './default-style-customizer/screen';

initializeReactComponent(
	'tablepress-default-style-customizer-screen',
	<DefaultStyleCustomizerScreen />
);

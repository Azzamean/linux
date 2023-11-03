/**
 * JavaScript code for the "Automatic Table Export" screen.
 *
 * @package TablePress
 * @subpackage Views JavaScript
 * @author Tobias Bäthge
 * @since 2.0.0
 */

/**
 * Internal dependencies.
 */
import { initializeReactComponent } from '../../../admin/js/common/react-loader';
import TablePressAutomaticTableExportScreen from './automatic-table-export/screen';

initializeReactComponent(
	'tablepress-automatic-table-export-screen',
	<TablePressAutomaticTableExportScreen />
);

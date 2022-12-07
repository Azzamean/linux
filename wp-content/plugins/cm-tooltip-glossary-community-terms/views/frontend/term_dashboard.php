<div class="communityTerms_wrapper communityTermsDashbard_wrapper">
    <?php
    if (is_user_logged_in()) {
        $userAllowed = array('allow_roles' => (array) \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_ALLOW_ROLES));
        $userAllowed = CMTooltipCommunityTermsFrontend::checkAllowAddTerms($userAllowed);

        if ($userAllowed['allowAddTerms']) {

            $addTermsLink = CMTooltipCommunityTermsFrontend::addLinkToForm('');
            if (!empty($addTermsLink)) {
                echo $addTermsLink;
            }

            // logged & allowed
            $delete_term = isset($_GET['del_term']) ? true : false;

            $get_edit_option = \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_ALLOW_EDIT_TERM);
            $get_delete_option = \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_ALLOW_DELETE_TERM);

            $dashboard_title = \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_TERM_TITLE);
            $dashboard_update = \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_TERM_UPDATE);
            $dashboard_create = \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_TERM_CREATE);
            $dashboard_status = \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_MODERATION);
            $dashboard_edit = \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_TERM_EDIT);
            $dashboard_delete = \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_TERM_DELETE);

            $getEditPageID = \CM\CMTT_Settings::get('cmttct_form_page_id');
            $editPageLink = get_page_link($getEditPageID);

            $showModerated = \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SHOW_MODERATED, '0');

            // Display terms list
            if ($data['haveposts']) {
                ?>
                <table><tbody>
                    <th><?php echo!empty($dashboard_title) ? $dashboard_title : '' ?></th>
                    <th><?php echo!empty($dashboard_update) ? $dashboard_update : '' ?></th>
                    <th><?php echo!empty($dashboard_create) ? $dashboard_create : '' ?></th>
                    <?php if ($get_edit_option) { ?><th><?php echo!empty($dashboard_edit) ? $dashboard_edit : '' ?></th><?php } ?>
                    <?php if ($get_delete_option) { ?><th><?php echo!empty($dashboard_delete) ? $dashboard_delete : '' ?></th><?php } ?>

                    <?php
                    foreach ($data['terms'] as $post) {
                        $isPending = CMTooltipCommunityTermsDashboardFrontend::cmtgct_isPending($post['post_id']);
                        if ($isPending && !$showModerated) {
                            continue;
                        }
                        ?>
                        <tr>
                            <td>
                                <a href="<?php echo $post['permalink'] ?>" title="<?php echo strip_tags($post['post_title']) ?>"><?php echo $post['post_title'] ?></a>
                                <?php
                                if ($isPending): echo '<span class="pendingStatus">' . $dashboard_status . '</span>';
                                endif;
                                ?>
                            </td>
                            <td><?php echo $post['modify']; ?></td>
                            <td><?php echo $post['date']; ?></td>
                            <?php if ($get_edit_option) { ?><td><a href="<?php echo $editPageLink; ?>?term_id=<?php echo $post['post_id']; ?>" ><?php echo!empty($dashboard_edit) ? $dashboard_edit : '' ?></a></td><?php } ?>
                            <?php if ($get_delete_option) { ?><td><a href="?del_term&amp;term_id=<?php echo $post['post_id']; ?>" onclick="return confirm('Are you sure you want to delete this term?')" ><?php echo!empty($dashboard_delete) ? $dashboard_delete : '' ?></a></td><?php } ?>
                        </tr>
                    <?php } ?>

                    </tbody></table>
                <?php
            } else {
                echo \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_NO_TERMS, 'You have no terms to display yet.');
                CMTooltipCommunityTermsFrontend::loadMyTermsForm();
            }
        } else {
            // logged & not allowed
            echo \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_NOT_ALLOWED_TO_SUGGEST, 'Currently you are not allowed to suggest a new terms. Please contact with page administrator.');
        }
    } else {
        // loggeout
        echo \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_NOT_LOGGED_IN, 'You must be logged in to manage your terms.');
        wp_login_form();
    }
    ?>
</div>
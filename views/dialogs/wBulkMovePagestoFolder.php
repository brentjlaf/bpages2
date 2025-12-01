<?php
// views/dialogs/wBulkMovePagestoFolder.php: Template placeholder for missing template coverage.
        // Loading direct helper to read skins data
        CI()->load->helper(['direct']);
        mwSkin()->loadSheet('', 'mw.windows');
        mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Move Pages To Folder</div>
<div class="winContainer" style="width: 100%;">
        <div class="winContent">
                <p class="copy-page-message">
                        <span data-bulk-dialog-message>Move the selected pages into another folder to keep work organized.</span>
                </p>
                <p class="formHint">Applying to <strong data-bulk-selection-label>the selected pages</strong>.</p>

                <dl class="mwDialog">
                        <dt>Destination Folder</dt>
                        <dd>
                                <select id="bulkMoveDestination" name="bulkMoveDestination" required>
                                        <option value="">Select a folder...</option>
                                        <option value="none">No folder (top level)</option>
                                        <option value="about-us">About Us</option>
                                        <option value="programs">Programs</option>
                                        <option value="get-involved">Get Involved</option>
                                        <option value="stories">Stories</option>
                                        <option value="resources">Resources</option>
                                        <option value="utility">Utility</option>
                                </select>
                        </dd>
                        <dd class="formHint">URLs, permissions, and analytics stay the same after moving.</dd>
                </dl>

                <p class="action-dialog-hint" data-bulk-dialog-hint>Choose a destination to move every selected page at once.</p>
        </div>
</div>
<div class="winFooter">
        <a class="close winCloseClick" data-bulk-dialog-cancel data-bulk-dialog-action="move">Cancel</a>
        <a class="apply" data-bulk-dialog-primary data-bulk-dialog-action="move"></a>
</div>
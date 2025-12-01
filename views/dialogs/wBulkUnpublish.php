<?php
// views/dialogs/wBulkUnpublish.php: Template placeholder for missing template coverage.
        // Loading direct helper to read skins data
        CI()->load->helper(['direct']);
        mwSkin()->loadSheet('', 'mw.windows');
        mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Unpublish Pages</div>
<div class="winContainer" style="width: 100%;">
        <div class="winContent">
                <p class="copy-page-message">
                        <span data-bulk-dialog-message>Unpublish the selected pages? They will remain visible to teammates but hidden from visitors.</span>
                </p>
                <p class="formHint">Applying to <strong data-bulk-selection-label>the selected pages</strong>.</p>

                <dl class="mwDialog">
                        <dt>Share links</dt>
                        <dd>
                                <input type="checkbox" id="bulkRemoveShareLinks" name="bulkRemoveShareLinks" checked>
                                <label for="bulkRemoveShareLinks">Disable existing share links for viewers without edit access</label>
                        </dd>
                        <dd class="formHint">Links will continue to work for collaborators who can edit or publish.</dd>
                </dl>

                <p class="action-dialog-hint" data-bulk-dialog-hint>We recommend notifying owners when unpublishing shared content.</p>
        </div>
</div>
<div class="winFooter">
        <a class="close winCloseClick" data-bulk-dialog-cancel data-bulk-dialog-action="unpublish">Cancel</a>
        <a class="apply" data-bulk-dialog-primary data-bulk-dialog-action="unpublish"></a>
</div>
<?php
// views/dialogs/wBulkMovetoTrash.php: Template placeholder for missing template coverage.
        // Loading direct helper to read skins data
        CI()->load->helper(['direct']);
        mwSkin()->loadSheet('', 'mw.windows');
        mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Move Pages To Trash</div>
<div class="winContainer" style="width: 100%;">
        <div class="winContent">
                <p class="copy-page-message">
                        <span data-bulk-dialog-message>Move the selected pages to the trash? You can restore them within 30 days.</span>
                </p>
                <p class="formHint">Applying to <strong data-bulk-selection-label>the selected pages</strong>.</p>

                <dl class="mwDialog">
                        <dt>Leave a note <span class="action-dialog-optional">(optional)</span></dt>
                        <dd>
                                <textarea id="bulkTrashReason" name="bulkTrashReason" placeholder="Share context for teammates"></textarea>
                        </dd>
                        <dd class="formHint">Trash is emptied automatically after 30 days.</dd>
                </dl>

                <p class="action-dialog-hint" data-bulk-dialog-hint>Owners will be notified so they can restore anything important.</p>
        </div>
</div>
<div class="winFooter">
        <a class="close winCloseClick" data-bulk-dialog-cancel data-bulk-dialog-action="delete">Cancel</a>
        <a class="apply" data-bulk-dialog-primary data-bulk-dialog-action="delete"></a>
</div>
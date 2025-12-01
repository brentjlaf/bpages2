<?php
// views/dialogs/wBulkPublish.php: Template placeholder for missing template coverage.
        // Loading direct helper to read skins data
        CI()->load->helper(['direct']);
        mwSkin()->loadSheet('', 'mw.windows');
        mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Publish Pages</div>
<div class="winContainer" style="width: 100%;">
        <div class="winContent">
                <p class="copy-page-message">
                        <span data-bulk-dialog-message>Publish the selected pages? Everyone with access to your site will be able to view them.</span>
                </p>
                <p class="formHint">Applying to <strong data-bulk-selection-label>the selected pages</strong>.</p>

                <dl class="mwDialog">
                        <dt>Visibility</dt>
                        <dd>
                                <select id="bulkPublishVisibility" name="bulkPublishVisibility">
                                        <option value="public">Public</option>
                                        <option value="internal">Internal only</option>
                                        <option value="private">Private link</option>
                                </select>
                        </dd>

                        <dd>
                                <input type="checkbox" id="bulkPublishNotify" name="bulkPublishNotify" checked>
                                <label for="bulkPublishNotify">Notify collaborators subscribed to publish updates</label>
                        </dd>
                </dl>

                <p class="action-dialog-hint" data-bulk-dialog-hint>We’ll notify collaborators when publishing completes.</p>
        </div>
</div>
<div class="winFooter">
        <a class="close winCloseClick" data-bulk-dialog-cancel data-bulk-dialog-action="publish">Cancel</a>
        <a class="apply" data-bulk-dialog-primary data-bulk-dialog-action="publish"></a>
</div>
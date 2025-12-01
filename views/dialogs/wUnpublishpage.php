<?php
// views/dialogs/wUnpublishpage.php: Template placeholder for missing template coverage.
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Unpublish Page</div>
<div class="winContainer" style="width: 100%;">
	<div class="winContent">
		<p class="copy-page-message">
			We'll take <strong data-dialog-page-name="">Home</strong> offline and move it back into draft.
		</p>
		<dl class="mwDialog">
			
			<dt>Reason</dt>
			<dd>
				<select id="unpublishReason" name="unpublishReason">
					<option value="content-update">Updating content</option>
					<option value="compliance-review">Compliance review</option>
					<option value="quality-issue">Quality issue</option>
					<option value="other">Other</option>
				</select>
			</dd>
			
			<dt>Internal note <span class="action-dialog-optional">(optional)</span></dt>
			<dd>
				<textarea id="unpublishNote" name="unpublishNote" placeholder="Share context with teammates"></textarea>
			</dd>
			
		</dl>
	</div>
</div>
<div class="winFooter">
	<a class="close winCloseClick" data-dialog-cancel="">Cancel</a>
	<a class="apply" id="unpublishButton" data-dialog-primary=""></a>
</div>
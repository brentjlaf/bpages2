<?php
// views/dialogs/wRestorepage.php: Template placeholder for missing template coverage.
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Restore Page</div>
<div class="winContainer" style="width: 100%;">
	<div class="winContent">
		<p class="copy-page-message">
			Restore <strong data-dialog-page-name="">Old Promotions</strong> from the trash. We'll return it to its original folder.
		</p>
		<dl class="mwDialog">
			
			<dd>
				<input type="checkbox" id="restorePublishToggle" name="restorePublish">
				<label for="restorePublishToggle">Publish immediately after restoring</label>
			</dd>
			
			<dd class="formHint">Leave unchecked to keep the page in draft.</dd>
			
		</dl>
	</div>
</div>
<div class="winFooter">
	<a class="close winCloseClick" data-dialog-cancel="">Cancel</a>
	<a class="apply" id="restoreButton" data-dialog-primary=""></a>
</div>
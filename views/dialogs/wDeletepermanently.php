<?php
// views/dialogs/wDeletepermanently.php: Template placeholder for missing template coverage.
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Delete Permanently</div>
<div class="winContainer" style="width: 100%;">
	<div class="winContent">
		<p class="copy-page-message action-dialog-warning">
			Permanently remove <strong data-dialog-page-name="">Old Promotions</strong> and all analytics. This action cannot be undone.
		</p>
		<dl class="mwDialog">
			
			<dt>Type the page name to confirm</dt>
			<dd>
				<input type="text" id="deletePageConfirmInput" name="confirmation" required autocomplete="off" data-delete-confirmation-input="" placeholder="Old Promotions">
			</dd>
			
			<dd class="formHint">To confirm, enter the exact page name above.</dd>
			
		</dl>
	</div>
</div>
<div class="winFooter">
	<a class="close winCloseClick" data-dialog-cancel="">Cancel</a>
	<a class="apply" id="deleteButton" data-dialog-primary=""></a>
</div>
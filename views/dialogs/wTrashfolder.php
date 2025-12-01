<?php
// views/dialogs/wTrashfolder.php: Template placeholder for missing template coverage.
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Trash Folder</div>
<div class="winContainer" style="width: 100%;">
	<div class="winContent">
		<p class="copy-page-message action-dialog-warning">
			Move <strong data-folder-dialog-folder-name="">About Us</strong> and every page inside to trash. You can restore them later.
		</p>
		<dl class="mwDialog">
			
			<dt>Type the folder name to confirm</dt>
			<dd>
				<input type="text" id="deleteFolderConfirmInput" name="confirmation" required autocomplete="off" data-folder-confirmation-input="" placeholder="About Us">
			</dd>
			
			<dd class="formHint">To confirm, enter the exact folder name above.</dd>
			
		</dl>
	</div>
</div>
<div class="winFooter">
	<a class="close winCloseClick" data-folder-dialog-cancel="">Cancel</a>
	<a class="apply" id="deleteFolderButton" data-folder-dialog-primary=""></a>
</div>
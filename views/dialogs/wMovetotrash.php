<?php
// views/dialogs/wMovetotrash.php: Template placeholder for missing template coverage.
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Move To Trash</div>
<div class="winContainer" style="width: 100%;">
	<div class="winContent">
		<p class="copy-page-message">
			Send <strong data-dialog-page-name="">Our History</strong> to the trash. You'll be able to restore it within 30 days.
		</p>
		<dl class="mwDialog">
			
			<dt>Leave a note <span class="action-dialog-optional">(optional)</span></dt>
			<dd>
				<textarea id="trashReason" name="trashReason" placeholder="Share context for teammates"></textarea>
			</dd>
			
		</dl>
	</div>
</div>
<div class="winFooter">
	<a class="close winCloseClick" data-dialog-cancel="">Cancel</a>
	<a class="apply" id="trashButton" data-dialog-primary=""></a>
</div>
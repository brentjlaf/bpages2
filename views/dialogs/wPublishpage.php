<?php
// views/dialogs/wPublishpage.php: Template placeholder for missing template coverage.
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Publish Page</div>
<div class="winContainer" style="width: 100%;">
	<div class="winContent">
		<p class="copy-page-message">
			Ready to publish <strong data-dialog-page-name="">Home</strong>? Choose a visibility level and we'll take it live immediately.
		</p>
		<dl class="mwDialog">
			
			<dt>Visibility</dt>
			<dd>
				<select id="publishVisibility" name="publishVisibility">
					<option value="public">Public</option>
					<option value="internal">Internal only</option>
					<option value="private">Private link</option>
				</select>
			</dd>
			
			<dd>
				<input type="checkbox" id="publishNotifySubscribers" name="publishNotifySubscribers">
				<label for="publishNotifySubscribers">Notify subscribers about this update</label>
			</dd>
			
		</dl>
	</div>
</div>
<div class="winFooter">
	<a class="close winCloseClick" data-dialog-cancel="">Cancel</a>
	<a class="apply" id="publishButton" data-dialog-primary=""></a>
</div>
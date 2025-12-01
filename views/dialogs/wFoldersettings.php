<?php
// views/dialogs/wFoldersettings.php: Template placeholder for missing template coverage.
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Folder Settings</div>
<div class="winContainer" style="width: 100%;">
	<div class="winContent">
		<dl class="mwDialog">
			
			<dt>Folder name</dt>
			<dd>
				<input type="text" id="folderNameInput" name="folderName" required>
			</dd>
			
			<dt>Accent color</dt>
			<dd>
				<div class="color-swatches">
					<button type="button" class="color-swatch selected" data-color="blue" aria-label="Blue" aria-pressed="true">
						<span aria-hidden="true"></span>
					</button>
					<button type="button" class="color-swatch" data-color="purple" aria-label="Purple" aria-pressed="false">
						<span aria-hidden="true"></span>
					</button>
					<button type="button" class="color-swatch" data-color="teal" aria-label="Teal" aria-pressed="false">
						<span aria-hidden="true"></span>
					</button>
					<button type="button" class="color-swatch" data-color="amber" aria-label="Amber" aria-pressed="false">
						<span aria-hidden="true"></span>
					</button>
				</div>
				<input type="hidden" id="folderColorInput" name="folderColor" value="blue">
			</dd>
			
		</dl>
	</div>
</div>
<div class="winFooter">
	<a class="close winCloseClick" data-folder-dialog-action="cancel">Cancel</a>
	<a class="apply" id="saveFolderButton" data-dialog-primary=""></a>
</div>
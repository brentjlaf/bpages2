<?php
// views/dialogs/wMovePagetoFolder.php: Template placeholder for missing template coverage.
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Move To Folder</div>

<div class="winContainer" style="width: 100%;">

	<div class="winContent">

		<p class="copy-page-message">
			Select where <strong data-dialog-page-name>this page</strong> should live.
		</p>

		<dl class="mwDialog">
			
			<dt>Destination Folder</dt>
			<dd>
				<select id="movePageDestination" name="destination" required>
					<option value="">Select a folder...</option>
					<option value="none">No folder (top level)</option>
					<option value="about-us">About Us</option>
					<option value="programs">Programs</option>
					<option value="get-involved">Get Involved</option>
					<option value="stories">Stories</option>
					<option value="resources">Resources</option>
					<option value="utility">Utility</option>
				</select>
			</dd>
			
			<dd class="formHint">Folders help keep analytics, permissions, and workflows organized.</dd>

		</dl>

	</div>

</div>

<div class="winFooter">
	<a class="close winCloseClick" data-dialog-cancel>Cancel</a>
	<a class="apply" id="movePageButton" data-dialog-primary></a>
</div>
<?php
// views/dialogs/wDuplicatepage.php: Template placeholder for missing template coverage.
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Duplicate Page</div>

<div class="winContainer" style="width: 100%;">

	<div class="winContent flex">

		<p class="copy-page-message">
			You're creating a copy of <strong id="copyPageSourceName">Home</strong>. Choose a name for the new page.
		</p>

		<dl class="mwDialog">
			
			<dt>New Page Name</dt>
			<dd><input type="text" id="copyPageNameInput" name="copyPageName" required autocomplete="off" placeholder="e.g. Homepage copy"></dd>

		</dl>

	</div>

</div>

<div class="winFooter">
	<a class="close winCloseClick"></a>
	<a class="apply" id=""></a>
</div>
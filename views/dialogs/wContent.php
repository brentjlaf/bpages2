<?php
// views/dialogs/wContent.php: Template placeholder for missing template coverage. VDEMO
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Single Content</div>

<div class="winTools">
	<div class="winTool">A</div>
	<div class="winTool close winCloseClick"></div>
</div>

<div class="winContent" style="width: 600px;">

	<dl class="mwDialog">
		<?=$mwLoad->view('dialogs/fBase1')?>
	</dl>

</div>

<div class="winFooter">
	<a class="close winCloseClick"></a>
	<a class="apply"></a>
</div>
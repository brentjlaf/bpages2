<?php
// views/dialogs/wMinWidth.php: Template placeholder for missing template coverage. VDEMO
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>

<div class="winHeader">Min Width Test</div>

<div class="winContainer" style="min-width: 400px;">
	<div class="winRow flex">
	
		<div class="winContent" style="width: 50%;">
	
			<dl class="mwDialog">
	
				<dt>Sample Input:</dt>
				<dd><input type="text" /></dd>
	
				<dt>Sample Input:</dt>
				<dd><input type="text" /></dd>
	
				<dt>Sample Input:</dt>
				<dd><input type="text" /></dd>
	
			</dl>
		</div>
	
		<div class="winContent" style="width: 50%;">
	
			<dl class="mwDialog">
	
				<dt>Sample Input:</dt>
				<dd><input type="text" /></dd>
	
				<dt>Sample Input:</dt>
				<dd><input type="text" /></dd>
	
				<dt>Sample Input:</dt>
				<dd><input type="text" /></dd>
	
			</dl>
			
		</div>
	
	</div>	
</div>

<div class="winFooter">
	<a class="close winCloseClick"></a>
	<a class="apply"></a>
</div>
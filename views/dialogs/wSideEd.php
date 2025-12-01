<?php
// views/dialogs/wSideEd.php: Template placeholder for missing template coverage.
	mwLoad()->resource('tinyMCE');

	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');

	$panelWidth	= 400;
	$winWidth	= 1200;
?>

<input data-settings="{ maximized: true }" />

<div class="winHeader">Editor With Side Panel</div>

<div class="winRow tools">

	<div class="winContent right" style="width: <?=$panelWidth?>px">

		<dl class="mwDialog tools">

			<dd>
				<table class="mwWinTabs">
					<tr>
				  		<td rel="tab1" onclick="jQuery('#wSideEd_panel').removeClass('hidden'); mwSwitchTab(this);">Tab1</td>
				  		<td rel="tab2" onclick="jQuery('#wSideEd_panel').removeClass('hidden'); mwSwitchTab(this);">Tab2</td>
				  		<td rel="tab_off" class="selected" onclick="jQuery('#wSideEd_panel').toggleClass('hidden')">&gt;</td>
					</tr>
				</table>
			</dd>

		</dl>

	</div>

	<div class="winContent auto mwDialog">

		<dl class="mwDialog tools">

			<dt class="left">Sample Input: </dt>
			<dd class="auto"><input type="text" /></dd>

		</dl>

	</div>

</div>

<div class="winHDivider"></div>

<div class="winRow flex">

	<div id="wSideEd_panel" class="winContainer right hidden" style="width: <?=$panelWidth?>px;">

		<div id="tab1" class="winContainer" style="min-width: <?=$panelWidth?>px;">

			<div class="winContent flex full">

				<dl class="mwDialog">
					<?=$mwLoad->view('dialogs/fSample1', ['size' => '100%'])?>
				</dl>

			</div>

		</div>

		<div id="tab2" class="winContainer" style="display: none; min-width: <?=$panelWidth?>px;">

			<div class="winContent flex full">

				<dl class="mwDialog">
					<?=$mwLoad->view('dialogs/fSample2')?>
				</dl>

			</div>

		</div>

	</div>

	<div class="winContainer auto mwDialog full">

		<textarea class="richEdit flat" size="100%"></textarea>

	</div>

</div>

<div class="winFooter">
	<a class="close winCloseClick"></a>
	<a class="apply"></a>
</div>
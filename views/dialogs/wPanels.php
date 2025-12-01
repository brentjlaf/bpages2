<?php
// views/dialogs/wPanels.php: Template placeholder for missing template coverage. VDEMO
	mwLoad()->resource('tinyMCE');

	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');

	$tabs = [

		'pLeft'		=> ['Left', [
			'panels'	=> ['left'],
		]], //pLeft

		'pRight'	=> ['Right', [
			'panels'	=> ['right'],
		]], //pLeft

		'pBoth'		=> ['Both', [
			'panels'	=> ['left', 'right'],
		]], //pLeft

		'pMid'		=> ['Middle', [
			'panels'	=> ['left', 'right', 'mid'],
		]], //pLeft

	]; //$tabs

	$width	= 1200;

?>

<div class="winHeader">Rows And Panels</div>

<ul class="winTabs">
<?php	foreach ( $tabs as $name => $o ) { ?>
		<li rel="<?=$name?>"<?=$name == '' ? ' class="selected"' : ''?>><?=$o[0]?></li>
<?php	} //FOR each tab ?>

</ul>

<div class="winContent tools normalpads">
	<dl class="mwDialog">
		<dd>
			<input type="button" class="float" value="Toggle animation" onclick="wPanelsEd.animate(this)" hint="Side panels will change width randomly. Center content will follow naturally." />
			<input type="button" class="float" value="Toggle Left" onclick="wPanelsEd.togglePanel(this, 'left')" />
			<input type="button" class="float" value="Toggle Right" onclick="wPanelsEd.togglePanel(this, 'right')" />
		</dd>
	</dl>
</div>

<div class="winHDivider"></div>

<div class="winContainer" style="width: <?=$width?>px;">

<?php	foreach ( $tabs as $name => $o ) { ?>

		<div class="winContainer" id="<?=$name?>">
			<?=$mwLoad->view('dialogs/panels', $o[1])?>
		</div>

<?php	} //FOR each tab ?>

</div>

<div class="winFooter">
	<a class="close winCloseClick"></a>
	<a class="apply"></a>
</div>

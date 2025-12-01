<?php
// views/dialogs/panels.php: Template placeholder for missing template coverage. VDEMO
	$containers	= isset($_GET['containers']);

	$width		= 300;
	$pClass		= $containers ? 'winContainer' : 'winContent';

	$cols		= [
		'left'		=> ['Left Panel', 'dialogs/fSample1', 'Panels have defined width.',  []],
		'right'		=> ['Right Panel', 'dialogs/fSample2', 'Panels have defined width.', []],
		'mid'		=> ['Fixed Content', 'dialogs/fBase1', 'This content have static width.', ['size' => 9]],
		'auto'		=> ['Auto Content', 'dialogs/fBase1', 'This content always takes remaining space.', ['rich' => !in_array('mid', $panels), 'size' => 9]],
	]; //$cols

?>

<style type="text/css">
.mwWindow .winRow.panels>.left>*:not(.mwInput),
.mwWindow .winRow.panels>.right>*:not(.mwInput)
{
	min-width		: <?=$width-100?>px;
}

.mwWindow .winRow.panels>.winContainer.left>.winContent,
.mwWindow .winRow.panels>.winContainer.right>.winContent
{
	min-width		: <?=$width-50?>px;
}

</style>

<div class="winRow flex panels">

<?php
	foreach ( $cols as $name => $o ) {

		if ( $name != 'auto' and !in_array($name, $panels) )
			continue;

?>

		<div class="<?=$pClass?> <?=$name?> panel"<?=($name != 'auto')? ' style="width: '.$width.'px;"' : ''?> hint="<?=$o[2]?>">

	<?php	if ( $containers ) { ?>
			<div class="winContent">
	<?php	} //IF containers ?>

				<dl class="mwDialog">

					<dd class="formGroup"><?=$o[0]?></dd>

					<?=$mwLoad->view($o[1], $o[3])?>

				</dl>

	<?php	if ( $containers ) { ?>
			</div>
	<?php	} //IF containers ?>

		</div>

<?php	} //FOR each tab ?>

</div>

<script type="text/javascript">

var wPanelsEd = {

	timer		: false,

	is		: {
		animating	: false,
	}, //is

	animate		: function ($button, $state ) {

		$button = _jq($button);
		var $this = this;

		if ( isUndefined($state) )
			this.is.animating = !this.is.animating;
		else
			this.is.animating = $state;

		if ( this.is.animating ) {
			this.timer = setInterval( function () {

				jQuery('#wPanels .winRow.panels>div:not(.auto)').each( function () {
					jQuery(this).width( Math.random()*50+<?=$width-25?> );
				});

			}, 700); //timeout

			$button.val('Animation: ON');

		} //IF animating
		else {
			clearInterval(this.timer);

			$button.val('Animation: OFF');

		} //IF idle


	}, //FUNC animate

	togglePanel		: function ($button, $side ) {

		$button = _jq($button);

		var $panel = jQuery('#wPanels .winContent.'+$side + ', #wPanels .winContainer.'+$side);
/*/
		if ( !$panel.is('.hidden') )
			$panel.children().each( function () {

				jQuery(this).css('min-width', jQuery(this).outerWidth() - 20 );

			}); //each.children
		else
			setTimeout( function () {
				$panel.children().css('min-width', '');
			}, 200);
/**/
		$panel.toggleClass('hidden');

		if ( $panel.is('.hidden') )
			$button.val( ucfirst($side) + ': OFF' );
		else
			$button.val( ucfirst($side) + ': ON' );

	}, //FUNC togglePanel

} //CLASS wAutoRow

</script>
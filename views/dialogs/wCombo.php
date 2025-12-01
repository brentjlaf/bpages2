<?php
// views/dialogs/wCombo.php: Template placeholder for missing template coverage. VDEMO
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Combo Dialog C</div>

<ul class="winTabs">
	<li rel="content" hint="Single content">Content</li>
	<li rel="row" hint="Single row">Row</li>
	<li rel="forms" hint="Dialogs stacking">Dialogs</li>
	<li rel="combo1" hint="Contents stacking">Combo 1</li>
	<li rel="combo2" hint="Rows stacking">Combo 2</li>
	<li rel="combo3" hint="Content and Row">Combo 3</li>
	<li rel="combo4" hint="Thinpads stacking">Combo 4</li>
</ul>

<div class="winContainer" style="width: 700px;">

<!---- SINGLE ----------------------------------------------------------------------------------------------------------------->

	<div id="content" class="winContainer">

		<div class="winContent flex">

			<dl class="mwDialog">
				<?=$mwLoad->view('dialogs/fSample1')?>
			</dl>

		</div>

	</div>

<!---- ROW -------------------------------------------------------------------------------------------------------------------->

	<div id="row" class="winContainer">

		<div class="winRow flex">

			<div class="winContent" style="width: 50%;">

				<dl class="mwDialog">
					<?=$mwLoad->view('dialogs/fSample1')?>
				</dl>

			</div>

			<div class="winContent" style="width: 50%;">

				<dl class="mwDialog">
					<?=$mwLoad->view('dialogs/fSample2')?>
				</dl>

			</div>

		</div>

	</div>

<!---- FORMS ------------------------------------------------------------------------------------------------------------------>

	<div id="forms" class="winContainer">

		<div id="forms" class="winContent">

			<dl class="mwDialog">
				<?=$mwLoad->view('dialogs/fBase1')?>
			</dl>
			<dl class="mwDialog">
				<?=$mwLoad->view('dialogs/fBase2')?>
			</dl>

		</div>
	</div>

<!---- COMBO1 ----------------------------------------------------------------------------------------------------------------->

	<div id="combo1" class="winContainer">

		<div class="winContent">

			<dl class="mwDialog">
				<?=$mwLoad->view('dialogs/fBase1')?>
			</dl>

		</div>

		<div class="winContent">

			<dl class="mwDialog">
				<?=$mwLoad->view('dialogs/fBase2')?>
			</dl>

		</div>

	</div>

<!---- COMBO2 ----------------------------------------------------------------------------------------------------------------->

	<div id="combo2" class="winContainer">

		<div class="winRow">

			<div class="winContent" style="width: 40%;">

				<dl class="mwDialog">
					<?=$mwLoad->view('dialogs/fBase1')?>
				</dl>

			</div>

			<div class="winContent" style="width: 60%;">

				<dl class="mwDialog">
					<?=$mwLoad->view('dialogs/fBase2')?>
				</dl>

			</div>

		</div>

		<div class="winRow">

			<div class="winContent" style="width: 60%;">

				<dl class="mwDialog">
					<?=$mwLoad->view('dialogs/fBase1')?>
				</dl>

			</div>

			<div class="winContent" style="width: 40%;">

				<dl class="mwDialog">
					<?=$mwLoad->view('dialogs/fBase2')?>
				</dl>

			</div>

		</div>

	</div>

<!---- COMBO3 ----------------------------------------------------------------------------------------------------------------->

	<div id="combo3" class="winContainer">

		<div class="winContent">
			<dl class="mwDialog">

				<dt>Sample Input:</dt>
				<dd><input type="text" /></dd>

			</dl>
		</div>

		<div class="winRow">

			<div class="winContent" style="width: 50%;">

				<dl class="mwDialog">
					<?=$mwLoad->view('dialogs/fBase1')?>
				</dl>

			</div>

			<div class="winContent" style="width: 50%;">

				<dl class="mwDialog">
					<?=$mwLoad->view('dialogs/fBase2')?>
				</dl>

			</div>

		</div>

		<div class="winContent">
			<dl class="mwDialog">
				<dt>Sample Text:</dt>
				<dd><textarea></textarea></dd>
			</dl>
		</div>

	</div>

<!---- COMBO4 ----------------------------------------------------------------------------------------------------------------->

	<div id="combo4" class="winContainer">

		<div class="winContent thinpads">
			<dl class="mwDialog">

				<dd class="formGroup">Form Group</dd>

				<dt>Sample Input:</dt>
				<dd><input type="text" /></dd>

			</dl>
		</div>

		<div class="winRow">

			<div class="winContent thinpads" style="width: 30%;">

				<dl class="mwDialog">
					<?=$mwLoad->view('dialogs/fBase1')?>
				</dl>

			</div>

			<div class="winContent thinpads" style="width: 30%;">

				<dl class="mwDialog">
					<?=$mwLoad->view('dialogs/fBase2')?>
				</dl>

			</div>

			<div class="winContent thinpads" style="width: 40%;">

				<dl class="mwDialog">
					<?=$mwLoad->view('dialogs/fBase5')?>
				</dl>

			</div>

		</div>

		<div class="winContent thinpads">

			<dl class="mwDialog">
				<dt>Sample Text:</dt>
				<dd><textarea class="multiline-3"></textarea></dd>
			</dl>
		</div>

	</div>

</div>

<div class="winFooter">
	<a class="close winCloseClick"></a>
	<a class="apply"></a>
</div>
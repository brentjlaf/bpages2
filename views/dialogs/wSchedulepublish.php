<?php
// views/dialogs/wSchedulepublish.php: Template placeholder for missing template coverage.
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Schedule Publish</div>
<div class="winContainer" style="width: 100%;">
	<div class="winContent">
		<p class="copy-page-message">
			Decide when <strong data-dialog-page-name="">Home</strong> should go live.
		</p>
		<dl class="mwDialog">
			
			<dt>Publish date</dt>
			<dd>
				<input type="date" id="scheduleDateInput" name="scheduleDate" required min="2025-11-24">
			</dd>
			
			<dt>Publish time</dt>
			<dd>
				<input type="time" id="scheduleTimeInput" name="scheduleTime" required>
			</dd>
			
			<dt>Time zone</dt>
			<dd>
				<select id="scheduleTimezoneSelect" name="scheduleTimezone">
					<option value="UTC">UTC</option>
					<option value="America/New_York">Eastern (US &amp; Canada)</option>
					<option value="America/Chicago">Central (US &amp; Canada)</option>
					<option value="America/Denver">Mountain (US &amp; Canada)</option>
					<option value="America/Los_Angeles">Pacific (US &amp; Canada)</option>
					<option value="Europe/London">London</option>
					<option value="Europe/Berlin">Berlin</option>
					<option value="Asia/Tokyo">Tokyo</option>
					<option value="Australia/Sydney">Sydney</option>
				</select>
			</dd>
			
			<dd>
				<input type="checkbox" id="scheduleNotifyTeam" name="scheduleNotifyTeam" checked>
				<label for="scheduleNotifyTeam">Remind the page owner 30 minutes before publish</label>
			</dd>
			
			<dd class="formHint">The page status will automatically switch to Published at the scheduled time.</dd>
			
		</dl>
	</div>
</div>
<div class="winFooter">
	<a class="close winCloseClick" data-dialog-cancel="">Cancel</a>
	<a class="apply" id="scheduleButton" data-dialog-primary=""></a>
</div>
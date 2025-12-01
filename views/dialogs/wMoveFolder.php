<?php
// views/dialogs/wBulkMovePagestoFolder.php
// Loading direct helper to read skins data
CI()->load->helper( [ 'direct' ] );
mwSkin()->loadSheet( '', 'mw.windows' );
mwSkin()->loadSheet( '', 'mw.forms' );
?>
<div class="winHeader">Move pages</div>
<div class="winContainer" style="width: 100%;">
  <div class="winContent">
    <dl class="mwDialog">
      <dt></dt>
      <dd>
        <p class="copy-page-message action-dialog-description"> Choose where to move <strong data-bulk-selection-label>the selected pages</strong>. 
          All selected pages will move together. </p>
      </dd>
      <dt>Destination</dt>
      <dd>
        <select id="bulkMoveDestination" name="bulkMoveDestination" required>
          <option value="_root">No folder</option>
          <option value="about-us">About Us</option>
          <option value="programs">Programs</option>
          <option value="get-involved">Get Involved</option>
          <option value="stories">Stories</option>
          <option value="resources">Resources</option>
          <option value="utility">Utility</option>
        </select>
      </dd>
      <dd class="formHint"> You can move pages back to the top level by choosing “No folder”. </dd>
    </dl>
  </div>
</div>
<div class="winFooter"> <a class="close winCloseClick" data-bulk-dialog-action="cancel">Cancel</a> <a
		class="apply"
		id="bulkMovePagesButton"
		data-dialog-primary=""
		data-bulk-dialog-primary=""
		data-bulk-dialog-action="move"
	></a> </div>

<?php
// views/dialogs/wPagesettings.php: Template placeholder for missing template coverage.
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>

<div class="winHeader">Page Settings</div>

<ul class="winTabs">
	<li rel="general" hint="Page title and template">General</li>
	<li rel="seo" hint="SEO and meta information">SEO</li>
	<li rel="socials" hint="Social sharing settings">Socials</li>
	<li rel="access" hint="Privacy and access controls">Access</li>
	<li rel="publishing" hint="Publishing options">Publishing</li>
</ul>

<div class="winContainer" style="width: 700px;">

<!---- GENERAL ----------------------------------------------------------------------------------------------------------------->

	<div id="general" class="winContainer">

		<div class="winContent">

			<input type="hidden" id="pageSettingsIdInput" name="pageId">
			<input type="hidden" id="pageSettingsTypeInput" name="type">
			<input type="hidden" id="pageSettingsTemplateInput" name="template">

			<dl class="mwDialog">
				
				<dt>Page Title</dt>
				<dd><input type="text" id="pageSettingsTitleInput" name="title" required></dd>
				
				<dd>
					<label class="wizard-checkbox" for="pageSettingsHomeToggle">
						<input type="checkbox" id="pageSettingsHomeToggle" name="setHome">
						<span>Set as Home Page</span>
					</label>
				</dd>
				
				<dd class="formGroup">Page Type</dd>
				
                                <dd>
                                        <div class="page-settings-choices" id="pageSettingsTypeOptions" role="radiogroup" aria-label="Select page type">
                                                <label class="page-settings-choice" data-page-type-option="Landing" data-accent="blue" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTypeOption" value="Landing">
                                                        <span>Landing</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-type-option="Blog" data-accent="violet" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTypeOption" value="Blog">
                                                        <span>Blog</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-type-option="Event" data-accent="amber" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTypeOption" value="Event">
                                                        <span>Event</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-type-option="Portfolio" data-accent="pink" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTypeOption" value="Portfolio">
                                                        <span>Portfolio</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-type-option="Contact" data-accent="emerald" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTypeOption" value="Contact">
                                                        <span>Contact</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-type-option="Home" data-accent="blue" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTypeOption" value="Home">
                                                        <span>Home</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-type-option="Content" data-accent="slate" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTypeOption" value="Content">
                                                        <span>Content</span>
                                                </label>
                                        </div>
									
									
									
									
									
                                </dd>
				
				<dd class="formGroup">Page Template</dd>
				
                                <dd>
                                        <div class="page-settings-choices" id="pageSettingsTemplateOptions" role="radiogroup" aria-label="Select page template">
                                                <label class="page-settings-choice" data-page-template-option="Standard page" data-accent="slate" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTemplateOption" value="Standard page">
                                                        <span>Standard page</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-template-option="Hero landing" data-accent="blue" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTemplateOption" value="Hero landing">
                                                        <span>Hero landing</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-template-option="Editorial longform" data-accent="violet" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTemplateOption" value="Editorial longform">
                                                        <span>Editorial longform</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-template-option="Knowledge base" data-accent="emerald" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTemplateOption" value="Knowledge base">
                                                        <span>Knowledge base</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-template-option="Gallery" data-accent="pink" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTemplateOption" value="Gallery">
                                                        <span>Gallery</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-template-option="Portfolio showcase" data-accent="pink" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTemplateOption" value="Portfolio showcase">
                                                        <span>Portfolio showcase</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-template-option="Campaign spotlight" data-accent="amber" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTemplateOption" value="Campaign spotlight">
                                                        <span>Campaign spotlight</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-template-option="Resource hub" data-accent="emerald" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTemplateOption" value="Resource hub">
                                                        <span>Resource hub</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-template-option="Insight report" data-accent="violet" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTemplateOption" value="Insight report">
                                                        <span>Insight report</span>
                                                </label>
                                                <label class="page-settings-choice" data-page-template-option="Brand style guide" data-accent="violet" data-selected="false" aria-checked="false">
                                                        <input type="radio" name="pageTemplateOption" value="Brand style guide">
                                                        <span>Brand style guide</span>
                                                </label>
                                        </div>
                                </dd>

			</dl>

		</div>

	</div>

<!---- SEO ----------------------------------------------------------------------------------------------------------------->

	<div id="seo" class="winContainer">

		<div class="winContent">

			<dl class="mwDialog">
				
				<dt>Page Url</dt>
				<dd><input type="text" id="pageSettingsSlugInput" name="slug" required></dd>
				
				<dd>
					<div class="wizard-checkbox-grid">
						<label class="wizard-checkbox" for="pageSettingsComplexUrl">
							<input type="checkbox" id="pageSettingsComplexUrl" name="complexUrl">
							<span>Use Complex Url</span>
						</label>
						<label class="wizard-checkbox" for="pageSettingsHideSearch">
							<input type="checkbox" id="pageSettingsHideSearch" name="hideSearch">
							<span>Hide from Search Engines</span>
						</label>
						<label class="wizard-checkbox" for="pageSettingsHideSiteSearch">
							<input type="checkbox" id="pageSettingsHideSiteSearch" name="hideSiteSearch">
							<span>Hide from Site Search</span>
						</label>
					</div>
				</dd>
				
				<dt>Canonical Url</dt>
				<dd><input type="url" id="pageSettingsCanonical" name="canonicalUrl" placeholder="https://mydomain.com/title"></dd>
				
				<dt>Meta Title</dt>
				<dd><input type="text" id="pageSettingsMetaTitle" name="metaTitle" placeholder="About Us — My Company"></dd>
				
				<dt>Meta Description</dt>
				<dd><textarea id="pageSettingsMetaDescription" name="metaDescription" placeholder="Describe the page in 160 characters or fewer" maxlength="160" rows="3"></textarea></dd>

			</dl>

		</div>

	</div>

<!---- SOCIALS ----------------------------------------------------------------------------------------------------------------->

	<div id="socials" class="winContainer">

		<div class="winContent">

			<dl class="mwDialog">
				
				<dt>Open Graph Title</dt>
				<dd><input type="text" id="pageSettingsOgTitle" name="ogTitle" placeholder="About Us"></dd>
				
				<dt>Open Graph Description</dt>
				<dd><textarea id="pageSettingsOgDescription" name="ogDescription" rows="3" placeholder="Share a short description for social cards"></textarea></dd>
				
				<dt>Open Graph Image</dt>
				<dd>
					<div class="wizard-file-drop">
						<i class="fa-regular fa-image" aria-hidden="true"></i>
						<strong>Upload a cover image</strong>
						<p class="wizard-helper-text">Recommended dimensions: 1200x630.</p>
						<div class="wizard-file-actions">
							<label for="pageSettingsOgImage">Select File...</label>
							<button type="button" class="danger">Remove</button>
						</div>
						<input type="file" id="pageSettingsOgImage" name="ogImage" accept="image/*">
					</div>
				</dd>

			</dl>

		</div>

	</div>

<!---- ACCESS ----------------------------------------------------------------------------------------------------------------->

	<div id="access" class="winContainer">

		<div class="winContent">

			<dl class="mwDialog">
				
				<dt>Privacy Setting</dt>
				<dd>
					<select id="pageSettingsPrivacy" name="privacySetting">
						<option value="any">Any user</option>
						<option value="members">Only members</option>
						<option value="admins">Only administrators</option>
					</select>
					<p class="wizard-select-note">
						This setting allows you to restrict public access to this page on your site.
					</p>
				</dd>
				
				<dd>
					<label class="wizard-checkbox" for="pageSettingsRequireLogin">
						<input type="checkbox" id="pageSettingsRequireLogin" name="requireLogin">
						<span>Require Login</span>
					</label>
					<p class="wizard-helper-text">
						If selected, this page will require users to login explicitly, ignoring cookies.
					</p>
				</dd>

			</dl>

		</div>

	</div>

<!---- PUBLISHING ----------------------------------------------------------------------------------------------------------------->

	
	<div id="publishing" class="winContainer">

		<div class="winContent">

			<dl class="mwDialog">
				
				<dt>Publishing Option</dt>
				<dd>
					<select id="pagePublishOptionSelect" name="pagePublishOption">
						<option value="publish-now">Publish Now — Make this page live immediately</option>
						<option value="schedule-publish">Schedule Publish — Set a future publish date and time</option>
						<option value="schedule-unpublish">Schedule Unpublish — Automatically unpublish at a specific date and time</option>
						<option value="save-draft">Save as Draft — Keep this page unpublished</option>
					</select>
				</dd>
				
				<dd>
					<div class="wizard-schedule-fields" id="pageSettingsScheduleFields" hidden>
						<dl class="mwDialog">
							<dt>Date</dt>
							<dd><input type="date" id="pageSettingsScheduleDate" name="scheduleDate"></dd>
							
							<dt>Time</dt>
							<dd><input type="time" id="pageSettingsScheduleTime" name="scheduleTime"></dd>
						</dl>
					</div>
				</dd>

			</dl>

		</div>

	</div>

</div>

<div class="winFooter">
	<a class="close winCloseClick" data-page-settings-action="cancel">Cancel</a>
	<a class="apply" id="savePageSettingsButton"></a>
</div>
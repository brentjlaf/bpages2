<?php
// views/dialogs/wFilterit.php: Template placeholder for missing template coverage.
	// Loading direct helper to read skins data
	CI()->load->helper(['direct']);
	mwSkin()->loadSheet('', 'mw.windows');
	mwSkin()->loadSheet('', 'mw.forms');
?>
<div class="winHeader">Filters</div>

<div class="winContainer" style="width: 700px;">

	<div class="winContent">

<!---- DATE ----------------------------------------------------------------------------------------------------------------->

                <dl class="mwDialog">
                        <dd class="formGroup">Date</dd>

                        <dd>
                                <div class="date-grid">
                                        <label for="filterStartDate">Start Date
                                                <input type="date" id="filterStartDate" name="filterStartDate">
                                        </label>

                                        <label for="filterEndDate">End Date
                                                <input type="date" id="filterEndDate" name="filterEndDate">
                                        </label>
                                </div>
                        </dd>

                        <dd class="formHint">Filters by last modified date. Leave one field blank for an open range.</dd>
                </dl>

<!---- AUTHOR ----------------------------------------------------------------------------------------------------------------->

		<dl class="mwDialog">
			<dd class="formGroup">Author</dd>
			
			<dd>
				<div class="author-filter-grid" id="authorFilterList" role="group" aria-label="Filter by author">
					<button type="button" class="author-filter-chip" data-author-value="Amelia Reed" data-active="false" title="Amelia Reed" aria-label="Toggle filter for Amelia Reed" aria-pressed="false">
						<span class="author-avatar" data-color="slate">AR</span>
					</button>
					<button type="button" class="author-filter-chip" data-author-value="Daniel Ortiz" data-active="false" title="Daniel Ortiz" aria-label="Toggle filter for Daniel Ortiz" aria-pressed="false">
						<span class="author-avatar" data-color="slate">DO</span>
					</button>
					<button type="button" class="author-filter-chip" data-author-value="Jordan Blake" data-active="false" title="Jordan Blake" aria-label="Toggle filter for Jordan Blake" aria-pressed="false">
						<span class="author-avatar" data-color="slate">JB</span>
					</button>
					<button type="button" class="author-filter-chip" data-author-value="Morgan Lee" data-active="false" title="Morgan Lee" aria-label="Toggle filter for Morgan Lee" aria-pressed="false">
						<span class="author-avatar" data-color="slate">ML</span>
					</button>
					<button type="button" class="author-filter-chip" data-author-value="Priya Patel" data-active="false" title="Priya Patel" aria-label="Toggle filter for Priya Patel" aria-pressed="false">
						<span class="author-avatar" data-color="slate">PP</span>
					</button>
				</div>
			</dd>
		</dl>

<!---- STATUS ----------------------------------------------------------------------------------------------------------------->

		<dl class="mwDialog">
			<dd class="formGroup">Status</dd>
			
			<dd>
                                <div class="filter-pill-group" id="statusFilterPills" role="group" aria-label="Filter by status">
                                        <button type="button" class="filter-pill" data-status-value="published" data-active="false" aria-pressed="false">Published</button>
                                        <button type="button" class="filter-pill" data-status-value="unpublished" data-active="false" aria-pressed="false">Unpublished</button>
                                        <button type="button" class="filter-pill" data-status-value="draft" data-active="false" aria-pressed="false">Draft</button>
                                        <button type="button" class="filter-pill" data-status-value="scheduled" data-active="false" aria-pressed="false">Scheduled</button>
                                        <button type="button" class="filter-pill" data-status-value="trash" data-active="false" aria-pressed="false">Trash</button>
                                </div>
			</dd>
		</dl>

<!---- TYPE ----------------------------------------------------------------------------------------------------------------->

		<dl class="mwDialog">
			<dd class="formGroup">Type</dd>
			
			<dd>
                                <div class="type-chip-group" id="typeFilterList" role="group" aria-label="Filter by type">
                                        <button type="button" class="type-chip" data-type-value="Landing" data-color="blue" data-active="false" aria-pressed="false">Landing</button>
                                        <button type="button" class="type-chip" data-type-value="Blog" data-color="violet" data-active="false" aria-pressed="false">Blog</button>
                                        <button type="button" class="type-chip" data-type-value="Event" data-color="amber" data-active="false" aria-pressed="false">Event</button>
                                        <button type="button" class="type-chip" data-type-value="Portfolio" data-color="pink" data-active="false" aria-pressed="false">Portfolio</button>
                                        <button type="button" class="type-chip" data-type-value="Contact" data-color="emerald" data-active="false" aria-pressed="false">Contact</button>
                                        <button type="button" class="type-chip" data-type-value="Home" data-color="blue" data-active="false" aria-pressed="false">Home</button>
                                        <button type="button" class="type-chip" data-type-value="Content" data-color="slate" data-active="false" aria-pressed="false">Content</button>
                                </div>
			</dd>
		</dl>

<!---- REPORT CARD ----------------------------------------------------------------------------------------------------------------->

		<dl class="mwDialog">
			<dd class="formGroup">Report Card</dd>
			
			<dd>
				<div class="report-checkboxes" id="reportFilterList">
					<label class="report-checkbox">
						<input type="checkbox" value="seo-low">
						<span>SEO score less than 50%</span>
					</label>
					<label class="report-checkbox">
						<input type="checkbox" value="slow-speed">
						<span>Slow page speed</span>
					</label>
					<label class="report-checkbox">
						<input type="checkbox" value="meta-title">
						<span>Meta title issues</span>
					</label>
					<label class="report-checkbox">
						<input type="checkbox" value="meta-description">
						<span>Meta description issues</span>
					</label>
					<label class="report-checkbox">
						<input type="checkbox" value="og-issues">
						<span>OG (Open Graph) issues</span>
					</label>
					<label class="report-checkbox">
						<input type="checkbox" value="broken-links">
						<span>Broken links</span>
					</label>
					<label class="report-checkbox">
						<input type="checkbox" value="heading-hierarchy">
						<span>Improper heading hierarchy</span>
					</label>
					<label class="report-checkbox">
						<input type="checkbox" value="stale-edit">
						<span>Edited more than 90 days ago</span>
					</label>
					<label class="report-checkbox">
						<input type="checkbox" value="low-engagement">
						<span>Low engagement rate</span>
					</label>
				</div>
			</dd>
		</dl>

	</div>

</div>

<div class="winFooter">	<a class="close winCloseClick"></a>

	<a class="reset" id="clearFiltersButton">Reset</a>
	<a class="apply" id="applyFiltersButton"></a>
</div>
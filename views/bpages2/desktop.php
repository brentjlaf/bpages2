<?php
// views/bpages2/desktop.php: Template placeholder for missing template coverage. VDEMO
	$mwLoad->Window('wFilterit', 'dialogs/wFilterit');
	$mwLoad->Window('wNewfolder', 'dialogs/wNewfolder');
	$mwLoad->Window('wDuplicatepage', 'dialogs/wDuplicatepage');
	$mwLoad->Window('wPagesettings', 'dialogs/wPagesettings');
	$mwLoad->Window('wMovePagetoFolder', 'dialogs/wMovePagetoFolder');
	$mwLoad->Window('wPublishpage', 'dialogs/wPublishpage');
	$mwLoad->Window('wUnpublishpage', 'dialogs/wUnpublishpage');
	$mwLoad->Window('wSchedulepublish', 'dialogs/wSchedulepublish');
	$mwLoad->Window('wMovetotrash', 'dialogs/wMovetotrash');
	$mwLoad->Window('wBulkPublish', 'dialogs/wBulkPublish');
	$mwLoad->Window('wBulkUnpublish', 'dialogs/wBulkUnpublish');
	$mwLoad->Window('wBulkMovePagestoFolder', 'dialogs/wBulkMovePagestoFolder');
	$mwLoad->Window('wBulkMovetoTrash', 'dialogs/wBulkMovetoTrash');
	$mwLoad->Window('wFoldersettings', 'dialogs/wFoldersettings');
	$mwLoad->Window('wTrashfolder', 'dialogs/wTrashfolder');
	$mwLoad->Window('wRestorepage', 'dialogs/wRestorepage');
	$mwLoad->Window('wDeletepermanently', 'dialogs/wDeletepermanently');
	$mwLoad->Window('wMoveFolder', 'dialogs/wMoveFolder');

	$mwLoad
		->js('sample.js')
		->css('sample.css')
	; //$mwLoad

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

<style>

.mwDesktop {
	padding: 0;
}

/* Handler visibility controls */
.mwIndexTable .handler.sortable {
	display: none;
}

.mwIndexTable li.head .handler.nestable {
	display: none;
}

.mwIndexTable dl:hover>.handler.sortable {
	display: block;
}

.mwIndexTable dl:hover>.handler.nestable {
	display: none;
}

/* Checkbox cell */
.mwIndexTable .checkbox-cell {
	width: 40px;
	padding: 8px;
}

.checkbox {
	display: inline-flex;
	align-items: center;
	cursor: pointer;
}

.checkbox input {
	width: 18px;
	height: 18px;
	cursor: pointer;
}

/* Status badges */
.badge {
	display: inline-block;
	padding: 4px 10px;
	border-radius: 12px;
	font-size: 12px;
	font-weight: 600;
}

.badge.published {
	background: #dcfce7;
	color: #166534;
}

.badge.unpublished {
	background: #e0e7ff;
	color: #3730a3;
}

.badge.draft {
	background: #fef3c7;
	color: #92400e;
}

.badge.scheduled {
	background: #fee2e2;
	color: #991b1b;
}

.badge.trash {
	background: #f3f4f6;
	color: #374151;
}

/* Chip */
.chip {
	display: inline-block;
	padding: 4px 10px;
	border-radius: 999px;
	background: #eef2ff;
	color: #4338ca;
	font-size: 12px;
	font-weight: 600;
}

/* Avatar */
.avatar {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	width: 32px;
	height: 32px;
	border-radius: 50%;
	background: #e0e7ff;
	color: #4338ca;
	font-size: 11px;
	font-weight: 600;
}

/* Folder styling */
.mwIndexTable li.group dl {
	background: #f8fafc;
}

.folder-header {
	display: flex;
	align-items: center;
	justify-content: space-between;
	width: 100%;
}

.folder-toggle {
	display: flex;
	align-items: center;
	gap: 12px;
	border: none;
	background: transparent;
	cursor: pointer;
	padding: 0;
}

.folder-icon {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	width: 32px;
	height: 32px;
	border-radius: 8px;
	background: rgba(59, 130, 246, 0.14);
	color: #2563eb;
	font-size: 14px;
}

.folder-name {
	font-size: 14px;
	font-weight: 700;
	color: #1f2937;
}

.folder-count {
	display: inline-flex;
	padding: 2px 8px;
	border-radius: 999px;
	background: rgba(59, 130, 246, 0.12);
	color: #2563eb;
	font-size: 11px;
	font-weight: 600;
}

.folder-actions {
	display: flex;
	gap: 4px;
}

.folder-actions button {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	width: 32px;
	height: 32px;
	border: 1px solid #e5e7eb;
	border-radius: 6px;
	background: white;
	color: #6b7280;
	cursor: pointer;
	transition: all 0.2s;
}

.folder-actions button:hover {
	background: #f3f4f6;
	color: #1f2937;
}

/* Indentation for folder items */
.mwIndexTable li[data-folder] dt {
	padding-left: 24px;
}

/* Action buttons */
.actions {
	display: flex;
	gap: 4px;
}

.actions button {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	width: 32px;
	height: 32px;
	border: 1px solid #e5e7eb;
	border-radius: 6px;
	background: white;
	color: #6b7280;
	cursor: pointer;
	transition: all 0.2s;
}

.actions button:hover {
	background: #f3f4f6;
	color: #1f2937;
}

/* Title styling */
.title-button {
	border: none;
	background: none;
	font-size: 14px;
	font-weight: 600;
	color: #1f2937;
	cursor: pointer;
	text-align: left;
}

.title-button:hover {
	color: #2563eb;
}

.subtitle {
	display: block;
	font-size: 12px;
	color: #6b7280;
	font-weight: 400;
}

/* Reports button */
.reports-button {
	border: none;
	background: none;
	cursor: pointer;
	text-align: left;
	padding: 0;
}

.reports-metric strong {
	display: block;
	font-size: 14px;
	color: #1f2937;
}

.metric-trend {
	display: block;
	font-size: 11px;
	color: #16a34a;
}

.metric-trend.down {
	color: #dc2626;
}

/* Bulk actions bar */
.bulk-actions-bar {
	display: none;
	padding: 12px 16px;
	background: #f3f4f6;
	border-bottom: 1px solid #e5e7eb;
	gap: 16px;
	align-items: center;
}

.bulk-actions-bar[aria-hidden="false"] {
	display: flex;
}

.bulk-summary {
	display: flex;
	align-items: center;
	gap: 8px;
	font-weight: 600;
	color: #1f2937;
}

.bulk-actions {
	display: flex;
	gap: 8px;
}

.bulk-actions button {
	padding: 8px 12px;
	border: 1px solid #e5e7eb;
	border-radius: 6px;
	background: white;
	color: #374151;
	font-size: 13px;
	font-weight: 500;
	cursor: pointer;
	display: inline-flex;
	align-items: center;
	gap: 6px;
}

.bulk-actions button:hover {
	background: #f9fafb;
}

.bulk-clear {
	margin-left: auto;
}

/* Tab styling */
.winTabs {
	display: flex;
	gap: 8px;
	padding: 8px 16px 0;
	background: #f1f5f9;
	border-bottom: 1px solid #e5e7eb;
}

.tab-button {
	padding: 10px 16px;
	border: none;
	border-radius: 12px 12px 0 0;
	background: transparent;
	color: #64748b;
	font-size: 14px;
	font-weight: 600;
	cursor: pointer;
	display: inline-flex;
	align-items: center;
	gap: 8px;
}

.tab-button.active {
	background: white;
	color: #1f2937;
}

.tab-badge {
	display: inline-flex;
	padding: 2px 8px;
	border-radius: 999px;
	background: #e2e8f0;
	color: #475569;
	font-size: 12px;
	font-weight: 600;
}

.tab-button.active .tab-badge {
	background: #dbeafe;
	color: #1e40af;
}

/* Search input */
.search-input {
	position: relative;
	display: inline-flex;
	align-items: center;
}

.search-input input {
	width: 260px;
	padding: 10px 16px 10px 38px;
	border-radius: 6px;
	border: 1px solid #e5e7eb;
	background: white;
	font-size: 14px;
	color: #1f2937;
	transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.search-input input:focus {
	outline: none;
	border-color: #2563eb;
	box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.search-input i {
	position: absolute;
	left: 12px;
	top: 50%;
	transform: translateY(-50%);
	color: #6b7280;
	font-size: 14px;
	pointer-events: none;
}

</style>

<div class="mwDskTools">

	<h1><span>Pages</span> Manager</h1>

	<div class="search-input">
		<i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
		<input type="search" id="pagesSearch" placeholder="Search pages" aria-label="Search pages">
	</div>

	<a class="Add" onclick="mwWindow('wFilterit').show();">Filter</a>

	<a class="Add" onclick="mwWindow('wPagesettings').show();">New Page</a>
	<a class="Add" onclick="mwWindow('wNewfolder').show();">New Folder</a>

</div>

<div class="bulk-actions-bar" id="bulkActionsBar" aria-hidden="true">
	<div class="bulk-summary">
		<i class="fa-solid fa-layer-group"></i>
		<span id="selectionCount">0 selected</span>
	</div>
	<div class="bulk-actions">
		<button type="button" onclick="mwWindow('wBulkPublish').show();"><i class="fa-solid fa-globe"></i>Publish</button>
		<button type="button" onclick="mwWindow('wBulkUnpublish').show();"><i class="fa-solid fa-toggle-off"></i>Unpublish</button>
		<button type="button" onclick="mwWindow('wBulkMovePagestoFolder').show();"><i class="fa-solid fa-folder-arrow-down"></i>Move to Folder</button>
		<button type="button" onclick="mwWindow('wBulkMovetoTrash').show();"><i class="fa-solid fa-trash-can"></i>Trash</button>
		<button type="button" class="bulk-clear" id="clearSelectionButton"><i class="fa-solid fa-xmark"></i>Clear Selection</button>
	</div>
</div>

<div class="mwDesktop">

	<div class="winTabs">
		<button class="tab-button active" type="button" data-status-tab="all">All <span class="tab-badge" data-status-count="all">28</span></button>
		<button class="tab-button" type="button" data-status-tab="published">Published <span class="tab-badge" data-status-count="published">18</span></button>
		<button class="tab-button" type="button" data-status-tab="unpublished">Unpublished <span class="tab-badge" data-status-count="unpublished">6</span></button>
		<button class="tab-button" type="button" data-status-tab="draft">Drafts <span class="tab-badge" data-status-count="draft">3</span></button>
		<button class="tab-button" type="button" data-status-tab="scheduled">Scheduled <span class="tab-badge" data-status-count="scheduled">1</span></button>
		<button class="tab-button" type="button" data-status-tab="trash">Trash <span class="tab-badge" data-status-count="trash">0</span></button>
	</div>

	<ul id="mwPagesIndex" class="mwIndexTable">

		<li class="head">
			<dl>
				<dd class="checkbox-cell">
					<label class="checkbox">
						<input type="checkbox" id="masterCheckbox">
					</label>
				</dd>
				<dt>Title</dt>
				<dd class="small">Status</dd>
				<dd class="small">Type</dd>
				<dd class="small">Author</dd>
				<dd class="small">Reports</dd>
				<dd class="small">Created</dd>
				<dd class="small">Modified</dd>
				<dd class="small">Actions</dd>
			</dl>
		</li>

		<li data-id="home" class="page-row no-children collapsed" data-status="published">
			<dl>
				<dd class="checkbox-cell">
					<label class="checkbox">
						<input type="checkbox" data-row-checkbox>
					</label>
				</dd>
				<dt>
					<button type="button" class="title-button">Home</button>
					<span class="subtitle">home</span>
				</dt>
				<dd><span class="badge published">Published</span></dd>
				<dd><span class="chip">Home</span></dd>
				<dd>Jordan Blake</dd>
				<dd>
					<button type="button" class="reports-button">
						<div class="reports-metric">
							<strong>12.8k views</strong>
							<span class="metric-trend up">+12%</span>
						</div>
					</button>
				</dd>
				<dd>Nov 01, 2024</dd>
				<dd>Jul 22, 2025</dd>
				<dd class="actions">
					<button type="button" onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
					<button type="button" onclick="mwWindow('wPagesettings').show();"><i class="fa-solid fa-gear"></i></button>
					<button type="button" onclick="mwWindow('wPublishpage').show();"><i class="fa-solid fa-ellipsis-vertical"></i></button>
				</dd>
			</dl>
		</li>

		<li class="group" data-folder="about-us">
			<dl>
				<dd class="checkbox-cell">
					<label class="checkbox">
						<input type="checkbox" data-folder-checkbox>
					</label>
				</dd>
				<dt>
					<div class="folder-header">
						<button type="button" class="folder-toggle">
							<span class="folder-icon"><i class="fa-solid fa-folder-open"></i></span>
							<span class="folder-name">About Us</span>
							<span class="folder-count">4 pages</span>
						</button>
						<div class="folder-actions">
							<button type="button" onclick="mwWindow('wFoldersettings').show();"><i class="fa-solid fa-pen-to-square"></i></button>
							<button type="button" onclick="mwWindow('wMoveFolder').show();"><i class="fa-solid fa-arrow-right-arrow-left"></i></button>
							<button type="button" onclick="mwWindow('wTrashfolder').show();"><i class="fa-solid fa-trash-can"></i></button>
						</div>
					</div>
				</dt>
			</dl>
		</li>

		<li data-id="our-team" class="page-row no-children collapsed" data-folder="about-us" data-status="published">
			<dl>
				<dd class="checkbox-cell">
					<label class="checkbox">
						<input type="checkbox" data-row-checkbox>
					</label>
				</dd>
				<dt>
					<button type="button" class="title-button">Our Team</button>
					<span class="subtitle">our-team</span>
				</dt>
				<dd><span class="badge published">Published</span></dd>
				<dd><span class="chip">Content</span></dd>
				<dd>Amelia Reed</dd>
				<dd>
					<button type="button" class="reports-button">
						<div class="reports-metric">
							<strong>4.2k views</strong>
							<span class="metric-trend up">+6%</span>
						</div>
					</button>
				</dd>
				<dd>Jan 12, 2025</dd>
				<dd>Jun 30, 2025</dd>
				<dd class="actions">
					<button type="button" onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
					<button type="button" onclick="mwWindow('wPagesettings').show();"><i class="fa-solid fa-gear"></i></button>
					<button type="button" onclick="mwWindow('wPublishpage').show();"><i class="fa-solid fa-ellipsis-vertical"></i></button>
				</dd>
			</dl>
		</li>

		<li data-id="mission" class="page-row no-children collapsed" data-folder="about-us" data-status="published">
			<dl>
				<dd class="checkbox-cell">
					<label class="checkbox">
						<input type="checkbox" data-row-checkbox>
					</label>
				</dd>
				<dt>
					<button type="button" class="title-button">Our Mission</button>
					<span class="subtitle">mission</span>
				</dt>
				<dd><span class="badge published">Published</span></dd>
				<dd><span class="chip">Content</span></dd>
				<dd>Jordan Blake</dd>
				<dd>
					<button type="button" class="reports-button">
						<div class="reports-metric">
							<strong>3.1k views</strong>
							<span class="metric-trend up">+8%</span>
						</div>
					</button>
				</dd>
				<dd>Nov 05, 2024</dd>
				<dd>May 14, 2025</dd>
				<dd class="actions">
					<button type="button" onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
					<button type="button" onclick="mwWindow('wPagesettings').show();"><i class="fa-solid fa-gear"></i></button>
					<button type="button" onclick="mwWindow('wPublishpage').show();"><i class="fa-solid fa-ellipsis-vertical"></i></button>
				</dd>
			</dl>
		</li>

		<li data-id="history" class="page-row no-children collapsed" data-folder="about-us" data-status="draft">
			<dl>
				<dd class="checkbox-cell">
					<label class="checkbox">
						<input type="checkbox" data-row-checkbox>
					</label>
				</dd>
				<dt>
					<button type="button" class="title-button">History</button>
					<span class="subtitle">history</span>
				</dt>
				<dd><span class="badge draft">Draft</span></dd>
				<dd><span class="chip">Content</span></dd>
				<dd>Taylor Collins</dd>
				<dd>
					<button type="button" class="reports-button">
						<div class="reports-metric">
							<strong>—</strong>
						</div>
					</button>
				</dd>
				<dd>Feb 18, 2025</dd>
				<dd>Jul 29, 2025</dd>
				<dd class="actions">
					<button type="button" onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
					<button type="button" onclick="mwWindow('wPagesettings').show();"><i class="fa-solid fa-gear"></i></button>
					<button type="button" onclick="mwWindow('wPublishpage').show();"><i class="fa-solid fa-ellipsis-vertical"></i></button>
				</dd>
			</dl>
		</li>

		<li data-id="contact" class="page-row no-children collapsed" data-folder="about-us" data-status="published">
			<dl>
				<dd class="checkbox-cell">
					<label class="checkbox">
						<input type="checkbox" data-row-checkbox>
					</label>
				</dd>
				<dt>
					<button type="button" class="title-button">Contact Us</button>
					<span class="subtitle">contact</span>
				</dt>
				<dd><span class="badge published">Published</span></dd>
				<dd><span class="chip">Contact</span></dd>
				<dd>Jordan Blake</dd>
				<dd>
					<button type="button" class="reports-button">
						<div class="reports-metric">
							<strong>5.6k views</strong>
							<span class="metric-trend up">+15%</span>
						</div>
					</button>
				</dd>
				<dd>Nov 08, 2024</dd>
				<dd>Jun 11, 2025</dd>
				<dd class="actions">
					<button type="button" onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
					<button type="button" onclick="mwWindow('wPagesettings').show();"><i class="fa-solid fa-gear"></i></button>
					<button type="button" onclick="mwWindow('wPublishpage').show();"><i class="fa-solid fa-ellipsis-vertical"></i></button>
				</dd>
			</dl>
		</li>

		<li class="group" data-folder="programs">
			<dl>
				<dd class="checkbox-cell">
					<label class="checkbox">
						<input type="checkbox" data-folder-checkbox>
					</label>
				</dd>
				<dt>
					<div class="folder-header">
						<button type="button" class="folder-toggle">
							<span class="folder-icon"><i class="fa-solid fa-folder-open"></i></span>
							<span class="folder-name">Programs</span>
							<span class="folder-count">4 pages</span>
						</button>
						<div class="folder-actions">
							<button type="button" onclick="mwWindow('wFoldersettings').show();"><i class="fa-solid fa-pen-to-square"></i></button>
							<button type="button" onclick="mwWindow('wMoveFolder').show();"><i class="fa-solid fa-arrow-right-arrow-left"></i></button>
							<button type="button" onclick="mwWindow('wTrashfolder').show();"><i class="fa-solid fa-trash-can"></i></button>
						</div>
					</div>
				</dt>
			</dl>
		</li>

		<li data-id="education" class="page-row no-children collapsed" data-folder="programs" data-status="published">
			<dl>
				<dd class="checkbox-cell">
					<label class="checkbox">
						<input type="checkbox" data-row-checkbox>
					</label>
				</dd>
				<dt>
					<button type="button" class="title-button">Education Programs</button>
					<span class="subtitle">education</span>
				</dt>
				<dd><span class="badge published">Published</span></dd>
				<dd><span class="chip">Programs</span></dd>
				<dd>Amelia Reed</dd>
				<dd>
					<button type="button" class="reports-button">
						<div class="reports-metric">
							<strong>7.4k views</strong>
							<span class="metric-trend up">+18%</span>
						</div>
					</button>
				</dd>
				<dd>Dec 03, 2024</dd>
				<dd>Jul 15, 2025</dd>
				<dd class="actions">
					<button type="button" onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
					<button type="button" onclick="mwWindow('wPagesettings').show();"><i class="fa-solid fa-gear"></i></button>
					<button type="button" onclick="mwWindow('wPublishpage').show();"><i class="fa-solid fa-ellipsis-vertical"></i></button>
				</dd>
			</dl>
		</li>

		<li data-id="youth" class="page-row no-children collapsed" data-folder="programs" data-status="published">
			<dl>
				<dd class="checkbox-cell">
					<label class="checkbox">
						<input type="checkbox" data-row-checkbox>
					</label>
				</dd>
				<dt>
					<button type="button" class="title-button">Youth Services</button>
					<span class="subtitle">youth</span>
				</dt>
				<dd><span class="badge published">Published</span></dd>
				<dd><span class="chip">Programs</span></dd>
				<dd>Taylor Collins</dd>
				<dd>
					<button type="button" class="reports-button">
						<div class="reports-metric">
							<strong>6.2k views</strong>
							<span class="metric-trend up">+9%</span>
						</div>
					</button>
				</dd>
				<dd>Nov 22, 2024</dd>
				<dd>Jun 28, 2025</dd>
				<dd class="actions">
					<button type="button" onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
					<button type="button" onclick="mwWindow('wPagesettings').show();"><i class="fa-solid fa-gear"></i></button>
					<button type="button" onclick="mwWindow('wPublishpage').show();"><i class="fa-solid fa-ellipsis-vertical"></i></button>
				</dd>
			</dl>
		</li>

		<li data-id="community" class="page-row no-children collapsed" data-folder="programs" data-status="unpublished">
			<dl>
				<dd class="checkbox-cell">
					<label class="checkbox">
						<input type="checkbox" data-row-checkbox>
					</label>
				</dd>
				<dt>
					<button type="button" class="title-button">Community Outreach</button>
					<span class="subtitle">community</span>
				</dt>
				<dd><span class="badge unpublished">Unpublished</span></dd>
				<dd><span class="chip">Programs</span></dd>
				<dd>Amelia Reed</dd>
				<dd>
					<button type="button" class="reports-button">
						<div class="reports-metric">
							<strong>—</strong>
						</div>
					</button>
				</dd>
				<dd>Jan 30, 2025</dd>
				<dd>Jul 20, 2025</dd>
				<dd class="actions">
					<button type="button" onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
					<button type="button" onclick="mwWindow('wPagesettings').show();"><i class="fa-solid fa-gear"></i></button>
					<button type="button" onclick="mwWindow('wPublishpage').show();"><i class="fa-solid fa-ellipsis-vertical"></i></button>
				</dd>
			</dl>
		</li>

		<li data-id="workshops" class="page-row no-children collapsed" data-folder="programs" data-status="published">
			<dl>
				<dd class="checkbox-cell">
					<label class="checkbox">
						<input type="checkbox" data-row-checkbox>
					</label>
				</dd>
				<dt>
					<button type="button" class="title-button">Workshops</button>
					<span class="subtitle">workshops</span>
				</dt>
				<dd><span class="badge published">Published</span></dd>
				<dd><span class="chip">Programs</span></dd>
				<dd>Jordan Blake</dd>
				<dd>
					<button type="button" class="reports-button">
						<div class="reports-metric">
							<strong>3.9k views</strong>
							<span class="metric-trend up">+5%</span>
						</div>
					</button>
				</dd>
				<dd>Dec 15, 2024</dd>
				<dd>Jun 05, 2025</dd>
				<dd class="actions">
					<button type="button" onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
					<button type="button" onclick="mwWindow('wPagesettings').show();"><i class="fa-solid fa-gear"></i></button>
					<button type="button" onclick="mwWindow('wPublishpage').show();"><i class="fa-solid fa-ellipsis-vertical"></i></button>
				</dd>
			</dl>
		</li>

	</ul>

</div>

<script type="text/javascript">

	jQuery( function () {

		// Search functionality
		jQuery('#pagesSearch').on('input', function() {
			const searchTerm = jQuery(this).val().toLowerCase().trim();

			jQuery('.page-row').each(function() {
				const title = jQuery(this).find('.title-button').text().toLowerCase();
				const subtitle = jQuery(this).find('.subtitle').text().toLowerCase();

				if (searchTerm === '' || title.includes(searchTerm) || subtitle.includes(searchTerm)) {
					jQuery(this).show();
				} else {
					jQuery(this).hide();
				}
			});
		});

		// Master checkbox functionality
		jQuery('#masterCheckbox').on('change', function() {
			const isChecked = jQuery(this).prop('checked');
			jQuery('[data-row-checkbox]').prop('checked', isChecked);
			updateBulkActionsBar();
		});

		// Row checkbox functionality
		jQuery('[data-row-checkbox]').on('change', function() {
			updateBulkActionsBar();

			// Update master checkbox state
			const totalCheckboxes = jQuery('[data-row-checkbox]').length;
			const checkedCheckboxes = jQuery('[data-row-checkbox]:checked').length;
			jQuery('#masterCheckbox').prop('checked', totalCheckboxes === checkedCheckboxes);
		});

		// Update bulk actions bar
		function updateBulkActionsBar() {
			const checkedCount = jQuery('[data-row-checkbox]:checked').length;
			const bulkBar = jQuery('#bulkActionsBar');

			if (checkedCount > 0) {
				bulkBar.attr('aria-hidden', 'false');
				jQuery('#selectionCount').text(checkedCount + ' selected');
			} else {
				bulkBar.attr('aria-hidden', 'true');
			}
		}

		// Clear selection
		jQuery('#clearSelectionButton').on('click', function() {
			jQuery('[data-row-checkbox], #masterCheckbox').prop('checked', false);
			updateBulkActionsBar();
		});

		// Tab functionality
		jQuery('[data-status-tab]').on('click', function() {
			const status = jQuery(this).data('status-tab');

			// Update active tab
			jQuery('[data-status-tab]').removeClass('active');
			jQuery(this).addClass('active');

			// Filter rows
			if (status === 'all') {
				jQuery('.page-row').show();
			} else {
				jQuery('.page-row').each(function() {
					const rowStatus = jQuery(this).data('status');
					if (rowStatus === status) {
						jQuery(this).show();
					} else {
						jQuery(this).hide();
					}
				});
			}
		});

		// Folder toggle functionality
		jQuery('.folder-toggle').on('click', function() {
			const folderRow = jQuery(this).closest('li');
			const folderId = folderRow.data('folder');
			const isExpanded = folderRow.hasClass('expanded');

			if (isExpanded) {
				folderRow.removeClass('expanded').addClass('collapsed');
				jQuery('[data-folder="' + folderId + '"]').hide();
				jQuery(this).find('i').removeClass('fa-folder-open').addClass('fa-folder');
			} else {
				folderRow.removeClass('collapsed').addClass('expanded');
				jQuery('[data-folder="' + folderId + '"]').show();
				jQuery(this).find('i').removeClass('fa-folder').addClass('fa-folder-open');
			}
		});

		// Initialize folders as expanded
		jQuery('.group').addClass('expanded');

	}); //jQuery

</script>

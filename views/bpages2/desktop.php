<?php
// views/bpages2/desktop.php: Template placeholder for missing template coverage.
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
  /* ========================================
   *  Root Variables & Base Styles
   * ======================================== */

	.mwDesktop {padding:0}
	
  :root {
    color-scheme: light;

    /* Base colors */
    --pages-white: #ffffff;
    --pages-white-rgb: 255, 255, 255;
    --pages-bg: #f5f7fb;
    --pages-card-bg: var(--pages-white);
    --pages-border: #e0e6f1;
    --pages-border-rgb: 224, 230, 241;
    --pages-text: #1f2937;
    --pages-muted: #6b7280;
    --pages-shadow-rgb: 15, 23, 42;

    /* Accents & states */
    --pages-accent: #000;
    --pages-accent-rgb: 50, 50, 50;
    --pages-danger: #ef4444;
    --pages-danger-rgb: 239, 68, 68;

    /* Status badge colors */
    --pages-badge-published: #dcfce7;
    --pages-badge-draft: #fef3c7;
    --pages-badge-unpublished: #e0e7ff;
    --pages-badge-scheduled: #fee2e2;
    --pages-badge-trash: #f3f4f6;

    /* Chips */
    --pages-chip-bg: #eef2ff;
    --pages-chip-color: #4338ca;

    /* Layout offsets */
    --pages-sticky-offset: 54px;
    --pages-bulk-bar-offset: 0px;
  }

  body {
    margin: 0;
    font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; 
    background: #fff;
    color: var(--pages-text);
  }

  /* ========================================
   *  Layout Shell & Toolbar
   * ======================================== */

  .pages-shell {
    width: 100%;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 0px;
    box-sizing: border-box;
  }

  .pages-toolbar {
    position: sticky;
    top: 0;
    z-index: 20;
    display: flex;
    flex-direction: column;
    gap: 0px;
    padding-bottom: 0px;
    background: #fff;
    backdrop-filter: blur(6px);
  }

  .pages-tabs-row {
    display: flex;
    align-items: center;
    gap: 16px;
  }

  .pages-card {
    border-radius: 18px;
    border: 1px solid var(--pages-border);
    background: var(--pages-card-bg);
  }

  /* ========================================
   *  Toolbar Controls & Buttons
   * ======================================== */

  .quick-actions {
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .icon-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 0px;
    border: 1px solid transparent;
    background: rgba(var(--pages-accent-rgb), 0.08);
    color: var(--pages-accent);
    cursor: pointer;
    transition: background 0.2s ease, color 0.2s ease, border-color 0.2s ease;
  }

  .icon-button:hover {
    background: rgba(var(--pages-accent-rgb), 0.16);
    border-color: rgba(var(--pages-accent-rgb), 0.24);
  }

  .pill-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 10px 14px;
    font-size: 14px;
    font-weight: 600;
    color: var(--pages-text);
    border-radius: 10px;
    border: 1px solid var(--pages-border);
    background: var(--pages-white);
    cursor: pointer;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .pill-button:hover {
    border-color: rgba(var(--pages-accent-rgb), 0.5);
    box-shadow: 0 10px 20px rgba(var(--pages-accent-rgb), 0.12);
  }

  .pill-button.primary {
    background: var(--pages-accent);
    border-color: var(--pages-accent);
    color: var(--pages-white);
    box-shadow: 0 10px 20px rgba(var(--pages-accent-rgb), 0.18);
  }

  /* ========================================
   *  Tooltips
   * ======================================== */

  [data-tooltip] {
    position: relative;
  }

  [data-tooltip]::after,
  [data-tooltip]::before {
    pointer-events: none;
    position: absolute;
    opacity: 0;
    transition: opacity 0.18s ease, transform 0.18s ease;
  }

  [data-tooltip]::after {
    content: attr(data-tooltip);
    bottom: calc(100% + 10px);
    left: 50%;
    transform: translate(-50%, -4px);
    background: rgba(var(--pages-shadow-rgb), 0.95);
    color: var(--pages-white);
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
    white-space: nowrap;
    box-shadow: 0 12px 24px rgba(var(--pages-shadow-rgb), 0.2);
    z-index: 30;
  }

  [data-tooltip]::before {
    content: "";
    bottom: calc(100% + 4px);
    left: 50%;
    transform: translate(-50%, -4px);
    border-width: 6px;
    border-style: solid;
    border-color: rgba(var(--pages-shadow-rgb), 0.95) transparent transparent transparent;
    z-index: 29;
  }

  [data-tooltip]:hover::after,
  [data-tooltip]:hover::before,
  [data-tooltip]:focus-visible::after,
  [data-tooltip]:focus-visible::before {
    opacity: 1;
    transform: translate(-50%, 0);
  }

  /* ========================================
   *  Search Input
   * ======================================== */

  .search-input {
    position: relative;
    display: inline-flex;
    align-items: center;
  }

  .search-input input {
    width: 260px;
    padding: 10px 76px 10px 38px;
    border-radius: 10px;
    border: 1px solid var(--pages-border);
    background: var(--pages-white);
    font-size: 14px;
    color: var(--pages-text);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .search-input input:focus {
    outline: none;
    border-color: rgba(var(--pages-accent-rgb), 0.55);
    box-shadow: 0 0 0 4px rgba(var(--pages-accent-rgb), 0.18);
  }

  .search-input i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--pages-muted);
    font-size: 14px;
    pointer-events: none;
  }

  .shortcut-hint {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 12px;
    font-weight: 600;
    color: var(--pages-muted);
    background: #f3f4f6;
    border-radius: 8px;
    padding: 4px 8px;
  }

  /* ========================================
   *  Tabs & Filters (Top of Table)
   * ======================================== */

  .pages-tabs {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    border-radius: 0;
    padding: 6px 6px 0 6px;
    background: #f1f5f9;
    overflow-x: auto;
  }

  .tab-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    border-radius: 12px 12px 0 0;
    border: none;
    background: transparent;
    color: var(--pages-text);
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.2s ease, color 0.2s ease;
  }

  .tab-button .tab-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    font-size: 12px;
    font-weight: 600;
    background: rgba(var(--pages-accent-rgb), 0.18);
    color: var(--pages-accent);
  }

  .tab-button.active {
    background: var(--pages-white);
    color: var(--pages-accent);
    box-shadow: 0 12px 24px rgba(var(--pages-accent-rgb), 0.18);
  }

  .tab-button.active .tab-badge {
    background: var(--pages-accent);
    color: var(--pages-white);
  }

  .filter-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    background: #efefef;
    padding: 8px;
  }

  .filter-chips[hidden] {
    display: none;
  }

  .chip-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 6px 12px;
    border-radius: 12px;
    background: rgba(var(--pages-accent-rgb), 0.1);
    color: var(--pages-accent);
    font-weight: 600;
    font-size: 12px;
    border: none;
  }

  .chip-button span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .chip-button i {
    font-size: 11px;
    color: var(--pages-accent);
  }

  /* ========================================
   *  Bulk Selection Bar
   * ======================================== */

  .bulk-actions-bar {
    position: sticky;
    top: var(--pages-sticky-offset);
    z-index: 30;
    display: none;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 14px 20px;
    background: var(--pages-white);
    /* border-radius: 14px;
       border: 1px solid var(--pages-border);
       box-shadow: 0 14px 28px rgba(var(--pages-accent-rgb), 0.16); */
  }

  .bulk-actions-bar.is-active {
    display: flex;
  }

  .bulk-summary {
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 600;
  }

  .bulk-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
  }

  .bulk-actions button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: 1px solid var(--pages-border);
    background: var(--pages-white);
    padding: 8px 14px;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    transition: border-color 0.2s ease, box-shadow 0.2s ease, color 0.2s ease;
  }

  .bulk-actions button:hover {
    border-color: rgba(var(--pages-accent-rgb), 0.5);
    color: var(--pages-accent);
    box-shadow: 0 12px 24px rgba(var(--pages-accent-rgb), 0.12);
  }

  .bulk-actions .bulk-clear {
    color: var(--pages-danger);
    border-color: rgba(var(--pages-danger-rgb), 0.4);
  }

  .bulk-actions .bulk-clear:hover {
    border-color: var(--pages-danger);
    color: #b91c1c;
    box-shadow: 0 12px 24px rgba(var(--pages-danger-rgb), 0.15);
  }

  /* ========================================
   *  Pages Table Layout & Structure
   * ======================================== */

  table.pages-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 960px;
  }

  .pages-table colgroup col.checkbox-col {
    width: 72px;
  }

  .pages-table colgroup col.wide {
    width: 320px;
  }

  .pages-table thead {
    position: sticky;
    top: calc(var(--pages-sticky-offset) + var(--pages-bulk-bar-offset));
    z-index: 15;
    background: #f9fafc;
    box-shadow: 0 6px 12px rgba(var(--pages-shadow-rgb), 0.04);
  }

  .pages-table thead th {
    text-align: left;
    padding: 18px 24px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--pages-muted);
    background: #f9fafc;
    border-bottom: 1px solid var(--pages-border);
  }

  .pages-table thead th.checkbox-cell {
    padding-left: 20px;
    padding-right: 12px;
  }

  .pages-table tbody tr:not(.group-row) {
    border-bottom: 1px solid var(--pages-border);
    transition: background 0.2s ease;
  }

  .pages-table tbody tr:not(.group-row):hover {
    background: #f7f9ff;
  }

  /* Homepage row highlight */
  .pages-table tbody tr.is-homepage {
    background: linear-gradient(90deg, rgba(var(--pages-accent-rgb), 0.03), rgba(var(--pages-accent-rgb), 0.02));
  }

  .pages-table tbody tr.is-homepage:hover {
    background: linear-gradient(90deg, rgba(var(--pages-accent-rgb), 0.05), rgba(var(--pages-accent-rgb), 0.04));
  }

  .pages-table tbody td {
    padding: 10px 24px;
    font-size: 14px;
    vertical-align: middle;
    color: var(--pages-text);
  }

  .pages-table tbody td.checkbox-cell {
    padding-left: 20px;
    padding-right: 12px;
  }

  /* ========================================
   *  Title Cell & Subtext
   * ======================================== */

  .title-cell {
    display: flex;
    align-items: center;
    gap: 16px;
    font-weight: 600;
  }

  .title-cell .home-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 10px;
    background: rgba(var(--pages-accent-rgb), 0.12);
    color: var(--pages-accent);
    font-size: 14px;
  }

  .title-cell .title-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .subtitle {

    display: block;
    margin: auto;
    font-size: 12px;
    font-weight: 500;
    color: var(--pages-muted);
  }

  /* ========================================
   *  Status Badges & Chips
   * ======================================== */

  .badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border-radius: 999px;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 600;
  }

  .badge.published {
    background: var(--pages-badge-published);
    color: #047857;
  }

  .badge.draft {
    background: var(--pages-badge-draft);
    color: #b45309;
  }

  .badge.unpublished {
    background: var(--pages-badge-unpublished);
    color: #4338ca;
  }

  .badge.scheduled {
    background: var(--pages-badge-scheduled);
    color: #b91c1c;
  }

  .badge.trash {
    background: var(--pages-badge-trash);
    color: #1f2937;
  }

  .chip {
    display: inline-flex;
    align-items: center;
    padding: 6px 14px;
    border-radius: 12px;
    background: var(--pages-chip-bg);
    color: var(--pages-chip-color);
    font-weight: 600;
    font-size: 12px;
  }

  /* Chip color variants */
  .chip[data-color="blue"] {
    background: rgba(var(--pages-accent-rgb), 0.14);
    color: #1d4ed8;
  }

  .chip[data-color="violet"] {
    background: rgba(139, 92, 246, 0.16);
    color: #5b21b6;
  }

  .chip[data-color="amber"] {
    background: rgba(217, 119, 6, 0.18);
    color: #b45309;
  }

  .chip[data-color="emerald"] {
    background: rgba(16, 185, 129, 0.18);
    color: #047857;
  }

  .chip[data-color="pink"] {
    background: rgba(219, 39, 119, 0.18);
    color: #be185d;
  }

  .chip[data-color="slate"] {
    background: rgba(148, 163, 184, 0.18);
    color: #334155;
  }

  /* ========================================
   *  Custom Checkbox Styling
   * ======================================== */

  .checkbox {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
  }

  .checkbox input {
    appearance: none;
    margin: 0;
    width: 20px;
    height: 20px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    position: relative;
    cursor: pointer;
    background: transparent;
    border: none;
    color: var(--pages-border);
    transition: color 0.2s ease;
  }

  .checkbox input::before {
    content: '';
    position: absolute;
    inset: -4px;
    display: block;
    border-radius: 8px;
    box-shadow: 0 0 0 0 rgba(var(--pages-accent-rgb), 0.28);
    opacity: 0;
    transition: box-shadow 0.2s ease, opacity 0.2s ease;
    pointer-events: none;
  }

  .checkbox input:focus-visible {
    outline: none;
  }

  .checkbox input:focus-visible::before {
    opacity: 1;
    box-shadow: 0 0 0 3px rgba(var(--pages-accent-rgb), 0.28);
  }

  .checkbox input::after {
    content: "\f0c8";
    font-family: 'Font Awesome 6 Free';
    font-weight: 400;
    font-size: 18px;
    line-height: 1;
    display: block;
    color: currentColor;
    transition: color 0.2s ease, transform 0.2s ease;
  }

  .checkbox input:not(:checked):not(:indeterminate):hover::after {
    color: rgba(var(--pages-accent-rgb), 0.6);
  }

  .checkbox input:checked:hover::after,
  .checkbox input:indeterminate:hover::after {
    color: #1d4ed8;
  }

  .checkbox input:checked {
    color: var(--pages-accent);
  }

  .checkbox input:checked::after {
    content: "\f14a";
    font-weight: 900;
    color: currentColor;
  }

  .checkbox input:indeterminate {
    color: var(--pages-accent);
  }

  .checkbox input:indeterminate::after {
    content: "\f146";
    font-weight: 900;
    transform: none;
  }

  /* ========================================
   *  Sort Buttons & Column Interactions
   * ======================================== */

  .sort-button {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: none;
    background: transparent;
    font: inherit;
    color: inherit;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-weight: 600;
    cursor: pointer;
    padding: 0;
  }

  .sort-button .sort-indicator {
    font-size: 12px;
    opacity: 0;
    transition: opacity 0.2s ease, transform 0.2s ease;
  }

  .sort-button.is-active .sort-indicator {
    opacity: 1;
  }

  .sort-button[data-direction='asc'] .sort-indicator {
    transform: rotate(0deg);
  }

  .sort-button[data-direction='desc'] .sort-indicator {
    transform: rotate(180deg);
  }

  .title-button,
  .author-filter,
  .reports-button {
    border: none;
    background: transparent;
    padding: 0;
    font: inherit;
    color: inherit;
    cursor: pointer;
    text-align: left;
  }

  .status-pill {
    display: inline-flex;
    align-items: center;
    cursor: default;
  }

  .author-filter {
    display: inline-flex;
  }

  .title-button {
    font-weight: 700;
  }

  .title-button:hover,
  .title-button:focus-visible {
    color: var(--pages-accent);
  }

  /* CTA variation on title button */
  .page-row[data-cta='true'] .title-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 18px;
    border-radius: 999px;
    background: var(--pages-accent);
    color: var(--pages-white);
    font-weight: 700;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .page-row[data-cta='true'] .title-button::after {
    content: 'Header CTA';
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 2px 8px;
    border-radius: 999px;
    background: rgba(var(--pages-white-rgb), 0.22);
  }

  .page-row[data-cta='true'] .title-button:hover,
  .page-row[data-cta='true'] .title-button:focus-visible {
    color: var(--pages-white);
    transform: translateY(-1px);
    box-shadow: 0 14px 24px rgba(var(--pages-accent-rgb), 0.28);
  }

  .page-row[data-cta='true'] .subtitle {
    color: var(--pages-muted);
  }

  .author-filter:focus-visible,
  .reports-button:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px rgba(var(--pages-accent-rgb), 0.22);
    border-radius: 10px;
  }

  .author-filter .avatar {
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }

  .author-filter:hover .avatar span,
  .author-filter:focus-visible .avatar span {
    background: rgba(var(--pages-accent-rgb), 0.14);
  }

  .reports-button {
    display: inline-flex;
  }

  /* ========================================
   *  Row States (Selected / Analytics)
   * ======================================== */

  .page-row.is-selected {
    background: rgba(var(--pages-accent-rgb), 0.08);
  }

  .page-row.is-selected:hover {
    background: rgba(var(--pages-accent-rgb), 0.12);
  }

  .page-row.has-analytics-open {
    background: rgba(var(--pages-accent-rgb), 0.06);
    box-shadow: inset 0 0 0 1px rgba(var(--pages-accent-rgb), 0.1);
  }

  .page-row.has-analytics-open:hover {
    background: rgba(var(--pages-accent-rgb), 0.1);
  }

  .page-analytics-row {
    background: transparent;
  }

  .page-analytics-row > td {
    padding: 0;
    border: none;
  }

  .page-analytics-drawer {
    padding: 28px 32px 32px;
    opacity: 0;
    transform: translateY(-12px);
    transition: opacity 0.2s ease, transform 0.2s ease;
    position: relative;
  }

  .page-analytics-row.is-open .page-analytics-drawer {
    opacity: 1;
    transform: translateY(0);
  }

  /* Hide rows via filters / collapse */
  .page-row.is-filter-hidden,
  .page-row.is-collapsed {
    display: none !important;
  }

  /* ========================================
   *  Analytics Chips & Close Button
   * ======================================== */

  .analytics-chip {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 600;
    border-radius: 999px;
    padding: 4px 10px;
    letter-spacing: 0.02em;
    background: var(--pages-chip-bg);
    color: var(--pages-chip-color);
  }

  .analytics-chip.is-good {
    background: #dcfce7;
    color: #166534;
  }

  .analytics-chip.is-caution {
    background: #fef3c7;
    color: #b45309;
  }

  .analytics-chip.is-issue {
    background: #fee2e2;
    color: #b91c1c;
  }

  .analytics-chip.is-neutral {
    background: #e5e7eb;
    color: #374151;
  }

  .analytics-chip.is-status {
    padding: 4px 12px;
  }

  .analytics-close {
    border: none;
    background: rgba(var(--pages-shadow-rgb), 0.06);
    color: var(--pages-muted);
    width: 34px;
    height: 34px;
    border-radius: 10px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s ease, color 0.2s ease;
  }

  .page-analytics-drawer > .analytics-close {
    position: absolute;
    top: 0px;
    right: 0px;
  }

  .analytics-close:hover,
  .analytics-close:focus-visible {
    background: rgba(var(--pages-shadow-rgb), 0.12);
    color: var(--pages-text);
    outline: none;
  }

  /* ========================================
   *  Analytics Cards & Grid
   * ======================================== */

  .analytics-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
  }

  .analytics-card {
    background: var(--pages-card-bg);
    border-radius: 18px;
    border: 1px solid var(--pages-border);
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 18px;
  }

  .analytics-card-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
  }

  .analytics-card-body {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .analytics-card-title {
    font-size: 16px;
    font-weight: 600;
    letter-spacing: -0.01em;
  }

  .analytics-card-subtitle {
    display: block;
    margin-top: 6px;
    font-size: 13px;
    color: var(--pages-muted);
  }

  .analytics-card-action {
    background: rgba(var(--pages-accent-rgb), 0.1);
    color: var(--pages-accent);
    border: none;
    border-radius: 999px;
    padding: 6px 14px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.02em;
    cursor: pointer;
    transition: background 0.2s ease, color 0.2s ease;
    white-space: nowrap;
  }

  .analytics-card-action:hover,
  .analytics-card-action:focus-visible {
    background: rgba(var(--pages-accent-rgb), 0.18);
    color: #1d4ed8;
    outline: none;
  }

  .analytics-metric-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 14px;
  }

  .analytics-metric {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
  }

  .analytics-metric-main {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .analytics-metric-label {
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--pages-muted);
  }

  .analytics-metric-value {
    font-size: 16px;
    font-weight: 600;
    color: var(--pages-text);
  }

  .analytics-metric-helper {
    font-size: 12px;
    color: var(--pages-muted);
  }

  /* ========================================
   *  Analytics - Traffic Card Variant
   * ======================================== */

  .analytics-card--traffic {
    background: linear-gradient(180deg, rgba(var(--pages-accent-rgb), 0.08), rgba(var(--pages-accent-rgb), 0.02));
    border-color: rgba(var(--pages-accent-rgb), 0.18);
  }

  .analytics-traffic-primary {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .analytics-traffic-value {
    font-size: 32px;
    font-weight: 700;
    letter-spacing: -0.02em;
  }

  .analytics-traffic-label {
    font-size: 13px;
    color: var(--pages-muted);
  }

  .analytics-traffic-trend {
    font-size: 13px;
    font-weight: 600;
  }

  .analytics-traffic-trend.is-up {
    color: #0f766e;
  }

  .analytics-traffic-trend.is-down {
    color: #b91c1c;
  }

  .analytics-traffic-context {
    font-size: 12px;
    color: var(--pages-muted);
  }

  .analytics-traffic-details {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px;
    margin-top: 12px;
  }

  .analytics-traffic-details .analytics-detail {
    background: rgba(var(--pages-white-rgb), 0.7);
    border: 1px solid rgba(var(--pages-accent-rgb), 0.16);
    border-radius: 14px;
    padding: 12px 14px;
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .analytics-detail-label {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: rgba(var(--pages-accent-rgb), 0.8);
    font-weight: 600;
  }

  .analytics-detail-value {
    font-size: 16px;
    font-weight: 600;
  }

  .analytics-detail-chip {
    align-self: flex-start;
  }

  /* ========================================
   *  Search Mode & Overlay (Reserved)
   * ======================================== */

  body.search-mode .pages-card,
  body.search-mode .pages-table,
  body.search-mode .dialog,
  body.search-mode .filter-chips,
  body.search-mode .pages-tabs {
    /* Reserved for search-mode overrides */
  }

  .search-overlay {
    /* Reserved for full-screen search overlay */
  }

  body.search-mode .search-overlay {
    opacity: 1;
    pointer-events: auto;
  }

  /* ========================================
   *  Filters Drawer (Right Panel)
   * ======================================== */

  .filters-drawer {
    position: fixed;
    inset: 0;
    background: rgba(var(--pages-shadow-rgb), 0.32);
    display: none;
    align-items: flex-start;
    justify-content: flex-end;
    padding: 32px;
    box-sizing: border-box;
    z-index: 40;
  }

  .filters-drawer[aria-hidden="false"] {
    display: flex;
  }

  .drawer-panel {
    width: 360px;
    max-width: calc(100% - 32px);
    background: var(--pages-white);
    border-radius: 20px;
    box-shadow: 0 24px 48px rgba(var(--pages-shadow-rgb), 0.28);
    padding: 28px;
    max-height: calc(100vh - 64px);
    display: flex;
    flex-direction: column;
    gap: 24px;
    overflow: hidden;
  }

  .drawer-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
  }

  .drawer-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 20px;
    font-weight: 700;
    margin: 0;
  }

  .drawer-title span {
    display: inline-flex;
    width: 36px;
    height: 36px;
    border-radius: 12px;
    align-items: center;
    justify-content: center;
    background: rgba(var(--pages-accent-rgb), 0.12);
    color: var(--pages-accent);
    font-size: 16px;
  }

  .drawer-close {
    background: transparent;
    border: none;
    color: var(--pages-muted);
    cursor: pointer;
    font-size: 18px;
    padding: 6px;
    border-radius: 8px;
    transition: background 0.2s ease;
  }

  .drawer-close:hover {
    background: rgba(148, 163, 184, 0.16);
    color: var(--pages-text);
  }

  .drawer-meta {
    font-size: 13px;
    color: var(--pages-muted);
  }

  .drawer-sections {
    display: flex;
    flex-direction: column;
    gap: 16px;
    flex: 1;
    overflow-y: auto;
    padding-right: 4px;
  }

  .drawer-section {
    border: 1px solid var(--pages-border);
    border-radius: 14px;
    background: #f8fafc;
    padding: 18px;
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .drawer-section + .drawer-section {
    margin-top: 4px;
  }

  .drawer-section-title {
    margin: 0;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    color: var(--pages-muted);
  }

  .section-content {
    padding: 0;
    display: grid;
    gap: 14px;
  }

  /* ========================================
   *  Drawer: Date Filters
   * ======================================== */

  .date-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px;
  }

  .date-grid label {
    display: flex;
    flex-direction: column;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    color: var(--pages-muted);
  }

  .date-grid input[type="date"] {
    padding: 8px 10px;
    font-size: 14px;
    font-family: inherit;
    color: var(--pages-text);
    background: var(--pages-white);
  }

  .date-hint {
    font-size: 12px;
    color: var(--pages-muted);
  }

  /* ========================================
   *  Drawer: Author Filters
   * ======================================== */

  .author-filter-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }

  .author-filter-chip {
    border: none;
    background: transparent;
    padding: 0;
    cursor: pointer;
  }

  .author-filter-chip .author-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    color: var(--pages-white);
    transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
  }

  .author-filter-chip[data-active="false"] .author-avatar {
    opacity: 0.48;
  }

  .author-filter-chip[data-active="true"] .author-avatar {
    opacity: 0.88;
  }

  .author-filter-chip[data-author-value="Morgan Lee"][data-active="true"] .author-avatar {
    box-shadow: none;
  }

  /* Author avatar color variants */
  .author-avatar[data-color="blue"] {
    background: linear-gradient(135deg, #2563eb, #4f46e5);
  }

  .author-avatar[data-color="purple"] {
    background: linear-gradient(135deg, #7c3aed, #c084fc);
  }

  .author-avatar[data-color="teal"] {
    background: linear-gradient(135deg, #0f766e, #14b8a6);
  }

  .author-avatar[data-color="amber"] {
    background: linear-gradient(135deg, #d97706, #f59e0b);
    color: #0f172a;
  }

  .author-avatar[data-color="pink"] {
    background: linear-gradient(135deg, #db2777, #f472b6);
  }

  .author-avatar[data-color="slate"] {
    background: linear-gradient(135deg, #475569, #94a3b8);
  }

  /* ========================================
   *  Drawer: Filter Pills & Type Chips
   * ======================================== */

  .filter-pill-group {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }

  .filter-pill {
    border-radius: 999px;
    border: 1px solid var(--pages-border);
    background: var(--pages-white);
    padding: 6px 14px;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    color: var(--pages-muted);
    transition: all 0.2s ease;
  }

  .filter-pill.is-active {
    background: var(--pages-accent);
    color: var(--pages-white);
    border-color: transparent;
    box-shadow: 0 12px 28px rgba(var(--pages-accent-rgb), 0.22);
  }

  .type-chip-group {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }

  .type-chip {
    border: none;
    border-radius: 12px;
    padding: 6px 12px;
    font-size: 13px;
    font-weight: 600;
    color: #1e293b;
    cursor: pointer;
    background: #e2e8f0;
    transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
  }

  .type-chip[data-active="false"] {
    filter: grayscale(0.4);
    opacity: 0.6;
  }

  .type-chip[data-active="true"] {
    transform: translateY(-1px);
    box-shadow: 0 10px 20px rgba(var(--pages-shadow-rgb), 0.18);
  }

  /* Type chip color variants */
  .type-chip[data-color="blue"] {
    background: rgba(var(--pages-accent-rgb), 0.15);
    color: #1d4ed8;
  }

  .type-chip[data-color="amber"] {
    background: rgba(217, 119, 6, 0.18);
    color: #b45309;
  }

  .type-chip[data-color="pink"] {
    background: rgba(219, 39, 119, 0.18);
    color: #be185d;
  }

  .type-chip[data-color="emerald"] {
    background: rgba(16, 185, 129, 0.18);
    color: #047857;
  }

  .type-chip[data-color="violet"] {
    background: rgba(139, 92, 246, 0.18);
    color: #5b21b6;
  }

  .type-chip[data-color="slate"] {
    background: rgba(100, 116, 139, 0.18);
    color: #475569;
  }

  /* ========================================
   *  Drawer: Report Checkboxes
   * ======================================== */

  .report-checkboxes {
    display: flex;
    flex-wrap: wrap;
    gap: 0px 16px; /* row-gap column-gap */
  }

  .report-checkbox {
    font-size: 13px;
    color: var(--pages-text);
    padding: 0 !important;
  }

  .report-checkbox input[type="checkbox"] {
    width: 16px;
    height: 16px;
    margin-top: 2px;
    border-radius: 4px;
    border: 1px solid var(--pages-border);
    accent-color: var(--pages-accent);
    cursor: pointer;
  }

  /* ========================================
   *  Drawer: Footer Buttons
   * ======================================== */

  .drawer-footer {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
  }

  .drawer-footer > div {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .drawer-footer button {
    border-radius: 999px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    font-size: 13px;
    padding: 10px 18px;
  }

  #clearFiltersButton {
    background: rgba(var(--pages-shadow-rgb), 0.06);
    color: var(--pages-muted);
  }

  #applyFiltersButton {
    /* Intentionally left for JS to style by class if needed */
  }

  .drawer-footer span {
    font-size: 12px;
    color: var(--pages-muted);
  }

  /* ========================================
   *  Avatars & Meta Info
   * ======================================== */

  .avatar {
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }

  .avatar span {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #e5e7eb;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
  }

  .avatar span[data-color="blue"] {
    background: linear-gradient(135deg, #2563eb, #4f46e5);
    color: var(--pages-white);
  }

  .avatar span[data-color="purple"] {
    background: linear-gradient(135deg, #7c3aed, #c084fc);
    color: var(--pages-white);
  }

  .avatar span[data-color="teal"] {
    background: linear-gradient(135deg, #0f766e, #14b8a6);
    color: var(--pages-white);
  }

  .avatar span[data-color="amber"] {
    background: linear-gradient(135deg, #d97706, #f59e0b);
    color: #0f172a;
  }

  .avatar span[data-color="pink"] {
    background: linear-gradient(135deg, #db2777, #f472b6);
    color: var(--pages-white);
  }

  .avatar span[data-color="slate"] {
    background: linear-gradient(135deg, #475569, #94a3b8);
    color: #f8fafc;
  }

  .meta {
    display: flex;
    flex-direction: column;
    gap: 4px;
    font-size: 12px;
    color: var(--pages-muted);
  }

  .meta strong {
    font-size: 14px;
    color: var(--pages-text);
  }

  /* ========================================
   *  Group / Folder Rows in Table
   * ======================================== */

  .group-row td {
    padding: 18px 24px;
    background: #eff0f2;
    border-top: 1px solid var(--pages-border);
    border-bottom: 1px solid var(--pages-border);
  }

  .group-row.is-filter-hidden {
    display: none;
  }

  .folder-header {
    display: flex;
    align-items: center;
    gap: 14px;
  }

  .folder-toggle {
    display: flex;
    align-items: center;
    gap: 14px;
    background: transparent;
    border: none;
    padding: 0;
    cursor: pointer;
    width: 100%;
    text-align: left;
  }

  .folder-toggle:focus-visible {
    outline: none;
  }

  .folder-toggle:focus-visible .folder-name {
    text-decoration: underline;
  }

  .folder-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: rgba(var(--pages-accent-rgb), 0.14);
    color: var(--pages-accent);
    font-size: 16px;
  }

  /* Folder icon color variants */
  .folder-icon[data-color='purple'] {
    background: rgba(124, 58, 237, 0.16);
    color: #7c3aed;
  }

  .folder-icon[data-color='teal'] {
    background: rgba(13, 148, 136, 0.18);
    color: #0f766e;
  }

  .folder-icon[data-color='amber'] {
    background: rgba(217, 119, 6, 0.2);
    color: #b45309;
  }

  .folder-icon[data-color='slate'] {
    background: rgba(148, 163, 184, 0.24);
    color: #475569;
  }

  .folder-details {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .folder-name {
    font-size: 14px;
    font-weight: 700;
    color: var(--pages-text);
  }

  .group-meta {
    font-size: 12px;
    color: var(--pages-muted);
    font-weight: 500;
    display: inline-flex;
  }

  .folder-count {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 999px;
    background: rgba(var(--pages-accent-rgb), 0.12);
    color: var(--pages-accent);
    font-weight: 600;
    line-height: 1;
  }

  .page-row[data-folder] td:first-child {
    padding-left: 56px;
  }

  .page-row[data-folder] td.checkbox-cell {
    padding-left: 48px;
  }

  .page-row[data-folder] td:nth-child(2) .title-cell {
    margin-left: 16px;
  }

  /* Flat view overrides */
  body.pages-flat-view .group-row {
    display: none !important;
  }

  body.pages-flat-view .page-row[data-folder] td:first-child {
    padding-left: 24px;
  }

  body.pages-flat-view .page-row[data-folder] td.checkbox-cell {
    padding-left: 20px;
  }

  body.pages-flat-view .page-row.is-collapsed {
    display: table-row !important;
  }

  .folder-actions {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    opacity: 0;
    transition: opacity 0.2s ease;
  }

  .group-row:hover .folder-actions,
  .group-row:focus-within .folder-actions {
    opacity: 1;
  }

  .folder-actions button {
    border: none;
    background: transparent;
    color: var(--pages-muted);
    padding: 6px;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.2s ease, color 0.2s ease;
  }

  .folder-actions button:hover {
    background: rgba(var(--pages-accent-rgb), 0.12);
    color: var(--pages-accent);
  }

  /* ========================================
   *  Row Actions & Action Menu
   * ======================================== */

  .actions {
    display: flex;
    justify-content: flex-end;
    gap: 6px;
  }

  .actions button {
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 6px 8px;
    border-radius: 8px;
    color: var(--pages-muted);
    transition: background 0.2s ease, color 0.2s ease;
  }

  .actions button:hover {
    background: rgba(var(--pages-accent-rgb), 0.12);
    color: var(--pages-accent);
  }

  .action-menu {
    position: relative;
  }

  .action-menu-trigger {
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .action-menu-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    min-width: 208px;
    padding: 8px 0;
    border-radius: 12px;
    background: var(--pages-white);
    box-shadow: 0 20px 45px rgba(var(--pages-shadow-rgb), 0.18);
    border: 1px solid rgba(var(--pages-shadow-rgb), 0.08);
    z-index: 20;
  }

  .action-menu-dropdown[hidden] {
    display: none;
  }

  .action-menu-item {
    width: 100%;
    padding: 10px 16px;
    background: transparent;
    border: none;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
    font-weight: 500;
    color: var(--pages-text);
    cursor: pointer;
    transition: background 0.2s ease, color 0.2s ease;
  }

  .action-menu-item .fa-solid,
  .action-menu-item .fa-regular {
    font-size: 16px;
    color: var(--pages-muted);
    transition: color 0.2s ease;
  }

  .action-menu-item:hover {
    background: rgba(var(--pages-accent-rgb), 0.08);
    color: var(--pages-accent);
  }

  .action-menu-item:hover .fa-solid,
  .action-menu-item:hover .fa-regular {
    color: var(--pages-accent);
  }

  .action-menu-item.is-destructive {
    color: #dc2626;
  }

  .action-menu-item.is-destructive .fa-solid {
    color: #dc2626;
  }

  .action-menu-item.is-destructive:hover {
    background: rgba(220, 38, 38, 0.12);
    color: #b91c1c;
  }

  .action-menu-item.is-destructive:hover .fa-solid {
    color: #b91c1c;
  }

  /* ========================================
   *  Reports Metrics & Trends
   * ======================================== */

  .reports-metric {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    font-weight: 500;
    color: var(--pages-muted);
  }

  .reports-metric strong {
    font-size: 14px;
    color: var(--pages-text);
  }

  .metric-trend {
    font-weight: 600;
  }

  .metric-trend.positive {
    color: #047857;
  }

  .metric-trend.negative {
    color: #b91c1c;
  }

  .metric-trend.neutral {
    color: var(--pages-muted);
  }

  /* ========================================
   *  Dialog Backdrop & Container
   * ======================================== */

  .dialog-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(var(--pages-shadow-rgb), 0.35);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    padding: 24px;
    box-sizing: border-box;
  }

  .dialog-backdrop[aria-hidden="false"] {
    display: flex;
  }

  .dialog {
    background: var(--pages-white);
    border-radius: 18px;
    padding: 28px;
    min-width: 320px;
    box-shadow: 0 25px 60px rgba(var(--pages-shadow-rgb), 0.18);
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .dialog-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
  }

  .dialog-header h2 {
    margin: 0;
    font-size: 20px;
  }

  .dialog-close {
    background: transparent;
    border: none;
    color: var(--pages-muted);
    cursor: pointer;
    font-size: 18px;
    padding: 6px;
    border-radius: 8px;
    transition: background 0.2s ease;
  }

  .dialog-close:hover {
    background: rgba(148, 163, 184, 0.16);
    color: var(--pages-text);
  }

  .dialog-options {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .dialog-option {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 14px 18px;
    border: 1px solid var(--pages-border);
    border-radius: 14px;
    background: var(--pages-white);
    cursor: pointer;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    text-align: left;
  }

  .dialog-option:hover {
    border-color: var(--pages-accent);
    box-shadow: 0 14px 30px rgba(var(--pages-accent-rgb), 0.16);
  }

  .dialog-option .icon-circle {
    background: #f8fafc;
    color: var(--pages-text);
    font-size: 20px;
  }

  .dialog-option span {
    font-weight: 600;
    color: var(--pages-text);
    font-size: 20px;
  }

  .dialog-option small {
    display: block;
    color: var(--pages-muted);
    font-size: 12px;
    margin-top: 2px;
  }

  .dialog-subtitle {
    margin: 0;
    font-size: 13px;
    color: var(--pages-muted);
  }

  .dialog-subtitle:empty {
    display: none;
  }

  .dialog-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
  }

  .checkbox-option {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--pages-text);
  }

  .checkbox-option input {
    width: 16px;
    height: 16px;
  }

  .dialog-actions button {
    padding: 10px 18px;
    border-radius: 10px;
    border: 1px solid var(--pages-border);
    background: var(--pages-white);
    font-weight: 600;
    cursor: pointer;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .dialog-actions button:hover {
    border-color: rgba(var(--pages-accent-rgb), 0.6);
    box-shadow: 0 10px 24px rgba(var(--pages-accent-rgb), 0.12);
  }

  .dialog-actions .primary {
    background: var(--pages-accent);
    color: var(--pages-white);
    border-color: var(--pages-accent);
    box-shadow: 0 12px 28px rgba(var(--pages-accent-rgb), 0.18);
  }

  .dialog-actions .primary:hover {
    box-shadow: 0 14px 32px rgba(var(--pages-accent-rgb), 0.22);
  }

  /* ========================================
   *  Folder & Page Settings Dialogs
   * ======================================== */

  .folder-dialog {
    max-width: 420px;
  }

  .folder-dialog form {
    display: flex;
    flex-direction: column;
    gap: 18px;
  }

  .page-settings-dialog {
    max-width: 520px;
  }

  .page-settings-dialog form {
    display: flex;
    flex-direction: column;
    gap: 18px;
  }

  .page-settings-tabs {
    display: flex;
    align-items: center;
    gap: 6px;
    border-bottom: 1px solid var(--pages-border);
    padding-bottom: 2px;
  }

  .page-settings-tab {
    position: relative;
    border: none;
    background: none;
    color: var(--pages-muted);
    font-weight: 600;
    font-size: 13px;
    padding: 10px 16px;
    border-radius: 10px 10px 0 0;
    cursor: pointer;
    transition: color 0.2s ease;
  }

  .page-settings-tab::after {
    content: "";
    position: absolute;
    left: 12px;
    right: 12px;
    bottom: -1px;
    height: 2px;
    background: transparent;
    transition: background 0.2s ease;
  }

  .page-settings-tab:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px rgba(var(--pages-accent-rgb), 0.25);
  }

  .page-settings-tab.is-active,
  .page-settings-tab[aria-selected='true'] {
    color: var(--pages-text);
  }

  .page-settings-tab.is-active::after,
  .page-settings-tab[aria-selected='true']::after {
    background: var(--pages-accent);
  }

  .page-settings-panels {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  .page-settings-panel {
    display: flex;
    flex-direction: column;
    gap: 18px;
  }

  .page-settings-panel[hidden] {
    display: none;
  }

  .page-settings-columns {
    display: grid;
    gap: 16px;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  }

  .page-settings-meta {
    display: grid;
    gap: 12px;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    font-size: 13px;
    color: var(--pages-muted);
  }

  .page-settings-meta div {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .page-settings-meta dt {
    font-weight: 600;
    color: var(--pages-text);
  }

  .page-settings-meta dd {
    margin: 2px 0 0;
  }

  /* ========================================
   *  Reusable Form Field Styles
   * ======================================== */

  .form-field {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .form-field label {
    font-weight: 600;
    font-size: 13px;
    color: var(--pages-muted);
  }

  .form-field input[type='text'] {
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid var(--pages-border);
    font-size: 14px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .form-field select,
  .form-field textarea {
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid var(--pages-border);
    font-size: 14px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .form-field textarea {
    min-height: 96px;
    resize: vertical;
  }

  .form-field input[type='text']:focus,
  .form-field select:focus,
  .form-field textarea:focus {
    outline: none;
    border-color: rgba(var(--pages-accent-rgb), 0.5);
    box-shadow: 0 0 0 3px rgba(var(--pages-accent-rgb), 0.18);
  }

  /* ========================================
   *  Color Swatches (Selection)
   * ======================================== */

  .color-swatches {
    display: flex;
    gap: 10px;
  }

  .color-swatch {
    position: relative;
    width: 32px;
    height: 32px;
    border-radius: 10px;
    border: 2px solid transparent;
    cursor: pointer;
    transition: transform 0.2s ease, border-color 0.2s ease;
  }

  .color-swatch input {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
  }

  .color-swatch span {
    position: absolute;
    inset: 0;
    border-radius: inherit;
  }

  .color-swatch[data-color='blue'] {
    background: rgba(var(--pages-accent-rgb), 0.18);
    border-color: rgba(var(--pages-accent-rgb), 0.4);
  }

  .color-swatch[data-color='purple'] {
    background: rgba(124, 58, 237, 0.18);
    border-color: rgba(124, 58, 237, 0.4);
  }

  .color-swatch[data-color='teal'] {
    background: rgba(13, 148, 136, 0.18);
    border-color: rgba(13, 148, 136, 0.4);
  }

  .color-swatch[data-color='amber'] {
    background: rgba(217, 119, 6, 0.18);
    border-color: rgba(217, 119, 6, 0.4);
  }

  .color-swatch input:checked + span,
  .color-swatch input:focus-visible + span {
    outline: 2px solid rgba(var(--pages-shadow-rgb), 0.2);
    outline-offset: 2px;
  }

  /* ========================================
   *  Copy Page & Action Dialogs
   * ======================================== */

  .copy-page-dialog {
    width: min(420px, 100%);
  }

  .copy-page-dialog form {
    display: flex;
    flex-direction: column;
    gap: 18px;
  }

  .copy-page-message {
    margin: 0;
    font-size: 14px;
    color: var(--pages-muted);
    line-height: 1.5;
  }

  .copy-page-message strong {
    color: var(--pages-text);
  }

  .action-dialog {
    width: min(500px, 100%);
  }

  .action-dialog-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .action-dialog-description {
    margin: 0;
    font-size: 14px;
    color: var(--pages-muted);
    line-height: 1.6;
  }

  .action-dialog-description strong {
    color: var(--pages-text);
  }

  .action-dialog-meta {
    margin: -10px 0 0;
    font-size: 12px;
    color: var(--pages-muted);
  }

  .action-dialog-field,
  .action-dialog-fieldset {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin: 0;
    padding: 0;
    border: none;
  }

  .action-dialog-field label,
  .action-dialog-fieldset > legend {
    font-size: 14px;
    font-weight: 600;
    color: var(--pages-text);
    margin: 0;
  }

  .action-dialog-fieldset > legend {
    padding: 0;
  }

  .action-dialog-field input,
  .action-dialog-field select,
  .action-dialog-field textarea {
    font: inherit;
    padding: 10px 12px;
    border: 1px solid var(--pages-border);
    border-radius: 12px;
    background: var(--pages-white);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .action-dialog-field textarea {
    min-height: 72px;
    resize: vertical;
  }

  .action-dialog-field input:focus,
  .action-dialog-field select:focus,
  .action-dialog-field textarea:focus {
    outline: none;
    border-color: rgba(var(--pages-accent-rgb), 0.45);
    box-shadow: 0 0 0 3px rgba(var(--pages-accent-rgb), 0.15);
  }

  .action-dialog-checkbox {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 14px;
    color: var(--pages-muted);
  }

  .action-dialog-checkbox input {
    margin-top: 2px;
  }

  .action-dialog-checkbox label {
    cursor: pointer;
  }

  .action-dialog-radio-group {
    display: grid;
    gap: 10px;
  }

  .action-dialog-radio {
    display: flex;
    gap: 14px;
    align-items: center;
    padding: 12px 16px;
    border: 1px solid var(--pages-border);
    border-radius: 14px;
    background: var(--pages-white);
    cursor: pointer;
    transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.15s ease;
  }

  .action-dialog-radio:hover {
    transform: translateY(-1px);
    border-color: rgba(var(--pages-accent-rgb), 0.35);
    box-shadow: 0 12px 24px rgba(var(--pages-shadow-rgb), 0.08);
  }

  .action-dialog-radio:focus-within {
    border-color: rgba(var(--pages-accent-rgb), 0.55);
    box-shadow: 0 0 0 3px rgba(var(--pages-accent-rgb), 0.18);
  }

  .action-dialog-radio input {
    flex-shrink: 0;
  }

  .action-dialog-radio-text {
    display: flex;
    flex-direction: column;
    gap: 4px;
    font-size: 13px;
    color: var(--pages-muted);
  }

  .action-dialog-radio-text strong {
    font-size: 14px;
    color: var(--pages-text);
  }

  .action-dialog-hint {
    margin: -0 0 0;
    font-size: 12px;
    color: red;
  }

  .action-dialog-warning {
    color: #b91c1c;
  }

  .action-dialog-optional {
    font-weight: 400;
    color: var(--pages-muted);
    font-size: 12px;
  }

  /* ========================================
   *  New Page Dialog (Wizard)
   * ======================================== */

  .new-page-dialog {
    position: relative;
    width: min(800px, 100%);
    padding: 36px;
    gap: 28px;
  }

  .new-page-dialog .dialog-close {
    position: absolute;
    top: 18px;
    right: 18px;
    color: var(--pages-muted);
  }

  .new-page-header {
    display: flex;
    align-items: flex-start;
    gap: 18px;
  }

  .new-page-header-icon {
    width: 60px;
    height: 60px;
    border-radius: 18px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    background: linear-gradient(135deg, rgba(var(--pages-accent-rgb), 0.15), rgba(14, 116, 144, 0.12));
    color: var(--pages-accent);
    box-shadow: inset 0 1px 0 rgba(var(--pages-white-rgb), 0.6), 0 14px 36px rgba(var(--pages-shadow-rgb), 0.12);
  }

  .new-page-header h2 {
    margin: 0;
    font-size: 26px;
    letter-spacing: -0.01em;
  }

  .new-page-header p {
    margin: 10px 0 0;
    color: var(--pages-muted);
    line-height: 1.5;
  }

  .new-page-form {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  /* New page tabs */
  .new-page-tabs {
    display: flex;
    align-items: center;
    gap: 6px;
    border-bottom: 1px solid var(--pages-border);
    padding-bottom: 2px;
  }

  .new-page-tab {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 18px;
    border: none;
    background: none;
    font: inherit;
    font-weight: 600;
    color: var(--pages-muted);
    cursor: pointer;
    border-radius: 10px 10px 0 0;
    transition: color 0.2s ease;
  }

  .new-page-tab::after {
    content: "";
    position: absolute;
    left: 12px;
    right: 12px;
    bottom: -1px;
    height: 2px;
    background: transparent;
    transition: background 0.2s ease;
  }

  .new-page-tab:hover {
    color: var(--pages-text);
  }

  .new-page-tab:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px rgba(var(--pages-accent-rgb), 0.24);
  }

  .new-page-tab.is-active,
  .new-page-tab[aria-selected='true'] {
    color: var(--pages-text);
  }

  .new-page-tab.is-active::after,
  .new-page-tab[aria-selected='true']::after {
    background: var(--pages-accent);
  }

  .new-page-tab-badge,
  .new-page-tab-check,
  .new-page-tab-text,
  .new-page-tab-title,
  .new-page-tab-description {
    display: none;
  }

  .new-page-tab-description {
    font-size: 12px;
    font-weight: 500;
    color: var(--pages-muted);
  }

  .new-page-tab.is-active .new-page-tab-description,
  .new-page-tab.is-complete .new-page-tab-description {
    color: rgba(var(--pages-accent-rgb), 0.8);
  }

  .new-page-step {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  .new-page-step[hidden] {
    display: none !important;
  }

  /* New page form groups & status options */
  .new-page-form-group {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .new-page-status-options {
    display: grid;
    gap: 10px;
  }

  .new-page-status-option {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 14px;
    border-radius: 14px;
    border: 1px solid rgba(148, 163, 184, 0.38);
    background: var(--pages-white);
    box-shadow: 0 8px 22px rgba(var(--pages-shadow-rgb), 0.06);
    transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
    cursor: pointer;
  }

  .new-page-status-option:hover,
  .new-page-status-option:focus-within {
    border-color: rgba(var(--pages-accent-rgb), 0.5);
    box-shadow: 0 12px 28px rgba(var(--pages-accent-rgb), 0.12);
    transform: translateY(-1px);
  }

  .new-page-status-option input {
    width: 18px;
    height: 18px;
    accent-color: var(--pages-accent);
    margin-right: 12px;
  }

  .new-page-status-label {
    display: flex;
    flex-direction: column;
    gap: 4px;
    font-weight: 600;
    color: var(--pages-text);
  }

  .new-page-status-label small {
    font-weight: 500;
    color: var(--pages-muted);
  }

  .new-page-schedule-fields {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 12px;
  }

  .new-page-schedule-fields input {
    border-radius: 12px;
    border: 1px solid rgba(148, 163, 184, 0.45);
    padding: 12px 14px;
    font-size: 14px;
    font-family: inherit;
    color: var(--pages-text);
    background: var(--pages-white);
    box-shadow: 0 6px 18px rgba(var(--pages-shadow-rgb), 0.05);
  }

  .new-page-schedule-fields input:focus {
    outline: none;
    border-color: rgba(var(--pages-accent-rgb), 0.55);
    box-shadow: 0 0 0 4px rgba(var(--pages-accent-rgb), 0.16);
  }

  .new-page-hint {
    margin: 0;
    font-size: 12px;
    color: var(--pages-muted);
  }

  .wizard-section {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .new-page-dialog .dialog-actions {
    margin-top: 8px;
  }

  /* ========================================
   *  Wizard Fields & Controls
   * ======================================== */

  .wizard-field {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .wizard-field label {
    font-weight: 600;
    font-size: 13px;
    color: var(--pages-muted);
  }

  .wizard-inline-controls {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .wizard-checkbox {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    color: var(--pages-text);
  }

  .wizard-checkbox input {
    width: 18px;
    height: 18px;
    accent-color: var(--pages-accent);
  }

  .wizard-radio-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .wizard-radio {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 16px;
    border: 1px solid var(--pages-border);
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
    background: var(--pages-white);
  }

  .wizard-radio:hover {
    border-color: rgba(var(--pages-accent-rgb), 0.3);
    background: rgba(var(--pages-accent-rgb), 0.02);
  }

  .wizard-radio input[type="radio"] {
    margin-top: 2px;
    width: 18px;
    height: 18px;
    accent-color: var(--pages-accent);
    cursor: pointer;
  }

  .wizard-radio input[type="radio"]:checked + .wizard-radio-content {
    color: var(--pages-text);
  }

  .wizard-radio:has(input[type="radio"]:checked) {
    border-color: var(--pages-accent);
    background: rgba(var(--pages-accent-rgb), 0.05);
  }

  .wizard-radio-content {
    display: flex;
    flex-direction: column;
    gap: 4px;
    flex: 1;
  }

  .wizard-radio-content strong {
    font-weight: 600;
    font-size: 14px;
    color: var(--pages-text);
  }

  .wizard-radio-content small {
    font-size: 13px;
    color: var(--pages-muted);
  }

  .wizard-schedule-fields {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-top: 12px;
    padding: 16px;
    border: 1px solid var(--pages-border);
    border-radius: 12px;
    background: rgba(var(--pages-accent-rgb), 0.02);
  }

  .wizard-schedule-fields .wizard-field {
    margin: 0;
  }

  .wizard-schedule-fields input[type="date"],
  .wizard-schedule-fields input[type="time"] {
    width: 100%;
    padding: 10px 12px;
    font-size: 14px;
    background: var(--pages-white);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .wizard-schedule-fields input:focus {
    outline: none;
    border-color: rgba(var(--pages-accent-rgb), 0.45);
    box-shadow: 0 0 0 3px rgba(var(--pages-accent-rgb), 0.18);
  }

  .wizard-schedule-fields label {
    display: block;
    font-weight: 600;
    font-size: 13px;
    color: var(--pages-text);
    margin-bottom: 6px;
  }

  /* ========================================
   *  Wizard Template Picker
   * ======================================== */

  .wizard-template-picker {
    border: 1px solid var(--pages-border);
    border-radius: 14px;
    padding: 18px;
    background: var(--pages-white);
    display: flex;
    flex-direction: column;
    gap: 16px;
    box-shadow: 0 8px 28px rgba(var(--pages-shadow-rgb), 0.08);
  }

  .wizard-template-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
    color: var(--pages-text);
  }

  .wizard-template-change {
    border: none;
    background: none;
    color: var(--pages-accent);
    font-weight: 600;
    cursor: pointer;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .wizard-template-options {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }

  .wizard-template-option {
    border: none;
    border-radius: 12px;
    padding: 10px 16px;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    background: var(--template-choice-bg, rgba(148, 163, 184, 0.18));
    color: var(--template-choice-color, #334155);
    transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
  }

  .wizard-template-option[data-selected='false'] {
    filter: grayscale(0.35);
    opacity: 0.72;
  }

  .wizard-template-option[data-selected='true'] {
    transform: translateY(-1px);
    box-shadow: 0 12px 24px rgba(var(--pages-shadow-rgb), 0.18);
    filter: none;
  }

  .wizard-template-option:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px rgba(var(--pages-accent-rgb), 0.24);
  }

  /* Template picker accent variants */
  .wizard-template-option[data-accent='blue'] {
    --template-choice-bg: rgba(var(--pages-accent-rgb), 0.16);
    --template-choice-color: #1d4ed8;
  }

  .wizard-template-option[data-accent='violet'] {
    --template-choice-bg: rgba(139, 92, 246, 0.18);
    --template-choice-color: #5b21b6;
  }

  .wizard-template-option[data-accent='indigo'] {
    --template-choice-bg: rgba(79, 70, 229, 0.18);
    --template-choice-color: #4338ca;
  }

  .wizard-template-option[data-accent='rose'] {
    --template-choice-bg: rgba(244, 63, 94, 0.18);
    --template-choice-color: #e11d48;
  }

  .wizard-template-option[data-accent='amber'] {
    --template-choice-bg: rgba(217, 119, 6, 0.2);
    --template-choice-color: #b45309;
  }

  .wizard-template-option[data-accent='emerald'] {
    --template-choice-bg: rgba(16, 185, 129, 0.2);
    --template-choice-color: #047857;
  }

  .wizard-template-option[data-accent='pink'] {
    --template-choice-bg: rgba(219, 39, 119, 0.2);
    --template-choice-color: #be185d;
  }

  .wizard-template-option[data-accent='orange'] {
    --template-choice-bg: rgba(249, 115, 22, 0.2);
    --template-choice-color: #c2410c;
  }

  .wizard-template-option[data-accent='slate'] {
    --template-choice-bg: rgba(148, 163, 184, 0.2);
    --template-choice-color: #334155;
  }

  .wizard-checkbox-grid {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .wizard-checkbox-grid .wizard-checkbox {
    font-weight: 500;
    color: var(--pages-muted);
    padding: 0;
  }

  /* ========================================
   *  Page Settings Choice Chips
   * ======================================== */

  .page-settings-choice-group {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .page-settings-choice-header {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .page-settings-choice-header.span {
    font-weight: 600;
    font-size: 13px;
    color: var(--pages-text);
  }

  .page-settings-choice-header p {
    margin: 0;
    font-size: 12px;
    color: var(--pages-muted);
  }

  .page-settings-choices {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }

  .page-settings-choice {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: none;
    border-radius: 12px;
    padding: 10px 16px;
    padding-right: 44px;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    background: var(--choice-bg, rgba(148, 163, 184, 0.18));
    color: var(--choice-color, #334155);
    transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
  }

  .page-settings-choice input[type='radio'] {
    position: absolute;
    inset: 0;
    opacity: 0;
    pointer-events: none;
  }

  .page-settings-choice::after {
    content: "✓";
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%) scale(0.85);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    border-radius: 999px;
    border: 2px solid currentColor;
    background: rgba(255, 255, 255, 0.9);
    color: currentColor;
    opacity: 0;
    transition: opacity 0.2s ease, transform 0.2s ease;
  }

  .page-settings-choice[data-selected='false'],
  .page-settings-choice[aria-checked='false'] {
    padding: 5px 10px 5px 0px;
  }

  .page-settings-choice[data-selected='true'],
  .page-settings-choice[aria-checked='true'] {
    transform: translateY(-1px);
    box-shadow: 0 12px 24px rgba(var(--pages-shadow-rgb), 0.18);
    filter: none;
  }

  .page-settings-choice[data-selected='true']::after,
  .page-settings-choice[aria-checked='true']::after {
    opacity: 1;
    transform: translateY(-50%) scale(1);
  }

  .page-settings-choice:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px rgba(var(--pages-accent-rgb), 0.24);
  }

  .page-settings-choice[data-accent='blue'] {
    --choice-bg: rgba(var(--pages-accent-rgb), 0.16);
    --choice-color: #1d4ed8;
  }

  .page-settings-choice[data-accent='violet'] {
    --choice-bg: rgba(139, 92, 246, 0.18);
    --choice-color: #5b21b6;
  }

  .page-settings-choice[data-accent='amber'] {
    --choice-bg: rgba(217, 119, 6, 0.2);
    --choice-color: #b45309;
  }

  .page-settings-choice[data-accent='emerald'] {
    --choice-bg: rgba(16, 185, 129, 0.2);
    --choice-color: #047857;
  }

  .page-settings-choice[data-accent='pink'] {
    --choice-bg: rgba(219, 39, 119, 0.2);
    --choice-color: #be185d;
  }

  .page-settings-choice[data-accent='slate'] {
    --choice-bg: rgba(148, 163, 184, 0.2);
    --choice-color: #334155;
  }

  /* ========================================
   *  Wizard Field Inputs & File Drop
   * ======================================== */

  .wizard-field input[type='text'],
  .wizard-field input[type='url'],
  .wizard-field textarea,
  .wizard-field select {
    padding: 12px 14px;
    border-radius: 12px;
    border: 1px solid var(--pages-border);
    font-size: 14px;
    background: var(--pages-white);
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }

  .wizard-field textarea {
    min-height: 96px;
    resize: vertical;
  }

  .wizard-field input:focus,
  .wizard-field textarea:focus,
  .wizard-field select:focus {
    outline: none;
    border-color: rgba(var(--pages-accent-rgb), 0.45);
    box-shadow: 0 0 0 3px rgba(var(--pages-accent-rgb), 0.18);
  }

  .wizard-file-drop {
    border: 1px dashed rgba(148, 163, 184, 0.65);
    border-radius: 14px;
    background: rgba(148, 163, 184, 0.08);
    padding: 24px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    text-align: center;
    color: var(--pages-muted);
  }

  .wizard-file-drop i {
    font-size: 28px;
    color: var(--pages-muted);
  }

  .wizard-file-drop strong {
    color: var(--pages-text);
  }

  .wizard-file-drop input[type='file'] {
    display: none;
  }

  .wizard-file-actions {
    display: flex;
    gap: 8px;
    align-items: center;
  }

  .wizard-file-actions button,
  .wizard-file-actions label {
    border: none;
    background: var(--pages-accent);
    color: var(--pages-white);
    padding: 8px 14px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
  }

  .wizard-file-actions button.danger {
    background: var(--pages-danger);
  }

  .wizard-helper-text {
    margin: 0;
    font-size: 12px;
    color: var(--pages-muted);
  }

  .wizard-select-note {
    margin: 0;
    font-size: 12px;
    color: var(--pages-muted);
  }

  /* ========================================
   *  New Page Basic Inputs
   * ======================================== */

  .new-page-question {
    font-size: 15px;
    font-weight: 600;
    color: var(--pages-text);
  }

  .new-page-input,
  .new-page-select {
    width: 100%;
    padding: 14px 16px;
    border-radius: 14px;
    border: 1px solid rgba(148, 163, 184, 0.45);
    font-size: 15px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    background: var(--pages-white);
    color: var(--pages-text);
    box-shadow: 0 8px 24px rgba(var(--pages-shadow-rgb), 0.04);
  }

  .new-page-input:focus,
  .new-page-select:focus {
    outline: none;
    border-color: rgba(var(--pages-accent-rgb), 0.55);
    box-shadow: 0 0 0 4px rgba(var(--pages-accent-rgb), 0.16);
  }

  .new-page-input::placeholder {
    color: rgba(107, 114, 128, 0.8);
  }

  .new-page-select {
    appearance: none;
    background-image:
      linear-gradient(45deg, transparent 50%, rgba(107, 114, 128, 0.6) 50%),
      linear-gradient(135deg, rgba(107, 114, 128, 0.6) 50%, transparent 50%);
    background-position: calc(100% - 22px) calc(50% + 3px),
      calc(100% - 16px) calc(50% + 3px);
    background-size: 6px 6px, 6px 6px;
    background-repeat: no-repeat;
    padding-right: 44px;
  }

  .new-page-select:focus {
    background-image:
      linear-gradient(45deg, transparent 50%, rgba(var(--pages-accent-rgb), 0.8) 50%),
      linear-gradient(135deg, rgba(var(--pages-accent-rgb), 0.8) 50%, transparent 50%);
  }

  .new-page-type-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 12px;
  }

  .new-page-type-option {
    border-radius: 14px;
    border: 1px solid rgba(148, 163, 184, 0.32);
    padding: 14px 12px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
    text-align: center;
    background: rgba(241, 245, 249, 0.72);
    color: var(--pages-text);
    appearance: none;
    outline: none;
  }

  .new-page-type-option:hover,
  .new-page-type-option:focus-visible {
    border-color: rgba(var(--pages-accent-rgb), 0.6);
    /* box-shadow: 0 12px 28px rgba(var(--pages-accent-rgb), 0.16); */
    outline: none;
    transform: translateY(-1px);
  }

  .new-page-type-option.selected {
    transform: translateY(-1px);
    border-color: transparent;
    /* box-shadow: 0 14px 32px rgba(var(--pages-shadow-rgb), 0.12); */
  }

  /* New page type accent variants */
  .new-page-type-option.accent-blue {
    background: rgba(var(--pages-accent-rgb), 0.16);
    color: #1d4ed8;
  }

  .new-page-type-option.accent-purple {
    background: rgba(124, 58, 237, 0.16);
    color: #6d28d9;
  }

  .new-page-type-option.accent-pink {
    background: rgba(236, 72, 153, 0.16);
    color: #db2777;
  }

  .new-page-type-option.accent-green {
    background: rgba(16, 185, 129, 0.16);
    color: #047857;
  }

  .new-page-type-option.accent-amber {
    background: rgba(251, 191, 36, 0.2);
    color: #b45309;
  }

  .new-page-type-option.accent-indigo {
    background: rgba(99, 102, 241, 0.18);
    color: #4338ca;
  }

  .new-page-type-option.accent-cyan {
    background: rgba(6, 182, 212, 0.18);
    color: #0e7490;
  }

  .new-page-type-option.accent-rose {
    background: rgba(244, 114, 182, 0.18);
    color: #be185d;
  }

  .new-page-type-option.accent-orange {
    background: rgba(249, 115, 22, 0.2);
    color: #c2410c;
  }

  .new-page-type-option.selected.accent-blue {
    box-shadow: 0 16px 34px rgba(var(--pages-accent-rgb), 0.28);
  }

  .new-page-type-option.selected.accent-purple {
    /* box-shadow: 0 16px 34px rgba(124, 58, 237, 0.26); */
  }

  .new-page-type-option.selected.accent-pink {
    box-shadow: 0 16px 34px rgba(236, 72, 153, 0.28);
  }

  .new-page-type-option.selected.accent-green {
    box-shadow: 0 16px 34px rgba(16, 185, 129, 0.26);
  }

  .new-page-type-option.selected.accent-amber {
    box-shadow: 0 16px 34px rgba(245, 158, 11, 0.26);
  }

  .new-page-type-option.selected.accent-indigo {
    box-shadow: 0 16px 34px rgba(99, 102, 241, 0.26);
  }

  .new-page-type-option.selected.accent-cyan {
    box-shadow: 0 16px 34px rgba(6, 182, 212, 0.26);
  }

  .new-page-type-option.selected.accent-rose {
    box-shadow: 0 16px 34px rgba(244, 114, 182, 0.28);
  }

  .new-page-type-option.selected.accent-orange {
    box-shadow: 0 16px 34px rgba(249, 115, 22, 0.26);
  }

  /* ========================================
   *  Responsive Layout
   * ======================================== */

  @media (max-width: 1440px) {
    .analytics-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }
  }

  @media (max-width: 960px) {
    .analytics-grid {
      grid-template-columns: 1fr;
    }

    .page-analytics-drawer {
      padding: 24px;
    }

    .pages-shell {
      padding: 12px 16px 48px;
    }

    .pages-toolbar {
      position: sticky;
      top: 0;
      padding-top: 8px;
      gap: 12px;
    }

    .pages-tabs-row {
      flex-direction: column;
      align-items: stretch;
      gap: 12px;
    }

    .search-input {
      width: 100%;
    }

    .search-input input {
      width: 100%;
    }

    .pages-tabs {
      flex-wrap: wrap;
    }

    .pages-card {
      overflow-x: auto;
    }

    .page-row[data-folder] td:first-child {
      padding-left: 32px;
    }

    body.pages-flat-view .page-row[data-folder] td:first-child {
      padding-left: 24px;
    }

    .page-row[data-folder] td:nth-child(2) .title-cell {
      margin-left: 12px;
    }

    .dialog {
      width: 100%;
    }

    .drawer-panel {
      width: 100%;
    }
  }
</style>


<div class="mwDskTools">

	<h1>Pages</h1>
	
	<div class="search-input">
              <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
              <input type="search" id="pagesSearch" placeholder="Search pages" aria-label="Search pages">
              <span class="shortcut-hint" aria-hidden="true">⌘ /</span>
            </div>
	
	
        <a class="Add" onclick="mwWindow('wFilterit').show();">Filter</a>

        <a class="Add" onclick="mwWindow('wPagesettings').show();">New Page</a>
        <a class="Add" onclick="mwWindow('wNewfolder').show();">New Folder</a>

        <div class="quick-actions" aria-label="View controls">
          <button
            class="icon-button"
            type="button"
            title="Show pages without folders"
            aria-label="Show pages without folders"
            data-flat-view-toggle
            data-tooltip="Show pages without folders"
            aria-pressed="false"
          >
            <i class="fa-solid fa-list" data-flat-view-icon aria-hidden="true"></i>
          </button>
          <button
            class="icon-button"
            type="button"
            title="Toggle view"
            aria-label="Toggle view"
            data-folder-toggle-all
            data-tooltip="Toggle view"
          >
            <i class="fa-solid fa-folder" data-folder-view-icon aria-hidden="true"></i>
          </button>
        </div>


</div>




<div class="mwDesktop" >

	

	
  <div class="pages-shell">
    <div class="search-overlay" aria-hidden="true"></div>
    <div class="pages-toolbar">
      
		
      <div class="pages-tabs-row">
        <nav class="pages-tabs" role="tablist" aria-label="Page status scopes">
          <button class="tab-button active" type="button" role="tab" aria-selected="true" data-status-tab="all">All <span class="tab-badge" data-status-count="all">0</span></button>
          <button class="tab-button" type="button" role="tab" aria-selected="false" data-status-tab="published">Published <span class="tab-badge" data-status-count="published">0</span></button>
          <button class="tab-button" type="button" role="tab" aria-selected="false" data-status-tab="unpublished">Unpublished <span class="tab-badge" data-status-count="unpublished">0</span></button>
          <button class="tab-button" type="button" role="tab" aria-selected="false" data-status-tab="draft">Drafts <span class="tab-badge" data-status-count="draft">0</span></button>
          <button class="tab-button" type="button" role="tab" aria-selected="false" data-status-tab="scheduled">Scheduled <span class="tab-badge" data-status-count="scheduled">0</span></button>
          <button class="tab-button" type="button" role="tab" aria-selected="false" data-status-tab="trash">Trash <span class="tab-badge" data-status-count="trash">0</span></button>
        </nav>
		  
      </div>

      <div class="filter-chips" id="filterChips" hidden aria-live="polite"></div>
      <div class="bulk-actions-bar" id="bulkActionsBar" aria-hidden="true">
        <div class="bulk-summary">
          <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
          <span id="selectionCount">0 selected</span>
        </div>
        <div class="bulk-actions" role="group" aria-label="Bulk actions">
          <button type="button" data-bulk-action="publish" onclick="mwWindow('wBulkPublish').show();"><i class="fa-solid fa-globe" aria-hidden="true"></i>Publish</button>
          <button type="button" data-bulk-action="unpublish" onclick="mwWindow('wBulkUnpublish').show();"><i class="fa-solid fa-toggle-off" aria-hidden="true"></i>Unpublish</button>
          <button type="button" data-bulk-action="move" onclick="mwWindow('wBulkMovePagestoFolder').show();"><i class="fa-solid fa-folder-arrow-down" aria-hidden="true"></i>Move to Folder</button>
          <button type="button" data-bulk-action="delete" onclick="mwWindow('wBulkMovetoTrash').show();"><i class="fa-solid fa-trash-can" aria-hidden="true"></i>Trash</button>
          <button type="button" class="bulk-clear" id="clearSelectionButton"><i class="fa-solid fa-xmark" aria-hidden="true"></i>Clear Selection</button>
        </div>
      </div>
    </div>

    <div class="pages-card">
      <table class="pages-table">
        <colgroup>
          <col class="checkbox-col">
          <col class="wide">
          <col>
          <col>
          <col>
          <col>
          <col>
          <col>
          <col>
        </colgroup>
        <thead>
          <tr>
            <th scope="col" class="checkbox-cell">
              <label class="checkbox" aria-label="Select all pages">
                <input type="checkbox" id="masterCheckbox">
              </label>
            </th>
            <th scope="col">Title</th>
            <th scope="col">
              <button type="button" class="sort-button" data-sort-key="status" data-direction="desc">
                <span>Status</span>
                <span class="sort-indicator" aria-hidden="true">▲</span>
              </button>
            </th>
            <th scope="col">
              <button type="button" class="sort-button" data-sort-key="type" data-direction="asc">
                <span>Type</span>
                <span class="sort-indicator" aria-hidden="true">▲</span>
              </button>
            </th>
            <th scope="col">
              <button type="button" class="sort-button" data-sort-key="author" data-direction="asc">
                <span>Author</span>
                <span class="sort-indicator" aria-hidden="true">▲</span>
              </button>
            </th>
            <th scope="col">
              <button type="button" class="sort-button" data-sort-key="reports" data-direction="desc">
                <span>Reports</span>
                <span class="sort-indicator" aria-hidden="true">▲</span>
              </button>
            </th>
            <th scope="col">
              <button type="button" class="sort-button" data-sort-key="created" data-direction="desc">
                <span>Created</span>
                <span class="sort-indicator" aria-hidden="true">▲</span>
              </button>
            </th>
            <th scope="col">
              <button type="button" class="sort-button" data-sort-key="modified" data-direction="desc">
                <span>Modified</span>
                <span class="sort-indicator" aria-hidden="true">▲</span>
              </button>
            </th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="page-row is-homepage"
            data-page-id="home"
            data-status="published"
            data-type="Home"
            data-author="Jordan Blake"
            data-title="Home"
            data-created="2024-11-01"
            data-modified="2025-07-22"
            data-report-value="12800"
            data-report-trend="12"
            data-report-direction="up"
            data-report-issues="performance"
            data-pinned="true"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Home">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="home">Home</button>
                  <span class="subtitle">home</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Home</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Jordan Blake"
                title="Jordan Blake"
                aria-label="Filter by Jordan Blake"
              >
                <div class="avatar">
                  <span aria-hidden="true">JB</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="home">
                <div class="reports-metric" data-trend="up">
                  <strong>12.8k views</strong>
                  <span class="metric-trend up">+12% vs last month</span>
                </div>
              </button>
            </td>
            <td data-created-label>Nov 01, 2024</td>
            <td data-modified-label>Jul 22, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="group-row"
            data-folder="about-us"
            data-folder-total="4"
            data-folder-name="About Us"
            data-folder-color="blue"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-folder-checkbox data-folder-id="about-us" aria-label="Select folder About Us">
              </label>
            </td>
            <td colspan="8">
              <div class="folder-header">
                <button type="button" class="folder-toggle" data-folder-toggle="about-us" aria-expanded="true">
                  <span class="folder-icon" aria-hidden="true"><i class="fa-solid fa-folder-open" data-folder-icon></i></span>
                  <div class="folder-details">
                    <span class="folder-name">About Us</span>
                    <span class="group-meta"><span class="folder-count" data-folder-count>4 pages</span></span>
                  </div>
                </button>
                <div class="folder-actions" role="group" aria-label="About Us folder actions">
                  <button type="button" data-folder-action="rename" aria-label="Rename folder" data-tooltip="Rename folder" onclick="mwWindow('wFoldersettings').show();"><i class="fa-solid fa-pen-to-square"></i></button>
                  <button type="button" data-folder-action="move" aria-label="Move folder" data-tooltip="Move folder" onclick="mwWindow('wMoveFolder').show();"><i class="fa-solid fa-arrow-right-arrow-left" ></i></button>
                  <button type="button" data-folder-action="delete" aria-label="Trash folder" data-tooltip="Trash folder" onclick="mwWindow('wTrashfolder').show();" ><i class="fa-solid fa-trash-can"></i></button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="about-us"
            data-page-id="our-team"
            data-status="published"
            data-type="Content"
            data-author="Amelia Reed"
            data-title="Our Team"
            data-created="2025-01-12"
            data-modified="2025-06-30"
            data-report-value="4200"
            data-report-trend="6"
            data-report-direction="up"
            data-report-issues="profiles"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Our Team">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="our-team">Our Team</button>
                  <span class="subtitle">about/our-team</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Content</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Amelia Reed"
                title="Amelia Reed"
                aria-label="Filter by Amelia Reed"
              >
                <div class="avatar">
                  <span aria-hidden="true">AR</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="our-team">
                <div class="reports-metric" data-trend="up">
                  <strong>4.2k views</strong>
                  <span class="metric-trend up">+6% engagement</span>
                </div>
              </button>
            </td>
            <td data-created-label>Jan 12, 2025</td>
            <td data-modified-label>Jun 30, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="about-us"
            data-page-id="our-history"
            data-status="published"
            data-type="Blog"
            data-author="Jordan Blake"
            data-title="Our History"
            data-created="2025-01-18"
            data-modified="2025-05-24"
            data-report-value="1875"
            data-report-trend="3"
            data-report-direction="up"
            data-report-issues="none"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Our History">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="our-history">Our History</button>
                  <span class="subtitle">about/our-history</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Blog</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Jordan Blake"
                title="Jordan Blake"
                aria-label="Filter by Jordan Blake"
              >
                <div class="avatar">
                  <span aria-hidden="true">JB</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="our-history">
                <div class="reports-metric" data-trend="up">
                  <strong>1.9k views</strong>
                  <span class="metric-trend up">+3% readership</span>
                </div>
              </button>
            </td>
            <td data-created-label>Jan 18, 2025</td>
            <td data-modified-label>May 24, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="about-us"
            data-page-id="our-locations"
            data-status="published"
            data-type="Contact"
            data-author="Priya Patel"
            data-title="Our Locations"
            data-created="2025-02-02"
            data-modified="2025-06-12"
            data-report-value="980"
            data-report-trend="4"
            data-report-direction="up"
            data-report-issues="maps"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Our Locations">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="our-locations">Our Locations</button>
                  <span class="subtitle">about/our-locations</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Contact</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Priya Patel"
                title="Priya Patel"
                aria-label="Filter by Priya Patel"
              >
                <div class="avatar">
                  <span aria-hidden="true">PP</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="our-locations">
                <div class="reports-metric" data-trend="up">
                  <strong>980 views</strong>
                  <span class="metric-trend up">Branch lookups ↑</span>
                </div>
              </button>
            </td>
            <td data-created-label>Feb 02, 2025</td>
            <td data-modified-label>Jun 12, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="about-us"
            data-page-id="annual-reports"
            data-status="scheduled"
            data-type="Content"
            data-author="Daniel Ortiz"
            data-title="Annual Reports"
            data-created="2025-03-04"
            data-modified="2025-07-10"
            data-report-value="0"
            data-report-trend="0"
            data-report-direction="neutral"
            data-report-issues="pending-release"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Annual Reports">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="annual-reports">Annual Reports</button>
                  <span class="subtitle">about/annual-reports</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge scheduled">Scheduled</span></span>
            </td>
            <td><span class="chip">Content</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Daniel Ortiz"
                title="Daniel Ortiz"
                aria-label="Filter by Daniel Ortiz"
              >
                <div class="avatar">
                  <span aria-hidden="true">DO</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="annual-reports">
                <div class="reports-metric" data-trend="neutral">
                  <strong>--</strong>
                  <span class="metric-trend neutral">Goes live Aug 01</span>
                </div>
              </button>
            </td>
            <td data-created-label>Mar 04, 2025</td>
            <td data-modified-label>Jul 10, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="group-row"
            data-folder="programs"
            data-folder-total="3"
            data-folder-name="Programs"
            data-folder-color="teal"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-folder-checkbox data-folder-id="programs" aria-label="Select folder Programs">
              </label>
            </td>
            <td colspan="8">
              <div class="folder-header">
                <button type="button" class="folder-toggle" data-folder-toggle="programs" aria-expanded="true">
                  <span class="folder-icon" data-color="teal" aria-hidden="true"><i class="fa-solid fa-folder-open" data-folder-icon></i></span>
                  <div class="folder-details">
                    <span class="folder-name">Programs</span>
                    <span class="group-meta"><span class="folder-count" data-folder-count>3 pages</span></span>
                  </div>
                </button>
                <div class="folder-actions" role="group" aria-label="Programs folder actions">
                  <button type="button" data-folder-action="rename" aria-label="Rename folder" data-tooltip="Rename folder" onclick="mwWindow('wFoldersettings').show();"><i class="fa-solid fa-pen-to-square"></i></button>
                  <button type="button" data-folder-action="move" aria-label="Move folder" data-tooltip="Move folder" onclick="mwWindow('wMoveFolder').show();"><i class="fa-solid fa-arrow-right-arrow-left"></i></button>
                  <button type="button" data-folder-action="delete" aria-label="Trash folder" data-tooltip="Trash folder" onclick="mwWindow('wTrashfolder').show();" ><i class="fa-solid fa-trash-can"></i></button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="programs"
            data-page-id="program-a"
            data-status="published"
            data-type="Event"
            data-author="Priya Patel"
            data-title="Program A"
            data-created="2025-01-28"
            data-modified="2025-07-18"
            data-report-value="3120"
            data-report-trend="9"
            data-report-direction="up"
            data-report-issues="impact-metrics"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Program A">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="program-a">Program A</button>
                  <span class="subtitle">programs/program-a</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Event</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Priya Patel"
                title="Priya Patel"
                aria-label="Filter by Priya Patel"
              >
                <div class="avatar">
                  <span aria-hidden="true">PP</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="program-a">
                <div class="reports-metric" data-trend="up">
                  <strong>3.1k views</strong>
                  <span class="metric-trend up">+9% inquiries</span>
                </div>
              </button>
            </td>
            <td data-created-label>Jan 28, 2025</td>
            <td data-modified-label>Jul 18, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="programs"
            data-page-id="program-b"
            data-status="draft"
            data-type="Event"
            data-author="Daniel Ortiz"
            data-title="Program B"
            data-created="2025-02-11"
            data-modified="2025-07-05"
            data-report-value="0"
            data-report-trend="0"
            data-report-direction="neutral"
            data-report-issues="draft"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Program B">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="program-b">Program B</button>
                  <span class="subtitle">programs/program-b</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge draft">Draft</span></span>
            </td>
            <td><span class="chip">Event</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Daniel Ortiz"
                title="Daniel Ortiz"
                aria-label="Filter by Daniel Ortiz"
              >
                <div class="avatar">
                  <span aria-hidden="true">DO</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="program-b">
                <div class="reports-metric" data-trend="neutral">
                  <strong>--</strong>
                  <span class="metric-trend neutral">Draft in progress</span>
                </div>
              </button>
            </td>
            <td data-created-label>Feb 11, 2025</td>
            <td data-modified-label>Jul 05, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="programs"
            data-page-id="impact-metrics"
            data-status="published"
            data-type="Content"
            data-author="Amelia Reed"
            data-title="Impact Metrics"
            data-created="2025-03-08"
            data-modified="2025-07-14"
            data-report-value="540"
            data-report-trend="5"
            data-report-direction="up"
            data-report-issues="data-quality"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Impact Metrics">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="impact-metrics">Impact Metrics</button>
                  <span class="subtitle">programs/impact-metrics</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Content</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Amelia Reed"
                title="Amelia Reed"
                aria-label="Filter by Amelia Reed"
              >
                <div class="avatar">
                  <span aria-hidden="true">AR</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="impact-metrics">
                <div class="reports-metric" data-trend="up">
                  <strong>540 downloads</strong>
                  <span class="metric-trend up">+5% completions</span>
                </div>
              </button>
            </td>
            <td data-created-label>Mar 08, 2025</td>
            <td data-modified-label>Jul 14, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="group-row"
            data-folder="get-involved"
            data-folder-total="3"
            data-folder-name="Get Involved"
            data-folder-color="purple"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-folder-checkbox data-folder-id="get-involved" aria-label="Select folder Get Involved">
              </label>
            </td>
            <td colspan="8">
              <div class="folder-header">
                <button type="button" class="folder-toggle" data-folder-toggle="get-involved" aria-expanded="true">
                  <span class="folder-icon" data-color="purple" aria-hidden="true"><i class="fa-solid fa-folder-open" data-folder-icon></i></span>
                  <div class="folder-details">
                    <span class="folder-name">Get Involved</span>
                    <span class="group-meta"><span class="folder-count" data-folder-count>3 pages</span></span>
                  </div>
                </button>
                <div class="folder-actions" role="group" aria-label="Get Involved folder actions">
                  <button type="button" data-folder-action="rename" aria-label="Rename folder" data-tooltip="Rename folder" onclick="mwWindow('wFoldersettings').show();"><i class="fa-solid fa-pen-to-square"></i></button>
                  <button type="button" data-folder-action="move" aria-label="Move folder" data-tooltip="Move folder" onclick="mwWindow('wMoveFolder').show();"><i class="fa-solid fa-arrow-right-arrow-left"></i></button>
                  <button type="button" data-folder-action="delete" aria-label="Trash folder" data-tooltip="Trash folder" onclick="mwWindow('wTrashfolder').show();" ><i class="fa-solid fa-trash-can"></i></button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="get-involved"
            data-page-id="volunteer"
            data-status="published"
            data-type="Landing"
            data-author="Morgan Lee"
            data-title="Volunteer"
            data-created="2025-01-30"
            data-modified="2025-07-17"
            data-report-value="2670"
            data-report-trend="7"
            data-report-direction="up"
            data-report-issues="applications"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Volunteer">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="volunteer">Volunteer</button>
                  <span class="subtitle">get-involved/volunteer</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Landing</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Morgan Lee"
                title="Morgan Lee"
                aria-label="Filter by Morgan Lee"
              >
                <div class="avatar">
                  <span aria-hidden="true">ML</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="volunteer">
                <div class="reports-metric" data-trend="up">
                  <strong>2.7k sign-ups</strong>
                  <span class="metric-trend up">+7% volunteers</span>
                </div>
              </button>
            </td>
            <td data-created-label>Jan 30, 2025</td>
            <td data-modified-label>Jul 17, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="get-involved"
            data-page-id="fundraise"
            data-status="published"
            data-type="Landing"
            data-author="Morgan Lee"
            data-title="Fundraise"
            data-created="2025-02-22"
            data-modified="2025-07-11"
            data-report-value="1430"
            data-report-trend="2"
            data-report-direction="up"
            data-report-issues="donations"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Fundraise">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="fundraise">Fundraise</button>
                  <span class="subtitle">get-involved/fundraise</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Landing</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Morgan Lee"
                title="Morgan Lee"
                aria-label="Filter by Morgan Lee"
              >
                <div class="avatar">
                  <span aria-hidden="true">ML</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="fundraise">
                <div class="reports-metric" data-trend="up">
                  <strong>$143k raised</strong>
                  <span class="metric-trend up">+2% YoY</span>
                </div>
              </button>
            </td>
            <td data-created-label>Feb 22, 2025</td>
            <td data-modified-label>Jul 11, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="get-involved"
            data-page-id="become-a-partner"
            data-status="published"
            data-type="Landing"
            data-author="Priya Patel"
            data-title="Become a Partner"
            data-created="2025-03-15"
            data-modified="2025-06-28"
            data-report-value="860"
            data-report-trend="4"
            data-report-direction="up"
            data-report-issues="form"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Become a Partner">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="become-a-partner">Become a Partner</button>
                  <span class="subtitle">get-involved/become-a-partner</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Landing</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Priya Patel"
                title="Priya Patel"
                aria-label="Filter by Priya Patel"
              >
                <div class="avatar">
                  <span aria-hidden="true">PP</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="become-a-partner">
                <div class="reports-metric" data-trend="up">
                  <strong>860 partners</strong>
                  <span class="metric-trend up">+4 new orgs</span>
                </div>
              </button>
            </td>
            <td data-created-label>Mar 15, 2025</td>
            <td data-modified-label>Jun 28, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings  onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="group-row"
            data-folder="stories"
            data-folder-total="4"
            data-folder-name="Stories"
            data-folder-color="amber"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-folder-checkbox data-folder-id="stories" aria-label="Select folder Stories">
              </label>
            </td>
            <td colspan="8">
              <div class="folder-header">
                <button type="button" class="folder-toggle" data-folder-toggle="stories" aria-expanded="true">
                  <span class="folder-icon" data-color="amber" aria-hidden="true"><i class="fa-solid fa-folder-open" data-folder-icon></i></span>
                  <div class="folder-details">
                    <span class="folder-name">Stories</span>
                    <span class="group-meta"><span class="folder-count" data-folder-count>4 pages</span></span>
                  </div>
                </button>
                <div class="folder-actions" role="group" aria-label="Stories folder actions">
                  <button type="button" data-folder-action="rename" aria-label="Rename folder" data-tooltip="Rename folder" onclick="mwWindow('wFoldersettings').show();"><i class="fa-solid fa-pen-to-square"></i></button>
                  <button type="button" data-folder-action="move" aria-label="Move folder" data-tooltip="Move folder" onclick="mwWindow('wMoveFolder').show();"><i class="fa-solid fa-arrow-right-arrow-left"></i></button>
                  <button type="button" data-folder-action="delete" aria-label="Trash folder" data-tooltip="Trash folder" onclick="mwWindow('wTrashfolder').show();" ><i class="fa-solid fa-trash-can"></i></button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="stories"
            data-page-id="blog"
            data-status="published"
            data-type="Blog"
            data-author="Jordan Blake"
            data-title="Blog"
            data-created="2025-01-05"
            data-modified="2025-07-19"
            data-report-value="5120"
            data-report-trend="11"
            data-report-direction="up"
            data-report-issues="seo-low"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Blog">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="blog">Blog</button>
                  <span class="subtitle">stories/blog</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Blog</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Jordan Blake"
                title="Jordan Blake"
                aria-label="Filter by Jordan Blake"
              >
                <div class="avatar">
                  <span aria-hidden="true">JB</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="blog">
                <div class="reports-metric" data-trend="up">
                  <strong>5.1k reads</strong>
                  <span class="metric-trend up">+11% subscribers</span>
                </div>
              </button>
            </td>
            <td data-created-label>Jan 05, 2025</td>
            <td data-modified-label>Jul 19, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings  onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="stories"
            data-page-id="success-stories"
            data-status="published"
            data-type="Blog"
            data-author="Amelia Reed"
            data-title="Success Stories"
            data-created="2025-02-08"
            data-modified="2025-07-09"
            data-report-value="2230"
            data-report-trend="5"
            data-report-direction="up"
            data-report-issues="storytelling"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Success Stories">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="success-stories">Success Stories</button>
                  <span class="subtitle">stories/success-stories</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Blog</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Amelia Reed"
                title="Amelia Reed"
                aria-label="Filter by Amelia Reed"
              >
                <div class="avatar">
                  <span aria-hidden="true">AR</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="success-stories">
                <div class="reports-metric" data-trend="up">
                  <strong>2.2k reads</strong>
                  <span class="metric-trend up">+5% reach</span>
                </div>
              </button>
            </td>
            <td data-created-label>Feb 08, 2025</td>
            <td data-modified-label>Jul 09, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings  onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="stories"
            data-page-id="photo-gallery"
            data-status="published"
            data-type="Portfolio"
            data-author="Priya Patel"
            data-title="Photo Gallery"
            data-created="2025-02-25"
            data-modified="2025-06-20"
            data-report-value="1760"
            data-report-trend="4"
            data-report-direction="up"
            data-report-issues="image-alt"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Photo Gallery">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="photo-gallery">Photo Gallery</button>
                  <span class="subtitle">stories/photo-gallery</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Portfolio</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Priya Patel"
                title="Priya Patel"
                aria-label="Filter by Priya Patel"
              >
                <div class="avatar">
                  <span aria-hidden="true">PP</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="photo-gallery">
                <div class="reports-metric" data-trend="up">
                  <strong>1.8k views</strong>
                  <span class="metric-trend up">+4% engagement</span>
                </div>
              </button>
            </td>
            <td data-created-label>Feb 25, 2025</td>
            <td data-modified-label>Jun 20, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings  onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="stories"
            data-page-id="events"
            data-status="published"
            data-type="Event"
            data-author="Morgan Lee"
            data-title="Events"
            data-created="2025-03-05"
            data-modified="2025-07-16"
            data-report-value="1340"
            data-report-trend="3"
            data-report-direction="up"
            data-report-issues="registration"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Events">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="events">Events</button>
                  <span class="subtitle">stories/events</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Event</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Morgan Lee"
                title="Morgan Lee"
                aria-label="Filter by Morgan Lee"
              >
                <div class="avatar">
                  <span aria-hidden="true">ML</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="events">
                <div class="reports-metric" data-trend="up">
                  <strong>1.3k RSVPs</strong>
                  <span class="metric-trend up">+3% attendance</span>
                </div>
              </button>
            </td>
            <td data-created-label>Mar 05, 2025</td>
            <td data-modified-label>Jul 16, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings  onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="group-row"
            data-folder="resources"
            data-folder-total="3"
            data-folder-name="Resources"
            data-folder-color="slate"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-folder-checkbox data-folder-id="resources" aria-label="Select folder Resources">
              </label>
            </td>
            <td colspan="8">
              <div class="folder-header">
                <button type="button" class="folder-toggle" data-folder-toggle="resources" aria-expanded="true">
                  <span class="folder-icon" data-color="slate" aria-hidden="true"><i class="fa-solid fa-folder-open" data-folder-icon></i></span>
                  <div class="folder-details">
                    <span class="folder-name">Resources</span>
                    <span class="group-meta"><span class="folder-count" data-folder-count>3 pages</span></span>
                  </div>
                </button>
                <div class="folder-actions" role="group" aria-label="Resources folder actions">
                  <button type="button" data-folder-action="rename" aria-label="Rename folder" data-tooltip="Rename folder" onclick="mwWindow('wFoldersettings').show();"><i class="fa-solid fa-pen-to-square"></i></button>
                  <button type="button" data-folder-action="move" aria-label="Move folder" data-tooltip="Move folder" onclick="mwWindow('wMoveFolder').show();"><i class="fa-solid fa-arrow-right-arrow-left"></i></button>
                  <button type="button" data-folder-action="delete" aria-label="Trash folder" data-tooltip="Trash folder" onclick="mwWindow('wTrashfolder').show();" ><i class="fa-solid fa-trash-can"></i></button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="resources"
            data-page-id="faqs"
            data-status="published"
            data-type="Contact"
            data-author="Daniel Ortiz"
            data-title="FAQs"
            data-created="2025-01-16"
            data-modified="2025-07-08"
            data-report-value="3890"
            data-report-trend="8"
            data-report-direction="up"
            data-report-issues="top-questions"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select FAQs">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="faqs">FAQs</button>
                  <span class="subtitle">resources/faqs</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Contact</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Daniel Ortiz"
                title="Daniel Ortiz"
                aria-label="Filter by Daniel Ortiz"
              >
                <div class="avatar">
                  <span aria-hidden="true">DO</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="faqs">
                <div class="reports-metric" data-trend="up">
                  <strong>3.9k visits</strong>
                  <span class="metric-trend up">+8% solved</span>
                </div>
              </button>
            </td>
            <td data-created-label>Jan 16, 2025</td>
            <td data-modified-label>Jul 08, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings  onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="resources"
            data-page-id="downloads-forms"
            data-status="published"
            data-type="Content"
            data-author="Amelia Reed"
            data-title="Downloads & Forms"
            data-created="2025-02-10"
            data-modified="2025-07-06"
            data-report-value="2480"
            data-report-trend="4"
            data-report-direction="up"
            data-report-issues="file-expiry"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Downloads & Forms">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="downloads-forms">Downloads & Forms</button>
                  <span class="subtitle">resources/downloads-forms</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Content</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Amelia Reed"
                title="Amelia Reed"
                aria-label="Filter by Amelia Reed"
              >
                <div class="avatar">
                  <span aria-hidden="true">AR</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="downloads-forms">
                <div class="reports-metric" data-trend="up">
                  <strong>2.5k downloads</strong>
                  <span class="metric-trend up">+4% completion</span>
                </div>
              </button>
            </td>
            <td data-created-label>Feb 10, 2025</td>
            <td data-modified-label>Jul 06, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings  onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="resources"
            data-page-id="newsroom-press"
            data-status="published"
            data-type="Blog"
            data-author="Jordan Blake"
            data-title="Newsroom & Press"
            data-created="2025-02-27"
            data-modified="2025-07-03"
            data-report-value="1670"
            data-report-trend="3"
            data-report-direction="up"
            data-report-issues="press"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Newsroom & Press">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="newsroom-press">Newsroom & Press</button>
                  <span class="subtitle">resources/newsroom-press</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Blog</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Jordan Blake"
                title="Jordan Blake"
                aria-label="Filter by Jordan Blake"
              >
                <div class="avatar">
                  <span aria-hidden="true">JB</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="newsroom-press">
                <div class="reports-metric" data-trend="up">
                  <strong>1.7k views</strong>
                  <span class="metric-trend up">+3% media hits</span>
                </div>
              </button>
            </td>
            <td data-created-label>Feb 27, 2025</td>
            <td data-modified-label>Jul 03, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings  onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-page-id="contact"
            data-status="published"
            data-type="Contact"
            data-author="Amelia Reed"
            data-title="Contact"
            data-created="2025-01-09"
            data-modified="2025-07-18"
            data-report-value="2980"
            data-report-trend="4"
            data-report-direction="up"
            data-report-issues="response-time"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Contact">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="contact">Contact</button>
                  <span class="subtitle">contact</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Contact</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Amelia Reed"
                title="Amelia Reed"
                aria-label="Filter by Amelia Reed"
              >
                <div class="avatar">
                  <span aria-hidden="true">AR</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="contact">
                <div class="reports-metric" data-trend="up">
                  <strong>2.9k inquiries</strong>
                  <span class="metric-trend up">+4% satisfaction</span>
                </div>
              </button>
            </td>
            <td data-created-label>Jan 09, 2025</td>
            <td data-modified-label>Jul 18, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings  onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="group-row"
            data-folder="utility"
            data-folder-total="2"
            data-folder-name="Utility"
            data-folder-color="purple"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-folder-checkbox data-folder-id="utility" aria-label="Select folder Utility">
              </label>
            </td>
            <td colspan="8">
              <div class="folder-header">
                <button type="button" class="folder-toggle" data-folder-toggle="utility" aria-expanded="true">
                  <span class="folder-icon" data-color="purple" aria-hidden="true"><i class="fa-solid fa-folder-open" data-folder-icon></i></span>
                  <div class="folder-details">
                    <span class="folder-name">Utility</span>
                    <span class="group-meta"><span class="folder-count" data-folder-count>2 pages</span></span>
                  </div>
                </button>
                <div class="folder-actions" role="group" aria-label="Utility folder actions">
                  <button type="button" data-folder-action="rename" aria-label="Rename folder" data-tooltip="Rename folder" onclick="mwWindow('wFoldersettings').show();"><i class="fa-solid fa-pen-to-square"></i></button>
                  <button type="button" data-folder-action="move" aria-label="Move folder" data-tooltip="Move folder" onclick="mwWindow('wMoveFolder').show();"><i class="fa-solid fa-arrow-right-arrow-left"></i></button>
                  <button type="button" data-folder-action="delete" aria-label="Trash folder" data-tooltip="Trash folder" onclick="mwWindow('wTrashfolder').show();" ><i class="fa-solid fa-trash-can"></i></button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="utility"
            data-page-id="utility-contact"
            data-status="published"
            data-type="Content"
            data-author="Morgan Lee"
            data-title="Contact"
            data-created="2025-01-07"
            data-modified="2025-07-15"
            data-report-value="420"
            data-report-trend="1"
            data-report-direction="up"
            data-report-issues="directory"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Contact">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="utility-contact">Contact</button>
                  <span class="subtitle">utility/contact</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Content</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Morgan Lee"
                title="Morgan Lee"
                aria-label="Filter by Morgan Lee"
              >
                <div class="avatar">
                  <span aria-hidden="true">ML</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="utility-contact">
                <div class="reports-metric" data-trend="up">
                  <strong>420 lookups</strong>
                  <span class="metric-trend up">+1% team use</span>
                </div>
              </button>
            </td>
            <td data-created-label>Jan 07, 2025</td>
            <td data-modified-label>Jul 15, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings  onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-folder="utility"
            data-page-id="member-login"
            data-status="published"
            data-type="Contact"
            data-author="Daniel Ortiz"
            data-title="Member Login"
            data-created="2025-01-21"
            data-modified="2025-07-13"
            data-report-value="3120"
            data-report-trend="5"
            data-report-direction="up"
            data-report-issues="sso"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Member Login">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="member-login">Member Login</button>
                  <span class="subtitle">utility/member-login</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge published">Published</span></span>
            </td>
            <td><span class="chip">Contact</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Daniel Ortiz"
                title="Daniel Ortiz"
                aria-label="Filter by Daniel Ortiz"
              >
                <div class="avatar">
                  <span aria-hidden="true">DO</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="member-login">
                <div class="reports-metric" data-trend="up">
                  <strong>3.1k logins</strong>
                  <span class="metric-trend up">+5% retention</span>
                </div>
              </button>
            </td>
            <td data-created-label>Jan 21, 2025</td>
            <td data-modified-label>Jul 13, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings  onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
          </div>
        </div>
      </td>
    </tr>
          <tr
            class="page-row"
            data-page-id="summer-campaign"
            data-status="unpublished"
            data-type="Landing"
            data-author="Priya Patel"
            data-title="Summer Campaign"
            data-created="2025-06-05"
            data-modified="2025-07-28"
            data-report-value="0"
            data-report-trend="0"
            data-report-direction="neutral"
            data-report-issues="awaiting-approval"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Summer Campaign">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="summer-campaign">Summer Campaign</button>
                  <span class="subtitle">campaigns/summer-2025</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge unpublished">Unpublished</span></span>
            </td>
            <td><span class="chip">Landing</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Priya Patel"
                title="Priya Patel"
                aria-label="Filter by Priya Patel"
              >
                <div class="avatar">
                  <span aria-hidden="true">PP</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="summer-campaign">
                <div class="reports-metric" data-trend="neutral">
                  <strong>--</strong>
                  <span class="metric-trend neutral">Awaiting approval</span>
                </div>
              </button>
            </td>
            <td data-created-label>Jun 05, 2025</td>
            <td data-modified-label>Jul 28, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings  onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-page-id="press-kit-refresh"
            data-status="unpublished"
            data-type="Content"
            data-author="Amelia Reed"
            data-title="Press Kit Refresh"
            data-created="2025-05-12"
            data-modified="2025-07-11"
            data-report-value="0"
            data-report-trend="0"
            data-report-direction="neutral"
            data-report-issues="brand-review"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Press Kit Refresh">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="press-kit-refresh">Press Kit Refresh</button>
                  <span class="subtitle">newsroom/press-kit</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge unpublished">Unpublished</span></span>
            </td>
            <td><span class="chip">Content</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Amelia Reed"
                title="Amelia Reed"
                aria-label="Filter by Amelia Reed"
              >
                <div class="avatar">
                  <span aria-hidden="true">AR</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="press-kit-refresh">
                <div class="reports-metric" data-trend="neutral">
                  <strong>--</strong>
                  <span class="metric-trend neutral">Brand review in progress</span>
                </div>
              </button>
            </td>
            <td data-created-label>May 12, 2025</td>
            <td data-modified-label>Jul 11, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings  onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-page-id="donor-portal-onboarding"
            data-status="unpublished"
            data-type="Contact"
            data-author="Jordan Blake"
            data-title="Donor Portal Onboarding"
            data-created="2025-05-30"
            data-modified="2025-07-09"
            data-report-value="0"
            data-report-trend="0"
            data-report-direction="neutral"
            data-report-issues="integration-testing"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Donor Portal Onboarding">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="donor-portal-onboarding">Donor Portal Onboarding</button>
                  <span class="subtitle">donors/onboarding</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge unpublished">Unpublished</span></span>
            </td>
            <td><span class="chip">Contact</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Jordan Blake"
                title="Jordan Blake"
                aria-label="Filter by Jordan Blake"
              >
                <div class="avatar">
                  <span aria-hidden="true">JB</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="donor-portal-onboarding">
                <div class="reports-metric" data-trend="neutral">
                  <strong>--</strong>
                  <span class="metric-trend neutral">Integration tests pending</span>
                </div>
              </button>
            </td>
            <td data-created-label>May 30, 2025</td>
            <td data-modified-label>Jul 09, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Copy page" data-tooltip="Copy page" data-copy-page onclick="mwWindow('wDuplicatepage').show();"><i class="fa-regular fa-copy"></i></button>
              <button type="button" aria-label="Copy link" data-tooltip="Copy link"><i class="fa-solid fa-link"></i></button>
              <button
                type="button"
                aria-label="Page settings"
                data-tooltip="Page settings"
                data-page-settings  onclick="mwWindow('wPagesettings').show();"
              >
                <i class="fa-solid fa-gear"></i>
              </button>
              <div class="action-menu" data-action-menu>
                <button
                  type="button"
                  class="action-menu-trigger"
                  aria-label="More actions"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-action-menu-trigger
                  data-tooltip="More actions"
                >
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="action-menu-dropdown" role="menu" data-action-menu-dropdown hidden>
                  <button type="button" class="action-menu-item" role="menuitem"  data-menu-action="publish" onclick="mwWindow('wPublishpage').show();">
                    <i class="fa-solid fa-arrow-up-from-bracket" aria-hidden="true"></i>
                    <span>Publish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="unpublish"   onclick="mwWindow('wUnpublishpage').show();">
                    <i class="fa-solid fa-arrow-down" aria-hidden="true"></i>
                    <span>Unpublish</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="schedule" onclick="mwWindow('wSchedulepublish').show();">
                    <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                    <span>Schedule</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="move" onclick="mwWindow('wMovePagetoFolder').show();">
                    <i class="fa-solid fa-folder-open" aria-hidden="true"></i>
                    <span>Move to Folder</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="duplicate"  onclick="mwWindow('wDuplicatepage').show();">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span>Duplicate</span>
                  </button>
                  <button type="button" class="action-menu-item" role="menuitem" data-menu-action="settings"   onclick="mwWindow('wPagesettings').show();">
                    <i class="fa-solid fa-gear" aria-hidden="true"></i>
                    <span>Settings</span>
                  </button>
                  <button
                    type="button"
                    class="action-menu-item is-destructive"
                    role="menuitem"
                    data-menu-action="trash" onclick="mwWindow('wMovetotrash').show();"
                  >
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                    <span>Trash</span>
                  </button>
                </div>
              </div>
            </td>
          </tr>
          <tr
            class="page-row"
            data-page-id="old-promotions"
            data-status="trash"
            data-type="Landing"
            data-author="Jordan Blake"
            data-title="Old Promotions"
            data-created="2024-03-15"
            data-modified="2025-08-20"
            data-report-value="850"
            data-report-trend="-15"
            data-report-direction="down"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Old Promotions">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="old-promotions">Old Promotions</button>
                  <span class="subtitle">marketing/old-promotions</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge trash">Trash</span></span>
            </td>
            <td><span class="chip">Landing</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Jordan Blake"
                title="Jordan Blake"
                aria-label="Filter by Jordan Blake"
              >
                <div class="avatar">
                  <span aria-hidden="true">JB</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="old-promotions">
                <div class="reports-metric" data-trend="down">
                  <strong>850 views</strong>
                  <span class="metric-trend down">-15% engagement</span>
                </div>
              </button>
            </td>
            <td data-created-label>Mar 15, 2024</td>
            <td data-modified-label>Aug 20, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Restore page" data-tooltip="Restore page" data-menu-action="restore" onclick="mwWindow('wRestorepage').show();" ><i class="fa-solid fa-arrow-rotate-left"></i></button>
              <button type="button" aria-label="Delete permanently" data-tooltip="Delete permanently" data-menu-action="delete" onclick="mwWindow('wDeletepermanently').show();" ><i class="fa-solid fa-trash-can"></i></button>
            </td>
          </tr>
          <tr
            class="page-row"
            data-page-id="legacy-product-catalog"
            data-status="trash"
            data-type="Portfolio"
            data-author="Amelia Reed"
            data-title="Legacy Product Catalog"
            data-created="2023-11-08"
            data-modified="2025-08-18"
            data-report-value="1240"
            data-report-trend="-22"
            data-report-direction="down"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Legacy Product Catalog">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="legacy-product-catalog">Legacy Product Catalog</button>
                  <span class="subtitle">products/legacy-catalog</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge trash">Trash</span></span>
            </td>
            <td><span class="chip">Portfolio</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Amelia Reed"
                title="Amelia Reed"
                aria-label="Filter by Amelia Reed"
              >
                <div class="avatar">
                  <span aria-hidden="true">AR</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="legacy-product-catalog">
                <div class="reports-metric" data-trend="down">
                  <strong>1.2k views</strong>
                  <span class="metric-trend down">-22% traffic</span>
                </div>
              </button>
            </td>
            <td data-created-label>Nov 08, 2023</td>
            <td data-modified-label>Aug 18, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Restore page" data-tooltip="Restore page" data-menu-action="restore" onclick="mwWindow('wRestorepage').show();" ><i class="fa-solid fa-arrow-rotate-left"></i></button>
              <button type="button" aria-label="Delete permanently" data-tooltip="Delete permanently" data-menu-action="delete" onclick="mwWindow('wDeletepermanently').show();" ><i class="fa-solid fa-trash-can"></i></button>
            </td>
          </tr>
          <tr
            class="page-row"
            data-page-id="discontinued-services"
            data-status="trash"
            data-type="Content"
            data-author="Daniel Ortiz"
            data-title="Discontinued Services"
            data-created="2024-06-12"
            data-modified="2025-08-15"
            data-report-value="320"
            data-report-trend="-45"
            data-report-direction="down"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Discontinued Services">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="discontinued-services">Discontinued Services</button>
                  <span class="subtitle">services/discontinued</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge trash">Trash</span></span>
            </td>
            <td><span class="chip">Content</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Daniel Ortiz"
                title="Daniel Ortiz"
                aria-label="Filter by Daniel Ortiz"
              >
                <div class="avatar">
                  <span aria-hidden="true">DO</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="discontinued-services">
                <div class="reports-metric" data-trend="down">
                  <strong>320 views</strong>
                  <span class="metric-trend down">-45% engagement</span>
                </div>
              </button>
            </td>
            <td data-created-label>Jun 12, 2024</td>
            <td data-modified-label>Aug 15, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Restore page" data-tooltip="Restore page" data-menu-action="restore" onclick="mwWindow('wRestorepage').show();" ><i class="fa-solid fa-arrow-rotate-left"></i></button>
              <button type="button" aria-label="Delete permanently" data-tooltip="Delete permanently" data-menu-action="delete" onclick="mwWindow('wDeletepermanently').show();" ><i class="fa-solid fa-trash-can"></i></button>
            </td>
          </tr>
          <tr
            class="page-row"
            data-page-id="test-page-draft"
            data-status="trash"
            data-type="Content"
            data-author="Jordan Blake"
            data-title="Test Page Draft"
            data-created="2025-07-01"
            data-modified="2025-08-10"
            data-report-value="45"
            data-report-trend="0"
            data-report-direction="neutral"
          >
            <td class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox" data-row-checkbox aria-label="Select Test Page Draft">
              </label>
            </td>
            <td>
              <div class="title-cell">
                <div class="title-text">
                  <button type="button" class="title-button" data-open-page="test-page-draft">Test Page Draft</button>
                  <span class="subtitle">testing/test-draft</span>
                </div>
              </div>
            </td>
            <td>
              <span class="status-pill"><span class="badge trash">Trash</span></span>
            </td>
            <td><span class="chip">Content</span></td>
            <td>
              <button
                type="button"
                class="author-filter"
                data-author-filter="Jordan Blake"
                title="Jordan Blake"
                aria-label="Filter by Jordan Blake"
              >
                <div class="avatar">
                  <span aria-hidden="true">JB</span>
                </div>
              </button>
            </td>
            <td>
              <button type="button" class="reports-button" data-report-drawer="test-page-draft">
                <div class="reports-metric" data-trend="neutral">
                  <strong>45 views</strong>
                  <span class="metric-trend neutral">No change</span>
                </div>
              </button>
            </td>
            <td data-created-label>Jul 01, 2025</td>
            <td data-modified-label>Aug 10, 2025</td>
            <td class="actions">
              <button type="button" aria-label="Restore page" data-tooltip="Restore page" data-menu-action="restore" onclick="mwWindow('wRestorepage').show();" ><i class="fa-solid fa-arrow-rotate-left"></i></button>
              <button type="button" aria-label="Delete permanently" data-tooltip="Delete permanently" data-menu-action="delete" onclick="mwWindow('wDeletepermanently').show();" ><i class="fa-solid fa-trash-can"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="filters-drawer" id="filtersDrawer" aria-hidden="true">
    <div class="drawer-panel" role="dialog" aria-modal="true" aria-labelledby="filtersDrawerTitle">
      <div class="drawer-header">
        <div class="drawer-title" id="filtersDrawerTitle">
          <span aria-hidden="true"><i class="fa-solid fa-filter"></i></span>
          Filters
        </div>
        <button class="drawer-close" type="button" aria-label="Close filters">
          <i class="fa-solid fa-xmark" aria-hidden="true"></i>
        </button>
      </div>
      <div class="drawer-meta" id="activeFilterCount">No filters applied</div>
      <div class="drawer-sections" role="presentation">
        <div class="drawer-section">
          <h3 class="drawer-section-title">Date</h3>
          <div class="section-content" id="dateFilterSection">
            <div class="date-grid">
              <label for="filterStartDate">Start Date
                <input type="date" id="filterStartDate" name="filterStartDate">
              </label>
              <label for="filterEndDate">End Date
                <input type="date" id="filterEndDate" name="filterEndDate">
              </label>
            </div>
            <div class="date-hint">Filters by last modified date. Leave one field blank for an open range.</div>
          </div>
        
          <h3 class="drawer-section-title">Author</h3>
          <div class="section-content" id="authorFilterSection">
            <div class="author-filter-grid" id="authorFilterList" role="group" aria-label="Filter by author">
              <button type="button" class="author-filter-chip" data-author-value="John Lee">
                <span class="author-avatar" data-color="blue">JL</span>
                John Lee
              </button>
              <button type="button" class="author-filter-chip" data-author-value="Alice Moore">
                <span class="author-avatar" data-color="purple">AM</span>
                Alice Moore
              </button>
              <button type="button" class="author-filter-chip" data-author-value="Ryan Chen">
                <span class="author-avatar" data-color="teal">RC</span>
                Ryan Chen
              </button>
            </div>
          </div>

          <h3 class="drawer-section-title">Status</h3>
          <div class="section-content" id="statusFilterSection">
            <div class="filter-pill-group" id="statusFilterPills" role="group" aria-label="Filter by status">
              <button type="button" class="filter-pill" data-status-value="published">Published</button>
              <button type="button" class="filter-pill" data-status-value="unpublished">Unpublished</button>
              <button type="button" class="filter-pill" data-status-value="draft">Draft</button>
              <button type="button" class="filter-pill" data-status-value="scheduled">Scheduled</button>
              <button type="button" class="filter-pill" data-status-value="trash">Trash</button>
            </div>
          </div>

          <h3 class="drawer-section-title">Type</h3>
          <div class="section-content" id="typeFilterSection">
            <div class="type-chip-group" id="typeFilterList" role="group" aria-label="Filter by type">
              <button type="button" class="type-chip" data-type-value="Landing" data-color="blue">
                <span class="type-dot" aria-hidden="true"></span>
                Landing
              </button>
              <button type="button" class="type-chip" data-type-value="Blog" data-color="violet">
                <span class="type-dot" aria-hidden="true"></span>
                Blog
              </button>
              <button type="button" class="type-chip" data-type-value="Event" data-color="amber">
                <span class="type-dot" aria-hidden="true"></span>
                Event
              </button>
              <button type="button" class="type-chip" data-type-value="Portfolio" data-color="pink">
                <span class="type-dot" aria-hidden="true"></span>
                Portfolio
              </button>
              <button type="button" class="type-chip" data-type-value="Contact" data-color="emerald">
                <span class="type-dot" aria-hidden="true"></span>
                Contact
              </button>
              <button type="button" class="type-chip" data-type-value="Home" data-color="blue">
                <span class="type-dot" aria-hidden="true"></span>
                Home
              </button>
              <button type="button" class="type-chip" data-type-value="Content" data-color="slate">
                <span class="type-dot" aria-hidden="true"></span>
                Content
              </button>
            </div>
          </div>

          <h3 class="drawer-section-title">Report Card</h3>
          <div class="section-content" id="reportFilterSection">
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
          </div>
        </div>
      </div>
      <div class="drawer-footer">
        <div>
          <button type="button" id="clearFiltersButton">Clear All</button>
        </div>
        <div>
          <button type="button" id="applyFiltersButton">Apply Filters</button>
          
        </div>
      </div>
		
    </div>
  </div>


</div>

  <template id="analyticsDrawerTemplate">
    <div class="page-analytics-drawer" data-analytics-drawer>
      <button type="button" class="analytics-close" data-analytics-close aria-label="Close analytics panel">
        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
      </button>
      <div class="analytics-grid">
        <div class="analytics-card analytics-card--info">
          <div class="analytics-card-header">
            <div>
              <span class="analytics-card-title">Highlights</span>
              <span class="analytics-card-subtitle">Owned by Jordan Blake</span>
            </div>
            <button type="button" class="analytics-card-action" data-analytics-action="info">Audit</button>
          </div>
          <div class="analytics-card-body">
            <ul class="analytics-metric-list">
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">Page Rank</span>
                  <span class="analytics-metric-value">#1</span>
                </div>
                <span class="analytics-chip is-good">Leading</span>
              </li>
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">Word Count</span>
                  <span class="analytics-metric-value">847 words</span>
                </div>
                <span class="analytics-chip is-good">Balanced</span>
              </li>
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">Images</span>
                  <span class="analytics-metric-value">12 assets</span>
                </div>
                <span class="analytics-chip is-caution">Alt text audit</span>
              </li>
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">Links</span>
                  <span class="analytics-metric-value">18 total</span>
                </div>
                <span class="analytics-chip is-issue">2 broken</span>
              </li>
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">Last Edited</span>
                  <span class="analytics-metric-value">Jul 22, 2025</span>
                </div>
                <span class="analytics-chip is-caution">30 days ago</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="analytics-card analytics-card--seo">
          <div class="analytics-card-header">
            <div>
              <span class="analytics-card-title">SEO health</span>
              <span class="analytics-card-subtitle">Score 92 / 100</span>
            </div>
            <button type="button" class="analytics-card-action" data-analytics-action="seo">View SEO audit</button>
          </div>
          <div class="analytics-card-body">
            <ul class="analytics-metric-list">
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">Meta Title</span>
                  <span class="analytics-metric-value">Optimized</span>
                </div>
                <span class="analytics-chip is-good">Green</span>
              </li>
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">Meta Description</span>
                  <span class="analytics-metric-value">Too long</span>
                </div>
                <span class="analytics-chip is-caution">-12 chars</span>
              </li>
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">Open Graph</span>
                  <span class="analytics-metric-value">Complete</span>
                </div>
                <span class="analytics-chip is-good">Share ready</span>
              </li>
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">Schema</span>
                  <span class="analytics-metric-value">Article & Breadcrumb</span>
                </div>
                <span class="analytics-chip is-good">Valid</span>
              </li>
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">Page Speed</span>
                  <span class="analytics-metric-value">91 (mobile)</span>
                </div>
                <span class="analytics-chip is-good">+4 vs last week</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="analytics-card analytics-card--accessibility">
          <div class="analytics-card-header">
            <div>
              <span class="analytics-card-title">Accessibility</span>
              <span class="analytics-card-subtitle">WCAG score 98 / 100</span>
            </div>
          </div>
          <div class="analytics-card-body">
            <ul class="analytics-metric-list">
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">Heading Hierarchy</span>
                  <span class="analytics-metric-value">1 issue</span>
                </div>
                <span class="analytics-chip is-issue">Missing H2</span>
              </li>
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">Image Alt Text</span>
                  <span class="analytics-metric-value">2 warnings</span>
                </div>
                <span class="analytics-chip is-caution">Decorative?</span>
              </li>
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">Keyboard Navigation</span>
                  <span class="analytics-metric-value">Pass</span>
                </div>
                <span class="analytics-chip is-good">Focusable</span>
              </li>
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">Color Contrast</span>
                  <span class="analytics-metric-value">AA compliant</span>
                </div>
                <span class="analytics-chip is-good">Pass</span>
              </li>
              <li class="analytics-metric">
                <div class="analytics-metric-main">
                  <span class="analytics-metric-label">ARIA Labels</span>
                  <span class="analytics-metric-value">Optimized</span>
                </div>
                <span class="analytics-chip is-good">Complete</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="analytics-card analytics-card--traffic">
          <div class="analytics-card-header">
            <div>
              <span class="analytics-card-title">Traffic</span>
              <span class="analytics-card-subtitle">Total views (rolling 12 months)</span>
            </div>
            <button type="button" class="analytics-card-action" data-analytics-action="traffic">Open traffic report</button>
          </div>
          <div class="analytics-card-body">
            <div class="analytics-traffic-primary">
              <span class="analytics-traffic-value">12.8k</span>
              <span class="analytics-traffic-label">Views YTD</span>
              <span class="analytics-traffic-trend is-up">+12.4% vs last month</span>
              <span class="analytics-traffic-context">Avg. session duration 3m 24s</span>
            </div>
            <div class="analytics-traffic-details">
              <div class="analytics-detail">
                <span class="analytics-detail-label">Unique visitors</span>
                <span class="analytics-detail-value">8.7k</span>
                <span class="analytics-chip analytics-detail-chip is-good">Growing</span>
              </div>
              <div class="analytics-detail">
                <span class="analytics-detail-label">Bounce rate</span>
                <span class="analytics-detail-value">38%</span>
                <span class="analytics-chip analytics-detail-chip is-caution">Watch</span>
              </div>
              <div class="analytics-detail">
                <span class="analytics-detail-label">Top channel</span>
                <span class="analytics-detail-value">Organic (54%)</span>
                <span class="analytics-chip analytics-detail-chip is-good">Trending</span>
              </div>
              <div class="analytics-detail">
                <span class="analytics-detail-label">Top device</span>
                <span class="analytics-detail-value">Mobile (62%)</span>
                <span class="analytics-chip analytics-detail-chip is-good">Stable</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>


  <script>
    (function () {
      // Main client-side controller for the Pages desktop view. This script wires up
      // search, filters, bulk actions, dialogs, and analytics cards so the PHP template
      // can behave like a modern single-page experience without a build step.

      // Storage keys used to persist small UX preferences between visits. These stay small
      // so localStorage never contains bulky page data—just feature toggles and view prefs.
      const folderStateStorageKey = 'mw-pages-folder-state';
      const flatViewStorageKey = 'mw-pages-flat-view';

      // Helper to clone our UI state object while keeping Set instances isolated so
      // subscribers always receive fresh references.
      const cloneState = (source) => ({
        ...source,
        authors: new Set(source.authors),
        types: new Set(source.types),
        statuses: new Set(source.statuses),
        reportCards: new Set(source.reportCards),
        selection: new Set(source.selection),
      });

      // Tiny observable store so multiple UI components can react to state changes
      // (filters, selection, search text, etc.) without a larger framework. Used
      // only inside this template to synchronize filters, dialogs, and bulk
      // actions without relying on external modules or other files.
      function createStore(initialState) {
        let state = cloneState(initialState);
        const listeners = new Set();

        const notify = () => {
          listeners.forEach((listener) => listener(state));
        };

        return {
          getState() {
            return state;
          },
          subscribe(listener) {
            if (typeof listener === 'function') {
              listeners.add(listener);
              return () => {
                listeners.delete(listener);
              };
            }
            return () => {};
          },
          update(updater) {
            const draft = cloneState(state);
            const result = typeof updater === 'function' ? updater(draft) ?? draft : draft;
            state = cloneState(result);
            notify();
            return state;
          },
        };
      }

      // Central state defaults used throughout the rest of the script. Each field feeds
      // a different UI surface, so resetting this object wipes the view back to defaults.
      const store = createStore({
        status: 'all',
        search: '',
        searchRaw: '',
        authors: new Set(),
        types: new Set(),
        statuses: new Set(),
        reportCards: new Set(),
        dateStart: '',
        dateEnd: '',
        sortKey: 'modified',
        sortDirection: 'desc',
        selection: new Set(),
      });

      // Keep a local reference to state so event handlers can read the latest values.
      let state = store.getState();
      store.subscribe((nextState) => {
        state = nextState;
      });

      // Static metadata used to render avatars, status chips, and form options. These
      // serve as lightweight fixtures so the interface looks populated without real data.
      const DEFAULT_AUTHOR_COLOR = 'blue';
      const AUTHOR_DETAILS = {
        'John Lee': { color: 'blue', email: 'john.lee@mayweather.studio' },
        'Alice Moore': { color: 'purple', email: 'alice.moore@mayweather.studio' },
        'Ryan Chen': { color: 'teal', email: 'ryan.chen@mayweather.studio' },
      };

      // Canonical status values used to render chips, filter pills, and badge labels.
      const STATUS_OPTIONS = [
        { value: 'published', label: 'Published' },
        { value: 'unpublished', label: 'Unpublished' },
        { value: 'draft', label: 'Draft' },
        { value: 'scheduled', label: 'Scheduled' },
        { value: 'trash', label: 'Trash' },
      ];

      // Extra copy that explains what each status means to the end user.
      const STATUS_DESCRIPTIONS = {
        published: 'Visible immediately after creation',
        unpublished: 'Keep offline but ready to go live later',
        draft: 'Private to collaborators until published',
        scheduled: 'Pick a date to automatically publish',
        trash: 'Restore pages or remove them permanently',
      };

      // Type styles determine the badge color for each template category.
      const TYPE_STYLES = {
        Landing: 'blue',
        Blog: 'violet',
        Event: 'amber',
        Portfolio: 'pink',
        Contact: 'emerald',
        Home: 'blue',
        Content: 'slate',
      };

      const TEMPLATE_DEFAULTS_BY_TYPE = {
        Landing: 'Hero landing',
        Blog: 'Editorial longform',
        Event: 'Standard page',
        Portfolio: 'Portfolio showcase',
        Contact: 'Standard page',
        Home: 'Hero landing',
        Content: 'Editorial longform',
      };

      // Static analytics drawer now sourced from template markup.
      const PAGE_ANALYTICS_DATA = {};
      const ANALYTICS_CARD_TITLES = {};
      const ANALYTICS_CARD_ORDER = ['info', 'seo', 'accessibility', 'traffic'];

      const analyticsTemplate = document.getElementById('analyticsDrawerTemplate');

      // Track the currently rendered analytics drawer so interactions and animations
      // can be coordinated without throwing reference errors when the drawer is opened.
      let analyticsRowElement = null;
      let analyticsActiveRow = null;
      let analyticsActivePageId = '';
      let analyticsColumnCount = 1;

      // Returns the static HTML for the analytics drawer. Only referenced within
      // this desktop.php controller when expanding analytics rows.
      function renderAnalyticsDrawerContent() {
        return analyticsTemplate ? analyticsTemplate.innerHTML : '';
      }

      // Maps a status value to its human-readable label for filter chips and
      // table badges. Used only inside this file by render helpers.
      function getStatusLabel(value) {
        const match = STATUS_OPTIONS.find((option) => option.value === value);
        return match ? match.label : value;
      }

      // Looks up the display label for an analytics report checkbox. Called from
      // analytics rendering helpers within this template only.
      function getReportLabel(value) {
        const checkbox = reportCheckboxes.find((input) => input.value === value);
        const label = checkbox?.parentElement?.querySelector('span')?.textContent?.trim();
        return label || value;
      }

      // Hides the inline analytics drawer row. This cleanup logic is only invoked
      // by the analytics open/close handlers inside desktop.php.
      function closeAnalyticsDrawer({ immediate = false } = {}) {
        if (!analyticsRowElement || !analyticsRowElement.isConnected) {
          if (analyticsActiveRow) {
            analyticsActiveRow.classList.remove('has-analytics-open');
          }
          analyticsActiveRow = null;
          analyticsActivePageId = '';
          return;
        }
        const drawer = analyticsRowElement.querySelector('.page-analytics-drawer');
        const finalize = () => {
          analyticsRowElement.remove();
          analyticsRowElement.classList.remove('is-open');
          if (analyticsActiveRow) {
            analyticsActiveRow.classList.remove('has-analytics-open');
          }
          analyticsActiveRow = null;
          analyticsActivePageId = '';
        };
        if (immediate || !drawer) {
          finalize();
          return;
        }
        const handleTransitionEnd = (event) => {
          if (event.target !== drawer) {
            return;
          }
          drawer.removeEventListener('transitionend', handleTransitionEnd);
          finalize();
        };
        drawer.addEventListener('transitionend', handleTransitionEnd);
        analyticsRowElement.classList.remove('is-open');
      }

      // Inserts and animates the analytics drawer below a table row. Triggered by
      // click handlers in this file; no external modules call this.
      function openAnalyticsDrawer(row) {
        if (!(row instanceof HTMLElement)) {
          return;
        }
        const pageId = row.dataset.pageId || '';
        if (!pageId) {
          return;
        }
        if (analyticsActivePageId === pageId && analyticsRowElement?.isConnected) {
          return;
        }
        if (analyticsRowElement?.isConnected) {
          closeAnalyticsDrawer({ immediate: true });
        }
        const columnCount = Math.max(1, analyticsColumnCount || 1);
        if (!analyticsRowElement) {
          analyticsRowElement = document.createElement('tr');
          analyticsRowElement.className = 'page-analytics-row';
        }
        analyticsRowElement.innerHTML = `<td colspan="${columnCount}">${renderAnalyticsDrawerContent()}</td>`;
        analyticsRowElement.classList.remove('is-open');
        row.insertAdjacentElement('afterend', analyticsRowElement);
        if (analyticsActiveRow) {
          analyticsActiveRow.classList.remove('has-analytics-open');
        }
        analyticsActiveRow = row;
        analyticsActivePageId = pageId;
        row.classList.add('has-analytics-open');
        window.requestAnimationFrame(() => {
          analyticsRowElement?.classList.add('is-open');
        });
      }
      // Updates the summary text that shows how many filters are active. Used by
      // the filter change listeners inside this template only.
      function updateActiveFilterSummary(count) {
        if (!activeFilterCount) {
          return;
        }
        if (count === 0) {
          activeFilterCount.textContent = 'No filters applied';
        } else if (count === 1) {
          activeFilterCount.textContent = '1 filter applied';
        } else {
          activeFilterCount.textContent = `${count} filters applied`;
        }
      }

      const pagesTableElement = document.querySelector('.pages-table');
      analyticsColumnCount = Math.max(
        1,
        pagesTableElement?.querySelectorAll('thead th').length || 9
      );

      const searchInput = document.getElementById('pagesSearch');
      const filterChips = document.getElementById('filterChips');
      const tabsContainer = document.querySelector('.pages-tabs');
      const tabButtons = document.querySelectorAll('[data-status-tab]');
      const countBadges = document.querySelectorAll('[data-status-count]');
      const filtersButton = document.getElementById('filtersButton');
      const filtersDrawer = document.getElementById('filtersDrawer');
      const drawerCloseButton = filtersDrawer?.querySelector('.drawer-close');
      const authorFilterList = document.getElementById('authorFilterList');
      const statusFilterPills = document.getElementById('statusFilterPills');
      const typeFilterList = document.getElementById('typeFilterList');
      const reportFilterList = document.getElementById('reportFilterList');
      const clearFiltersButton = document.getElementById('clearFiltersButton');
      const applyFiltersButton = document.getElementById('applyFiltersButton');
      const startDateInput = document.getElementById('filterStartDate');
      const endDateInput = document.getElementById('filterEndDate');
      const activeFilterCount = document.getElementById('activeFilterCount');
      const searchOverlay = document.querySelector('.search-overlay');
      const newButton = document.getElementById('newButton');
      const dialog = document.getElementById('newDialog');
      const dialogCloseButton = dialog?.querySelector('.dialog-close');
      const optionButtons = dialog ? dialog.querySelectorAll('.dialog-option') : [];
      const newPageDialog = document.getElementById('newPageDialog');
      const newPageDialogCloseButton = newPageDialog?.querySelector('.dialog-close');
      const newPageForm = document.getElementById('newPageForm');
      const newPageTitleInput = document.getElementById('newPageTitle');
      const newPageSteps = newPageForm
        ? Array.from(newPageForm.querySelectorAll('[data-step]'))
        : [];
      const newPageStepTabs = newPageForm
        ? Array.from(newPageForm.querySelectorAll('[data-step-tab]'))
        : [];
      const newPageNextButton = newPageForm?.querySelector('[data-new-page-nav="next"]') || null;
      const newPageSubmitButton = newPageForm?.querySelector('[data-new-page-nav="submit"]') || null;
      const newPageCancelButton =
        newPageForm?.querySelector('[data-new-page-action="cancel"]') || null;
      const newPageSlugInput = document.getElementById('newPageSlug');
      const newPageMetaTitleInput = document.getElementById('newPageMetaTitle');
      const newPageMetaDescriptionInput = document.getElementById('newPageMetaDescription');
      const newPageTypeButtons = newPageForm
        ? Array.from(newPageForm.querySelectorAll('[data-new-page-type-option]'))
        : [];
      const newPageTemplateButtons = newPageForm
        ? Array.from(newPageForm.querySelectorAll('[data-new-page-template-option]'))
        : [];
      const newPageTypeInput = document.getElementById('newPageTypeInput');
      const newPageTemplateInput = document.getElementById('newPageTemplateInput');
      const newPagePublishOptions = newPageForm
        ? Array.from(newPageForm.querySelectorAll('input[name="publishOption"]'))
        : [];
      const newPageScheduleFields = document.getElementById('newPageScheduleFields');
      const pageSettingsPublishOptions = Array.from(
        document.querySelectorAll('input[name="pagePublishOption"]')
      );
      const pageSettingsScheduleFields = document.getElementById('pageSettingsScheduleFields');
      let defaultNewPageTypeValue = '';
      let defaultNewPageTemplateValue = '';
      let activeNewPageTemplateIndex = -1;
      const copyPageDialog = document.getElementById('copyPageDialog');
      const copyPageDialogClose = copyPageDialog?.querySelector('.dialog-close');
      const copyPageForm = document.getElementById('copyPageForm');
      const copyPageNameInput = document.getElementById('copyPageNameInput');
      const copyPageSourceName = document.getElementById('copyPageSourceName');
      const copyPageCancelButton = copyPageDialog?.querySelector('[data-copy-dialog-action="cancel"]');
      let newPageCurrentStepIndex = 0;
      const masterCheckbox = document.getElementById('masterCheckbox');
      const bulkBar = document.getElementById('bulkActionsBar');
      const selectionCount = document.getElementById('selectionCount');
      const clearSelectionButton = document.getElementById('clearSelectionButton');
      const bulkActionButtons = document.querySelectorAll('[data-bulk-action]');
      const sortButtons = document.querySelectorAll('.sort-button');

      const folderSettingsDialog = document.getElementById('folderSettingsDialog');
      const folderDialogClose = folderSettingsDialog?.querySelector('.dialog-close');
      const folderSettingsForm = document.getElementById('folderSettingsForm');
      const folderDialogTitle = document.getElementById('folderDialogTitle');
      const folderDialogSubmitButton = folderSettingsForm?.querySelector('button[type="submit"]');
      const folderNameInput = document.getElementById('folderNameInput');
      const folderColorRadios = folderSettingsForm
        ? folderSettingsForm.querySelectorAll('input[name="folderColor"]')
        : [];
      const folderDialogCancel = folderSettingsDialog?.querySelector('[data-folder-dialog-action="cancel"]');

      const moveFolderDialog = document.getElementById('moveFolderDialog');
      const moveFolderDialogPanel = moveFolderDialog?.querySelector('.dialog');
      const moveFolderForm = document.getElementById('moveFolderForm');
      const moveFolderDestinationSelect = document.getElementById('moveFolderDestination');
      const moveFolderSubmitButton = moveFolderForm?.querySelector('[data-folder-dialog-primary]');

      const deleteFolderDialog = document.getElementById('deleteFolderDialog');
      const deleteFolderDialogPanel = deleteFolderDialog?.querySelector('.dialog');
      const deleteFolderForm = document.getElementById('deleteFolderForm');
      const deleteFolderConfirmInput = document.getElementById('deleteFolderConfirmInput');

      const restoreAllDialog = document.getElementById('restoreAllDialog');
      const restoreAllDialogPanel = restoreAllDialog?.querySelector('.dialog');
      const restoreAllForm = document.getElementById('restoreAllForm');

      const emptyTrashDialog = document.getElementById('emptyTrashDialog');
      const emptyTrashDialogPanel = emptyTrashDialog?.querySelector('.dialog');
      const emptyTrashForm = document.getElementById('emptyTrashForm');
      const emptyTrashConfirmInput = document.getElementById('emptyTrashConfirmInput');

      const pageSettingsDialog = document.getElementById('pageSettingsDialog');
      const pageSettingsDialogTitle = document.getElementById('pageSettingsDialogTitle');
      const pageSettingsDialogSubtitle = document.getElementById('pageSettingsDialogSubtitle');
      const pageSettingsDialogClose = pageSettingsDialog?.querySelector('.dialog-close');
      const pageSettingsCancel = pageSettingsDialog?.querySelector('[data-page-settings-action="cancel"]');
      const pageSettingsForm = document.getElementById('pageSettingsForm');
      const pageSettingsIdInput = document.getElementById('pageSettingsIdInput');
      const pageSettingsTitleInput = document.getElementById('pageSettingsTitleInput');
      const pageSettingsSlugInput = document.getElementById('pageSettingsSlugInput');
      const pageSettingsHomeToggle = document.getElementById('pageSettingsHomeToggle');
      const pageSettingsPrivacySelect = document.getElementById('pageSettingsPrivacy');
      const pageSettingsRequireLoginCheckbox = document.getElementById('pageSettingsRequireLogin');
      const pageSettingsComplexUrlCheckbox = document.getElementById('pageSettingsComplexUrl');
      const pageSettingsHideSearchCheckbox = document.getElementById('pageSettingsHideSearch');
      const pageSettingsHideSiteSearchCheckbox = document.getElementById('pageSettingsHideSiteSearch');
      const pageSettingsCanonicalInput = document.getElementById('pageSettingsCanonical');
      const pageSettingsMetaTitleInput = document.getElementById('pageSettingsMetaTitle');
      const pageSettingsMetaDescriptionInput = document.getElementById('pageSettingsMetaDescription');
      const pageSettingsOgTitleInput = document.getElementById('pageSettingsOgTitle');
      const pageSettingsOgDescriptionInput = document.getElementById('pageSettingsOgDescription');
      const pageSettingsOgImageInput = document.getElementById('pageSettingsOgImage');
      const pageSettingsTypeInput = document.getElementById('pageSettingsTypeInput');
      const pageSettingsTemplateInput = document.getElementById('pageSettingsTemplateInput');

      const publishDialog = document.getElementById('publishConfirmDialog');
      const publishDialogPanel = publishDialog?.querySelector('.dialog');
      const publishDialogForm = publishDialog?.querySelector('[data-publish-dialog-form]');
      const publishStatusLabel = publishDialog?.querySelector('[data-publish-current-status]');

      const unpublishDialog = document.getElementById('unpublishConfirmDialog');
      const unpublishDialogPanel = unpublishDialog?.querySelector('.dialog');
      const unpublishDialogForm = unpublishDialog?.querySelector('[data-unpublish-dialog-form]');
      const unpublishReasonSelect = unpublishDialog?.querySelector('#unpublishReason');
      const unpublishNoteInput = unpublishDialog?.querySelector('#unpublishNote');

      const scheduleDialog = document.getElementById('scheduleDialog');
      const scheduleDialogPanel = scheduleDialog?.querySelector('.dialog');
      const scheduleDialogForm = scheduleDialog?.querySelector('[data-schedule-dialog-form]');
      const scheduleDateInput = scheduleDialog?.querySelector('#scheduleDateInput');
      const scheduleTimeInput = scheduleDialog?.querySelector('#scheduleTimeInput');
      const scheduleTimezoneSelect = scheduleDialog?.querySelector('#scheduleTimezoneSelect');
      const scheduleNotifyCheckbox = scheduleDialog?.querySelector('#scheduleNotifyTeam');

      const moveDialog = document.getElementById('movePageDialog');
      const moveDialogPanel = moveDialog?.querySelector('.dialog');
      const moveDialogForm = moveDialog?.querySelector('[data-move-dialog-form]');
      const moveDialogOptions = moveDialog?.querySelector('[data-move-dialog-options]');

      const trashDialog = document.getElementById('trashConfirmDialog');
      const trashDialogPanel = trashDialog?.querySelector('.dialog');
      const trashDialogForm = trashDialog?.querySelector('[data-trash-dialog-form]');
      const trashNoteInput = trashDialog?.querySelector('#trashReason');

      const restoreDialog = document.getElementById('restoreConfirmDialog');
      const restoreDialogPanel = restoreDialog?.querySelector('.dialog');
      const restoreDialogForm = restoreDialog?.querySelector('[data-restore-dialog-form]');
      const restorePublishCheckbox = restoreDialog?.querySelector('#restorePublishToggle');

      const deleteDialog = document.getElementById('deleteConfirmDialog');
      const deleteDialogPanel = deleteDialog?.querySelector('.dialog');
      const deleteDialogForm = deleteDialog?.querySelector('[data-delete-dialog-form]');
      const deletePageConfirmInput = document.getElementById('deletePageConfirmInput');
      // Elements and configuration for the multi-select bulk action confirmation dialog.
      const bulkActionDialog = document.getElementById('bulkActionDialog');
      const bulkActionDialogPanel = bulkActionDialog?.querySelector('.dialog');
      const bulkActionDialogTitle = document.getElementById('bulkActionDialogTitle');
      const bulkActionDialogDescription = document.getElementById('bulkActionDialogDescription');
      const bulkActionDialogMessage = bulkActionDialog?.querySelector('[data-bulk-dialog-message]');
      const bulkActionDialogHint = bulkActionDialog?.querySelector('[data-bulk-dialog-hint]');
      const bulkActionDialogPrimary = bulkActionDialog?.querySelector('[data-bulk-dialog-primary]');
      const pageSettingsTabButtons = pageSettingsDialog
        ? Array.from(pageSettingsDialog.querySelectorAll('[data-page-settings-tab]'))
        : [];
      const pageSettingsPanels = pageSettingsDialog
        ? Array.from(pageSettingsDialog.querySelectorAll('[data-page-settings-panel]'))
        : [];
      const defaultPageSettingsTab =
        pageSettingsTabButtons[0]?.dataset.pageSettingsTab || null;
      let activePageSettingsTab = defaultPageSettingsTab;
      const pageSettingsTypeButtons = pageSettingsDialog
        ? Array.from(pageSettingsDialog.querySelectorAll('[data-page-type-option]'))
        : [];
      // Text templates for each bulk action so the dialog can adapt to the requested operation.
      const bulkActionDialogConfigs = {
        publish: {
          title: 'Publish pages',
          getPrimaryLabel: ({ count }) => (count === 1 ? 'Publish page' : 'Publish pages'),
          getMessage: ({ selectionLabel }) =>
            `Publish ${selectionLabel}? Everyone with access to your site will be able to view them.`,
          hint: 'We’ll notify collaborators who subscribe to publish updates.',
        },
        unpublish: {
          title: 'Unpublish pages',
          getPrimaryLabel: ({ count }) => (count === 1 ? 'Unpublish page' : 'Unpublish pages'),
          getMessage: ({ selectionLabel }) =>
            `Unpublish ${selectionLabel}? They will stay visible to teammates but hidden from visitors.`,
          hint: 'Existing share links will stop working for viewers without edit access.',
        },
        move: {
          title: 'Move to folder',
          getPrimaryLabel: ({ count }) => (count === 1 ? 'Move page' : 'Move pages'),
          getMessage: ({ selectionLabel }) =>
            `Move ${selectionLabel} into a different folder? Use this to keep work organized.`,
          hint: 'URLs, permissions, and analytics stay the same after moving.',
        },
        delete: {
          title: 'Move to trash',
          destructive: true,
          getPrimaryLabel: ({ count }) => (count === 1 ? 'Move to trash' : 'Move pages to trash'),
          getMessage: ({ selectionLabel }) =>
            `Move ${selectionLabel} to the trash? You can restore them within 30 days.`,
          hint: 'Trash is emptied automatically after 30 days.',
        },
      };
      // Encapsulated controller that opens/closes the bulk dialog and wires its buttons.
      const bulkActionDialogController = (() => {
        if (!(bulkActionDialog instanceof HTMLElement) || !(bulkActionDialogPanel instanceof HTMLElement)) {
          return null;
        }

        const trap = createFocusTrap(bulkActionDialogPanel);
        const closeButtons = Array.from(
          bulkActionDialog.querySelectorAll('[data-bulk-dialog-close]')
        );
        const cancelButtons = Array.from(
          bulkActionDialog.querySelectorAll('[data-bulk-dialog-cancel]')
        );
        let activeAction = null;
        let lastTrigger = null;

        const isOpen = () => bulkActionDialog.getAttribute('aria-hidden') === 'false';

        const applyConfig = (config, count) => {
          const noun = count === 1 ? 'page' : 'pages';
          const selectionLabel = count === 1 ? 'the selected page' : `${count} selected pages`;
          if (bulkActionDialogTitle) {
            bulkActionDialogTitle.textContent = config.title;
          }
          if (bulkActionDialogMessage) {
            const message =
              typeof config.getMessage === 'function'
                ? config.getMessage({ count, noun, selectionLabel })
                : `Apply this action to ${selectionLabel}?`;
            bulkActionDialogMessage.textContent = message;
          }
          if (bulkActionDialogPrimary) {
            const label =
              typeof config.getPrimaryLabel === 'function'
                ? config.getPrimaryLabel({ count, noun, selectionLabel })
                : config.primaryLabel || 'Continue';
            bulkActionDialogPrimary.textContent = label;
          }
          if (bulkActionDialogHint) {
            const hint =
              typeof config.getHint === 'function'
                ? config.getHint({ count, noun, selectionLabel })
                : config.hint || '';
            if (hint) {
              bulkActionDialogHint.textContent = hint;
              bulkActionDialogHint.hidden = false;
            } else {
              bulkActionDialogHint.textContent = '';
              bulkActionDialogHint.hidden = true;
            }
          }
          if (bulkActionDialogDescription) {
            bulkActionDialogDescription.classList.toggle(
              'action-dialog-warning',
              Boolean(config.destructive)
            );
          }
        };

        const close = ({ focusTrigger = true } = {}) => {
          if (!isOpen()) {
            return;
          }
          trap.deactivate();
          bulkActionDialog.setAttribute('aria-hidden', 'true');
          syncBodyScrollState();
          const trigger = lastTrigger;
          activeAction = null;
          lastTrigger = null;
          if (focusTrigger && trigger instanceof HTMLElement) {
            trigger.focus({ preventScroll: true });
          }
        };

        const open = (action, { trigger = null } = {}) => {
          const config = bulkActionDialogConfigs[action];
          if (!config) {
            return;
          }
          const count = state.selection.size;
          if (count === 0) {
            return;
          }
          applyConfig(config, count);
          activeAction = action;
          lastTrigger = trigger instanceof HTMLElement ? trigger : null;
          bulkActionDialog.setAttribute('aria-hidden', 'false');
          syncBodyScrollState();
          window.requestAnimationFrame(() => {
            const focusTarget =
              bulkActionDialogPrimary instanceof HTMLElement ? bulkActionDialogPrimary : null;
            trap.activate({ focusElement: focusTarget });
          });
        };

        const handleRequestClose = () => {
          close();
        };

        closeButtons.forEach((button) => {
          button.addEventListener('click', handleRequestClose);
        });

        cancelButtons.forEach((button) => {
          button.addEventListener('click', handleRequestClose);
        });

        bulkActionDialog.addEventListener('click', (event) => {
          if (event.target === bulkActionDialog) {
            close();
          }
        });

        bulkActionDialogPrimary?.addEventListener('click', () => {
          if (!activeAction) {
            close();
            return;
          }
          const selectedIds = Array.from(state.selection);
          console.log(`Bulk ${activeAction}`, selectedIds);
          clearSelection();
          close({ focusTrigger: false });
        });

        return { open, close, isOpen };
      })();
      // Cached collections used by the page settings drawer to know which template or type
      // options exist. These feed the tabbed form that appears when editing page metadata.
      const pageSettingsTemplateButtons = pageSettingsDialog
        ? Array.from(pageSettingsDialog.querySelectorAll('[data-page-template-option]'))
        : [];
      const defaultPageTypeValue =
        pageSettingsTypeButtons[0]?.dataset.pageTypeOption || '';
      const defaultPageTemplateValue =
        pageSettingsTemplateButtons[0]?.dataset.pageTemplateOption || '';

      // Default values for the "New page" flow, seeded by any pre-selected chips so the
      // dialog can highlight the correct options when opened.
      defaultNewPageTypeValue =
        newPageTypeInput?.value ||
        newPageTypeButtons[0]?.dataset.newPageTypeOption ||
        defaultPageTypeValue ||
        '';
      defaultNewPageTemplateValue =
        newPageTemplateInput?.value ||
        (newPageTemplateButtons.find(
          (button) => button.dataset.templateType === defaultNewPageTypeValue
        )?.dataset.newPageTemplateOption || '') ||
        (defaultPageTemplateValue &&
        newPageTemplateButtons.some(
          (button) => button.dataset.newPageTemplateOption === defaultPageTemplateValue
        )
          ? defaultPageTemplateValue
          : '') ||
        newPageTemplateButtons[0]?.dataset.newPageTemplateOption ||
        '';
      activeNewPageTemplateIndex = newPageTemplateButtons.findIndex((button) => {
        const ariaPressed = button.getAttribute('aria-pressed');
        return button.dataset.selected === 'true' || ariaPressed === 'true';
      });

      // Switch the page settings drawer between the Metadata and Template tabs while keeping
      // ARIA attributes aligned for accessibility. Only invoked by tab buttons in
      // this template.
      function setActivePageSettingsTab(tabValue, { focusTab = false } = {}) {
        if (!pageSettingsTabButtons.length || !pageSettingsPanels.length) {
          return;
        }

        const targetValue =
          pageSettingsTabButtons.find(
            (button) => button.dataset.pageSettingsTab === tabValue
          )?.dataset.pageSettingsTab || defaultPageSettingsTab;

        if (!targetValue) {
          return;
        }

        activePageSettingsTab = targetValue;

        pageSettingsTabButtons.forEach((button) => {
          const isActive = button.dataset.pageSettingsTab === targetValue;
          button.classList.toggle('is-active', isActive);
          button.setAttribute('aria-selected', isActive ? 'true' : 'false');
          button.tabIndex = isActive ? 0 : -1;
          if (isActive && focusTab) {
            button.focus({ preventScroll: true });
          }
        });

        pageSettingsPanels.forEach((panel) => {
          const isActive = panel.dataset.pageSettingsPanel === targetValue;
          panel.hidden = !isActive;
          panel.setAttribute('aria-hidden', isActive ? 'false' : 'true');
        });
      }

      // Keyboard helper that advances focus to the next or previous settings tab.
      // Used by keydown handlers in this file; no outside callers.
      function focusAdjacentPageSettingsTab(direction) {
        if (!pageSettingsTabButtons.length) {
          return;
        }
        const currentIndex = pageSettingsTabButtons.findIndex(
          (button) => button.dataset.pageSettingsTab === activePageSettingsTab
        );
        const startIndex = currentIndex >= 0 ? currentIndex : 0;
        const nextIndex =
          (startIndex + direction + pageSettingsTabButtons.length) %
          pageSettingsTabButtons.length;
        const nextTab = pageSettingsTabButtons[nextIndex]?.dataset.pageSettingsTab;
        if (nextTab) {
          setActivePageSettingsTab(nextTab, { focusTab: true });
        }
      }

      // Applies the chosen page type to the settings form and updates the related
      // segmented controls. Only used within desktop.php when initializing the
      // settings drawer.
      function setPageSettingsType(value) {
        const buttons = pageSettingsTypeButtons;
        if (!buttons.length) {
          if (pageSettingsTypeInput) {
            pageSettingsTypeInput.value = value || '';
          }
          return;
        }
        const availableValues = buttons
          .map((button) => button.dataset.pageTypeOption || '')
          .filter(Boolean);
        const target =
          (value && availableValues.includes(value) && value) ||
          defaultPageTypeValue ||
          availableValues[0] ||
          '';
        if (pageSettingsTypeInput) {
          pageSettingsTypeInput.value = target;
        }
        buttons.forEach((button) => {
          const buttonValue = button.dataset.pageTypeOption || '';
          const isSelected = Boolean(target) && buttonValue === target;
          button.dataset.selected = isSelected ? 'true' : 'false';
          button.setAttribute('aria-checked', isSelected ? 'true' : 'false');
          const radioInput = button.querySelector("input[type='radio']");
          if (radioInput instanceof HTMLInputElement && radioInput.type === 'radio') {
            radioInput.checked = isSelected;
          }
        });
      }

      // Applies the selected template within the settings dialog, syncing hidden
      // inputs and ARIA attributes. Only called by controls in this view.
      function setPageSettingsTemplate(value) {
        const buttons = pageSettingsTemplateButtons;
        if (!buttons.length) {
          if (pageSettingsTemplateInput) {
            pageSettingsTemplateInput.value = value || '';
          }
          return;
        }
        const availableValues = buttons
          .map((button) => button.dataset.pageTemplateOption || '')
          .filter(Boolean);
        const target =
          (value && availableValues.includes(value) && value) ||
          defaultPageTemplateValue ||
          availableValues[0] ||
          '';
        if (pageSettingsTemplateInput) {
          pageSettingsTemplateInput.value = target;
        }
        buttons.forEach((button) => {
          const buttonValue = button.dataset.pageTemplateOption || '';
          const isSelected = Boolean(target) && buttonValue === target;
          button.dataset.selected = isSelected ? 'true' : 'false';
          button.setAttribute('aria-checked', isSelected ? 'true' : 'false');
          const radioInput = button.querySelector("input[type='radio']");
          if (radioInput instanceof HTMLInputElement && radioInput.type === 'radio') {
            radioInput.checked = isSelected;
          }
        });
      }

      // Cache frequently accessed DOM nodes for the list, folders, and contextual actions.
      const pageRows = Array.from(document.querySelectorAll('.page-row'));
      const folderRows = Array.from(document.querySelectorAll('.group-row'));
      const folderToggleButtons = Array.from(document.querySelectorAll('[data-folder-toggle]'));
      const folderCheckboxes = Array.from(document.querySelectorAll('[data-folder-checkbox]'));
      const folderViewToggleButton = document.querySelector('[data-folder-toggle-all]');
      const folderViewToggleIcon =
        folderViewToggleButton?.querySelector('[data-folder-view-icon]') || null;
      const flatViewToggleButton = document.querySelector('[data-flat-view-toggle]');
      const flatViewToggleIcon = flatViewToggleButton?.querySelector('[data-flat-view-icon]') || null;
      const actionMenus = Array.from(document.querySelectorAll('[data-action-menu]'));
      const copyPageButtons = Array.from(document.querySelectorAll('[data-copy-page]'));

      const pageRowById = new Map(pageRows.map((row) => [row.dataset.pageId, row]));
      const folderRowById = new Map(folderRows.map((row) => [row.dataset.folder, row]));

      // Create lookup tables so folder/group operations can quickly locate child rows.
      const folderMembers = new Map();
      pageRows.forEach((row) => {
        const folderId = row.dataset.folder || '_root';
        if (!folderMembers.has(folderId)) {
          folderMembers.set(folderId, []);
        }
        if (!row.dataset.template) {
          const fallbackTemplate =
            TEMPLATE_DEFAULTS_BY_TYPE[row.dataset.type || ''] ||
            defaultPageTemplateValue;
          if (fallbackTemplate) {
            row.dataset.template = fallbackTemplate;
          }
        }
        folderMembers.get(folderId).push(row);
      });

      const folderOptions = [{ value: '_root', label: 'No folder' }];
      const seenFolders = new Set(['_root']);
      folderRows.forEach((row) => {
        const folderId = row.dataset.folder || '';
        if (!folderId || seenFolders.has(folderId)) {
          return;
        }
        const label = row.dataset.folderName || folderId;
        folderOptions.push({ value: folderId, label });
        seenFolders.add(folderId);
      });

      const actionDialogControllers = [];
      const actionDialogs = {};
      const folderActionDialogs = {};

      const publishDialogController = createActionDialog({
        name: 'publish',
        backdrop: publishDialog,
        dialog: publishDialogPanel,
        form: publishDialogForm,
        initialFocusSelector: '#publishVisibility',
        onOpen: ({ row }) => {
          if (publishStatusLabel) {
            const statusValue = row?.dataset.status || '';
            const statusLabel = statusValue ? getStatusLabel(statusValue) : '—';
            publishStatusLabel.textContent = statusLabel || '—';
          }
        },
        onClose: () => {
          if (publishStatusLabel) {
            publishStatusLabel.textContent = '—';
          }
        },
        onSubmit: ({ pageId, form }) => {
          const formData = new FormData(form);
          const visibility = (formData.get('publishVisibility') || 'public').toString();
          const notify = formData.has('publishNotifySubscribers');
          console.log('Publish page', {
            pageId,
            visibility,
            notifySubscribers: notify,
          });
        },
      });

      if (publishDialogController) {
        actionDialogControllers.push(publishDialogController);
        actionDialogs.publish = publishDialogController;
      }

      const unpublishDialogController = createActionDialog({
        name: 'unpublish',
        backdrop: unpublishDialog,
        dialog: unpublishDialogPanel,
        form: unpublishDialogForm,
        initialFocusSelector: '#unpublishReason',
        onOpen: () => {
          if (unpublishReasonSelect instanceof HTMLSelectElement && unpublishReasonSelect.options.length > 0) {
            unpublishReasonSelect.value = unpublishReasonSelect.options[0].value;
          }
          if (unpublishNoteInput instanceof HTMLTextAreaElement) {
            unpublishNoteInput.value = '';
          }
        },
        onSubmit: ({ pageId, form }) => {
          const formData = new FormData(form);
          const reason = (formData.get('unpublishReason') || '').toString();
          const note = (formData.get('unpublishNote') || '').toString().trim();
          console.log('Unpublish page', {
            pageId,
            reason,
            note: note || null,
          });
        },
      });

      if (unpublishDialogController) {
        actionDialogControllers.push(unpublishDialogController);
        actionDialogs.unpublish = unpublishDialogController;
      }

      const scheduleDialogController = createActionDialog({
        name: 'schedule',
        backdrop: scheduleDialog,
        dialog: scheduleDialogPanel,
        form: scheduleDialogForm,
        initialFocusSelector: '#scheduleDateInput',
        onOpen: () => {
          const now = new Date();
          if (scheduleDateInput instanceof HTMLInputElement) {
            const today = formatDateInputValue(now);
            scheduleDateInput.min = today;
            scheduleDateInput.value = today;
          }
          if (scheduleTimeInput instanceof HTMLInputElement) {
            scheduleTimeInput.value = formatTimeInputValue(now);
          }
          if (scheduleTimezoneSelect instanceof HTMLSelectElement) {
            const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone || 'UTC';
            if (scheduleTimezoneSelect.querySelector(`option[value="${timezone}"]`)) {
              scheduleTimezoneSelect.value = timezone;
            } else {
              scheduleTimezoneSelect.value = 'UTC';
            }
          }
          if (scheduleNotifyCheckbox instanceof HTMLInputElement) {
            scheduleNotifyCheckbox.checked = true;
          }
        },
        onSubmit: ({ pageId, form }) => {
          const formData = new FormData(form);
          const date = (formData.get('scheduleDate') || '').toString();
          const time = (formData.get('scheduleTime') || '').toString();
          const timezone = (formData.get('scheduleTimezone') || '').toString();
          const notify = formData.has('scheduleNotifyTeam');
          console.log('Schedule page', {
            pageId,
            schedule: { date, time, timezone },
            notifyOwner: notify,
          });
        },
      });

      if (scheduleDialogController) {
        actionDialogControllers.push(scheduleDialogController);
        actionDialogs.schedule = scheduleDialogController;
      }

      const moveDialogController = createActionDialog({
        name: 'move',
        backdrop: moveDialog,
        dialog: moveDialogPanel,
        form: moveDialogForm,
        initialFocusSelector: 'input[name="moveFolder"]',
        onOpen: ({ row }) => {
          if (!(moveDialogOptions instanceof HTMLElement)) {
            return;
          }
          moveDialogOptions.innerHTML = '';
          const currentFolder = row?.dataset.folder || '_root';
          folderOptions.forEach(({ value, label }) => {
            const optionLabel = label || (value === '_root' ? 'No folder' : value);
            const wrapper = document.createElement('label');
            wrapper.className = 'action-dialog-radio';
            const radio = document.createElement('input');
            radio.type = 'radio';
            radio.name = 'moveFolder';
            radio.value = value;
            radio.required = true;
            radio.checked = value === currentFolder;
            const text = document.createElement('div');
            text.className = 'action-dialog-radio-text';
            const title = document.createElement('strong');
            title.textContent = optionLabel;
            const subtitle = document.createElement('span');
            subtitle.textContent =
              value === currentFolder ? 'Currently assigned' : 'Move page to this folder';
            text.append(title, subtitle);
            wrapper.append(radio, text);
            moveDialogOptions.append(wrapper);
          });
        },
        onClose: () => {
          if (moveDialogOptions instanceof HTMLElement) {
            moveDialogOptions.innerHTML = '';
          }
        },
        onSubmit: ({ pageId, form }) => {
          const formData = new FormData(form);
          const folderId = (formData.get('moveFolder') || '_root').toString();
          console.log('Move page to folder', {
            pageId,
            folderId,
          });
        },
      });

      if (moveDialogController) {
        actionDialogControllers.push(moveDialogController);
        actionDialogs.move = moveDialogController;
      }

      const trashDialogController = createActionDialog({
        name: 'trash',
        backdrop: trashDialog,
        dialog: trashDialogPanel,
        form: trashDialogForm,
        initialFocusSelector: '#trashReason',
        onOpen: () => {
          if (trashNoteInput instanceof HTMLTextAreaElement) {
            trashNoteInput.value = '';
          }
        },
        onSubmit: ({ pageId, form }) => {
          const formData = new FormData(form);
          const note = (formData.get('trashReason') || '').toString().trim();
          console.log('Move page to trash', {
            pageId,
            note: note || null,
          });
        },
      });

      if (trashDialogController) {
        actionDialogControllers.push(trashDialogController);
        actionDialogs.trash = trashDialogController;
      }

      const restoreDialogController = createActionDialog({
        name: 'restore',
        backdrop: restoreDialog,
        dialog: restoreDialogPanel,
        form: restoreDialogForm,
        initialFocusSelector: '#restorePublishToggle',
        onOpen: () => {
          if (restorePublishCheckbox instanceof HTMLInputElement) {
            restorePublishCheckbox.checked = false;
          }
        },
        onSubmit: ({ pageId, form }) => {
          const formData = new FormData(form);
          const publish = formData.has('restorePublish');
          console.log('Restore page', {
            pageId,
            publishImmediately: publish,
          });
        },
      });

      if (restoreDialogController) {
        actionDialogControllers.push(restoreDialogController);
        actionDialogs.restore = restoreDialogController;
      }

      const deleteDialogController = createActionDialog({
        name: 'delete-permanently',
        backdrop: deleteDialog,
        dialog: deleteDialogPanel,
        form: deleteDialogForm,
        initialFocusSelector: '#deletePageConfirmInput',
        onOpen: ({ pageId, row }) => {
          const pageName = getPageNameFromRow(row);
          if (deletePageConfirmInput instanceof HTMLInputElement) {
            deletePageConfirmInput.value = '';
            deletePageConfirmInput.placeholder = pageName;
            deletePageConfirmInput.setCustomValidity('');
          }
        },
        onClose: () => {
          if (deletePageConfirmInput instanceof HTMLInputElement) {
            deletePageConfirmInput.value = '';
            deletePageConfirmInput.setCustomValidity('');
            deletePageConfirmInput.removeAttribute('placeholder');
          }
        },
        onSubmit: ({ pageId, row, form }) => {
          const pageName = getPageNameFromRow(row);
          const typedValue = (deletePageConfirmInput?.value || '').trim();
          if (!typedValue || typedValue !== pageName) {
            if (deletePageConfirmInput instanceof HTMLInputElement) {
              deletePageConfirmInput.setCustomValidity('Enter the page name exactly to confirm.');
              deletePageConfirmInput.reportValidity();
            }
            return false;
          }
          console.log('Delete page permanently', {
            pageId,
            confirmed: true,
          });
          return true;
        },
      });

      if (deleteDialogController) {
        actionDialogControllers.push(deleteDialogController);
        actionDialogs['delete'] = deleteDialogController;
      }

      const moveFolderDialogController = createFolderActionDialog({
        name: 'move-folder',
        backdrop: moveFolderDialog,
        dialog: moveFolderDialogPanel,
        form: moveFolderForm,
        initialFocusSelector: '#moveFolderDestination',
        onOpen: ({ folderId }) => {
          if (!(moveFolderDestinationSelect instanceof HTMLSelectElement)) {
            return;
          }
          moveFolderDestinationSelect.innerHTML = '';
          moveFolderDestinationSelect.disabled = false;
          moveFolderDestinationSelect.required = true;
          folderOptions.forEach(({ value, label }) => {
            if (!value || value === folderId) {
              return;
            }
            const option = document.createElement('option');
            option.value = value;
            option.textContent = label;
            moveFolderDestinationSelect.append(option);
          });
          if (moveFolderDestinationSelect.options.length > 0) {
            moveFolderDestinationSelect.value = moveFolderDestinationSelect.options[0].value;
            moveFolderDestinationSelect.setCustomValidity('');
          } else {
            const placeholderOption = document.createElement('option');
            placeholderOption.value = '';
            placeholderOption.textContent = 'No available destinations';
            placeholderOption.disabled = true;
            placeholderOption.selected = true;
            moveFolderDestinationSelect.append(placeholderOption);
            moveFolderDestinationSelect.disabled = true;
          }
          if (moveFolderSubmitButton instanceof HTMLButtonElement) {
            moveFolderSubmitButton.disabled = moveFolderDestinationSelect.disabled;
          }
        },
        onClose: () => {
          if (moveFolderDestinationSelect instanceof HTMLSelectElement) {
            moveFolderDestinationSelect.innerHTML = '';
            moveFolderDestinationSelect.disabled = false;
            moveFolderDestinationSelect.setCustomValidity('');
          }
          if (moveFolderSubmitButton instanceof HTMLButtonElement) {
            moveFolderSubmitButton.disabled = false;
          }
        },
        onSubmit: ({ folderId, form }) => {
          if (!(form instanceof HTMLFormElement)) {
            return true;
          }
          const formData = new FormData(form);
          const destination = (formData.get('destination') || '').toString();
          if (!destination) {
            if (moveFolderDestinationSelect instanceof HTMLSelectElement) {
              moveFolderDestinationSelect.setCustomValidity('Select a destination.');
              moveFolderDestinationSelect.reportValidity();
            }
            return false;
          }
          console.log('Move folder', { folderId, destination });
          return true;
        },
      });

      if (moveFolderDialogController) {
        actionDialogControllers.push(moveFolderDialogController);
        folderActionDialogs.move = moveFolderDialogController;
      }

      const deleteFolderDialogController = createFolderActionDialog({
        name: 'delete-folder',
        backdrop: deleteFolderDialog,
        dialog: deleteFolderDialogPanel,
        form: deleteFolderForm,
        initialFocusSelector: '#deleteFolderConfirmInput',
        onOpen: ({ folderName }) => {
          if (deleteFolderConfirmInput instanceof HTMLInputElement) {
            deleteFolderConfirmInput.value = '';
            deleteFolderConfirmInput.placeholder = folderName;
            deleteFolderConfirmInput.setCustomValidity('');
          }
        },
        onClose: () => {
          if (deleteFolderConfirmInput instanceof HTMLInputElement) {
            deleteFolderConfirmInput.value = '';
            deleteFolderConfirmInput.setCustomValidity('');
            deleteFolderConfirmInput.removeAttribute('placeholder');
          }
        },
        onSubmit: ({ folderId, folderName }) => {
          const typedValue = (deleteFolderConfirmInput?.value || '').trim();
          if (!typedValue || typedValue !== folderName) {
            if (deleteFolderConfirmInput instanceof HTMLInputElement) {
              deleteFolderConfirmInput.setCustomValidity('Enter the folder name exactly to confirm.');
              deleteFolderConfirmInput.reportValidity();
            }
            return false;
          }
          console.log('Delete folder permanently', { folderId });
          return true;
        },
      });

      if (deleteFolderDialogController) {
        actionDialogControllers.push(deleteFolderDialogController);
        folderActionDialogs.delete = deleteFolderDialogController;
      }

      const restoreAllDialogController = createFolderActionDialog({
        name: 'restore-all',
        backdrop: restoreAllDialog,
        dialog: restoreAllDialogPanel,
        form: restoreAllForm,
        onSubmit: ({ folderId }) => {
          console.log('Restore all pages for folder', { folderId });
          return true;
        },
      });

      if (restoreAllDialogController) {
        actionDialogControllers.push(restoreAllDialogController);
        folderActionDialogs['restore-all'] = restoreAllDialogController;
      }

      const emptyTrashDialogController = createFolderActionDialog({
        name: 'empty-trash',
        backdrop: emptyTrashDialog,
        dialog: emptyTrashDialogPanel,
        form: emptyTrashForm,
        initialFocusSelector: '#emptyTrashConfirmInput',
        onOpen: () => {
          if (emptyTrashConfirmInput instanceof HTMLInputElement) {
            emptyTrashConfirmInput.value = '';
            emptyTrashConfirmInput.setCustomValidity('');
          }
        },
        onClose: () => {
          if (emptyTrashConfirmInput instanceof HTMLInputElement) {
            emptyTrashConfirmInput.value = '';
            emptyTrashConfirmInput.setCustomValidity('');
          }
        },
        onSubmit: ({ folderId }) => {
          const typedValue = (emptyTrashConfirmInput?.value || '').trim();
          if (!typedValue || typedValue.toUpperCase() !== 'EMPTY') {
            if (emptyTrashConfirmInput instanceof HTMLInputElement) {
              emptyTrashConfirmInput.setCustomValidity('Type EMPTY to confirm.');
              emptyTrashConfirmInput.reportValidity();
            }
            return false;
          }
          console.log('Empty trash', { folderId });
          return true;
        },
      });

      if (emptyTrashDialogController) {
        actionDialogControllers.push(emptyTrashDialogController);
        folderActionDialogs.empty = emptyTrashDialogController;
      }

      const authorOptions = Array.from(
        new Set([
          ...pageRows.map((row) => row.dataset.author || '').filter(Boolean),
          ...Object.keys(AUTHOR_DETAILS),
        ])
      )
        .filter(Boolean)
        .sort((a, b) => a.localeCompare(b));

      // Build a normalized representation of each row for searching, filtering, and UI updates.
      const rowData = pageRows.map((row) => {
        const {
          pageId = '',
          status = 'all',
          type = '',
          author = '',
          title = '',
          template = '',
        } = row.dataset;
        const slugElement = row.querySelector('.title-text .subtitle');
        const slug = slugElement ? slugElement.textContent.trim() : '';
        const searchSource = [title, slug, status, type, author, template, row.textContent || '']
          .join(' ')
          .toLowerCase()
          .replace(/\s+/g, ' ')
          .trim();
        const reportIssues = new Set(
          (row.dataset.reportIssues || '')
            .split(/\s+/)
            .map((value) => value.trim())
            .filter(Boolean)
        );
        return {
          element: row,
          pageId,
          status,
          type,
          author,
          title,
          slug,
          template,
          created: row.dataset.created || '',
          modified: row.dataset.modified || '',
          reportIssues,
          searchText: searchSource,
        };
      });

      // Apply presentational data attributes (chip colors, avatar accents) derived from row metadata.
      // Called only during initial hydration of this template to make placeholder
      // content look cohesive.
      function applyRowVisualStyles() {
        rowData.forEach(({ element, type, author }) => {
          const typeChip = element.querySelector('.chip');
          if (typeChip) {
            typeChip.dataset.color = TYPE_STYLES[type] || 'slate';
          }

          const avatarSpan = element.querySelector('.author-filter .avatar span');
          if (avatarSpan) {
            const { color = DEFAULT_AUTHOR_COLOR } = AUTHOR_DETAILS[author] || {};
            avatarSpan.dataset.color = color;
          }
        });
      }

      applyRowVisualStyles();

      copyPageButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
          event.preventDefault();
          const row = button.closest('.page-row');
          const pageId = row?.dataset.pageId;
          if (pageId) {
            openCopyPageDialog(pageId, button);
          }
        });
      });

      // Reset and seed the Page Settings dialog with defaults before opening. Only
      // referenced internally when showing the settings dialog.
      function populatePageSettingsControls() {
        if (pageSettingsPrivacySelect) {
          pageSettingsPrivacySelect.value = 'any';
        }
        [
          pageSettingsHomeToggle,
          pageSettingsComplexUrlCheckbox,
          pageSettingsHideSearchCheckbox,
          pageSettingsHideSiteSearchCheckbox,
          pageSettingsRequireLoginCheckbox,
        ].forEach((checkbox) => {
          if (checkbox instanceof HTMLInputElement) {
            checkbox.checked = false;
          }
        });
        [
          pageSettingsCanonicalInput,
          pageSettingsMetaTitleInput,
          pageSettingsMetaDescriptionInput,
          pageSettingsOgTitleInput,
          pageSettingsOgDescriptionInput,
        ].forEach((input) => {
          if (input instanceof HTMLInputElement || input instanceof HTMLTextAreaElement) {
            input.value = '';
          }
        });
        if (pageSettingsOgImageInput instanceof HTMLInputElement) {
          pageSettingsOgImageInput.value = '';
        }
        setPageSettingsType(defaultPageTypeValue);
        setPageSettingsTemplate(defaultPageTemplateValue);
      }

      // Clears the Page Settings dialog state so subsequent opens start fresh.
      // Used solely within this desktop.php script.
      function resetPageSettingsDialog() {
        pageSettingsForm?.reset();
        if (pageSettingsDialogSubtitle) {
          pageSettingsDialogSubtitle.textContent = '';
        }
        if (pageSettingsIdInput) {
          pageSettingsIdInput.value = '';
        }
        populatePageSettingsControls();
        setActivePageSettingsTab(defaultPageSettingsTab);
      }

     // Opens the Page Settings drawer for a specific row. Triggered by action
     // buttons within this template; not reused elsewhere.
     function openPageSettingsDialog(pageId, trigger) {
        if (!pageSettingsDialog || !pageId) {
          return;
        }
        const row = pageRowById.get(pageId);
        if (!row) {
          return;
        }
        resetPageSettingsDialog();
        populatePageSettingsControls();
        activePageId = pageId;
        lastPageSettingsTrigger = trigger || null;

        const fallbackTitle =
          row.dataset.title ||
          row.querySelector('.title-button')?.textContent?.trim() ||
          'Untitled page';
        const slug = row.dataset.pageId || '';
        const metaTitle = row.dataset.metaTitle || fallbackTitle;
        const metaDescription = row.dataset.metaDescription || '';
        const ogTitle = row.dataset.ogTitle || fallbackTitle;
        const ogDescription = row.dataset.ogDescription || '';
        const privacy = row.dataset.privacy || 'any';
        const requiresLogin = row.dataset.requireLogin === 'true';
        const complexUrl = row.dataset.complexUrl === 'true';
        const hideSearch = row.dataset.hideSearch === 'true';
        const hideSiteSearch = row.dataset.hideSiteSearch === 'true';
        const canonicalUrl = row.dataset.canonicalUrl || '';
        const isHomePage = row.dataset.home === 'true';

        if (pageSettingsDialogTitle) {
          pageSettingsDialogTitle.textContent = 'Page settings';
        }
        if (pageSettingsDialogSubtitle) {
          pageSettingsDialogSubtitle.textContent = fallbackTitle;
        }
        if (pageSettingsIdInput) {
          pageSettingsIdInput.value = pageId;
        }
        if (pageSettingsTitleInput) {
          pageSettingsTitleInput.value = fallbackTitle;
        }
        if (pageSettingsSlugInput) {
          pageSettingsSlugInput.value = slug;
        }
        if (pageSettingsHomeToggle) {
          pageSettingsHomeToggle.checked = isHomePage;
        }
        if (pageSettingsPrivacySelect) {
          if (!pageSettingsPrivacySelect.querySelector(`option[value="${privacy}"]`)) {
            const option = document.createElement('option');
            option.value = privacy;
            option.textContent = privacy;
            pageSettingsPrivacySelect.append(option);
          }
          pageSettingsPrivacySelect.value = privacy;
        }
        if (pageSettingsRequireLoginCheckbox) {
          pageSettingsRequireLoginCheckbox.checked = requiresLogin;
        }
        if (pageSettingsComplexUrlCheckbox) {
          pageSettingsComplexUrlCheckbox.checked = complexUrl;
        }
        if (pageSettingsHideSearchCheckbox) {
          pageSettingsHideSearchCheckbox.checked = hideSearch;
        }
        if (pageSettingsHideSiteSearchCheckbox) {
          pageSettingsHideSiteSearchCheckbox.checked = hideSiteSearch;
        }
        if (pageSettingsCanonicalInput) {
          pageSettingsCanonicalInput.value = canonicalUrl;
        }
        if (pageSettingsMetaTitleInput) {
          pageSettingsMetaTitleInput.value = metaTitle;
        }
        if (pageSettingsMetaDescriptionInput) {
          pageSettingsMetaDescriptionInput.value = metaDescription;
        }
        if (pageSettingsOgTitleInput) {
          pageSettingsOgTitleInput.value = ogTitle;
        }
        if (pageSettingsOgDescriptionInput) {
          pageSettingsOgDescriptionInput.value = ogDescription;
        }

        const typeValue = row.dataset.type || defaultPageTypeValue;
        setPageSettingsType(typeValue);

        const suggestedTemplate =
          TEMPLATE_DEFAULTS_BY_TYPE[typeValue] || defaultPageTemplateValue;
        const templateValue = row.dataset.template || suggestedTemplate;
        if (!row.dataset.template && templateValue) {
          row.dataset.template = templateValue;
        }
        setPageSettingsTemplate(templateValue);

        pageSettingsDialog.setAttribute('aria-hidden', 'false');
        syncBodyScrollState();
        window.requestAnimationFrame(() => {
          pageSettingsTitleInput?.focus({ preventScroll: true });
        });
      }

      // Hides the Page Settings drawer and restores focus back to the trigger when
      // appropriate. Only used by event handlers in this view.
      function closePageSettingsDialog({ focusTrigger = true } = {}) {
        if (!pageSettingsDialog) {
          return;
        }
        pageSettingsDialog.setAttribute('aria-hidden', 'true');
        syncBodyScrollState();
        if (focusTrigger && lastPageSettingsTrigger instanceof HTMLElement) {
          lastPageSettingsTrigger.focus({ preventScroll: true });
        }
        activePageId = null;
        lastPageSettingsTrigger = null;
        resetPageSettingsDialog();
      }

      populatePageSettingsControls();
      resetPageSettingsDialog();

      const folderState = (() => {
        try {
          const stored = localStorage.getItem(folderStateStorageKey);
          if (!stored) {
            return {};
          }
          const parsed = JSON.parse(stored);
          return typeof parsed === 'object' && parsed !== null ? parsed : {};
        } catch (error) {
          console.warn('Unable to parse folder state', error);
          return {};
        }
      })();

      let isFlatView = (() => {
        try {
          const stored = localStorage.getItem(flatViewStorageKey);
          return stored === 'true';
        } catch (error) {
          console.warn('Unable to parse flat view preference', error);
          return false;
        }
      })();

      let activeFolderId = null;
      let folderDialogMode = 'edit';
      let lastFolderDialogTrigger = null;
      const DEFAULT_FOLDER_COLOR = 'blue';
      let activePageId = null;
      let lastPageSettingsTrigger = null;
      let activeCopyPageId = null;
      let lastCopyPageTrigger = null;
      // Toggles body scrolling based on whether any drawers or dialogs are open.
      // This is local to the Pages desktop template; no shared usage elsewhere.
      function syncBodyScrollState() {
        const drawerOpen = filtersDrawer?.getAttribute('aria-hidden') === 'false';
        const createDialogOpen = dialog?.getAttribute('aria-hidden') === 'false';
        const folderDialogOpen = folderSettingsDialog?.getAttribute('aria-hidden') === 'false';
        const newPageDialogOpen = newPageDialog?.getAttribute('aria-hidden') === 'false';
        const pageSettingsOpen = pageSettingsDialog?.getAttribute('aria-hidden') === 'false';
        const copyPageDialogOpen = copyPageDialog?.getAttribute('aria-hidden') === 'false';
        const actionDialogsOpen = actionDialogControllers.some(
          (controller) => typeof controller?.isOpen === 'function' && controller.isOpen()
        );
        document.body.style.overflow =
          drawerOpen ||
          createDialogOpen ||
          folderDialogOpen ||
          newPageDialogOpen ||
          pageSettingsOpen ||
          copyPageDialogOpen ||
          actionDialogsOpen
            ? 'hidden'
            : '';
      }

      // Closes a row-level action menu and optionally restores focus. Used only by
      // menu click/keyboard handlers in this file.
      function closeActionMenu(menu, { focusTrigger = false } = {}) {
        if (!menu) {
          return;
        }
        const trigger = menu.querySelector('[data-action-menu-trigger]');
        const dropdown = menu.querySelector('[data-action-menu-dropdown]');
        if (!trigger || !dropdown) {
          return;
        }
        menu.dataset.open = 'false';
        trigger.setAttribute('aria-expanded', 'false');
        dropdown.hidden = true;
        if (focusTrigger) {
          trigger.focus({ preventScroll: true });
        }
      }

      // Opens a row-level action menu. Called by triggers inside this template; no
      // external scripts rely on it.
      function openActionMenu(menu) {
        if (!menu) {
          return;
        }
        const trigger = menu.querySelector('[data-action-menu-trigger]');
        const dropdown = menu.querySelector('[data-action-menu-dropdown]');
        if (!trigger || !dropdown) {
          return;
        }
        closeAllActionMenus(menu);
        menu.dataset.open = 'true';
        trigger.setAttribute('aria-expanded', 'true');
        dropdown.hidden = false;
      }

      // Closes every action menu except an optional exclusion. Used to ensure only
      // one dropdown stays open within this template.
      function closeAllActionMenus(exceptMenu = null) {
        actionMenus.forEach((menu) => {
          if (menu === exceptMenu) {
            return;
          }
          closeActionMenu(menu);
        });
      }

      // Minimal focus trap to keep keyboard users inside dialogs/modals while they are open.
      // Exclusively used by dialogs defined in this PHP view.
      function createFocusTrap(container) {
        if (!(container instanceof HTMLElement)) {
          return {
            activate() {},
            deactivate() {},
          };
        }

        const getFocusableElements = () =>
          Array.from(
            container.querySelectorAll(
              'a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])'
            )
          ).filter((element) => {
            if (!(element instanceof HTMLElement)) {
              return false;
            }
            if (element.hasAttribute('disabled')) {
              return false;
            }
            if (element.getAttribute('aria-hidden') === 'true') {
              return false;
            }
            const { offsetParent } = element;
            return offsetParent !== null || element === document.activeElement;
          });

        const handleKeydown = (event) => {
          if (event.key !== 'Tab') {
            return;
          }

          const focusable = getFocusableElements();
          if (focusable.length === 0) {
            event.preventDefault();
            container.focus({ preventScroll: true });
            return;
          }

          const currentIndex = focusable.indexOf(document.activeElement);
          if (event.shiftKey) {
            if (currentIndex <= 0) {
              event.preventDefault();
              focusable[focusable.length - 1].focus({ preventScroll: true });
            }
          } else if (currentIndex === focusable.length - 1) {
            event.preventDefault();
            focusable[0].focus({ preventScroll: true });
          }
        };

        return {
          activate({ focusElement = null } = {}) {
            container.addEventListener('keydown', handleKeydown);
            const focusable = getFocusableElements();
            const target =
              focusElement instanceof HTMLElement
                ? focusElement
                : focusable[0] || container;
            if (target instanceof HTMLElement) {
              target.focus({ preventScroll: true });
            }
          },
          deactivate() {
            container.removeEventListener('keydown', handleKeydown);
          },
        };
      }

      // Resolves a friendly page name from a table row for use in dialog copy.
      // Called by action dialog builders within this template only.
      function getPageNameFromRow(row) {
        if (!(row instanceof HTMLElement)) {
          return 'this page';
        }
        const explicitTitle = row.dataset.title;
        if (explicitTitle) {
          return explicitTitle;
        }
        const buttonTitle = row.querySelector('.title-button')?.textContent?.trim();
        if (buttonTitle) {
          return buttonTitle;
        }
        const textTitle = row.querySelector('.title-text')?.textContent?.trim();
        if (textTitle) {
          return textTitle;
        }
        return row.dataset.pageId || 'this page';
      }

      // Resolves a friendly folder name from a table row for dialog copy. Only
      // referenced locally by folder action dialogs.
      function getFolderNameFromRow(row) {
        if (!(row instanceof HTMLElement)) {
          return 'this folder';
        }
        const explicitName = row.dataset.folderName;
        if (explicitName) {
          return explicitName;
        }
        const textName = row.querySelector('.folder-name')?.textContent?.trim();
        if (textName) {
          return textName;
        }
        const identifier = row.dataset.folder;
        if (identifier === '_root') {
          return 'Root';
        }
        if (identifier === 'trash') {
          return 'Trash';
        }
        return identifier || 'this folder';
      }

      // Formats a Date into an ISO date string for <input type="date"> controls.
      // Used internally when prefilling schedule dialogs.
      function formatDateInputValue(date) {
        if (!(date instanceof Date) || Number.isNaN(date.getTime())) {
          return '';
        }
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
      }

      // Formats a Date into HH:MM for <input type="time"> fields. Used only by
      // scheduling helpers below.
      function formatTimeInputValue(date) {
        if (!(date instanceof Date) || Number.isNaN(date.getTime())) {
          return '';
        }
        return date.toLocaleTimeString([], { hour12: false, hour: '2-digit', minute: '2-digit' });
      }

      // Generic dialog factory for page-level actions (rename, delete, etc.). All
      // usage happens inside this controller to keep dialog wiring consistent.
      function createActionDialog({
        name,
        backdrop,
        dialog,
        form = null,
        initialFocusSelector = '[data-dialog-primary]',
        onOpen = null,
        onClose = null,
        onSubmit = null,
      }) {
        if (!(backdrop instanceof HTMLElement) || !(dialog instanceof HTMLElement)) {
          return null;
        }

        const trap = createFocusTrap(dialog);
        const pageNameTargets = Array.from(
          dialog.querySelectorAll('[data-dialog-page-name]')
        );
        const closeButtons = Array.from(backdrop.querySelectorAll('[data-dialog-close]'));
        const cancelButtons = Array.from(backdrop.querySelectorAll('[data-dialog-cancel]'));

        let activePageIdForDialog = null;
        let lastTriggerForDialog = null;

        const isOpen = () => backdrop.getAttribute('aria-hidden') === 'false';

        const setPageName = (name) => {
          pageNameTargets.forEach((target) => {
            target.textContent = name;
          });
        };

        const open = (pageId, { trigger = null } = {}) => {
          if (!pageId) {
            return;
          }
          const row = pageRowById.get(pageId) || null;
          activePageIdForDialog = pageId;
          lastTriggerForDialog = trigger instanceof HTMLElement ? trigger : null;
          setPageName(getPageNameFromRow(row));
          if (typeof onOpen === 'function') {
            onOpen({ pageId, row, dialog, backdrop });
          }
          backdrop.setAttribute('aria-hidden', 'false');
          syncBodyScrollState();
          window.requestAnimationFrame(() => {
            const initialFocus = initialFocusSelector
              ? dialog.querySelector(initialFocusSelector)
              : null;
            trap.activate({
              focusElement: initialFocus instanceof HTMLElement ? initialFocus : null,
            });
          });
        };

        const close = ({ focusTrigger = true } = {}) => {
          if (!isOpen()) {
            return;
          }
          trap.deactivate();
          backdrop.setAttribute('aria-hidden', 'true');
          syncBodyScrollState();
          if (form instanceof HTMLFormElement) {
            form.reset();
          }
          if (typeof onClose === 'function') {
            onClose({ pageId: activePageIdForDialog });
          }
          const triggerElement = lastTriggerForDialog;
          activePageIdForDialog = null;
          lastTriggerForDialog = null;
          if (focusTrigger && triggerElement instanceof HTMLElement) {
            triggerElement.focus({ preventScroll: true });
          }
        };

        closeButtons.forEach((button) => {
          button.addEventListener('click', () => {
            close();
          });
        });

        cancelButtons.forEach((button) => {
          button.addEventListener('click', () => {
            close();
          });
        });

        backdrop.addEventListener('click', (event) => {
          if (event.target === backdrop) {
            close();
          }
        });

        if (form instanceof HTMLFormElement) {
          form.addEventListener('submit', (event) => {
            event.preventDefault();
            if (!activePageIdForDialog) {
              close();
              return;
            }
            if (typeof onSubmit === 'function') {
              const row = pageRowById.get(activePageIdForDialog) || null;
              onSubmit({ pageId: activePageIdForDialog, row, form });
            }
            close();
          });
        }

        return {
          name,
          open,
          close,
          isOpen,
          getPageId: () => activePageIdForDialog,
        };
      }

      // Dialog factory specialized for folder-level actions in the left navigation.
      // Only instantiated by the folder action buttons defined in this template.
      function createFolderActionDialog({
        name,
        backdrop,
        dialog,
        form = null,
        initialFocusSelector = '[data-folder-dialog-primary]',
        onOpen = null,
        onClose = null,
        onSubmit = null,
      }) {
        if (!(backdrop instanceof HTMLElement) || !(dialog instanceof HTMLElement)) {
          return null;
        }

        const trap = createFocusTrap(dialog);
        const nameTargets = Array.from(dialog.querySelectorAll('[data-folder-dialog-folder-name]'));
        const closeButtons = Array.from(backdrop.querySelectorAll('[data-folder-dialog-close]'));
        const cancelButtons = Array.from(backdrop.querySelectorAll('[data-folder-dialog-cancel]'));

        let activeFolderIdForDialog = null;
        let activeFolderNameForDialog = 'this folder';
        let lastTriggerForDialog = null;

        const isOpen = () => backdrop.getAttribute('aria-hidden') === 'false';

        const setFolderName = (value) => {
          nameTargets.forEach((target) => {
            target.textContent = value;
          });
        };

        const open = (folderId, { trigger = null } = {}) => {
          if (!folderId) {
            return;
          }
          const row = folderRowById.get(folderId) || null;
          activeFolderIdForDialog = folderId;
          activeFolderNameForDialog = getFolderNameFromRow(row);
          lastTriggerForDialog = trigger instanceof HTMLElement ? trigger : null;
          if (form instanceof HTMLFormElement) {
            form.reset();
          }
          setFolderName(activeFolderNameForDialog);
          if (typeof onOpen === 'function') {
            onOpen({
              folderId,
              folderName: activeFolderNameForDialog,
              row,
              dialog,
              backdrop,
              form,
            });
          }
          backdrop.setAttribute('aria-hidden', 'false');
          syncBodyScrollState();
          window.requestAnimationFrame(() => {
            const initialFocus = initialFocusSelector
              ? dialog.querySelector(initialFocusSelector)
              : null;
            trap.activate({
              focusElement: initialFocus instanceof HTMLElement ? initialFocus : null,
            });
          });
        };

        const close = ({ focusTrigger = true } = {}) => {
          if (!isOpen()) {
            return;
          }
          trap.deactivate();
          backdrop.setAttribute('aria-hidden', 'true');
          syncBodyScrollState();
          if (form instanceof HTMLFormElement) {
            form.reset();
          }
          if (typeof onClose === 'function') {
            onClose({
              folderId: activeFolderIdForDialog,
              folderName: activeFolderNameForDialog,
              dialog,
              backdrop,
            });
          }
          const triggerElement = lastTriggerForDialog;
          activeFolderIdForDialog = null;
          activeFolderNameForDialog = 'this folder';
          lastTriggerForDialog = null;
          if (focusTrigger && triggerElement instanceof HTMLElement) {
            triggerElement.focus({ preventScroll: true });
          }
        };

        closeButtons.forEach((button) => {
          button.addEventListener('click', () => {
            close();
          });
        });

        cancelButtons.forEach((button) => {
          button.addEventListener('click', () => {
            close();
          });
        });

        backdrop.addEventListener('click', (event) => {
          if (event.target === backdrop) {
            close();
          }
        });

        if (form instanceof HTMLFormElement) {
          form.addEventListener('submit', (event) => {
            event.preventDefault();
            if (!activeFolderIdForDialog) {
              close();
              return;
            }
            if (!form.reportValidity()) {
              return;
            }
            let shouldClose = true;
            if (typeof onSubmit === 'function') {
              const row = folderRowById.get(activeFolderIdForDialog) || null;
              const result = onSubmit({
                folderId: activeFolderIdForDialog,
                folderName: activeFolderNameForDialog,
                row,
                form,
              });
              if (result === false) {
                shouldClose = false;
              }
            }
            if (shouldClose) {
              close();
            }
          });
        }

        return {
          name,
          open,
          close,
          isOpen,
          getFolderId: () => activeFolderIdForDialog,
        };
      }

      // Determines whether a row matches the current free-text, author, type, status,
      // and date filters. Used internally when recalculating the table state.
      function matchesBaseFilters(item) {
        if (state.search && !item.searchText.includes(state.search)) {
          return false;
        }

        if (state.authors.size > 0 && !state.authors.has(item.author)) {
          return false;
        }

        if (state.types.size > 0 && !state.types.has(item.type)) {
          return false;
        }

        if (state.statuses.size > 0 && !state.statuses.has(item.status)) {
          return false;
        }

        if (state.dateStart || state.dateEnd) {
          const targetDate = item.modified || item.created;
          if (!targetDate) {
            return false;
          }
          if (state.dateStart && targetDate < state.dateStart) {
            return false;
          }
          if (state.dateEnd && targetDate > state.dateEnd) {
            return false;
          }
        }

        if (state.reportCards.size > 0) {
          if (item.reportIssues.size === 0) {
            return false;
          }
          for (const value of state.reportCards) {
            if (!item.reportIssues.has(value)) {
              return false;
            }
          }
        }

        return true;
      }

      // Shows or hides folder group rows based on the active filters so empty groups
      // collapse automatically. Only called during filter updates in this script.
      function updateGroupRowsVisibility() {
        folderRows.forEach((folderRow) => {
          const folderId = folderRow.dataset.folder || '_root';
          const members = folderMembers.get(folderId) || [];
          const hasVisible = members.some((row) => !row.classList.contains('is-filter-hidden'));
          folderRow.classList.toggle('is-filter-hidden', !hasVisible);
        });
      }

      // Recomputes the badge counts for each folder header. Used when filters or
      // selections change within this file.
      function updateFolderCounts() {
        folderRows.forEach((folderRow) => {
          const folderId = folderRow.dataset.folder || '_root';
          const members = folderMembers.get(folderId) || [];
          const visibleCount = members.filter((row) => !row.classList.contains('is-filter-hidden')).length;
          const totalAttr = Number(folderRow.dataset.folderTotal || members.length);
          const total = Number.isNaN(totalAttr) ? members.length : totalAttr;
          const label = folderRow.querySelector('[data-folder-count]');
          if (!label) {
            return;
          }
          const text =
            visibleCount !== total
              ? `${visibleCount} of ${total} pages`
              : `${total} page${total === 1 ? '' : 's'}`;
          label.textContent = text;
        });
      }

      // Updates tab badges and filter chip summaries based on visible rows. Called
      // whenever filters or search text change in this view.
      function updateCounts(baseMatches) {
        const counts = { all: 0, published: 0, unpublished: 0, draft: 0, scheduled: 0, trash: 0 };
        rowData.forEach((item) => {
          if (!baseMatches.get(item)) {
            return;
          }
          const key = counts[item.status] !== undefined ? item.status : null;
          if (key) {
            counts[key] += 1;
          }
          if (item.status !== 'trash') {
            counts.all += 1;
          }
        });

        countBadges.forEach((badge) => {
          const key = badge.dataset.statusCount;
          if (!key) {
            return;
          }
          badge.textContent = counts[key] ?? 0;
        });
      }

      // Renders the pills that summarize selected filters. Only used after filter
      // changes inside this template.
      function renderChips() {
        if (!filterChips) {
          return;
        }

        const chips = [];

        if (state.search) {
          chips.push({ type: 'search', value: state.searchRaw });
        }

        state.authors.forEach((value) => {
          chips.push({ type: 'author', value });
        });

        state.types.forEach((value) => {
          chips.push({ type: 'type', value });
        });

        state.statuses.forEach((value) => {
          chips.push({ type: 'status', value });
        });

        state.reportCards.forEach((value) => {
          chips.push({ type: 'report', value });
        });

        if (state.dateStart || state.dateEnd) {
          chips.push({ type: 'date', value: { start: state.dateStart, end: state.dateEnd } });
        }

        filterChips.innerHTML = '';

        if (chips.length === 0) {
          filterChips.hidden = true;
          updateActiveFilterSummary(0);
          return;
        }

        filterChips.hidden = false;

        chips.forEach((chip) => {
          const button = document.createElement('button');
          button.type = 'button';
          button.className = 'chip-button';
          button.dataset.chipType = chip.type;
          let visualLabel = '';
          let ariaLabelValue = '';

          switch (chip.type) {
            case 'search':
              visualLabel = `Search: ${chip.value}`;
              ariaLabelValue = visualLabel;
              button.dataset.chipValue = chip.value;
              break;
            case 'author':
              visualLabel = `Author: ${getAuthorInitials(chip.value) || chip.value}`;
              ariaLabelValue = `Author: ${chip.value}`;
              button.dataset.chipValue = chip.value;
              break;
            case 'type':
              visualLabel = `Type: ${chip.value}`;
              ariaLabelValue = visualLabel;
              button.dataset.chipValue = chip.value;
              break;
            case 'status':
              visualLabel = `Status: ${getStatusLabel(chip.value)}`;
              ariaLabelValue = visualLabel;
              button.dataset.chipValue = chip.value;
              break;
            case 'report':
              visualLabel = `Report: ${getReportLabel(chip.value)}`;
              ariaLabelValue = visualLabel;
              button.dataset.chipValue = chip.value;
              break;
            case 'date': {
              const startText = formatDateForDisplay(chip.value.start);
              const endText = formatDateForDisplay(chip.value.end);
              if (chip.value.start && chip.value.end) {
                visualLabel = `Modified: ${startText} – ${endText}`;
              } else if (chip.value.start) {
                visualLabel = `Modified: From ${startText}`;
              } else if (chip.value.end) {
                visualLabel = `Modified: Through ${endText}`;
              } else {
                visualLabel = 'Modified date';
              }
              ariaLabelValue = visualLabel;
              button.dataset.chipStart = chip.value.start || '';
              button.dataset.chipEnd = chip.value.end || '';
              break;
            }
            default:
              visualLabel = chip.value;
              ariaLabelValue = visualLabel;
              button.dataset.chipValue = chip.value;
          }

          button.setAttribute('aria-label', `Remove ${ariaLabelValue}`);

          const labelSpan = document.createElement('span');
          labelSpan.textContent = visualLabel;
          const icon = document.createElement('i');
          icon.className = 'fa-solid fa-xmark';
          icon.setAttribute('aria-hidden', 'true');

          button.append(labelSpan, icon);
          filterChips.appendChild(button);
        });

        updateActiveFilterSummary(chips.length);
      }

      // Returns the rows currently relevant (all rows or filtered rows depending on
      // flat view). Used by selection and sort helpers below.
      function getRowsInScope() {
        return pageRows.filter(
          (row) => !row.classList.contains('is-filter-hidden') && !row.classList.contains('is-collapsed')
        );
      }

      // Toggles selection for a specific page row and updates ARIA states. Called by
      // checkbox handlers defined in this file.
      function setPageSelection(row, shouldSelect) {
        const checkbox = row.querySelector('[data-row-checkbox]');
        const pageId = row.dataset.pageId;
        if (!checkbox || !pageId) {
          return;
        }
        checkbox.checked = shouldSelect;
        row.classList.toggle('is-selected', shouldSelect);
        store.update((draft) => {
          if (shouldSelect) {
            draft.selection.add(pageId);
          } else {
            draft.selection.delete(pageId);
          }
          return draft;
        });
      }

      // Syncs the master checkbox state (checked/indeterminate) with current row
      // selection. Only used by selection helpers here.
      function updateMasterCheckbox() {
        if (!masterCheckbox) {
          return;
        }
        const scopeRows = getRowsInScope();
        const total = scopeRows.length;
        const selectedInScope = scopeRows.filter((row) => state.selection.has(row.dataset.pageId)).length;
        masterCheckbox.disabled = total === 0;
        masterCheckbox.checked = total > 0 && selectedInScope === total;
        masterCheckbox.indeterminate = selectedInScope > 0 && selectedInScope < total;
        if (total === 0) {
          masterCheckbox.indeterminate = false;
          masterCheckbox.checked = false;
        }
      }

      // Updates folder-level checkboxes to match the selection status of their
      // member pages. Invoked during selection changes within this script.
      function updateFolderCheckboxes() {
        folderCheckboxes.forEach((checkbox) => {
          const folderId = checkbox.dataset.folderId || '_root';
          const members = folderMembers.get(folderId) || [];
          const scopedMembers = members.filter((row) => !row.classList.contains('is-filter-hidden'));
          const total = scopedMembers.length;
          const selectedCount = scopedMembers.filter((row) => state.selection.has(row.dataset.pageId)).length;
          checkbox.disabled = total === 0;
          checkbox.checked = total > 0 && selectedCount === total;
          checkbox.indeterminate = selectedCount > 0 && selectedCount < total;
          if (total === 0) {
            checkbox.indeterminate = false;
            checkbox.checked = false;
          }
        });
      }

      // Shows or hides the bulk actions bar based on selection count. Local to this
      // template; not referenced elsewhere.
      function updateBulkBar() {
        if (!bulkBar || !selectionCount) {
          return;
        }
        const count = state.selection.size;
        const label = count === 1 ? '1 selected' : `${count} selected`;
        selectionCount.textContent = label;
        const isActive = count > 0;
        bulkBar.classList.toggle('is-active', isActive);
        bulkBar.setAttribute('aria-hidden', isActive ? 'false' : 'true');
        bulkActionButtons.forEach((button) => {
          button.disabled = count === 0;
        });
        if (clearSelectionButton) {
          clearSelectionButton.disabled = count === 0;
        }
        syncBulkBarOffset();
      }

      // Keeps the bulk actions bar from overlapping the bottom toolbar by syncing a
      // CSS variable. Used by scroll/resize listeners in this view only.
      function syncBulkBarOffset() {
        if (!bulkBar) {
          return;
        }
        const offset = bulkBar.classList.contains('is-active')
          ? bulkBar.getBoundingClientRect().height + 16
          : 0;
        document.body.style.setProperty('--pages-bulk-bar-offset', `${offset}px`);
      }

      // Extracts comparable values for a given sort key from a table row. Only used
      // by sort helpers in this template.
      function getSortValue(row, key) {
        switch (key) {
          case 'status': {
            const order = { published: 0, scheduled: 1, draft: 2, unpublished: 3, trash: 4 };
            return order[row.dataset.status] ?? 99;
          }
          case 'type':
            return (row.dataset.type || '').toLowerCase();
          case 'author':
            return (row.dataset.author || '').toLowerCase();
          case 'reports':
            return Number(row.dataset.reportValue || 0);
          case 'created':
            return Date.parse(row.dataset.created || 0);
          case 'modified':
            return Date.parse(row.dataset.modified || 0);
          case 'title':
            return (row.dataset.title || '').toLowerCase();
          default:
            return 0;
        }
      }

      // Performs a stable comparison between two rows based on the active sort key.
      // Local helper for applySort; not used outside this script.
      function compareRows(a, b, key, direction) {
        const valueA = getSortValue(a, key);
        const valueB = getSortValue(b, key);
        let result;
        if (
          typeof valueA === 'number' &&
          typeof valueB === 'number' &&
          !Number.isNaN(valueA) &&
          !Number.isNaN(valueB)
        ) {
          result = valueA - valueB;
        } else {
          result = String(valueA).localeCompare(String(valueB), undefined, {
            numeric: true,
            sensitivity: 'base',
          });
        }
        return direction === 'asc' ? result : -result;
      }

      // Finds the table row immediately after a folder header. Used when toggling
      // folder expansion states below.
      function getNextGroupRow(folderRow) {
        let sibling = folderRow.nextElementSibling;
        while (sibling && !sibling.classList.contains('group-row')) {
          sibling = sibling.nextElementSibling;
        }
        return sibling;
      }

      // Applies the active sort to the currently scoped rows and updates the DOM
      // order. Only called by sort control handlers here.
      function applySort() {
        if (!state.sortKey) {
          return;
        }

        folderRows.forEach((folderRow) => {
          const folderId = folderRow.dataset.folder || '_root';
          const members = folderMembers.get(folderId) || [];
          if (members.length === 0) {
            return;
          }
          const sorted = members
            .slice()
            .sort((a, b) => compareRows(a, b, state.sortKey, state.sortDirection));
          const tbody = folderRow.parentElement;
          const marker = getNextGroupRow(folderRow);
          sorted.forEach((row) => {
            tbody.insertBefore(row, marker);
          });
          folderMembers.set(folderId, sorted);
        });

        const rootMembers = folderMembers.get('_root') || [];
        if (rootMembers.length === 0) {
          return;
        }

        const pinnedRows = rootMembers.filter((row) => row.dataset.pinned === 'true');
        const unpinnedRows = rootMembers.filter((row) => row.dataset.pinned !== 'true');
        const sortedUnpinned = unpinnedRows
          .slice()
          .sort((a, b) => compareRows(a, b, state.sortKey, state.sortDirection));
        const tbody = rootMembers[0]?.parentElement || folderRows[0]?.parentElement || null;
        if (!tbody) {
          folderMembers.set('_root', [...pinnedRows, ...sortedUnpinned]);
          return;
        }

        const firstFolderRow = folderRows[0] || null;
        const pinnedMarker =
          firstFolderRow || sortedUnpinned[0] || unpinnedRows[0] || tbody.firstChild;
        pinnedRows.forEach((row) => {
          tbody.insertBefore(row, pinnedMarker);
        });

        const afterLastFolderMarker = (() => {
          if (folderRows.length === 0) {
            return null;
          }
          const lastFolderRow = folderRows[folderRows.length - 1];
          const nextGroupRow = getNextGroupRow(lastFolderRow);
          return nextGroupRow || null;
        })();

        sortedUnpinned.forEach((row) => {
          tbody.insertBefore(row, afterLastFolderMarker);
        });

        folderMembers.set('_root', [...pinnedRows, ...sortedUnpinned]);
      }

      // Syncs the visual sort direction indicators with the active sort state.
      // Used locally whenever sorting changes.
      function updateSortIndicators() {
        sortButtons.forEach((button) => {
          const key = button.dataset.sortKey;
          const isActive = key === state.sortKey;
          button.classList.toggle('is-active', isActive);
          const indicator = button.querySelector('.sort-indicator');
          if (indicator) {
            indicator.textContent = isActive ? (state.sortDirection === 'asc' ? '▲' : '▼') : '▲';
          }
          const headerCell = button.closest('th');
          if (headerCell) {
            headerCell.setAttribute(
              'aria-sort',
              isActive ? (state.sortDirection === 'asc' ? 'ascending' : 'descending') : 'none'
            );
          }
        });
      }

      // Updates the flat view toggle button icon to reflect the current state.
      // Only used within this script when toggling hierarchy modes.
      function updateFlatViewToggleButton() {
        if (!flatViewToggleButton) {
          return;
        }

        const label = isFlatView ? 'Show pages in folders' : 'Show pages without folders';
        flatViewToggleButton.setAttribute('aria-label', label);
        flatViewToggleButton.setAttribute('title', label);
        flatViewToggleButton.setAttribute('aria-pressed', isFlatView ? 'true' : 'false');
        flatViewToggleButton.setAttribute('data-tooltip', label);
        if (flatViewToggleIcon) {
          flatViewToggleIcon.classList.remove('fa-list', 'fa-folder-tree');
          flatViewToggleIcon.classList.add(isFlatView ? 'fa-folder-tree' : 'fa-list');
        }
      }

      // Updates the folder visibility toggle icon to show whether groups are
      // expanded. Local helper invoked by folder view handlers.
      function updateFolderViewToggleButtonState() {
        if (!folderViewToggleButton) {
          return;
        }

        const setFolderToggleIcon = (isExpanded) => {
          if (!folderViewToggleIcon) {
            return;
          }
          folderViewToggleIcon.classList.remove('fa-folder', 'fa-folder-open');
          folderViewToggleIcon.classList.add(isExpanded ? 'fa-folder-open' : 'fa-folder');
        };

        if (isFlatView) {
          const label = 'Folder controls hidden in flat view';
          folderViewToggleButton.setAttribute('aria-label', label);
          folderViewToggleButton.setAttribute('title', label);
          folderViewToggleButton.setAttribute('aria-pressed', 'false');
          folderViewToggleButton.setAttribute('data-tooltip', label);
          folderViewToggleButton.disabled = true;
          setFolderToggleIcon(false);
          return;
        }

        const availableToggles = folderToggleButtons.filter((button) => button.dataset.folderToggle);
        if (availableToggles.length === 0) {
          folderViewToggleButton.setAttribute('aria-label', 'Expand all folders');
          folderViewToggleButton.setAttribute('title', 'Expand all folders');
          folderViewToggleButton.setAttribute('aria-pressed', 'false');
          folderViewToggleButton.setAttribute('data-tooltip', 'Expand all folders');
          folderViewToggleButton.disabled = true;
          setFolderToggleIcon(false);
          return;
        }

        folderViewToggleButton.disabled = false;

        const allExpanded = availableToggles.every(
          (button) => button.getAttribute('aria-expanded') === 'true'
        );
        const label = allExpanded ? 'Collapse all folders' : 'Expand all folders';
        folderViewToggleButton.setAttribute('aria-label', label);
        folderViewToggleButton.setAttribute('title', label);
        folderViewToggleButton.setAttribute('aria-pressed', allExpanded ? 'true' : 'false');
        folderViewToggleButton.setAttribute('data-tooltip', label);
        setFolderToggleIcon(allExpanded);
      }

      // Expands or collapses a folder group and optionally persists the state to
      // localStorage. Only called by folder toggle handlers here.
      function setFolderExpanded(folderId, expanded, persist = true) {
        const toggle = document.querySelector(`[data-folder-toggle="${folderId}"]`);
        const members = folderMembers.get(folderId) || [];
        if (toggle) {
          toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
          const icon = toggle.querySelector('[data-folder-icon]');
          if (icon) {
            icon.classList.remove('fa-folder-open', 'fa-folder');
            icon.classList.add(expanded ? 'fa-folder-open' : 'fa-folder');
          }
        }
        members.forEach((row) => {
          row.classList.toggle('is-collapsed', !expanded);
          if (expanded) {
            row.removeAttribute('aria-hidden');
          } else {
            row.setAttribute('aria-hidden', 'true');
          }
        });
        if (persist) {
          folderState[folderId] = expanded;
          try {
            localStorage.setItem(folderStateStorageKey, JSON.stringify(folderState));
          } catch (error) {
            console.warn('Unable to persist folder state', error);
          }
        }
        updateFolderViewToggleButtonState();
        updateMasterCheckbox();
        updateBulkBar();
      }

      // Reads saved folder expansion preferences and applies them to the DOM. Used
      // during initialization inside this template.
      function refreshFolderExpansionFromState() {
        if (isFlatView) {
          return;
        }
        folderToggleButtons.forEach((button) => {
          const folderId = button.dataset.folderToggle;
          if (!folderId) {
            return;
          }
          const stored = folderState[folderId];
          const expanded = stored !== undefined ? Boolean(stored) : true;
          setFolderExpanded(folderId, expanded, false);
        });
      }

      // Switches between hierarchical and flat list views, persisting the choice if
      // requested. Triggered solely by UI controls in this view.
      function applyFlatViewState({ persist = true } = {}) {
        document.body.classList.toggle('pages-flat-view', isFlatView);

        if (isFlatView) {
          pageRows.forEach((row) => {
            row.classList.remove('is-collapsed');
            row.removeAttribute('aria-hidden');
          });
        } else {
          refreshFolderExpansionFromState();
        }

        updateFlatViewToggleButton();
        updateFolderViewToggleButtonState();
        updateGroupRowsVisibility();
        updateMasterCheckbox();
        updateFolderCheckboxes();
        updateBulkBar();

        if (persist) {
          try {
            localStorage.setItem(flatViewStorageKey, isFlatView ? 'true' : 'false');
          } catch (error) {
            console.warn('Unable to persist flat view preference', error);
          }
        }
      }

      // Re-renders the visible rows based on filters, folder visibility, and view
      // mode. This is the main refresh routine used by this controller only.
      function updateRows() {
        const baseMatches = new Map();

        rowData.forEach((item) => {
          const matchesBase = matchesBaseFilters(item);
          baseMatches.set(item, matchesBase);
          const matchesStatus =
            state.status === 'all'
              ? item.status !== 'trash'
              : item.status === state.status;
          const shouldShow = matchesBase && matchesStatus;


          item.element.classList.toggle('is-filter-hidden', !shouldShow);
          if (!shouldShow && state.selection.has(item.pageId)) {
            setPageSelection(item.element, false);
          }
        });

        updateGroupRowsVisibility();
        updateFolderCounts();
        updateCounts(baseMatches);
        renderChips();
        updateFolderCheckboxes();
        updateMasterCheckbox();
        updateBulkBar();
        if (analyticsActiveRow) {
          const shouldCollapse =
            analyticsActiveRow.classList.contains('is-filter-hidden') ||
            analyticsActiveRow.classList.contains('is-collapsed');
          if (shouldCollapse) {
            closeAnalyticsDrawer({ immediate: true });
          }
        }
      }

      // Places focus in the main search box without scrolling. Used by keyboard
      // shortcuts defined in this script.
      function focusSearchInput() {
        if (!searchInput) {
          return;
        }
        searchInput.focus();
        searchInput.select();
      }

      const authorButtons = authorFilterList
        ? Array.from(authorFilterList.querySelectorAll('[data-author-value]'))
        : [];
      const statusButtons = statusFilterPills
        ? Array.from(statusFilterPills.querySelectorAll('[data-status-value]'))
        : [];
      const typeButtons = typeFilterList
        ? Array.from(typeFilterList.querySelectorAll('[data-type-value]'))
        : [];
      const reportCheckboxes = reportFilterList
        ? Array.from(reportFilterList.querySelectorAll('input[type=\"checkbox\"]'))
        : [];

      authorButtons.forEach((button) => {
        const author = button.dataset.authorValue || button.textContent.trim();
        const { color = DEFAULT_AUTHOR_COLOR, email } = AUTHOR_DETAILS[author] || {};
        const avatar = button.querySelector('.author-avatar');
        if (avatar && !avatar.dataset.color) {
          avatar.dataset.color = color;
        }
        const tooltip = email ? `${author} · ${email}` : author;
        button.title = tooltip;
        button.setAttribute('aria-label', `Toggle filter for ${author}`);
        button.addEventListener('click', () => {
          store.update((draft) => {
            if (draft.authors.has(author)) {
              draft.authors.delete(author);
            } else {
              draft.authors.add(author);
            }
            return draft;
          });
          updateRows();
          syncFilterControls();
        });
      });

      statusButtons.forEach((button) => {
        const value = button.dataset.statusValue || '';
        button.addEventListener('click', () => {
          if (!value) {
            return;
          }
          store.update((draft) => {
            if (draft.statuses.has(value)) {
              draft.statuses.delete(value);
            } else {
              draft.statuses.add(value);
            }
            return draft;
          });
          updateRows();
          syncFilterControls();
        });
      });

      typeButtons.forEach((button) => {
        const type = button.dataset.typeValue || '';
        if (!button.dataset.color && type) {
          button.dataset.color = TYPE_STYLES[type] || 'slate';
        }
        button.addEventListener('click', () => {
          if (!type) {
            return;
          }
          store.update((draft) => {
            if (draft.types.has(type)) {
              draft.types.delete(type);
            } else {
              draft.types.add(type);
            }
            return draft;
          });
          updateRows();
          syncFilterControls();
        });
      });

      reportCheckboxes.forEach((input) => {
        input.checked = state.reportCards.has(input.value);
        input.addEventListener('change', () => {
          const value = input.value;
          store.update((draft) => {
            if (input.checked) {
              draft.reportCards.add(value);
            } else {
              draft.reportCards.delete(value);
            }
            return draft;
          });
          updateRows();
          syncFilterControls();
        });
      });

      // Enables or disables the "New" button based on selection and search state.
      // Only referenced by event handlers in this file.
      function syncCreateButtonState() {
        if (!newPageSubmitButton) {
          return;
        }
        newPageSubmitButton.disabled = false;
      }

      // Pushes the current filter state into the drawer controls and chips. Used
      // exclusively by this script after state updates.
      function syncFilterControls() {
        authorButtons.forEach((button) => {
          const value = button.dataset.authorValue;
          const isActive = value ? state.authors.has(value) : false;
          button.dataset.active = isActive ? 'true' : 'false';
          button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });

        statusButtons.forEach((button) => {
          const value = button.dataset.statusValue;
          const isActive = value ? state.statuses.has(value) : false;
          button.dataset.active = isActive ? 'true' : 'false';
          button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
          button.classList.toggle('is-active', isActive);
        });

        typeButtons.forEach((button) => {
          const value = button.dataset.typeValue;
          const isActive = value ? state.types.has(value) : false;
          button.dataset.active = isActive ? 'true' : 'false';
          button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });

        reportCheckboxes.forEach((checkbox) => {
          checkbox.checked = state.reportCards.has(checkbox.value);
        });

        if (startDateInput) {
          startDateInput.value = state.dateStart;
        }
        if (endDateInput) {
          endDateInput.value = state.dateEnd;
        }
      }

      syncCreateButtonState();
      syncFilterControls();

      // Opens the filters drawer overlay. Only used within this page template.
      function openDrawer() {
        if (!filtersDrawer) {
          return;
        }
        filtersDrawer.setAttribute('aria-hidden', 'false');
        syncBodyScrollState();
        const firstInput = filtersDrawer.querySelector('input');
        if (firstInput) {
          firstInput.focus();
        }
      }

      // Closes the filters drawer and restores body scroll/focus. Local usage only.
      function closeDrawer() {
        if (!filtersDrawer) {
          return;
        }
        filtersDrawer.setAttribute('aria-hidden', 'true');
        syncBodyScrollState();
        filtersButton?.focus();
      }

      // Displays the quick-create dialog. Triggered by the New button in this view.
      function openDialog() {
        if (!dialog) {
          return;
        }
        dialog.setAttribute('aria-hidden', 'false');
        syncBodyScrollState();
        dialogCloseButton?.focus();
      }

      // Hides the quick-create dialog and optionally refocuses the trigger. Only
      // referenced within this template.
      function closeDialog({ focusTrigger = true } = {}) {
        if (!dialog) {
          return;
        }
        dialog.setAttribute('aria-hidden', 'true');
        syncBodyScrollState();
        if (focusTrigger) {
          newButton?.focus();
        }
      }

      // Applies a template choice in the new page wizard and optionally syncs the
      // page type. Used only by wizard controls here.
      function setNewPageTemplate(value, { syncType = true } = {}) {
        if (!newPageTemplateButtons.length) {
          if (newPageTemplateInput) {
            newPageTemplateInput.value = value || '';
          }
          if (syncType && value) {
            const associatedButton = newPageTemplateButtons.find(
              (button) => button.dataset.newPageTemplateOption === value
            );
            const associatedType = associatedButton?.dataset.templateType || '';
            if (associatedType) {
              setNewPageType(associatedType, { syncTemplate: false });
            }
          }
          return;
        }

        const availableTemplates = newPageTemplateButtons
          .map((button) => button.dataset.newPageTemplateOption || '')
          .filter(Boolean);
        const recommendedTemplate =
          (newPageTypeInput?.value && TEMPLATE_DEFAULTS_BY_TYPE[newPageTypeInput.value]) ||
          '';
        const fallbackTemplate =
          (value && availableTemplates.includes(value) && value) ||
          (recommendedTemplate && availableTemplates.includes(recommendedTemplate)
            ? recommendedTemplate
            : '') ||
          (defaultNewPageTemplateValue &&
          availableTemplates.includes(defaultNewPageTemplateValue)
            ? defaultNewPageTemplateValue
            : '') ||
          availableTemplates[0] ||
          '';

        if (newPageTemplateInput) {
          newPageTemplateInput.value = fallbackTemplate;
        }

        let nextActiveIndex = -1;
        newPageTemplateButtons.forEach((button, index) => {
          const buttonValue = button.dataset.newPageTemplateOption || '';
          const isActive = Boolean(fallbackTemplate) && buttonValue === fallbackTemplate;
          button.dataset.selected = isActive ? 'true' : 'false';
          button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
          button.tabIndex = isActive ? 0 : -1;
          if (isActive) {
            nextActiveIndex = index;
          }
        });

        activeNewPageTemplateIndex =
          nextActiveIndex >= 0 ? nextActiveIndex : Math.max(0, activeNewPageTemplateIndex);

        if (syncType) {
          const templateButton = newPageTemplateButtons[activeNewPageTemplateIndex] || null;
          const templateType = templateButton?.dataset.templateType || '';
          if (templateType) {
            setNewPageType(templateType, { syncTemplate: false });
          }
        }
      }

      // Updates the new page wizard with the selected page type and template
      // pairing. Invoked by button handlers inside this template.
      function setNewPageType(value, { syncTemplate = true } = {}) {
        if (!newPageTypeButtons.length) {
          if (newPageTypeInput) {
            newPageTypeInput.value = value || '';
          }
          if (syncTemplate) {
            const recommended = TEMPLATE_DEFAULTS_BY_TYPE[value] || defaultNewPageTemplateValue || '';
            if (recommended) {
              setNewPageTemplate(recommended, { syncType: false });
            }
          }
          return;
        }

        const availableTypes = newPageTypeButtons
          .map((button) => button.dataset.newPageTypeOption || '')
          .filter(Boolean);
        const fallbackType =
          (value && availableTypes.includes(value) && value) ||
          (defaultNewPageTypeValue && availableTypes.includes(defaultNewPageTypeValue)
            ? defaultNewPageTypeValue
            : '') ||
          availableTypes[0] ||
          '';

        if (newPageTypeInput) {
          newPageTypeInput.value = fallbackType;
        }

        newPageTypeButtons.forEach((button) => {
          const buttonValue = button.dataset.newPageTypeOption || '';
          const isSelected = Boolean(fallbackType) && buttonValue === fallbackType;
          button.classList.toggle('selected', isSelected);
          button.setAttribute('aria-pressed', isSelected ? 'true' : 'false');
        });

        if (syncTemplate) {
          const templateButton = newPageTemplateButtons.find(
            (button) => button.dataset.templateType === fallbackType
          );
          const templateValue =
            templateButton?.dataset.newPageTemplateOption ||
            TEMPLATE_DEFAULTS_BY_TYPE[fallbackType] ||
            '';
          if (templateValue) {
            setNewPageTemplate(templateValue, { syncType: false });
          }
        }
      }

      // Resets the multi-step new page dialog to its defaults. Only referenced by
      // open/close handlers in this script.
      function resetNewPageDialog() {
        if (newPageForm) {
          newPageSteps.forEach((section) => {
            getNewPageStepControls(section).forEach((control) => {
              control.removeAttribute('disabled');
            });
            section.removeAttribute('hidden');
            section.removeAttribute('aria-hidden');
          });
          newPageForm.reset();
        }
        const initialTypeValue =
          newPageTypeInput?.value || defaultNewPageTypeValue || '';
        setNewPageType(initialTypeValue, { syncTemplate: true });
        syncCreateButtonState();
        newPageSlugInput?.setCustomValidity('');
        newPageMetaTitleInput?.setCustomValidity('');
        newPageMetaDescriptionInput?.setCustomValidity('');
        newPageCurrentStepIndex = 0;
        if (newPageSteps.length > 0) {
          syncNewPageStepState();
        }
      }

      // Opens the multi-step new page dialog from the quick-create menu. Not
      // called outside this view.
      function openNewPageDialog() {
        if (!newPageDialog) {
          return;
        }
        resetNewPageDialog();
        newPageDialog.setAttribute('aria-hidden', 'false');
        syncBodyScrollState();
        window.requestAnimationFrame(() => {
          newPageTitleInput?.focus();
        });
      }

      // Closes the new page dialog and optionally refocuses the trigger. Local to
      // this desktop.php script.
      function closeNewPageDialog({ focusTrigger = true } = {}) {
        if (!newPageDialog) {
          return;
        }
        newPageDialog.setAttribute('aria-hidden', 'true');
        syncBodyScrollState();
        if (focusTrigger) {
          newButton?.focus();
        }
      }

      // Opens the copy page dialog for a specific row. Triggered only by copy
      // buttons in this template.
      function openCopyPageDialog(pageId, trigger) {
        if (!copyPageDialog) {
          return;
        }
        const row = pageRowById.get(pageId);
        if (!row) {
          return;
        }
        activeCopyPageId = pageId;
        lastCopyPageTrigger = trigger instanceof HTMLElement ? trigger : null;
        const title =
          row.dataset.title ||
          row.querySelector('.title-button')?.textContent?.trim() ||
          row.querySelector('.title-text')?.textContent?.trim() ||
          'this page';
        if (copyPageSourceName) {
          copyPageSourceName.textContent = title;
        }
        if (copyPageNameInput) {
          const suggestedName = title ? `${title} copy` : '';
          copyPageNameInput.value = suggestedName.trim();
          if (copyPageNameInput.value) {
            copyPageNameInput.setSelectionRange(0, copyPageNameInput.value.length);
          }
        }
        copyPageDialog.setAttribute('aria-hidden', 'false');
        syncBodyScrollState();
        window.requestAnimationFrame(() => {
          if (copyPageNameInput) {
            copyPageNameInput.focus({ preventScroll: true });
            copyPageNameInput.select();
          }
        });
      }

      // Closes the copy page dialog and optionally returns focus to the trigger.
      // Only used inside this view.
      function closeCopyPageDialog({ focusTrigger = true } = {}) {
        if (!copyPageDialog) {
          return;
        }
        copyPageDialog.setAttribute('aria-hidden', 'true');
        syncBodyScrollState();
        copyPageForm?.reset();
        if (copyPageSourceName) {
          copyPageSourceName.textContent = 'this page';
        }
        if (copyPageNameInput) {
          copyPageNameInput.value = '';
          copyPageNameInput.setCustomValidity('');
        }
        const trigger = lastCopyPageTrigger;
        activeCopyPageId = null;
        lastCopyPageTrigger = null;
        if (focusTrigger && trigger instanceof HTMLElement) {
          trigger.focus({ preventScroll: true });
        }
      }

      // Clears the folder create/edit dialog so it starts fresh. Used by the
      // folder dialog open/close helpers below.
      function resetFolderDialog() {
        if (folderSettingsForm) {
          folderSettingsForm.reset();
        }
        if (folderNameInput) {
          folderNameInput.value = '';
          folderNameInput.setCustomValidity('');
        }
        folderColorRadios.forEach((radio) => {
          radio.checked = false;
        });
        if (folderDialogTitle) {
          folderDialogTitle.textContent = 'Folder settings';
        }
        if (folderDialogSubmitButton) {
          folderDialogSubmitButton.textContent = 'Save changes';
        }
        folderSettingsDialog?.setAttribute('data-mode', 'edit');
      }

      // Opens the folder dialog in create or edit mode depending on the provided
      // folder ID. Only invoked by folder buttons within this template.
      function openFolderDialog(folderId = null, { trigger = null } = {}) {
        if (!folderSettingsDialog) {
          return;
        }
        resetFolderDialog();
        lastFolderDialogTrigger = trigger instanceof HTMLElement ? trigger : null;
        const folderRow = folderId ? folderRowById.get(folderId) : null;
        const isEditMode = Boolean(folderRow);
        folderDialogMode = isEditMode ? 'edit' : 'create';
        folderSettingsDialog.setAttribute('data-mode', folderDialogMode);
        if (folderDialogMode === 'edit' && folderRow) {
          activeFolderId = folderId;
          const currentName =
            folderRow.dataset.folderName ||
            folderRow.querySelector('.folder-name')?.textContent?.trim() ||
            '';
          if (folderNameInput) {
            folderNameInput.value = currentName;
          }
          const currentColor = folderRow.dataset.folderColor || DEFAULT_FOLDER_COLOR;
          folderColorRadios.forEach((radio) => {
            radio.checked = radio.value === currentColor;
          });
          if (folderDialogTitle) {
            folderDialogTitle.textContent = 'Folder settings';
          }
          if (folderDialogSubmitButton) {
            folderDialogSubmitButton.textContent = 'Save changes';
          }
        } else {
          activeFolderId = null;
          if (folderDialogTitle) {
            folderDialogTitle.textContent = 'Create folder';
          }
          if (folderDialogSubmitButton) {
            folderDialogSubmitButton.textContent = 'Create folder';
          }
          const hasPreselectedColor = Array.from(folderColorRadios).some(
            (radio) => radio.checked
          );
          if (!hasPreselectedColor) {
            const defaultRadio = Array.from(folderColorRadios).find(
              (radio) => radio.value === DEFAULT_FOLDER_COLOR
            );
            if (defaultRadio) {
              defaultRadio.checked = true;
            } else if (folderColorRadios[0]) {
              folderColorRadios[0].checked = true;
            }
          }
        }
        folderSettingsDialog.setAttribute('aria-hidden', 'false');
        syncBodyScrollState();
        window.requestAnimationFrame(() => {
          if (folderNameInput) {
            folderNameInput.focus({ preventScroll: true });
            folderNameInput.select();
          }
        });
      }

      // Closes the folder dialog and returns focus when appropriate. Used solely
      // by this controller.
      function closeFolderDialog({ focusTrigger = true } = {}) {
        if (!folderSettingsDialog) {
          return;
        }
        folderSettingsDialog.setAttribute('aria-hidden', 'true');
        syncBodyScrollState();
        activeFolderId = null;
        folderDialogMode = 'edit';
        const trigger = lastFolderDialogTrigger;
        lastFolderDialogTrigger = null;
        resetFolderDialog();
        if (focusTrigger && trigger instanceof HTMLElement) {
          trigger.focus({ preventScroll: true });
        }
      }

      // Clears all selected rows and updates related UI affordances. Only used by
      // handlers in this template.
      function clearSelection() {
        Array.from(state.selection).forEach((pageId) => {
          const row = pageRowById.get(pageId);
          if (row) {
            setPageSelection(row, false);
          }
        });
        updateMasterCheckbox();
        updateFolderCheckboxes();
        updateBulkBar();
      }

      if (searchInput) {
        searchInput.addEventListener('input', (event) => {
          const rawValue = event.target.value.trim();
          store.update((draft) => {
            if (rawValue.length >= 3) {
              draft.search = rawValue.toLowerCase();
              draft.searchRaw = rawValue;
            } else {
              draft.search = '';
              draft.searchRaw = '';
            }
            return draft;
          });
          updateRows();
        });

        searchInput.addEventListener('focus', () => {
          document.body.classList.add('search-mode');
        });

        searchInput.addEventListener('blur', () => {
          window.requestAnimationFrame(() => {
            if (document.activeElement !== searchInput) {
              document.body.classList.remove('search-mode');
            }
          });
        });
      }

      if (searchOverlay) {
        searchOverlay.addEventListener('click', () => {
          searchInput?.blur();
        });
      }

      document.addEventListener('keydown', (event) => {
        const target = event.target;
        const triggerElement =
          target instanceof HTMLElement
            ? target.closest('[data-action-menu-trigger]')
            : null;
        if (triggerElement) {
          const menu = triggerElement.closest('[data-action-menu]');
          if (menu) {
            if (event.key === 'Escape') {
              event.preventDefault();
              closeActionMenu(menu);
              return;
            }
            if (event.key === 'Enter' || event.key === ' ') {
              event.preventDefault();
              const isOpen = menu.dataset.open === 'true';
              if (isOpen) {
                closeActionMenu(menu);
              } else {
                openActionMenu(menu);
              }
              return;
            }
            if (event.key === 'ArrowDown') {
              event.preventDefault();
              openActionMenu(menu);
              menu
                .querySelector('[data-action-menu-dropdown] [data-menu-action]')
                ?.focus({ preventScroll: true });
              return;
            }
          }
        }
        const dropdownElement =
          target instanceof HTMLElement
            ? target.closest('[data-action-menu-dropdown]')
            : null;
        if (dropdownElement && event.key === 'Escape') {
          event.preventDefault();
          const menu = dropdownElement.closest('[data-action-menu]');
          if (menu) {
            closeActionMenu(menu, { focusTrigger: true });
            return;
          }
        }
        const isTypingTarget =
          target instanceof HTMLElement &&
          (target.tagName === 'INPUT' ||
            target.tagName === 'TEXTAREA' ||
            target.isContentEditable);

        if ((event.metaKey || event.ctrlKey) && event.key === '/') {
          event.preventDefault();
          focusSearchInput();
          return;
        }

        if (
          event.key === '/' &&
          !event.metaKey &&
          !event.ctrlKey &&
          !event.altKey &&
          !event.shiftKey &&
          !isTypingTarget
        ) {
          event.preventDefault();
          focusSearchInput();
          return;
        }
        if (event.key === 'Escape') {
          for (const controller of actionDialogControllers) {
            if (controller?.isOpen && controller.isOpen()) {
              event.preventDefault();
              controller.close();
              return;
            }
          }
          if (filtersDrawer?.getAttribute('aria-hidden') === 'false') {
            event.preventDefault();
            closeDrawer();
            return;
          }
          if (newPageDialog?.getAttribute('aria-hidden') === 'false') {
            event.preventDefault();
            closeNewPageDialog();
            return;
          }
          if (copyPageDialog?.getAttribute('aria-hidden') === 'false') {
            event.preventDefault();
            closeCopyPageDialog();
            return;
          }
          if (dialog?.getAttribute('aria-hidden') === 'false') {
            event.preventDefault();
            closeDialog();
            return;
          }
          if (folderSettingsDialog?.getAttribute('aria-hidden') === 'false') {
            event.preventDefault();
            closeFolderDialog();
          }
          if (pageSettingsDialog?.getAttribute('aria-hidden') === 'false') {
            event.preventDefault();
            closePageSettingsDialog();
          }
          closeAllActionMenus();
        }
      });

      if (filterChips) {
        filterChips.addEventListener('click', (event) => {
          const target = event.target.closest('.chip-button');
          if (!target) {
            return;
          }
          const chipType = target.dataset.chipType;
          if (!chipType) {
            return;
          }
          const chipValue = target.dataset.chipValue || '';

          if (chipType === 'search') {
            if (searchInput) {
              searchInput.value = '';
            }
            store.update((draft) => {
              draft.search = '';
              draft.searchRaw = '';
              return draft;
            });
          } else if (chipType === 'author') {
            store.update((draft) => {
              draft.authors.delete(chipValue);
              return draft;
            });
          } else if (chipType === 'type') {
            store.update((draft) => {
              draft.types.delete(chipValue);
              return draft;
            });
          } else if (chipType === 'status') {
            store.update((draft) => {
              draft.statuses.delete(chipValue);
              return draft;
            });
          } else if (chipType === 'report') {
            store.update((draft) => {
              draft.reportCards.delete(chipValue);
              return draft;
            });
          } else if (chipType === 'date') {
            if (startDateInput) {
              startDateInput.value = '';
            }
            if (endDateInput) {
              endDateInput.value = '';
            }
            store.update((draft) => {
              draft.dateStart = '';
              draft.dateEnd = '';
              return draft;
            });
          }

          syncFilterControls();
          updateRows();
        });
      }

      if (tabsContainer) {
        tabsContainer.addEventListener('click', (event) => {
          const button = event.target.closest('[data-status-tab]');
          if (!button || !tabsContainer.contains(button)) {
            return;
          }
          const status = button.dataset.statusTab;
          if (!status || status === state.status) {
            return;
          }

          store.update((draft) => {
            draft.status = status;
            return draft;
          });

          tabButtons.forEach((tab) => {
            const isActive = tab === button;
            tab.classList.toggle('active', isActive);
            tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
          });

          updateRows();
        });
      }

      if (filtersButton) {
        filtersButton.addEventListener('click', () => {
          if (filtersDrawer?.getAttribute('aria-hidden') === 'false') {
            closeDrawer();
          } else {
            openDrawer();
          }
        });
      }

      drawerCloseButton?.addEventListener('click', closeDrawer);

      filtersDrawer?.addEventListener('click', (event) => {
        if (event.target === filtersDrawer) {
          closeDrawer();
        }
      });

      if (clearFiltersButton) {
        clearFiltersButton.addEventListener('click', () => {
          if (searchInput) {
            searchInput.value = '';
          }
          store.update((draft) => {
            draft.search = '';
            draft.searchRaw = '';
            draft.authors.clear();
            draft.types.clear();
            draft.statuses.clear();
            draft.reportCards.clear();
            draft.dateStart = '';
            draft.dateEnd = '';
            return draft;
          });
          syncFilterControls();
          updateRows();
        });
      }

      startDateInput?.addEventListener('change', () => {
        store.update((draft) => {
          draft.dateStart = startDateInput.value;
          return draft;
        });
        updateRows();
        syncFilterControls();
      });

      endDateInput?.addEventListener('change', () => {
        store.update((draft) => {
          draft.dateEnd = endDateInput.value;
          return draft;
        });
        updateRows();
        syncFilterControls();
      });

      applyFiltersButton?.addEventListener('click', () => {
        closeDrawer();
      });

      newButton?.addEventListener('click', openDialog);
      dialogCloseButton?.addEventListener('click', closeDialog);

      dialog?.addEventListener('click', (event) => {
        if (event.target === dialog) {
          closeDialog();
        }
      });

      optionButtons.forEach((button) => {
        button.addEventListener('click', () => {
          const action = button.dataset.action;
          if (action === 'page') {
            closeDialog({ focusTrigger: false });
            window.requestAnimationFrame(() => {
              openNewPageDialog();
            });
            return;
          }
          if (action === 'folder') {
            closeDialog({ focusTrigger: false });
            window.requestAnimationFrame(() => {
              openFolderDialog(null, { trigger: newButton });
            });
            return;
          }
          closeDialog();
          if (action) {
            console.log(`Create new ${action}`);
          }
        });
      });

      newPageDialogCloseButton?.addEventListener('click', () => {
        closeNewPageDialog();
      });

      newPageDialog?.addEventListener('click', (event) => {
        if (event.target === newPageDialog) {
          closeNewPageDialog();
        }
      });

      copyPageDialogClose?.addEventListener('click', () => {
        closeCopyPageDialog();
      });

      copyPageCancelButton?.addEventListener('click', () => {
        closeCopyPageDialog();
      });

      copyPageDialog?.addEventListener('click', (event) => {
        if (event.target === copyPageDialog) {
          closeCopyPageDialog();
        }
      });

      copyPageForm?.addEventListener('submit', (event) => {
        event.preventDefault();
        if (!copyPageForm.reportValidity()) {
          return;
        }
        if (!activeCopyPageId) {
          closeCopyPageDialog();
          return;
        }
        const formData = new FormData(copyPageForm);
        const newTitle = (formData.get('copyPageName') || '').toString().trim();
        console.log('Duplicate page', { sourcePageId: activeCopyPageId, title: newTitle });
        closeCopyPageDialog();
      });

      // Helper to gather the tabs and panels for a wizard step section. Used when
      // wiring the new page multi-step navigation within this file.
      function getNewPageStepControls(section) {
        if (!section) {
          return [];
        }
        return Array.from(section.querySelectorAll('input, select, textarea'));
      }

      // Syncs the wizard pagination, tab indices, and buttons with the current
      // step index. Only used by the new page dialog code here.
      function syncNewPageStepState() {
        if (newPageSteps.length === 0) {
          return;
        }
        newPageSteps.forEach((section, index) => {
          const isActive = index === newPageCurrentStepIndex;
          section.toggleAttribute('hidden', !isActive);
          section.setAttribute('aria-hidden', isActive ? 'false' : 'true');
          section.setAttribute('tabindex', isActive ? '0' : '-1');
          getNewPageStepControls(section).forEach((control) => {
            if (control instanceof HTMLInputElement && control.type === 'hidden') {
              return;
            }
            if (isActive) {
              control.removeAttribute('disabled');
            } else {
              control.setAttribute('disabled', 'true');
            }
          });
        });
        if (newPageStepTabs.length > 0) {
          newPageStepTabs.forEach((tab, index) => {
            const isActive = index === newPageCurrentStepIndex;
            const isComplete = index < newPageCurrentStepIndex;
            tab.classList.toggle('is-active', isActive);
            tab.classList.toggle('is-complete', isComplete);
            tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
            tab.setAttribute('tabindex', isActive ? '0' : '-1');
          });
        }
        if (newPageNextButton) {
          newPageNextButton.toggleAttribute(
            'hidden',
            newPageCurrentStepIndex >= newPageSteps.length - 1
          );
        }
        if (newPageSubmitButton) {
          newPageSubmitButton.toggleAttribute(
            'hidden',
            newPageCurrentStepIndex < newPageSteps.length - 1
          );
        }
        syncCreateButtonState();
      }

      // Moves keyboard focus into the active panel for a wizard step. Used by
      // navigation helpers inside this template.
      function focusNewPageStep(section) {
        if (!section) {
          return;
        }
        const focusTarget = section.querySelector(
          'input:not([type="hidden"]):not([disabled]), select:not([disabled]), textarea:not([disabled])'
        );
        if (focusTarget instanceof HTMLElement) {
          focusTarget.focus();
          return;
        }
        if (section instanceof HTMLElement) {
          section.focus();
        }
      }

      // Sets the current wizard step by index and optionally focuses the panel.
      // Only referenced inside this desktop view.
      function setNewPageStep(index, { focusStep = true } = {}) {
        if (newPageSteps.length === 0) {
          return;
        }
        const clampedIndex = Math.max(0, Math.min(index, newPageSteps.length - 1));
        newPageCurrentStepIndex = clampedIndex;
        syncNewPageStepState();
        if (focusStep) {
          window.requestAnimationFrame(() => {
            focusNewPageStep(newPageSteps[newPageCurrentStepIndex]);
          });
        }
      }

      // Handles tab button interactions for the wizard, supporting keyboard and
      // mouse users. Used only inside this script.
      function handleNewPageStepTabChange(targetIndex, { fromKeyboard = false } = {}) {
        if (newPageSteps.length === 0) {
          return;
        }
        if (targetIndex < 0 || targetIndex >= newPageSteps.length) {
          return;
        }
        if (targetIndex > newPageCurrentStepIndex + 1) {
          return;
        }
        if (targetIndex === newPageCurrentStepIndex + 1 && !validateNewPageStep()) {
          return;
        }
        setNewPageStep(targetIndex, { focusStep: !fromKeyboard });
        if (fromKeyboard) {
          const targetTab = newPageStepTabs[targetIndex];
          if (targetTab) {
            targetTab.focus();
          }
        }
      }

      // Validates fields for a wizard step and reports invalid controls. Invoked
      // by navigation handlers within this template.
      function validateNewPageStep(stepIndex = newPageCurrentStepIndex) {
        const section = newPageSteps[stepIndex];
        if (!section) {
          return true;
        }
        if (section.dataset.step === 'seo') {
          if (newPageSlugInput) {
            const slugValue = newPageSlugInput.value.trim();
            if (!slugValue) {
              newPageSlugInput.setCustomValidity('Please enter a slug.');
            } else if (!/^[a-z0-9-]+$/.test(slugValue)) {
              newPageSlugInput.setCustomValidity(
                'Slug can only contain lowercase letters, numbers, and hyphens.'
              );
            } else {
              newPageSlugInput.value = slugValue;
              newPageSlugInput.setCustomValidity('');
            }
          }
          if (newPageMetaTitleInput) {
            const metaTitleValue = newPageMetaTitleInput.value.trim();
            if (!metaTitleValue) {
              newPageMetaTitleInput.setCustomValidity('Please enter a meta title.');
            } else {
              newPageMetaTitleInput.value = metaTitleValue;
              newPageMetaTitleInput.setCustomValidity('');
            }
          }
          if (newPageMetaDescriptionInput) {
            const descriptionValue = newPageMetaDescriptionInput.value.trim();
            if (!descriptionValue) {
              newPageMetaDescriptionInput.setCustomValidity('Please enter a meta description.');
            } else if (descriptionValue.length > 160) {
              newPageMetaDescriptionInput.setCustomValidity(
                'Meta description must be 160 characters or fewer.'
              );
            } else {
              newPageMetaDescriptionInput.value = descriptionValue;
              newPageMetaDescriptionInput.setCustomValidity('');
            }
          }
        }
        let isValid = true;
        getNewPageStepControls(section)
          .filter((control) => !control.disabled)
          .forEach((control) => {
            if (!control.checkValidity()) {
              if (isValid) {
                control.reportValidity();
              }
              isValid = false;
            }
          });
        syncCreateButtonState();
        return isValid;
      }

      if (newPageSteps.length > 0) {
        syncNewPageStepState();
      }

      newPageStepTabs.forEach((tab, index) => {
        tab.addEventListener('click', () => {
          handleNewPageStepTabChange(index);
        });
        tab.addEventListener('keydown', (event) => {
          const keys = ['ArrowRight', 'ArrowLeft', 'Home', 'End'];
          if (!keys.includes(event.key)) {
            return;
          }
          event.preventDefault();
          let targetIndex = index;
          if (event.key === 'ArrowRight') {
            targetIndex = (index + 1) % newPageStepTabs.length;
          } else if (event.key === 'ArrowLeft') {
            targetIndex = (index - 1 + newPageStepTabs.length) % newPageStepTabs.length;
          } else if (event.key === 'Home') {
            targetIndex = 0;
          } else if (event.key === 'End') {
            targetIndex = newPageStepTabs.length - 1;
          }
          handleNewPageStepTabChange(targetIndex, { fromKeyboard: true });
        });
      });

      newPageNextButton?.addEventListener('click', () => {
        if (!validateNewPageStep()) {
          return;
        }
        setNewPageStep(newPageCurrentStepIndex + 1);
      });

      newPageCancelButton?.addEventListener('click', () => {
        closeNewPageDialog();
      });

      newPageTypeButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
          setNewPageType(button.dataset.newPageTypeOption || '', { syncTemplate: true });
        });
        button.addEventListener('keydown', (event) => {
          const keys = ['ArrowRight', 'ArrowLeft', 'ArrowDown', 'ArrowUp', 'Home', 'End'];
          if (!keys.includes(event.key)) {
            return;
          }
          event.preventDefault();
          let targetIndex = index;
          const total = newPageTypeButtons.length;
          if (event.key === 'ArrowRight' || event.key === 'ArrowDown') {
            targetIndex = (index + 1) % total;
          } else if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') {
            targetIndex = (index - 1 + total) % total;
          } else if (event.key === 'Home') {
            targetIndex = 0;
          } else if (event.key === 'End') {
            targetIndex = total - 1;
          }
          const targetButton = newPageTypeButtons[targetIndex];
          if (targetButton) {
            setNewPageType(targetButton.dataset.newPageTypeOption || '', { syncTemplate: true });
            targetButton.focus({ preventScroll: true });
          }
        });
      });

      newPageTemplateButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
          setNewPageTemplate(button.dataset.newPageTemplateOption || '', { syncType: true });
        });
        button.addEventListener('keydown', (event) => {
          const keys = ['ArrowRight', 'ArrowLeft', 'Home', 'End'];
          if (!keys.includes(event.key)) {
            return;
          }
          event.preventDefault();
          let targetIndex = index;
          if (event.key === 'ArrowRight') {
            targetIndex = (index + 1) % newPageTemplateButtons.length;
          } else if (event.key === 'ArrowLeft') {
            targetIndex =
              (index - 1 + newPageTemplateButtons.length) % newPageTemplateButtons.length;
          } else if (event.key === 'Home') {
            targetIndex = 0;
          } else if (event.key === 'End') {
            targetIndex = newPageTemplateButtons.length - 1;
          }
          const targetButton = newPageTemplateButtons[targetIndex];
          if (targetButton) {
            setNewPageTemplate(targetButton.dataset.newPageTemplateOption || '', {
              syncType: true,
            });
            targetButton.focus({ preventScroll: true });
          }
        });
      });

      if (newPageTypeButtons.length || newPageTypeInput) {
        const initialType = newPageTypeInput?.value || defaultNewPageTypeValue || '';
        setNewPageType(initialType, { syncTemplate: true });
      } else if (newPageTemplateButtons.length) {
        const initialTemplate =
          newPageTemplateInput?.value || defaultNewPageTemplateValue || '';
        setNewPageTemplate(initialTemplate, { syncType: true });
      }

      newPageSlugInput?.addEventListener('input', () => {
        newPageSlugInput.setCustomValidity('');
      });

      newPageMetaTitleInput?.addEventListener('input', () => {
        newPageMetaTitleInput.setCustomValidity('');
      });

      newPageMetaDescriptionInput?.addEventListener('input', () => {
        newPageMetaDescriptionInput.setCustomValidity('');
      });

      newPageForm?.addEventListener('submit', (event) => {
        event.preventDefault();
        if (!validateNewPageStep()) {
          return;
        }
        const restoredControls = [];
        newPageSteps.forEach((section) => {
          getNewPageStepControls(section).forEach((control) => {
            if (
              control.disabled &&
              !(control instanceof HTMLInputElement && control.type === 'hidden')
            ) {
              restoredControls.push(control);
              control.removeAttribute('disabled');
            }
          });
        });
        if (!newPageForm.checkValidity()) {
          newPageForm.reportValidity();
          restoredControls.forEach((control) => {
            control.setAttribute('disabled', 'true');
          });
          return;
        }
        const formData = new FormData(newPageForm);
        restoredControls.forEach((control) => {
          control.setAttribute('disabled', 'true');
        });
        const socialImage = formData.get('socialImage');
        const normalizedSocialImage =
          socialImage instanceof File && socialImage.name ? socialImage : null;
        const statusValue = (formData.get('status') || '').toString().trim() || 'draft';
        const scheduleDate = (formData.get('scheduleDate') || '').toString().trim();
        const scheduleTime = (formData.get('scheduleTime') || '').toString().trim();
        const scheduleAt =
          statusValue === 'scheduled' && scheduleDate && scheduleTime
            ? `${scheduleDate}T${scheduleTime}`
            : null;
        const payload = {
          title: (formData.get('title') || '').toString().trim(),
          folder: (formData.get('folder') || '').toString().trim(),
          type: (formData.get('type') || '').toString().trim(),
          status: statusValue,
          scheduleAt,
          metadata: {
            slug: (formData.get('slug') || '').toString().trim(),
            metaTitle: (formData.get('metaTitle') || '').toString().trim(),
            metaDescription: (formData.get('metaDescription') || '').toString().trim(),
            socialImage: normalizedSocialImage,
          },
        };
        console.log('Create new page', payload);
        closeNewPageDialog();
      });

      folderDialogClose?.addEventListener('click', () => {
        closeFolderDialog();
      });
      folderDialogCancel?.addEventListener('click', () => {
        closeFolderDialog();
      });
      folderSettingsDialog?.addEventListener('click', (event) => {
        if (event.target === folderSettingsDialog) {
          closeFolderDialog();
        }
      });

      folderNameInput?.addEventListener('input', () => {
        folderNameInput.setCustomValidity('');
      });

      folderSettingsForm?.addEventListener('submit', (event) => {
        event.preventDefault();
        if (!folderSettingsForm?.reportValidity()) {
          return;
        }
        const trimmedName = folderNameInput?.value.trim() || '';
        if (!trimmedName) {
          if (folderNameInput) {
            folderNameInput.value = '';
            folderNameInput.setCustomValidity('Please enter a folder name.');
            folderNameInput.reportValidity();
          }
          return;
        }
        if (folderNameInput) {
          folderNameInput.value = trimmedName;
          folderNameInput.setCustomValidity('');
        }
        const selectedColor =
          Array.from(folderColorRadios).find((radio) => radio.checked)?.value || DEFAULT_FOLDER_COLOR;
        if (folderDialogMode === 'create' || !activeFolderId) {
          console.log('Create folder', {
            name: trimmedName,
            color: selectedColor,
          });
          closeFolderDialog();
          return;
        }
        const folderRow = folderRowById.get(activeFolderId);
        if (!folderRow) {
          closeFolderDialog();
          return;
        }
        const nameElement = folderRow.querySelector('.folder-name');
        if (nameElement) {
          nameElement.textContent = trimmedName;
        }
        folderRow.dataset.folderName = trimmedName;
        const folderCheckbox = folderRow.querySelector('[data-folder-checkbox]');
        folderCheckbox?.setAttribute('aria-label', `Select folder ${trimmedName}`);
        const actionsGroup = folderRow.querySelector('.folder-actions');
        actionsGroup?.setAttribute('aria-label', `${trimmedName} folder actions`);
        const folderOption = folderOptions.find((option) => option.value === activeFolderId);
        if (folderOption) {
          folderOption.label = trimmedName;
          populatePageSettingsControls();
        }
        if (selectedColor) {
          const icon = folderRow.querySelector('.folder-icon');
          if (icon) {
            icon.setAttribute('data-color', selectedColor);
          }
          folderRow.dataset.folderColor = selectedColor;
        }
        console.log('Update folder', {
          folderId: activeFolderId,
          name: trimmedName,
          color: selectedColor,
        });
        closeFolderDialog();
      });

      moveFolderDestinationSelect?.addEventListener('change', () => {
        moveFolderDestinationSelect.setCustomValidity('');
      });

      deleteFolderConfirmInput?.addEventListener('input', () => {
        deleteFolderConfirmInput.setCustomValidity('');
      });

      emptyTrashConfirmInput?.addEventListener('input', () => {
        emptyTrashConfirmInput.setCustomValidity('');
      });

      pageSettingsDialogClose?.addEventListener('click', () => {
        closePageSettingsDialog();
      });

      pageSettingsCancel?.addEventListener('click', () => {
        closePageSettingsDialog();
      });

      pageSettingsDialog?.addEventListener('click', (event) => {
        if (event.target === pageSettingsDialog) {
          closePageSettingsDialog();
          return;
        }
        const tabButton = event.target.closest('[data-page-settings-tab]');
        if (tabButton) {
          setActivePageSettingsTab(tabButton.dataset.pageSettingsTab);
          return;
        }
        const typeButton = event.target.closest('[data-page-type-option]');
        if (typeButton) {
          const nextType = typeButton.dataset.pageTypeOption || '';
          setPageSettingsType(nextType);
          const recommendedTemplate =
            TEMPLATE_DEFAULTS_BY_TYPE[nextType] || defaultPageTemplateValue;
          if (recommendedTemplate) {
            setPageSettingsTemplate(recommendedTemplate);
          }
          return;
        }
        const templateButton = event.target.closest('[data-page-template-option]');
        if (templateButton) {
          setPageSettingsTemplate(templateButton.dataset.pageTemplateOption || '');
        }
      });

      pageSettingsDialog?.addEventListener('change', (event) => {
        const typeRadio = event.target.closest("input[name='pageTypeOption']");
        if (typeRadio instanceof HTMLInputElement && typeRadio.type === 'radio') {
          const nextType = typeRadio.value || '';
          setPageSettingsType(nextType);
          const recommendedTemplate =
            TEMPLATE_DEFAULTS_BY_TYPE[nextType] || defaultPageTemplateValue;
          if (recommendedTemplate) {
            setPageSettingsTemplate(recommendedTemplate);
          }
          return;
        }
        const templateRadio = event.target.closest("input[name='pageTemplateOption']");
        if (templateRadio instanceof HTMLInputElement && templateRadio.type === 'radio') {
          setPageSettingsTemplate(templateRadio.value || '');
        }
      });

      pageSettingsDialog?.addEventListener('keydown', (event) => {
        const tabButton = event.target.closest('[data-page-settings-tab]');
        if (!tabButton) {
          return;
        }
        if (event.key === 'ArrowRight') {
          event.preventDefault();
          focusAdjacentPageSettingsTab(1);
        } else if (event.key === 'ArrowLeft') {
          event.preventDefault();
          focusAdjacentPageSettingsTab(-1);
        } else if (event.key === 'Home') {
          event.preventDefault();
          const firstTab = pageSettingsTabButtons[0]?.dataset.pageSettingsTab;
          if (firstTab) {
            setActivePageSettingsTab(firstTab, { focusTab: true });
          }
        } else if (event.key === 'End') {
          event.preventDefault();
          const lastTab =
            pageSettingsTabButtons[pageSettingsTabButtons.length - 1]?.dataset
              .pageSettingsTab;
          if (lastTab) {
            setActivePageSettingsTab(lastTab, { focusTab: true });
          }
        }
      });

      pageSettingsForm?.addEventListener('submit', (event) => {
        event.preventDefault();
        if (!activePageId) {
          closePageSettingsDialog();
          return;
        }
        const formData = new FormData(pageSettingsForm);
        const titleValue = (formData.get('title') || '').toString().trim();
        const slugValue = (formData.get('slug') || '').toString().trim();
        const typeValue = (formData.get('type') || '').toString().trim();
        const templateValue = (formData.get('template') || '').toString().trim();
        const normalizedType = typeValue || defaultPageTypeValue;
        const resolvedTemplate =
          templateValue || TEMPLATE_DEFAULTS_BY_TYPE[normalizedType] || defaultPageTemplateValue;
        const payload = {
          pageId: activePageId,
          title: titleValue,
          slug: slugValue,
          folder: (formData.get('folder') || '').toString().trim(),
          status: (formData.get('status') || '').toString().trim(),
          author: (formData.get('author') || '').toString().trim(),
          description: (formData.get('description') || '').toString().trim(),
          type: normalizedType,
          template: resolvedTemplate,
        };
        const row = pageRowById.get(activePageId);
        if (row) {
          if (titleValue) {
            row.dataset.title = titleValue;
            const titleButton = row.querySelector('.title-button');
            if (titleButton) {
              titleButton.textContent = titleValue;
            }
          }
          if (slugValue) {
            const subtitle = row.querySelector('.title-text .subtitle');
            if (subtitle) {
              subtitle.textContent = slugValue;
            }
          }
          if (normalizedType) {
            row.dataset.type = normalizedType;
          }
          if (resolvedTemplate) {
            row.dataset.template = resolvedTemplate;
          }
          const typeChip = row.querySelector('.chip');
          if (typeChip) {
            typeChip.textContent = normalizedType || '—';
            typeChip.dataset.color = TYPE_STYLES[normalizedType] || 'slate';
          }
        }
        const rowEntry = rowData.find((item) => item.pageId === activePageId);
        if (rowEntry) {
          rowEntry.title = titleValue || rowEntry.title;
          rowEntry.slug = slugValue || rowEntry.slug;
          rowEntry.type = normalizedType || rowEntry.type;
          rowEntry.template = resolvedTemplate || rowEntry.template;
          const sourceBits = [
            rowEntry.title,
            rowEntry.slug,
            rowEntry.status,
            rowEntry.type,
            rowEntry.author,
            rowEntry.template,
            row?.textContent || '',
          ];
          rowEntry.searchText = sourceBits
            .join(' ')
            .toLowerCase()
            .replace(/\s+/g, ' ')
            .trim();
        }
        applyRowVisualStyles();
        renderTypeFilters();
        syncFilterControls();
        updateRows();
        console.log('Update page settings', payload);
        closePageSettingsDialog();
      });

      const handleTableChange = (event) => {
        const target = event.target;
        if (!(target instanceof HTMLInputElement)) {
          return;
        }
        if (target.matches('[data-row-checkbox]')) {
          const row = target.closest('.page-row');
          if (!row) {
            return;
          }
          setPageSelection(row, target.checked);
          updateMasterCheckbox();
          updateFolderCheckboxes();
          updateBulkBar();
          return;
        }
        if (target.matches('[data-folder-checkbox]')) {
          const folderId = target.dataset.folderId || '_root';
          const members = folderMembers.get(folderId) || [];
          const scopedMembers = members.filter(
            (row) => !row.classList.contains('is-filter-hidden')
          );
          if (scopedMembers.length === 0) {
            target.checked = false;
            target.indeterminate = false;
            return;
          }
          scopedMembers.forEach((row) => {
            setPageSelection(row, target.checked);
          });
          updateMasterCheckbox();
          updateFolderCheckboxes();
          updateBulkBar();
        }
      };

      pagesTableElement?.addEventListener('change', handleTableChange);

      masterCheckbox?.addEventListener('change', () => {
        if (!masterCheckbox) {
          return;
        }
        const scopeRows = getRowsInScope();
        scopeRows.forEach((row) => {
          setPageSelection(row, masterCheckbox.checked);
        });
        updateMasterCheckbox();
        updateFolderCheckboxes();
        updateBulkBar();
      });

      actionMenus.forEach((menu) => {
        closeActionMenu(menu);
      });

      if (bulkActionsBar) {
        bulkActionsBar.addEventListener('click', (event) => {
          const clearButton = event.target.closest('#clearSelectionButton');
          if (clearButton) {
            event.preventDefault();
            clearSelection();
            return;
          }
          const actionButton = event.target.closest('[data-bulk-action]');
          if (!actionButton) {
            return;
          }
          const action = actionButton.dataset.bulkAction;
          if (!action || state.selection.size === 0) {
            return;
          }
          if (bulkActionDialogController) {
            bulkActionDialogController.open(action, { trigger: actionButton });
            return;
          }
          console.log(`Bulk ${action}`, Array.from(state.selection));
        });
      }

      window.addEventListener('resize', syncBulkBarOffset);

      sortButtons.forEach((button) => {
        button.addEventListener('click', () => {
          const key = button.dataset.sortKey;
          if (!key) {
            return;
          }
          store.update((draft) => {
            if (draft.sortKey === key) {
              draft.sortDirection = draft.sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
              draft.sortKey = key;
              draft.sortDirection =
                key === 'type' || key === 'author' || key === 'title' ? 'asc' : 'desc';
            }
            return draft;
          });
          applySort();
          updateSortIndicators();
        });
      });

      folderToggleButtons.forEach((button) => {
        const folderId = button.dataset.folderToggle;
        button.addEventListener('click', (event) => {
          event.preventDefault();
          if (isFlatView) {
            return;
          }
          const isExpanded = button.getAttribute('aria-expanded') === 'true';
          setFolderExpanded(folderId, !isExpanded);
        });
        button.addEventListener('dblclick', (event) => {
          event.preventDefault();
          if (isFlatView) {
            return;
          }
          event.stopPropagation();
          openFolderDialog(folderId, { trigger: button });
        });
      });

      flatViewToggleButton?.addEventListener('click', (event) => {
        event.preventDefault();
        isFlatView = !isFlatView;
        applyFlatViewState();
      });

      folderViewToggleButton?.addEventListener('click', (event) => {
        event.preventDefault();
        if (isFlatView) {
          return;
        }
        const availableToggles = folderToggleButtons.filter((button) => button.dataset.folderToggle);
        const shouldExpand = availableToggles.some(
          (toggleButton) => toggleButton.getAttribute('aria-expanded') !== 'true'
        );
        availableToggles.forEach((toggleButton) => {
          const folderId = toggleButton.dataset.folderToggle;
          if (folderId) {
            setFolderExpanded(folderId, shouldExpand);
          }
        });
      });

      applyFlatViewState({ persist: false });

      updateFolderViewToggleButtonState();

      document.addEventListener('click', (event) => {
        const trigger = event.target.closest('[data-action-menu-trigger]');
        if (trigger) {
          const menu = trigger.closest('[data-action-menu]');
          if (menu) {
            event.preventDefault();
            event.stopPropagation();
            const isOpen = menu.dataset.open === 'true';
            if (isOpen) {
              closeActionMenu(menu);
            } else {
              openActionMenu(menu);
            }
          }
          return;
        }
        const menuElement = event.target.closest('[data-action-menu]');
        if (!menuElement) {
          closeAllActionMenus();
        }
        const analyticsCloseButton = event.target.closest('[data-analytics-close]');
        if (analyticsCloseButton) {
          closeAnalyticsDrawer();
          return;
        }

        const analyticsActionButton = event.target.closest('[data-analytics-action]');
        if (analyticsActionButton) {
          const actionKey = analyticsActionButton.dataset.analyticsAction || '';
          if (analyticsActivePageId) {
            console.log('Analytics action', actionKey, analyticsActivePageId);
          }
          return;
        }
        const pageSettingsTrigger = event.target.closest('[data-page-settings]');
        if (pageSettingsTrigger) {
          const row = pageSettingsTrigger.closest('.page-row');
          const pageId = row?.dataset.pageId;
          if (pageId) {
            openPageSettingsDialog(pageId, pageSettingsTrigger);
          }
          return;
        }

        const actionMenuItem = event.target.closest('[data-menu-action]');
        if (actionMenuItem) {
          const action = actionMenuItem.dataset.menuAction;
          const row = actionMenuItem.closest('.page-row');
          const pageId = row?.dataset.pageId;
          const triggerButton = menuElement?.querySelector('[data-action-menu-trigger]');
          if (action === 'settings' && pageId) {
            if (menuElement) {
              closeActionMenu(menuElement);
            }
            openPageSettingsDialog(pageId, triggerButton || actionMenuItem);
            return;
          }
          if (action === 'duplicate' && pageId) {
            if (menuElement) {
              closeActionMenu(menuElement);
            }
            openCopyPageDialog(pageId, triggerButton || actionMenuItem);
            return;
          }
          if (action && pageId) {
            const controller = actionDialogs[action];
            if (controller) {
              if (menuElement) {
                closeActionMenu(menuElement);
              }
              controller.open(pageId, { trigger: triggerButton || actionMenuItem });
              return;
            }
            console.log(`Page ${action}`, pageId);
          } else if (action) {
            console.log(`Page ${action}`, pageId);
          }
          if (menuElement) {
            closeActionMenu(menuElement);
          }
        }
        const titleButton = event.target.closest('[data-open-page]');
        if (titleButton) {
          const pageId = titleButton.dataset.openPage;
          console.log('Open page editor for', pageId);
        }
        const authorButton = event.target.closest('[data-author-filter]');
        if (authorButton) {
          if (state.authors.size > 0) {
            store.update((draft) => {
              draft.authors.clear();
              return draft;
            });
            syncFilterControls();
            updateRows();
          }
        }
        const reportButton = event.target.closest('[data-report-drawer]');
        if (reportButton) {
          const row = reportButton.closest('.page-row');
          if (row) {
            openAnalyticsDrawer(row);
          }
          return;
        }
        const folderActionButton = event.target.closest('[data-folder-action]');
        if (folderActionButton) {
          const action = folderActionButton.dataset.folderAction;
          const folderRow = folderActionButton.closest('.group-row');
          const folderId = folderRow?.dataset.folder;
          if (action === 'rename' && folderId) {
            const triggerButton =
              menuElement?.querySelector('[data-action-menu-trigger]') || folderActionButton;
            openFolderDialog(folderId, { trigger: triggerButton });
          } else if (action && folderId) {
            const controller = folderActionDialogs[action];
            if (controller) {
              const triggerButton =
                menuElement?.querySelector('[data-action-menu-trigger]') || folderActionButton;
              controller.open(folderId, { trigger: triggerButton });
            } else {
              console.log(`Folder ${action}`, folderId);
            }
          }
        }
        if (event.target.closest('.page-analytics-row')) {
          return;
        }
        const rowTarget = event.target.closest('.page-row');
        if (rowTarget) {
          if (
            rowTarget.classList.contains('is-filter-hidden') ||
            rowTarget.classList.contains('is-collapsed')
          ) {
            return;
          }
          const interactiveTarget = event.target.closest(
            'button, a, input, label, .checkbox, [data-action-menu], .author-filter, .folder-header, .folder-actions'
          );
          if (!interactiveTarget) {
            openAnalyticsDrawer(rowTarget);
          }
        }
      });

      // Handle publish option changes for new page dialog
      if (newPageForm && newPageScheduleFields) {
        newPageForm.addEventListener('change', (event) => {
          const input = event.target;
          if (!(input instanceof HTMLInputElement)) {
            return;
          }
          if (input.name === 'publishOption') {
            const showSchedule =
              input.value === 'schedule-publish' || input.value === 'schedule-unpublish';
            newPageScheduleFields.hidden = !showSchedule;
          }
        });
      }

      // Handle publish option changes for page settings dialog
      if (pageSettingsForm && pageSettingsScheduleFields) {
        pageSettingsForm.addEventListener('change', (event) => {
          const input = event.target;
          if (!(input instanceof HTMLInputElement)) {
            return;
          }
          if (input.name === 'pagePublishOption') {
            const showSchedule =
              input.value === 'schedule-publish' || input.value === 'schedule-unpublish';
            pageSettingsScheduleFields.hidden = !showSchedule;
          }
        });
      }

      const initialise = () => {
        applySort();
        updateSortIndicators();
        updateRows();
        syncFilterControls();
        syncBodyScrollState();
        syncBulkBarOffset();
      };

      initialise();
    })();
  </script>



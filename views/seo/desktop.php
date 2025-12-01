<?php
// views/seo/desktop.php: Template placeholder for missing template coverage.
$mwLoad->Window( 'wSeo', 'seo/index' );

$mwLoad
  ->js( 'sample.js' )->css( 'sample.css' );

// API endpoint to fetch and parse sitemap
if (isset($_GET['api']) && $_GET['api'] === 'sitemap') {
    header('Content-Type: application/json');
    
    $sitemap_url = isset($_GET['url']) ? $_GET['url'] : '';
    
    if (empty($sitemap_url)) {
        echo json_encode(['error' => 'No sitemap URL provided']);
        exit;
    }
    
    $xml_content = @file_get_contents($sitemap_url);
    
    if ($xml_content === false) {
        echo json_encode(['error' => 'Failed to fetch sitemap']);
        exit;
    }
    
    libxml_use_internal_errors(true);
    $xml = simplexml_load_string($xml_content);
    libxml_clear_errors();
    
    if ($xml === false) {
        echo json_encode(['error' => 'Failed to parse sitemap XML']);
        exit;
    }
    
    $xml->registerXPathNamespace('sm', 'http://www.sitemaps.org/schemas/sitemap/0.9');
    $urlNodes = $xml->xpath('//sm:url/sm:loc');
    
    $urls = [];
    if ($urlNodes) {
        foreach ($urlNodes as $url) {
            $urls[] = (string)$url;
        }
    }
    
    echo json_encode(['urls' => $urls]);
    exit;
}

// API endpoint to fetch page content (proxy to avoid CORS)
if (isset($_GET['api']) && $_GET['api'] === 'fetch') {
    header('Content-Type: application/json');
    
    $page_url = isset($_GET['url']) ? $_GET['url'] : '';
    
    if (empty($page_url)) {
        echo json_encode(['error' => 'No page URL provided']);
        exit;
    }
    
    $context = stream_context_create([
        'http' => [
            'timeout' => 10,
            'user_agent' => 'SEO Audit Tool/1.0'
        ]
    ]);
    
    $html = @file_get_contents($page_url, false, $context);
    
    if ($html === false) {
        echo json_encode(['error' => 'Failed to fetch page']);
        exit;
    }
    
    echo json_encode(['html' => $html]);
    exit;
}

// Get current site URL for default sitemap
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$default_sitemap_url = $protocol . '://' . $host . '/sitemap.xml';
?>
<style>
.seo-app-main * {
    box-sizing: border-box;
}

.seo-app-main {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 0;
}

.seo-app-main .app-content {
    max-width: 100%;
    margin: 0 auto;
    padding: 0;
}

.seo-app-main .container {
    width: 100%;
}

/* Hero Section */
.seo-app-main .seo-hero {
    background: #2EB7A0;
    color: white;
    padding: 3rem 2rem;
    margin-bottom: 2rem;
}

.seo-app-main .seo-hero-content {
    margin: 0 auto 2rem;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 2rem;
}

.seo-app-main .hero-eyebrow {
    display: inline-block;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.25rem 0.75rem;
    margin-bottom: 0.5rem;
}

.seo-app-main .seo-hero-title {
    font-size: 2rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
}

.seo-app-main .seo-hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.95;
    margin: 0;
    line-height: 1.5;
}

.seo-app-main .seo-hero-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.75rem;
}

.seo-app-main .seo-hero-meta {
    font-size: 0.875rem;
    opacity: 0.9;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Overview Cards */
.seo-app-main .seo-overview-grid {
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
}

.seo-app-main .seo-overview-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 1.5rem;
    text-align: center;
}

.seo-app-main .seo-overview-value {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    line-height: 1;
}

.seo-app-main .seo-overview-label {
    font-size: 0.875rem;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 500;
}

/* Quick Fixes Container */
.seo-app-main .quick-fixes-container {
    display: none;
    margin: 0 auto 2rem;
    padding: 0 2rem;
}

.seo-app-main .quick-fixes-container.show {
    display: block;
}

/* Legend */
.seo-app-main .seo-legend {
    display: flex;
    gap: 2rem;
    padding: 1rem 1.5rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    margin-bottom: 1.5rem;
}

.seo-app-main .legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #64748b;
}

.seo-app-main .legend-color {
    width: 1rem;
    height: 1rem;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.seo-app-main .legend-color.green {
    background: #10b981;
}

.seo-app-main .legend-color.yellow {
    background: #f59e0b;
}

.seo-app-main .legend-color.red {
    background: #ef4444;
}

.seo-app-main .quick-fixes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
}

.seo-app-main .quick-fix-card {
    background: #fff;
    padding: 1.5rem;
    border: 2px solid #fee2e2;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    transition: all 0.2s;
    position: relative;
}

.seo-app-main .quick-fix-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: #ef4444;
}

.seo-app-main .quick-fix-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
    border-color: #fca5a5;
}

.seo-app-main .quick-fix-card.serious {
    border-color: #fef3c7;
}

.seo-app-main .quick-fix-card.serious::before {
    background: #f59e0b;
}

.seo-app-main .quick-fix-card.serious:hover {
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.15);
    border-color: #fcd34d;
}

.seo-app-main .quick-fix-card.moderate {
    border-color: #d1fae5;
}

.seo-app-main .quick-fix-card.moderate::before {
    background: #10b981;
}

.seo-app-main .quick-fix-card.moderate:hover {
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
    border-color: #86efac;
}

.seo-app-main .quick-fix-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 1rem;
    gap: 1rem;
}

.seo-app-main .quick-fix-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
    line-height: 1.4;
}

.seo-app-main .quick-fix-count {
    background: #fee2e2;
    color: #991b1b;
    padding: 0.375rem 0.75rem;
    font-size: 0.8125rem;
    font-weight: 700;
    white-space: nowrap;
    line-height: 1;
}

.seo-app-main .quick-fix-card.serious .quick-fix-count {
    background: #fef3c7;
    color: #92400e;
}

.seo-app-main .quick-fix-card.moderate .quick-fix-count {
    background: #d1fae5;
    color: #065f46;
}

.seo-app-main .quick-fix-description {
    font-size: 0.9rem;
    color: #64748b;
    margin: 0 0 1rem 0;
    line-height: 1.6;
}

.seo-app-main .quick-fix-suggestion {
    font-size: 0.9rem;
    color: #1e293b;
    background: #f0fdfa;
    padding: 1rem;
    margin: 0 0 1rem 0;
    border-left: 3px solid #2EB7A0;
    line-height: 1.6;
}

.seo-app-main .quick-fix-suggestion strong {
    color: #0f766e;
    font-weight: 600;
}

/* Buttons */
.seo-app-main .btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border: none;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
}

	
	
	
.seo-app-main .btn-primary {
    background: white;
    color: #2EB7A0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.seo-app-main .btn-primary:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.seo-app-main .btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.seo-app-main .btn-export {
    padding: 0.625rem 1.25rem;
    background: #2EB7A0;
    color: white;
    text-decoration: none;
    border: none;
    cursor: pointer;
    font-size: 0.875rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
    transition: all 0.2s;
}

.seo-app-main .btn-export:hover {
    background: #259887;
    transform: translateY(-1px);
}

.seo-app-main .btn-small {
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
}

.seo-app-main h4 { margin-bottom:25px;}	
	
/* Status Messages */
.seo-app-main .status {
    display: none;
    padding: 1rem;
    margin: 1rem 2rem;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}

.seo-app-main .status.show {
    display: block;
}

.seo-app-main .status.loading {
    background: #e3f2fd;
    color: #1976d2;
    border: 1px solid #90caf9;
}

.seo-app-main .status.error {
    background: #ffebee;
    color: #c62828;
    border: 1px solid #ef9a9a;
}

.seo-app-main .status.success {
    background: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #a5d6a7;
}

.seo-app-main .spinner {
    display: inline-block;
    width: 14px;
    height: 14px;
    border: 2px solid rgba(0, 0, 0, 0.1);
    border-top-color: currentColor;
    border-radius: 50%;
    animation: spin 0.6s linear infinite;
    vertical-align: middle;
    margin-right: 0.5rem;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Progress Bar */
.seo-app-main .progress-bar {
    margin: 1.5rem auto 0;
    height: 8px;
    background: rgba(255, 255, 255, 0.3);
    overflow: hidden;
}

.seo-app-main .progress-fill {
    height: 100%;
    background: white;
    width: 0%;
    transition: width 0.3s ease;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

/* Results Container */
.seo-app-main .results-container {
    display: none;
    margin: 0 auto;
    padding: 0 2rem 2rem;
}

.seo-app-main .results-container.show {
    display: block;
}

/* Cards */
.seo-app-main .card {
    background: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    padding: 2rem;
    margin-bottom: 2rem;
}

.seo-app-main .card h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a202c;
    margin: 0 0 1.5rem 0;
}

/* Page Grid */
.seo-app-main .seo-page-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.seo-app-main .seo-page-card {
    background: white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    padding: 1.5rem;
    transition: all 0.2s;
    cursor: pointer;
    border: 2px solid transparent;
}

.seo-app-main .seo-page-card:hover,
.seo-app-main .seo-page-card:focus {
    transform: translateY(-4px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
    border-color: #2EB7A0;
    outline: none;
}

.seo-app-main .seo-page-card header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.seo-app-main .score-indicator {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    gap: 0.125rem;
}

.seo-app-main .score-indicator__number {
    font-size: 2rem;
    line-height: 1;
}

.seo-app-main .seo-score--excellent {
    color: #10b981;
}

.seo-app-main .seo-score--good {
    color: #10b981;
}

.seo-app-main .seo-score--fair {
    color: #f59e0b;
}

.seo-app-main .seo-score--poor {
    color: #ef4444;
}

.seo-app-main .seo-level-badge {
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.seo-app-main .level-optimised {
    background: #d1fae5;
    color: #065f46;
}

.seo-app-main .level-needs-improvement {
    background: #fef3c7;
    color: #92400e;
}

.seo-app-main .level-critical {
    background: #fee2e2;
    color: #991b1b;
}

.seo-app-main .seo-page-card h3 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1a202c;
    margin: 0 0 0.5rem 0;
    line-height: 1.4;
}

.seo-app-main .seo-page-url {
    font-size: 0.875rem;
    color: #2EB7A0;
    margin: 0 0 1rem 0;
    word-break: break-all;
}

.seo-app-main .seo-page-summary {
    font-size: 0.875rem;
    color: #64748b;
    margin: 0 0 1rem 0;
    line-height: 1.5;
}

.seo-app-main .seo-page-metrics {
    list-style: none;
    padding: 0;
    margin: 0 0 1rem 0;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
    padding-top: 1rem;
    border-top: 1px solid #e2e8f0;
}

.seo-app-main .seo-page-metrics li {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.seo-app-main .seo-page-metrics li span:first-child {
    font-size: 0.75rem;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 500;
}

.seo-app-main .seo-page-metrics li span:last-child {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1e293b;
}

.seo-app-main .seo-page-issues {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
    min-height: 2rem;
}

.seo-app-main .issue-badge {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}

.seo-app-main .issue-badge:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.seo-app-main .issue-badge.fail,
.seo-app-main .issue-badge.critical {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fca5a5;
}

.seo-app-main .issue-badge.warning,
.seo-app-main .issue-badge.serious,
.seo-app-main .issue-badge.moderate {
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #fcd34d;
}

.seo-app-main .issue-badge.minor {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #86efac;
}

.seo-app-main .seo-page-card footer {
    padding-top: 1rem;
    border-top: 1px solid #e2e8f0;
}

.seo-app-main .seo-card-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    background: none;
    border: none;
    color: #2EB7A0;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    padding: 0;
    transition: all 0.2s;
}

.seo-app-main .seo-card-link:hover {
    gap: 0.75rem;
}

/* Table */
.seo-app-main .table-wrapper {
    overflow-x: auto;
    margin-top: 1rem;
    border: 1px solid #e2e8f0;
    background: white;
}

.seo-app-main table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}

.seo-app-main thead {
    background: #f8fafc;
    border-bottom: 2px solid #e2e8f0;
}

.seo-app-main th {
    padding: 1.25rem 1.5rem;
    text-align: left;
    font-weight: 600;
    color: #1e293b;
    font-size: 0.8125rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    white-space: nowrap;
}

.seo-app-main td {
    padding: 1.5rem;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: top;
}

.seo-app-main tbody tr {
    transition: background 0.15s;
}

.seo-app-main tbody tr:hover {
    background: #fafbfc;
}

.seo-app-main tbody tr:last-child td {
    border-bottom: none;
}

.seo-app-main .page-link {
    color: #2EB7A0;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
    display: block;
    max-width: 350px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 0.9rem;
}

.seo-app-main .page-link:hover {
    color: #259887;
    text-decoration: underline;
}

.seo-app-main .btn-view-details {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.625rem 1.25rem;
    background: #2EB7A0;
    color: white;
    border: none;
    font-size: 0.8125rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
}

.seo-app-main .btn-view-details:hover {
    background: #259887;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(46, 183, 160, 0.2);
}

/* Modal */
.seo-app-main .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    animation: fadeIn 0.2s;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.seo-app-main .modal.show {
    display: flex;
    align-items: center;
    justify-content: center;
}

.seo-app-main .modal-content {
    background-color: white;
    margin: 2rem;
    padding: 2.5rem 2.5rem 2rem;
    width: 90%;
    max-width: 700px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    animation: slideUp 0.3s;
}

@keyframes slideUp {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.seo-app-main .modal-close {
    position: absolute;
    right: 2rem;
    top: 2rem;
    width: 2rem;
    height: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f9;
    border: none;
    cursor: pointer;
    color: #64748b;
    font-size: 1.25rem;
    transition: all 0.2s;
}

.seo-app-main .modal-close:hover {
    background: #e2e8f0;
    color: #1e293b;
    transform: scale(1.1);
}

.seo-app-main #modal-title,
.seo-app-main #detail-modal-title {
    margin: 0 0 0.75rem 0;
    padding-right: 2.75rem;
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a202c;
}

.seo-app-main #modal-body {
    margin-top: 1.5rem;
    line-height: 1.6;
    color: #475569;
}

.seo-app-main #modal-body h4 {
    color: #1e293b;
    font-size: 1.125rem;
    font-weight: 600;
    margin: 1.5rem 0 0.75rem;
}

.seo-app-main #modal-body ul {
    margin: 0.75rem 0;
    padding-left: 1.5rem;
}

.seo-app-main #modal-body li {
    margin: 0.5rem 0;
    line-height: 1.6;
}

.seo-app-main #modal-body code {
    background: #f1f5f9;
    padding: 0.125rem 0.375rem;
    border-radius: 4px;
    font-family: 'Monaco', 'Courier New', monospace;
    font-size: 0.875em;
    color: #2EB7A0;
}

.seo-app-main #modal-body pre {
    background: #1e293b;
    color: #e2e8f0;
    padding: 1rem;
    border-radius: 8px;
    overflow-x: auto;
    margin: 1rem 0;
    font-family: 'Monaco', 'Courier New', monospace;
    font-size: 0.875rem;
    line-height: 1.5;
}
</style>

<div class="mwDskTools">
  <h1>SEO Audit</h1>
</div>

<div class="mwDesktop">
  <main class="seo-app-main">
    <div class="app-content">
      <div class="container">
        
        <div class="seo-hero">
          <div class="seo-hero-content">
            <div>
              <span class="hero-eyebrow">Optimisation Signals</span>
              <h2 class="seo-hero-title">SEO Audit Dashboard</h2>
              <p class="seo-hero-subtitle">Measure on-page signals and prioritise fixes that improve organic visibility.</p>
            </div>
            <div class="seo-hero-actions">
              <button type="button" id="scan-btn" class="btn btn-primary" onclick="startScan()">
                <span>Scan All Pages</span>
              </button>
            </div>
          </div>
          
          <div class="seo-overview-grid">
            <div class="seo-overview-card">
              <div class="seo-overview-value" id="pages-scanned">0</div>
              <div class="seo-overview-label">Pages Scanned</div>
            </div>
            <div class="seo-overview-card">
              <div class="seo-overview-value" id="avg-score">0%</div>
              <div class="seo-overview-label">Average SEO Score</div>
            </div>
            <div class="seo-overview-card">
              <div class="seo-overview-value" id="total-issues">0</div>
              <div class="seo-overview-label">Critical Issues</div>
            </div>
            <div class="seo-overview-card">
              <div class="seo-overview-value" id="optimized-pages">0</div>
              <div class="seo-overview-label">Optimised Pages</div>
            </div>
          </div>
          
          <div class="progress-bar" id="progress-bar" style="display: none;">
            <div class="progress-fill" id="progress-fill"></div>
          </div>
        </div>

        <div id="status" class="status"></div>

        <!-- Quick Fixes Summary -->
        <div class="quick-fixes-container" id="quick-fixes-container">
          <div class="card">
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
              <h2 style="margin: 0;">Priority Fixes</h2>
            </div>
            <p style="color: #64748b; margin: 0 0 1.5rem 0; font-size: 1rem;">Address these common issues across multiple pages to improve your overall SEO score.</p>
            
            <div class="seo-legend">
              <div class="legend-item">
                <div class="legend-color green"></div>
                <span>Pass / Minor</span>
              </div>
              <div class="legend-item">
                <div class="legend-color yellow"></div>
                <span>Warning / Needs Improvement</span>
              </div>
              <div class="legend-item">
                <div class="legend-color red"></div>
                <span>Critical / Failed</span>
              </div>
            </div>
            
            <div class="quick-fixes-grid" id="quick-fixes-grid"></div>
          </div>
        </div>

        <div class="results-container" id="results-container">
          <div class="card">
            <h2>SEO Analysis Results</h2>
            <button class="btn-export" onclick="exportToCSV()">
              Export CSV
            </button>
            
            <div class="seo-legend">
              <div class="legend-item">
                <div class="legend-color green"></div>
                <span>Pass / Minor (90-100)</span>
              </div>
              <div class="legend-item">
                <div class="legend-color yellow"></div>
                <span>Warning (60-89)</span>
              </div>
              <div class="legend-item">
                <div class="legend-color red"></div>
                <span>Critical (0-59)</span>
              </div>
            </div>
            
            <div class="table-wrapper">
              <table id="results-table">
                <thead>
                  <tr>
                    <th>URL</th>
                    <th>Score</th>
                    <th>Status</th>
                    <th>Word Count</th>
                    <th>Internal Links</th>
                    <th>Missing Alt</th>
                    <th>Issues</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="results-tbody">
                  <!-- Results will be populated here -->
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Modal for fix suggestions -->
    <div id="suggestion-modal" class="modal">
      <div class="modal-content">
        <button class="modal-close" onclick="closeModal()" aria-label="Close">
          ×
        </button>
        <h3 id="modal-title"></h3>
        <div id="modal-body"></div>
      </div>
    </div>
    
    <!-- Modal for page details -->
    <div id="page-details-modal" class="modal">
      <div class="modal-content" style="max-width: 900px;">
        <button class="modal-close" onclick="closePageDetails()" aria-label="Close">
          ×
        </button>
        <h3 id="detail-modal-title"></h3>
        <div id="detail-modal-body"></div>
      </div>
    </div>
  </main>
</div>

<script>
// Global variables
let scanResults = [];
let totalPages = 0;
let scannedPages = 0;
let totalIssues = 0;
let totalWarnings = 0;
const sitemapUrl = '<?php echo addslashes($default_sitemap_url); ?>';

// System paths to ignore (no scans, no CSV rows)
const SYSTEM_PATHS = ['/403', '/404', '/error', '/search'];

// Fix suggestions database
const fixSuggestions = {
    'Title Tag - fail': {
        title: 'Missing Title Tag',
        description: 'Your page is missing a title tag. The title tag is one of the most important on-page SEO elements.',
        quickFix: 'Add a title tag with 50-60 characters inside your head section',
        fix: [
            'Add a title tag inside your head section',
            'Keep it between 50-60 characters for optimal display in search results',
            'Make it unique and descriptive for each page',
            'Include your primary keyword near the beginning'
        ]
    },
    'Title Tag - warning': {
        title: 'Title Tag Length Not Optimal',
        description: 'Your title tag exists but is not the optimal length (50-60 characters).',
        quickFix: 'Adjust title length to 50-60 characters and include primary keyword',
        fix: [
            'Title tags shorter than 50 characters may not be descriptive enough',
            'Title tags longer than 60 characters may be truncated in search results',
            'Include your primary keyword',
            'Make it compelling to improve click-through rates'
        ]
    },
    'Title Tag - serious': {
        title: 'Title Tag Length Not Optimal',
        description: 'Your title tag exists but is not the optimal length (50-60 characters).',
        quickFix: 'Adjust title length to 50-60 characters and include primary keyword',
        fix: [
            'Title tags shorter than 50 characters may not be descriptive enough',
            'Title tags longer than 60 characters may be truncated in search results',
            'Include your primary keyword',
            'Make it compelling to improve click-through rates'
        ]
    },
    'Meta Description - fail': {
        title: 'Missing Meta Description',
        description: 'Your page is missing a meta description. This is the text snippet that appears in search results.',
        quickFix: 'Add meta description tag with 150-160 characters including keywords',
        fix: [
            'Add a meta name description tag inside your head section',
            'Keep it between 150-160 characters',
            'Make it compelling and include a call-to-action',
            'Include your target keywords naturally'
        ]
    },
    'Meta Description - warning': {
        title: 'Meta Description Length Not Optimal',
        description: 'Your meta description exists but is not the optimal length (150-160 characters).',
        quickFix: 'Optimize description to 150-160 characters with compelling CTA',
        fix: [
            'Descriptions shorter than 150 characters may not be compelling enough',
            'Descriptions longer than 160 characters may be truncated in search results',
            'Include a clear value proposition',
            'Add a call-to-action if space permits'
        ]
    },
    'Meta Description - serious': {
        title: 'Meta Description Too Short',
        description: 'Your meta description is too short to be effective.',
        quickFix: 'Expand description to at least 120 characters with keywords',
        fix: [
            'Descriptions shorter than 120 characters may not be compelling enough',
            'Add more detail about your page content',
            'Include your target keywords naturally',
            'Make it compelling to improve click-through rates'
        ]
    },
    'H1 Tag - fail': {
        title: 'Missing H1 Tag',
        description: 'Your page is missing an H1 heading. The H1 should describe the main topic of the page.',
        quickFix: 'Add one H1 tag near top of content with primary keyword',
        fix: [
            'Add one H1 tag to your page',
            'Place it near the top of your content',
            'Make it descriptive and include your primary keyword',
            'Only use ONE H1 per page'
        ]
    },
    'H1 Tag - warning': {
        title: 'Multiple H1 Tags Found',
        description: 'Your page has multiple H1 tags. Best practice is to have only one H1 per page.',
        quickFix: 'Remove duplicate H1 tags, keep only one main heading',
        fix: [
            'Use only one H1 tag per page',
            'Use H2, H3, H4, etc. for subheadings',
            'Maintain a proper heading hierarchy',
            'The H1 should describe the main page topic'
        ]
    },
    'H1 Tag - serious': {
        title: 'Missing H1 Tag',
        description: 'Your page is missing an H1 heading.',
        quickFix: 'Add one H1 tag near top of content with primary keyword',
        fix: [
            'Add one H1 tag to your page',
            'Place it near the top of your content',
            'Make it descriptive and include your primary keyword'
        ]
    },
    'Image Alt Tags - fail': {
        title: 'Missing Image Alt Tags',
        description: 'All your images are missing alt attributes. Alt text is crucial for accessibility and SEO.',
        quickFix: 'Add descriptive alt text to all images',
        fix: [
            'Add descriptive alt attributes to all images',
            'Describe what the image shows',
            'Include keywords naturally when relevant',
            'Keep descriptions concise but informative'
        ]
    },
    'Image Alt Tags - warning': {
        title: 'Some Images Missing Alt Tags',
        description: 'Some of your images are missing alt attributes. All images should have descriptive alt text.',
        quickFix: 'Add alt attributes to remaining images',
        fix: [
            'Add alt attributes to all remaining images',
            'Decorative images can use empty alt text',
            'Describe the image content clearly',
            'Include keywords naturally when relevant'
        ]
    },
    'Content Length - fail': {
        title: 'Insufficient Content',
        description: 'Your page has less than 150 words. Search engines prefer pages with substantial, valuable content.',
        quickFix: 'Expand content to at least 300 words with quality information',
        fix: [
            'Aim for at least 300 words of quality content',
            'Provide comprehensive information on your topic',
            'Break up text with headings and images',
            'Focus on answering user questions thoroughly'
        ]
    },
    'Content Length - warning': {
        title: 'Content Length Below Optimal',
        description: 'Your page has 150-299 words. While this is better than thin content, aim for at least 300 words.',
        quickFix: 'Add more details and examples to reach 300+ words',
        fix: [
            'Expand your content to at least 300 words',
            'Add more details, examples, or explanations',
            'Consider adding sections for related topics',
            'Ensure quality over quantity'
        ]
    },
    'Content Length - serious': {
        title: 'Content Too Short',
        description: 'Your page has insufficient content.',
        quickFix: 'Expand content to at least 300 words with quality information',
        fix: [
            'Aim for at least 300 words of quality content',
            'Provide comprehensive information on your topic',
            'Focus on answering user questions thoroughly'
        ]
    },
    'Internal Links - warning': {
        title: 'Few Internal Links',
        description: 'Your page has fewer than 3 internal links.',
        quickFix: 'Add 3-5 relevant internal links to related content',
        fix: [
            'Add links to related pages on your site',
            'Use descriptive anchor text',
            'Link to important pages',
            'Aim for 3-5 internal links per page'
        ]
    },
    'Canonical Tag - warning': {
        title: 'Missing Canonical Tag',
        description: 'Your page is missing a canonical tag. This helps prevent duplicate content issues.',
        quickFix: 'Add canonical tag pointing to this page URL',
        fix: [
            'Add a link rel canonical tag to your head section',
            'Point it to the preferred version of this page',
            'Use absolute URLs (include https://)',
            'Ensure it matches the actual page URL'
        ]
    },
    'Open Graph - fail': {
        title: 'Missing Open Graph Tags',
        description: 'Your page is missing Open Graph tags. These control how your page appears when shared on social media.',
        quickFix: 'Add og:title, og:description, and og:image meta tags',
        fix: [
            'Add og:title, og:description, and og:image meta tags',
            'Place them in your head section',
            'Use compelling titles and descriptions',
            'Use high-quality images (1200x630px recommended)'
        ]
    },
    'Open Graph - warning': {
        title: 'Incomplete Open Graph Tags',
        description: 'Your page has some Open Graph tags but is missing others.',
        quickFix: 'Complete missing og:title, og:description, or og:image tags',
        fix: [
            'Add the missing Open Graph tags',
            'Ensure you have og:title, og:description, and og:image',
            'Consider adding og:url and og:type as well'
        ]
    },
    'Open Graph - minor': {
        title: 'Missing Open Graph Tags',
        description: 'Your page is missing Open Graph tags.',
        quickFix: 'Add og:title, og:description, and og:image meta tags',
        fix: [
            'Add og:title, og:description, and og:image meta tags',
            'Use high-quality images (1200x630px recommended)'
        ]
    }
};

// Show status message
function showStatus(message, type) {
    const statusEl = document.getElementById('status');
    statusEl.className = `status ${type} show`;
    statusEl.innerHTML = message;
}

// Hide status message
function hideStatus() {
    const statusEl = document.getElementById('status');
    statusEl.classList.remove('show');
}

// Update progress
function updateProgress(current, total) {
    const percentage = Math.round((current / total) * 100);
    const progressBar = document.getElementById('progress-bar');
    const progressFill = document.getElementById('progress-fill');
    
    progressBar.style.display = 'block';
    progressFill.style.width = percentage + '%';
    
    showStatus(
        `<div class="spinner"></div> Scanning page ${current} of ${total} (${percentage}%)...`,
        'loading'
    );
}

// Show fix suggestion modal
function showFixSuggestion(checkLabel, status) {
    const key = `${checkLabel} - ${status}`;
    const suggestion = fixSuggestions[key];
    
    if (!suggestion) return;
    
    const modal = document.getElementById('suggestion-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalBody = document.getElementById('modal-body');
    
    modalTitle.textContent = suggestion.title;
    
    let bodyHTML = `<p style="font-size: 1rem; color: #64748b; line-height: 1.6; margin-bottom: 1.5rem;">${suggestion.description}</p>`;
    bodyHTML += '<h4 style="font-size: 1.125rem; font-weight: 600; color: #1e293b; margin-bottom: 1rem;">How to Fix:</h4><ul style="margin: 0; padding-left: 1.5rem;">';
    suggestion.fix.forEach(item => {
        bodyHTML += `<li style="margin: 0.75rem 0; line-height: 1.6; color: #475569;">${item}</li>`;
    });
    bodyHTML += '</ul>';
    
    modalBody.innerHTML = bodyHTML;
    modal.classList.add('show');
}

// Close modal
function closeModal() {
    const modal = document.getElementById('suggestion-modal');
    modal.classList.remove('show');
}

// Close modal when clicking outside
window.onclick = function(event) {
    const suggestionModal = document.getElementById('suggestion-modal');
    const detailsModal = document.getElementById('page-details-modal');
    
    if (event.target === suggestionModal) {
        suggestionModal.classList.remove('show');
    }
    if (event.target === detailsModal) {
        detailsModal.classList.remove('show');
    }
}

// Close modals with escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.getElementById('suggestion-modal').classList.remove('show');
        document.getElementById('page-details-modal').classList.remove('show');
    }
});

// Collect visible text only (not scripts, styles, head, hidden, etc.)
function getVisibleText(node) {
    if (!node) return '';

    let text = '';

    // Text node: collect it
    if (node.nodeType === Node.TEXT_NODE) {
        return node.textContent || '';
    }

    // Element node: skip non-visible containers
    if (node.nodeType === Node.ELEMENT_NODE) {
        const tag = node.tagName ? node.tagName.toLowerCase() : '';

        // Skip non-content / non-visible containers
        if (
            tag === 'script' ||
            tag === 'style' ||
            tag === 'noscript' ||
            tag === 'template' ||
            tag === 'head'
        ) {
            return '';
        }

        // Skip elements explicitly marked hidden
        if (
            node.hasAttribute('hidden') ||
            (node.getAttribute && node.getAttribute('aria-hidden') === 'true')
        ) {
            return '';
        }

        // Recurse into children
        node.childNodes.forEach(child => {
            text += ' ' + getVisibleText(child);
        });
    }

    return text;
}

// Helper: is this URL one of our system pages?
function isSystemPage(url) {
    try {
        const u = new URL(url);
        let path = u.pathname || '/';
        // strip trailing slashes
        path = path.replace(/\/+$/, '') || '/';
        return SYSTEM_PATHS.includes(path);
    } catch (e) {
        // Fallback for relative URLs
        let path = url.split('?')[0];
        path = path.replace(/\/+$/, '') || '/';
        return SYSTEM_PATHS.includes(path);
    }
}

// Parse HTML and perform comprehensive SEO checks
function checkPage(html, url) {
    const parser = new DOMParser();
    const doc = parser.parseFromString(html, 'text/html');
    
    const checks = [];
    let violations = {
        critical: 0,
        serious: 0,
        moderate: 0,
        minor: 0
    };
    
    // Check 1: Title Tag
    const title = doc.querySelector('title');
    let titleStatus = 'fail';
    let titleLength = 0;
    if (title && title.textContent.trim().length > 0) {
        titleLength = title.textContent.trim().length;
        if (titleLength >= 30 && titleLength <= 65) {
            titleStatus = 'ok';
        } else if (titleLength > 0) {
            titleStatus = 'serious';
            violations.serious++;
        }
    } else {
        violations.critical++;
    }
    if (titleStatus === 'fail') violations.critical++;
    checks.push({ label: 'Title Tag', status: titleStatus });
    
    // Check 2: Meta Description
    const metaDesc = doc.querySelector('meta[name="description"]');
    let descStatus = 'fail';
    let descLength = 0;
    if (metaDesc && metaDesc.getAttribute('content').trim().length > 0) {
        descLength = metaDesc.getAttribute('content').trim().length;
        if (descLength >= 120 && descLength <= 160) {
            descStatus = 'ok';
        } else if (descLength >= 70) {
            descStatus = 'warning';
            violations.moderate++;
        } else {
            descStatus = 'serious';
            violations.serious++;
        }
    } else {
        descStatus = 'serious';
        violations.serious++;
    }
    checks.push({ label: 'Meta Description', status: descStatus });
    
    // Check 3: H1 Tag
    const h1Tags = doc.querySelectorAll('h1');
    let h1Status = 'fail';
    if (h1Tags.length === 1) {
        h1Status = 'ok';
    } else if (h1Tags.length > 1) {
        h1Status = 'warning';
        violations.moderate++;
    } else {
        h1Status = 'serious';
        violations.serious++;
    }
    checks.push({ label: 'H1 Tag', status: h1Status });
    
    // Check 4: Image Alt Tags
    const images = doc.querySelectorAll('img');
    let imagesWithoutAlt = 0;
    images.forEach(img => {
        if (!img.hasAttribute('alt') || img.getAttribute('alt').trim().length === 0) {
            imagesWithoutAlt++;
        }
    });
    let altStatus = 'ok';
    if (images.length > 0) {
        if (imagesWithoutAlt === 0) {
            altStatus = 'ok';
        } else if (imagesWithoutAlt < images.length) {
            altStatus = 'warning';
            violations.moderate++;
        } else {
            altStatus = 'warning';
            violations.moderate++;
        }
    }
    checks.push({ label: 'Image Alt Tags', status: altStatus });
    
    // Check 5: Content Length (visible text only)
    const visibleText = doc.body ? getVisibleText(doc.body) : '';
    const wordCount = visibleText
        .trim()
        .split(/\s+/)
        .filter(word => word.length > 0)
        .length;

    let contentStatus = 'fail';
    if (wordCount >= 300) {
        contentStatus = 'ok';
    } else if (wordCount >= 150) {
        contentStatus = 'warning';
        violations.moderate++;
    } else {
        contentStatus = 'serious';
        violations.serious++;
    }
    checks.push({ label: 'Content Length', status: contentStatus });
    
    // Check 6: Internal Links
    const anchors = doc.querySelectorAll('a');
    let internalLinks = 0;
    anchors.forEach(a => {
        const href = a.getAttribute('href');
        if (href && !href.startsWith('http') && !href.startsWith('#') && !href.startsWith('javascript:')) {
            internalLinks++;
        }
    });
    let linkStatus = 'ok';
    if (internalLinks < 3) {
        linkStatus = 'warning';
        violations.moderate++;
    }
    checks.push({ label: 'Internal Links', status: linkStatus });
    
    // Check 7: Canonical Tag
    const canonical = doc.querySelector('link[rel="canonical"]');
    const canonicalStatus = canonical && canonical.getAttribute('href') ? 'ok' : 'warning';
    if (canonicalStatus === 'warning') {
        violations.moderate++;
    }
    checks.push({ label: 'Canonical Tag', status: canonicalStatus });
    
    // Check 8: Open Graph Tags
    const ogTitle = doc.querySelector('meta[property="og:title"]');
    const ogDescription = doc.querySelector('meta[property="og:description"]');
    const ogImage = doc.querySelector('meta[property="og:image"]');
    let ogStatus = 'fail';
    const ogCount = [ogTitle, ogDescription, ogImage].filter(el => el).length;
    if (ogCount === 3) {
        ogStatus = 'ok';
    } else if (ogCount > 0) {
        ogStatus = 'minor';
        violations.minor++;
    } else {
        ogStatus = 'minor';
        violations.minor++;
    }
    checks.push({ label: 'Open Graph', status: ogStatus });
    
    // Calculate SEO score
    let score = 100;
    score -= violations.critical * 18;
    score -= violations.serious * 12;
    score -= violations.moderate * 7;
    score -= violations.minor * 4;
    score = Math.max(0, Math.min(100, Math.round(score)));
    
    // If perfect, cap at 98
    if (violations.critical === 0 && violations.serious === 0 && violations.moderate === 0 && violations.minor === 0) {
        score = 98;
    }
    
    return {
        checks,
        score,
        criticalCount: violations.critical,
        seriousCount: violations.serious,
        warningCount: violations.moderate + violations.minor,
        wordCount,
        internalLinks,
        missingAlt: imagesWithoutAlt
    };
}

// Fetch sitemap URLs
async function fetchSitemap(sitemapUrl) {
    const response = await fetch(`?api=sitemap&url=${encodeURIComponent(sitemapUrl)}`);
    const data = await response.json();
    
    if (data.error) {
        throw new Error(data.error);
    }
    
    let urls = data.urls || [];

    // Filter out system pages based on path (e.g. /403, /404, /error, /search)
    urls = urls.filter(url => !isSystemPage(url));

    return urls;
}

// Fetch page content
async function fetchPage(pageUrl) {
    try {
        const response = await fetch(`?api=fetch&url=${encodeURIComponent(pageUrl)}`);
        const data = await response.json();
        
        if (data.error) {
            throw new Error(data.error);
        }
        
        return data.html;
    } catch (error) {
        console.error(`Failed to fetch ${pageUrl}:`, error);
        return null;
    }
}

// Scan a single page
async function scanPage(url) {
    const html = await fetchPage(url);
    
    if (!html) {
        return {
            url: url,
            checks: [
                { label: 'Title Tag', status: 'fail' },
                { label: 'Meta Description', status: 'fail' },
                { label: 'H1 Tag', status: 'fail' },
                { label: 'Image Alt Tags', status: 'fail' },
                { label: 'Content Length', status: 'fail' },
                { label: 'Internal Links', status: 'fail' },
                { label: 'Canonical Tag', status: 'fail' },
                { label: 'Open Graph', status: 'fail' }
            ],
            score: 0,
            criticalCount: 8,
            seriousCount: 0,
            warningCount: 0,
            wordCount: 0,
            internalLinks: 0,
            missingAlt: 0
        };
    }
    
    const result = checkPage(html, url);
    return { url, ...result };
}

// Add delay between requests
function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// Generate quick fixes summary
function generateQuickFixesSummary() {
    const issueMap = {};
    
    // Count issues across all pages
    scanResults.forEach(result => {
        result.checks.forEach(check => {
            if (check.status !== 'ok') {
                const key = `${check.label} - ${check.status}`;
                if (!issueMap[key]) {
                    issueMap[key] = {
                        label: check.label,
                        status: check.status,
                        count: 0,
                        pages: []
                    };
                }
                issueMap[key].count++;
                issueMap[key].pages.push(result.url);
            }
        });
    });
    
    // Sort by count (most common first) and severity
    const sortedIssues = Object.values(issueMap).sort((a, b) => {
        const severityOrder = { fail: 0, serious: 1, warning: 2, minor: 3 };
        if (a.count !== b.count) return b.count - a.count;
        return severityOrder[a.status] - severityOrder[b.status];
    });
    
    // Display top issues
    const quickFixesGrid = document.getElementById('quick-fixes-grid');
    const quickFixesContainer = document.getElementById('quick-fixes-container');
    quickFixesGrid.innerHTML = '';
    
    if (sortedIssues.length === 0) {
        quickFixesContainer.classList.remove('show');
        return;
    }
    
    quickFixesContainer.classList.add('show');
    
    // Show top 6 most common issues
    sortedIssues.slice(0, 6).forEach(issue => {
        const key = `${issue.label} - ${issue.status}`;
        const suggestion = fixSuggestions[key];
        
        if (!suggestion) return;
        
        const severityClass = issue.status === 'fail' ? '' : 
                             issue.status === 'serious' ? 'serious' : 'moderate';
        
        const card = document.createElement('div');
        card.className = `quick-fix-card ${severityClass}`;
        card.innerHTML = `
            <div class="quick-fix-header">
                <h3 class="quick-fix-title">${escapeHtml(issue.label)}</h3>
                <span class="quick-fix-count">${issue.count} page${issue.count > 1 ? 's' : ''}</span>
            </div>
            <p class="quick-fix-description">${suggestion.description}</p>
            <div class="quick-fix-suggestion">
                <strong>Quick Fix:</strong> ${suggestion.quickFix}
            </div>
            <button class="btn-view-details btn-small" onclick="showFixSuggestion('${escapeHtml(issue.label)}', '${issue.status}')">
                View Full Guide
            </button>
        `;
        
        quickFixesGrid.appendChild(card);
    });
}

// Start the scan
async function startScan() {
    const scanBtn = document.getElementById('scan-btn');
    const resultsContainer = document.getElementById('results-container');
    const quickFixesContainer = document.getElementById('quick-fixes-container');
    
    // Reset
    scanResults = [];
    scannedPages = 0;
    totalIssues = 0;
    totalWarnings = 0;
    resultsContainer.classList.remove('show');
    quickFixesContainer.classList.remove('show');
    
    // Disable button
    scanBtn.disabled = true;
    scanBtn.innerHTML = '<div class="spinner"></div> Scanning...';
    
    try {
        // Fetch sitemap from current site
        showStatus('<div class="spinner"></div> Fetching sitemap from ' + sitemapUrl + '...', 'loading');
        const urls = await fetchSitemap(sitemapUrl);
        
        if (!urls || urls.length === 0) {
            throw new Error('No URLs found in sitemap (after excluding system pages). Make sure ' + sitemapUrl + ' exists and contains valid URLs.');
        }
        
        totalPages = urls.length;
        showStatus(`<div class="spinner"></div> Found ${totalPages} pages in sitemap. Starting scan...`, 'loading');
        await delay(500);
        
        // Scan each page
        for (let i = 0; i < urls.length; i++) {
            updateProgress(i + 1, totalPages);
            
            const result = await scanPage(urls[i]);
            scanResults.push(result);
            scannedPages++;
            
            // Count critical issues
            totalIssues += result.criticalCount;
            totalWarnings += result.warningCount;
            
            await delay(100);
        }
        
        // Generate quick fixes summary
        generateQuickFixesSummary();
        
        // Show results
        displayResults();
        showStatus('Scan complete! Analyzed ' + scannedPages + ' pages from your sitemap (system pages excluded).', 'success');
        setTimeout(hideStatus, 3000);
        
    } catch (error) {
        showStatus(`Error: ${error.message}`, 'error');
    } finally {
        scanBtn.disabled = false;
        scanBtn.innerHTML = '<span>Scan All Pages</span>';
        document.getElementById('progress-bar').style.display = 'none';
    }
}

// Display results in table
function displayResults() {
    const resultsContainer = document.getElementById('results-container');
    const tbody = document.getElementById('results-tbody');
    
    // Calculate aggregate stats
    let totalScore = 0;
    let optimizedCount = 0;
    
    scanResults.forEach(result => {
        totalScore += result.score;
        if (result.score >= 90 && result.criticalCount === 0) {
            optimizedCount++;
        }
    });
    
    const avgScore = scannedPages > 0 ? Math.round(totalScore / scannedPages) : 0;
    
    // Update summary stats
    document.getElementById('pages-scanned').textContent = scannedPages;
    document.getElementById('avg-score').textContent = avgScore + '%';
    document.getElementById('total-issues').textContent = totalIssues;
    document.getElementById('optimized-pages').textContent = optimizedCount;
    
    // Clear existing rows
    tbody.innerHTML = '';
    
    // Create rows for each result
    scanResults.forEach((result, index) => {
        const row = document.createElement('tr');
        
        const score = result.score;
        const scoreClass = score >= 90 ? 'seo-score--excellent' : 
                          score >= 75 ? 'seo-score--good' : 
                          score >= 60 ? 'seo-score--fair' : 'seo-score--poor';
        
        const level = score >= 90 && result.criticalCount === 0 ? 'Optimised' :
                     score >= 60 ? 'Needs Improvement' : 'Critical';
        const levelSlug = level.toLowerCase().replace(/ /g, '-');
        
        // Get failed/warning checks
        const issues = result.checks.filter(c => c.status !== 'ok');
        
        // Build issues HTML - badges only, no quick fixes
        let issuesHTML = '';
        if (issues.length === 0) {
            issuesHTML = '<span style="color: #10b981; font-size: 0.875rem; font-weight: 500;">None</span>';
        } else {
            issuesHTML += '<div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">';
            issues.slice(0, 3).forEach(issue => {
                const badgeClass = issue.status === 'fail' ? 'fail' : 
                                  issue.status === 'serious' ? 'serious' : 
                                  issue.status === 'warning' ? 'warning' : 'minor';
                
                issuesHTML += `<span class="issue-badge ${badgeClass}" onclick="showFixSuggestion('${escapeHtml(issue.label)}', '${issue.status}')">${escapeHtml(issue.label)}</span>`;
            });
            if (issues.length > 3) {
                issuesHTML += `<span style="color: #64748b; font-size: 0.75rem; padding: 0.375rem 0;">+${issues.length - 3} more</span>`;
            }
            issuesHTML += '</div>';
        }
        
        row.innerHTML = `
            <td><a href="${escapeHtml(result.url)}" target="_blank" class="page-link">${escapeHtml(result.url)}</a></td>
            <td>
                <div class="score-indicator ${scoreClass}" style="font-size: 1.25rem;">
                    <span class="score-indicator__number">${score}</span><span style="font-size: 0.875rem;">%</span>
                </div>
            </td>
            <td><span class="seo-level-badge level-${levelSlug}">${level}</span></td>
            <td>${result.wordCount}</td>
            <td>${result.internalLinks}</td>
            <td>${result.missingAlt}</td>
            <td>${issuesHTML}</td>
            <td>
                <button class="btn-view-details" onclick="showPageDetails(${index})" aria-label="View details for ${escapeHtml(result.url)}">
                    View Details
                </button>
            </td>
        `;
        
        tbody.appendChild(row);
    });
    
    // Show results
    resultsContainer.classList.add('show');
    document.getElementById('quick-fixes-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

// Show detailed page analysis modal
function showPageDetails(index) {
    const result = scanResults[index];
    if (!result) return;
    
    const modal = document.getElementById('page-details-modal');
    const modalTitle = document.getElementById('detail-modal-title');
    const modalBody = document.getElementById('detail-modal-body');
    
    const score = result.score;
    const scoreClass = score >= 90 ? 'seo-score--excellent' : 
                      score >= 75 ? 'seo-score--good' : 
                      score >= 60 ? 'seo-score--fair' : 'seo-score--poor';
    
    const level = score >= 90 && result.criticalCount === 0 ? 'Optimised' :
                 score >= 60 ? 'Needs Improvement' : 'Critical';
    const levelSlug = level.toLowerCase().replace(/ /g, '-');
    
    modalTitle.textContent = result.url;
    
    let bodyHTML = `
        <div style="display: flex; gap: 1.5rem; align-items: center; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0;">
            <div class="score-indicator ${scoreClass}" style="font-size: 3rem;">
                <span class="score-indicator__number">${score}</span><span style="font-size: 1.5rem;">%</span>
            </div>
            <div>
                <div><span class="seo-level-badge level-${levelSlug}">${level}</span></div>
                <p style="margin: 0.5rem 0 0 0; color: #64748b;">SEO health score: ${score}%. ${result.criticalCount} critical, ${result.warningCount} warnings.</p>
            </div>
        </div>
        
        <h4 style="margin-top: 1.5rem;">Page Metrics</h4>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 2rem;">
            <div style="padding: 1rem; background: #f8fafc;">
                <div style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; margin-bottom: 0.25rem;">Word Count</div>
                <div style="font-size: 1.5rem; font-weight: 600;">${result.wordCount}</div>
            </div>
            <div style="padding: 1rem; background: #f8fafc;">
                <div style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; margin-bottom: 0.25rem;">Internal Links</div>
                <div style="font-size: 1.5rem; font-weight: 600;">${result.internalLinks}</div>
            </div>
            <div style="padding: 1rem; background: #f8fafc;">
                <div style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; margin-bottom: 0.25rem;">Missing Alt Tags</div>
                <div style="font-size: 1.5rem; font-weight: 600;">${result.missingAlt}</div>
            </div>
        </div>
        
        <h4>Issues & Recommended Fixes</h4>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
    `;
    
    const issues = result.checks.filter(c => c.status !== 'ok');
    
    if (issues.length === 0) {
        bodyHTML += '<p style="color: #10b981; padding: 1rem; background: #ecfdf5; text-align: center; font-weight: 500;">No issues detected - this page is fully optimized!</p>';
    } else {
        issues.forEach(issue => {
            const key = `${issue.label} - ${issue.status}`;
            const suggestion = fixSuggestions[key];
            const badgeClass = issue.status === 'fail' ? 'fail' : 
                              issue.status === 'serious' ? 'serious' : 
                              issue.status === 'warning' ? 'warning' : 'minor';
            const impactLabel = issue.status === 'fail' ? 'Critical' :
                               issue.status === 'serious' ? 'Serious' :
                               issue.status === 'warning' ? 'Moderate' : 'Minor';
            const borderColor = badgeClass === 'fail' || badgeClass === 'serious' ? '#ef4444' : 
                               badgeClass === 'warning' ? '#f59e0b' : '#3b82f6';
            
            bodyHTML += `
                <div style="padding: 1rem; background: #f8fafc; border-left: 4px solid ${borderColor};">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.75rem;">
                        <strong style="color: #1e293b;">${escapeHtml(issue.label)}</strong>
                        <span class="issue-badge ${badgeClass}">${impactLabel}</span>
                    </div>
                    ${suggestion ? `
                        <div style="background: white; padding: 0.75rem;">
                            <div style="font-size: 0.875rem; color: #64748b; margin-bottom: 0.5rem;">${suggestion.description}</div>
                            <div style="font-size: 0.875rem; color: #2EB7A0; font-weight: 500; padding: 0.5rem; background: #f0fdfa; border-left: 3px solid #2EB7A0;">
                                <strong>Quick Fix:</strong> ${suggestion.quickFix}
                            </div>
                        </div>
                        
                    ` : ''}
                </div>
            `;
        });
    }
    
    bodyHTML += '</div>';
    
    modalBody.innerHTML = bodyHTML;
    modal.classList.add('show');
}

// Close page details modal
function closePageDetails() {
    const modal = document.getElementById('page-details-modal');
    modal.classList.remove('show');
}

// Helper function to escape HTML
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Export to CSV
function exportToCSV() {
    if (scanResults.length === 0) {
        showStatus('No results to export', 'error');
        setTimeout(hideStatus, 2000);
        return;
    }
    
    let csv = 'URL,Score,Status,Title Tag,Meta Description,H1 Tag,Image Alt Tags,Content Length,Internal Links,Canonical Tag,Open Graph\n';
    
    scanResults.forEach(result => {
        const status = result.score >= 90 ? 'Optimised' : result.score >= 60 ? 'Needs Improvement' : 'Critical';
        const row = [
            result.url,
            result.score + '%',
            status,
            ...result.checks.map(check => {
                if (check.status === 'ok') return 'Pass';
                if (check.status === 'warning' || check.status === 'minor') return 'Warning';
                if (check.status === 'serious') return 'Serious';
                return 'Fail';
            })
        ];
        csv += row.map(cell => `"${cell}"`).join(',') + '\n';
    });
    
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `seo-audit-${new Date().toISOString().split('T')[0]}.csv`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
    
    showStatus('CSV exported successfully!', 'success');
    setTimeout(hideStatus, 2000);
}
</script>

<script type="text/javascript">
jQuery(function() {
    setTimeout(function() {
        // mwWindow('wPages').show();
    }, 500);
});
</script>
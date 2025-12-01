<?php
// views/metadata/desktop.php: Template for metadata analyzer tool
$mwLoad->Window( 'wMetadata', 'metadata/index' );

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

// API endpoint to fetch page content
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
            'user_agent' => 'Metadata Analyzer Tool/1.0'
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
.metadata-main * {
    box-sizing: border-box;
}

.metadata-main {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 0;
}

.metadata-main .app-content {
    max-width: 100%;
    margin: 0 auto;
    padding: 0;
}

.metadata-main .container {
    width: 100%;
}

/* Hero Section */
.metadata-main .hero {
    background: #2EB7A0;
    color: white;
    padding: 3rem 2rem;
    margin-bottom: 2rem;
}

.metadata-main .hero-content {
    margin: 0 auto 2rem;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 2rem;
}

.metadata-main .hero-eyebrow {
    display: inline-block;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.25rem 0.75rem;
    margin-bottom: 0.5rem;
}

.metadata-main .hero-title {
    font-size: 2rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
}

.metadata-main .hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.95;
    margin: 0;
    line-height: 1.5;
}

.metadata-main .hero-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.75rem;
}

/* Overview Cards */
.metadata-main .overview-grid {
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
}

.metadata-main .overview-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 1.5rem;
    text-align: center;
}

.metadata-main .overview-value {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    line-height: 1;
}

.metadata-main .overview-label {
    font-size: 0.875rem;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 500;
}

/* Buttons */
.metadata-main .btn {
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

.metadata-main .btn-primary {
    background: white;
    color: #2EB7A0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.metadata-main .btn-primary:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.metadata-main .btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.metadata-main .btn-export {
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

.metadata-main .btn-export:hover {
    background: #259887;
    transform: translateY(-1px);
}

.metadata-main .btn-view-details {
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

.metadata-main .btn-view-details:hover {
    background: #259887;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(46, 183, 160, 0.2);
}

/* Status Messages */
.metadata-main .status {
    display: none;
    padding: 1rem;
    margin: 1rem 2rem;
    text-align: center;
}

.metadata-main .status.show {
    display: block;
}

.metadata-main .status.loading {
    background: #e3f2fd;
    color: #1976d2;
    border: 1px solid #90caf9;
}

.metadata-main .status.error {
    background: #ffebee;
    color: #c62828;
    border: 1px solid #ef9a9a;
}

.metadata-main .status.success {
    background: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #a5d6a7;
}

.metadata-main .spinner {
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
.metadata-main .progress-bar {
    margin: 1.5rem auto 0;
    height: 8px;
    background: rgba(255, 255, 255, 0.3);
    overflow: hidden;
}

.metadata-main .progress-fill {
    height: 100%;
    background: white;
    width: 0%;
    transition: width 0.3s ease;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

/* Results Container */
.metadata-main .results-container {
    display: none;
    margin: 0 auto;
    padding: 0 2rem 2rem;
}

.metadata-main .results-container.show {
    display: block;
}

/* Cards */
.metadata-main .card {
    background: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    padding: 2rem;
    margin-bottom: 2rem;
}

.metadata-main .card h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a202c;
    margin: 0 0 1.5rem 0;
}

/* Legend */
.metadata-main .legend {
    display: flex;
    gap: 2rem;
    padding: 1rem 1.5rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    margin-bottom: 1.5rem;
}

.metadata-main .legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #64748b;
}

.metadata-main .legend-color {
    width: 1rem;
    height: 1rem;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.metadata-main .legend-color.green {
    background: #10b981;
}

.metadata-main .legend-color.yellow {
    background: #f59e0b;
}

.metadata-main .legend-color.red {
    background: #ef4444;
}

/* Table */
.metadata-main .table-wrapper {
    overflow-x: auto;
    margin-top: 1rem;
    border: 1px solid #e2e8f0;
    background: white;
}

.metadata-main table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}

.metadata-main thead {
    background: #f8fafc;
    border-bottom: 2px solid #e2e8f0;
}

.metadata-main th {
    padding: 1.25rem 1.5rem;
    text-align: left;
    font-weight: 600;
    color: #1e293b;
    font-size: 0.8125rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    white-space: nowrap;
}

.metadata-main td {
    padding: 1.5rem;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: top;
}

.metadata-main tbody tr {
    transition: background 0.15s;
}

.metadata-main tbody tr:hover {
    background: #fafbfc;
}

.metadata-main tbody tr:last-child td {
    border-bottom: none;
}

.metadata-main .page-link {
    color: #2EB7A0;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
    display: block;
    max-width: 400px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 0.9rem;
}

.metadata-main .page-link:hover {
    color: #259887;
    text-decoration: underline;
}

.metadata-main .status-badge {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.metadata-main .status-perfect {
    background: #d1fae5;
    color: #065f46;
}

.metadata-main .status-good {
    background: #dbeafe;
    color: #1e40af;
}

.metadata-main .status-warning {
    background: #fef3c7;
    color: #92400e;
}

.metadata-main .status-poor {
    background: #fee2e2;
    color: #991b1b;
}

.metadata-main .issue-count {
    color: #ef4444;
    font-weight: 600;
}

/* Modal */
.metadata-main .modal {
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

.metadata-main .modal.show {
    display: flex;
    align-items: center;
    justify-content: center;
}

.metadata-main .modal-content {
    background-color: white;
    margin: 2rem;
    padding: 2.5rem 2.5rem 2rem;
    width: 90%;
    max-width: 900px;
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

.metadata-main .modal-close {
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

.metadata-main .modal-close:hover {
    background: #e2e8f0;
    color: #1e293b;
    transform: scale(1.1);
}

.metadata-main #modal-title {
    margin: 0 0 0.75rem 0;
    padding-right: 2.75rem;
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a202c;
}

.metadata-main #modal-body {
    margin-top: 1.5rem;
    line-height: 1.6;
    color: #475569;
}

.metadata-main .search-preview {
    background: white;
    border: 1px solid #e2e8f0;
    padding: 1.5rem;
    margin: 1.5rem 0;
    font-family: Arial, sans-serif;
}

.metadata-main .search-preview-title {
    color: #1a0dab;
    font-size: 1.25rem;
    font-weight: normal;
    margin: 0 0 0.25rem 0;
    text-decoration: none;
    cursor: pointer;
}

.metadata-main .search-preview-title:hover {
    text-decoration: underline;
}

.metadata-main .search-preview-url {
    color: #006621;
    font-size: 0.875rem;
    margin: 0 0 0.5rem 0;
}

.metadata-main .search-preview-description {
    color: #545454;
    font-size: 0.875rem;
    line-height: 1.57;
    margin: 0;
}

.metadata-main .meta-section {
    margin: 2rem 0;
}

.metadata-main .meta-section h4 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 1rem 0;
}

.metadata-main .meta-item {
    padding: 1rem;
    background: #f8fafc;
    border-left: 3px solid #2EB7A0;
    margin-bottom: 1rem;
}

.metadata-main .meta-item.missing {
    background: #fef2f2;
    border-left-color: #ef4444;
}

.metadata-main .meta-item.warning {
    background: #fffbeb;
    border-left-color: #f59e0b;
}

.metadata-main .meta-label {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.metadata-main .meta-value {
    color: #475569;
    font-size: 0.9rem;
    word-break: break-word;
}

.metadata-main .meta-length {
    font-size: 0.8125rem;
    color: #64748b;
    margin-top: 0.25rem;
}

.metadata-main .meta-length.good {
    color: #10b981;
}

.metadata-main .meta-length.warning {
    color: #f59e0b;
}

.metadata-main .meta-length.error {
    color: #ef4444;
}

.metadata-main .duplicate-warning {
    background: #fef3c7;
    border: 1px solid #fcd34d;
    padding: 1rem;
    margin: 1rem 0;
    color: #92400e;
    font-size: 0.9rem;
}
</style>

<div class="mwDskTools">
  <h1>Meta Data Analyzer</h1>
</div>

<div class="mwDesktop">
  <main class="metadata-main">
    <div class="app-content">
      <div class="container">
        
        <div class="hero">
          <div class="hero-content">
            <div>
              <span class="hero-eyebrow">SEO Meta Tags</span>
              <h2 class="hero-title">Meta Data Analyzer</h2>
              <p class="hero-subtitle">Analyze meta tags, validate lengths, find duplicates, and preview search results.</p>
            </div>
            <div class="hero-actions">
              <button type="button" id="scan-btn" class="btn btn-primary" onclick="startScan()">
                <span>Analyze All Pages</span>
              </button>
            </div>
          </div>
          
          <div class="overview-grid">
            <div class="overview-card">
              <div class="overview-value" id="pages-scanned">0</div>
              <div class="overview-label">Pages Scanned</div>
            </div>
            <div class="overview-card">
              <div class="overview-value" id="perfect-meta">0</div>
              <div class="overview-label">Perfect Meta</div>
            </div>
            <div class="overview-card">
              <div class="overview-value" id="missing-meta">0</div>
              <div class="overview-label">Missing Meta</div>
            </div>
            <div class="overview-card">
              <div class="overview-value" id="duplicate-meta">0</div>
              <div class="overview-label">Duplicates</div>
            </div>
          </div>
          
          <div class="progress-bar" id="progress-bar" style="display: none;">
            <div class="progress-fill" id="progress-fill"></div>
          </div>
        </div>

        <div id="status" class="status"></div>

        <div class="results-container" id="results-container">
          <div class="card">
            <h2>Meta Data Analysis Results</h2>
            <button class="btn-export" onclick="exportToCSV()">
              Export CSV
            </button>
            
            <div class="legend">
              <div class="legend-item">
                <div class="legend-color green"></div>
                <span>Perfect (All meta optimized)</span>
              </div>
              <div class="legend-item">
                <div class="legend-color yellow"></div>
                <span>Warning (Length issues)</span>
              </div>
              <div class="legend-item">
                <div class="legend-color red"></div>
                <span>Poor (Missing meta)</span>
              </div>
            </div>
            
            <div class="table-wrapper">
              <table id="results-table">
                <thead>
                  <tr>
                    <th>URL</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
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

    <!-- Modal for details -->
    <div id="details-modal" class="modal" onclick="closeModalOnBackground(event)">
      <div class="modal-content">
        <button class="modal-close" onclick="closeModal()" aria-label="Close">
          ×
        </button>
        <h3 id="modal-title"></h3>
        <div id="modal-body"></div>
      </div>
    </div>
  </main>
</div>

<script>
// Global variables
let scanResults = [];
let totalPages = 0;
let scannedPages = 0;
let perfectMeta = 0;
let missingMeta = 0;
let duplicateMeta = 0;
const sitemapUrl = '<?php echo addslashes($default_sitemap_url); ?>';

// System paths to ignore
const SYSTEM_PATHS = ['/403', '/404', '/error', '/search'];

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
        `<div class="spinner"></div> Analyzing page ${current} of ${total} (${percentage}%)...`,
        'loading'
    );
}

// Helper: is this URL one of our system pages?
function isSystemPage(url) {
    try {
        const u = new URL(url);
        let path = u.pathname || '/';
        path = path.replace(/\/+$/, '') || '/';
        return SYSTEM_PATHS.includes(path);
    } catch (e) {
        let path = url.split('?')[0];
        path = path.replace(/\/+$/, '') || '/';
        return SYSTEM_PATHS.includes(path);
    }
}

// Fetch sitemap URLs
async function fetchSitemap(sitemapUrl) {
    const response = await fetch(`?api=sitemap&url=${encodeURIComponent(sitemapUrl)}`);
    const data = await response.json();
    
    if (data.error) {
        throw new Error(data.error);
    }
    
    let urls = data.urls || [];
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

// Analyze page metadata
function analyzeMetadata(html, url) {
    const parser = new DOMParser();
    const doc = parser.parseFromString(html, 'text/html');
    
    const issues = [];
    const metadata = {};
    
    // Get Title
    const titleTag = doc.querySelector('title');
    metadata.title = titleTag ? titleTag.textContent.trim() : '';
    metadata.titleLength = metadata.title.length;
    
    if (!metadata.title) {
        issues.push('Missing title tag');
    } else if (metadata.titleLength < 30) {
        issues.push('Title too short (< 30 chars)');
    } else if (metadata.titleLength > 60) {
        issues.push('Title too long (> 60 chars)');
    }
    
    // Get Meta Description
    const descTag = doc.querySelector('meta[name="description"]');
    metadata.description = descTag ? descTag.getAttribute('content').trim() : '';
    metadata.descriptionLength = metadata.description.length;
    
    if (!metadata.description) {
        issues.push('Missing meta description');
    } else if (metadata.descriptionLength < 120) {
        issues.push('Description too short (< 120 chars)');
    } else if (metadata.descriptionLength > 160) {
        issues.push('Description too long (> 160 chars)');
    }
    
    // Get Meta Keywords (deprecated but still check)
    const keywordsTag = doc.querySelector('meta[name="keywords"]');
    metadata.keywords = keywordsTag ? keywordsTag.getAttribute('content').trim() : '';
    
    // Get Open Graph Tags
    metadata.ogTitle = doc.querySelector('meta[property="og:title"]')?.getAttribute('content') || '';
    metadata.ogDescription = doc.querySelector('meta[property="og:description"]')?.getAttribute('content') || '';
    metadata.ogImage = doc.querySelector('meta[property="og:image"]')?.getAttribute('content') || '';
    metadata.ogUrl = doc.querySelector('meta[property="og:url"]')?.getAttribute('content') || '';
    metadata.ogType = doc.querySelector('meta[property="og:type"]')?.getAttribute('content') || '';
    
    let ogMissing = 0;
    if (!metadata.ogTitle) ogMissing++;
    if (!metadata.ogDescription) ogMissing++;
    if (!metadata.ogImage) ogMissing++;
    
    if (ogMissing > 0) {
        issues.push(`Missing ${ogMissing} Open Graph tag${ogMissing > 1 ? 's' : ''}`);
    }
    
    // Get Canonical
    const canonicalTag = doc.querySelector('link[rel="canonical"]');
    metadata.canonical = canonicalTag ? canonicalTag.getAttribute('href') : '';
    
    if (!metadata.canonical) {
        issues.push('Missing canonical tag');
    }
    
    // Get Robots
    const robotsTag = doc.querySelector('meta[name="robots"]');
    metadata.robots = robotsTag ? robotsTag.getAttribute('content') : '';
    
    // Determine status
    let status = 'perfect';
    if (issues.length === 0) {
        status = 'perfect';
    } else if (issues.some(i => i.includes('Missing'))) {
        status = 'poor';
    } else {
        status = 'warning';
    }
    
    return {
        url,
        metadata,
        issues,
        status,
        issueCount: issues.length
    };
}

// Scan a single page
async function scanPage(url) {
    const html = await fetchPage(url);
    
    if (!html) {
        return {
            url: url,
            metadata: {
                title: '',
                titleLength: 0,
                description: '',
                descriptionLength: 0
            },
            issues: ['Failed to load page'],
            status: 'poor',
            issueCount: 1
        };
    }
    
    return analyzeMetadata(html, url);
}

// Add delay between requests
function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// Find duplicates
function findDuplicates() {
    const titleMap = new Map();
    const descMap = new Map();
    
    scanResults.forEach(result => {
        if (result.metadata.title) {
            if (!titleMap.has(result.metadata.title)) {
                titleMap.set(result.metadata.title, []);
            }
            titleMap.get(result.metadata.title).push(result.url);
        }
        
        if (result.metadata.description) {
            if (!descMap.has(result.metadata.description)) {
                descMap.set(result.metadata.description, []);
            }
            descMap.get(result.metadata.description).push(result.url);
        }
    });
    
    // Mark duplicates
    scanResults.forEach(result => {
        const titleUrls = titleMap.get(result.metadata.title) || [];
        const descUrls = descMap.get(result.metadata.description) || [];
        
        result.duplicateTitleWith = titleUrls.length > 1 ? titleUrls.filter(u => u !== result.url) : [];
        result.duplicateDescWith = descUrls.length > 1 ? descUrls.filter(u => u !== result.url) : [];
        
        if (result.duplicateTitleWith.length > 0 || result.duplicateDescWith.length > 0) {
            duplicateMeta++;
        }
    });
}

// Start the scan
async function startScan() {
    const scanBtn = document.getElementById('scan-btn');
    const resultsContainer = document.getElementById('results-container');
    
    // Reset
    scanResults = [];
    scannedPages = 0;
    perfectMeta = 0;
    missingMeta = 0;
    duplicateMeta = 0;
    resultsContainer.classList.remove('show');
    
    // Disable button
    scanBtn.disabled = true;
    scanBtn.innerHTML = '<div class="spinner"></div> Analyzing...';
    
    try {
        // Fetch sitemap
        showStatus('<div class="spinner"></div> Fetching sitemap from ' + sitemapUrl + '...', 'loading');
        const urls = await fetchSitemap(sitemapUrl);
        
        if (!urls || urls.length === 0) {
            throw new Error('No URLs found in sitemap. Make sure ' + sitemapUrl + ' exists and contains valid URLs.');
        }
        
        totalPages = urls.length;
        showStatus(`<div class="spinner"></div> Found ${totalPages} pages. Starting analysis...`, 'loading');
        await delay(500);
        
        // Scan each page
        for (let i = 0; i < urls.length; i++) {
            updateProgress(i + 1, totalPages);
            
            const result = await scanPage(urls[i]);
            scanResults.push(result);
            scannedPages++;
            
            if (result.status === 'perfect') {
                perfectMeta++;
            } else if (result.status === 'poor') {
                missingMeta++;
            }
            
            await delay(100);
        }
        
        // Find duplicates
        findDuplicates();
        
        // Show results
        displayResults();
        showStatus('Scan complete! Analyzed ' + scannedPages + ' pages.', 'success');
        setTimeout(hideStatus, 3000);
        
    } catch (error) {
        showStatus(`Error: ${error.message}`, 'error');
    } finally {
        scanBtn.disabled = false;
        scanBtn.innerHTML = '<span>Analyze All Pages</span>';
        document.getElementById('progress-bar').style.display = 'none';
    }
}

// Display results in table
function displayResults() {
    const resultsContainer = document.getElementById('results-container');
    const tbody = document.getElementById('results-tbody');
    
    // Update summary stats
    document.getElementById('pages-scanned').textContent = scannedPages;
    document.getElementById('perfect-meta').textContent = perfectMeta;
    document.getElementById('missing-meta').textContent = missingMeta;
    document.getElementById('duplicate-meta').textContent = duplicateMeta;
    
    // Clear existing rows
    tbody.innerHTML = '';
    
    // Create rows
    scanResults.forEach((result, index) => {
        const row = document.createElement('tr');
        
        const statusClass = result.status === 'perfect' ? 'status-perfect' : 
                           result.status === 'warning' ? 'status-warning' : 'status-poor';
        
        const statusText = result.status === 'perfect' ? 'Perfect' : 
                          result.status === 'warning' ? 'Warning' : 'Poor';
        
        const titlePreview = result.metadata.title ? 
            (result.metadata.title.substring(0, 50) + (result.metadata.title.length > 50 ? '...' : '')) : 
            '(missing)';
        
        const descPreview = result.metadata.description ? 
            (result.metadata.description.substring(0, 60) + (result.metadata.description.length > 60 ? '...' : '')) : 
            '(missing)';
        
        row.innerHTML = `
            <td><a href="${escapeHtml(result.url)}" target="_blank" class="page-link">${escapeHtml(result.url)}</a></td>
            <td>${escapeHtml(titlePreview)}<br><small style="color: #64748b;">${result.metadata.titleLength} chars</small></td>
            <td>${escapeHtml(descPreview)}<br><small style="color: #64748b;">${result.metadata.descriptionLength} chars</small></td>
            <td><span class="status-badge ${statusClass}">${statusText}</span></td>
            <td>${result.issueCount > 0 ? `<span class="issue-count">${result.issueCount}</span>` : '0'}</td>
            <td>
                <button class="btn-view-details" onclick="showDetails(${index})">
                    View Details
                </button>
            </td>
        `;
        
        tbody.appendChild(row);
    });
    
    resultsContainer.classList.add('show');
}

// Show details modal
function showDetails(index) {
    const result = scanResults[index];
    if (!result) return;
    
    const modal = document.getElementById('details-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalBody = document.getElementById('modal-body');
    
    modalTitle.textContent = result.url;
    
    let bodyHTML = '';
    
    // Search Preview
    bodyHTML += `
        <h4 style="margin-top: 0;">Google Search Preview</h4>
        <div class="search-preview">
            <div class="search-preview-title">${escapeHtml(result.metadata.title || 'No title')}</div>
            <div class="search-preview-url">${escapeHtml(result.url)}</div>
            <div class="search-preview-description">${escapeHtml(result.metadata.description || 'No meta description provided.')}</div>
        </div>
    `;
    
    // Duplicate warnings
    if (result.duplicateTitleWith.length > 0) {
        bodyHTML += `
            <div class="duplicate-warning">
                <strong>Duplicate Title:</strong> This title is also used on ${result.duplicateTitleWith.length} other page${result.duplicateTitleWith.length > 1 ? 's' : ''}
            </div>
        `;
    }
    
    if (result.duplicateDescWith.length > 0) {
        bodyHTML += `
            <div class="duplicate-warning">
                <strong>Duplicate Description:</strong> This description is also used on ${result.duplicateDescWith.length} other page${result.duplicateDescWith.length > 1 ? 's' : ''}
            </div>
        `;
    }
    
    // Basic Meta Tags
    bodyHTML += `
        <div class="meta-section">
            <h4>Basic Meta Tags</h4>
    `;
    
    // Title
    const titleClass = !result.metadata.title ? 'missing' : 
                      (result.metadata.titleLength < 30 || result.metadata.titleLength > 60) ? 'warning' : '';
    const titleLengthClass = result.metadata.titleLength >= 30 && result.metadata.titleLength <= 60 ? 'good' : 
                            result.metadata.titleLength > 0 ? 'warning' : 'error';
    
    bodyHTML += `
        <div class="meta-item ${titleClass}">
            <div class="meta-label">Title Tag</div>
            <div class="meta-value">${escapeHtml(result.metadata.title || '(missing)')}</div>
            <div class="meta-length ${titleLengthClass}">${result.metadata.titleLength} characters (recommended: 30-60)</div>
        </div>
    `;
    
    // Description
    const descClass = !result.metadata.description ? 'missing' : 
                     (result.metadata.descriptionLength < 120 || result.metadata.descriptionLength > 160) ? 'warning' : '';
    const descLengthClass = result.metadata.descriptionLength >= 120 && result.metadata.descriptionLength <= 160 ? 'good' : 
                           result.metadata.descriptionLength > 0 ? 'warning' : 'error';
    
    bodyHTML += `
        <div class="meta-item ${descClass}">
            <div class="meta-label">Meta Description</div>
            <div class="meta-value">${escapeHtml(result.metadata.description || '(missing)')}</div>
            <div class="meta-length ${descLengthClass}">${result.metadata.descriptionLength} characters (recommended: 120-160)</div>
        </div>
    `;
    
    // Canonical
    bodyHTML += `
        <div class="meta-item ${!result.metadata.canonical ? 'missing' : ''}">
            <div class="meta-label">Canonical URL</div>
            <div class="meta-value">${escapeHtml(result.metadata.canonical || '(missing)')}</div>
        </div>
    `;
    
    bodyHTML += `</div>`;
    
    // Open Graph Tags
    bodyHTML += `
        <div class="meta-section">
            <h4>Open Graph Tags (Facebook/LinkedIn)</h4>
    `;
    
    bodyHTML += `
        <div class="meta-item ${!result.metadata.ogTitle ? 'missing' : ''}">
            <div class="meta-label">og:title</div>
            <div class="meta-value">${escapeHtml(result.metadata.ogTitle || '(missing)')}</div>
        </div>
        <div class="meta-item ${!result.metadata.ogDescription ? 'missing' : ''}">
            <div class="meta-label">og:description</div>
            <div class="meta-value">${escapeHtml(result.metadata.ogDescription || '(missing)')}</div>
        </div>
        <div class="meta-item ${!result.metadata.ogImage ? 'missing' : ''}">
            <div class="meta-label">og:image</div>
            <div class="meta-value">${escapeHtml(result.metadata.ogImage || '(missing)')}</div>
        </div>
    `;
    
    bodyHTML += `</div>`;
    
    // Issues Summary
    if (result.issues.length > 0) {
        bodyHTML += `
            <div class="meta-section">
                <h4>Issues Found (${result.issues.length})</h4>
        `;
        
        result.issues.forEach(issue => {
            bodyHTML += `
                <div class="meta-item warning">
                    <div class="meta-value">${escapeHtml(issue)}</div>
                </div>
            `;
        });
        
        bodyHTML += `</div>`;
    }
    
    modalBody.innerHTML = bodyHTML;
    modal.classList.add('show');
}

// Close modal
function closeModal() {
    const modal = document.getElementById('details-modal');
    modal.classList.remove('show');
}

// Close modal when clicking on background
function closeModalOnBackground(event) {
    if (event.target === event.currentTarget) {
        closeModal();
    }
}

// Close modal with escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.getElementById('details-modal').classList.remove('show');
    }
});

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
    
    let csv = 'URL,Title,Title Length,Description,Description Length,Status,Issues,Has Duplicates\n';
    
    scanResults.forEach(result => {
        const hasDuplicates = (result.duplicateTitleWith.length > 0 || result.duplicateDescWith.length > 0) ? 'Yes' : 'No';
        
        const row = [
            result.url,
            result.metadata.title,
            result.metadata.titleLength,
            result.metadata.description,
            result.metadata.descriptionLength,
            result.status,
            result.issueCount,
            hasDuplicates
        ];
        csv += row.map(cell => `"${cell}"`).join(',') + '\n';
    });
    
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `metadata-analysis-${new Date().toISOString().split('T')[0]}.csv`;
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
        // mwWindow('wMetadata').show();
    }, 500);
});
</script>
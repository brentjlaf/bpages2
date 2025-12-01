<?php
// views/link-checker/desktop.php: Template for link checking tool
$mwLoad->Window( 'wLinkChecker', 'link-checker/index' );

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
            'user_agent' => 'Link Checker Tool/1.0'
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

// API endpoint to check if a link is valid
if (isset($_GET['api']) && $_GET['api'] === 'check-link') {
    header('Content-Type: application/json');
    
    $link_url = isset($_GET['url']) ? $_GET['url'] : '';
    
    if (empty($link_url)) {
        echo json_encode(['error' => 'No link URL provided']);
        exit;
    }
    
    $context = stream_context_create([
        'http' => [
            'timeout' => 5,
            'user_agent' => 'Link Checker Tool/1.0',
            'method' => 'HEAD'
        ]
    ]);
    
    $headers = @get_headers($link_url, 1, $context);
    
    if ($headers === false) {
        echo json_encode(['status' => 0, 'message' => 'Failed to connect']);
        exit;
    }
    
    $status_line = $headers[0];
    preg_match('/HTTP\/\d\.\d\s+(\d+)/', $status_line, $matches);
    $status_code = isset($matches[1]) ? (int)$matches[1] : 0;
    
    echo json_encode(['status' => $status_code]);
    exit;
}

// Get current site URL for default sitemap
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$default_sitemap_url = $protocol . '://' . $host . '/sitemap.xml';
$site_domain = $host;
?>
<style>
.link-checker-main * {
    box-sizing: border-box;
}

.link-checker-main {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 0;
}

.link-checker-main .app-content {
    max-width: 100%;
    margin: 0 auto;
    padding: 0;
}

.link-checker-main .container {
    width: 100%;
}

/* Hero Section */
.link-checker-main .hero {
    background: #2EB7A0;
    color: white;
    padding: 3rem 2rem;
    margin-bottom: 2rem;
}

.link-checker-main .hero-content {
    margin: 0 auto 2rem;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 2rem;
}

.link-checker-main .hero-eyebrow {
    display: inline-block;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.25rem 0.75rem;
    margin-bottom: 0.5rem;
}

.link-checker-main .hero-title {
    font-size: 2rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
}

.link-checker-main .hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.95;
    margin: 0;
    line-height: 1.5;
}

.link-checker-main .hero-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.75rem;
}

/* Overview Cards */
.link-checker-main .overview-grid {
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
}

.link-checker-main .overview-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 1.5rem;
    text-align: center;
}

.link-checker-main .overview-value {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    line-height: 1;
}

.link-checker-main .overview-label {
    font-size: 0.875rem;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 500;
}

/* Buttons */
.link-checker-main .btn {
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

.link-checker-main .btn-primary {
    background: white;
    color: #2EB7A0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.link-checker-main .btn-primary:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.link-checker-main .btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.link-checker-main .btn-export {
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

.link-checker-main .btn-export:hover {
    background: #259887;
    transform: translateY(-1px);
}

/* Status Messages */
.link-checker-main .status {
    display: none;
    padding: 1rem;
    margin: 1rem 2rem;
    text-align: center;
}

.link-checker-main .status.show {
    display: block;
}

.link-checker-main .status.loading {
    background: #e3f2fd;
    color: #1976d2;
    border: 1px solid #90caf9;
}

.link-checker-main .status.error {
    background: #ffebee;
    color: #c62828;
    border: 1px solid #ef9a9a;
}

.link-checker-main .status.success {
    background: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #a5d6a7;
}

.link-checker-main .spinner {
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
.link-checker-main .progress-bar {
    margin: 1.5rem auto 0;
    height: 8px;
    background: rgba(255, 255, 255, 0.3);
    overflow: hidden;
}

.link-checker-main .progress-fill {
    height: 100%;
    background: white;
    width: 0%;
    transition: width 0.3s ease;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

/* Results Container */
.link-checker-main .results-container {
    display: none;
    margin: 0 auto;
    padding: 0 2rem 2rem;
}

.link-checker-main .results-container.show {
    display: block;
}

/* Cards */
.link-checker-main .card {
    background: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    padding: 2rem;
    margin-bottom: 2rem;
}

.link-checker-main .card h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a202c;
    margin: 0 0 1.5rem 0;
}

/* Legend */
.link-checker-main .legend {
    display: flex;
    gap: 2rem;
    padding: 1rem 1.5rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    margin-bottom: 1.5rem;
}

.link-checker-main .legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #64748b;
}

.link-checker-main .legend-color {
    width: 1rem;
    height: 1rem;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.link-checker-main .legend-color.green {
    background: #10b981;
}

.link-checker-main .legend-color.yellow {
    background: #f59e0b;
}

.link-checker-main .legend-color.red {
    background: #ef4444;
}

.link-checker-main .legend-color.blue {
    background: #3b82f6;
}

/* Table */
.link-checker-main .table-wrapper {
    overflow-x: auto;
    margin-top: 1rem;
    border: 1px solid #e2e8f0;
    background: white;
}

.link-checker-main table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}

.link-checker-main thead {
    background: #f8fafc;
    border-bottom: 2px solid #e2e8f0;
}

.link-checker-main th {
    padding: 1.25rem 1.5rem;
    text-align: left;
    font-weight: 600;
    color: #1e293b;
    font-size: 0.8125rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    white-space: nowrap;
}

.link-checker-main td {
    padding: 1.5rem;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: top;
}

.link-checker-main tbody tr {
    transition: background 0.15s;
}

.link-checker-main tbody tr:hover {
    background: #fafbfc;
}

.link-checker-main tbody tr:last-child td {
    border-bottom: none;
}

.link-checker-main .page-link {
    color: #2EB7A0;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
    display: block;
    max-width: 450px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 0.9rem;
}

.link-checker-main .page-link:hover {
    color: #259887;
    text-decoration: underline;
}

.link-checker-main .link-url {
    color: #3b82f6;
    text-decoration: none;
    transition: color 0.2s;
    display: block;
    max-width: 400px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 0.85rem;
}

.link-checker-main .link-url:hover {
    color: #2563eb;
    text-decoration: underline;
}

.link-checker-main .status-badge {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.link-checker-main .status-ok {
    background: #d1fae5;
    color: #065f46;
}

.link-checker-main .status-redirect {
    background: #fef3c7;
    color: #92400e;
}

.link-checker-main .status-broken {
    background: #fee2e2;
    color: #991b1b;
}

.link-checker-main .status-external {
    background: #dbeafe;
    color: #1e40af;
}

.link-checker-main .status-checking {
    background: #e0e7ff;
    color: #4338ca;
}

.link-checker-main .link-type-badge {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    font-size: 0.7rem;
    font-weight: 500;
    background: #f1f5f9;
    color: #64748b;
    text-transform: uppercase;
}

/* Filters */
.link-checker-main .filters {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.link-checker-main .filter-btn {
    padding: 0.5rem 1rem;
    background: white;
    border: 1px solid #e2e8f0;
    color: #64748b;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}

.link-checker-main .filter-btn:hover {
    border-color: #2EB7A0;
    color: #2EB7A0;
}

.link-checker-main .filter-btn.active {
    background: #2EB7A0;
    border-color: #2EB7A0;
    color: white;
}

/* Summary Cards */
.link-checker-main .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.link-checker-main .summary-card {
    background: white;
    padding: 1.5rem;
    border-left: 4px solid;
}

.link-checker-main .summary-card.broken {
    border-color: #ef4444;
}

.link-checker-main .summary-card.redirects {
    border-color: #f59e0b;
}

.link-checker-main .summary-card.external {
    border-color: #3b82f6;
}

.link-checker-main .summary-card h3 {
    font-size: 0.875rem;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin: 0 0 0.5rem 0;
}

.link-checker-main .summary-card .count {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
}
</style>

<div class="mwDskTools">
  <h1>Link Checker</h1>
</div>

<div class="mwDesktop">
  <main class="link-checker-main">
    <div class="app-content">
      <div class="container">
        
        <div class="hero">
          <div class="hero-content">
            <div>
              <span class="hero-eyebrow">Link Health Monitor</span>
              <h2 class="hero-title">Link Checker Dashboard</h2>
              <p class="hero-subtitle">Scan all pages to find broken links, redirects, and external references.</p>
            </div>
            <div class="hero-actions">
              <button type="button" id="scan-btn" class="btn btn-primary" onclick="startScan()">
                <span>Scan All Links</span>
              </button>
            </div>
          </div>
          
          <div class="overview-grid">
            <div class="overview-card">
              <div class="overview-value" id="pages-scanned">0</div>
              <div class="overview-label">Pages Scanned</div>
            </div>
            <div class="overview-card">
              <div class="overview-value" id="total-links">0</div>
              <div class="overview-label">Total Links</div>
            </div>
            <div class="overview-card">
              <div class="overview-value" id="broken-links">0</div>
              <div class="overview-label">Broken Links</div>
            </div>
            <div class="overview-card">
              <div class="overview-value" id="external-links">0</div>
              <div class="overview-label">External Links</div>
            </div>
          </div>
          
          <div class="progress-bar" id="progress-bar" style="display: none;">
            <div class="progress-fill" id="progress-fill"></div>
          </div>
        </div>

        <div id="status" class="status"></div>

        <div class="results-container" id="results-container">
          
          <div class="summary-grid" id="summary-grid" style="display: none;">
            <div class="summary-card broken">
              <h3>Broken Links</h3>
              <div class="count" id="summary-broken">0</div>
            </div>
            <div class="summary-card redirects">
              <h3>Redirects (3xx)</h3>
              <div class="count" id="summary-redirects">0</div>
            </div>
            <div class="summary-card external">
              <h3>External Links</h3>
              <div class="count" id="summary-external">0</div>
            </div>
          </div>
          
          <div class="card">
            <h2>Link Analysis Results</h2>
            <button class="btn-export" onclick="exportToCSV()">
              Export CSV
            </button>
            
            <div class="legend">
              <div class="legend-item">
                <div class="legend-color green"></div>
                <span>OK (200)</span>
              </div>
              <div class="legend-item">
                <div class="legend-color yellow"></div>
                <span>Redirect (3xx)</span>
              </div>
              <div class="legend-item">
                <div class="legend-color red"></div>
                <span>Broken (4xx/5xx)</span>
              </div>
              <div class="legend-item">
                <div class="legend-color blue"></div>
                <span>External</span>
              </div>
            </div>
            
            <div class="filters">
              <button class="filter-btn active" onclick="filterLinks('all')">All Links</button>
              <button class="filter-btn" onclick="filterLinks('broken')">Broken Only</button>
              <button class="filter-btn" onclick="filterLinks('redirect')">Redirects Only</button>
              <button class="filter-btn" onclick="filterLinks('external')">External Only</button>
              <button class="filter-btn" onclick="filterLinks('internal')">Internal Only</button>
            </div>
            
            <div class="table-wrapper">
              <table id="results-table">
                <thead>
                  <tr>
                    <th>Source Page</th>
                    <th>Link URL</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Code</th>
                    <th>Anchor Text</th>
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
  </main>
</div>

<script>
// Global variables
let scanResults = [];
let totalPages = 0;
let scannedPages = 0;
let totalLinksCount = 0;
let brokenLinksCount = 0;
let externalLinksCount = 0;
let redirectCount = 0;
const sitemapUrl = '<?php echo addslashes($default_sitemap_url); ?>';
const siteDomain = '<?php echo addslashes($site_domain); ?>';
let currentFilter = 'all';

// System paths to ignore
const SYSTEM_PATHS = ['/403', '/404', '/error', '/search'];

// Cache for checked URLs to avoid duplicate checks
const urlStatusCache = new Map();

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

// Check if URL is external
function isExternalLink(url, sourcePage) {
    try {
        // Handle relative URLs
        if (url.startsWith('/') || url.startsWith('./') || url.startsWith('../')) {
            return false;
        }
        
        // Handle anchor links
        if (url.startsWith('#')) {
            return false;
        }
        
        // Handle protocol-relative URLs
        if (url.startsWith('//')) {
            url = 'https:' + url;
        }
        
        // Handle absolute URLs
        if (url.startsWith('http://') || url.startsWith('https://')) {
            const linkUrl = new URL(url);
            const sourceUrl = new URL(sourcePage);
            return linkUrl.hostname !== sourceUrl.hostname;
        }
        
        return false;
    } catch (e) {
        return false;
    }
}

// Normalize URL for comparison
function normalizeUrl(url, baseUrl) {
    try {
        // Handle anchor links
        if (url.startsWith('#')) {
            return new URL(baseUrl).href + url;
        }
        
        // Handle relative URLs
        if (url.startsWith('/') || url.startsWith('./') || url.startsWith('../')) {
            return new URL(url, baseUrl).href;
        }
        
        // Handle protocol-relative URLs
        if (url.startsWith('//')) {
            return 'https:' + url;
        }
        
        // Already absolute
        return new URL(url).href;
    } catch (e) {
        return url;
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

// Check link status
async function checkLinkStatus(url) {
    // Check cache first
    if (urlStatusCache.has(url)) {
        return urlStatusCache.get(url);
    }
    
    try {
        const response = await fetch(`?api=check-link&url=${encodeURIComponent(url)}`);
        const data = await response.json();
        
        const status = data.status || 0;
        urlStatusCache.set(url, status);
        return status;
    } catch (error) {
        console.error(`Failed to check ${url}:`, error);
        urlStatusCache.set(url, 0);
        return 0;
    }
}

// Extract all links from page
function extractLinks(html, sourceUrl) {
    const parser = new DOMParser();
    const doc = parser.parseFromString(html, 'text/html');
    const anchors = doc.querySelectorAll('a[href]');
    const links = [];
    
    anchors.forEach(anchor => {
        const href = anchor.getAttribute('href');
        const text = anchor.textContent.trim();
        
        // Skip empty, javascript, mailto, tel links
        if (!href || 
            href.startsWith('javascript:') || 
            href.startsWith('mailto:') || 
            href.startsWith('tel:')) {
            return;
        }
        
        const normalizedUrl = normalizeUrl(href, sourceUrl);
        const isExternal = isExternalLink(href, sourceUrl);
        
        links.push({
            url: normalizedUrl,
            originalHref: href,
            anchorText: text || '(no text)',
            isExternal: isExternal,
            status: 0,
            statusText: 'Checking...'
        });
    });
    
    return links;
}

// Scan a single page for links
async function scanPage(url) {
    const html = await fetchPage(url);
    
    if (!html) {
        return {
            sourceUrl: url,
            links: []
        };
    }
    
    const links = extractLinks(html, url);
    
    return {
        sourceUrl: url,
        links: links
    };
}

// Add delay between requests
function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// Start the scan
async function startScan() {
    const scanBtn = document.getElementById('scan-btn');
    const resultsContainer = document.getElementById('results-container');
    const summaryGrid = document.getElementById('summary-grid');
    
    // Reset
    scanResults = [];
    scannedPages = 0;
    totalLinksCount = 0;
    brokenLinksCount = 0;
    externalLinksCount = 0;
    redirectCount = 0;
    urlStatusCache.clear();
    resultsContainer.classList.remove('show');
    summaryGrid.style.display = 'none';
    
    // Disable button
    scanBtn.disabled = true;
    scanBtn.innerHTML = '<div class="spinner"></div> Scanning...';
    
    try {
        // Fetch sitemap
        showStatus('<div class="spinner"></div> Fetching sitemap from ' + sitemapUrl + '...', 'loading');
        const urls = await fetchSitemap(sitemapUrl);
        
        if (!urls || urls.length === 0) {
            throw new Error('No URLs found in sitemap. Make sure ' + sitemapUrl + ' exists and contains valid URLs.');
        }
        
        totalPages = urls.length;
        showStatus(`<div class="spinner"></div> Found ${totalPages} pages. Extracting links...`, 'loading');
        await delay(500);
        
        // Scan each page for links
        for (let i = 0; i < urls.length; i++) {
            updateProgress(i + 1, totalPages);
            
            const result = await scanPage(urls[i]);
            scanResults.push(result);
            scannedPages++;
            
            await delay(100);
        }
        
        // Count total links
        scanResults.forEach(result => {
            totalLinksCount += result.links.length;
            result.links.forEach(link => {
                if (link.isExternal) {
                    externalLinksCount++;
                }
            });
        });
        
        // Update stats
        document.getElementById('pages-scanned').textContent = scannedPages;
        document.getElementById('total-links').textContent = totalLinksCount;
        document.getElementById('external-links').textContent = externalLinksCount;
        
        showStatus('<div class="spinner"></div> Checking link status... This may take a while.', 'loading');
        
        // Check status of unique links
        const uniqueLinks = new Set();
        scanResults.forEach(result => {
            result.links.forEach(link => {
                uniqueLinks.add(link.url);
            });
        });
        
        let checkedCount = 0;
        const totalUnique = uniqueLinks.size;
        
        for (const linkUrl of uniqueLinks) {
            const status = await checkLinkStatus(linkUrl);
            checkedCount++;
            
            if (checkedCount % 5 === 0 || checkedCount === totalUnique) {
                showStatus(
                    `<div class="spinner"></div> Checking link ${checkedCount} of ${totalUnique}...`,
                    'loading'
                );
            }
            
            await delay(50);
        }
        
        // Update link statuses
        scanResults.forEach(result => {
            result.links.forEach(link => {
                const status = urlStatusCache.get(link.url) || 0;
                link.status = status;
                
                if (status === 0) {
                    link.statusText = 'Failed';
                    brokenLinksCount++;
                } else if (status >= 200 && status < 300) {
                    link.statusText = 'OK';
                } else if (status >= 300 && status < 400) {
                    link.statusText = 'Redirect';
                    redirectCount++;
                } else if (status >= 400) {
                    link.statusText = 'Broken';
                    brokenLinksCount++;
                }
            });
        });
        
        // Update stats
        document.getElementById('broken-links').textContent = brokenLinksCount;
        document.getElementById('summary-broken').textContent = brokenLinksCount;
        document.getElementById('summary-redirects').textContent = redirectCount;
        document.getElementById('summary-external').textContent = externalLinksCount;
        
        // Show results
        displayResults();
        summaryGrid.style.display = 'grid';
        showStatus('Scan complete! Checked ' + totalLinksCount + ' links across ' + scannedPages + ' pages.', 'success');
        setTimeout(hideStatus, 3000);
        
    } catch (error) {
        showStatus(`Error: ${error.message}`, 'error');
    } finally {
        scanBtn.disabled = false;
        scanBtn.innerHTML = '<span>Scan All Links</span>';
        document.getElementById('progress-bar').style.display = 'none';
    }
}

// Filter links
function filterLinks(filter) {
    currentFilter = filter;
    
    // Update button states
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    // Filter table rows
    const rows = document.querySelectorAll('#results-tbody tr');
    rows.forEach(row => {
        const type = row.dataset.type;
        const status = row.dataset.status;
        
        let show = false;
        
        if (filter === 'all') {
            show = true;
        } else if (filter === 'broken' && (status === 'broken' || status === 'failed')) {
            show = true;
        } else if (filter === 'redirect' && status === 'redirect') {
            show = true;
        } else if (filter === 'external' && type === 'external') {
            show = true;
        } else if (filter === 'internal' && type === 'internal') {
            show = true;
        }
        
        row.style.display = show ? '' : 'none';
    });
}

// Display results in table
function displayResults() {
    const resultsContainer = document.getElementById('results-container');
    const tbody = document.getElementById('results-tbody');
    
    tbody.innerHTML = '';
    
    // Flatten all links with their source pages
    const allLinks = [];
    scanResults.forEach(result => {
        result.links.forEach(link => {
            allLinks.push({
                sourcePage: result.sourceUrl,
                ...link
            });
        });
    });
    
    // Sort by status (broken first, then redirects, then OK)
    allLinks.sort((a, b) => {
        const priority = { 'Broken': 0, 'Failed': 0, 'Redirect': 1, 'OK': 2 };
        return (priority[a.statusText] || 3) - (priority[b.statusText] || 3);
    });
    
    // Create rows
    allLinks.forEach(link => {
        const row = document.createElement('tr');
        
        let statusClass = 'status-ok';
        let statusLabel = link.statusText;
        
        if (link.status === 0 || link.status >= 400) {
            statusClass = 'status-broken';
        } else if (link.status >= 300 && link.status < 400) {
            statusClass = 'status-redirect';
        }
        
        if (link.isExternal) {
            statusClass += ' status-external';
        }
        
        const linkType = link.isExternal ? 'external' : 'internal';
        const dataStatus = link.status === 0 || link.status >= 400 ? 'broken' : 
                          link.status >= 300 && link.status < 400 ? 'redirect' : 'ok';
        
        row.dataset.type = linkType;
        row.dataset.status = dataStatus;
        
        row.innerHTML = `
            <td><a href="${escapeHtml(link.sourcePage)}" target="_blank" class="page-link">${escapeHtml(link.sourcePage)}</a></td>
            <td><a href="${escapeHtml(link.url)}" target="_blank" class="link-url">${escapeHtml(link.url)}</a></td>
            <td><span class="link-type-badge">${linkType}</span></td>
            <td><span class="status-badge ${statusClass}">${statusLabel}</span></td>
            <td>${link.status || 'N/A'}</td>
            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${escapeHtml(link.anchorText)}</td>
        `;
        
        tbody.appendChild(row);
    });
    
    resultsContainer.classList.add('show');
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
    
    let csv = 'Source Page,Link URL,Type,Status,Code,Anchor Text\n';
    
    scanResults.forEach(result => {
        result.links.forEach(link => {
            const type = link.isExternal ? 'External' : 'Internal';
            const row = [
                result.sourceUrl,
                link.url,
                type,
                link.statusText,
                link.status || 'N/A',
                link.anchorText
            ];
            csv += row.map(cell => `"${cell}"`).join(',') + '\n';
        });
    });
    
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `link-check-${new Date().toISOString().split('T')[0]}.csv`;
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
        // mwWindow('wLinkChecker').show();
    }, 500);
});
</script>
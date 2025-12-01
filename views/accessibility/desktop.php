<?php
// views/accessibility/desktop.php: Template for accessibility checking tool
$mwLoad->Window( 'wAccessibility', 'accessibility/index' );

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
            'user_agent' => 'Accessibility Checker Tool/1.0'
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
.a11y-main * {
    box-sizing: border-box;
}

.a11y-main {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 0;
}

.a11y-main .app-content {
    max-width: 100%;
    margin: 0 auto;
    padding: 0;
}

.a11y-main .container {
    width: 100%;
}

/* Hero Section */
.a11y-main .hero {
    background: #2EB7A0;
    color: white;
    padding: 3rem 2rem;
    margin-bottom: 2rem;
}

.a11y-main .hero-content {
    margin: 0 auto 2rem;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 2rem;
}

.a11y-main .hero-eyebrow {
    display: inline-block;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.25rem 0.75rem;
    margin-bottom: 0.5rem;
}

.a11y-main .hero-title {
    font-size: 2rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
}

.a11y-main .hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.95;
    margin: 0;
    line-height: 1.5;
}

.a11y-main .hero-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.75rem;
}

/* Overview Cards */
.a11y-main .overview-grid {
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
}

.a11y-main .overview-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 1.5rem;
    text-align: center;
}

.a11y-main .overview-value {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    line-height: 1;
}

.a11y-main .overview-label {
    font-size: 0.875rem;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 500;
}

/* Buttons */
.a11y-main .btn {
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

.a11y-main .btn-primary {
    background: white;
    color: #2EB7A0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.a11y-main .btn-primary:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.a11y-main .btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.a11y-main .btn-export {
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

.a11y-main .btn-export:hover {
    background: #259887;
    transform: translateY(-1px);
}

.a11y-main .btn-view-details {
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

.a11y-main .btn-view-details:hover {
    background: #259887;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(46, 183, 160, 0.2);
}

/* Status Messages */
.a11y-main .status {
    display: none;
    padding: 1rem;
    margin: 1rem 2rem;
    text-align: center;
}

.a11y-main .status.show {
    display: block;
}

.a11y-main .status.loading {
    background: #e3f2fd;
    color: #1976d2;
    border: 1px solid #90caf9;
}

.a11y-main .status.error {
    background: #ffebee;
    color: #c62828;
    border: 1px solid #ef9a9a;
}

.a11y-main .status.success {
    background: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #a5d6a7;
}

.a11y-main .spinner {
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
.a11y-main .progress-bar {
    margin: 1.5rem auto 0;
    height: 8px;
    background: rgba(255, 255, 255, 0.3);
    overflow: hidden;
}

.a11y-main .progress-fill {
    height: 100%;
    background: white;
    width: 0%;
    transition: width 0.3s ease;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

/* Results Container */
.a11y-main .results-container {
    display: none;
    margin: 0 auto;
    padding: 0 2rem 2rem;
}

.a11y-main .results-container.show {
    display: block;
}

/* Cards */
.a11y-main .card {
    background: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    padding: 2rem;
    margin-bottom: 2rem;
}

.a11y-main .card h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a202c;
    margin: 0 0 1.5rem 0;
}

/* Legend */
.a11y-main .legend {
    display: flex;
    gap: 2rem;
    padding: 1rem 1.5rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    margin-bottom: 1.5rem;
}

.a11y-main .legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #64748b;
}

.a11y-main .legend-color {
    width: 1rem;
    height: 1rem;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.a11y-main .legend-color.green {
    background: #10b981;
}

.a11y-main .legend-color.yellow {
    background: #f59e0b;
}

.a11y-main .legend-color.red {
    background: #ef4444;
}

/* Table */
.a11y-main .table-wrapper {
    overflow-x: auto;
    margin-top: 1rem;
    border: 1px solid #e2e8f0;
    background: white;
}

.a11y-main table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}

.a11y-main thead {
    background: #f8fafc;
    border-bottom: 2px solid #e2e8f0;
}

.a11y-main th {
    padding: 1.25rem 1.5rem;
    text-align: left;
    font-weight: 600;
    color: #1e293b;
    font-size: 0.8125rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    white-space: nowrap;
}

.a11y-main td {
    padding: 1.5rem;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: top;
}

.a11y-main tbody tr {
    transition: background 0.15s;
}

.a11y-main tbody tr:hover {
    background: #fafbfc;
}

.a11y-main tbody tr:last-child td {
    border-bottom: none;
}

.a11y-main .page-link {
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

.a11y-main .page-link:hover {
    color: #259887;
    text-decoration: underline;
}

.a11y-main .score-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.25rem;
    padding: 0.5rem;
    min-width: 3rem;
}

.a11y-main .score-excellent {
    color: #10b981;
}

.a11y-main .score-good {
    color: #3b82f6;
}

.a11y-main .score-fair {
    color: #f59e0b;
}

.a11y-main .score-poor {
    color: #ef4444;
}

.a11y-main .compliance-badge {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.a11y-main .wcag-level-badge {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    background: #3b82f6;
    color: white;
}

.a11y-main .level-aaa {
    background: #10b981;
    color: white;
}

.a11y-main .level-aa {
    background: #3b82f6;
    color: white;
}

.a11y-main .level-a {
    background: #f59e0b;
    color: white;
}

.a11y-main .level-fail {
    background: #ef4444;
    color: white;
}

.a11y-main .compliant {
    background: #d1fae5;
    color: #065f46;
}

.a11y-main .partial {
    background: #fef3c7;
    color: #92400e;
}

.a11y-main .non-compliant {
    background: #fee2e2;
    color: #991b1b;
}

.a11y-main .issue-badge {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 500;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
}

.a11y-main .issue-critical {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fca5a5;
}

.a11y-main .issue-serious {
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #fcd34d;
}

.a11y-main .issue-moderate {
    background: #dbeafe;
    color: #1e40af;
    border: 1px solid #93c5fd;
}

/* Modal */
.a11y-main .modal {
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

.a11y-main .modal.show {
    display: flex;
    align-items: center;
    justify-content: center;
}

.a11y-main .modal-content {
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

.a11y-main .modal-close {
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

.a11y-main .modal-close:hover {
    background: #e2e8f0;
    color: #1e293b;
    transform: scale(1.1);
}

.a11y-main #modal-title {
    margin: 0 0 0.75rem 0;
    padding-right: 2.75rem;
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a202c;
}

.a11y-main #modal-body {
    margin-top: 1.5rem;
    line-height: 1.6;
    color: #475569;
}

.a11y-main .metric-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin: 1.5rem 0;
}

.a11y-main .metric-card {
    padding: 1rem;
    background: #f8fafc;
    border-left: 3px solid #2EB7A0;
}

.a11y-main .metric-label {
    font-size: 0.75rem;
    color: #64748b;
    text-transform: uppercase;
    margin-bottom: 0.25rem;
}

.a11y-main .metric-value {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1e293b;
}

.a11y-main .issue-section {
    margin: 1.5rem 0;
}

.a11y-main .issue-section h4 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 1rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.a11y-main .issue-item {
    padding: 1rem;
    background: #f8fafc;
    border-left: 3px solid #f59e0b;
    margin-bottom: 0.75rem;
}

.a11y-main .issue-item.critical {
    background: #fef2f2;
    border-left-color: #ef4444;
}

.a11y-main .issue-item.serious {
    background: #fffbeb;
    border-left-color: #f59e0b;
}

.a11y-main .issue-item.moderate {
    background: #eff6ff;
    border-left-color: #3b82f6;
}

.a11y-main .issue-item strong {
    display: block;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.a11y-main .issue-count {
    background: #ef4444;
    color: white;
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    margin-left: 0.5rem;
}
</style>

<div class="mwDskTools">
  <h1>Accessibility Scanner</h1>
</div>

<div class="mwDesktop">
  <main class="a11y-main">
    <div class="app-content">
      <div class="container">
        
        <div class="hero">
          <div class="hero-content">
            <div>
              <span class="hero-eyebrow">WCAG Compliance</span>
              <h2 class="hero-title">Accessibility Scanner Dashboard</h2>
              <p class="hero-subtitle">Check your site for accessibility issues and WCAG 2.1 compliance violations.</p>
            </div>
            <div class="hero-actions">
              <button type="button" id="scan-btn" class="btn btn-primary" onclick="startScan()">
                <span>Scan All Pages</span>
              </button>
            </div>
          </div>
          
          <div class="overview-grid">
            <div class="overview-card">
              <div class="overview-value" id="pages-scanned">0</div>
              <div class="overview-label">Pages Scanned</div>
            </div>
            <div class="overview-card">
              <div class="overview-value" id="avg-score">0%</div>
              <div class="overview-label">Avg Score</div>
            </div>
            <div class="overview-card">
              <div class="overview-value" id="total-issues">0</div>
              <div class="overview-label">Total Issues</div>
            </div>
            <div class="overview-card">
              <div class="overview-value" id="compliant-pages">0</div>
              <div class="overview-label">Compliant Pages</div>
            </div>
          </div>
          
          <div class="progress-bar" id="progress-bar" style="display: none;">
            <div class="progress-fill" id="progress-fill"></div>
          </div>
        </div>

        <div id="status" class="status"></div>

        <div class="results-container" id="results-container">
          <div class="card">
            <h2>Accessibility Analysis Results</h2>
            <button class="btn-export" onclick="exportToCSV()">
              Export CSV
            </button>
            
            <div class="legend">
              <div class="legend-item">
                <div class="legend-color green"></div>
                <span>AAA (No Issues)</span>
              </div>
              <div class="legend-item">
                <div class="legend-color" style="background: #3b82f6;"></div>
                <span>AA (Minor Issues)</span>
              </div>
              <div class="legend-item">
                <div class="legend-color yellow"></div>
                <span>A (Serious Issues)</span>
              </div>
              <div class="legend-item">
                <div class="legend-color red"></div>
                <span>Fail (Critical Issues)</span>
              </div>
            </div>
            
            <div class="table-wrapper">
              <table id="results-table">
                <thead>
                  <tr>
                    <th>URL</th>
                    <th>Score</th>
                    <th>WCAG Level</th>
                    <th>Compliance</th>
                    <th>Critical</th>
                    <th>Serious</th>
                    <th>Moderate</th>
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
let totalIssues = 0;
let compliantPages = 0;
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

// Analyze page for accessibility issues
function analyzeAccessibility(html, url) {
    const parser = new DOMParser();
    const doc = parser.parseFromString(html, 'text/html');
    
    const issues = {
        critical: [],
        serious: [],
        moderate: []
    };
    
    // Check 1: Image Alt Attributes
    const images = doc.querySelectorAll('img');
    let imagesWithoutAlt = 0;
    let imagesWithEmptyAlt = 0;
    const imagesWithoutAltDetails = [];
    const imagesWithEmptyAltDetails = [];
    
    images.forEach((img, index) => {
        const src = img.getAttribute('src') || '(no src)';
        if (!img.hasAttribute('alt')) {
            imagesWithoutAlt++;
            imagesWithoutAltDetails.push({
                src: src,
                position: `Image #${index + 1}`,
                outerHTML: img.outerHTML.substring(0, 150) + (img.outerHTML.length > 150 ? '...' : '')
            });
        } else if (img.getAttribute('alt').trim() === '' && !img.hasAttribute('role')) {
            imagesWithEmptyAlt++;
            imagesWithEmptyAltDetails.push({
                src: src,
                position: `Image #${index + 1}`,
                outerHTML: img.outerHTML.substring(0, 150) + (img.outerHTML.length > 150 ? '...' : '')
            });
        }
    });
    
    if (imagesWithoutAlt > 0) {
        issues.critical.push({
            type: 'Images Missing Alt Attributes',
            count: imagesWithoutAlt,
            message: `${imagesWithoutAlt} image${imagesWithoutAlt > 1 ? 's' : ''} missing alt attributes`,
            wcag: 'WCAG 2.1 Level A - 1.1.1 Non-text Content',
            details: imagesWithoutAltDetails
        });
    }
    if (imagesWithEmptyAlt > 0) {
        issues.moderate.push({
            type: 'Images With Empty Alt Text',
            count: imagesWithEmptyAlt,
            message: `${imagesWithEmptyAlt} decorative image${imagesWithEmptyAlt > 1 ? 's have' : ' has'} empty alt (ensure they are truly decorative)`,
            wcag: 'WCAG 2.1 Level A - 1.1.1 Non-text Content',
            details: imagesWithEmptyAltDetails
        });
    }
    
    // Check 2: Headings Hierarchy
    const h1s = doc.querySelectorAll('h1');
    const h2s = doc.querySelectorAll('h2');
    const h3s = doc.querySelectorAll('h3');
    const h4s = doc.querySelectorAll('h4');
    const h5s = doc.querySelectorAll('h5');
    const h6s = doc.querySelectorAll('h6');
    
    if (h1s.length === 0) {
        issues.critical.push({
            type: 'Missing H1 Heading',
            count: 1,
            message: 'Page missing H1 heading for main content',
            wcag: 'WCAG 2.1 Level AA - 2.4.6 Headings and Labels',
            details: [{ explanation: 'No H1 heading found on the page. Add a single H1 tag that describes the main content.' }]
        });
    } else if (h1s.length > 1) {
        const h1Details = [];
        h1s.forEach((h1, index) => {
            h1Details.push({
                position: `H1 #${index + 1}`,
                text: h1.textContent.trim(),
                outerHTML: h1.outerHTML.substring(0, 150) + (h1.outerHTML.length > 150 ? '...' : '')
            });
        });
        issues.moderate.push({
            type: 'Multiple H1 Headings',
            count: h1s.length,
            message: `Page has ${h1s.length} H1 headings (should have only one)`,
            wcag: 'WCAG 2.1 Level AA - 2.4.6 Headings and Labels',
            details: h1Details
        });
    }
    
    // Check heading order - basic check
    const allHeadings = doc.querySelectorAll('h1, h2, h3, h4, h5, h6');
    let headingOrderIssues = 0;
    let prevLevel = 0;
    const headingOrderDetails = [];
    
    allHeadings.forEach((heading, index) => {
        const level = parseInt(heading.tagName.substring(1));
        if (prevLevel > 0 && level - prevLevel > 1) {
            headingOrderIssues++;
            headingOrderDetails.push({
                position: `Heading #${index + 1}`,
                issue: `Skipped from H${prevLevel} to H${level}`,
                text: heading.textContent.trim(),
                outerHTML: heading.outerHTML.substring(0, 150) + (heading.outerHTML.length > 150 ? '...' : '')
            });
        }
        prevLevel = level;
    });
    if (headingOrderIssues > 0) {
        issues.moderate.push({
            type: 'Heading Hierarchy Issues',
            count: headingOrderIssues,
            message: `${headingOrderIssues} instance${headingOrderIssues > 1 ? 's' : ''} of skipped heading levels`,
            wcag: 'WCAG 2.1 Level AA - 2.4.6 Headings and Labels',
            details: headingOrderDetails
        });
    }
    
    // Check 3: Link Text
    const links = doc.querySelectorAll('a');
    let linksWithoutText = 0;
    let linksWithBadText = 0;
    const badLinkText = ['click here', 'read more', 'more', 'link', 'here'];
    const linksWithoutTextDetails = [];
    const linksWithBadTextDetails = [];
    
    links.forEach((link, index) => {
        const text = link.textContent.trim().toLowerCase();
        const ariaLabel = link.getAttribute('aria-label');
        const title = link.getAttribute('title');
        const href = link.getAttribute('href') || '(no href)';
        
        if (!text && !ariaLabel && !title) {
            linksWithoutText++;
            linksWithoutTextDetails.push({
                position: `Link #${index + 1}`,
                href: href,
                outerHTML: link.outerHTML.substring(0, 150) + (link.outerHTML.length > 150 ? '...' : '')
            });
        } else if (badLinkText.includes(text) && !ariaLabel) {
            linksWithBadText++;
            linksWithBadTextDetails.push({
                position: `Link #${index + 1}`,
                text: text,
                href: href,
                outerHTML: link.outerHTML.substring(0, 150) + (link.outerHTML.length > 150 ? '...' : '')
            });
        }
    });
    
    if (linksWithoutText > 0) {
        issues.serious.push({
            type: 'Links Without Text',
            count: linksWithoutText,
            message: `${linksWithoutText} link${linksWithoutText > 1 ? 's' : ''} without accessible text`,
            wcag: 'WCAG 2.1 Level A - 2.4.4 Link Purpose',
            details: linksWithoutTextDetails
        });
    }
    
    if (linksWithBadText > 0) {
        issues.moderate.push({
            type: 'Links With Non-Descriptive Text',
            count: linksWithBadText,
            message: `${linksWithBadText} link${linksWithBadText > 1 ? 's use' : ' uses'} non-descriptive text (e.g., "click here")`,
            wcag: 'WCAG 2.1 Level A - 2.4.4 Link Purpose',
            details: linksWithBadTextDetails
        });
    }
    
    // Check 4: Color Contrast (basic check - looks for inline styles)
    const elementsWithInlineColor = doc.querySelectorAll('[style*="color"]');
    let potentialContrastIssues = 0;
    const contrastIssueDetails = [];
    
    elementsWithInlineColor.forEach((elem, index) => {
        const style = elem.getAttribute('style');
        if (style && style.includes('color') && !style.includes('background')) {
            potentialContrastIssues++;
            contrastIssueDetails.push({
                position: `Element #${index + 1}`,
                tag: elem.tagName.toLowerCase(),
                style: style,
                outerHTML: elem.outerHTML.substring(0, 150) + (elem.outerHTML.length > 150 ? '...' : '')
            });
        }
    });
    if (potentialContrastIssues > 0) {
        issues.moderate.push({
            type: 'Potential Color Contrast Issues',
            count: potentialContrastIssues,
            message: `${potentialContrastIssues} element${potentialContrastIssues > 1 ? 's have' : ' has'} inline color without background (manual review needed)`,
            wcag: 'WCAG 2.1 Level AA - 1.4.3 Contrast (Minimum)',
            details: contrastIssueDetails
        });
    }
    
    // Check 5: Language Attribute
    const htmlElem = doc.querySelector('html');
    if (!htmlElem || !htmlElem.hasAttribute('lang')) {
        issues.serious.push({
            type: 'Missing Language Attribute',
            count: 1,
            message: 'HTML element missing lang attribute',
            wcag: 'WCAG 2.1 Level A - 3.1.1 Language of Page',
            details: [{ 
                explanation: 'Add lang="en" (or appropriate language code) to the <html> tag',
                example: '<html lang="en">'
            }]
        });
    }
    
    // Check 6: Semantic HTML
    const semanticElements = doc.querySelectorAll('header, nav, main, article, section, aside, footer');
    if (semanticElements.length === 0) {
        issues.serious.push({
            type: 'Missing Semantic HTML',
            count: 1,
            message: 'No semantic HTML5 elements found (header, nav, main, article, section, aside, footer)',
            wcag: 'WCAG 2.1 Level A - 1.3.1 Info and Relationships',
            details: [{
                explanation: 'Use semantic HTML5 elements to structure your page',
                recommendation: 'Add elements like <header>, <nav>, <main>, <article>, <section>, <aside>, and <footer>'
            }]
        });
    }
    
    const mainElements = doc.querySelectorAll('main');
    if (mainElements.length === 0) {
        issues.moderate.push({
            type: 'Missing Main Landmark',
            count: 1,
            message: 'Page missing <main> element for main content',
            wcag: 'WCAG 2.1 Level A - 1.3.1 Info and Relationships',
            details: [{
                explanation: 'Wrap your main content in a <main> element',
                example: '<main>...main content here...</main>'
            }]
        });
    } else if (mainElements.length > 1) {
        const mainDetails = [];
        mainElements.forEach((main, index) => {
            mainDetails.push({
                position: `Main #${index + 1}`,
                outerHTML: main.outerHTML.substring(0, 150) + (main.outerHTML.length > 150 ? '...' : '')
            });
        });
        issues.moderate.push({
            type: 'Multiple Main Landmarks',
            count: mainElements.length,
            message: `Page has ${mainElements.length} <main> elements (should have only one)`,
            wcag: 'WCAG 2.1 Level A - 1.3.1 Info and Relationships',
            details: mainDetails
        });
    }
    
    // Check 7: Media Accessibility
    const videos = doc.querySelectorAll('video');
    const audios = doc.querySelectorAll('audio');
    let mediaWithoutCaptions = 0;
    const mediaDetails = [];
    
    videos.forEach((video, index) => {
        const tracks = video.querySelectorAll('track[kind="captions"], track[kind="subtitles"]');
        if (tracks.length === 0) {
            mediaWithoutCaptions++;
            const src = video.getAttribute('src') || video.querySelector('source')?.getAttribute('src') || '(no src)';
            mediaDetails.push({
                position: `Video #${index + 1}`,
                src: src,
                outerHTML: video.outerHTML.substring(0, 150) + (video.outerHTML.length > 150 ? '...' : '')
            });
        }
    });
    
    if (mediaWithoutCaptions > 0) {
        issues.serious.push({
            type: 'Media Without Captions',
            count: mediaWithoutCaptions,
            message: `${mediaWithoutCaptions} video${mediaWithoutCaptions > 1 ? 's' : ''} without captions or subtitles`,
            wcag: 'WCAG 2.1 Level A - 1.2.2 Captions (Prerecorded)',
            details: mediaDetails
        });
    }
    
    // Check 8: Text Resizing (checks for fixed font sizes in pixels)
    const elementsWithPxFont = doc.querySelectorAll('[style*="font-size"][style*="px"]');
    const pxFontDetails = [];
    
    elementsWithPxFont.forEach((elem, index) => {
        const style = elem.getAttribute('style');
        pxFontDetails.push({
            position: `Element #${index + 1}`,
            tag: elem.tagName.toLowerCase(),
            style: style,
            outerHTML: elem.outerHTML.substring(0, 150) + (elem.outerHTML.length > 150 ? '...' : '')
        });
    });
    
    if (elementsWithPxFont.length > 0) {
        issues.moderate.push({
            type: 'Fixed Pixel Font Sizes',
            count: elementsWithPxFont.length,
            message: `${elementsWithPxFont.length} element${elementsWithPxFont.length > 1 ? 's use' : ' uses'} fixed pixel font sizes (may prevent text resizing)`,
            wcag: 'WCAG 2.1 Level AA - 1.4.4 Resize Text',
            details: pxFontDetails
        });
    }
    
    // Check 9: Responsive Design (checks for viewport meta tag)
    const viewportMeta = doc.querySelector('meta[name="viewport"]');
    if (!viewportMeta) {
        issues.serious.push({
            type: 'Missing Viewport Meta Tag',
            count: 1,
            message: 'Page missing viewport meta tag for responsive design',
            wcag: 'WCAG 2.1 Level AA - 1.4.10 Reflow',
            details: [{
                explanation: 'Add a viewport meta tag to the <head> section',
                example: '<meta name="viewport" content="width=device-width, initial-scale=1">'
            }]
        });
    } else {
        const content = viewportMeta.getAttribute('content');
        if (content && (content.includes('user-scalable=no') || content.includes('maximum-scale=1'))) {
            issues.serious.push({
                type: 'Viewport Prevents Zooming',
                count: 1,
                message: 'Viewport meta tag prevents users from zooming',
                wcag: 'WCAG 2.1 Level AA - 1.4.4 Resize Text',
                details: [{
                    current: viewportMeta.outerHTML,
                    fix: 'Remove user-scalable=no and maximum-scale restrictions',
                    example: '<meta name="viewport" content="width=device-width, initial-scale=1">'
                }]
            });
        }
    }
    
    // Check 10: Keyboard Navigation (checks for interactive elements)
    const interactiveElements = doc.querySelectorAll('a, button, input, select, textarea, [tabindex]');
    let negativeTabIndex = 0;
    let highTabIndex = 0;
    const negativeTabDetails = [];
    const highTabDetails = [];
    
    interactiveElements.forEach((elem, index) => {
        const tabindex = elem.getAttribute('tabindex');
        if (tabindex) {
            const value = parseInt(tabindex);
            if (value < 0 && elem.tagName !== 'A' && elem.tagName !== 'BUTTON') {
                negativeTabIndex++;
                negativeTabDetails.push({
                    position: `Element #${index + 1}`,
                    tag: elem.tagName.toLowerCase(),
                    tabindex: value,
                    outerHTML: elem.outerHTML.substring(0, 150) + (elem.outerHTML.length > 150 ? '...' : '')
                });
            }
            if (value > 0) {
                highTabIndex++;
                highTabDetails.push({
                    position: `Element #${index + 1}`,
                    tag: elem.tagName.toLowerCase(),
                    tabindex: value,
                    outerHTML: elem.outerHTML.substring(0, 150) + (elem.outerHTML.length > 150 ? '...' : '')
                });
            }
        }
    });
    
    if (negativeTabIndex > 0) {
        issues.moderate.push({
            type: 'Elements Removed From Tab Order',
            count: negativeTabIndex,
            message: `${negativeTabIndex} element${negativeTabIndex > 1 ? 's have' : ' has'} negative tabindex (removed from keyboard navigation)`,
            wcag: 'WCAG 2.1 Level A - 2.1.1 Keyboard',
            details: negativeTabDetails
        });
    }
    
    if (highTabIndex > 0) {
        issues.moderate.push({
            type: 'Custom Tab Order',
            count: highTabIndex,
            message: `${highTabIndex} element${highTabIndex > 1 ? 's use' : ' uses'} positive tabindex (may cause confusing tab order)`,
            wcag: 'WCAG 2.1 Level A - 2.1.1 Keyboard',
            details: highTabDetails
        });
    }
    
    // Check 11: Focus Management
    const focusableElements = doc.querySelectorAll('a, button, input, select, textarea, [tabindex="0"]');
    let elementsMissingFocusStyle = 0;
    
    // This is a simplified check - in reality, we'd need to analyze computed styles
    const styleSheets = doc.querySelectorAll('style');
    let hasFocusStyles = false;
    styleSheets.forEach(style => {
        if (style.textContent.includes(':focus')) {
            hasFocusStyles = true;
        }
    });
    
    if (!hasFocusStyles) {
        issues.moderate.push({
            type: 'Missing Focus Styles',
            count: 1,
            message: 'No focus styles detected in inline styles (ensure focus is visually obvious)',
            wcag: 'WCAG 2.1 Level AA - 2.4.7 Focus Visible',
            details: [{
                explanation: 'Add :focus styles to make keyboard navigation visible',
                example: 'a:focus, button:focus { outline: 2px solid blue; }'
            }]
        });
    }
    
    // Check 12: ARIA Live Regions for Notifications
    const liveRegions = doc.querySelectorAll('[aria-live], [role="alert"], [role="status"]');
    const alerts = doc.querySelectorAll('[role="alert"]');
    
    // This is informational rather than an issue
    if (liveRegions.length === 0 && (doc.body.textContent.toLowerCase().includes('notification') || 
        doc.body.textContent.toLowerCase().includes('alert'))) {
        issues.moderate.push({
            type: 'Potential Missing ARIA Live Regions',
            count: 1,
            message: 'Page mentions notifications/alerts but has no ARIA live regions',
            wcag: 'WCAG 2.1 Level A - 4.1.3 Status Messages',
            details: [{
                explanation: 'Add aria-live attributes to dynamic notification areas',
                example: '<div aria-live="polite" role="status">...notifications...</div>'
            }]
        });
    }
    
    // Check 13: Dynamic Content (checks for ARIA attributes for dynamic updates)
    const ariaHiddenElements = doc.querySelectorAll('[aria-hidden="true"]');
    const ariaExpandedElements = doc.querySelectorAll('[aria-expanded]');
    const ariaHiddenDetails = [];
    
    if (ariaHiddenElements.length > 0) {
        // Just informational - validate they're used correctly
        let ariaHiddenOnInteractive = 0;
        ariaHiddenElements.forEach((elem, index) => {
            if (elem.matches('button, a, input, select, textarea')) {
                ariaHiddenOnInteractive++;
                ariaHiddenDetails.push({
                    position: `Element #${index + 1}`,
                    tag: elem.tagName.toLowerCase(),
                    outerHTML: elem.outerHTML.substring(0, 150) + (elem.outerHTML.length > 150 ? '...' : '')
                });
            }
        });
        
        if (ariaHiddenOnInteractive > 0) {
            issues.serious.push({
                type: 'ARIA Hidden on Interactive Elements',
                count: ariaHiddenOnInteractive,
                message: `${ariaHiddenOnInteractive} interactive element${ariaHiddenOnInteractive > 1 ? 's' : ''} hidden from screen readers`,
                wcag: 'WCAG 2.1 Level A - 4.1.2 Name, Role, Value',
                details: ariaHiddenDetails
            });
        }
    }
    
    // Calculate score
    let score = 100;
    score -= issues.critical.length * 12;
    score -= issues.serious.length * 8;
    score -= issues.moderate.length * 4;
    score = Math.max(0, Math.min(100, score));
    
    const totalIssuesCount = issues.critical.length + issues.serious.length + issues.moderate.length;
    
    return {
        score,
        issues,
        criticalCount: issues.critical.length,
        seriousCount: issues.serious.length,
        moderateCount: issues.moderate.length,
        totalIssues: totalIssuesCount
    };
}

// Scan a single page
async function scanPage(url) {
    const html = await fetchPage(url);
    
    if (!html) {
        return {
            url: url,
            score: 0,
            issues: {
                critical: [{ type: 'Failed to Load', count: 1, message: 'Failed to load page', wcag: 'N/A' }],
                serious: [],
                moderate: []
            },
            criticalCount: 1,
            seriousCount: 0,
            moderateCount: 0,
            totalIssues: 1
        };
    }
    
    const analysis = analyzeAccessibility(html, url);
    
    return {
        url: url,
        ...analysis
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
    
    // Reset
    scanResults = [];
    scannedPages = 0;
    totalIssues = 0;
    compliantPages = 0;
    resultsContainer.classList.remove('show');
    
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
        showStatus(`<div class="spinner"></div> Found ${totalPages} pages. Starting accessibility scan...`, 'loading');
        await delay(500);
        
        // Scan each page
        for (let i = 0; i < urls.length; i++) {
            updateProgress(i + 1, totalPages);
            
            const result = await scanPage(urls[i]);
            scanResults.push(result);
            scannedPages++;
            
            totalIssues += result.totalIssues;
            
            if (result.score >= 90) {
                compliantPages++;
            }
            
            await delay(100);
        }
        
        // Show results
        displayResults();
        showStatus('Scan complete! Analyzed ' + scannedPages + ' pages for accessibility.', 'success');
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
    
    // Calculate stats
    let totalScore = 0;
    scanResults.forEach(result => {
        totalScore += result.score;
    });
    
    const avgScore = scannedPages > 0 ? Math.round(totalScore / scannedPages) : 0;
    
    // Update summary stats
    document.getElementById('pages-scanned').textContent = scannedPages;
    document.getElementById('avg-score').textContent = avgScore + '%';
    document.getElementById('total-issues').textContent = totalIssues;
    document.getElementById('compliant-pages').textContent = compliantPages;

    
    // Clear existing rows
    tbody.innerHTML = '';
    
    // Create rows
    scanResults.forEach((result, index) => {
        const row = document.createElement('tr');
        
        const score = result.score;
        const scoreClass = score >= 90 ? 'score-excellent' : 
                          score >= 70 ? 'score-good' : 
                          score >= 50 ? 'score-fair' : 'score-poor';
        
        const compliance = score >= 90 ? 'Compliant' : 
                          score >= 70 ? 'Partial' : 'Non-Compliant';
        const complianceClass = score >= 90 ? 'compliant' : 
                               score >= 70 ? 'partial' : 'non-compliant';
        
        // Determine WCAG Level based on score and critical issues
        let wcagLevel = 'Fail';
        let wcagLevelClass = 'level-fail';
        
        if (result.criticalCount === 0 && result.seriousCount === 0 && result.moderateCount === 0) {
            wcagLevel = 'AAA';
            wcagLevelClass = 'level-aaa';
        } else if (result.criticalCount === 0 && result.seriousCount === 0) {
            wcagLevel = 'AA';
            wcagLevelClass = 'level-aa';
        } else if (result.criticalCount === 0) {
            wcagLevel = 'A';
            wcagLevelClass = 'level-a';
        }
        
        row.innerHTML = `
            <td><a href="${escapeHtml(result.url)}" target="_blank" class="page-link">${escapeHtml(result.url)}</a></td>
            <td><span class="score-badge ${scoreClass}">${score}%</span></td>
            <td><span class="wcag-level-badge ${wcagLevelClass}">${wcagLevel}</span></td>
            <td><span class="compliance-badge ${complianceClass}">${compliance}</span></td>
            <td>${result.criticalCount}</td>
            <td>${result.seriousCount}</td>
            <td>${result.moderateCount}</td>
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
    
    const scoreClass = result.score >= 90 ? 'score-excellent' : 
                      result.score >= 70 ? 'score-good' : 
                      result.score >= 50 ? 'score-fair' : 'score-poor';
    
    let bodyHTML = `
        <div class="metric-grid">
            <div class="metric-card">
                <div class="metric-label">Score</div>
                <div class="metric-value ${scoreClass}">${result.score}%</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Critical Issues</div>
                <div class="metric-value">${result.criticalCount}</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Serious Issues</div>
                <div class="metric-value">${result.seriousCount}</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Moderate Issues</div>
                <div class="metric-value">${result.moderateCount}</div>
            </div>
        </div>
    `;
    
    // Critical issues
    if (result.issues.critical.length > 0) {
        bodyHTML += `
            <div class="issue-section">
                <h4>Critical Issues<span class="issue-count">${result.issues.critical.length}</span></h4>
        `;
        result.issues.critical.forEach(issue => {
            bodyHTML += `
                <div class="issue-item critical">
                    <strong>${escapeHtml(issue.type)}${issue.count > 1 ? ` (${issue.count})` : ''}</strong>
                    <div>${escapeHtml(issue.message)}</div>
                    <div style="font-size: 0.875rem; color: #64748b; margin-top: 0.5rem;">${escapeHtml(issue.wcag)}</div>
            `;
            
            // Show details if available
            if (issue.details && issue.details.length > 0) {
                bodyHTML += '<div style="margin-top: 1rem; padding: 1rem; background: #fafafa; border-left: 3px solid #ef4444;">';
                bodyHTML += '<strong style="display: block; margin-bottom: 0.5rem; color: #1e293b;">Found Issues:</strong>';
                
                issue.details.forEach((detail, idx) => {
                    if (idx < 5) { // Show max 5 examples
                        bodyHTML += '<div style="margin-bottom: 0.75rem; padding-bottom: 0.75rem; border-bottom: 1px solid #e5e7eb;">';
                        
                        if (detail.position) {
                            bodyHTML += `<div style="font-weight: 600; color: #1e293b; margin-bottom: 0.25rem;">${escapeHtml(detail.position)}</div>`;
                        }
                        
                        if (detail.src) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #64748b;">Source: ${escapeHtml(detail.src)}</div>`;
                        }
                        
                        if (detail.href) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #64748b;">Link: ${escapeHtml(detail.href)}</div>`;
                        }
                        
                        if (detail.text) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #64748b;">Text: "${escapeHtml(detail.text)}"</div>`;
                        }
                        
                        if (detail.explanation) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #475569; margin-top: 0.25rem;">${escapeHtml(detail.explanation)}</div>`;
                        }
                        
                        if (detail.example) {
                            bodyHTML += `<div style="font-size: 0.8125rem; margin-top: 0.5rem; padding: 0.5rem; background: #f1f5f9; font-family: monospace; color: #1e293b;">${escapeHtml(detail.example)}</div>`;
                        }
                        
                        if (detail.outerHTML) {
                            bodyHTML += `<div style="font-size: 0.75rem; margin-top: 0.5rem; padding: 0.5rem; background: #f8fafc; font-family: monospace; color: #64748b; overflow-x: auto;">${escapeHtml(detail.outerHTML)}</div>`;
                        }
                        
                        bodyHTML += '</div>';
                    }
                });
                
                if (issue.details.length > 5) {
                    bodyHTML += `<div style="font-size: 0.875rem; color: #64748b; font-style: italic;">...and ${issue.details.length - 5} more</div>`;
                }
                
                bodyHTML += '</div>';
            }
            
            bodyHTML += `</div>`;
        });
        bodyHTML += `</div>`;
    }
    
    // Serious issues
    if (result.issues.serious.length > 0) {
        bodyHTML += `
            <div class="issue-section">
                <h4>Serious Issues<span class="issue-count" style="background: #f59e0b;">${result.issues.serious.length}</span></h4>
        `;
        result.issues.serious.forEach(issue => {
            bodyHTML += `
                <div class="issue-item serious">
                    <strong>${escapeHtml(issue.type)}${issue.count > 1 ? ` (${issue.count})` : ''}</strong>
                    <div>${escapeHtml(issue.message)}</div>
                    <div style="font-size: 0.875rem; color: #64748b; margin-top: 0.5rem;">${escapeHtml(issue.wcag)}</div>
            `;
            
            // Show details if available
            if (issue.details && issue.details.length > 0) {
                bodyHTML += '<div style="margin-top: 1rem; padding: 1rem; background: #fffbeb; border-left: 3px solid #f59e0b;">';
                bodyHTML += '<strong style="display: block; margin-bottom: 0.5rem; color: #1e293b;">Found Issues:</strong>';
                
                issue.details.forEach((detail, idx) => {
                    if (idx < 5) {
                        bodyHTML += '<div style="margin-bottom: 0.75rem; padding-bottom: 0.75rem; border-bottom: 1px solid #e5e7eb;">';
                        
                        if (detail.position) {
                            bodyHTML += `<div style="font-weight: 600; color: #1e293b; margin-bottom: 0.25rem;">${escapeHtml(detail.position)}</div>`;
                        }
                        
                        if (detail.src) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #64748b;">Source: ${escapeHtml(detail.src)}</div>`;
                        }
                        
                        if (detail.href) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #64748b;">Link: ${escapeHtml(detail.href)}</div>`;
                        }
                        
                        if (detail.explanation) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #475569; margin-top: 0.25rem;">${escapeHtml(detail.explanation)}</div>`;
                        }
                        
                        if (detail.example) {
                            bodyHTML += `<div style="font-size: 0.8125rem; margin-top: 0.5rem; padding: 0.5rem; background: #fef3c7; font-family: monospace; color: #1e293b;">${escapeHtml(detail.example)}</div>`;
                        }
                        
                        if (detail.current) {
                            bodyHTML += `<div style="font-size: 0.75rem; margin-top: 0.5rem;"><strong>Current:</strong></div>`;
                            bodyHTML += `<div style="font-size: 0.75rem; padding: 0.5rem; background: #f8fafc; font-family: monospace; color: #64748b; overflow-x: auto;">${escapeHtml(detail.current)}</div>`;
                        }
                        
                        if (detail.fix) {
                            bodyHTML += `<div style="font-size: 0.875rem; margin-top: 0.5rem; color: #475569;">${escapeHtml(detail.fix)}</div>`;
                        }
                        
                        if (detail.outerHTML) {
                            bodyHTML += `<div style="font-size: 0.75rem; margin-top: 0.5rem; padding: 0.5rem; background: #f8fafc; font-family: monospace; color: #64748b; overflow-x: auto;">${escapeHtml(detail.outerHTML)}</div>`;
                        }
                        
                        bodyHTML += '</div>';
                    }
                });
                
                if (issue.details.length > 5) {
                    bodyHTML += `<div style="font-size: 0.875rem; color: #64748b; font-style: italic;">...and ${issue.details.length - 5} more</div>`;
                }
                
                bodyHTML += '</div>';
            }
            
            bodyHTML += `</div>`;
        });
        bodyHTML += `</div>`;
    }
    
    // Moderate issues
    if (result.issues.moderate.length > 0) {
        bodyHTML += `
            <div class="issue-section">
                <h4>Moderate Issues<span class="issue-count" style="background: #3b82f6;">${result.issues.moderate.length}</span></h4>
        `;
        result.issues.moderate.forEach(issue => {
            bodyHTML += `
                <div class="issue-item moderate">
                    <strong>${escapeHtml(issue.type)}${issue.count > 1 ? ` (${issue.count})` : ''}</strong>
                    <div>${escapeHtml(issue.message)}</div>
                    <div style="font-size: 0.875rem; color: #64748b; margin-top: 0.5rem;">${escapeHtml(issue.wcag)}</div>
            `;
            
            // Show details if available
            if (issue.details && issue.details.length > 0) {
                bodyHTML += '<div style="margin-top: 1rem; padding: 1rem; background: #eff6ff; border-left: 3px solid #3b82f6;">';
                bodyHTML += '<strong style="display: block; margin-bottom: 0.5rem; color: #1e293b;">Found Issues:</strong>';
                
                issue.details.forEach((detail, idx) => {
                    if (idx < 5) {
                        bodyHTML += '<div style="margin-bottom: 0.75rem; padding-bottom: 0.75rem; border-bottom: 1px solid #e5e7eb;">';
                        
                        if (detail.position) {
                            bodyHTML += `<div style="font-weight: 600; color: #1e293b; margin-bottom: 0.25rem;">${escapeHtml(detail.position)}</div>`;
                        }
                        
                        if (detail.issue) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #ef4444; margin-bottom: 0.25rem;">${escapeHtml(detail.issue)}</div>`;
                        }
                        
                        if (detail.text) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #64748b;">Text: "${escapeHtml(detail.text)}"</div>`;
                        }
                        
                        if (detail.href) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #64748b;">Link: ${escapeHtml(detail.href)}</div>`;
                        }
                        
                        if (detail.tag) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #64748b;">Tag: &lt;${escapeHtml(detail.tag)}&gt;</div>`;
                        }
                        
                        if (detail.style) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #64748b;">Style: ${escapeHtml(detail.style)}</div>`;
                        }
                        
                        if (detail.tabindex) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #64748b;">Tabindex: ${escapeHtml(detail.tabindex)}</div>`;
                        }
                        
                        if (detail.explanation) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #475569; margin-top: 0.25rem;">${escapeHtml(detail.explanation)}</div>`;
                        }
                        
                        if (detail.recommendation) {
                            bodyHTML += `<div style="font-size: 0.875rem; color: #475569; margin-top: 0.25rem;">${escapeHtml(detail.recommendation)}</div>`;
                        }
                        
                        if (detail.example) {
                            bodyHTML += `<div style="font-size: 0.8125rem; margin-top: 0.5rem; padding: 0.5rem; background: #dbeafe; font-family: monospace; color: #1e293b;">${escapeHtml(detail.example)}</div>`;
                        }
                        
                        if (detail.outerHTML) {
                            bodyHTML += `<div style="font-size: 0.75rem; margin-top: 0.5rem; padding: 0.5rem; background: #f8fafc; font-family: monospace; color: #64748b; overflow-x: auto;">${escapeHtml(detail.outerHTML)}</div>`;
                        }
                        
                        bodyHTML += '</div>';
                    }
                });
                
                if (issue.details.length > 5) {
                    bodyHTML += `<div style="font-size: 0.875rem; color: #64748b; font-style: italic;">...and ${issue.details.length - 5} more</div>`;
                }
                
                bodyHTML += '</div>';
            }
            
            bodyHTML += `</div>`;
        });
        bodyHTML += `</div>`;
    }
    
    // No issues
    if (result.totalIssues === 0) {
        bodyHTML += `
            <div class="issue-section">
                <h4>Accessibility Status</h4>
                <div style="padding: 1rem; background: #ecfdf5; border-left: 3px solid #10b981;">
                    <strong>Fully Compliant</strong><br>
                    This page has no detected accessibility issues and meets WCAG 2.1 guidelines.
                </div>
            </div>
        `;
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
    
    let csv = 'URL,Score,Compliance,Critical Issues,Serious Issues,Moderate Issues,Total Issues\n';
    
    scanResults.forEach(result => {
        const compliance = result.score >= 90 ? 'Compliant' : 
                          result.score >= 70 ? 'Partial' : 'Non-Compliant';
        
        const row = [
            result.url,
            result.score + '%',
            compliance,
            result.criticalCount,
            result.seriousCount,
            result.moderateCount,
            result.totalIssues
        ];
        csv += row.map(cell => `"${cell}"`).join(',') + '\n';
    });
    
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `accessibility-scan-${new Date().toISOString().split('T')[0]}.csv`;
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
        // mwWindow('wAccessibility').show();
    }, 500);
});
</script>
<?php
// views/performance/desktop.php: Template for performance checking tool
$mwLoad->Window( 'wPerformance', 'performance/index' );

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

// API endpoint to fetch page content and measure load time
if (isset($_GET['api']) && $_GET['api'] === 'fetch') {
    header('Content-Type: application/json');
    
    $page_url = isset($_GET['url']) ? $_GET['url'] : '';
    
    if (empty($page_url)) {
        echo json_encode(['error' => 'No page URL provided']);
        exit;
    }
    
    $start_time = microtime(true);
    
    $context = stream_context_create([
        'http' => [
            'timeout' => 10,
            'user_agent' => 'Performance Checker Tool/1.0'
        ]
    ]);
    
    $html = @file_get_contents($page_url, false, $context);
    
    $load_time = microtime(true) - $start_time;
    
    if ($html === false) {
        echo json_encode(['error' => 'Failed to fetch page']);
        exit;
    }
    
    echo json_encode([
        'html' => $html,
        'loadTime' => round($load_time, 3)
    ]);
    exit;
}

// API endpoint to get image file size
if (isset($_GET['api']) && $_GET['api'] === 'image-size') {
    header('Content-Type: application/json');
    
    $image_url = isset($_GET['url']) ? $_GET['url'] : '';
    
    if (empty($image_url)) {
        echo json_encode(['error' => 'No image URL provided']);
        exit;
    }
    
    $headers = @get_headers($image_url, 1);
    
    if ($headers === false) {
        echo json_encode(['size' => 0]);
        exit;
    }
    
    $size = 0;
    if (isset($headers['Content-Length'])) {
        $size = is_array($headers['Content-Length']) ? 
                end($headers['Content-Length']) : 
                $headers['Content-Length'];
    }
    
    echo json_encode(['size' => (int)$size]);
    exit;
}

// Get current site URL for default sitemap
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$default_sitemap_url = $protocol . '://' . $host . '/sitemap.xml';
?>
<style>
.performance-main * {
    box-sizing: border-box;
}

.performance-main {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 0;
}

.performance-main .app-content {
    max-width: 100%;
    margin: 0 auto;
    padding: 0;
}

.performance-main .container {
    width: 100%;
}

/* Hero Section */
.performance-main .hero {
    background: #2EB7A0;
    color: white;
    padding: 3rem 2rem;
    margin-bottom: 2rem;
}

.performance-main .hero-content {
    margin: 0 auto 2rem;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 2rem;
}

.performance-main .hero-eyebrow {
    display: inline-block;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.25rem 0.75rem;
    margin-bottom: 0.5rem;
}

.performance-main .hero-title {
    font-size: 2rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
}

.performance-main .hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.95;
    margin: 0;
    line-height: 1.5;
}

.performance-main .hero-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.75rem;
}

/* Overview Cards */
.performance-main .overview-grid {
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
}

.performance-main .overview-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 1.5rem;
    text-align: center;
}

.performance-main .overview-value {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    line-height: 1;
}

.performance-main .overview-label {
    font-size: 0.875rem;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 500;
}

/* Buttons */
.performance-main .btn {
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

.performance-main .btn-primary {
    background: white;
    color: #2EB7A0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.performance-main .btn-primary:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.performance-main .btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.performance-main .btn-export {
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

.performance-main .btn-export:hover {
    background: #259887;
    transform: translateY(-1px);
}

.performance-main .btn-view-details {
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

.performance-main .btn-view-details:hover {
    background: #259887;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(46, 183, 160, 0.2);
}

/* Status Messages */
.performance-main .status {
    display: none;
    padding: 1rem;
    margin: 1rem 2rem;
    text-align: center;
}

.performance-main .status.show {
    display: block;
}

.performance-main .status.loading {
    background: #e3f2fd;
    color: #1976d2;
    border: 1px solid #90caf9;
}

.performance-main .status.error {
    background: #ffebee;
    color: #c62828;
    border: 1px solid #ef9a9a;
}

.performance-main .status.success {
    background: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #a5d6a7;
}

.performance-main .spinner {
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
.performance-main .progress-bar {
    margin: 1.5rem auto 0;
    height: 8px;
    background: rgba(255, 255, 255, 0.3);
    overflow: hidden;
}

.performance-main .progress-fill {
    height: 100%;
    background: white;
    width: 0%;
    transition: width 0.3s ease;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

/* Results Container */
.performance-main .results-container {
    display: none;
    margin: 0 auto;
    padding: 0 2rem 2rem;
}

.performance-main .results-container.show {
    display: block;
}

/* Cards */
.performance-main .card {
    background: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    padding: 2rem;
    margin-bottom: 2rem;
}

.performance-main .card h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a202c;
    margin: 0 0 1.5rem 0;
}

/* Legend */
.performance-main .legend {
    display: flex;
    gap: 2rem;
    padding: 1rem 1.5rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    margin-bottom: 1.5rem;
}

.performance-main .legend-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #64748b;
}

.performance-main .legend-color {
    width: 1rem;
    height: 1rem;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.performance-main .legend-color.green {
    background: #10b981;
}

.performance-main .legend-color.yellow {
    background: #f59e0b;
}

.performance-main .legend-color.red {
    background: #ef4444;
}

/* Table */
.performance-main .table-wrapper {
    overflow-x: auto;
    margin-top: 1rem;
    border: 1px solid #e2e8f0;
    background: white;
}

.performance-main table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}

.performance-main thead {
    background: #f8fafc;
    border-bottom: 2px solid #e2e8f0;
}

.performance-main th {
    padding: 1.25rem 1.5rem;
    text-align: left;
    font-weight: 600;
    color: #1e293b;
    font-size: 0.8125rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    white-space: nowrap;
}

.performance-main td {
    padding: 1.5rem;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: top;
}

.performance-main tbody tr {
    transition: background 0.15s;
}

.performance-main tbody tr:hover {
    background: #fafbfc;
}

.performance-main tbody tr:last-child td {
    border-bottom: none;
}

.performance-main .page-link {
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

.performance-main .page-link:hover {
    color: #259887;
    text-decoration: underline;
}

.performance-main .performance-badge {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.performance-main .perf-excellent {
    background: #d1fae5;
    color: #065f46;
}

.performance-main .perf-good {
    background: #dbeafe;
    color: #1e40af;
}

.performance-main .perf-fair {
    background: #fef3c7;
    color: #92400e;
}

.performance-main .perf-poor {
    background: #fee2e2;
    color: #991b1b;
}

.performance-main .issue-badge {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 500;
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fca5a5;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
}

.performance-main .load-time {
    font-size: 1.25rem;
    font-weight: 600;
}

.performance-main .load-time.fast {
    color: #10b981;
}

.performance-main .load-time.moderate {
    color: #f59e0b;
}

.performance-main .load-time.slow {
    color: #ef4444;
}

/* Modal */
.performance-main .modal {
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

.performance-main .modal.show {
    display: flex;
    align-items: center;
    justify-content: center;
}

.performance-main .modal-content {
    background-color: white;
    margin: 2rem;
    padding: 2.5rem 2.5rem 2rem;
    width: 90%;
    max-width: 800px;
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

.performance-main .modal-close {
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

.performance-main .modal-close:hover {
    background: #e2e8f0;
    color: #1e293b;
    transform: scale(1.1);
}

.performance-main #modal-title {
    margin: 0 0 0.75rem 0;
    padding-right: 2.75rem;
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a202c;
}

.performance-main #modal-body {
    margin-top: 1.5rem;
    line-height: 1.6;
    color: #475569;
}

.performance-main .metric-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin: 1.5rem 0;
}

.performance-main .metric-card {
    padding: 1rem;
    background: #f8fafc;
    border-left: 3px solid #2EB7A0;
}

.performance-main .metric-label {
    font-size: 0.75rem;
    color: #64748b;
    text-transform: uppercase;
    margin-bottom: 0.25rem;
}

.performance-main .metric-value {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1e293b;
}

.performance-main .issue-section {
    margin: 1.5rem 0;
}

.performance-main .issue-section h4 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 1rem 0;
}

.performance-main .issue-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.performance-main .issue-item {
    padding: 1rem;
    background: #fff7ed;
    border-left: 3px solid #f59e0b;
    margin-bottom: 0.75rem;
}

.performance-main .issue-item.critical {
    background: #fef2f2;
    border-left-color: #ef4444;
}

.performance-main .issue-item strong {
    display: block;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.performance-main .image-issue {
    padding: 1rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    margin-bottom: 0.75rem;
}

.performance-main .image-issue img {
    max-width: 100px;
    max-height: 100px;
    display: block;
    margin: 0.5rem 0;
    border: 1px solid #e2e8f0;
}

.performance-main .image-info {
    font-size: 0.875rem;
    color: #64748b;
    margin-top: 0.5rem;
}
</style>

<div class="mwDskTools">
  <h1>Performance Checker</h1>
</div>

<div class="mwDesktop">
  <main class="performance-main">
    <div class="app-content">
      <div class="container">
        
        <div class="hero">
          <div class="hero-content">
            <div>
              <span class="hero-eyebrow">Speed & Optimization</span>
              <h2 class="hero-title">Performance Checker Dashboard</h2>
              <p class="hero-subtitle">Measure page load times and identify optimization opportunities across your site.</p>
            </div>
            <div class="hero-actions">
              <button type="button" id="scan-btn" class="btn btn-primary" onclick="startScan()">
                <span>Check All Pages</span>
              </button>
            </div>
          </div>
          
          <div class="overview-grid">
            <div class="overview-card">
              <div class="overview-value" id="pages-scanned">0</div>
              <div class="overview-label">Pages Scanned</div>
            </div>
            <div class="overview-card">
              <div class="overview-value" id="avg-load-time">0s</div>
              <div class="overview-label">Avg Load Time</div>
            </div>
            <div class="overview-card">
              <div class="overview-value" id="slow-pages">0</div>
              <div class="overview-label">Slow Pages (&gt;2s)</div>
            </div>
            <div class="overview-card">
              <div class="overview-value" id="image-issues">0</div>
              <div class="overview-label">Image Issues</div>
            </div>
          </div>
          
          <div class="progress-bar" id="progress-bar" style="display: none;">
            <div class="progress-fill" id="progress-fill"></div>
          </div>
        </div>

        <div id="status" class="status"></div>

        <div class="results-container" id="results-container">
          <div class="card">
            <h2>Performance Analysis Results</h2>
            <button class="btn-export" onclick="exportToCSV()">
              Export CSV
            </button>
            
            <div class="legend">
              <div class="legend-item">
                <div class="legend-color green"></div>
                <span>Excellent (&lt;1s)</span>
              </div>
              <div class="legend-item">
                <div class="legend-color yellow"></div>
                <span>Fair (1-2s)</span>
              </div>
              <div class="legend-item">
                <div class="legend-color red"></div>
                <span>Slow (&gt;2s)</span>
              </div>
            </div>
            
            <div class="table-wrapper">
              <table id="results-table">
                <thead>
                  <tr>
                    <th>URL</th>
                    <th>Load Time</th>
                    <th>Performance</th>
                    <th>Images</th>
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

    <!-- Modal for performance details -->
    <div id="details-modal" class="modal">
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
let slowPagesCount = 0;
let totalImageIssues = 0;
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
        `<div class="spinner"></div> Checking page ${current} of ${total} (${percentage}%)...`,
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

// Fetch page content and measure load time
async function fetchPage(pageUrl) {
    try {
        const response = await fetch(`?api=fetch&url=${encodeURIComponent(pageUrl)}`);
        const data = await response.json();
        
        if (data.error) {
            throw new Error(data.error);
        }
        
        return {
            html: data.html,
            loadTime: data.loadTime
        };
    } catch (error) {
        console.error(`Failed to fetch ${pageUrl}:`, error);
        return null;
    }
}

// Get image file size
async function getImageSize(imageUrl) {
    try {
        const response = await fetch(`?api=image-size&url=${encodeURIComponent(imageUrl)}`);
        const data = await response.json();
        return data.size || 0;
    } catch (error) {
        console.error(`Failed to get size for ${imageUrl}:`, error);
        return 0;
    }
}

// Format bytes to human readable
function formatBytes(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

// Analyze page performance
async function analyzePage(html, url) {
    const parser = new DOMParser();
    const doc = parser.parseFromString(html, 'text/html');
    
    const issues = [];
    const imageIssues = [];
    
    // Check images
    const images = doc.querySelectorAll('img');
    let totalImages = images.length;
    let imagesWithoutAlt = 0;
    let largeImages = 0;
    
    for (const img of images) {
        const src = img.getAttribute('src');
        const alt = img.getAttribute('alt');
        const width = img.getAttribute('width') || img.naturalWidth;
        const height = img.getAttribute('height') || img.naturalHeight;
        
        let imageUrl = src;
        
        // Normalize image URL
        if (src && !src.startsWith('http') && !src.startsWith('data:')) {
            try {
                imageUrl = new URL(src, url).href;
            } catch (e) {
                imageUrl = src;
            }
        }
        
        const imageIssue = {
            src: imageUrl,
            alt: alt || '',
            width: width,
            height: height,
            problems: []
        };
        
        // Check for missing alt text
        if (!alt || alt.trim() === '') {
            imagesWithoutAlt++;
            imageIssue.problems.push('Missing alt text');
        }
        
        // Check for large dimensions
        if (width > 1920 || height > 1080) {
            imageIssue.problems.push(`Large dimensions: ${width}x${height}px`);
        }
        
        // Check file size for non-data URLs
        if (imageUrl && imageUrl.startsWith('http')) {
            try {
                const size = await getImageSize(imageUrl);
                imageIssue.size = size;
                
                // 500KB threshold
                if (size > 500000) {
                    largeImages++;
                    imageIssue.problems.push(`Large file size: ${formatBytes(size)}`);
                }
            } catch (e) {
                // Skip size check if failed
            }
        }
        
        if (imageIssue.problems.length > 0) {
            imageIssues.push(imageIssue);
        }
    }
    
    // Build issues summary
    if (imagesWithoutAlt > 0) {
        issues.push({
            type: 'warning',
            message: `${imagesWithoutAlt} image${imagesWithoutAlt > 1 ? 's' : ''} missing alt text`
        });
    }
    
    if (largeImages > 0) {
        issues.push({
            type: 'critical',
            message: `${largeImages} large image${largeImages > 1 ? 's' : ''} (&gt;500KB)`
        });
    }
    
    return {
        totalImages,
        imagesWithoutAlt,
        largeImages,
        issues,
        imageIssues
    };
}

// Scan a single page
async function scanPage(url) {
    const pageData = await fetchPage(url);
    
    if (!pageData) {
        return {
            url: url,
            loadTime: 0,
            totalImages: 0,
            imagesWithoutAlt: 0,
            largeImages: 0,
            issues: [{
                type: 'critical',
                message: 'Failed to load page'
            }],
            imageIssues: []
        };
    }
    
    const analysis = await analyzePage(pageData.html, url);
    
    return {
        url: url,
        loadTime: pageData.loadTime,
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
    slowPagesCount = 0;
    totalImageIssues = 0;
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
        showStatus(`<div class="spinner"></div> Found ${totalPages} pages. Starting performance check...`, 'loading');
        await delay(500);
        
        // Scan each page
        for (let i = 0; i < urls.length; i++) {
            updateProgress(i + 1, totalPages);
            
            const result = await scanPage(urls[i]);
            scanResults.push(result);
            scannedPages++;
            
            if (result.loadTime > 2) {
                slowPagesCount++;
            }
            
            totalImageIssues += result.imageIssues.length;
            
            await delay(150);
        }
        
        // Show results
        displayResults();
        showStatus('Scan complete! Analyzed ' + scannedPages + ' pages.', 'success');
        setTimeout(hideStatus, 3000);
        
    } catch (error) {
        showStatus(`Error: ${error.message}`, 'error');
    } finally {
        scanBtn.disabled = false;
        scanBtn.innerHTML = '<span>Check All Pages</span>';
        document.getElementById('progress-bar').style.display = 'none';
    }
}

// Display results in table
function displayResults() {
    const resultsContainer = document.getElementById('results-container');
    const tbody = document.getElementById('results-tbody');
    
    // Calculate stats
    let totalLoadTime = 0;
    scanResults.forEach(result => {
        totalLoadTime += result.loadTime;
    });
    
    const avgLoadTime = scannedPages > 0 ? (totalLoadTime / scannedPages).toFixed(2) : 0;
    
    // Update summary stats
    document.getElementById('pages-scanned').textContent = scannedPages;
    document.getElementById('avg-load-time').textContent = avgLoadTime + 's';
    document.getElementById('slow-pages').textContent = slowPagesCount;
    document.getElementById('image-issues').textContent = totalImageIssues;
    
    // Clear existing rows
    tbody.innerHTML = '';
    
    // Create rows
    scanResults.forEach((result, index) => {
        const row = document.createElement('tr');
        
        const loadTime = result.loadTime;
        const loadTimeClass = loadTime < 1 ? 'fast' : loadTime < 2 ? 'moderate' : 'slow';
        
        const performance = loadTime < 1 ? 'Excellent' : 
                          loadTime < 2 ? 'Good' : 
                          loadTime < 3 ? 'Fair' : 'Poor';
        const perfClass = loadTime < 1 ? 'perf-excellent' : 
                         loadTime < 2 ? 'perf-good' : 
                         loadTime < 3 ? 'perf-fair' : 'perf-poor';
        
        // Build issues HTML
        let issuesHTML = '';
        if (result.issues.length === 0) {
            issuesHTML = '<span style="color: #10b981; font-size: 0.875rem; font-weight: 500;">None</span>';
        } else {
            issuesHTML = '<div>';
            result.issues.slice(0, 2).forEach(issue => {
                issuesHTML += `<span class="issue-badge">${issue.message}</span>`;
            });
            if (result.issues.length > 2) {
                issuesHTML += `<span style="color: #64748b; font-size: 0.75rem;">+${result.issues.length - 2} more</span>`;
            }
            issuesHTML += '</div>';
        }
        
        row.innerHTML = `
            <td><a href="${escapeHtml(result.url)}" target="_blank" class="page-link">${escapeHtml(result.url)}</a></td>
            <td><span class="load-time ${loadTimeClass}">${loadTime}s</span></td>
            <td><span class="performance-badge ${perfClass}">${performance}</span></td>
            <td>${result.totalImages} (${result.imagesWithoutAlt} no alt)</td>
            <td>${issuesHTML}</td>
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

// Show performance details modal
function showDetails(index) {
    const result = scanResults[index];
    if (!result) return;
    
    const modal = document.getElementById('details-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalBody = document.getElementById('modal-body');
    
    modalTitle.textContent = result.url;
    
    const loadTimeClass = result.loadTime < 1 ? 'fast' : result.loadTime < 2 ? 'moderate' : 'slow';
    
    let bodyHTML = `
        <div class="metric-grid">
            <div class="metric-card">
                <div class="metric-label">Load Time</div>
                <div class="metric-value load-time ${loadTimeClass}">${result.loadTime}s</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Total Images</div>
                <div class="metric-value">${result.totalImages}</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Missing Alt</div>
                <div class="metric-value">${result.imagesWithoutAlt}</div>
            </div>
        </div>
    `;
    
    // Performance assessment
    if (result.loadTime > 2) {
        bodyHTML += `
            <div class="issue-section">
                <h4>⚠️ Performance Warning</h4>
                <div class="issue-item critical">
                    <strong>Slow Page Load</strong>
                    This page took ${result.loadTime} seconds to load, which is above the recommended 2-second threshold. Users may experience delays.
                </div>
            </div>
        `;
    } else {
        bodyHTML += `
            <div class="issue-section">
                <h4>✅ Performance Status</h4>
                <div style="padding: 1rem; background: #ecfdf5; border-left: 3px solid #10b981;">
                    <strong>Good Load Time</strong><br>
                    This page loads in ${result.loadTime} seconds, which meets performance standards.
                </div>
            </div>
        `;
    }
    
    // Image issues
    if (result.imageIssues.length > 0) {
        bodyHTML += `
            <div class="issue-section">
                <h4>🖼️ Image Optimization Issues</h4>
        `;
        
        result.imageIssues.forEach(img => {
            const problemsList = img.problems.join(', ');
            bodyHTML += `
                <div class="image-issue">
                    <strong>Image Issues Found:</strong>
                    <div style="color: #ef4444; margin: 0.5rem 0;">${problemsList}</div>
                    <img src="${escapeHtml(img.src)}" alt="${escapeHtml(img.alt)}" onerror="this.style.display='none'">
                    <div class="image-info">
                        <strong>Source:</strong> ${escapeHtml(img.src)}<br>
                        ${img.width && img.height ? `<strong>Dimensions:</strong> ${img.width}x${img.height}px<br>` : ''}
                        ${img.size ? `<strong>File Size:</strong> ${formatBytes(img.size)}<br>` : ''}
                        ${img.alt ? `<strong>Alt Text:</strong> "${escapeHtml(img.alt)}"` : '<strong>Alt Text:</strong> <span style="color: #ef4444;">Missing</span>'}
                    </div>
                </div>
            `;
        });
        
        bodyHTML += `</div>`;
    } else {
        bodyHTML += `
            <div class="issue-section">
                <h4>✅ Image Optimization</h4>
                <div style="padding: 1rem; background: #ecfdf5; border-left: 3px solid #10b981;">
                    All images are properly optimized with appropriate alt text and file sizes.
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

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('details-modal');
    if (event.target === modal) {
        modal.classList.remove('show');
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
    
    let csv = 'URL,Load Time (s),Performance,Total Images,Images Missing Alt,Large Images,Issues\n';
    
    scanResults.forEach(result => {
        const performance = result.loadTime < 1 ? 'Excellent' : 
                          result.loadTime < 2 ? 'Good' : 
                          result.loadTime < 3 ? 'Fair' : 'Poor';
        const issues = result.issues.map(i => i.message).join('; ');
        
        const row = [
            result.url,
            result.loadTime,
            performance,
            result.totalImages,
            result.imagesWithoutAlt,
            result.largeImages,
            issues || 'None'
        ];
        csv += row.map(cell => `"${cell}"`).join(',') + '\n';
    });
    
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `performance-check-${new Date().toISOString().split('T')[0]}.csv`;
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
        // mwWindow('wPerformance').show();
    }, 500);
});
</script>
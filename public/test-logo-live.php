<!DOCTYPE html>
<html>
<head>
    <title>Logo Test - Live Check</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin: 20px 0;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        h1 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        h2 {
            color: #333;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo-test {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
            margin: 30px 0;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 3px dashed #ddd;
            min-height: 250px;
        }
        .logo-box {
            text-align: center;
        }
        .logo-box img {
            max-width: 200px;
            max-height: 200px;
            border: 3px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            background: white;
            transition: all 0.3s;
        }
        .logo-box img.loaded {
            border-color: #28a745;
            box-shadow: 0 0 20px rgba(40, 167, 69, 0.3);
        }
        .logo-box img.error {
            border-color: #dc3545;
            box-shadow: 0 0 20px rgba(220, 53, 69, 0.3);
        }
        .logo-box label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #666;
            font-size: 14px;
        }
        .status {
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            font-weight: 500;
        }
        .status.success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .status.error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        .status.info {
            background: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #0c5460;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background: #667eea;
            color: white;
            font-weight: 600;
        }
        table tr:nth-child(even) {
            background: #f8f9fa;
        }
        .url-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #667eea;
            margin: 15px 0;
            font-family: 'Courier New', monospace;
            word-break: break-all;
            font-size: 13px;
        }
        .refresh-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-block;
            margin: 10px 5px;
        }
        .refresh-btn:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        .icon { display: inline-block; margin-right: 8px; }
        .spinner {
            animation: spin 1s linear infinite;
            display: inline-block;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Logo System - Live Test</h1>
        
        <?php
        require __DIR__ . '/../vendor/autoload.php';
        $app = require_once __DIR__ . '/../bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        
        $logoWebsite = \App\Models\LogoWebsite::where('status', true)->first();
        $logoAdmin = \App\Models\LogoAdmin::where('status', true)->first();
        $timestamp = time();
        ?>
        
        <!-- Logo Website -->
        <div class="card">
            <h2>🌐 Logo Website</h2>
            
            <?php if($logoWebsite): ?>
                <div class="status success">
                    <span class="icon">✅</span> Logo Website Aktif Ditemukan!
                </div>
                
                <table>
                    <tr>
                        <th>Property</th>
                        <th>Value</th>
                    </tr>
                    <tr>
                        <td><strong>ID</strong></td>
                        <td><?php echo $logoWebsite->id; ?></td>
                    </tr>
                    <tr>
                        <td><strong>File Path</strong></td>
                        <td><?php echo $logoWebsite->gambar; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Database Timestamp</strong></td>
                        <td><?php echo $logoWebsite->updated_at->format('Y-m-d H:i:s'); ?> (<?php echo $logoWebsite->updated_at->timestamp; ?>)</td>
                    </tr>
                    <tr>
                        <td><strong>File Size</strong></td>
                        <td>
                            <?php 
                            $path = storage_path('app/public/' . $logoWebsite->gambar);
                            echo file_exists($path) ? number_format(filesize($path)/1024, 2) . ' KB' : 'File not found';
                            ?>
                        </td>
                    </tr>
                </table>
                
                <div class="url-box">
                    <strong>URL dengan Cache Busting:</strong><br>
                    <?php echo asset('storage/' . $logoWebsite->gambar) . '?v=' . $logoWebsite->updated_at->timestamp; ?>
                </div>
                
                <div class="logo-test">
                    <div class="logo-box">
                        <img id="logoWebsite1" 
                             src="<?php echo asset('storage/' . $logoWebsite->gambar) . '?v=' . $logoWebsite->updated_at->timestamp; ?>" 
                             alt="Logo Website">
                        <label>With Cache Busting</label>
                    </div>
                    <div class="logo-box">
                        <img id="logoWebsite2" 
                             src="<?php echo asset('storage/' . $logoWebsite->gambar); ?>" 
                             alt="Logo Website">
                        <label>Without Cache Busting</label>
                    </div>
                    <div class="logo-box">
                        <img id="logoWebsite3" 
                             src="/storage/<?php echo $logoWebsite->gambar; ?>?t=<?php echo $timestamp; ?>" 
                             alt="Logo Website">
                        <label>Direct Path + Random</label>
                    </div>
                </div>
            <?php else: ?>
                <div class="status error">
                    <span class="icon">❌</span> Tidak ada Logo Website aktif!
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Logo Admin -->
        <div class="card">
            <h2>🛡️ Logo Admin</h2>
            
            <?php if($logoAdmin): ?>
                <div class="status success">
                    <span class="icon">✅</span> Logo Admin Aktif Ditemukan!
                </div>
                
                <table>
                    <tr>
                        <th>Property</th>
                        <th>Value</th>
                    </tr>
                    <tr>
                        <td><strong>ID</strong></td>
                        <td><?php echo $logoAdmin->id; ?></td>
                    </tr>
                    <tr>
                        <td><strong>File Path</strong></td>
                        <td><?php echo $logoAdmin->gambar; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Database Timestamp</strong></td>
                        <td><?php echo $logoAdmin->updated_at->format('Y-m-d H:i:s'); ?> (<?php echo $logoAdmin->updated_at->timestamp; ?>)</td>
                    </tr>
                    <tr>
                        <td><strong>File Size</strong></td>
                        <td>
                            <?php 
                            $pathAdmin = storage_path('app/public/' . $logoAdmin->gambar);
                            echo file_exists($pathAdmin) ? number_format(filesize($pathAdmin)/1024, 2) . ' KB' : 'File not found';
                            ?>
                        </td>
                    </tr>
                </table>
                
                <div class="url-box">
                    <strong>URL dengan Cache Busting:</strong><br>
                    <?php echo asset('storage/' . $logoAdmin->gambar) . '?v=' . $logoAdmin->updated_at->timestamp; ?>
                </div>
                
                <div class="logo-test">
                    <div class="logo-box">
                        <img id="logoAdmin1" 
                             src="<?php echo asset('storage/' . $logoAdmin->gambar) . '?v=' . $logoAdmin->updated_at->timestamp; ?>" 
                             alt="Logo Admin">
                        <label>With Cache Busting</label>
                    </div>
                    <div class="logo-box">
                        <img id="logoAdmin2" 
                             src="<?php echo asset('storage/' . $logoAdmin->gambar); ?>" 
                             alt="Logo Admin">
                        <label>Without Cache Busting</label>
                    </div>
                    <div class="logo-box">
                        <img id="logoAdmin3" 
                             src="/storage/<?php echo $logoAdmin->gambar; ?>?t=<?php echo $timestamp; ?>" 
                             alt="Logo Admin">
                        <label>Direct Path + Random</label>
                    </div>
                </div>
            <?php else: ?>
                <div class="status error">
                    <span class="icon">❌</span> Tidak ada Logo Admin aktif!
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Actions -->
        <div class="card">
            <h2>🔄 Actions</h2>
            <button class="refresh-btn" onclick="location.reload()">
                <span class="icon">🔄</span> Refresh Page
            </button>
            <button class="refresh-btn" onclick="location.reload(true)">
                <span class="icon">⚡</span> Hard Refresh
            </button>
            <button class="refresh-btn" onclick="clearCacheAndReload()">
                <span class="icon">🗑️</span> Clear Cache & Reload
            </button>
        </div>
        
        <!-- Console Log -->
        <div class="card">
            <h2>📋 Console Log</h2>
            <div id="console" style="background: #1e1e1e; color: #00ff00; padding: 20px; border-radius: 8px; font-family: 'Courier New', monospace; min-height: 200px; max-height: 400px; overflow-y: auto;"></div>
        </div>
    </div>
    
    <script>
        const consoleDiv = document.getElementById('console');
        
        function log(message, type = 'info') {
            const timestamp = new Date().toLocaleTimeString();
            const icon = type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️';
            const color = type === 'success' ? '#00ff00' : type === 'error' ? '#ff0000' : '#00ffff';
            consoleDiv.innerHTML += `<div style="color: ${color}; margin: 5px 0;">[${timestamp}] ${icon} ${message}</div>`;
            consoleDiv.scrollTop = consoleDiv.scrollHeight;
        }
        
        function clearCacheAndReload() {
            log('Clearing cache...', 'info');
            if ('caches' in window) {
                caches.keys().then(names => {
                    names.forEach(name => {
                        caches.delete(name);
                    });
                    log('Cache cleared!', 'success');
                    setTimeout(() => location.reload(true), 500);
                });
            } else {
                log('Cache API not supported', 'error');
                location.reload(true);
            }
        }
        
        // Test all images
        document.querySelectorAll('img').forEach((img, index) => {
            const id = img.id;
            log(`Loading image: ${id}...`, 'info');
            
            img.onload = function() {
                this.classList.add('loaded');
                log(`${id} loaded successfully! (${this.naturalWidth}x${this.naturalHeight})`, 'success');
            };
            
            img.onerror = function() {
                this.classList.add('error');
                this.alt = '❌ FAILED';
                log(`${id} failed to load! URL: ${this.src}`, 'error');
            };
        });
        
        log('Page loaded - Waiting for images...', 'info');
        log('Total images to load: ' + document.querySelectorAll('img').length, 'info');
    </script>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>🔍 Logo Debug - Real Time</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            color: #333;
        }
        .container { max-width: 1400px; margin: 0 auto; }
        h1 { 
            color: white; 
            text-align: center; 
            font-size: 3em; 
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin: 20px 0;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h2 {
            color: #667eea;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 1.8em;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        .info-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #667eea;
        }
        .info-box h3 {
            color: #667eea;
            margin-bottom: 15px;
            font-size: 1.2em;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .info-row:last-child { border-bottom: none; }
        .info-label {
            font-weight: 600;
            color: #666;
        }
        .info-value {
            color: #333;
            word-break: break-all;
            max-width: 60%;
            text-align: right;
        }
        .logo-display {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 10px;
            min-height: 300px;
            position: relative;
        }
        .logo-display img {
            max-width: 250px;
            max-height: 250px;
            border: 5px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            background: white;
            transition: all 0.3s;
        }
        .logo-display img.loaded {
            border-color: #28a745;
            box-shadow: 0 0 30px rgba(40, 167, 69, 0.4);
        }
        .logo-display img.error {
            border-color: #dc3545;
            box-shadow: 0 0 30px rgba(220, 53, 69, 0.4);
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
        }
        .status-badge.success {
            background: #d4edda;
            color: #155724;
        }
        .status-badge.error {
            background: #f8d7da;
            color: #721c24;
        }
        .url-box {
            background: #2d3748;
            color: #68d391;
            padding: 20px;
            border-radius: 8px;
            font-family: 'Monaco', 'Courier New', monospace;
            font-size: 13px;
            word-break: break-all;
            margin: 15px 0;
            position: relative;
        }
        .copy-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #667eea;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }
        .copy-btn:hover { background: #5568d3; }
        .btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin: 10px 5px;
            transition: all 0.3s;
        }
        .btn:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        .console {
            background: #1a202c;
            color: #68d391;
            padding: 20px;
            border-radius: 8px;
            font-family: 'Monaco', 'Courier New', monospace;
            font-size: 13px;
            max-height: 400px;
            overflow-y: auto;
            margin: 20px 0;
        }
        .console-line {
            padding: 3px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .timestamp {
            color: #a0aec0;
            font-size: 11px;
        }
        .spinner {
            display: inline-block;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Logo System Debug - Real Time</h1>
        
        <?php
        require __DIR__ . '/../vendor/autoload.php';
        $app = require_once __DIR__ . '/../bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        
        // Force fresh query
        \Illuminate\Support\Facades\DB::connection()->disableQueryLog();
        $logoWebsite = \App\Models\LogoWebsite::where('status', true)->orderBy('updated_at', 'desc')->first();
        $logoAdmin = \App\Models\LogoAdmin::where('status', true)->orderBy('updated_at', 'desc')->first();
        
        $currentTime = time();
        ?>
        
        <!-- Logo Website -->
        <div class="card">
            <h2>🌐 Logo Website</h2>
            
            <?php if($logoWebsite): ?>
                <div class="grid">
                    <div class="info-box">
                        <h3>📊 Database Info</h3>
                        <div class="info-row">
                            <span class="info-label">ID:</span>
                            <span class="info-value"><?php echo $logoWebsite->id; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status:</span>
                            <span class="info-value">
                                <span class="status-badge success">✅ AKTIF</span>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">File Path:</span>
                            <span class="info-value"><?php echo $logoWebsite->gambar; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Last Updated:</span>
                            <span class="info-value"><?php echo $logoWebsite->updated_at->format('Y-m-d H:i:s'); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Timestamp:</span>
                            <span class="info-value"><?php echo $logoWebsite->updated_at->timestamp; ?></span>
                        </div>
                    </div>
                    
                    <div class="info-box">
                        <h3>📁 File System</h3>
                        <?php 
                        $path = storage_path('app/public/' . $logoWebsite->gambar);
                        $exists = file_exists($path);
                        ?>
                        <div class="info-row">
                            <span class="info-label">File Exists:</span>
                            <span class="info-value">
                                <?php echo $exists ? '<span class="status-badge success">✅ YES</span>' : '<span class="status-badge error">❌ NO</span>'; ?>
                            </span>
                        </div>
                        <?php if($exists): ?>
                        <div class="info-row">
                            <span class="info-label">File Size:</span>
                            <span class="info-value"><?php echo number_format(filesize($path)/1024, 2); ?> KB</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Modified:</span>
                            <span class="info-value"><?php echo date('Y-m-d H:i:s', filemtime($path)); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">MIME Type:</span>
                            <span class="info-value"><?php echo mime_content_type($path); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="url-box">
                    <button class="copy-btn" onclick="copyToClipboard('url-website')">📋 Copy</button>
                    <div id="url-website">
                        <?php echo asset('storage/' . $logoWebsite->gambar) . '?v=' . $logoWebsite->updated_at->timestamp . '&t=' . $currentTime; ?>
                    </div>
                </div>
                
                <div class="logo-display">
                    <img id="logoWebsiteImg" 
                         src="<?php echo asset('storage/' . $logoWebsite->gambar) . '?v=' . $logoWebsite->updated_at->timestamp . '&t=' . $currentTime; ?>" 
                         alt="Logo Website">
                </div>
            <?php else: ?>
                <div class="status-badge error">❌ Tidak ada logo website aktif!</div>
            <?php endif; ?>
        </div>
        
        <!-- Logo Admin -->
        <div class="card">
            <h2>🛡️ Logo Admin</h2>
            
            <?php if($logoAdmin): ?>
                <div class="grid">
                    <div class="info-box">
                        <h3>📊 Database Info</h3>
                        <div class="info-row">
                            <span class="info-label">ID:</span>
                            <span class="info-value"><?php echo $logoAdmin->id; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status:</span>
                            <span class="info-value">
                                <span class="status-badge success">✅ AKTIF</span>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">File Path:</span>
                            <span class="info-value"><?php echo $logoAdmin->gambar; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Last Updated:</span>
                            <span class="info-value"><?php echo $logoAdmin->updated_at->format('Y-m-d H:i:s'); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Timestamp:</span>
                            <span class="info-value"><?php echo $logoAdmin->updated_at->timestamp; ?></span>
                        </div>
                    </div>
                    
                    <div class="info-box">
                        <h3>📁 File System</h3>
                        <?php 
                        $pathAdmin = storage_path('app/public/' . $logoAdmin->gambar);
                        $existsAdmin = file_exists($pathAdmin);
                        ?>
                        <div class="info-row">
                            <span class="info-label">File Exists:</span>
                            <span class="info-value">
                                <?php echo $existsAdmin ? '<span class="status-badge success">✅ YES</span>' : '<span class="status-badge error">❌ NO</span>'; ?>
                            </span>
                        </div>
                        <?php if($existsAdmin): ?>
                        <div class="info-row">
                            <span class="info-label">File Size:</span>
                            <span class="info-value"><?php echo number_format(filesize($pathAdmin)/1024, 2); ?> KB</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Modified:</span>
                            <span class="info-value"><?php echo date('Y-m-d H:i:s', filemtime($pathAdmin)); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">MIME Type:</span>
                            <span class="info-value"><?php echo mime_content_type($pathAdmin); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="url-box">
                    <button class="copy-btn" onclick="copyToClipboard('url-admin')">📋 Copy</button>
                    <div id="url-admin">
                        <?php echo asset('storage/' . $logoAdmin->gambar) . '?v=' . $logoAdmin->updated_at->timestamp . '&t=' . $currentTime; ?>
                    </div>
                </div>
                
                <div class="logo-display">
                    <img id="logoAdminImg" 
                         src="<?php echo asset('storage/' . $logoAdmin->gambar) . '?v=' . $logoAdmin->updated_at->timestamp . '&t=' . $currentTime; ?>" 
                         alt="Logo Admin">
                </div>
            <?php else: ?>
                <div class="status-badge error">❌ Tidak ada logo admin aktif!</div>
            <?php endif; ?>
        </div>
        
        <!-- Actions -->
        <div class="card">
            <h2>🔄 Actions</h2>
            <button class="btn" onclick="location.reload()">🔄 Refresh Page</button>
            <button class="btn" onclick="location.reload(true)">⚡ Hard Refresh</button>
            <button class="btn" onclick="clearAllCache()">🗑️ Clear All Cache</button>
            <a href="/adminui/dashboard" class="btn">🏠 Go to Dashboard</a>
        </div>
        
        <!-- Console -->
        <div class="card">
            <h2>📋 Console Log</h2>
            <div class="console" id="console"></div>
        </div>
    </div>
    
    <script>
        const consoleDiv = document.getElementById('console');
        
        function log(message, type = 'info') {
            const timestamp = new Date().toLocaleTimeString();
            const colors = {
                'info': '#68d391',
                'success': '#48bb78',
                'error': '#f56565',
                'warning': '#ed8936'
            };
            consoleDiv.innerHTML += `
                <div class="console-line">
                    <span class="timestamp">[${timestamp}]</span> 
                    <span style="color: ${colors[type] || colors.info}">${message}</span>
                </div>
            `;
            consoleDiv.scrollTop = consoleDiv.scrollHeight;
            console.log(`[${timestamp}] ${message}`);
        }
        
        function copyToClipboard(id) {
            const text = document.getElementById(id).textContent;
            navigator.clipboard.writeText(text).then(() => {
                log('✅ URL copied to clipboard!', 'success');
                alert('URL copied to clipboard!');
            });
        }
        
        function clearAllCache() {
            log('🗑️ Clearing browser cache...', 'info');
            if ('caches' in window) {
                caches.keys().then(names => {
                    names.forEach(name => caches.delete(name));
                    log('✅ Cache cleared successfully!', 'success');
                    setTimeout(() => location.reload(true), 1000);
                });
            } else {
                log('⚠️ Cache API not supported', 'warning');
                location.reload(true);
            }
        }
        
        // Test images
        log('🚀 Page loaded, testing images...', 'info');
        
        <?php if($logoWebsite): ?>
        const imgWebsite = document.getElementById('logoWebsiteImg');
        imgWebsite.onload = function() {
            this.classList.add('loaded');
            log(`✅ Logo Website loaded! (${this.naturalWidth}x${this.naturalHeight})`, 'success');
        };
        imgWebsite.onerror = function() {
            this.classList.add('error');
            log(`❌ Logo Website FAILED to load! URL: ${this.src}`, 'error');
        };
        <?php endif; ?>
        
        <?php if($logoAdmin): ?>
        const imgAdmin = document.getElementById('logoAdminImg');
        imgAdmin.onload = function() {
            this.classList.add('loaded');
            log(`✅ Logo Admin loaded! (${this.naturalWidth}x${this.naturalHeight})`, 'success');
        };
        imgAdmin.onerror = function() {
            this.classList.add('error');
            log(`❌ Logo Admin FAILED to load! URL: ${this.src}`, 'error');
        };
        <?php endif; ?>
        
        log('⏳ Waiting for images to load...', 'info');
        
        // Check after 2 seconds
        setTimeout(() => {
            const loaded = document.querySelectorAll('img.loaded').length;
            const failed = document.querySelectorAll('img.error').length;
            const total = document.querySelectorAll('.logo-display img').length;
            
            if (failed > 0) {
                log(`⚠️ ${failed}/${total} images failed to load!`, 'error');
                log('💡 Check Network tab (F12) for 404 errors', 'warning');
            } else if (loaded === total) {
                log(`🎉 All images loaded successfully! (${loaded}/${total})`, 'success');
            }
        }, 2000);
    </script>
</body>
</html>

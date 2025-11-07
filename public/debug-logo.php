<!DOCTYPE html>
<html>
<head>
    <title>Debug Logo - Jasa Ibnu</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .debug-box { background: white; padding: 20px; margin: 10px 0; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .logo-preview { max-width: 200px; max-height: 200px; border: 2px solid #ddd; padding: 10px; background: #f8f9fa; }
        .success { color: green; } .error { color: red; }
        table { width: 100%; border-collapse: collapse; }
        table td { padding: 8px; border: 1px solid #ddd; }
        table tr:nth-child(odd) { background: #f9f9f9; }
        .test-img { border: 3px solid red; margin: 10px 0; }
    </style>
</head>
<body>
    <h1>🔍 Debug Logo System</h1>
    
    <div class="debug-box">
        <h2>Logo Website - Database Info</h2>
        <?php
        require __DIR__ . '/../vendor/autoload.php';
        $app = require_once __DIR__ . '/../bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        
        $logoWebsite = \App\Models\LogoWebsite::where('status', true)->first();
        ?>
        <table>
            <tr>
                <td><strong>Status</strong></td>
                <td><?php echo $logoWebsite ? '<span class="success">✅ ADA DATA</span>' : '<span class="error">❌ TIDAK ADA DATA</span>'; ?></td>
            </tr>
            <?php if($logoWebsite): ?>
            <tr>
                <td><strong>ID</strong></td>
                <td><?php echo $logoWebsite->id; ?></td>
            </tr>
            <tr>
                <td><strong>Path di Database</strong></td>
                <td><?php echo $logoWebsite->gambar; ?></td>
            </tr>
            <tr>
                <td><strong>URL dengan asset()</strong></td>
                <td><?php echo asset('storage/' . $logoWebsite->gambar); ?></td>
            </tr>
            <tr>
                <td><strong>File Exists?</strong></td>
                <td>
                    <?php 
                    $filePath = storage_path('app/public/' . $logoWebsite->gambar);
                    echo file_exists($filePath) ? '<span class="success">✅ YA</span>' : '<span class="error">❌ TIDAK</span>';
                    echo '<br><small>' . $filePath . '</small>';
                    ?>
                </td>
            </tr>
            <tr>
                <td><strong>File Size</strong></td>
                <td><?php echo file_exists($filePath) ? number_format(filesize($filePath) / 1024, 2) . ' KB' : 'N/A'; ?></td>
            </tr>
            <tr>
                <td><strong>Created At</strong></td>
                <td><?php echo $logoWebsite->created_at->format('Y-m-d H:i:s'); ?></td>
            </tr>
            <?php endif; ?>
        </table>
    </div>
    
    <?php if($logoWebsite): ?>
    <div class="debug-box">
        <h2>Logo Preview Test</h2>
        <p><strong>Test 1: Relative Path</strong></p>
        <img src="/storage/<?php echo $logoWebsite->gambar; ?>" class="logo-preview test-img" alt="Logo Test 1" onerror="this.style.border='3px solid red'; this.alt='❌ GAGAL LOAD'">
        
        <p><strong>Test 2: asset() Helper</strong></p>
        <img src="<?php echo asset('storage/' . $logoWebsite->gambar); ?>" class="logo-preview test-img" alt="Logo Test 2" onerror="this.style.border='3px solid red'; this.alt='❌ GAGAL LOAD'">
        
        <p><strong>Test 3: Direct File (if symlink correct)</strong></p>
        <img src="/storage/logo-website/<?php echo basename($logoWebsite->gambar); ?>" class="logo-preview test-img" alt="Logo Test 3" onerror="this.style.border='3px solid red'; this.alt='❌ GAGAL LOAD'">
        
        <script>
            window.addEventListener('load', function() {
                document.querySelectorAll('.test-img').forEach(function(img, index) {
                    img.onload = function() {
                        this.style.border = '3px solid green';
                        console.log('✅ Test ' + (index + 1) + ' SUCCESS:', this.src);
                    };
                    img.onerror = function() {
                        this.style.border = '3px solid red';
                        console.error('❌ Test ' + (index + 1) + ' FAILED:', this.src);
                    };
                });
            });
        </script>
    </div>
    <?php endif; ?>
    
    <div class="debug-box">
        <h2>Logo Admin - Database Info</h2>
        <?php
        $logoAdmin = \App\Models\LogoAdmin::where('status', true)->first();
        ?>
        <table>
            <tr>
                <td><strong>Status</strong></td>
                <td><?php echo $logoAdmin ? '<span class="success">✅ ADA DATA</span>' : '<span class="error">❌ TIDAK ADA DATA</span>'; ?></td>
            </tr>
            <?php if($logoAdmin): ?>
            <tr>
                <td><strong>ID</strong></td>
                <td><?php echo $logoAdmin->id; ?></td>
            </tr>
            <tr>
                <td><strong>Path di Database</strong></td>
                <td><?php echo $logoAdmin->gambar; ?></td>
            </tr>
            <tr>
                <td><strong>URL dengan asset()</strong></td>
                <td><?php echo asset('storage/' . $logoAdmin->gambar); ?></td>
            </tr>
            <tr>
                <td><strong>File Exists?</strong></td>
                <td>
                    <?php 
                    $filePathAdmin = storage_path('app/public/' . $logoAdmin->gambar);
                    echo file_exists($filePathAdmin) ? '<span class="success">✅ YA</span>' : '<span class="error">❌ TIDAK</span>';
                    echo '<br><small>' . $filePathAdmin . '</small>';
                    ?>
                </td>
            </tr>
            <?php endif; ?>
        </table>
    </div>
    
    <?php if($logoAdmin): ?>
    <div class="debug-box">
        <h2>Logo Admin Preview Test</h2>
        <img src="<?php echo asset('storage/' . $logoAdmin->gambar); ?>" class="logo-preview test-img" alt="Logo Admin" onerror="this.style.border='3px solid red'; this.alt='❌ GAGAL LOAD'">
    </div>
    <?php endif; ?>
    
    <div class="debug-box">
        <h2>Storage Symlink Check</h2>
        <?php
        $symlinkPath = public_path('storage');
        $targetPath = storage_path('app/public');
        ?>
        <table>
            <tr>
                <td><strong>Symlink Path</strong></td>
                <td><?php echo $symlinkPath; ?></td>
            </tr>
            <tr>
                <td><strong>Symlink Exists?</strong></td>
                <td><?php echo file_exists($symlinkPath) ? '<span class="success">✅ YA</span>' : '<span class="error">❌ TIDAK</span>'; ?></td>
            </tr>
            <tr>
                <td><strong>Is Symlink?</strong></td>
                <td><?php echo is_link($symlinkPath) ? '<span class="success">✅ YA</span>' : '<span class="error">❌ TIDAK (Real Directory)</span>'; ?></td>
            </tr>
            <tr>
                <td><strong>Target Path</strong></td>
                <td><?php echo is_link($symlinkPath) ? readlink($symlinkPath) : 'N/A'; ?></td>
            </tr>
            <tr>
                <td><strong>Expected Target</strong></td>
                <td><?php echo $targetPath; ?></td>
            </tr>
        </table>
    </div>
    
    <div class="debug-box">
        <h2>📋 Kesimpulan</h2>
        <ul>
            <li>Jika gambar muncul dengan border <strong style="color: green;">HIJAU</strong> = ✅ Logo berfungsi dengan baik</li>
            <li>Jika gambar tidak muncul dengan border <strong style="color: red;">MERAH</strong> = ❌ Ada masalah dengan path atau symlink</li>
            <li>Buka Console (F12) untuk lihat detail error</li>
        </ul>
    </div>
    
</body>
</html>

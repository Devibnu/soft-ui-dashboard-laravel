<?php
// Test file to verify cache
echo "<!-- CACHE TEST: " . date('Y-m-d H:i:s') . " -->";
echo "<!-- If you see different time on each refresh, cache is working correctly -->";

// Test HeaderInfo
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$headerInfo = \App\Models\HeaderInfo::where('status', true)->first();

if ($headerInfo) {
    echo "\n<!-- HeaderInfo FOUND -->";
    echo "\n<!-- Nama: " . $headerInfo->nama_website . " -->";
    echo "\n<!-- Email: " . $headerInfo->email . " -->";
    echo "\n<!-- Phone: " . $headerInfo->telepon . " -->";
} else {
    echo "\n<!-- HeaderInfo NOT FOUND -->";
}
?>

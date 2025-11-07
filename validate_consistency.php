<?php
// Helper script untuk validate konsistensi
// Jalankan: php artisan tinker lalu include 'validate_consistency.php'

use App\Models\AboutHeroSection;
use App\Models\HeaderLayanan;
use Illuminate\Support\Facades\Schema;

function validateConsistency() {
    $errors = [];
    
    // Check About tables
    $aboutTables = [
        'about_hero_sections',
        'about_content_sections', 
        'about_testimonial_sections',
        'hero_pages'
    ];
    
    foreach ($aboutTables as $table) {
        if (!Schema::hasTable($table)) {
            $errors[] = "❌ Missing table: {$table}";
        } else {
            echo "✅ Table exists: {$table}\n";
        }
    }
    
    // Check Services tables  
    $servicesTables = [
        'header_layanans',
        'fitur_utamas',
        'daftar_layanans'
    ];
    
    foreach ($servicesTables as $table) {
        if (!Schema::hasTable($table)) {
            $errors[] = "❌ Missing table: {$table}";
        } else {
            echo "✅ Table exists: {$table}\n";
        }
    }
    
    // Check model fillables match table columns
    if (Schema::hasTable('about_hero_sections')) {
        $columns = Schema::getColumnListing('about_hero_sections');
        $modelFillable = (new AboutHeroSection())->getFillable();
        
        foreach ($modelFillable as $field) {
            if (!in_array($field, $columns)) {
                $errors[] = "❌ AboutHeroSection fillable '{$field}' not in table";
            }
        }
    }
    
    if (Schema::hasTable('header_layanans')) {
        $columns = Schema::getColumnListing('header_layanans');
        $modelFillable = (new HeaderLayanan())->getFillable();
        
        foreach ($modelFillable as $field) {
            if (!in_array($field, $columns)) {
                $errors[] = "❌ HeaderLayanan fillable '{$field}' not in table";
            }
        }
    }
    
    if (empty($errors)) {
        echo "\n🎉 All consistency checks passed!\n";
    } else {
        echo "\n⚠️  Found issues:\n";
        foreach ($errors as $error) {
            echo $error . "\n";
        }
    }
    
    return $errors;
}

// Jalankan validasi
validateConsistency();
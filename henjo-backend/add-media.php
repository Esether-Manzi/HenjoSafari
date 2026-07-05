<?php

use App\Models\SafariPackage;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Get all packages
$packages = SafariPackage::all();

echo "Adding media to " . count($packages) . " packages...\n\n";

// Add cover images
foreach ($packages as $package) {
    $imageId = $package->id + 20;
    $url = "https://picsum.photos/id/{$imageId}/1200/800";
    try {
        $package->clearMediaCollection('cover');
        $package->addMediaFromUrl($url)
                ->usingName($package->title . ' Cover')
                ->toMediaCollection('cover');
        echo "✅ Added cover for: {$package->title}\n";
    } catch (\Exception $e) {
        echo "❌ Error adding cover for {$package->title}: " . $e->getMessage() . "\n";
    }
}

echo "\n";

// Add gallery images
foreach ($packages as $package) {
    $baseId = $package->id + 30;
    
    // Create an array of URLs
    $urls = [
        "https://picsum.photos/id/{$baseId}/800/600",
        "https://picsum.photos/id/" . ($baseId + 5) . "/800/600",
        "https://picsum.photos/id/" . ($baseId + 10) . "/800/600",
    ];
    
    foreach ($urls as $index => $url) {
        try {
            $package->addMediaFromUrl($url)
                    ->usingName($package->title . ' Gallery ' . ($index + 1))
                    ->toMediaCollection('gallery');
            echo "✅ Added gallery image for: {$package->title}\n";
        } catch (\Exception $e) {
            echo "❌ Error: " . $e->getMessage() . "\n";
        }
    }
}

echo "\n";

// Verify
foreach ($packages as $package) {
    $cover = $package->getFirstMediaUrl('cover');
    $gallery = $package->getMedia('gallery');
    echo "Package: {$package->title}\n";
    echo "  Cover: " . ($cover ?: 'None') . "\n";
    echo "  Gallery: " . count($gallery) . " images\n";
}

echo "\n✅ Done!\n";
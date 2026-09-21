<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Vite;

// Full-document loads carry a Link header for the preloaded Vite assets. The origin web server
// buffers response headers with a fixed budget (8 KB per header on Apache/FastCGI, 4 KB in total
// on nginx), so the header has to stay bounded however many chunks a page imports.
test('the link header stays within budget however many chunks a page imports', function () {
    $directory = 'preload-link-header-test';

    // An entry that statically imports 150 chunks, as a chunk-heavy page does.
    $manifest = [
        'resources/js/app.ts' => [
            'file'    => 'assets/app-abcdef12.js',
            'src'     => 'resources/js/app.ts',
            'isEntry' => true,
            'imports' => [],
        ],
    ];

    for ($i = 0; $i < 150; $i++) {
        $manifest["_chunk{$i}-abcdef12.js"] = ['file' => "assets/chunk{$i}-abcdef12.js"];
        $manifest['resources/js/app.ts']['imports'][] = "_chunk{$i}-abcdef12.js";
    }

    File::ensureDirectoryExists(public_path($directory));
    File::put(public_path("{$directory}/manifest.json"), json_encode($manifest, JSON_THROW_ON_ERROR));

    try {
        Route::middleware('web')->get('/__preload-link-header', fn () => (string) Vite::useBuildDirectory($directory)
            // A running dev server (public/hot) would replace the manifest and preload nothing.
            ->useHotFile(storage_path('framework/testing/vite.hot'))
            ->withEntryPoints(['resources/js/app.ts'])
            ->toHtml());

        $response = $this->get('/__preload-link-header');

        $response->assertOk();

        // The page really imports more than the limit, so the cap is what keeps the header small.
        expect(count(Vite::preloadedAssets()))->toBeGreaterThan(20);

        $link = (string) $response->headers->get('Link');

        expect($link)->not->toBe('');
        expect(substr_count($link, ', ') + 1)->toBeLessThanOrEqual(20);
        expect(strlen($link))->toBeLessThan(4096);
    } finally {
        File::deleteDirectory(public_path($directory));
    }
});

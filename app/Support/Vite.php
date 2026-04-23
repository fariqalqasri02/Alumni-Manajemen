<?php

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use RuntimeException;

class Vite
{
    public function tags($entrypoints): string
    {
        $entrypoints = array_map(static function ($entrypoint) {
            return ltrim((string) $entrypoint, '/');
        }, Arr::wrap($entrypoints));

        if ($this->hasHotFile()) {
            return $this->hotTags($entrypoints);
        }

        return $this->buildTags($entrypoints);
    }

    protected function hasHotFile(): bool
    {
        return File::exists(public_path('hot'));
    }

    protected function hotTags(array $entrypoints): string
    {
        $devServer = rtrim(trim((string) File::get(public_path('hot'))), '/');
        $tags = [
            '<script type="module" src="'.$this->escape($devServer.'/@vite/client').'"></script>',
        ];

        foreach ($entrypoints as $entrypoint) {
            $url = $this->escape($devServer.'/'.$entrypoint);

            if ($this->isCssPath($entrypoint)) {
                $tags[] = '<link rel="stylesheet" href="'.$url.'" />';
                continue;
            }

            $tags[] = '<script type="module" src="'.$url.'"></script>';
        }

        return implode(PHP_EOL, array_unique($tags));
    }

    protected function buildTags(array $entrypoints): string
    {
        $manifestPath = public_path('build/manifest.json');

        if (! File::exists($manifestPath)) {
            return '';
        }

        $manifest = json_decode((string) File::get($manifestPath), true, 512, JSON_THROW_ON_ERROR);
        $styles = [];
        $scripts = [];
        $preloads = [];
        $imported = [];

        foreach ($entrypoints as $entrypoint) {
            $chunk = $manifest[$entrypoint] ?? null;

            if (! is_array($chunk)) {
                throw new RuntimeException("Entrypoint Vite [$entrypoint] tidak ditemukan di manifest.");
            }

            $this->collectImportedAssets($chunk, $manifest, $styles, $preloads, $imported);

            if (! empty($chunk['css'])) {
                foreach ($chunk['css'] as $cssFile) {
                    $styles[] = $this->assetUrl($cssFile);
                }
            }

            if (! empty($chunk['file'])) {
                $fileUrl = $this->assetUrl($chunk['file']);

                if ($this->isCssPath($chunk['file'])) {
                    $styles[] = $fileUrl;
                } else {
                    $scripts[] = $fileUrl;
                }
            }
        }

        $tags = [];

        foreach (array_unique($preloads) as $url) {
            $tags[] = '<link rel="modulepreload" href="'.$this->escape($url).'" />';
        }

        foreach (array_unique($styles) as $url) {
            $tags[] = '<link rel="stylesheet" href="'.$this->escape($url).'" />';
        }

        foreach (array_unique($scripts) as $url) {
            $tags[] = '<script type="module" src="'.$this->escape($url).'"></script>';
        }

        return implode(PHP_EOL, $tags);
    }

    protected function collectImportedAssets(array $chunk, array $manifest, array &$styles, array &$preloads, array &$imported): void
    {
        foreach ($chunk['imports'] ?? [] as $import) {
            if (isset($imported[$import]) || empty($manifest[$import])) {
                continue;
            }

            $imported[$import] = true;
            $importChunk = $manifest[$import];

            if (! empty($importChunk['file']) && ! $this->isCssPath($importChunk['file'])) {
                $preloads[] = $this->assetUrl($importChunk['file']);
            }

            if (! empty($importChunk['css'])) {
                foreach ($importChunk['css'] as $cssFile) {
                    $styles[] = $this->assetUrl($cssFile);
                }
            }

            $this->collectImportedAssets($importChunk, $manifest, $styles, $preloads, $imported);
        }
    }

    protected function assetUrl(string $path): string
    {
        return asset('build/'.ltrim($path, '/'));
    }

    protected function isCssPath(string $path): bool
    {
        return str_ends_with(strtolower($path), '.css');
    }

    protected function escape(string $value): string
    {
        return e($value);
    }
}

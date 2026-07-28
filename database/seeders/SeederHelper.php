<?php

namespace Database\Seeders;

class SeederHelper
{
    /**
     * Get an existing dummy image from public/admin/images/{$folder}
     */
    public static function getExistingImage(string $folder, int $index = 0, string $fallbackTitle = 'Image'): string
    {
        $dir = public_path("admin/images/{$folder}");

        if (is_dir($dir)) {
            $files = array_values(array_filter(scandir($dir), function ($file) use ($dir) {
                if (is_dir("{$dir}/{$file}")) {
                    return false;
                }
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                return in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg']);
            }));

            if (!empty($files)) {
                $selected = $files[$index % count($files)];
                return "admin/images/{$folder}/{$selected}";
            }
        }

        // Fallback placeholder creation if folder is empty
        return self::createPlaceholderImage("admin/images/{$folder}/default_{$index}.svg", $fallbackTitle);
    }

    /**
     * Get multiple existing images from public/admin/images/{$folder}
     */
    public static function getExistingImages(string $folder, int $count = 3): array
    {
        $dir = public_path("admin/images/{$folder}");
        $results = [];

        if (is_dir($dir)) {
            $files = array_values(array_filter(scandir($dir), function ($file) use ($dir) {
                if (is_dir("{$dir}/{$file}")) {
                    return false;
                }
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                return in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg']);
            }));

            if (!empty($files)) {
                for ($i = 0; $i < $count; $i++) {
                    $selected = $files[$i % count($files)];
                    $results[] = "admin/images/{$folder}/{$selected}";
                }
                return $results;
            }
        }

        for ($i = 0; $i < $count; $i++) {
            $results[] = self::createPlaceholderImage("admin/images/{$folder}/default_{$i}.svg", "Gallery {$i}");
        }

        return $results;
    }

    /**
     * Creates a dummy SVG placeholder image if it doesn't exist.
     */
    public static function createPlaceholderImage(
        string $relativePath,
        string $title,
        int $width = 600,
        int $height = 400,
        string $bgColor = '#1f2937',
        string $textColor = '#ffffff'
    ): string {
        $fullPath = public_path($relativePath);
        $directory = dirname($fullPath);

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        if (!file_exists($fullPath)) {
            $titleEscaped = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
            $svgContent = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="{$width}" height="{$height}" viewBox="0 0 {$width} {$height}">
  <rect width="100%" height="100%" fill="{$bgColor}"/>
  <circle cx="50%" cy="40%" r="50" fill="none" stroke="{$textColor}" stroke-width="4" opacity="0.4"/>
  <path d="M 50% 30% L 50% 50% M 40% 40% L 60% 40%" stroke="{$textColor}" stroke-width="4" opacity="0.4"/>
  <text x="50%" y="75%" fill="{$textColor}" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif" font-size="22" font-weight="bold" text-anchor="middle" dominant-baseline="middle">{$titleEscaped}</text>
</svg>
SVG;
            file_put_contents($fullPath, $svgContent);
        }

        return $relativePath;
    }
}

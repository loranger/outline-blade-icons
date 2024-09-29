<?php

namespace UnReact;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ConvertIconsCommand extends Command
{
    protected $signature = 'icons:convert';
    protected $description = 'Convert Outline React icons to Blade components';

    public function handle()
    {
        $srcDir = __DIR__ . '/../outline-icons/src/components';
        $destDir = resource_path('views/components/outline');
        $stubPath = __DIR__ . '/stubs/icon.stub';

        if (!File::exists($destDir)) {
            File::makeDirectory($destDir, 0755, true);
        }

        $files = File::files($srcDir);

        foreach ($files as $file) {
            $bladeFileName = $this->toBladeComponentName($file->getFilename());
            $bladeFilePath = $destDir . '/' . $bladeFileName;

            $content = File::get($file->getPathname());
            $svgContent = $this->extractSvgContent($content);
            $bladeContent = $this->generateBladeComponent($stubPath, $svgContent);

            if ($svgContent) {
                File::put($bladeFilePath, $bladeContent);
                $this->info("Composant Blade {$bladeFileName} créé avec succès.");
            }
        }
    }

    private function toBladeComponentName($fileName)
    {
        $name = preg_replace('/(\w+)Icon/U', "$1", basename($fileName, ".tsx"));
        return Str::kebab($name) . '.blade.php';
    }

    private function extractSvgContent($content)
    {
        preg_match('/<Icon.*>([\s\S]*)<\/Icon>/', $content, $matches);
        if (count($matches) > 1) {
            return trim($matches[1]);
        }
        return false;
    }

    private function generateBladeComponent($stubPath, $svgContent)
    {
        $stub = File::get($stubPath);
        return str_replace('{{ $path }}', $svgContent, $stub);
    }
}

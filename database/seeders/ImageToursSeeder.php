<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Tour;

class ImageToursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $basePath = public_path('img');

        $mappings = [
            'lugares' => [
                'tipo' => 'lugar',
                'default_price' => 20000,
                'default_duration' => 180,
            ],
            'restaurantes' => [
                'tipo' => 'restaurante',
                'default_price' => 35000,
                'default_duration' => 120,
            ],
            'emprendedores' => [
                'tipo' => 'emprendedores',
                'default_price' => 15000,
                'default_duration' => 90,
            ],
        ];

        foreach ($mappings as $folder => $meta) {
            $dir = $basePath . DIRECTORY_SEPARATOR . $folder;
            if (! File::exists($dir)) {
                $this->command->warn("Directory not found: $dir — skipping.");
                continue;
            }

            // Special handling for emprendedores (has subdirectories)
            if ($folder === 'emprendedores') {
                $subdirs = File::directories($dir);
                foreach ($subdirs as $subdir) {
                    $this->processEmprendedor($subdir, $meta);
                }
            } else {
                // For lugares and restaurantes (direct image files)
                $files = File::files($dir);
                foreach ($files as $file) {
                    $this->processImageFile($file, $folder, $meta);
                }
            }
        }
    }

    /**
     * Process a single image file (lugares, restaurantes)
     */
    private function processImageFile($file, $folder, $meta): void
    {
        $filename = $file->getFilename();
        $name = pathinfo($filename, PATHINFO_FILENAME);

        // Normalize name: replace underscores/hyphens with spaces, remove extra chars
        $cleanName = preg_replace('/[_\-]+/', ' ', $name);
        $cleanName = ucwords(mb_strtolower($cleanName));

        $imagePath = 'img/' . $folder . '/' . $filename;

        // Compose a simple description based on name and location
        $description = "Visita \"{$cleanName}\" en Ocaña. Descubre su historia, atractivos y servicios locales.";

        // Build tags
        $tags = [$meta['tipo']];
        $tipos = [$meta['tipo']];
        $lower = mb_strtolower($name);

        $this->assignTags($lower, $tags, $tipos);

        // Create or update tour by image path to avoid duplicates
        $tour = Tour::where('image', $imagePath)->first();
        if (! $tour) {
            // Also avoid duplicate names — append suffix if exists
            $baseName = $cleanName;
            $suffix = 1;
            while (Tour::where('name', $cleanName)->exists()) {
                $cleanName = $baseName . ' ' . $suffix;
                $suffix++;
            }

            Tour::create([
                'name' => $cleanName,
                'description' => $description,
                'image' => $imagePath,
                'price' => $meta['default_price'],
                'tags' => $tags,
                'tipo' => $meta['tipo'],
                'tipos' => $tipos,
                'location' => 'Ocaña',
                'duration_minutes' => $meta['default_duration'],
                'active' => true,
            ]);

            $this->command->info("Created tour: {$cleanName} ({$imagePath})");
        } else {
            // Update existing record with consistent meta
            $tour->update([
                'name' => $cleanName,
                'description' => $description,
                'price' => $meta['default_price'],
                'tags' => $tags,
                'tipo' => $meta['tipo'],
                'tipos' => $tipos,
                'location' => 'Ocaña',
                'duration_minutes' => $meta['default_duration'],
                'active' => true,
            ]);
            $this->command->info("Updated tour: {$cleanName} ({$imagePath})");
        }
    }

    /**
     * Process an emprendedor subdirectory
     */
    private function processEmprendedor($subdir, $meta): void
    {
        $dirname = basename($subdir);

        // Get the first image file from this subdirectory
        $files = File::files($subdir);
        $imageFile = null;

        foreach ($files as $file) {
            $ext = strtolower($file->getExtension());
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $imageFile = $file;
                break;
            }
        }

        if (! $imageFile) {
            $this->command->warn("No image files found in: $subdir");
            return;
        }

        $filename = $imageFile->getFilename();
        $cleanName = preg_replace('/[_\-]+/', ' ', $dirname);
        $cleanName = ucwords(mb_strtolower($cleanName));

        $imagePath = 'img/emprendedores/' . $dirname . '/' . $filename;

        // Read TXT file for detailed information
        $description = "Descubre el emprendimiento \"{$cleanName}\" en Ocaña. Conoce sus productos y servicios.";
        $profileLink = null;

        foreach ($files as $file) {
            if (strtolower($file->getExtension()) === 'txt') {
                $content = File::get($file->getRealPath());
                // Extract description/detalles - capture multiline text
                // Matches: Detalles, Detalles:, descripción, descripciòn, descripcion, etc.
                // with optional spaces before and after the colon
                if (preg_match('/(?:Detalles?|descripci(?:ó|ò|o)?n)\s*:\s*(.+?)(?=https?:\/\/|$)/is', $content, $matches)) {
                    $desc = trim($matches[1]);
                    // Clean up the description (remove extra whitespace and newlines)
                    $desc = preg_replace('/\s+/', ' ', $desc);
                    if (!empty($desc)) {
                        $description = $desc;
                    }
                }
                // Extract link (Instagram, TikTok, etc.)
                if (preg_match('/(https?:\/\/[^\s]+)/i', $content, $matches)) {
                    $profileLink = trim($matches[1]);
                }
                break;
            }
        }

        // Build tags
        $tags = [$meta['tipo']];
        $tipos = [$meta['tipo']];
        $lower = mb_strtolower($dirname);

        $this->assignTags($lower, $tags, $tipos);

        // Create or update tour by image path
        $tour = Tour::where('image', $imagePath)->first();
        if (! $tour) {
            // Avoid duplicate names
            $baseName = $cleanName;
            $suffix = 1;
            while (Tour::where('name', $cleanName)->exists()) {
                $cleanName = $baseName . ' ' . $suffix;
                $suffix++;
            }

            Tour::create([
                'name' => $cleanName,
                'description' => $description,
                'image' => $imagePath,
                'price' => $meta['default_price'],
                'tags' => $tags,
                'tipo' => $meta['tipo'],
                'tipos' => $tipos,
                'location' => 'Ocaña',
                'duration_minutes' => $meta['default_duration'],
                'active' => true,
                'profile_link' => $profileLink,
            ]);

            $this->command->info("Created tour: {$cleanName} ({$imagePath})");
        } else {
            // Update existing record
            $tour->update([
                'name' => $cleanName,
                'description' => $description,
                'price' => $meta['default_price'],
                'tags' => $tags,
                'tipo' => $meta['tipo'],
                'tipos' => $tipos,
                'location' => 'Ocaña',
                'duration_minutes' => $meta['default_duration'],
                'active' => true,
                'profile_link' => $profileLink,
            ]);
            $this->command->info("Updated tour: {$cleanName} ({$imagePath})");
        }
    }

    /**
     * Assign tags and tipos based on keywords
     */
    private function assignTags($lower, &$tags, &$tipos): void
    {
        $tagKeywords = [
            'naturaleza' => ['naturaleza', 'parque', 'estoraques', 'rio', 'río', 'lagos', 'laguna', 'mirador', 'miradores', 'sendero', 'senderismo', 'aventura'],
            'comida_tipica' => ['cafe', 'restaurante', 'comida', 'areperia', 'pizza', 'gastronomia'],
            'historia' => ['historia', 'historico', 'histórica', 'historica', 'plazarella', 'complejo', 'museo'],
            'cultura' => ['cultura', 'cultural', 'galeria', 'arte', 'artesano', 'artista', 'museo'],
            'aventura' => ['aventura', 'trek', 'trekking', 'adventura', 'adventure'],
            'senderismo' => ['sendero', 'senderismo'],
            'miradores' => ['mirador', 'miradores', 'atardecer'],
            'lagos_rios' => ['lago', 'laguna', 'rio', 'río', 'ríos', 'lagos'],
            'fotografia' => ['fotografia', 'foto', 'fotógrafo', 'fotografa', 'mirador', 'paisaje', 'atardecer'],
            'religion' => ['iglesia', 'catedral', 'religion', 'religiosa', 'santuario', 'templo'],
            'arte' => ['arte', 'galeria', 'artista', 'artesano'],
            'arquitectura' => ['arquitectura', 'arquitectonico', 'arquitectónica', 'arquitectonica'],
        ];

        foreach ($tagKeywords as $tag => $keys) {
            foreach ($keys as $k) {
                if (mb_stripos($lower, $k) !== false) {
                    if (! in_array($tag, $tags)) {
                        $tags[] = $tag;
                    }
                }
            }
        }

        // Detect if this place should also be 'cultura'
        $cultureKeys = ['museo', 'iglesia', 'catedral', 'santuario', 'historia', 'religio', 'cultura', 'arquitectura', 'plaza', 'complejo', 'templo'];
        foreach ($cultureKeys as $ck) {
            if (mb_stripos($lower, $ck) !== false) {
                if (! in_array('cultura', $tipos)) {
                    $tipos[] = 'cultura';
                }
                break;
            }
        }
    }
}

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
        ];

        foreach ($mappings as $folder => $meta) {
            $dir = $basePath . DIRECTORY_SEPARATOR . $folder;
            if (! File::exists($dir)) {
                $this->command->warn("Directory not found: $dir — skipping.");
                continue;
            }

            $files = File::files($dir);
            foreach ($files as $file) {
                $filename = $file->getFilename();
                $name = pathinfo($filename, PATHINFO_FILENAME);

                // Normalize name: replace underscores/hyphens with spaces, remove extra chars
                $cleanName = preg_replace('/[_\-]+/', ' ', $name);
                $cleanName = ucwords(mb_strtolower($cleanName));

                $imagePath = 'img/' . $folder . '/' . $filename;

                // Compose a simple description based on name and location
                $description = "Visita \"{$cleanName}\" en Ocaña. Descubre su historia, atractivos y servicios locales.";

                // Build tags: include tipo and detect additional tags from filename keywords
                $tags = [$meta['tipo']];
                $tipos = [$meta['tipo']];
                $lower = mb_strtolower($name);

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

                // Ensure fotografía tag is present for scenic places by default
                if (! in_array('fotografia', $tags) && (mb_stripos($lower, 'mirador') !== false || mb_stripos($lower, 'vista') !== false || mb_stripos($lower, 'atardecer') !== false)) {
                    $tags[] = 'fotografia';
                }

                // Detect if this place should also be 'cultura'
                // e.g. names containing museo, iglesia, historia, colonia, cultura
                $cultureKeys = ['museo', 'iglesia', 'catedral', 'santuario', 'historia', 'religio', 'cultura', 'arquitectura', 'plaza', 'complejo', 'templo'];
                foreach ($cultureKeys as $ck) {
                    if (mb_stripos($lower, $ck) !== false) {
                        if (! in_array('cultura', $tipos)) {
                            $tipos[] = 'cultura';
                        }
                        break;
                    }
                }

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
        }
    }
}

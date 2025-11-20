<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the tours table.
     */
    public function run(): void
    {
        $tours = [
            [
                'name' => 'Los Estoraques - Parque Natural',
                'description' => 'Explora uno de los paisajes más espectaculares de Colombia. Los Estoraques ofrecen formaciones geológicas únicas, cañones profundos y vistas panorámicas que te dejarán sin aliento.',
                'image' => 'img/fotosWelcome/los_estoraques2.png',
                'price' => 45000,
                'tags' => json_encode(['naturaleza', 'senderismo', 'miradores', 'fotografia']),
                'tipo' => 'lugar',
                'location' => 'Ocaña, Norte de Santander',
                'duration_minutes' => 480,
                'active' => true,
            ],
            [
                'name' => 'Tour Histórico Centro Colonial',
                'description' => 'Descubre la historia de Ocaña a través de sus calles coloniales. Visita iglesias históricas, plazas tradicionales y aprende sobre la cultura local de primera mano.',
                'image' => 'img/fotosWelcome/los_estoraques2.png',
                'price' => 25000,
                'tags' => json_encode(['historia', 'cultura', 'arquitectura', 'fotografia']),
                'tipo' => 'cultura',
                'location' => 'Centro Histórico de Ocaña',
                'duration_minutes' => 180,
                'active' => true,
            ],
            [
                'name' => 'Aventura en el Catatumbo',
                'description' => 'Vive la adrenalina en la región del Catatumbo con actividades de aventura, cascadas escondidas y naturaleza virgen. Una experiencia inolvidable para los amantes de la aventura extrema.',
                'image' => 'img/fotosWelcome/los_estoraques2.png',
                'price' => 85000,
                'tags' => json_encode(['aventura', 'naturaleza', 'senderismo', 'lagos_rios']),
                'tipo' => 'lugar',
                'location' => 'Catatumbo, Zulia',
                'duration_minutes' => 600,
                'active' => true,
            ],
            [
                'name' => 'Gastronomía Tradicional Ocaña',
                'description' => 'Prueba los sabores auténticos de Ocaña en un recorrido culinario. Degusta platos típicos en restaurantes locales y conoce las tradiciones gastronómicas de la región.',
                'image' => 'img/fotosWelcome/los_estoraques2.png',
                'price' => 35000,
                'tags' => json_encode(['comida_tipica', 'cultura', 'fotografia']),
                'tipo' => 'restaurante',
                'location' => 'Restaurantes Centro de Ocaña',
                'duration_minutes' => 180,
                'active' => true,
            ],
            [
                'name' => 'Ruta Religiosa - Iglesias Coloniales',
                'description' => 'Un viaje espiritual por las iglesias coloniales más hermosas de Ocaña. Conoce la arquitectura religiosa y la importancia histórica de estos templos centenarios.',
                'image' => 'img/fotosWelcome/los_estoraques2.png',
                'price' => 20000,
                'tags' => json_encode(['religion', 'arquitectura', 'historia', 'cultura']),
                'tipo' => 'cultura',
                'location' => 'Diversos puntos de Ocaña',
                'duration_minutes' => 150,
                'active' => true,
            ],
            [
                'name' => 'Sendero del Río - Naturaleza y Fotografía',
                'description' => 'Camina por senderos rodeados de naturaleza virgen siguiendo el curso de un río cristalino. Perfecto para fotografía naturalista y contacto con la biodiversidad local.',
                'image' => 'img/fotosWelcome/los_estoraques2.png',
                'price' => 30000,
                'tags' => json_encode(['naturaleza', 'senderismo', 'fotografia', 'lagos_rios']),
                'tipo' => 'lugar',
                'location' => 'Ríos cercanos a Ocaña',
                'duration_minutes' => 300,
                'active' => true,
            ],
            [
                'name' => 'Galería de Arte Local y Cultura',
                'description' => 'Descubre el talento artístico local visitando galerías y talleres de artesanos. Conoce la obra de artistas regionales y aprende sobre las tradiciones artísticas de Ocaña.',
                'image' => 'img/fotosWelcome/los_estoraques2.png',
                'price' => 15000,
                'tags' => json_encode(['arte', 'cultura', 'arquitectura']),
                'tipo' => 'cultura',
                'location' => 'Galerías Centro de Ocaña',
                'duration_minutes' => 120,
                'active' => true,
            ],
            [
                'name' => 'Mirador del Atardecer - Vista Panorámica',
                'description' => 'Sube a uno de los mejores miradores de la región para disfrutar de un atardecer espectacular. Trae tu cámara para capturar momentos inolvidables.',
                'image' => 'img/fotosWelcome/los_estoraques2.png',
                'price' => 18000,
                'tags' => json_encode(['miradores', 'fotografia', 'naturaleza']),
                'tipo' => 'lugar',
                'location' => 'Miradores estratégicos de Ocaña',
                'duration_minutes' => 120,
                'active' => true,
            ],
        ];

        foreach ($tours as $tour) {
            Tour::create($tour);
        }
    }
}

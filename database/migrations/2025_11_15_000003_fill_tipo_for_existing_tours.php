<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mapear tags a tipo
        $tours = DB::table('tours')->get();

        foreach ($tours as $tour) {
            $tipo = 'lugar'; // default

            $tags = $tour->tags;
            if (is_string($tags)) {
                $decoded = json_decode($tags, true);
                $tagsArr = is_array($decoded) ? $decoded : [];
            } elseif (is_array($tags)) {
                $tagsArr = $tags;
            } else {
                $tagsArr = [];
            }

            $tagsLower = array_map('strtolower', $tagsArr);

            // Reglas simples para asignar tipo
            if (in_array('comida_tipica', $tagsLower) || in_array('restaurante', $tagsLower)) {
                $tipo = 'restaurante';
            } elseif (
                array_intersect(['arte', 'cultura', 'historia', 'religion', 'arquitectura'], $tagsLower)
            ) {
                $tipo = 'cultura';
            } elseif (array_intersect(['aventura', 'senderismo', 'miradores', 'naturaleza', 'lagos_rios', 'fotografia'], $tagsLower)) {
                $tipo = 'lugar';
            }

            DB::table('tours')->where('id', $tour->id)->update(['tipo' => $tipo]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No revertimos cambios de datos
    }
};

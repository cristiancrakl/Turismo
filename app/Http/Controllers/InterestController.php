<?php

namespace App\Http\Controllers;

use App\Models\UserInterest;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InterestController extends Controller
{
    /**
     * Mostrar la vista para configurar gustos e intereses
     */
    public function showSettings()
    {
        $user = Auth::user();
        $availableInterests = UserInterest::getAvailableInterests();
        $userInterests = [];

        try {
            $userInterests = $user->getInterestNames() ?? [];
        } catch (\Exception $e) {
            \Log::error('Error obteniendo intereses del usuario: ' . $e->getMessage());
        }

        return view('interests.settings', [
            'availableInterests' => $availableInterests,
            'userInterests' => $userInterests,
        ]);
    }

    /**
     * Guardar los intereses del usuario
     */
    public function saveInterests(Request $request)
    {
        $user = Auth::user();

        // Validar que los intereses sean válidos
        $availableKeys = array_keys(UserInterest::getAvailableInterests());
        $interests = $request->input('interests', []);

        $validated = array_intersect($interests, $availableKeys);

        // Eliminar intereses previos
        $user->interests()->delete();

        // Guardar nuevos intereses
        foreach ($validated as $interest) {
            UserInterest::create([
                'user_id' => $user->id,
                'interest' => $interest,
            ]);
        }

        return redirect()->route('interests.settings')
            ->with('success', '✓ Tus gustos han sido guardados correctamente');
    }

    /**
     * Mostrar tours recomendados basados en los intereses del usuario
     */
    public function showRecommendations()
    {
        $user = Auth::user();

        // Obtener intereses del usuario de la BD
        $userInterests = [];
        try {
            $userInterests = $user->getInterestNames() ?? [];
        } catch (\Exception $e) {
            \Log::error('Error obteniendo intereses: ' . $e->getMessage());
        }

        // Si el usuario no tiene intereses configurados
        if (empty($userInterests)) {
            return view('interests.recommendations', [
                'tours' => [],
                'hasInterests' => false,
                'interestCount' => 0,
            ]);
        }

        // Obtener tours que coincidan con los intereses del usuario
        $tours = $this->getMatchingTours($userInterests);

        // Log para debugging
        \Log::info('Intereses del usuario:', ['interests' => $userInterests]);
        \Log::info('Tours encontrados:', ['count' => count($tours), 'tour_names' => array_map(fn($t) => $t->name, $tours)]);

        return view('interests.recommendations', [
            'tours' => $tours,
            'hasInterests' => true,
            'interestCount' => count($userInterests),
            'userInterests' => $userInterests,
        ]);
    }

    /**
     * Filtrar tours según los intereses del usuario
     * 
     * @param array $userInterests Array de intereses del usuario (ya en minúsculas)
     * @return array Array de tours que coinciden con los intereses
     */
    private function getMatchingTours(array $userInterests)
    {
        // Asegurar que todos los intereses del usuario están en minúsculas
        $userInterestsLower = array_map('strtolower', $userInterests);

        // Obtener todos los tours activos
        $allTours = Tour::where('active', true)->get();

        $matchingTours = [];

        foreach ($allTours as $tour) {
            // El cast 'array' en el modelo Tour convierte JSON automáticamente a array
            $tags = $tour->tags ?? [];

            // Asegurar que es un array
            if (!is_array($tags)) {
                // Si aún no es array, intentar parsear como JSON
                if (is_string($tags)) {
                    $tags = json_decode($tags, true) ?? [];
                } else {
                    $tags = [];
                }
            }

            // Normalizar tags a minúsculas
            $tagsLower = array_map('strtolower', $tags);

            // Encontrar coincidencias
            $matches = array_intersect($userInterestsLower, $tagsLower);
            $matchCount = count($matches);

            // Si hay al menos una coincidencia, agregar el tour
            if ($matchCount > 0) {
                $tour->match_count = $matchCount;
                $tour->matching_tags = array_values($matches); // Tags que coincidieron
                $matchingTours[] = $tour;
            }
        }

        // Ordenar por número de coincidencias (descendente)
        usort($matchingTours, function ($a, $b) {
            return $b->match_count <=> $a->match_count;
        });

        return $matchingTours;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\UserInterest;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $allTours = Tour::all(); // Todos los tours
        $tours = Tour::all(); // Tours a mostrar (filtrados o todos)
        $userInterests = [];
        $hasInterests = false;

        // Si el usuario está autenticado, obtener sus intereses
        if ($user) {
            try {
                $userInterests = $user->interests()
                    ->get()
                    ->pluck('interest')
                    ->map('strtolower')
                    ->toArray();

                if (!empty($userInterests)) {
                    $hasInterests = true;
                    // Filtrar tours según intereses del usuario
                    $tours = $this->getFilteredTours($userInterests);
                }
            } catch (\Exception $e) {
                // Si hay error, mostrar todos los tours
                $tours = Tour::all();
            }
        }

        return view('dashboard', [
            'tours' => $tours,
            'allTours' => $allTours, // Pasar todos los tours también
            'userInterests' => $userInterests,
            'hasInterests' => $hasInterests,
        ]);
    }

    /**
     * Filtrar tours según los intereses del usuario
     */
    private function getFilteredTours(array $userInterests)
    {
        $userInterestsLower = array_map('strtolower', $userInterests);
        $tours = Tour::where('active', true)->get();
        $matchingTours = [];

        foreach ($tours as $tour) {
            // Obtener tags del tour
            $tags = $tour->tags ?? [];

            // Asegurar que es un array
            if (!is_array($tags)) {
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
                $tour->matching_tags = array_values($matches);
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

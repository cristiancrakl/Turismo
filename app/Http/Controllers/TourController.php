<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    // Mostrar tours de tipo 'lugar'
    public function lugares()
    {
        $tours = Tour::where(function ($q) {
            $q->where('tipo', 'lugar')->orWhereJsonContains('tipos', 'lugar');
        })->where('active', true)->get();
        return view('tours.lugares', compact('tours'));
    }

    // Mostrar tours de tipo 'restaurante'
    public function restaurantes()
    {
        $tours = Tour::where(function ($q) {
            $q->where('tipo', 'restaurante')->orWhereJsonContains('tipos', 'restaurante');
        })->where('active', true)->get();
        return view('tours.restaurantes', compact('tours'));
    }

    // Mostrar tours de tipo 'cultura'
    public function cultura()
    {
        $tours = Tour::where(function ($q) {
            $q->where('tipo', 'cultura')->orWhereJsonContains('tipos', 'cultura');
        })->where('active', true)->get();
        return view('tours.cultura', compact('tours'));
    }

    // Mostrar tours de tipo 'emprendimiento'
    public function emprendedores()
    {
        $tours = Tour::where(function ($q) {
            $q->where('tipo', 'emprendedores')->orWhereJsonContains('tipos', 'emprendedores');
        })->where('active', true)->get();
        return view('tours.emprendedores', compact('tours'));
    }

    /**
     * Show a single tour detail and related tours
     */
    public function show(Tour $tour)
    {
        // Related tours: same tipo (or in tipos), exclude current
        $related = Tour::where('id', '<>', $tour->id)
            ->where('active', true)
            ->where(function ($q) use ($tour) {
                $q->where('tipo', $tour->tipo)
                    ->orWhereJsonContains('tipos', $tour->tipo);
            })
            ->take(6)
            ->get();

        return view('tours.show', compact('tour', 'related'));
    }
}

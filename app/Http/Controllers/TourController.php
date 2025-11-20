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
}

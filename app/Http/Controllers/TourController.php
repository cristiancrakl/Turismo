<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    // Mostrar tours de tipo 'lugar'
    public function lugares()
    {
        $tours = Tour::where('tipo', 'lugar')->where('active', true)->get();
        return view('tours.lugares', compact('tours'));
    }

    // Mostrar tours de tipo 'restaurante'
    public function restaurantes()
    {
        $tours = Tour::where('tipo', 'restaurante')->where('active', true)->get();
        return view('tours.restaurantes', compact('tours'));
    }

    // Mostrar tours de tipo 'cultura'
    public function cultura()
    {
        $tours = Tour::where('tipo', 'cultura')->where('active', true)->get();
        return view('tours.cultura', compact('tours'));
    }

    // Mostrar tours de tipo 'emprendimiento'
    public function emprendedores()
    {
        $tours = Tour::where('tipo', 'emprendedores')->where('active', true)->get();
        return view('tours.emprendedores', compact('tours'));
    }
}

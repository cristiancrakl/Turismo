<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Artisan;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/limpiar-cache', function () {
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('event:clear');
    return "Caché limpiada";
});

// Rutas públicas por tipo de tour
Route::get('/tours/lugares', [TourController::class, 'lugares'])->name('tours.lugares');
Route::get('/tours/restaurantes', [TourController::class, 'restaurantes'])->name('tours.restaurantes');
Route::get('/tours/cultura', [TourController::class, 'cultura'])->name('tours.cultura');
Route::get('/tours/emprendedores', [TourController::class, 'emprendedores'])->name('tours.emprendedores');
// Show single tour
Route::get('/tours/{tour}', [TourController::class, 'show'])->name('tours.show');

// Páginas estáticas: Contactanos y About
Route::get('/contactanos', [PageController::class, 'contactanos'])->name('contactanos');
Route::get('/about', [PageController::class, 'about'])->name('about');
// Envío del formulario de contacto
Route::post('/contactanos/send', [PageController::class, 'sendContact'])->name('contactanos.send');

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rutas para intereses y recomendaciones (protegidas por autenticación)
Route::middleware(['auth'])->group(function () {
    Route::get('/interests/settings', [InterestController::class, 'showSettings'])->name('interests.settings');
    Route::post('/interests/save', [InterestController::class, 'saveInterests'])->name('interests.save');
    Route::get('/interests/recommendations', [InterestController::class, 'showRecommendations'])->name('interests.recommendations');

    // Ruta de debug - para verificar que el filtrado funciona
    Route::get('/debug/interests', function () {
        try {
            $user = Auth::user();
            $userInterests = $user->interests()->get()->pluck('interest')->toArray();
            $tours = \App\Models\Tour::all();

            return [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_interests' => $userInterests,
                'total_tours' => $tours->count(),
                'tours_sample' => $tours->take(2)->map(fn($t) => [
                    'id' => $t->id,
                    'name' => $t->name,
                    'tags' => $t->tags,
                    'tags_type' => gettype($t->tags),
                ])->toArray(),
                'status' => 'OK',
            ];
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'status' => 'ERROR',
                'trace' => $e->getTraceAsString(),
            ];
        }
    });
});

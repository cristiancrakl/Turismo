@extends('layouts.app')

@section('title', 'Restaurantes')

@section('content')
<div class="page-main" style="padding-top:90px; min-height:calc(100vh - 160px); display:flex; flex-direction:column;">
    <div class="container my-5" style="flex:0 0 auto;">
        <h1 class="mb-4">Restaurantes</h1>
        <div class="tours-grid">
            @forelse($tours as $tour)
            @include('tours._card', ['tour' => $tour])
            @empty
            <p>No hay restaurantes disponibles.</p>
            @endforelse
        </div>
    </div>

    <div style="flex:1 1 auto;"></div>
</div>
@endsection
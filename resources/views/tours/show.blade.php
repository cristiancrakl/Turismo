@extends('layouts.app')

@section('title', $tour->name)

@section('content')
<div class="page-main" style="padding-top:90px; min-height:calc(100vh - 160px); display:flex; flex-direction:column;">
    <div class="container my-5" style="flex:0 0 auto;">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <img src="{{ asset($tour->image) }}" class="card-img-top" alt="{{ $tour->name }}">
                    <div class="card-body">
                        <h1 class="card-title">{{ $tour->name }}</h1>
                        @if($tour->tipo)
                        <p><strong>Tipo:</strong> {{ ucfirst(str_replace('_',' ', $tour->tipo)) }}</p>
                        @endif

                        <p>{{ $tour->description }}</p>

                        @if($tour->profile_link)
                        <p><a class="btn btn-success" target="_blank" href="{{ $tour->profile_link }}">Visitar perfil</a></p>
                        @else
                        @php
                        $mapUrl = $tour->link ?? ('https://www.google.com/maps/search/?api=1&query=' . urlencode($tour->location ?? $tour->name));
                        @endphp
                        <p><a class="btn btn-primary" target="_blank" href="{{ $mapUrl }}">Ver en Google Maps</a></p>
                        @endif

                    </div>
                </div>

                <h4>También te puede interesar</h4>
                <div class="tours-grid">
                    @forelse($related as $r)
                    @include('tours._card', ['tour' => $r])
                    @empty
                    <p>No hay recomendaciones relacionadas por ahora.</p>
                    @endforelse
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3">
                    <h5>Información rápida</h5>
                    <p><strong>Precio:</strong> {{ $tour->price ? '$' . number_format($tour->price, 0, ',', '.') : 'N/A' }}</p>
                    <p><strong>Ubicación:</strong> {{ $tour->location }}</p>
                </div>
            </div>
        </div>
    </div>

    <div style="flex:1 1 auto;"></div>
</div>
@endsection
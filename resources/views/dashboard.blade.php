@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-content">
        <h1>Descubre Majestuosos Paisajes</h1>
        <p>esta aplicacion tiene como objetivo promover el turismo local y cultural en ocaña y en el catatumbo a los
            visitantes la oportunidad de descubrir su historia paisajes y tradiciones ademas busca impulsar a os
            emprendedores locales creando una red que conecte cultura turismo y desarrollo sostenible</p>
        <a hidden href="#tours" class="btn-primary-custom">Explore Now</a>
    </div>
    <!-- Horizontal Carousel of Landscape Thumbnails -->
    <div class="hero-carousel">
        <div class="carousel-container">
            @foreach($tours as $tour)
            <img src="{{ asset($tour->image) }}" alt="{{ $tour->name }}" data-bg="{{ asset($tour->image) }}">
            @endforeach
        </div>
    </div>
</section>

<!--Seccion beneficios -->
<section class="benefits" id="benefits">
    <div class="container">
        <!-- Sección de Intereses del Usuario -->
        @auth
        @if($hasInterests)
        <div class="user-interests-section"
            style="margin-bottom: 40px; padding: 20px; background: linear-gradient(135deg, #f0f9f7 0%, #e8f5f0 100%); border-radius: 12px; border-left: 4px solid #178f6a;">
            <h3 style="color: #178f6a; margin-bottom: 15px; font-weight: 700;">
                <i class="fas fa-heart me-2"></i> Tus Intereses Configurados
            </h3>
            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                @php
                $availableInterests = App\Models\UserInterest::getAvailableInterests();
                @endphp
                @foreach($userInterests as $interest)
                <span
                    style="background: #178f6a; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 500; font-size: 0.9rem;">
                    {{ $availableInterests[$interest] ?? ucfirst(str_replace('_', ' ', $interest)) }}
                </span>
                @endforeach
            </div>
            <p style="margin-top: 15px; color: #666; font-size: 0.95rem;">
                <i class="fas fa-info-circle me-2"></i>
                Mostramos tours que coinciden con tus intereses.
                <a href="{{ route('interests.settings') }}"
                    style="color: #178f6a; font-weight: 600; text-decoration: none;">Editar mis gustos</a>
            </p>
        </div>
        @else
        <div class="user-interests-section"
            style="margin-bottom: 40px; padding: 20px; background: linear-gradient(135deg, #fff9f0 0%, #ffe8d6 100%); border-radius: 12px; border-left: 4px solid #f2b01e;">
            <h3 style="color: #f59e0b; margin-bottom: 15px; font-weight: 700;">
                <i class="fas fa-lightbulb me-2"></i> Personaliza tu Experiencia
            </h3>
            <p style="color: #666; margin-bottom: 15px;">
                Aún no has configurado tus gustos. Configúralos para recibir recomendaciones personalizadas de tours.
            </p>
            <a href="{{ route('interests.settings') }}" class="btn"
                style="background: linear-gradient(135deg, #178f6a 0%, #0d5a4a 100%); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-block;">
                <i class="fas fa-heart me-2"></i> Configurar Mis Gustos
            </a>
        </div>
        @endif
        @endauth

        <h2 hidden></h2>
        <div class="benefits-grid">
            <div class="benefit-item">
                <a href="{{ route('tours.lugares') }}"><i class="fas fa-map-marker-alt"></i>
                    <h3>Lugares</h3>
                </a>

            </div>
            <div class="benefit-item">
                <a href="{{ route('tours.restaurantes') }}"><i class="fas fa-utensils"></i>
                    <h3>Restaurantes</h3>
                </a>

            </div>
            <div class="benefit-item">
                <a href="{{ route('tours.cultura') }}"><i class="fas fa-church"></i>
                    <h3>Cultura</h3>
                </a>

            </div>
            <div class="benefit-item">
                <a href="{{ route('tours.emprendedores') }}"><i class="fas fa-store"></i>
                    <h3>Emprendedores</h3>
                </a>

            </div>
        </div>
    </div>
</section>

<!-- Seccion de Recomendaciones -->
<section class="Recomendaciones" id="Recomendaciones">
    <div class="container">
        @auth
        @if($hasInterests)
        <h2>Tours Recomendados para Ti</h2>
        @if(count($tours) === 0)
        <div style="text-align: center; padding: 40px 20px;">
            <i class="fas fa-search" style="font-size: 3rem; color: #ccc; margin-bottom: 20px; display: block;"></i>
            <p style="color: #666; font-size: 1.1rem;">No hay tours disponibles que coincidan con tus intereses en este
                momento.</p>
            <a href="{{ route('interests.settings') }}" class="btn"
                style="background: linear-gradient(135deg, #178f6a 0%, #0d5a4a 100%); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-block; margin-top: 15px;">
                Cambiar mis gustos
            </a>
        </div>
        @endif
        @else
        <h2>Nuestras Recomendaciones</h2>
        @endif
        @else
        <h2>Nuestras Recomendaciones</h2>
        @endauth
        <div class="tours-grid">
            @foreach($tours as $tour)
            <div class="tour-card" style="position: relative;">
                @auth
                @if($hasInterests && isset($tour->match_count))
                <div
                    style="position: absolute; top: 10px; right: 10px; background: linear-gradient(135deg, #178f6a 0%, #0d5a4a 100%); color: white; padding: 8px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; box-shadow: 0 4px 10px rgba(23, 143, 106, 0.3); z-index: 10;">
                    <i class="fas fa-check-circle me-1"></i> {{ $tour->match_count }} coincidencia(s)
                </div>
                @endif
                @endauth
                <img src="{{ asset($tour->image) }}" alt="{{ $tour->name }}">
                <div class="tour-card-content">
                    <h3>{{ $tour->name }}</h3>
                    @if(isset($tour->tipo))
                    <div style="font-size:0.85rem;color:#666;margin-bottom:6px;">
                        <strong>Tipo:</strong> {{ ucfirst(str_replace('_',' ', $tour->tipo)) }}
                    </div>
                    @endif
                    <p>{{ $tour->description }}</p>

                    @auth
                    @if($hasInterests && isset($tour->matching_tags) && count($tour->matching_tags) > 0)
                    <div style="margin-bottom: 10px;">
                        <small style="color: #666;">Tus intereses coinciden en:</small>
                        <div style="display: flex; flex-wrap: wrap; gap: 5px; margin-top: 5px;">
                            @php
                            $availableInterests = App\Models\UserInterest::getAvailableInterests();
                            @endphp
                            @foreach($tour->matching_tags as $tag)
                            <span
                                style="background: #e8f5f0; color: #178f6a; padding: 4px 10px; border-radius: 12px; font-size: 0.8rem; font-weight: 500;">
                                {{ $availableInterests[$tag] ?? ucfirst(str_replace('_', ' ', $tag)) }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @endauth

                    <div class="tour-price">
                        <a target="blank" href="https://www.google.com/maps/place/{{($tour->link)}}">Ver en
                            Google Maps</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Seccion de tours -->
<section class="tours" id="tours">
    <div class="container">
        <h2>Todos Nuestros Tours Disponibles</h2>
        <div class="tours-grid">
            @foreach($allTours as $tour)
            <div class="tour-card" style="position: relative;">
                <img src="{{ asset($tour->image) }}" alt="{{ $tour->name }}">
                <div class="tour-card-content">
                    <h3>{{ $tour->name }}</h3>
                    <p>{{ $tour->description }}</p>
                    <div class="tour-price">
                        <a target="blank" href="https://www.google.com/maps/place/{{($tour->link)}}">Ver en
                            Google Maps</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/dasboard.js') }}"></script>
@endpush
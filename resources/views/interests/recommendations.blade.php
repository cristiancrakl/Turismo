@extends('layouts.app')

@section('title', 'Tours Recomendados')

@section('content')
<!-- Debug Info (solo en desarrollo) -->
@if (config('app.debug'))
<div style="background: #f0f0f0; padding: 10px; margin: 10px; border-left: 4px solid #ff6b6b; font-family: monospace; font-size: 12px;">
    <strong>DEBUG:</strong>
    hasInterests: {{ $hasInterests ? 'true' : 'false' }} |
    Tours: {{ count($tours) }} |
    User Interests: {{ isset($userInterests) ? json_encode($userInterests) : 'N/A' }}
</div>
@endif

<div class="container my-5" style="min-height: calc(100vh - 200px); padding-top: 40px; padding-bottom: 60px;">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            <div class="recommendations-sidebar">
                <div class="sidebar-header">
                    <h5><i class="fas fa-sliders-h me-2"></i> Mis Intereses</h5>
                </div>

                @if ($hasInterests)
                <div class="interests-tags">
                    @php
                    $userInterests = auth()->user()->interests()->pluck('interest')->toArray();
                    $availableInterests = App\Models\UserInterest::getAvailableInterests();
                    @endphp

                    @foreach ($userInterests as $interest)
                    <span class="interest-tag">
                        {{ $availableInterests[$interest] ?? $interest }}
                    </span>
                    @endforeach
                </div>

                <a href="{{ route('interests.settings') }}" class="btn btn-outline-secondary btn-sm w-100">
                    <i class="fas fa-edit me-2"></i> Editar Gustos
                </a>
                @else
                <p class="text-muted text-center">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    No has configurado tus gustos
                </p>
                <a href="{{ route('interests.settings') }}" class="btn btn-primary btn-sm w-100">
                    <i class="fas fa-heart me-2"></i> Configurar Ahora
                </a>
                @endif
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            @if (!$hasInterests)
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-compass"></i>
                </div>
                <h2>Configura tus gustos para ver recomendaciones personalizadas</h2>
                <p>Selecciona tus intereses turísticos y te mostraremos los tours más adecuados para ti.</p>
                <a href="{{ route('interests.settings') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-heart me-2"></i> Configurar Mis Gustos
                </a>
            </div>
            @elseif (count($tours) === 0)
            <!-- No tours found -->
            <div class="no-tours">
                <div class="no-tours-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h2>No hay tours disponibles</h2>
                <p>Por el momento, no hay tours que coincidan con tus intereses.</p>
                <p class="text-muted">Prueba a añadir más intereses o intenta más tarde.</p>
                <a href="{{ route('interests.settings') }}" class="btn btn-secondary">
                    <i class="fas fa-edit me-2"></i> Cambiar Intereses
                </a>
            </div>
            @else
            <!-- Tours Grid -->
            <div class="recommendations-header">
                <h2><i class="fas fa-star me-2"></i> Tours Recomendados para Ti</h2>
                <p class="text-muted">{{ count($tours) }} tour(s) encontrado(s)</p>
            </div>

            <div class="tours-grid">
                @foreach ($tours as $tour)
                <div class="tour-card">
                    @if ($tour->image)
                    <div class="tour-image">
                        <img src="{{ asset($tour->image) }}" alt="{{ $tour->name }}">
                        <div class="tour-match-badge">
                            <i class="fas fa-check-circle me-1"></i>
                            {{ $tour->match_count }} coincidencia(s)
                        </div>
                    </div>
                    @else
                    <div class="tour-image tour-image-placeholder">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif

                    <div class="tour-content">
                        <h3 class="tour-name">{{ $tour->name }}</h3>

                        @if ($tour->description)
                        <p class="tour-description">
                            {{ Str::limit($tour->description, 100) }}
                        </p>
                        @endif

                        <div class="tour-tags">
                            @php
                            $tags = is_string($tour->tags) ? json_decode($tour->tags, true) : $tour->tags;
                            $tags = is_array($tags) ? $tags : [];
                            @endphp
                            @foreach (array_slice($tags, 0, 3) as $tag)
                            <span class="tag">{{ ucfirst($tag) }}</span>
                            @endforeach
                            @if (count($tags) > 3)
                            <span class="tag">+{{ count($tags) - 3 }}</span>
                            @endif
                        </div>

                        @if ($tour->price)
                        <div class="tour-price">
                            <span class="price-label">Desde</span>
                            <span class="price-amount">${{ number_format($tour->price, 0) }}</span>
                        </div>
                        @endif

                        <a href="#" class="btn btn-view-tour">
                            Ver Detalles <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    html,
    body {
        height: auto !important;
        overflow-y: auto !important;
    }

    .recommendations-sidebar {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        position: static;
    }

    .sidebar-header {
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }

    .sidebar-header h5 {
        margin: 0;
        color: #333;
        font-weight: 700;
    }

    .interests-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
    }

    .interest-tag {
        background: linear-gradient(135deg, #178f6a 0%, #0d5a4a 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .empty-state,
    .no-tours {
        text-align: center;
        padding: 80px 40px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .empty-icon,
    .no-tours-icon {
        font-size: 4rem;
        color: #178f6a;
        margin-bottom: 20px;
        opacity: 0.8;
    }

    .empty-state h2,
    .no-tours h2 {
        color: #333;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .empty-state p,
    .no-tours p {
        color: #666;
        font-size: 1.05rem;
        margin-bottom: 15px;
    }

    .recommendations-header {
        margin-bottom: 30px;
    }

    .recommendations-header h2 {
        color: #333;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .tours-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
    }

    .tour-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .tour-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .tour-image {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: #f0f0f0;
    }

    .tour-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .tour-card:hover .tour-image img {
        transform: scale(1.05);
    }

    .tour-image-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ccc;
        font-size: 2rem;
    }

    .tour-match-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: linear-gradient(135deg, #178f6a 0%, #0d5a4a 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(23, 143, 106, 0.3);
    }

    .tour-content {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .tour-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #333;
        margin: 0 0 10px 0;
    }

    .tour-description {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 12px;
        line-height: 1.5;
    }

    .tour-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 15px;
    }

    .tag {
        background: #f0f0f0;
        color: #555;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .tour-price {
        display: flex;
        align-items: baseline;
        gap: 8px;
        margin-bottom: 15px;
        padding-top: 12px;
        border-top: 1px solid #e9ecef;
    }

    .price-label {
        font-size: 0.85rem;
        color: #666;
        font-weight: 500;
    }

    .price-amount {
        font-size: 1.5rem;
        color: #178f6a;
        font-weight: 700;
    }

    .btn-view-tour {
        background: linear-gradient(135deg, #178f6a 0%, #0d5a4a 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: auto;
        text-align: center;
        display: inline-block;
    }

    .btn-view-tour:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(23, 143, 106, 0.3);
        color: white;
    }

    @media (max-width: 768px) {
        .recommendations-sidebar {
            position: static;
            margin-bottom: 30px;
        }

        .tours-grid {
            grid-template-columns: 1fr;
        }

        .empty-state,
        .no-tours {
            padding: 50px 20px;
        }

        .empty-icon,
        .no-tours-icon {
            font-size: 3rem;
        }
    }
</style>
@endsection
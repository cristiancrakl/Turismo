<div class="tour-card" style="cursor:pointer;" onclick="window.location='{{ route('tours.show', $tour->id) }}'">
    @auth
    @if(isset($tour->match_count))
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

        {{-- Mostrar descripción completa para coincidir con dashboard --}}
        <p>{{ $tour->description }}</p>

        @auth
        @if(isset($tour->matching_tags) && count($tour->matching_tags) > 0)
        <div style="margin-bottom: 10px;">
            <small style="color: #666;">Tus intereses coinciden en:</small>
            <div style="display: flex; flex-wrap: wrap; gap: 5px; margin-top: 5px;">
                @php $availableInterests = App\Models\UserInterest::getAvailableInterests(); @endphp
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
            @if($tour->tipo === 'emprendedores' && $tour->profile_link)
            <a target="_blank" href="{{ $tour->profile_link }}" onclick="event.stopPropagation();">Ver Perfil</a>
            @else
            @php
            $mapUrl = $tour->link ?? ('https://www.google.com/maps/search/?api=1&query=' . urlencode($tour->location ??
            $tour->name));
            @endphp
            <a target="_blank" href="{{ $mapUrl }}" onclick="event.stopPropagation();">Ver en Google Maps</a>
            @endif
        </div>
    </div>
</div>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name')}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{asset('img/logos/logoAplicacion.png')}}">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Styles / Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


</head>

<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <h1>{{ config('app.name')}}</h1>
                </div>
                <div class="user-buttons">
                    <button class="btn btn-secondary"><a href="{{route('login')}}">Iniciar Sesion</a></button>
                    <button class="btn btn-primary"><a href="{{route('register')}}">Registrarse</a></button>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="hero-background"
                style="background-image: url('{{ asset('img/fotosWelcome/los_estoraques2.png') }}')"></div>
            <div class="hero-content">
                <h1>Ocaña, Colombia</h1>
                <p class="hero-subtitle">4.6 · 181 opiniones</p>
                <div class="hero-buttons">
                    <button class="btn btn-primary"><a href="{{route('login')}}">Ver atracciones</a></button>
                    <button class="btn btn-secondary"><a href="{{route('login')}}">Ver hoteles</a></button>
                </div>
            </div>
        </section>

        <section class="gallery">
            <div class="container">
                <div class="gallery-carousel">
                    <div class="gallery-item">
                        <img src="{{asset('img/fotosWelcome/Ocaña1.jpg')}}" alt="Foto 1 de Ocaña">
                        <div class="photo-overlay">1 / 4</div>
                    </div>
                    <div class="gallery-item">
                        <img src="{{asset('img/fotosWelcome/Ocaña2.jpg')}}" alt="Foto 2 de Ocaña">
                        <div class="photo-overlay">2 / 4</div>
                    </div>
                    <div class="gallery-item">
                        <img src="{{asset('img/fotosWelcome/Ocaña3.jpg')}}" alt="Foto 3 de Ocaña">
                        <div class="photo-overlay">3 / 4</div>
                    </div>
                    <div class="gallery-item">
                        <img src="{{asset('img/fotosWelcome/Ocaña4.jpg')}}" alt="Foto 4 de Ocaña">
                        <div class="photo-overlay">4 / 4</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="attractions">
            <div class="container">
                <h2>Atracciones destacadas</h2>
                <div class="attractions-grid">
                    <article class="card">
                        <img src="{{asset('img/fotosWelcome/los_estoraques2.png')}}"
                            alt="Área Natural Única Los Estoraques">
                        <div class="card-content">
                            <h3>Área Natural Única Los Estoraques</h3>
                            <div class="rating">
                                <div class="stars">★★★★★</div>
                                <span>4.8</span>
                            </div>
                            <p class="category">Naturaleza</p>
                            <p>Reserva natural con bosques y ríos, ideal para ecoturismo y observación de aves.</p>
                            <button class="btn btn-primary"><a href="{{route('login')}}">Ver Más</a></button>
                        </div>
                    </article>
                    <article class="card">
                        <img src="{{asset('img/fotosWelcome/catedralSantaAna.png')}}" alt="Catedral de Santa Ana">
                        <div class="card-content">
                            <h3>Catedral de Santa Ana</h3>
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span>4.5</span>
                            </div>
                            <p class="category">Historia</p>
                            <p>Iglesia colonial del siglo XVII con arquitectura barroca y arte religioso.</p>
                            <button class="btn btn-primary"><a href="{{route('login')}}">Ver Más</a></button>
                        </div>
                    </article>
                    <article class="card">
                        <img src="{{asset('img/fotosWelcome/parque_ocaña.jpeg')}}" alt="Parque Principal">
                        <div class="card-content">
                            <h3>Parque Principal</h3>
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span>4.3</span>
                            </div>
                            <p class="category">Punto de interés</p>
                            <p>Centro histórico con plazas, fuentes y arquitectura colonial.</p>
                            <button class="btn btn-primary"><a href="{{route('login')}}">Ver Más</a></button>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="hotels">
            <div class="container">
                <div class="hotels-carousel">
                    <article class="hotel-card">
                        <img src="{{asset('img/fotosWelcome/hotelPlazaReal.png')}}" alt="Hotel Plaza">
                        <div class="card-content">
                            <h3>Hotel Plaza</h3>
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span>4.4</span>
                            </div>
                            <p class="price">Desde $80.000/noche</p>
                            <div class="hotel-buttons">
                                <button class="btn btn-secondary"><a href="{{route('login')}}">Reservar</a></button>
                                <button class="btn btn-outline"><a href="{{route('login')}}">ver</a></button>
                            </div>
                        </div>
                    </article>
                    <article class="hotel-card">
                        <img src="{{asset('img/fotosWelcome/hotelReal.png')}}" alt="Hotel Real">
                        <div class="card-content">
                            <h3>Hotel Real</h3>
                            <div class="rating">
                                <div class="stars">★★★☆☆</div>
                                <span>3.8</span>
                            </div>
                            <p class="price">Desde $60.000/noche</p>
                            <div class="hotel-buttons">
                                <button class="btn btn-secondary">Reservar</button>
                                <button class="btn btn-outline">Ver</button>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="map-section">
            <div class="container">
                <div class="map-layout">
                    <div class="map-sidebar">
                        <div id="map"></div>
                        <div class="filters">
                            <h3>Filtros</h3>
                            <details>
                                <summary>Tipo</summary>
                                <ul>
                                    <li><a href="#" class="filter-btn" data-type="all">Todo</a></li>
                                    <li><a href="#" class="filter-btn" data-type="Naturaleza">Naturaleza</a></li>
                                    <li><a href="#" class="filter-btn" data-type="Historia">Historia</a></li>
                                    <li><a href="#" class="filter-btn" data-type="Iglesias">Iglesias</a></li>
                                </ul>
                            </details>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="reviews">
            <div class="container">
                <h2>Reseñas</h2>
                <div class="reviews-list">
                    <article class="review">
                        <img src="{{asset('img/Avatar/Hombre1.jpg')}}" alt="Avatar de Juan Pérez" class="avatar">
                        <div class="review-content">
                            <div class="review-header">
                                <h4>Juan Pérez</h4>
                                <span class="date">15 oct 2023</span>
                                <div class="rating">
                                    <div class="stars">★★★★★</div>
                                    <span>5.0</span>
                                </div>
                            </div>
                            <p>Excelente lugar para visitar. La naturaleza es impresionante y el pueblo tiene mucho
                                encanto.</p>
                        </div>
                    </article>
                    <article class="review">
                        <img src="{{asset('img/Avatar/Mujer.jpg')}}" alt="Avatar de María López" class="avatar">
                        <div class="review-content">
                            <div class="review-header">
                                <h4>María López</h4>
                                <span class="date">22 sep 2023</span>
                                <div class="rating">
                                    <div class="stars">★★★★☆</div>
                                    <span>4.0</span>
                                </div>
                            </div>
                            <p>Muy buena experiencia. Recomiendo el hotel colonial y las atracciones naturales.</p>
                        </div>
                    </article>
                    <article class="review">
                        <img src="{{asset('img/Avatar/Hombre2.jpg')}}" alt="Avatar de Carlos García" class="avatar">
                        <div class="review-content">
                            <div class="review-header">
                                <h4>Carlos García</h4>
                                <span class="date">10 ago 2023</span>
                                <div class="rating">
                                    <div class="stars">★★★★☆</div>
                                    <span>4.5</span>
                                </div>
                            </div>
                            <p>Ocaña es un destino único. La historia y la cultura son fascinantes.</p>
                        </div>
                    </article>
                </div>
                <button class="btn btn-primary">Ver todas las reseñas</button>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name')}}. Todos los
                derechos
                reservados.</p>
        </div>
    </footer>


</body>

</html>

<!-- Leaflet JS + inicialización del mapa con filtros -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        try {
            var lat = 8.2379;
            var lng = -73.3568;
            var map = L.map('map').setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
            }).addTo(map);

            var places = [{
                    name: 'Área Natural Única Los Estoraques',
                    lat: 8.2265,
                    lng: -73.3535,
                    type: 'Naturaleza'
                },
                {
                    name: 'Catedral de Santa Ana',
                    lat: 8.2391,
                    lng: -73.3572,
                    type: 'Historia'
                },
                {
                    name: 'Parque Principal',
                    lat: 8.2382,
                    lng: -73.3560,
                    type: 'Punto'
                },
                {
                    name: 'Iglesia San Joaquín',
                    lat: 8.2410,
                    lng: -73.3540,
                    type: 'Iglesias'
                }
            ];

            var markersLayer = L.layerGroup().addTo(map);

            function renderMarkers(filterType) {
                markersLayer.clearLayers();
                places.forEach(function(p) {
                    if (!filterType || filterType === 'all' || p.type === filterType) {
                        var m = L.marker([p.lat, p.lng]).bindPopup('<strong>' + p.name + '</strong><br>' + p
                            .type);
                        markersLayer.addLayer(m);
                    }
                });
            }

            renderMarkers('all');

            L.circleMarker([lat, lng], {
                radius: 6,
                color: '#178f6a',
                fillOpacity: 1
            }).addTo(map).bindPopup('Ocaña, Norte de Santander');

            var filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var type = btn.getAttribute('data-type');
                    renderMarkers(type === 'all' ? 'all' : type);
                    filterButtons.forEach(function(b) {
                        b.classList.remove('active-filter');
                    });
                    btn.classList.add('active-filter');
                });
            });

            var defaultBtn = document.querySelector('.filter-btn[data-type="all"]');
            if (defaultBtn) defaultBtn.classList.add('active-filter');

        } catch (e) {
            console.error('Error inicializando Leaflet:', e);
        }
    });
</script>
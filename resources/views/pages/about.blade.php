@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="page-main" style="padding-top:90px; min-height:calc(100vh - 160px); display:flex; flex-direction:column;">
    <div class="container my-5" style="flex:0 0 auto;">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mb-4">About Us</h1>
                <div class="card">
                    <div class="card-body">
                        <p>
                            AMARU es una iniciativa para promover el turismo local y cultural en la región,
                            conectando visitantes con lugares, restaurantes, actividades culturales y emprendedores locales.
                            Nuestro objetivo es preservar tradiciones, impulsar la economía local y ofrecer experiencias
                            auténticas a los viajeros.
                        </p>
                        <h4>¿Qué hacemos?</h4>
                        <ul>
                            <li>Promovemos tours y actividades locales</li>
                            <li>Conectamos turistas con emprendedores y restaurantes</li>
                            <li>Ofrecemos recomendación personalizada basada en intereses</li>
                        </ul>
                        <p>Si tienes preguntas, contáctanos desde la página de contacto.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="flex:1 1 auto;"></div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Configurar Gustos')

@section('content')
<div class="container my-5" style="min-height: calc(100vh - 200px); padding-top: 40px; padding-bottom: 60px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card principal -->
            <div class="interests-card">
                <div class="interests-header">
                    <div class="interests-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h1>Configuración de Gustos</h1>
                    <p>Selecciona tus intereses turísticos para recibir recomendaciones personalizadas</p>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <form action="{{ route('interests.save') }}" method="POST" class="interests-form">
                    @csrf

                    <div class="interests-grid">
                        @foreach ($availableInterests as $key => $label)
                        <div class="interest-item">
                            <input
                                type="checkbox"
                                id="interest_{{ $key }}"
                                name="interests[]"
                                value="{{ $key }}"
                                class="interest-checkbox"
                                {{ in_array($key, $userInterests) ? 'checked' : '' }}>
                            <label for="interest_{{ $key }}" class="interest-label">
                                <span class="checkbox-custom"></span>
                                <span class="interest-text">{{ $label }}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <div class="interests-actions">
                        <button type="submit" class="btn btn-save">
                            <i class="fas fa-save me-2"></i> Guardar Cambios
                        </button>
                        <a href="{{ route('interests.recommendations') }}" class="btn btn-secondary">
                            <i class="fas fa-compass me-2"></i> Ver Recomendaciones
                        </a>
                    </div>
                </form>
            </div>

            <!-- Info -->
            <div class="interests-info mt-4">
                <p class="text-center text-muted">
                    <i class="fas fa-info-circle me-2"></i>
                    Puedes seleccionar varios intereses para recibir mejores recomendaciones de tours
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    html,
    body {
        height: auto !important;
        overflow-y: auto !important;
    }

    .interests-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        overflow: visible;
        animation: slideUp 0.4s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .interests-header {
        background: linear-gradient(135deg, #178f6a 0%, #0d5a4a 100%);
        color: white;
        padding: 40px 30px;
        text-align: center;
    }

    .interests-icon {
        font-size: 3rem;
        margin-bottom: 15px;
        opacity: 0.9;
    }

    .interests-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 10px 0;
    }

    .interests-header p {
        font-size: 1rem;
        margin: 0;
        opacity: 0.95;
    }

    .interests-form {
        padding: 40px 30px;
    }

    .interests-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .interest-item {
        position: relative;
    }

    .interest-checkbox {
        display: none;
    }

    .interest-label {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin: 0;
    }

    .interest-label:hover {
        background: #f0f0f0;
        border-color: #178f6a;
    }

    .interest-checkbox:checked+.interest-label {
        background: #e8f5f0;
        border-color: #178f6a;
        box-shadow: 0 0 0 3px rgba(23, 143, 106, 0.1);
    }

    .checkbox-custom {
        width: 20px;
        height: 20px;
        border: 2px solid #ccc;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .interest-checkbox:checked+.interest-label .checkbox-custom {
        background: #178f6a;
        border-color: #178f6a;
        color: white;
    }

    .checkbox-custom::after {
        content: '';
        display: none;
        width: 4px;
        height: 8px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .interest-checkbox:checked+.interest-label .checkbox-custom::after {
        display: block;
    }

    .interest-text {
        font-weight: 500;
        color: #333;
        flex: 1;
    }

    .interests-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }

    .btn-save {
        background: linear-gradient(135deg, #178f6a 0%, #0d5a4a 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(23, 143, 106, 0.3);
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(23, 143, 106, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-secondary {
        background: #f5f6f7;
        color: #333;
        border: 2px solid #e9ecef;
        padding: 10px 28px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: #e9ecef;
        color: #333;
        text-decoration: none;
    }

    .interests-info {
        background: #f8f9fa;
        padding: 15px 20px;
        border-radius: 10px;
        border-left: 4px solid #178f6a;
    }

    .alert {
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .interests-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .interests-header {
            padding: 30px 20px;
        }

        .interests-header h1 {
            font-size: 1.5rem;
        }

        .interests-form {
            padding: 20px;
        }

        .interests-actions {
            flex-direction: column;
        }

        .btn-save,
        .btn-secondary {
            width: 100%;
        }
    }
</style>
@endsection
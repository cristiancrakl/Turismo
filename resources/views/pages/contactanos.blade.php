@extends('layouts.app')

@section('title', 'Contáctanos')

@section('content')
<div class="page-main" style="padding-top:90px; min-height:calc(100vh - 160px); display:flex; flex-direction:column;">
    <div class="container my-5" style="flex:0 0 auto;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">Contáctanos</h1>

                @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('contactanos.send') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Mensaje</label>
                                <textarea name="message" id="message" rows="6" class="form-control" required>{{ old('message') }}</textarea>
                                @error('message') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <button class="btn btn-primary" type="submit">Enviar Mensaje</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div style="flex:1 1 auto;"></div>
</div>
@endsection
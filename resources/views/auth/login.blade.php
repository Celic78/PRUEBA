@extends('layouts.app')

@section('title', 'Inicio de Sesión')

@section('content')
<div class="login-wrapper">
    <div class="login-card">
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="login-title-box">
                <h2>INICIO DE SESION</h2>
            </div>

            @if($errors->any())
                <p style="color: #a83232; font-size: 0.9rem; margin-bottom: 1rem;">
                    {{ $errors->first() }}
                </p>
            @endif

            <div class="login-field-box">
                <label for="name">USUARIO</label>
                <input type="text" id="name" name="name" class="login-input" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="login-field-box">
                <label for="password">CONTRASEÑA</label>
                <input type="password" id="password" name="password" class="login-input" required>
            </div>

            <div class="login-btn-box">
                <button type="submit" class="login-btn">INGRESAR</button>
            </div>
        </form>
    </div>
</div>
@endsection
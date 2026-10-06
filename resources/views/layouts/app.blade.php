<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Consultorio Nutricional')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @auth
    <div class="app-container">
        <!-- Sidebar Lateral -->
        <aside class="sidebar">
            <div>
                <a href="#" class="sidebar-brand font-playfair">NutriClínica</a>
                <nav class="sidebar-nav">
                    @if(Auth::user()->esNutriologo())
                        <a href="{{ route('nutriologo.dashboard') }}" class="sidebar-link {{ request()->routeIs('nutriologo.dashboard') ? 'active' : '' }}">Inicio</a>
                        <a href="{{ route('nutriologo.pacientes') }}" class="sidebar-link {{ request()->routeIs('nutriologo.pacientes*') ? 'active' : '' }}">Pacientes</a>
                        <a href="{{ route('nutriologo.citas') }}" class="sidebar-link {{ request()->routeIs('nutriologo.citas') ? 'active' : '' }}">Citas Medica</a>
                    @else
                        <a href="{{ route('paciente.dashboard') }}" class="sidebar-link {{ request()->routeIs('paciente.dashboard') ? 'active' : '' }}">Mi Panel</a>
                    @endif
                </nav>
            </div>
            <div>
                <button id="theme-toggle" class="theme-toggle" style="width: 100%; margin-bottom: 1rem;">Modo Oscuro</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="width: 100%;">Cerrar Sesión</button>
                </form>
            </div>
        </aside>

        <!-- Contenido Principal -->
        <main class="main-content">
            <div class="header-top">
                <h1 class="font-playfair">@yield('page-title', 'Bienvenido')</h1>
                <div>
                    <span>Hola, <strong>{{ Auth::user()->name }}</strong></span>
                </div>
            </div>

            @if(session('success'))
                <div class="card" style="background-color: var(--lime-cream); color: var(--evergreen); border: none;">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="card" style="background-color: #fecaca; color: #991b1b; border: none;">
                    <ul style="margin-left: 1.25rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    @else
        <!-- Para Vistas Públicas o Login -->
        <div style="position: absolute; top: 1rem; right: 1rem;">
            <button id="theme-toggle" class="theme-toggle">Modo Oscuro</button>
        </div>
        @yield('content')
    @endauth
</body>
</html>
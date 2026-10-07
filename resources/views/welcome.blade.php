<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriVida | Nutrición Clínica</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-salvia: #eaf0e8;
            --bg-white: #ffffff;
            --green-forest: #1b3823;
            --green-emerald: #2e7d52;
            --green-emerald-light: rgba(46, 125, 82, 0.08);
            --text-dark: #19291c;
            --text-muted: #536957;
            --border-soft: #d3dfd5;
            --radius-pill: 9999px;
            --radius-card: 28px;
            --shadow-clean: 0 16px 40px rgba(27, 56, 35, 0.06);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-salvia);
            color: var(--text-dark);
            min-height: 100vh;
        }

        /* NAVBAR */
        .navbar {
            max-width: 1200px;
            margin: 1.5rem auto;
            padding: 0.8rem 2rem;
            background: var(--bg-white);
            border-radius: var(--radius-pill);
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow-clean);
            border: 1px solid var(--border-soft);
        }

        .brand {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--green-forest);
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.3s;
        }

        .nav-links a:hover, .nav-links a.active {
            color: var(--green-forest);
        }

        .btn-login {
            background-color: var(--green-forest);
            color: #ffffff;
            padding: 0.7rem 1.6rem;
            border-radius: var(--radius-pill);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: var(--green-emerald);
        }

        /* HERO SECTION */
        .hero {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .hero-badge {
            display: inline-block;
            background-color: var(--green-emerald-light);
            color: var(--green-emerald);
            padding: 0.5rem 1.2rem;
            border-radius: var(--radius-pill);
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
        }

        .hero h1 {
            font-size: 3.2rem;
            line-height: 1.15;
            color: var(--green-forest);
            font-weight: 800;
            margin-bottom: 1.2rem;
        }

        .hero p {
            font-size: 1.1rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn-cta {
            display: inline-block;
            background-color: var(--green-forest);
            color: #ffffff;
            padding: 1rem 2.2rem;
            border-radius: var(--radius-pill);
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 8px 20px rgba(27, 56, 35, 0.15);
            transition: all 0.3s ease;
        }

        .btn-cta:hover {
            background-color: var(--green-emerald);
            transform: translateY(-2px);
        }

        .hero-card {
            background: var(--bg-white);
            border-radius: var(--radius-card);
            padding: 3rem;
            border: 1px solid var(--border-soft);
            box-shadow: var(--shadow-clean);
            text-align: center;
        }

        .hero-card h3 {
            font-size: 1.8rem;
            color: var(--green-forest);
            margin-bottom: 1rem;
        }

        .hero-card p {
            font-size: 0.95rem;
            margin-bottom: 0;
        }
    </style>
</head>
<body>

    <!-- MENÚ SUPERIOR -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="brand">NutriVida</a>
        
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="active">Inicio</a></li>
            <li><a href="{{ route('recursos') }}">Recursos</a></li>
            <li><a href="{{ route('nosotros') }}">Nosotros</a></li>
        </ul>

        <a href="{{ route('login') }}" class="btn-login">Iniciar Sesión</a>
    </nav>

    <!-- SECCIÓN PRINCIPAL -->
    <section class="hero">
        <div>
            <span class="hero-badge">Consulta Nutricional Personalizada</span>
            <h1>Transforma tu salud con un enfoque sostenible</h1>
            <p>Diseñamos planes de alimentación adaptados a tu estilo de vida, apoyados en evaluación clínica integral y constante seguimiento profesional.</p>
            <a href="{{ route('appointments.create') }}" class="btn-cta">Agendar Consulta</a>
        </div>

        <div class="hero-card">
            <div style="width: 70px; height: 70px; background: var(--green-emerald-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--green-emerald)" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <h3>Atención Profesional</h3>
            <p>Seguimiento clínico para el control de peso, nutrición deportiva y salud metabólica.</p>
        </div>
    </section>

</body>
</html>
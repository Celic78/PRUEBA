<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | NutriVida</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-card {
            max-width: 440px;
            width: 100%;
            background-color: var(--bg-white);
            border: 1px solid var(--border-soft);
            border-radius: var(--radius-card);
            padding: 3rem 2.5rem;
            box-shadow: var(--shadow-clean);
            text-align: center;
        }

        .brand-pill {
            display: inline-block;
            background-color: var(--green-emerald-light);
            color: var(--green-emerald);
            padding: 0.5rem 1.2rem;
            border-radius: var(--radius-pill);
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
        }

        .login-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--green-forest);
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
            text-align: center;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--green-forest);
            margin-bottom: 0.4rem;
        }

        .input-pill-centered {
            width: 100%;
            padding: 0.95rem 1.5rem;
            border-radius: var(--radius-pill);
            border: 1.5px solid var(--border-soft);
            background-color: #f9fbf9;
            color: var(--text-dark);
            font-size: 0.95rem;
            text-align: center;
            outline: none;
            transition: all 0.3s ease;
        }

        .input-pill-centered:focus {
            border-color: var(--green-emerald);
            background-color: var(--bg-white);
            box-shadow: 0 0 0 4px var(--green-emerald-light);
        }

        .btn-pill-submit {
            width: 100%;
            background-color: var(--green-forest);
            color: #ffffff;
            border: none;
            padding: 1rem 2rem;
            border-radius: var(--radius-pill);
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
            box-shadow: 0 8px 20px rgba(27, 56, 35, 0.15);
        }

        .btn-pill-submit:hover {
            background-color: var(--green-emerald);
            transform: translateY(-2px);
        }

        .back-link {
            display: inline-block;
            margin-top: 1.5rem;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .back-link:hover {
            color: var(--green-forest);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <span class="brand-pill">NutriVida Access</span>
        <h1 class="login-title">Iniciar Sesión</h1>
        <p class="login-subtitle">Ingresa tus datos para acceder al sistema</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="input-pill-centered" placeholder="ejemplo@correo.com" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="input-pill-centered" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-pill-submit">
                Entrar a la Cuenta
            </button>
        </form>

        <a href="/" class="back-link">← Volver al inicio</a>
    </div>

</body>
</html>
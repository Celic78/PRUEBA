<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Panel | NutriVida Pacientes</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-salvia: #eaf0e8;
            --bg-white: #ffffff;
            --green-forest: #1b3823;
            --green-emerald: #2e7d52;
            --text-dark: #19291c;
            --text-muted: #536957;
            --border-soft: #d3dfd5;
            --radius-pill: 9999px;
            --radius-card: 28px;
            --shadow-clean: 0 16px 40px rgba(27, 56, 35, 0.06);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--bg-salvia); color: var(--text-dark); min-height: 100vh; padding: 2rem; }

        .container { max-width: 720px; margin: 1rem auto; background: var(--bg-white); border-radius: var(--radius-card); padding: 2.5rem; border: 1px solid var(--border-soft); box-shadow: var(--shadow-clean); text-align: center; }
        .welcome-badge { background: rgba(46, 125, 82, 0.1); color: var(--green-emerald); padding: 0.5rem 1.2rem; border-radius: var(--radius-pill); font-weight: 700; font-size: 0.85rem; display: inline-block; margin-bottom: 1rem; }
        h1 { font-size: 2rem; color: var(--green-forest); margin-bottom: 0.5rem; font-weight: 800; }
        p { color: var(--text-muted); line-height: 1.6; margin-bottom: 2rem; }

        .btn-pill { background-color: var(--green-forest); color: white; padding: 0.9rem 2rem; border-radius: var(--radius-pill); font-weight: 700; text-decoration: none; display: inline-block; }

        .citas-list { text-align: left; margin-top: 2rem; border-top: 1px solid var(--border-soft); padding-top: 1.5rem; }
        .cita-card { background: #f9fbf9; border: 1px solid var(--border-soft); padding: 1.2rem; border-radius: 18px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
        .cita-info h4 { font-size: 0.95rem; color: var(--green-forest); font-weight: 800; }
        .cita-info p { font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0; }
        .btn-pdf { background: var(--green-emerald); color: white; text-decoration: none; padding: 0.5rem 1rem; border-radius: var(--radius-pill); font-size: 0.8rem; font-weight: 700; }
    </style>
</head>
<body>

    <div class="container">
        <span class="welcome-badge">Portal del Paciente</span>
        <h1>¡Hola, {{ session('user_name') }}!</h1>
        <p>Gestiona tus consultas agendadas con la Dra. Rocío Morales.</p>

        <a href="{{ route('appointments.create') }}" class="btn-pill">+ Agendar Nueva Cita</a>

        <div class="citas-list">
            <h3 style="font-size: 1.1rem; color: var(--green-forest); margin-bottom: 1rem;">Mis Citas Registradas</h3>
            @if(empty($misCitas))
                <p style="font-size: 0.85rem; color: var(--text-muted);">No tienes citas agendadas aún.</p>
            @else
                @foreach($misCitas as $c)
                    <div class="cita-card">
                        <div class="cita-info">
                            <h4>📅 {{ $c['fecha'] }} - {{ $c['hora'] }}</h4>
                            <p>Motivo: {{ $c['motivo'] }} | Folio: {{ $c['id'] }}</p>
                        </div>
                        <a href="{{ route('citas.pdf', ['id' => $c['id']]) }}" class="btn-pdf">📄 Descargar PDF</a>
                    </div>
                @endforeach
            @endif
        </div>

        <a href="{{ route('logout') }}" style="display:block; margin-top: 1.5rem; color: #d32f2f; text-decoration: none; font-size: 0.85rem; font-weight: 700;">Cerrar Sesión</a>
    </div>

</body>
</html>
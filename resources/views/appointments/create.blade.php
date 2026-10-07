<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita | NutriVida</title>
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
        body { background-color: var(--bg-salvia); color: var(--text-dark); min-height: 100vh; padding: 2rem; display: flex; align-items: center; justify-content: center; }

        .card { max-width: 520px; width: 100%; background: var(--bg-white); border-radius: var(--radius-card); padding: 2.5rem; border: 1px solid var(--border-soft); box-shadow: var(--shadow-clean); text-align: center; }
        h1 { font-size: 1.8rem; color: var(--green-forest); font-weight: 800; margin-bottom: 0.5rem; }
        p { color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.8rem; }

        .form-group { margin-bottom: 1.2rem; text-align: left; }
        .form-group label { display: block; font-size: 0.85rem; font-weight: 700; color: var(--green-forest); margin-bottom: 0.4rem; }

        .input-pill { width: 100%; padding: 0.85rem 1.2rem; border-radius: var(--radius-pill); border: 1.5px solid var(--border-soft); background-color: #f9fbf9; outline: none; font-size: 0.9rem; }
        .input-pill:focus { border-color: var(--green-emerald); background-color: #fff; }

        .btn-pill { width: 100%; background-color: var(--green-forest); color: white; padding: 1rem; border-radius: var(--radius-pill); font-weight: 700; border: none; cursor: pointer; font-size: 0.95rem; margin-top: 1rem; }
        .btn-pill:hover { background-color: var(--green-emerald); }

        .alert-error { background: #fde8e8; color: #9b1c1c; padding: 0.8rem; border-radius: var(--radius-pill); font-size: 0.85rem; font-weight: 700; margin-bottom: 1rem; text-align: center; }
        .occupied-hint { font-size: 0.75rem; color: #c53030; display: block; margin-top: 0.3rem; }
    </style>
</head>
<body>

    <div class="card">
        <h1>Agendar Consulta</h1>
        <p>Selecciona la fecha y horario de tu preferencia.</p>

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nombre Completo</label>
                <input type="text" name="nombre" value="{{ session('user_name') ?? '' }}" required class="input-pill" placeholder="Tu nombre">
            </div>

            <div class="form-group">
                <label>Selecciona la Fecha</label>
                <input type="date" id="selectFecha" name="fecha" required min="{{ date('Y-m-d') }}" class="input-pill">
            </div>

            <div class="form-group">
                <label>Selecciona el Horario</label>
                <select id="selectHora" name="hora" required class="input-pill">
                    <option value="">-- Selecciona primero una fecha --</option>
                    <option value="09:00 hrs">09:00 hrs</option>
                    <option value="10:00 hrs">10:00 hrs</option>
                    <option value="11:00 hrs">11:00 hrs</option>
                    <option value="12:00 hrs">12:00 hrs</option>
                    <option value="16:00 hrs">16:00 hrs</option>
                    <option value="17:00 hrs">17:00 hrs</option>
                </select>
                <span id="hintOcupado" class="occupied-hint" style="display:none;">* Los horarios marcados con (Ocupado) ya fueron reservados para este día.</span>
            </div>

            <div class="form-group">
                <label>Motivo de Consulta</label>
                <input type="text" name="motivo" class="input-pill" placeholder="Ej. Control de peso, nutrición deportiva">
            </div>

            <button type="submit" class="btn-pill">Confirmar y Descargar Comprobante</button>
        </form>

        <a href="{{ route('paciente.dashboard') }}" style="display:inline-block; margin-top: 1.2rem; color: var(--text-muted); text-decoration: none; font-weight: 700; font-size: 0.85rem;">← Volver al Panel</a>
    </div>

    <script>
        // Citas ya agendadas pasadas desde Laravel
        const citasExistentes = @json($citas);

        const fechaInput = document.getElementById('selectFecha');
        const horaSelect = document.getElementById('selectHora');
        const hintOcupado = document.getElementById('hintOcupado');

        fechaInput.addEventListener('change', function() {
            const fechaSeleccionada = this.value;
            let hayOcupados = false;

            Array.from(horaSelect.options).forEach(option => {
                if (!option.value) return;

                // Verificar si esta hora ya existe en la fecha seleccionada
                const estaOcupado = citasExistentes.some(c => c.fecha === fechaSeleccionada && c.hora === option.value);

                if (estaOcupado) {
                    option.disabled = true;
                    option.text = option.value + " - (Ocupado)";
                    hayOcupados = true;
                } else {
                    option.disabled = false;
                    option.text = option.value;
                }
            });

            horaSelect.value = "";
            hintOcupado.style.display = hayOcupados ? "block" : "none";
        });
    </script>
</body>
</html>
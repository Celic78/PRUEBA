<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Nutriólogo | NutriVida</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-salvia: #eaf0e8;
            --bg-white: #ffffff;
            --green-forest: #1b3823;
            --green-emerald: #2e7d52;
            --green-emerald-light: rgba(46, 125, 82, 0.1);
            --text-dark: #19291c;
            --text-muted: #536957;
            --border-soft: #d3dfd5;
            --radius-pill: 9999px;
            --radius-card: 24px;
            --shadow-clean: 0 12px 32px rgba(27, 56, 35, 0.05);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--bg-salvia); color: var(--text-dark); min-height: 100vh; }

        .dash-header { max-width: 1280px; margin: 0 auto; padding: 1.5rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        .user-pill { background-color: var(--bg-white); border: 1px solid var(--border-soft); padding: 0.5rem 1.2rem; border-radius: var(--radius-pill); display: flex; align-items: center; gap: 0.8rem; box-shadow: var(--shadow-clean); }
        .avatar-circle { width: 36px; height: 36px; border-radius: 50%; background-color: var(--green-forest); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem; }

        .dash-layout { max-width: 1280px; margin: 1rem auto 4rem auto; padding: 0 2rem; display: grid; grid-template-columns: 1fr 360px; gap: 2rem; }
        .kpi-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.2rem; margin-bottom: 2rem; }
        .kpi-card { background-color: var(--bg-white); border: 1px solid var(--border-soft); border-radius: var(--radius-card); padding: 1.5rem; text-align: center; box-shadow: var(--shadow-clean); }
        .kpi-card h3 { font-size: 2.2rem; font-weight: 800; color: var(--green-forest); }
        .kpi-card p { font-size: 0.85rem; color: var(--text-muted); font-weight: 600; }

        .section-card { background-color: var(--bg-white); border: 1px solid var(--border-soft); border-radius: var(--radius-card); padding: 2rem; box-shadow: var(--shadow-clean); margin-bottom: 2rem; }
        .section-title { font-size: 1.2rem; color: var(--green-forest); font-weight: 800; margin-bottom: 1.2rem; text-align: center; }

        .appointment-item { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.2rem; border-radius: var(--radius-pill); background-color: #f9fbf9; border: 1px solid var(--border-soft); margin-bottom: 0.8rem; }
        .patient-info h4 { font-size: 0.95rem; color: var(--green-forest); font-weight: 700; }
        .patient-info p { font-size: 0.8rem; color: var(--text-muted); }
        .time-badge { background-color: var(--green-emerald-light); color: var(--green-emerald); padding: 0.4rem 1rem; border-radius: var(--radius-pill); font-size: 0.85rem; font-weight: 700; }

        .input-pill-centered { width: 100%; padding: 0.9rem 1.2rem; border-radius: var(--radius-pill); border: 1.5px solid var(--border-soft); background-color: #f9fbf9; color: var(--text-dark); font-size: 0.9rem; text-align: center; outline: none; margin-bottom: 0.8rem; }
        .input-pill-centered:focus { border-color: var(--green-emerald); background-color: #fff; }

        .btn-pill-small { background-color: var(--green-forest); color: #ffffff; border: none; padding: 0.85rem 1.8rem; border-radius: var(--radius-pill); font-weight: 700; font-size: 0.85rem; cursor: pointer; width: 100%; transition: background 0.3s; }
        .btn-pill-small:hover { background-color: var(--green-emerald); }

        .alert-success { background: var(--green-emerald-light); color: var(--green-emerald); padding: 0.8rem; border-radius: var(--radius-pill); text-align: center; font-size: 0.85rem; font-weight: 700; margin-bottom: 1rem; display: none; }
        .logout-btn { color: #d32f2f; text-decoration: none; font-size: 0.85rem; font-weight: 700; }
    </style>
</head>
<body>

    <header class="dash-header">
        <div style="display: flex; align-items: center; gap: 0.8rem;">
            <h2 style="font-size: 1.2rem; color: var(--green-forest);">NutriVida <span style="font-size: 0.8rem; font-weight: 500; color: var(--text-muted);">| Panel Clínico (Superusuario)</span></h2>
        </div>

        <div class="user-pill">
            <div class="avatar-circle">DR</div>
            <span style="font-size: 0.85rem; font-weight: 700; color: var(--green-forest);">Dra. Rocío Morales</span>
            <a href="{{ route('logout') }}" class="logout-btn">Salir</a>
        </div>
    </header>

    <main class="dash-layout">
        <div>
            <div class="kpi-row">
                <div class="kpi-card">
                    <h3 id="total-citas">4</h3>
                    <p>Citas de Hoy</p>
                </div>
                <div class="kpi-card">
                    <h3 id="total-pacientes">28</h3>
                    <p>Pacientes Registrados</p>
                </div>
                <div class="kpi-card">
                    <h3>100%</h3>
                    <p>Acceso Seguro</p>
                </div>
            </div>

            <!-- Lista Dinámica de Citas -->
            <div class="section-card">
                <h3 class="section-title" style="text-align: left;">Agenda de Pacientes</h3>
                <div id="lista-pacientes">
                    <div class="appointment-item" data-nombre="María Fernanda Gómez">
                        <div class="patient-info">
                            <h4>María Fernanda Gómez</h4>
                            <p>Evaluación Inicial & Antropometría</p>
                        </div>
                        <span class="time-badge">10:00 hrs</span>
                    </div>

                    <div class="appointment-item" data-nombre="Carlos Eduardo Ruiz">
                        <div class="patient-info">
                            <h4>Carlos Eduardo Ruiz</h4>
                            <p>Control de Progreso Mensual</p>
                        </div>
                        <span class="time-badge">13:00 hrs</span>
                    </div>

                    <div class="appointment-item" data-nombre="Lucía Méndez">
                        <div class="patient-info">
                            <h4>Lucía Méndez</h4>
                            <p>Ajuste de Plan de Alimentación</p>
                        </div>
                        <span class="time-badge">16:00 hrs</span>
                    </div>

                    <div class="appointment-item" data-nombre="Jorge Valenzuela">
                        <div class="patient-info">
                            <h4>Jorge Valenzuela</h4>
                            <p>Seguimiento Deportivo</p>
                        </div>
                        <span class="time-badge">17:00 hrs</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formularios y Búsqueda Interactiva -->
        <div>
            <div class="section-card">
                <h3 class="section-title">Buscar Paciente</h3>
                <input type="text" id="inputBuscador" class="input-pill-centered" placeholder="Escribe el nombre del paciente...">
            </div>

            <div class="section-card">
                <h3 class="section-title">Guardar Ficha Clínica</h3>
                <div id="alertSuccess" class="alert-success">✓ Ficha registrada correctamente</div>

                <form id="formClinico">
                    <input type="text" id="nombrePaciente" class="input-pill-centered" placeholder="Nombre completo del paciente" required>
                    <input type="text" id="datosAntropometricos" class="input-pill-centered" placeholder="Peso / % Grasa / IMC" required>
                    <input type="text" id="observaciones" class="input-pill-centered" placeholder="Observaciones clínicas breves" required>
                    <button type="submit" class="btn-pill-small">Guardar Formulario</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Funcionalidad de Búsqueda de Pacientes en tiempo real
        document.getElementById('inputBuscador').addEventListener('keyup', function() {
            let filtro = this.value.toLowerCase();
            let items = document.querySelectorAll('#lista-pacientes .appointment-item');

            items.forEach(function(item) {
                let nombre = item.getAttribute('data-nombre').toLowerCase();
                if (nombre.includes(filtro)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Funcionalidad de Guardar Ficha Clínica en pantalla
        document.getElementById('formClinico').addEventListener('submit', function(e) {
            e.preventDefault();
            
            let nombre = document.getElementById('nombrePaciente').value;
            let datos = document.getElementById('datosAntropometricos').value;

            // Agregar a la lista de agenda
            let lista = document.getElementById('lista-pacientes');
            let nuevoItem = document.createElement('div');
            nuevoItem.className = 'appointment-item';
            nuevoItem.setAttribute('data-nombre', nombre);
            nuevoItem.innerHTML = `
                <div class="patient-info">
                    <h4>${nombre}</h4>
                    <p>Ficha: ${datos}</p>
                </div>
                <span class="time-badge">Registrado</span>
            `;
            lista.prepend(nuevoItem);

            // Actualizar contador
            let total = document.getElementById('total-pacientes');
            total.innerText = parseInt(total.innerText) + 1;

            // Mostrar mensaje de éxito y reiniciar formulario
            let alert = document.getElementById('alertSuccess');
            alert.style.display = 'block';
            document.getElementById('formClinico').reset();

            setTimeout(() => { alert.style.display = 'none'; }, 3000);
        });
    </script>
</body>
</html>
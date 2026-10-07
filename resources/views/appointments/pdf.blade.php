<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante_Cita_{{ $cita['id'] }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f4f6f4; padding: 2rem; color: #1b3823; }
        .ticket { max-width: 580px; margin: 0 auto; background: white; border-radius: 24px; padding: 3rem; border: 2px solid #d3dfd5; box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: center; }
        .brand { font-size: 1.8rem; font-weight: 800; color: #1b3823; margin-bottom: 0.2rem; }
        .badge { background: rgba(46, 125, 82, 0.1); color: #2e7d52; padding: 0.4rem 1rem; border-radius: 9999px; font-weight: 700; font-size: 0.8rem; display: inline-block; margin-bottom: 2rem; }
        .details { text-align: left; background: #f9fbf9; border: 1px solid #d3dfd5; border-radius: 16px; padding: 1.5rem; margin-bottom: 2rem; }
        .detail-row { display: flex; justify-content: space-between; margin-bottom: 0.8rem; font-size: 0.95rem; border-bottom: 1px dashed #d3dfd5; padding-bottom: 0.5rem; }
        .detail-row:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .label { color: #536957; font-weight: 600; }
        .val { font-weight: 800; color: #1b3823; }
        .btn-download { background: #1b3823; color: white; border: none; padding: 0.9rem 2rem; border-radius: 9999px; font-weight: 700; cursor: pointer; font-size: 0.9rem; text-decoration: none; display: inline-block; }
        
        /* Ocultar botones al imprimir a PDF */
        @media print {
            body { background: white; padding: 0; }
            .ticket { border: none; box-shadow: none; width: 100%; max-width: 100%; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

    <div class="ticket">
        <div class="brand">NutriVida</div>
        <span class="badge">Comprobante de Cita Confirmada</span>

        <div class="details">
            <div class="detail-row">
                <span class="label">Folio:</span>
                <span class="val">{{ $cita['id'] }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Paciente:</span>
                <span class="val">{{ $cita['nombre'] }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Fecha de Cita:</span>
                <span class="val">{{ $cita['fecha'] }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Horario Reservado:</span>
                <span class="val">{{ $cita['hora'] }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Especialista:</span>
                <span class="val">Dra. Rocío Morales</span>
            </div>
            <div class="detail-row">
                <span class="label">Motivo:</span>
                <span class="val">{{ $cita['motivo'] }}</span>
            </div>
        </div>

        <div class="no-print" style="display: flex; gap: 1rem; justify-content: center;">
            <button onclick="window.print()" class="btn-download">📥 Guardar / Descargar PDF</button>
            <a href="{{ route('paciente.dashboard') }}" class="btn-download" style="background: #536957;">Volver al Panel</a>
        </div>
    </div>

    <script>
        // Lanzar diálogo de impresión a PDF automáticamente al cargar
        window.onload = function() {
            setTimeout(() => { window.print(); }, 500);
        };
    </script>
</body>
</html>
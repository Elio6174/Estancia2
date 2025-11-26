<?php
function calcularEdad($fechaNacimiento) {
    if (!$fechaNacimiento) return null;
    $fechaNac = new DateTime($fechaNacimiento);
    $hoy = new DateTime();
    $edad = $hoy->diff($fechaNac)->y;
    return $edad;
}

function formatearFechaLarga($fecha) {
    if (!$fecha) return null;
    $meses = [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];

    $fechaObj = new DateTime($fecha);

    $dia = $fechaObj->format('d');
    $mes = $meses[intval($fechaObj->format('m')) - 1];
    $año = $fechaObj->format('Y');
    return "$dia de $mes, $año";
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>CliniHub - Expediente</title>
        <link href="data:image/x-icon;base64," rel="icon" type="image/x-icon"/>
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect"/>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script>
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            "primary": "#11b4d4",
                            "primary-subtle": "#e0f7fa",
                            "secondary": "#f472b6",
                            "success": "#34d399",
                            "warning": "#fbbf24",
                            "background-light": "#f6f8f8",
                            "background-dark": "#101f22",
                            "text-light": "#101f22",
                            "text-dark": "#f6f8f8",
                            "surface-light": "#ffffff",
                            "surface-dark": "#1a2c2f",
                            "border-light": "#e0e7e9",
                            "border-dark": "#2a3c3f"
                        },
                        fontFamily: {
                            "display": ["Inter", "sans-serif"]
                        },
                        borderRadius: {
                            "DEFAULT": "0rem",
                            "lg": "0rem",
                            "xl": "0rem", 
                            "full": "9999px"
                        }
                    }
                }
            }
        </script>
        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 20;
            }
            .window {
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            #mobile-menu-toggle:checked ~ #mobile-menu-overlay {
                display: block;
            }
            #mobile-menu-toggle:checked ~ #mobile-menu {
                transform: translateX(0);
            }
            #mobile-menu-toggle:checked ~ main {
                overflow: hidden;
                height: 100vh;
            }

            .paciente-activo {
                background-color: rgba(17, 180, 212, 0.1);
                border-left: 4px solid #11b4d4;
            }

            html.dark .paciente-activo {
                background-color: rgba(17, 180, 212, 0.2);
            }
        </style>
    </head>
    <body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div id="expediente" class="w-full max-w-7xl flex flex-col gap-6">
                <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <div>
                            <div class="flex items-center gap-2">
                                <a class="flex items-center gap-2 text-text-light/60 dark:text-text-dark/60 hover:text-primary dark:hover:text-primary" 
                                href="index.php?view=MisPacientes">
                                    <span class="material-symbols-outlined">arrow_back</span>
                                    <span>Volver a Mis Pacientes</span>
                                </a>
                            </div>
                            <h1 class="text-3xl font-bold">Expediente de <?php echo $data['nombre']?></h1>
                            <p class="text-text-light/60 dark:text-text-dark/60">ID Paciente: P<?php echo $data['id_paciente']?></p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full md:w-auto">
                        <button onclick="imprimirExpediente()" 
                                class="no-print flex items-center justify-center gap-2 h-10 px-4 bg-primary text-white rounded">
                            <span class="material-symbols-outlined">print</span>
                            <span>Imprimir Expediente</span>
                        </button>

                    </div>
                </header>

                <div class="max-w-4xl mx-auto w-full">
                    <div class="lg:col-span-2 flex flex-col gap-6">
                        <div class="window bg-surface-light dark:bg-surface-dark flex flex-col">
                            <div class="p-4 md:p-6 flex flex-col gap-6 overflow-y-auto">
                                <section>
                                    <h2 class="text-xl font-bold border-b border-border-light dark:border-border-dark pb-3 mb-4">
                                        Datos Personales
                                    </h2>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                        <div>
                                            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Nombre Completo</p>
                                            <p class="font-semibold"><?php echo $data['nombre']?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Fecha de Nacimiento</p>
                                            <p class="font-semibold"><?php echo formatearFechaLarga($data['fecha_nacimiento']).' ('.calcularEdad($data['fecha_nacimiento']).' años)'?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Género</p>
                                            <p class="font-semibold"><?php echo $data['sexo']?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Teléfono</p>
                                            <p class="font-semibold"><?php echo $data['telefono']?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Email</p>
                                            <p class="font-semibold"><?php echo $data['correo']?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Dirección</p>
                                            <p class="font-semibold"><?php echo $data['direccion']?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Tipo de Sangre</p>
                                            <p class="font-semibold"><?php echo $data['tipo_sangre']?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Alergias</p>
                                            <p class="font-semibold">Penicilina</p>
                                        </div>
                                    </div>
                                </section>
                                <section>
                                    <h2 class="text-xl font-bold border-b border-border-light dark:border-border-dark pb-3 mb-4">
                                        Historial Médico
                                    </h2>

                                    <div class="flex flex-col gap-4">
                                        <?php while($cita = $citas->fetch_assoc()):?>
                                        <div class="border border-border-light dark:border-border-dark p-4 rounded">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="font-bold"><?php echo $cita['especialidad']?></p>
                                                    <p class="text-sm text-text-light/60 dark:text-text-dark/60">
                                                        <?php echo $cita['doctor'].' - '.formatearFechaLarga($cita['fecha_cita'])?>
                                                    </p>
                                                </div>
                                                <span class="px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-200">
                                                    Consulta
                                                </span>
                                            </div>
                                            <div class="mt-3">
                                                <p><span class="font-semibold">Diagnóstico:</span> Infección respiratoria aguda.</p>
                                                <p><span class="font-semibold">Tratamiento:</span> Reposo, hidratación y Amoxicilina 500mg cada 8 horas.</p>
                                            </div>
                                        </div>
                                        <?php endwhile;?>

                                        <div class="border border-border-light dark:border-border-dark p-4 rounded">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="font-bold">Consulta de Seguimiento</p>
                                                    <p class="text-sm text-text-light/60 dark:text-text-dark/60">
                                                        Dr. Carlos Akle - 25 de Marzo, 2023
                                                    </p>
                                                </div>
                                                <span class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-200">
                                                    Seguimiento
                                                </span>
                                            </div>
                                            <div class="mt-3">
                                                <p><span class="font-semibold">Diagnóstico:</span> Hipertensión arterial controlada.</p>
                                                <p><span class="font-semibold">Tratamiento:</span> Continuar Losartán 50mg diario.</p>
                                            </div>
                                        </div>

                                        <div class="border border-border-light dark:border-border-dark p-4 rounded">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="font-bold">Examen Anual</p>
                                                    <p class="text-sm text-text-light/60 dark:text-text-dark/60">
                                                        Dra. Ana López - 10 de Enero, 2023
                                                    </p>
                                                </div>
                                                <span class="px-2 py-1 text-xs font-medium text-purple-700 bg-purple-100 rounded-full dark:bg-purple-900 dark:text-purple-200">
                                                    Examen
                                                </span>
                                            </div>
                                            <div class="mt-3">
                                                <p><span class="font-semibold">Diagnóstico:</span> Paciente saludable, sin hallazgos relevantes.</p>
                                                <p><span class="font-semibold">Tratamiento:</span> Recomendaciones de dieta y ejercicio.</p>
                                            </div>
                                        </div>

                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
function imprimirExpediente() {
    const contenido = document.getElementById("expediente").innerHTML;
    let estilos = "";
    document.querySelectorAll("style, link[rel='stylesheet']").forEach((nodo) => {
        estilos += nodo.outerHTML;
    });

    const ventana = window.open("", "PRINT", "height=800,width=1000");

    ventana.document.write(`
        <html>
        <head>
            <title>Expediente Médico</title>
            ${estilos}

            <style>
                /* ===== A4 ===== */
                @page {
                    size: A4;
                    margin: 20mm;
                }

                /* Evitar enlaces mostrando la URL */
                a[href]:after {
                    content: "";
                }

                /* No mostrar el botón en impresión */
                .no-print {
                    display: none !important;
                }

                /* Mantener colores EXACTOS en impresión */
                * {
                    -webkit-print-color-adjust: exact !important;
                    print-color-adjust: exact !important;
                }

                body {
                    background: white !important;
                    padding: 10px;
                    font-family: 'Inter', sans-serif;
                }
            </style>
        </head>

        <body>
            ${contenido}
        </body>
        </html>
    `);

    ventana.document.close();
    ventana.focus();

    setTimeout(() => {
        ventana.print();
        ventana.close();
    }, 500);
}
</script>
<script>
function imprimirExpediente() {
    const contenido = document.getElementById("expediente").innerHTML;
    let estilos = "";
    document.querySelectorAll("style, link[rel='stylesheet']").forEach((nodo) => {
        estilos += nodo.outerHTML;
    });

    const ventana = window.open("", "PRINT", "height=800,width=1000");

    ventana.document.write(`
        <html>
        <head>
            <title>Expediente Médico</title>
            ${estilos}

            <style>
                /* ===== A4 ===== */
                @page {
                    size: A4;
                    margin: 20mm;
                }

                /* Evitar enlaces mostrando la URL */
                a[href]:after {
                    content: "";
                }

                /* No mostrar el botón en impresión */
                .no-print {
                    display: none !important;
                }

                /* Mantener colores EXACTOS en impresión */
                * {
                    -webkit-print-color-adjust: exact !important;
                    print-color-adjust: exact !important;
                }

                body {
                    background: white !important;
                    padding: 10px;
                    font-family: 'Inter', sans-serif;
                }
            </style>
        </head>

        <body>
            ${contenido}
        </body>
        </html>
    `);
    ventana.document.close();
    ventana.focus();

    setTimeout(() => {
        ventana.print();
        ventana.close();
    }, 500);
}
</script>


</html>
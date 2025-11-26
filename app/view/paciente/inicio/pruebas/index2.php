<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Stitch Design</title>
    <link href="data:image/x-icon;base64," rel="icon" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
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
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
    <div class="flex min-h-screen">
        <!-- Barra lateral fija -->
        <aside class="w-64 bg-[#0d1b2a] text-white p-4 flex flex-col justify-between fixed h-screen">
            <div>
                <div class="flex items-center gap-4 mb-8 px-2">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCUexV-rdlrinY8S-2_Xg9qTQX7s2Pn7Y3IY31a85C4QHz5xlH4aiRSyEu4D5TWt6l6OzLbLMSay0mcwXFtGTaX38-ZYK_hZmkio-UCMKHOhSaDqZYKYuAmbDqAobEZTlw1Ykco_kF45fFUUS59f7_-dZD3eu5QKO8HNTU4h0Bh5oVBR7NBZVxiiHifAHlWds6hC4Kwipkwx3rFp9uIBcQ_rh9rn333TUybgbWvwhHyxflsh1JzpMFB471rN0JSI6F2mgkFVbnqhpMS");'>
                    </div>
                    <div>
                        <p class="text-sm text-text-dark/70">Hola,</p>
			<h1 class="text-lg font-bold"><?php echo $data['nombre']?></h1>
                    </div>
                </div>

                <nav class="flex flex-col gap-2">
                    <a class="flex items-center gap-3 px-4 py-3 bg-primary/20 text-primary font-bold rounded-lg" href="#">
                        <span class="material-symbols-outlined">home</span>
                        <span>Inicio</span>
                    </a>
		    <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg"
		    <?php echo 'href="index.php?view=MiPerfil&idUser='. $id .'"'?>>
                        <span class="material-symbols-outlined">person</span>
                        <span>Mi Perfil</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg"
			<?php echo 'href="index.php?view=AgendarCita&idUser='.$id.'"'?>>
                        <span class="material-symbols-outlined">calendar_month</span>
                        <span>Agendar Cita</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg"
			<?php echo 'href="index.php?view=MisCitas&idUser='.$id.'"'?>>
                        <span class="material-symbols-outlined">list_alt</span>
                        <span>Mis Citas</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg"
			<?php echo 'href="index.php?view=Notificaciones&idUser='.$id.'"'?>>
                        <span class="material-symbols-outlined">notifications</span>
                        <span>Notificaciones</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg"
			<?php echo 'href="index.php?view=Mensajes&idUser='.$id.'"'?>>
                        <span class="material-symbols-outlined">chat</span>
                        <span>Mensajes</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg"
                        href="/estancia/vista/paciente/FAQ">
                        <span class="material-symbols-outlined">quiz</span>
                        <span>FAQ</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg"
                        href="/estancia/vista/paciente/RecetasActivas">
                        <span class="material-symbols-outlined">receipt_long</span>
                        <span>Recetas Activas</span>
                    </a>
                </nav>
            </div>

            <div>
                <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" href="#">
                    <span class="material-symbols-outlined">folder_open</span>
                    <span>Resultados/Documentos</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 mt-2 hover:bg-red-500/10 text-red-500 rounded-lg" href="#">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Cerrar Sesión</span>
                </a>
            </div>
        </aside>

        <!-- Contenido desplazable -->
        <main class="flex-1 p-8 ml-64 overflow-y-auto">
            <div class="max-w-6xl mx-auto">
                <header class="mb-8">
                    <h2 class="text-4xl font-bold text-text-light dark:text-text-dark">Panel del Paciente</h2>
                </header>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <!-- Próxima Cita -->
                        <section class="mb-8">
                            <h3 class="text-xl font-bold mb-4 text-text-light dark:text-text-dark">Próxima Cita</h3>
                            <div class="bg-surface-light dark:bg-surface-dark p-6 flex items-center justify-between shadow-sm rounded-lg border-l-4 border-primary">
                                <div class="flex items-center gap-6">
                                    <div class="bg-primary-subtle dark:bg-primary/20 p-4 rounded-full">
                                        <span class="material-symbols-outlined text-primary !text-4xl">vaccines</span>
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-text-light dark:text-text-dark">Consulta General</p>
                                        <p class="text-text-light/70 dark:text-text-dark/70">Dr. Carlos Mendoza</p>
                                        <p class="text-text-light/70 dark:text-text-dark/70">15 de Julio, 2024 | 10:00 AM</p>
                                    </div>
                                </div>
                                <a class="bg-primary text-white font-bold py-3 px-6 hover:opacity-90 transition-opacity rounded-lg"
                                    href="#">Ver Detalles</a>
                            </div>
                        </section>

                        <!-- Acceso Rápido -->
                        <section class="mb-8">
                            <h3 class="text-xl font-bold mb-4 text-text-light dark:text-text-dark">Acceso Rápido</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <a class="bg-surface-light dark:bg-surface-dark p-6 flex flex-col items-center justify-center text-center hover:shadow-lg transition-shadow border border-border-light dark:border-border-dark rounded-lg"
				   href="index.php?view=MiPerfil">
                                    <div class="bg-primary-subtle dark:bg-primary/20 p-4 rounded-full mb-4">
                                        <span class="material-symbols-outlined text-primary !text-3xl">person</span>
                                    </div>
                                    <h4 class="text-lg font-bold text-text-light dark:text-text-dark">Mi Perfil</h4>
                                    <p class="text-sm text-text-light/60 dark:text-text-dark/60">Ver y editar datos</p>
                                </a>

                                <a class="bg-surface-light dark:bg-surface-dark p-6 flex flex-col items-center justify-center text-center hover:shadow-lg transition-shadow border border-border-light dark:border-border-dark rounded-lg"
                                    href="index.php?view=AgendarCita">
                                    <div class="bg-primary-subtle dark:bg-primary/20 p-4 rounded-full mb-4">
                                        <span class="material-symbols-outlined text-primary !text-3xl">calendar_add_on</span>
                                    </div>
                                    <h4 class="text-lg font-bold text-text-light dark:text-text-dark">Agendar Cita</h4>
                                    <p class="text-sm text-text-light/60 dark:text-text-dark/60">Busca especialistas</p>
                                </a>

                                <a class="bg-surface-light dark:bg-surface-dark p-6 flex flex-col items-center justify-center text-center hover:shadow-lg transition-shadow border border-border-light dark:border-border-dark rounded-lg"
                                    href="index.php?view=MisCitas">
                                    <div class="bg-primary-subtle dark:bg-primary/20 p-4 rounded-full mb-4">
                                        <span class="material-symbols-outlined text-primary !text-3xl">history</span>
                                    </div>
                                    <h4 class="text-lg font-bold text-text-light dark:text-text-dark">Mis Citas</h4>
                                    <p class="text-sm text-text-light/60 dark:text-text-dark/60">Historial y próximas</p>
                                </a>
                            </div>
                        </section>

                        <!-- Recetas Activas -->
                        <section>
                            <h3 class="text-xl font-bold mb-4 text-text-light dark:text-text-dark">Recetas Activas</h3>
                            <div class="bg-surface-light dark:bg-surface-dark p-6 shadow-sm rounded-lg">
                                <div class="flex items-center justify-between border-b border-border-light dark:border-border-dark pb-3 mb-3">
                                    <div>
                                        <p class="font-bold text-text-light dark:text-text-dark">Paracetamol 500mg</p>
                                        <p class="text-sm text-text-light/60 dark:text-text-dark/60">1 tableta cada 8 horas</p>
                                    </div>
                                    <a class="text-primary hover:underline text-sm font-semibold" href="#">Ver detalles</a>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-bold text-text-light dark:text-text-dark">Loratadina 10mg</p>
                                        <p class="text-sm text-text-light/60 dark:text-text-dark/60">1 tableta al día</p>
                                    </div>
                                    <a class="text-primary hover:underline text-sm font-semibold" href="#">Ver detalles</a>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Columna derecha -->
                    <div class="space-y-8">
                        <!-- Notificaciones -->
                        <section>
                            <h3 class="text-xl font-bold mb-4 text-text-light dark:text-text-dark">Notificaciones/Alertas</h3>
                            <div class="bg-surface-light dark:bg-surface-dark p-6 shadow-sm space-y-4 rounded-lg">
                                <div class="flex items-start gap-4">
                                    <span class="material-symbols-outlined text-success mt-1">task_alt</span>
                                    <div>
                                        <p class="font-bold text-text-light dark:text-text-dark">Resultados de laboratorio listos</p>
                                        <p class="text-sm text-text-light/60 dark:text-text-dark/60">Hace 2 horas</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <span class="material-symbols-outlined text-warning mt-1">calendar_month</span>
                                    <div>
                                        <p class="font-bold text-text-light dark:text-text-dark">Recordatorio de cita</p>
                                        <p class="text-sm text-text-light/60 dark:text-text-dark/60">Mañana a las 10:00 AM</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Mensajes -->
                        <section>
                            <h3 class="text-xl font-bold mb-4 text-text-light dark:text-text-dark">Mensajes con el Doctor</h3>
                            <a class="block bg-surface-light dark:bg-surface-dark p-6 shadow-sm hover:shadow-lg transition-shadow rounded-lg"
                                href="#">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <span class="material-symbols-outlined text-primary !text-3xl">chat</span>
                                            <span
                                                class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-secondary ring-2 ring-surface-light dark:ring-surface-dark">
                                            </span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-text-light dark:text-text-dark">Dr. Carlos Mendoza</p>
                                            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Último mensaje: "Todo bien..."</p>
                                        </div>
                                    </div>
                                    <span class="material-symbols-outlined text-text-light/60 dark:text-text-dark/60">arrow_forward_ios</span>
                                </div>
                            </a>
                        </section>

                        <!-- FAQ -->
                        <section>
                            <h3 class="text-xl font-bold mb-4 text-text-light dark:text-text-dark">Preguntas Frecuentes (FAQ)</h3>
                            <div class="bg-surface-light dark:bg-surface-dark p-6 shadow-sm rounded-lg">
                                <a class="flex items-center justify-between py-2 text-text-light dark:text-text-dark hover:text-primary"
                                    href="#">
                                    <span>¿Cómo agendar una cita?</span>
                                    <span class="material-symbols-outlined">chevron_right</span>
                                </a>
                                <a class="flex items-center justify-between py-2 text-text-light dark:text-text-dark hover:text-primary"
                                    href="#">
                                    <span>¿Dónde veo mis resultados?</span>
                                    <span class="material-symbols-outlined">chevron_right</span>
                                </a>
                                <a class="flex items-center justify-between py-2 text-text-light dark:text-text-dark hover:text-primary"
                                    href="#">
                                    <span>Contacto y emergencias</span>
                                    <span class="material-symbols-outlined">chevron_right</span>
                                </a>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>


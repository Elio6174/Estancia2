<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>CliniHub - Mis Citas</title>
        <link href="data:image/x-icon;base64," rel="icon" type="image/x-icon" />
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet" />
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
            html.sidebar-open {
                overflow: hidden;
            }
        </style>
    </head>
    <body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
        <div class="flex min-h-screen">
            <div id="sidebar-container">
                <div id="overlay" class="fixed inset-0 z-30 bg-black/50 opacity-0 lg:hidden transition-opacity duration-300 ease-in-out pointer-events-none"></div>
                <aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-[#0d1b2a] text-white p-4 flex flex-col justify-between transform -translate-x-full transition-transform duration-300 ease-in-out z-40 lg:translate-x-0">
                    <div>
                        <div class="flex items-center justify-between gap-4 mb-8 px-2">
                            <div class="flex items-center gap-4">
                                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12" 
                                    style='background-image: url("<?php echo htmlspecialchars($_SESSION['foto_url'] ?? "http://localhost/estancia/vista/uploads/usuarios/12225881.png"); ?>");'>
                                </div>
                                <div>
                                    <p class="text-sm text-text-dark/70">Hola,</p>
                                    <h1 class="text-lg font-bold"><?php echo $_SESSION['user_name']?></h1>
                                </div>
                            </div>
                            <button id="close-btn" class="lg:hidden text-text-dark/70 hover:text-white">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        <nav class="flex flex-col gap-2">
                            <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg"
                            href="index.php?view=Inicio">
                                <span class="material-symbols-outlined">home</span>
                                <span>Inicio</span>
                            </a>
                            <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg"
                            href="index.php?view=MiPerfil">
                                <span class="material-symbols-outlined">person</span>
                                <span>Mi Perfil</span>
                            </a>
                            <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg"
                            href="index.php?view=AgendarCita">
                                <span class="material-symbols-outlined">calendar_month</span>
                                <span>Agendar Cita</span>
                            </a>
                            <a class="flex items-center gap-3 px-4 py-3 bg-primary/20 text-primary font-bold rounded-lg"
                            href="index.php?view=MisCitas">
                                <span class="material-symbols-outlined">list_alt</span>
                                <span>Mis Citas</span>
                            </a>
                        </nav>
                    </div>
                    <div>
                        <a class="flex items-center gap-3 px-4 py-3 mt-2 hover:bg-red-500/10 text-red-500 rounded-lg"
                        href="index.php?action=logout">
                            <span class="material-symbols-outlined">logout</span>
                            <span>Cerrar Sesión</span>
                        </a>
                    </div>
                </aside>
            </div>
            <main id="content-area" class="flex-1 lg:ml-64 p-4 sm:p-8">
                <div class="max-w-6xl mx-auto">
                    <header class="mb-8">
                        <div class="flex items-center gap-4">
                            <button id="hamburger-btn" class="p-2 lg:hidden">
                                <span class="material-symbols-outlined">menu</span>
                            </button>
                            <h2 class="text-3xl lg:text-4xl font-bold text-text-light dark:text-text-dark">Mis Citas</h2>
                        </div>
                    </header>
                    <div class="space-y-12">
                        <section>
                            <h3 class="text-xl lg:text-2xl font-bold mb-6 text-text-light dark:text-text-dark">Próximas Citas</h3>
                            <div class="space-y-6">
                                <?php if (!empty($citas)): ?>
                                    <?php foreach ($citas as $cita): ?>
                                    <div class="bg-surface-light dark:bg-surface-dark p-4 sm:p-6 shadow-sm rounded-lg border-l-4 border-primary">
                                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                            <div class="flex items-center gap-4 sm:gap-6">
                                                <div class="text-center w-16 sm:w-20">
                                                    <p class="text-3xl sm:text-4xl font-bold text-primary"><?php echo $cita['dia_cita']?></p>
                                                    <p class="text-xs sm:text-sm uppercase text-text-light/70 dark:text-text-dark/70"><?php echo $cita['mes_cita']?></p>
                                                </div>
                                                <div>
                                                    <p class="text-base sm:text-lg font-bold text-text-light dark:text-text-dark"><?php echo $cita['especialidad']?></p>
                                                    <p class="text-sm text-text-light/70 dark:text-text-dark/70"><?php echo $cita['nombre_doctor']?></p>
                                                    <p class="text-sm text-text-light/70 dark:text-text-dark/70"><?php echo $cita['hora_cita']?></p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2 sm:gap-4 w-full sm:w-auto mt-4 sm:mt-0">
                                                <a <?php echo 'href="index.php?action=cancelarCita&idCita='.$cita['id_cita'].'"'?>>
                                                    <button class="flex-1 sm:flex-none min-w-[150px] bg-red-500/10 text-red-500 font-bold py-2 px-6 hover:bg-red-500/20 transition-colors rounded-lg text-sm">
                                                        Cancelar Cita
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                   <div class="bg-surface-light dark:bg-surface-dark p-8 sm:p-10 shadow-md rounded-2xl border border-border-light dark:border-border-dark text-center transition-all duration-300">
                                        <div class="flex flex-col items-center justify-center space-y-4">
                                            <span class="material-symbols-outlined text-5xl text-primary">event_note</span>
                                            <h2 class="text-xl sm:text-2xl font-bold text-text-light dark:text-text-dark">
                                                Aún no tienes citas registradas
                                            </h2>
                                            <p class="text-sm sm:text-base text-text-light/70 dark:text-text-dark/70">
                                                Agenda tu primera cita para comenzar.
                                            </p>
                                            <a href="#" class="mt-3 inline-flex items-center gap-2 bg-primary/10 hover:bg-primary/20 text-primary font-semibold py-2 px-4 rounded-lg transition-colors">
                                                <span class="material-symbols-outlined text-base">add_circle</span>
                                                Agendar cita
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </section>

                        <section>
                            <h3 class="text-xl lg:text-2xl font-bold mb-6 text-text-light dark:text-text-dark">Citas Pasadas</h3>
                            <div class="space-y-6">
                                <?php if (!empty($citasFinalizadas)): ?>
                                    <?php foreach ($citasFinalizadas as $citasF): ?>
                                <div class="bg-surface-light/70 dark:bg-surface-dark/70 p-4 sm:p-6 shadow-sm rounded-lg border-l-4 border-gray-400">
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                        <div class="flex items-center gap-4 sm:gap-6">
                                            <div class="text-center w-16 sm:w-20">
                                                <p class="text-3xl sm:text-4xl font-bold text-gray-500"><?php echo $citasF['dia_cita']?></p>
                                                <p class="text-xs sm:text-sm uppercase text-text-light/60 dark:text-text-dark/60"><?php echo $citasF['mes_cita']?></p>
                                            </div>
                                            <div>
                                                <p class="text-base sm:text-lg font-bold text-text-light/80 dark:text-text-dark/80"><?php echo $citasF['especialidad']?></p>
                                                <p class="text-sm text-text-light/60 dark:text-text-dark/60"><?php echo $citasF['nombre_doctor']?></p>
                                                <p class="text-sm text-text-light/60 dark:text-text-dark/60"><?php echo $citasF['hora_cita']?></p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 sm:gap-4 w-full sm:w-auto mt-4 sm:mt-0">
                                            <a href="#" class="flex-1 text-center text-sm font-semibold text-primary hover:underline">Ver Resumen</a>
                                        </div>
                                    </div>
                                </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="bg-surface-light dark:bg-surface-dark p-8 sm:p-10 shadow-md rounded-2xl border border-border-light dark:border-border-dark text-center transition-all duration-300">
                                        <div class="flex flex-col items-center justify-center space-y-4">
                                            <span class="material-symbols-outlined text-5xl text-primary">event_busy</span>
                                            <h2 class="text-xl sm:text-2xl font-bold text-text-light dark:text-text-dark">
                                                No tienes citas finalizadas
                                            </h2>
                                            <p class="text-sm sm:text-base text-text-light/70 dark:text-text-dark/70">
                                                Aquí aparecerán tus citas completadas.
                                            </p>
                                            <a href="#" class="mt-3 inline-flex items-center gap-2 bg-primary/10 hover:bg-primary/20 text-primary font-semibold py-2 px-4 rounded-lg transition-colors">
                                                <span class="material-symbols-outlined text-base">calendar_month</span>
                                                Agendar nueva cita
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </section>
                    </div>
                </div>
            </main>
        </div>

        <script>
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const hamburgerBtn = document.getElementById('hamburger-btn');
            const closeBtn = document.getElementById('close-btn');
            const htmlEl = document.documentElement;

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                overlay.classList.add('opacity-100', 'pointer-events-auto');
                htmlEl.classList.add('sidebar-open');
            }

            function closeSidebar() {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.remove('opacity-100', 'pointer-events-auto');
                overlay.classList.add('opacity-0', 'pointer-events-none');
                htmlEl.classList.remove('sidebar-open');
            }

            hamburgerBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                openSidebar();
            });

            closeBtn.addEventListener('click', () => {
                closeSidebar();
            });

            overlay.addEventListener('click', () => {
                closeSidebar();
            });
        </script>
    </body>
</html>

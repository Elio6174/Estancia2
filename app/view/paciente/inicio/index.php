<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>CliniHub - Inicio</title>
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
      [x-cloak] {
        display: none !important;
      }
      .no-scrollbar::-webkit-scrollbar {
        display: none;
      }
      .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>

    <body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark" x-data="{ sidebarOpen: false, notificationsOpen: false }" :class="{ 'overflow-hidden': sidebarOpen }">
        <?php
            session_start();
        ?>
        <div class="relative min-h-screen">
            <aside
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                class="fixed top-0 left-0 z-40 w-64 bg-[#0d1b2a] text-white p-4 flex flex-col justify-between transform transition-transform duration-300 ease-in-out overflow-y-auto no-scrollbar lg:translate-x-0"
                style="height: 100dvh; will-change: transform;"
            >
            <div>
                <div class="flex items-center gap-4 mb-8 px-2">
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12"
                    style='background-image: url("<?php echo htmlspecialchars($_SESSION['foto_url'] ?? "http://else.mx/uploads/usuarios/12225881.png"); ?>");'>
                </div>
                <div>
                    <p class="text-sm text-text-dark/70">Hola,</p>
                    <h1 class="text-lg font-bold"><?php echo $_SESSION['user_name']?></h1>
                </div>
                </div>
                <nav class="flex flex-col gap-2">
                    <a class="flex items-center gap-3 px-4 py-3 bg-primary/20 text-primary font-bold rounded-lg" 
                    href="#">
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
                    <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" 
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
            <div
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-black/50 z-30 lg:hidden"
            x-cloak
            x-show="sidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            ></div>
            <main class="flex-1 p-4 sm:p-6 lg:p-8 lg:ml-64 overflow-y-auto">
                    <div class="max-w-6xl mx-auto">
                    <header class="mb-8 flex items-center gap-4 justify-between" x-data="{ notificationsOpen: false }">
                    <div class="flex items-center gap-4">
                        <button 
                        @click="sidebarOpen = !sidebarOpen" 
                        class="lg:hidden text-text-light dark:text-text-dark"
                        >
                        <span class="material-symbols-outlined">menu</span>
                        </button>
                        <h2 class="text-3xl md:text-4xl font-bold text-text-light dark:text-text-dark">Inicio</h2>
                    </div>
                    <div class="relative" x-data="{ open: false }">
                        <button 
                        @click="open = !open" 
                        class="relative p-2 rounded-full hover:bg-primary/10 transition"
                        aria-label="Ver notificaciones"
                        >
                        <span class="material-symbols-outlined text-text-light dark:text-text-dark !text-3xl">notifications</span>
                        <?php if ($data['datos_completos'] === 0): ?>
                        <span class="absolute top-2 right-2 block h-2.5 w-2.5 rounded-full bg-secondary ring-2 ring-background-light dark:ring-background-dark"></span>
                        <?php endif; ?>
                        </button>
                        <div
                        x-show="open"
                        @click.outside="open = false"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute right-0 mt-3 w-80 bg-surface-light dark:bg-surface-dark rounded-lg shadow-lg border border-border-light dark:border-border-dark z-50"
                        >
                        <div class="p-4 border-b border-border-light dark:border-border-dark flex justify-between items-center">
                            <h4 class="font-bold">Notificaciones</h4>
                            <button 
                            @click="open = false" 
                            class="text-text-light/70 dark:text-text-dark/70 hover:text-text-light dark:hover:text-text-dark"
                            >
                            <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        <div class="p-4 space-y-4 max-h-80 overflow-y-auto">
                            <?php if ($data['datos_completos'] === 0): ?>
                                <a 
                                    href="index.php?view=MiPerfil"
                                    class="flex items-start gap-4 hover:bg-primary/5 rounded-md p-2 transition cursor-pointer"
                                >
                                    <span class="material-symbols-outlined text-warning self-center">settings</span>
                                    <div>
                                        <p class="font-bold text-text-light dark:text-text-dark text-sm">
                                            Completa la configuración de tu cuenta
                                        </p>
                                        <p class="text-xs text-text-light/60 dark:text-text-dark/60">
                                            Hace unos minutos
                                        </p>
                                    </div>
                                </a>
                            <?php endif; ?>
                            <div class="flex items-start gap-4 p-2">
                            <span class="material-symbols-outlined text-success self-center">task_alt</span>
                            <div>
                                <p class="font-bold text-text-light dark:text-text-dark text-sm">Resultados de laboratorio listos</p>
                                <p class="text-xs text-text-light/60 dark:text-text-dark/60">Hace 2 horas</p>
                            </div>
                            </div>
                            <div class="flex items-start gap-4 p-2">
                            <span class="material-symbols-outlined text-warning self-center">calendar_month</span>
                            <div>
                                <p class="font-bold text-text-light dark:text-text-dark text-sm">Recordatorio de cita</p>
                                <p class="text-xs text-text-light/60 dark:text-text-dark/60">Mañana a las 10:00 AM</p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </header>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <section class="mb-8">
                        <h3 class="text-xl font-bold mb-4 text-text-light dark:text-text-dark">Próxima Cita</h3>
                        <?php if (!empty($cita)): ?>
                        <div class="bg-surface-light dark:bg-surface-dark p-4 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between shadow-sm rounded-lg border-l-4 border-primary gap-4">
                            <div class="flex items-center gap-4 sm:gap-6">
                            <div class="bg-primary-subtle dark:bg-primary/20 p-4 rounded-full">
                                <span class="material-symbols-outlined text-primary !text-3xl sm:!text-4xl">vaccines</span>
                            </div>
                            <div>
                                <p class="text-lg font-bold text-text-light dark:text-text-dark"><?php echo $cita['especialidad']?></p>
                                <p class="text-sm sm:text-base text-text-light/70 dark:text-text-dark/70"><?php echo $cita['nombre_doctor']?></p>
                                <p class="text-sm sm:text-base text-text-light/70 dark:text-text-dark/70"><?php echo $cita['dia_cita'].' de '.$cita['mes_cita'].' | '.$cita['hora_cita']?></p>
                            </div>
                            </div>
                            <a
                            class="bg-primary text-white font-bold py-2 px-4 sm:py-3 sm:px-6 hover:opacity-90 transition-opacity rounded-lg w-full sm:w-auto text-center"
                            href="#"
                            >Ver Detalles</a>
                        </div>
                        <?php else: ?>
                        <div class="bg-surface-light dark:bg-surface-dark p-4 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between shadow-sm rounded-lg border-l-4 border-primary gap-4">
                            <div class="flex flex-col">
                                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Aún no tienes citas para hoy</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Programa tu primera cita médica para comenzar.</p>
                            </div>
                            <a href="#" class="mt-3 inline-flex items-center gap-2 bg-primary/10 hover:bg-primary/20 text-primary font-semibold py-2 px-4 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-base">add_circle</span>Agendar cita
                            </a>
                        </div>
                        <?php endif; ?>
                        </section>
                       <section class="mb-8">
                        <h3 class="text-xl font-bold mb-4 text-text-light dark:text-text-dark">Acceso Rápido</h3>

                        <div class="flex space-x-4 overflow-x-auto pb-4 no-scrollbar sm:grid sm:grid-cols-2 lg:grid-cols-3 sm:gap-6 sm:space-x-0 sm:pb-0">

                            <a
                            class="flex-shrink-0 w-40 sm:w-auto bg-surface-light dark:bg-surface-dark p-6 flex flex-col items-center justify-center text-center 
                                    border border-border-light dark:border-border-dark rounded-lg 
                                    transition-all duration-300 ease-in-out 
                                    hover:shadow-lg hover:-translate-y-1
                                    focus:outline-none focus:ring-0 focus-visible:ring-0"
                            href="index.php?view=MiPerfil"
                            >
                            <div class="bg-primary-subtle dark:bg-primary/20 p-4 rounded-full mb-4 transition-transform duration-300 group-hover:scale-110">
                                <span class="material-symbols-outlined text-primary !text-3xl">person</span>
                            </div>
                            <h4 class="text-base sm:text-lg font-bold text-text-light dark:text-text-dark">Mi Perfil</h4>
                            <p class="text-xs sm:text-sm text-text-light/60 dark:text-text-dark/60 mt-1">Ver y editar datos</p>
                            </a>

                            <a
                            class="flex-shrink-0 w-40 sm:w-auto bg-surface-light dark:bg-surface-dark p-6 flex flex-col items-center justify-center text-center 
                                    border border-border-light dark:border-border-dark rounded-lg 
                                    transition-all duration-300 ease-in-out 
                                    hover:shadow-lg hover:-translate-y-1
                                    focus:outline-none focus:ring-0 focus-visible:ring-0"
                            href="index.php?view=AgendarCita"
                            >
                            <div class="bg-primary-subtle dark:bg-primary/20 p-4 rounded-full mb-4 transition-transform duration-300 group-hover:scale-110">
                                <span class="material-symbols-outlined text-primary !text-3xl">calendar_add_on</span>
                            </div>
                            <h4 class="text-base sm:text-lg font-bold text-text-light dark:text-text-dark">Agendar Cita</h4>
                            <p class="text-xs sm:text-sm text-text-light/60 dark:text-text-dark/60 mt-1">Busca especialistas</p>
                            </a>

                            <a
                            class="flex-shrink-0 w-40 sm:w-auto bg-surface-light dark:bg-surface-dark p-6 flex flex-col items-center justify-center text-center 
                                    border border-border-light dark:border-border-dark rounded-lg 
                                    transition-all duration-300 ease-in-out 
                                    hover:shadow-lg hover:-translate-y-1
                                    focus:outline-none focus:ring-0 focus-visible:ring-0"
                            href="index.php?view=MisCitas"
                            >
                            <div class="bg-primary-subtle dark:bg-primary/20 p-4 rounded-full mb-4 transition-transform duration-300 group-hover:scale-110">
                                <span class="material-symbols-outlined text-primary !text-3xl">history</span>
                            </div>
                            <h4 class="text-base sm:text-lg font-bold text-text-light dark:text-text-dark">Mis Citas</h4>
                            <p class="text-xs sm:text-sm text-text-light/60 dark:text-text-dark/60 mt-1">Historial y próximas</p>
                            </a>

                        </div>
                        </section>



                        <section>
                        <h3 class="text-xl font-bold mb-4 text-text-light dark:text-text-dark">Recetas Activas</h3>
                        <div class="bg-surface-light dark:bg-surface-dark p-6 shadow-sm rounded-lg">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border-b border-border-light dark:border-border-dark pb-3 mb-3 gap-2">
                            <div>
                                <p class="font-bold text-text-light dark:text-text-dark">Paracetamol 500mg</p>
                                <p class="text-sm text-text-light/60 dark:text-text-dark/60">1 tableta cada 8 horas</p>
                            </div>
                            <a class="text-primary hover:underline text-sm font-semibold self-start sm:self-center" href="#">Ver detalles</a>
                            </div>

                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                            <div>
                                <p class="font-bold text-text-light dark:text-text-dark">Loratadina 10mg</p>
                                <p class="text-sm text-text-light/60 dark:text-text-dark/60">1 tableta al día</p>
                            </div>
                            <a class="text-primary hover:underline text-sm font-semibold self-start sm:self-center" href="#">Ver detalles</a>
                            </div>
                        </div>
                        </section>
                    </div>

                    <div class="space-y-8">


                        <section>
                        <h3 class="text-xl font-bold mb-4 text-text-light dark:text-text-dark">Mensajes con el Doctor</h3>
                        <a class="block bg-surface-light dark:bg-surface-dark p-6 shadow-sm hover:shadow-lg transition-shadow rounded-lg" href="#">
                            <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                <span class="material-symbols-outlined text-primary !text-3xl">chat</span>
                                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-secondary ring-2 ring-surface-light dark:ring-surface-dark"></span>
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

                        <section>
                        <h3 class="text-xl font-bold mb-4 text-text-light dark:text-text-dark">Preguntas Frecuentes (FAQ)</h3>
                        <div class="bg-surface-light dark:bg-surface-dark p-6 shadow-sm rounded-lg">
                            <a class="flex items-center justify-between py-2 text-text-light dark:text-text-dark hover:text-primary" href="#">
                            <span>¿Cómo agendar una cita?</span>
                            <span class="material-symbols-outlined">chevron_right</span>
                            </a>
                            <a class="flex items-center justify-between py-2 text-text-light dark:text-text-dark hover:text-primary" href="#">
                            <span>¿Dónde veo mis resultados?</span>
                            <span class="material-symbols-outlined">chevron_right</span>
                            </a>
                            <a class="flex items-center justify-between py-2 text-text-light dark:text-text-dark hover:text-primary" href="#">
                            <span>Contacto y emergencias</span>
                            <span class="material-symbols-outlined">chevron_right</span>
                            </a>
                        </div>
                        </section>
                    </div>
                    </div>
                </div>
            </main>
            <?php if ($data['datos_completos'] === 0): ?>
            <div 
                x-data="{ visible: false }"
                x-init="setTimeout(() => visible = true, 100); setTimeout(() => visible = false, 6000)" 
                x-show="visible"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-5 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-5 scale-95"
                class="fixed bottom-6 right-6 bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark 
                    shadow-lg rounded-xl p-4 flex items-start gap-4 w-80 z-50"
                x-cloak
            >
                <span class="material-symbols-outlined text-warning self-center text-3xl animate-pulse">notifications_active</span>

                <div class="flex-1">
                <p class="font-bold text-text-light dark:text-text-dark text-sm">
                    Completa la configuración de tu cuenta
                </p>
                <p class="text-xs text-text-light/60 dark:text-text-dark/60">Haz clic para continuar</p>
                <a 
                    href="index.php?view=MiPerfil"
                    class="inline-block mt-2 text-primary font-semibold text-sm hover:underline"
                >
                    Ir a mi perfil →
                </a>
                </div>

                <button 
                @click="visible = false" 
                class="text-text-light/50 dark:text-text-dark/50 hover:text-text-light dark:hover:text-text-dark transition"
                >
                <span class="material-symbols-outlined text-base">close</span>
                </button>
            </div>
            <?php endif; ?>
        </div>
    </body>
</html>

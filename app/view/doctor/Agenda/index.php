<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>CliniHub - Mi Agenda</title>
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
                        },
                    },
                },
            }
        </script>
        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 20;
            }
            .window {
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            .calendar-grid {
                grid-template-columns: repeat(7, minmax(0, 1fr));
            }
            .calendar-day {
                height: 120px;
            }
            .time-slot {
                height: 60px;
            }
            @media (max-width: 1023px) {
                #sidebar-menu {
                    transform: translateX(-100%);
                    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                }
                #sidebar-menu:target {
                    transform: translateX(0);
                }
                #sidebar-menu:target ~ main #sidebar-overlay {
                    opacity: 1;
                    pointer-events: auto;
                }
                body:has(#sidebar-menu:target) {
                    overflow: hidden;
                }
            }
            a[href="#sidebar-menu"]:active {
                transform: scale(0.95);
                transition: transform 0.1s ease-in-out;
            }

            @keyframes slideUp {
                from { transform: translateY(40px); opacity: 0; }
                to   { transform: translateY(0); opacity: 1; }
            }
            @keyframes fadeIn {
                from { opacity: 0; }
                to   { opacity: 1; }
            }
            .animate-slideUp { animation: slideUp 0.35s ease-out; }
            .animate-fadeIn  { animation: fadeIn 0.35s ease-out; }
        </style>
        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
        <div class="flex min-h-screen">
            <aside class="fixed inset-y-0 left-0 w-64 bg-[#0d1b2a] text-white p-4 flex flex-col justify-between z-40 
                          lg:fixed lg:translate-x-0" 
                   id="sidebar-menu">
                <div>
                    <div class="flex items-center justify-between gap-4 mb-8 p-2">
                        <div class="flex items-center gap-4">
                            <div class="bg-primary/20 p-2 rounded-full">
                                <span class="material-symbols-outlined text-primary !text-2xl">health_and_safety</span>
                            </div>
                            <span class="font-bold text-xl">CliniHub</span>
                        </div>
                        <a aria-label="Cerrar menú" class="lg:hidden p-1 text-white/80 hover:text-white" href="#">
                            <span class="material-symbols-outlined">close</span>
                        </a>
                    </div>
                    <nav class="flex flex-col gap-2">
                        <a class="flex items-center gap-3 h-12 px-3 hover:bg-primary/10 text-text-dark/90 rounded" 
                        href="index.php?view=Inicio">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                        <a class="flex items-center gap-3 h-12 px-3 hover:bg-primary/10 text-text-dark/90 rounded" 
                        href="index.php?view=MiPerfil">
                            <span class="material-symbols-outlined">person</span>
                            <span>Mi Perfil</span>
                        </a>
                        <a class="flex items-center gap-3 h-12 px-3 bg-primary/20 text-primary rounded" 
                        href="index.php?view=Agenda">
                            <span class="material-symbols-outlined">calendar_month</span>
                            <span>Agenda</span>
                        </a>
                        <a class="flex items-center gap-3 h-12 px-3 hover:bg-primary/10 text-text-dark/90 rounded" 
                        href="index.php?view=MisPacientes">
                            <span class="material-symbols-outlined">groups</span>
                            <span>Mis Pacientes</span>
                        </a>
                    </nav>
                </div>
                <div class="flex flex-col gap-2">
                    <a class="flex items-center gap-3 h-12 px-3 hover:bg-red-500/10 text-red-500 rounded" 
                    href="index.php?action=logout">
                        <span class="material-symbols-outlined">logout</span>
                        <span>Cerrar Sesión</span>
                    </a>
                </div>
            </aside>
            <main class="flex-1 p-4 md:p-6 lg:p-8 flex flex-col gap-6 relative lg:ml-64">
                <a aria-hidden="true" 
                   class="fixed inset-0 bg-black/50 z-30 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out lg:hidden" 
                   href="#" 
                   id="sidebar-overlay">
                </a>
                
                <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center gap-4">
                        <a aria-label="Abrir menú" class="lg:hidden p-2 -ml-2 text-text-light dark:text-text-dark transition-transform" href="#sidebar-menu">
                            <span class="material-symbols-outlined">menu</span>
                        </a>
                        <div>
                            <h1 class="text-3xl font-bold">Mi Agenda</h1>
                            <p class="text-text-light/60 dark:text-text-dark/60">Gestiona tus citas y disponibilidad.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 self-stretch">
                        <a href="index.php?view=horarios">
                                <button class="flex items-center justify-center gap-2 h-10 px-4 bg-green-500 text-white font-semibold rounded w-full md:w-auto hover:bg-green-600 transition">
                                <span class="material-symbols-outlined">schedule</span>
                                <span>Seleccionar Horario</span>
                            </button>
                        </a>
                    </div>
                </header>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 flex-1">
                    <div class="lg:col-span-2 flex flex-col gap-6">
                        <div class="window bg-surface-light dark:bg-surface-dark p-4" x-data="calendar()">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
                                <div class="flex items-center gap-4">
                                    <button @click="prevMonth" class="p-2 rounded hover:bg-border-light dark:hover:bg-border-dark">
                                        <span class="material-symbols-outlined">chevron_left</span>
                                    </button>
                                    <h2 class="text-xl font-bold whitespace-nowrap" x-text="monthName + ' ' + currentYear"></h2>
                                    <button @click="nextMonth" class="p-2 rounded hover:bg-border-light dark:hover:bg-border-dark">
                                        <span class="material-symbols-outlined">chevron_right</span>
                                    </button>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button @click="vista = 'mes'"
                                            :class="vista === 'mes' ? 'bg-primary-subtle text-primary dark:bg-primary/20' : 'text-text-light/70 dark:text-text-dark/70 hover:bg-border-light dark:hover:bg-border-dark'"
                                            class="h-9 px-3 text-sm font-semibold rounded">
                                        Mes
                                    </button>
                                    <button @click="showWeek()"
                                            :class="vista === 'semana' ? 'bg-primary-subtle text-primary dark:bg-primary/20' : 'text-text-light/70 dark:text-text-dark/70 hover:bg-border-light dark:hover:bg-border-dark'"
                                            class="h-9 px-3 text-sm font-semibold rounded">
                                        Semana
                                    </button>
                                    <button @click="showDay()"
                                        :class="vista === 'dia' 
                                            ? 'bg-primary-subtle text-primary dark:bg-primary/20' 
                                            : 'text-text-light/70 dark:text-text-dark/70 hover:bg-border-light dark:hover:bg-border-dark'"
                                        class="h-9 px-3 text-sm font-semibold rounded">
                                        Día
                                    </button>
                                </div>
                            </div>
                            <div class="relative min-h-[500px]">
                                <!-- Mes -->
                                <div 
                                    x-show="vista === 'mes'"
                                    x-transition
                                    x-cloak
                                    class="absolute top-0 left-0 w-full grid calendar-grid border-t border-l border-border-light dark:border-border-dark"
                                >
                                    <template x-for="d in ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb']">
                                        <div class="text-center font-semibold p-2 border-b border-r border-border-light dark:border-border-dark text-sm" 
                                            x-text="d"></div>
                                    </template>
                                    <template x-for="day in days">
                                        <div 
                                            class="p-2 border-b border-r border-border-light dark:border-border-dark relative overflow-hidden cursor-pointer"
                                            @click="openDayView(day.fullDate)"
                                        >
                                            <span class="font-semibold" x-text="day.number"></span>
                                            <template x-if="appointmentsByDay[day.fullDate]">
                                                <div class="mt-1 text-xs bg-primary/10 text-primary p-1 rounded">
                                                    <span x-text="appointmentsByDay[day.fullDate].length + ' cita(s)'"></span>
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                                <div 
                                    x-show="vista === 'semana'" 
                                    x-transition
                                    x-cloak
                                    class="absolute top-0 left-0 w-full flex-1 overflow-x-auto scrollbar-hide"
                                >
                                    <div class="grid grid-cols-7 min-w-[700px] md:min-w-full">
                                        <template x-for="day in weekDays">
                                            <div class="text-center font-semibold p-2 border-b border-border-light dark:border-border-dark text-sm">
                                                <span x-text="day.label"></span>
                                            </div>
                                        </template>
                                        <template x-for="day in weekDays">
                                            <div class="border-r border-border-light dark:border-border-dark p-2 space-y-2">
                                                <template x-for="cita in (appointmentsByDay[day.fullDate] || [])">
                                                    <div 
                                                        class="p-2 text-xs bg-primary/20 text-primary rounded cursor-pointer"
                                                        @click="openDayView(day.fullDate)"
                                                    >
                                                        <p class="font-bold" x-text="normalizeCitaHour(cita.hora)"></p>
                                                        <p x-text="cita.paciente"></p>
                                                    </div>
                                                </template>
                                                <template x-if="!(appointmentsByDay[day.fullDate] && appointmentsByDay[day.fullDate].length)">
                                                    <div class="p-2 text-xs bg-gray-500/10 text-text-light/70 dark:text-text-dark/70 rounded text-center">
                                                        <p>No hay citas</p>
                                                    </div>
                                                </template>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <!-- Dia -->
                                <div 
                                    x-show="vista === 'dia'" 
                                    x-transition
                                    x-cloak
                                    class="flex flex-col gap-4 overflow-y-auto scrollbar-hide p-4"
                                >
                                    <h2 class="text-xl font-bold mb-2 text-center md:text-left"
                                        x-text="formatDiaCorto(selectedDay)">
                                    </h2>
                                    <template x-if="selectedAppointments.length === 0">
                                        <p class="text-center text-text-light/70 dark:text-text-dark/70 py-10 text-lg md:text-base">
                                            No hay citas para este día.
                                        </p>
                                    </template>
                                    <template x-if="selectedAppointments.length > 0">
                                        <div>
                                            <template x-for="hour in hours">
                                                <div class="flex items-start gap-3 py-3 border-b border-border-light dark:border-border-dark">
                                                    <div class="w-16 text-right text-sm text-text-light/60 dark:text-text-dark/60 pt-1"
                                                        x-text="hour">
                                                    </div>

                                                    <div class="flex-1">
                                                        <template 
                                                            x-for="cita in selectedAppointments.filter(
                                                                c => normalizeCitaHour(c.hora) === normalizeHour(hour)
                                                            )"
                                                        >
                                                        <div 
                                                            class="w-full rounded-md p-3 shadow-sm cursor-pointer transition border-l-4"
                                                            @click="openCitaModal(cita)"
                                                            :class="{
                                                                'bg-yellow-100 border-yellow-400 hover:bg-yellow-200 text-yellow-700': cita.estado === 'pendiente',
                                                                'bg-green-100 border-green-500 hover:bg-green-200 text-green-700': cita.estado === 'confirmada',
                                                                'bg-red-100 border-red-500 hover:bg-red-200 text-red-600': cita.estado === 'cancelada',
                                                                'bg-blue-100 border-blue-500 hover:bg-blue-200 text-blue-700': cita.estado === 'realizada',
                                                            }"
                                                        >
                                                            <p class="text-sm font-bold" x-text="cita.hora"></p>
                                                            <p class="text-sm" x-text="cita.paciente"></p>
                                                        </div>
                                                        </template>
                                                        <template 
                                                            x-if="selectedAppointments.filter(
                                                                c => normalizeCitaHour(c.hora) === normalizeHour(hour)
                                                            ).length === 0"
                                                        >
                                                            <div class="w-full rounded-md p-3 text-center text-sm text-text-light/60 dark:text-text-dark/60">
                                                                Tiempo libre
                                                            </div>
                                                        </template>

                                                    </div>

                                                </div>
                                            </template>

                                        </div>
                                    </template>
                                </div>
                                <!-- MODAL -->
                                <div 
                                    x-show="showModal"
                                    x-cloak
                                    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-[999] p-4 animate-fadeIn"
                                >
                                    <div class="bg-white dark:bg-surface-dark w-full max-w-lg rounded-xl shadow-2xl overflow-hidden animate-slideUp">
                                        <div class="bg-primary/10 dark:bg-primary/20 border-b border-primary/30 p-5 flex items-center gap-4">
                                            <div 
                                                :style="modalCita.foto 
                                                    ? 'background-image:url(' + modalCita.foto + ')' 
                                                    : 'background-image:url(https://via.placeholder.com/200x200?text=Paciente)'"
                                                class="w-16 h-16 rounded-full bg-cover bg-center shadow-md border-2 border-primary"
                                            ></div>
                                            <div>
                                                <h2 class="text-xl font-bold text-primary leading-tight" x-text="modalCita.paciente"></h2>
                                                <p class="text-sm text-text-light/70 dark:text-text-dark/70" x-text="'Cita médica'"></p>
                                            </div>
                                            <button @click="closeCitaModal" class="ml-auto text-text-light/60 hover:text-primary">
                                                <span class="material-symbols-outlined text-2xl">close</span>
                                            </button>
                                        </div>
                                        <div class="p-5 space-y-6 max-h-[70vh] overflow-y-auto">
                                            <div class="bg-background-light dark:bg-background-dark p-4 rounded-lg border border-border-light dark:border-border-dark shadow-sm">
                                                <p class="text-sm mb-1">
                                                    <strong class="text-primary">Fecha:</strong>
                                                    <span x-text="modalCita.fecha"></span>
                                                </p>

                                                <p class="text-sm">
                                                    <strong class="text-primary">Hora:</strong>
                                                    <span x-text="modalCita.hora"></span>
                                                </p>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-text-light dark:text-text-dark mb-2">Notas</h3>
                                                <textarea x-model="modalNotas"
                                                    class="w-full p-3 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark rounded-lg text-sm shadow-inner"
                                                    rows="3"
                                                    placeholder="Escribe notas adicionales de la consulta..."></textarea>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-text-light dark:text-text-dark mb-2">Diagnóstico</h3>
                                                <textarea x-model="modalDiagnostico"
                                                    class="w-full p-3 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark rounded-lg text-sm shadow-inner"
                                                    rows="3"
                                                    placeholder="Escribe el diagnóstico del paciente..."></textarea>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-text-light dark:text-text-dark mb-2">Receta</h3>
                                                <textarea x-model="modalReceta"
                                                    class="w-full p-3 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark rounded-lg text-sm shadow-inner"
                                                    rows="3"
                                                    placeholder="Escribe la receta médica..."></textarea>
                                            </div>

                                        </div>
                                        <div class="border-t border-border-light dark:border-border-dark p-4 flex justify-end gap-3 bg-background-light dark:bg-background-dark">
                                            <button 
                                                @click="closeCitaModal"
                                                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-sm rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition shadow-sm"
                                            >
                                                Cancelar
                                            </button>

                                            <button 
                                                @click="completeCita"
                                                class="px-4 py-2 bg-primary text-white text-sm font-semibold rounded-lg shadow-md hover:bg-primary/80 transition"
                                            >
                                                Completar
                                            </button>
                                        </div>

                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-1 flex flex-col gap-6">
                        <div class="window bg-surface-light dark:bg-surface-dark flex flex-col">
                            <header class="border-b border-border-light dark:border-border-dark p-4">
                                <h2 class="text-lg font-bold">Resumen del Día</h2>
                                <p class="text-sm text-text-light/60 dark:text-text-dark/60">Miércoles, 6 de Diciembre</p>
                            </header>
                            <div class="p-4 flex-1 overflow-y-auto space-y-4">
                                <div class="flex items-center gap-3 p-3 bg-green-500/10 rounded border-l-4 border-green-500">
                                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuATJn5QwYPv9__VsaX0rlDfujVs24BDJw69jQ75MkdNW2GM4FaFeA9aRDKQlTvNbHEnKddLzPiZo2yw4rpRG3l7jcXsaW-fGj9ZJNw5s7Cye_MPNUU53xZsoCeLNEjAkYxqS3V6uP5bI8syiw7shd54zXo5FqBPNEMEh2vew1WPJ-TOL-y0cY9CFj17IVDnf2--6K9l0eO1Org75TNhIr5GZEVZ_xd_i8lks7ynOAvTuEUSlXm6HlujRzouUnUc5br4NtYFMt7VVFrX");'></div>
                                    <div>
                                        <p class="font-semibold">Carlos Mendoza</p>
                                        <p class="text-sm text-text-light/80 dark:text-text-dark/80">09:00 - 09:30 <span class="font-bold text-green-600 dark:text-green-400">• Confirmada</span></p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-yellow-500/10 rounded border-l-4 border-yellow-500">
                                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuATJn5QwYPv9__VsaX0rlDfujVs24BDJw69jQ75MkdNW2GM4FaFeA9aRDKQlTvNbHEnKddLzPiZo2yw4rpRG3l7jcXsaW-fGj9ZJNw5s7Cye_MPNUU53xZsoCeLNEjAkYxqS3V6uP5bI8syiw7shd54zXo5FqBPNEMEh2vew1WPJ-TOL-y0cY9CFj17IVDnf2--6K9l0eO1Org75TNhIr5GZEVZ_xd_i8lks7ynOAvTuEUSlXm6HlujRzouUnUc5br4NtYFMt7VVFrX");'></div>
                                    <div>
                                        <p class="font-semibold">Laura Jimenez</p>
                                        <p class="text-sm text-text-light/80 dark:text-text-dark/80">10:00 - 10:30 <span class="font-bold text-yellow-600 dark:text-yellow-400">• Pendiente</span></p>
                                    </div>
                                </div>
                                <div class="p-3 bg-gray-500/10 rounded border-l-4 border-gray-500">
                                    <p class="font-semibold text-text-light/70 dark:text-text-dark/70">11:00 - 12:00</p>
                                    <p class="text-sm text-text-light/60 dark:text-text-dark/60">Tiempo libre</p>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-green-500/10 rounded border-l-4 border-green-500">
                                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCUexV-rdlrinY8S-2_Xg9qTQX7s2Pn7Y3IY31a85C4QHz5xlH4aiRSyEu4D5TWt6l6OzLbLMSay0mcwXFtGTaX38-ZYK_hZmkio-UCMKHOhSaDqZYKYuAmbDqAobEZTlw1Ykco_kF45fFUUS59f7_-dZD3eu5QKO8HNTU4h0Bh5oVBR7NBZVxiiHifAHlWds6hC4Kwipkwx3rFp9uIBcQ_rh9rn333TUybgbWvwhHyxflsh1JzpMFB471rN0JSI6F2mgkFVbnqhpMS");'></div>
                                    <div>
                                        <p class="font-semibold">Ana Torres</p>
                                        <p class="text-sm text-text-light/80 dark:text-text-dark/80">12:00 - 12:30 <span class="font-bold text-green-600 dark:text-green-400">• Confirmada</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="window bg-surface-light dark:bg-surface-dark flex flex-col p-4 gap-3">
                            <h3 class="font-bold text-lg">Filtros</h3>
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium" for="appointment-type">Tipo de Cita</label>
                                <select class="bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark rounded h-10 px-3 text-sm" id="appointment-type">
                                    <option>Todas</option>
                                    <option>Consulta General</option>
                                    <option>Seguimiento</option>
                                    <option>Virtual</option>
                                </select>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium" for="appointment-status">Estado</label>
                                <select class="bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark rounded h-10 px-3 text-sm" id="appointment-status">
                                    <option>Todos</option>
                                    <option>Confirmada</option>
                                    <option>Pendiente</option>
                                    <option>Cancelada</option>
                                </select>
                            </div>
                            <button class="h-10 px-4 bg-primary/20 text-primary font-semibold rounded mt-2">Aplicar Filtros</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
    </body>
<script>
function calendar() {
    return {
        vista: 'mes',
        selectedDay: null,
        selectedAppointments: [],
        currentYear: new Date().getFullYear(),
        currentMonth: new Date().getMonth(),
        days: [],
        appointments: [],
        hours: [],
        appointmentsByDay: {}, 
        weekDays: [], 
        showModal: false,
        modalCita: {},
        modalNotas: "",
        modalDiagnostico: "",
        modalReceta: "",

        async init() {
            await this.loadAppointments();
            await this.loadHours();
            this.generateCalendar();
            this.setWeekDaysFrom(this.todayString());
        },

        localDateToString(date) {
            const y = date.getFullYear();
            const m = String(date.getMonth() + 1).padStart(2, "0");
            const d = String(date.getDate()).padStart(2, "0");
            return `${y}-${m}-${d}`;
        },

        async openCitaModal(cita) {
            const citaCompleta = await this.fetchCitaById(cita.id_cita);
            if (citaCompleta) {
                this.modalCita = citaCompleta;
                this.modalNotas = citaCompleta.notas || "";
                this.modalDiagnostico = citaCompleta.diagnostico || "";
                this.modalReceta = citaCompleta.receta || "";
            } else {
                this.modalCita = cita;
                this.modalNotas = "";
                this.modalDiagnostico = "";
                this.modalReceta = "";
            }
            this.showModal = true;
        },

        closeCitaModal() {
            this.showModal = false;
        },

        async fetchCitaById(id_cita) {
            const form = new FormData();
            form.append("id_cita", id_cita);

            console.log(id_cita);
            const res = await fetch("index.php?action=getCitaById", {
                method: "POST",
                body: form
            });

            const data = await res.json();
            console.log("Respuesta getCitaById:", data);

            return data.success ? data.cita : null;
        },

        async completeCita() {
            const payload = {
                id_cita: this.modalCita.id_cita,
                notas: this.modalNotas,
                diagnostico: this.modalDiagnostico,
                receta: this.modalReceta
            };

            try {
                const res = await fetch("index.php?action=completeCita", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(payload)
                });

                const data = await res.json();

                if (data.success) {
                    this.showModal = false;
                    await this.loadAppointments();
                    if (this.vista === "dia" && this.selectedDay) {
                        this.selectedAppointments = this.appointmentsByDay[this.selectedDay] || [];
                    }

                    if (this.vista === "semana") {
                        const base = this.selectedDay || this.todayString();
                        this.setWeekDaysFrom(base);
                    }

                    if (this.vista === "mes") {
                        this.generateCalendar();
                    }

                } else {
                    alert("Error: " + data.message);
                }

            } catch (e) {
                console.error(e);
                alert("Ocurrió un error de conexión");
            }
        },



        parseDateStr(str) {
            const [y, m, d] = str.split("-").map(Number);
            return new Date(y, m - 1, d);
        },

        todayString() {
            return this.localDateToString(new Date());
        },

        formatDiaCorto(fecha) {
            if (!fecha) return "";
            const dias = [
                "Domingo", "Lunes", "Martes", "Miércoles", 
                "Jueves", "Viernes", "Sábado"
            ];
            const [year, month, day] = fecha.split("-");
            const fechaObj = new Date(year, month - 1, day);
            const diaSemana = dias[fechaObj.getDay()];
            return `${diaSemana} ${parseInt(day)}`;
        },

        async loadAppointments() {
            try {
                const res = await fetch("index.php?action=getDoctorAppointmentsDates");
                const data = await res.json();
                this.appointmentsByDay = {};
                data.forEach(cita => {
                    const fecha = cita.fecha; 
                    if (!this.appointmentsByDay[fecha]) {
                        this.appointmentsByDay[fecha] = [];
                    }
                    this.appointmentsByDay[fecha].push(cita);
                });
            } catch (e) {
                console.error('Error cargando citas', e);
            }
        }, 

        async loadHours() {
            try {
                const res = await fetch("index.php?action=getAllHours");
                const data = await res.json();
                this.hours = data.map(h => h.time); 
            } catch (e) {
                console.error("Error cargando horas", e);
            }
        },

        get monthName() {
            return new Date(this.currentYear, this.currentMonth)
                .toLocaleString("es-ES", { month: "long" })
                .replace(/^\w/, c => c.toUpperCase());
        },

        generateCalendar() {
            this.days = [];
            const firstDay = new Date(this.currentYear, this.currentMonth, 1);
            const lastDay  = new Date(this.currentYear, this.currentMonth + 1, 0);
            const padding = firstDay.getDay(); 
            for (let i = 0; i < padding; i++) {
                this.days.push({ number: '', fullDate: null });
            }
            for (let d = 1; d <= lastDay.getDate(); d++) {
                const date = new Date(this.currentYear, this.currentMonth, d);
                const formatted = this.localDateToString(date);
                this.days.push({
                    number: d,
                    fullDate: formatted
                });
            }
        },

        normalizeHour(timeString) {
            let [hourMin, ampm] = timeString.split(" ");
            let [h, m] = hourMin.split(":");
            h = parseInt(h);
            if (ampm === "PM" && h !== 12) h += 12;
            if (ampm === "AM" && h === 12) h = 0;
            return `${h.toString().padStart(2,'0')}:${m}`;
        },

        normalizeCitaHour(hora) {
            if (hora.includes("AM") || hora.includes("PM")) {

                let [hourMin, ampm] = hora.split(" ");
                let [h, m] = hourMin.split(":");

                h = parseInt(h);

                if (ampm === "PM" && h !== 12) h += 12;
                if (ampm === "AM" && h === 12) h = 0;

                return `${h.toString().padStart(2,'0')}:${m}`;
            }
            hora = hora.substring(0,5);
            let [h, m] = hora.split(":");
            h = h.padStart(2, "0");
            return `${h}:${m}`;
        },


        openDayView(date) {
            if (!date) return;
            this.selectedDay = date;
            this.selectedAppointments = this.appointmentsByDay[date] || [];
            this.syncMonthToSelectedDay(date);
            this.vista = 'dia';
        },

        showDay() {
            const fecha = this.selectedDay || this.todayString();
            this.selectedDay = fecha;
            this.selectedAppointments = this.appointmentsByDay[fecha] || [];
            this.syncMonthToSelectedDay(fecha);
            this.vista = "dia";
        },

        setWeekDaysFrom(fechaStr) {
            const base = this.parseDateStr(fechaStr);
            const diasCortos = ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'];
            const day = base.getDay();                
            const diff = (day === 0 ? -6 : 1 - day); 
            const monday = new Date(base);
            monday.setDate(base.getDate() + diff);

            this.weekDays = [];

            for (let i = 0; i < 7; i++) {
                const d2 = new Date(monday);
                d2.setDate(monday.getDate() + i);
                const fullDate = this.localDateToString(d2);
                const label = `${diasCortos[d2.getDay()]} ${d2.getDate()}`;
                this.weekDays.push({
                    fullDate,
                    label
                });
            }
        },

        showWeek() {
            const base = this.selectedDay || this.todayString();
            this.selectedDay = base;
            this.setWeekDaysFrom(base);
            this.syncMonthToSelectedDay(this.selectedDay);
            this.vista = 'semana';
        },

        syncMonthToSelectedDay(fechaStr) {
            if (!fechaStr) return;
            const d = this.parseDateStr(fechaStr); 
            this.currentYear  = d.getFullYear();
            this.currentMonth = d.getMonth();
        },

        async prevMonth() {
            if (this.vista === "semana") {
                const baseStr = this.selectedDay || this.todayString();
                let d = this.parseDateStr(baseStr);
                d.setDate(d.getDate() - 7);
                const nuevaFecha = this.localDateToString(d);
                this.selectedDay = nuevaFecha;
                this.setWeekDaysFrom(nuevaFecha);
                this.syncMonthToSelectedDay(this.selectedDay);
                return;
            }

            if (this.vista === "dia") {
                const baseStr = this.selectedDay || this.todayString();
                let d = this.parseDateStr(baseStr);
                d.setDate(d.getDate() - 1);
                const nuevaFecha = this.localDateToString(d);
                this.selectedDay = nuevaFecha;
                this.selectedAppointments = this.appointmentsByDay[nuevaFecha] || [];
                this.syncMonthToSelectedDay(this.selectedDay);
                return;
            }

            if (this.currentMonth === 0) {
                this.currentMonth = 11;
                this.currentYear--;
            } else {
                this.currentMonth--;
            }
            await this.loadAppointments();
            this.generateCalendar();
        },

        async nextMonth() {
            if (this.vista === "semana") {
                const baseStr = this.selectedDay || this.todayString();
                let d = this.parseDateStr(baseStr);
                d.setDate(d.getDate() + 7);
                const nuevaFecha = this.localDateToString(d);
                this.selectedDay = nuevaFecha;
                this.setWeekDaysFrom(nuevaFecha);
                this.syncMonthToSelectedDay(this.selectedDay);
                return;
            }

            if (this.vista === "dia") {
                const baseStr = this.selectedDay || this.todayString();
                let d = this.parseDateStr(baseStr);
                d.setDate(d.getDate() + 1);
                const nuevaFecha = this.localDateToString(d);
                this.selectedDay = nuevaFecha;
                this.selectedAppointments = this.appointmentsByDay[nuevaFecha] || [];
                this.syncMonthToSelectedDay(this.selectedDay);
                return;
            }

            if (this.currentMonth === 11) {
                this.currentMonth = 0;
                this.currentYear++;
            } else {
                this.currentMonth++;
            }
            await this.loadAppointments();
            this.generateCalendar();
        }
    };
}
</script>
</html>
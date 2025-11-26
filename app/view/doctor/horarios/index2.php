<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>Disponibilidad Semanal - Clínica Bienestar</title>
        <link href="data:image/x-icon;base64," rel="icon" type="image/x-icon"/>
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect"/>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
            :target ~ #sidebar-overlay {
                opacity: 1;
                pointer-events: auto;
            }
            :target #sidebar {
                transform: translateX(0);
            }
            :target {
                overflow: hidden;
            }
            .time-slot:checked+label {
                background-color: #11b4d4;color: white;
                border-color: #11b4d4;
            }
            html.dark .time-slot:checked+label {
                background-color: #11b4d4;color: #101f22;
            }
            .time-slot:disabled+label {
                background-color: #f3f4f6;
                cursor: not-allowed;
                color: #9ca3af;
                border-color: transparent;
            }
            html.dark .time-slot:disabled+label {
                background-color: rgba(0,0,0,0.2);
                color: #4b5563;
            }
            .schedule-preset:checked + label {
                background-color: #11b4d4;
                color: white;
            }
            html.dark .schedule-preset:checked + label {
                background-color: #11b4d4;
                color: #101f22;
            }
        </style>

    </head>
    <body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark" id="page-container">
        <div class="flex min-h-screen">
            <a class="fixed inset-0 bg-black/60 z-30 opacity-0 pointer-events-none lg:hidden transition-opacity duration-300" href="#page-container" id="sidebar-overlay"></a>
            <aside class="w-64 bg-[#0d1b2a] text-white p-4 flex flex-col justify-between fixed lg:fixed lg:translate-x-0 h-screen -translate-x-full lg:translate-x-0 lg:transition-none transition-transform duration-300 z-40 top-0 left-0" id="sidebar">
                <div>
                    <div class="flex items-center gap-4 mb-8 p-2">
                        <div class="bg-primary/20 p-2 rounded-full">
                            <span class="material-symbols-outlined text-primary !text-2xl">health_and_safety</span>
                        </div>
                        <span class="font-bold text-xl">Clínica Bienestar</span>
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
                        <a class="flex items-center gap-3 h-12 px-3 bg-primary/20 text-primary rounded" href="#">
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
                    <div class="flex items-center gap-3 p-2">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCUexV-rdlrinY8S-2_Xg9qTQX7s2Pn7Y3IY31a85C4QHz5xlH4aiRSyEu4D5TWt6l6OzLbLMSay0mcwXFtGTaX38-ZYK_hZmkio-UCMKHOhSaDqZYKYuAmbDqAobEZTlw1Ykco_kF45fFUUS59f7_-dZD3eu5QKO8HNTU4h0Bh5oVBR7NBZVxiiHifAHlWds6hC4Kwipkwx3rFp9uIBcQ_rh9rn333TUybgbWvwhHyxflsh1JzpMFB471rN0JSI6F2mgkFVbnqhpMS");'></div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-sm">Dr. Carlos Akle</span>
                            <span class="text-xs text-text-dark/70">Cardiólogo</span>
                        </div>
                    </div>
                    <a class="flex items-center gap-3 h-12 px-3 hover:bg-red-500/10 text-red-500 rounded" href="#">
                        <span class="material-symbols-outlined">logout</span>
                        <span>Cerrar Sesión</span>
                    </a>
                </div>
            </aside>
            <main class="flex-1 p-4 md:p-6 lg:p-8 flex flex-col gap-6 lg:ml-64">

                <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center gap-4">
                        <a class="lg:hidden p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700" href="#sidebar">
                            <span class="material-symbols-outlined">menu</span>
                        </a>

                        <a href="index.php?view=Agenda" class="flex items-center justify-center w-10 h-10 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                            <span class="material-symbols-outlined text-4xl text-gray-800 dark:text-gray-100">
                                arrow_back_ios_new
                            </span>
                        </a>





                        <div>
                            <h1 class="text-3xl font-bold">Disponibilidad Semanal</h1>
                            <p class="text-text-light/60 dark:text-text-dark/60">Define tus horarios de atención para la semana.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="flex items-center gap-2 h-10 px-4 border border-border-light dark:border-border-dark font-semibold rounded">
                            <span>Cancelar</span>
                        </button>
                        <button 
                            type="submit" 
                            form="appDisponibilidad" 
                            class="flex items-center gap-2 h-10 px-4 bg-primary text-white font-semibold rounded"
                        >
                            <span class="material-symbols-outlined">save</span>
                            <span>Guardar Disponibilidad</span>
                        </button>
                    </div>
                </header>
                <div class="window bg-surface-light dark:bg-surface-dark p-4 md:p-6 flex flex-col gap-6">
                    <form 
                        x-data="{ 
                            horariosCombinados: [],
                            totalHoras: 0,
                            actualizarTotal() {
                                this.totalHoras = this.horariosCombinados.reduce((suma, dia) => 
                                    suma + dia.horarios.filter(h => h.enabled).length, 0);
                            },
                            limpiarTodo() {
                                this.horariosCombinados.forEach(dia => {
                                    dia.horarios.forEach(h => h.enabled = false);
                                });
                                this.actualizarTotal();
                            }
                        }"
                        x-effect="actualizarTotal()"
                        x-effect="limpiarTodo()"
                        class="hidden lg:block overflow-x-auto"
                        id="appDisponibilidad"
                        method="POST"
                        action="index.php?action=saveSchedule"
                    >
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <h2 class="text-xl font-bold">Patrones Rápidos</h2>
                            <div class="flex flex-wrap gap-2">
                                <button class="flex items-center gap-2 h-9 px-3 text-sm font-semibold rounded bg-primary-subtle text-primary dark:bg-primary/20">
                                    <span class="material-symbols-outlined !text-base">work</span>
                                    <span>Mismo horario días hábiles</span>
                                </button>
                                <button class="flex items-center gap-2 h-9 px-3 text-sm font-semibold rounded text-text-light/70 dark:text-text-dark/70 hover:bg-border-light dark:hover:bg-border-dark">
                                    <span class="material-symbols-outlined !text-base">content_copy</span>
                                    <span>Copiar de Lunes</span>
                                </button>
                                <button 
                                    type="button"
                                    @click="limpiarTodo"
                                    class="flex items-center gap-2 h-9 px-3 text-sm font-semibold rounded text-text-light/70 dark:text-text-dark/70 hover:bg-border-light dark:hover:bg-border-dark"
                                >
                                    <span class="material-symbols-outlined !text-base">clear_all</span>
                                    <span>Limpiar todo</span>
                                </button>
                            </div>
                        </div>
                        <table class="w-full border-collapse text-center">
                            <thead class="border-b border-border-light dark:border-border-dark">
                            <tr>
                                <template x-for="dia in horariosCombinados" :key="dia.id_dia">
                                <th class="p-2 md:p-3 font-semibold" x-text="dia.nombre"></th>
                                </template>
                            </tr>
                            </thead>

                            <tbody>
                            <template x-for="(hora, idx) in horariosCombinados[0]?.horarios || []" :key="hora.id_hora">
                                <tr class="border-b border-border-light dark:border-border-dark">
                                <template x-for="dia in horariosCombinados" :key="dia.id_dia">
                                    <td class="p-1">
                                    <input
                                        class="time-slot sr-only"
                                        type="checkbox"
                                        :id="`chk-${dia.id_dia}-${hora.id_hora}`"
                                        :name="`horarios[${dia.id_dia}][]`"
                                        :value="hora.id_hora"
                                        x-model="dia.horarios.find(h => h.id_hora === hora.id_hora).enabled"
                                    />
                                    <label
                                        :for="`chk-${dia.id_dia}-${hora.id_hora}`"
                                        class="w-full text-sm font-medium cursor-pointer p-2 flex items-center justify-center border border-border-light dark:border-border-dark transition-colors"
                                        :class="{
                                        'bg-primary text-white': dia.horarios.find(h => h.id_hora === hora.id_hora).enabled,
                                        'hover:bg-primary-subtle dark:hover:bg-primary/20': !dia.horarios.find(h => h.id_hora === hora.id_hora).enabled
                                        }"
                                        x-text="hora.time"
                                    ></label>
                                    </td>
                                </template>
                                </tr>
                            </template>
                            </tbody>
                        </table>
                        <div class="mt-4 flex justify-end">
                            <div class="bg-primary-subtle dark:bg-primary/20 text-primary dark:text-primary-subtle p-3 inline-flex items-center gap-2">
                                <span class="font-bold text-lg">Suma Total de Horas Disponibles:</span>
                                <span class="font-black text-2xl" x-text="totalHoras"></span>
                            </div>
                        </div>


                        </form>
                        <div 
                            class="block lg:hidden space-y-6" 
                            id="appDisponibilidadMovil"
                            x-data="{ 
                                horariosCombinados: [], 
                                totalHoras: 0, 
                                actualizarTotal() { 
                                    this.totalHoras = this.horariosCombinados.reduce((suma, dia) => 
                                        suma + dia.horarios.filter(h => h.enabled).length, 0); 
                                },

                                limpiarTodo() {
                                    this.horariosCombinados.forEach(dia => {
                                        dia.horarios.forEach(h => h.enabled = false);
                                    });
                                    this.actualizarTotal();
                                }
                            }"
                            x-effect="actualizarTotal()"
                            x-effect="limpiarTodo()"
                        >
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <h2 class="text-xl font-bold">Patrones Rápidos</h2>
                            <div class="flex flex-wrap gap-2">
                                <button class="flex items-center gap-2 h-9 px-3 text-sm font-semibold rounded bg-primary-subtle text-primary dark:bg-primary/20">
                                    <span class="material-symbols-outlined !text-base">work</span>
                                    <span>Mismo horario días hábiles</span>
                                </button>
                                <button class="flex items-center gap-2 h-9 px-3 text-sm font-semibold rounded text-text-light/70 dark:text-text-dark/70 hover:bg-border-light dark:hover:bg-border-dark">
                                    <span class="material-symbols-outlined !text-base">content_copy</span>
                                    <span>Copiar de Lunes</span>
                                </button>
                                <button 
                                    type="button"
                                    @click="limpiarTodo"
                                    class="flex items-center gap-2 h-9 px-3 text-sm font-semibold rounded text-text-light/70 dark:text-text-dark/70 hover:bg-border-light dark:hover:bg-border-dark"
                                >
                                    <span class="material-symbols-outlined !text-base">clear_all</span>
                                    <span>Limpiar todo</span>
                                </button>
                            </div>
                        </div>
                        <template x-for="dia in horariosCombinados" :key="dia.id_dia">
                            <div class="border-b border-border-light dark:border-border-dark pb-6">
                            <h3 class="font-bold text-lg mb-3" x-text="dia.nombre"></h3>

                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 mb-4">
                                <template x-for="hora in dia.horarios" :key="hora.id_hora">
                                <div>
                                    <input
                                    class="time-slot sr-only"
                                    type="checkbox"
                                    :id="`m-${dia.nombre.toLowerCase()}-${hora.id_hora}`"
                                    :checked="hora.enabled"
                                    x-model="hora.enabled"
                                    />
                                    <label
                                    :for="`m-${dia.nombre.toLowerCase()}-${hora.id_hora}`"
                                    class="w-full text-sm font-medium cursor-pointer p-2 flex items-center justify-center border border-border-light dark:border-border-dark transition-colors"
                                    :class="hora.enabled 
                                        ? 'bg-primary text-white font-semibold' 
                                        : 'hover:bg-primary-subtle dark:hover:bg-primary/20'"
                                    x-text="hora.time"
                                    ></label>
                                </div>
                                </template>
                            </div>

                            <div class="flex items-center gap-2">
                                <input class="schedule-preset sr-only" type="radio"
                                :id="`m-preset-${dia.nombre.toLowerCase()}-morning`"
                                :name="`m-preset-${dia.nombre.toLowerCase()}`" />
                                <label
                                class="flex-1 text-center text-xs font-semibold cursor-pointer p-2 border border-border-light dark:border-border-dark hover:bg-primary-subtle dark:hover:bg-primary/20 transition-colors"
                                :for="`m-preset-${dia.nombre.toLowerCase()}-morning`">
                                Matutino
                                </label>

                                <input class="schedule-preset sr-only" type="radio"
                                :id="`m-preset-${dia.nombre.toLowerCase()}-afternoon`"
                                :name="`m-preset-${dia.nombre.toLowerCase()}`" />
                                <label
                                class="flex-1 text-center text-xs font-semibold cursor-pointer p-2 border border-border-light dark:border-border-dark hover:bg-primary-subtle dark:hover:bg-primary/20 transition-colors"
                                :for="`m-preset-${dia.nombre.toLowerCase()}-afternoon`">
                                Vespertino
                                </label>

                                <input checked class="schedule-preset sr-only" type="radio"
                                :id="`m-preset-${dia.nombre.toLowerCase()}-custom`"
                                :name="`m-preset-${dia.nombre.toLowerCase()}`" />
                                <label
                                class="flex-1 text-center text-xs font-semibold cursor-pointer p-2 border border-border-light dark:border-border-dark hover:bg-primary-subtle dark:hover:bg-primary/20 transition-colors"
                                :for="`m-preset-${dia.nombre.toLowerCase()}-custom`">
                                Personalizado
                                </label>
                            </div>
                            </div>
                        </template>
                        <div class="mt-4 flex justify-end">
                            <div class="bg-primary-subtle dark:bg-primary/20 text-primary dark:text-primary-subtle p-3 inline-flex items-center gap-2">
                                <span class="font-bold text-lg">Suma Total de Horas Disponibles:</span>
                                <span class="font-black text-2xl" x-text="totalHoras"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script>
                document.addEventListener("alpine:initialized", () => {
                const el = document.getElementById("appDisponibilidad");
                const elMovil = document.getElementById("appDisponibilidadMovil");
                if (el && Alpine.$data(el) && elMovil && Alpine.$data(elMovil)) {
                    const app = (window.appDisponibilidad = Alpine.$data(el));
                    const appMovil = (window.appDisponibilidadMovil = Alpine.$data(elMovil));

                    Promise.all([
                    fetch("index.php?action=getDays").then((res) => res.json()),
                    fetch("index.php?action=getAllHours").then((res) => res.json()),
                    fetch("index.php?action=availableSchedule").then((res) => res.json()),
                    ])
                    .then(([diasData, horasData, selectedHours]) => {
                        const selectedMap = {};
                        selectedHours.forEach((d) => {
                        selectedMap[d.id_dia] = d.horas_ids
                            .split(",")
                            .map((id) => parseInt(id.trim()));
                        });

                        const vectorFinal = diasData.map((dia) => {
                        const horas = horasData.map((h) => ({
                            id_hora: h.id_hora,
                            time: h.time,
                            enabled: selectedMap[dia.id_dia]
                            ? selectedMap[dia.id_dia].includes(h.id_hora)
                            : false,
                        }));

                        return {
                            id_dia: dia.id_dia,
                            nombre: dia.nombre,
                            horarios: horas,
                        };
                        });
                        app.horariosCombinados = vectorFinal;
                        app.dias = diasData;
                        app.horarios = horasData;
                        app.selectedHours = selectedHours;

                        appMovil.horariosCombinados = vectorFinal;
                        appMovil.dias = diasData;
                        appMovil.horarios = horasData;
                        appMovil.selectedHours = selectedHours;

                        console.log("Vector combinado listo:", vectorFinal);
                    })
                    .catch((err) =>
                        console.error("Error al obtener datos de disponibilidad:", err)
                    );
                }
                });
            </script>
        </div>
    </body>
</html>
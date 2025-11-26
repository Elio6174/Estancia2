<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>CliniHub - Mis Pacientes</title>
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
                background-color: rgba(17, 180, 212, 0.1); /* bg-primary/10 */
                border-left: 4px solid #11b4d4;
            }

            html.dark .paciente-activo {
                background-color: rgba(17, 180, 212, 0.2); /* dark mode */
            }
        </style>
    </head>
    <body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
        <div class="flex min-h-screen relative">
            <input class="hidden" id="mobile-menu-toggle" type="checkbox"/>
            <aside class="fixed inset-y-0 left-0 w-64 bg-[#0d1b2a] text-white p-4 flex flex-col justify-between z-40 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:relative lg:flex" id="mobile-menu">
                <div>
                    <div class="flex items-center gap-4 mb-8 p-2">
                        <div class="bg-primary/20 p-2 rounded-full">
                            <span class="material-symbols-outlined text-primary !text-2xl">health_and_safety</span>
                        </div>
                        <span class="font-bold text-xl">CliniHub</span>
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
                        <a class="flex items-center gap-3 h-12 px-3 hover:bg-primary/10 text-text-dark/90 rounded" 
                        href="index.php?view=Agenda">
                            <span class="material-symbols-outlined">calendar_month</span>
                            <span>Agenda</span>
                        </a>
                        <a class="flex items-center gap-3 h-12 px-3 bg-primary/20 text-primary rounded" 
                        href="index.php?view=MisPacientes">
                            <span class="material-symbols-outlined">groups</span>
                            <span>Mis Pacientes</span>
                        </a>
                    </nav>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-3 p-2">
                    </div>
                    <a class="flex items-center gap-3 h-12 px-3 hover:bg-red-500/10 text-red-500 rounded" 
                    href="index.php?action=logout">
                        <span class="material-symbols-outlined">logout</span>
                        <span>Cerrar Sesión</span>
                    </a>
                </div>
            </aside>
            <label class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden" for="mobile-menu-toggle" id="mobile-menu-overlay"></label>
            <main class="flex-1 p-4 md:p-6 lg:p-8 flex flex-col gap-6 w-full lg:w-auto">
                <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <label class="lg:hidden cursor-pointer" for="mobile-menu-toggle">
                            <span class="material-symbols-outlined text-2xl">menu</span>
                        </label>
                        <div>
                            <h1 class="text-3xl font-bold">Mis Pacientes</h1>
                            <p class="text-text-light/60 dark:text-text-dark/60">Lista de pacientes asignados y su información.</p>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full md:w-auto">
                        <div class="relative flex-1">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-light/50 dark:text-text-dark/50">search</span>
                            <input class="bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded h-10 pl-10 pr-4 w-full" placeholder="Buscar paciente..." type="text"/>
                        </div>
                        <button class="flex items-center justify-center gap-2 h-10 px-4 bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded">
                            <span class="material-symbols-outlined">filter_list</span>
                            <span>Filtrar</span>
                        </button>
                    </div>
                </header>
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 flex-1">
                    <div class="xl:col-span-2 flex flex-col gap-6">
                        <div class="window bg-surface-light dark:bg-surface-dark flex-1 flex flex-col">
                            <div class="border-b border-border-light dark:border-border-dark p-3">
                                <h2 class="text-lg font-bold">Lista de Pacientes</h2>
                            </div>
                            <div class="flex-1 overflow-y-auto">
                                <?php if(!empty($data)):

                                $pacientes = [];
                                while ($fila = $data->fetch_assoc()) {
                                    $pacientes[] = $fila;
                                }?>
                                <table class="w-full text-left hidden md:table">
                                    <thead class="sticky top-0 bg-surface-light dark:bg-surface-dark border-b border-border-light dark:border-border-dark">
                                        <tr>
                                            <th class="p-3 font-semibold">Nombre del Paciente</th>
                                            <th class="p-3 font-semibold">ID Paciente</th>
                                            <th class="p-3 font-semibold">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($pacientes as $paciente): ?>
                                        <tr 
                                            class="border-b border-border-light dark:border-border-dark hover:bg-primary-subtle/50 dark:hover:bg-primary/10 cursor-pointer"
                                            data-id="<?php echo 'P'.$paciente['id_paciente']; ?>"
                                            data-nombre="<?php echo htmlspecialchars($paciente['nombreApellido']); ?>"
                                            data-foto="<?php echo htmlspecialchars($paciente['foto_url'] ?? 'http://localhost/estancia/vista/uploads/usuarios/12225881.png'); ?>"
                                        >
                                            <td class="p-3">
                                                <div class="flex items-center gap-3">
                                                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" 
                                                     style='background-image: url("<?php echo htmlspecialchars($paciente['foto_url'] ?? "http://localhost/estancia/vista/uploads/usuarios/12225881.png"); ?>");'>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold"><?php echo $paciente['nombreApellido']?></p>
                                                        <p class="text-sm text-text-light/60 dark:text-text-dark/60"><?php echo $paciente['genero'].', '.$paciente['edad'].' años'?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-3"><?php echo 'P'.$paciente['id_paciente']?></td>
                                            <td class="p-3"><span class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-200"><?php echo $paciente['estado_cita']?></span></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                    <div class="divide-y divide-border-light dark:divide-border-dark md:hidden">
                                    <?php foreach($pacientes as $paciente): ?>
                                        <div 
                                        class="p-3 hover:bg-primary-subtle/50 dark:hover:bg-primary/10 cursor-pointer paciente-item"
                                        data-id="<?php echo 'P'.$paciente['id_paciente']; ?>"
                                        data-nombre="<?php echo htmlspecialchars($paciente['nombreApellido']); ?>"
                                        data-foto="<?php echo htmlspecialchars($paciente['foto_url'] ?? 'http://localhost/estancia/vista/uploads/usuarios/12225881.png'); ?>"
                                        >
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" 
                                                style='background-image: url("<?php echo htmlspecialchars($paciente['foto_url'] ?? "http://localhost/estancia/vista/uploads/usuarios/12225881.png"); ?>");'>
                                            </div>
                                            <div>
                                                <p class="font-semibold"><?php echo $paciente['nombreApellido']?></p>
                                                <p class="text-sm text-text-light/60 dark:text-text-dark/60"><?php echo 'P'.$paciente['id_paciente']?></p>
                                            </div>
                                            </div>
                                            <span class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-200">
                                            <?php echo $paciente['estado_cita']?>
                                            </span>
                                        </div>
                                        </div>
                                    <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                <p class="p-4 text-center text-text-light/70 dark:text-text-dark/70">No hay pacientes asignados.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="xl:col-span-1">
                        <div id="panel-acciones" 
                            class="window bg-surface-light dark:bg-surface-dark flex flex-col
                                    xl:relative xl:transform-none xl:inset-auto xl:w-auto xl:h-auto xl:z-auto
                                    fixed inset-y-0 right-0 z-50 w-full sm:w-96 transform translate-x-full 
                                    transition-transform duration-300 ease-in-out hidden"
                        >

                            <header class="bg-surface-light dark:bg-surface-dark border-b border-border-light dark:border-border-dark flex items-center justify-between p-3">
                                <h2 class="text-lg font-bold">Información del Paciente</h2>
                                <button onclick="togglePanel()" class="p-1 rounded hover:bg-background-light dark:hover:bg-background-dark xl:hidden">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                            </header>
                            <div class="p-4 flex-1 flex flex-col gap-4">
                                <div class="flex flex-col items-center text-center gap-2">
                                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-24" 
                                         style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuATJn5QwYPv9__VsaX0rlDfujVs24BDJw69jQ75MkdNW2GM4FaFeA9aRDKQlTvNbHEnKddLzPiZo2yw4rpRG3l7jcXsaW-fGj9ZJNw5s7Cye_MPNUU53xZsoCeLNEjAkYxqS3V6uP5bI8syiw7shd54zXo5FqBPNEMEh2vew1WPJ-TOL-y0cY9CFj17IVDnf2--6K9l0eO1Org75TNhIr5GZEVZ_xd_i8lks7ynOAvTuEUSlXm6HlujRzouUnUc5br4NtYFMt7VVFrX");'>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold">Maria Rodriguez</h3>
                                        <p class="text-text-light/60 dark:text-text-dark/60">ID Paciente: P00456</p>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2 flex-1">
                                    <a id="btnExpediente"
                                    class="flex items-center gap-3 p-3 hover:bg-primary-subtle dark:hover:bg-primary/10 rounded">
                                        <span class="material-symbols-outlined text-primary">description</span>
                                        <span>Ver Expediente Completo</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <div 
            id="appointmentModal"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 
                    opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out"
            >

            <div 
                class="window bg-surface-light dark:bg-surface-dark w-full max-w-4xl max-h-[90vh] flex flex-col 
                    transform scale-95 opacity-0 transition-all duration-300 ease-in-out"
                id="appointmentWindow"
            >
                <!-- Header -->
                <header class="flex items-center justify-between p-4 border-b border-border-light dark:border-border-dark">
                <h2 class="text-xl font-bold">Agendar Nueva Cita</h2>
                <button id="closeModalBtn" class="p-1 rounded hover:bg-background-light dark:hover:bg-background-dark">
                    <span class="material-symbols-outlined">close</span>
                </button>
                </header>

                <!-- Contenido -->
                <div class="flex-1 p-6 grid grid-cols-1 md:grid-cols-2 gap-6 overflow-y-auto">
                <!-- Columna izquierda -->
                <div class="flex flex-col gap-4">
                    <div>
                    <h3 class="font-bold text-lg">Información del Paciente</h3>
                    <div class="p-4 bg-background-light dark:bg-background-dark mt-2 border border-border-light dark:border-border-dark flex items-center gap-4">
                        <div id="modalFotoPaciente" 
                            class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12"
                            style='background-image: url("http://localhost/estancia/vista/uploads/usuarios/12225881.png");'>
                        </div>
                        <div>
                        <p id="modalNombrePaciente" class="font-semibold">Maria Rodriguez</p>
                        <p id="modalIdPaciente" class="text-sm text-text-light/60 dark:text-text-dark/60">ID: P00456</p>
                        </div>
                    </div>
                    </div>

                    <div class="flex flex-col gap-2">
                    <label class="font-medium" for="appointment-type">Tipo de Cita</label>
                    <select class="w-full h-10 px-3 bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded" id="appointment-type">
                        <option>Consulta</option>
                        <option>Seguimiento</option>
                        <option>Procedimiento</option>
                    </select>
                    </div>

                    <div class="flex flex-col gap-2">
                    <label class="font-medium" for="notes">Notas Adicionales</label>
                    <textarea
                        class="w-full p-3 bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded"
                        id="notes"
                        placeholder="Añadir notas relevantes para la cita..."
                        rows="4"></textarea>
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    <h3 class="font-bold text-lg">Seleccionar Fecha y Hora</h3>

                    <div class="border border-border-light dark:border-border-dark p-2">
                        <div class="flex items-center justify-between mb-2 px-2">
                            <button class="p-1 rounded hover:bg-background-light dark:hover:bg-background-dark">
                            <span class="material-symbols-outlined">chevron_left</span>
                            </button>
                            <span class="font-semibold" id="titulo">Octubre 2024</span>
                            <button class="p-1 rounded hover:bg-background-light dark:hover:bg-background-dark">
                            <span class="material-symbols-outlined">chevron_right</span>
                            </button>
                        </div>

                        <div class="grid grid-cols-7 text-center text-sm" id="calendario"></div>
                    </div>

                    <div 
                        class="grid grid-cols-3 gap-2 text-center"
                        x-data="{ horarios: [] }"
                        @update-horarios.window="horarios = $event.detail"
                    >
                    <template x-for="hora in horarios" :key="hora.id_disponibilidad">
                        <button 
                            class="p-2 border border-border-light dark:border-border-dark rounded hover:bg-background-light dark:hover:bg-background-dark transition"
                            x-text="hora.hora_formateada"
                        ></button>
                    </template>
                     <template x-if="horarios.length === 0">
                        <p class="col-span-3 text-sm text-text-light/60 dark:text-text-dark/60 p-2">
                            No hay horarios disponibles para esta fecha.
                        </p>
                    </template>
                    </div>
                </div>
                </div>

                <!-- Footer -->
                <footer class="flex items-center justify-end gap-3 p-4 border-t border-border-light dark:border-border-dark">
                <button id="cancelModalBtn" class="h-10 px-4 rounded border border-border-light dark:border-border-dark hover:bg-background-light dark:hover:bg-background-dark">Cancelar</button>
                <button class="h-10 px-4 rounded bg-primary text-white hover:bg-primary/90">Confirmar Cita</button>
                </footer>
            </div>
            </div>

        </div>
        <div id="panel-overlay" 
             class="fixed inset-0 bg-black/50 z-40 hidden"
             onclick="togglePanel()">
        </div>
        <script>

            document.addEventListener('alpine:init', () => {
                Alpine.store('calendar', {
                    diaSeleccionado: null,   
                    mesSeleccionado: null,  
                    añoSeleccionado: null,  
                    idDia: null,           
                    nombreDia: '',          
                    textoFecha: '',       

                    setFecha(fecha, diasSemana, meses) {
                        this.diaSeleccionado = fecha.getDate();
                        this.mesSeleccionado = fecha.getMonth();
                        this.añoSeleccionado = fecha.getFullYear();

                        const numeroDia = fecha.getDay(); // 0=Dom, 1=Lun, ..., 6=Sab
                        this.idDia = numeroDia === 0 ? 7 : numeroDia;
                        this.nombreDia = diasSemana[numeroDia];
                        this.textoFecha = `${this.diaSeleccionado} de ${meses[this.mesSeleccionado]} de ${this.añoSeleccionado}`;
                    }
                });
            });
            (function () {
                const panel = document.getElementById('panel-acciones')
                const overlay = document.getElementById('panel-overlay')

                const foto = panel.querySelector('.size-24')
                const nombre = panel.querySelector('h3')
                const idPaciente = panel.querySelector('p.text-text-light\\/60')
                const estadoSpan = panel.querySelector('.text-yellow-700')

                function isSmallScreen() {
                    return window.innerWidth < 1024
                }

            function openPanel() {
                panel.classList.remove('translate-x-full', 'hidden');
                if (isSmallScreen() && overlay) {
                    overlay.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closePanel() {
                panel.classList.add('translate-x-full');
                setTimeout(() => panel.classList.add('hidden'), 300); // espera la animación
                if (isSmallScreen() && overlay) {
                    overlay.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            }


            window.togglePanel = function () {
                if (panel.classList.contains('translate-x-full')) openPanel()
                else closePanel()
            }


            const modalFoto = document.getElementById('modalFotoPaciente');
            const modalNombre = document.getElementById('modalNombrePaciente');
            const modalId = document.getElementById('modalIdPaciente');

            const pacientes = document.querySelectorAll('tr[data-nombre], .paciente-item');
            pacientes.forEach(el => {
                el.addEventListener('click', () => {
                    const nombrePaciente = el.dataset.nombre;
                    const id = el.dataset.id;
                    const fotoUrl = el.dataset.foto;

                    pacientes.forEach(p => p.classList.remove('paciente-activo'));
                    el.classList.add('paciente-activo');

                    if (foto) foto.style.backgroundImage = `url('${fotoUrl}')`;
                    if (nombre) nombre.textContent = nombrePaciente;
                    if (idPaciente) idPaciente.textContent = 'ID Paciente: ' + id;
                    if (modalFoto) modalFoto.style.backgroundImage = `url('${fotoUrl}')`;
                    if (modalNombre) modalNombre.textContent = nombrePaciente;
                    if (modalId) modalId.textContent = 'ID: ' + id;

                    const btnExp = document.getElementById("btnExpediente");
                    if (btnExp) {
                        btnExp.href = "index.php?view=Expediente&idPaciente=" + id.replace("P", "");
                    }

                    openPanel();
                });
            });




            if (overlay) overlay.addEventListener('click', closePanel)
                document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closePanel() })
            })()


            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('appointmentModal');
                const windowBox = document.getElementById('appointmentWindow');
                const openBtn = document.getElementById('openModalBtn');
                const closeBtn = document.getElementById('closeModalBtn');
                const cancelBtn = document.getElementById('cancelModalBtn');

                function openModal() {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                windowBox.classList.remove('scale-95', 'opacity-0');
                windowBox.classList.add('scale-100', 'opacity-100');
                }

                function closeModal() {
                windowBox.classList.remove('scale-100', 'opacity-100');
                windowBox.classList.add('scale-95', 'opacity-0');
                modal.classList.add('opacity-0', 'pointer-events-none');
                }

                openBtn.addEventListener('click', openModal);
                closeBtn.addEventListener('click', closeModal);
                cancelBtn.addEventListener('click', closeModal);
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) closeModal();
                });

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') closeModal();
                });
            });


            const diasSemana = ["D", "L", "M", "M", "J", "V", "S"];
            const meses = [
                "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
            ];

            function dibujarCalendario(año, mes) {
                const hoy = new Date();
                const primerDia = new Date(año, mes, 1);
                const ultimoDia = new Date(año, mes + 1, 0);
                const totalDias = ultimoDia.getDate();

                const inicioSemana = primerDia.getDay();
                const ultimoDiaSemana = ultimoDia.getDay();
                const totalPrevios = inicioSemana;
                const totalSiguientes = 6 - ultimoDiaSemana;
                const diasPrevios = new Date(año, mes, 0).getDate();

                const contenedorDias = document.getElementById("calendario");
                contenedorDias.innerHTML = "";

                diasSemana.forEach(dia => {
                    const div = document.createElement("div");
                    div.className = "py-2 text-text-light/60 dark:text-text-dark/60";
                    div.textContent = dia;
                    contenedorDias.appendChild(div);
                });

                for (let i = diasPrevios - totalPrevios + 1; i <= diasPrevios; i++) {
                    const div = crearDia(i, mes - 1, año, true);
                    contenedorDias.appendChild(div);
                }

                for (let i = 1; i <= totalDias; i++) {
                    const div = crearDia(i, mes, año, false);
                    contenedorDias.appendChild(div);
                }

                for (let i = 1; i <= totalSiguientes; i++) {
                    const div = crearDia(i, mes + 1, año, true);
                    contenedorDias.appendChild(div);
                }
                document.getElementById("titulo").textContent = `${meses[mes]} ${año}`;
            }


            let fechaActual = new Date();
            let mesActual = fechaActual.getMonth();
            let añoActual = fechaActual.getFullYear();
            let diaSeleccionado = null;

            dibujarCalendario(añoActual, mesActual);

            function crearDia(dia, mes, año, esOtroMes) {
                const fecha = new Date(año, mes, dia);
                const div = document.createElement("div");
                div.className = "py-2 cursor-pointer group";
                div.textContent = dia;

                if (fecha.getDay() === 0 || fecha.getDay() === 6 || esOtroMes) div.className = "py-2 cursor-pointer text-text-light/40 dark:text-text-dark/40";

                const hoy = new Date();
                if (
                    dia === hoy.getDate() &&
                    mes === hoy.getMonth() &&
                    año === hoy.getFullYear()
                ) {
                    div.className = "py-2 cursor-pointer bg-primary-subtle dark:bg-primary/20 text-primary font-bold";
                }

                div.addEventListener("click", () => seleccionarDia(div, fecha));

                return div;
            }


            function seleccionarDia(elemento, fecha) {
                if (diaSeleccionado) {
                    diaSeleccionado.classList.remove("bg-secondary", "rounded-full", "text-white");
                }

                elemento.classList.add("bg-secondary", "rounded-full", "text-white");
                diaSeleccionado = elemento;

                const dia = fecha.getDate();
                const mes = fecha.getMonth();
                const año = fecha.getFullYear();

                const numeroDia = fecha.getDay();
                const idDia = numeroDia === 0 ? 7 : numeroDia;

                fetch(`index.php?action=getDisponibilidad&date=${idDia}`)
                .then(response => {
                    if (!response.ok) throw new Error("Error en la respuesta del servidor");
                    return response.json();
                })
                .then(data => {
                    window.dispatchEvent(new CustomEvent('update-horarios', { detail: data }));
                })
                .catch(error => {
                    console.error("Error al obtener horarios:", error);
                });

                window.fechaSeleccionada = { dia, mes: mes + 1, año };
            }

        </script>
    </body>
</html>
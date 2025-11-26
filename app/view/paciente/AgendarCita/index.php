<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>CliniHub - Agendar Cita</title>
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
          fontFamily: { "display": ["Inter", "sans-serif"] },
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
    [x-cloak] { display: none !important; }
    aside { height: 100dvh; }
  </style>

  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body 
  class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark"
  x-data="{ sidebarOpen: false }"
  :class="{ 'overflow-hidden': sidebarOpen }"
>
  <?php 
    session_start();
    if (!isset($_SESSION['id_usuario'])) {
      header("Location: index.php");
      exit;
    }
  ?>
  <div class="relative min-h-screen">
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed top-0 left-0 z-40 h-screen w-64 bg-[#0d1b2a] text-white p-4 flex flex-col justify-between 
                transform transition-transform duration-300 ease-in-out 
                overflow-y-auto no-scrollbar md:translate-x-0"
        style="height: 100dvh; will-change: transform;"
    >
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
        <button @click="sidebarOpen = false" class="md:hidden text-white/70 hover:text-white">
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
        <a class="flex items-center gap-3 px-4 py-3 bg-primary/20 text-primary font-bold rounded-lg" 
        href="index.php?view=MisCitas">
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
    <div class="mt-6">
        <a class="flex items-center gap-3 px-4 py-3 mt-2 hover:bg-red-500/10 text-red-500 rounded-lg" 
        href="index.php?action=logout">
        <span class="material-symbols-outlined">logout</span>
        <span>Cerrar Sesión</span>
        </a>
    </div>
    </aside>
    <div
      @click="sidebarOpen = false"
      class="fixed inset-0 bg-black/50 z-30 md:hidden"
      x-cloak
      x-show="sidebarOpen"
      x-transition:enter="transition-opacity ease-linear duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition-opacity ease-linear duration-300"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
    ></div>
      <main class="flex-1 p-4 sm:p-8 lg:h-screen lg:overflow-y-auto md:ml-64">
        <div class="max-w-7xl mx-auto">
          <header class="mb-8 flex items-center gap-4">
            <button 
              @click="sidebarOpen = true" 
              class="lg:hidden text-text-light dark:text-text-dark p-2 mt-1"
            >
              <span class="material-symbols-outlined text-3xl">menu</span>
            </button>
            <div>
              <h2 class="text-3xl lg:text-4xl font-bold text-text-light dark:text-text-dark">
                Agendar Cita
              </h2>
            </div>
          </header>
          <div 
            x-data="{ 
                especialidad: 'Seleccionar especialidad',
                nombreDia: '',
                doctor: 'Seleccionar doctor',
                horaSeleccionada: '',
                idDisponibilidadSeleccionada: '',
                fechaSeleccionada: '',
                fechaDB: '',    
                horariosDisponibles: [],
                especialidades: [],
                doctores: []
              }"
            id="appCita"
            x-on:fecha-seleccionada.window="
              fechaSeleccionada = $event.detail.texto;
              fechaDB = $event.detail.db;
            " 
            x-on:horarios-actualizados.window="horariosDisponibles = $event.detail"
            class="grid grid-cols-1 lg:grid-cols-3 gap-8"
          >
            <form action="index.php?action=CreateAppointment" method="POST" class="contents">
                <input type="hidden" name="hora" :value="idDisponibilidadSeleccionada">
                <input type="hidden" name="fecha" :value="fechaDB">
                <input type="hidden" name="especialidad" :value="especialidad">
                <input type="hidden" name="doctor" :value="doctor">
                <div class="lg:col-span-2 bg-surface-light dark:bg-surface-dark p-4 sm:p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-center mb-6">
                  <h3 class="text-xl sm:text-2xl font-bold" id="titulo">Julio 2024</h3>

                  <div class="flex items-center gap-2">
                    <button type="button" class="p-2 rounded-full hover:bg-border-light dark:hover:bg-border-dark" id="anterior">
                      <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button type="button" class="p-2 rounded-full hover:bg-border-light dark:hover:bg-border-dark" id="siguiente">
                      <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                  </div>
                </div>

                <div class="grid grid-cols-7 gap-1 text-center text-sm" id="calendario"></div>
                <div class="mt-8">
                  <h3 class="text-lg sm:text-xl font-bold mb-4" id="seleccion">
                    Horarios Disponibles para el 15 de Julio
                  </h3>

                  <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-3">
                    <template x-for="slot in horariosDisponibles" :key="slot.id_disponibilidad || slot.time">
                      <button
                        type="button"
                        :disabled="!slot.enabled"
                        @click="
                          if (slot.enabled) {
                            horaSeleccionada = slot.time;
                            idDisponibilidadSeleccionada = slot.id_disponibilidad;

                            window.dispatchEvent(new CustomEvent('hora-seleccionada', {
                              detail: { time: slot.time }
                            }));
                          }
                        "
                        :class="{
                          'p-3 text-center border border-border-light dark:border-border-dark rounded-lg': true,
                          'hover:border-primary hover:text-primary transition-colors': slot.enabled,
                          'bg-primary/10 text-primary border-primary': horaSeleccionada === slot.time,
                          'text-text-light/40 dark:text-text-dark/40 bg-background-light dark:bg-background-dark cursor-not-allowed': !slot.enabled
                        }"
                        x-text="slot.time"
                        :data-id="slot.id_disponibilidad"
                      ></button>
                    </template>
                  </div>
                </div>
              </div>

              <div class="bg-surface-light dark:bg-surface-dark p-4 sm:p-6 rounded-lg shadow-sm space-y-6">
                <div>
                  <label class="block text-sm font-medium text-text-light/80 dark:text-text-dark/80 mb-2" for="specialty">Especialidad</label>
                  <select 
                    x-model="especialidad"
                    id="specialty"
                    @change="
                        if (especialidad && especialidad !== 'Seleccionar especialidad') {
                          window.dispatchEvent(
                            new CustomEvent('especialidad-cambiada', {
                              detail: { specialty: especialidad }
                            })
                          );
                        }
                      "
                    :disabled="!horaSeleccionada"
                    :class="[
                      'w-full bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-lg focus:ring-primary focus:border-primary p-2',
                      !horaSeleccionada ? 'text-text-light/40 dark:text-text-dark/40 bg-background-light dark:bg-background-dark cursor-not-allowed' : ''
                    ]"
                  >
                    <option value="" selected>Seleccionar especialidad</option>
                    <template x-for="esp in especialidades" :key="esp.id_especialidad">
                      <option 
                        :value="esp.id_especialidad"
                        x-text="esp.especialidad"
                      >
                    </option>
                    </template>
                  </select>
                </div>

                <div>
                  <label class="block text-sm font-medium text-text-light/80 dark:text-text-dark/80 mb-2" for="doctor">Doctor</label>
                  <select 
                    x-model="doctor"
                    id="doctor" 
                    :disabled="!especialidad || especialidad === 'Seleccionar especialidad'"
                    :class="[
                      'w-full bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded-lg focus:ring-primary focus:border-primary p-2',
                      (!especialidad || especialidad === 'Seleccionar especialidad') ? 'text-text-light/40 dark:text-text-dark/40 bg-background-light dark:bg-background-dark cursor-not-allowed' : ''
                    ]"
                  >
                    <option value="" selected>Seleccionar doctor</option>
                    <template x-for="doc in doctores" :key="doc.id_doctor">
                      <option 
                        :value="doc.id_doctor"
                        x-text="doc.nombre"
                      >
                    </option>
                    </template>
                  </select>
                </div>
                <div class="border-t border-border-light dark:border-border-dark pt-6">
                  <h3 class="text-lg font-bold mb-4">Resumen de la Cita</h3>
                  <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                      <span class="text-text-light/70 dark:text-text-dark/70">Especialidad:</span>
                      <span 
                        class="font-semibold" 
                        x-text="especialidad ? (especialidades.find(e => e.id_especialidad == especialidad)?.especialidad || 'Seleccionar especialidad') : 'Seleccionar especialidad'"
                      >
                    </span>
                    </div>
                    <div class="flex justify-between">
                      <span class="text-text-light/70 dark:text-text-dark/70">Doctor:</span>
                      <span 
                        class="font-semibold" 
                        x-text="doctor ? (doctores.find(d => d.id_doctor == doctor)?.nombre || 'Seleccionar doctor') : 'Seleccionar doctor'"
                      >
                      </span>
                    </div>
                    <div class="flex justify-between">
                      <span class="text-text-light/70 dark:text-text-dark/70">Fecha:</span>
                      <span class="font-semibold" x-text="fechaSeleccionada || 'Selecciona una fecha'"></span>
                    </div>
                    <div class="flex justify-between">
                      <span class="text-text-light/70 dark:text-text-dark/70">Hora:</span>
                      <span class="font-semibold" x-text="horaSeleccionada">10:00 AM</span>
                    </div>
                  </div>
                </div>
                <button 
                  type="submit"
                  :disabled="!doctor || doctor === 'Seleccionar doctor'"
                  :class="[
                    'w-full font-bold py-3 px-6 rounded-lg flex items-center justify-center gap-2 transition-opacity',
                    (!doctor || doctor === 'Seleccionar doctor') 
                      ? 'bg-gray-400 text-white cursor-not-allowed opacity-70' 
                      : 'bg-primary text-white hover:opacity-90'
                  ]"
                >
                  <span class="material-symbols-outlined">check_circle</span>
                  <span>Confirmar Cita</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </main>
    <script>
    function parseHora12hToDate(timeStr, baseDate = new Date()) {
        let [time, ampm] = timeStr.trim().split(" ");
        let [hour, minute] = time.split(":").map(n => parseInt(n));

        if (ampm.toUpperCase() === "PM" && hour < 12) hour += 12;
        if (ampm.toUpperCase() === "AM" && hour === 12) hour = 0;

        const d = new Date(baseDate);
        d.setHours(hour, minute, 0, 0);
        return d;
    }

    const diasSemana = ["DOM", "LUN", "MAR", "MIE", "JUE", "VIE", "SAB"];
    const meses = [
      "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
      "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];

    let fechaActual = new Date();
    let mesActual = fechaActual.getMonth();
    let añoActual = fechaActual.getFullYear();
    let diaSeleccionado = null;

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
        div.className = "font-bold text-sm text-text-light/60 dark:text-text-dark/60";
        div.textContent = dia;
        contenedorDias.appendChild(div);
      });

      for (let i = diasPrevios - totalPrevios + 1; i <= diasPrevios; i++) {
        contenedorDias.appendChild(crearDia(i, mes - 1, año, true));
      }

      for (let i = 1; i <= totalDias; i++) {
        contenedorDias.appendChild(crearDia(i, mes, año, false));
      }

      for (let i = 1; i <= totalSiguientes; i++) {
        contenedorDias.appendChild(crearDia(i, mes + 1, año, true));
      }

      document.getElementById("titulo").textContent = `${meses[mes]} ${año}`;
    }

    function crearDia(dia, mes, año, esOtroMes) {
      const fecha = new Date(año, mes, dia);
      const div = document.createElement("div");
      div.textContent = dia;

      const hoy = new Date();
      hoy.setHours(0,0,0,0);

      const fechaComparar = new Date(año, mes, dia);
      fechaComparar.setHours(0,0,0,0);

      if (fechaComparar < hoy) {
        div.className = "py-2 text-text-light/40 dark:text-text-dark/40 cursor-not-allowed rounded";
        return div;
      }

      div.className = "py-2 cursor-pointer group";

      if (
        dia === hoy.getDate() &&
        mes === hoy.getMonth() &&
        año === hoy.getFullYear()
      ) {
        div.className = "py-2 cursor-pointer bg-primary text-white rounded-full";
      }

      if (esOtroMes) {
        div.className = "py-2 text-text-light/40 dark:text-text-dark/40 cursor-not-allowed";
        return div;
      }

      div.addEventListener("click", () => seleccionarDia(div, fecha));
      return div;
    }

    function convertirHoraTo24(hora) {
        let [time, ampm] = hora.split(" ");
        let [h, m] = time.split(":");

        h = parseInt(h);
        m = parseInt(m);

        if (ampm === "PM" && h < 12) h += 12;
        if (ampm === "AM" && h === 12) h = 0;

        h = h.toString().padStart(2, '0');
        m = m.toString().padStart(2, '0');

        return `${h}:${m}:00`;
    }

    function seleccionarDia(elemento, fecha) {
      if (diaSeleccionado) {
        diaSeleccionado.classList.remove("bg-secondary","text-white");
      }

      elemento.classList.add("bg-secondary","rounded-full","text-white");
      diaSeleccionado = elemento;

      const dia = fecha.getDate();
      const mes = fecha.getMonth();
      const año = fecha.getFullYear();
      const nombreDia = diasSemana[fecha.getDay()];
      const textoFecha = `${dia} de ${meses[mes]} de ${año}`;

      const mesDB = String(mes + 1).padStart(2,'0');
      const diaDB = String(dia).padStart(2,'0');
      const fechaDB = `${año}-${mesDB}-${diaDB}`;

      document.getElementById("seleccion").textContent =
        `Horarios Disponibles para el ${dia} de ${meses[mes]}`;

      if (window.appCita) {
        window.appCita.nombreDia = nombreDia;
        window.appCita.horaSeleccionada = '';
        window.appCita.especialidad = 'Seleccionar especialidad';
        window.appCita.doctor = 'Seleccionar doctor';
        window.appCita.especialidades = [];
        window.appCita.doctores = [];
      }

      fetch("index.php?action=getAllHours")
        .then(res => res.json())
        .then(horasData => {
          const todosLosHorarios = horasData.map(h => ({ time: h.time.trim() }));

          return fetch(`index.php?action=getAvailableSlots&date=${nombreDia}`)
            .then(res => res.json())
            .then(data => {
              const disponibles = data.map(slot => ({
                id_disponibilidad: slot.id_disponibilidad,
                time: slot.hora.trim()
              }));

              const dispMap = Object.fromEntries(
                disponibles.map(d => [d.time, d.id_disponibilidad])
              );

              const hoy = new Date();
              const esHoy =
                fecha.getDate() === hoy.getDate() &&
                fecha.getMonth() === hoy.getMonth() &&
                fecha.getFullYear() === hoy.getFullYear();

              const listaFinal = todosLosHorarios.map(h => {
                let disponible = !!dispMap[h.time];

                if (esHoy && disponible) {
                  const horaSlot = parseHora12hToDate(h.time, hoy);
                  if (horaSlot <= hoy) disponible = false;
                }

                return {
                  time: h.time,
                  id_disponibilidad: disponible ? dispMap[h.time] : null,
                  enabled: disponible
                };
              });

              window.dispatchEvent(new CustomEvent('horarios-actualizados', {
                detail: listaFinal
              }));

              window.dispatchEvent(new CustomEvent('fecha-seleccionada', {
                detail: { texto: textoFecha, db: fechaDB }
              }));
            });
        });
    }


    window.addEventListener('hora-seleccionada', (e) => {
        const app = Alpine.$data(document.getElementById('appCita'));

        let hora = e.detail.time;
        const nombreDia = app.nombreDia;

        if (!hora || !nombreDia) return;
        const hora24 = convertirHoraTo24(hora);

        app.especialidad = 'Seleccionar especialidad';
        app.especialidades = [];
        app.doctor = 'Seleccionar doctor';
        app.doctores = [];

        fetch(`index.php?action=getAvailableSpecialties&date=${nombreDia}&time=${hora24}`)
            .then(res => res.json())
            .then(data => {
                app.especialidades = data;
            })
            .catch(err => console.error("Error al obtener especialidades:", err));
    });

    window.addEventListener('especialidad-cambiada', (e) => {
      const app = Alpine.$data(document.getElementById('appCita'));

      const specialty = e.detail.specialty;
      const hora = app.horaSeleccionada;
      const nombreDia = app.nombreDia;

      if (!specialty || !hora) return;

      app.doctor = "Seleccionar doctor";
      app.doctores = [];

      fetch(`index.php?action=getAvailableDoctors&date=${nombreDia}&time=${hora}&specialty=${encodeURIComponent(specialty)}`)
        .then(res => res.json())
        .then(doctores => {
          app.doctores = doctores;
        });
    });

    document.addEventListener("DOMContentLoaded", () => {

      const hoy = new Date();

      const dia = hoy.getDate();
      const mes = hoy.getMonth();
      const año = hoy.getFullYear();
      const nombreDia = diasSemana[hoy.getDay()];
      const textoFecha = `${dia} de ${meses[mes]} de ${año}`;

      document.getElementById("seleccion").textContent =
        `Horarios Disponibles para el ${dia} de ${meses[mes]}`;

      fetch("index.php?action=getAllHours")
        .then(res => res.json())
        .then(horasData => {

          const todosLosHorarios = horasData.map(h => h.time.trim());

          return fetch(`index.php?action=getAvailableSlots&date=${nombreDia}`)
            .then(res => res.json())
            .then(data => {

              const disponibles = data.map(slot => slot.hora.trim());

              const listaFinal = todosLosHorarios.map(time => {

                let disponible = disponibles.includes(time);

                if (disponible) {
                  const horaSlot = parseHora12hToDate(time, hoy);
                  if (horaSlot <= hoy) disponible = false;
                }

                return {
                  time,
                  enabled: disponible
                };

              });
              window.dispatchEvent(new CustomEvent('horarios-actualizados', { detail: listaFinal }));
              window.dispatchEvent(new CustomEvent('fecha-seleccionada', {
                detail: {
                  texto: textoFecha,
                  db: `${año}-${String(mes+1).padStart(2,"0")}-${String(dia).padStart(2,"0")}`
                }
              }));
            });
        });
    });

    document.getElementById("anterior").addEventListener("click", () => {
      mesActual--;
      if (mesActual < 0) { mesActual = 11; añoActual--; }
      diaSeleccionado = null;
      document.getElementById("seleccion").textContent = "Selecciona un día";
      dibujarCalendario(añoActual, mesActual);
    });

    document.getElementById("siguiente").addEventListener("click", () => {
      mesActual++;
      if (mesActual > 11) { mesActual = 0; añoActual++; }
      diaSeleccionado = null;
      document.getElementById("seleccion").textContent = "Selecciona un día";
      dibujarCalendario(añoActual, mesActual);
    });

    document.addEventListener("alpine:initialized", () => {
      window.appCita = Alpine.$data(document.getElementById('appCita'));
    });

    dibujarCalendario(añoActual, mesActual);

    </script>
  </div>
</body>
</html>
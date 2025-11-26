<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>

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
  <div class="flex min-h-screen">
    <!-- Overlay para móvil -->
    <div 
      @click="sidebarOpen = false"
      class="fixed inset-0 z-30 bg-black/50 lg:hidden"
      x-show="sidebarOpen"
      x-transition:enter="transition-opacity ease-linear duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition-opacity ease-linear duration-300"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      x-cloak
    ></div>

    <!-- Sidebar -->
    <aside
      :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
      class="fixed lg:static top-0 left-0 z-40 h-screen w-64 bg-[#0d1b2a] text-white p-4 flex flex-col justify-between 
             transform transition-transform duration-300 ease-in-out 
             overflow-y-auto no-scrollbar lg:translate-x-0"
    >
      <div>
        <div class="flex items-center justify-between gap-4 mb-8 px-2">
          <div class="flex items-center gap-4">
            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12"
              style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCUexV-rdlrinY8S-2_Xg9qTQX7s2Pn7Y3IY31a85C4QHz5xlH4aiRSyEu4D5TWt6l6OzLbLMSay0mcwXFtGTaX38-ZYK_hZmkio-UCMKHOhSaDqZYKYuAmbDqAobEZTlw1Ykco_kF45fFUUS59f7_-dZD3eu5QKO8HNTU4h0Bh5oVBR7NBZVxiiHifAHlWds6hC4Kwipkwx3rFp9uIBcQ_rh9rn333TUybgbWvwhHyxflsh1JzpMFB471rN0JSI6F2mgkFVbnqhpMS");'>
            </div>
            <div>
              <p class="text-sm text-text-dark/70">Hola,</p>
              <h1 class="text-lg font-bold">Sofia</h1>
            </div>
          </div>
          <button @click="sidebarOpen = false" class="lg:hidden text-white/70 hover:text-white">
            <span class="material-symbols-outlined">close</span>
          </button>
        </div>
        <nav class="flex flex-col gap-2">
          <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" href="index.php?view=Inicio">
            <span class="material-symbols-outlined">home</span><span>Inicio</span>
          </a>
          <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" href="index.php?view=MiPerfil">
            <span class="material-symbols-outlined">person</span><span>Mi Perfil</span>
          </a>
          <a class="flex items-center gap-3 px-4 py-3 bg-primary/20 text-primary font-bold rounded-lg" href="index.php?view=MisCitas">
            <span class="material-symbols-outlined">calendar_month</span><span>Agendar Cita</span>
          </a>
          <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" href="index.php?view=MisCitas">
            <span class="material-symbols-outlined">list_alt</span><span>Mis Citas</span>
          </a>
          <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" href="index.php?view=Notificaciones">
            <span class="material-symbols-outlined">notifications</span><span>Notificaciones</span>
          </a>
          <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" href="index.php?view=Mensajes">
            <span class="material-symbols-outlined">chat</span><span>Mensajes</span>
          </a>
          <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" href="#">
            <span class="material-symbols-outlined">quiz</span><span>FAQ</span>
          </a>
          <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" href="#">
            <span class="material-symbols-outlined">receipt_long</span><span>Recetas Activas</span>
          </a>
        </nav>
      </div>
      <div class="mt-6">
        <a class="flex items-center gap-3 px-4 py-3 mt-2 hover:bg-red-500/10 text-red-500 rounded-lg" href="#">
          <span class="material-symbols-outlined">logout</span><span>Cerrar Sesión</span>
        </a>
      </div>
    </aside>

    <!-- Contenido principal -->
    <main class="flex-1 min-h-screen p-4 sm:p-8 lg:overflow-auto">
      <div class="w-full px-2 sm:px-8">
        <header class="mb-8 flex items-center gap-4">
          <button @click="sidebarOpen = true" class="lg:hidden text-text-light dark:text-text-dark p-2 mt-1">
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
            
          
                <input type="hidden" name="hora" :value="idDisponibilidadSeleccionada">
                <input type="hidden" name="fecha" :value="fechaDB">
                <input type="hidden" name="especialidad" :value="especialidad">
                <input type="hidden" name="doctor" :value="doctor">
                <div class="lg:col-span-2 bg-surface-light dark:bg-surface-dark p-4 sm:p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-center mb-6">
                  <h3 class="text-xl sm:text-2xl font-bold" id="titulo">Julio 2024</h3>

                  <div class="flex items-center gap-2">
                    <button class="p-2 rounded-full hover:bg-border-light dark:hover:bg-border-dark" id="anterior">
                      <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button class="p-2 rounded-full hover:bg-border-light dark:hover:bg-border-dark" id="siguiente">
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
                          horaSeleccionada = slot.time;
                          idDisponibilidadSeleccionada = slot.id_disponibilidad;
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
                <button type="submit" class="w-full bg-primary text-white font-bold py-3 px-6 hover:opacity-90 transition-opacity rounded-lg flex items-center justify-center gap-2">
                  <span class="material-symbols-outlined">check_circle</span>
                  <span>Confirmar Cita</span>
                </button>
              </div>
            
          </div>
      </div>
    </main>
    <script>
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
          if (mes === hoy.getMonth() && año === hoy.getFullYear()) {
            document.getElementById("seleccion").textContent = `Horarios Disponibles para el ${hoy.getDate()} de ${meses[hoy.getMonth()]}`;
          }
        }

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
            div.className = "py-2 relative cursor-pointer group bg-primary text-white rounded-full";
          }

          div.addEventListener("click", () => seleccionarDia(div, fecha));

          return div;
        }

        function seleccionarDia(elemento, fecha) {
          if (diaSeleccionado) {
            diaSeleccionado.classList.remove("bg-secondary","rounded-full","text-white");
          }

          elemento.classList.add("bg-secondary","rounded-full","text-white");
          diaSeleccionado = elemento;

          if (window.appCita) {
            window.appCita.horaSeleccionada = '';
            window.appCita.especialidad = 'Seleccionar especialidad';
            window.appCita.doctor = 'Seleccionar doctor';
            window.appCita.especialidades = [];
            window.appCita.doctores = [];
          }

          const dia = fecha.getDate();
          const mes = fecha.getMonth();
          const año = fecha.getFullYear();
          const nombreDia = diasSemana[fecha.getDay()];
          const textoFecha = `${dia} de ${meses[mes]} de ${año}`;
          document.getElementById("seleccion").textContent = `Horarios Disponibles para el ${dia} de ${meses[mes]}`;

          const mesDB = String(mes + 1).padStart(2, '0'); 
          const diaDB = String(dia).padStart(2, '0');
          const fechaDB = `${año}-${mesDB}-${diaDB}`;

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

                  const listaFinal = todosLosHorarios.map(h => ({
                    time: h.time,
                    id_disponibilidad: dispMap[h.time] ?? null,
                    enabled: !!dispMap[h.time]
                  }));

                  window.dispatchEvent(new CustomEvent('horarios-actualizados', { detail: listaFinal }));
                  window.dispatchEvent(new CustomEvent('fecha-seleccionada', { detail: { texto: textoFecha, db: fechaDB } }));
                  const horaSeleccionada = listaFinal.find(h => h.enabled)?.time || '';
                  if (horaSeleccionada) {
                    fetch(`index.php?action=getAvailableSpecialties&date=${nombreDia}&time=${horaSeleccionada}`)
                      .then(res => res.json())
                      .then(especialidadesData => {
                        const especialidades = especialidadesData;
                        if (window.appCita) {
                          window.appCita.especialidades = especialidades;
                          window.appCita.nombreDia = nombreDia;
                        }
                      })
                      .catch(err => console.error('Error al obtener especialidades:', err));
                  }
                });
            })
            .catch(err => console.error('Error al obtener horarios:', err));
        }
                  
        document.getElementById("anterior").addEventListener("click", () => {
          mesActual--;
          if (mesActual < 0) {
            mesActual = 11;
            añoActual--;
          }
          diaSeleccionado = null;
          document.getElementById("seleccion").textContent = "Selecciona un día";
          dibujarCalendario(añoActual, mesActual);
        });

        document.getElementById("siguiente").addEventListener("click", () => {
          mesActual++;
          if (mesActual > 11) {
            mesActual = 0;
            añoActual++;
          }
          diaSeleccionado = null;
          document.getElementById("seleccion").textContent = "Selecciona un día";
          dibujarCalendario(añoActual, mesActual);
        });

        dibujarCalendario(añoActual, mesActual);

        document.addEventListener("alpine:initialized", () => {
          const el = document.getElementById('appCita');
          if (el && Alpine.$data(el)) {
            window.appCita = Alpine.$data(el);
            Alpine.effect(() => {
              const especialidad = window.appCita.especialidad;
              const hora = window.appCita.horaSeleccionada;
              const nombreDia = window.appCita.nombreDia;
              if(window.appCita.horaSeleccionada){
                if (hora && especialidad && especialidad !== "" && especialidad !== 0) {
                  fetch(`index.php?action=getAvailableDoctors&date=${nombreDia}&time=${hora}&specialty=${encodeURIComponent(especialidad)}`)
                    .then(res => res.json())
                    .then(doctoresData => {
                      window.appCita.doctores = doctoresData;
                    })
                    .catch(err => console.error("Error al obtener doctores:", err));
                } else {
                  window.appCita.doctor = 'Seleccionar doctor';
                }
              }              
            });
          }
        });

        document.addEventListener("DOMContentLoaded", () => {
          const hoy = new Date();
          const dia = hoy.getDate();
          const mes = meses[hoy.getMonth()];
          const año = hoy.getFullYear();
          const nombreDia = diasSemana[hoy.getDay()];
          const textoFecha = `${dia} de ${mes} de ${año}`;

          document.getElementById("seleccion").textContent = `Horarios Disponibles para el ${dia} de ${mes}`;

          fetch("index.php?action=getAllHours")
            .then(res => res.json())
            .then(horasData => {
              const todosLosHorarios = horasData.map(h => h.time.trim());

              return fetch(`index.php?action=getAvailableSlots&date=${nombreDia}`)
                .then(res => res.json())
                .then(data => {
                  const disponibles = data.map(slot => slot.hora.trim());

                  const listaFinal = todosLosHorarios.map(time => ({
                    time,
                    enabled: disponibles.includes(time)
                  }));

                  window.dispatchEvent(new CustomEvent('horarios-actualizados', { detail: listaFinal }));
                  window.dispatchEvent(new CustomEvent('fecha-seleccionada', { detail: textoFecha }));
                });
            })
            .catch(err => console.error('Error al obtener horarios:', err));
          });
      </script>
  </div>
</body>
</html>

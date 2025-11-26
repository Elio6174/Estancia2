<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Stitch Design</title>
<link href="data:image/x-icon;base64," rel="icon" type="image/x-icon"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#11b4d4",
                        "primary-subtle": "#e0f7fa",
                        //"secondary": "#f472b6",
                        "secondary": "#C2CCD1",
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
<aside class="w-64 bg-[#0d1b2a] text-white p-4 flex flex-col justify-between">
<div>
<div class="flex items-center gap-4 mb-8 px-2">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCUexV-rdlrinY8S-2_Xg9qTQX7s2Pn7Y3IY31a85C4QHz5xlH4aiRSyEu4D5TWt6l6OzLbLMSay0mcwXFtGTaX38-ZYK_hZmkio-UCMKHOhSaDqZYKYuAmbDqAobEZTlw1Ykco_kF45fFUUS59f7_-dZD3eu5QKO8HNTU4h0Bh5oVBR7NBZVxiiHifAHlWds6hC4Kwipkwx3rFp9uIBcQ_rh9rn333TUybgbWvwhHyxflsh1JzpMFB471rN0JSI6F2mgkFVbnqhpMS");'></div>
<div>
<p class="text-sm text-text-dark/70">Hola,</p>
<h1 class="text-lg font-bold">Sofia</h1>
</div>
</div>
<nav class="flex flex-col gap-2">
<a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" <?php echo 'href="index.php?view=Inicio&idUser='.$_GET['idUser'].'"'?>>
<span class="material-symbols-outlined">home</span>
<span>Inicio</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" <?php echo 'href="index.php?view=MiPerfil&idUser='.$_GET['idUser'].'"'?>>
<span class="material-symbols-outlined">person</span>
<span>Mi Perfil</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 bg-primary/20 text-primary font-bold rounded-lg" <?php echo 'href="index.php?view=AgendarCita&idUser='.$_GET['idUser'].'"'?>>
<span class="material-symbols-outlined">calendar_month</span>
<span>Agendar Cita</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" <?php echo 'href="index.php?view=MisCitas&idUser='.$_GET['idUser'].'"'?>>
<span class="material-symbols-outlined">list_alt</span>
<span>Mis Citas</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" <?php echo 'href="index.php?view=Notificaciones&idUser='.$_GET['idUser'].'"'?>>
<span class="material-symbols-outlined">notifications</span>
<span>Notificaciones</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" <?php echo 'href="index.php?view=Mensajes&idUser='.$_GET['idUser'].'"'?>>
<span class="material-symbols-outlined">chat</span>
<span>Mensajes</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" href="#">
<span class="material-symbols-outlined">quiz</span>
<span>FAQ</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" href="#">
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
<main class="flex-1 p-8">
<div class="max-w-7xl mx-auto">
<header class="mb-8">
<h2 class="text-4xl font-bold text-text-light dark:text-text-dark">Agendar Cita</h2>
<p class="text-text-light/60 dark:text-text-dark/60 mt-1">Selecciona la especialidad, doctor, fecha y hora para tu próxima cita.</p>
</header>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
<div class="lg:col-span-2 bg-surface-light dark:bg-surface-dark p-6 rounded-lg shadow-sm">
<div class="flex justify-between items-center mb-6">
<h3 class="text-2xl font-bold" id="titulo">Julio 2024</h3>
<div class="flex items-center gap-2">
<button class="p-2 rounded-full hover:bg-border-light dark:hover:bg-border-dark" id="anterior">
<span class="material-symbols-outlined">chevron_left</span>
</button>
<button class="p-2 rounded-full hover:bg-border-light dark:hover:bg-border-dark" id="siguiente">
<span class="material-symbols-outlined">chevron_right</span>
</button>
</div>
</div>
<div class="grid grid-cols-7 gap-1 text-center" id="calendario"></div>
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

    //Dibujar calendario lineal
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

      //Dias de la semana
      diasSemana.forEach(dia => {
        const div = document.createElement("div");
        div.className = "font-bold text-sm text-text-light/60 dark:text-text-dark/60";
        div.textContent = dia;
        contenedorDias.appendChild(div);
      });

      //Días del mes anterior
      for (let i = diasPrevios - totalPrevios + 1; i <= diasPrevios; i++) {
        const div = crearDia(i, mes - 1, año, true);
        contenedorDias.appendChild(div);
      }

      //Días del mes actual
      for (let i = 1; i <= totalDias; i++) {
        const div = crearDia(i, mes, año, false);
        contenedorDias.appendChild(div);
      }

      //Días del siguiente mes
      for (let i = 1; i <= totalSiguientes; i++) {
        const div = crearDia(i, mes + 1, año, true);
        contenedorDias.appendChild(div);
      }

      document.getElementById("titulo").textContent = `${meses[mes]} ${año}`;
      if (mes === hoy.getMonth() && año === hoy.getFullYear()) {
         document.getElementById("seleccion").textContent = `Horarios Disponibles para el ${hoy.getDate()} de ${meses[hoy.getMonth()]}`;
      }else{
   	 console.log("se asigna");
      }

    }

    //Crear un día del calendario
    function crearDia(dia, mes, año, esOtroMes) {
      const fecha = new Date(año, mes, dia);
      const div = document.createElement("div");
      div.className = "py-2 cursor-pointer group";
      div.textContent = dia;

      if (fecha.getDay() === 0 || fecha.getDay() === 6 || esOtroMes) div.className = "py-2 cursor-pointer text-text-light/40 dark:text-text-dark/40";

      // Marcar el día actual
      const hoy = new Date();
      if (
        dia === hoy.getDate() &&
        mes === hoy.getMonth() &&
        año === hoy.getFullYear()
      ) {
        div.className = "py-2 relative cursor-pointer group bg-primary text-white rounded-full";
      }

      //Agregar evento de clic
      div.addEventListener("click", () => seleccionarDia(div, fecha));

      return div;
    }

    //Seleccionar día y mostrarlo
    function seleccionarDia(elemento, fecha) {
      // Quitar selección anterior
      //if (diaSeleccionado) diaSeleccionado.classList.remove("seleccionado");
      if (diaSeleccionado){
	 diaSeleccionado.classList.remove("bg-secondary");
	 diaSeleccionado.classList.remove("rounded-full");
	 diaSeleccionado.classList.remove("text-white");
      }

      // Marcar el nuevo
      //elemento.classList.add("relative bg-secondary text-white rounded-full");
      elemento.classList.add("bg-secondary");
      elemento.classList.add("rounded-full");
      elemento.classList.add("text-white");
      //elemento.className = "py-2 relative cursor-pointer group bg-secondary text-white rounded-full";
      diaSeleccionado = elemento;

      // Mostrar el texto en el <h3>
      const dia = fecha.getDate();
      const mes = meses[fecha.getMonth()];
      const año = fecha.getFullYear();
      document.getElementById("seleccion").textContent = `Horarios Disponibles para el ${dia} de ${mes}`;
    }

    //Botones de navegación
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

    // Inicializar
    dibujarCalendario(añoActual, mesActual);
  </script>

<div class="mt-8">
<h3 class="text-xl font-bold mb-4" id="seleccion">Horarios Disponibles para el 15 de Julio</h3>
<div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
<button class="p-3 text-center border border-border-light dark:border-border-dark rounded-lg hover:border-primary hover:text-primary transition-colors">09:00 AM</button>
<button class="p-3 text-center border border-border-light dark:border-border-dark rounded-lg hover:border-primary hover:text-primary transition-colors bg-primary/10 text-primary border-primary">10:00 AM</button>
<button class="p-3 text-center border border-border-light dark:border-border-dark rounded-lg hover:border-primary hover:text-primary transition-colors">10:30 AM</button>
<button class="p-3 text-center border border-border-light dark:border-border-dark rounded-lg text-text-light/40 dark:text-text-dark/40 bg-background-light dark:bg-background-dark cursor-not-allowed" disabled="">11:00 AM</button>
<button class="p-3 text-center border border-border-light dark:border-border-dark rounded-lg hover:border-primary hover:text-primary transition-colors">11:30 AM</button>
<button class="p-3 text-center border border-border-light dark:border-border-dark rounded-lg hover:border-primary hover:text-primary transition-colors">02:00 PM</button>
<button class="p-3 text-center border border-border-light dark:border-border-dark rounded-lg hover:border-primary hover:text-primary transition-colors">02:30 PM</button>
<button class="p-3 text-center border border-border-light dark:border-border-dark rounded-lg text-text-light/40 dark:text-text-dark/40 bg-background-light dark:bg-background-dark cursor-not-allowed" disabled="">03:00 PM</button>
<button class="p-3 text-center border border-border-light dark:border-border-dark rounded-lg hover:border-primary hover:text-primary transition-colors">03:30 PM</button>
<button class="p-3 text-center border border-border-light dark:border-border-dark rounded-lg hover:border-primary hover:text-primary transition-colors">04:00 PM</button>
</div>
</div>
</div>
<div class="bg-surface-light dark:bg-surface-dark p-6 rounded-lg shadow-sm space-y-6">
<div>
<label class="block text-sm font-medium text-text-light/80 dark:text-text-dark/80 mb-2" for="specialty">Especialidad</label>
<select class="w-full bg-surface-light dark:bg-surface-dark border-border-light dark:border-border-dark rounded-lg focus:ring-primary focus:border-primary" id="specialty" name="specialty">
<option>Seleccionar especialidad</option>
<option selected="">Consulta General</option>
<option>Cardiología</option>
<option>Dermatología</option>
<option>Pediatría</option>
</select>
</div>
<div>
<label class="block text-sm font-medium text-text-light/80 dark:text-text-dark/80 mb-2" for="doctor">Doctor</label>
<select class="w-full bg-surface-light dark:bg-surface-dark border-border-light dark:border-border-dark rounded-lg focus:ring-primary focus:border-primary" id="doctor" name="doctor">
<option>Seleccionar doctor</option>
<option selected="">Dr. Carlos Mendoza</option>
<option>Dra. Elena Ríos</option>
<option>Dr. Juan Perez</option>
</select>
</div>
<div class="border-t border-border-light dark:border-border-dark pt-6">
<h3 class="text-lg font-bold mb-4">Resumen de la Cita</h3>
<div class="space-y-3 text-sm">
<div class="flex justify-between">
<span class="text-text-light/70 dark:text-text-dark/70">Especialidad:</span>
<span class="font-semibold">Consulta General</span>
</div>
<div class="flex justify-between">
<span class="text-text-light/70 dark:text-text-dark/70">Doctor:</span>
<span class="font-semibold">Dr. Carlos Mendoza</span>
</div>
<div class="flex justify-between">
<span class="text-text-light/70 dark:text-text-dark/70">Fecha:</span>
<span class="font-semibold">Lunes, 15 de Julio</span>
</div>
<div class="flex justify-between">
<span class="text-text-light/70 dark:text-text-dark/70">Hora:</span>
<span class="font-semibold">10:00 AM</span>
</div>
</div>
</div>
<button class="w-full bg-primary text-white font-bold py-3 px-6 hover:opacity-90 transition-opacity rounded-lg flex items-center justify-center gap-2">
<span class="material-symbols-outlined">check_circle</span>
<span>Confirmar Cita</span>
</button>
</div>
</div>
</div>
</main>
</div>

</body></html>

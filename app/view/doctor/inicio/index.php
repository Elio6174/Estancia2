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
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#11b4d4",
              "primary-subtle": "#e0f7fa",
              secondary: "#f472b6",
              success: "#34d399",
              warning: "#fbbf24",
              "background-light": "#f6f8f8",
              "background-dark": "#101f22",
              "text-light": "#101f22",
              "text-dark": "#f6f8f8",
              "surface-light": "#ffffff",
              "surface-dark": "#1a2c2f",
              "border-light": "#e0e7e9",
              "border-dark": "#2a3c3f",
            },
            fontFamily: {
              display: ["Inter", "sans-serif"],
            },
            borderRadius: {
              DEFAULT: "0rem",
              lg: "0rem",
              xl: "0rem",
              full: "9999px",
            },
          },
        },
      };
    </script>
    <style>
      .material-symbols-outlined {
        font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 20;
      }

      .window {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1),
          0 10px 10px -5px rgba(0, 0, 0, 0.04);
      }

      #sidebar {
        position: fixed; 
        top: 0;
        left: 0;
        bottom: 0;
        height: 100vh;
        overflow-y: auto; 
      }

      #menu-toggle:checked ~ #sidebar {
        transform: translateX(0);
      }

      #menu-toggle:checked ~ #overlay {
        display: block;
      }

      #menu-toggle:checked ~ main {
        overflow: hidden;
        height: 100vh;
      }

      @media (min-width: 1024px) {
        #overlay {
          display: none !important;
        }
      }

      #alerts-toggle:checked ~ #alerts-modal,
      #tasks-toggle:checked ~ #tasks-modal {
        display: flex;
      }

      body:has(#alerts-toggle:checked),
      body:has(#tasks-toggle:checked),
      body:has(#menu-toggle:checked) {
        overflow: hidden; 
      }
    </style>
  </head>
  <body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
    <div class="flex min-h-screen">
      <input class="hidden" id="menu-toggle" type="checkbox" />
      <label
        class="fixed inset-0 bg-black/60 z-30 hidden lg:hidden cursor-pointer transition-opacity duration-300"
        for="menu-toggle"
        id="overlay"
      ></label>
      <aside
        class="w-64 bg-[#0d1b2a] text-white p-4 flex flex-col justify-between transform -translate-x-full transition-transform duration-300 ease-in-out z-40 lg:translate-x-0 lg:flex"
        id="sidebar"
      >
        <div>
          <div class="flex items-center justify-between gap-4 mb-8 p-2">
            <div class="flex items-center gap-4">
              <div class="bg-primary/20 p-2 rounded-full">
                <span class="material-symbols-outlined text-primary !text-2xl">
                  health_and_safety
                </span>
              </div>
              <span class="font-bold text-xl">CliniHub</span>
            </div>
            <label
              class="lg:hidden cursor-pointer text-text-dark/80 hover:text-white"
              for="menu-toggle"
            >
              <span class="material-symbols-outlined !text-3xl">close</span>
            </label>
          </div>
          <nav class="flex flex-col gap-2">
            <a
              class="flex items-center gap-3 h-12 px-3 bg-primary/20 text-primary rounded"
              href="index.php?view=Inicio"
            >
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
            <a class="flex items-center gap-3 h-12 px-3 hover:bg-primary/10 text-text-dark/90 rounded" 
            href="index.php?view=MisPacientes">
              <span class="material-symbols-outlined">groups</span>
              <span>Mis Pacientes</span>
            </a>
          </nav>
        </div>
        <div class="flex flex-col gap-2">
          <a
            class="flex items-center gap-3 h-12 px-3 hover:bg-red-500/10 text-red-500 rounded"
            href="index.php?action=logout"
          >
            <span class="material-symbols-outlined">logout</span>
            <span>Cerrar Sesión</span>
          </a>
        </div>
      </aside>
      <main class="flex-1 p-4 md:p-6 lg:p-8 flex flex-col gap-6 lg:ml-64">
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
          <div class="flex items-center justify-between w-full lg:w-auto">
            <div class="flex items-center gap-4">
              <label class="lg:hidden cursor-pointer" for="menu-toggle">
                <span class="material-symbols-outlined text-3xl">menu</span>
              </label>
              <div>
                <h1 class="text-2xl md:text-3xl font-bold">Dashboard</h1>
                <p class="text-text-light/60 dark:text-text-dark/60 text-sm md:text-base">
                  Resumen de su actividad diaria.
                </p>
              </div>
            </div>
            <div class="flex items-center gap-2 lg:hidden">
              <label
                class="cursor-pointer p-2 rounded-full hover:bg-gray-200 dark:hover:bg-surface-dark"
                for="alerts-toggle"
              >
                <span class="material-symbols-outlined">notifications</span>
              </label>
              <label
                class="cursor-pointer p-2 rounded-full hover:bg-gray-200 dark:hover:bg-surface-dark"
                for="tasks-toggle"
              >
                <span class="material-symbols-outlined">assignment</span>
              </label>
            </div>
          </div>
        </header>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 flex-1">
            <div class="lg:col-span-2 flex flex-col gap-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="window bg-surface-light dark:bg-surface-dark p-4 flex flex-col gap-4">
                    <div class="flex items-center gap-3">
                    <div class="bg-primary/20 p-2 rounded">
                        <span class="material-symbols-outlined text-primary !text-2xl">event_available</span>
                    </div>
                    <h2 class="text-lg font-bold">Citas del Día</h2>
                    </div>
                    <?php if ($datas->num_rows === 0): ?>
                        <p class="text-center text-gray-500 dark:text-gray-400 py-4">
                            No tienes citas para hoy.
                        </p>
                    <?php else: ?>
                        <?php while($data = $datas->fetch_assoc()): ?>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-3 border border-border-light dark:border-border-dark rounded">
                                    <div>
                                        <p class="font-semibold"><?php echo $data['nombre_paciente']; ?></p>
                                        <p class="text-sm text-text-light/60 dark:text-text-dark/60"><?php echo $data['hora']; ?></p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-200">
                                        <?php echo $data['estado']; ?>
                                    </span>
                                </div>
                            </div>
                            <a class="text-sm font-semibold text-primary text-right mt-auto" href="#">Ver todas las citas</a>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="window bg-surface-light dark:bg-surface-dark p-4 flex flex-col gap-4">
                    <div class="flex items-center gap-3">
                    <div class="bg-secondary/20 p-2 rounded">
                        <span class="material-symbols-outlined text-secondary !text-2xl">event_upcoming</span>
                    </div>
                    <h2 class="text-lg font-bold">Próximas Citas</h2>
                    </div>
                    <div class="space-y-2">
                    <p class="text-sm"><strong>Mañana: </strong><?php echo ($estadisticasCitas['citas_manana'] == 0) ? "No tienes citas para mañana" : $estadisticasCitas['citas_manana'] . " citas programadas"; ?></p>
                    <p class="text-sm"><strong>Esta semana: </strong><?php echo ($estadisticasCitas['total_citas'] == 0) ? "No tienes citas esta semana" : $estadisticasCitas['total_citas'] . " citas programadas";?></p>

                    </div>
                    <div class="flex flex-col gap-2 mt-2">
                    <?php while($nextDate = $nextDates->fetch_assoc()):?>
                    <div class="flex items-center gap-3 p-2 border border-border-light dark:border-border-dark rounded">
                        <div
                        class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8"
                        style='background-image: url("<?php echo htmlspecialchars($nextDate['foto_url'] ?? "https://else.mx/uploads/usuarios/12225881.png"); ?>");'
                        ></div>
                        <div>
                        <p class="font-semibold text-sm"><?php echo $nextDate['nombre_paciente']?></p>
                        <p class="text-xs text-text-light/60 dark:text-text-dark/60"><?php echo $nextDate['fecha_cita'].','.$nextDate['hora']?></p>
                        </div>
                    </div>
                    <?php endwhile;?>
                    </div>
                </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="window bg-surface-light dark:bg-surface-dark p-4 flex flex-col items-center justify-center text-center gap-2">
                    <span class="material-symbols-outlined text-success !text-4xl">groups</span>
                    <p class="text-4xl font-bold">7</p>
                    <p class="text-sm font-semibold text-text-light/80 dark:text-text-dark/80">Pacientes Pendientes</p>
                    <a class="text-sm font-semibold text-primary mt-2" href="#">Ver lista</a>
                </div>
                <div class="window bg-surface-light dark:bg-surface-dark p-4 flex flex-col items-center justify-center text-center gap-2">
                    <div class="relative">
                    <span class="material-symbols-outlined text-secondary !text-4xl">mail</span>
                    <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-secondary text-white text-xs font-bold">3</span>
                    </div>
                    <p class="text-4xl font-bold">3</p>
                    <p class="text-sm font-semibold text-text-light/80 dark:text-text-dark/80">Mensajes No Leídos</p>
                    <a class="text-sm font-semibold text-primary mt-2" href="#">Ir a mensajes</a>
                </div>
                <div class="window bg-surface-light dark:bg-surface-dark p-4 flex flex-col items-center justify-center text-center gap-2">
                    <span class="material-symbols-outlined text-warning !text-4xl">task_alt</span>
                    <p class="text-4xl font-bold">5</p>
                    <p class="text-sm font-semibold text-text-light/80 dark:text-text-dark/80">Alertas / Tareas</p>
                    <a class="text-sm font-semibold text-primary mt-2" href="#">Revisar</a>
                </div>
                </div>
            </div>
            <div class="lg:col-span-1 window bg-surface-light dark:bg-surface-dark flex-col hidden lg:flex">
                <header class="bg-surface-light dark:bg-surface-dark border-b border-border-light dark:border-border-dark flex items-center justify-between p-3">
                <h2 class="text-lg font-bold">Alertas y Tareas Pendientes</h2>
                </header>
                <div class="p-4 flex-1 overflow-y-auto space-y-4">
                <div class="flex items-start gap-3 p-3 bg-warning/10 rounded border border-warning/50">
                    <span class="material-symbols-outlined text-warning mt-1">warning</span>
                    <div>
                    <p class="font-semibold text-warning-700 dark:text-warning">Resultados de laboratorio pendientes</p>
                    <p class="text-sm text-text-light/80 dark:text-text-dark/80">Revisar los análisis de Juan Pérez.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-3 bg-primary-subtle/50 dark:bg-primary/10 rounded border border-primary/50">
                    <span class="material-symbols-outlined text-primary mt-1">description</span>
                    <div>
                    <p class="font-semibold text-primary">Firmar expediente</p>
                    <p class="text-sm text-text-light/80 dark:text-text-dark/80">Expediente de Ana Torres necesita firma digital.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-3 bg-secondary/10 rounded border border-secondary/50">
                    <span class="material-symbols-outlined text-secondary mt-1">call</span>
                    <div>
                    <p class="font-semibold text-secondary-700 dark:text-secondary">Llamada de seguimiento</p>
                    <p class="text-sm text-text-light/80 dark:text-text-dark/80">Contactar a Carlos Mendoza sobre su medicación.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-3 bg-warning/10 rounded border border-warning/50">
                    <span class="material-symbols-outlined text-warning mt-1">medication</span>
                    <div>
                    <p class="font-semibold text-warning-700 dark:text-warning">Revisar prescripción</p>
                    <p class="text-sm text-text-light/80 dark:text-text-dark/80">La farmacia solicitó aclaración sobre la receta de Laura Jimenez.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-3 bg-primary-subtle/50 dark:bg-primary/10 rounded border border-primary/50">
                    <span class="material-symbols-outlined text-primary mt-1">summarize</span>
                    <div>
                    <p class="font-semibold text-primary">Preparar resumen de caso</p>
                    <p class="text-sm text-text-light/80 dark:text-text-dark/80">Para la interconsulta del paciente Roberto Lima.</p>
                    </div>
                </div>
                </div>
            </div>
            </div>
      </main>
    </div>
    <input class="hidden" id="alerts-toggle" type="checkbox" />
    <div
      class="fixed inset-0 bg-black/60 z-50 hidden items-center justify-center p-4"
      id="alerts-modal"
    >
      <label class="absolute inset-0 cursor-pointer" for="alerts-toggle"></label>
      <div
        class="window bg-surface-light dark:bg-surface-dark w-full max-w-lg max-h-[90vh] flex flex-col relative"
      >
        <header
          class="flex items-center justify-between p-4 border-b border-border-light dark:border-border-dark"
        >
          <h2 class="text-lg font-bold">Alertas</h2>
          <label class="cursor-pointer" for="alerts-toggle">
            <span class="material-symbols-outlined">close</span>
          </label>
        </header>
        <div class="p-4 overflow-y-auto space-y-3">
          <div class="p-3 border border-border-light dark:border-border-dark rounded">
            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Hoy, 10:45 AM</p>
            <p class="font-semibold">Resultados de laboratorio pendientes</p>
            <p class="text-sm mt-1">Revisar los análisis de Juan Pérez.</p>
            <button class="text-sm font-semibold text-primary mt-2">Marcar como leído</button>
          </div>
          <div class="p-3 border border-border-light dark:border-border-dark rounded">
            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Ayer, 3:30 PM</p>
            <p class="font-semibold">Revisar prescripción</p>
            <p class="text-sm mt-1">
              La farmacia solicitó aclaración sobre la receta de Laura Jimenez.
            </p>
            <button class="text-sm font-semibold text-primary mt-2">Marcar como leído</button>
          </div>
          <div class="p-3 border border-border-light dark:border-border-dark rounded opacity-60">
            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Hace 2 días</p>
            <p class="font-semibold">Alerta de medicamento</p>
            <p class="text-sm mt-1">
              Posible interacción farmacológica para el paciente Miguel Castro.
            </p>
          </div>
        </div>
      </div>
    </div>
    <input class="hidden" id="tasks-toggle" type="checkbox" />
    <div
      class="fixed inset-0 bg-black/60 z-50 hidden items-center justify-center p-4"
      id="tasks-modal"
    >
      <label class="absolute inset-0 cursor-pointer" for="tasks-toggle"></label>
      <div
        class="window bg-surface-light dark:bg-surface-dark w-full max-w-lg max-h-[90vh] flex flex-col relative"
      >
        <header
          class="flex items-center justify-between p-4 border-b border-border-light dark:border-border-dark"
        >
          <h2 class="text-lg font-bold">Tareas Pendientes</h2>
          <label class="cursor-pointer" for="tasks-toggle">
            <span class="material-symbols-outlined">close</span>
          </label>
        </header>
        <div class="p-4 overflow-y-auto space-y-3">
          <div class="p-3 border border-border-light dark:border-border-dark rounded">
            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Vence: Hoy</p>
            <p class="font-semibold">Firmar expediente</p>
            <p class="text-sm mt-1">Expediente de Ana Torres necesita firma digital.</p>
            <button class="text-sm font-semibold text-primary mt-2">Completar Tarea</button>
          </div>
          <div class="p-3 border border-border-light dark:border-border-dark rounded">
            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Vence: Mañana</p>
            <p class="font-semibold">Llamada de seguimiento</p>
            <p class="text-sm mt-1">Contactar a Carlos Mendoza sobre su medicación.</p>
            <button class="text-sm font-semibold text-primary mt-2">Completar Tarea</button>
          </div>
          <div class="p-3 border border-border-light dark:border-border-dark rounded">
            <p class="text-sm text-text-light/60 dark:text-text-dark/60">Vence: 25 de Mayo</p>
            <p class="font-semibold">Preparar resumen de caso</p>
            <p class="text-sm mt-1">Para la interconsulta del paciente Roberto Lima.</p>
            <button class="text-sm font-semibold text-primary mt-2">Completar Tarea</button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>


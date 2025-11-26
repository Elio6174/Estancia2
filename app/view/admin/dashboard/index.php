<!DOCTYPE html>
<html class="" lang="es">
   <head>
      <meta charset="utf-8"/>
      <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
      <title>CliniHub - Inicio</title>
      <link href="data:image/x-icon;base64," rel="icon" type="image/x-icon"/>
      <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
      <style type="text/tailwindcss">
         @layer utilities {
         .transition-all {
         transition-property: all;
         transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
         transition-duration: 150ms;
         }
         }
      </style>
      <script>tailwind.config = {darkMode: "class", theme: {extend: {colors: {primary: "#11b4d4", "primary-vibrant": "#00a9c7", secondary: "#fb923c", "background-light": "#f6f8f8", "background-dark": "#101f22", "card-light": "#ffffff", "card-dark": "#2d3748"}, fontFamily: {display: "Inter"}, borderRadius: {DEFAULT: "0px", lg: "0px", xl: "0px", full: "0px"}, boxShadow: {soft: "0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05)", lifted: "0 10px 15px -3px rgb(0 0 0 / 0.07), 0 4px 6px -4px rgb(0 0 0 / 0.07)"}}}};</script>
      <link href="https://fonts.googleapis.com" rel="preconnect"/>
      <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
      <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   </head>
   <body class="font-display bg-background-light dark:bg-background-dark">
      <div class="relative flex h-auto min-h-screen w-full overflow-x-hidden">
         <div class="flex h-full grow">
            <aside id="sidebar"
               class="fixed top-0 left-0 h-screen w-64 flex flex-col bg-[#111827] text-white shadow-lg 
                     transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-40">
               <div class="flex h-full flex-col gap-6 p-4">
                  <div class="flex items-center gap-3 p-2">
                     <span class="material-symbols-outlined text-primary text-3xl">health_and_safety</span>
                     <h1 class="text-xl font-bold text-white">CliniHub</h1>
                  </div>
                  <?php include 'app/view/admin/slidebar/index.php'; ?>
               </div>
            </aside>
            <div id="overlay" class="fixed inset-0 bg-black/40 hidden z-30 lg:hidden" onclick="closeSidebar()"></div>
            <div class="flex-1 lg:ml-64">
               <?php include 'app/view/admin/header/index.php'; ?>
               <main class="p-8">
                  <div class="flex flex-col gap-8">
                     <div>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Resumen General</h3>
                        <p class="text-gray-500 dark:text-gray-400">Visión general de las métricas clave del consultorio.</p>
                     </div>
                     <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="group transform cursor-pointer bg-card-light p-5 shadow-soft transition-all hover:-translate-y-1 hover:shadow-lifted dark:bg-card-dark">
                           <div class="flex items-center justify-between">
                              <h4 class="font-semibold text-gray-700 dark:text-gray-200">Total Pacientes</h4>
                              <div class="bg-primary/10 p-2 text-primary transition-colors group-hover:bg-primary group-hover:text-white dark:bg-primary/20">
                                 <span class="material-symbols-outlined">group</span>
                              </div>
                           </div>
                           <p class="mt-4 text-3xl font-bold text-gray-900 dark:text-white"><?php echo $totalPacienes['total'] ?></p>
                           <p class="mt-1 flex items-center text-sm text-green-500">+15% vs mes anterior</p>
                        </div>
                        <div class="group transform cursor-pointer bg-card-light p-5 shadow-soft transition-all hover:-translate-y-1 hover:shadow-lifted dark:bg-card-dark">
                           <div class="flex items-center justify-between">
                              <h4 class="font-semibold text-gray-700 dark:text-gray-200">Citas Próximas</h4>
                              <div class="bg-secondary/10 p-2 text-secondary transition-colors group-hover:bg-secondary group-hover:text-white dark:bg-secondary/20">
                                 <span class="material-symbols-outlined">calendar_today</span>
                              </div>
                           </div>
                           <p class="mt-4 text-3xl font-bold text-gray-900 dark:text-white">34</p>
                           <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Para hoy</p>
                        </div>
                        <div class="group transform cursor-pointer bg-card-light p-5 shadow-soft transition-all hover:-translate-y-1 hover:shadow-lifted dark:bg-card-dark">
                           <div class="flex items-center justify-between">
                              <h4 class="font-semibold text-gray-700 dark:text-gray-200">Doctores Activos</h4>
                              <div class="bg-green-500/10 p-2 text-green-500 transition-colors group-hover:bg-green-500 group-hover:text-white dark:bg-green-500/20">
                                 <span class="material-symbols-outlined">medication</span>
                              </div>
                           </div>
                           <p class="mt-4 text-3xl font-bold text-gray-900 dark:text-white">8</p>
                           <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">De 12 en total</p>
                        </div>
                        <div class="group transform cursor-pointer bg-card-light p-5 shadow-soft transition-all hover:-translate-y-1 hover:shadow-lifted dark:bg-card-dark">
                           <div class="flex items-center justify-between">
                              <h4 class="font-semibold text-gray-700 dark:text-gray-200">Expedientes Recientes</h4>
                              <div class="bg-indigo-500/10 p-2 text-indigo-500 transition-colors group-hover:bg-indigo-500 group-hover:text-white dark:bg-indigo-500/20">
                                 <span class="material-symbols-outlined">folder_copy</span>
                              </div>
                           </div>
                           <p class="mt-4 text-3xl font-bold text-gray-900 dark:text-white">5</p>
                           <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Creados esta semana</p>
                        </div>
                     </div>
                     <div class="grid grid-cols-1 gap-8 lg:grid-cols-5">
                        <div class="bg-card-light p-6 shadow-soft dark:bg-card-dark lg:col-span-3">
                           <div class="flex justify-between items-center mb-4">
                              <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Citas por Mes</h3>
                              <div class="flex items-center gap-4">
                                 <div>
                                       <label for="filtroEstado" class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">Estado</label>
                                       <select id="filtroEstado"
                                          class="w-40 border border-gray-300 bg-background-light py-2 px-3 text-sm
                                                focus:border-primary focus:ring-2 focus:ring-primary/50
                                                dark:border-gray-600 dark:bg-background-dark dark:text-white">
                                          <option value="cancelada">Cancelada</option>
                                          <option value="realizada" selected>Realizada</option>
                                       </select>
                                 </div>
                                 <button id="btnFiltrar"
                                       class="flex items-center gap-2 bg-secondary px-4 py-2 text-sm font-semibold text-white 
                                             transition-all hover:bg-orange-500 mt-6">
                                       <span class="material-symbols-outlined">filter_list</span>
                                       Filtrar
                                 </button>
                              </div>
                           </div>
                           <div class="h-80">
                              <canvas id="citasChart"></canvas>
                           </div>
                        </div>
                     </div>
                     <div class="bg-card-light p-6 shadow-soft dark:bg-card-dark">
                        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                           <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Acceso Rápido</h3>
                        </div>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                           <a class="group flex flex-col items-center justify-center bg-primary/5 p-6 text-center transition-all hover:bg-primary/10 dark:bg-primary/10 dark:hover:bg-primary/20" 
                           href="index.php?view=Citas">
                              <span class="material-symbols-outlined text-primary text-4xl">folder_shared</span>
                              <p class="mt-2 font-semibold text-gray-700 dark:text-gray-200">Ver Citas</p>
                           </a>
                           <a class="group flex flex-col items-center justify-center bg-secondary/5 p-6 text-center transition-all hover:bg-secondary/10 dark:bg-secondary/10 dark:hover:bg-secondary/20" 
                           href="index.php?view=Usuarios">
                              <span class="material-symbols-outlined text-secondary text-4xl">group</span>
                              <p class="mt-2 font-semibold text-gray-700 dark:text-gray-200">Gestionar Usuarios</p>
                           </a>
                           <a class="group flex flex-col items-center justify-center bg-green-500/5 p-6 text-center transition-all hover:bg-green-500/10 dark:bg-green-500/10 dark:hover:bg-green-500/20" 
                           href="index.php?view=Reportes">
                              <span class="material-symbols-outlined text-green-600 text-4xl">calendar_month</span>
                              <p class="mt-2 font-semibold text-gray-700 dark:text-gray-200">Ver Reportes</p>
                           </a>
                        </div>
                     </div>
                  </div>
               </main>
            </div>
         </div>
      </div>
      <script>
         let citasChart = null;
         const citasCtx = document.getElementById('citasChart').getContext('2d');
         const isDarkMode = document.documentElement.classList.contains('dark');
         const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
         const labelColor = isDarkMode ? 'rgba(255, 255, 255, 0.7)' : 'rgba(0, 0, 0, 0.7)';
         function cargarGrafica(estado = "realizada") {
            fetch(`index.php?action=appointmentsByMonth&estado=${estado}`)
               .then(response => response.json())
               .then(data => {
                     const labels = data.map(m => m.mes);
                     const valores = data.map(m => m.total_citas);
                     if (citasChart !== null) {
                        citasChart.destroy();
                     }
                     citasChart = new Chart(citasCtx, {
                        type: 'line',
                        data: {
                           labels: labels,
                           datasets: [{
                                 label: `Citas (${estado})`,
                                 data: valores,
                                 fill: true,
                                 backgroundColor: 'rgba(17, 180, 212, 0.2)',
                                 borderColor: 'rgba(17, 180, 212, 1)',
                                 borderWidth: 2,
                                 pointBackgroundColor: 'rgba(17, 180, 212, 1)',
                                 tension: 0.4
                           }]
                        },
                        options: {
                           responsive: true,
                           maintainAspectRatio: false,
                           scales: {
                                 y: {
                                    beginAtZero: true,
                                    grid: { color: gridColor },
                                    ticks: { color: labelColor }
                                 },
                                 x: {
                                    grid: { color: gridColor },
                                    ticks: { color: labelColor }
                                 }
                           },
                           plugins: { legend: { display: false } }
                        }
                     });
               })
               .catch(error => console.error("Error cargando datos:", error));
         }
         document.getElementById("btnFiltrar").addEventListener("click", () => {
            const estado = document.getElementById("filtroEstado").value;
            cargarGrafica(estado);
         });
         cargarGrafica("realizada");

         function openSidebar() {
            document.getElementById("sidebar").classList.remove("-translate-x-full");
            document.getElementById("overlay").classList.remove("hidden");
            document.body.classList.add("overflow-hidden");
         }

         function closeSidebar() {
            document.getElementById("sidebar").classList.add("-translate-x-full");
            document.getElementById("overlay").classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
         }
      </script>
   </body>
</html>



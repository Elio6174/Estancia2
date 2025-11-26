<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="utf-8"/>
      <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
      <title>CliniHub - Reportes</title>
      <link href="data:image/x-icon;base64," rel="icon" type="image/x-icon"/>
      <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <style type="text/tailwindcss">
         @layer utilities {
         .transition-all {
         transition-property: all;
         transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
         transition-duration: 150ms;
         }
         }
      </style>
      <script>
         tailwind.config = {
             darkMode: "class",
             theme: {
                 extend: {
                     colors: {
                         "primary": "#11b4d4",
                         "primary-vibrant": "#00a9c7",
                         "secondary": "#fb923c",
                         "background-light": "#f0f4f8",
                         "background-dark": "#1a202c",
                         "card-light": "#ffffff",
                         "card-dark": "#2d3748",
                     },
                     fontFamily: {
                         "display": ["Inter"]
                     },
                     borderRadius: {
                         "DEFAULT": "0",
                         "lg": "0",
                         "xl": "0",
                         "full": "9999px"
                     },
                     boxShadow: {
                         'soft': '0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05)',
                         'lifted': '0 10px 15px -3px rgb(0 0 0 / 0.07), 0 4px 6px -4px rgb(0 0 0 / 0.07)',
                     }
                 },
             },
         }
      </script>
      <link href="https://fonts.googleapis.com" rel="preconnect"/>
      <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
      <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
   </head>
   <body class="font-display bg-background-light dark:bg-background-dark">
      <div class="relative flex h-auto min-h-screen w-full overflow-x-hidden">
         <div class="flex h-full grow">
            <aside id="sidebar"
               class="fixed top-0 left-0 h-screen w-64 bg-[#111827] text-white shadow-soft 
                     transform -translate-x-full md:translate-x-0 transition-all duration-300 z-40">
               <div class="flex h-full flex-col gap-6 p-4">
                  <div class="flex items-center gap-3 p-2">
                        <span class="material-symbols-outlined text-primary text-3xl">health_and_safety</span>
                        <h1 class="text-xl font-bold text-white">CliniHub</h1>
                  </div>
                  <?php include 'app/view/admin/slidebar/index.php'; ?>
               </div>
            </aside>
            <div id="overlay" class="fixed inset-0 bg-black/50 hidden z-30 md:hidden"></div>
            <div class="flex-1 md:ml-64 transition-all">
              <?php include 'app/view/admin/header/index.php'; ?>
               <main class="p-8">
                  <div class="flex flex-col gap-8">
                     <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div>
                           <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Generador de Reportes</h3>
                           <p class="text-gray-500 dark:text-gray-400">Seleccione filtros para generar un nuevo reporte.</p>
                        </div>
                     </div>
                     <div class="bg-card-light p-6 shadow-soft dark:bg-card-dark">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                           <div>
                              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300" for="report-type">Tipo de Reporte</label>
                              <select class="w-full border border-gray-300 bg-background-light py-2 pl-3 pr-10 text-gray-900 transition-all focus:border-primary focus:ring-2 focus:ring-primary/50 dark:border-gray-600 dark:bg-background-dark dark:text-white" id="report-type">
                                 <option value="citas">Citas por período</option>
                                 <option value="pacientes">Pacientes</option>
                                 <option value="doctores">Doctores</option>
                              </select>
                           </div>
                           <div>
                              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300" for="start-date">Fecha de Inicio</label>
                              <input class="w-full border border-gray-300 bg-background-light py-2 px-3 text-gray-900 transition-all focus:border-primary focus:ring-2 focus:ring-primary/50 dark:border-gray-600 dark:bg-background-dark dark:text-white" id="start-date" type="date"/>
                           </div>
                           <div>
                              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300" for="end-date">Fecha de Fin</label>
                              <input class="w-full border border-gray-300 bg-background-light py-2 px-3 text-gray-900 transition-all focus:border-primary focus:ring-2 focus:ring-primary/50 dark:border-gray-600 dark:bg-background-dark dark:text-white" id="end-date" type="date"/>
                           </div>
                           <div>
                              <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300" for="doctor">Doctor</label>
                              <select class="w-full border border-gray-300 bg-background-light py-2 pl-3 pr-10 text-gray-900 transition-all focus:border-primary focus:ring-2 focus:ring-primary/50 dark:border-gray-600 dark:bg-background-dark dark:text-white" id="doctor">
                                 <option>Todos</option>
                                 <option>Dr. Carlos Pérez</option>
                                 <option>Dra. Ana García</option>
                                 <option>Dr. Miguel Torres</option>
                              </select>
                           </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                           <button id="btn-generar" class="flex items-center gap-2 bg-gray-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500/50 focus:ring-offset-2 dark:bg-gray-700 dark:hover:bg-gray-600">
                           <span>Generar</span>
                           </button>
                        </div>
                     </div>
                     <div class="bg-card-light p-6 shadow-soft dark:bg-card-dark">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                           <div>
                                 <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300" for="backup-type">
                                    Tipo de Respaldo
                                 </label>
                                 <select class="w-full border border-gray-300 bg-background-light py-2 pl-3 pr-10 
                                                text-gray-900 transition-all focus:border-primary focus:ring-2 
                                                focus:ring-primary/50 dark:border-gray-600 dark:bg-background-dark 
                                                dark:text-white" id="backup-type">
                                    <option>Completo</option>
                                    <option>Incremental</option>
                                    <option>Diferencial</option>
                                 </select>
                           </div>
                           <div class="flex items-end">
                                 <button id="btn-backup" 
                                       class="w-full bg-blue-600 px-4 py-2.5 text-sm font-semibold 
                                                text-white shadow-sm transition-all hover:bg-blue-700 
                                                focus:outline-none focus:ring-2 focus:ring-blue-500/50 
                                                dark:bg-blue-700 dark:hover:bg-blue-600">
                                    Generar Respaldo
                                 </button>
                              </div>
                        </div>
                     </div>
<div class="bg-card-light p-6 shadow-soft dark:bg-card-dark">
   <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Cargar Script SQL</h3>
   
   <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      
      <!-- Input para archivo -->
      <div>
         <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
            Selecciona un archivo SQL
         </label>
         <input 
            id="sql-file"
            type="file" 
            accept=".sql"
            class="w-full border border-gray-300 bg-background-light py-2 px-3 
                   text-gray-900 transition-all focus:border-primary focus:ring-2 
                   focus:ring-primary/50 dark:border-gray-600 dark:bg-background-dark 
                   dark:text-white"
         />
         <p id="sql-file-name" class="mt-2 text-sm text-gray-500 dark:text-gray-400"></p>
      </div>

      <!-- Botón para subir -->
      <div class="flex items-end">
         <button id="btn-upload-sql" 
               class="relative w-full bg-green-600 px-4 py-2.5 text-sm font-semibold 
                        text-white shadow-sm transition-all hover:bg-green-700 
                        focus:outline-none focus:ring-2 focus:ring-green-500/50 
                        dark:bg-green-700 dark:hover:bg-green-600">
            <span id="upload-sql-text">Subir Script SQL</span>
            <span id="upload-sql-spinner" 
                  class="hidden absolute right-4 top-1/2 -translate-y-1/2">
               <svg class="animate-spin h-5 w-5 text-white" 
                     viewBox="0 0 24 24">
                     <circle class="opacity-25" cx="12" cy="12" r="10" 
                           stroke="currentColor" stroke-width="4"></circle>
                     <path class="opacity-75" fill="currentColor"
                           d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                     </path>
               </svg>
            </span>
         </button>

      </div>

   </div>
</div>

                     <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                        <div class="bg-card-light p-6 shadow-soft dark:bg-card-dark lg:col-span-2">
                           <h3 class="mb-6 text-xl font-semibold text-gray-800 dark:text-white">Citas por Período</h3>
                           <div class="h-80">
                              <canvas id="line-chart"></canvas>
                           </div>
                        </div>
                        <div class="bg-card-light p-6 shadow-soft dark:bg-card-dark">
                           <h3 class="mb-6 text-xl font-semibold text-gray-800 dark:text-white">Distribución de Citas</h3>
                           <div class="h-80">
                              <canvas id="pie-chart"></canvas>
                           </div>
                        </div>
                     </div>
                  </div>
               </main>
            </div>
         </div>
      </div>
   <script>
      const lineCtx = document.getElementById('line-chart').getContext('2d');
      const lineChart = new Chart(lineCtx, {
         type: 'line',
         data: {
            labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6'],
            datasets: [{
                  label: 'Citas',
                  data: [65, 59, 80, 81, 56, 55],
                  fill: false,
                  borderColor: '#11b4d4',
                  tension: 0.1,
                  pointBackgroundColor: '#11b4d4',
                  pointBorderColor: '#fff',
                  pointHoverBackgroundColor: '#fff',
                  pointHoverBorderColor: '#11b4d4'
            }]
         },
         options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                  legend: { display: false }
            },
            scales: {
                  x: {
                     grid: { display: false },
                     ticks: { color: document.body.classList.contains('dark') ? '#9ca3af' : '#6b7280' }
                  },
                  y: {
                     grid: { color: document.body.classList.contains('dark') ? '#4b5563' : '#e5e7eb' },
                     ticks: { color: document.body.classList.contains('dark') ? '#9ca3af' : '#6b7280' }
                  }
            }
         }
      });

      const pieCtx = document.getElementById('pie-chart').getContext('2d');
      const pieChart = new Chart(pieCtx, {
         type: 'pie',
         data: {
            labels: ['Consulta General', 'Especialista', 'Urgencias'],
            datasets: [{
                  label: 'Distribución de Citas',
                  data: [300, 150, 100],
                  backgroundColor: ['#11b4d4', '#fb923c', '#6b7280'],
                  hoverOffset: 4
            }]
         },
         options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                  legend: {
                     position: 'bottom',
                     labels: {
                        color: document.body.classList.contains('dark') ? '#f3f4f6' : '#374151'
                     }
                  }
            }
         }
      });

      async function cargarGraficaPie() {
         try {
            const response = await fetch("index.php?action=getAppointmentsBySpecialty");
            const data = await response.json();

            pieChart.data.labels = data.map(item => item.especialidad);
            pieChart.data.datasets[0].data = data.map(item => parseInt(item.total_citas));
            pieChart.update();
         } catch (error) {
            console.error("Error cargando gráfica de pastel:", error);
         }
      }

      async function cargarGraficaLine() {
         try {
            const res = await fetch("index.php?action=getAppointmentsByMonth");
            const data = await res.json();

            lineChart.data.labels = data.map(sem => `Semana ${sem.semana}`);
            lineChart.data.datasets[0].data = data.map(sem => sem.total);

            lineChart.update();
         } catch (error) {
            console.error("Error cargando gráfica de líneas:", error);
         }
      }

      cargarGraficaPie();
      cargarGraficaLine();

      const tipoReporte = document.getElementById("report-type");
      const doctorSelect = document.getElementById("doctor");
      const startDate = document.getElementById("start-date");
      const endDate = document.getElementById("end-date");

      function actualizarCampos() {
         const esCitas = (tipoReporte.value === "citas");
         doctorSelect.disabled = !esCitas;
         doctorSelect.classList.toggle("opacity-50", !esCitas);
         doctorSelect.classList.toggle("cursor-not-allowed", !esCitas);
         startDate.disabled = !esCitas;
         startDate.classList.toggle("opacity-50", !esCitas);
         startDate.classList.toggle("cursor-not-allowed", !esCitas);
         endDate.disabled = !esCitas;
         endDate.classList.toggle("opacity-50", !esCitas);
         endDate.classList.toggle("cursor-not-allowed", !esCitas);
      }
      tipoReporte.addEventListener("change", actualizarCampos);

      actualizarCampos();

      async function cargarDoctores() {
         try {
            const res = await fetch("index.php?action=getDoctors");
            const data = await res.json();

            doctorSelect.innerHTML = "";

            const optTodos = document.createElement("option");
            optTodos.value = "todos";
            optTodos.textContent = "Todos los doctores";
            doctorSelect.appendChild(optTodos);

            data.forEach(doc => {
                  const option = document.createElement("option");
                  option.value = doc.id_doctor;
                  option.textContent = doc.nombre;
                  doctorSelect.appendChild(option);
            });

         } catch (error) {
            console.error("Error cargando doctores:", error);
            doctorSelect.innerHTML = "<option>Error al cargar doctores</option>";
         }
      }
      cargarDoctores();

      const btnGenerar = document.getElementById("btn-generar");
      btnGenerar.addEventListener("click", async () => {
         const tipo = document.getElementById("report-type").value;
         const inicio = document.getElementById("start-date").value;
         const fin = document.getElementById("end-date").value;
         const doctor = document.getElementById("doctor").value;
         const formData = new FormData();
         formData.append("tipo", tipo);
         formData.append("inicio", inicio);
         formData.append("fin", fin);
         formData.append("doctor", doctor);

         const response = await fetch("index.php?action=generarReporteCitas", {
            method: "POST",
            body: formData
         });
         let filename = "Reporte.pdf";

         const header = response.headers.get("Content-Disposition");
         if (header && header.includes("filename=")) {
            filename = header.split("filename=")[1].replace(/"/g, "");
         }
         const blob = await response.blob();
         const url = window.URL.createObjectURL(blob);
         const a = document.createElement("a");
         a.href = url;
         a.download = filename; 
         a.click();
         window.URL.revokeObjectURL(url);
      });

      document.getElementById("btn-backup").addEventListener("click", async () => {

         const type = document.getElementById("backup-type").value;

         const formData = new FormData();
         formData.append("type", type);

         try {
            const res = await fetch("index.php?action=backUp", {
                  method: "POST",
                  body: formData
            });

            // Obtener nombre del archivo desde headers
            let filename = "respaldo.sql";
            const header = res.headers.get("Content-Disposition");

            if (header && header.includes("filename=")) {
                  filename = header.split("filename=")[1].replace(/"/g, "");
            }

            const blob = await res.blob();
            const url = window.URL.createObjectURL(blob);

            const a = document.createElement("a");
            a.href = url;
            a.download = filename;
            a.click();

            window.URL.revokeObjectURL(url);

         } catch (error) {
            console.error("Error generando respaldo:", error);
            alert("Ocurrió un error generando el respaldo");
         }
      });

      document.getElementById("btn-upload-sql").addEventListener("click", async () => {
         const fileInput = document.getElementById("sql-file");
         const file = fileInput.files[0];
         if (!file) {
            alert("Selecciona un archivo primero.");
            return;
         }
         const btn = document.getElementById("btn-upload-sql");
         const text = document.getElementById("upload-sql-text");
         const spinner = document.getElementById("upload-sql-spinner");
         btn.disabled = true;
         btn.classList.add("opacity-70", "cursor-not-allowed");
         text.classList.add("hidden");
         spinner.classList.remove("hidden");
         const formData = new FormData();
         formData.append("sql_file", file);
         try {
            const res = await fetch("index.php?action=uploadSqlScript", {
                  method: "POST",
                  body: formData
            });
            const data = await res.json();
            if (data.success) {
                  alert("Script ejecutado correctamente.");
            } else {
                  alert("Error: " + data.message);
            }
         } catch (err) {
            console.error("Error:", err);
            alert("Ocurrió un error al subir el archivo.");
         }
         btn.disabled = false;
         btn.classList.remove("opacity-70", "cursor-not-allowed");
         text.classList.remove("hidden");
         spinner.classList.add("hidden");
      });
      
      const sidebar = document.getElementById("sidebar");
         const overlay = document.getElementById("overlay");
         const openMenu = document.getElementById("open-menu");

         function openSidebar() {
            sidebar.classList.remove("-translate-x-full");
            overlay.classList.remove("hidden");
            document.body.classList.add("overflow-hidden"); 
         }

         function closeSidebar() {
            sidebar.classList.add("-translate-x-full");
            overlay.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
         }

         openMenu.addEventListener("click", openSidebar);
         overlay.addEventListener("click", closeSidebar);
   </script>
</body>
</html>
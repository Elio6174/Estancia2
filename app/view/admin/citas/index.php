<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="utf-8"/>
      <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
      <title>CliniHub - Citas</title>
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
      <div class="min-h-screen w-full">
        <div class="flex">
            <aside id="sidebar"
               class="fixed top-0 left-0 h-screen w-64 flex flex-col bg-[#111827] text-white shadow-lg
                     transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-40">
               <div class="flex flex-col gap-6 p-4 h-full">
                  <div class="flex items-center gap-3 p-2">
                        <span class="material-symbols-outlined text-primary text-3xl">health_and_safety</span>
                        <h1 class="text-xl font-bold text-white">CliniHub</h1>
                  </div>
                  <?php include 'app/view/admin/slidebar/index.php'; ?>
               </div>
            </aside>
            <div id="overlay" 
               class="fixed inset-0 bg-black/40 hidden z-30 lg:hidden"
               onclick="closeSidebar()">
            </div>
            <div class="flex-1 lg:ml-64">
               <?php include 'app/view/admin/header/index.php'; ?>
               <main class="p-4 sm:p-6 lg:p-8">
                  <div class="flex flex-col gap-8">

                     <!-- Filtros -->
                     <div class="bg-card-light p-6 shadow-soft dark:bg-card-dark rounded-md">
                        <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 pb-6 dark:border-gray-700">
                           <div>
                              <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Filtros de Búsqueda</h3>
                              <p class="text-sm text-gray-500 dark:text-gray-400">Encuentra citas rápidamente usando los filtros.</p>
                           </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">

                           <!-- BUSCAR PACIENTE -->
                           <div class="relative w-full">
                              <label class="text-sm font-medium text-gray-600 dark:text-gray-300" for="search-paciente">Paciente</label>
                              <span class="material-symbols-outlined absolute bottom-2.5 left-3 text-gray-400">search</span>
                              <input 
                                 class="w-full border-gray-300 text-sm rounded-md pl-10
                                       focus:border-primary focus:ring-primary
                                       dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                 id="search-paciente" 
                                 placeholder="Buscar por nombre..." 
                                 type="text"/>
                           </div>

                           <!-- DOCTOR -->
                           <div>
                              <label class="text-sm font-medium text-gray-600 dark:text-gray-300" for="filter-doctor">Doctor</label>
                              <select class="w-full border-gray-300 rounded-md text-sm 
                                             focus:border-primary focus:ring-primary
                                             dark:border-gray-600 dark:bg-gray-700 dark:text-white" 
                                    id="filter-doctor"></select>
                           </div>

                           <!-- FECHA -->
                           <div>
                              <label class="text-sm font-medium text-gray-600 dark:text-gray-300" for="filter-date">Fecha</label>
                              <input 
                                 class="w-full border-gray-300 rounded-md text-sm 
                                       focus:border-primary focus:ring-primary
                                       dark:border-gray-600 dark:bg-gray-700 dark:text-white" 
                                 id="filter-date" type="date"/>
                           </div>

                           <!-- ESTADO -->
                           <div>
                              <label class="text-sm font-medium text-gray-600 dark:text-gray-300" for="filter-status">Estado</label>
                              <select class="w-full border-gray-300 rounded-md text-sm 
                                             focus:border-primary focus:ring-primary
                                             dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    id="filter-status">
                                 <option>Todos</option>
                                 <option>Confirmada</option>
                                 <option>Realizada</option>
                                 <option>Cancelada</option>
                                 <option>Pendiente</option>
                              </select>
                           </div>

                           <!-- BOTÓN FILTRAR -->
                           <div class="flex items-end">
                              <button id="btnFiltrar" 
                                    class="w-full bg-secondary px-4 py-2 text-white text-sm rounded-md 
                                             hover:bg-orange-500">
                                 Filtrar
                              </button>
                           </div>

                        </div>
                     </div>

                     <!-- TABLA -->
                     <div class="overflow-x-auto bg-card-light shadow-soft dark:bg-card-dark rounded-md
                                 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-transparent">

                        <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-gray-700">
                           <thead class="bg-gray-50 dark:bg-gray-800">
                              <tr>
                                 <th class="px-4 py-2 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300">Fecha</th>
                                 <th class="px-4 py-2 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300">Hora</th>
                                 <th class="px-4 py-2 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300">Paciente</th>
                                 <th class="px-4 py-2 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300">Doctor</th>
                                 <th class="px-4 py-2 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300">Tipo</th>
                                 <th class="px-4 py-2 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300">Estado</th>
                                 <th class="px-4 py-2 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300">Acciones</th>
                              </tr>
                           </thead>
                           <tbody id="tabla-citas" 
                              class="divide-y divide-gray-200 bg-card-light dark:divide-gray-700 dark:bg-card-dark">
                           </tbody>
                        </table>

                        <!-- PAGINACIÓN -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-t border-gray-200 bg-card-light px-4 py-3 dark:border-gray-700 dark:bg-card-dark">
                           <p class="text-sm text-gray-500 dark:text-gray-400">
                              Mostrando <span id="desde"></span> a <span id="hasta"></span> de 
                              <span id="total"></span> resultados
                           </p>

                           <div class="inline-flex items-center gap-2">
                              <button id="prevPage"
                                 class="border border-gray-300 bg-white px-3 py-2 text-sm rounded-md text-gray-500 disabled:opacity-50">
                                 Anterior
                              </button>
                              <button id="nextPage"
                                 class="border border-gray-300 bg-white px-3 py-2 text-sm rounded-md text-gray-500 disabled:opacity-50">
                                 Siguiente
                              </button>
                           </div>
                        </div>

                     </div>
                  </div>
               </main>

            </div>
         </div>
      </div>
      <div id="modalEliminar" 
         class="fixed inset-0 z-[9999] hidden bg-black/50 backdrop-blur-sm items-center justify-center">
         <div class="bg-card-light dark:bg-card-dark p-6 rounded-md shadow-xl w-full max-w-md animate-fadeIn">
            <div class="flex items-center gap-3">
                  <span class="material-symbols-outlined text-red-500 text-4xl">warning</span>
                  <h2 class="text-xl font-bold text-gray-800 dark:text-white">Eliminar Cita</h2>
            </div>
            <p class="mt-4 text-gray-700 dark:text-gray-300">
                  ¿Seguro que deseas eliminar esta cita? Esta acción no se puede deshacer.
            </p>
            <div id="infoCitaEliminar" 
                  class="mt-4 p-4 rounded bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-sm">
            </div>
            <div class="flex justify-end gap-3 pt-6">
                  <button onclick="cerrarModalEliminar()" 
                     class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700
                           dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200">
                     Cancelar
                  </button>
                  <button id="btnConfirmarEliminar" 
                     class="px-4 py-2 bg-red-600 text-white hover:bg-red-700">
                     Eliminar
                  </button>
            </div>
         </div>
      </div>
   </body>
   <script>
      const sidebar = document.getElementById("sidebar");
      const backdrop = document.getElementById("sidebarBackdrop");
      const menuBtn = document.getElementById("menuBtn");

      menuBtn?.addEventListener("click", () => {
         sidebar.classList.toggle("-translate-x-64");
         backdrop.classList.toggle("hidden");
      });

      backdrop?.addEventListener("click", () => {
         sidebar.classList.add("-translate-x-64");
         backdrop.classList.add("hidden");
      });


      let page = 1;
      let limit = 5;

      async function cargarCitas() {
         const paciente = document.getElementById("search-paciente").value;
         const estado = document.getElementById("filter-status").value;
         const doctor = document.getElementById("filter-doctor").value;
         const fecha = document.getElementById("filter-date").value;
         const params = new URLSearchParams({
            action: "getAppointments",
            page,
            limit,
            paciente,
            estado: estado !== "Todos" ? estado.toLowerCase() : "",
            doctor: doctor !== "Todos" ? doctor : "",
            fecha
         });
         const res = await fetch(`index.php?${params.toString()}`);
         const json = await res.json();
         llenarTabla(json.data);
         actualizarPaginacion(json);
      }

      function llenarTabla(citas) {
         const tbody = document.getElementById("tabla-citas");
         tbody.innerHTML = "";
         citas.forEach(c => {
            tbody.innerHTML += `
            <tr>
                  <td class="px-6 py-4">${c.fecha}</td>
                  <td class="px-6 py-4">${c.hora}</td>
                  <td class="px-6 py-4">${c.paciente}</td>
                  <td class="px-6 py-4">${c.doctor}</td>
                  <td class="px-6 py-4">${c.especialidad}</td>
                  <td class="px-6 py-4">
                     <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium 
                        ${getEstadoColor(c.estado)}">
                        ${c.estado}
                     </span>
                  </td>
                  <td class="px-6 py-4">
                     <div class="flex items-center gap-2">
                        <button 
                           class="p-1 text-red-500 hover:text-red-700"
                           data-cita='${JSON.stringify(c)}'
                           onclick="abrirModalEliminar(this.dataset.cita)">
                           <span class="material-symbols-outlined">delete</span>
                        </button>
                        <button class="p-1 text-gray-400 hover:text-secondary">
                              <span class="material-symbols-outlined">edit</span>
                        </button>
                     </div>
                  </td>
            </tr>`;
         });
      }

      function getEstadoColor(estado){
         switch(estado){
            case 'confirmada': return 'bg-green-100 text-green-800';
            case 'realizada':  return 'bg-blue-100 text-blue-800';
            case 'cancelada':  return 'bg-red-100 text-red-800';
            case 'pendiente':  return 'bg-yellow-100 text-yellow-800';
            default: return 'bg-gray-100 text-gray-800';
         }
      }

      function actualizarPaginacion(info){
         document.getElementById("total").innerText = info.total;
         document.getElementById("desde").innerText = (info.page - 1) * info.limit + 1;
         document.getElementById("hasta").innerText = Math.min(info.page * info.limit, info.total);

         document.getElementById("prevPage").disabled = info.page <= 1;
         document.getElementById("nextPage").disabled = info.page >= info.total_pages;
      }

      document.getElementById("prevPage").onclick = () => {
         if (page > 1){ page--; cargarCitas(); }
      };

      document.getElementById("nextPage").onclick = () => {
         page++; cargarCitas();
      };

      document.getElementById("btnFiltrar").onclick = () => {
         page = 1;
         cargarCitas();
      };

      async function loadDoctors() {
         const response = await fetch("index.php?action=getDoctors");
         const doctors = await response.json();
         const select = document.getElementById("filter-doctor");
         select.innerHTML = '<option value="">Todos</option>';
         doctors.forEach(doc => {
            const option = document.createElement("option");
            option.value = doc.id_doctor;
            option.textContent = doc.nombre;
            select.appendChild(option);
         });
      }

      document.addEventListener("DOMContentLoaded", () => {
         loadDoctors();
         cargarCitas();
      });

      let idCitaAEliminar = null;

      function abrirModalEliminar(citaJSON) {
         const cita = JSON.parse(citaJSON);
         idCitaAEliminar = cita.id_cita;

         const info = `
            <p><strong>Fecha:</strong> ${cita.fecha}</p>
            <p><strong>Hora:</strong> ${cita.hora}</p>
            <p><strong>Paciente:</strong> ${cita.paciente}</p>
            <p><strong>Doctor:</strong> ${cita.doctor}</p>
            <p><strong>Especialidad:</strong> ${cita.especialidad}</p>
            <p class="mt-2"><strong>Estado:</strong> ${cita.estado}</p>
         `;

         document.getElementById("infoCitaEliminar").innerHTML = info;

         document.getElementById("modalEliminar").classList.remove("hidden");
         document.getElementById("modalEliminar").classList.add("flex");
      }

      function cerrarModalEliminar() {
         idCitaAEliminar = null;
         document.getElementById("modalEliminar").classList.remove("flex");
         document.getElementById("modalEliminar").classList.add("hidden");
      }

      document.getElementById("btnConfirmarEliminar").onclick = async () => {
         if (!idCitaAEliminar) return;
         const res = await fetch(`index.php?action=deleteAppointment&id=${idCitaAEliminar}`, {
            method: "DELETE"
         });

         const json = await res.json();

         if (json.success) {
            cerrarModalEliminar();
            cargarCitas();
         } else {
            alert("Error al eliminar la cita");
         }
      };

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
</html>
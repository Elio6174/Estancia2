<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="utf-8"/>
      <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
      <title>CliniHub - Usuarios</title>
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
      <div class="relative flex h-auto min-h-screen w-full overflow-x-hidden">
         <div class="flex h-full grow">
            <aside id="sidebar"
               class="fixed left-0 top-0 h-screen w-64 bg-[#111827] text-white shadow-soft
                     transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-50">
               <div class="flex h-full flex-col gap-6 p-4 overflow-y-auto">
                  <div class="flex items-center gap-3 p-2">
                     <span class="material-symbols-outlined text-primary text-3xl">health_and_safety</span>
                     <h1 class="text-xl font-bold text-white">CliniHub</h1>
                  </div>
                  <?php include 'app/view/admin/slidebar/index.php'; ?>
               </div>
            </aside>
            <div id="overlay"
               class="fixed inset-0 bg-black/40 hidden z-40 lg:hidden"
               onclick="closeSidebar()">
            </div>

            <div class="flex-1 lg:ml-64">
               <?php include 'app/view/admin/header/index.php'; ?>
               <main class="flex-1 p-8">
                  <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                     <div class="lg:col-span-2 ">
                        <div class="bg-card-light p-6 shadow-soft dark:bg-card-dark">
                           <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                              <div class="flex flex-col gap-4 lg:flex-row lg:gap-4 w-full">
                                 <div class="relative flex-1">
                                    <label for="search-nombre" class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">
                                       Nombre
                                    </label>
                                    <input id="search-nombre"
                                       class="w-full border border-gray-300 bg-background-light py-2 px-3 transition-all 
                                              focus:border-primary focus:ring-2 focus:ring-primary/50 
                                              dark:border-gray-600 dark:bg-background-dark dark:text-white"
                                       placeholder="Buscar por nombre..."
                                       type="text"/>
                                 </div>
                                 <div class="relative flex-1">
                                    <label for="search-correo" class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">
                                       Correo
                                    </label>
                                    <input id="search-correo"
                                       class="w-full border border-gray-300 bg-background-light py-2 px-3 transition-all 
                                              focus:border-primary focus:ring-2 focus:ring-primary/50 
                                              dark:border-gray-600 dark:bg-background-dark dark:text-white"
                                       placeholder="Buscar por correo..."
                                       type="text"/>
                                 </div>
                                 <div class="flex-1 lg:max-w-[180px]">
                                    <label for="filter-rol" class="block text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">
                                       Rol
                                    </label>
                                    <select id="filter-rol"
                                       class="w-full border border-gray-300 bg-background-light py-2 px-3 text-sm
                                              focus:border-primary focus:ring-2 focus:ring-primary/50
                                              dark:border-gray-600 dark:bg-background-dark dark:text-white">
                                       <option value="">Todos</option>
                                       <option value="paciente">Paciente</option>
                                       <option value="doctor">Doctor</option>
                                       <option value="administrador">Administrador</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="flex justify-end">
                                 <button id="btnFiltrar"
                                    class="flex items-center gap-2 bg-secondary px-4 py-2 text-sm font-semibold text-white 
                                           transition-all hover:bg-orange-500">
                                    <span class="material-symbols-outlined">filter_list</span>
                                    <span>Filtrar</span>
                                 </button>
                              </div>
                           </div>
                           <div class="overflow-x-auto">
                              <table class="w-full text-left">
                                 <thead>
                                    <tr class="border-b border-gray-200 text-sm font-semibold text-gray-500 dark:border-gray-700 dark:text-gray-400">
                                       <th class="px-4 py-3">Nombre</th>
                                       <th class="px-4 py-3">Id</th>
                                       <th class="px-4 py-3">Correo</th>
                                       <th class="px-4 py-3">Rol</th>
                                    </tr>
                                 </thead>
                                 <tbody id="tabla-usuarios" class="divide-y divide-gray-200 dark:divide-gray-700">
                                 </tbody>
                              </table>
                           </div>
                           <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                              <p class="text-sm text-gray-600 dark:text-gray-300">
                                 Mostrando <span id="desde">0</span> a <span id="hasta">0</span> de 
                                 <span id="total">0</span> usuarios
                              </p>
                              <div class="flex items-center gap-2">
                                 <button id="prevPage"
                                    class="px-3 py-2 text-sm border border-gray-300 bg-white text-gray-600 
                                           hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed
                                           dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                    Anterior
                                 </button>
                                 <button id="nextPage"
                                    class="px-3 py-2 text-sm border border-gray-300 bg-white text-gray-600 
                                           hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed
                                           dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                    Siguiente
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="lg:col-span-1">
                        <div class="sticky top-24">
                           <div class="bg-card-light p-6 shadow-soft dark:bg-card-dark">
                              <div class="flex flex-col items-center">
                                 <img id="usuarioFoto"
                                    alt="Avatar de Usuario"
                                    class="h-24 w-24 rounded-full object-cover"
                                    src="https://ui-avatars.com/api/?name=Usuario&background=0D8ABC&color=fff"/>
                                 <h3 id="usuarioNombre" class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">
                                    Selecciona un usuario
                                 </h3>
                                 <p id="usuarioId" class="text-sm text-gray-500 dark:text-gray-400">ID: -</p>
                              </div>
                              <div class="mt-6 border-t border-gray-200 pt-6 dark:border-gray-700">
                                 <h4 class="text-base font-semibold text-gray-700 dark:text-gray-200">Información de Contacto</h4>
                                 <div class="mt-4 space-y-3 text-sm">
                                    <div class="flex items-center gap-3">
                                       <span class="material-symbols-outlined text-gray-400">email</span>
                                       <span id="usuarioCorreo" class="text-gray-600 dark:text-gray-300">-</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                       <span class="material-symbols-outlined text-gray-400">badge</span>
                                       <span id="usuarioRol" class="text-gray-600 dark:text-gray-300">-</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="mt-8 flex flex-col gap-3">
                                 <button id="btnEditarUsuario"
                                    class="flex w-full items-center justify-center gap-2 bg-gray-100 px-4 py-2.5
                                           text-gray-700 hover:bg-gray-200
                                           dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                                    <span class="material-symbols-outlined">edit</span>
                                    <span>Editar Información</span>
                                 </button>
                                 <button id="btnVerExpediente"
                                    class="hidden flex w-full items-center justify-center gap-2 bg-gray-100 px-4 py-2.5
                                          text-gray-700 hover:bg-gray-200
                                          dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                                    <span class="material-symbols-outlined">folder_open</span>
                                    <span>Ver expediente</span>
                                 </button>
                                 <button id="btnEliminarUsuario"
                                    class="flex w-full items-center justify-center gap-2 bg-red-500/10 px-4 py-2.5 text-red-600
                                           hover:bg-red-500/20">
                                    <span class="material-symbols-outlined">delete</span>
                                    <span>Eliminar Usuario</span>
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </main>
            </div>
         </div>
      </div>
      <div id="modalEditar" class="fixed inset-0 z-[9999] hidden bg-black/50 backdrop-blur-sm items-center justify-center">
         <div class="bg-card-light dark:bg-card-dark p-6 rounded-md shadow-xl w-full max-w-lg animate-fadeIn">
            <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Editar Información</h2>
            <form id="formEditar" class="space-y-4">
                  <div>
                     <label class="block text-sm font-semibold">Nombre</label>
                     <input id="editNombre" class="w-full px-3 py-2 border dark:bg-background-dark dark:text-white">
                  </div>
                  <div>
                  <label class="block text-sm font-semibold">Correo</label>
                  <div>
                     <label class="block text-sm font-semibold">Correo</label>
                     <input id="editCorreo" type="email" disabled
                        class="w-full px-3 py-2 border dark:bg-background-dark dark:text-white 
                              cursor-not-allowed bg-gray-200 text-gray-500 border-gray-300"
                     >
                  </div>

                  </div>

                  <div>
                     <label class="block text-sm font-semibold">Rol</label>
                     <select id="editRol" class="w-full px-3 py-2 border dark:bg-background-dark dark:text-white">
                        <option value="paciente">Paciente</option>
                        <option value="doctor">Doctor</option>
                        <option value="administrador">Administrador</option>
                     </select>
                  </div>
                  <div class="flex justify-end gap-3">
                     <button type="button" onclick="cerrarModalEditar()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400">
                        Cancelar
                     </button>
                     <button type="submit" class="px-4 py-2 bg-primary text-white hover:bg-primary-vibrant">
                        Guardar
                     </button>
                  </div>
            </form>
         </div>
      </div>
      <div id="modalEliminar" class="fixed inset-0 z-[9999] hidden bg-black/50 backdrop-blur-sm items-center justify-center">
         <div class="bg-card-light dark:bg-card-dark p-6 rounded-md shadow-xl w-full max-w-md animate-fadeIn">
            <div class="flex items-center gap-3">
                  <span class="material-symbols-outlined text-red-500 text-4xl">warning</span>
                  <h2 class="text-xl font-bold text-gray-800 dark:text-white">Confirmar Eliminación</h2>
            </div>
            <p id="mensajeEliminar" class="mt-4 text-gray-700 dark:text-gray-300">
                  ¿Estás seguro de que deseas eliminar este usuario?
            </p>
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
      <script>
      let page = 1;
      const limit = 5;

      let usuarioSeleccionado = null;
      let filaSeleccionada = null;
      let idAEliminar = null;
      const claseNormalFila = "cursor-pointer transition-all hover:bg-gray-50 dark:hover:bg-gray-800/50";
      const claseFilaSeleccionada = claseNormalFila + " bg-primary/10 dark:bg-primary/20";

      function getRolBadgeClasses(rol){
         switch(rol){
            case 'paciente': 
               return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
            case 'doctor':
               return 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
            case 'administrador':
               return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
            default:
               return 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
         }
      }

      async function cargarUsuarios(){
         const nombre = document.getElementById("search-nombre").value.trim();
         const correo = document.getElementById("search-correo").value.trim();
         const rol    = document.getElementById("filter-rol").value;

         const params = new URLSearchParams({
            action: "getUsers",
            page,
            limit,
            nombre,
            correo,
            rol
         });

         const res = await fetch(`index.php?${params.toString()}`);
         const json = await res.json();

         llenarTabla(json.data || []);
         actualizarPaginacion(json);
      }

      function llenarTabla(usuarios){
         const tbody = document.getElementById("tabla-usuarios");
         tbody.innerHTML = "";
         filaSeleccionada = null;
         usuarioSeleccionado = null;
         limpiarPanelUsuario();

         usuarios.forEach(u => {
            const tr = document.createElement("tr");
            tr.className = claseNormalFila;

            const rolBadge = getRolBadgeClasses(u.rol);

            tr.innerHTML = `
               <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-200">${u.nombre}</td>
               <td class="px-4 py-3 text-gray-600 dark:text-gray-300">U${u.id_usuario}</td>
               <td class="px-4 py-3 text-gray-600 dark:text-gray-300">${u.correo}</td>
               <td class="px-4 py-3">
                  <span class="rounded-full px-2 py-1 text-xs font-semibold ${rolBadge}">
                     ${u.rol.charAt(0).toUpperCase() + u.rol.slice(1)}
                  </span>
               </td>
            `;

            tr.addEventListener("click", () => seleccionarUsuario(u, tr));
            tbody.appendChild(tr);
         });

         if (usuarios.length > 0){
            const firstRow = tbody.querySelector("tr");
            seleccionarUsuario(usuarios[0], firstRow);
         }
      }

      function actualizarPaginacion(info){
         const total = info.total || 0;
         const currentPage = info.page || 1;
         const perPage = info.limit || limit;

         document.getElementById("total").innerText = total;
         if (total === 0){
            document.getElementById("desde").innerText = 0;
            document.getElementById("hasta").innerText = 0;
         } else {
            document.getElementById("desde").innerText = (currentPage - 1) * perPage + 1;
            document.getElementById("hasta").innerText = Math.min(currentPage * perPage, total);
         }

         document.getElementById("prevPage").disabled = currentPage <= 1;
         document.getElementById("nextPage").disabled = currentPage >= (info.total_pages || 1);
      }

      function seleccionarUsuario(usuario, fila){
         usuarioSeleccionado = usuario;
         if (filaSeleccionada){
            filaSeleccionada.className = claseNormalFila;
         }
         fila.className = claseFilaSeleccionada;
         filaSeleccionada = fila;
         document.getElementById("usuarioNombre").innerText = usuario.nombre;
         document.getElementById("usuarioId").innerText = `ID: U${usuario.id_usuario}`;
         document.getElementById("usuarioCorreo").innerText = usuario.correo;
         document.getElementById("usuarioRol").innerText = usuario.rol.charAt(0).toUpperCase() + usuario.rol.slice(1);
         const avatarUrl = `https://ui-avatars.com/api/?name=${encodeURIComponent(usuario.nombre)}&background=0D8ABC&color=fff`;
         document.getElementById("usuarioFoto").src = avatarUrl;
         const btnExpediente = document.getElementById("btnVerExpediente");
         if (usuario.rol === "paciente") {
            btnExpediente.classList.remove("hidden");
         } else {
            btnExpediente.classList.add("hidden");
         }
      }


      function limpiarPanelUsuario(){
         document.getElementById("usuarioNombre").innerText = "Selecciona un usuario";
         document.getElementById("usuarioId").innerText = "ID: -";
         document.getElementById("usuarioCorreo").innerText = "-";
         document.getElementById("usuarioRol").innerText = "-";
         document.getElementById("usuarioFoto").src = "https://ui-avatars.com/api/?name=Usuario&background=0D8ABC&color=fff";
      }

      function abrirModalEditar(){
         if (!usuarioSeleccionado){
            alert("Selecciona un usuario primero");
            return;
         }

         document.getElementById("editNombre").value = usuarioSeleccionado.nombre;
         document.getElementById("editCorreo").value = usuarioSeleccionado.correo;
         document.getElementById("editRol").value    = usuarioSeleccionado.rol;

         const modal = document.getElementById("modalEditar");
         modal.classList.remove("hidden");
         modal.classList.add("flex");
      }

      function cerrarModalEditar(){
         const modal = document.getElementById("modalEditar");
         modal.classList.add("hidden");
         modal.classList.remove("flex");
      }

      document.getElementById("formEditar").addEventListener("submit", async function(e){
         e.preventDefault();
         if (!usuarioSeleccionado) return;

         const formData = new FormData();
         formData.append("id_usuario", usuarioSeleccionado.id_usuario);
         formData.append("nombre", document.getElementById("editNombre").value.trim());
         formData.append("correo", document.getElementById("editCorreo").value.trim());
         formData.append("rol", document.getElementById("editRol").value);

         const res = await fetch("index.php?action=updateUser", {
            method: "POST",
            body: formData
         });

         const data = await res.json();
         if (data.status === "success"){
            cerrarModalEditar();
            cargarUsuarios();
         } else {
            alert("Error al actualizar: " + (data.message || "Desconocido"));
         }
      });

      function abrirModalEliminar(){
         if (!usuarioSeleccionado){
            alert("Selecciona un usuario primero");
            return;
         }

         idAEliminar = usuarioSeleccionado.id_usuario;

         const mensaje = `¿Estás seguro de que deseas eliminar a 
            <strong>${usuarioSeleccionado.nombre}</strong> (ID: U${usuarioSeleccionado.id_usuario})?`;

         document.getElementById("mensajeEliminar").innerHTML = mensaje;

         const modal = document.getElementById("modalEliminar");
         modal.classList.remove("hidden");
         modal.classList.add("flex");
      }

      function cerrarModalEliminar(){
         const modal = document.getElementById("modalEliminar");
         modal.classList.add("hidden");
         modal.classList.remove("flex");
         idAEliminar = null;
      }

      document.getElementById("btnConfirmarEliminar").addEventListener("click", async function(){
         if (!idAEliminar){
            alert("Error: No se recibió ID del usuario.");
            return;
         }

         const formData = new FormData();
         formData.append("id", idAEliminar);

         try {
            const res = await fetch("index.php?action=deleteUser", {
               method: "POST",
               body: formData
            });

            const data = await res.json();

            if (data.status === "success"){
               cerrarModalEliminar();
               cargarUsuarios();
            } else {
               alert("Error: " + (data.message || "No se pudo eliminar"));
            }
         } catch (err){
            console.error(err);
            alert("Error en la comunicación con el servidor.");
            cerrarModalEliminar();
         }
      });

      document.getElementById("prevPage").addEventListener("click", () => {
         if (page > 1){
            page--;
            cargarUsuarios();
         }
      });

      document.getElementById("nextPage").addEventListener("click", () => {
         page++;
         cargarUsuarios();
      });

      document.getElementById("btnFiltrar").addEventListener("click", () => {
         page = 1;
         cargarUsuarios();
      });

      document.getElementById("btnEditarUsuario").addEventListener("click", abrirModalEditar);
      document.getElementById("btnEliminarUsuario").addEventListener("click", abrirModalEliminar);

      ["search-nombre", "search-correo"].forEach(id => {
         document.getElementById(id).addEventListener("keyup", e => {
            if (e.key === "Enter"){
               page = 1;
               cargarUsuarios();
            }
         });
      });

      document.addEventListener("DOMContentLoaded", () => {
         cargarUsuarios();
      });

      document.getElementById("btnVerExpediente").addEventListener("click", () => {
         if (!usuarioSeleccionado) return;
         if (usuarioSeleccionado.rol !== "paciente") return;
         const id = usuarioSeleccionado.id_usuario;
         window.location.href = `index.php?view=Expediente&id=${id}`;
      });

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

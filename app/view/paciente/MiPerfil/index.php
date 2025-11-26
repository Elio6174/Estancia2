<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>CliniHub - Mi Perfil</title>
  <link href="data:image/x-icon;base64," rel="icon" type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCH2VVRjXBU2d2Svff6D7jqNyZcIGHJfEU&libraries=places" async defer></script>
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
    $id = $_SESSION['id_usuario'];
    $error = $_SESSION['code'] ?? null;
    unset($_SESSION['code']);
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
            <div 
              id="sidebarAvatar"
              class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12"
              style='background-image: url("<?php echo htmlspecialchars($_SESSION['foto_url'] ?? "http://else.mx/uploads/usuarios/12225881.png"); ?>");'>
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
        <a class="flex items-center gap-3 px-4 py-3 bg-primary/20 text-primary font-bold rounded-lg" 
        href="index.php?view=MiPerfil">
            <span class="material-symbols-outlined">person</span>
            <span>Mi Perfil</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 hover:bg-primary/10 text-text-dark/90 rounded-lg" 
        href="index.php?view=AgendarCita">
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
    <main class="flex-1 p-4 md:p-8 md:ml-64 overflow-y-auto">
      <div class="max-w-4xl mx-auto">
        <header class="mb-6 md:mb-8 flex items-center justify-between">
          <button @click="sidebarOpen = true" class="md:hidden text-text-light dark:text-text-dark">
            <span class="material-symbols-outlined text-3xl">menu</span>
          </button>
          <h2 class="text-3xl md:text-4xl font-bold text-text-light dark:text-text-dark flex-1 text-center md:text-left">Mi Perfil</h2>
        </header>
        <div class="bg-surface-light dark:bg-surface-dark p-6 md:p-8 shadow-sm rounded-lg">
                <div class="space-y-8">
                <div>
                    <div class="flex items-center justify-between mb-6 border-b border-border-light dark:border-border-dark pb-3">
                      <h3 class="text-xl font-bold text-text-light dark:text-text-dark">
                        Información Personal
                      </h3>

                      <span 
                        class="material-symbols-outlined !text-2xl align-middle animate-bubble 
                        <?php 
                          if (!empty($error) && $error === 'success') {
                            echo 'text-success';
                          } else {
                            echo 'text-gray-400 dark:text-gray-500';
                          }
                        ?>">
                        cloud_done
                      </span>

                      <style>
                      @keyframes bubble {
                        0%, 100% {
                          transform: translateY(0);
                        }
                        50% {
                          transform: translateY(-6px) scale(1.1);
                        }
                      }

                      .animate-bubble {
                        animation: bubble 1.8s ease-in-out infinite;
                      }
                      </style>
                    </div>
                    <div class="flex flex-col items-center md:items-start gap-6 mb-6">
                      <div class="relative group w-28 h-28">
                        <img
                          id="profilePreview"
                          src="<?php echo !empty($data['foto_url']) ? $data['foto_url'] : 'http://else.mx/uploads/usuarios/12225881.png'; ?>"
                          alt="Foto de perfil"
                          class="w-28 h-28 rounded-full object-cover border-4 border-white dark:border-surface-dark shadow-md transition-all duration-300 group-hover:opacity-80"
                        />
                        <form id="formUpload" method="POST" enctype="multipart/form-data" action="index.php?action=uploadImage">
                          <input type="file" id="profile_pic" name="imagen" accept="image/*" class="hidden" onchange="previewAndUpload(event)">
                          <label for="profile_pic"
                            class="absolute bottom-1 right-1 bg-primary text-white p-2 rounded-full shadow-lg cursor-pointer hover:bg-primary/90 transition-all duration-200">
                            <span class="material-symbols-outlined text-base">photo_camera</span>
                          </label>
                        </form>
                        <div id="uploadSpinner"
                          class="absolute inset-0 bg-black/40 flex items-center justify-center rounded-full hidden">
                          <span class="material-symbols-outlined text-white animate-spin">progress_activity</span>
                        </div>
                      </div>
                    <form id="userData" action="index.php?action=UpdateData" method="POST">
                    <input type="hidden" name="idUser" <?php echo 'value="'.$id.'"'?>>
                    <div class="text-center md:text-left">
                        <p class="text-lg font-semibold"><?php echo $data['nombreApellido']?></p>
                        <p class="text-sm text-text-light/70 dark:text-text-dark/70"><?php echo $data['correo']?></p>
                    </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label
                          class="block text-sm font-medium text-text-light/80 dark:text-text-dark/80 mb-1"
                          for="fullName"
                        >Nombre Completo</label>
                        <input
                          class="w-full bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark rounded-md shadow-sm focus:ring-primary focus:border-primary"
                          id="fullName"
                          name="nombre"
                          type="text"
                        <?php echo 'value="'.$data['nombre'].'"'?>
                        />
                    </div>
                    <div>
                        <label
                          class="block text-sm font-medium text-text-light/80 dark:text-text-dark/80 mb-1"
                          for="email"
                        >Correo Electrónico</label>
                        <input
                          class="w-full bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark rounded-md shadow-sm focus:ring-primary focus:border-primary"
                          id="email"
                          name="email"
                          type="email"
                        <?php echo 'value="'.$data['correo'].'"'?> disabled
                        />
                    </div>
                    <div>
                        <label
                          class="block text-sm font-medium text-text-light/80 dark:text-text-dark/80 mb-1"
                          for="phone"
                        >Teléfono</label>
                        <input
                          class="w-full bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark rounded-md shadow-sm focus:ring-primary focus:border-primary"
                          id="phone"
                          name="phone"
                          type="number"
                        <?php echo 'value="'.$data['telefono'].'"'?>
                        />
                    </div>
                    <div>
                        <label
                          class="block text-sm font-medium text-text-light/80 dark:text-text-dark/80 mb-1"
                          for="birthdate"
                        >Fecha de Nacimiento</label>
                        <input
                          class="w-full bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark rounded-md shadow-sm focus:ring-primary focus:border-primary"
                          id="birthdate"
                          name="birthdate"
                          type="date"
                        <?php echo 'value="' . (!empty($data['fecha_nacimiento']) ? $data['fecha_nacimiento'] : '') . '"'; ?>
                        />
                    </div>
                    <div>
                        <label
                          class="block text-sm font-medium text-text-light/80 dark:text-text-dark/80 mb-1"
                          for="sex"
                        >Sexo</label>
                        <select
                        class="w-full bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark rounded-md shadow-sm focus:ring-primary focus:border-primary"
                        id="sex"
                        name="sexo"
                        >
                        <option value="" <?php echo (empty($data['sexo'])) ? 'selected' : ''; ?>>Selecciona una opción</option>
                        <option <?php echo (!empty($data['sexo']) && $data['sexo'] === 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
                        <option <?php echo (!empty($data['sexo']) && $data['sexo'] === 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                        <option <?php echo (!empty($data['sexo']) && $data['sexo'] === 'Prefiero no decir') ? 'selected' : ''; ?>>Prefiero no decir</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <div class="relative">
                          <input
                            id="address"
                            name="address"
                            type="text"
                            placeholder="Escribe tu dirección..."
                            class="w-full bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark rounded-md shadow-sm focus:ring-primary focus:border-primary pl-10"
                            <?php echo 'value="'.$data['direccion'].'"'?>
                          />
                          <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-light/50 dark:text-text-dark/50">
                            location_on
                          </span>
                        </div>

                    </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-6 text-text-light dark:text-text-dark border-b border-border-light dark:border-border-dark pb-3">
                    Detalles Médicos
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label
                        class="block text-sm font-medium text-text-light/80 dark:text-text-dark/80 mb-1"
                        for="bloodType"
                        >Tipo de Sangre</label>
                        <select
                        class="w-full bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark rounded-md shadow-sm focus:ring-primary focus:border-primary"
                        id="bloodType"
                        name="bloodType"
                        >
                        <option value="" <?php echo (empty($data['tipo_sangre'])) ? 'selected' : ''; ?>>Selecciona una opción</option>
                        <option value="1" <?php echo (($data['tipo_sangre'] ?? '') === 'O+') ? 'selected' : ''; ?>>O+</option>
                        <option value="2" <?php echo (($data['tipo_sangre'] ?? '') === 'O-') ? 'selected' : ''; ?>>O-</option>
                        <option value="3" <?php echo (($data['tipo_sangre'] ?? '') === 'A+') ? 'selected' : ''; ?>>A+</option>
                        <option value="4" <?php echo (($data['tipo_sangre'] ?? '') === 'A-') ? 'selected' : ''; ?>>A-</option>
                        <option value="5" <?php echo (($data['tipo_sangre'] ?? '') === 'B+') ? 'selected' : ''; ?>>B+</option>
                        <option value="6" <?php echo (($data['tipo_sangre'] ?? '') === 'B-') ? 'selected' : ''; ?>>B-</option>
                        <option value="7" <?php echo (($data['tipo_sangre'] ?? '') === 'AB+') ? 'selected' : ''; ?>>AB+</option>
                        <option value="8" <?php echo (($data['tipo_sangre'] ?? '') === 'AB-') ? 'selected' : ''; ?>>AB-</option>
                        </select>
                    </div>

                    <div>
                        <label
                        class="block text-sm font-medium text-text-light/80 dark:text-text-dark/80 mb-1"
                        for="allergies"
                        >Alergias Conocidas</label>
                        <input
                        class="w-full bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark rounded-md shadow-sm focus:ring-primary focus:border-primary"
                        id="allergies"
                        type="text"
                        value="Penicilina, Nueces"
                        />
                    </div>

                    <div class="md:col-span-2">
                        <label
                        class="block text-sm font-medium text-text-light/80 dark:text-text-dark/80 mb-1"
                        for="medications"
                        >Medicamentos Actuales</label>
                        <textarea
                        class="w-full bg-background-light dark:bg-background-dark border-border-light dark:border-border-dark rounded-md shadow-sm focus:ring-primary focus:border-primary"
                        id="medications"
                        rows="3"
                        >Loratadina 10mg (diario)</textarea>
                    </div>
                    </div>
                </div>
                </div>
                    </form>
                <div class="mt-10 flex flex-col md:flex-row justify-end gap-4">
                <button
                    class="w-full md:w-auto bg-primary text-white font-bold py-3 px-6 hover:opacity-90 transition-opacity rounded-lg"
                    type="submit"
                    form="userData"
                >
                    Guardar Cambios
                </button>
                </div>
        </div>
      </div>
    </main>
  </div>
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const input = document.getElementById('address');

  if (!input) return;
  const autocomplete = new google.maps.places.Autocomplete(input, {
    fields: ['formatted_address', 'geometry', 'name'],
    types: ['geocode'], 
    componentRestrictions: { country: "mx" } 
  });

  autocomplete.addListener('place_changed', function() {
    const place = autocomplete.getPlace();
    console.log('Lugar seleccionado:', place);

    if (place.formatted_address) {
      input.value = place.formatted_address;
    }
  });
});

async function previewAndUpload(event) {
  const file = event.target.files[0];
  if (!file) return;

  const preview = document.getElementById('profilePreview');
  const spinner = document.getElementById('uploadSpinner');
  const sidebarAvatar = document.getElementById('sidebarAvatar');

  preview.src = URL.createObjectURL(file);
  spinner.classList.remove('hidden');

  const formData = new FormData(document.getElementById('formUpload'));

  try {
    const res = await fetch('index.php?action=uploadImage', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();

    if (data.url) {
      const nuevaUrl = data.url + '?v=' + new Date().getTime();
      preview.src = nuevaUrl;

      if (sidebarAvatar) {
        sidebarAvatar.style.backgroundImage = `url("${nuevaUrl}")`;
      }

      await fetch('index.php?action=setSessionPhoto', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ foto_url: data.url })
      });
    } else {
      alert(data.error || "Error al subir la imagen");
    }
  } catch (err) {
    alert("Error al conectar con el servidor");
  } finally {
    spinner.classList.add('hidden');
  }
}
</script>
</html>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>CliniHub - Mi Perfil</title>
        <link href="data:image/x-icon;base64," rel="icon" type="image/x-icon"/>
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect"/>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                        fontFamily: {
                            "display": ["Inter", "sans-serif"]
                        },
                        borderRadius: {
                            "DEFAULT": "0rem",
                            "lg": "0rem",
                            "xl": "0rem",
                            "full": "9999px"
                        },
                    },
                },
            }
        </script>
        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 20;
            }
            .window {
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            #mobile-menu-toggle:checked~#mobile-menu-overlay {
                display: block;
            }
            #mobile-menu-toggle:checked~#mobile-menu {
                transform: translateX(0);
            }
            #mobile-menu-toggle:checked~main {
                overflow: hidden;
                height: 100vh;
            }
        </style>
    </head>
    <body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
        <div class="flex min-h-screen relative">
            <input class="hidden" id="mobile-menu-toggle" type="checkbox"/>
            <aside
            class="fixed top-0 left-0 h-screen w-64 bg-[#0d1b2a] text-white p-4 flex flex-col justify-between 
                    z-40 transition-transform duration-300 ease-in-out 
                    transform -translate-x-full lg:translate-x-0 overflow-y-auto"
            id="mobile-menu"
            >
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
                <a class="flex items-center gap-3 h-12 px-3 bg-primary/20 text-primary rounded"
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
                <a class="flex items-center gap-3 h-12 px-3 hover:bg-red-500/10 text-red-500 rounded" 
                href="index.php?action=logout">
                <span class="material-symbols-outlined">logout</span>
                <span>Cerrar Sesión</span>
                </a>
            </div>
            </aside>
            <label class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden" for="mobile-menu-toggle" id="mobile-menu-overlay"></label>
            <main class="flex-1 p-4 md:p-6 lg:p-8 flex flex-col gap-6 w-full transition-all duration-300 lg:ml-64">

                <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <label class="lg:hidden cursor-pointer" for="mobile-menu-toggle">
                            <span class="material-symbols-outlined text-2xl">menu</span>
                        </label>
                        <div>
                            <h1 class="text-3xl font-bold">Mi Perfil</h1>
                            <p class="text-text-light/60 dark:text-text-dark/60">Actualiza tu información personal y profesional.</p>
                        </div>
                    </div>
                </header>
                <div 
                    id="profileForm"
                    x-data="{
                        getSpecialties: [],
                        nombre: '<?php echo $data['nombre']; ?>',
                        especialidad: '<?php echo $data['id_especialidad']; ?>',
                        birthdate: '<?php echo $data['fecha_nacimiento']; ?>',
                        phone: '<?php echo $data['telefono']; ?>',
                        address: '<?php echo $data['direccion']; ?>',
                        consultorio: '<?php echo $data['consultorio']; ?>',
                        cedula: '<?php echo $data['cedula_profesional']; ?>',
                        sexo: '<?php echo $data['sexo']; ?>',
                        formCompleto() {
                            return (
                                this.nombre.trim() !== '' &&
                                this.especialidad.trim() !== '' &&
                                this.birthdate.trim() !== '' &&
                                this.phone.trim() !== '' &&
                                this.address.trim() !== '' &&
                                this.consultorio.trim() !== '' &&
                                this.cedula.trim() !== '' &&
                                this.sexo.trim() !== ''
                            );
                        }
                    }"
                >
                    <div class="window bg-surface-light dark:bg-surface-dark flex-1 flex flex-col">
                        <div class="p-4 md:p-6 lg:p-8 flex-1">
                            <div class="flex flex-col md:flex-row gap-8 items-start">
                                <div class="flex flex-col items-center gap-4 w-full md:w-56 flex-shrink-0">
                                    <div class="relative">
                                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-32" style='background-image: url("https://thumbs.dreamstime.com/b/vector-de-perfil-avatar-predeterminado-foto-usuario-medios-sociales-icono-183042379.jpg");'></div>
                                    </div>
                                    <div class="text-center">
                                        <h2 class="text-2xl font-bold">Dr. <?php echo $data['nombre']?></h2>
                                        <p class="text-text-light/60 dark:text-text-dark/60"><?php echo $data['especialidad']?></p>
                                    </div>
                                </div>
                                <div class="w-full flex-1">
                                    <form 
                                        class="space-y-6"
                                        action="index.php?action=UpdateData"
                                        id="updateProfileForm"
                                        method="POST"
                                    >

                                        <input type="hidden" name="idUser" <?php echo 'value="'.$_SESSION['id_usuario'].'"'?>/>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                            <div>
                                                <label class="font-medium text-sm" for="full-name">Nombre Completo</label>
                                                <input 
                                                    class="mt-1 block w-full bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded h-10 px-3" 
                                                    id="full-name" 
                                                    type="text" 
                                                    name="nombre"
                                                    x-model="nombre"
                                                    <?php echo 'value="'.$data['nombre'].'"'?>
                                                />
                                            </div>
                                            <div>
                                                <label class="font-medium text-sm" for="email">Correo Electrónico</label>
                                                <input 
                                                    class="mt-1 block w-full bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded h-10 px-3" 
                                                    id="email" 
                                                    type="email" 
                                                    <?php echo 'value="'.$data['correo'].'"'?>
                                                />
                                            </div>
                                            <div>
                                                <label class="font-medium text-sm" for="specialty">Especialidad</label>
                                                <select 
                                                    id="specialty"
                                                    name="especialidad"
                                                    x-model="especialidad"
                                                    class="mt-1 block w-full bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded h-10 px-3"
                                                >
                                                    <option value="">Seleccionar especialidad</option>
                                                    <option value="2" <?= ($data['especialidad'] == "Cardiología") ? "selected" : "" ?>> Cardiología</option>
                                                    <option value="1" <?= ($data['especialidad'] == "Consulta General") ? "selected" : "" ?>> Consulta General</option>
                                                    <option value="3" <?= ($data['especialidad'] == "Dermatología") ? "selected" : "" ?>> Dermatología</option>
                                                    <option value="4" <?= ($data['especialidad'] == "Pediatría") ? "selected" : "" ?>>Pediatría</option>
                                                </select>




                                            </div>
                                            <div>
                                                <label class="font-medium text-sm" for="dob">Fecha de Nacimiento</label>
                                                <input 
                                                    class="mt-1 block w-full bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded h-10 px-3" 
                                                    id="dob" 
                                                    type="date" 
                                                    name="birthdate"
                                                    x-model="birthdate"
                                                    <?php echo 'value="'.$data['fecha_nacimiento'].'"'?>
                                                />
                                            </div>
                                            <div>
                                                <label class="font-medium text-sm" for="phone">Número de Teléfono</label>
                                                <input 
                                                    class="mt-1 block w-full bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded h-10 px-3" 
                                                    id="phone" 
                                                    name="phone"
                                                    type="tel" 
                                                    x-model="phone"
                                                    <?php echo 'value="'.$data['telefono'].'"'?>
                                                />
                                            </div>
                                            <div>
                                                <label class="font-medium text-sm" for="address">Dirección</label>
                                                <div class="relative">
                                                <input 
                                                    id="address"
                                                    name="address"
                                                    type="text"
                                                    x-model="address"
                                                    placeholder="Escribe tu dirección..."
                                                    class="mt-1 block w-full bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded h-10 pl-10 pr-3 focus:ring-primary focus:border-primary"
                                                    <?php echo 'value="'.$data['direccion'].'"'?>
                                                />
                                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-light/50 dark:text-text-dark/50">
                                                    location_on
                                                </span>
                                                <input type="hidden" id="lat" name="lat" />
                                                <input type="hidden" id="lng" name="lng" />
                                                </div>
                                            </div>
                                            <div>
                                                <label class="font-medium text-sm" for="consultorio">Consultorio</label>
                                                <input 
                                                    class="mt-1 block w-full bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded h-10 px-3" 
                                                    id="consultorio" 
                                                    name="consultorio"
                                                    type="text" 
                                                    x-model="consultorio"
                                                    <?php echo 'value="'.$data['consultorio'].'"'?>
                                                />
                                            </div>
                                            <div>
                                                <label class="font-medium text-sm" for="cedula">Cedula Profesional</label>
                                                <input 
                                                    class="mt-1 block w-full bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded h-10 px-3" 
                                                    id="cedula" 
                                                    name="cedula"
                                                    type="text" 
                                                    x-model="cedula"
                                                    <?php echo 'value="'.$data['cedula_profesional'].'"'?>
                                                />
                                            </div>
                                            <div>
                                                <label
                                                class="font-medium text-sm"
                                                for="sex"
                                                >Sexo</label>
                                                <select
                                                    class="mt-1 block w-full bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded h-10 px-3"
                                                    id="sex"
                                                    name="sexo"
                                                    x-model="sexo"
                                                >
                                                    <option value="" <?php echo (empty($data['sexo'])) ? 'selected' : ''; ?>>Selecciona una opción</option>
                                                    <option value="Femenino" <?php echo (!empty($data['sexo']) && $data['sexo'] === 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
                                                    <option value="Masculino" <?php echo (!empty($data['sexo']) && $data['sexo'] === 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                                                    <option value="Prefiero no decir" <?php echo (!empty($data['sexo']) && $data['sexo'] === 'Prefiero no decir') ? 'selected' : ''; ?>>Prefiero no decir</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="border-t border-border-light dark:border-border-dark p-4 md:p-6 flex flex-col sm:flex-row justify-end items-center gap-3">
                                            <button class="w-full sm:w-auto flex items-center justify-center gap-2 h-10 px-4 bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded hover:bg-primary-subtle dark:hover:bg-primary/10">
                                                <span class="material-symbols-outlined">lock</span>
                                                <span>Cambiar Contraseña</span>
                                            </button>
                                            <button 
                                                type="submit"
                                                form="updateProfileForm"
                                                class="w-full sm:w-auto flex items-center justify-center gap-2 h-10 px-6 rounded transition-colors"
                                                :class="formCompleto() 
                                                    ? 'bg-primary text-white hover:bg-primary/90 cursor-pointer' 
                                                    : 'bg-gray-300 text-gray-500 cursor-not-allowed'"
                                                :disabled="!formCompleto()"
                                            >
                                                <span class="material-symbols-outlined">save</span>
                                                <span>Guardar Cambios</span>
                                            </button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>

    <script>
document.addEventListener("alpine:initialized", () => {
    const el = document.getElementById("profileForm");
    if (el && Alpine.$data(el)) {
        const app = (window.profileForm = Alpine.$data(el));
        fetch(`index.php?action=getSpecialties`)
            .then(res => res.json())
            .then(getSpecialties => {
                app.getSpecialties = getSpecialties.map(e => ({
                    ...e,
                    id_especialidad: String(e.id_especialidad)
                }));
            })
            .catch(err => console.error("Error al obtener las especialidades:", err));
    }
});


        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('address');
            if (!input || !window.google || !google.maps) return;

            const autocomplete = new google.maps.places.Autocomplete(input, {
                fields: ['formatted_address', 'geometry', 'name'],
                types: ['geocode'],
                componentRestrictions: { country: "mx" }
            });

            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                if (!place.formatted_address) return;

                input.value = place.formatted_address;

                if (window.profileForm) {
                window.profileForm.address = place.formatted_address;
                }

                if (place.geometry && place.geometry.location) {
                const lat = place.geometry.location.lat();
                const lng = place.geometry.location.lng();
                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;
                }
            });
        });
    </script>
</html>
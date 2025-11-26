<!DOCTYPE html>
<html lang="es"><head>
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
        #mobile-menu-toggle:checked ~ #mobile-menu-overlay {
            display: block;
        }
        #mobile-menu-toggle:checked ~ #mobile-menu {
            transform: translateX(0);
        }
        #mobile-menu-toggle:checked ~ main {
            overflow: hidden;
            height: 100vh;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
<div class="flex min-h-screen relative">
<input class="hidden" id="mobile-menu-toggle" type="checkbox"/>
<aside class="fixed inset-y-0 left-0 w-64 bg-[#0d1b2a] text-white p-4 flex flex-col justify-between z-40 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:relative lg:flex" id="mobile-menu">
<div>
<div class="flex items-center gap-4 mb-8 p-2">
<div class="bg-primary/20 p-2 rounded-full">
<span class="material-symbols-outlined text-primary !text-2xl">health_and_safety</span>
</div>
<span class="font-bold text-xl">Clínica Bienestar</span>
</div>
<nav class="flex flex-col gap-2">
<a class="flex items-center gap-3 h-12 px-3 hover:bg-primary/10 text-text-dark/90 rounded" href="#">
<span class="material-symbols-outlined">dashboard</span>
<span>Dashboard</span>
</a>
<a class="flex items-center gap-3 h-12 px-3 hover:bg-primary/10 text-text-dark/90 rounded" href="#">
<span class="material-symbols-outlined">calendar_month</span>
<span>Agenda</span>
</a>
<a class="flex items-center gap-3 h-12 px-3 bg-primary/20 text-primary rounded" href="#">
<span class="material-symbols-outlined">groups</span>
<span>Mis Pacientes</span>
</a>
<a class="flex items-center gap-3 h-12 px-3 hover:bg-primary/10 text-text-dark/90 rounded" href="#">
<span class="material-symbols-outlined">chat</span>
<span>Mensajes</span>
</a>
<a class="flex items-center gap-3 h-12 px-3 hover:bg-primary/10 text-text-dark/90 rounded" href="#">
<span class="material-symbols-outlined">science</span>
<span>Resultados</span>
</a>
<a class="flex items-center gap-3 h-12 px-3 hover:bg-primary/10 text-text-dark/90 rounded" href="#">
<span class="material-symbols-outlined">description</span>
<span>Notas</span>
</a>
</nav>
</div>
<div class="flex flex-col gap-2">
<div class="flex items-center gap-3 p-2">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCUexV-rdlrinY8S-2_Xg9qTQX7s2Pn7Y3IY31a85C4QHz5xlH4aiRSyEu4D5TWt6l6OzLbLMSay0mcwXFtGTaX38-ZYK_hZmkio-UCMKHOhSaDqZYKYuAmbDqAobEZTlw1Ykco_kF45fFUUS59f7_-dZD3eu5QKO8HNTU4h0Bh5oVBR7NBZVxiiHifAHlWds6hC4Kwipkwx3rFp9uIBcQ_rh9rn333TUybgbWvwhHyxflsh1JzpMFB471rN0JSI6F2mgkFVbnqhpMS");'></div>
<div class="flex flex-col">
<span class="font-semibold text-sm">Dr. Carlos Akle</span>
<span class="text-xs text-text-dark/70">Cardiólogo</span>
</div>
</div>
<a class="flex items-center gap-3 h-12 px-3 hover:bg-red-500/10 text-red-500 rounded" href="#">
<span class="material-symbols-outlined">logout</span>
<span>Cerrar Sesión</span>
</a>
</div>
</aside>
<label class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden" for="mobile-menu-toggle" id="mobile-menu-overlay"></label>
<main class="flex-1 p-4 md:p-6 lg:p-8 flex flex-col gap-6 w-full lg:w-auto">
<header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
<div class="flex items-center gap-4 w-full md:w-auto">
<label class="lg:hidden cursor-pointer" for="mobile-menu-toggle">
<span class="material-symbols-outlined text-2xl">menu</span>
</label>
<div>
<h1 class="text-3xl font-bold">Mis Pacientes</h1>
<p class="text-text-light/60 dark:text-text-dark/60">Lista de pacientes asignados y su información.</p>
</div>
</div>
<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full md:w-auto">
<div class="relative flex-1">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-light/50 dark:text-text-dark/50">search</span>
<input class="bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded h-10 pl-10 pr-4 w-full" placeholder="Buscar paciente..." type="text"/>
</div>
<button class="flex items-center justify-center gap-2 h-10 px-4 bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark rounded">
<span class="material-symbols-outlined">filter_list</span>
<span>Filtrar</span>
</button>
</div>
</header>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 flex-1">
<div class="lg:col-span-2 flex flex-col gap-6">
<div class="window bg-surface-light dark:bg-surface-dark flex-1 flex flex-col">
<div class="border-b border-border-light dark:border-border-dark p-3">
<h2 class="text-lg font-bold">Lista de Pacientes</h2>
</div>
<div class="flex-1 overflow-y-auto">
<table class="w-full text-left hidden md:table">
<thead class="sticky top-0 bg-surface-light dark:bg-surface-dark border-b border-border-light dark:border-border-dark">
<tr>
<th class="p-3 font-semibold">Nombre del Paciente</th>
<th class="p-3 font-semibold">ID Paciente</th>
<th class="p-3 font-semibold">Estado</th>
<th class="p-3 font-semibold text-right">Acciones</th>
</tr>
</thead>
<tbody>
<tr class="border-b border-border-light dark:border-border-dark hover:bg-primary-subtle/50 dark:hover:bg-primary/10 cursor-pointer">
<td class="p-3">
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuATJn5QwYPv9__VsaX0rlDfujVs24BDJw69jQ75MkdNW2GM4FaFeA9aRDKQlTvNbHEnKddLzPiZo2yw4rpRG3l7jcXsaW-fGj9ZJNw5s7Cye_MPNUU53xZsoCeLNEjAkYxqS3V6uP5bI8syiw7shd54zXo5FqBPNEMEh2vew1WPJ-TOL-y0cY9CFj17IVDnf2--6K9l0eO1Org75TNhIr5GZEVZ_xd_i8lks7ynOAvTuEUSlXm6HlujRzouUnUc5br4NtYFMt7VVFrX");'></div>
<div>
<p class="font-semibold">Juan Pérez</p>
<p class="text-sm text-text-light/60 dark:text-text-dark/60">Hombre, 45 años</p>
</div>
</div>
</td>
<td class="p-3">P00123</td>
<td class="p-3"><span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-200">Activo</span></td>
<td class="p-3 text-right"><span class="material-symbols-outlined">chevron_right</span></td>
</tr>
<tr class="border-b border-border-light dark:border-border-dark hover:bg-primary-subtle/50 dark:hover:bg-primary/10 cursor-pointer bg-primary-subtle dark:bg-primary/20">
<td class="p-3">
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuATJn5QwYPv9__VsaX0rlDfujVs24BDJw69jQ75MkdNW2GM4FaFeA9aRDKQlTvNbHEnKddLzPiZo2yw4rpRG3l7jcXsaW-fGj9ZJNw5s7Cye_MPNUU53xZsoCeLNEjAkYxqS3V6uP5bI8syiw7shd54zXo5FqBPNEMEh2vew1WPJ-TOL-y0cY9CFj17IVDnf2--6K9l0eO1Org75TNhIr5GZEVZ_xd_i8lks7ynOAvTuEUSlXm6HlujRzouUnUc5br4NtYFMt7VVFrX");'></div>
<div>
<p class="font-semibold">Maria Rodriguez</p>
<p class="text-sm text-text-light/60 dark:text-text-dark/60">Mujer, 34 años</p>
</div>
</div>
</td>
<td class="p-3">P00456</td>
<td class="p-3"><span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-200">Activo</span></td>
<td class="p-3 text-right"><span class="material-symbols-outlined">chevron_right</span></td>
</tr>
<tr class="border-b border-border-light dark:border-border-dark hover:bg-primary-subtle/50 dark:hover:bg-primary/10 cursor-pointer">
<td class="p-3">
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCnlOz4jlSWrmy1GSbTlOKhatMQll3Sdnxz_qqZEs5Ioqhm0gaqpEN9GHCM07hsoq3wgE9RLHCjXu_ocNdzwIUs4su2YjW1GXZs-PTjihOy0YlY36u9DGGr9MP5rxHgmmNSolNdULEIOwURu3Osj6cLlwT3gphDENyy_AXpmvRhFah9U5HFpl2R-2He-oqMlLf_0aJERynvuRM61Qi_Ibx94YHoKQm47nlXFfnE8kwJ4d5mOFfaV63KZMv6h-_A9mPwrc3ynY_zTSxB");'></div>
<div>
<p class="font-semibold">Carlos Mendoza</p>
<p class="text-sm text-text-light/60 dark:text-text-dark/60">Hombre, 52 años</p>
</div>
</div>
</td>
<td class="p-3">P00789</td>
<td class="p-3"><span class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-200">Seguimiento</span></td>
<td class="p-3 text-right"><span class="material-symbols-outlined">chevron_right</span></td>
</tr>
<tr class="border-b border-border-light dark:border-border-dark hover:bg-primary-subtle/50 dark:hover:bg-primary/10 cursor-pointer">
<td class="p-3">
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCnlOz4jlSWrmy1GSbTlOKhatMQll3Sdnxz_qqZEs5Ioqhm0gaqpEN9GHCM07hsoq3wgE9RLHCjXu_ocNdzwIUs4su2YjW1GXZs-PTjihOy0YlY36u9DGGr9MP5rxHgmmNSolNdULEIOwURu3Osj6cLlwT3gphDENyy_AXpmvRhFah9U5HFpl2R-2He-oqMlLf_0aJERynvuRM61Qi_Ibx94YHoKQm47nlXFfnE8kwJ4d5mOFfaV63KZMv6h-_A9mPwrc3ynY_zTSxB");'></div>
<div>
<p class="font-semibold">Sofia Garcia</p>
<p class="text-sm text-text-light/60 dark:text-text-dark/60">Mujer, 28 años</p>
</div>
</div>
</td>
<td class="p-3">P01123</td>
<td class="p-3"><span class="px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-200">Inactivo</span></td>
<td class="p-3 text-right"><span class="material-symbols-outlined">chevron_right</span></td>
</tr>
<tr class="border-b border-border-light dark:border-border-dark hover:bg-primary-subtle/50 dark:hover:bg-primary/10 cursor-pointer">
<td class="p-3">
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCnlOz4jlSWrmy1GSbTlOKhatMQll3Sdnxz_qqZEs5Ioqhm0gaqpEN9GHCM07hsoq3wgE9RLHCjXu_ocNdzwIUs4su2YjW1GXZs-PTjihOy0YlY36u9DGGr9MP5rxHgmmNSolNdULEIOwURu3Osj6cLlwT3gphDENyy_AXpmvRhFah9U5HFpl2R-2He-oqMlLf_0aJERynvuRM61Qi_Ibx94YHoKQm47nlXFfnE8kwJ4d5mOFfaV63KZMv6h-_A9mPwrc3ynY_zTSxB");'></div>
<div>
<p class="font-semibold">Laura Jimenez</p>
<p class="text-sm text-text-light/60 dark:text-text-dark/60">Mujer, 61 años</p>
</div>
</div>
</td>
<td class="p-3">P01456</td>
<td class="p-3"><span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-200">Activo</span></td>
<td class="p-3 text-right"><span class="material-symbols-outlined">chevron_right</span></td>
</tr>
<tr class="border-b border-border-light dark:border-border-dark hover:bg-primary-subtle/50 dark:hover:bg-primary/10 cursor-pointer">
<td class="p-3">
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCnlOz4jlSWrmy1GSbTlOKhatMQll3Sdnxz_qqZEs5Ioqhm0gaqpEN9GHCM07hsoq3wgE9RLHCjXu_ocNdzwIUs4su2YjW1GXZs-PTjihOy0YlY36u9DGGr9MP5rxHgmmNSolNdULEIOwURu3Osj6cLlwT3gphDENyy_AXpmvRhFah9U5HFpl2R-2He-oqMlLf_0aJERynvuRM61Qi_Ibx94YHoKQm47nlXFfnE8kwJ4d5mOFfaV63KZMv6h-_A9mPwrc3ynY_zTSxB");'></div>
<div>
<p class="font-semibold">Roberto Lima</p>
<p class="text-sm text-text-light/60 dark:text-text-dark/60">Hombre, 38 años</p>
</div>
</div>
</td>
<td class="p-3">P01789</td>
<td class="p-3"><span class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-200">Seguimiento</span></td>
<td class="p-3 text-right"><span class="material-symbols-outlined">chevron_right</span></td>
</tr>
</tbody>
</table>
<div class="divide-y divide-border-light dark:divide-border-dark md:hidden">
<div class="p-3 hover:bg-primary-subtle/50 dark:hover:bg-primary/10 cursor-pointer">
<div class="flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuATJn5QwYPv9__VsaX0rlDfujVs24BDJw69jQ75MkdNW2GM4FaFeA9aRDKQlTvNbHEnKddLzPiZo2yw4rpRG3l7jcXsaW-fGj9ZJNw5s7Cye_MPNUU53xZsoCeLNEjAkYxqS3V6uP5bI8syiw7shd54zXo5FqBPNEMEh2vew1WPJ-TOL-y0cY9CFj17IVDnf2--6K9l0eO1Org75TNhIr5GZEVZ_xd_i8lks7ynOAvTuEUSlXm6HlujRzouUnUc5br4NtYFMt7VVFrX");'></div>
<div>
<p class="font-semibold">Juan Pérez</p>
<p class="text-sm text-text-light/60 dark:text-text-dark/60">P00123</p>
</div>
</div>
<span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-200">Activo</span>
</div>
</div>
<div class="p-3 bg-primary-subtle dark:bg-primary/20 hover:bg-primary-subtle/50 dark:hover:bg-primary/10 cursor-pointer">
<div class="flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuATJn5QwYPv9__VsaX0rlDfujVs24BDJw69jQ75MkdNW2GM4FaFeA9aRDKQlTvNbHEnKddLzPiZo2yw4rpRG3l7jcXsaW-fGj9ZJNw5s7Cye_MPNUU53xZsoCeLNEjAkYxqS3V6uP5bI8syiw7shd54zXo5FqBPNEMEh2vew1WPJ-TOL-y0cY9CFj17IVDnf2--6K9l0eO1Org75TNhIr5GZEVZ_xd_i8lks7ynOAvTuEUSlXm6HlujRzouUnUc5br4NtYFMt7VVFrX");'></div>
<div>
<p class="font-semibold">Maria Rodriguez</p>
<p class="text-sm text-text-light/60 dark:text-text-dark/60">P00456</p>
</div>
</div>
<span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-200">Activo</span>
</div>
</div>
<div class="p-3 hover:bg-primary-subtle/50 dark:hover:bg-primary/10 cursor-pointer">
<div class="flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCnlOz4jlSWrmy1GSbTlOKhatMQll3Sdnxz_qqZEs5Ioqhm0gaqpEN9GHCM07hsoq3wgE9RLHCjXu_ocNdzwIUs4su2YjW1GXZs-PTjihOy0YlY36u9DGGr9MP5rxHgmmNSolNdULEIOwURu3Osj6cLlwT3gphDENyy_AXpmvRhFah9U5HFpl2R-2He-oqMlLf_0aJERynvuRM61Qi_Ibx94YHoKQm47nlXFfnE8kwJ4d5mOFfaV63KZMv6h-_A9mPwrc3ynY_zTSxB");'></div>
<div>
<p class="font-semibold">Carlos Mendoza</p>
<p class="text-sm text-text-light/60 dark:text-text-dark/60">P00789</p>
</div>
</div>
<span class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-200">Seguimiento</span>
</div>
</div>
<div class="p-3 hover:bg-primary-subtle/50 dark:hover:bg-primary/10 cursor-pointer">
<div class="flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCnlOz4jlSWrmy1GSbTlOKhatMQll3Sdnxz_qqZEs5Ioqhm0gaqpEN9GHCM07hsoq3wgE9RLHCjXu_ocNdzwIUs4su2YjW1GXZs-PTjihOy0YlY36u9DGGr9MP5rxHgmmNSolNdULEIOwURu3Osj6cLlwT3gphDENyy_AXpmvRhFah9U5HFpl2R-2He-oqMlLf_0aJERynvuRM61Qi_Ibx94YHoKQm47nlXFfnE8kwJ4d5mOFfaV63KZMv6h-_A9mPwrc3ynY_zTSxB");'></div>
<div>
<p class="font-semibold">Sofia Garcia</p>
<p class="text-sm text-text-light/60 dark:text-text-dark/60">P01123</p>
</div>
</div>
<span class="px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-200">Inactivo</span>
</div>
</div>
<div class="p-3 hover:bg-primary-subtle/50 dark:hover:bg-primary/10 cursor-pointer">
<div class="flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCnlOz4jlSWrmy1GSbTlOKhatMQll3Sdnxz_qqZEs5Ioqhm0gaqpEN9GHCM07hsoq3wgE9RLHCjXu_ocNdzwIUs4su2YjW1GXZs-PTjihOy0YlY36u9DGGr9MP5rxHgmmNSolNdULEIOwURu3Osj6cLlwT3gphDENyy_AXpmvRhFah9U5HFpl2R-2He-oqMlLf_0aJERynvuRM61Qi_Ibx94YHoKQm47nlXFfnE8kwJ4d5mOFfaV63KZMv6h-_A9mPwrc3ynY_zTSxB");'></div>
<div>
<p class="font-semibold">Laura Jimenez</p>
<p class="text-sm text-text-light/60 dark:text-text-dark/60">P01456</p>
</div>
</div>
<span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-200">Activo</span>
</div>
</div>
<div class="p-3 hover:bg-primary-subtle/50 dark:hover:bg-primary/10 cursor-pointer">
<div class="flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCnlOz4jlSWrmy1GSbTlOKhatMQll3Sdnxz_qqZEs5Ioqhm0gaqpEN9GHCM07hsoq3wgE9RLHCjXu_ocNdzwIUs4su2YjW1GXZs-PTjihOy0YlY36u9DGGr9MP5rxHgmmNSolNdULEIOwURu3Osj6cLlwT3gphDENyy_AXpmvRhFah9U5HFpl2R-2He-oqMlLf_0aJERynvuRM61Qi_Ibx94YHoKQm47nlXFfnE8kwJ4d5mOFfaV63KZMv6h-_A9mPwrc3ynY_zTSxB");'></div>
<div>
<p class="font-semibold">Roberto Lima</p>
<p class="text-sm text-text-light/60 dark:text-text-dark/60">P01789</p>
</div>
</div>
<span class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-200">Seguimiento</span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="lg:col-span-1 window bg-surface-light dark:bg-surface-dark flex flex-col">
<header class="bg-surface-light dark:bg-surface-dark border-b border-border-light dark:border-border-dark flex items-center justify-between p-3">
<h2 class="text-lg font-bold">Resumen del Paciente</h2>
</header>
<div class="p-4 flex-1 flex flex-col gap-6 items-center text-center">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-24" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuATJn5QwYPv9__VsaX0rlDfujVs24BDJw69jQ75MkdNW2GM4FaFeA9aRDKQlTvNbHEnKddLzPiZo2yw4rpRG3l7jcXsaW-fGj9ZJNw5s7Cye_MPNUU53xZsoCeLNEjAkYxqS3V6uP5bI8syiw7shd54zXo5FqBPNEMEh2vew1WPJ-TOL-y0cY9CFj17IVDnf2--6K9l0eO1Org75TNhIr5GZEVZ_xd_i8lks7ynOAvTuEUSlXm6HlujRzouUnUc5br4NtYFMt7VVFrX");'></div>
<div>
<h3 class="text-xl font-bold">Maria Rodriguez</h3>
<p class="text-text-light/60 dark:text-text-dark/60">ID Paciente: P00456</p>
</div>
<div class="w-full text-left space-y-3">
<div class="flex justify-between items-center">
<span class="font-semibold text-sm">Edad:</span>
<span class="text-sm">34 años</span>
</div>
<div class="flex justify-between items-center">
<span class="font-semibold text-sm">Género:</span>
<span class="text-sm">Mujer</span>
</div>
<div class="flex justify-between items-center">
<span class="font-semibold text-sm">Teléfono:</span>
<span class="text-sm">+1 234 567 890</span>
</div>
<div class="flex justify-between items-center">
<span class="font-semibold text-sm">Próxima Cita:</span>
<span class="text-sm">15/08/2024, 10:30 AM</span>
</div>
<div class="flex flex-col text-left gap-1">
<span class="font-semibold text-sm">Alergias Conocidas:</span>
<p class="text-sm">Penicilina, Mariscos.</p>
</div>
<div class="flex flex-col text-left gap-1">
<span class="font-semibold text-sm">Condiciones Crónicas:</span>
<p class="text-sm">Asma.</p>
</div>
</div>
<button class="w-full h-10 bg-primary text-white rounded font-semibold flex items-center justify-center gap-2 mt-auto">
<span class="material-symbols-outlined">description</span>
<span>Ver Expediente Completo</span>
</button>
</div>
</div>
</div>
</main>
</div>

</body></html>
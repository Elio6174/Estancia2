<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$rol = $_SESSION['rol'] ?? '';
$current = basename($_SERVER['PHP_SELF']); 

function pageTitle($current) {
    switch ($current) {
        case 'dashboard.php': return 'Dashboard';
        case 'citas.php': return 'Citas';
        case 'pacientes.php': return 'Pacientes';
        case 'doctores.php': return 'Doctores';
        case 'disponibilidad.php': return 'Disponibilidad';
        case 'expedientes.php': return 'Expedientes Clínicos';
        case 'reportes.php': return 'Reportes';
        case 'usuarios.php': return 'Usuarios';
        default: return 'CliniHub';
    }
}
?>
<header class="sticky top-0 z-10 flex h-16 items-center justify-between border-b border-gray-200 
               bg-card-light/80 px-8 backdrop-blur-sm dark:border-gray-700 dark:bg-card-dark/80">

    <button class="lg:hidden p-2 text-gray-700 dark:text-gray-200" onclick="openSidebar()">
        <span class="material-symbols-outlined text-3xl">menu</span>
    </button>
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
        <?= pageTitle($current); ?>
    </h2>
    <div class="flex items-center gap-4">
        <button class="relative rounded-full p-2 text-gray-500 hover:bg-gray-200 hover:text-gray-700 
                       dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200">
            <span class="material-symbols-outlined">notifications</span>
            <span class="absolute right-2 top-2 block h-2 w-2 rounded-full bg-red-500"></span>
        </button>
        <div class="flex items-center gap-3">
            <img class="h-10 w-10 rounded-full object-cover"
                 src="https://lh3.googleusercontent.com/aida-public/AB6AXuAk8nuHlk58bmMDl5wqvf1UOV4xunbN7d_xrJvlmI1HbSeyfUpk4yQcc6A8UpwIeCOsK_kHLvi4MgxliLKIGZnhuQc0GTvW0o8KBbv9S4Uu7K3IkOYKmWCDeP39q4Na3beZjBJonzRlAMuqXJOIRWs6YmJYOwbXEE2ncxLxvoK76BZVJBPmw0l0uSWfa7a1FDIiUA6sm5mwOXjg8Ylyk88ygjxlGMku37Nc8AaNmOuYqUDvRLXfRuauVqSdZLW1II8YWtPHq-yRyLM1"
                 alt="User Avatar">
            <div>
                <p class="font-semibold text-gray-800 dark:text-white">
                    <?= $_SESSION['nombre'] ?? 'Usuario'; ?>
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    <?= ucfirst($rol) ?>
                </p>
            </div>
        </div>
    </div>
</header>

<?php
$rol = $_SESSION['rol'] ?? '';
$current = $_GET['view'] ?? '';

function active($page, $current) {
    return $current === $page 
        ? "bg-primary/20 font-semibold text-primary-vibrant"
        : "text-gray-300 hover:bg-primary/20 hover:text-white";
}
?>
<nav class="flex-1 flex flex-col">
    <div class="flex flex-col gap-2">
        <a class="flex items-center gap-3 px-3 py-2.5 <?= active('Inicio', $current) ?>"
            href="index.php?view=Inicio">
            <span class="material-symbols-outlined">dashboard</span>
            <span>Dashboard</span>
        </a>
        <?php if ($rol === 'administrador'): ?>
            <a class="flex items-center gap-3 px-3 py-2.5 <?= active('Citas', $current) ?>"
            href="index.php?view=Citas">
                <span class="material-symbols-outlined">event</span>
                <span>Citas</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 <?= active('Reportes', $current) ?>"
            href="index.php?view=Reportes">
                <span class="material-symbols-outlined">bar_chart</span>
                <span>Reportes</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 <?= active('Usuarios', $current) ?>"
            href="index.php?view=Usuarios">
                <span class="material-symbols-outlined">person</span>
                <span>Usuarios</span>
            </a>
        <?php endif; ?>
    </div>
    <div class="mt-auto flex flex-col gap-2 p-4">
        <a href="index.php?action=logout"
            class="flex items-center gap-3 px-3 py-2.5 text-red-400 hover:bg-red-500/10 hover:text-red-500 transition-all">
            <span class="material-symbols-outlined">logout</span>
            <span>Cerrar Sesión</span>
        </a>
    </div>
</nav>


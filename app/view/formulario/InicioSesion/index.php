<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>CliniHub - Login</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#11b4d4",
                        "background-light": "#f6f8f8",
                        "background-dark": "#101f22",
                        "foreground-light": "#0d191b",
                        "foreground-dark": "#e8eced",
                        "subtle-light": "#4c8d9a",
                        "subtle-dark": "#a3c4cb",
                        "border-light": "#cfe3e7",
                        "border-dark": "#2d3f43",
                        "form-divider-dark": "#0d1b2a",
                        "link-dark": "#0d1b2a"
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0rem",
                        "lg": "0rem",
                        "xl": "0rem",
                        "full": "0rem"
                    },
                },
            },
        }
    </script>
    <style>
        .form-input::placeholder {
            color: #4c8d9a;
        }

        .dark .form-input::placeholder {
            color: #a3c4cb;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display">
    <?php
        session_start();
        $error = $_SESSION['error'] ?? null;
        $form_data = $_SESSION['form_data'] ?? [];
        unset($_SESSION['error'], $_SESSION['form_data']);
    ?>
    <div class="flex min-h-screen">
        <div class="hidden lg:block lg:w-2/3 bg-cover bg-center"
            style="background-image: url('https://st2.depositphotos.com/4055463/7336/i/450/depositphotos_73360379-stock-photo-hospital-3d-rendering.jpg')">
        </div>
        <div class="w-full lg:w-1/3 flex items-center justify-center p-4 md:p-12 relative">
            <div class="absolute left-0 top-0 bottom-0 w-px bg-border-light dark:bg-form-divider-dark hidden lg:block"></div>
            <div class="w-full max-w-sm space-y-8">
                <div class="text-center">
                    <h2 class="mt-6 text-3xl font-bold tracking-tight text-foreground-light dark:text-foreground-dark">
                        Bienvenido de nuevo
                    </h2>
                    <p class="mt-2 text-sm text-subtle-light dark:text-subtle-dark">
                        Inicia sesión para acceder al portal.
                    </p>
                </div>
                <form action="index.php?action=loginIn" class="space-y-6" method="POST">
                    <div>
                        <label class="block text-sm font-medium text-foreground-light dark:text-foreground-dark"
                            for="email">Correo electrónico o nombre de usuario</label>

                        <div class="mt-1">
                            <input autocomplete="email"
                                class="form-input block w-full border border-border-light bg-background-light px-3 py-2 text-foreground-light shadow-sm focus:border-primary focus:outline-none focus:ring-primary dark:border-border-dark dark:bg-background-dark dark:text-foreground-dark dark:focus:border-primary dark:focus:ring-primary"
                                id="email" name="email" placeholder="tu-correo@ejemplo.com" required="" type="email"
                                value="<?= htmlspecialchars($form_data['email'] ?? '') ?>" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-foreground-light dark:text-foreground-dark"
                            for="password">Contraseña</label>

                        <div class="mt-1">
                            <input autocomplete="current-password"
                                class="form-input block w-full border border-border-light bg-background-light px-3 py-2 text-foreground-light shadow-sm focus:border-primary focus:outline-none focus:ring-primary dark:border-border-dark dark:bg-background-dark dark:text-foreground-dark dark:focus:border-primary dark:focus:ring-primary"
                                id="password" name="password" placeholder="********" required="" type="password" />
                        </div>
                    </div>
                    <div class="text-sm">
                        <a class="font-medium text-link-dark hover:text-link-dark/80" href="#">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                    <div>
                        <?php if ($error): ?>
                            <div
                                class="<?= $error['code'] === '500'
                                    ? 'flex w-full justify-center bg-red-100 border border-red-300 text-red-700 px-3 py-3 text-sm shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-300'
                                    : 'px-4 py-2 rounded text-center mb-4'
                                ?>">
                                <?= htmlspecialchars($error['message']) ?>
                            </div>
                            <br>
                        <?php endif; ?>
                        <button
                            class="flex w-full justify-center bg-[#0d1b2a] px-3 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#0d1b2a]/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#0d1b2a]"
                            type="submit">
                            Iniciar sesión
                        </button>
                    </div>
                </form>
                <p class="text-center text-sm text-subtle-light dark:text-subtle-dark">
                    ¿No tienes una cuenta?
                    <a class="font-medium text-link-dark hover:text-link-dark/80" href="index.php?view=SingIn">
                        Regístrate
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>

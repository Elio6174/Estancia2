<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CliniHub - Registro</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link 
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" 
        rel="stylesheet"
    />
    <style type="text/tailwindcss">
        :root {
            --primary-color: #11b4d4;
            --background-light: #ffffff;
            --background-dark: #101f22;
            --dark-blue-almost-black: #050a1a;
        }

        .character {
            border-radius: 12px;
            position: absolute;
        }
        .eyes {
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 40px;
        }
        .eyes div {
            width: 16px;
            height: 22px;
            background: black;
            border-radius: 50px;
        }
        .mouth {
            width: 40px;
            height: 4px;
            background: black;
            margin: 8px auto 0;
            border-radius: 4px;
        }
    </style>
</head>
<body class="bg-background-light font-display text-black">
<?php
    session_start();
    $error = $_SESSION['error'] ?? null;
    $form_data = $_SESSION['form_data'] ?? [];
    unset($_SESSION['error'], $_SESSION['form_data']);
?>
    <div class="flex min-h-screen">
        <div class="hidden md:flex w-2/3 relative items-end justify-center bg-white">
            <div class="absolute inset-0 bg-white"></div>
            <div class="character" style="
                width: 90px; height: 220px; background:#12224d;
                bottom: 0; left: 120px;
            ">
                <div class="eyes">
                    <div></div><div></div>
                </div>
            </div>
            <div class="character" style="
                width: 130px; height: 330px; background:#FDBE57;
                bottom: 0; left: 210px;
            ">
                <div class="eyes">
                    <div></div><div></div>
                </div>
                <div class="mouth"></div>
            </div>
            <div class="character" style="
                width: 160px; height: 260px; background:#7FA6B3;
                bottom: 0; left: 340px;
            ">
                <div class="eyes">
                    <div></div><div></div>
                </div>
                <div class="mouth" style="height: 5px; width: 50px;"></div>
            </div>
            <div class="character" style="
                width: 130px; height: 330px; background:#FFD7C2;
                bottom: 0; left: 500px;
            ">
                <div class="eyes">
                    <div></div><div></div>
                </div>
                <div class="mouth"></div>
            </div>
        </div>
        <div class="w-full md:w-1/3 flex items-center justify-center p-8 md:p-12 relative">
            <div class="absolute left-0 top-0 bottom-0 w-px bg-gray-200 hidden md:block"></div>

            <div class="w-full max-w-sm space-y-6">
                <div class="text-center">
                    <h1 class="text-3xl font-bold">Crea tu cuenta</h1>
                    <p class="text-gray-500">Únete a MediConnect para gestionar tu salud.</p>
                </div>
                <form class="space-y-4" action="index.php?action=SingIn" method="POST">
                    <div>
                        <label class="block text-sm font-medium">Nombre completo</label>
                        <input 
                            name="nombre" 
                            type="text" 
                            placeholder="Ingresa tu nombre completo"
                            value="<?= htmlspecialchars($form_data['nombre'] ?? '') ?>"
                            class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300"
                            required
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Correo electrónico</label>
                        <input 
                            name="email" 
                            type="email" 
                            placeholder="Ingresa tu correo electrónico"
                            value="<?= htmlspecialchars($form_data['email'] ?? '') ?>"
                            class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300"
                            required
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Número de teléfono</label>
                        <input 
                            name="phone" 
                            type="number" 
                            placeholder="Ingresa tu número de teléfono"
                            value="<?= htmlspecialchars($form_data['phone'] ?? '') ?>"
                            class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300"
                            required
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Contraseña</label>
                        <input 
                            name="password" 
                            type="password" 
                            placeholder="Ingresa tu contraseña"
                            class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300"
                            required
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Confirmar contraseña</label>
                        <input 
                            name="confirm-password" 
                            type="password" 
                            placeholder="Confirma tu contraseña"
                            class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300"
                            required
                        />
                    </div>
                    <?php if ($error): ?>
                        <div class="<?= $error === 'success' ? 'bg-green-100 border border-green-300 text-green-700' : 'bg-red-100 border border-red-300 text-red-700' ?> px-4 py-2 rounded text-center mb-4">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>
                    <button 
                        type="submit"
                        class="w-full py-2 px-4 text-white bg-black">
                        Registrarse
                    </button>
                </form>
                <p class="text-center text-sm text-gray-500">
                    ¿Ya tienes cuenta?
                    <a href="index.php" class="font-medium text-black">Inicia sesión</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>

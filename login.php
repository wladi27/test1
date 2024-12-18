<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">
    <style>
        body {
            background-color: rgb(246, 255, 200);
        }
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="card p-4 shadow-sm" style="width: 400px;" id="login-container">
            <h2 class="text-center mb-4">Login</h2>
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="username" placeholder="Ingrese su usuario" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" placeholder="Ingrese su contraseña" required>
            </div>
            <button class="btn btn-primary" onclick="login()">Login</button>
            <div class="text-center mt-3">
                <p>¿No tienes una cuenta? <a href="#" onclick="showRegisterForm()">Regístrate</a></p>
            </div>
        </div>

        <div class="card p-4 shadow-sm" style="width: 400px; display: none;" id="register-container">
            <h2 class="text-center mb-4">Registro</h2>
            <div class="mb-3">
                <label for="register-username" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="register-username" placeholder="Ingrese su usuario" required>
            </div>
            <div class="mb-3">
                <label for="register-password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="register-password" placeholder="Ingrese su contraseña" required>
            </div>
            <button class="btn btn-primary" onclick="register()">Registro</button>
            <div class="text-center mt-3">
                <p>Ya tienes una cuenta? <a href="#" onclick="showLoginForm()">Ingresa</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
    <script>
        function login() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    <?php
    include 'url.php';
    ?>
    fetch('http://192.168.0.175/qr/api/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Inicio de sesión exitoso') {
            // Guardar los datos del usuario en la sesión
            sessionStorage.setItem('user', JSON.stringify(data.user));

            Swal.fire({
                title: 'Success',
                text: 'Login successful',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                // Redirigir al usuario a la página home.php
                window.location.href = 'home';
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: data.message,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error',
            text: 'An error occurred. Please try again later.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
}

        function register() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            fetch('http://localhost/qr/api/usuarios', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ username, password })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Usuario creado exitosamente') {
                    Swal.fire({
                        title: 'Success',
                        text: 'Usuario creado con exito!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Redirigir al usuario a la página de login o mostrar un mensaje de éxito
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred. Please try again later.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        }

        function showRegisterForm() {
            document.getElementById('register-container').classList.remove('d-none');
            document.getElementById('register-container').classList.add('d-flex');
            document.querySelector('.card:not(#register-container .card)').classList.add('d-none');
        }

        function showLoginForm() {
            document.getElementById('register-container').classList.add('d-none');
            document.getElementById('register-container').classList.remove('d-flex');
            document.querySelector('.card:not(#register-container .card)').classList.remove('d-none');
        }
    </script>
</body>
</html>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
    <script>
        
    </script>
</body>
</html>

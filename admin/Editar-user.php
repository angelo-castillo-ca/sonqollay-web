<?php
include 'back/session.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Editar Usuario</h2>
        <form id="editar-usuario-form">
            <div class="form-group">
                <label for="nombres">nombres</label>
                <input type="text" class="form-control" id="nombres" name="nombres" required>
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required>
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo"required>
            </div>
            <div class="form-group">
                <label for="passwd">Contraseña</label>
                <input type="password" class="form-control" id="passwd" name="passwd" required>
            </div>
            <div class="form-group">
                <label for="rol">Rol</label>
                <input type="text" class="form-control" id="rol" name="rol"required>
            </div>
            <div class="form-group">
                <label for="creditos">Créditos</label>
                <input type="number" class="form-control" id="creditos" name="creditos" required>
            </div>
            <input type="hidden" id="usuario_id" name="id">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Obtener el ID del usuario de la URL
            const urlParams = new URLSearchParams(window.location.search);
            const userId = urlParams.get('id');

            // Imprimir el valor de userId para depurar
            console.log('UserID:', userId);
            

            // Verificar si el ID del usuario es válido
            if (userId && parseInt(userId) > 0) {
            // Realizar la solicitud para obtener los datos del usuario
            fetch(`back/obtener_usuario.php?id=${userId}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // Asignar valores a los campos del formulario
                document.getElementById('nombres').value = data.nombres ?? '';
                document.getElementById('apellido_paterno').value = data.apellido_paterno ?? '';
                document.getElementById('apellido_materno').value = data.apellido_materno ?? '';
                document.getElementById('correo').value = data.correo ?? '';
                document.getElementById('passwd').value = data.passwd ?? '';
                document.getElementById('rol').value = data.rol ?? '';
                // Verificar si creditos está definido y asignar cero si no lo está
                document.getElementById('creditos').value = data.creditos ?? 0;
                document.getElementById('usuario_id').value = data.id ?? '';
            })
            .catch(error => console.error('Error:', error));
    } else {
        console.error('ID del usuario no válido');
    }

            // Agregar el evento submit al formulario de edición
            document.getElementById('editar-usuario-form').addEventListener('submit', function (e) {
                e.preventDefault();

                // Obtener los datos del formulario
                const formData = new FormData(this);

                // Enviar los datos del formulario para editar el usuario
                fetch('back/editar_usuario.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                       // Mostrar un mensaje de alerta con la respuesta del servidor
                        alert(data.message);
                        // Redirigir a la página de alumnos si la edición fue exitosa
                        if (data.success) {
                            window.location.href = data.redirect_url;
                        }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Modulo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Editar modulo</h2>
        <form id="editar-modulo-form">
            <div class="form-group">
                <label for="nombre">nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="creditos">Creditos</label>
                <input type="creditos" class="form-control" id="creditos" name="creditos" required>
            </div>
            <input type="hidden" id="modulo_id" name="id">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Obtener el ID del modulo de la URL
            const urlParams = new URLSearchParams(window.location.search);
            const moduloId = urlParams.get('id');

            // Imprimir el valor de userId para depurar
            console.log('MouduloID:', moduloId);
            

            // Verificar si el ID del modulo es válido
            if (moduloId && parseInt(moduloId) > 0) {
            // Realizar la solicitud para obtener los datos del modulo
            fetch(`back/obtener_modulo.php?id=${moduloId}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // Asignar valores a los campos del formulario
                document.getElementById('nombre').value = data.nombre ?? '';
                document.getElementById('creditos').value = data.creditos ?? 0;
                document.getElementById('modulo_id').value = data.id ?? '';
            })
            .catch(error => console.error('Error:', error));
    } else {
        console.error('ID del modulo no válido');
    }

            // Agregar el evento submit al formulario de edición
            document.getElementById('editar-modulo-form').addEventListener('submit', function (e) {
                e.preventDefault();

                // Obtener los datos del formulario
                const formData = new FormData(this);

                // Enviar los datos del formulario para editar el usuario
                fetch('back/editar_modulo.php', {
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

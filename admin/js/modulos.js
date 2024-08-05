$(document).ready(function () {
    $.ajax({
        url: 'back/modulos.php',
        dataType: 'json',
        success: function (data) {
            $('#example tbody').empty();
            $.each(data, function (index, value) {
                $('#example tbody').append('<tr>' +
                    '<td>' + value.id + '</td>' +
                    '<td>' + value.nombre + '</td>' +
                    '<td>' + value.creditos + '</td>' +
                    '<td>' +
                    '<button type="button" class="btn btn-warning d-flex align-items-center edit-button" style="height: 38px;" data-id="' + value.id + '">Editar <i class="fa fa-edit"></i></button>' +
                    '</td>' +
                    '<td>' +
                    '<button type="button" class="btn btn-danger d-flex align-items-center eliminar-button" style="height: 38px;" data-id="' + value.id + '">Eliminar <i class="fa fa-trash"></i></button>' +
                    '</td>' +
                    '<td>' +
                    '<button type="button" class="btn btn-primary d-flex align-items-center expand-button" style="height: 38px;" data-id="' + value.id + '">Preguntas</button>' +
                    '</td>' +
                    '</tr>');
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            console.error(status);
            console.error(error);
        }
    });

    // Inicializar la tabla DataTable fuera de la función success
    $('#example').DataTable();

    // Agregar evento de clic al botón de editar
    $(document).on('click', '.edit-button', function() {
        var moduloId = $(this).data('id');
        window.location.href = 'Editar-modulo.php?id=' + moduloId;
    });

    $(document).on('click', '.expand-button', function() {
        var moduleId = $(this).data('id');
        window.location.href = 'modulos-preguntas.php?id=' + moduleId;
      });

    // Agregar evento de clic al botón de eliminar
    $(document).on('click', '.eliminar-button', function() {
        var moduloId = $(this).data('id');
        if (confirm('¿Estás seguro de que deseas eliminar este modulo?')) {
            $.ajax({
                url: 'back/eliminar_modulo.php',
                type: 'GET',
                data: { id: moduloId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert('Error: ' + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    console.error(status);
                    console.error(error);
                }
            });
        }
    });
});
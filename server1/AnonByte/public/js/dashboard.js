$(document).ready(function () {
    // Inicializar una variable global para almacenar la solicitud AJAX actual
    var currentRequest = null;

    // Función para realizar la solicitud AJAX
    function makeRequest() {
        // Si hay una solicitud AJAX actual en progreso, cancelarla
        if (currentRequest != null) {
            currentRequest.abort();
        }

        // Realizar la solicitud AJAX
        currentRequest = $.get("/dashboard/stats", function (data) {
            $('.stats').html(data);
        });
    }

    // Establecer un temporizador para realizar una solicitud AJAX cada 10 segundos
    var intervalId = setInterval(makeRequest, 10000);

    // Agregar un controlador de eventos al botón de actualización
    $('#regargarStats').click(function () {
        makeRequest();
    });
});

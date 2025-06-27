$(function () {
    // Gráfico donut
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
    var progreso = parseInt($('#barraProgreso').attr('style').split(':')[1]);
    var restante = 100 - progreso;

    var donutData = {
        datasets: [
            {
                data: [progreso, restante],
                backgroundColor: ['#39A900', '#d2d6de'],
            }
        ]
    };

    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
        cutout: '70%',
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return context.raw + '%';
                    }
                }
            }
        }
    };

    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    });

    // Animación de la barra de progreso
    function animarBarraProgreso() {
        var barra = $('#barraProgreso');
        var porcentajeFinal = progreso;
        var porcentajeActual = 0;
        var velocidad = 20; // ms entre cada incremento
        var incremento = 1;

        var intervalo = setInterval(function () {
            if (porcentajeActual >= porcentajeFinal) {
                clearInterval(intervalo);
                return;
            }

            porcentajeActual += incremento;
            if (porcentajeActual > porcentajeFinal) {
                porcentajeActual = porcentajeFinal;
            }

            barra.css('width', porcentajeActual + '%');
            barra.attr('aria-valuenow', porcentajeActual);
            barra.parent().find('.float-right b').text(porcentajeActual);
        }, velocidad);
    }

    animarBarraProgreso();
});

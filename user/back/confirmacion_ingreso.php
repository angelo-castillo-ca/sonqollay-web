<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso correcto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #3498db; /* Fondo azul */
            overflow: hidden;
            position: relative;
            animation: fadeInBackground 4s ease-out;
        }

        .circle {
            position: absolute;
            background-color: #f1c40f; /* Círculos amarillos */
            border-radius: 50%;
            animation: bounce 4s infinite;
        }

        .circle1 { top: 20%; left: 30%; width: 100px; height: 100px; }
        .circle2 { top: 50%; left: 60%; width: 80px; height: 80px; }
        .circle3 { top: 80%; left: 20%; width: 120px; height: 120px; }
        .circle4 { top: 40%; left: 40%; width: 90px; height: 90px; }
        .circle5 { top: 70%; left: 80%; width: 110px; height: 110px; }
        .circle6 { top: 10%; left: 80%; width: 70px; height: 70px; }
        .circle7 { top: 60%; left: 10%; width: 130px; height: 130px; }

        .confirmation-container {
            text-align: center;
            z-index: 2;
            position: relative;
            animation: fadeInUp 2s ease-out;
        }

        @keyframes fadeInBackground {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }
    </style>
    <script>
        // Redirige automáticamente después de 4 segundos
        setTimeout(function(){
            window.location.href = '../index.php';
        }, 4000);
    </script>
</head>
<body>

    <div class="circle circle1"></div>
    <div class="circle circle2"></div>
    <div class="circle circle3"></div>
    <div class="circle circle4"></div>
    <div class="circle circle5"></div>
    <div class="circle circle6"></div>
    <div class="circle circle7"></div>

    <div class="confirmation-container animated fadeInUp">
        <h2 class="mb-4">Has ingresado a Sonqollay</h2>
        <!-- Agrega aquí cualquier contenido adicional o estilos que desees -->
    </div>

</body>
</html>

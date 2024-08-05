<?php
include 'config/functions.php';
include 'back/session.php';
$estado = true;
$mensaje = "";

//$postData = $_POST;
//foreach ($postData as $key => $value) {
//    echo "Clave: $key; Valor: $value<br>";
//}
//
//exit;

if(isset($_POST["kr-hash-algorithm"]) && $_POST["kr-hash-algorithm"] == "sha256_hmac") {
    if (!isset($_POST['kr-answer'])){
        $estado = false;
        $mensaje = "Contenido inválido";
    }else{
        $krAnswer = str_replace('\/', '/', $_POST['kr-answer']);
        $calculateHash = hash_hmac('sha256', $krAnswer, IZIPAY_HAS_KEY);
        if($calculateHash == $_POST['kr-hash']){
            $data =  json_decode($krAnswer, true);
           // $transactionToken = $_POST["transactionToken"];
           //$email = $_POST["customerEmail"];
           // $amount = $_GET["amount"];
          //$purchaseNumber = $_GET["purchaseNumber"];
            $plan = $_GET["plan"];
          //  $channel = $_POST["channel"];
                try {
                   // $token = generateToken();
                  //  $data = generateAuthorization($amount, $purchaseNumber, $transactionToken, $token);
                    registroTransacciones($data,$plan,$krAnswer);
                }catch (Exception $exception){
                    $estado = false;
                }

        }else{
            $estado = false;
            $mensaje = "Contenido incorrecto";
        }
    }

} else {
    $estado = false;
    $mensaje = "Algoritmo no soportado";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Brand</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.user.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Serif">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="../assets/css/swiper-icons.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/Data-Table-styles.css">
    <link rel="stylesheet" href="../assets/css/Data-Table.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <!--link rel="stylesheet" href="../assets/css/Lista-Productos-Canito.css"-->
    <link rel="stylesheet" href="../assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <link rel="stylesheet" href="../assets/css/Navbar-Right-Links-icons.css">
    <link rel="stylesheet" href="../assets/css/Navbar.css">
    <!--link rel="stylesheet" href="../assets/css/Pricing-Table-with-Icon-Buy-Button-styles.css"-->
    <!--link rel="stylesheet" href="../assets/css/Pricing-Table-with-Icon-Buy-Button.css"-->
    <link rel="stylesheet" href="../assets/css/Simple-Slider-swiper-bundle.min.css">
    <link rel="stylesheet" href="../assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="../assets/css/Steps-Progressbar.css">

    <style>

        .container-pago {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .titulo-pago {
            text-align: center;
            color: #4e73df;
            margin-bottom: 30px;
        }

        .info-pago {
            margin-bottom: 15px;
        }
        .titulo-info{
            margin-bottom: 22px;
        }

        .info-pago-item {
            margin-bottom: 13px;
            display: flex;
            justify-content: space-between;
        }

        .checkbox-label {
            display: inline-block;
            margin-bottom: 10px;
        }

        .checkbox-label a {
            text-decoration: none;
        }

    </style>
</head>

<body id="page-top">
<nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light" style="background: rgb(52,131,225);">
    <div class="container-fluid">
        <a href="index.php">
            <img class="img-fluid" src="../assets/img/logos/LOGO SONQOLLAY.png" width="171" height="29">
        </a>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow d-flex align-items-center">
                    <a href="monedas.php" class="d-flex align-items-center">
                        <span id="creditos" class="d-none d-lg-inline me-2 text-gray-600 small">
                            <?php
                            $creditos = $_SESSION['creditos'] ?? 0;
                            echo "$" . htmlspecialchars($creditos);
                            ?>
                        </span>
                        <img class="border rounded-circle img-profile img-fluid" src="../assets/img/monedas/pila-de-monedas.png" style="max-width: 30px; height: auto;">
                    </a>
                    <div class="d-none d-sm-block topbar-divider"></div>
                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                        <span class="d-none d-lg-inline me-2 text-gray-600 small">
                            <?php
                            $nombre_usuario = $_SESSION['nombre_usuario'] ?? '';
                            echo htmlspecialchars($nombre_usuario);
                            ?>
                        </span>
                        <img class="border rounded-circle img-profile" src="<?php echo htmlspecialchars($_SESSION['avatar_usuario']); ?>">
                    </a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                        <a class="dropdown-item" href="perfil.php">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Perfil
                        </a>
                        <a class="dropdown-item" href="change-password.php">
                            <i class="fas fa-user-lock fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Cambiar contraseña
                        </a>
                        <a class="dropdown-item" href="modulosA.html">
                            <i class="fas fa-check-double fa-sm fa-fw me-2 text-gray-400"></i>Mis módulos&nbsp; aprobados
                        </a>
                        <a class="dropdown-item" href="modulos.html">
                            <i class="fas fa-pencil-alt fa-sm fa-fw me-2 text-gray-400"></i>Mis módulos&nbsp; por llevar
                        </a>
                        <a class="dropdown-item" href="back/close.php">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Salir
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <?php if($estado){?>
            <div class="container d-flex justify-content-center">

                <div class="col-md-8 col-sm-12">
                    <div class="alert alert-success text-center" role="alert">
                        <i class="fas fa-check-circle"></i> <?php echo $data['transactions'][0]['detailedStatus']; ?>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <b>Número de pedido: </b> <?php echo $data['orderDetails']['orderId']; ?>
                        </div>
                        <div class="col-md-12">
                            <?php
                            $fechaOriginal = $data['transactions'][0]['creationDate'];
                            $fecha = new DateTime($fechaOriginal);
                            $fecha->setTimezone(new DateTimeZone('America/Lima'));
                            $fechaFormateada = $fecha->format('d/m/Y H:i:s');
                            ?>
                            <b>Fecha y hora del pedido: </b> <?php echo $fechaFormateada ; ?>
                        </div>
                        <div class="col-md-12">
                            <b>Tarjeta: </b> <?php echo $data['transactions'][0]['transactionDetails']['cardDetails']['pan'] . " (" . $data['transactions'][0]['transactionDetails']['cardDetails']['effectiveBrand'] . ")"; ?>
                        </div>
                        <div class="col-md-12">
                            <b>Importe pagado: </b> <?php echo intval($data['transactions'][0]['amount']) / 100 . " " . $data['transactions'][0]['currency']; ?>
                        </div>
                    </div>
                </div>


            </div>
    <?php } else {?>
        <div class="container text-center mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h1 class="display-4 text-danger"><i class="fas fa-exclamation-circle"></i> Error</h1>
                            <p class="lead">Oops! Algo salió mal.</p>
                            <p>Por favor, inténtalo de nuevo más tarde o contacta con el soporte si el problema persiste.</p>
                            <a href="/" class="btn btn-primary"><i class="fas fa-home"></i> Volver al  Inicio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>
</html>

<?php
$estado = true;
include 'back/session.php';
if (isset($_GET['plan'])) {

    $plan_id = $_GET['plan'];
   // include 'services.php';
    $planInfo = obtenerPlanPorId($plan_id);
    $row = mysqli_fetch_assoc($planInfo);
    if ($row ) {
        include 'config/functions.php';
        $amount = $row['precio'];
        $detallePago = "Detalle de pago";

        $token = generateToken($amount);
        $orden = $_SESSION['orden'];

//        echo $token;
//        exit;
      //  $sesion = generateSesion($amount, $token);
       // $purchaseNumber = generatePurchaseNumber();

    } else {
        $estado = false;
    }
} else {
    $estado = false;
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

    <script type="text/javascript"
            src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"
            kr-public-key="<?= IZIPAY_PUBLIC_KEY ?>"
            kr-post-url-success="/user/finalizar.php?plan=<?php echo $plan_id ?>";
            kr-language="es-ES">
    </script>
    <link rel="stylesheet" href="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic-reset.min.css">
    <script src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic.js">
    </script>

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

<?php if ($estado){?>
<div id="wrapper">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">

                <div class="mb-3">
                    <br>
                    <div class="container-pago">
                        <h1 class="titulo-pago">Pago con Visa</h1>
                        <hr>

                        <div class="info-pago">
                            <h3 class="titulo-info">Información del pago</h3>
                            <div class="info-pago-item">
                                <span class="info-pago-label">Importe a pagar:</span>
                                <span class="info-pago-value">S/. <?php echo $amount; ?></span>
                            </div>
                            <div class="info-pago-item">
                                <span class="info-pago-label">Número de pedido:</span>
                                <span class="info-pago-value"><?php echo $orden; ?></span>
                            </div>
                            <div class="info-pago-item">
                                <span class="info-pago-label">Concepto:</span>
                                <span class="info-pago-value"><?php echo $detallePago; ?></span>
                            </div>
                            <div class="info-pago-item">
                                <span class="info-pago-label">Fecha:</span>
                                <span class="info-pago-value"><?php echo date("d/m/Y"); ?></span>
                            </div>
                        </div>

                        <hr>

                        <div class="checkbox-label">
                            <input type="checkbox" name="ckbTerms" id="ckbTerms" onclick="visaNetEc3()" style="margin-bottom: 20px;">
                            <label for="ckbTerms">Acepto los <a href="#" target="_blank">Términos y condiciones</a></label>
                        </div>
                        <div class="text-center" id="frmVisaNet" style="display: none">
                            <div class="kr-embedded"  kr-popin kr-form-token="<?php echo $token?>"></div>
                        </div>
                    </div>

                </div>


            </div>

        </div>



        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Brand 2023</span></div>
            </div>
        </footer>

    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top">
        <i class="fas fa-angle-up"></i></a>
</div>
<?php }else{ ?>
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
<script src="../assets/js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>

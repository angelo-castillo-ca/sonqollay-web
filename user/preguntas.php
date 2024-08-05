<?php
include 'back/session.php';
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sonqollay-web</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/swiper-icons.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/Data-Table-styles.css">
    <link rel="stylesheet" href="../assets/css/Data-Table.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="../assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <link rel="stylesheet" href="../assets/css/Navbar-Right-Links-icons.css">
    <link rel="stylesheet" href="../assets/css/Navbar.css">
    <link rel="stylesheet" href="../assets/css/Simple-Slider-swiper-bundle.min.css">
    <link rel="stylesheet" href="../assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="../assets/css/Steps-Progressbar.css">
    <
</head>
<body>
<nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light" style="background: rgb(52,131,225);">
    <div class="container-fluid">
        <a href="index.php">
            <img class="img-fluid" src="../assets/img/logos/LOGO SONQOLLAY.png" width="171" height="29">
        </a>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow d-flex align-items-center">
                    <a href="monedas.php" class="d-flex align-items-center">
                        <span class="d-none d-lg-inline me-2 text-gray-600 small">
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
                        <a class="dropdown-item" href="perfil.html">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Perfil
                        </a>
                        <a class="dropdown-item" href="change-password.html">
                            <i class="fas fa-user-lock fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Cambiar contraseña
                        </a>
                        <a class="dropdown-item" href="modulosA.html">
                            <i class="fas fa-check-double fa-sm fa-fw me-2 text-gray-400"></i>Mis módulos&nbsp; aprobados
                        </a>
                        <a class="dropdown-item" href="modulos.html">
                            <i class="fas fa-pencil-alt fa-sm fa-fw me-2 text-gray-400"></i>Mis módulos&nbsp; por llevar
                        </a>
                        <a class="dropdown-item" href="close.php">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Salir
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
    <main>
    <section>
            <div class="steps-progressbar text-center container">
                <div class="progress">
                    <div class="progress-bar progress-bar-animated" role="progressbar" ></div>
                </div>
            </div>
        </section>
    </main>
    <div id="preguntas-container" class="container mt-5"></div>
    <div id="respuestas-container" class="container mt-3"></div>
    <!-- Ventana emergente para confirmar si el usuario quiere continuar -->
    <div class="modal fade" id="modalConfirmacion" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConfirmacionLabel">Confirmación de Continuación</h5>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Quieres seguir respondiendo preguntas? Necesitas 100 monedas para adquirir este módulo.
                </div>
                <div class="modal-footer">
                    <a href="ventana_monedas.php" class="btn btn-link">Ir a la ventana de Monedas</a>
                    <button id="btnPagarMonedas" type="button" class="btn btn-primary">Pagar 100 monedas</button>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="../assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---1-Index-Table-with-Search--Sort-Filters.js"></script>
    <script src="../assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---Material-UI-Actions.js"></script>
    <script src="../assets/js/Simple-Slider-swiper-bundle.min.js"></script>
    <script src="../assets/js/Simple-Slider.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="scripts_preguntas.js"></script>
    
</body>
</html>

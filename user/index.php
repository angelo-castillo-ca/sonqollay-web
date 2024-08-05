<?php
include 'back/session.php';
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Brand</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.user.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/Data-Table-styles.css">
    <link rel="stylesheet" href="../assets/css/Data-Table.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="../assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <script src="scripts_user.js"></script>
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
                        <img class="border rounded-circle img-profile" src="<?php echo $_SESSION['avatar_usuario']; ?>"></a>
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
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4" style="text-align: center;">
                    Bienvenido
                    <span class="d-none d-lg-inline me-2 text-gray-600 small">
                            <?php
                                $nombre_completo = $_SESSION['nombre_completo_usuario'] ?? '';
                                echo htmlspecialchars($nombre_completo)
                            ?>
                        </span> 
                    </h3>
                </div>
                <section class="clean-block features">
                    <div class="container py-4 py-xl-5" style="display: block;">
                        <section style="padding-top: 40px;">
                            <div class="container" style="text-align: center;">
                                <h1>Modulos</h1>
                            </div>
                            <div class="row justify-content-center" style="margin-right: 0px;margin-left: 0px;">
                            <div class="col-sm-6 col-lg-4" style="margin-top: 35px;">
                                <div onclick="data_liderazgo()" class="card clean-card text-center" style="cursor: pointer;">
                                    <a href="preguntas.php">
                                        <img class="img-fluid card-img-top w-100 d-block" src="../assets/img/iconos/LIDERAZGO_SONQO.png" alt="Liderazgo">
                                    </a>
                                    <div class="card-body info">
                                        <h4 class="card-title">Liderazgo</h4>
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-6 col-lg-4" style="margin-top: 35px;">
                                    <div onclick="data_empatia()" class="card clean-card text-center" style="cursor: pointer;">
                                        <a href="preguntas.php">
                                            <img class="img-fluid card-img-top w-100 d-block" src="../assets/img/iconos/EMPATÍA_SONQO.png" alt="Empatía">
                                        </a>
                                        <div class="card-body info">
                                            <h4 class="card-title">Empatía</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4" style="margin-top: 35px;">
                                    <div onclick="data_resiliencia()" class="card clean-card text-center" style="cursor: pointer;">
                                        <a href="preguntas.php">
                                            <img class="img-fluid card-img-top w-100 d-block" src="../assets/img/iconos/RESILIENCIA_SONQO.png" alt="Resiliencia">
                                        </a>
                                        <div class="card-body info">
                                            <h4 class="card-title">Resiliencia</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section style="padding-top: 40px;">
                            <div class="row justify-content-center" style="margin-right: 0px;margin-left: 0px;">
                                <div class="col-sm-6 col-lg-4" style="margin-top: 35px;">
                                    <div onclick="data_gestion_tiempo()" class="card clean-card text-center" style="cursor: pointer;">
                                        <a href="preguntas.php">
                                            <img class="img-fluid card-img-top w-100 d-block" src="../assets/img/iconos/GESTIÓN_DEL_TIEMPO_SONQO.png" alt="Gestión del Tiempo">
                                        </a>
                                        <div class="card-body info">
                                            <h4 class="card-title">Gestión del tiempo</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4" style="margin-top: 35px;">
                                <div onclick="datac_comunicacion_asertiva()" class="card clean-card text-center" style="cursor: pointer;">
                                    <a href="preguntas.php">
                                        <img class="img-fluid card-img-top w-100 d-block" src="../assets/img/iconos/COMUNICACIÓN_ASERTIVA_SONQO.png" alt="Comunicación Asertiva">
                                    </a>
                                    <div class="card-body info">
                                        <h4 class="card-title">Comunicación Asertiva</h4>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Brand 2023</span></div>
        </div>
    </footer>
    <script src="../assets/bootstrap/js/bootstrap.min.user.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="../assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---1-Index-Table-with-Search--Sort-Filters.js"></script>
    <script src="../assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---Material-UI-Actions.js"></script>
    <script src="../assets/js/theme.js"></script>
</body>

</html>
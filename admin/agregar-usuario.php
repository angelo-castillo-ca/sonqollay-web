<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Profile - Brand</title>
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
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
        <link rel="stylesheet" href="../assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
        <link rel="stylesheet" href="../assets/css/Navbar-Right-Links-icons.css">
        <link rel="stylesheet" href="../assets/css/Navbar.css">
        <link rel="stylesheet" href="../assets/css/Simple-Slider-swiper-bundle.min.css">
        <link rel="stylesheet" href="../assets/css/Simple-Slider.css">
        <link rel="stylesheet" href="../assets/css/Steps-Progressbar.css">
    </head>
    <body style="background: url(&quot;../assets/img/banners/Banner-Sonqollay.jpg&quot;);">
        <div class="container" style="position:absolute; left:0; right:0; top: 50%; transform: translateY(-50%); -ms-transform: translateY(-50%); -moz-transform: translateY(-50%); -webkit-transform: translateY(-50%); -o-transform: translateY(-50%);">
            <div class="row d-flex d-xl-flex justify-content-center justify-content-xl-center">
                <div class="col-sm-12 col-lg-10 col-xl-9 col-xxl-7 bg-white shadow-lg" data-bss-hover-animate="rubberBand" style="border-radius: 5px;">
                    <div class="p-5"><a href="index.html"><img class="img-fluid" src="../assets/img/logos/LOGO%20SONQOLLAY%20CORREGIDO.png"></a>
                        <div class="text-center">
                            <h4 class="text-dark mb-4">Agregar usuario</h4>
                        </div>
                        <form class="user" action="back/agregar-usuario.php" method="post">
                            <div class="mb-3"><input class="form-control form-control-user" type="email" id="email" name="email" placeholder="Email" required=""></div>
                    
                            <div class="row mb-3">
                                <div class="col-sm-6 mb-3 mb-sm-0"><input class="form-control form-control-user" type="password" id="password" name="password" placeholder="Contraseña" required=""></div>
                            </div>
                    
                            <div class="row mb-3">
                                <div class="mb-3 mb-sm-0"><input class="form-control form-control-user" type="text" id="nombres" name="nombres" placeholder="Nombres" required=""></div>
                            </div>
    
                            <div class="row mb-3">
                                <div class="mb-3 mb-sm-0"><input class="form-control form-control-user" type="text" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno" required=""></div>
                            </div>
    
                            <div class="row mb-3">
                                <div class="mb-3 mb-sm-0"><input class="form-control form-control-user" type="text" id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno" required=""></div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="gender"><strong>Género</strong></label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="">Selecciona una opción</option>
                                            <option value="M">Masculino</option>
                                            <option value="F">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <p id="emailErrorMsg" class="text-danger" style="display:none;">Paragraph</p>
                                <p id="passwordErrorMsg" class="text-danger" style="display:none;">Paragraph</p>
                            </div>

                            <button class="btn btn-primary d-block btn-user w-100" type="submit" name="submitBtn">Registrar</button>
                        </form>
                </div>
            </div>
        <script>
        let email = document.getElementById("email")
        let password = document.getElementById("password")
        let submitBtn = document.getElementById("submitBtn")
        let emailErrorMsg = document.getElementById('emailErrorMsg')
        let passwordErrorMsg = document.getElementById('passwordErrorMsg')
    
        function displayErrorMsg(type, msg) {
            if(type == "email") {
                emailErrorMsg.style.display = "block"
                emailErrorMsg.innerHTML = msg
                submitBtn.disabled = true
            }
            else {
                passwordErrorMsg.style.display = "block"
                passwordErrorMsg.innerHTML = msg
                submitBtn.disabled = true
            }
        }
    
        function hideErrorMsg(type) {
            if(type == "email") {
                emailErrorMsg.style.display = "none"
                emailErrorMsg.innerHTML = ""
                submitBtn.disabled = true
                if(passwordErrorMsg.innerHTML == "")
                    submitBtn.disabled = false
            }
            else {
                passwordErrorMsg.style.display = "none"
                passwordErrorMsg.innerHTML = ""
                if(emailErrorMsg.innerHTML == "")
                    submitBtn.disabled = false
            }
        }
        
        // Validate password upon change
        password.addEventListener("change", function() {

                // Check if the password has 8 characters or more
                if(password.value.length >= 8)
                    hideErrorMsg("password")
                else
                    displayErrorMsg("password", "La contraseña debe tener al menos 8 caracteres")
        })
           
        // Validate email upon change
        email.addEventListener("change", function() {
            // Check if the email is valid using a regular expression (string@string.string)
            if(email.value.match(/^[^@]+@[^@]+\.[^@]+$/))
                hideErrorMsg("email")
            else
                displayErrorMsg("email", "Invalid email")
        });
    </script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="../assets/js/Simple-Slider-swiper-bundle.min.js"></script>
    <script src="../assets/js/Simple-Slider.js"></script>
    </div>

</body>
</html>

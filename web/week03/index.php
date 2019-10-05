<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Browse Items</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../src/materialize/css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="../src/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <!--Include Header from template php file-->
    <?php include '../src/php_templates/header_shopping_cart.php'; ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="../images/chocolatechipcookie.jpg">
                            <span class="card-title">Chocolate Chip</span>
                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons" id="chocolate_chip">add_shopping_cart</i></a>
                        </div>
                        <div class="card-content">
                            <p>The chocolate chip cookie that started it all! These original chocolate chip cookies are a true classic and the go-to cookie for all occasions!</p>
                            <br />
                            <p>$1.50 / Cookie</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="../images/sugarcookie.jpg">
                            <span class="card-title">Sugar</span>
                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons" id="sugar">add_shopping_cart</i></a>
                        </div>
                        <div class="card-content">
                            <p>The Sugar cookie that started it all! These original sugar cookies are a true classic and the go-to cookie for all occasions!</p>
                            <br />
                            <p>$1.50 / Cookie</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="../images/snickerdoodlecookie.jpg">
                            <span class="card-title">Snikerdoodle</span>
                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons" id="snickerdoodle">add_shopping_cart</i></a>
                        </div>
                        <div class="card-content">
                            <p>The Snickerdoodle cookie that started it all! These original snickerdoodle cookies are a true classic and the go-to cookie for all occasions!</p>
                            <br />
                            <p>$1.50 / Cookie</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="../images/peanutbuttercookie.jpg">
                            <span class="card-title">Peanut Butter</span>
                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons" id="peanut_butter">add_shopping_cart</i></a>
                        </div>
                        <div class="card-content">
                            <p>The Peanut Butter cookie that started it all! These original peanut butter cookies are a true classic and the go-to cookie for all occasions!</p>
                            <br />
                            <p>$1.50 / Cookie</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="../images/mmcookie.jpg">
                            <span class="card-title">M&M</span>
                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons" id="m_m">add_shopping_cart</i></a>
                        </div>
                        <div class="card-content">
                            <p>The M&M cookie that started it all! These original M&M cookies are a true classic and the go-to cookie for all occasions!</p>
                            <br />
                            <p>$1.50 / Cookie</p>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="../images/chocolatecookie.jpg">
                            <span class="card-title">Chocolate</span>
                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons" id="chocolate">add_shopping_cart</i></a>
                        </div>
                        <div class="card-content">
                            <p>The Chocolate cookie that started it all! These original chocolate cookies are a true classic and the go-to cookie for all occasions!</p>
                            <br />
                            <p>$1.50 / Cookie</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--Include Footer from template php file-->
    <?php include '../src/php_templates/footer.php'; ?>
    <script type="text/javascript" src="../src/materialize/js/materialize.min.js"></script>
    <script type="text/javascript" src="../src/main.js"></script>
    <script type="text/javascript" src="../week03/shopping_cart.js"></script>
</body>

</html>
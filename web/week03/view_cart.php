<!DOCTYPE html>
<html>

<head>
    <title>Shopping Cart</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../src/materialize/css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="../src/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <!--Include Header from template php file-->
    <?php include '../src/php_templates/header_continue_shopping.php'; ?>

    <main>
        <div class="container">
            <h3>Shopping Cart</h3>
            <div id="checkout"></div>
            <div id="shopping_cart"></div>
        </div>
    </main>
    <!--Include Footer from template php file-->
    <?php include '../src/php_templates/footer.php'; ?>
    <script type="text/javascript" src="../src/materialize/js/materialize.min.js">
    </script>
    <script type="text/javascript" src="../src/main.js"></script>
    <script type="text/javascript" src="../week03/shopping_cart.js"></script>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../src/materialize/css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="../src/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <!--Include Header from template php file-->
    <?php include '../src/php_templates/header_cart_return.php'; ?>
    <main>
        <div class="container">
            <h3>Checkout</h3>
            <div class="row">
                <form class="col s12" method="POST" action="../week03/confirmation.php">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">directions</i>
                            <input required id="street" name="street" type="text" class="validate">
                            <label for="street">Street</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">location_city</i>
                            <input required id="city" name="city" type="text" class="validate">
                            <label for="city">City</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">card_membership</i>
                            <input required id="state" name="state" type="text" class="validate">
                            <label for="state">State</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">flag</i>
                            <input required id="country" name="country" type="text" class="validate">
                            <label for="country">Country</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input required id="zip_code" name="zip_code" type="text" class="validate">
                            <label for="zip_code">ZIP Code</label>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light orange" type="submit" name="action">Confirm Purchase
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </main>
    <!--Include Footer from template php file-->
    <?php include '../src/php_templates/footer.php'; ?>
    <script type="text/javascript" src="../src/materialize/js/materialize.min.js">
    </script>
    <script type="text/javascript" src="../src/main.js"></script>
</body>

</html>
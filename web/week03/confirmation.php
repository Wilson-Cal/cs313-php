<?php
$cookie_name = "shopping_cart";
$purchasedItems;
if (isset($_COOKIE[$cookie_name])) {
    $purchasedItems = json_decode($_COOKIE[$cookie_name]);
    setcookie($cookie_name, null, -1);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Confirmation</title>
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
            <h3>Confirmation</h3>
            <h4 class="left-align">Items</h4>
            <div id="purchased_items">
                <ul class="collection left-align">
                    <?php
                    $totalPrice = 0;
                    $puchaseMap = array(
                        "chocolate_chip" => "Chocolate Chip Cookie",
                        "sugar" => "Sugar Cookie",
                        "snickerdoodle" => "Snickerdoodle Cookie",
                        "peanut_butter" => "Peanut Butter Cookie",
                        "m_m" => "M&M Cookie",
                        "chocolate" => "Chocolate Cookie"
                    );
                    foreach ($purchasedItems as $key => $value) {
                        if ($value > 0) {
                            $totalPrice += $value * 1.50;
                            $template = '<li class="collection-item"><div>' . $puchaseMap[$key] . '<a class="secondary-content">Quantity: ' . $value . '</a></div></li>';
                            echo $template;
                        }
                    }
                    ?>
                    <li class="collection-item">
                        <div><strong>Total Price:</strong><a class="secondary-content">$<?php echo number_format((float) $totalPrice, 2, '.', ''); ?></a></div>
                    </li>
                </ul>

            </div>
            <h4 class="left-align">Shipping To</h4>
            <?php
            $street = $city = $state = $country = $zipCode = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $street = test_input($_POST["street"]);
                $city = test_input($_POST["city"]);
                $state = test_input($_POST["state"]);
                $country = test_input($_POST["country"]);
                $zipCode = test_input($_POST["zip_code"]);
            }
            function test_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">directions</i>
                            <input disabled id="street_address" name="street_address" type="text" class="validate" value="<?php echo $street ?>">
                            <label for="street_address">Street Address</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">location_city</i>
                            <input disabled id="city" name="city" type="text" class="validate" value="<?php echo $city ?>">
                            <label for="city">City</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">card_membership</i>
                            <input disabled id="state" name="state" type="text" class="validate" value="<?php echo $state ?>">
                            <label for="state">State</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">flag</i>
                            <input disabled id="country" name="country" type="text" class="validate" value="<?php echo $country ?>">
                            <label for="country">Country</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input disabled id="zip_code" name="zip_code" type="text" class="validate" value="<?php echo $zipCode ?>">
                            <label for="zip_code">ZIP Code</label>
                        </div>
                    </div>
                </div>
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
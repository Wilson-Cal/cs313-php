<?php
class ShoppingCart
{
    function ShoppingCart()
    {
        $this->chocolate_chip = 0;
        $this->sugar = 0;
        $this->snickerdoodle = 0;
        $this->peanut_butter = 0;
        $this->m_m = 0;
        $this->chocolate = 0;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_POST["x"], false);
    $key = $obj->name;
    $remove = $obj->remove;
    $update = $obj->update;
    $quantity = $obj->quantity;
    $cookie_name = "shopping_cart";
    if (isset($_COOKIE[$cookie_name])) {
        $shopping_cart = json_decode($_COOKIE[$cookie_name]);
        if ($remove) {
            $shopping_cart->$key = 0;
        } else if ($update) {
            $shopping_cart->$key = $quantity;
        } else {
            $shopping_cart->$key += $quantity;
        }
        $cookie_value = json_encode($shopping_cart);
        setcookie($cookie_name, $cookie_value);
        echo $cookie_value;
    } else {
        $shopping_cart = new ShoppingCart();
        $shopping_cart->$key += $quantity;
        $cookie_value = json_encode($shopping_cart);
        setcookie($cookie_name, $cookie_value);
        echo $shopping_cart->$key;
    }
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("Content-Type: application/json; charset=UTF-8");
    $cookie_name = "shopping_cart";
    if (isset($_COOKIE[$cookie_name])) {
        echo $_COOKIE[$cookie_name];
    } else {
        $shopping_cart = new ShoppingCart();
        $response = json_encode($shopping_cart);
        echo $response;
    }
}

<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PC Part Index</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="shortcut icon" type="img/icon" href="favicon.ico" />
</head>

<body>
    <ul class="nav">
        <li>
            <a href="">Home</a>
        </li>
        <select id="categories">
        </select>
        <li id="favorites">
            Favorites
        </li>
        <input type="search" placeholder="Search...">
        <?php
        if (isset($_COOKIE["user_id"])) {
            echo '<li id="user_account_log_out">Log Out</li>';
        } else {
            echo '<li id="user_account">Log In</li>';
        }
        ?>
    </ul>
    <h1 class="title">PC Part Index</h1>
    <div id="loader"></div>
    <div class="content" id="animate-bottom">
        <h2 id="categoryTitle"></h2>
        <table id="components">
            <tbody></tbody>
        </table>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="favorite" data-star="off"></span>
                <span class="close">&times;</span>
                <h2 id="item-name"></h2>
            </div>
            <div class="modal-body">
                <h3>Information</h3>
                <table id="modal-components">
                    <tbody id="modal-table-body"></tbody>
                </table>
            </div>
            <div class="modal-body">
                <h3>Amazon Link</h3>
                <a id="amazon-link" target="_blank"></a>
                <h3>Newegg Link</h3>
                <a id="newegg-link" target="_blank"></a>
            </div>
        </div>
    </div>
    <div id="log_in_modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Log In</h2>
            </div>
            <div class="modal-body">
                <h3>Email</h3>
                <input type="text" id="email_input">
                <h3>Password</h3>
                <input type="password" id="password_input">
            </div>
            <div class="modal-body">
                <a class="button" id="log_in_button">Log In</a>
                <a class="button" id="sign_up_button">Sign Up</a>
            </div>
        </div>
    </div>
    <div id="sign_up_modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Sign Up</h2>
            </div>
            <div class="modal-body">
                <h3>Username</h3>
                <input type="text" id="username_sign_up">
                <h3>Email</h3>
                <input type="text" id="email_sign_up">
                <h3>Password</h3>
                <input type="password" id="password_sign_up">
            </div>
            <div class="modal-body">
                <a class="button" id="sign_up">Sign Up</a>
                <p id="signupError"></p>
            </div>
        </div>
    </div>
    <footer>
        <ul>
            <li>Created by: Cal Wilson - 2018</li>
            <li>Email:
                <a href="mailto:calwils@gmail.com">calwils@gmail.com</a>
            </li>
            <li>GitHub:
                <a href="https://github.com/Wilson-Cal">https://github.com/Wilson-Cal</a>
            </li>
        </ul>
    </footer>
</body>
<script src="main.js"></script>

</html>
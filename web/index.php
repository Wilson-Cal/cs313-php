<!DOCTYPE html>
<html>

<head>
  <title>CS 313 Homepage</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="./src/materialize/css/materialize.min.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="./src/main.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <?php include './src/php_templates/header.php'; ?>
  <main>
    <div class="container">
      <div class="row">
        <div class="col s12">
          <h1>CS 313 Homepage</h1>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <a class="waves-effect waves-light btn-large orange" href="./week02/about_me.php"><i class="material-icons left">account_circle</i>About Me</a>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <a class="waves-effect waves-light btn-large orange" href="./week02"><i class="material-icons left">assignment</i>Assignments</a>
        </div>
      </div>
    </div>
  </main>
  <?php include './src/php_templates/footer.php'; ?>
  <script type="text/javascript" src="./src/materialize/js/materialize.min.js">
  </script>
  <script type="text/javascript" src="./src/main.js"></script>
</body>

</html>
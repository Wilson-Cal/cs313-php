<!DOCTYPE html>
<html>

<head>
    <title>CS 313 - About Me</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../src/materialize/css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="../src/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <!--Include Header from template php file-->
    <?php include '../src/php_templates/header.php'; ?>
    <main>
        <div>
            <div class="row">
                <div class="col s12 m4">
                </div>
                <div class="col s12 m4">
                    <h1 class="center-align">About Me</h1>
                    <img src="../images/me.jpg" class="responsive-img">
                    <p>
                        Hi! My name is Cal Wilson. I am currently in my last semester as a student at BYU-Idaho.
                        I am studying Software Engineering and I really have enjoy the things I have learned. I
                        am very excited to graduate and begin my career as a software developer.
                    </p>
                    <p>
                        I met my wife a little over two years ago. Life has been nothing short of amazing with her.
                        She helps me become a little better everyday. I am grateful to her for her example and spirit.
                    </p>
                    <img src="https://www.huntsville.org/includes/public/assets/logo.svg">
                    <p>
                        I am originally from Huntsville, Alabama. The area is quickly growing due to the large amounts
                        of technology, aerospace, and military contract jobs available. It is a great place to grow up
                        and raise a family.
                    </p>
                    <p>
                        I currently work as a Student Software Developer for BYU-Idaho's IT department. I do alot of
                        work in NodeJS and C#. We mostly interact with and write automation tools for I-Learn via the
                        <a href="https://canvas.instructure.com/doc/api/" target="_blank">Canvas Rest API</a>.
                    </p>
                    <img src="https://cdn4.iconfinder.com/data/icons/logos-3/600/React.js_logo-512.png" class="responsive-img">
                    <p>
                        In my free time, I really enjoy developing applications using React. React is a very cool library
                        that allows you to create apps for multiple clients. I believe they currently support web, mobile,
                        and VR. I haven't made a VR app yet, but I really want to. I just lack a VR headset.
                    </p>
                    <p>
                        I also really enjoy playing video games. I'm mostly into games like Space Engineers, Kerbal Space
                        Program, No Mans Sky, Star Wars Battlefront II, and Minecraft. I also enjoy OSRS. If you play
                        let me know.
                    </p>
                </div>
                <div class="col s12 m4">
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
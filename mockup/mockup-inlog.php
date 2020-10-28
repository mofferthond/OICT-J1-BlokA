<!DOCTYPE html>
<html> 
    <head>
    <title>Mijn Account | by Daniel Kuiper</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/media.css">
    <link rel="stylesheet" href="/css/typography.css">
    <link rel="stylesheet" href="https://use.typekit.net/ffn0jjk.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../images/favicon-3.png">
    </head>
<body>
    <!-- 3.1 -->
    <div class="login-body">
        <!-- 3.1.1 -->
        <div class="overlap-264653-50 overlap-login">
            <!-- 3.1.1.1 -->
            <div class="login-container container">
                <!-- 3.1.1.1.1 -->
                <h2 id="title" class="login-title">Inloggen</h2>
                <!-- 3.1.1.1.2 -->
                <div id="login-wrapper" class="login-wrapper">
                    <!-- 3.1.1.1.2.1 -->
                    <form class="login-form" action="login.php" method="post" style="display: block;">
                        <!-- 3.1.1.1.2.1.1 -->
                        <div class="form-container">
                            <!-- 3.1.1.1.2.1.1.1 -->
                            <input type="email" name="email" placeholder="Emailadres" class="input-email" required>
                            <!-- 3.1.1.1.2.1.1.2 -->
                            <input type="password" name="password" placeholder="Wachtwoord" class="input-password" required>
                            <!-- 3.1.1.1.2.1.1.3 -->
                            <div class="login-col1 login-col">
                                <!-- 3.1.1.1.2.1.1.3.1 -->
                                <input type="submit" value="Login" class="login-submit">
                            </div>
                            </form>
                            <!-- 3.1.1.1.2.1.1.4 -->
                            <div class="login-col2 login-col">
                                <!-- 3.1.1.1.2.1.1.4.1 -->
                                <a onclick="showRegister()" class="register-button">nog niet geregistreerd?</a>
                            </div>
                        </div>
                </div>
                <!-- 3.1.1.1.3 -->
                <div id="registration-wrapper" class="login-wrapper" style="display: none;">
                    <!-- 3.1.1.1.3.1 -->
                    <form class="registration-form" action="../handlers/registration.php" method="post">
                        <!-- 3.1.1.1.3.1.1 -->
                        <div class="form-container">
                            <!-- 3.1.1.1.3.1.1.1 -->
                            <input type="text" name="first_name" placeholder="Voornaam" class="input-name-first" required>
                            <!-- 3.1.1.1.3.1.1.2 -->
                            <input type="text" name="last_name" placeholder="Achternaam" class="input-name-last" required>
                            <!-- 3.1.1.1.3.1.1.3 -->
                            <input type="email" name="email" placeholder="Emailadres" class="input-email" required>
                            <!-- 3.1.1.1.3.1.1.4 -->
                            <input type="password" name="password" placeholder="Wachtwoord" class="input-password" required>
                            <!-- 3.1.1.1.3.1.1.5 -->
                            <label class="title-radio">Account-type:</label>
                            <!-- 3.1.1.1.3.1.1.6 -->
                            <div class="input-radio">
                                <!-- 3.1.1.1.3.1.1.6.1 -->
                                <input type="radio" name="visibility" value="open" class="input-input-radio" checked>
                                <!-- 3.1.1.1.3.1.1.6.2 -->
                                <label for="open" class="label-input-radio">Open</label>
                                <!-- 3.1.1.1.3.1.1.6.3 -->
                                <input type="radio" name="visibility" value="protected" class="input-input-radio">
                                <!-- 3.1.1.1.3.1.1.6.4 -->
                                <label for="protected" class="label-input-radio">Protected</label>
                                <!-- 3.1.1.1.3.1.1.6.5 -->
                                <input type="radio" name="visibility" value="private" class="input-input-radio">
                                <!-- 3.1.1.1.3.1.1.6.6 -->
                                <label for="private" class="label-input-radio">Private</label>
                            </div>
                            <!-- 3.1.1.1.3.1.1.7 -->
                            <div class="login-col1 login-col">
                                <!-- 3.1.1.1.3.1.1.7.1 -->
                                <input type="submit" value="Registreer" class="login-submit">
                            </div>
                            
                            <!-- 3.1.1.1.3.1.1.8 -->
                            <div class="login-col2 login-col">
                                <!-- 3.1.1.1.3.1.1.8.1 -->
                                <a onclick="showLogin()" class="register-button">terug naar inloggen</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 3.2 -->
    <script>
        function showRegister(){
            document.getElementById('title').innerHTML = 'Registreren';
            document.getElementById('login-wrapper').style.display = 'none';
            document.getElementById('registration-wrapper').style.display = 'block';
        }

        function showLogin(){
            document.getElementById('title').innerHTML = 'Inloggen';
            document.getElementById('login-wrapper').style.display = 'block';
            document.getElementById('registration-wrapper').style.display = 'none';
        }
        

    </script>
</body>
</html>
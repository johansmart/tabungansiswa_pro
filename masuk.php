
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tabungan Siswa - Login</title>
    <!-- meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="Login Tabungan Siswa"
    />
    <!-- /meta tags -->
    <!-- custom style sheet -->
    <link href="masuk/css/style.css" rel="stylesheet" type="text/css" />
    <!-- /custom style sheet -->
    <!-- fontawesome css -->
    <link href="masuk/css/fontawesome-all.css" rel="stylesheet" />
    <!-- /fontawesome css -->
    <!-- google fonts-->
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- /google fonts-->

</head>


<body>
    <br><center><img src="dist/img/profile/bank.png" width="90" height="90"></center><br>
    <div class=" w3l-login-form">
        <h2>Login Here</h2>
        <form action="index.php?page=act-login&op=in" method="POST">

            <div class=" w3l-form-group">
                <label>Rekening:</label>
                <div class="group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="id_user" autocomplete="off" class="form-control" placeholder="Rekening" required="required" />
                </div>
            </div>
            <div class=" w3l-form-group">
                <label>Password:</label>
                <div class="group">
                    <i class="fas fa-unlock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password" required="required" />
                </div>
            </div>
            <div class="forgot">
                <a href="index.php?page=form-register">Belum Daftar?</a>
                <p><input type="checkbox">Remember Me</p>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
<br>

</body>

</html>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Retreat Centre Sukamakmur | Log in</title>

    <base href="<?php echo base_url() ?>">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dist/css/AdminLTE.min.css">

</head>

<body class="hold-transition login-page">

<div class="login-box">

    <div class="login-logo">
        <a href="#"><b>RC </b>Sukamakmur</a>
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Harap Login untuk Melanjutkan</p>

        <form action="login" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Username" name="username">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="_submit">Sign In</button>
                </div>
                <div class="col-xs-6">
                    <button class="btn btn-default btn-block btn-flat" type="reset">Reset</button>
                </div>
            </div>
        </form>
        <div class="social-auth-links text-center">
            <font color ="red"><p><?php echo $Reason ?></p></font>
        </div>

        <br/>

        <a href="pengunjung/buatakun" class="text-center">Register a new membership</a>

    </div>
</div>

</body>
</html>

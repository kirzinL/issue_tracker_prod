<?php
session_start();
if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0){
    header("Location:./");
    exit;
}
require_once('DBConnection.php');
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drakester Inc TS</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</head>

<style>
    body{
        background-image:url("assets/bg.jpg");
        background-size:100% 100%;
    }
    .hero{
        border:solid;
        height:100vh;
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
    }
    .login-card{
        border:solid;
        width: 20rem;
        height:auto;
        border-radius:10px;
        padding:25px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .btn-login{
        border-radius:10px;
        width: 100%;
        margin-top:15px;
    }
</style>


<body>
    
<div class="hero">
    <div class="header">
        <h1 class="text-white">Ticketing System</h1>
    </div>
    <div class="login-card">
        <div class="login-body">
           <img src="assets/drakester-logo.png" class="mb-3" width=220px>
            <form action="" id="login-form">
                    
                    <div class="form-group">
                        <label for="username" class="control-label text-white">Username </label>
                        <input type="text" id="username" autofocus name="username" class="form-control form-user-pass " required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label text-white">Password</label>
                        <input type="password" id="password" name="password" class="form-control  form-user-pass " required>
                    </div>
                    <div class="form-group d-flex w-100 justify-content-end">
                        <button class="btn btn-login btn-primary ">Login
                            <img src="assets/login.png" width=20>
                        </button>
                    </div>
                    <hr>
                    <div class="forget">
                        <span class="forget-text text-white">forgot your password? contact your Administrator</span>
                    </div>
                </form>
        </div>
    </div>
</div>
</body>
</html>


<script>
    $(function(){
        $('#login-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            _this.find('button').attr('disabled',true)
            _this.find('button[type="submit"]').text('Loging in...')
            $.ajax({
                url:'Actions.php?a=login',
                method:'POST',
                data:$(this).serialize(),
                dataType:'JSON',
                error:err=>{
                    console.log(err)
                    _el.addClass('alert alert-danger')
                    _el.text("An error occurred.")
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled',false)
                    _this.find('button[type="submit"]').text('Save')
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        _el.addClass('alert alert-success')
                        setTimeout(() => {
                            location.replace('./');
                        }, 2000);
                    }else{
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg)

                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled',false)
                    _this.find('button[type="submit"]').text('Save')
                }
            })
        })
    })
</script>
</html>
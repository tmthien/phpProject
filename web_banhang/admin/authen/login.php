<?php
    session_start();

    require_once('../../utils/utility.php');
    require_once('../../database/dbhelper.php');
    require_once('process_form_login.php');

    $user = getUserToken();
    if($user != null) {
        header('Location: ../');
        die();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập</title>
    <link rel="stylesheet" href="../../assets/css/login.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

</head>
<body>
	<div class="container">
    <div class="panel panel-primary main-form">
            <div class="panel-heading">
                <h2 class="text-center">Đăng nhập</h2>
                <!-- <h4 class="text-center" style="color: red;"><?=$msg?></h4> -->
            </div>
            <div class="panel-body">
                <form method="post">                  
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input required="true" placeholder="Nhập Email" type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group show-pwd">
                        <label for="pwd">Mật khẩu:</label>
                        <input required="true" type="password" placeholder="Nhập Mật Khẩu" class="form-control" id="pwd" name="password" minlength="6">
                        <span class="show-btn"><i class="fas fa-eye"></i></span>
                    </div>
                    <p>
                        Bạn chưa có tài khoản?
                        <a href="register.php">Đăng ký</a>
                    </p>
                    <button class="btn btn-success">Đăng nhập</button>
                </form>
            </div>
        </div>
	</div>

    <script type="text/javascript">
        const passField = document.querySelector("input");
        const showBtn = document.querySelector("span i");
        showBtn.onclick = (()=>{
            if(passField.type === "password"){
                passField.type = "text";
                showBtn.classList.add("hide-btn");
            }else{
                passField.type = "password";
                showBtn.classList.remove("hide-btn");
            }
        });
    </script>
</body>
</html>
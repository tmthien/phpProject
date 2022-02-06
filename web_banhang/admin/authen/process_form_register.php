<?php

    $fullname = $email = $msg = '';

    if(!empty($_POST)) {
        $fullname = getPost('fullname');
        $email = getPost('email');
        $pwd = getPost('password');

        //validate

        if(empty($fullname) || empty($email) || empty($pwd) || strlen($pwd)<6) {
        }
        else {
            //validate thành công

            $userExist = executeResult("SELECT * FROM user where email = '$email'", true);

            if($userExist != null) {
                $msg = 'Email đã tồn tại!!';
            }
            else {
                $created_at = $updated_at = date('Y-m-d H:i:s');
                //Sử dụng mã hoá 1 chiều MD5
                $pwd = getSecurityMD5($pwd);

                $sql = "INSERT into user (fullname, email, password, role_id, created_at, updated_at, deleted) 
                values ('$fullname', '$email', '$pwd', 2, '$created_at', '$updated_at', 0)";
                execute($sql);
                header('Location: login.php');
                die();
            }
        } 
        
    }



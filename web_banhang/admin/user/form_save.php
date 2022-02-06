<?php  
    if(!empty($_POST)) {
        $id             = getPost('id');

        $fullname       = getPost('fullname');
        $email          = getPost('email');
        $phone_number   = getPost('phone_number');
        $address        = getPost('address');
        $password       = getPost('password');
        $role_id        = getPost('role_id');

        if($password != '') {
            $password = getSecurityMD5($password);
        }

        $created_at = $updated_at = date("Y-m-d H:i:s");

        if($id > 0) {
            //update 
            $sql = "SELECT * FROM user where email = '$email' and id <> $id";
            $userItem = executeResult($sql, true);

            if($userItem != null) {
                $msg = 'Không thể chỉnh sửa email, vui lòng thực hiện lại';
            }
            else {
                if($password != '') {
                    $sql = "UPDATE user set fullname = '$fullname', email = '$email', phone_number = '$phone_number',role_id = '$role_id', address = '$address', password = '$password', updated_at = '$updated_at' where id = $id";
                }
                else {
                    $sql = "UPDATE user set fullname = '$fullname', email = '$email', phone_number = '$phone_number',role_id = '$role_id', address = '$address', updated_at = '$updated_at' where id = $id";
                }
                execute($sql);
                header('Location: index.php');
                die();
            }

        }

        else {
            $sql = "SELECT * FROM user where email = '$email'";
            $userItem = executeResult($sql, true);
            //insert
            if($userItem == null) {
                //insert dữ liệu
                $sql = "INSERT into user(fullname, email, phone_number, address, password, role_id, created_at, updated_at, deleted) 
                values ('$fullname', '$email', '$phone_number', '$address', '$password', '$role_id', '$created_at', '$updated_at', 0)";
    
                execute($sql);
                header('Location: index.php');
                die();
            }
            else {
                //Email đã tồn tại - Yêu cầu nhập lại
                $msg = 'Email đã được đăng ký! Vui lòng nhập lại.';
            }
        }
    }

?>
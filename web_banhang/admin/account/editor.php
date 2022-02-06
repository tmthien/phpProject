<?php

    $title = 'Thêm/Sửa tài khoản Admin';
    $baseUrl = '../';
    require_once($baseUrl.'layouts/header.php');

    $id = $msg = $fullname = $email = $phone_number = $address = $role_id = '';

    require_once('form_save.php');

    $id = getGet('id');

    if($id != '' && $id > 0) {
        $sql = "SELECT * FROM user where id = '$id'";
        $userItem = executeResult($sql, true); 

        if($userItem != null) {
            $fullname       = $userItem['fullname'];
            $email          = $userItem['email'];
            $phone_number   = $userItem['phone_number'];
            $address        = $userItem['address'];
            $role_id        = $userItem['role_id'];
        }
        else {
            $id = 0;
        }
    }
    else {
        $id = 0;
    }

    $sql = "SELECT * FROM role";
    $roleItems = executeResult($sql);
?>  

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center pt-4 pb-4">Thêm/Sửa tài khoản Admin</h1>
            <h4 class="text-center pt-4 pb-4" style="color:red;"><?=$msg?></h4>
        </div>
        <div class="container" style="width: 60%;">
            <div class="panel panel-primary main-form" >
                <div class="panel-body" >
                    <form method="post" onsubmit="return validateForm(); ">
                        <div class="form-group">
                            <label for="usr">Tên:</label>
                            <input required="true" type="text" class="form-control" id="usr" name="fullname" value="<?=$fullname?>">
                            <input type="text" name="id" value="<?=$id?>" hidden="true">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input required="true" type="email" class="form-control" id="email" name="email" value="<?=$email?>">
                        </div>
                        <div class="form-group">
                        <label for="role">Role:</label>
                        <select class="form-control" name="role_id" id="role_id"  require="true">
                            <option value="">--Chọn--</option>
                            <?php
                                foreach ($roleItems as $role) {
                                    if($role['id'] == $role_id) {
                                        echo '
                                            <option selected value="'.$role['id'].'">'.$role['name'].'</option>
                                        ';
                                    }
                                    echo '
                                        <option value="'.$role['id'].'">'.$role['name'].'</option>
                                    ';
                                }
                            ?>
                        </select>
                        <div class="form-group">
                            <label for="phone_number">SĐT:</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?=$phone_number?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Địa chỉ:</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?=$address?>">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Mật khẩu:</label>
                            <input <?=($id > 0 ? '': 'required="true"')?> type="text" class="form-control" id="pwd" name="password" minlength="6">
                            <!-- <span class="show-btn"><i class="fas fa-eye"></i></span> -->
                        </div>
                        <div class="form-group">
                            <label for="confirmation_pwd">Nhập lại mật khẩu:</label>
                            <input <?=($id > 0 ? '': 'required="true"')?> type="text" class="form-control" id="confirmation_pwd" minlength="6">
                            <!-- <span class="show-btn"><i class="fas fa-eye"></i></span> -->
                        </div>
                        <button class="btn btn-success" style="width:100px;">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    function validateForm() {
        $pwd = $('#pwd').val();
        $confirmPwd = $('#confirmation_pwd').val();
        if ($pwd != $confirmPwd) {
            alert("Mật khẩu không trùng khớp! Vui lòng nhập lại mật khẩu")
            return false
        }
        return true
    }
    </script>
<?php
    require_once($baseUrl.'layouts/footer.php');
?>
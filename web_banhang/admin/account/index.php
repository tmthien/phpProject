<?php

    $title = 'Quản lý tài khoản admin';
    $baseUrl = '../';
    require_once($baseUrl.'layouts/header.php');
    $sql = "SELECT user.*, role.name as role_name from user left join role on user.role_id = role.id where user.deleted = 0 and user.role_id=1";
    $data = executeResult($sql);
?>  
    
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center pt-4 pb-4">Quản lý tài khoản Admin</h1>
            <a href="editor.php" >
                <button class="btn btn-success" style="margin:20px">
                    Thêm mới
                </button>
            </a>

            <table class="table table-bordered table-hover table-reponsive mx-2" style="width: 99%;">
                <thead>
                    <tr>
                        <th style="width:50px;">STT</th>
                        <th>Họ & Tên</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th style="width:100px;">Quyền</th>
                        <th style="width:50px"></th>
                        <th style="width:50px"></th>
                    </tr>
                    <a href=""></a>
                </thead>
                <tbody>
                    <?php
                    $index = 0;
                        foreach ($data as $item) {
                            echo'
                            <tr>
                                <th>'.(++$index).'</th>
                                <td>'.$item['fullname'].'</td>
                                <td>'.$item['email'].'</td>
                                <td>'.$item['phone_number'].'</td>
                                <td>'.$item['address'].'</td>
                                <td>'.$item['role_name'].'</td>
                                <th style="text-align: center;">
                                    <a href="editor.php?id='.$item['id'].'" style="padding: 8px; color: #060ccd;">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                </th>
                                <th style="text-align: center;">
                                    <a style="padding: 8px; color: #ff1d05;">
                                        <i class="fas fa-user-times"></i>
                                    </a>
                                </th>
                            </tr>    
                            ';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
    require_once($baseUrl.'layouts/footer.php');
?>
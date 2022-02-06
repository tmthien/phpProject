<?php
    session_start();

    require_once('../../utils/utility.php');
    require_once('../../database/dbhelper.php');

    $user = getUserToken();
    if($user == null) {
        die();
    }

    if(!empty($_POST)) {
        $action = getPost('action');

        switch ($action) {
            case 'delete':
                deleteCategory();
                break;
        }
    }

    function deleteCategory() {
        $id = getPost('id');

        $sql = "SELECT COUNT(*) as total from product where category_id = '$id' and deleted =0";
        $data = executeResult($sql, true);
        $total = $data['total'];
        
        if($total > 0) {
            echo'Danh mục đang chứa sản phẩm! Không thể xoá';
            die();
        }

        $sql = "DELETE FROM category where id = '$id' ";
        execute($sql);
    }
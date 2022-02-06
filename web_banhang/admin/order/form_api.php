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
            case 'update_status':
                update_status();
                break;
        }
    }

    function update_status() {
        $id = getPost('id');
        $status = getPost('status');

        $updated_at = date("Y-m-d H:i:s");
        $sql = "UPDATE orders set status = $status where id = '$id' ";
        execute($sql);
    }
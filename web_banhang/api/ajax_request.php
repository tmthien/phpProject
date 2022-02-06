<?php

    session_start();
    require_once('../database/dbhelper.php');
    require_once('../utils/utility.php');

    $action = getPost('action');

    switch ($action) {
        case 'cart': 
            addToCart();
            break;
        case 'update_cart': 
            updateCart();
            break;
        case 'checkout';
            checkout(); 
            break;    
    }

    function checkout(){
        if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
            return;
        }

        $fullname = getPost('fullname');
        $email = getPost('email');
        $phone_number = getPost('phone_number');
        $address = getPost('address');
        $note = getPost('note');

        $user = getUserToken();
        $userId = 0;
        if($user != null) {
            $userId = $user['id'];
        }

        $orderDate = date('Y-m-d H:i:s');
        $totalMoney = 0;
        foreach($_SESSION['cart'] as $item) {
            $totalMoney += $item['discount'] * $item['num'];
        }

        $sql = "INSERT INTO orders(user_id, fullname, email, phone_number, address, note, order_date, total_money)
        values('$userId', '$fullname', '$email', '$phone_number', '$address', '$note', '$orderDate', '$totalMoney')";
        execute($sql);

        $sql = "SELECT * FROM orders WHERE order_date = '$orderDate'";
        $orderItem = executeResult($sql, true);

        $orderId = $orderItem['id'];

        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['id'];
            $price = $item['discount'];
            $num = $item['num'];
            $totalMoney = $price * $num;
        
            $sql = "INSERT INTO order_details(order_id, product_id, price, num, total_money)
            values ('$orderId', '$product_id', '$price', '$num', '$totalMoney')";
            execute($sql);
        }

        unset($_SESSION['cart']);

    }

    function updateCart(){
        $id = getPost('id');
        $num = getPost('num');

        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        for($i = 0; $i < count($_SESSION['cart']); $i++) {
            if($_SESSION['cart'][$i]['id'] == $id){
                $_SESSION['cart'][$i]['num'] = $num;
                if($num <= 0){
                    array_splice($_SESSION['cart'], $i, 1);
                }
                break;
            }
        }
    }

    function addToCart() {
        $id = getPost('id');
        $num = getPost('num');

        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $isFind =false;
        for($i = 0; $i < count($_SESSION['cart']); $i++) {
            if($_SESSION['cart'][$i]['id'] == $id){
                $_SESSION['cart'][$i]['num'] += $num;
                $isFind = true;
                break;
            }
        }

        if(!$isFind) {
            $sql  = "SELECT product.*, category.name as category_name 
            from product left join category on product.category_id = category.id 
            where product.id = $id ";
            $product = executeResult($sql, true);
            $product['num'] = $num;
            $_SESSION['cart'][] = $product;
        }
    }
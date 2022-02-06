<?php

    $title = 'Chi tiết đơn hàng';
    $baseUrl = '../';
    require_once($baseUrl.'layouts/header.php');

    $orderId = getGet('id');

    $sql = "SELECT order_details.*, product.thumbnail, product.title FROM order_details left join product on product.id = order_details.product_id WHERE order_details.order_id = $orderId";
    $data = executeResult($sql);

    $sql = "SELECT * FROM orders WHERE id =$orderId";
    $orderItem = executeResult($sql, true);
?>  
   <div class="row">
        <div class="col-md-12">
            <h1 class="text-center pt-4 pb-4">Chi tiết đơn hàng</h1>
        </div>

        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered table-hover table-reponsive mx-2" style="width: 99%;">
                    <thead>
                        <tr>
                            <th style="width:50px;">STT</th>
                            <th>Hình ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
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
                                    <td>
                                        <img style="max-height:120px;" src="'.fixUrl($item['thumbnail']).'"
                                        </td>
                                    <td>'.$item['title'].'</td>
                                    <td>'.$item['price'].'</td>
                                    <td>'.$item['num'].'</td>
                                    <td>'.$item['total_money'].'</td>
                                </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <table class="table table-bordered table-hover table-reponsive mx-2" style="width: 99%;">
                        <tr>
                            <th>Họ & Tên</th>
                            <td><?=$orderItem['fullname']?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?=$orderItem['email']?></td>
                        </tr>
                        <tr>
                            <th>SĐT</th>
                            <td><?=$orderItem['phone_number']?></td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td><?=$orderItem['address']?></td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
<?php
    require_once($baseUrl.'layouts/footer.php');
?>
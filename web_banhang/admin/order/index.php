<?php

    $title = 'Quản lý đơn hàng';
    $baseUrl = '../';
    require_once($baseUrl.'layouts/header.php');

    $sql = "SELECT * FROM orders order by status asc, order_date desc";
    $data = executeResult($sql);
?>  
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center pt-4 pb-4">Quản lý đơn hàng</h1>
            <table class="table table-bordered table-hover table-reponsive mx-2" style="width: 99%;">
                <thead>
                    <tr>
                        <th style="width:50px;">STT</th>
                        <th>Họ Tên</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Nội dung</th>
                        <th>Ngày tạo</th>
                        <th>Tổng tiền</th>
                        <th style="width:100px"></th>
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
                                <td>'.$item['note'].'</td>
                                <td>'.$item['order_date'].'</td>
                                <td>'.$item['total_money'].'</td>';
                                if( $item['status'] == 0) {
                                    echo'
                                        <th style="text-align: center;">
                                            <a onclick="changeStatus('.$item['id'].', 1)" style="padding: 8px; color: #028912;">
                                                <i class="fas fa-check-square"></i>
                                            </a>
                                      
                                            <a onclick="changeStatus('.$item['id'].', 2)" style="padding: 8px; color: #ff0018;">
                                                <i class="fas fa-window-close"></i>
                                            </a>
                                        </th>
                                    ';
                                }
                                else if($item['status'] == 1){
                                    echo'
                                        <th style="text-align: center; color: #028912;">
                                           <label class="">Accepted</label>
                                        </th>';
                                    }
                                else {
                                    echo'
                                        <th style="text-align: center; color: #ff0018;">
                                            <label class="">Cancelled</label>
                                        </th>';
                                    }    
                                    echo'
                                        <th style="text-align: center; color: #ff0018;">
                                            <a href="detail.php?id='.$item['id'].'" style="padding: 8px; color: #028ad9;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </th>
                                    </tr>';
                            }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        function changeStatus(id, status) {
            $.post('form_api.php', {
                'id': id,
                'status': status,
                'action': 'update_status'
            }, 
            function (data) {
                location.reload()
            })
        }
    </script>
<?php
    require_once($baseUrl.'layouts/footer.php');
?>
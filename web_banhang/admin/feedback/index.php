<?php

    $title = 'Quản lý phản hồi';
    $baseUrl = '../';
    require_once($baseUrl.'layouts/header.php');

    $sql = "SELECT * FROM feedback order by status asc, updated_at desc";
    $data = executeResult($sql);
?>  
   <div class="row">
        <div class="col-md-12">
            <h1 class="text-center pt-4 pb-4">Quản lý Phản hồi</h1>
            <table class="table table-bordered table-hover table-reponsive mx-2" style="width: 99%;">
                <thead>
                    <tr>
                        <th style="width:50px;">STT</th>
                        <th>Tên</th>
                        <th>Họ</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Chủ đề</th>
                        <th>Nội dung</th>
                        <th>Ngày tạo</th>
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
                                <td>'.$item['lastname'].'</td>
                                <td>'.$item['firstname'].'</td>
                                <td>'.$item['email'].'</td>
                                <td>'.$item['phone_number'].'</td>
                                <td>'.$item['subject_name'].'</td>
                                <td>'.$item['note'].'</td>
                                <td>'.$item['updated_at'].'</td>';
                                if( $item['status'] == 0) {
                                    echo'
                                        <th style="text-align: center;">
                                            <a onclick="markRead('.$item['id'].')" style="padding: 8px; color: #0e58df;">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </th>
                                    ';
                                }
                                else {
                                    echo'
                                        <th style="text-align: center;">
                                            <a style="padding: 8px; color: #028912;">
                                                <i class="far fa-check-circle"></i>
                                            </a>
                                        </th>
                            </tr>';
                                }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        function markRead(id) {
            $.post('form_api.php', {
                'id': id,
                'action': 'mark'
            }, 
            function (data) {
                location.reload()
            })
        }
    </script>
<?php
    require_once($baseUrl.'layouts/footer.php');
?>
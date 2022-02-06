<?php

    $title = 'Quản lý sản phẩm';
    $baseUrl = '../';
    require_once($baseUrl.'layouts/header.php');

    $sql = "SELECT product.*, category.name as category_name from product left join category on product.category_id = category.id where product.deleted = 0";
    $data = executeResult($sql);
?>  

    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center pt-4 pb-4">Quản lý người dùng</h1>
            <a href="editor.php" >
                <button class="btn btn-success" style="margin:20px">
                    Thêm mới sản phẩm
                </button>
            </a>

            <table class="table table-bordered table-hover table-reponsive mx-2" style="width: 99%;">
                <thead>
                    <tr>
                        <th style="width:50px;">STT</th>
                        <th style="width:120px;">Thumbnail</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th style="width:100px;">Brand</th>
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
                                <td><img src="'.fixUrl($item['thumbnail']).'" style="height: 100px;"></td>
                                <td>'.$item['title'].'</td>
                                <td>'.number_format($item['discount']).'</td>
                                <td>'.$item['category_name'].'</td>
                                    <th style="text-align: center;">
                                        <a href="editor.php?id='.$item['id'].'" style="padding: 8px; color: #060ccd;">
                                            <i class="fas fa-user-edit"></i>
                                        </a>
                                    </th>
                                    <th style="text-align: center;">
                                        <a onclick="deleteProduct('.$item['id'].')" style="padding: 8px; color: #ff1d05;">
                                            <i class="fas fa-user-times"></i>
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
        function deleteProduct(id) {
            option = confirm('Xoá sản phẩm này này?')
            if(!option) return;

            $.post('form_api.php', {
                'id': id,
                'action': 'delete'
            }, 
            function (data) {
                location.reload()
            })
        }
    </script>

<?php
    require_once($baseUrl.'layouts/footer.php');
?>
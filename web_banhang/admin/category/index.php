<?php

    $title = 'Danh mục sản phẩm';
    $baseUrl = '../';
    require_once($baseUrl.'layouts/header.php');

    
    require_once('form_save.php');
    $id = $name = "";
    if(isset($_GET['id'])){
        $id = getGet('id');
        $sql = "SELECT * FROM category where id = $id";
        $data = executeResult($sql, true);

        if($data != null) {
            $name = $data['name'];
        }
    }

    $sql = "SELECT * FROM category";
    $data = executeResult($sql);
?>  
   <div class="row">
        <h1 class="text-center pt-4 pb-4">Quản lý danh mục sản phẩm</h1>
        <div class="col-md-4">
            <form method="post" action="index.php">
                <div class="form-group" style="padding: 0 8px;">
                    <lable for="usr" style="font-weight: bold;">Tên danh mục sản phẩm</lable>
                    <input type="text" required="true" class="form-control" id="usr" name="name" value="<?=$name?>">
                    <input type="text" name="id" value="<?=$id?>" hidden="true">
                    <button class="btn btn-success mt-2">Thêm mới</button>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered table-hover table-reponsive mx-4 mt-4" style="width: 90%;">
                <thead>
                    <tr>
                        <th style="width:50px;">STT</th>
                        <th>Tên danh mục</th>
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
                                <td>'.$item['name'].'</td>
                                    <th style="text-align: center;">
                                        <a href="?id='.$item['id'].'" style="padding: 8px; color: #060ccd;">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </th>
                                    <th style="text-align: center;">
                                        <a onclick="deleteCategory('.$item['id'].')" style="padding: 8px; color: #ff1d05;">
                                            <i class="far fa-trash-alt"></i>
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
        function deleteCategory(id) {
            option = confirm('Xoá danh mục này?')
            if(!option) return;

            $.post('form_api.php', {
                'id': id,
                'action': 'delete'
            }, 
            function (data) {
                if(data != null && data != '') {
                    alert(data);
                    return;
                }
                location.reload()
            })
        }
    </script>
<?php
    require_once($baseUrl.'layouts/footer.php');
?>
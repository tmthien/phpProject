<?php

    $title = 'Thêm/Sửa sản phẩm';
    $baseUrl = '../';
    require_once($baseUrl.'layouts/header.php');

    $id = $thumbnail = $title = $price = $discount = $category_id = $description = '';

    require_once('form_save.php');

    $id = getGet('id');

    if($id != '' && $id > 0) {
        $sql = "SELECT * FROM product where id = '$id' and deleted =0";
        $productItem = executeResult($sql, true); 

        if($productItem != null) {
            $thumbnail      = $productItem['thumbnail'];
            $title          = $productItem['title'];
            $price          = $productItem['price'];
            $discount       = $productItem['discount'];
            $category_id    = $productItem['category_id'];
            $description    = $productItem['description'];
        }
        else {
            $id = 0;
        }
    }
    else {
        $id = 0;
    }

    $sql = "SELECT * FROM category";
    $categoryItems = executeResult($sql);
?>  

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center pt-4 pb-4">Thêm/Sửa sản phẩm</h1>
            <!-- <h4 class="text-center pt-4 pb-4" style="color:red;"><?=$msg?></h4> -->
        </div>
        <div class="panel panel-primary main-form" >
            <div class="panel-body" >
                <form method="post" enctype="multipart/form-data">
                    <div class="container"> 
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">Tên sản phẩm:</label>
                                    <input required="true" type="text" class="form-control" id="title" name="title" value="<?=$title?>">
                                    <input type="text" name="id" value="<?=$id?>" hidden="true">
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô tả sản phẩm:</label>
                                    <textarea class="form-control" name="description" id="description" rows="5"><?=$description?></textarea>
                                </div>
                                <button class="btn btn-success" style="width:100px;">Lưu</button>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category_id">Hãng:</label>
                                    <select class="form-control" name="category_id" id="category_id"  require="true">
                                        <option value="">--Chọn--</option>
                                        <?php
                                            foreach ($categoryItems as $item) {
                                                if($item['id'] == $category_id) {
                                                    echo '
                                                        <option selected value="'.$item['id'].'">'.$item['name'].'</option>
                                                    ';
                                                }
                                                echo '
                                                    <option value="'.$item['id'].'">'.$item['name'].'</option>
                                                ';
                                            }
                                        ?>  
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Giá:</label>
                                    <input type="number" class="form-control" id="price" name="price" value="<?=$price?>">
                                </div>
                                <div class="form-group">
                                    <label for="discount">Giảm giá:</label>
                                    <input type="number" class="form-control" id="discount" name="discount" value="<?=$discount?>">
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail:</label>
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" onchange="updateThumbnail()">
                                    <img id="thumbnail_img" src="<?=fixUrl($thumbnail)?>" style="margin: 4px; max-height:120px;" >
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type = "text/javascript">
        function updateThumbnail(){
            $('#thumbnail_img').attr('src', $('#thumbnail').val())
        }
        $('#description').summernote({
        placeholder: 'Nhập giới thiệu sản phẩm',
        tabsize: 2,
        height: 320,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>
<?php
    require_once($baseUrl.'layouts/footer.php');
?>
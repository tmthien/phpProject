<?php
    require_once ('../layouts/header.php');

    $category_id = getGet('id');

    if($category_id == null || $category_id ==''){
        $sql  = "SELECT product.*, category.name as category_name from product left join category on product.category_id = category.id
         order by product.updated_at desc limit 0,8";
    }
    else {
        $sql  = "SELECT product.*, category.name as category_name from product left join category on product.category_id = category.id 
        where product.category_id = $category_id order by product.updated_at desc limit 0,8";
    }

    $lastestItems = executeResult($sql);
?>
    <h2 class="page-header">SẢN PHẨM MỚI NHẤT</h2>

    <div class="container">
        <!--  -->
            <div class="row">
                <?php
                    foreach ($lastestItems as $item) {
                        echo'
                            <div class="col-md-3 col-6 product">
                                <a href="detail.php?id='.$item['id'].'">
                                    <img src="'.fixUrls($item['thumbnail']).'" alt="">
                                    <p class="product-brand">'.$item['category_name'].'</p>
                                    <p class="product-name">'.$item['title'].'</p>
                                </a>
                                <p class="product-price">'.number_format($item['discount']).'</p>
                                </div>
                                ';
                            }
                            ?>
            </div>
    </div>        

<?php
    require_once('../layouts/footer.php');
?>


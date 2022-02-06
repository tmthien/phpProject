<?php
    require_once ('../layouts/header.php');
    
    $sql  = "SELECT product.*, category.name as category_name from product left join category on product.category_id = category.id order by product.updated_at desc limit 0,8";
    $lastestItems = executeResult($sql);
    
?>

<!-- BANNER START -->
<div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://sotavn.com/media/stories/images/thiet-ke-logo-giay-the-thao-4.png" alt="">
        </div>
        <div class="carousel-item">
        <img src="https://thietke6d.com/wp-content/uploads/2021/05/banner-quang-cao-giay-6.png" alt="Chicago">
        </div>
        <div class="carousel-item">
        <img src="https://thietke6d.com/wp-content/uploads/2021/05/banner-quang-cao-giay-3.png" alt="New York">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>

</div>
<!-- BANNER END -->
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
        
    <!-- Danh muc san pham -->
            <?php
                foreach ($menuItems as $item) {
                    $sql  = "SELECT product.*, category.name as category_name 
                    from product left join category on product.category_id = category.id 
                    where product.category_id = ".$item['id']." order by product.updated_at desc limit 0,4";
                    $items = executeResult($sql);
                    if($items == null || count($items) < 4) continue;
            ?>
        <h2 class="page-header"><?=$item['name']?></h2>
                <div class="row">
                    <?php
                            foreach ($items as $pitem) {
                                echo'
                                <div class="col-md-3 col-6 product">
                                    <a href="detail.php?id='.$item['id'].'">
                                        <img src="'.fixUrls($pitem['thumbnail']).'" alt="">
                                        <p class="product-brand">'.$pitem['category_name'].'</p>
                                        <p class="product-name">'.$pitem['title'].'</p>
                                    </a>
                                        <p class="product-price">'.number_format($pitem['discount']).'</p>
                                    </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php
    require_once('../layouts/footer.php');
?>


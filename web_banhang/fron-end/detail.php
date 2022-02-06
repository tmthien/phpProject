<?php
    require_once ('../layouts/header.php');

    $productId = getGet('id');
    $sql  = "SELECT product.*, category.name as category_name from product left join category on product.category_id = category.id 
    where product.id = $productId ";
    $product = executeResult($sql, true);

    $category_id = $product['category_id'];
    $sql  = "SELECT product.*, category.name as category_name from product left join category on product.category_id = category.id 
    where product.category_id = $category_id order by product.updated_at desc limit 0,4";
    $lastestItems = executeResult($sql);
    
?>
<link rel="stylesheet" href="../assets/css/index.css">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?=fixUrls($product['thumbnail'])?>" style="width: 100%;"alt="">
            </div>
            <div class="col-md-6">
                <ul class="breadcrumb product-detail">
                    <li>
                        <a href="index.php">Trang chủ /</a>
                    </li>
                    <li>
                        <a href="category.php?id=<?=$product['category_id']?>"> <?=$product['category_name']?> /</a>
                    </li>
                    <li> <?=$product['title']?></li>
                </ul>
                <h4><?=$product['title']?></h4>
                <div class="reviews-counter">
                    <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" checked />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" checked />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" checked />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" title="text">1 star</label>
                        </div>
                    <span>3 Reviews</span>
                </div>
                <div class="product-price-discount">
                    <h4><?=number_format($product['discount'])?> VND</h4>
                    <span class="line-through"><?=number_format($product['price'])?> VND</span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="size">Size</label>
                        <select id="size" name="size" class="form-control">
                            <option>S</option>
                            <option>M</option>
                            <option>L</option>
                            <option>XL</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="color">Color</label>
                        <select id="color" name="color" class="form-control">
                            <option>Blue</option>
                            <option>Green</option>
                            <option>Red</option>
                        </select>
                    </div>
                </div>
                <div class="product-count">
                    <label for="size">Số lượng</label>
                    <div class="d-flex">
                        <button class="btn btn-light" onclick="addMoreCart(-1)" >-</button>
                        <input type="number" name="num" value="1" class="qty" onchange="fixCartNum()">
                        <button class="btn btn-light" onclick="addMoreCart(1)" >+</button>
                    </div>
                </div>
                <button class="btn btn-secondary" onclick="addCart(<?=$product['id']?>, $('[name=num]').val())">Thêm vào giỏ hàng</button>
                <a href="cart.php">
                    <button class="btn btn-view">Xem giỏ hàng</button>
                </a>
                    
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Chi tiết sản phẩm</h2>
                <p><?=$product['description']?></p>
            </div>
        </div>
    </div>

    <h2 class="page-header">SẢN PHẨM LIÊN QUAN</h2>
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
                                <p class="product-price">'.number_format($item['discount']).' VND</p>
                                </div>
                                ';
                            }
                            ?>
            </div>
    </div>       

    <script type="text/javascript">
        function addMoreCart(delta) {
            num = parseInt($('[name=num]').val())
            num += delta
            if(num <1 ) num =1;
            $('[name=num]').val(num)
        }
        function fixCartNum() {
            $('[name=num]').val(Math.abs($('[name=num]').val()))
        }
        function addCart(productId, num) {
            $.post('../api/ajax_request.php', {
                'action': 'cart',
                'id': productId,
                'num': num
            }, function(data) {
                location.reload()
            })
        }

    </script>

<?php
    require_once('../layouts/footer.php');
?>


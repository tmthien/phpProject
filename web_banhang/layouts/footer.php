<div class="footer" style="margin-top:10px;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                Giới thiệu
                <ul>
                    <li>Email: zxczxc@gmail.com</li>
                    <li>Phone: 0123654987</li>
                </ul>
            </div>
        </div>
    </div>
    <p>Coppy right @ 2021</p>
</div>

<?php
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $count = 0;
    foreach($_SESSION['cart'] as $item) {
        $count += $item['num'];
    }
?>

<!-- Cart Start -->
    <span class="cart-icon">
        <span class="cart-count"><?= $count ?></span>
        <a href="cart.php">
            <img class="rounded-circle" src="https://banner2.cleanpng.com/20180703/vtz/kisspng-shopping-cart-software-computer-icons-mayline-5b3b72a89c95a3.3174593115306226326414.jpg" alt="">
        </a>
    </span>
<!-- Cart end -->
   
</html>
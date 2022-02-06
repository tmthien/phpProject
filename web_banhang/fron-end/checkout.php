<?php
    require_once ('../layouts/header.php');

?>
   <div class="container">
       <form method="post" onsubmit="return completeCheckout();">
            <div class="row">
                <div class="col-md-6">
                        <h3>Giỏ hàng</h3>
                        <div class="panel-body">
                                <div class="form-group">
                                    <label for="fullname">Tên:</label>
                                    <input required="true" type="text" placeholder="Nhập Họ Tên" class="form-control" id="fullname" name="fullname">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input required="true" type="email" placeholder="Nhập Email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group ">
                                    <label for="phone_number">SĐT:</label>
                                    <input required="true" type="tel" placeholder="Số điện thoại" class="form-control" id="phone_number" name="phone_number">
                                </div>
                                <div class="form-group">
                                    <label for="address">Địa chỉ:</label>
                                    <input required="true" type="text" placeholder="Nhập địa chỉ" class="form-control" id="address" name="address">
                                </div>
                                <div class="form-group">
                                    <label for="note">Nội dung:</label>
                                <textarea name="note" id="note" cols="70" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th>STT</th>
                            <th>Thumbnail</th>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng giá</th>
                        </tr>
                            <?php
                                if(!isset($_SESSION['cart'])) {
                                    $_SESSION['cart'] = [];
                                }
                                $index = 0;
                                foreach($_SESSION['cart'] as $item) {
                                    echo'
                                    <tr>
                                    <td>'.(++$index).'</td>
                                    <td>
                                    <img src="'.fixUrls($item['thumbnail']).'" style="width:100px">
                                            </td>
                                            <td>'.$item['title'].'</td>
                                            <td>'.number_format($item['discount']).' VNĐ</td>
                                            <td>'.$item['num'].'</td>
                                            <td>'.number_format($item['discount'] * $item['num']).' VNĐ</td>
                                        </tr>
                                        ';
                                    }
                            ?>
                    </table>
                    <a href="checkout.php">
                        <button class="btn btn-checkout" onclick="completeCheckout()">Thanh toán</button>
                    </a>
                </div>
            </div>
        </form>
   </div>
   <script type="text/javascript">
       function completeCheckout() {
           $.post('../api/ajax_request.php', {
                'action': 'checkout',
                'fullname': $('[name=fullname]').val(),
                'email': $('[name=email]').val(),
                'phone_number': $('[name=phone_number]').val(),
                'address': $('[name=address]').val(),
                'note': $('[name=note]').val()
            }, function(){
                window.open('complete.php', '_self');
            })
            return false;
        }
    </script>

<?php
    require_once('../layouts/footer.php');
?>


<?php
    require_once ('../layouts/header.php');

?>
   <div class="container">
       <div class="row">
           <h3>Giỏ hàng</h3>
           <table class="table table-bordered">
               <tr>
                   <th>STT</th>
                   <th>Thumbnail</th>
                   <th>Tên</th>
                   <th>Giá</th>
                   <th>Số lượng</th>
                   <th>Tổng giá</th>
                   <th style="width: 70px;"></th>
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
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-light" onclick="addMoreCart('.$item['id'].', -1)" >-</button>
                                        <input type="number" id="num_'.$item['id'].'" name="num" value="'.$item['num'].'" class="form-control" style="width:60px;" onchange="fixCartNum('.$item['id'].')">
                                        <button class="btn btn-light" onclick="addMoreCart('.$item['id'].', 1)" >+</button>
                                    </div>
                                </td>
                                <td>'.number_format($item['discount'] * $item['num']).' VNĐ</td>
                                <td>
                                    <button class="btn btn-danger" onclick="updateCart('.$item['id'].', 0)">Xoá</button>
                                </td>
                            </tr>
                        ';
                    }
                ?>
           </table>
           <a href="checkout.php">
               <button class="btn btn-checkout">Thanh toán</button>
           </a>
       </div>
   </div>
   <script type="text/javascript">
        function addMoreCart(id, delta) {
            num = parseInt($('#num_'+id).val())
            num += delta
            $('#num_'+id).val(num)

            updateCart(id, num)
        }
        function fixCartNum(id) {
            $('#num_'+id).val(Math.abs($('#num_'+id).val()))
            updateCart(id,  $('#num_'+id).val())

        }
        function updateCart(productId, num) {
            $.post('../api/ajax_request.php', {
                'action': 'update_cart',
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


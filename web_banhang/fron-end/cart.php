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
                   <th>Tổng giá</th>
                   <th></th>
               </tr>
                <?php
                    if(!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }
                    $index=0;
                    foreach($_SESSION['cart'] as $item){
                        echo'
                            <tr>
                                <td>'.(++$index).'</td>
                                <td>
                                </td>
                                <td>'.$item['title'].'</td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-danger">Xoá</button>
                                </td>
                            </tr>
                        ';
                    }
                ?>
                <img src="" alt="">
           </table>
       </div>
   </div>

<?php
    require_once('../layouts/footer.php');
?>


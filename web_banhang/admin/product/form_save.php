<?php  
    if(!empty($_POST)) {
        $id             = getPost('id');
        $title          = getPost('title');
        $price          = getPost('price');
        $discount       = getPost('discount');
        $description    = getPost('description');
        $category_id    = getPost('category_id');

        $thumbnail      = moveFile('thumbnail');
        
        $created_at = $updated_at = date('Y-m-d H:i:s');

       if($id > 0) {
           //update dữ liệu
           if($thumbnail != ''){
               $sql = "UPDATE product SET thumbnail = '$thumbnail', title = '$title', description = '$description', price = '$price', discount = '$discount', updated_at = '$updated_at', created_at = '$created_at' WHERE id ='$id'";
           }
           else{
               $sql = "UPDATE product set title = '$title', price = '$price', discount = '$discount', description = '$description', created_at = '$created_at', updated_at = '$updated_at' WHERE id = $id";
           }
            execute($sql);
            header("Location: index.php");
            die();
        }

       else {
           //inser dữ liệu
           $sql = "INSERT INTO product (category_id, title, price, discount, thumbnail, description,  created_at, updated_at, deleted) 
           values ('$category_id', '$title', '$price', '$discount', '$thumbnail', '$description',  '$created_at', '$updated_at', 0)";
           execute($sql);
           header("Location: index.php");
           die();
       }
    }

?>
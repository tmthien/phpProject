<?php
    require_once ('../layouts/header.php');

    if(!empty($_POST)) {
        $first_name = getPost['first_name'];
        $last_name = getPost['last_name'];
        $email = getPost['email'];
        $phone_number = getPost['phone_number'];
        $subject_name = getPost['subject_name'];
        $note = getPost['note'];
        $created_at = $updated_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO feedback (firstname, lastname, email, phone_number, subject_name, note, created_at, updated_at)
        values ('$first_name', '$last_name', '$email', $phone_number, '$subject_name', '$note, '$created_at', '$updated_at";
        execute($sql);
    }

?>
   <div class="container">
       <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <h3>Phản hồi</h3>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input required="true" type="text" placeholder="Nhập Họ " class="form-control" id="usr" name="first_tname">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input required="true" type="text" placeholder="Nhập Họ Tên" class="form-control" id="usr" name="last_name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input required="true" type="email" placeholder="Nhập Email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group ">
                            <input required="true" type="tel" placeholder="Số điện thoại" class="form-control" id="phone_number" name="phone_number">
                        </div>
                        <div class="form-group">
                            <input required="true" type="text" placeholder="Nhập chủ đề" class="form-control" id="subject_name" name="subject_name">
                        </div>
                        <div class="form-group">
                            <textarea name="note" id="note" cols="70" rows="5"></textarea>
                        </div>
                        <button>Gửi phản hồi</button>
                    </div>
                </div>
                <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27311.708809096184!2d107.9986639161534!3d16.310847398340396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe985a778248e8920!2zQmnhu4NuIELDrG5oIEFu!5e0!3m2!1svi!2s!4v1644138657386!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </form>
   </div>

<?php
    require_once('../layouts/footer.php');
?>


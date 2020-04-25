<?php
if (isset($_POST['message'])) {
    $AllEmails = new \model\NewsLetter();
    $arrayOfTargets = $_POST['target'] ? ['email' => $_POST['target']] : $AllEmails->getAll();
    foreach ($arrayOfTargets as $arrayOfTarget){
        $arrayOfTarget = (array)$arrayOfTargets;
        mail($arrayOfTarget['email'],'NoReply@puzzleide.ir',$_POST['message']);
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">داشبورد</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="#">خانه</a></li>
                    <li class="breadcrumb-item active">داشبورد مدیریتی</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $conn->query("select * from tblTickets")->rowCount() ?></h3>
                        <p>تیکت ها</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a rel="Users/Tickets/Tickets" class="small-box-footer ajax">اطلاعات بیشتر <i
                                class="fa fa-arrow-circle-left"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $conn->query("select * from tblNewsLetter")->rowCount() ?></h3>
                        <p>اعضای خبرنامه</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a rel="Users/NewsLetter/NewsLetter" class="small-box-footer ajax">اطلاعات بیشتر <i
                                class="fa fa-arrow-circle-left"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= $conn->query("select * from tblServices")->rowCount() ?></h3>
                        <p>خدمات شما</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a rel="Site/Services/Services" class="small-box-footer ajax">اطلاعات بیشتر <i
                                class="fa fa-arrow-circle-left"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $conn->query("select * from tblVisits")->rowCount() ?></h3>

                        <p>بازدید جدید</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success card-outline">
                    <div class="card card-header">
                        <div class="card-title">
                            ارسال پیام در خبر نامه
                        </div>
                        <div class="card-tools">
                            <button data-widget="remove" class="btn btn-tool">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <form method="post">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <textarea id="textarea" name="message"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="col-md-12">
                                    <div class="d-flex flex-wrap">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <input checked type="checkbox" class="ml-2" id="toAll">
                                                <label for="toAll">ارسال برای همه</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <input disabled="disabled" type="email" name="target" id="target"  class="form-control w-75 text-center">
                                                <button class="btn btn-primary">
                                                    ارسال
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
<script>
    document.getElementById('toAll').onchange = function () {
        if (this.checked == false) {
            document.getElementById('target').setAttribute('placeholder','ایمیل هدف');
            document.getElementById('target').removeAttribute('disabled');
        } else  {
            document.getElementById('target').setAttribute('disabled','disabled');
            document.getElementById('target').removeAttribute('placeholder');
        }
    };
</script>

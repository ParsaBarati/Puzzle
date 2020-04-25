<?php
include '../../../autoload.php';
$data = ValidateRequestForPageLoad($_POST);
echo CheckLoadedDataFromAjaxCall($data);
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DATA SEEDER</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="../../index.php">خانه</a></li>
                    <li class="breadcrumb-item active">DATA SEEDER</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title">DATA SEEDER</h3>
                    <div class="card-tools">

                        <a rel="Seeder/Seeder.php"
                           class="btn btn-outline-danger mr-2 pull-left ajax"><i
                                    class="fa fa-arrow-left"></i> بازگشت </a>
                        <a rel="Seeder/SeedStart.php?table=<?= $data->table ?>"
                           class="btn btn-outline-danger pull-left ajax"><i
                                    class="fa fa-refresh"></i> تازه
                            سازی</a>
                    </div>
                </div>
                <form>
                    <div class="card-body d-flex flex-wrap table-responsive">
                        <?= hiddenInput($data->table, 'table') ?>
                        <?php
                        foreach ($data as $key => $item) {
                            if ($key != 'table') {
                                ?>
                                <div class="form-group col-md-4">
                                    <label style="float: left"><?= $item ?></label>
                                    <select required class="form-control" name="name[<?= $item ?>]">
                                        <option value="0" selected>خالی باشد</option>
                                        <option value="state">آیدی استان</option>
                                        <option value="state_name">نام استان</option>
                                        <option value="city">شهرایدی</option>
                                        <option value="city_name">نام شهر</option>
                                        <option value="state_by_city">آیدی استان والد شهر</option>
                                        <option value="mobile">موبایل</option>
                                        <option value="fname">نام</option>
                                        <option value="lname">نام خانوادگی</option>
                                        <option value="tel">تلفن</option>
                                        <option value="username">نام کاربری</option>
                                        <option value="password">رمز عبور</option>
                                        <option value="nCode">کد ملی</option>
                                        <option value="email">ایمیل</option>
                                        <option value="word">کلمه</option>
                                        <option value="time">تایم الان</option>
                                    </select>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    <div class="form-group col-md-9 mr-auto ml-auto">
                        <label>تعداد رکورد ها</label>
                        <input type="number" min="0" value="100" max="1000" name="count" required class="form-control">
                    </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-danger pull-left"><i class="fa fa-plus"></i>
                            !Seed
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    $.submit('controllers/Seeder/SeedSubmit.php');
    $.Ajax();
</script>

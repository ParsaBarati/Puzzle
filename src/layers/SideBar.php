<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
    data-accordion="false">
    <!-- start -->
        <?= navItemHasTreeView('مدیریت محتوای سایت',
            'fa fa-stack-exchange',
            navItem('بنر ها', 'Site/TopBanners/TopBanners') .
            navItem('بنر بخش وسط', 'Site/MidBanner/MidBanner') .
            navItem('مدیریت تیتر ها', 'Site/Titles/Titles') .
            navItem('شمارنده ها', 'Site/Counters/Counters') .
            navItem('روند کاری', 'Site/WorkPlan/WorkPlan') .
            navItem('تنظیمات فوتر', 'Site/Footer/FooterSettings/FooterSettings') .
            navItem('مقالات', 'Site/Blog/Blogs') .
            navItem('خدمات', 'Site/Services/Services')


        ) ?>
        <?= navItemHasTreeView('تیکت ها و اعضای خبر نامه', 'fa fa-stack-exchange', navItem('تیکت ها', 'Users/Tickets/Tickets') . navItem('خبر نامه', 'Users/NewsLetter/NewsLetter') . navItem('پیام های خوش آمد', 'Users/WelcomeMessages/WelcomeMessages')) ?>
    <?=navItem('مدیریت استان ها','Test/States/States')?>
    <!-- end -->
    <li class="nav-item">
        <a href="Actions/sign-out"
           class="nav-link">
            <i class="fa fa-circle-o nav-icon text-danger"></i>
            <p>خروج
            </p>
        </a>
    </li>
    <?php
    if ($DEVELOPMENT == true) {
        ?>
        <li class="nav-item">
            <a rel="Seeder/Seeder.fwTools"
               class="nav-link ajax">
                <i class="fa fa-times-circle-o nav-icon text-danger"></i>
                <p>DATA SEEDER
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a rel="QueryBuilder/QueryBuilder.fwTools"
               class="nav-link ajax">
                <i class="fa fa-times-circle-o nav-icon text-danger"></i>
                <p>QUERY BUILDER
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a rel="modelGenerator/modelGenerator.fwTools"
               class="nav-link ajax">
                <i class="fa fa-times-rectangle nav-icon text-danger"></i>
                <p>MODEL GENERATOR
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a rel="formGenerator/formGenerator.fwTools"
               class="nav-link ajax">
                <i class="fa fa-times-rectangle-o nav-icon text-danger"></i>
                <p>Form Generator
                </p>
            </a>
        </li>
        <?php
    }
    ?>
</ul>

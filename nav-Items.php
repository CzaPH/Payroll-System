<?php function navItems($active) { ?>
<?php 
        $items = [
            [
                "caption"=> "Employee",
                "icon"=> "bx bx-grid-alt",
                "url"=> "dashboard.php"
            ],
            [
                "caption"=> "Attendance",
                "icon"=> "bx bxs-user-circle",
                "url"=> "attendance.php"
            ],
           
            [
                "caption"=> "Schedule",
                "icon"=> "bx bx-task'",
                "url"=> "Schedule.php"
            ],
            [
                "caption"=> "Payroll",
                "icon"=> "bx bxs-wallet-alt",
                "url"=> "Payroll.php"
            ],
        ];
    ?>
<ul class="nav-links">
    <?php foreach ($items as $item) { ?>
    <li>
        <a href="<?= $item["url"] ?>" style="color: white" class="<?= $item["caption"] == $active ? "active": "" ?>">
            <i class='<?= $item["icon"] ?>'></i>
            <span class="link_name"><?= $item["caption"] ?></span>
        </a>
    </li>
    <?php } ?>

</ul>
<?php } ?>
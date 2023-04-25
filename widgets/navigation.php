<div class="app-sidebar">
    <a href="index.php" class="app-sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == "index.php") { ?>active<?php } ?>">
        <i class="fa fa-home fa-lg"></i>
    </a>
    <a href="account.php" class="app-sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == "account.php") { ?>active<?php } ?>">
        <i class="fa fa-user fa-lg"></i>
    </a>
    <a href="transactions.php" class="app-sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == "transactions.php") { ?>active<?php } ?>">
        <i class="fa fa-chart-pie fa-lg"></i>
    </a>
    <a href="schedule.php" class="app-sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == "schedule.php") { ?>active<?php } ?>">
        <i class="fa fa-calendar-day fa-lg"></i>
    </a>

    <?php if($_SESSION['task'] == 'EMPLOYEE' || $_SESSION['id'] == 'SUPERADMIN1030'){ ?>
    <a href="employee.php" class="app-sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == "employee.php" || basename($_SERVER['PHP_SELF']) == "employee-dashboard.php") { ?>active<?php } ?>">
        <i class="fa fa-list fa-lg" style="color:<?php echo $__colorEmployee; ?>;"></i>
    </a>
    <a href="employee-monitor.php" class="app-sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == "employee-monitor.php") { ?>active<?php } ?>">
        <i class="fa fa-dollar-sign fa-lg" style="color:<?php echo $__colorEmployee; ?>;"></i>
    </a>
    <?php } ?>

    <?php if($_SESSION['task'] == 'ADMIN' || $_SESSION['id'] == 'SUPERADMIN1030'){ ?>
    <a href="admin.php" class="app-sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == "admin.php") { ?>active<?php } ?>">
        <i class="fa fa-chart-line fa-lg" style="color:<?php echo $__colorAdmin; ?>;"></i>
    </a>
    <a href="admin-account.php" class="app-sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == "admin-account.php") { ?>active<?php } ?>">
        <i class="fa fa-users fa-lg" style="color:<?php echo $__colorAdmin; ?>;"></i>
    </a>
    <a href="admin-core.php" class="app-sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == "admin-core.php") { ?>active<?php } ?>">
        <i class="fa fa-suitcase fa-lg" style="color:<?php echo $__colorAdmin; ?>;"></i>
    </a>
    <?php } ?>

    <a href="setting.php" class="app-sidebar-link <?php if (basename($_SERVER['PHP_SELF']) == "setting.php") { ?>active<?php } ?>">
        <i class="fa fa-wrench fa-lg"></i>
    </a>
</div>
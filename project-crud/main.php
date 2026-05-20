<?php
session_start();
session_regenerate_id();
ob_start();
include "config/connection.php";
include "config/function.php";


if (!isset($_SESSION['NAMA'])) {
    header("location:index.php");
}
?>

<!DOCTYPE html>

<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="assets/template/assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard</title>

    <meta name="description" content="" />

    <?php include "inc/css.php"; ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include "inc/sidebar.php"; ?>

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include "inc/navbar.php"; ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-12-md">
                                <?php
                                if (isset($_GET['page'])) {
                                    if (file_exists('pages/' . $_GET['page'] . '.php')) {
                                        include 'pages/' . $_GET['page'] . '.php';
                                    } else {
                                        echo "<h1>Halaman tidak ditemukan</h1>";
                                    }
                                } else {
                                    include 'pages/dashboard.php';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php include "inc/footer.php"; ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <?php include "inc/js.php"; ?>
</body>

</html>
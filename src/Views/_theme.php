<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= url("themes/soft-ui/assets/img/apple-icon.png") ?>">
    <link rel="icon" type="image/png" href="<?= url("themes/soft-ui/assets/img/favicon.png") ?>">
    <title><?= $title ?></title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= url("themes/soft-ui/assets/css/nucleo-icons.css") ?>" rel="stylesheet" />
    <link href="<?= url("themes/soft-ui/assets/css/nucleo-svg.css") ?>" rel="stylesheet" />
    <link href="<?= url("public/css/crud.css") ?>" rel="stylesheet" />
    <link href="<?= url("public/css/home.css") ?>" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= url("themes/soft-ui/assets/css/nucleo-svg.css") ?>" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= url("themes/soft-ui/assets/css/soft-ui-dashboard.css?v=1.0.3") ?>" rel="stylesheet" />
    <link href="<?= url("public/css/toastr.css") ?>" rel="stylesheet" />
    <?= $this->section("styles") ?>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?= $this->insert("/templates/left", $left); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <?= $this->insert("/templates/header"); ?>
        <div class="container-fluid py-4">
            <?= $this->section("content") ?>
            <script> const salvar = <?php echo json_encode(url('plans.addSong')) ?>; </script>
            <?= $this->insert("/templates/footer"); ?> 
        </div>
    </main>
    <?= 
        $this->insert("/templates/right"); 
        $this->insert("/templates/scripts"); 
        ?>
    <?= $this->section("scripts") ?>
    <?= $this->insert("templates/message") ?>
</body>
</html>
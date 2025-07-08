<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi e-Arsip</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="app sidebar-mini">
    <!-- header -->
    <?= $this->include('layout/header') ?>
    <!-- menu -->
    <?= $this->include('layout/menu') ?>
    <!-- content -->
    <?= $this->renderSection('content') ?>
    <?= $this->include('layout/script') ?>
</body>

</html>